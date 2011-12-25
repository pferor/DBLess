{* Language bar template *}

{* Displays a language bar *}
{section name=lang loop=$ListLangs}

{if $ListLangs[lang] != $Language}
  [<a class="language"
      href=".?pg={$_front_}&amp;lang={$ListLangs[lang]}"
      title="">{$ListLangs[lang]}</a>]&nbsp;
{/if}

{sectionelse}
<!-- No languages -->
  <div class="error">
  ?? TODO ??
  </div>
{/section}

