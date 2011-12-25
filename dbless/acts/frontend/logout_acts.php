<?php
/**
 * @file logout_acts.php
 *
 * @brief Log out form actions
 */

$DIR_LEVEL = 2;
require_once('../../localcfg.php');
include($DIR_INCLUDE . 'file.php');
include($DIR_CONFIG  . 'dirs.php');
include($DIR_CONFIG  . 'pages_ids.php');
include($DIR_CONFIG  . 'site_tech.php');  /* Site technical info. */


/* Language */
if (!isset($_GET['lang']) || !file_exists($DIR_POSTS . $_GET['lang'])) {
  $Language = $SITE_DEFAULT_LANGUAGE;
} else {
  $Language = $_GET['lang'];
}


/* Default URI, just if something went wrong */
$URI = '../..?pg=' . $_f_logout_ .
  '&lang=' . $Language;

if (isset($_POST['bu_logout'])) {
  session_start();

  /* --- Log action --- */
  if ($LOG_ACTION) {
    $log_msg = $_SESSION['DBL_Username'] . ' logged out';
    AppendToLog($FILE_LOG, $log_msg);
  }
  /* --- Log action --- */

  $_SESSION['DBL_LoggedIn'] = false;
  $_SESSION['DBL_Username'] = '';

  unset($_SESSION['DBL_LoggedIn']);
  unset($_SESSION['DBL_Username']);
}


/* Redirect automatically */
header('Location: ' . $URI);

