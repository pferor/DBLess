{* Search results template *}

<div class="search">

{if $SearchQuery != ""}
<h3>{$Navigation.SearchResults_text} (<q>{$SearchQuery}</q>)</h3>
{else}
<h3>{$Navigation.SearchResults_text}</h3>
{/if}

{* Search results table *}
<table id="search">

  <tr>
    <th>{$Results.Title_text}</th>
    <th>{$Results.Description_text}</th>
    <th>{$Results.DateTime_text}</th>
    <th>{$Results.Author_text}</th>
  </tr>

{section name=post loop=$SearchResults}
  <tr>
    <td class="title">
        <a href=".?pg=post&amp;id={$SearchResults[post].id}&amp;lang={$Language}"
           title="{$SearchResults[post].Title}"
           >{$SearchResults[post].Title}</a>
    </td>
    <td class="description">
      <!-- Show a brief of the post if there is no summary -->
 {if $SearchResults[post].Summary == ""}
      {$SearchResults[post].Post}
 {else}
      {$SearchResults[post].Summary}
 {/if}
    </td>
    <td class="timestamp">{$SearchResults[post].TimeStamp}</td>
    <td class="author">{$SearchResults[post].Author}</td>
  </tr>

{sectionelse}
  <tr>
    <td colspan="4">
      <div class="error">
        {* TODO :: Check this error *}
        <!-- There are no files -->
        {$Messages.NoSearch_err}
      </div>
    </td>
  </tr>

{/section}

</table>
</div>
