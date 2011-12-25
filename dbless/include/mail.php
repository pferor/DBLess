<?php
/**
 * @file mail.php
 *
 * @brief Mail routines
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
 * @brief Check if a string is a valid E-mail
 *
 * @param $email E-mail to check
 *
 * @rerurn @c true if $mail is a well-formed E-mail, @c false
 *         otherwise
 */
function isEmail($email)
{
  return preg_match('|^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$|i',
                    $email);
}


/**
 * @brief Sends a mail in UTF-8
 *
 * @param $to      Receiver, or receivers of the mail
 * @param $subject Subject of the email to be sent
 * @param $message Message to be sent
 * @param $header  String to be inserted at the end of the email header
 *
 * @return Returns @c true if the mail was successfully accepted for
 *         delivery, @c false otherwise.
 */
function mail_utf8($to,
                   $subject = '(No subject)',
                   $message = '',
                   $header  = '')
{
  $header_ = 'MIME-Version: 1.0' .
    "\r\n" . 'Content-type: text/plain; charset=UTF-8' .
    "\r\n";

  return mail($to, '=?UTF-8?B?' .
              base64_encode($subject) . '?=',
              $message, $header_ . $header);
}

