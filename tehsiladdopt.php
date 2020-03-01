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
$tehsil_addopt = new tehsil_addopt();

// Run the page
$tehsil_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tehsil_addopt->Page_Render();
?>
<script>
var ftehsiladdopt, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "addopt";
	ftehsiladdopt = currentForm = new ew.Form("ftehsiladdopt", "addopt");

	// Validate form
	ftehsiladdopt.validate = function() {
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
			<?php if ($tehsil_addopt->tehsil_district_id->Required) { ?>
				elm = this.getElements("x" + infix + "_tehsil_district_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tehsil_addopt->tehsil_district_id->caption(), $tehsil_addopt->tehsil_district_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tehsil_addopt->tehsil_name->Required) { ?>
				elm = this.getElements("x" + infix + "_tehsil_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tehsil_addopt->tehsil_name->caption(), $tehsil_addopt->tehsil_name->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	ftehsiladdopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftehsiladdopt.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftehsiladdopt.lists["x_tehsil_district_id"] = <?php echo $tehsil_addopt->tehsil_district_id->Lookup->toClientList($tehsil_addopt) ?>;
	ftehsiladdopt.lists["x_tehsil_district_id"].options = <?php echo JsonEncode($tehsil_addopt->tehsil_district_id->lookupOptions()) ?>;
	loadjs.done("ftehsiladdopt");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tehsil_addopt->showPageHeader(); ?>
<?php
$tehsil_addopt->showMessage();
?>
<form name="ftehsiladdopt" id="ftehsiladdopt" class="ew-form ew-horizontal" action="<?php echo Config("API_URL") ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="<?php echo Config("API_ACTION_NAME") ?>" id="<?php echo Config("API_ACTION_NAME") ?>" value="<?php echo Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?php echo Config("API_OBJECT_NAME") ?>" id="<?php echo Config("API_OBJECT_NAME") ?>" value="<?php echo $tehsil_addopt->TableVar ?>">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($tehsil_addopt->tehsil_district_id->Visible) { // tehsil_district_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_tehsil_district_id"><?php echo $tehsil_addopt->tehsil_district_id->caption() ?><?php echo $tehsil_addopt->tehsil_district_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_tehsil_district_id"><?php echo EmptyValue(strval($tehsil_addopt->tehsil_district_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $tehsil_addopt->tehsil_district_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($tehsil_addopt->tehsil_district_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($tehsil_addopt->tehsil_district_id->ReadOnly || $tehsil_addopt->tehsil_district_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_tehsil_district_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $tehsil_addopt->tehsil_district_id->Lookup->getParamTag($tehsil_addopt, "p_x_tehsil_district_id") ?>
<input type="hidden" data-table="tehsil" data-field="x_tehsil_district_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $tehsil_addopt->tehsil_district_id->displayValueSeparatorAttribute() ?>" name="x_tehsil_district_id" id="x_tehsil_district_id" value="<?php echo $tehsil_addopt->tehsil_district_id->CurrentValue ?>"<?php echo $tehsil_addopt->tehsil_district_id->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tehsil_addopt->tehsil_name->Visible) { // tehsil_name ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_tehsil_name"><?php echo $tehsil_addopt->tehsil_name->caption() ?><?php echo $tehsil_addopt->tehsil_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tehsil" data-field="x_tehsil_name" name="x_tehsil_name" id="x_tehsil_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tehsil_addopt->tehsil_name->getPlaceHolder()) ?>" value="<?php echo $tehsil_addopt->tehsil_name->EditValue ?>"<?php echo $tehsil_addopt->tehsil_name->editAttributes() ?>>
</div>
	</div>
<?php } ?>
</form>
<?php
$tehsil_addopt->showPageFooter();
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
$tehsil_addopt->terminate();
?>