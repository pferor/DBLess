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
include($DIR_INCLUDE . 'values.php');   /* GetValueOrDefault(...) */
include($DIR_INCLUDE . 'file.php');     /* SaveFile(...) */
include($DIR_INCLUDE . 'mail.php');     /* isEmail(...) */
include($DIR_INCLUDE . 'html.php');      /* NoEntities(...) */


/* Language */
if (!isset($_GET['lang']) || !file_exists($DIR_POSTS.$_GET['lang'])) {
  $Language = $SITE_DEFAULT_LANGUAGE;
} else {
  $Language = $_GET['lang'];
}


/* Default URI, just if something went wrong */
$URI = '../..?pg=' . $_f_profile_ .
  '&lang=' . $Language;

/* Proflle button preseed */
if (isset($_POST['bu_profile'])) {
  $USERNAME  = $_POST['username'];
  $PASSWORD  = $_POST['password'];
  $EMAIL     = $_POST['email'];
  $LANGUAGE  = $_POST['language'];
  $CSSSKIN   = $_POST['cssskin'];

  /* Avoid strange things */
  $USERNAME = NoEntities($USERNAME);
  $EMAIL    = NoEntities($EMAIL);
  $LANGUAGE = html2text($LANGUAGE);
  $CSSSKIN  = html2text($CSSSKIN);

  /* Sets the user dir. */
  $UserDirectory = $DIR_USERS . sha1(strtolower($USERNAME));

  $err = ''; /* Data validates as long as $err is an empty string */
  /* err: No username given */
  if ($USERNAME == '') {
    $err .= '&username=blank';
  }
  /* err: There is no folder for that user, and this is strange since
   * at this point the user must be logged in. */
  if (!file_exists($UserDirectory)) {
    $err .= '&username=bad';
  }
  /* err: No message body */
  if ($PASSWORD == '') {
    $err .= '&pass=blank';
  }
  /* err: bad E-mail */
  if ($EMAIL != '' && !isEmail($EMAIL)) {
    $err .= '&email=bad';
  }

  /* Retrieve user info. here */
  include($UserDirectory . '/' . $FILE_USER_INFO);
  include($UserDirectory . '/' . $FILE_USER_CONFIG);

  /* This is inmutable data */
  $Original_SignupDate = $_SIGN_UP_DATE;


  /* err: bad name */
  if (strtolower($USERNAME) != strtolower($_USER_NAME)) {
    $err .= '&username=corrupt';
  }
  /* err: password is incorrect */
  if (sha1($PASSWORD) != $_USER_PASS_SHA1) {
    $err .= '&pass=bad';
  }

  /* If data does not validate... */
  if ($err != '') {
    $info = '&temail=' . urlencode($EMAIL) .
      '&plang=' . urlencode($LANGUAGE) .
      '&pstyle=' . urlencode($CSSSKIN);
    $URI .= $err . $info;
  }
  else {
    /* Make some corrections */

    /* 1. Create info.php */
    $UserInfoFileContent = '<?php' . "\n" .
      '$_USER_NAME      = ' . "'" . $USERNAME              . "'" . ';' . "\n" .
      '$_USER_PASS_SHA1 = ' . "'" . sha1($PASSWORD)        . "'" . ';' . "\n" .
      '$_USER_EMAIL     = ' . "'" . $EMAIL                 . "'" . ';' . "\n" .
      '$_SIGN_UP_DATE   = ' . "'" . $Original_SignupDate   . "'" . ';' . "\n" .
      '?>';
    SaveFile($UserDirectory . '/' . $FILE_USER_INFO,
             $UserInfoFileContent);

    /* 2. Create config.php */
    $UserInfoFileContent = '<?php' . "\n" .
      '$_USER_LANG    = ' . "'" . $LANGUAGE . "'" . ';' . "\n" .
      '$_USER_CSSSKIN = ' . "'" . $CSSSKIN  . "'" . ';' . "\n" .
      '?>' . "\n";
    SaveFile($UserDirectory . '/' . $FILE_USER_CONFIG,
             $UserInfoFileContent);

    /* Update language */
    $Language = $LANGUAGE;
    $URI = '../..?pg=' . $_f_profile_ .
      '&lang=' . $Language;


    /* --- Log action --- */
    if ($LOG_ACTION) {
      $log_msg = $USERNAME . ' has requested updated his/her profile';
      AppendToLog($FILE_LOG, $log_msg);
    }
    /* --- Log action --- */

    $URI .= '&profile=updated';
  }
}
/* Proflle password preseed */
else if (isset($_POST['bu_profile_password'])) {
  $PASSWORD0 = $_POST['password0'];
  $PASSWORD1 = $_POST['password1'];
  $PASSWORD2 = $_POST['password2'];
  $USERNAME  = $_POST['username_hidden'];


  $err = ''; /* Data validates as long as $err is an empty string */

  $UserDirectory = $DIR_USERS . sha1(strtolower($USERNAME));
  /* err: There is no folder for that user, and this is strange since
   * at this point the user must be logged in. */
  if (!file_exists($UserDirectory)) {
    $err .= '&username=bad';
  }

  /* Retrieve user info. here */
  include($UserDirectory . '/' . $FILE_USER_INFO);

  /* err: No password given */
  if ($PASSWORD0 == '') {
    $err .= '&pass0=blank';
  }
  /* err: password is incorrect */
  elseif (sha1($PASSWORD0) != $_USER_PASS_SHA1) {
    $err .= '&pass0=bad';
  }

  /* err: Password cannot be the username */
  if ($PASSWORD1 == $USERNAME) {
    $err .= '&pass2=same';
  }
  /* err: No password given */
  else if ($PASSWORD1 == '') {
    $err .= '&pass2=blank';
  }
  /* err: Passwords do not match */
  else if ($PASSWORD1 != $PASSWORD2) {
    $err .= '&pass2=match';
  }


  if ($err != '') {
    $URI .= $err;
  }
  else {
    /* Update password here */
    /* 1. Create info.php */
    $UserInfoFileContent = '<?php' . "\n" .
      '$_USER_NAME      = ' . "'" . $USERNAME        . "'" . ';' . "\n" .
      '$_USER_PASS_SHA1 = ' . "'" . sha1($PASSWORD1) . "'" . ';' . "\n" .
      '$_USER_EMAIL     = ' . "'" . $_USER_EMAIL     . "'" . ';' . "\n" .
      '$_SIGN_UP_DATE   = ' . "'" . $_SIGN_UP_DATE   . "'" . ';' . "\n" .
      '?>';
    SaveFile($UserDirectory . '/' . $FILE_USER_INFO,
             $UserInfoFileContent);

    /* --- Log action --- */
    if ($LOG_ACTION) {
      $log_msg = $USERNAME . ' changed his/her password';
      AppendToLog($FILE_LOG, $log_msg);
    }
    /* --- Log action --- */


    $URI .= '&password=updated';
  }

}


/* Redirect automatically */
header('Location: ' . $URI);

