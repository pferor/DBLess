{* Comments form template *}

  <form action="{$CommentActs}?lang={$Language}&id={$PostResults.id}"
        id="comment"
        method="post">
    <table class="comment">

      {* Username *}
      <tr>
        <td>
          <label for="username">{$Form.Name_text}</label>
          <span class="required_field">*</span>
        </td>
        <td>
          <input id="username"
                 name="username"
                 title="{$Form.Name_title}"
                 type="hidden"
{if $UserLoggedIn}
                 value="{$Username}" />
{else}
                 value="{$Form.Anonymous_text}" />
{/if}

          <input class="disabled wide"
                 disabled="disabled"
                 id="username_disabled"
                 name="username_disabled"
                 title="{$Form.Name_title}"
                 type="text"
{if $UserLoggedIn}
                 value="{$Username}" />
{else}
                 value="{$Form.Anonymous_text}" />
{/if}
        </td>
        <td class="field_info">
{if $POSTUsername == "blank"}
    <span class="form_error">
      {$Messages.Blank_Username_err}
    </span>
{else}
          &nbsp;
{/if}
        </td>
      </tr>

      {* Comment itself *}
      <tr>
        <td>
          <label for="comment">{$Form.Comment_text}</label>
          <span class="required_field">*</span>
        </td>
        <td>
          <textarea class="wide"
                    cols="50"
                    rows="10"
                    id="comment"
                    name="comment"
                    title="{$Form.Comment_title}">{$FIELDComment}</textarea>
        </td>
        <td class="field_info">
{if $POSTComment == "blank"}
    <span class="form_error">
      {$Messages.Blank_Comment_err}
    </span>
{else}
          &nbsp;
{/if}
        </td>
      </tr>

{* Captcha *}
{if !$UserLoggedIn}
          <tr>
            <td>&nbsp;</td>
            <td colspan="2"
                 id="aart_captcha">
              {$CaptchaAart}
            </td>
          </tr>

          <tr>
            <td>
              <label for="captcha">{$Form.Captcha_text}</label>
              <span class="required_field">*</span>
            </td>
            <td>
              <input class="wide"
                     id="captcha"
                     name="captcha"
                     title="{$Form.Captcha_title}"
                     type="text"
                     value="" />
            </td>
            <td class="field_info">
{if $POSTCaptcha == "bad"}
    <span class="form_error">
      {$Messages.Bad_Captcha_err}
    </span>
{else}
    &nbsp;
{/if}
            </td>
          </tr>
{/if}

{* Submit button *}
      <tr>
        <td>&nbsp;</td>
        <td>
          <input class="button"
                 id="bu_comment"
                 name="bu_comment"
                 title="{$Form.Submit_title}"
                 type="submit"
                 value="{$Form.Submit_text}" />
        </td>
        <td>&nbsp;</td>
      </tr>

    </table>
  </form>


