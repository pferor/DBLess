<?php
/**
 * @file contact_acts.php
 *
 * @brief Contact form actions
 */

$DIR_LEVEL = 2;
require_once('../../localcfg.php');
include($DIR_CONFIG  . 'dirs.php');
include($DIR_CONFIG  . 'pages_ids.php');
include($DIR_CONFIG  . 'site_admin.php');
include($DIR_CONFIG  . 'site_tech.php');  /* Site technical info. */
include($DIR_INFO    . 'site_name.php');
include($DIR_INCLUDE . 'mail.php');       /* isEmail(...), mail_utf8(...) */
include($DIR_INCLUDE . 'html.php');       /* NoEntities(...) */
include($DIR_INCLUDE . 'values.php');     /* GetValueOrDefault(...) */


/* Language */
if (!isset($_GET['lang']) || !file_exists($DIR_POSTS.$_GET['lang'])) {
  $Language = $SITE_DEFAULT_LANGUAGE;
} else {
  $Language = $_GET['lang'];
}


/* Default URI, just if something went wrong */
$URI = '../..?pg=' . $_f_contact_ .
  '&lang=' . $Language;

/* Contact button pressed */
if (isset($_POST['bu_send'])) {
  $USERNAME = $_POST['username'];
  $EMAIL    = $_POST['email'];
  $MESSAGE  = $_POST['message'];

  /* Avoid strange things */
  $USERNAME = NoEntities($USERNAME);
  $EMAIL    = NoEntities($EMAIL);
  $MESSAGE  = NoEntities($MESSAGE);

  /* Do not accept '\r' or "\n" characters in username or email */

  $err = ''; /* Data validates as long as $err is an empty string */
  /* err: No username given */
  if ($USERNAME == '' || preg_match('/[\r\n]/', $USERNAME)) {
    $err .= '&username=blank';
  }
  /* err: bad E-mail */
  if ($EMAIL != '' && !isEmail($EMAIL)) {
    $err .= '&email=bad';
  }
  if (preg_match('/[\r\n]/', $USERNAME)) {
    $err .= '&email=bad';
  }
  /* err: No message body */
  if ($MESSAGE == '') {
    $err .= '&msg=blank';
  }

  session_start();
  if (!$_SESSION['DBL_LoggedIn']) {
      $CAPTCHA  = $_POST['captcha'];

      if (!isset($_SESSION['DBL_Captcha']) ||
          $_SESSION['DBL_Captcha'] == '') {
        $err .= '&captcha=nocookie';
      }
      else if ($_SESSION['DBL_Captcha'] != $CAPTCHA) {
        $err .= '&captcha=bad';
      }
  }

  /* If data does not validate... */
  if ($err != '') {
    $info = '&tusername=' . urlencode($USERNAME) .
      '&temail=' . urlencode($EMAIL) .
      '&tmsg='   . urlencode($MESSAGE);
    $URI .= $err . $info;
  }
  else {
    $MESSAGE .= "\n"; /* Adds a new line after
                         trim. */
    /* Send a mail. The admin address is on `~/config/site_tech.php' */
    if (isEmail($SITE_CONTACT_EMAIL)) {
      /* Sending... */
      $sender_email = html2text(GetValueOrDefault($EMAIL, 'null@null-address.com'));
      $recipient    = html2text($SITE_CONTACT_EMAIL);
      $subject      = html2text($SITE_SHORT_NAME);
      $mail_body    = nl2br(NoEntities($MESSAGE));
      $header       = 'From: ' . html2text($USERNAME) . ' <' . $sender_email . '>' . "\r\n";

      if (@mail_utf8($recipient, $subject, $mail_body, $header)) {
        $URI .= '&mail=sent';
      }
      else {
        $URI .= '&mail=fail';
      }

    } /* if (isEmail(... */
  } /* else (if $err == ''); if there are no errors */
}


/* Redirect automatically */
header('Location: ' .$URI);

