<?php
/**
 * @file tags.h
 *
 * @brief Tags operations
 *
 * @todo Put array_iunique in the proper file
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

require_once('common.php');


/**
 * @brief Removes duplicate values from an array in case insensitive
 *
 * @param $array The input array
 *
 * @note This is a insensitive version of 'array_unique', but ignoring
 *       the sort flags.
 */
function array_iunique(array $array)
{
  $uniq = array();

  foreach ($array as $value) {
    $uniq[strtolower($value)] = $value;
  }

  return array_values($uniq);
}


/**
 * @brief Normalize a tags string
 *
 * @tags_str  String to normalize
 * @delimiter Tags separator
 *
 * @return Tags string normalized
 */
function NormalizeTagsString($tags_str,
                             $delimiter = ',')
{
  $tags_str = RemoveRepeatedChars($tags_str, ' ');
  $tags_str = RemoveRepeatedChars($tags_str, $delimiter);
  $tags_str = RemoveRepeatedChars($tags_str, $delimiter . ' ');


  /* Remove spaces before the delimiter */
  $tags_str = str_replace(' '. $delimiter,
                          $delimiter,
                          $tags_str);

  /* Remove spaces after the delimiter */
  $tags_str = str_replace($delimiter. ' ',
                          $delimiter,
                          $tags_str);

  /* Remove delimiter if it's at the beggining */
  $tags_str = preg_replace('/^'.$delimiter.'/', '', $tags_str);

  /* Remove delimiter if it's at the end */
  $tags_str = trim($tags_str);
  $tags_str = preg_replace('/' . $delimiter . '$/',  '', $tags_str);
  $tags_str = preg_replace('/' . $delimiter . '$/',  '', $tags_str);

  /* Return spaces again, but only needed ones */
  $tags_str = str_replace($delimiter,
                          $delimiter. ' ',
                          $tags_str);

  return $tags_str;
}


/**
 * @brief Transfom the tags string into an array
 *
 * @param $tags_str  String of tags
 * @param $delimiter Tags delimiter
 * @param $sensitive Different case tags are different tags?
 *
 * @return Tags array
 *
 * @note The string is normalized before exploding it
 *
 * @see NormalizeTagsString
 */
function TagsFromString($tags_str,
                        $sensitive = false,
                        $delimiter = ',')
{
  $tags_arr = explode($delimiter,
                      (string) NormalizeTagsString($tags_str));

  /* This is no needed since the string is normalized with
   * NormalizeTagsString */
/*
  // Remove empty entries if theres some
  foreach ($tags_arr as $key => $value) {
    $tags_arr[$key] = trim($tags_arr[$key]);
    if (is_null($value) || $value == '') {
      unset($tags_arr[$key]);
    }
  }
*/

  /* Remove empty tags -- you want this because there is a chance of a
   * post without tags. */
  $tags_arr = array_filter($tags_arr);

  /* Remove duplicate tags */
  $tags_arr = array_unique($tags_arr);

  /* Consider different case tags as same tags */
  if (!$sensitive) {
    $tags_arr = array_iunique($tags_arr);
  }

  /* Reset inidices */
  $tags_arr = array_merge(array(), $tags_arr);

  return $tags_arr;
}

