<?php
/**
 * @file skins.php
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
 * @brief Count how many skins are on the system
 *
 * @param $dir Skins directory
 * @param $ext Extension to take in consideration
 *
 * @return Number of language files are in the skins directory
 */
function CountSkins($dir = 'css/',
                    $ext = 'css')
{
  return CountFiles($dir, $ext);
}


/**
 * @brief Generates a list of skins
 *
 * @param $dir       Skins directory
 * @param $extension Extension of the langauge files
 * @param $exclude   Exclude files with this pattern (see 'preg_match')
 *
 * @return An array containing the skins on the system
 */
function ListSkins($dir       = 'css/',
                   $extension = 'css',
                   $exclude   = '/^__/')
{
  $files   = scandir($dir);
  $ext_len = strlen($extension) + 1;
  $skins   = array();

  for ($i = 0; $i < count($files); $i++) {
    if ($files[$i][0] != ' . ' &&
        $files[$i][strlen($files[$i]) - 1] != '~'  &&
        strtolower(substr($files[$i], -($ext_len - 1))) == $extension &&
        !preg_match($exclude, $files[$i])) {
      array_push($skins, substr($files[$i], 0, -4));
    }
  }

  return $skins;
}

