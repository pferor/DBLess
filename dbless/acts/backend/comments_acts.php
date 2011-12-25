<?php
/**
 * @file posts_acts.php
 *
 * @brief Posts creation/edition/deletion actions
 *
 * @note I'm not happy with the method used here (and in users form).
 *       It will be so tedious to have an intermediate page for each
 *       comment, but in this case, a form per comment is needed on
 *       the same page. So I need to pass the comment ID throught the
 *       URI. Since this is the administration, no one is allowed here
 *       unless the administrator says so, but I think this is a flaw
 *       in this project.
 */

$DIR_LEVEL = 2;
require_once('../../localcfg.php');
include($DIR_CONFIG  . 'dirs.php');
include($DIR_CONFIG  . 'pages_ids.php');
include($DIR_CONFIG  . 'site_admin.php'); /* Site administrators. */
include($DIR_CONFIG  . 'site_tech.php');  /* Site technical info. */
include($DIR_INCLUDE . 'common.php');     /* Truncate(... */
include($DIR_INCLUDE . 'file.php');       /* SaveFile(... */
include($DIR_INCLUDE . 'html.php');       /* html2text(... */
include($DIR_INCLUDE . 'values.php');     /* GetValueOrDefault(... */


/* Language */
if (!isset($_GET['lang']) || !file_exists($DIR_POSTS . $_GET['lang'])) {
  $Language = $SITE_DEFAULT_LANGUAGE;
} else {
  $Language = $_GET['lang'];
}

/* OK, this is a mess... :-( */
/* Comment ID */
if (isset($_GET['id'])) {
  $CommentID = GetValueOrDefault($_GET['id'], 0);
} else {
  $CommentID = GetValueOrDefault($_POST['id'], 0);
}
/* Post ID */
if (isset($_GET['postid'])) {
  $PostID = GetValueOrDefault($_GET['postid'], 0);
} else {
  if (isset($_POST['postid'])) {
    $PostID = GetValueOrDefault($_POST['postid'], 0);;
  } else {
    $PostID = GetValueOrDefault($_POST['postid_' . $CommentID], 0);
  }
}


/* Actions for each id */
$bu_accept_id = 'bu_accept_' . $CommentID;
$bu_reject_id = 'bu_reject_' . $CommentID;


/* Default URI, just if something went wrong */
$URI = '../../admin.php?pg=' . $_b_comments_ .
  '&lang=' . $Language;


/* Accept button pressed */
if (isset($_POST[$bu_accept_id])) {
  $CommentsDirectory = $DIR_POSTS . $Language . '/' .
    $_POST['postid_' . $CommentID];
  /* Save the comment again, under the same name, but changing the
   * MODERATE_PENDING flag to '0'. */
  $MODERATE_PENDING = 0;
  $AUTHOR  = $_POST['re_author_'        . $CommentID];
  $COMMENT = br2nl($_POST['re_comment_' . $CommentID]);

  /* There is no comprobation, in this point the comment should be
   * valid... just not moderated. */
  $CommentFileContent   = '<?php' . "\n" .
    '$MODERATE_PENDING  = '      . $MODERATE_PENDING . ';' . "\n" .
    '$AUTHOR            = ' . "'". $AUTHOR   . "'"   . ';' . "\n" .
    '$IN_RESPONSE_TO    = ' . "'". NULL      . "'"   . ';' . "\n" .
    '$COMMENT           = ' . "'". nl2br(NoEntities($COMMENT)) .
    "'"   . ';' . "\n" .
    '?>';

  SaveFile($CommentsDirectory . '/' . $CommentID . '.php',
           $CommentFileContent);


  /* --- Log action --- */
  session_start();
  if ($LOG_ACTION) {
    $log_msg = 'Comment "' . $CommentID . '" (' . $Language .
      ') written by ' . $AUTHOR .
      ' was accepted in moderation by ' . $_SESSION['DBL_Username'];
    AppendToLog($FILE_LOG, $log_msg);
  }
  /* --- Log action --- */

  /* Update URI */
  $action = 'admitted';
  $URI .= '&action=' . $action;
/* Reject button pressed */
} else if (isset($_POST[$bu_reject_id])) {
  /* Go to the kill page, this is needed because there is no alerts
   * (no scripting language) and any admin can press this button by
   * mistake. */

  $URI = '../../admin.php?pg=' . $_b_killcomment_ .
    '&lang='    . $Language  .
    '&id='      . $CommentID .
    '&postid='  . $PostID    .
    '&comment=' . urlencode(Truncate(html2text(GetValueOrDefault($_POST['re_comment_' .
                                                                        $CommentID],
                                                                 '?')), 100));
} else if (isset($_POST['bu_kill'])) {
  $AUTHOR  = $_POST['re_author_' . $CommentID];

  $CommentFilename = $DIR_POSTS . $Language . '/' . $PostID . '/' .
    $CommentID . '.php';

  /* Remove comment */
  $action = '';
  if (file_exists($CommentFilename)) {
    if (!@unlink($CommentFilename)) {
      $action = 'cant_rm_comment';
    }
  } else {
    $action = 'cant_rm_comment';
  }

  /* Show the action, success or fail */
  if ($action == '') {
    $action = 'rejected';
  }

  /* --- Log action --- */
  session_start();
  if ($LOG_ACTION) {
    $log_msg = 'Comment "' . $CommentID . '" (' . $Language .
      ') written by ' . $AUTHOR .
      ' was rejected in moderation by ' . $_SESSION['DBL_Username'];
    AppendToLog($FILE_LOG, $log_msg);
  }
  /* --- Log action --- */

  $URI = '../../admin.php?pg=' . $_b_comments_ .
    '&lang='   . $Language .
    '&action=' . $action;
}


/* Redirect automatically */
header('Location: ' . $URI);

