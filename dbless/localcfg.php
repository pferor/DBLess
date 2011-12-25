<?php
/**
 * @file localcfg.php
 *
 * @brief Site main config file
 */


/* Sets the base directory */
$BASE_DIR = "";
if (isset($DIR_LEVEL)) {
  if ($DIR_LEVEL == 0) {
    $BASE_DIR = "";
  }
  else {
      for ($i = 1; $i <= $DIR_LEVEL; $i++) {
        $BASE_DIR = $BASE_DIR . "../";
      } /* for ($i... */
  } /* else; ($DIR_LEVEL != 0) */
} /* if (isset(... */
else {
  $BASE_DIR = "../"; /* default choice */
}


/* Main directory of the site */
$DIR_ROOT = $BASE_DIR;


/* Site configuration directory. This is the only directory that is
   specified here. The other site directories are defined in
   $DIR_CONFIG, wich is what is being defined here. */
$DIR_CONFIG = $BASE_DIR . "config/"; /**< Configuration dir. */


/* Include site configuration */
include_once($DIR_CONFIG . "dirs.php"); /* Site directories */

