<?php
/**
 * @file html.php
 *
 * @brief HTML transformation routines
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
 * @brief Converts HTML to plain text, i.e.,
 *
 * @param $html HTML code to convert
 *
 * @return Plain text version of $html
 *
 * @note This function was done in lowercase format to make an analogy
 *       to @c htmlspecialchars and @c htmlentities.  Also, it
 *       remainds me to the GNU/Linux command of the same name.
 */
function html2text($html)
{
  $tags = array (
                 0 => '~<h[123][^>]+>~si',
                 1 => '~<h[456][^>]+>~si',
                 2 => '~<table[^>]+>~si',
                 3 => '~<tr[^>]+>~si',
                 4 => '~<li[^>]+>~si',
                 5 => '~<br[^>]+>~si',
                 6 => '~<p[^>]+>~si',
                 7 => '~<div[^>]+>~si',
                 );

  $html = preg_replace($tags,                           "\n",  $html);
  $html = preg_replace('~</t(d|h)>\s*<t(d|h)[^>]+>~si', ' - ', $html);
  $html = preg_replace('~<[^>]+>~s',                    '',    $html);

  /* reducing spaces */
  $html = preg_replace('~ +~s',                         ' ',   $html);
  $html = preg_replace('~^\s+~m',                       '',    $html);
  $html = preg_replace('~\s+$~m',                       '',    $html);

  /* reducing newlines */
  $html = preg_replace('~\n+~s',                        "\n",  $html);

  return $html;
}


/**
 * @brief Prepares a string to be used on a search function
 *
 * @param $text Text to normalize
 *
 * @return Normalized string
 *
 * @note The normalization process is the following:
 *   1. Remove HTML commentaries
 *   2. Remove non alphanumeric characters
 *   3. Remove carriage return characters
 *   4. Remove extra white spaces between words
 */
function NormalizeString($text)
{
  $CR = array("\r\n", "\r", "\n");

  /* Remove HTML commentaries */
  $text = preg_replace('/<!--(.|\s)*?-->/', '',  $text);

  /* Remove non alphanumerical characters */
  $text = preg_replace('/[^a-zA-Z0-9\s]/', '',  $text);

  /* Replace carriage returns */
  $text = str_replace($CR, ' ', $text);

  /* Remove several spaces */
  $text = RemoveRepeatedChars($text, ' ');

  return $text;
}


/**
 * @brief Remove HTML special characters
 *
 * @param $html HTML to tranform
 * @param $trim If @c true, trim the string too
 *
 * @return String without HTML entities
 *
 */
function NoEntities($html, $trim = true)
{
  $str = ($trim) ? trim($html) : $html;

  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


/**
 * @brief Replace dangerous quotes for HTML code. The rest of the
 * entities are intact
 *
 * @param $html String to replace in
 * @param $trim If @c true, trim the string too
 *
 * @return Intput HTML string without dangerous quotes
 *
 * @note In this project the PHP quotes convention used is strong
 *       quotes always (') except when refering to escape sequences
 *       and quotation within quotation. So when the uses enters some
 *       text that need to be recognized as HTML, the strong quotes
 *       are converted to HTML characters in order to prevent
 *       conflicts with PHP. Soft quotes (") are not transformed
 *       because they are needed in HTML, and this function expects an
 *       HTML output.
 */
function NoQuotes($html, $trim = true)
{
  $str = ($trim) ? trim($html) : $html;

  /* "'" to "&#039;" */
  $str = str_replace("'", '&#039;', $str);

  return $str;
}


/**
 * @brief Just do the opposite of nl2br
 *
 * @param $string Input string
 *
 * @return String with new lines instead of <BR> tags
 */
function br2nl($string)
{
  return preg_replace('/<br\\s*?\/??>/i', '', $string);
}

