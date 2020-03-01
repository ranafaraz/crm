<?php
namespace PHPMaker2020\crm_live;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$services_addopt = new services_addopt();

// Run the page
$services_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$services_addopt->Page_Render();
?>
<script>
var fservicesaddopt, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "addopt";
	fservicesaddopt = currentForm = new ew.Form("fservicesaddopt", "addopt");

	// Validate form
	fservicesaddopt.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "F")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($services_addopt->service_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_service_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_addopt->service_branch_id->caption(), $services_addopt->service_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($services_addopt->service_caption->Required) { ?>
				elm = this.getElements("x" + infix + "_service_caption");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_addopt->service_caption->caption(), $services_addopt->service_caption->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($services_addopt->service_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_service_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_addopt->service_desc->caption(), $services_addopt->service_desc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($services_addopt->service_logo->Required) { ?>
				felm = this.getElements("x" + infix + "_service_logo");
				elm = this.getElements("fn_x" + infix + "_service_logo");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $services_addopt->service_logo->caption(), $services_addopt->service_logo->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fservicesaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fservicesaddopt.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fservicesaddopt.lists["x_service_branch_id"] = <?php echo $services_addopt->service_branch_id->Lookup->toClientList($services_addopt) ?>;
	fservicesaddopt.lists["x_service_branch_id"].options = <?php echo JsonEncode($services_addopt->service_branch_id->lookupOptions()) ?>;
	loadjs.done("fservicesaddopt");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $services_addopt->showPageHeader(); ?>
<?php
$services_addopt->showMessage();
?>
<form name="fservicesaddopt" id="fservicesaddopt" class="ew-form ew-horizontal" action="<?php echo Config("API_URL") ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="<?php echo Config("API_ACTION_NAME") ?>" id="<?php echo Config("API_ACTION_NAME") ?>" value="<?php echo Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?php echo Config("API_OBJECT_NAME") ?>" id="<?php echo Config("API_OBJECT_NAME") ?>" value="<?php echo $services_addopt->TableVar ?>">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($services_addopt->service_branch_id->Visible) { // service_branch_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_service_branch_id"><?php echo $services_addopt->service_branch_id->caption() ?><?php echo $services_addopt->service_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($services_addopt->service_branch_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $services_addopt->service_branch_id->ViewValue ?></button>
		<div id="dsl_x_service_branch_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $services_addopt->service_branch_id->radioButtonListHtml(TRUE, "x_service_branch_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_service_branch_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="services" data-field="x_service_branch_id" data-value-separator="<?php echo $services_addopt->service_branch_id->displayValueSeparatorAttribute() ?>" name="x_service_branch_id" id="x_service_branch_id" value="{value}"<?php echo $services_addopt->service_branch_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$services_addopt->service_branch_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $services_addopt->service_branch_id->Lookup->getParamTag($services_addopt, "p_x_service_branch_id") ?>
</div>
	</div>
<?php } ?>
<?php if ($services_addopt->service_caption->Visible) { // service_caption ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_service_caption"><?php echo $services_addopt->service_caption->caption() ?><?php echo $services_addopt->service_caption->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="services" data-field="x_service_caption" name="x_service_caption" id="x_service_caption" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($services_addopt->service_caption->getPlaceHolder()) ?>" value="<?php echo $services_addopt->service_caption->EditValue ?>"<?php echo $services_addopt->service_caption->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($services_addopt->service_desc->Visible) { // service_desc ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label"><?php echo $services_addopt->service_desc->caption() ?><?php echo $services_addopt->service_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<?php $services_addopt->service_desc->EditAttrs->appendClass("editor"); ?>
<textarea data-table="services" data-field="x_service_desc" name="x_service_desc" id="x_service_desc" cols="35" rows="4" placeholder="<?php echo HtmlEncode($services_addopt->service_desc->getPlaceHolder()) ?>"<?php echo $services_addopt->service_desc->editAttributes() ?>><?php echo $services_addopt->service_desc->EditValue ?></textarea>
<script>
loadjs.ready(["fservicesaddopt", "editor"], function() {
	ew.createEditor("fservicesaddopt", "x_service_desc", 35, 4, <?php echo $services_addopt->service_desc->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</div>
	</div>
<?php } ?>
<?php if ($services_addopt->service_logo->Visible) { // service_logo ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label"><?php echo $services_addopt->service_logo->caption() ?><?php echo $services_addopt->service_logo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div id="fd_x_service_logo">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $services_addopt->service_logo->title() ?>" data-table="services" data-field="x_service_logo" name="x_service_logo" id="x_service_logo" lang="<?php echo CurrentLanguageID() ?>"<?php echo $services_addopt->service_logo->editAttributes() ?><?php if ($services_addopt->service_logo->ReadOnly || $services_addopt->service_logo->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_service_logo"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_service_logo" id= "fn_x_service_logo" value="<?php echo $services_addopt->service_logo->Upload->FileName ?>">
<input type="hidden" name="fa_x_service_logo" id= "fa_x_service_logo" value="0">
<input type="hidden" name="fs_x_service_logo" id= "fs_x_service_logo" value="100">
<input type="hidden" name="fx_x_service_logo" id= "fx_x_service_logo" value="<?php echo $services_addopt->service_logo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_service_logo" id= "fm_x_service_logo" value="<?php echo $services_addopt->service_logo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_service_logo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</div>
	</div>
<?php } ?>
</form>
<?php
$services_addopt->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php
$services_addopt->terminate();
?>