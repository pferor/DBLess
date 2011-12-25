<?php
/**
 * @file en.php
 *
 * @brief English language file
 */


/* Language file information */
$LangCharset = 'utf-8';
$LangTextDir = 'ltr';


/* Site navigation */
$Navigation = array(
                    'Admin_text'          => 'Administration',
                    'Admin_title'         => 'Site administration',
                    'Home_text'           => 'Home',
                    'Home_title'          => 'Front page',
                    'Archive_text'        => 'Archive',
                    'Archive_title'       => 'Posts archive',
                    'About_text'          => 'About...',
                    'About_title'         => 'About',
                    'Contact_text'        => 'Contact',
                    'Contact_title'       => 'Contact form',
                    'Syndication_text'    => 'Syndication',
                    'Syndication_title'   => 'RSS syndication',
                    'Join_text'           => 'Create account',
                    'Join_title'          => 'Create a new account',
                    'Login_text'          => 'Log in',
                    'Login_title'         => 'Log in',
                    'Profile_text'        => 'Preferences',
                    'Profile_title'       => 'User preferences',
                    'Logout_text'         => 'Log out',
                    'Logout_title'        => 'Log out',
                    'SearchResults_text'  => 'Filter results',
                    'TagsResults_text'    => 'Tags results',
                    'BackendLink_text'    => 'Administration',
                    'BackendLink_title'   => 'Site administration'
                    );

/* Info in forms */
$FormsInfo = array(
                   'LostPassword_info'    => 'All fields are required except the password if you are trying o recover it.',
                   'LostPassword_warning' => 'You must have indicated an e-mail address to reset your password.',
                   'Logout_info'          => 'To terminate your session and disconnect from this site click the “Log out” button.',
                   'Logout_warning'       => '',
                   'Logout_OK'            => 'You are now logged out. It is recommended that you close your browser and remove the cookies to complete the termination of this session',
                   'Login_info'           => 'This form allows you to enter with your username and password. If you don’t have an account yet, you must create one. This form is case sensitive.',
                   'Login_warning'        => 'You must have cookies enabled to log in.',
                   'LoginToRegister_link' => 'Don’t have an account? Create a new one.',
                   'RegisterToLogin_link' => 'Already have an account? Log in.',
                   'Register_info'        => 'E-mail address is optional, but it’s needed for password resets, should you forget your password. This form is case sensitive.',
                   'Register_warning'     => 'Offensive, promotional, deliberately misleading or defamatory usernames may be blocked permanently.',
                   'Contact_info'         => 'E-mail address is optional, but it’s needed if a reply is expected.',
                   'Contact_warning'      => '',
                   'Profile_info'         => 'Basic information.',
                   'Profile_warning'      => 'You need to enter your password to authenticate your identity and avoid abuses.',
                   'ProfilePass_info'     => 'Change account password.',
                   'ProfilePass_warning'  => '',
                   'NoCommentsYet_info'   => 'There are no comments in this post... yet.',
                   'Comments_info'        => '',
                   'Comments_warning'     => 'You need to be logged in in order to comment.'
                   );


/* Posts naveigation */
$Post = array(
              'Older_text'  => 'Older posts',
              'Older_title' => 'Older pots',
              'Newer_text'  => 'Newer posts',
              'Newer_title' => 'Newer posts',
              'More_text'   => 'More',
              'More_title'  => 'More',
              'Tags_text'   => 'Tags',
              'Tags_title'  => 'Tags'
              );


/* Site archive */
$Results = array(
                 'Title_text'       => 'Title',
                 'Description_text' => 'Description',
                 'DateTime_text'    => 'Date and time',
                 'Author_text'      => 'Author'
                 );


