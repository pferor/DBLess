{* Contact form template*}

      <form action="{$ContactActs}?lang={$Language}"
            id="contact"
            method="post">
        <table class="contact">

          <tr>
            <td>
              <label for="username">{$Form.Name_text}</label>
              <span class="required_field">*</span>
            </td>
            <td>
{if $UserLoggedIn}
              <input id="username"
                     name="username"
                     title="{$Form.Name_title}"
                     type="hidden"
                     value="{$Username}" />

              <input class="disabled"
                     disabled="disabled"
                     id="username_disabled"
                     name="username_disabled"
                     title="{$Form.Name_title}"
                     type="text"
                     value="{$Username}" />
{else}
              <input id="username"
                     name="username"
                     title="{$Form.Name_title}"
                     type="text"
                     value="{$FIELDUsername}" />
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

          <tr>
            <td>
              <label for="email">{$Form.Email_text}</label>
              <span class="required_field">&nbsp;&nbsp;</span>
            </td>
            <td>
{if $UserLoggedIn}
              <input id="email"
                     name="email"
                     title="{$Form.Email_title}"
                     type="text"
{if $FIELDEmail == ""}
                     value="{$UserEmail}" />
{else}
                     value="{$FIELDEmail}" />
{/if}
{else}
              <input id="email"
                     name="email"
                     title="{$Form.Email_title}"
                     type="text"
                     value="{$FIELDEmail}" />
{/if}
            </td>
            <td class="field_info">
{if $POSTEmail == "bad"}
    <span class="form_error">
      {$Messages.Bad_Email_err}
    </span>
{else}
&nbsp;
{/if}
            </td>
          </tr>

          <tr>
            <td>
              <label for="message">{$Form.Message_text}</label>
              <span class="required_field">*</span>
            </td>
            <td>
              <textarea cols="30"
                        rows="5"
                        id="message"
                        name="message"
                        title="{$Form.Message_title}">{$FIELDMessage}</textarea>
            </td>
            <td class="field_info">
{if $POSTMessage == "blank"}
    <span class="form_error">
      {$Messages.Blank_Text_err}
    </span>
{else}
    &nbsp;
{/if}
            </td>
          </tr>

{if !$UserLoggedIn}
          <tr>
            <td colspan="3"
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
              <input id="captcha"
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
{elseif $POSTCaptcha == "nocookie"}
    <span class="form_error">
      {$Messages.NoCookies_err}
    </span>
{else}
    &nbsp;
{/if}
            </td>
          </tr>
{/if}

          <tr>
            <td>&nbsp;</td>
            <td>
              <input class="button"
                     id="bu_send"
                     name="bu_send"
                     title="{$Form.Submit_title}"
                     type="submit"
                     value="{$Form.Submit_text}" />
              </td>
            <td>&nbsp;</td>
          </tr>

        </table>
      </form>

