<?php
/*
 * @file smarty_lang.php
 *
 * @brief Language strings passed to Smarty
 *
 * @detail Variables assigned to frontend languages using Smarty. If
 *         new language entries are added, there must be added here
 *         too. In this file will be included *only* language entries
 *         needed in `.tpl' files.
 */

$smarty->assign('Navigation',
                array(
                      'Home_text'           => $Navigation['Home_text'],
                      'Home_title'          => $Navigation['Home_title'],
                      'Archive_text'        => $Navigation['Archive_text'],
                      'Archive_title'       => $Navigation['Archive_title'],
                      'About_text'          => $Navigation['About_text'],
                      'About_title'         => $Navigation['About_title'],
                      'Contact_text'        => $Navigation['Contact_text'],
                      'Contact_title'       => $Navigation['Contact_title'],
                      'Syndication_text'    => $Navigation['Syndication_text'],
                      'Syndication_title'   => $Navigation['Syndication_title'],
                      'Join_text'           => $Navigation['Join_text'],
                      'Join_title'          => $Navigation['Join_title'],
                      'Login_text'          => $Navigation['Login_text'],
                      'Login_title'         => $Navigation['Login_title'],
                      'Profile_text'        => $Navigation['Profile_text'],
                      'Profile_title'       => $Navigation['Profile_title'],
                      'Logout_text'         => $Navigation['Logout_text'],
                      'Logout_title'        => $Navigation['Logout_title'],
                      'SearchResults_text'  => $Navigation['SearchResults_text'],
                      'TagsResults_text'    => $Navigation['TagsResults_text'],
                      'BackendLink_text'    => $Navigation['BackendLink_text'],
                      'BackendLink_title'   => $Navigation['BackendLink_title']
                      )
                );

$smarty->assign('FormsInfo',
                array(
                      'LostPassword_info'    => $FormsInfo['LostPassword_info'],
                      'LostPassword_warning' => $FormsInfo['LostPassword_warning'],
                      'Logout_info'          => $FormsInfo['Logout_info'],
                      'Logout_warning'       => $FormsInfo['Logout_warning'],
                      'Logout_OK'            => $FormsInfo['Logout_OK'],
                      'Login_info'           => $FormsInfo['Login_info'],
                      'Login_warning'        => $FormsInfo['Login_warning'],
                      'LoginToRegister_link' => $FormsInfo['LoginToRegister_link'],
                      'RegisterToLogin_link' => $FormsInfo['RegisterToLogin_link'],
                      'Register_info'        => $FormsInfo['Register_info'],
                      'Register_warning'     => $FormsInfo['Register_warning'],
                      'Contact_info'         => $FormsInfo['Contact_info'],
                      'Contact_warning'      => $FormsInfo['Contact_warning'],
                      'Profile_info'         => $FormsInfo['Profile_info'],
                      'Profile_warning'      => $FormsInfo['Profile_warning'],
                      'ProfilePass_info'     => $FormsInfo['ProfilePass_info'],
                      'ProfilePass_warning'  => $FormsInfo['ProfilePass_warning'],
                      'NoCommentsYet_info'   => $FormsInfo['NoCommentsYet_info'],
                      'Comments_info'        => $FormsInfo['Comments_info'],
                      'Comments_warning'     => $FormsInfo['Comments_warning']
                      )
                );

$smarty->assign('Post',
                array(
                      'Older_text'  => $Post['Older_text'],
                      'Older_title' => $Post['Older_title'],
                      'Newer_text'  => $Post['Newer_text'],
                      'Newer_title' => $Post['Newer_title'],
                      'More_text'   => $Post['More_text'],
                      'More_title'  => $Post['More_title'],
                      'Tags_text'   => $Post['Tags_text'],
                      'Tags_title'  => $Post['Tags_title'],
                      )
                );

$smarty->assign('Results',
                array(
                      'Title_text'       => $Results['Title_text'],
                      'Description_text' => $Results['Description_text'],
                      'DateTime_text'    => $Results['DateTime_text'],
                      'Author_text'      => $Results['Author_text']
                      )
                );

