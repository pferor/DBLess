{* Post template *}


{if $PostResults.id != ""}

{* Post itself *}
<div class="post">
{if $PostResults.Title != ""}
  <h3 class="post_title">{$PostResults.Title}</h3>
{/if}
  <div class="post_info">
    <span class="post_timestamp">{$PostResults.TimeStamp}</span>
{if $PostResults.Author != ""}
    <span class="post_author">/ {$PostResults.Author}</span>
{/if}
  </div>

{if $PostResults.Summary != ""}
  <h4 class="post_summary">{$PostResults.Summary}</h4>
{/if}

{if $PostResults.Post != ""}
  <div class="post_content">{$PostResults.Post}</div>
{/if}


{* Tags --only if there are at least one-- *}
{if !empty($PostResults.Tags)}
  <hr />

  <div class="more_link">
    {$Post.Tags_text}:

{foreach from=$PostResults.Tags item=tag name=taglist}
    <a class="tag_link"
       href=".?pg={$_tags_}&amp;$lang={$Language}&amp;tag={$tag|urlencode}"
       title="">{$tag}</a>{if !$smarty.foreach.taglist.last},{/if}
{/foreach}
  </div>
{/if}


{* Post comments *}
  <hr />
{include file="$DirFrontend/p_comments.tpl"}

{else}
<div class="error">
  <!-- No Post ID -->
  ?
</div>
{/if}

