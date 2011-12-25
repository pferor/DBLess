{* Main teplate loader *}

{include file          = "$DirBackend/h_header.tpl"
         PageTitle     = "$SiteShortName"
         Language      = "$Language"
         Charset       = "$Charset"
         TextDirection = "$TextDirection"
         CSSSkin       = "$CSSSkin"
         FavIcon       = "$FavIcon"
}

{* Load each page *}
{if     $CurrentPageName == $_front_}       {include file = "$DirBackend/p_front.tpl"}
{elseif $CurrentPageName == $_comments_}    {include file = "$DirBackend/p_comments.tpl"}
{elseif $CurrentPageName == $_killcomment_} {include file = "$DirBackend/p_killcomment.tpl"}
{elseif $CurrentPageName == $_killpost_}    {include file = "$DirBackend/p_killpost.tpl"}
{elseif $CurrentPageName == $_killuser_}    {include file = "$DirBackend/p_killuser.tpl"}
{elseif $CurrentPageName == $_logout_}      {include file = "$DirBackend/p_logout.tpl"}
{elseif $CurrentPageName == $_post_}        {include file = "$DirBackend/p_post.tpl"}
{elseif $CurrentPageName == $_posts_}       {include file = "$DirBackend/p_posts.tpl"}
{elseif $CurrentPageName == $_siteinfo_}    {include file = "$DirBackend/p_siteinfo.tpl"}
{elseif $CurrentPageName == $_users_}       {include file = "$DirBackend/p_users.tpl"}
{else}                                      {include file = "$DirBackend/p_front.tpl"}
{/if}

{include file = "$DirBackend/h_footer.tpl"}

