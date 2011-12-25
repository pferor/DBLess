<?php
/**
 * @file values.php
 *
 * @brief Values management functions
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
 * @brief Get a value, os assign a default value if it was not set
 *
 * @param $value         Value to return if it's set
 * @param $default_value Value to assign if $value is not set
 *
 * @return Value if is set, or default one otherwise
 */
function GetValueOrDefault(&$value, $default_value = null)
{
  if (isset($value) && $value != '') {
    return $value;
  } else {
    return $default_value;
  }
}

