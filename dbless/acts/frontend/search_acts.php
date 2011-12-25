<?php
/**
 * @file logout_acts.php
 *
 * @brief Log out form actions
 */

$DIR_LEVEL = 2;
require_once('../../localcfg.php');
include($DIR_CONFIG  . 'dirs.php');
include($DIR_CONFIG  . 'pages_ids.php');
include($DIR_CONFIG  . 'site_tech.php'); /* Site technical info. */
include($DIR_INCLUDE . 'html.php');      /* NoEntities(...) */


/* Language */
if (!isset($_GET['lang']) || !file_exists($DIR_POSTS . $_GET['lang'])) {
  $Language = $SITE_DEFAULT_LANGUAGE;
} else {
  $Language = $_GET['lang'];
}


/* Default URI, just if something went wrong */
$URI = '../..?pg=' . $_f_search_ .
  '&lang=' . $Language;


if (isset($_POST['bu_search'])) {
  /* Avoid strange things */
  $SEARCH_QUERY = $_POST['search_query'];
  $SEARCH_QUERY = NoEntities($SEARCH_QUERY);
  $SEARCH_QUERY = urlencode($SEARCH_QUERY);

  $URI .= '&q=' . $SEARCH_QUERY;
}


/* Redirect automatically */
header('Location: ' . $URI);

