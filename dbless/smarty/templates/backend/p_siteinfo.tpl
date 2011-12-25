{* Site info. template *}
<div class="site_info">

  <h3>{$Navigation.SiteInfo_title}</h3>

{* Get messages *}
{if $FORMAction == "saved"}
  <div class="success">
    {$Messages.SaveSiteInfo_suc}
  </div>
{elseif $FORMAction == "fail"}
  <div class="error">
    {$Messages.SaveSiteInfoCannot_err}
  </div>
{/if}

  <form action="{$SiteActs}?lang={$Language}"
	id="siteinfo"
	method="post">
    <fieldset>
      <legend>{$Form.SiteInfo_field}</legend>
      <table id="site_info">
	<tr>
          <td>
	    <label for="site_name">{$Form.SiteName_text} <span class="required_field">*</span></label>
	  </td>
          <td>
            <input class="wider"
                   name="site_name"
                   id="site_name"
                   title="{$Form.SiteName_text}"
                   type="text"
                   value="{$SiteShortName}" />
          </td>
	  <td class="field_info">
{if $POSTSiteName == "blank"}
    <span class="form_error">
      {$Messages.BlankSitename_err}
    </span>
{else}
    &nbsp;
{/if}	    
	  </td>
	</tr>

	<tr>
          <td><label for="site_description">{$Form.SiteDescription_text}</label></td>
          <td colspan="2">
            <input class="wider"
                   name="site_description"
                   id="site_description"
                   title="{$Form.SiteDescription_text}"
                   type="text"
                   value="{$SiteLongName}" />
          </td>
	</tr>

	<tr>
          <td><label for="site_tip">{$Form.SiteTip_text}</label></td>
          <td colspan="2">
            <input class="wider"
                   name="site_tip"
                   id="site_tip"
                   title="{$Form.SiteTip_text}"
                   type="text"
                   value="{$SiteMainTip}" />
          </td>
	</tr>

	<tr>
          <td>&nbsp;</td>
          <td colspan="2">
            <input class="button"
                   name="bu_save_name"
                   id="bu_save_name"
                   title="{$Actions.Save_title}"
                   type="submit"
                   value="{$Actions.Save_text}" />
          </td>
	</tr>

      </table>
    </fieldset>
  </form>

  <form action="{$SiteActs}?lang={$Language}"
	id="licenseinfo"
	method="post">
    <fieldset>
      <legend>{$Form.LicenseInfo_field}</legend>

      <table id="site_license">
	<tr>
          <td><label for="license_name">{$Form.LicenseName_text}</label></td>
          <td colspan="2">
            <input class="wider"
                   name="license_name"
                   id="license_name"
                   title="{$Form.LicenseName_text}"
                   type="text"
                   value="{$SiteLicenseText}" />
          </td>
	</tr>

	<tr>
          <td><label for="licencse_description">{$Form.LicenseDescription_text}</label></td>
          <td colspan="2">
            <input class="wider"
                   name="license_description"
                   id="license_description"
                   title="{$Form.LicenseDescription_text}"
                   type="text"
                   value="{$SiteLicenseTitle}" />
          </td>
	</tr>

	<tr>
          <td><label for="license_uri">{$Form.LicenseURI_text}</label></td>
          <td colspan="2">
            <input class="wider"
                   name="license_uri"
                   id="license_uri"
                   title="{$Form.LicenseURI_text}"
                   type="text"
                   value="{$SiteLicenseURI}" />
          </td>
	</tr>

	<tr>
          <td>&nbsp;</td>
          <td colspan="2">
            <input class="button"
                   name="bu_save_license"
                   id="bu_save_license2"
                   title="{$Actions.Save_title}"
                   type="submit"
                   value="{$Actions.Save_text}" />
          </td>
	</tr>

      </table>

    </fieldset>
  </form>

</div>

