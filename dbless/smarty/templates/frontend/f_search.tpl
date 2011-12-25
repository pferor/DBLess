{* Search form *}

<form action="{$SearchActs}?lang={$Language}"
      id="search"
      method="post">
  <table class="search">
    <tr>
      <td>
        <input accesskey="0"
               class="search_input"
               id="search_query"
               name="search_query"
               title=""
               type="text"
               value="{$SearchQuery}" />
      </td>
      <td>
        <input class="button"
               id="bu_search"
               name="bu_search"
               title="{$Form.Search_title}"
               type="submit"
               value="{$Form.Search_text}" />
      </td>
    </tr>
    </table>
</form>

