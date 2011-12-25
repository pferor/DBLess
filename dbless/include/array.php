<?php
/**
 * @file array.php
 *
 * @brief Site content arrays routines for posts and comments
 *
 * @todo Search methods definitions (TITLES, SUMMARIES and CONTENTS)
 *       should be defined here? This definitions are used in
 *       `site_tech.php', and that file is invoked after this one.
 *       Figure out how to make this more beautiful
 *
 * @todo Make this file more readable
 *
 * @author  Pferor <pferor@gmail.com>
 * @version 1.0 (2010-09-12)
 *
 * @ingroup Functions
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


require_once('html.php');  /* html2text(... */
require_once('posts.php'); /* GetPostsFiles(... */
require_once('tags.php');  /* TagsFromString(... */
require_once('users.php'); /* isAdmin(... */


/* Search methods */
if (!defined ('TITLES')) {
  define('TITLES',    1);
}
if (!defined ('SUMMARIES')) {
  define('SUMMARIES', 2);
}
if (!defined ('CONTENTS')) {
  define('CONTENTS',  4);
}


/**
 * @brief Retrieve the posts within a range
 *
 * @param $dir_posts            Where to find the posts
 * @param $max_trucante_summary Characters to get from the summary
 * @param $post_delimiter       Delimiter of the post. If $Summary is
 *                              empty, the text shown as the post
 *                              summary is the post itself until the
 *                              delimiter is found.
 * @param $start                Initial post postion to retrieve from
 * @param $end                  End post position to retrive to
 * @param $fmt_plain            Use original post or plain text?
 * @param $future_is_valid      Future posts will be added too?
 * @param $sensitive            Case sensitive tags?
 *
 * @return Array of posts, or @c null if @e $dir_posts does not exist
 */
function ArrayPosts($dir_posts       = 'posts/',
                    $post_delimiter  = '<!-- more -->',
                    $start           = 0,
                    $end             = 0,
                    $fmt_plain       = true,
                    $future_is_valid = false,
                    $sensitive       = false)
{
  if (!is_dir($dir_posts)) {
    return null;
  }

  $posts_files_results = array();
  $posts_files_results = GetPostFiles($dir_posts, true,
                                      $future_is_valid);
  $posts_count = count($posts_files_results);

  if ($end == 0) {
    $end = $posts_count;
  }

  /* swap limits it $start > $end */
  if ($start > $end) {
    $tmp   = $start;
    $start = $end;
    $end   = $tmp;
  }

  if ($posts_count == 0) {
    return array();
  }

  /* Get only needed posts information */
  $posts_results = array();
  for ($i = $start; $i < $end; $i++) {
    unset($AUTHOR, $TITLE, $SUMMARY, $POST, $TAGS);
    include($dir_posts . '/' . $posts_files_results[$i]);

    /* Transform post HTML to plain text... */
    if ($fmt_plain) {
      $arr_tmp = array(
                       /* Preventing the insertion HTML code */
                       'id'        => substr($posts_files_results[$i],
                                             0, -4),
                       'Tags'      => TagsFromString(GetValueOrDefault($TAGS,
                                                                       '',
                                                                       $sensitive)),
                       'TimeStamp' => FormatPostDateTime(substr($posts_files_results[$i],
                                                                0, -4)),
                       'Author'    => html2text(GetValueOrDefault($AUTHOR,
                                                                  '')),
                       'Title'     => html2text(GetValueOrDefault($TITLE,
                                                                  '')),
                       'Summary'   => html2text(GetValueOrDefault($SUMMARY,
                                                                  '')),
                       'Post'      => ($post_delimiter == '') ?
                       html2text(GetValueOrDefault($POST, '')) :
                       (is_int($post_delimiter)) ?
                       Truncate(html2text(GetValueOrDefault($POST, '')),
                                $post_delimiter) :
                       html2text(StringBetween(GetValueOrDefault($POST, ''),
                                               '^', $post_delimiter))
                       );
      /* ... or preserve HTML format */
    } else {
      $arr_tmp = array(
                       /* Preventing the insertion HTML code */
                       'id'        => substr($posts_files_results[$i], 0, -4),
                       'Tags'      => TagsFromString(GetValueOrDefault($TAGS,
                                                                       '',
                                                                       $sensitive)),
                       'TimeStamp' => FormatPostDateTime(substr($posts_files_results[$i],
                                                                0, -4)),
                       'Author'    => GetValueOrDefault($AUTHOR,  ''),
                       'Title'     => GetValueOrDefault($TITLE,   ''),
                       'Summary'   => GetValueOrDefault($SUMMARY, ''),
                       'Post'      => ($post_delimiter == '') ?
                       GetValueOrDefault($POST, ''):
                       (is_int($post_delimiter)) ?
                       Truncate(GetValueOrDefault($POST, ''),
                                $post_delimiter) :
                       StringBetween(GetValueOrDefault($POST, ''),
                                     '^', $post_delimiter)
                       );
    }
    $posts_results[$i - $start] = $arr_tmp;
    unset($arr_tmp);

    /* Stop when needed */
    if ($i >= $posts_count -1) {
      break;
    }
  } /* for ($i... */

  return $posts_results;
}


