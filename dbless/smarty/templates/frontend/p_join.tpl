{* Join template *}

  <h3>{$Navigation.Join_title}</h3>


{* Get messages *}
{if $FORMJoin == "created"}
    <div class="success">
      {$Messages.Account_Created_suc}
    </div>
{else}
{* Get possible errors *}
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


{* Show some info. *}
{if $UserLoggedIn}
  <div class="error">
    {$Messages.Login_Cannot_err}
  </div>
{else}

  <div class="join">

    <div class="join_info">
{if $FormsInfo.Register_info != ""}
      <p>
        {$FormsInfo.Register_info}
      </p>
{/if}
{if $FormsInfo.Register_warning != ""}
      <p>
        {$FormsInfo.Register_warning}
      </p>
{/if}
{if $$FormsInfo.RegisterToLogin_link != ""}
      <p>
        <a href="?pg=login&amp;lang={$Language}"
           title="{$Navigation.Login_title}"
           >{$FormsInfo.RegisterToLogin_link}</a>
      </p>
{/if}

    </div>


{* Display the form *}
    <div class="join_form">
{include file="$DirFrontend/f_join.tpl"}
    </div>

{/if}
  </div>
{/if}

