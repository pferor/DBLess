<?php
/**
 * @file logfile_acts.php
 *
 * @brief Log file form actions
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
$URI = '../../admin.php?pg=' . $_b_front_ .
  '&lang=' . $Language;


if (isset($_POST['bu_delete'])) {
  SaveFile($FILE_LOG, '', 'w');

  session_start();
  $log_msg = 'New log file created by ' . $_SESSION['DBL_Username'];
  AppendToLog($FILE_LOG, $log_msg);
}


/* Redirect automatically */
header('Location: ' . $URI);

