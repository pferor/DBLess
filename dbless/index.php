<?php
/**
 * @file index.php
 *
 * @brief Site main index
 *
 * @author  Pferor <pferor@gmail.com>
 * @version 1.0 (2010-09-12)
 *
 * @defgroup Frontend
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
require_once($DIR_INCLUDE . 'html.php');     /* HTML manipulation routines */
require_once($DIR_INCLUDE . 'values.php');   /* Values routines */
require_once($DIR_INCLUDE . 'language.php'); /* Languages operations */
require_once($DIR_INCLUDE . 'cssskin.php');  /* Languages operations */
require_once($DIR_INCLUDE . 'posts.php');    /* Posts routines */
require_once($DIR_INCLUDE . 'users.php');    /* Users routines */
require_once($DIR_INCLUDE . 'array.php');    /* Posts/comments arrays */

/* Site configuration */
include($DIR_CONFIG . 'smarty.php');        /* Smarty class */
include($DIR_CONFIG . 'pages_ids.php');     /* Site page ids. */
include($DIR_CONFIG . 'site_admin.php');    /* Site administators info. */
include($DIR_CONFIG . 'site_tech.php');     /* Site technical info. */
include($DIR_INFO   . 'site_name.php');     /* Site name */
include($DIR_INFO   . 'site_license.php');  /* Site license */


/* Is user logged in? */
$UserLoggedIn = GetValueOrDefault($_SESSION['DBL_LoggedIn'], false);
$Username     = GetValueOrDefault($_SESSION['DBL_Username'], false);

if ($UserLoggedIn) {
  $UserInfoFile   = $DIR_USERS . sha1(strtolower($Username)) . '/' .
    GetValueOrDefault($FILE_USER_INFO,   '_nulldir_');
  $UserConfigFile = $DIR_USERS . sha1(strtolower($Username)) . '/' .
    GetValueOrDefault($FILE_USER_CONFIG, '_nulldir_');

  if (file_exists($UserInfoFile)) {
    include($UserInfoFile);
  }
  if (file_exists($UserConfigFile)) {
    include($UserConfigFile);
  }

  /* Check if corrupt file - If file is corrupt, session will end on
   * the next link click! */
  if (strtolower($Username) != strtolower($_USER_NAME)) {
    $_SESSION['DBL_Username'] = NULL;
    $_SESSION['DBL_LoggedIn'] = NULL;
    unset($_SESSION['DBL_Username']);
    unset($_SESSION['DBL_LoggedIn']);
  }
}
$UserEmail   = GetValueOrDefault($_USER_EMAIL, '');
$UserIsAdmin = isAdmin($Username, $SITE_ADMINS_ARR);


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
    file_exists($DIR_LANGS_FRONTEND . $_GET['lang'] . '.php') &&
    file_exists($DIR_POSTS . $_GET['lang'])) {
  $Language = $_GET['lang'];
}
else if (isset($_USER_LANG) &&
         file_exists($DIR_LANGS_FRONTEND . $_USER_LANG . '.php') &&
         file_exists($DIR_POSTS . $_USER_LANG)) {
  $Language = $_USER_LANG;
}
else {
  $Language = $SITE_DEFAULT_LANGUAGE;
}

$Language_File     = $Language . '.php';
$Language_FullPath = $DIR_LANGS_FRONTEND.$Language_File;
include($Language_FullPath);


/* What happens when the default language file does not exist? */
if (!file_exists($Language_FullPath)) {
  $NoDefaultLanguage_ErrorMessage = 'Error. Default language file "' .
    $Language_FullPath . '" was not found. Please add it or change ' .
    'the default language file in "' . $DIR_CONFIG . 'site_tech.php'.
    '". ' . 'This site cannot be displayed without a language file.';

  /* and then... dies */
  die($NoDefaultLanguage_ErrorMessage);
}


/* CSS
 *
 * Very similar to languages
 *
 *  1. first looks at the URI if there is some 'theme=default' or so,
 *
 *  2. if not, looks the user language in his/her file on the bar
 *     _USER_CSSSKIN. If there is no userr online, then this step does
 *     nothing,
 *
 * 3. and finally, if the above options are not functional, the style
 *    used is the default one ($SITE_DEFAULT_CSS_SKIN) defined in
 *    `conf/site_tech.php'.
 */
