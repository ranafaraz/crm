<?php
namespace PHPMaker2020\project1;

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
$sms_api_add = new sms_api_add();

// Run the page
$sms_api_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_api_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsms_apiadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fsms_apiadd = currentForm = new ew.Form("fsms_apiadd", "add");

	// Validate form
	fsms_apiadd.validate = function() {
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
			<?php if ($sms_api_add->sms_api_user->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_api_user");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_api_add->sms_api_user->caption(), $sms_api_add->sms_api_user->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sms_api_add->sms_api_pass->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_api_pass");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_api_add->sms_api_pass->caption(), $sms_api_add->sms_api_pass->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sms_api_add->sms_api_url->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_api_url");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_api_add->sms_api_url->caption(), $sms_api_add->sms_api_url->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sms_api_add->sms_api_mask->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_api_mask");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_api_add->sms_api_mask->caption(), $sms_api_add->sms_api_mask->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sms_api_add->sms_api_reg_date->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_api_reg_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_api_add->sms_api_reg_date->caption(), $sms_api_add->sms_api_reg_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sms_api_reg_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($sms_api_add->sms_api_reg_date->errorMessage()) ?>");
			<?php if ($sms_api_add->sms_api_expiry_date->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_api_expiry_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_api_add->sms_api_expiry_date->caption(), $sms_api_add->sms_api_expiry_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sms_api_expiry_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($sms_api_add->sms_api_expiry_date->errorMessage()) ?>");
			<?php if ($sms_api_add->sms_api_total_sms->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_api_total_sms");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_api_add->sms_api_total_sms->caption(), $sms_api_add->sms_api_total_sms->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sms_api_total_sms");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($sms_api_add->sms_api_total_sms->errorMessage()) ?>");

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
	fsms_apiadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsms_apiadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsms_apiadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sms_api_add->showPageHeader(); ?>
<?php
$sms_api_add->showMessage();
?>
<form name="fsms_apiadd" id="fsms_apiadd" class="<?php echo $sms_api_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_api">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$sms_api_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($sms_api_add->sms_api_user->Visible) { // sms_api_user ?>
	<div id="r_sms_api_user" class="form-group row">
		<label id="elh_sms_api_sms_api_user" for="x_sms_api_user" class="<?php echo $sms_api_add->LeftColumnClass ?>"><?php echo $sms_api_add->sms_api_user->caption() ?><?php echo $sms_api_add->sms_api_user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_api_add->RightColumnClass ?>"><div <?php echo $sms_api_add->sms_api_user->cellAttributes() ?>>
<span id="el_sms_api_sms_api_user">
<input type="text" data-table="sms_api" data-field="x_sms_api_user" name="x_sms_api_user" id="x_sms_api_user" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($sms_api_add->sms_api_user->getPlaceHolder()) ?>" value="<?php echo $sms_api_add->sms_api_user->EditValue ?>"<?php echo $sms_api_add->sms_api_user->editAttributes() ?>>
</span>
<?php echo $sms_api_add->sms_api_user->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_api_add->sms_api_pass->Visible) { // sms_api_pass ?>
	<div id="r_sms_api_pass" class="form-group row">
		<label id="elh_sms_api_sms_api_pass" for="x_sms_api_pass" class="<?php echo $sms_api_add->LeftColumnClass ?>"><?php echo $sms_api_add->sms_api_pass->caption() ?><?php echo $sms_api_add->sms_api_pass->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_api_add->RightColumnClass ?>"><div <?php echo $sms_api_add->sms_api_pass->cellAttributes() ?>>
<span id="el_sms_api_sms_api_pass">
<input type="text" data-table="sms_api" data-field="x_sms_api_pass" name="x_sms_api_pass" id="x_sms_api_pass" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($sms_api_add->sms_api_pass->getPlaceHolder()) ?>" value="<?php echo $sms_api_add->sms_api_pass->EditValue ?>"<?php echo $sms_api_add->sms_api_pass->editAttributes() ?>>
</span>
<?php echo $sms_api_add->sms_api_pass->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_api_add->sms_api_url->Visible) { // sms_api_url ?>
	<div id="r_sms_api_url" class="form-group row">
		<label id="elh_sms_api_sms_api_url" for="x_sms_api_url" class="<?php echo $sms_api_add->LeftColumnClass ?>"><?php echo $sms_api_add->sms_api_url->caption() ?><?php echo $sms_api_add->sms_api_url->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_api_add->RightColumnClass ?>"><div <?php echo $sms_api_add->sms_api_url->cellAttributes() ?>>
<span id="el_sms_api_sms_api_url">
<input type="text" data-table="sms_api" data-field="x_sms_api_url" name="x_sms_api_url" id="x_sms_api_url" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($sms_api_add->sms_api_url->getPlaceHolder()) ?>" value="<?php echo $sms_api_add->sms_api_url->EditValue ?>"<?php echo $sms_api_add->sms_api_url->editAttributes() ?>>
</span>
<?php echo $sms_api_add->sms_api_url->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_api_add->sms_api_mask->Visible) { // sms_api_mask ?>
	<div id="r_sms_api_mask" class="form-group row">
		<label id="elh_sms_api_sms_api_mask" for="x_sms_api_mask" class="<?php echo $sms_api_add->LeftColumnClass ?>"><?php echo $sms_api_add->sms_api_mask->caption() ?><?php echo $sms_api_add->sms_api_mask->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_api_add->RightColumnClass ?>"><div <?php echo $sms_api_add->sms_api_mask->cellAttributes() ?>>
<span id="el_sms_api_sms_api_mask">
<input type="text" data-table="sms_api" data-field="x_sms_api_mask" name="x_sms_api_mask" id="x_sms_api_mask" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($sms_api_add->sms_api_mask->getPlaceHolder()) ?>" value="<?php echo $sms_api_add->sms_api_mask->EditValue ?>"<?php echo $sms_api_add->sms_api_mask->editAttributes() ?>>
</span>
<?php echo $sms_api_add->sms_api_mask->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_api_add->sms_api_reg_date->Visible) { // sms_api_reg_date ?>
	<div id="r_sms_api_reg_date" class="form-group row">
		<label id="elh_sms_api_sms_api_reg_date" for="x_sms_api_reg_date" class="<?php echo $sms_api_add->LeftColumnClass ?>"><?php echo $sms_api_add->sms_api_reg_date->caption() ?><?php echo $sms_api_add->sms_api_reg_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_api_add->RightColumnClass ?>"><div <?php echo $sms_api_add->sms_api_reg_date->cellAttributes() ?>>
<span id="el_sms_api_sms_api_reg_date">
<input type="text" data-table="sms_api" data-field="x_sms_api_reg_date" name="x_sms_api_reg_date" id="x_sms_api_reg_date" maxlength="10" placeholder="<?php echo HtmlEncode($sms_api_add->sms_api_reg_date->getPlaceHolder()) ?>" value="<?php echo $sms_api_add->sms_api_reg_date->EditValue ?>"<?php echo $sms_api_add->sms_api_reg_date->editAttributes() ?>>
<?php if (!$sms_api_add->sms_api_reg_date->ReadOnly && !$sms_api_add->sms_api_reg_date->Disabled && !isset($sms_api_add->sms_api_reg_date->EditAttrs["readonly"]) && !isset($sms_api_add->sms_api_reg_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsms_apiadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fsms_apiadd", "x_sms_api_reg_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $sms_api_add->sms_api_reg_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_api_add->sms_api_expiry_date->Visible) { // sms_api_expiry_date ?>
	<div id="r_sms_api_expiry_date" class="form-group row">
		<label id="elh_sms_api_sms_api_expiry_date" for="x_sms_api_expiry_date" class="<?php echo $sms_api_add->LeftColumnClass ?>"><?php echo $sms_api_add->sms_api_expiry_date->caption() ?><?php echo $sms_api_add->sms_api_expiry_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_api_add->RightColumnClass ?>"><div <?php echo $sms_api_add->sms_api_expiry_date->cellAttributes() ?>>
<span id="el_sms_api_sms_api_expiry_date">
<input type="text" data-table="sms_api" data-field="x_sms_api_expiry_date" name="x_sms_api_expiry_date" id="x_sms_api_expiry_date" maxlength="10" placeholder="<?php echo HtmlEncode($sms_api_add->sms_api_expiry_date->getPlaceHolder()) ?>" value="<?php echo $sms_api_add->sms_api_expiry_date->EditValue ?>"<?php echo $sms_api_add->sms_api_expiry_date->editAttributes() ?>>
<?php if (!$sms_api_add->sms_api_expiry_date->ReadOnly && !$sms_api_add->sms_api_expiry_date->Disabled && !isset($sms_api_add->sms_api_expiry_date->EditAttrs["readonly"]) && !isset($sms_api_add->sms_api_expiry_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsms_apiadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fsms_apiadd", "x_sms_api_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $sms_api_add->sms_api_expiry_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_api_add->sms_api_total_sms->Visible) { // sms_api_total_sms ?>
	<div id="r_sms_api_total_sms" class="form-group row">
		<label id="elh_sms_api_sms_api_total_sms" for="x_sms_api_total_sms" class="<?php echo $sms_api_add->LeftColumnClass ?>"><?php echo $sms_api_add->sms_api_total_sms->caption() ?><?php echo $sms_api_add->sms_api_total_sms->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_api_add->RightColumnClass ?>"><div <?php echo $sms_api_add->sms_api_total_sms->cellAttributes() ?>>
<span id="el_sms_api_sms_api_total_sms">
<input type="text" data-table="sms_api" data-field="x_sms_api_total_sms" name="x_sms_api_total_sms" id="x_sms_api_total_sms" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($sms_api_add->sms_api_total_sms->getPlaceHolder()) ?>" value="<?php echo $sms_api_add->sms_api_total_sms->EditValue ?>"<?php echo $sms_api_add->sms_api_total_sms->editAttributes() ?>>
</span>
<?php echo $sms_api_add->sms_api_total_sms->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$sms_api_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $sms_api_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sms_api_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$sms_api_add->showPageFooter();
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
$sms_api_add->terminate();
?>