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
$organization_add = new organization_add();

// Run the page
$organization_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$organization_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var forganizationadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	forganizationadd = currentForm = new ew.Form("forganizationadd", "add");

	// Validate form
	forganizationadd.validate = function() {
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
			<?php if ($organization_add->org_city_id->Required) { ?>
				elm = this.getElements("x" + infix + "_org_city_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $organization_add->org_city_id->caption(), $organization_add->org_city_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_org_city_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($organization_add->org_city_id->errorMessage()) ?>");
			<?php if ($organization_add->org_name->Required) { ?>
				elm = this.getElements("x" + infix + "_org_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $organization_add->org_name->caption(), $organization_add->org_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($organization_add->org_head_office->Required) { ?>
				elm = this.getElements("x" + infix + "_org_head_office");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $organization_add->org_head_office->caption(), $organization_add->org_head_office->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($organization_add->org_owner->Required) { ?>
				elm = this.getElements("x" + infix + "_org_owner");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $organization_add->org_owner->caption(), $organization_add->org_owner->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($organization_add->org_contact_no->Required) { ?>
				elm = this.getElements("x" + infix + "_org_contact_no");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $organization_add->org_contact_no->caption(), $organization_add->org_contact_no->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($organization_add->org_logo->Required) { ?>
				elm = this.getElements("x" + infix + "_org_logo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $organization_add->org_logo->caption(), $organization_add->org_logo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($organization_add->org_bank_acc->Required) { ?>
				elm = this.getElements("x" + infix + "_org_bank_acc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $organization_add->org_bank_acc->caption(), $organization_add->org_bank_acc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($organization_add->org_ntn->Required) { ?>
				elm = this.getElements("x" + infix + "_org_ntn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $organization_add->org_ntn->caption(), $organization_add->org_ntn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($organization_add->org_email->Required) { ?>
				elm = this.getElements("x" + infix + "_org_email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $organization_add->org_email->caption(), $organization_add->org_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($organization_add->org_website->Required) { ?>
				elm = this.getElements("x" + infix + "_org_website");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $organization_add->org_website->caption(), $organization_add->org_website->RequiredErrorMessage)) ?>");
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
	forganizationadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	forganizationadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("forganizationadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $organization_add->showPageHeader(); ?>
<?php
$organization_add->showMessage();
?>
<form name="forganizationadd" id="forganizationadd" class="<?php echo $organization_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="organization">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$organization_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($organization_add->org_city_id->Visible) { // org_city_id ?>
	<div id="r_org_city_id" class="form-group row">
		<label id="elh_organization_org_city_id" for="x_org_city_id" class="<?php echo $organization_add->LeftColumnClass ?>"><?php echo $organization_add->org_city_id->caption() ?><?php echo $organization_add->org_city_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $organization_add->RightColumnClass ?>"><div <?php echo $organization_add->org_city_id->cellAttributes() ?>>
<span id="el_organization_org_city_id">
<input type="text" data-table="organization" data-field="x_org_city_id" name="x_org_city_id" id="x_org_city_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($organization_add->org_city_id->getPlaceHolder()) ?>" value="<?php echo $organization_add->org_city_id->EditValue ?>"<?php echo $organization_add->org_city_id->editAttributes() ?>>
</span>
<?php echo $organization_add->org_city_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($organization_add->org_name->Visible) { // org_name ?>
	<div id="r_org_name" class="form-group row">
		<label id="elh_organization_org_name" for="x_org_name" class="<?php echo $organization_add->LeftColumnClass ?>"><?php echo $organization_add->org_name->caption() ?><?php echo $organization_add->org_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $organization_add->RightColumnClass ?>"><div <?php echo $organization_add->org_name->cellAttributes() ?>>
<span id="el_organization_org_name">
<input type="text" data-table="organization" data-field="x_org_name" name="x_org_name" id="x_org_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($organization_add->org_name->getPlaceHolder()) ?>" value="<?php echo $organization_add->org_name->EditValue ?>"<?php echo $organization_add->org_name->editAttributes() ?>>
</span>
<?php echo $organization_add->org_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($organization_add->org_head_office->Visible) { // org_head_office ?>
	<div id="r_org_head_office" class="form-group row">
		<label id="elh_organization_org_head_office" for="x_org_head_office" class="<?php echo $organization_add->LeftColumnClass ?>"><?php echo $organization_add->org_head_office->caption() ?><?php echo $organization_add->org_head_office->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $organization_add->RightColumnClass ?>"><div <?php echo $organization_add->org_head_office->cellAttributes() ?>>
<span id="el_organization_org_head_office">
<input type="text" data-table="organization" data-field="x_org_head_office" name="x_org_head_office" id="x_org_head_office" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($organization_add->org_head_office->getPlaceHolder()) ?>" value="<?php echo $organization_add->org_head_office->EditValue ?>"<?php echo $organization_add->org_head_office->editAttributes() ?>>
</span>
<?php echo $organization_add->org_head_office->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($organization_add->org_owner->Visible) { // org_owner ?>
	<div id="r_org_owner" class="form-group row">
		<label id="elh_organization_org_owner" for="x_org_owner" class="<?php echo $organization_add->LeftColumnClass ?>"><?php echo $organization_add->org_owner->caption() ?><?php echo $organization_add->org_owner->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $organization_add->RightColumnClass ?>"><div <?php echo $organization_add->org_owner->cellAttributes() ?>>
<span id="el_organization_org_owner">
<input type="text" data-table="organization" data-field="x_org_owner" name="x_org_owner" id="x_org_owner" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($organization_add->org_owner->getPlaceHolder()) ?>" value="<?php echo $organization_add->org_owner->EditValue ?>"<?php echo $organization_add->org_owner->editAttributes() ?>>
</span>
<?php echo $organization_add->org_owner->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($organization_add->org_contact_no->Visible) { // org_contact_no ?>
	<div id="r_org_contact_no" class="form-group row">
		<label id="elh_organization_org_contact_no" for="x_org_contact_no" class="<?php echo $organization_add->LeftColumnClass ?>"><?php echo $organization_add->org_contact_no->caption() ?><?php echo $organization_add->org_contact_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $organization_add->RightColumnClass ?>"><div <?php echo $organization_add->org_contact_no->cellAttributes() ?>>
<span id="el_organization_org_contact_no">
<input type="text" data-table="organization" data-field="x_org_contact_no" name="x_org_contact_no" id="x_org_contact_no" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($organization_add->org_contact_no->getPlaceHolder()) ?>" value="<?php echo $organization_add->org_contact_no->EditValue ?>"<?php echo $organization_add->org_contact_no->editAttributes() ?>>
</span>
<?php echo $organization_add->org_contact_no->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($organization_add->org_logo->Visible) { // org_logo ?>
	<div id="r_org_logo" class="form-group row">
		<label id="elh_organization_org_logo" for="x_org_logo" class="<?php echo $organization_add->LeftColumnClass ?>"><?php echo $organization_add->org_logo->caption() ?><?php echo $organization_add->org_logo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $organization_add->RightColumnClass ?>"><div <?php echo $organization_add->org_logo->cellAttributes() ?>>
<span id="el_organization_org_logo">
<input type="text" data-table="organization" data-field="x_org_logo" name="x_org_logo" id="x_org_logo" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($organization_add->org_logo->getPlaceHolder()) ?>" value="<?php echo $organization_add->org_logo->EditValue ?>"<?php echo $organization_add->org_logo->editAttributes() ?>>
</span>
<?php echo $organization_add->org_logo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($organization_add->org_bank_acc->Visible) { // org_bank_acc ?>
	<div id="r_org_bank_acc" class="form-group row">
		<label id="elh_organization_org_bank_acc" for="x_org_bank_acc" class="<?php echo $organization_add->LeftColumnClass ?>"><?php echo $organization_add->org_bank_acc->caption() ?><?php echo $organization_add->org_bank_acc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $organization_add->RightColumnClass ?>"><div <?php echo $organization_add->org_bank_acc->cellAttributes() ?>>
<span id="el_organization_org_bank_acc">
<input type="text" data-table="organization" data-field="x_org_bank_acc" name="x_org_bank_acc" id="x_org_bank_acc" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($organization_add->org_bank_acc->getPlaceHolder()) ?>" value="<?php echo $organization_add->org_bank_acc->EditValue ?>"<?php echo $organization_add->org_bank_acc->editAttributes() ?>>
</span>
<?php echo $organization_add->org_bank_acc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($organization_add->org_ntn->Visible) { // org_ntn ?>
	<div id="r_org_ntn" class="form-group row">
		<label id="elh_organization_org_ntn" for="x_org_ntn" class="<?php echo $organization_add->LeftColumnClass ?>"><?php echo $organization_add->org_ntn->caption() ?><?php echo $organization_add->org_ntn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $organization_add->RightColumnClass ?>"><div <?php echo $organization_add->org_ntn->cellAttributes() ?>>
<span id="el_organization_org_ntn">
<input type="text" data-table="organization" data-field="x_org_ntn" name="x_org_ntn" id="x_org_ntn" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($organization_add->org_ntn->getPlaceHolder()) ?>" value="<?php echo $organization_add->org_ntn->EditValue ?>"<?php echo $organization_add->org_ntn->editAttributes() ?>>
</span>
<?php echo $organization_add->org_ntn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($organization_add->org_email->Visible) { // org_email ?>
	<div id="r_org_email" class="form-group row">
		<label id="elh_organization_org_email" for="x_org_email" class="<?php echo $organization_add->LeftColumnClass ?>"><?php echo $organization_add->org_email->caption() ?><?php echo $organization_add->org_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $organization_add->RightColumnClass ?>"><div <?php echo $organization_add->org_email->cellAttributes() ?>>
<span id="el_organization_org_email">
<input type="text" data-table="organization" data-field="x_org_email" name="x_org_email" id="x_org_email" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($organization_add->org_email->getPlaceHolder()) ?>" value="<?php echo $organization_add->org_email->EditValue ?>"<?php echo $organization_add->org_email->editAttributes() ?>>
</span>
<?php echo $organization_add->org_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($organization_add->org_website->Visible) { // org_website ?>
	<div id="r_org_website" class="form-group row">
		<label id="elh_organization_org_website" for="x_org_website" class="<?php echo $organization_add->LeftColumnClass ?>"><?php echo $organization_add->org_website->caption() ?><?php echo $organization_add->org_website->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $organization_add->RightColumnClass ?>"><div <?php echo $organization_add->org_website->cellAttributes() ?>>
<span id="el_organization_org_website">
<input type="text" data-table="organization" data-field="x_org_website" name="x_org_website" id="x_org_website" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($organization_add->org_website->getPlaceHolder()) ?>" value="<?php echo $organization_add->org_website->EditValue ?>"<?php echo $organization_add->org_website->editAttributes() ?>>
</span>
<?php echo $organization_add->org_website->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$organization_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $organization_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $organization_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$organization_add->showPageFooter();
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
$organization_add->terminate();
?>