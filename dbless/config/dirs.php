<?php
/**
 * @file dirs.php
 *
 * @brief Site filesystem configuration
 */


/* Directories other than config */
$DIR_INCLUDE = $BASE_DIR . 'include/';   /**< Include PHP code dir. */
$DIR_LIB     = $BASE_DIR . 'lib/';       /**< Libraries dir. */
$DIR_FEED    = $BASE_DIR . 'rss/';       /**< RSS synd .  dir. */
$DIR_IMAGES  = $BASE_DIR . 'images/';    /**< Images dir. */
$DIR_POSTS   = $BASE_DIR . 'posts/';     /**< Posts dir. */
$DIR_USERS   = $BASE_DIR . 'users/';     /**< Users dir. */
$DIR_ACTS    = $BASE_DIR . 'acts/';      /**< Form actions dir. */
$DIR_INFO    = $BASE_DIR . 'info/';      /**< Site info dir. */
$DIR_CSS     = $BASE_DIR . 'css/';       /**< CSS themes dir. */
$DIR_LANGS   = $BASE_DIR . 'langs/';     /**< Languages dir. */


/* The log file, if $LOG_ACTIONS is 'true' every action will be logged
 * to this file. Is Alse the front page of the backend.
 * See `site_tech.php' file.
 */
$FILE_LOG = $DIR_INFO . 'log.txt';


/* Smarty [ http://www.smarty.net/ ] */
$DIR_SMARTY_DIRS = 'smarty/';            /**< Smarty templates dir. */
$DIR_SMARTY_LIB  = $DIR_LIB . 'smarty/'; /**< Smarty library dir. */

/* Smarty subdirectories */
$DIR_SMARTY_CONF_CACHE    = $DIR_SMARTY_DIRS . 'cache/';
$DIR_SMARTY_CONF_COMPILE  = $DIR_SMARTY_DIRS . 'compile/';
$DIR_SMARTY_CONF_CONFIG   = $DIR_SMARTY_DIRS . 'config/';
$DIR_SMARTY_CONF_TEMPLATE = $DIR_SMARTY_DIRS . 'templates/';


/* Frontend/backend division */
$DIR_GENERIC_FRONTEND          = 'frontend/';
$DIR_GENERIC_BACKEND           = 'backend/';
$DIR_LANGS_FRONTEND            = $DIR_LANGS . $DIR_GENERIC_FRONTEND;
$DIR_LANGS_BACKEND             = $DIR_LANGS . $DIR_GENERIC_BACKEND;
$DIR_CSS_FRONTEND              = $DIR_CSS   . $DIR_GENERIC_FRONTEND;
$DIR_CSS_BACKEND               = $DIR_CSS   . $DIR_GENERIC_BACKEND;
$DIR_ACTS_FRONTEND             = $DIR_ACTS  . $DIR_GENERIC_FRONTEND;
$DIR_ACTS_BACKEND              = $DIR_ACTS  . $DIR_GENERIC_BACKEND;
$DIR_SMARTY_TEMPLATES_FRONTEND = $DIR_SMARTY_CONF_TEMPLATE .
                                 $DIR_GENERIC_FRONTEND;
$DIR_SMARTY_TEMPLATES_BACKEND  = $DIR_SMARTY_CONF_TEMPLATE .
                                 $DIR_GENERIC_BACKEND;

/* User related files */
$FILE_USER_INFO   = 'info.php';   /*+< Username, email,...  */
$FILE_USER_CONFIG = 'config.php'; /**< Language, skin,... */

