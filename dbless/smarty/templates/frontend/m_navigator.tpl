{* Navigator template *}
  <div id="main_navigator">
    <ul>

{if $CurrentPageName == $_front_}
      <li class="selected"><a accesskey="1"
                              href="?pg={$_front_}&amp;lang={$Language}"
                              title="{$Navigation.Home_title}"
                              >{$Navigation.Home_text}</a></li>
{else}
      <li><a accesskey="1"
             href="?pg={$_front_}&amp;lang={$Language}"
             title="{$Navigation.Home_title}"
             >{$Navigation.Home_text}</a></li>
{/if}


{if $CurrentPageName == $_archive_}
      <li class="selected"><a accesskey="2"
                              href="?pg={$_archive_}&amp;lang={$Language}"
                              title="{$Navigation.Archive_title}"
                              >{$Navigation.Archive_text}</a></li>
{else}
      <li><a accesskey="2"
             href="?pg={$_archive_}&amp;lang={$Language}"
             title="{$Navigation.Archive_title}"
             >{$Navigation.Archive_text}</a></li>
{/if}


{if $CurrentPageName == $_about_}
      <li class="selected"><a accesskey="3"
                              href="?pg={$_about_}&amp;lang={$Language}"
                              title="{$Navigation.About_title}"
                              >{$Navigation.About_text}</a></li>
{else}
      <li><a accesskey="3"
             href="?pg={$_about_}&amp;lang={$Language}"
             title="{$Navigation.About_title}"
             >{$Navigation.About_text}</a></li>
{/if}


{if $CurrentPageName == $_contact_}
      <li class="selected"><a accesskey="4"
                              href="?pg={$_contact_}&amp;lang={$Language}"
                              title="{$Navigation.Contact_title}"
                              >{$Navigation.Contact_text}</a></li>
{else}
      <li><a accesskey="4"
             href="?pg={$_contact_}&amp;lang={$Language}"
             title="{$Navigation.Contact_title}"
             >{$Navigation.Contact_text}</a></li>
{/if}

{if $UserLoggedIn}
      {if $CurrentPageName == $_profile_}
      <li class="selected"><a accesskey="6"
                              href="?pg={$_profile_}&amp;lang={$Language}"
                              title="{$Navigation.Logout_title}"
                              >{$Navigation.Profile_text}</a></li>
      {else}
      <li><a accesskey="6"
             href="?pg={$_profile_}&amp;lang={$Language}"
             title="{$Navigation.Profile_title}"
             >{$Navigation.Profile_text}</a></li>
      {/if}
{else}
      {if $CurrentPageName == $_join_}
      <li class="selected"><a accesskey="6"
                              href="?pg={$_join_}&amp;lang={$Language}"
                              title="{$Navigation.Join_title}"
                              >{$Navigation.Join_text}</a></li>
      {else}
      <li><a accesskey="6"
             href="?pg={$_join_}&amp;lang={$Language}"
             title="{$Navigation.Join_title}"
             >{$Navigation.Join_text}</a></li>
      {/if}
{/if}

{if $UserLoggedIn}
      {if $CurrentPageName == $_logout_}
      <li class="selected"><a accesskey="6"
                              href="?pg={$_logout_}&amp;lang={$Language}"
                              title="{$Navigation.Logout_title}"
                              >{$Navigation.Logout_text} [{$Username}]</a></li>
      {else}
      <li><a accesskey="6"
             href="?pg={$_logout_}&amp;lang={$Language}"
             title="{$Navigation.Logout_title}"
             >{$Navigation.Logout_text} [{$Username}]</a></li>
      {/if}
{else}
      {if $CurrentPageName == $_login_}
      <li class="selected"><a accesskey="6"
                              href="?pg={$_login_}&amp;lang={$Language}"
                              title="{$Navigation.Login_title}"
                              >{$Navigation.Login_text}</a></li>
      {else}
      <li><a accesskey="6"
             href="?pg={$_login_}&amp;lang={$Language}"
             title="{$Navigation.Login_title}"
             >{$Navigation.Login_text}</a></li>
      {/if}
{/if}

    </ul>

  </div>

