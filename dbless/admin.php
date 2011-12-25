<?php
/**
 * @file index.php
 *
 * @brief Site administration
 *
 * @author  Pferor <pferor@gmail.com>
 * @version 1.0 (2010-09-12)
 *
 * @defgroup Backend
 *
 * @section license_sec License
 *  This program is free software: you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License as
 *  published by the Free Software Foundation, either version 3 of the
 *  License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 *  General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program. If not, see
 *  <a href="http://www.gnu.org/licenses/">http://www.gnu.org/licenses/</a>.
 */

session_start();

$DIR_LEVEL = 0;
require_once('localcfg.php');

/* Site functions */
require_once($DIR_INCLUDE . 'common.php');   /* Common routines */
require_once($DIR_INCLUDE . 'aart.php');     /* ASCII art functions */
require_once($DIR_INCLUDE . 'file.php');     /* File functions */
require_once($DIR_INCLUDE . 'html.php');     /* HTML manipulation routines */
require_once($DIR_INCLUDE . 'values.php');   /* Values routines */
require_once($DIR_INCLUDE . 'language.php'); /* Languages operations */
require_once($DIR_INCLUDE . 'cssskin.php');  /* Languages operations */
require_once($DIR_INCLUDE . 'posts.php');    /* Posts routines */
require_once($DIR_INCLUDE . 'users.php');    /* User management */
require_once($DIR_INCLUDE . 'array.php');    /* Posts/comments arrays */

/* Site configuration */
include($DIR_CONFIG . 'smarty.php');       /* Smarty class */
include($DIR_CONFIG . 'site_admin.php');   /* Site administators list */
include($DIR_CONFIG . 'site_tech.php');    /* Site technical info. */
include($DIR_CONFIG . 'pages_ids.php');    /* Site page ids. */
include($DIR_INFO   . 'site_license.php'); /* Site license */
include($DIR_INFO   . 'site_name.php');    /* Site name */


/* Is user logged in? */
$UserLoggedIn = GetValueOrDefault($_SESSION['DBL_LoggedIn'], false);
$Username     = GetValueOrDefault($_SESSION['DBL_Username'], false);


/* Set the Administrator usernames in `config/ !'
 */
