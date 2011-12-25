<?php
/*
 * @file smarty_lang.php
 *
 * @brief Language strings passed to Smarty
 *
 * @detail Variables assigned to backend languages using Smarty. If
 *         new language entries are added, there must be added here
 *         too. In this file will be included *only* language entries
 *         needed in `.tpl' files.
 */

$smarty->assign('Actions',
                array(
                      'Admit_text'        => $Actions['Admit_text'],
                      'Admit_title'       => $Actions['Admit_title'],
                      'Cancel_text'       => $Actions['Cancel_text'],
                      'Cancel_title'      => $Actions['Cancel_title'],
                      'Delete_text'       => $Actions['Delete_text'],
                      'Delete_title'      => $Actions['Delete_title'],
                      'KillComment_text'  => $Actions['KillComment_text'],
                      'KillComment_title' => $Actions['KillComment_title'],
                      'KillPost_text'     => $Actions['KillPost_text'],
                      'KillPost_title'    => $Actions['KillPost_title'],
                      'KillUser_text'     => $Actions['KillUser_text'],
                      'KillUser_title'    => $Actions['KillUser_title'],
                      'NewPost_text'      => $Actions['NewPost_text'],
                      'NewPost_title'     => $Actions['NewPost_title'],
                      'Reject_text'       => $Actions['Reject_text'],
                      'Reject_title'      => $Actions['Reject_title'],
                      'Save_text'         => $Actions['Save_text'],
                      'Save_title'        => $Actions['Save_title'],
                      'Submit_text'       => $Actions['Submit_text'],
                      'Submit_title'      => $Actions['Submit_title'],
                      )
                );

$smarty->assign('Form',
                array(
                      'Author_text'             => $Form['Author_text'],
                      'ClosedPost_text'         => $Form['ClosedPost_text'],
                      'Email_text'              => $Form['Email_text'],
                      'Email_title'             => $Form['Email_title'],
                      'LicenseInfo_field'       => $Form['LicenseInfo_field'],
                      'LicenseName_text'        => $Form['LicenseName_text'],
                      'LicenseDescription_text' => $Form['LicenseDescription_text'],
                      'LicenseURI_text'         => $Form['LicenseURI_text'],
                      'LockComments_text'       => $Form['LockComments_text'],
                      'Post_text'               => $Form['Post_text'],
                      'SiteInfo_field'          => $Form['SiteInfo_field'],
                      'SiteName_text'           => $Form['SiteName_text'],
                      'SiteDescription_text'    => $Form['SiteDescription_text'],
                      'SiteTip_text'            => $Form['SiteTip_text'],
                      'Summary_text'            => $Form['Summary_text'],
                      'Tags_text'               => $Form['Tags_text'],
                      'Timestamp_text'          => $Form['Timestamp_text'],
                      'Title_text'              => $Form['Title_text']
                      )
                );

$smarty->assign('FormsInfo',
                array(
                      'Content_info'         => $FormsInfo['Content_info'],
                      'KillComment_info'     => $FormsInfo['KillComment_info'],
                      'KillComment_warning'  => $FormsInfo['KillComment_warning'],
                      'KillPost_info'        => $FormsInfo['KillPost_info'],
                      'KillPost_warning'     => $FormsInfo['KillPost_warning'],
                      'KillUser_info'        => $FormsInfo['KillUser_info'],
                      'KillUser_warning'     => $FormsInfo['KillUser_warning'],
                      'Logout_info'          => $FormsInfo['Logout_info'],
                      'Logout_warning'       => $FormsInfo['Logout_warning'],
                      'Tags_info'            => $FormsInfo['Tags_info'],
                      'TimestampFormat_info' => $FormsInfo['TimestampFormat_info']
                      )
                );

$smarty->assign('Messages',
                array(
                      'BlankSitename_err'                 => $Messages['BlankSitename_err'],
                      'CommentAdmitted_suc'               => $Messages['CommentAdmitted_suc'],
                      'CommentRejected_suc'               => $Messages['CommentRejected_suc'],
                      'CommentsModerationOff_err'         => $Messages['CommentsModerationOff_err'],
                      'KillCommentsCannot_err'            => $Messages['KillCommentsCannot_err'],
                      'KillPostCannot_err'                => $Messages['KillPostCannot_err'],
                      'KillUnmoderatedCommentCannot_err'  => $Messages['KillUnmoderatedCommentCannot_err'],
                      'KillUserCannot_err'                => $Messages['KillUserCannot_err'],
                      'NoCommentsModeration_err'          => $Messages['NoCommentsModeration_err'],
                      'NoUsers_err'                       => $Messages['NoUsers_err'],
                      'PostBadlySaved_suc'                => $Messages['PostBadlySaved_suc'],
                      'PostCannotSave_err'                => $Messages['PostCannotSave_err'],
                      'PostDoesntExist_err'               => $Messages['PostDoesntExist_err'],
                      'PostKilled_suc'                    => $Messages['PostKilled_suc'],
                      'PostSaved_suc'                     => $Messages['PostSaved_suc'],
                      'SaveSiteInfoCannot_err'            => $Messages['SaveSiteInfoCannot_err'],
                      'SaveSiteInfo_suc'                  => $Messages['SaveSiteInfo_suc'],
                      'UnmoderatedCommentDoesntExist_err' => $Messages['UnmoderatedCommentDoesntExist_err'],
                      'UserDoesntExist_err'               => $Messages['UserDoesntExist_err'],
                      'UserKilled_suc'                    => $Messages['UserKilled_suc']
                      )
                );

$smarty->assign('Navigation',
                array(
                      'Admin_text'         => $Navigation['Admin_text'],
                      'Admin_title'        => $Navigation['Admin_title'],
                      'Comments_text'      => $Navigation['Comments_text'],
                      'Comments_title'     => $Navigation['Comments_title'],
                      'FrontendLink_text'  => $Navigation['FrontendLink_text'],
                      'FrontendLink_title' => $Navigation['FrontendLink_title'],
                      'Home_text'          => $Navigation['Home_text'],
                      'Home_title'         => $Navigation['Home_title'],
                      'KillPost_title'     => $Navigation['KillPost_title'],
                      'KillUser_title'     => $Navigation['KillUser_title'],
                      'Logout_text'        => $Navigation['Logout_text'],
                      'Logout_title'       => $Navigation['Logout_title'],
                      'Posts_text'         => $Navigation['Posts_text'],
                      'Posts_title'        => $Navigation['Posts_title'],
                      'Users_text'         => $Navigation['Users_text'],
                      'Users_title'        => $Navigation['Users_title'],
                      'SiteInfo_text'      => $Navigation['SiteInfo_text'],
                      'SiteInfo_title'     => $Navigation['SiteInfo_title']
                      )
                );

$smarty->assign('Results',
                array(
                      'Action_text'      => $Results['Action_text'],
                      'Author_text'      => $Results['Author_text'],
                      'Comment_text'     => $Results['Comment_text'],
                      'DateTime_text'    => $Results['DateTime_text'],
                      'Description_text' => $Results['Description_text'],
                      'Email_text'       => $Results['Email_text'],
                     ' Post_text'        => $Results['Post_text'],
                      'SignUpDate_text'  => $Results['SignUpDate_text'],
                      'Title_text'       => $Results['Title_text'],
                      'Username_text'    => $Results['Username_text']
                      )
                );