/**
 * @brief Retrieves the arrays of comments for a given post
 *
 * @param $dir_posts       Directory where retrieve the post comments
 * @param $post_id         ID of the post to search comments in
 * @param $moderation      Exclude comments pending moderation
 * @param $future_is_valid Future posts will be considered valid?
 *
 * @return Comments for the post $post_id
 */
function ArrayComments($dir_posts,
                       $post_id,
                       $moderation      = true,
                       $future_is_valid = false)
{
  if (!is_dir($dir_posts . '/' . $post_id)) {
    return null;
  }

  /* Get comments */
  $comments_files_results = GetCommentFiles($dir_posts . '/' . $post_id,
                                          //false, /* Newer last */
                                          true,  /* Newer first */
                                          $future_is_valid);
  $comments_count = count($comments_files_results);

  if ($comments_count == 0) {
    return array();
  }

  /* Get info. */
  $comments_results = array();
  for ($i = 0; $i < $comments_count; $i++) {
    unset($MODERATE_PENDING, $AUTHOR, $IN_RESPONSE_OF, $COMMENT);

    include($dir_posts . '/' . $post_id . '/' .
            $comments_files_results[$i]);

    if (!$moderation || (!isset($MODERATE_PENDING) ||
                         !$MODERATE_PENDING)) {
      $arr_tmp = array(
                       'id'        => substr($comments_files_results[$i],
                                             0, -4),
                       'TimeStamp' => FormatPostDateTime(substr($comments_files_results[$i],
                                                                0, -4)),
                       'Author'    => GetValueOrDefault($AUTHOR, ''),
                       'Comment'   => $COMMENT
                       );

      $comments_results[$i] = $arr_tmp;
      unset($arr_tmp);
    } /* if ($MODERATE... */
  } /* for ($i */

  /* Reset array indices */
  $comments_results = array_merge(array(), $comments_results);

  return $comments_results;
}


/**
 * @brief Get comments without moderation
 *
 * @param $dir             Directory where to find comments
 * @param $post_id         ID of the post to search comments in
 * @param $future_is_valid Future comments will be added too
 *
 * @return Array of comments pending of moderation
 */
function ArrayUnmoderatedComments($dir_posts,
                                  $post_id,
                                  $future_is_valid = false)
{
  if (!is_dir($dir_posts . '/' . $post_id)) {
    return null;
  }

  /* Get comments */
  $comments_files_results = GetCommentFiles($dir_posts . '/' . $post_id,
                                          //false, /* Newer last */
                                          true,  /* Newer first */
                                          $future_is_valid);
  $comments_count = count($comments_files_results);

  if ($comments_count > 0) {
    /* Get info. */
    $unmoderated_comments_results = array();

    for ($i = 0; $i < $comments_count; $i++) {
      unset($MODERATE_PENDING, $AUTHOR, $IN_RESPONSE_OF, $COMMENT);

      include($dir_posts . '/' . $post_id . '/' .
              $comments_files_results[$i]);

      if ($MODERATE_PENDING) {
        $arr_tmp = array(
                         'id'        => substr($comments_files_results[$i],
                                               0, -4),
                         'PostID'    => $post_id,
                         'PostTitle' => PostTitleByID($dir_posts, $post_id),
                         'TimeStamp' => FormatPostDateTime(substr($comments_files_results[$i],
                                                                  0, -4)),
                         'Author'    => GetValueOrDefault($AUTHOR, ''),
                         'Comment'   => $COMMENT,
                         );

        $unmoderated_comments_results[$i] = $arr_tmp;
        unset($arr_tmp);
      } /* if ($MODERATE... */
    } /* for ($i */

    /* Reset array indices */
    $unmoderated_comments_results = array_merge(array(), $unmoderated_comments_results);
  } else {
    $unmoderated_comments_results = array();
  }

  return $unmoderated_comments_results;
}


/**
 * @brief Get ALL comments without moderation
 *
 * @param $dir             Directory where to find comments
 * @param $future_is_valid Future comments will be added too
 *
 * @return Array of comments pending of moderation
 *
 * @note The result is an array where the keys are the posts ID, and
 *       for each one, the array of the comment fields.
 *
 * @note The @c $future_is_valid makes no sense here. There cannot be
 *              a comment with a future date. Although it will be used
 *              here for testing purposes. Probably in the future, this
 *              parameter will disappear.
 */
