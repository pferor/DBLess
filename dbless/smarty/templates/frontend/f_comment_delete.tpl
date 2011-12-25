{* Comment delete template *}

{* Show delete button only if this is current user *}
{if $CommentsResults[comment].Author == $Username}
  <form action="{$CommentActs}?lang={$Language}&id={$PostResults.id}"
        id="delete_comment{$CommentsResults[comment].id}"
        class="delete_comment"
        method="post">
    <div>
      <input class="comment_id"
             name="comment_id"
             id="comment_id"
             title="{$CommentsResults[comment].id}"
             type="hidden"
             value="{$CommentsResults[comment].id}" />

      <input class=""
             name="author"
             id="author"
             title="{$Username}"
             type="hidden"
             value="{$Username}" />

      <input class="button delete"
             name="bu_kill"
             id="bu_kill"
             title="{$Form.Delete_title}"
             type="submit"
             value="{$Form.Delete_text}" />
{/if}
      </div>
  </form>

