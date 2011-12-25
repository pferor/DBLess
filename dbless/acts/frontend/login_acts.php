<?php
/**
 * @file login_acts.php
 *
 * @brief Log in form actions
 */

$DIR_LEVEL = 2;
require_once('../../localcfg.php');
include($DIR_CONFIG  . 'dirs.php');
include($DIR_CONFIG  . 'pages_ids.php');
include($DIR_CONFIG  . 'site_tech.php'); /* Site technical info. */
include($DIR_INFO    . 'site_name.php');
include($DIR_INCLUDE . 'values.php');    /* GetValueOrDefault(...) */
include($DIR_INCLUDE . 'common.php');    /* GeneratePassword(...) */
include($DIR_INCLUDE . 'file.php');      /* SaveFile(...) */
include($DIR_INCLUDE . 'mail.php');      /* isEmail(...) */
include($DIR_INCLUDE . 'html.php');      /* isEmail(...), NoEntities(...) */

/* Language */
if (!isset($_GET['lang']) || !file_exists($DIR_POSTS.$_GET['lang'])) {
  $Language = $SITE_DEFAULT_LANGUAGE;
} else {
  $Language = $_GET['lang'];
}


/* Default URI, just if something went wrong */
$URI = '../..?pg=' . $_f_login_ .
  '&lang=' . $Language;

/* This file needs to use the language file in order to fill the
 * mail */
include($DIR_LANGS_FRONTEND . $Language . '.php');


/* Login button pressed */
if (isset($_POST['bu_login'])) {
  $USERNAME = $_POST['username'];
  $PASSWORD = $_POST['password'];

  /* Avoid strange things */
  $USERNAME = NoEntities($USERNAME);

  /* Set user files */
  $UserInfoFile   = $DIR_USERS . sha1(strtolower($USERNAME)) .
    '/' . $FILE_USER_INFO;   /* username, email,... */
  $UserConfigFile = $DIR_USERS . sha1(strtolower($USERNAME)) .
    '/' . $FILE_USER_CONFIG; /* lang, skin,... */

  $err = ''; /* Data validates as long as $err is an empty string */
  /* err: No username given */
  if ($USERNAME == '') {
    $err .= '&username=blank';
  }
  /* err: No password given */
  if ($PASSWORD == '') {
    $err .= '&password=blank';
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

  /* err: User does not exist*/
  if ($USERNAME == '' || !file_exists($UserInfoFile)) {
    if (strpos($err, 'blank') === false) {
      $err .= '&login=bad';
    }
  } else {
    if ($err == '') {
      include($UserInfoFile);
      if (file_exists($UserConfigFile)) {
        /* This file is optional, if the variables in it are NULL,
         * void, or are not declared at all, the default values will be
         * used instead. */
        include($UserConfigFile);
      }
      /* err: Username is OK, but password isn't */
      if ($_USER_PASS_SHA1 != sha1($PASSWORD)) {
        if (strpos($err, 'blank') === false) {
          $err .= '&login=bad';
        }
      }
      /* err: Corrupted file -> A user file is corrupted if the SHA1
       * encryption of the variable $_USER_NAME has not the same value as the
       * firectory */
      else if (strtolower($USERNAME) != strtolower($_USER_NAME)) {
        $err .= '&login=corrupt';
      /* Everything is OK */
      } else {
        /****/
        // SET THE LOGIN COOKIE!!!
        /****/
        session_start();
        $_SESSION['DBL_LoggedIn'] = true;
        $_SESSION['DBL_Username'] = $USERNAME;

	/* --- Log action --- */
	if ($LOG_ACTION) {
	  $log_msg = $USERNAME . ' logged in';
	  AppendToLog($FILE_LOG, $log_msg);
	}
	/* --- Log action --- */

        /* Go to front page as a winner! */
        $lang = GetValueOrDefault($_USER_LANG, $Language);
        $URI  = '../..?pg=' . $_f_front_ .
          '&lang=' . $Language;
      }
    }
  }

  /* If data does not validate... */
  if ($err != '') {
    $info = '&tusername=' . urlencode($USERNAME);
    $URI .= $err . $info;
  }
}
/* Password recovery button */
else if (isset($_POST['bu_lost_password'])) {
  $USERNAME = $_POST['username'];

  $err = ''; /* Data validates as long as $err is an empty string */
  /* err: No username given */
  if ($USERNAME == '') {
    $err .= '&username=blank';
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


  if ($err != '') {
    $info = '&tusername=' . urlencode($USERNAME);
    $URI .= $err . $info;
  }
  else {
    /* Check if username exists */
    $UserDirectory = $DIR_USERS . sha1($USERNAME);

    /* Check username does not exist */
    if (!file_exists($UserDirectory)) {
      $info = '&tusername=' . urlencode($USERNAME);
      $err .= '&username=notexists';
      $URI .= $err . $info;
    }
    else {
      include($UserDirectory . '/' . $FILE_USER_INFO);
      if (!isEmail($_USER_EMAIL)) {
        $info = '&tusername=' . urlencode($USERNAME);
        $err .= '&email=none';
        $URI .= $err . $info;
      }
      else {
        /* Change passwowrd for a random one */
        $NEW_PASSWORD = GeneratePassword(8);

        /* Send password via E-mail */
        $no_reply_email = 'no.reply@reply.no';
        $sender_email   = $no_reply_email;
        $recipient      = $_USER_EMAIL;
        $subject        = $SITE_SHORT_NAME . ' - ' . $LostPassword['Subject_text'];
        $mail_body      = $LostPassword['Subject_text'] . "\r\n" .
          $LostPassword['Body_text']  .
          $NEW_PASSWORD    . "\r\n\n" .
          $SITE_SHORT_NAME . "\r\n"   .
          $SITE_LONG_NAME;
        $header       = 'From: ' . $SITE_SHORT_NAME . ' <' . $no_reply_email . '>' . "\r\n";

        if (mail_utf8($recipient, $subject, $mail_body, $header)) {
          /* Save new user file with new pasword */
          $UserInfoFileContent = '<?php' . "\n" .
            '$_USER_NAME      = ' . '"' . $_USER_NAME         . '"' . ';' . "\n" .
            '$_USER_PASS_SHA1 = ' . '"' . sha1($NEW_PASSWORD) . '"' . ';' . "\n" .
            '$_USER_EMAIL     = ' . '"' . $_USER_EMAIL        . '"' . ';' . "\n" .
            '?>' . "\n";
          SaveFile($UserDirectory . '/' . $FILE_USER_INFO,
                   $UserInfoFileContent);

          /* --- Log action --- */
          if ($LOG_ACTION) {
            $log_msg = $USERNAME . ' has requested a new password';
            AppendToLog($FILE_LOG, $log_msg);
          }
          /* --- Log action --- */

          $info = '&tusername=' . urlencode($USERNAME);
          $URI .= $info . '&mail=sent';
        }
        else {
          $info = '&tusername=' . urlencode($USERNAME);
          $URI .= $info . '&mail=fail';
        }
      } /* valid email */
    } /* valid username */
  } /* no errors */
}


/* Redirect automatically */
header('Location: ' . $URI);