function ArrayAllUnmoderatedComments($dir_posts,
                                     $future_is_valid = false)
{
  $posts_results        = GetPostFiles($dir_posts, true, $future_is_valid);
  $unmoderated_comments = array();

  /* For each post, get its unmoderated comments. */
  foreach ($posts_results as $post) {
    $unmoderated_comments = array_merge((array) $unmoderated_comments,
                                        (array) ArrayUnmoderatedComments($dir_posts,
                                                                         substr($post, 0, -4)));
  } /* foreach ($posts_results... */

  return $unmoderated_comments;
}


/**
 * @brief Retrieves posts that mathes a query
 *
 * @param $dir_posts        Where to find the posts
 * @param $query            Query to match
 * @param $method           Search method (search only in titles,
 *                          summaries or contents)
 * @param $post_delimiter   Delimiter of the post. If $Summary is
 *                          empty, the text shown as the post
 *                          summary is the post itself until the
 *                          delimiter is found.
 * @param $fmt_plain        Use original post or plain text?
 * @param $future_is_valid  Future posts will be added too?
 *
 * @note This function uses the definitions TITLES, SUMMARIES and
 *       CONTENTS. Its values are used in the following way:
 *
 *  TITLES    = 001
 *  SUMMARIES = 010
 *  CONTENTS  = 100
 *
 *  TITLES    | SUMMARIES          001 | 010       = 011
 *  TITLES    | CONTENTS           001 | 100       = 101
 *  SUMMARIES | CONTENTS           010 | 100       = 110
 *  ...
 *  TITLES | SUMARIES | CONTENTS   001 | 010 | 100 = 111
 *
 * @return Array of posts, or @c null if @e $dir_posts does not exist
 */
function ArraySearch($dir_posts       = 'posts/',
                     $query           = '',
                     $method          = '',
                     $post_delimiter  = '<!-- more -->',
                     $fmt_plain       = true,
                     $future_is_valid = false)
{
  if (!is_dir($dir_posts)) {
    return null;
  }

  $posts_results = ArrayPosts($dir_posts, '',
                             0, 0,
                             $fmt_plain,
                             $future_is_valid);
  $posts_count   = count($posts_results);

  if ($posts_count == 0) {
    return array();
  }

  if ($query != '') {
    /* Remove non alphanumeric characters  */
    $query = preg_replace('/[^a-zA-Z0-9\s]/', '', $query);

    /* Setting blank spaces around the query, we makes sure that we
     * find the same word, instead a lot of unneded matches. */

    /* This makes the search more refined, but this ignores the first
     * and last words. A blank space must be added to the haystack as
     * well. */
    $query = ' ' . $query . ' ';


    $search_results = array();

    /* Search in ALL posts */
    foreach ($posts_results as $result) {
      /* Search in titles */
      if (($method & TITLES) > 0) {
        $Title = ' ' .
          NormalizeString($result['Title']) . ' ';

        if (stristr($Title, $query) &&
            !in_array($result, $search_results)) {
          /* Add this post to SearchResults */
          array_push($search_results, $result);
        }
      } /* if ($method... */

      /* Search in summaries */
      if (($method & SUMMARIES) > 0) {
        $Summary = ' ' .
          NormalizeString($result['Summary']) . ' ';

        if (stristr($Summary, $query) &&
            !in_array($result, $search_results)) {
          /* Add this post to SearchResults */
          array_push($search_results, $result);
        }
      }

      /* Serach in post text */
      if (($method & CONTENTS) > 0) {
        $Content = ' ' .
          NormalizeString($result['Post']) . ' ';

        if (stristr($Content, $query) &&
            !in_array($result, $search_results)) {
          /* Add this post to SearchResults */
          array_push($search_results, $result);
        }
      }

    } /* foreach (... */
  /* If no query, then show all posts (just like archive) */
  } else {
    $search_results = $posts_results;
  }

  /* Format - if no summary, show a bit of the post content */
  foreach ($search_results as &$result) {
    if (!isset($result['Summary']) ||
        $result['Summary'] == '') {
      if ($fmt_plain) {
        $result['Post']  = ($post_delimiter == '') ?
          html2text($result['Post']) :
          (is_int($post_delimiter)) ?
          Truncate(html2text($result['Post']), $post_delimiter) :
          html2text(StringBetween($result['Post'],
                                  '^', $post_delimiter));
      } else {
        $result['Post']  = ($post_delimiter == '') ?
          $result['Post']:
          (is_int($post_delimiter)) ?
          Truncate($result['Post'], $post_delimiter) :
          StringBetween($result['Post'],
                        '^', $post_delimiter);
      }
    } /* if no summary */
  } /* foreach (... */


  return $search_results;
}