/* Forms */
$Form = array(
              'Name_text'          => 'Name',
              'Name_title'         => 'Username',
              'Email_text'         => 'E-mail',
              'Email_title'        => 'E-mail',
              'Message_text'       => 'Text',
              'Message_title'      => 'Text',
              'Captcha_text'       => 'Code',
              'Captcha_title'      => 'Code',
              'PasswordLost_text'  => 'E-mail new password',
              'PasswordLost_title' => 'Password lost. E-mail new password',
              'Password_text'      => 'Password',
              'Password_title'     => 'Password',
              'Password0_text'     => 'Current password',
              'Password0_title'    => 'Current password',
              'Password1_text'     => 'New password',
              'Password1_title'    => 'New password',
              'Password2_text'     => 'Retype password',
              'Password2_title'    => 'Retype password',
              'Submit_text'        => 'Sumbit',
              'Submit_title'       => 'Submit form',
              'Search_text'        => 'Filter',
              'Search_title'       => 'Filter posts',
              'Lang_text'          => 'Site language',
              'Lang_title'         => 'Language in which this site will be displayed for this user',
              'Skin_text'          => 'Style',
              'Skin_title'         => 'Style in which this site will be displayed for this user',
              'Comment_text'       => 'Comment',
              'Comment_title'      => 'Comment',
              'Anonymous_text'     => 'Anonymous',
              'Delete_text'        => 'Delete',
              'Delete_title'       => 'Delete'
              );


/* Page 'about...' */
$About = array(
               'Content' => '<p>All about About...</p>'
               );


/* Validation links */
$Validation = array(
                    'Valid_XHTML' => 'Valid XHTML',
                    'Valid_CSS'   => 'Valid CSS',
                    'Valid_RSS'   => 'Vaid RSS',
                    'Valid_WCAG'  => 'Conformity level AA'
                    );


/* Error messages */
$Messages = array(
                  'Cannot_Perform_err'         => 'Error. Plase contact the webmaster.',
                  'Message_Sent_err'           => 'The message was not delivered. Try again in a few minutes.',
                  'Message_Sent_suc'           => 'Message was delivered successfully.',
                  'Account_Created_suc'        => 'Account created successfully. Please, log in.',
                  'NoPosts_err'                => 'There are no posts.',
                  'NoSearch_err'               => 'There were no results matching the query.',
                  'NoTag_err'                  => 'Thera are no posts for this tag.',
                  'Int_NotFound_err'           => 'The page you are trying to access is not here.',
                  'Bad_Captcha_err'            => 'Incorrect or missing confirmation code.',
                  'Bad_Username_err'           => 'The username does not exist. Please contact the webmaster.',
                  'No_Email_err'               => 'There is no E-mail account for this user.',
                  'Blank_Username_err'         => 'You have not specified a valid user name.',
                  'Taken_Username_err'         => 'Username entered already in use. Please choose a different name.',
                  'Bad_Password_err'           => 'The passowrd is not correct',
                  'Blank_Password_err'         => 'There is no password. Please try again.',
                  'Short_Password_err'         => 'Passwords must be at least 1 character.',
                  'PasswordIsName_err'         => 'Your password must be different from your username.',
                  'Match_Password_err'         => 'The passwords you entered do not match.',
                  'Corrupt_File_err'           => 'This user account is corrupted. Please contact the webmaster.',
                  'Bad_Login_err'              => 'One or both fields are incorrect. Please try again.',
                  'Bad_Email_err'              => 'The e-mail address cannot be accepted as it appears to have an invalid format. Please enter a well-formatted address or empty that field.',
                  'Blank_Text_err'             => 'There is no text, try again.',
                  'Blank_Comment_err'          => 'There is no comment, try again.',
                  'Login_Cannot_err'           => 'There is a session on course. In order to log in as another user, first you have to log out.',
                  'Profile_Cannot_err'         => 'Nobody is logged in.',
                  'Comment_Cannot_err'         => 'You have to log in in order to comment.',
                  'Comment_Closed_err'         => 'This post is closed to comments.',
                  'Comment_Sent_suc'           => 'Your comment has beed added.',
                  'Comment_Sent2suc'           => 'Your comment will be added after moderation.',
                  'Comment_Deleted_suc'        => 'Your comment has been deleted.',
                  'Comment_Delete_Cannot_err'  => 'The comment could not be deleted. Try again after a few minutes.',
                  'Profile_Updated_suc'        => 'Preferences saved successfully.',
                  'Password_New_suc'           => 'The password has been modified.',
                  'NoCookies_err'              => 'Cookies are not allowed. Enable them and try again.'
                  );


/* Some fields in the recovery password mail */
$LostPassword = array(
                      'Subject_text' => 'Password recovery.',
                      'Body_text'    => 'Your new password is: '
                      );

