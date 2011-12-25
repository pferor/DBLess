{* Main front page *}

{* Posts list *}
{section name=post loop=$PostsResults}
  <div class="post">
{if $PostsResults[post].Title != ""}
    <h3 class="post_title"><a href=".?pg=post&amp;id={$PostsResults[post].id}&amp;lang={$Language}"
                              title="{$PostsResults[post].Title}"
                              >{$PostsResults[post].Title}</a></h3>
{/if}

    <div class="post_info">
      <span class="post_timestamp">{$PostsResults[post].TimeStamp}</span>
{if $PostsResults[post].Author != ""}
      <span class="post_author">/ {$PostsResults[post].Author}</span>
{/if}
    </div>

{if $PostsResults[post].Summary != ""}
    <h4 class="post_summary">{$PostsResults[post].Summary}</h4>
{/if}

{if $PostsResults[post].Post != ""}
    <div class="post_content">
      {$PostsResults[post].Post}
    </div>
{/if}

{* Link to post *}
    <div class="more_link">
      <a href=".?pg={$_post_}&amp;id={$PostsResults[post].id}&amp;lang={$Language}"
         title="{$PostsResults[post].Title}">{$Post.More_text} »</a>
    </div>

{* Tags --only if there are at least one-- *}
{if !empty($PostsResults[post].Tags)}
    <div class="more_link">
         {$Post.Tags_text}:

{foreach from=$PostsResults[post].Tags item=tag name=taglist}
         <a class="tag_link"
            href=".?pg={$_tags_}&amp;$lang={$Language}&amp;tag={$tag|urlencode}"
            title="">{$tag}</a>{if !$smarty.foreach.taglist.last},{/if}
{/foreach}
    </div>
{/if}

  </div>

{sectionelse}
  <div class="error">
    <!-- There are no files -->
    {$Messages.NoPosts_err}
  </div>
{/section}

<!-- Pager -->

{if $PostsCount > $MaxPostsInFrontPage}
  <div id="pager">

{assign var="_next" value=$PagerStart+$MaxPostsInFrontPage}
{if $_next < $PostsCount}
    <span id="older_link">
      <a href=".?pg={$_front_}&amp;lang={$Language}&amp;start={$_next}"
         title="{$Post.Older_title}">{$Post.Older_text}</a>
    </span>
{/if}

{assign var="_prev" value=$PagerStart-$MaxPostsInFrontPage}
{if $_prev >= 0}
    <span id="newer_link">
      <a href=".?pg={$_front_}&amp;lang={$Language}&amp;start={$_prev}"
         title="{$Post.Newer_title}">{$Post.Newer_text}</a>
    </span>
{/if}

  </div>
{/if}

