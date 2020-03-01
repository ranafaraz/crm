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
$state_addopt = new state_addopt();

// Run the page
$state_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$state_addopt->Page_Render();
?>
<script>
var fstateaddopt, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "addopt";
	fstateaddopt = currentForm = new ew.Form("fstateaddopt", "addopt");

	// Validate form
	fstateaddopt.validate = function() {
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
			<?php if ($state_addopt->state_country_id->Required) { ?>
				elm = this.getElements("x" + infix + "_state_country_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $state_addopt->state_country_id->caption(), $state_addopt->state_country_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($state_addopt->state_name->Required) { ?>
				elm = this.getElements("x" + infix + "_state_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $state_addopt->state_name->caption(), $state_addopt->state_name->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fstateaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstateaddopt.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstateaddopt.lists["x_state_country_id"] = <?php echo $state_addopt->state_country_id->Lookup->toClientList($state_addopt) ?>;
	fstateaddopt.lists["x_state_country_id"].options = <?php echo JsonEncode($state_addopt->state_country_id->lookupOptions()) ?>;
	loadjs.done("fstateaddopt");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $state_addopt->showPageHeader(); ?>
<?php
$state_addopt->showMessage();
?>
<form name="fstateaddopt" id="fstateaddopt" class="ew-form ew-horizontal" action="<?php echo Config("API_URL") ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="<?php echo Config("API_ACTION_NAME") ?>" id="<?php echo Config("API_ACTION_NAME") ?>" value="<?php echo Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?php echo Config("API_OBJECT_NAME") ?>" id="<?php echo Config("API_OBJECT_NAME") ?>" value="<?php echo $state_addopt->TableVar ?>">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($state_addopt->state_country_id->Visible) { // state_country_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_state_country_id"><?php echo $state_addopt->state_country_id->caption() ?><?php echo $state_addopt->state_country_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_state_country_id"><?php echo EmptyValue(strval($state_addopt->state_country_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $state_addopt->state_country_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($state_addopt->state_country_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($state_addopt->state_country_id->ReadOnly || $state_addopt->state_country_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_state_country_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $state_addopt->state_country_id->Lookup->getParamTag($state_addopt, "p_x_state_country_id") ?>
<input type="hidden" data-table="state" data-field="x_state_country_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $state_addopt->state_country_id->displayValueSeparatorAttribute() ?>" name="x_state_country_id" id="x_state_country_id" value="<?php echo $state_addopt->state_country_id->CurrentValue ?>"<?php echo $state_addopt->state_country_id->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($state_addopt->state_name->Visible) { // state_name ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_state_name"><?php echo $state_addopt->state_name->caption() ?><?php echo $state_addopt->state_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="state" data-field="x_state_name" name="x_state_name" id="x_state_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($state_addopt->state_name->getPlaceHolder()) ?>" value="<?php echo $state_addopt->state_name->EditValue ?>"<?php echo $state_addopt->state_name->editAttributes() ?>>
</div>
	</div>
<?php } ?>
</form>
<?php
$state_addopt->showPageFooter();
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
$state_addopt->terminate();
?>