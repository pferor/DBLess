<?php
/**
 * @file rss_feed.php
 *
 * @brief Gererate a valid RSS 2,0 feed with site contents for any
 *        language available on the site
 */

/**
 * @brief Just a bad fix to modify the relative URI on the feed links.
 *
 * @param $uri      Relative URI to transform
 * @param $uri_base Base of the URI
 *
 * @note @e $uri_base must be well defined
 */
function Rel2Abs($uri,
        $uri_base='http://pferor.org/blog/')
//        $uri_base='http://localhost/dbless/')
{
  if (!preg_match("/^http/", $uri)) {
    $new_uri = $uri_base.$uri;
    $new_uri = str_replace('../', '', $new_uri);
  }
  else {
    $new_uri = $uri;
  }

  return $new_uri;
}


 /* Just in case, for using absolute URIs: There are some problems
  * using relative URIs */
require_once('../localcfg.php');

include($DIR_INCLUDE . 'html.php');      /* html2text */
include($DIR_INCLUDE . 'file.php');      /* File management */
include($DIR_INCLUDE . 'posts.php');     /* Get posts,... */
include($DIR_CONFIG  . 'site_tech.php'); /* Get the default language */
include($DIR_INFO    . 'site_name.php'); /* Get site name */


/* Get language. One file per language */
if (!isset($_GET["lang"]) || !file_exists($DIR_POSTS.$_GET["lang"])) {
  $lang = $SITE_DEFAULT_LANGUAGE;
}
else {
  $lang = $_GET["lang"];
}


/* RSS Structure */
$FeedContent = "";

$FeedContent .=
  '<?xml version="1.0" ?>' . "\n" .
  '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . "\n".
  '<channel>' . "\n";

$FeedContent .=
  '<title>'       . $SITE_SHORT_NAME . '</title>' . "\n" .
  '<link>'        . Rel2Abs('')      . '</link>'  . "\n" .
  '<description>' . $SITE_LONG_NAME  . 'Description'. '</description>' . "\n";

/* Get posts */
$PostsFiles = array();
$PostsFiles = GetPostFiles($DIR_POSTS.$lang);

for ($i = 0; $i < count($PostsFiles); $i++) {
  include($DIR_POSTS.$lang.'/'.$PostsFiles[$i]);

  $FEEDCONTENT_URI         = substr('?pg=post&amp;id='.$PostsFiles[$i], 0, -4);
  $FEEDCONTENT_TITLE       = html2text($TITLE);
  $FEEDCONTENT_DESCRIPTION = html2text(StringBetween($POST, '^', $POST_DELIMITER_STRING));

  $FeedContent .=
    '  <item>'."\n".
    '    <title>'       . $FEEDCONTENT_TITLE        . '</title>'       . "\n".
    '    <link>'        . Rel2Abs($FEEDCONTENT_URI) . '</link>'        . "\n".
    '    <description>' . $FEEDCONTENT_DESCRIPTION  . '</description>' . "\n".
    '    <guid>'        . Rel2Abs($FEEDCONTENT_URI) . '</guid>'        . "\n";

  $FeedContent .='  </item>' . "\n";
}

  $FeedContent .=
  '</channel>' . "\n" .
  '</rss>'     . "\n";


/* Generate file */
$FeedFilename = "feed." . $lang . ".xml";
SaveFile($FeedFilename, $FeedContent, "w+");


/* Redirect to that brand new file */
header("Location: " . $FeedFilename);

