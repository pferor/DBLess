    </div>
    <!-- End of page content -->

    <hr />

    <div id="footer">

      <div id="syndication">
        <a href="{$RSSFeedFile}?lang={$Language}"
           rel="alternate"
           title="{$Navigation.Syndication_title}"
           >{$Navigation.Syndication_title}</a>
      </div>

      <div id="validation">
        <a href="http://validator.w3.org/check?uri=referer"
           title="{$Validation.Valid_XHTML}">XHTML 1.0</a>
        |
        <a href="http://jigsaw.w3.org/css-validator/check/referer"
           title="{$Validation.Valid_CSS}">CSS 2.1</a>
        |
        <a href="http://feed2.w3.org/check.cgi?url={$RSSFeed}"
           title="{$Validation.Valid_RSS}">RSS 2.0</a>
        |
        <a href="http://www.w3.org/WAI/WCAG1AA-Conformance"
           title="{$Validation.Valid_WCAG}">WAI-AA WCAG 1.0</a>
        </div>

    </div>

  </body>
</html>

