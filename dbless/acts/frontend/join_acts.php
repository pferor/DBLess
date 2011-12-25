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
include($DIR_CONFIG  . 'site_admin.php'); /* Site administrators. */
include($DIR_CONFIG  . 'site_tech.php');  /* Site technical info. */
include($DIR_INCLUDE . 'values.php');     /* GetValueOrDefault(...) */
include($DIR_INCLUDE . 'datetime.php');   /* FormatDateTime(...) */
include($DIR_INCLUDE . 'file.php');       /* SaveFile(...) */
include($DIR_INCLUDE . 'mail.php');       /* isEmail(...) */
include($DIR_INCLUDE . 'html.php');       /* NoEntities(...) */


/* Language */
if (!isset($_GET['lang']) || !file_exists($DIR_POSTS . $_GET['lang'])) {
  $Language = $SITE_DEFAULT_LANGUAGE;
} else {
  $Language = $_GET['lang'];
}


/* Default URI, just if something went wrong */
$URI = '../..?pg=' . $_f_join_ .
  '&lang' . $Language;

/* RegisterLogin button pressed */
if (isset($_POST['bu_join'])) {
  $USERNAME  = $_POST['username'];
  $PASSWORD1 = $_POST['password1'];
  $PASSWORD2 = $_POST['password2'];
  $EMAIL     = $_POST['email'];
  $LANGUAGE  = $_POST['language'];
  $CSSSKIN   = $_POST['cssskin'];

  /* Avoid strange things */
  $USERNAME = NoEntities($USERNAME);
  $EMAIL    = NoEntities($EMAIL);
  $LANGUAGE = html2text($LANGUAGE);
  $CSSSKIN  = html2text($CSSSKIN);


  $err = ''; /* Data validates as long as $err is an empty string */
  /* err: No username given */
  if ($USERNAME == '') {
    $err .= '&username=blank';
  }
  /* err: No password given */
  if ($PASSWORD1 == '') {
    $err .= '&pass=blank';
  }
  /* err: Password cannot be the username */
  if ($PASSWORD1 == $USERNAME) {
    $err .= '&pass=same';
  }
  /* err: Passwords do not match */
  if ($PASSWORD1 != $PASSWORD2) {
    $err .= '&pass=match';
  }
  /* err: bad E-mail */
  if ($EMAIL != '' && !isEmail($EMAIL)) {
    $err .= '&email=bad';
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
      '&plang='  . urlencode($LANGUAGE) .
      '&pstyle=' . urlencode($CSSSKIN);
    $URI .= $err . $info;
  }
  else {
    /* Do the register actions here */

    /* First of all, usernamea in case insensitive */
    $UserDirectory = $DIR_USERS . sha1(strtolower($USERNAME));

    /* 1. Check username does not exist */
    if (file_exists($UserDirectory) || in_array($USERNAME, $SITE_ADMINS_ARR)) {
      $info = '&tusername=' . urlencode($USERNAME) .
        '&temail=' . urlencode($EMAIL) .
        '&plang='  . urlencode($LANGUAGE) .
        '&pstyle=' . urlencode($CSSSKIN);
      $err .= '&join=userexists';
      $URI .= $err . $info;
    }
    else {
      /* 2. Check directory can be created */
      if (@mkdir($UserDirectory)) {

        /* 3. Create info.php */
        $_SIGN_UP_DATE = FormatDateTime(); /* Sets current date and
                                            * time by using
                                            * getdate() */
        $UserInfoFileContent = '<?php' . "\n" .
          '$_USER_NAME      = ' . "'" . $USERNAME        . "'" . ';' . "\n" .
          '$_USER_PASS_SHA1 = ' . "'" . sha1($PASSWORD1) . "'" . ';' . "\n" .
          '$_USER_EMAIL     = ' . "'" . $EMAIL           . "'" . ';' . "\n" .
          '$_SIGN_UP_DATE   = ' . "'" . $_SIGN_UP_DATE   . "'" . ';' . "\n" .
          '?>';
        SaveFile($UserDirectory . '/' . $FILE_USER_INFO,
                 $UserInfoFileContent);

        /* 4. Create config.php */
        $UserInfoFileContent = '<?php' . "\n" .
          '$_USER_LANG    = ' . "'" . $LANGUAGE . "'" . ';' . "\n" .
          '$_USER_CSSSKIN = ' . "'" . $CSSSKIN  . "'" . ';' . "\n" .
          '?>';
        SaveFile($UserDirectory . '/' . $FILE_USER_CONFIG,
                 $UserInfoFileContent);
      }
      else {
        @rmdir($UserDirectory);

        $err = '&join=perms';

        $info = '&tusername=' . urlencode($USERNAME) .
          '&temail=' . urlencode($EMAIL)    .
          '&plang='  . urlencode($LANGUAGE) .
          '&pstyle=' . urlencode($CSSSKIN);
        $URI .= $err . $info;
      }

      /* --- Log action --- */
      if ($LOG_ACTION) {
        $log_msg = 'A new user account was *created* by ' . $USERNAME;
        AppendToLog($FILE_LOG, $log_msg);
      }
      /* --- Log action --- */


     /* Go to login page instead... */
      $URI = '../..?pg=' . $_f_login_ .
        '&lang' . $Language;
      $URI .= '&join=created';
    }
  }
}


/* Redirect automatically */
header('Location: ' . $URI);

