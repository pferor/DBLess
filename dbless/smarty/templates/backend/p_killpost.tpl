{* Kill confirmation template *}

  <h3>{$Navigation.KillPost_title}</h3>

{if $PostID != 0}
  <div class="kill">

  {* Show some info. *}
    <div class="kill_info">
{if $FormsInfo.KillPost_info != ""}
      <p>
        {$FormsInfo.KillPost_info}
      </p>
{/if}
{if $FormsInfo.KillPost_warning != ""}
      <p>
        {$FormsInfo.KillPost_warning}
      </p>
{/if}
    </div>

    <div class="error">
      {$PostTitle}
      <br />
      {$PostTimestamp}
    </div>

  </div>

{* Display the form *}
  <div class="kill_form">
    <form action="{$PostsActs}?lang={$Language}"
          id="kill"
          method="post">
      <table class="kill">

        <tr>
          <td>
            <input id="id"
                   name="id"
                   title="{$PostID}"
                   type="hidden"
                   value="{$PostID}" />

            <input class="button delete kill_button"
                   id="bu_kill"
                   name="bu_kill"
                   title="{$Actions.KillPost_title}"
                   type="submit"
                   value="{$Actions.KillPost_text}" />
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
{if $FORMAction == "kill"}
    <div class="success">
      {$Messages.PostKilled_suc}
    </div>
{elseif $FORMAction == "cant_rm_post"}
    <div class="error">
      {$Messages.KillPostCannot_err}
    </div>
{elseif $FORMAction == "cant_rm_comm"}
    <div class="error">
      {$Messages.KillCommentsCannot_err}
    </div>
{else}
    <div class="error">
      {$Messages.PostDoesntExist_err}
    </div>
{/if}

{/if}