if (isset($_GET['style']) &&
    file_exists($DIR_CSS_FRONTEND . $_GET['style'] . '.css')) {
  $CSS_Style = $_GET['style'];
}
else if (isset($_USER_CSSSKIN) &&
         file_exists($DIR_CSS_FRONTEND . $_USER_CSSSKIN . '.css')) {
  $CSS_Style = $_USER_CSSSKIN;
}
else {
  $CSS_Style = $SITE_DEFAULT_CSS_SKIN;
}

$CSS_Skin_File     = $CSS_Style . '.css';
$CSS_Skin_FullPath = $DIR_CSS_FRONTEND . $CSS_Skin_File;

/* If there is no CSS the site will not be displayed properly, but
 * enought. A site without the style still gives content, and that is
 * the important goal of this site. I tried to make this site as
 * simple as I could, mantaining the structure I like and taking in
 * consideration that it has to be displayer as well without the CSS.
 *
 * So, there is no fatal error if the stylesheet isn't found.
 */


/* Get current page name, or use $_f_front_ as default page */
$CurrentPageName = GetValueOrDefault($_GET['pg'], $_f_front_);

/* Smarty template engine... here comes! */
$smarty = new DBL_Smarty();

/* Add language strings */
include($DIR_LANGS_FRONTEND . 'smarty_lang.php');

/* First is first */
$smarty->assign('UserLoggedIn', $UserLoggedIn);
$smarty->assign('UserIsAdmin',  $UserIsAdmin);
$smarty->assign('Username',     $Username);
$smarty->assign('UserEmail',    $UserEmail);

/* Site info. */
$smarty->assign('SiteShortName', html2text($SITE_SHORT_NAME));
$smarty->assign('SiteLongName',  html2text(GetValueOrDefault($SITE_LONG_NAME, '')));
$smarty->assign('SiteMainTip',   GetValueOrDefault($SITE_MAIN_TIP, ''));

/* Site license */
$smarty->assign('SiteLicenseText',  html2text(GetValueOrDefault($SITE_LICENSE_TEXT,  '')));
$smarty->assign('SiteLicenseTitle', html2text(GetValueOrDefault($SITE_LICENSE_TITLE, '')));
$smarty->assign('SiteLicenseURI',   GetValueOrDefault($SITE_LICENSE_URI,   ''));

/* Site technical details */
$smarty->assign('Language',      $Language);
$smarty->assign('Style',         $CSS_Style);
$smarty->assign('Charset',       $LangCharset);
$smarty->assign('TextDirection', $LangTextDir);
$smarty->assign('CSSSkin',       $CSS_Skin_FullPath);
$smarty->assign('CSSName',       $CSS_Style);
$smarty->assign('RSSFeed',       $DIR_FEED   . 'rss_feed.php');
//$smarty->assign('FavIcon',       $DIR_IMAGES . 'favicon.ico');
$smarty->assign('FavIcon',       $DIR_ROOT . 'favicon.ico');

/* RSS feed */
$smarty->assign('RSSFeedFile', $DIR_FEED . 'rss_feed.php');

/* Forms actions files */
$smarty->assign('CommentActs', $DIR_ACTS_FRONTEND . 'comment_acts.php');
$smarty->assign('ContactActs', $DIR_ACTS_FRONTEND . 'contact_acts.php');
$smarty->assign('JoinActs',    $DIR_ACTS_FRONTEND . 'join_acts.php');
$smarty->assign('LoginActs',   $DIR_ACTS_FRONTEND . 'login_acts.php');
$smarty->assign('LogoutActs',  $DIR_ACTS_FRONTEND . 'logout_acts.php');
$smarty->assign('ProfileActs', $DIR_ACTS_FRONTEND . 'profile_acts.php');
$smarty->assign('SearchActs',  $DIR_ACTS_FRONTEND . 'search_acts.php');

/* Languages */
/* TODO - do not show language bar if there are no language directory
 * on posts.
 *
 * Despite the langauges list is formed with the language files in
 * $DIR_LANGS, the effective languages are counted based on the
 * language folders in $DIR_POSTS. If there are just one language
 * directory in $DIR_POSTS, the language bar will be invisible.
 */
$ListLangs = ListEffectiveLangs($DIR_LANGS_FRONTEND, $DIR_POSTS);

$smarty->assign('ListLangs',  $ListLangs);
$smarty->assign('CountLangs', count($ListLangs));


