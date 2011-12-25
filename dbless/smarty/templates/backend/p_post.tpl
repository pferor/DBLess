{* Post template *}

{* Get messages *}
{if $FORMFile == "saved"}
    <div class="success">
      {$Messages.PostSaved_suc}
    </div>
{elseif  $FORMFile == "fail"}
    <div class="error">
      {$Messages.PostCannotSave_err}
    </div>
{/if}
{if $FORMRename == "bad"}
    <div class="error">
      {$Messages.PostBadlySaved_suc}
    </div>
{/if}

{* Post itself *}
<div class="post_form">
  <form action="{$PostsActs}?lang={$Language}"
        id="post"
        method="post">

    <table class="post">
      <tr>
        <td class="title" colspan="2">
{* ID (hidden) *}
        <input id="id"
               name="id"
               type="hidden"
               value="{$PostID}" />


{* Title *}
        <label for="title">
{if $POSTTitle == "blank"}
          <span class="form_error">{$Form.Title_text}</span>
{else}
          {$Form.Title_text}
{/if}
        </label>
        <span class="required_field">*</span>
        <br />
        <input id="title"
               name="title"
               title="{$Form.Title_text}"
               type="text"
{if $FIELDTitle != ""}
               value="{$FIELDTitle}" />
{else}
               value="{$PostResults.Title}" />
{/if}
        </td>
      </tr>

{* Summary *}
      <tr>
        <td class="summary" colspan="2">
        <label for="summary">{$Form.Summary_text}</label>
        <br />
        <input id="summary"
               name="summary"
               title="{$Form.Summary_text}"
               type="text"
{if $FIELDSummary != ""}
               value="{$FIELDSummary}" />
{else}
               value="{$PostResults.Summary}" />
{/if}
        </td>
      </tr>

{* Post *}
      <tr>
        <td class="content" colspan="2">

        <label for="content">
{if $POSTPost == "blank"}
          <span class="form_error">{$Form.Post_text}</span>
{else}
          {$Form.Post_text}
{/if}
        <span class="required_field">*</span>
        <span class="form_info">({$FormsInfo.Content_info|lower}:
          <code>{$PostDelimiter}</code>)</span>
        <br />
        <textarea cols="80"
                  rows="20"
                  id="content"
                  name="content"
                  title="{$Form.Post_text}"
{if $FIELDPost != ""}
                  >{$FIELDPost}</textarea>
{elseif $PostResults.Post != ""}
                  >{$PostResults.Post}</textarea>
{else}
                  >&lt;p&gt;
&lt;/p&gt;
</textarea>
{/if}
        </td>
      </tr>

{* Tags *}
      <tr>
        <td class="tags" colspan="2">
        <label for="tags">{$Form.Tags_text}</label>
        <span class="form_info">({$FormsInfo.Tags_info|lower})</span>
        <br />
        <input id="tags"
               name="tags"
               title="{$Form.Tags_text}"
               type="text"
{if $FIELDTags != ""}
               value="{$FIELDTags}" />
{else}
               value="{$PostResults.Tags}" />
{/if}
        </td>
      </tr>


{* Timestamp *}
      <tr>
        <td class="timestamp">
          <label for="timestamp">
{if $POSTTimestamp == "blank" || $POSTTimestamp == "bad"}
          <span class="form_error">{$Form.Timestamp_text}</span>
{else}
          {$Form.Timestamp_text}
{/if}
          </label>
          <span class="required_field">*</span>
          <span class="form_info">(<code>{$FormsInfo.TimestampFormat_info}</code>)</span>
          <br />
          <input id="timestamp"
                 name="timestamp"
                 title="{$Form.Timestamp_text}"
                 type="text"
{if $FIELDTimestamp != ""}
                 value="{$FIELDTimestamp}" />
{elseif $PostResults.TimeStamp != ""}
                 value="{$PostResults.TimeStamp}" />
{else}
                 value="{$TimestampNow}" />
{/if}
        </td>


{* Author *}
        <td class="author">

          <label for="author">
{if $POSTAuthor == "blank"}
            <span class="form_error">{$Form.Author_text}</span>
{else}
            {$Form.Author_text}
{/if}
        </label>

        <span class="required_field">*</span>
        <input id="author"
               name="author"
               title="{$Form.Author_text}"
               type="text"
{if $FIELDAuthor != "" }
               value="{$FIELDAuthor}" />
{elseif $PostResults.Author != ""}
               value="{$PostResults.Author}" />
{else}
               value="{$Username}" />
{/if}
        </td>
      </tr>


{* Closed? *}
       <tr>
        <td class="closed" colspan="2">
          <label class="hidden"
                 for="closed">{$Form.LockComments_text}</label>
          <input id="closed"
                 name="closed"
                 title="{$Form.ClosedPost_text}"
                 type="checkbox"
{* I'm really tired now... fix this mess with these if-else's and
   use a more harmonic solution -- Clue: use also $FIELDClosed to
   set the checkbox flag overriding the $PostResults.Closed. In
   case of error this will remember the users choice. *}
{if $PostID == 0}
                 checked="checked"
{else}
{if $PostResults.Closed == 0}
                 checked="checked"
{/if}
{/if}
                 value="closed" />{$Form.ClosedPost_text}
          <span class="required_field">*</span>
        </td>
       </tr>


{* Button *}
      <tr>
        <td colspan="2">
          <hr />

          <input class="button save"
                 id="bu_save"
                 name="bu_save"
                 title="{$Actions.Save_title}"
                 type="submit"
                 value="{$Actions.Save_text}" />



{if $PostResults.id != 0}
          <input class="button delete"
                 id="bu_delete"
                 name="bu_delete"
                 title="{$Actions.Delete_title}"
                 type="submit"
                 value="{$Actions.Delete_text}" />
{/if}
        </td>
      </tr>

    </table>
  </form>

</div>


