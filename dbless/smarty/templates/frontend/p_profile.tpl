{* Join template *}

  <h3>{$Navigation.Profile_title}</h3>


{* Get messages *}
{if $FORMJoin == "userexists"}
    <div class="error">
      {$Messages.Taken_Username_err}
    </div>
{/if}
{if $FORMJoin == "perms"}
    <div class="error">
      {$Messages.Cannot_Perform_err}
    </div>
{/if}
{if $FORMProfile == "updated"}
    <div class="success">
      {$Messages.Profile_Updated_suc}
    </div>
{/if}
{if $FORMPassword == "updated"}
    <div class="success">
      {$Messages.Password_New_suc}
    </div>
{/if}


{* Main preferences *}
{if !$UserLoggedIn}
  <div class="error">
    {$Messages.Profile_Cannot_err}
  </div>
{else}

  <div class="profile">

    <div class="profile_info">
{if $FormsInfo.Profile_info != ""}
      <p>
        {$FormsInfo.Profile_info}
      </p>
{/if}
{if $FormsInfo.Profile_warning != ""}
      <p>
        {$FormsInfo.Profile_warning}
      </p>
{/if}

    </div>

{* Display profile form *}
    <div class="profile_form">
{include file="$DirFrontend/f_profile.tpl"}
    </div>

    <hr />


{* Password *}
    <div class="profile_info">
{if $FormsInfo.ProfilePass_info != ""}
      <p>
        {$FormsInfo.ProfilePass_info}
      </p>
{/if}
{if $FormsInfo.ProfilePass_warning != ""}
      <p>
        {$FormsInfo.ProfilePass_warning}
      </p>
{/if}
    </div>

{* Display password change form *}
    <div class="profile_password_form">
{include file="$DirFrontend/f_profile_password.tpl"}
    </div>

{/if}
  </div>
