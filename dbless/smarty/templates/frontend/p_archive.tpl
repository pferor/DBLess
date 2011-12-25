{* Archive template *}

<div class="archive">

<h3>{$Navigation.Archive_title}</h3>

{* Archive table *}
<table id="archive">

  <tr>
    <th>{$Results.Title_text}</th>
    <th>{$Results.Description_text}</th>
    <th>{$Results.DateTime_text}</th>
    <th>{$Results.Author_text}</th>
  </tr>

{section name=post loop=$PostsResults}
  <tr>
    <td class="title">
        <a href=".?pg=post&amp;id={$PostsResults[post].id}&amp;lang={$Language}"
           title="{$PostsResults[post].Title}"
           >{$PostsResults[post].Title}</a>
    </td>
    <td class="description">
      <!-- Show a brief of the post if there is no summary -->
 {if $PostsResults[post].Summary == ""}
      {$PostsResults[post].Post}
 {else}
      {$PostsResults[post].Summary}
 {/if}
    </td>
    <td class="timestamp">{$PostsResults[post].TimeStamp}</td>
    <td class="author">{$PostsResults[post].Author}</td>
  </tr>

{sectionelse}
  <tr>
    <td colspan="4">
      <div class="error">
        {* TODO :: Check this error *}
        <!-- There are no files -->
        {$Messages.NoPosts_err}
      </div>
    </td>
  </tr>

{/section}

</table>

</div>
