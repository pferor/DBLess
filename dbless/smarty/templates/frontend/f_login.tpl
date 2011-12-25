{* Login form template *}

      <form action="{$LoginActs}?lang={$Language}"
            id="login"
            method="post">
        <table class="login">

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
                     type="text"
                     value="{$FIELDUsername}" />
            </td>
            <td class="field_info">
{if $POSTUsername == "blank"}
    <span class="form_error">
      {$Messages.Blank_Username_err}
    </span>
{elseif $POSTUsername == "notexists"}
    <span class="form_error">
      {$Messages.Bad_Username_err}
    </span>
{else}
    &nbsp;
{/if}
            </td>
          </tr>

{* Password *}
          <tr>
            <td>
              <label for="password">{$Form.Password_text}</label>
              <span class="required_field">*</span>
            </td>
            <td>
              <input id="password"
                     name="password"
                     title="{$Form.Password_title}"
                     type="password"
                     value="" />
              </td>
            <td class="field_info">
{if $POSTPassword == "blank"}
    <span class="form_error">
      {$Messages.Blank_Password_err}
    </span>
{else}
    &nbsp;
{/if}
            </td>
          </tr>


{* Captcha *}
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


{* Submit button *}
          <tr>
            <td colspan="2">
              <input class="button"
                     id="bu_login"
                     name="bu_login"
                     title="{$Form.Submit_title}"
                     type="submit"
                     value="{$Form.Submit_text}" />
            </td>
            <td>&nbsp;</td>
          </tr>

{* Submit new password button *}
          <tr>
            <td colspan="2">
              <input class="button"
                     id="bu_lost_password"
                     name="bu_lost_password"
                     title="{$Form.PasswordLost_title}"
                     type="submit"
                     value="{$Form.PasswordLost_text}" />
            <td>&nbsp;</td>
          </tr>

        </table>
      </form>

