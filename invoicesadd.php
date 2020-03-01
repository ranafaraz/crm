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
$invoices_add = new invoices_add();

// Run the page
$invoices_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$invoices_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var finvoicesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	finvoicesadd = currentForm = new ew.Form("finvoicesadd", "add");

	// Validate form
	finvoicesadd.validate = function() {
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
			<?php if ($invoices_add->invoice_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_add->invoice_branch_id->caption(), $invoices_add->invoice_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($invoices_add->invoice_business_id->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_business_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_add->invoice_business_id->caption(), $invoices_add->invoice_business_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($invoices_add->invoice_service_id->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_service_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_add->invoice_service_id->caption(), $invoices_add->invoice_service_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($invoices_add->invoice_amount->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_add->invoice_amount->caption(), $invoices_add->invoice_amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_amount");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_add->invoice_amount->errorMessage()) ?>");
			<?php if ($invoices_add->invoice_issue_date->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_issue_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_add->invoice_issue_date->caption(), $invoices_add->invoice_issue_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_issue_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_add->invoice_issue_date->errorMessage()) ?>");
			<?php if ($invoices_add->invoice_due_date->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_due_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_add->invoice_due_date->caption(), $invoices_add->invoice_due_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_due_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_add->invoice_due_date->errorMessage()) ?>");
			<?php if ($invoices_add->invoice_status->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_add->invoice_status->caption(), $invoices_add->invoice_status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($invoices_add->invoice_collected_amount->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_collected_amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_add->invoice_collected_amount->caption(), $invoices_add->invoice_collected_amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_collected_amount");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_add->invoice_collected_amount->errorMessage()) ?>");
			<?php if ($invoices_add->invoice_remaining_amount->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_remaining_amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_add->invoice_remaining_amount->caption(), $invoices_add->invoice_remaining_amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_remaining_amount");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_add->invoice_remaining_amount->errorMessage()) ?>");
			<?php if ($invoices_add->invoice_collection_date->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_collection_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_add->invoice_collection_date->caption(), $invoices_add->invoice_collection_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_invoice_collection_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($invoices_add->invoice_collection_date->errorMessage()) ?>");
			<?php if ($invoices_add->invoice_content->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_content");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_add->invoice_content->caption(), $invoices_add->invoice_content->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($invoices_add->invoice_comments->Required) { ?>
				elm = this.getElements("x" + infix + "_invoice_comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $invoices_add->invoice_comments->caption(), $invoices_add->invoice_comments->RequiredErrorMessage)) ?>");
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
	finvoicesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	finvoicesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	finvoicesadd.lists["x_invoice_branch_id"] = <?php echo $invoices_add->invoice_branch_id->Lookup->toClientList($invoices_add) ?>;
	finvoicesadd.lists["x_invoice_branch_id"].options = <?php echo JsonEncode($invoices_add->invoice_branch_id->lookupOptions()) ?>;
	finvoicesadd.lists["x_invoice_business_id"] = <?php echo $invoices_add->invoice_business_id->Lookup->toClientList($invoices_add) ?>;
	finvoicesadd.lists["x_invoice_business_id"].options = <?php echo JsonEncode($invoices_add->invoice_business_id->lookupOptions()) ?>;
	finvoicesadd.lists["x_invoice_service_id"] = <?php echo $invoices_add->invoice_service_id->Lookup->toClientList($invoices_add) ?>;
	finvoicesadd.lists["x_invoice_service_id"].options = <?php echo JsonEncode($invoices_add->invoice_service_id->lookupOptions()) ?>;
	finvoicesadd.lists["x_invoice_status"] = <?php echo $invoices_add->invoice_status->Lookup->toClientList($invoices_add) ?>;
	finvoicesadd.lists["x_invoice_status"].options = <?php echo JsonEncode($invoices_add->invoice_status->options(FALSE, TRUE)) ?>;
	loadjs.done("finvoicesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $invoices_add->showPageHeader(); ?>
<?php
$invoices_add->showMessage();
?>
<form name="finvoicesadd" id="finvoicesadd" class="<?php echo $invoices_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="invoices">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$invoices_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($invoices_add->invoice_branch_id->Visible) { // invoice_branch_id ?>
	<div id="r_invoice_branch_id" class="form-group row">
		<label id="elh_invoices_invoice_branch_id" for="x_invoice_branch_id" class="<?php echo $invoices_add->LeftColumnClass ?>"><?php echo $invoices_add->invoice_branch_id->caption() ?><?php echo $invoices_add->invoice_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_add->RightColumnClass ?>"><div <?php echo $invoices_add->invoice_branch_id->cellAttributes() ?>>
<span id="el_invoices_invoice_branch_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($invoices_add->invoice_branch_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $invoices_add->invoice_branch_id->ViewValue ?></button>
		<div id="dsl_x_invoice_branch_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $invoices_add->invoice_branch_id->radioButtonListHtml(TRUE, "x_invoice_branch_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_invoice_branch_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="invoices" data-field="x_invoice_branch_id" data-value-separator="<?php echo $invoices_add->invoice_branch_id->displayValueSeparatorAttribute() ?>" name="x_invoice_branch_id" id="x_invoice_branch_id" value="{value}"<?php echo $invoices_add->invoice_branch_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$invoices_add->invoice_branch_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $invoices_add->invoice_branch_id->Lookup->getParamTag($invoices_add, "p_x_invoice_branch_id") ?>
</span>
<?php echo $invoices_add->invoice_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_add->invoice_business_id->Visible) { // invoice_business_id ?>
	<div id="r_invoice_business_id" class="form-group row">
		<label id="elh_invoices_invoice_business_id" for="x_invoice_business_id" class="<?php echo $invoices_add->LeftColumnClass ?>"><?php echo $invoices_add->invoice_business_id->caption() ?><?php echo $invoices_add->invoice_business_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_add->RightColumnClass ?>"><div <?php echo $invoices_add->invoice_business_id->cellAttributes() ?>>
<span id="el_invoices_invoice_business_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_invoice_business_id"><?php echo EmptyValue(strval($invoices_add->invoice_business_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $invoices_add->invoice_business_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($invoices_add->invoice_business_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($invoices_add->invoice_business_id->ReadOnly || $invoices_add->invoice_business_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_invoice_business_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
		<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_invoice_business_id" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $invoices_add->invoice_business_id->caption() ?>" data-title="<?php echo $invoices_add->invoice_business_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_invoice_business_id',url:'businessaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button>
	</div>
</div>
<?php echo $invoices_add->invoice_business_id->Lookup->getParamTag($invoices_add, "p_x_invoice_business_id") ?>
<input type="hidden" data-table="invoices" data-field="x_invoice_business_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $invoices_add->invoice_business_id->displayValueSeparatorAttribute() ?>" name="x_invoice_business_id" id="x_invoice_business_id" value="<?php echo $invoices_add->invoice_business_id->CurrentValue ?>"<?php echo $invoices_add->invoice_business_id->editAttributes() ?>>
</span>
<?php echo $invoices_add->invoice_business_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_add->invoice_service_id->Visible) { // invoice_service_id ?>
	<div id="r_invoice_service_id" class="form-group row">
		<label id="elh_invoices_invoice_service_id" for="x_invoice_service_id" class="<?php echo $invoices_add->LeftColumnClass ?>"><?php echo $invoices_add->invoice_service_id->caption() ?><?php echo $invoices_add->invoice_service_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_add->RightColumnClass ?>"><div <?php echo $invoices_add->invoice_service_id->cellAttributes() ?>>
<span id="el_invoices_invoice_service_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_invoice_service_id"><?php echo EmptyValue(strval($invoices_add->invoice_service_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $invoices_add->invoice_service_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($invoices_add->invoice_service_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($invoices_add->invoice_service_id->ReadOnly || $invoices_add->invoice_service_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_invoice_service_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
		<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_invoice_service_id" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $invoices_add->invoice_service_id->caption() ?>" data-title="<?php echo $invoices_add->invoice_service_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_invoice_service_id',url:'servicesaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button>
	</div>
</div>
<?php echo $invoices_add->invoice_service_id->Lookup->getParamTag($invoices_add, "p_x_invoice_service_id") ?>
<input type="hidden" data-table="invoices" data-field="x_invoice_service_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $invoices_add->invoice_service_id->displayValueSeparatorAttribute() ?>" name="x_invoice_service_id" id="x_invoice_service_id" value="<?php echo $invoices_add->invoice_service_id->CurrentValue ?>"<?php echo $invoices_add->invoice_service_id->editAttributes() ?>>
</span>
<?php echo $invoices_add->invoice_service_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_add->invoice_amount->Visible) { // invoice_amount ?>
	<div id="r_invoice_amount" class="form-group row">
		<label id="elh_invoices_invoice_amount" for="x_invoice_amount" class="<?php echo $invoices_add->LeftColumnClass ?>"><?php echo $invoices_add->invoice_amount->caption() ?><?php echo $invoices_add->invoice_amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_add->RightColumnClass ?>"><div <?php echo $invoices_add->invoice_amount->cellAttributes() ?>>
<span id="el_invoices_invoice_amount">
<input type="text" data-table="invoices" data-field="x_invoice_amount" name="x_invoice_amount" id="x_invoice_amount" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($invoices_add->invoice_amount->getPlaceHolder()) ?>" value="<?php echo $invoices_add->invoice_amount->EditValue ?>"<?php echo $invoices_add->invoice_amount->editAttributes() ?>>
</span>
<?php echo $invoices_add->invoice_amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_add->invoice_issue_date->Visible) { // invoice_issue_date ?>
	<div id="r_invoice_issue_date" class="form-group row">
		<label id="elh_invoices_invoice_issue_date" for="x_invoice_issue_date" class="<?php echo $invoices_add->LeftColumnClass ?>"><?php echo $invoices_add->invoice_issue_date->caption() ?><?php echo $invoices_add->invoice_issue_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_add->RightColumnClass ?>"><div <?php echo $invoices_add->invoice_issue_date->cellAttributes() ?>>
<span id="el_invoices_invoice_issue_date">
<input type="text" data-table="invoices" data-field="x_invoice_issue_date" name="x_invoice_issue_date" id="x_invoice_issue_date" maxlength="10" placeholder="<?php echo HtmlEncode($invoices_add->invoice_issue_date->getPlaceHolder()) ?>" value="<?php echo $invoices_add->invoice_issue_date->EditValue ?>"<?php echo $invoices_add->invoice_issue_date->editAttributes() ?>>
<?php if (!$invoices_add->invoice_issue_date->ReadOnly && !$invoices_add->invoice_issue_date->Disabled && !isset($invoices_add->invoice_issue_date->EditAttrs["readonly"]) && !isset($invoices_add->invoice_issue_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finvoicesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("finvoicesadd", "x_invoice_issue_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $invoices_add->invoice_issue_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_add->invoice_due_date->Visible) { // invoice_due_date ?>
	<div id="r_invoice_due_date" class="form-group row">
		<label id="elh_invoices_invoice_due_date" for="x_invoice_due_date" class="<?php echo $invoices_add->LeftColumnClass ?>"><?php echo $invoices_add->invoice_due_date->caption() ?><?php echo $invoices_add->invoice_due_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_add->RightColumnClass ?>"><div <?php echo $invoices_add->invoice_due_date->cellAttributes() ?>>
<span id="el_invoices_invoice_due_date">
<input type="text" data-table="invoices" data-field="x_invoice_due_date" name="x_invoice_due_date" id="x_invoice_due_date" maxlength="10" placeholder="<?php echo HtmlEncode($invoices_add->invoice_due_date->getPlaceHolder()) ?>" value="<?php echo $invoices_add->invoice_due_date->EditValue ?>"<?php echo $invoices_add->invoice_due_date->editAttributes() ?>>
<?php if (!$invoices_add->invoice_due_date->ReadOnly && !$invoices_add->invoice_due_date->Disabled && !isset($invoices_add->invoice_due_date->EditAttrs["readonly"]) && !isset($invoices_add->invoice_due_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finvoicesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("finvoicesadd", "x_invoice_due_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $invoices_add->invoice_due_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_add->invoice_status->Visible) { // invoice_status ?>
	<div id="r_invoice_status" class="form-group row">
		<label id="elh_invoices_invoice_status" class="<?php echo $invoices_add->LeftColumnClass ?>"><?php echo $invoices_add->invoice_status->caption() ?><?php echo $invoices_add->invoice_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_add->RightColumnClass ?>"><div <?php echo $invoices_add->invoice_status->cellAttributes() ?>>
<span id="el_invoices_invoice_status">
<div id="tp_x_invoice_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="invoices" data-field="x_invoice_status" data-value-separator="<?php echo $invoices_add->invoice_status->displayValueSeparatorAttribute() ?>" name="x_invoice_status" id="x_invoice_status" value="{value}"<?php echo $invoices_add->invoice_status->editAttributes() ?>></div>
<div id="dsl_x_invoice_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $invoices_add->invoice_status->radioButtonListHtml(FALSE, "x_invoice_status") ?>
</div></div>
</span>
<?php echo $invoices_add->invoice_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_add->invoice_collected_amount->Visible) { // invoice_collected_amount ?>
	<div id="r_invoice_collected_amount" class="form-group row">
		<label id="elh_invoices_invoice_collected_amount" for="x_invoice_collected_amount" class="<?php echo $invoices_add->LeftColumnClass ?>"><?php echo $invoices_add->invoice_collected_amount->caption() ?><?php echo $invoices_add->invoice_collected_amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_add->RightColumnClass ?>"><div <?php echo $invoices_add->invoice_collected_amount->cellAttributes() ?>>
<span id="el_invoices_invoice_collected_amount">
<input type="text" data-table="invoices" data-field="x_invoice_collected_amount" name="x_invoice_collected_amount" id="x_invoice_collected_amount" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($invoices_add->invoice_collected_amount->getPlaceHolder()) ?>" value="<?php echo $invoices_add->invoice_collected_amount->EditValue ?>"<?php echo $invoices_add->invoice_collected_amount->editAttributes() ?>>
</span>
<?php echo $invoices_add->invoice_collected_amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_add->invoice_remaining_amount->Visible) { // invoice_remaining_amount ?>
	<div id="r_invoice_remaining_amount" class="form-group row">
		<label id="elh_invoices_invoice_remaining_amount" for="x_invoice_remaining_amount" class="<?php echo $invoices_add->LeftColumnClass ?>"><?php echo $invoices_add->invoice_remaining_amount->caption() ?><?php echo $invoices_add->invoice_remaining_amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_add->RightColumnClass ?>"><div <?php echo $invoices_add->invoice_remaining_amount->cellAttributes() ?>>
<span id="el_invoices_invoice_remaining_amount">
<input type="text" data-table="invoices" data-field="x_invoice_remaining_amount" name="x_invoice_remaining_amount" id="x_invoice_remaining_amount" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($invoices_add->invoice_remaining_amount->getPlaceHolder()) ?>" value="<?php echo $invoices_add->invoice_remaining_amount->EditValue ?>"<?php echo $invoices_add->invoice_remaining_amount->editAttributes() ?>>
</span>
<?php echo $invoices_add->invoice_remaining_amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_add->invoice_collection_date->Visible) { // invoice_collection_date ?>
	<div id="r_invoice_collection_date" class="form-group row">
		<label id="elh_invoices_invoice_collection_date" for="x_invoice_collection_date" class="<?php echo $invoices_add->LeftColumnClass ?>"><?php echo $invoices_add->invoice_collection_date->caption() ?><?php echo $invoices_add->invoice_collection_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_add->RightColumnClass ?>"><div <?php echo $invoices_add->invoice_collection_date->cellAttributes() ?>>
<span id="el_invoices_invoice_collection_date">
<input type="text" data-table="invoices" data-field="x_invoice_collection_date" data-format="2" name="x_invoice_collection_date" id="x_invoice_collection_date" maxlength="10" placeholder="<?php echo HtmlEncode($invoices_add->invoice_collection_date->getPlaceHolder()) ?>" value="<?php echo $invoices_add->invoice_collection_date->EditValue ?>"<?php echo $invoices_add->invoice_collection_date->editAttributes() ?>>
<?php if (!$invoices_add->invoice_collection_date->ReadOnly && !$invoices_add->invoice_collection_date->Disabled && !isset($invoices_add->invoice_collection_date->EditAttrs["readonly"]) && !isset($invoices_add->invoice_collection_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finvoicesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("finvoicesadd", "x_invoice_collection_date", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
<?php } ?>
</span>
<?php echo $invoices_add->invoice_collection_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_add->invoice_content->Visible) { // invoice_content ?>
	<div id="r_invoice_content" class="form-group row">
		<label id="elh_invoices_invoice_content" class="<?php echo $invoices_add->LeftColumnClass ?>"><?php echo $invoices_add->invoice_content->caption() ?><?php echo $invoices_add->invoice_content->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_add->RightColumnClass ?>"><div <?php echo $invoices_add->invoice_content->cellAttributes() ?>>
<span id="el_invoices_invoice_content">
<?php $invoices_add->invoice_content->EditAttrs->appendClass("editor"); ?>
<textarea data-table="invoices" data-field="x_invoice_content" name="x_invoice_content" id="x_invoice_content" cols="35" rows="4" placeholder="<?php echo HtmlEncode($invoices_add->invoice_content->getPlaceHolder()) ?>"<?php echo $invoices_add->invoice_content->editAttributes() ?>><?php echo $invoices_add->invoice_content->EditValue ?></textarea>
<script>
loadjs.ready(["finvoicesadd", "editor"], function() {
	ew.createEditor("finvoicesadd", "x_invoice_content", 35, 4, <?php echo $invoices_add->invoice_content->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $invoices_add->invoice_content->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($invoices_add->invoice_comments->Visible) { // invoice_comments ?>
	<div id="r_invoice_comments" class="form-group row">
		<label id="elh_invoices_invoice_comments" class="<?php echo $invoices_add->LeftColumnClass ?>"><?php echo $invoices_add->invoice_comments->caption() ?><?php echo $invoices_add->invoice_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $invoices_add->RightColumnClass ?>"><div <?php echo $invoices_add->invoice_comments->cellAttributes() ?>>
<span id="el_invoices_invoice_comments">
<?php $invoices_add->invoice_comments->EditAttrs->appendClass("editor"); ?>
<textarea data-table="invoices" data-field="x_invoice_comments" name="x_invoice_comments" id="x_invoice_comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($invoices_add->invoice_comments->getPlaceHolder()) ?>"<?php echo $invoices_add->invoice_comments->editAttributes() ?>><?php echo $invoices_add->invoice_comments->EditValue ?></textarea>
<script>
loadjs.ready(["finvoicesadd", "editor"], function() {
	ew.createEditor("finvoicesadd", "x_invoice_comments", 35, 4, <?php echo $invoices_add->invoice_comments->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $invoices_add->invoice_comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$invoices_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $invoices_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $invoices_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$invoices_add->showPageFooter();
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
$invoices_add->terminate();
?>