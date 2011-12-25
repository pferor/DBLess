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
             href="?pg={$_front}&amp;lang={$Language}"
             title="{$Navigation.Home_title}"
             >{$Navigation.Home_text}</a></li>
{/if}


{if $CurrentPageName == $_posts_ || $CurrentPageName == $_post_}
      <li class="selected"><a accesskey="2"
                              href="?pg={$_posts_}&amp;lang={$Language}"
                              title="{$Navigation.Posts_title}"
                              >{$Navigation.Posts_text}</a></li>
{else}
      <li><a accesskey="2"
             href="?pg={$_posts_}&amp;lang={$Language}"
             title="{$Navigation.Posts_title}"
             >{$Navigation.Posts_text}</a></li>
{/if}


{if $CurrentPageName == $_comments_ || $CurrentPageName == $_comment_}
      <li class="selected"><a accesskey="3"
                              href="?pg={$_comments_}&amp;lang={$Language}"
                              title="{$Navigation.Comments_title}"
                              >{$Navigation.Comments_text}</a></li>
{else}
      <li><a accesskey="3"
             href="?pg={$_comments_}&amp;lang={$Language}"
             title="{$Navigation.Comments_title}"
             >{$Navigation.Comments_text}</a></li>
{/if}


{if $CurrentPageName == $_users_ || $CurrentPageName == $_user_}
      <li class="selected"><a accesskey="4"
                              href="?pg={$_users_}&amp;lang={$Language}"
                              title="{$Navigation.Users_title}"
                              >{$Navigation.Users_text}</a></li>
{else}
      <li><a accesskey="4"
             href="?pg={$_users_}&amp;lang={$Language}"
             title="{$Navigation.Users_title}"
             >{$Navigation.Users_text}</a></li>
{/if}


{if $CurrentPageName == $_siteinfo_}
      <li class="selected"><a accesskey="4"
                              href="?pg={$_siteinfo_}&amp;lang={$Language}"
                              title="{$Navigation.SiteInfo_title}"
                              >{$Navigation.SiteInfo_text}</a></li>
{else}
      <li><a accesskey="4"
             href="?pg={$_siteinfo_}&amp;lang={$Language}"
             title="{$Navigation.SiteInfo_title}"
             >{$Navigation.SiteInfo_text}</a></li>
{/if}


{if $CurrentPageName == $_logout_}
      <li class="selected"><a accesskey="5"
                              href="?pg={$_logout_}&amp;lang={$Language}"
                              title="{$Navigation.Logout_title}"
                              >{$Navigation.Logout_text} [{$Username}]</a></li>
{else}
      <li><a accesskey="5"
             href="?pg={$_logout_}&amp;lang={$Language}"
             title="{$Navigation.Logout_title}"
             >{$Navigation.Logout_text} [{$Username}]</a></li>
{/if}


    </ul>

  </div>

