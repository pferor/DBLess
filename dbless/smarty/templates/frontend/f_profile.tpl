{* Profile form template *}

      <form action="{$ProfileActs}?lang={$Language}"
            id="profile"
            method="post">
        <table class="profile">

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
                     value="{$Username}" />
              <input class="disabled"
                     disabled="disabled"
                     id="username_disabled"
                     name="username_disabled"
                     title="{$Form.Name_title}"
                     type="text"
                     value="{$Username}" />
            </td>
            <td class="field_info">
{if $POSTUsername == "blank"}
    <span class="form_error">
      {$Messages.Blank_Username_err}
    </span>
{elseif $POSTUsername == "bad"}
    <span class="form_error">
      {$Messages.Bad_Username_err}
    </span>
{elseif $POSTUsername == "corrupt"}
    <span class="form_error">
      {$Messages.Corrupt_File_err}
    </span>
{else}
    &nbsp;
{/if}
            </td>
          </tr>

{* E-mail *}
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
{if $FIELDEmail == ""}
                     value="{$UserEmail}" />
{else}
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

{* Language selector *}
          <tr>
            <td>
              <label for="language">{$Form.Lang_text}</label>
              <span class="required_field">*</span>
            </td>

            <td>
              <select id="language"
                      name="language">
{section name=lang loop=$ListLangs}
{if $ListLangs[lang] == $UserLanguage && $POSTLang == "" ||
    $ListLangs[lang] == $POSTLang  ||
    $ListLangs[lang] == $Language}
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

{* Style selector *}
          <tr>
            <td>
              <label for="language">{$Form.Skin_text}</label>
              <span class="required_field">*</span>
            </td>

            <td>
              <select id="cssskin"
                      name="cssskin">
{section name=cssskin loop=$ListCSSSkins}
{if $ListCSSSkins[cssskin] == $UserCSSSkin && $POSTCSSSkin == "" ||
    $ListCSSSkins[cssskin] == $POSTCSSSkin ||
    $ListCSSSkins[cssskin] == $Style}
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

{* Password (as a authentification) *}
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
{elseif $POSTPassword == "bad"}
    <span class="form_error">
      {$Messages.Bad_Password_err}
    </span>
{else}
    &nbsp;
{/if}
            </td>
          </tr>

{* Profile button *}
          <tr>
            <td>&nbsp;</td>
            <td>
              <input class="button"
                     id="bu_profile"
                     name="bu_profile"
                     title="{$Form.Submit_title}"
                     type="submit"
                     value="{$Form.Submit_text}" />
            </td>
            <td>&nbsp;</td>
          </tr>

        </table>
      </form>

