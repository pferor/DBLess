{* Kill confirmation template *}

  <h3>{$Navigation.KillUser_title}</h3>

{if $UserID != "0"}
  <div class="kill">

  {* Show some info. *}
    <div class="kill_info">
{if $FormsInfo.KillUser_info != ""}
      <p>
        {$FormsInfo.KillUser_info}
      </p>
{/if}
{if $FormsInfo.KillUser_warning != ""}
      <p>
        {$FormsInfo.KillUser_warning}
      </p>
{/if}
    </div>

    <div class="error">
      {$UserToKill}
      <br />
      {$PostTimestamp}
    </div>

  </div>

{* Display the form *}
  <div class="kill_form">
    <form action="{$UsersActs}?lang={$Language}"
          id="kill"
          method="post">
      <table class="kill">

        <tr>
          <td>
            <input id="id"
                   name="id"
                   title="{$UserID}"
                   type="hidden"
                   value="{$UserID}" />

            <input name="re_username"
                   id="re_username"
                   title="{$UserToKill}"
                   type="hidden"
                   value="{$UserToKill}" />

            <input class="button delete kill_button"
                   id="bu_kill"
                   name="bu_kill"
                   title="{$Actions.KillUser_title}"
                   type="submit"
                   value="{$Actions.KillUser_text}" />
          </td>
        </tr>

        <tr>
          <td>
            <input class="button kill_button"
                   id="bu_kill_cancel"
                   name="bu_kill_cancel"
                   title="{$Actions.Cancel_title}"
                   type="submit"
                   value="{$Actions.Cancel_text}" />
          <td>
        </tr>

      </table>
    </form>
  </div>

</div>

{else}
<div class="error">
  {$Messages.UserDoesntExist_err}
</div>

{/if}
