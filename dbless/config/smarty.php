<?php
/**
 * @file smarty.php
 *
 * @brief Smarty main configuration (Smarty 2.6.26)
 */


/* This gets all directory variables */
require_once('localcfg.php');

/* Put full path to `Smarty.class.php' */
require($DIR_SMARTY_LIB . '/Smarty.class.php');


/* New Smarty class with custom directories for this project */
class DBL_Smarty extends Smarty
{
  function DBL_Smarty()
  {
    global $DIR_SMARTY_CONF_TEMPLATE;
    global $DIR_SMARTY_CONF_CACHE;
    global $DIR_SMARTY_CONF_CONFIG;
    global $DIR_SMARTY_CONF_COMPILE;
    //global $DIR_SMARTY_CONF_PLUGINS;


    $this->Smarty();
    $this->template_dir = $DIR_SMARTY_CONF_TEMPLATE;
    $this->config_dir   = $DIR_SMARTY_CONF_CONFIG;
    $this->cache_dir    = $DIR_SMARTY_CONF_CACHE;
    $this->compile_dir  = $DIR_SMARTY_CONF_COMPILE;
    //$this->plugins_dir  = $DIR_SMARTY_CONF_PLUGINS;

    $this->debugging      = false;
    $this->caching        = false;
    $this->cache_lifetime = 120;

    //$this->assign('app_name', 'DBLess');
  }
}

