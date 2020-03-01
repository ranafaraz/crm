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
$division_addopt = new division_addopt();

// Run the page
$division_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$division_addopt->Page_Render();
?>
<script>
var fdivisionaddopt, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "addopt";
	fdivisionaddopt = currentForm = new ew.Form("fdivisionaddopt", "addopt");

	// Validate form
	fdivisionaddopt.validate = function() {
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
			<?php if ($division_addopt->division_state_id->Required) { ?>
				elm = this.getElements("x" + infix + "_division_state_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_addopt->division_state_id->caption(), $division_addopt->division_state_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($division_addopt->division_name->Required) { ?>
				elm = this.getElements("x" + infix + "_division_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_addopt->division_name->caption(), $division_addopt->division_name->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fdivisionaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdivisionaddopt.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdivisionaddopt.lists["x_division_state_id"] = <?php echo $division_addopt->division_state_id->Lookup->toClientList($division_addopt) ?>;
	fdivisionaddopt.lists["x_division_state_id"].options = <?php echo JsonEncode($division_addopt->division_state_id->lookupOptions()) ?>;
	loadjs.done("fdivisionaddopt");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $division_addopt->showPageHeader(); ?>
<?php
$division_addopt->showMessage();
?>
<form name="fdivisionaddopt" id="fdivisionaddopt" class="ew-form ew-horizontal" action="<?php echo Config("API_URL") ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="<?php echo Config("API_ACTION_NAME") ?>" id="<?php echo Config("API_ACTION_NAME") ?>" value="<?php echo Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?php echo Config("API_OBJECT_NAME") ?>" id="<?php echo Config("API_OBJECT_NAME") ?>" value="<?php echo $division_addopt->TableVar ?>">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($division_addopt->division_state_id->Visible) { // division_state_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_division_state_id"><?php echo $division_addopt->division_state_id->caption() ?><?php echo $division_addopt->division_state_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_division_state_id"><?php echo EmptyValue(strval($division_addopt->division_state_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $division_addopt->division_state_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($division_addopt->division_state_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($division_addopt->division_state_id->ReadOnly || $division_addopt->division_state_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_division_state_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $division_addopt->division_state_id->Lookup->getParamTag($division_addopt, "p_x_division_state_id") ?>
<input type="hidden" data-table="division" data-field="x_division_state_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $division_addopt->division_state_id->displayValueSeparatorAttribute() ?>" name="x_division_state_id" id="x_division_state_id" value="<?php echo $division_addopt->division_state_id->CurrentValue ?>"<?php echo $division_addopt->division_state_id->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($division_addopt->division_name->Visible) { // division_name ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_division_name"><?php echo $division_addopt->division_name->caption() ?><?php echo $division_addopt->division_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="division" data-field="x_division_name" name="x_division_name" id="x_division_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($division_addopt->division_name->getPlaceHolder()) ?>" value="<?php echo $division_addopt->division_name->EditValue ?>"<?php echo $division_addopt->division_name->editAttributes() ?>>
</div>
	</div>
<?php } ?>
</form>
<?php
$division_addopt->showPageFooter();
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
$division_addopt->terminate();
?>