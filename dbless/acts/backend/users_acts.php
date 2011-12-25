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
include($DIR_INCLUDE . 'file.php');       /* rmdir_recursive(... */
include($DIR_INCLUDE . 'values.php');     /* GetValueOrDefault(... */


/* Language */
if (!isset($_GET['lang']) || !file_exists($DIR_POSTS . $_GET['lang'])) {
  $Language = $SITE_DEFAULT_LANGUAGE;
} else {
  $Language = $_GET['lang'];
}


/* UserID; same as the directory name... again... this is a mess! */
if (isset($_GET['id'])) {
  $UserID = GetValueOrDefault($_GET['id'], 0);
} else {
  $UserID = GetValueOrDefault($_POST['id'], 0);
}
$bu_delete_id = 'bu_delete_' . $UserID;


/* Default URI, just if something went wrong */
$URI = '../../admin.php?pg=' . $_b_users_ .
  '&lang=' . $Language;


/* Delete button pressed */
if (isset($_POST[$bu_delete_id])) {
  /* Redirects to kill user page */
  $URI = '../../admin.php?pg=' . $_b_killuser_ .
    '&lang=' . $Language .
    '&id='   . $UserID;
/* Kill button pressed */
} else if (isset($_POST['bu_kill'])) {
  $USERNAME = $_POST['re_username'];
  $UserDir  = $DIR_USERS . $UserID;

  /* Delete user */
  $action = '';
  if (is_dir($UserDir)) {
    if (!@rmdir_recursive($UserDir)) {
      $action = '&action=cant_rm_user';
    }
  /* Error removing user */
  } else {
    $action = '&action=cant_rm_user';
  }

  /* Removed successfully */
  if ($action == '') {
    $action = '&action=kill';
  }

  /* --- Log action --- */
  session_start();
  if ($LOG_ACTION) {
    $log_msg = 'User ' .$USERNAME . ' was deleted by ' .
      $_SESSION['DBL_Username'];
    AppendToLog($FILE_LOG, $log_msg);
  }
  /* --- Log action --- */

  /* Show the action, success or fail */
  $URI = '../../admin.php?pg=' . $_b_users_ .
    '&lang='   . $Language .
    '&action=' . $action;
}

/* The cancel button, just does nothing, it redirects to the last URI
 * set on $URI, before the if above */


/* Redirect automatically */
header('Location: ' . $URI);

