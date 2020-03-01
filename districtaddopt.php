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
$district_addopt = new district_addopt();

// Run the page
$district_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$district_addopt->Page_Render();
?>
<script>
var fdistrictaddopt, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "addopt";
	fdistrictaddopt = currentForm = new ew.Form("fdistrictaddopt", "addopt");

	// Validate form
	fdistrictaddopt.validate = function() {
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
			<?php if ($district_addopt->district_division_id->Required) { ?>
				elm = this.getElements("x" + infix + "_district_division_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $district_addopt->district_division_id->caption(), $district_addopt->district_division_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($district_addopt->district_name->Required) { ?>
				elm = this.getElements("x" + infix + "_district_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $district_addopt->district_name->caption(), $district_addopt->district_name->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fdistrictaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdistrictaddopt.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdistrictaddopt.lists["x_district_division_id"] = <?php echo $district_addopt->district_division_id->Lookup->toClientList($district_addopt) ?>;
	fdistrictaddopt.lists["x_district_division_id"].options = <?php echo JsonEncode($district_addopt->district_division_id->lookupOptions()) ?>;
	loadjs.done("fdistrictaddopt");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $district_addopt->showPageHeader(); ?>
<?php
$district_addopt->showMessage();
?>
<form name="fdistrictaddopt" id="fdistrictaddopt" class="ew-form ew-horizontal" action="<?php echo Config("API_URL") ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="<?php echo Config("API_ACTION_NAME") ?>" id="<?php echo Config("API_ACTION_NAME") ?>" value="<?php echo Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?php echo Config("API_OBJECT_NAME") ?>" id="<?php echo Config("API_OBJECT_NAME") ?>" value="<?php echo $district_addopt->TableVar ?>">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($district_addopt->district_division_id->Visible) { // district_division_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_district_division_id"><?php echo $district_addopt->district_division_id->caption() ?><?php echo $district_addopt->district_division_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_district_division_id"><?php echo EmptyValue(strval($district_addopt->district_division_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $district_addopt->district_division_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($district_addopt->district_division_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($district_addopt->district_division_id->ReadOnly || $district_addopt->district_division_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_district_division_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $district_addopt->district_division_id->Lookup->getParamTag($district_addopt, "p_x_district_division_id") ?>
<input type="hidden" data-table="district" data-field="x_district_division_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $district_addopt->district_division_id->displayValueSeparatorAttribute() ?>" name="x_district_division_id" id="x_district_division_id" value="<?php echo $district_addopt->district_division_id->CurrentValue ?>"<?php echo $district_addopt->district_division_id->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($district_addopt->district_name->Visible) { // district_name ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_district_name"><?php echo $district_addopt->district_name->caption() ?><?php echo $district_addopt->district_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="district" data-field="x_district_name" name="x_district_name" id="x_district_name" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($district_addopt->district_name->getPlaceHolder()) ?>" value="<?php echo $district_addopt->district_name->EditValue ?>"<?php echo $district_addopt->district_name->editAttributes() ?>>
</div>
	</div>
<?php } ?>
</form>
<?php
$district_addopt->showPageFooter();
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
$district_addopt->terminate();
?>