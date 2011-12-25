<?php
/**
 * @file file.php
 *
 * @brief File management, save, etc.
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
 * @brief Creates a new file
 *
 * @param $filename Filename to save
 * @param $content  Content within the file
 * @param $fmode    Write mode, set to 'w+' by default
 *
 * @return @e false if the file cannot be created, or otherwise
 */
function SaveFile($filename, $content, $fmode = 'w+')
{
  /* 'w+': Open for reading and writing; place the file pointer at the
   *       beginning of the file and truncate the file to zero
   *       length. If the file does not exist, attempt to create
   *       it. */

  /* Make sure the file exists and is writable first */
/*
  if (is_writable($filename)) {
*/
    if (!$handle = fopen($filename, $fmode)) {
      echo 'Cannot open file "' . $filename . '"';
      return false;
    }

    /* Write content $content to our opened file. */
    if (fwrite($handle, $content) === false) {
      echo 'Cannot write to file "' . $filename . '"';
      return false;
    }

    /* Success, wrote file '$filename' */
    fclose($handle);
    return true;
/*
  } else {
    echo 'The file "' . $filename . '" is not writable';
    return false;
  }
*/
}


/**
 * @brief Appends a message to a file
 *
 * @param $file      File where the message will be appended
 * @param $msg       Message to append
 * @param $timestamp Display timestamp?
 * @param $nl        Appendsa a new line after the message?
 *
 * @return @c true if the message was successfully appended, or
 *         @c false otherwise
 *
 * @note This file is intended to be a log and a each one of them
 *       need a timestamp. The function @e FormatDateTime from
 *       @c datetime.php is used in order to display a proper
 *       timestamp.
 *
 * @todo Check what happens If file does not exist. Does the 'a+' mode
 *       creates one file with the right permissions?
 *
 * @see datetime.php
 */
function AppendToLog($file,
                     $msg,
                     $timestamp = true,
                     $nl = true)
{
  if ($timestamp) {
    $separator = ' :: ';
    $log_msg   = '[' . FormatDateTime() . ']' . $separator . $msg;
  }
  else {
    $log_msg = $msg;
  }

  /* Add new line */
  if ($nl) {
    $log_msg .= "\n";
  }

  /* Save the log file */
  /* 'a+': Open for reading and writing; place the file pointer at the
   *       end of the file. If the file does not exist, attempt to
   *       create it. */
  return SaveFile($file, $log_msg, 'a+');
}


/**
 * @brief Checks if a directory is empty
 *
 * @param $dir Directory to check out
 *
 * @return @c true if the directory is empty, @c false otherwise
 */
function isEmptyDir($dir)
{
  return (($files = @scandir($dir)) && count($files) <= 2);
}


/**
 * @brief Removes recursively a directory if exists
 *
 * @param $dir Directory to remove
 *
 * @return Returns @c true on success or @c false on failure
 *
 * @note This function was done in lowercase_dash_separated format to
 *       make an analogy to @c rmdir
 */
function rmdir_recursive($dir)
{
  if (!file_exists($dir) || !is_dir($dir)) {
    return false;
  }

  $objects = scandir($dir);

  foreach ($objects as $object) {
    if ($object != "." && $object != "..") {
      if (filetype($dir . "/" . $object) == "dir") {
        rmdir_recursive($dir . "/" . $object);
      } else {
        unlink($dir . "/" . $object);
      }
    }
  } /* foreach($objects... */

  reset($objects);
  return rmdir($dir);
}


/**
 * @brief Gives a size in human readable form
 *
 * @param $size      Size to transform to human readable
 * @param $retstring Return string format
 *
 * @return Size in human readable format
 */
function SizeReadable($size, $retstring = null)
{
  $sizes = array(  'B', 'kiB', 'MiB', 'GiB',
                 'TiB', 'PiB', 'EiB', 'ZiB',
                 'YiB');

  if ($retstring === null) {
    $retstring = '%01.2f %s';
  }

  $lastsizestring = end($sizes);
  foreach ($sizes as $sizestring) {
    if ($size < 1024) {
      break;
    }
    if ($sizestring != $lastsizestring) {
      $size /= 1024;
    }
  }

  /* Bytes aren't normally fractional */
  if ($sizestring == $sizes[0]) {
    $retstring = '%01d %s';
  }

  return sprintf($retstring, $size, $sizestring);
}


/**
 * @brief Displays the content of a file
 *
 * @param $file Filename where is the content to show
 *
 * @return Text content on file as a big string converted to HTML
 */
function ShowFileContent($file)
{
  $fp   = fopen($file, "r");
  $text = fread($fp, filesize($file));
  $text = nl2br($text);

  fclose($fp);

  return $text;
}

