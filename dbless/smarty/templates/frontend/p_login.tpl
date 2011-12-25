{* Login template *}

{* Login section *}
  <h3>{$Navigation.Login_title}</h3>


{* Get messages *}
{if $POSTLogin == "bad"}
    <div class="error">
      {$Messages.Bad_Login_err}
    </div>
{/if}
{if $POSTLogin == "corrupt"}
    <div class="error">
      {$Messages.Corrupt_File_err}
    </div>
{/if}
{if $FORMEmail == "none"}
    <div class="error">
      {$Messages.No_Email_err}
    </div>
{/if}
{if $FORMMail == "fail"}
    <div class="error">
      {$Messages.Message_Sent_err}
    </div>
{/if}
{if $FORMMail == "sent"}
    <div class="success">
      {$Messages.Message_Sent_suc}
    </div>
{/if}
{if $FORMJoin == "created"}
    <div class="success">
      {$Messages.Account_Created_suc}
    </div>
{/if}

{if $UserLoggedIn}
  <div class="error">
    {$Messages.Login_Cannot_err}
  </div>
{else}

  <div class="login">


{* Show some info *}
    <div class="login_info">
{if $FormsInfo.Login_info != ""}
      <p>
        {$FormsInfo.Login_info}
      </p>
{/if}
{if $FormsInfo.Login_warning != ""}
      <p>
        {$FormsInfo.Login_warning}
      </p>
{/if}
{if $$FormsInfo.LoginToRegister_link != ""}
      <p>
        <a href="?pg=join&amp;lang={$Language}"
           title="{$Navigation.Register_title}"
           >{$FormsInfo.LoginToRegister_link}</a>
      </p>
{/if}

{if $FormsInfo.LostPassword_info != ""}
      <p>
	{$FormsInfo.LostPassword_info}
      </p>
{/if}

{if $FormsInfo.LostPassword_warning != ""}
      <p>
	{$FormsInfo.LostPassword_warning}
      </p>
{/if}
    </div>


{* Display the log in form *}
    <div class="login_form">
{include file="$DirFrontend/f_login.tpl"}
    </div>

{/if}
  </div>

