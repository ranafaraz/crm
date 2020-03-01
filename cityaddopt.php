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
$city_addopt = new city_addopt();

// Run the page
$city_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$city_addopt->Page_Render();
?>
<script>
var fcityaddopt, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "addopt";
	fcityaddopt = currentForm = new ew.Form("fcityaddopt", "addopt");

	// Validate form
	fcityaddopt.validate = function() {
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
			<?php if ($city_addopt->city_tehsil_id->Required) { ?>
				elm = this.getElements("x" + infix + "_city_tehsil_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $city_addopt->city_tehsil_id->caption(), $city_addopt->city_tehsil_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($city_addopt->city_name->Required) { ?>
				elm = this.getElements("x" + infix + "_city_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $city_addopt->city_name->caption(), $city_addopt->city_name->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fcityaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcityaddopt.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcityaddopt.lists["x_city_tehsil_id"] = <?php echo $city_addopt->city_tehsil_id->Lookup->toClientList($city_addopt) ?>;
	fcityaddopt.lists["x_city_tehsil_id"].options = <?php echo JsonEncode($city_addopt->city_tehsil_id->lookupOptions()) ?>;
	loadjs.done("fcityaddopt");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $city_addopt->showPageHeader(); ?>
<?php
$city_addopt->showMessage();
?>
<form name="fcityaddopt" id="fcityaddopt" class="ew-form ew-horizontal" action="<?php echo Config("API_URL") ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="<?php echo Config("API_ACTION_NAME") ?>" id="<?php echo Config("API_ACTION_NAME") ?>" value="<?php echo Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?php echo Config("API_OBJECT_NAME") ?>" id="<?php echo Config("API_OBJECT_NAME") ?>" value="<?php echo $city_addopt->TableVar ?>">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($city_addopt->city_tehsil_id->Visible) { // city_tehsil_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_city_tehsil_id"><?php echo $city_addopt->city_tehsil_id->caption() ?><?php echo $city_addopt->city_tehsil_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_city_tehsil_id"><?php echo EmptyValue(strval($city_addopt->city_tehsil_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $city_addopt->city_tehsil_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($city_addopt->city_tehsil_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($city_addopt->city_tehsil_id->ReadOnly || $city_addopt->city_tehsil_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_city_tehsil_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $city_addopt->city_tehsil_id->Lookup->getParamTag($city_addopt, "p_x_city_tehsil_id") ?>
<input type="hidden" data-table="city" data-field="x_city_tehsil_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $city_addopt->city_tehsil_id->displayValueSeparatorAttribute() ?>" name="x_city_tehsil_id" id="x_city_tehsil_id" value="<?php echo $city_addopt->city_tehsil_id->CurrentValue ?>"<?php echo $city_addopt->city_tehsil_id->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($city_addopt->city_name->Visible) { // city_name ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_city_name"><?php echo $city_addopt->city_name->caption() ?><?php echo $city_addopt->city_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="city" data-field="x_city_name" name="x_city_name" id="x_city_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($city_addopt->city_name->getPlaceHolder()) ?>" value="<?php echo $city_addopt->city_name->EditValue ?>"<?php echo $city_addopt->city_name->editAttributes() ?>>
</div>
	</div>
<?php } ?>
</form>
<?php
$city_addopt->showPageFooter();
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
$city_addopt->terminate();
?>