/* Pages variables */
$smarty->assign('_about_',         $_f_about_);
$smarty->assign('_archive_',       $_f_archive_);
$smarty->assign('_contact_',       $_f_contact_);
$smarty->assign('_front_',         $_f_front_);
$smarty->assign('_join_',          $_f_join_);
$smarty->assign('_login_',         $_f_login_);
$smarty->assign('_logout_',        $_f_logout_);
$smarty->assign('_post_',          $_f_post_);
$smarty->assign('_profile_',       $_f_profile_);
$smarty->assign('_search_',        $_f_search_);
$smarty->assign('_tags_',          $_f_tags_);

/* The frontpage "is" when is not any other page */
$isFrontPage = ($CurrentPageName == $_f_front_ || $CurrentPageName == '') ||
  $CurrentPageName != $_f_about_   && $CurrentPageName != $_f_archive_ &&
  $CurrentPageName != $_f_contact_ && $CurrentPageName != $_f_join_    &&
  $CurrentPageName != $_f_login_   && $CurrentPageName != $_f_logout_  &&
  $CurrentPageName != $_f_post_    && $CurrentPageName != $_f_profile_ &&
  $CurrentPageName != $_f_search_  && $CurrentPageName != $_f_tags_;

/* Correct $CurrentPageName if neccesarry */
if ($isFrontPage) {
  $CurrentPageName = $_f_front_;
}
$smarty->assign('CurrentPageName', $CurrentPageName);


/* This is needed in every page since the search form is in all
 * pages */
$SearchQuery = trim(urldecode(GetValueOrDefault($_GET['q'], '')));
$smarty->assign('SearchQuery', $SearchQuery);