if (!$UserLoggedIn || !isAdmin($Username, $SITE_ADMINS_ARR)) {
  /* TWO OPTIONS FOR KEEP AWAY NON ADMINISTRATORS WHO TRY TO ENTER THE
   * ADMINISTRATION PAGE */

  /* 1. Redirect to `index.php' if don't have enough credentials */
  header('Location: index.php');

  /* 2. Or you can fake a 404 page */
/*
  $fake_webmaster = 'webmaster@site.com';
  $site_domain    = 'www.yoursite.com';

  die('<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Object not found!</title>
<link rev="made" href="mailto:you@example.com" />
<style type="text/css">
    body { color: #000000; background-color: #FFFFFF; }
    a:link { color: #0000CC; }
    p, address {margin-left: 3em;}
    span {font-size: smaller;}
</style>
</head>
<body>
<h1>Object not found!</h1>
<p>
    The requested URL was not found on this server.
    If you entered the URL manually please check your
    spelling and try again.
</p>
<p>
If you think this is a server error, please contact
the <a href="mailto:' . $fake_webmaster . '">webmaster</a>.
</p>
<h2>Error 404</h2>
<address>
  <a href="http://' . $site_domain . '">' . $site_domain . '</a><br />
  <span>Mon 13 Sep 2010 08:30:12 PM CEST<br />
  Apache/2.2.12 (Unix) DAV/2 mod_ssl/2.2.12 OpenSSL/0.9.8k PHP/5.3.0 mod_apreq2-20051231/2.6.0 mod_perl/2.0.4 Perl/v5.10.0</span>
</address>
</body>
</html>');
*/
} else {
  /* At this point, the user is logged in and is an administrator */
  $UserInfoFile   = $DIR_USERS . sha1($Username) . '/' .
    GetValueOrDefault($FILE_USER_INFO,   '_nulldir_');
  $UserConfigFile = $DIR_USERS . sha1($Username) . '/' .
    GetValueOrDefault($FILE_USER_CONFIG, '_nulldir_');

  if (file_exists($UserInfoFile)) {
    include($UserInfoFile);
  }
  if (file_exists($UserConfigFile)) {
    include($UserConfigFile);
  }

  /* Check if corrupt file - If file is corrupt, session will end on
   * the next link click */
  if (sha1($Username) != sha1($_USER_NAME)) {
    $_SESSION['DBL_Username'] = NULL;
    $_SESSION['DBL_LoggedIn'] = NULL;
    unset($_SESSION['DBL_Username']);
    unset($_SESSION['DBL_LoggedIn']);
  }

  $UserEmail = GetValueOrDefault($_USER_EMAIL, '');



  /* Language
   *
   * Procedure is simple. Uses specified langauge:
   *
   *  1. first looks at the URI if there is some 'lang=en' or so,
   *
   *  2. if not, looks the user language in his/her file on the var
   *     $_USER_LANG. If there is no user online, then this step does
   *     nothing,
   *
   * 3. and finally, if the above options are not functional, the
   *    language used is the default one ($SITE_DEFAULT_LANGUAGE)
   *    declared in `conf/site_tech.php'.
   */
  if (isset($_GET['lang']) &&
      file_exists($DIR_LANGS . $_GET['lang'] . '.php') &&
      file_exists($DIR_POSTS . $_GET['lang'])) {
    $Language = $_GET['lang'];
  }
  else if (isset($_USER_LANG) &&
           file_exists($DIR_LANGS . $_USER_LANG . '.php') &&
           file_exists($DIR_POSTS . $_USER_LANG)) {
    $Language = $_USER_LANG;
  }
  else {
    $Language = $SITE_DEFAULT_LANGUAGE;
  }

  $Language_File     = $Language . '.php';
  $Language_FullPath = $DIR_LANGS_BACKEND . $Language_File;
  include($Language_FullPath);


  /* What happens when the default language file does not exist? */
  if (!file_exists($Language_FullPath)) {
    $NoDefaultLanguage_ErrorMessage = 'Error. Default language file "' .
      $Language_FullPath . '" was not found. Please add it or change ' .
      'the default language file in "' . $DIR_CONFIG . 'site_tech.php' .
      '". ' . 'This site cannot be displayed without a language file.';

    /* and then... dies */
    die($NoDefaultLanguage_ErrorMessage);
  }


  /* CSS
   *
   * Very similar to languages
   *
   *  1. first looks at the URI if there is some 'theme=default' or
   *     so,
   *
   *  2. if not, looks the user language in his/her file on the bar
   *     _USER_CSSSKIN. If there is no userr online, then this step
   *     does nothing,
   *
   * 3. and finally, if the above options are not functional, the
   *    style used is the default one ($SITE_DEFAULT_CSS_SKIN) defined
   *    in `conf/site_tech.php'.
   */
  if (isset($_GET['style']) &&
      file_exists($DIR_CSS_BACKEND . $_GET['style'] . '.css')) {
    $CSS_Style = $_GET['style'];
  }
  else if (isset($_USER_CSSSKIN) &&
           file_exists($DIR_CSS_BACKEND . $_USER_CSSSKIN . '.css')) {
    $CSS_Style = $_USER_CSSSKIN;
  }
  else {
    $CSS_Style = $SITE_DEFAULT_CSS_SKIN;
  }

  $CSS_Skin_File     = $CSS_Style . '.css';
  $CSS_Skin_FullPath = $DIR_CSS_BACKEND . $CSS_Skin_File;

  /* If there is no CSS the site will not be displayed properly, but
   * enought. A site without the style still gives content, and that
   * is the important goal of this site. I tried to make this site as
   * simple as I could, mantaining the structure I like and taking in
   * consideration that it has to be displayer as well without the
   * CSS.
   *
   * So, there is no fatal error if the stylesheet isn't found.
   */


  /* Get current page name, or use $_front_ as default page */
  $CurrentPageName = GetValueOrDefault($_GET['pg'], $_b_front_);

  /* Smarty template engine... here comes! */
  $smarty = new DBL_Smarty();

  /* Add language strings */
  include($DIR_LANGS_BACKEND . 'smarty_lang.php');

  /* First is first */
  $smarty->assign('UserLoggedIn', $UserLoggedIn);
  $smarty->assign('Username',     $Username);
  $smarty->assign('UserEmail',    $UserEmail);

  /* Site info. */
  $smarty->assign('SiteShortName', html2text($SITE_SHORT_NAME));
  $smarty->assign('SiteLongName',  html2text(GetValueOrDefault($SITE_LONG_NAME, '')));
  $smarty->assign('SiteMainTip',   NoEntities(GetValueOrDefault($SITE_MAIN_TIP, '')));

  /* Site license */
  $smarty->assign('SiteLicenseText',  html2text(GetValueOrDefault($SITE_LICENSE_TEXT,  '')));
  $smarty->assign('SiteLicenseTitle', html2text(GetValueOrDefault($SITE_LICENSE_TITLE, '')));
  $smarty->assign('SiteLicenseURI',   html2text(GetValueOrDefault($SITE_LICENSE_URI,   '')));

  /* Site technical details */
  $smarty->assign('Language',      $Language);
  $smarty->assign('Style',         $CSS_Style);
  $smarty->assign('Charset',       $LangCharset);
  $smarty->assign('TextDirection', $LangTextDir);
  $smarty->assign('CSSSkin',       $CSS_Skin_FullPath);
//$smarty->assign('FavIcon',       $DIR_IMAGES . 'favicon.ico');
  $smarty->assign('FavIcon',       $DIR_ROOT. 'favicon.ico');

  /* Forms actions files */
  $smarty->assign('CommentsActs', $DIR_ACTS_BACKEND . 'comments_acts.php');
  $smarty->assign('LogFileActs',  $DIR_ACTS_BACKEND . 'logfile_acts.php');
  $smarty->assign('LogoutActs',   $DIR_ACTS_BACKEND . 'logout_acts.php');
  $smarty->assign('PostsActs',    $DIR_ACTS_BACKEND . 'posts_acts.php');
  $smarty->assign('SiteActs',     $DIR_ACTS_BACKEND . 'site_acts.php');
  $smarty->assign('UsersActs',    $DIR_ACTS_BACKEND . 'users_acts.php');

  /* Pages variables */
  $smarty->assign('_front_',         $_b_front_);
  $smarty->assign('_comments_',      $_b_comments_);
  $smarty->assign('_killcomment_',   $_b_killcomment_);
  $smarty->assign('_killpost_',      $_b_killpost_);
  $smarty->assign('_killuser_',      $_b_killuser_);
  $smarty->assign('_logout_',        $_b_logout_);
  $smarty->assign('_post_',          $_b_post_);
  $smarty->assign('_posts_',         $_b_posts_);
  $smarty->assign('_users_',         $_b_users_);
  $smarty->assign('_siteinfo_',      $_b_siteinfo_);

  /* The frontpage "is" when is not any other page */
  $isFrontPage = ($CurrentPageName == $_b_front_ || $CurrentPageName == '') ||
    $CurrentPageName != $_b_posts_       && $CurrentPageName != $_b_post_     &&
    $CurrentPageName != $_b_users_       && $CurrentPageName != $_b_comments_ &&
    $CurrentPageName != $_b_siteinfo_    && $CurrentPageName != $_b_logout_   &&
    $CurrentPageName != $_b_killpost_    && $CurrentPageName != $_b_killuser_ &&
    $CurrentPageName != $_b_killcomment_;

  /* Correct $CurrentPageName if neccesarry */
  if ($isFrontPage) {
    $CurrentPageName = $_b_front_;
  }
  $smarty->assign('CurrentPageName', $CurrentPageName);


  /* ~~~ FRONT PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
  if ($CurrentPageName == $_b_front_) {
    $smarty->assign ('LogFileName', $FILE_LOG);
    $smarty->assign ('LogFileSize', SizeReadable(sprintf("%u",
							 filesize($FILE_LOG))));
    $smarty->assign ('LogFileText', ShowFileContent($FILE_LOG));
  }
  /* ~~~ End of FRONT PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


  /* ~~~ POSTS PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
  if ($CurrentPageName == $_b_posts_) {
    /* Get posts */
    $PostsResults = ArrayPosts($DIR_POSTS . $Language,
                               $MAX_POSTS_CHARS_IN_SUMMARY_REPLACEMENT,
                               0, 0, true, true);

    $smarty->assign('PostsResults',  $PostsResults);
    unset($PostResults);
  }
  /* ~~~ End of POSTS PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


  /* ~~~ POST PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
  if ($CurrentPageName == $_b_post_) {
    $PostResults = array();

    if (file_exists($DIR_POSTS . $Language)) {

      /* Get post */
      /* If not valid post, then id = 0 */
      $PostID = GetValueOrDefault($_GET['id'], 0);

      /* The confirmation of valid post is made also in `post_acts.php' */
      if (!isValidPostFile($PostID, true)) {
        $PostID = 0;
      }

      if (isValidPostFile($PostID, true)) {
        unset($TAGS, $CLOSED, $AUTHOR, $TITLE, $SUMMARY, $POST);

        $PostFile = $DIR_POSTS . $Language . '/' . $PostID . '.php';
        if (file_exists($PostFile)) {
          include($PostFile);
        }

        /* The POST *must* contain at least one character */
        if (isset($POST) && $POST != '') {
          $PostResults =
            array(
                  /* Preventing the insertion HTML code */
                  'id'        => $PostID,
                  'TimeStamp' => FormatPostDateTime($PostID),
                  'Closed'    => NoEntities(GetValueOrDefault($CLOSED,  0)),
                  'Tags'      => NoEntities(GetValueOrDefault($TAGS,    '')),
                  'Author'    => NoEntities(GetValueOrDefault($AUTHOR,  '')),
                  'Title'     => NoEntities(GetValueOrDefault($TITLE,   '')),
                  'Summary'   => NoEntities(GetValueOrDefault($SUMMARY, '')),
                  'Post'      => NoEntities($POST)
                  );
        }
      }
      else {
        $PostID = 0;
      }

      $smarty->assign('PostID',        $PostID);
      $smarty->assign('PostResults',   $PostResults);
      $smarty->assign('TimestampNow',  FormatDateTime(getdate()));
      unset($PostResults);

      $smarty->assign('FIELDTitle',     GetValueOrDefault($_GET['ttitle'],     ''));
      $smarty->assign('FIELDSummary',   GetValueOrDefault($_GET['tsummary'],   ''));
      $smarty->assign('FIELDAuthor',    GetValueOrDefault($_GET['tauthor'],    ''));
      $smarty->assign('FIELDPost',      GetValueOrDefault($_GET['tpost'],      ''));
      $smarty->assign('FIELDTags',      GetValueOrDefault($_GET['ttags'],      ''));
      $smarty->assign('FIELDTimestamp', GetValueOrDefault($_GET['ttimestamp'], ''));
      $smarty->assign('FIELDClosed',    GetValueOrDefault($_GET['tclosed'],    -1));

      $smarty->assign('FORMFile',       GetValueOrDefault($_GET["file"]),      '');
      $smarty->assign('FORMRename',     GetValueOrDefault($_GET["rename"]),    '');

      $smarty->assign('POSTTitle',      GetValueOrDefault($_GET["title"]),     '');
      $smarty->assign('POSTPost' ,      GetValueOrDefault($_GET["post"]),      '');
      $smarty->assign('POSTAuthor',     GetValueOrDefault($_GET["author"]),    '');
      $smarty->assign('POSTTimestamp',  GetValueOrDefault($_GET["timestamp"]), '');
    }

    $smarty->assign('PostDelimiter', NoEntities($POST_DELIMITER_STRING));
  }
  /* ~~~ End of POST PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

  /* ~~~ KILL POST PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
  if ($CurrentPageName == $_b_killpost_) {
    $PostID   = GetValueOrDefault($_GET['id'], 0);
    $PostFile = $DIR_POSTS . $Language . '/' . $PostID . '.php';

    /* The confirmation of valid post is made also in `post_acts.php' */
    if (!isValidPostFile($PostID, true) || !file_exists($PostFile)) {
      $PostID = 0;
    }

    $smarty->assign('PostID',        $PostID);
    $smarty->assign('PostTimestamp', FormatPostDateTime($PostID));
    $smarty->assign('PostTitle',     urldecode(GetValueOrDefault($_GET["title"], '')));

    $smarty->assign('FORMAction',    GetValueOrDefault($_GET['action']), '');
  }
  /* ~~~ End of KILL POST PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


  /* ~~~ COMMENTS PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
  if ($CurrentPageName == $_b_comments_) {
    if ($COMMENTS_MODERATION) {
      $smarty->assign('ModerationOff', false);

      /* Get unmoderated comments */
      $UnmoderatedCommentsResults = ArrayAllUnmoderatedComments($DIR_POSTS . $Language);
      $smarty->assign('UnmoderatedCommentsResults', $UnmoderatedCommentsResults);
      unset($UnmoderatedCommentsResults);
    } else {
      $smarty->assign('ModerationOff', true);
    }

    $smarty->assign('FORMAction', GetValueOrDefault($_GET['action']));
  }
  /* ~~~ End of COMMENTS PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


  /* ~~~ REJECT UNMODERATED COMMENT ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
  if ($CurrentPageName == $_b_killcomment_) {
    $CommentID   = GetValueOrDefault($_GET['id'],     0);
    $PostID      = GetValueOrDefault($_GET['postid'], 0);

    $CommentText = GetValueOrDefault($_GET['comment'], '?');

    $smarty->assign('CommentText', $CommentText);
    $smarty->assign('CommentID',   $CommentID);
    $smarty->assign('PostID',      $PostID);

    $smarty->assign('FORMAction', GetValueOrDefault($_GET['action']), '');
  }
  /* ~~~ End of REJECT UNMODERATED COMMENT ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


  /* ~~~ USERS PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
  if ($CurrentPageName == $_b_users_) {
    /* Get users */
    $UsersResults = ArrayUsers($DIR_USERS,
                               $FILE_USER_INFO,
                               false,
                               $SITE_ADMINS_ARR);

    $smarty->assign('UsersResults', $UsersResults);
    unset($UsersResults);

    $smarty->assign('FORMAction', GetValueOrDefault($_GET['action']), '');
  }
  /* ~~~ End of USERS PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


  /* ~~~ KILL USER PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
  if ($CurrentPageName == $_b_killuser_) {
    $UserID   = GetValueOrDefault($_GET['id'], '0'); /* Take in
                                                      * consideration
                                                      * that the user
                                                      * id. is treated
                                                      * as a string,
                                                      * so the default
                                                      * value is '0'
                                                      * (string) and
                                                      * not 0 (int) */
    $UserFile = $DIR_USERS . $UserID;

    /* Check for a valid user id. */
    if (!is_dir($UserFile)) {
      $UserID = '0';
    } else {
      /* Retrieve user name */
      include($UserFile . '/' .$FILE_USER_INFO);
    }
    $UserToKill = GetValueOrDefault($_USER_NAME, '');

    $smarty->assign('UserID',     $UserID);
    $smarty->assign('UserToKill', $UserToKill);

    /* Just for avoiding improbable errors, restore the $_USER_NAME
     * original value. */
    $_USER_NAME = $Username;

    $smarty->assign('FORMAction', GetValueOrDefault($_GET['action']), '');
  }
  /* ~~~ End of KILL USER PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


  /* ~~~ SITE INFO PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
  if ($CurrentPageName == $_b_siteinfo_) {
    $smarty->assign('POSTSiteName', GetValueOrDefault($_GET["sitename"]), '');

    $smarty->assign('FORMAction',   GetValueOrDefault($_GET['action']),   '');
  }
  /* ~~~ End of SITE INFO PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


  /* Smarty display */
  $smarty->assign('DirBackend', $DIR_GENERIC_BACKEND);
  $smarty->display($DIR_GENERIC_BACKEND . 'main.tpl');
}

?>

