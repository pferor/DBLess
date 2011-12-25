{* Kill confirmation template *}

  <h3>{$Navigation.KillComment_title}</h3>

{if $CommentID != "0"}
  <div class="kill">

  {* Show some info. *}
    <div class="kill_info">
{if $FormsInfo.KillComment_info != ""}
      <p>
        {$FormsInfo.KillComment_info}
      </p>
{/if}
{if $FormsInfo.KillComment_warning != ""}
      <p>
        {$FormsInfo.KillComment_warning}
      </p>
{/if}
    </div>

    <div class="error">
      {$CommentText}
    </div>

  </div>

{* Display the form *}
  <div class="kill_form">
    <form action="{$CommentsActs}?lang={$Language}"
          id="kill"
          method="post">
      <table class="kill">

        <tr>
          <td>
            <input id="id"
                   name="id"
                   title="{$CommentID}"
                   type="hidden"
                   value="{$CommentID}" />

            <input id="postid"
                   name="postid"
                   title="{$PostID}"
                   type="hidden"
                   value="{$PostID}" />

            <input class="button delete kill_button"
                   id="bu_kill"
                   name="bu_kill"
                   title="{$Actions.KillComment_title}"
                   type="submit"
                   value="{$Actions.KillComment_text}" />
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
  {$Messages.UnmoderatedCommentDoesntExist_err}
</div>
{/if}
