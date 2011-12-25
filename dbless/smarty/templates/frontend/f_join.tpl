{* Join form template *}

      <form action="{$JoinActs}?lang={$Language}"
            id="join"
            method="post">
        <table class="join">

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
{else}
    &nbsp;
{/if}
            </td>
          </tr>

{* First password field *}
          <tr>
            <td>
              <label for="password1">{$Form.Password_text}</label>
              <span class="required_field">*</span>
            </td>
            <td>
              <input id="password1"
                     name="password1"
                     title="{$Form.Password_title}"
                     type="password"
                     value="" />
            </td>
            <td class="field_info"
                rowspan="2">

{if $POSTPassword == "blank"}
    <span class="form_error">
      {$Messages.Short_Password_err}
    </span>
{elseif $POSTPassword == "match"}
    <span class="form_error">
      {$Messages.Match_Password_err}
    </span>
{elseif $POSTPassword == "same"}
    <span class="form_error">
      {$Messages.PasswordIsName_err}
    </span>

{else}
    &nbsp;
{/if}
            </td>
          </tr>

{* Second password field *}
          <tr>
            <td>
              <label for="password2">{$Form.Password2_text}</label>
              <span class="required_field">*</span>
            </td>
            <td>
              <input id="password2"
                     name="password2"
                     title="{$Form.Password2_title}"
                     type="password"
                     value="" />
            </td>
          </tr>

{* Email *}
          <tr>
            <td>
              <label for="email">{$Form.Email_text}</label>
              <!-- Not required field -->
              <span class="required_field">&nbsp;&nbsp;</span>
            </td>
            <td>
              <input id="email"
                     name="email"
                     title="{$Form.Email_title}"
                     type="text"
                     value="{$FIELDEmail}" />
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

{* Language *}
          <tr>
            <td>
              <label for="language">{$Form.Lang_text}</label>
              <span class="required_field">*</span>
            </td>

            <td>
              <select id="language"
                      name="language">
{section name=lang loop=$ListLangs}
{if $ListLangs[lang] == $POSTLang || $ListLangs[lang] == $Language}
                <option selected="selected"
                        value="{$ListLangs[lang]}">{$ListLangs[lang]}</option>
{else}
                <option value="{$ListLangs[lang]}">{$ListLangs[lang]}</option>
{/if}
{/section}
              </select>


            </td>
            <td>&nbsp;</td>
          </tr>

{* CSS skin *}
          <tr>
            <td>
              <label for="language">{$Form.Skin_text}</label>
              <span class="required_field">*</span>
            </td>

            <td>
              <select id="cssskin"
                      name="cssskin">
{section name=cssskin loop=$ListCSSSkins}
{if $UserLoggedIn}
{if $ListCSSSkins[cssskin] == $POSTCSSSkin || $ListCSSSkins[cssskin] == $CSSName}
                <option selected="selected"
                        value="{$ListCSSSkins[cssskin]}">{$ListCSSSkins[cssskin]}</option>
{/if}
{elseif $ListCSSSkins[cssskin] == $CSSName}
                <option selected="selected"
			value="{$ListCSSSkins[cssskin]}">{$ListCSSSkins[cssskin]}</option>
{else}
                <option value="{$ListCSSSkins[cssskin]}">{$ListCSSSkins[cssskin]}</option>
{/if}
{/section}
              </select>


            </td>
            <td>&nbsp;</td>
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
            <td>&nbsp;</td>
            <td>
              <input class="button"
                     id="bu_join"
                     name="bu_join"
                     title="{$Form.Submit_title}"
                     type="submit"
                     value="{$Form.Submit_text}" />
            </td>
            <td>&nbsp;</td>
          </tr>

        </table>
      </form>

