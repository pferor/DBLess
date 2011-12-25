<?php
/**
 * @file datetime.php
 *
 * @brief Date time operations, specially with timestamps
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
 * @brief Compare two timestmps
 *
 * @param $date1 First date to compare
 * @param $date2 Second date to compare
 *
 * @return  1 if $date1 > $date2,
 *         -1 if $date1 < $date2 or
 *          0 if both timestamps are the same
 *
 * @note Date format must be 'yyyy-dd-mm HH:MM:SS'
 */
function DateTimeCompare($date1, $date2)
{
  $stamp1     = explode(' ', $date1);
  $date1_arr  = explode('-', $stamp1[0]);
  $time1_arr  = explode(':', $stamp1[1]);
  $stamp1_int = mktime($time1_arr[0], $time1_arr[1], $time1_arr[2],
                      $date1_arr[1], $date1_arr[2], $date1_arr[0]);

  $stamp2     = explode(' ', $date2);
  $date2_arr  = explode('-', $stamp2[0]);
  $time2_arr  = explode(':', $stamp2[1]);
  $stamp2_int = mktime($time2_arr[0], $time2_arr[1], $time2_arr[2],
                      $date2_arr[1], $date2_arr[2], $date2_arr[0]);

  $difference = $stamp1_int - $stamp2_int;

  if ($difference > 0) { /* $date2 < $date1 */
    return 1;
  } else if ($difference < 0) { /* $date2 > $date1 */
    return -1;
  } else { /* Same date */
    return 0;
  }
}


/**
 * @brief Compare one timestamp with current time
 *
 * @param $date Date to compare with today
 *
 * @return  1 if $date1 is bigger than today
 *         -1 if $date1 is smaller than today
 *          0 if both timestamps are the same
 *
 * @note Date format must be 'yyyy-dd-mm HH:MM:SS'
 */
function DateTimeCompareWithToday($date)
{
  $today = getdate();

  $today_timestamp = sprintf('%04d-%02d-%02d %02d:%02d:%02d',
                             $today['year'],
                             $today['mon'],
                             $today['mday'],
                             $today['hours'],
                             $today['minutes'],
                             $today['seconds']);

  return DateTimeCompare($date, $today_timestamp);
}


/**
 * @brief Checks if a timestamp is valid
 *
 * @param $date Timestamp to check
 *
 * @return @e true if $date is a valid timestamp, @e false otherwise
 *
 * @note Date format must be 'yyyy-dd-mm HH:MM:SS'
 */
function isValidDateTime($date)
{
  $stamp     = explode(' ', $date);
  $date_arr  = explode('-', $stamp[0]);
  $time_arr  = explode(':', $stamp[1]);

  $year  = $date_arr[0];
  $month = $date_arr[1];
  $day   = $date_arr[2];
  $hour  = $time_arr[0];
  $mins  = $time_arr[1];
  $secs  = $time_arr[2];

  /* Validate string. You can validate if strlen($date) == 14, but it
   * doesn't guarantee that every field is OK. */
  if (strlen($year)  != 4 ||
      strlen($month) != 2 ||
      strlen($day)   != 2 ||
      strlen($hour)  != 2 ||
      strlen($mins)  != 2 ||
      strlen($secs)  != 2) {
    return false;
  }

  /* validate date and time */
  if (checkdate($month, $day, $year)) {
    if ($hour < 0 || $hour > 23) {
      return false;
    }
    if ($mins < 0 || $mins > 59) {
      return false;
    }
    if ($secs < 0 || $secs > 59) {
      return false;
    }
  }

  return true;
}


/**
 * @brief Formats a timestamp from the format 'yyyymmddHHMMSS', and
 *        returns the same timestamp with format 'yyyy-mm-dd HH:MM:SS'
 *
 * @param $plaintext Timestamp in format 'yyyymmddHHMMSS'
 *
 * @return Timestamp in format 'yyyy-mm-dd HH:MM:SS'
 *
 * @note Before making any transformation, this function checks if the
 *       timestamp is valid
 */
function FormatPostDateTime($plaintext)
{
  /* A future date is also valid, so second parameter to 'true' */
  if (!isValidPostFile($plaintext, true)) {
    return '';
  } else {
    $year  = $plaintext[0]  . $plaintext[1]  . $plaintext[2] . $plaintext[3];
    $month = $plaintext[4]  . $plaintext[5];
    $day   = $plaintext[6]  . $plaintext[7];
    $hour  = $plaintext[8]  . $plaintext[9];
    $mins  = $plaintext[10] . $plaintext[11];
    $secs  = $plaintext[12] . $plaintext[13];

    return sprintf('%04d-%02d-%02d %02d:%02d:%02d',
                   $year, $month, $day,
                   $hour, $mins, $secs);
  }
}

/**
 * @brief Remove separators and spaces on a timestamp string
 *
 * @param $string String
 *
 * @return Only numbers string
 *
 * @todo Make this function to remove the non-digits characters
 *       instead
 */
function FormatDateTimePlain($string)
{
  return preg_replace('/[\ A-Za-z:-]/', '', $string);
}


/**
 * @brief Formats a datetime array with user defined separators
 *
 * @param $date_arr     Date array; getdate() for example
 * @param $date_sep     Date separator (yyyy-mm-dd)
 * @param $time_sep     Time separator (hh:mm:ss)
 * @param $datetime_sep Separator between date and time
 *
 * @return Formated date string
 */
function FormatDateTime($date_arr     = array(),
                        $date_sep     = '-',
                        $time_sep     = ':',
                        $datetime_sep = ' ')
{
  if (empty($date_arr)) {
    $date_arr = getdate();
  }

  return sprintf('%04d%s%02d%s%02d%s%02d%s%02d%s%02d',
                 $date_arr['year'],
                 $date_sep,
                 $date_arr['mon'],
                 $date_sep,
                 $date_arr['mday'],

                 $datetime_sep,

                 $date_arr['hours'],
                 $time_sep,
                 $date_arr['minutes'],
                 $time_sep,
                 $date_arr['seconds']);
}