/* Actions depeneding of the page */
/* ~~~ FRONT PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
if ($isFrontPage) {
    /* Get posts */
  if (file_exists($DIR_POSTS . $Language)) {
    /* Note that GetPostFiles will ignore posts with a
     * date superior that today's */
    /* WHERE IS IT */
  
    /* Pager boundaries */
    $Start = GetValueOrDefault($_GET['start'], 0); /* Pager start */
    /* Avoiding offset in the posts array. The $Start value *must*
     * be in this way... or 0 */
    if (($Start % $MAX_POSTS_IN_FRONT_PAGE) != 0) {
      $Start = 0;
    }
    $End = $Start + $MAX_POSTS_IN_FRONT_PAGE;

    /* Get posts information */
    $PostsResults = ArrayPosts($DIR_POSTS . $Language,
                               $POST_DELIMITER_STRING,
                               $Start, $End,
                               $POSTS_PREVIEW_IN_PLAIN_TEXT);
    $PostsCount = count(ArrayPosts($DIR_POSTS . $Language,
                                   $POST_DELIMITER_STRING));
    /* Useful vars. needed in Smarty template */
    $smarty->assign('MaxPostsInFrontPage', $MAX_POSTS_IN_FRONT_PAGE);
    $smarty->assign('PostsCount',          $PostsCount);
    $smarty->assign('PagerStart',          $Start);
    $smarty->assign('PagerEnd',            $End);
  }

  $smarty->assign('PostsResults', $PostsResults);
  unset($PostResults);
}
/* ~~~ End of FRONT PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


/* ~~~ ARCHIVE PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
if ($CurrentPageName == $_f_archive_) {
  /* Get posts */
  $PostsResults = ArrayPosts($DIR_POSTS . $Language,
                             $MAX_POSTS_CHARS_IN_SUMMARY_REPLACEMENT);

  $smarty->assign('PostsResults',  $PostsResults);
  unset($PostResults);
}
/* ~~~ End of ARCHIVE PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


/* ~~~ POST PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
if ($CurrentPageName == $_f_post_) {
  if (file_exists($DIR_POSTS . $Language)) {
    /* Get post */
    $PostID = GetValueOrDefault($_GET['id']);
    $PostFile = $DIR_POSTS . $Language . '/' . $PostID . '.php';

    /* TODO; future post is not checked, always is valid
     *   [ && isValidate(FormatDate($PostID), <$future_is_valid>) ] */
    /* Check if file exists */
    if (!file_exists($PostFile)) {
      $posts    = GetPostFiles($DIR_POSTS . $Language);
      $PostFile = $DIR_POSTS . $Language . '/' . $posts[0];
      $PostID   = substr($posts[0], 0, -4);
    }

    unset($TAGS, $CLOSED, $AUTHOR, $TITLE, $SUMMARY, $POST);
    include($PostFile);

    /* The POST *must* contain at least one character */
    if (isset($POST) && $POST != '') {
      $PostResults = array(
                           /* Preventing the insertion HTML code */
                           'id'        => $PostID,
                           'TimeStamp' => FormatPostDateTime($PostID),
                           'Closed'    => GetValueOrDefault($CLOSED, false),
                           'Tags'      => TagsFromString(GetValueOrDefault($TAGS,
                                                                           NULL)),
                           'Author'    => GetValueOrDefault($AUTHOR,  ''),
                           'Title'     => GetValueOrDefault($TITLE,   ''),
                           'Summary'   => GetValueOrDefault($SUMMARY, ''),
                           'Post'      => $POST
                           );
    }
    else {
      $PostResults = array();
    }

    $smarty->assign('PostResults',  $PostResults);
    unset($PostResults);

    /* Comments */
    $smarty->assign('CommentsModeration', $COMMENTS_MODERATION);
    $CommentsResults = ArrayComments($DIR_POSTS . $Language,
                                     $PostID,
                                     $COMMENTS_MODERATION);
    $CommentsCount   = count($CommentsResults);
    $smarty->assign('CommentsResults', $CommentsResults);
    $smarty->assign('CommentsCount',   $CommentsCount);
    unset($CommentsResults);

    /* Smarty needed vars. for comments */
    $smarty->assign('AnonymousCanComment', $ANONYMOUS_CAN_COMMENT);

    $smarty->assign('FIELDComment', urldecode(GetValueOrDefault($_GET['tcomment'], '')));

    $smarty->assign('POSTUsername', GetValueOrDefault($_GET['username'],  ''));
    $smarty->assign('POSTComment',  GetValueOrDefault($_GET['comment'],   ''));
    $smarty->assign('POSTCaptcha',  GetValueOrDefault($_GET['captcha'],   ''));
  }

}
/* ~~~ End of POST PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


/* ~~~ LOGIN PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
if ($CurrentPageName == $_f_login_) {
  $smarty->assign('FIELDUsername', urldecode(GetValueOrDefault($_GET['tusername'], '')));

  $smarty->assign('POSTUsername',  GetValueOrDefault($_GET['username'],  ''));
  $smarty->assign('POSTPassword',  GetValueOrDefault($_GET['password'],  ''));
  $smarty->assign('POSTLogin',     GetValueOrDefault($_GET['login'],     ''));
  $smarty->assign('POSTCaptcha',   GetValueOrDefault($_GET['captcha'],   ''));

  $smarty->assign('FORMEmail',     GetValueOrDefault($_GET['email'],     ''));
  $smarty->assign('FORMMail',      GetValueOrDefault($_GET['mail'],      ''));

  $smarty->assign('FORMJoin',      GetValueOrDefault($_GET['join'],    ''));
}
/* ~~~ End of LOGIN PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


/* ~~~ CAPTCHA PAGES ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
if ($CurrentPageName == $_f_contact_ ||
    $CurrentPageName == $_f_join_    ||
    $CurrentPageName == $_f_post_    ||
    $CurrentPageName == $_f_login_) {
  $Captcha = GeneratePassword(5);
  $smarty->assign('CaptchaString', $Captcha);
  $smarty->assign('CaptchaAart',
                  aart($Captcha, '$DIR_INCLUDE/aafonts/fnt_standard.php'));
  $_SESSION['DBL_Captcha'] = $Captcha;
}


/* ~~~ CONTACT PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
if ($CurrentPageName == $_f_contact_) {
  $smarty->assign('FIELDUsername', urldecode(GetValueOrDefault($_GET['tusername'], '')));
  $smarty->assign('FIELDEmail',    urldecode(GetValueOrDefault($_GET['temail'],    '')));
  $smarty->assign('FIELDMessage',  urldecode(GetValueOrDefault($_GET['tmsg'],      '')));

  $smarty->assign('POSTUsername',  GetValueOrDefault($_GET['username'],  ''));
  $smarty->assign('POSTEmail',     GetValueOrDefault($_GET['email'],     ''));
  $smarty->assign('POSTMessage',   GetValueOrDefault($_GET['msg'],       ''));
  $smarty->assign('POSTCaptcha',   GetValueOrDefault($_GET['captcha'],   ''));

  $smarty->assign('FORMMail',      GetValueOrDefault($_GET['mail'],      ''));
}
/* ~~~ End of CONTACT PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


/* ~~~ JOIN PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
if ($CurrentPageName == $_f_join_) {
  $smarty->assign('FIELDUsername', urldecode(GetValueOrDefault($_GET['tusername'], '')));
  $smarty->assign('FIELDEmail',    urldecode(GetValueOrDefault($_GET['temail'],    '')));

  $smarty->assign('POSTUsername',  GetValueOrDefault($_GET['username'],  ''));
  $smarty->assign('POSTEmail',     GetValueOrDefault($_GET['email'],     ''));
  $smarty->assign('POSTPassword',  GetValueOrDefault($_GET['pass'],      ''));
  $smarty->assign('POSTCaptcha',   GetValueOrDefault($_GET['captcha'],   ''));
  $smarty->assign('POSTLang',      GetValueOrDefault($_GET['plang'],     ''));
  $smarty->assign('POSTCSSSkin',   GetValueOrDefault($_GET['pstyle'],    ''));

  $smarty->assign('FORMJoin',      GetValueOrDefault($_GET['join'],    ''));
}
/* ~~~ End of JOIN PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


/* ~~~ PROFILE PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
if ($CurrentPageName == $_f_profile_ ||
    $CurrentPageName == $_f_join_) {
  $smarty->assign('ListCSSSkins',  ListSkins($DIR_CSS_FRONTEND));
  $smarty->assign('CountCSSSkins', count(ListSkins($DIR_CSS_FRONTEND)));

  if ($UserLoggedIn) {
    $smarty->assign('UserCSSSkin',   $_USER_CSSSKIN);
    $smarty->assign('UserLanguage',  $_USER_LANG);
  }

  $smarty->assign('FIELDEmail',    urldecode(GetValueOrDefault($_GET['temail'], '')));

  $smarty->assign('POSTUsername',  GetValueOrDefault($_GET['username'],  ''));
  $smarty->assign('POSTEmail',     GetValueOrDefault($_GET['email'],     ''));
  $smarty->assign('POSTPassword',  GetValueOrDefault($_GET['pass'],      ''));
  $smarty->assign('POSTPassword0', GetValueOrDefault($_GET['pass0'],     ''));
  $smarty->assign('POSTPassword2', GetValueOrDefault($_GET['pass2'],     ''));
  $smarty->assign('POSTLang',      GetValueOrDefault($_GET['plang'],     ''));
  $smarty->assign('POSTCSSSkin',   GetValueOrDefault($_GET['pstyle'],    ''));

  $smarty->assign('FORMProfile',   GetValueOrDefault($_GET['profile'],   ''));
  $smarty->assign('FORMPassword',  GetValueOrDefault($_GET['password'],  ''));
}
/* ~~~ End of PROFILE PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


/* ~~~ SEARCH PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
if ($CurrentPageName == $_f_search_) {
  /* These two sentences are at the top of this document. The search
   * form is every page, so the search query must be seen from any
   * page. */
  //$SearchQuery = trim(urldecode(GetValueOrDefault($_GET['q'], '')));
  //$smarty->assign('SearchQuery', $SearchQuery);

  $SearchMethod = $SITE_SEARCH_METHOD;
  $SearchResults = ArraySearch($DIR_POSTS . $Language,
                               $SearchQuery,
                               $SearchMethod,
                               $MAX_POSTS_CHARS_IN_SUMMARY_REPLACEMENT,
                               $POSTS_PREVIEW_IN_PLAIN_TEXT);

  $smarty->assign('SearchResults', $SearchResults);
}
/* ~~~ End of SEARCH PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


/* ~~~ TAGS PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
if ($CurrentPageName == $_f_tags_) {
  $TagQuery = trim(urldecode(GetValueOrDefault($_GET['tag'], '')));
  $smarty->assign('TagQuery', $TagQuery);

  $TagsResults = ArrayTags($DIR_POSTS . $Language,
                           $TagQuery,
                           //true,      /* case sensitive tags */
                           false,     /* case insensitive tags */
                           $MAX_POSTS_CHARS_IN_SUMMARY_REPLACEMENT,
                           $POSTS_PREVIEW_IN_PLAIN_TEXT);

  $smarty->assign('TagsResults', $TagsResults);
}
/* ~~~ End of TAGS PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


/* Smarty display */
$smarty->assign('DirFrontend', $DIR_GENERIC_FRONTEND);
$smarty->display($DIR_GENERIC_FRONTEND . 'main.tpl');

?>

