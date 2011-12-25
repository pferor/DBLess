<?php
/**
 * @file posts.php
 *
 * @brief Posts operations
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


require_once('datetime.php'); /* FormatDateTime(... */


/**
 * @brief Check if a post file has a well formed name
 *
 * @param $plaintext       Text of the post filename
 * @param $future_is_valid Consider the future posts valids too
 *
 * @return @e true if the post filename is well formed, @e false
 *         otherwise
 *
 * @note In order to add the feature of program posts, i.e., save a
 *       post with a future date, not to be shown before that date is
 *       reached, the valid dates refering to a future date will be
 *       considered unvalid. With this restriction, no
 *       posts/comments will shown until its date is reachd.
 */
function isValidPostFile($plaintext,
                         $future_is_valid = false)
{
  if (strlen($plaintext) != 14) {
    return false;
  } else {
    $year  = $plaintext[0]  . $plaintext[1]  . $plaintext[2] . $plaintext[3];
    $month = $plaintext[4]  . $plaintext[5];
    $day   = $plaintext[6]  . $plaintext[7];
    $hour  = $plaintext[8]  . $plaintext[9];
    $mins  = $plaintext[10] . $plaintext[11];
    $secs  = $plaintext[12].  $plaintext[13];

    $timestamp = sprintf('%04d-%02d-%02d %02d:%02d:%02d',
                         $year, $month, $day,
                         $hour, $mins,  $secs);

    /* Admits only valid timestamps and past or present dates, not
     * future ones */
    if ($future_is_valid) {
      if (isValidDateTime($timestamp)) {
        return true;
      } else {
        return false;
      }
    } else {
      if (isValidDateTime($timestamp) &&
          DateTimeCompareWithToday($timestamp) < 0) {
        return true;
      } else {
        return false;
      }
    } /* if ($future_is_valid... */
  }
}


/**
 * @brief Check if a comment file has a well formed name
 *
 * @param $plaintext       Text of the post filename
 * @param $future_is_valid Consider the future posts valids too
 *
 * @return @e true if the post filename is well formed, @e false
 *         otherwise
 *
 * @note In order to add the feature of program posts, i.e., save a
 *       post with a future date, not to be shown before that date is
 *       reached, the valid dates refering to a future date will be
 *       considered unvalid. With this restriction, no
 *       posts/comments will shown until its date is reachd.
 *
 * @note Comments filenames have the same properties as posts'.
 *
 * @see isValidPostFile
 */
function isValidCommentFile($plaintext,
                            $future_is_valid = false)
{
  return isValidPostFile($plaintext, $future_is_valid);
}


/**
 * @brief Gets all the posts filenames
 *
 * @param $dir             Directory where to search for the comments
 * @param $newer_first     New entries first
 * @param $future_is_valid Future comments will be added too
 *
 * @return Array containig the posts filenames sorted by date in
 *         descending order. If there are no posts, or no valid ones,
 *         an empty array will be returned.
 */
function GetPostFiles($dir             = 'posts/',
                      $newer_first     = true,
                      $future_is_valid = false)
{
  $posts       = scandir($dir);
  $valid_posts = array();

  for ($i = 0, $k = 0; $i < count($posts); $i++) {
    /* Do not take ^. and ~$ files */
    if ($posts[$i][0] != '.' &&
        $posts[$i][strlen($posts[$i]) - 1] != '~') {
      if (isValidPostFile(substr($posts[$i], 0, -4),
                          $future_is_valid)) {
        $valid_posts[$k] = $posts[$i];
        $k++;
      }
    }
  } /* for */

  if ($newer_first) {
    return array_reverse($valid_posts);
  } else {
    return $valid_posts;
  }
}


/**
 * @brief Gets all the comments filenames
 *
 * @param $dir             Directory where to search for the comments
 * @param $newer_first     New entries first
 * @param $future_is_valid Future comments will be added too
 *
 * @return Array containig the posts filenames sorted by date in
 *         descending order. If there are no posts, or no valid ones,
 *         an empty array will be returned.
 *
 * @note Comments filenames have the same properties as posts'.
 *
 * @see isValidPostFile
 */
function GetCommentFiles($dir             = 'comments/',
                         $newer_first     = true,
                         $future_is_valid = false)
{
  return GetPostFiles($dir, $newer_first, $future_is_valid);
}


/**
 * @brief Count the number of valid comments for a given post
 *
 * @param $posts_file      Post to get the number of comments from
 * @param $dir             Dir to search for the comments
 * @param $future_is_valid Future comments will be valid too
 *
 * @return Number of comments for a given post
 *
 * @note Comments are stored with a syntax very similar to posts, so,
 *       the function 'isValidPost' is usesd to check if the
 *       comment is valid.
 */
function CountComments($posts_file,
                       $dir             = '',
                       $future_is_valid = false)
{
  $counter = 0;
  $complete_dir = $dir . substr($posts_file, 0, -4);

  if (is_dir($complete_dir)) {
    if (($files = @scandir($complete_dir))) {
      foreach ($files as $file) {
        if (isValidPostFile(substr($file, 0, -4),
                            $future_is_valid)) {
          $counter++;
        }
      } /* foreach ($file as... */
    }

    return $counter;
  /* if (is_dir(... */
  } else {
    return $counter;
  }
}


/**
 * @brief Gets post title by a given ID
 *
 * @param $dir_posts Directory where posts are
 * @param $post_id   Post identificator
 *
 * @return Post title or @c null if post is not valid
 */
function PostTitleByID($dir_posts = 'posts/',
                       $post_id)
{
  if (isValidPostFile($post_id)) {
    $post_file = $dir_posts . '/' . $post_id . '.php';

    if (file_exists($post_file)) {
      include($post_file);
      return $TITLE;
    }
  }

  return null;
}


/**
 * @brief Gets the substring between two marks
 *
 * @param $string String to look in
 * @param $start  Initial mark
 * @param $end    End mark
 *
 * @return String between $start and $end.
 *
 * @note This function supports regular expressions. To find a
 * substring between the very beginning of the string and $end, $start
 * must be set to $start='^'.
 */
function StringBetween($string,
                       $start,
                       $end)
{
  $string = ' ^' . $string;
  $ini    = strpos($string, $start);

  if ($ini == 0) {
    return '';
  }

  $ini += strlen($start);
  $len  = strpos($string, $end, $ini) - $ini;

  return substr($string, $ini, $len);
}

