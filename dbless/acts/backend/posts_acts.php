<?php
/**
 * @file posts_acts.php
 *
 * @brief Posts creation/edition/deletion actions
 */

$DIR_LEVEL = 2;
require_once('../../localcfg.php');
include($DIR_CONFIG  . 'dirs.php');
include($DIR_CONFIG  . 'pages_ids.php');
include($DIR_CONFIG  . 'site_tech.php');  /* Site technical info. */
include($DIR_INCLUDE . 'datetime.php');   /* FormatDateTimePlain(... */
include($DIR_INCLUDE . 'file.php');       /* SaveFile(... */
include($DIR_INCLUDE . 'html.php');       /* NoQuotes(... */
include($DIR_INCLUDE . 'posts.php');      /* isValidPostFile(... */
include($DIR_INCLUDE . 'tags.php');       /* NormalizeTags(... */
include($DIR_INCLUDE . 'values.php');     /* GetValueOrDefault(... */


/* Language */
if (!isset($_GET['lang']) || !file_exists($DIR_POSTS . $_GET['lang'])) {
  $Language = $SITE_DEFAULT_LANGUAGE;
} else {
  $Language = $_GET['lang'];
}


/* PostID */
$PostID = GetValueOrDefault($_POST['id'], 0);

/* Default URI, just if something went wrong */
$URI = '../../admin.php?pg=' . $_b_post_ .
  '&id='   . $PostID .
  '&lang=' . $Language;


/* Save button pressed */
if (isset($_POST['bu_save'])) {
  /* If $PostID == 0, means new enty, otherwise means editing an old
   * entry */
  if ($PostID == 0){
    $PostID   = FormatDateTime(getdate(), '', '', '');
  }
  $PostFilename = $DIR_POSTS . $Language . '/' . $PostID;

  /* Get post values */
  $TITLE     = $_POST['title'];
  $SUMMARY   = $_POST['summary'];
  $CONTENT   = $_POST['content'];
  $TAGS      = $_POST['tags'];
  $TIMESTAMP = $_POST['timestamp'];
  $AUTHOR    = $_POST['author'];
  $CLOSED    = GetValueOrDefault($_POST['closed'], 0);

  /* Nice values */
  $TITLE   = html2text(NoQuotes($TITLE));
  $SUMMARY = NoQuotes($SUMMARY);
  $CONTENT = NoQuotes($CONTENT);
  $TAGS    = NormalizeTagsString(NoQuotes($TAGS));

  $err = '';
  if ($TITLE == '') {
    $err .= '&title=blank';
  }
  if ($CONTENT == '' ||
      urlencode($CONTENT) == '%3Cp%3E%0D%0A%3C%2Fp%3E' ||
      urlencode($CONTENT) == '%3Cp%3E%3C%2Fp%3E') {
    $err .= '&post=blank';
  }
  if ($AUTHOR == '') {
    $err .= '&author=blank';
  }

  if ($TIMESTAMP == '') {
    $err .= '&timestamp=blank';
  }
  else if (!isValidPostFile(FormatDateTimePlain($TIMESTAMP),
                            true)) { /* future is valid here */
    $err .= '&timestamp=bad';
  }

  /* Validation */
  if ($err != '') {
    /* Update URI */
    $info = '&ttitle=' . urlencode($TITLE) .
      '&tsummary='  . urlencode($SUMMARY) .
      '&tauthor='   . urlencode($AUTHOR) .
      '&ttags='     . urlencode($TAGS) .
      '&ttimstamp=' . urlencode($TIMESTAMP) .
      '&tclosed='   . $CLOSED .
      '&tpost='     . urlencode($CONTENT);

    $URI .= $err . $info;
  } else {
    $NewPostID       = FormatDateTimePlain($TIMESTAMP);
    $CommentsDir     = $DIR_POSTS . $Language . '/'. $PostID . '/';
    $PostFilename    = $DIR_POSTS . $Language . '/'. $PostID . '.php';
    $NewPostFilename = $DIR_POSTS . $Language . '/'. $NewPostID . '.php';
    $NewCommentsDir  = $DIR_POSTS . $Language . '/'. $NewPostID . '/';

    /* File content */
    $FileContent = '<?php' . "\n" .
      '$AUTHOR  = ' . "'" . $AUTHOR  . "'" . ';'. "\n" .
      '$CLOSED  = ' . "'" . $CLOSED  . "'" . ';'. "\n" .
      '$TAGS    = ' . "'" . $TAGS    . "'" . ';'. "\n" .
      '$TITLE   = ' . "'" . $TITLE   . "'" . ';'. "\n" .
      '$SUMMARY = ' . "'" . $SUMMARY . "'" . ';'. "\n" .
      '$POST    = ' . "'" . $CONTENT . "'" . ';'. "\n" .
      '?>' . "\n";

    if (SaveFile($PostFilename, $FileContent)) {
      $action = 'saved';
    }
    else {
      $action = 'fail';
    }

    /* If timestamp was changed... change the directory too */
    if ($PostID != $NewPostID) {
      /* Has comments */
      if (is_dir($CommentsDir)) {
        if (!rename($CommentsDir, $NewCommentsDir)) {
          $rename = '&rename=bad';
        }
      }
      rename($PostFilename, $NewPostFilename);
      $PostID = $NewPostID;
    }

    /* --- Log action --- */
    session_start();
    if ($LOG_ACTION) {
      $log_msg = 'Post "' .$PostID . '" (' . $Language .
        ') was saved by ' . $_SESSION['DBL_Username'];
      AppendToLog($FILE_LOG, $log_msg);
    }
    /* --- Log action --- */

    $URI = '../../admin.php?pg=' . $_b_post_ .
      '&id='   . $PostID .
      '&lang=' . $Language;

    $URI .= '&file=' . $action . $rename;
  }
/* Delete request button pressed */
} else if (isset($_POST['bu_delete'])) {
  $TITLE = NoQuotes($_POST['title']);

  $URI = '../../admin.php?pg=' . $_b_killpost_ .
    '&id='    . $PostID .
    '&title=' . $TITLE  .
    '&lang='  . $Language;

/* Irreversible deletions pressed */
} else if (isset($_POST['bu_kill'])) {
  $PostCommentsDir = $DIR_POSTS . $Language . '/' . $PostID;
  $PostFilename    = $PostCommentsDir . '.php';

  /* Delete post */
  $action = '';
  if (@unlink($PostFilename)) {
    /* Delete comments if exist */
    if (is_dir($PostCommentsDir)) {
      if (!@rmdir_recursive($PostCommentsDir)) {
        /* Error removing comments */
        $action = '&action=cant_rm_comm';
      }
    }
  /* Error removing post */
  } else {
    $action = '&action=cant_rm_post';
  }

  /* Removed successfully */
  if ($action == '') {
    $action = '&action=kill';

    /* --- Log action --- */
    session_start();
    if ($LOG_ACTION) {
      $log_msg = 'Post "' .$PostID . '" (' . $Language .
        ') was deleted by ' . $_SESSION['DBL_Username'];
      AppendToLog($FILE_LOG, $log_msg);
    }
    /* --- Log action --- */
  }

  /* Show the action, success or fail */
  $URI = '../../admin.php?pg=' . $_b_killpost_ .
    '&lang='   . $Language .
    '&action=' . $action;
}

/* The cancel button, just does nothing, it redirects to the last URI
 * set on $URI,before the if above */


/* Redirect automatically */
header('Location: ' . $URI);

