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
$sms_package_add = new sms_package_add();

// Run the page
$sms_package_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_package_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsms_packageadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fsms_packageadd = currentForm = new ew.Form("fsms_packageadd", "add");

	// Validate form
	fsms_packageadd.validate = function() {
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
			<?php if ($sms_package_add->sms_pkg_sms_api_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_pkg_sms_api_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_package_add->sms_pkg_sms_api_id->caption(), $sms_package_add->sms_pkg_sms_api_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sms_package_add->sms_pkg_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_pkg_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_package_add->sms_pkg_branch_id->caption(), $sms_package_add->sms_pkg_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sms_package_add->sms_pkg_total_allowed_sms->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_pkg_total_allowed_sms");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_package_add->sms_pkg_total_allowed_sms->caption(), $sms_package_add->sms_pkg_total_allowed_sms->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sms_pkg_total_allowed_sms");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($sms_package_add->sms_pkg_total_allowed_sms->errorMessage()) ?>");
			<?php if ($sms_package_add->sms_pkg_expiry_date->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_pkg_expiry_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_package_add->sms_pkg_expiry_date->caption(), $sms_package_add->sms_pkg_expiry_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sms_pkg_expiry_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($sms_package_add->sms_pkg_expiry_date->errorMessage()) ?>");
			<?php if ($sms_package_add->sms_pkg_per_sms_cost->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_pkg_per_sms_cost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_package_add->sms_pkg_per_sms_cost->caption(), $sms_package_add->sms_pkg_per_sms_cost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sms_pkg_per_sms_cost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($sms_package_add->sms_pkg_per_sms_cost->errorMessage()) ?>");
			<?php if ($sms_package_add->sms_pkg_deal_details->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_pkg_deal_details");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_package_add->sms_pkg_deal_details->caption(), $sms_package_add->sms_pkg_deal_details->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fsms_packageadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsms_packageadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fsms_packageadd.lists["x_sms_pkg_sms_api_id"] = <?php echo $sms_package_add->sms_pkg_sms_api_id->Lookup->toClientList($sms_package_add) ?>;
	fsms_packageadd.lists["x_sms_pkg_sms_api_id"].options = <?php echo JsonEncode($sms_package_add->sms_pkg_sms_api_id->lookupOptions()) ?>;
	fsms_packageadd.lists["x_sms_pkg_branch_id"] = <?php echo $sms_package_add->sms_pkg_branch_id->Lookup->toClientList($sms_package_add) ?>;
	fsms_packageadd.lists["x_sms_pkg_branch_id"].options = <?php echo JsonEncode($sms_package_add->sms_pkg_branch_id->lookupOptions()) ?>;
	loadjs.done("fsms_packageadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sms_package_add->showPageHeader(); ?>
<?php
$sms_package_add->showMessage();
?>
<form name="fsms_packageadd" id="fsms_packageadd" class="<?php echo $sms_package_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_package">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$sms_package_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($sms_package_add->sms_pkg_sms_api_id->Visible) { // sms_pkg_sms_api_id ?>
	<div id="r_sms_pkg_sms_api_id" class="form-group row">
		<label id="elh_sms_package_sms_pkg_sms_api_id" for="x_sms_pkg_sms_api_id" class="<?php echo $sms_package_add->LeftColumnClass ?>"><?php echo $sms_package_add->sms_pkg_sms_api_id->caption() ?><?php echo $sms_package_add->sms_pkg_sms_api_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_package_add->RightColumnClass ?>"><div <?php echo $sms_package_add->sms_pkg_sms_api_id->cellAttributes() ?>>
<span id="el_sms_package_sms_pkg_sms_api_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_sms_pkg_sms_api_id"><?php echo EmptyValue(strval($sms_package_add->sms_pkg_sms_api_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $sms_package_add->sms_pkg_sms_api_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($sms_package_add->sms_pkg_sms_api_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($sms_package_add->sms_pkg_sms_api_id->ReadOnly || $sms_package_add->sms_pkg_sms_api_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_sms_pkg_sms_api_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $sms_package_add->sms_pkg_sms_api_id->Lookup->getParamTag($sms_package_add, "p_x_sms_pkg_sms_api_id") ?>
<input type="hidden" data-table="sms_package" data-field="x_sms_pkg_sms_api_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $sms_package_add->sms_pkg_sms_api_id->displayValueSeparatorAttribute() ?>" name="x_sms_pkg_sms_api_id" id="x_sms_pkg_sms_api_id" value="<?php echo $sms_package_add->sms_pkg_sms_api_id->CurrentValue ?>"<?php echo $sms_package_add->sms_pkg_sms_api_id->editAttributes() ?>>
</span>
<?php echo $sms_package_add->sms_pkg_sms_api_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_package_add->sms_pkg_branch_id->Visible) { // sms_pkg_branch_id ?>
	<div id="r_sms_pkg_branch_id" class="form-group row">
		<label id="elh_sms_package_sms_pkg_branch_id" for="x_sms_pkg_branch_id" class="<?php echo $sms_package_add->LeftColumnClass ?>"><?php echo $sms_package_add->sms_pkg_branch_id->caption() ?><?php echo $sms_package_add->sms_pkg_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_package_add->RightColumnClass ?>"><div <?php echo $sms_package_add->sms_pkg_branch_id->cellAttributes() ?>>
<span id="el_sms_package_sms_pkg_branch_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($sms_package_add->sms_pkg_branch_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $sms_package_add->sms_pkg_branch_id->ViewValue ?></button>
		<div id="dsl_x_sms_pkg_branch_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $sms_package_add->sms_pkg_branch_id->radioButtonListHtml(TRUE, "x_sms_pkg_branch_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_sms_pkg_branch_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="sms_package" data-field="x_sms_pkg_branch_id" data-value-separator="<?php echo $sms_package_add->sms_pkg_branch_id->displayValueSeparatorAttribute() ?>" name="x_sms_pkg_branch_id" id="x_sms_pkg_branch_id" value="{value}"<?php echo $sms_package_add->sms_pkg_branch_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$sms_package_add->sms_pkg_branch_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $sms_package_add->sms_pkg_branch_id->Lookup->getParamTag($sms_package_add, "p_x_sms_pkg_branch_id") ?>
</span>
<?php echo $sms_package_add->sms_pkg_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_package_add->sms_pkg_total_allowed_sms->Visible) { // sms_pkg_total_allowed_sms ?>
	<div id="r_sms_pkg_total_allowed_sms" class="form-group row">
		<label id="elh_sms_package_sms_pkg_total_allowed_sms" for="x_sms_pkg_total_allowed_sms" class="<?php echo $sms_package_add->LeftColumnClass ?>"><?php echo $sms_package_add->sms_pkg_total_allowed_sms->caption() ?><?php echo $sms_package_add->sms_pkg_total_allowed_sms->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_package_add->RightColumnClass ?>"><div <?php echo $sms_package_add->sms_pkg_total_allowed_sms->cellAttributes() ?>>
<span id="el_sms_package_sms_pkg_total_allowed_sms">
<input type="text" data-table="sms_package" data-field="x_sms_pkg_total_allowed_sms" name="x_sms_pkg_total_allowed_sms" id="x_sms_pkg_total_allowed_sms" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($sms_package_add->sms_pkg_total_allowed_sms->getPlaceHolder()) ?>" value="<?php echo $sms_package_add->sms_pkg_total_allowed_sms->EditValue ?>"<?php echo $sms_package_add->sms_pkg_total_allowed_sms->editAttributes() ?>>
</span>
<?php echo $sms_package_add->sms_pkg_total_allowed_sms->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_package_add->sms_pkg_expiry_date->Visible) { // sms_pkg_expiry_date ?>
	<div id="r_sms_pkg_expiry_date" class="form-group row">
		<label id="elh_sms_package_sms_pkg_expiry_date" for="x_sms_pkg_expiry_date" class="<?php echo $sms_package_add->LeftColumnClass ?>"><?php echo $sms_package_add->sms_pkg_expiry_date->caption() ?><?php echo $sms_package_add->sms_pkg_expiry_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_package_add->RightColumnClass ?>"><div <?php echo $sms_package_add->sms_pkg_expiry_date->cellAttributes() ?>>
<span id="el_sms_package_sms_pkg_expiry_date">
<input type="text" data-table="sms_package" data-field="x_sms_pkg_expiry_date" name="x_sms_pkg_expiry_date" id="x_sms_pkg_expiry_date" maxlength="10" placeholder="<?php echo HtmlEncode($sms_package_add->sms_pkg_expiry_date->getPlaceHolder()) ?>" value="<?php echo $sms_package_add->sms_pkg_expiry_date->EditValue ?>"<?php echo $sms_package_add->sms_pkg_expiry_date->editAttributes() ?>>
<?php if (!$sms_package_add->sms_pkg_expiry_date->ReadOnly && !$sms_package_add->sms_pkg_expiry_date->Disabled && !isset($sms_package_add->sms_pkg_expiry_date->EditAttrs["readonly"]) && !isset($sms_package_add->sms_pkg_expiry_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsms_packageadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fsms_packageadd", "x_sms_pkg_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $sms_package_add->sms_pkg_expiry_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_package_add->sms_pkg_per_sms_cost->Visible) { // sms_pkg_per_sms_cost ?>
	<div id="r_sms_pkg_per_sms_cost" class="form-group row">
		<label id="elh_sms_package_sms_pkg_per_sms_cost" for="x_sms_pkg_per_sms_cost" class="<?php echo $sms_package_add->LeftColumnClass ?>"><?php echo $sms_package_add->sms_pkg_per_sms_cost->caption() ?><?php echo $sms_package_add->sms_pkg_per_sms_cost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_package_add->RightColumnClass ?>"><div <?php echo $sms_package_add->sms_pkg_per_sms_cost->cellAttributes() ?>>
<span id="el_sms_package_sms_pkg_per_sms_cost">
<input type="text" data-table="sms_package" data-field="x_sms_pkg_per_sms_cost" name="x_sms_pkg_per_sms_cost" id="x_sms_pkg_per_sms_cost" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($sms_package_add->sms_pkg_per_sms_cost->getPlaceHolder()) ?>" value="<?php echo $sms_package_add->sms_pkg_per_sms_cost->EditValue ?>"<?php echo $sms_package_add->sms_pkg_per_sms_cost->editAttributes() ?>>
</span>
<?php echo $sms_package_add->sms_pkg_per_sms_cost->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_package_add->sms_pkg_deal_details->Visible) { // sms_pkg_deal_details ?>
	<div id="r_sms_pkg_deal_details" class="form-group row">
		<label id="elh_sms_package_sms_pkg_deal_details" class="<?php echo $sms_package_add->LeftColumnClass ?>"><?php echo $sms_package_add->sms_pkg_deal_details->caption() ?><?php echo $sms_package_add->sms_pkg_deal_details->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_package_add->RightColumnClass ?>"><div <?php echo $sms_package_add->sms_pkg_deal_details->cellAttributes() ?>>
<span id="el_sms_package_sms_pkg_deal_details">
<?php $sms_package_add->sms_pkg_deal_details->EditAttrs->appendClass("editor"); ?>
<textarea data-table="sms_package" data-field="x_sms_pkg_deal_details" name="x_sms_pkg_deal_details" id="x_sms_pkg_deal_details" cols="35" rows="4" placeholder="<?php echo HtmlEncode($sms_package_add->sms_pkg_deal_details->getPlaceHolder()) ?>"<?php echo $sms_package_add->sms_pkg_deal_details->editAttributes() ?>><?php echo $sms_package_add->sms_pkg_deal_details->EditValue ?></textarea>
<script>
loadjs.ready(["fsms_packageadd", "editor"], function() {
	ew.createEditor("fsms_packageadd", "x_sms_pkg_deal_details", 35, 4, <?php echo $sms_package_add->sms_pkg_deal_details->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $sms_package_add->sms_pkg_deal_details->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$sms_package_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $sms_package_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sms_package_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$sms_package_add->showPageFooter();
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
<?php include_once "footer.php"; ?>
<?php
$sms_package_add->terminate();
?>