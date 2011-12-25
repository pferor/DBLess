{* Logout template *}

  <h3>{$Navigation.Logout_title}</h3>


{if $UserLoggedIn}
  <div class="logout">


{* Show some info. *}
    <div class="logout_info">
{if $FormsInfo.Logout_info != ""}
      <p>
        {$FormsInfo.Logout_info}
      </p>
{/if}
{if $FormsInfo.Logout_warning != ""}
      <p>
        {$FormsInfo.Logout_warning}
      </p>
{/if}
    </div>


{* Display the form *}
    <div class="logout_form">
      <form action="{$LogoutActs}?lang={$Language}"
            id="logout"
            method="post">
        <table class="logout">

          <tr>
            <td>
              <input class="button logout_button"
                     id="bu_logout"
                     name="bu_logout"
                     title="{$Navigation.Logout_title}"
                     type="submit"
                     value="{$Navigation.Logout_title}" />
              <td>
          </tr>

        </table>
    </div>

  </div>

{else}
  <div class="success">
    {$FormsInfo.Logout_OK}
  </div>
{/if}

