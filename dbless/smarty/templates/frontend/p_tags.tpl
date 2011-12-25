{* Tags results template *}

<div class="tag">

{if $TagQuery == ""}
<h3>{$Navigation.TagsResults_text}</h3>
{else}
<h3>{$Navigation.TagsResults_text} (<q>{$TagQuery}</q>)</h3>
{/if}

{* Tags results table *}
<table id="tag">

  <tr>
    <th>{$Results.Title_text}</th>
    <th>{$Results.Description_text}</th>
    <th>{$Results.DateTime_text}</th>
    <th>{$Results.Author_text}</th>
  </tr>

{section name=post loop=$TagsResults}
  <tr>
    <td class="title">
        <a href=".?pg=post&amp;id={$TagsResults[post].id}&amp;lang={$Language}"
           title="{$TagsResults[post].Title}"
           >{$TagsResults[post].Title}</a>
    </td>
    <td class="description">
      <!-- Show a brief of the post if there is no summary -->
 {if $TagsResults[post].Summary == ""}
      {$TagsResults[post].Post}
 {else}
      {$TagsResults[post].Summary}
 {/if}
    </td>
    <td class="timestamp">{$TagsResults[post].TimeStamp}</td>
    <td class="author">{$TagsResults[post].Author}</td>
  </tr>

{sectionelse}
  <tr>
    <td colspan="4">
      <div class="error">
	{* TODO :: Check this error *}
	<!-- There are no files -->
	{$Messages.NoTag_err}
      </div>
    </td>
  </tr>

{/section}

</table>
</div>
