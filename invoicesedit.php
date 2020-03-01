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
$invoices_edit = new invoices_edit();

// Run the page
$invoices_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$invoices_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var finvoicesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	finvoicesedit = currentForm = new ew.Form("finvoicesedit", "edit");

	// Validate form
	finvoicesedit.validate = function() {
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
			<?php if ($invoices_edit->invoice_id->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_edit->invoice_id->caption(), $invoices_edit->invoice_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($invoices_edit->invoice_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_edit->invoice_branch_id->caption(), $invoices_edit->invoice_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_branch_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_edit->invoice_branch_id->errorMessage()) ?>");
			<?php if ($invoices_edit->invoice_business_id->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_business_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_edit->invoice_business_id->caption(), $invoices_edit->invoice_business_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_business_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_edit->invoice_business_id->errorMessage()) ?>");
			<?php if ($invoices_edit->invoice_service_id->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_service_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_edit->invoice_service_id->caption(), $invoices_edit->invoice_service_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_service_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_edit->invoice_service_id->errorMessage()) ?>");
			<?php if ($invoices_edit->invoice_amount->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_edit->invoice_amount->caption(), $invoices_edit->invoice_amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_amount");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_edit->invoice_amount->errorMessage()) ?>");
			<?php if ($invoices_edit->invoice_issue_date->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_issue_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_edit->invoice_issue_date->caption(), $invoices_edit->invoice_issue_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_issue_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_edit->invoice_issue_date->errorMessage()) ?>");
			<?php if ($invoices_edit->invoice_due_date->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_due_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_edit->invoice_due_date->caption(), $invoices_edit->invoice_due_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_due_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_edit->invoice_due_date->errorMessage()) ?>");
			<?php if ($invoices_edit->invoice_status->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_edit->invoice_status->caption(), $invoices_edit->invoice_status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($invoices_edit->invoice_collected_amount->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_collected_amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_edit->invoice_collected_amount->caption(), $invoices_edit->invoice_collected_amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_collected_amount");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_edit->invoice_collected_amount->errorMessage()) ?>");
			<?php if ($invoices_edit->invoice_remaining_amount->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_remaining_amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_edit->invoice_remaining_amount->caption(), $invoices_edit->invoice_remaining_amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_remaining_amount");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_edit->invoice_remaining_amount->errorMessage()) ?>");
			<?php if ($invoices_edit->invoice_collection_date->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_collection_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_edit->invoice_collection_date->caption(), $invoices_edit->invoice_collection_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_collection_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_edit->invoice_collection_date->errorMessage()) ?>");
			<?php if ($invoices_edit->invoice_content->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_content");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_edit->invoice_content->caption(), $invoices_edit->invoice_content->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($invoices_edit->invoice_comments->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_edit->invoice_comments->caption(), $invoices_edit->invoice_comments->RequiredErrorMessage)) ?>");
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
	finvoicesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	finvoicesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	finvoicesedit.lists["x_invoice_status"] = <?php echo $invoices_edit->invoice_status->Lookup->toClientList($invoices_edit) ?>;
	finvoicesedit.lists["x_invoice_status"].options = <?php echo JsonEncode($invoices_edit->invoice_status->options(FALSE, TRUE)) ?>;
	loadjs.done("finvoicesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $invoices_edit->showPageHeader(); ?>
<?php
$invoices_edit->showMessage();
?>
<form name="finvoicesedit" id="finvoicesedit" class="<?php echo $invoices_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="invoices">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$invoices_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($invoices_edit->invoice_id->Visible) { // invoice_id ?>
	<div id="r_invoice_id" class="form-group row">
		<label id="elh_invoices_invoice_id" class="<?php echo $invoices_edit->LeftColumnClass ?>"><?php echo $invoices_edit->invoice_id->caption() ?><?php echo $invoices_edit->invoice_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_edit->RightColumnClass ?>"><div <?php echo $invoices_edit->invoice_id->cellAttributes() ?>>
<span id="el_invoices_invoice_id">
<span<?php echo $invoices_edit->invoice_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($invoices_edit->invoice_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="invoices" data-field="x_invoice_id" name="x_invoice_id" id="x_invoice_id" value="<?php echo HtmlEncode($invoices_edit->invoice_id->CurrentValue) ?>">
<?php echo $invoices_edit->invoice_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_edit->invoice_branch_id->Visible) { // invoice_branch_id ?>
	<div id="r_invoice_branch_id" class="form-group row">
		<label id="elh_invoices_invoice_branch_id" for="x_invoice_branch_id" class="<?php echo $invoices_edit->LeftColumnClass ?>"><?php echo $invoices_edit->invoice_branch_id->caption() ?><?php echo $invoices_edit->invoice_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_edit->RightColumnClass ?>"><div <?php echo $invoices_edit->invoice_branch_id->cellAttributes() ?>>
<span id="el_invoices_invoice_branch_id">
<input type="text" data-table="invoices" data-field="x_invoice_branch_id" name="x_invoice_branch_id" id="x_invoice_branch_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($invoices_edit->invoice_branch_id->getPlaceHolder()) ?>" value="<?php echo $invoices_edit->invoice_branch_id->EditValue ?>"<?php echo $invoices_edit->invoice_branch_id->editAttributes() ?>>
</span>
<?php echo $invoices_edit->invoice_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_edit->invoice_business_id->Visible) { // invoice_business_id ?>
	<div id="r_invoice_business_id" class="form-group row">
		<label id="elh_invoices_invoice_business_id" for="x_invoice_business_id" class="<?php echo $invoices_edit->LeftColumnClass ?>"><?php echo $invoices_edit->invoice_business_id->caption() ?><?php echo $invoices_edit->invoice_business_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_edit->RightColumnClass ?>"><div <?php echo $invoices_edit->invoice_business_id->cellAttributes() ?>>
<span id="el_invoices_invoice_business_id">
<input type="text" data-table="invoices" data-field="x_invoice_business_id" name="x_invoice_business_id" id="x_invoice_business_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($invoices_edit->invoice_business_id->getPlaceHolder()) ?>" value="<?php echo $invoices_edit->invoice_business_id->EditValue ?>"<?php echo $invoices_edit->invoice_business_id->editAttributes() ?>>
</span>
<?php echo $invoices_edit->invoice_business_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_edit->invoice_service_id->Visible) { // invoice_service_id ?>
	<div id="r_invoice_service_id" class="form-group row">
		<label id="elh_invoices_invoice_service_id" for="x_invoice_service_id" class="<?php echo $invoices_edit->LeftColumnClass ?>"><?php echo $invoices_edit->invoice_service_id->caption() ?><?php echo $invoices_edit->invoice_service_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_edit->RightColumnClass ?>"><div <?php echo $invoices_edit->invoice_service_id->cellAttributes() ?>>
<span id="el_invoices_invoice_service_id">
<input type="text" data-table="invoices" data-field="x_invoice_service_id" name="x_invoice_service_id" id="x_invoice_service_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($invoices_edit->invoice_service_id->getPlaceHolder()) ?>" value="<?php echo $invoices_edit->invoice_service_id->EditValue ?>"<?php echo $invoices_edit->invoice_service_id->editAttributes() ?>>
</span>
<?php echo $invoices_edit->invoice_service_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_edit->invoice_amount->Visible) { // invoice_amount ?>
	<div id="r_invoice_amount" class="form-group row">
		<label id="elh_invoices_invoice_amount" for="x_invoice_amount" class="<?php echo $invoices_edit->LeftColumnClass ?>"><?php echo $invoices_edit->invoice_amount->caption() ?><?php echo $invoices_edit->invoice_amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_edit->RightColumnClass ?>"><div <?php echo $invoices_edit->invoice_amount->cellAttributes() ?>>
<span id="el_invoices_invoice_amount">
<input type="text" data-table="invoices" data-field="x_invoice_amount" name="x_invoice_amount" id="x_invoice_amount" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($invoices_edit->invoice_amount->getPlaceHolder()) ?>" value="<?php echo $invoices_edit->invoice_amount->EditValue ?>"<?php echo $invoices_edit->invoice_amount->editAttributes() ?>>
</span>
<?php echo $invoices_edit->invoice_amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_edit->invoice_issue_date->Visible) { // invoice_issue_date ?>
	<div id="r_invoice_issue_date" class="form-group row">
		<label id="elh_invoices_invoice_issue_date" for="x_invoice_issue_date" class="<?php echo $invoices_edit->LeftColumnClass ?>"><?php echo $invoices_edit->invoice_issue_date->caption() ?><?php echo $invoices_edit->invoice_issue_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_edit->RightColumnClass ?>"><div <?php echo $invoices_edit->invoice_issue_date->cellAttributes() ?>>
<span id="el_invoices_invoice_issue_date">
<input type="text" data-table="invoices" data-field="x_invoice_issue_date" name="x_invoice_issue_date" id="x_invoice_issue_date" maxlength="10" placeholder="<?php echo HtmlEncode($invoices_edit->invoice_issue_date->getPlaceHolder()) ?>" value="<?php echo $invoices_edit->invoice_issue_date->EditValue ?>"<?php echo $invoices_edit->invoice_issue_date->editAttributes() ?>>
<?php if (!$invoices_edit->invoice_issue_date->ReadOnly && !$invoices_edit->invoice_issue_date->Disabled && !isset($invoices_edit->invoice_issue_date->EditAttrs["readonly"]) && !isset($invoices_edit->invoice_issue_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finvoicesedit", "datetimepicker"], function() {
	ew.createDateTimePicker("finvoicesedit", "x_invoice_issue_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $invoices_edit->invoice_issue_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_edit->invoice_due_date->Visible) { // invoice_due_date ?>
	<div id="r_invoice_due_date" class="form-group row">
		<label id="elh_invoices_invoice_due_date" for="x_invoice_due_date" class="<?php echo $invoices_edit->LeftColumnClass ?>"><?php echo $invoices_edit->invoice_due_date->caption() ?><?php echo $invoices_edit->invoice_due_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_edit->RightColumnClass ?>"><div <?php echo $invoices_edit->invoice_due_date->cellAttributes() ?>>
<span id="el_invoices_invoice_due_date">
<input type="text" data-table="invoices" data-field="x_invoice_due_date" name="x_invoice_due_date" id="x_invoice_due_date" maxlength="10" placeholder="<?php echo HtmlEncode($invoices_edit->invoice_due_date->getPlaceHolder()) ?>" value="<?php echo $invoices_edit->invoice_due_date->EditValue ?>"<?php echo $invoices_edit->invoice_due_date->editAttributes() ?>>
<?php if (!$invoices_edit->invoice_due_date->ReadOnly && !$invoices_edit->invoice_due_date->Disabled && !isset($invoices_edit->invoice_due_date->EditAttrs["readonly"]) && !isset($invoices_edit->invoice_due_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finvoicesedit", "datetimepicker"], function() {
	ew.createDateTimePicker("finvoicesedit", "x_invoice_due_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $invoices_edit->invoice_due_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_edit->invoice_status->Visible) { // invoice_status ?>
	<div id="r_invoice_status" class="form-group row">
		<label id="elh_invoices_invoice_status" class="<?php echo $invoices_edit->LeftColumnClass ?>"><?php echo $invoices_edit->invoice_status->caption() ?><?php echo $invoices_edit->invoice_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_edit->RightColumnClass ?>"><div <?php echo $invoices_edit->invoice_status->cellAttributes() ?>>
<span id="el_invoices_invoice_status">
<div id="tp_x_invoice_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="invoices" data-field="x_invoice_status" data-value-separator="<?php echo $invoices_edit->invoice_status->displayValueSeparatorAttribute() ?>" name="x_invoice_status" id="x_invoice_status" value="{value}"<?php echo $invoices_edit->invoice_status->editAttributes() ?>></div>
<div id="dsl_x_invoice_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $invoices_edit->invoice_status->radioButtonListHtml(FALSE, "x_invoice_status") ?>
</div></div>
</span>
<?php echo $invoices_edit->invoice_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_edit->invoice_collected_amount->Visible) { // invoice_collected_amount ?>
	<div id="r_invoice_collected_amount" class="form-group row">
		<label id="elh_invoices_invoice_collected_amount" for="x_invoice_collected_amount" class="<?php echo $invoices_edit->LeftColumnClass ?>"><?php echo $invoices_edit->invoice_collected_amount->caption() ?><?php echo $invoices_edit->invoice_collected_amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_edit->RightColumnClass ?>"><div <?php echo $invoices_edit->invoice_collected_amount->cellAttributes() ?>>
<span id="el_invoices_invoice_collected_amount">
<input type="text" data-table="invoices" data-field="x_invoice_collected_amount" name="x_invoice_collected_amount" id="x_invoice_collected_amount" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($invoices_edit->invoice_collected_amount->getPlaceHolder()) ?>" value="<?php echo $invoices_edit->invoice_collected_amount->EditValue ?>"<?php echo $invoices_edit->invoice_collected_amount->editAttributes() ?>>
</span>
<?php echo $invoices_edit->invoice_collected_amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_edit->invoice_remaining_amount->Visible) { // invoice_remaining_amount ?>
	<div id="r_invoice_remaining_amount" class="form-group row">
		<label id="elh_invoices_invoice_remaining_amount" for="x_invoice_remaining_amount" class="<?php echo $invoices_edit->LeftColumnClass ?>"><?php echo $invoices_edit->invoice_remaining_amount->caption() ?><?php echo $invoices_edit->invoice_remaining_amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_edit->RightColumnClass ?>"><div <?php echo $invoices_edit->invoice_remaining_amount->cellAttributes() ?>>
<span id="el_invoices_invoice_remaining_amount">
<input type="text" data-table="invoices" data-field="x_invoice_remaining_amount" name="x_invoice_remaining_amount" id="x_invoice_remaining_amount" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($invoices_edit->invoice_remaining_amount->getPlaceHolder()) ?>" value="<?php echo $invoices_edit->invoice_remaining_amount->EditValue ?>"<?php echo $invoices_edit->invoice_remaining_amount->editAttributes() ?>>
</span>
<?php echo $invoices_edit->invoice_remaining_amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_edit->invoice_collection_date->Visible) { // invoice_collection_date ?>
	<div id="r_invoice_collection_date" class="form-group row">
		<label id="elh_invoices_invoice_collection_date" for="x_invoice_collection_date" class="<?php echo $invoices_edit->LeftColumnClass ?>"><?php echo $invoices_edit->invoice_collection_date->caption() ?><?php echo $invoices_edit->invoice_collection_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_edit->RightColumnClass ?>"><div <?php echo $invoices_edit->invoice_collection_date->cellAttributes() ?>>
<span id="el_invoices_invoice_collection_date">
<input type="text" data-table="invoices" data-field="x_invoice_collection_date" name="x_invoice_collection_date" id="x_invoice_collection_date" maxlength="10" placeholder="<?php echo HtmlEncode($invoices_edit->invoice_collection_date->getPlaceHolder()) ?>" value="<?php echo $invoices_edit->invoice_collection_date->EditValue ?>"<?php echo $invoices_edit->invoice_collection_date->editAttributes() ?>>
<?php if (!$invoices_edit->invoice_collection_date->ReadOnly && !$invoices_edit->invoice_collection_date->Disabled && !isset($invoices_edit->invoice_collection_date->EditAttrs["readonly"]) && !isset($invoices_edit->invoice_collection_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finvoicesedit", "datetimepicker"], function() {
	ew.createDateTimePicker("finvoicesedit", "x_invoice_collection_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $invoices_edit->invoice_collection_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_edit->invoice_content->Visible) { // invoice_content ?>
	<div id="r_invoice_content" class="form-group row">
		<label id="elh_invoices_invoice_content" for="x_invoice_content" class="<?php echo $invoices_edit->LeftColumnClass ?>"><?php echo $invoices_edit->invoice_content->caption() ?><?php echo $invoices_edit->invoice_content->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_edit->RightColumnClass ?>"><div <?php echo $invoices_edit->invoice_content->cellAttributes() ?>>
<span id="el_invoices_invoice_content">
<textarea data-table="invoices" data-field="x_invoice_content" name="x_invoice_content" id="x_invoice_content" cols="35" rows="4" placeholder="<?php echo HtmlEncode($invoices_edit->invoice_content->getPlaceHolder()) ?>"<?php echo $invoices_edit->invoice_content->editAttributes() ?>><?php echo $invoices_edit->invoice_content->EditValue ?></textarea>
</span>
<?php echo $invoices_edit->invoice_content->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_edit->invoice_comments->Visible) { // invoice_comments ?>
	<div id="r_invoice_comments" class="form-group row">
		<label id="elh_invoices_invoice_comments" for="x_invoice_comments" class="<?php echo $invoices_edit->LeftColumnClass ?>"><?php echo $invoices_edit->invoice_comments->caption() ?><?php echo $invoices_edit->invoice_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_edit->RightColumnClass ?>"><div <?php echo $invoices_edit->invoice_comments->cellAttributes() ?>>
<span id="el_invoices_invoice_comments">
<textarea data-table="invoices" data-field="x_invoice_comments" name="x_invoice_comments" id="x_invoice_comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($invoices_edit->invoice_comments->getPlaceHolder()) ?>"<?php echo $invoices_edit->invoice_comments->editAttributes() ?>><?php echo $invoices_edit->invoice_comments->EditValue ?></textarea>
</span>
<?php echo $invoices_edit->invoice_comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$invoices_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $invoices_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $invoices_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$invoices_edit->showPageFooter();
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
$invoices_edit->terminate();
?>