<?php
/**
 * @file users.php
 *
 * @brief Users related routines
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
 * @brief Checks if some user is administrator
 *
 * @param $admin_name Name of the administrator
 * @param $admins_arr Array of administrators to search in
 *
 * @return @c true if $admin_name is really an administrator, or
 *         @c false otherwise
 */
function isAdmin($admin_name, $admins_arr)
{
  if (isset($admin_name) && $admin_name != '') {
    return in_array($admin_name, $admins_arr);
  } else {
    return false;
  }
}


/**
 * @brief Returns the ID of the administrator
 *
 * @param $admin_name Name of the administrator to get the ID
 * @param $admins_arr Array of administrators to search in
 *
 * @return Administrator ID or -1 if $admin_name is not an admin
 */
function AdminID($admin_name, $admins_arr)
{
  if (in_array($admins_arr, $admin_name)) {
    return array_search($admin_name, $admins_arr);
  } else {
    return -1;
  }
}


/**
 * @brief Get an array of users directories
 *
 * @param $dir Directory where users are
 *
 * @return Array of users folders. If there are no users an empty
 *         array will be returned.
 */
function GetUsersDirs($dir = 'users/')
{
  $users      = scandir($dir);
  $users_dirs = array();

  for ($i = 0, $k = 0; $i < count($users); $i++) {
    /* Do not take ^. and ~$ files */
    if ($users[$i][0] != '.' &&
        $users[$i][strlen($users[$i]) - 1] != '~') {
      $users_dirs[$k] = $users[$i];
      $k++;
    }
  } /* for($i... */

  return $users_dirs;
}

