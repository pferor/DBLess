{* Commentaries template *}

  <div id="comment">

{if $POSTComment == "sent"}
    <div class="success">

{if $CommentsModeration && !$UserIsAdmin}
      {$Messages.Comment_Sent2_suc}
{else}
      {$Messages.Comment_Sent_suc}
{/if}
    </div>
{elseif $POSTComment == "deleted"}
    <div class="success">
      {$Messages.Comment_Deleted_suc}
    </div>
{elseif $POSTComment == "not_deleted"}
    <div class="error">
      {$Messages.Comment_Delete_Cannot_err}
    </div>

{/if}

{* Commentaries *}
{if !$CommentsCount && !$PostResults.Closed}
  <p>
    {$FormsInfo.NoCommentsYet_info}
  </p>
{else}
{* Show comments *}
{section name=comment loop=$CommentsResults}
{if $CommentsResults[comment].Author == $PostResults.Author}
    <div class="comment comment_author">
{else}
    <div class="comment comment_user">
      {/if}
      <span class="comment_author">{$CommentsResults[comment].Author}</span>
      <span class="comment_timestamp">{$CommentsResults[comment].TimeStamp}</span>
      <div class="comment_text">{$CommentsResults[comment].Comment}</div>

{* Show delete button only if this is current user *}
{include file="$DirFrontend/f_comment_delete.tpl"}
    </div>
{/section}

{/if}

{if $PostResults.Closed}
{*    <div class="error">*}
    <div>
    {$Messages.Comment_Closed_err}
    </div>
{else}

{if $UserLoggedIn || $AnonymousCanComment}
  <div class="comment"
       id="comment_form">

{* Comments form *}
{include file="$DirFrontend/f_comments.tpl"}
  </div>

{else}

{if $FormsInfo.Comments_info != ""}
  <p>
    {$FormsInfo.Comments_info}
  </p>
{/if}
{if $FormsInfo.Comments_warning != ""}
  <p>
    {$FormsInfo.Comments_warning}
    <br />
{if $$FormsInfo.RegisterToLogin_link != ""}
    <a href="?pg=login&amp;lang={$Language}"
       title="{$Navigation.Login_title}"
       >{$FormsInfo.RegisterToLogin_link}</a>
{/if}
<br />
{if $$FormsInfo.LoginToRegister_link != ""}
<a href="?pg=join&amp;lang={$Language}"
   title="{$Navigation.Register_title}"
   >{$FormsInfo.LoginToRegister_link}</a>
{/if}
  </p>

{/if}

{/if}
{/if}
    </div>

