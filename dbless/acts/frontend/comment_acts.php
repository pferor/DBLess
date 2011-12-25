<?php
/**
 * @file comment_acts.php
 *
 * @brief Log in form actions
 */

$DIR_LEVEL = 2;
require_once('../../localcfg.php');
require_once($DIR_CONFIG  . 'dirs.php');
require_once($DIR_CONFIG  . 'pages_ids.php');
require_once($DIR_CONFIG  . 'site_admin.php'); /* Site administrators. */
require_once($DIR_CONFIG  . 'site_tech.php');  /* Site technical info. */
require_once($DIR_INCLUDE . 'values.php');     /* GetValueOrDefault(...) */
require_once($DIR_INCLUDE . 'file.php');       /* SaveFile(...) */
require_once($DIR_INCLUDE . 'html.php');       /* NoEntities(...) */
require_once($DIR_INCLUDE . 'users.php');      /* IsAdmin(...) */
require_once($DIR_INCLUDE . 'datetime.php');   /* FormatDateTime(...) */


/* Language */
if (!isset($_GET['lang']) || !file_exists($DIR_POSTS . $_GET['lang'])) {
  $Language = $SITE_DEFAULT_LANGUAGE;
} else {
  $Language = $_GET['lang'];
}

/* PostID */
$PostID = GetValueOrDefault($_GET['id'], 0);


/* Default URI, just if something went wrong */
$URI = '../..?pg=' . $_f_post_ .
  '&id='   . $PostID .
  '&lang=' . $Language;


/* Comment button pressed */
if (isset($_POST['bu_comment'])) {
  $USERNAME = $_POST['username'];
  $COMMENT  = $_POST['comment'];

  $err = ''; /* Data validates as long as $err is an empty string */
  /* err: No username given */
  if ($USERNAME == '') {
    $err .= '&username=blank';
  }
  /* err: No comment */
  if ($COMMENT == '') {
    $err .= '&comment=blank';
  }

  session_start();


  if (!$_SESSION['DBL_LoggedIn']) {
    $CAPTCHA = $_POST['captcha'];

    if (!isset($_SESSION['DBL_Captcha']) ||
        $_SESSION['DBL_Captcha'] == '') {
      $err .= '&captcha=nocookie';
    }
    else if ($_SESSION['DBL_Captcha'] != $CAPTCHA) {
      $err .= '&captcha=bad';
    }
  }

  /* If data does not validate... */
  if ($err != '') {
    $info = '&tcomment=' . urlencode($COMMENT);
    $URI .= $err . $info;
    $URI .= '#comment_form';
  }
  else {
    /* comment actions */

    /* If no comments folder, create one */
    $CommentsDirectory = $DIR_POSTS . $Language.'/' . $PostID;
    if (!is_dir($CommentsDirectory)) {
      @mkdir($CommentsDirectory);
    }

    if (file_exists($CommentsDirectory)) {
      $CommentID   = FormatDateTime(getdate(), '', '', '');
      $CommentFile = $CommentsDirectory . '/' . $CommentID . '.php';

      /* Save comment */
      /* If user is an administrator, the comment will be published,
         no matter if the comments moderation is activated. */
      if ($COMMENTS_MODERATION &&
          !isAdmin($USERNAME, $SITE_ADMINS_ARR)) {
        $MODERATE_PENDING = 1;
      } else {
        $MODERATE_PENDING = 0;
      }

      $CommentFileContent   = '<?php' . "\n" .
        '$MODERATE_PENDING  = '      . $MODERATE_PENDING . ';' . "\n" .
        '$AUTHOR            = ' . "'". $USERNAME . "'"   . ';' . "\n" .
        '$IN_RESPONSE_TO    = ' . "'". NULL      . "'"   . ';' . "\n" .
        '$COMMENT           = ' . "'". nl2br(NoEntities($COMMENT)) .
        "'" . ';' . "\n" .
        '?>';

      SaveFile($CommentFile, $CommentFileContent);

      /* Update URI */
      $URI .= '&comment=sent';

      /* --- Log action --- */
      if ($LOG_ACTION) {
        $log_msg = 'Comment "' . $CommentID .
          '" added to post "'. $PostID . '" (' . $Language . ') by ' .
	  $USERNAME;
        AppendToLog($FILE_LOG, $log_msg);
      }
      /* --- Log action --- */
    } else {
      $URI .= '&comment=perms';
    }
    $URI .= '#comment';
  }
} else if (isset($_POST["bu_kill"])) {
    $CommentID         = $_POST['comment_id'];
    $CommentsDirectory = $DIR_POSTS . $Language.'/' . $PostID;
    $CommentFile       = $CommentsDirectory . '/' . $CommentID . '.php';

    $_USERNAME = $_POST['author'];

    if (file_exists($CommentFile)) {
      include($CommentFile);

      /* Check who wants to delete the comment.
       * This test is maded on the template file as well, but
       * better to double check it... just in case. ,-) */
      if ($_USERNAME == $AUTHOR) {
        if (@unlink($CommentFile)) {
          /* Delete the comment */
          $URI .= '&comment=deleted';

          /* Delete comments directory if empty. Keep the filesystem
           * clean! */
          if (isEmptyDir($CommentsDirectory)) {
            /* No warning advice if error in this case. After all, the
             * directory will be created again if a new comment
             * arrives, or it will be deleted if the post is killed.
             * In that cases, a warning is shown. No need to do it
             * in every comment deletion. */
            @rmdir($CommentsDirectory);
          }

          /* --- Log action --- */
          if ($LOG_ACTION) {
            $log_msg = 'Comment "' . $CommentID .
              '" deleted on post "'. $PostID . '" (' . $Language . ' ) by ' .
	      $AUTHOR;
            AppendToLog($FILE_LOG, $log_msg);
          }
          /* --- Log action --- */
        }
        else {
          /* Error deleting file */
          $URI .= '&comment=not_deleted';
        }

        $URI .= '#comment';
      } /* if ($_USERNAME... */
    }
}


/* Redirect automatically */
header('Location: ' . $URI);

