{* Comments template *}
<div class="comments">

<h3>{$Navigation.Comments_title}</h3>


{* Get messages *}
{if $FORMAction == "admitted"}
    <div class="success">
      {$Messages.CommentAdmitted_suc}
    </div>
{elseif $FORMAction == "rejected"}
    <div class="success">
      {$Messages.CommentRejected_suc}
    </div>
{elseif $FORMAction == "cant_rm_comment"}
    <div class="error">
      {$Messages.KillUnmoderatedCommentCannot_err}
    </div>
{/if}

{* Comments table *}
<table id="comments">

  <tr>
    <th>{$Results.Post_text}</th>
    <th>{$Results.Comment_text}</th>
    <th>{$Results.DateTime_text}</th>
    <th>{$Results.Author_text}</th>
    <th>{$Results.Action_text}</th>
  </tr>

{if $ModerationOff}
  <tr>
    <td colspan="5">
      <div class="error">
        {$Messages.CommentsModerationOff_err}
      </div>
    </td>
  </tr>
{else}

{foreach from=$UnmoderatedCommentsResults item=comment name=comments}
  <tr>
{* Post where this coment belongs *}
    <td class="post">
      <strong>{$comment.PostTitle}</strong>
    </td>

{* Comment itself *}
    <td class="comment">
      {$comment.Comment}
    </td>

{* Timestamp *}
    <td>
      {$comment.TimeStamp}
    </td>

{* Author *}
    <td>
      {$comment.Author}
    </td>

{* Action *}
    <td class="actions">
      <form action="{$CommentsActs}?lang={$Language}&id={$comment.id}"
            id="comments_{$comment.id}"
            method="post">
        <div>
          <input name="postid_{$comment.id}"
                 id="postid_{$comment.id}"
                 title="{$comment.PostID}"
                 type="hidden"
                 value="{$comment.PostID}" />

          <input name="re_author_{$comment.id}"
                 id="re_author_{$comment.id}"
                 title="{$comment.Author}"
                 type="hidden"
                 value="{$comment.Author}" />

          <input name="re_comment_{$comment.id}"
                 id="re_comment_{$comment.id}"
                 title="{$comment.Comment}"
                 type="hidden"
                 value="{$comment.Comment}" />

          <input class="button"
                 name="bu_accept_{$comment.id}"
                 id="bu_accept_{$comment.id}"
                 title="{$Actions.Admit_title}"
                 type="submit"
                 value="{$Actions.Admit_text}" />

          <input class="button delete"
                 name="bu_reject_{$comment.id}"
                 id="bu_reject_{$comment.id}"
                 title="{$Actions.Reject_title}"
                 type="submit"
                 value="{$Actions.Reject_text}" />
        </div>
        </form>

    </td>

  </tr>

{foreachelse}
  <tr>
    <td colspan="5">
      <div class="error">
    {* TODO :: Check this error *}
        {$Messages.NoCommentsModeration_err}
      </div>
    </td>
  </tr>

{/foreach}
{/if}

</table>


</div>
