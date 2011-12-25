{* Contact form template *}

  <h3>{$Navigation.Contact_title}</h3>

{* Get messages *}
{if $FORMMail == "sent"}
  <div class="success">
    {$Messages.Message_Sent_suc}
  </div>
{elseif $FORMMail == "fail"}
  <div class="error">
    {$Messages.Message_Sent_err}
  </div>

{else}


{* Show some info. *}
  <div class="contact">

    <div class="contactinfo">
{if $FormsInfo.Contact_info != ""}
      <p>
        {$FormsInfo.Contact_info}
      </p>
{/if}
{if $FormsInfo.Contact_warning != ""}
      <p>
        {$FormsInfo.Contact_warning}
      </p>
{/if}

    </div>


{* Display the form *}
    <div class="contact_form">
{include file="$DirFrontend/f_contact.tpl"}
    </div>

  </div>
{/if}

