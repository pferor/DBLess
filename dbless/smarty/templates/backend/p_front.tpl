{* Administration front page *}

{* Log file *}
<div class="logfile">
  <h3>‘{$LogFileName}’ ({$LogFileSize})</h3>

  <form action="{$LogFileActs}?lang=&{$Language}"
	id="logfile"
	method="post">
    <div>
      <input class="button delete"
	     name="bu_delete"
	     id="bu_delete"
	     title="{$Actions.Delete_title}"
	     type="submit"
	     value="{$Actions.Delete_text}" />
    </div>
  </form>


  <pre id="logcontent">{$LogFileText}</pre>

</div>