$smarty->assign('Form',
                array(
                      'Name_text'          => $Form['Name_text'],
                      'Name_title'         => $Form['Name_title'],
                      'Email_text'         => $Form['Email_text'],
                      'Email_title'        => $Form['Email_title'],
                      'Message_text'       => $Form['Message_text'],
                      'Message_title'      => $Form['Message_title'],
                      'Captcha_text'       => $Form['Captcha_text'],
                      'Captcha_title'      => $Form['Captcha_title'],
                      'PasswordLost_text'  => $Form['PasswordLost_text'],
                      'PasswordLost_title' => $Form['PasswordLost_title'],
                      'Password_text'      => $Form['Password_text'],
                      'Password_title'     => $Form['Password_title'],
                      'Password0_text'     => $Form['Password0_text'],
                      'Password0_title'    => $Form['Password0_title'],
                      'Password1_text'     => $Form['Password1_text'],
                      'Password1_title'    => $Form['Password1_title'],
                      'Password2_text'     => $Form['Password2_text'],
                      'Password2_title'    => $Form['Password2_title'],
                      'Submit_text'        => $Form['Submit_text'],
                      'Submit_title'       => $Form['Submit_title'],
                      'Search_text'        => $Form['Search_text'],
                      'Search_title'       => $Form['Search_title'],
                      'Lang_text'          => $Form['Lang_text'],
                      'Lang_title'         => $Form['Lang_title'],
                      'Skin_text'          => $Form['Skin_text'],
                      'Skin_title'         => $Form['Skin_title'],
                      'Comment_text'       => $Form['Comment_text'],
                      'Comment_title'      => $Form['Comment_title'],
                      'Anonymous_text'     => $Form['Anonymous_text'],
                      'Delete_text'        => $Form['Delete_text'],
                      'Delete_title'       => $Form['Delete_title']
                      )
                );

$smarty->assign('About',
                array(
                      'Content' => $About['Content']
                      )
                );


$smarty->assign('Validation',
                array(
                      'Valid_XHTML' => $Validation['Valid_XHTML'],
                      'Valid_CSS'   => $Validation['Valid_CSS'],
                      'Valid_RSS'   => $Validation['Valid_RSS'],
                      'Valid_WCAG'  => $Validation['Valid_WCAG']
                      )
                );

$smarty->assign('Messages',
                array(
                      'Cannot_Perform_err'         => $Messages['Cannot_Perform_err'],
                      'Message_Sent_err'           => $Messages['Message_Sent_err'],
                      'Message_Sent_suc'           => $Messages['Message_Sent_suc'],
                      'Account_Created_suc'        => $Messages['Account_Created_suc'],
                      'Int_NotFound_err'           => $Messages['Int_NotFound_err'],
                      'NoPosts_err'                => $Messages['NoPosts_err'],
                      'NoSearch_err'               => $Messages['NoSearch_err'],
                      'NoTag_err'                  => $Messages['NoTag_err'],
                      'Bad_Captcha_err'            => $Messages['Bad_Captcha_err'],
                      'Bad_Username_err'           => $Messages['Bad_Username_err'],
                      'No_Email_err'               => $Messages['No_Email_err'],
                      'Blank_Username_err'         => $Messages['Blank_Username_err'],
                      'Taken_Username_err'         => $Messages['Taken_Username_err'],
                      'Bad_Password_err'           => $Messages['Bad_Password_err'],
                      'Blank_Password_err'         => $Messages['Blank_Password_err'],
                      'Short_Password_err'         => $Messages['Short_Password_err'],
                      'PasswordIsName_err'         => $Messages['PasswordIsName_err'],
                      'Match_Password_err'         => $Messages['Match_Password_err'],
                      'Corrupt_File_err'           => $Messages['Corrupt_File_err'],
                      'Bad_Login_err'              => $Messages['Bad_Login_err'],
                      'Bad_Email_err'              => $Messages['Bad_Email_err'],
                      'Blank_Text_err'             => $Messages['Blank_Text_err'],
                      'Blank_Comment_err'          => $Messages['Blank_Comment_err'],
                      'Login_Cannot_err'           => $Messages['Login_Cannot_err'],
                      'Profile_Cannot_err'         => $Messages['Profile_Cannot_err'],
                      'Comment_Cannot_err'         => $Messages['Comment_Cannot_err'],
                      'Comment_Closed_err'         => $Messages['Comment_Closed_err'],
                      'Comment_Sent_suc'           => $Messages['Comment_Sent_suc'],
                      'Comment_Sent2_suc'          => $Messages['Comment_Sent2_suc'],
                      'Comment_Deleted_suc'        => $Messages['Comment_Deleted_suc'],
                      'Comment_Delete_Cannot_err'  => $Messages['Comment_Delete_Cannot_err'],
                      'Profile_Updated_suc'        => $Messages['Profile_Updated_suc'],
                      'Password_New_suc'           => $Messages['Password_New_suc'],
                      'NoCookies_err'              => $Messages['NoCookies_err']
                      )
                );

$smarty->assign('LostPassword',
                array(
                      'Subject_text' => $LostPassword['Subject_text'],
                      'Body_title'   => $LostPassword['Body_text']
                      )
                );

