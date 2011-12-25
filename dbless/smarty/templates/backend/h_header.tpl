{* Header template *}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
          "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html
   xmlns="http://www.w3.org/1999/xhtml"
   xml:lang="{$Language}" dir="{$TextDirection}" id="top">

  <head>
    <meta http-equiv="content-type" content="text/html; charset={$Charset}" />
    <meta name="author" content="Pferor" />
    <title>{$PageTitle}</title>
    <link rel="stylesheet" type="text/css" media="screen" href="{$CSSSkin}" />
    <link rel="shortcut icon" type="image/x-icon" href="{$FavIcon}" />
    <link rel="alternate" type="application/rss+xml" title="RSS" href="{$RSSFeed}" />
  </head>

  <body lang="{$Language}">

    <!-- Main title table -->
    <div id="main_title">
      <div id="main_options">

{* Frontend link *}
        <div id="administration_link">
          [<a id="administration_link"
             href="./index.php?lang={$Language}"
             title="{$Navigation.FrontendLink_title}">{$Navigation.FrontendLink_text}</a>]&nbsp;
        </div>


{* Show the language bar only when there are more than 1 language *}
{if $CountLangs > 1}
        <div id="languages_bar">
{include file ="$DirBackend/m_language.tpl"}
        </div>
{/if}
      </div>

      <div id="site_name">
        <h1><a href=".?lang={$Language}"
               tabindex="-1"
               title="{$SiteLongName}">{$SiteShortName}</a></h1>
        <h2>{$Navigation.Admin_title}</h2>
      </div>

    </div>

    <!-- Navigator menu -->
{include
    file="$DirBackend/m_navigator.tpl"
    Language="$Language"}

    <!-- Site content -->
    <div id="content">

