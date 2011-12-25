{* Profile change password template *}

      <form action="{$ProfileActs}?lang={$Language}"
            id="profile_password"
            method="post">
        <table class="profile">

{* Old passord field*}
          <tr>
            <td>
              <label for="password0">{$Form.Password0_text}</label>
              <span class="required_field">*</span>
            </td>
            <td>
              <input id="username_hidden"
                     name="username_hidden"
                     title="{$Form.Name_title}"
                     type="hidden"
                     value="{$Username}" />
              <input id="password0"
                     name="password0"
                     title="{$Form.Password0_title}"
                     type="password"
                     value="" />
            </td>
            <td class="field_info">
{if $POSTPassword0 == "blank"}
    <span class="form_error">
      {$Messages.Short_Password_err}
    </span>
{elseif $POSTPassword0 == "bad"}
    <span class="form_error">
      {$Messages.Bad_Password_err}
    </span>
{else}
    &nbsp;
{/if}
            </td>
          </tr>

{* First password field *}
          <tr>
            <td>
              <label for="password1">{$Form.Password1_text}</label>
              <span class="required_field">*</span>
            </td>
            <td>
              <input id="password1"
                     name="password1"
                     title="{$Form.Password1_title}"
                     type="password"
                     value="" />
            </td>
            <td class="field_info"
                rowspan="2">
{if $POSTPassword2 == "blank"}
    <span class="form_error">
      {$Messages.Short_Password_err}
    </span>
{elseif $POSTPassword2 == "same"}
    <span class="form_error">
      {$Messages.PasswordIsName_err}
    </span>
{elseif $POSTPassword2 == "match"}
    <span class="form_error">
      {$Messages.Match_Password_err}
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

{* Submit button *}
          <tr>
            <td>&nbsp;</td>
            <td>
              <input class="button"
                     id="bu_profile_password"
                     name="bu_profile_password"
                     title="{$Form.Submit_title}"
                     type="submit"
                     value="{$Form.Submit_text}" />
            </td>
            <td>&nbsp;</td>
          </tr>

        </table>
      </form>

