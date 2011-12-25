{* Main template loader *}
{include file          = "$DirFrontend/h_header.tpl"
         PageTitle     = "$SiteShortName"
         Language      = "$Language"
         Charset       = "$Charset"
         TextDirection = "$TextDirection"
         CSSSkin       = "$CSSSkin"
         RSSFeed       = "$RSSFeed"
         FavIcon       = "$FavIcon"
}

{* Load each page *}
{if     $CurrentPageName == $_front_}    {include file = "$DirFrontend/p_front.tpl"}
{elseif $CurrentPageName == $_about_}    {include file = "$DirFrontend/p_about.tpl"}
{elseif $CurrentPageName == $_archive_}  {include file = "$DirFrontend/p_archive.tpl"}
{elseif $CurrentPageName == $_contact_}  {include file = "$DirFrontend/p_contact.tpl"}
{elseif $CurrentPageName == $_login_}    {include file = "$DirFrontend/p_login.tpl"}
{elseif $CurrentPageName == $_logout_}   {include file = "$DirFrontend/p_logout.tpl"}
{elseif $CurrentPageName == $_join_}     {include file = "$DirFrontend/p_join.tpl"}
{elseif $CurrentPageName == $_post_}     {include file = "$DirFrontend/p_post.tpl"}
{elseif $CurrentPageName == $_profile_}  {include file = "$DirFrontend/p_profile.tpl"}
{elseif $CurrentPageName == $_search_}   {include file = "$DirFrontend/p_search.tpl"}
{elseif $CurrentPageName == $_tags_}     {include file = "$DirFrontend/p_tags.tpl"}
{else}                                   {include file = "$DirFrontend/p_front.tpl"}
{/if}

{include file = "$DirFrontend/h_footer.tpl"}

