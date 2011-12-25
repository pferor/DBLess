<?php
/**
 * @file languages.php
 *
 * @brief Langauges operations
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
 * @brief Count how many languages are on the system
 *
 * @param $dir Languages directory
 * @param $ext Extension to take in consideration
 *
 * @return Number of language files are in the languages directory
 */
function CountLangs($dir = 'langs/',
                    $ext = 'php')
{
  return CountFiles($dir, $ext);
}


/**
 * @brief Count how many langauge can be used
 *
 * @param $dir_langs Languages directory
 * @param $dir_posts Posts diectory
 *
 * @return Number of effective languages
 */
function ListEffectiveLangs($dir_langs = 'langs/',
                            $dir_posts = 'posts/')
{
  $langs = array();

  $langs = array_intersect(ListLangsFiles($dir_langs),
                           ListLangsDirectories($dir_posts));

  /* This resets the array indices. Smarty requires sorted indices
   * for the 'section' function */
  return array_merge(array(), $langs);
}


/**
 * @brief Count the language directories in posts folder
 *
 * @param @dir     Directory where to count
 * @param @exclude Exclude files with this pattern (see 'preg_match')
 *
 * @return Number of languages directories in posts dir.
 */
function CountLangsDirectories($dir     = 'posts/',
                               $exclude = '/php$/')
{
  $files     = array();
  $directory = opendir($dir);

  while ($item = readdir($directory)) {
    // We filter the elements that we don't want to appear '.', '..'
    if (($item != '.') && ($item != '..') && 
        !preg_match($exclude, $item)) {
      $files[] = $item;
    }
  }
  $numFiles = count($files);

  return $numFiles;
}


/**
 * @brief Generates a list of languages
 *
 * @param $dir       Languages directory
 * @param $extension Extension of the langauge files
 * @param $exclude   Exclude files with this pattern (see 'preg_match')
 *
 * @return An array containing the languages on the system
 */
function ListLangsFiles($dir       = 'langs/',
                        $extension = 'php',
                        $exclude   = '/smarty/')
{
  $files   = scandir($dir);
  $ext_len = strlen($extension) + 1;
  $langs   = array();

  for ($i = 0; $i < count($files); $i++) {
    if ($files[$i][0] != ' . ' &&
        $files[$i][strlen($files[$i]) - 1] != '~'  &&
        strtolower(substr($files[$i], -($ext_len - 1))) == $extension &&
        !preg_match($exclude, $files[$i])) {
      array_push($langs, substr($files[$i], 0, -4));
    }
  }

  return $langs;
}


/**
 * @brief Generates the language directories in posts folder
 *
 * @param @dir     Directory where to count
 * @param @exclude Exclude files with this pattern (see 'preg_match')
 *
 * @return Number of languages directories in posts dir.
 */
function ListLangsDirectories($dir     = 'posts/',
                              $exclude = '/php$/')
{
  $files     = array();
  $directory = opendir($dir);

  while ($item = readdir($directory)) {
    // We filter the elements that we don't want to appear '.', '..'
    if (($item != '.') && ($item != '..') && 
        !preg_match($exclude, $item)) {
      $files[] = $item;
    }
  }

  return $files;
}

