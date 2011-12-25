<?php
/**
 * @file common.php
 *
 * @brief Common routines
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


/**
 * @brief Truncates a string
 *
 * @param $str      String to truncate
 * @param $length   Length from where to truncate
 * @param $trailing Suffix added to the trucated string
 *
 * @return String truncated
 */
function Truncate($str, $length = 10, $trailing = '...')
{
  /* Take off chars for the trailing */
  $length -= strlen($trailing);
  if (strlen($str) > $length) {
    /* string exceeded length, truncate and add trailing dots */
    return substr($str, 0, $length) . $trailing;
  } else {
    /* The string was already short enough, return the string */
    $res = $str;
  }

  return $res;
}


/**
 * @brief Generate a password
 *
 * @param $pass_length Length of the password
 *
 * @return New password of pass_length characters
 */
function GeneratePassword($pass_length = 8)
{
  //$str = '012345679abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

  /* Exclude ambigous characters: O and 0, I and l or 1...
   * Removed: capital 'O'
   */
  $str     = '012345679abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
  $pass    = '';
  $str_len = strlen($str) - 1;

  for ($i = 0; $i < $pass_length; $i++) {
    $rand  =  mt_rand(0, $str_len);
    $pass .= $str[$rand];
  }

  return $pass;
}


/**
 * @brief Count the number of files on a directory with a specified
 *        extension
 *
 * @param $directory Directory where to count
 * @param $extension Extension of the files to count.
 *
 * @return Number of files with extension $extension are in $directory
 *
 * @norte Hidden files (beggining with a dot [^.]) or temporary files
 *        (ending with a tilde [~$]) will be ignored
 */
function CountFiles($directory, $extension = 'php')
{
  $files   = scandir($directory);
  $ext_len = strlen($extension) + 1;

  $counter = 0;
  for ($i=0; $i < count($files); $i++) {
    /* Ignore files biggining with '.' or ending in '~' */
    if ($files[$i][0] != ' . ' &&
        $files[$i][strlen($files[$i]) - 1] != '~' &&
        strtolower(substr($files[$i],
                          strlen($files[$i]) - $ext_len, $ext_len)) ==
        '.' . $extension) {
      $counter++;
    }
  }

  return $counter;
}


/**
 * @brief Remove repeated characters
 *
 * @param $text Text to remove characterin
 * @param $char Char to remove repetitions
 *
 * @return Text without extra characters
 */
function RemoveRepeatedChars($text, $char)
{
  $count = 1;
  while ($count) {
    $text = str_replace($char . $char, $char, $text, $count);
  }

  return trim($text);
}

