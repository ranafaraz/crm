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
$quotation_add = new quotation_add();

// Run the page
$quotation_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$quotation_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fquotationadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fquotationadd = currentForm = new ew.Form("fquotationadd", "add");

	// Validate form
	fquotationadd.validate = function() {
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
			<?php if ($quotation_add->quote_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_quote_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quotation_add->quote_branch_id->caption(), $quotation_add->quote_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_quote_branch_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quotation_add->quote_branch_id->errorMessage()) ?>");
			<?php if ($quotation_add->quote_business_id->Required) { ?>
				elm = this.getElements("x" + infix + "_quote_business_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quotation_add->quote_business_id->caption(), $quotation_add->quote_business_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_quote_business_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quotation_add->quote_business_id->errorMessage()) ?>");
			<?php if ($quotation_add->quote_service_id->Required) { ?>
				elm = this.getElements("x" + infix + "_quote_service_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quotation_add->quote_service_id->caption(), $quotation_add->quote_service_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_quote_service_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quotation_add->quote_service_id->errorMessage()) ?>");
			<?php if ($quotation_add->quote_issue_date->Required) { ?>
				elm = this.getElements("x" + infix + "_quote_issue_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quotation_add->quote_issue_date->caption(), $quotation_add->quote_issue_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_quote_issue_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quotation_add->quote_issue_date->errorMessage()) ?>");
			<?php if ($quotation_add->quote_due_date->Required) { ?>
				elm = this.getElements("x" + infix + "_quote_due_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quotation_add->quote_due_date->caption(), $quotation_add->quote_due_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_quote_due_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quotation_add->quote_due_date->errorMessage()) ?>");
			<?php if ($quotation_add->quote_amount->Required) { ?>
				elm = this.getElements("x" + infix + "_quote_amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quotation_add->quote_amount->caption(), $quotation_add->quote_amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_quote_amount");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quotation_add->quote_amount->errorMessage()) ?>");
			<?php if ($quotation_add->quote_content->Required) { ?>
				elm = this.getElements("x" + infix + "_quote_content");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quotation_add->quote_content->caption(), $quotation_add->quote_content->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($quotation_add->quote_comments->Required) { ?>
				elm = this.getElements("x" + infix + "_quote_comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quotation_add->quote_comments->caption(), $quotation_add->quote_comments->RequiredErrorMessage)) ?>");
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
	fquotationadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fquotationadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fquotationadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $quotation_add->showPageHeader(); ?>
<?php
$quotation_add->showMessage();
?>
<form name="fquotationadd" id="fquotationadd" class="<?php echo $quotation_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="quotation">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$quotation_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($quotation_add->quote_branch_id->Visible) { // quote_branch_id ?>
	<div id="r_quote_branch_id" class="form-group row">
		<label id="elh_quotation_quote_branch_id" for="x_quote_branch_id" class="<?php echo $quotation_add->LeftColumnClass ?>"><?php echo $quotation_add->quote_branch_id->caption() ?><?php echo $quotation_add->quote_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quotation_add->RightColumnClass ?>"><div <?php echo $quotation_add->quote_branch_id->cellAttributes() ?>>
<span id="el_quotation_quote_branch_id">
<input type="text" data-table="quotation" data-field="x_quote_branch_id" name="x_quote_branch_id" id="x_quote_branch_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($quotation_add->quote_branch_id->getPlaceHolder()) ?>" value="<?php echo $quotation_add->quote_branch_id->EditValue ?>"<?php echo $quotation_add->quote_branch_id->editAttributes() ?>>
</span>
<?php echo $quotation_add->quote_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($quotation_add->quote_business_id->Visible) { // quote_business_id ?>
	<div id="r_quote_business_id" class="form-group row">
		<label id="elh_quotation_quote_business_id" for="x_quote_business_id" class="<?php echo $quotation_add->LeftColumnClass ?>"><?php echo $quotation_add->quote_business_id->caption() ?><?php echo $quotation_add->quote_business_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quotation_add->RightColumnClass ?>"><div <?php echo $quotation_add->quote_business_id->cellAttributes() ?>>
<span id="el_quotation_quote_business_id">
<input type="text" data-table="quotation" data-field="x_quote_business_id" name="x_quote_business_id" id="x_quote_business_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($quotation_add->quote_business_id->getPlaceHolder()) ?>" value="<?php echo $quotation_add->quote_business_id->EditValue ?>"<?php echo $quotation_add->quote_business_id->editAttributes() ?>>
</span>
<?php echo $quotation_add->quote_business_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($quotation_add->quote_service_id->Visible) { // quote_service_id ?>
	<div id="r_quote_service_id" class="form-group row">
		<label id="elh_quotation_quote_service_id" for="x_quote_service_id" class="<?php echo $quotation_add->LeftColumnClass ?>"><?php echo $quotation_add->quote_service_id->caption() ?><?php echo $quotation_add->quote_service_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quotation_add->RightColumnClass ?>"><div <?php echo $quotation_add->quote_service_id->cellAttributes() ?>>
<span id="el_quotation_quote_service_id">
<input type="text" data-table="quotation" data-field="x_quote_service_id" name="x_quote_service_id" id="x_quote_service_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($quotation_add->quote_service_id->getPlaceHolder()) ?>" value="<?php echo $quotation_add->quote_service_id->EditValue ?>"<?php echo $quotation_add->quote_service_id->editAttributes() ?>>
</span>
<?php echo $quotation_add->quote_service_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($quotation_add->quote_issue_date->Visible) { // quote_issue_date ?>
	<div id="r_quote_issue_date" class="form-group row">
		<label id="elh_quotation_quote_issue_date" for="x_quote_issue_date" class="<?php echo $quotation_add->LeftColumnClass ?>"><?php echo $quotation_add->quote_issue_date->caption() ?><?php echo $quotation_add->quote_issue_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quotation_add->RightColumnClass ?>"><div <?php echo $quotation_add->quote_issue_date->cellAttributes() ?>>
<span id="el_quotation_quote_issue_date">
<input type="text" data-table="quotation" data-field="x_quote_issue_date" name="x_quote_issue_date" id="x_quote_issue_date" maxlength="10" placeholder="<?php echo HtmlEncode($quotation_add->quote_issue_date->getPlaceHolder()) ?>" value="<?php echo $quotation_add->quote_issue_date->EditValue ?>"<?php echo $quotation_add->quote_issue_date->editAttributes() ?>>
<?php if (!$quotation_add->quote_issue_date->ReadOnly && !$quotation_add->quote_issue_date->Disabled && !isset($quotation_add->quote_issue_date->EditAttrs["readonly"]) && !isset($quotation_add->quote_issue_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fquotationadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fquotationadd", "x_quote_issue_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $quotation_add->quote_issue_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($quotation_add->quote_due_date->Visible) { // quote_due_date ?>
	<div id="r_quote_due_date" class="form-group row">
		<label id="elh_quotation_quote_due_date" for="x_quote_due_date" class="<?php echo $quotation_add->LeftColumnClass ?>"><?php echo $quotation_add->quote_due_date->caption() ?><?php echo $quotation_add->quote_due_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quotation_add->RightColumnClass ?>"><div <?php echo $quotation_add->quote_due_date->cellAttributes() ?>>
<span id="el_quotation_quote_due_date">
<input type="text" data-table="quotation" data-field="x_quote_due_date" name="x_quote_due_date" id="x_quote_due_date" maxlength="10" placeholder="<?php echo HtmlEncode($quotation_add->quote_due_date->getPlaceHolder()) ?>" value="<?php echo $quotation_add->quote_due_date->EditValue ?>"<?php echo $quotation_add->quote_due_date->editAttributes() ?>>
<?php if (!$quotation_add->quote_due_date->ReadOnly && !$quotation_add->quote_due_date->Disabled && !isset($quotation_add->quote_due_date->EditAttrs["readonly"]) && !isset($quotation_add->quote_due_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fquotationadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fquotationadd", "x_quote_due_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $quotation_add->quote_due_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($quotation_add->quote_amount->Visible) { // quote_amount ?>
	<div id="r_quote_amount" class="form-group row">
		<label id="elh_quotation_quote_amount" for="x_quote_amount" class="<?php echo $quotation_add->LeftColumnClass ?>"><?php echo $quotation_add->quote_amount->caption() ?><?php echo $quotation_add->quote_amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quotation_add->RightColumnClass ?>"><div <?php echo $quotation_add->quote_amount->cellAttributes() ?>>
<span id="el_quotation_quote_amount">
<input type="text" data-table="quotation" data-field="x_quote_amount" name="x_quote_amount" id="x_quote_amount" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($quotation_add->quote_amount->getPlaceHolder()) ?>" value="<?php echo $quotation_add->quote_amount->EditValue ?>"<?php echo $quotation_add->quote_amount->editAttributes() ?>>
</span>
<?php echo $quotation_add->quote_amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($quotation_add->quote_content->Visible) { // quote_content ?>
	<div id="r_quote_content" class="form-group row">
		<label id="elh_quotation_quote_content" for="x_quote_content" class="<?php echo $quotation_add->LeftColumnClass ?>"><?php echo $quotation_add->quote_content->caption() ?><?php echo $quotation_add->quote_content->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quotation_add->RightColumnClass ?>"><div <?php echo $quotation_add->quote_content->cellAttributes() ?>>
<span id="el_quotation_quote_content">
<textarea data-table="quotation" data-field="x_quote_content" name="x_quote_content" id="x_quote_content" cols="35" rows="4" placeholder="<?php echo HtmlEncode($quotation_add->quote_content->getPlaceHolder()) ?>"<?php echo $quotation_add->quote_content->editAttributes() ?>><?php echo $quotation_add->quote_content->EditValue ?></textarea>
</span>
<?php echo $quotation_add->quote_content->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($quotation_add->quote_comments->Visible) { // quote_comments ?>
	<div id="r_quote_comments" class="form-group row">
		<label id="elh_quotation_quote_comments" for="x_quote_comments" class="<?php echo $quotation_add->LeftColumnClass ?>"><?php echo $quotation_add->quote_comments->caption() ?><?php echo $quotation_add->quote_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quotation_add->RightColumnClass ?>"><div <?php echo $quotation_add->quote_comments->cellAttributes() ?>>
<span id="el_quotation_quote_comments">
<textarea data-table="quotation" data-field="x_quote_comments" name="x_quote_comments" id="x_quote_comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($quotation_add->quote_comments->getPlaceHolder()) ?>"<?php echo $quotation_add->quote_comments->editAttributes() ?>><?php echo $quotation_add->quote_comments->EditValue ?></textarea>
</span>
<?php echo $quotation_add->quote_comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$quotation_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $quotation_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $quotation_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$quotation_add->showPageFooter();
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
$quotation_add->terminate();
?>