{* Users administration template *}
<div class="users">

<h3>{$Navigation.Users_title}</h3>


{* Get messages *}
{if $FORMAction == "kill"}
    <div class="success">
      {$Messages.UserKilled_suc}
    </div>
{elseif $FORMAction == "cant_rm_user"}
    <div class="error">
      {$Messages.KillUserCannot_err}
    </div>
{/if}

{* Users table *}
<table id="users">

  <tr>
    <th>{$Results.Username_text}</th>
    <th>{$Results.Email_text}</th>
    <th>{$Results.SignUpDate_text}</th>
    <th>{$Results.Action_text}</th>
  </tr>

{foreach from=$UsersResults item=user name=users}

  <tr>
{* Username *}
    <td class="username">
      {$user.Username}
    </td>

{* E-mail *}
    <td class="email">
{if $user.Email != ""}
      <a href="mailto:{$user.Email}"
         title="{$user.Email}">{$user.Email}</a>
{else}
      &nbsp;
{/if}
    </td>

{* Sign up date *}
    <td class="signup_date">
      {$user.SignUpDate}
    </td>

{* Action *}
    <td class="action">
      <form action="{$UsersActs}?lang={$Language}&id={$user.id}"
            id="{$user.id}"
            method="post">
        <div>
          <input name="id_{$user.id}"
                 id="id_{$user.id}"
                 title="{$user.Username}"
                 type="hidden"
                 value="{$user.id}" />

          <input name="re_username_{$user.id}"
                 id="re_username_{$user.id}"
                 title="{$user.Username}"
                 type="hidden"
                 value="{$user.Username}" />

          <input class="button delete"
                 name="bu_delete_{$user.id}"
                 id="bu_delete_{$user.id}"
                 title="{$Actions.Delete_title}"
                 type="submit"
                 value="{$Actions.Delete_text}" />

        </div>
      </form>
    </td>

  </tr>

{foreachelse}

  <tr>
    <td colspan="4">
      <div class="error">
    {* TODO :: Check this error *}
        {$Messages.NoUsers_err}
      </div>
    </td>
  </tr>

{/foreach}

</table>