/**
 * @brief Retrieves posts that mathes a tag
 *
 * @param $dir_posts        Where to find the posts
 * @param $tag              Tag to match
 * @param $sensitive        Be case sensitive?
 * @param $post_delimiter   Delimiter of the post. If $Summary is
 *                          empty, the text shown as the post
 *                          summary is the post itself until the
 *                          delimiter is found.
 * @param $fmt_plain        Use original post or plain text?
 * @param $future_is_valid  Future posts will be added too?
 *
 * @return Array of posts, or @c null if @e $dir_posts does not exist
 */
function ArrayTags($dir_posts       = 'posts/',
                   $tag             = '',
                   $sensitive       = false,
                   $post_delimiter  = '<!-- more -->',
                   $fmt_plain       = true,
                   $future_is_valid = false)
{
  if (!is_dir($dir_posts)) {
    return null;
  }

  $posts_results = ArrayPosts($dir_posts, '',
                             0, 0,
                             $fmt_plain,
                             $future_is_valid);
  $posts_count   = count($posts_results);

  if ($posts_count == 0) {
    return array();
  }

  if ($tag != '') {
    $tags_results = array();

    /* Search tag in ALL posts */
    foreach ($posts_results as $result) {
      foreach ($result['Tags'] as $rtag) {

        if ($sensitive) {
          if (in_array($tag,
                       TagsFromString($rtag, $sensitive))) {
            array_push($tags_results, $result);
          }
        } else {
          if (in_array(strtolower($tag),
                       TagsFromString(strtolower($rtag),
                                      $sensitive))) {
            array_push($tags_results, $result);
          }
        } /* if ($sensitive*/

      } /* foreach (... */
    } /* foreach (... */
  /* If no tag, then show nothing */
  } else {
    return array();
  }

  /* Format - if no summary, show a bit of the post content */
  foreach ($tags_results as &$result) {
    if (!isset($result['Summary']) ||
        $result['Summary'] == '') {
      if ($fmt_plain) {
        $result['Post']  = ($post_delimiter == '') ?
          html2text($result['Post']) :
          (is_int($post_delimiter)) ?
          Truncate(html2text($result['Post']), $post_delimiter) :
          html2text(StringBetween($result['Post'],
                                  '^', $post_delimiter));
      } else {
        $result['Post']  = ($post_delimiter == '') ?
          $result['Post']:
          (is_int($post_delimiter)) ?
          Truncate($result['Post'], $post_delimiter) :
          StringBetween($result['Post'],
                        '^', $post_delimiter);
      }
    } /* if no summary */
  } /* foreach (... */


  return $tags_results;
}


/**
 * @brief Get an array of users
 *
 * @param $dir_users      Directory where users are
 * @param $info_file      Where the user information is stored
 * @param $include_admins Include administrators info?
 *
 * @return Array of users by name, or @c null if the directory does
 *         not exist. This directory is the container of all users,
 *         not the individual user folder.
 */
function ArrayUsers($dir_users = 'users/',
                    $info_file = 'info.php',
                    $include_admins = false,
                    $admins_arr = 'site_admin.php')
{
  if (!is_dir($dir_users)) {
    return null;
  }

  $users_files_results = GetUsersDirs($dir_users);
  $users_count         = count($users_files_results);

  if ($users_count == 0) {
    return array();
  }

  $users_results = array();

  /* Get users information */
  foreach ($users_files_results as $user) {
    unset($_USER_NAME, $USER_EMAIL, $_SIGN_UP_DATE);
    $tmp_arr = array();

    /* Include user info. file */
    include($dir_users . $user . '/' . $info_file);

    if (!$include_admins) {
      if (!isAdmin($_USER_NAME, $admins_arr)) {
        $tmp_arr = array (
                          'id'         => $user,
                          'Username'   => GetValueOrDefault($_USER_NAME,    'ERROR!'),
                          'Email'      => GetValueOrDefault($_USER_EMAIL,   ''),
                          'SignUpDate' => GetValueOrDefault($_SIGN_UP_DATE, '?')
                          );
      }
    } else {
      $tmp_arr = array (
                        'id'         => $user,
                        'Username'   => GetValueOrDefault($_USER_NAME,    'ERROR!'),
                        'Email'      => GetValueOrDefault($_USER_EMAIL,   ''),
                        'SignUpDate' => GetValueOrDefault($_SIGN_UP_DATE, '?')
                        );
    }

    /* If admins. are not wanted may be empty entries on tmp_arr. They
     * must be exluded as well. */
    if (!empty($tmp_arr)) {
      array_push($users_results, $tmp_arr);
    }

    unset($tmp_arr);
  } /* foreach($users_results... */

  return $users_results;
}

