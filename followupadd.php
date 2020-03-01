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
$followup_add = new followup_add();

// Run the page
$followup_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$followup_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ffollowupadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ffollowupadd = currentForm = new ew.Form("ffollowupadd", "add");

	// Validate form
	ffollowupadd.validate = function() {
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
			<?php if ($followup_add->followup_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_add->followup_branch_id->caption(), $followup_add->followup_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_followup_branch_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($followup_add->followup_branch_id->errorMessage()) ?>");
			<?php if ($followup_add->followup_business_id->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_business_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_add->followup_business_id->caption(), $followup_add->followup_business_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_followup_business_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($followup_add->followup_business_id->errorMessage()) ?>");
			<?php if ($followup_add->followup_by_emp_id->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_by_emp_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_add->followup_by_emp_id->caption(), $followup_add->followup_by_emp_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_followup_by_emp_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($followup_add->followup_by_emp_id->errorMessage()) ?>");
			<?php if ($followup_add->followup_no_id->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_no_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_add->followup_no_id->caption(), $followup_add->followup_no_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_followup_no_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($followup_add->followup_no_id->errorMessage()) ?>");
			<?php if ($followup_add->followup_date->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_add->followup_date->caption(), $followup_add->followup_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_followup_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($followup_add->followup_date->errorMessage()) ?>");
			<?php if ($followup_add->followup_comments->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_add->followup_comments->caption(), $followup_add->followup_comments->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($followup_add->followup_response->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_response");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_add->followup_response->caption(), $followup_add->followup_response->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($followup_add->nxt_FU_date->Required) { ?>
				elm = this.getElements("x" + infix + "_nxt_FU_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_add->nxt_FU_date->caption(), $followup_add->nxt_FU_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nxt_FU_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($followup_add->nxt_FU_date->errorMessage()) ?>");
			<?php if ($followup_add->nxt_FU_plans->Required) { ?>
				elm = this.getElements("x" + infix + "_nxt_FU_plans");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_add->nxt_FU_plans->caption(), $followup_add->nxt_FU_plans->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($followup_add->current_FU_status->Required) { ?>
				elm = this.getElements("x" + infix + "_current_FU_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_add->current_FU_status->caption(), $followup_add->current_FU_status->RequiredErrorMessage)) ?>");
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
	ffollowupadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ffollowupadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ffollowupadd.lists["x_followup_response"] = <?php echo $followup_add->followup_response->Lookup->toClientList($followup_add) ?>;
	ffollowupadd.lists["x_followup_response"].options = <?php echo JsonEncode($followup_add->followup_response->options(FALSE, TRUE)) ?>;
	ffollowupadd.lists["x_current_FU_status"] = <?php echo $followup_add->current_FU_status->Lookup->toClientList($followup_add) ?>;
	ffollowupadd.lists["x_current_FU_status"].options = <?php echo JsonEncode($followup_add->current_FU_status->options(FALSE, TRUE)) ?>;
	loadjs.done("ffollowupadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $followup_add->showPageHeader(); ?>
<?php
$followup_add->showMessage();
?>
<form name="ffollowupadd" id="ffollowupadd" class="<?php echo $followup_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="followup">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$followup_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($followup_add->followup_branch_id->Visible) { // followup_branch_id ?>
	<div id="r_followup_branch_id" class="form-group row">
		<label id="elh_followup_followup_branch_id" for="x_followup_branch_id" class="<?php echo $followup_add->LeftColumnClass ?>"><?php echo $followup_add->followup_branch_id->caption() ?><?php echo $followup_add->followup_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_add->RightColumnClass ?>"><div <?php echo $followup_add->followup_branch_id->cellAttributes() ?>>
<span id="el_followup_followup_branch_id">
<input type="text" data-table="followup" data-field="x_followup_branch_id" name="x_followup_branch_id" id="x_followup_branch_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($followup_add->followup_branch_id->getPlaceHolder()) ?>" value="<?php echo $followup_add->followup_branch_id->EditValue ?>"<?php echo $followup_add->followup_branch_id->editAttributes() ?>>
</span>
<?php echo $followup_add->followup_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_add->followup_business_id->Visible) { // followup_business_id ?>
	<div id="r_followup_business_id" class="form-group row">
		<label id="elh_followup_followup_business_id" for="x_followup_business_id" class="<?php echo $followup_add->LeftColumnClass ?>"><?php echo $followup_add->followup_business_id->caption() ?><?php echo $followup_add->followup_business_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_add->RightColumnClass ?>"><div <?php echo $followup_add->followup_business_id->cellAttributes() ?>>
<span id="el_followup_followup_business_id">
<input type="text" data-table="followup" data-field="x_followup_business_id" name="x_followup_business_id" id="x_followup_business_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($followup_add->followup_business_id->getPlaceHolder()) ?>" value="<?php echo $followup_add->followup_business_id->EditValue ?>"<?php echo $followup_add->followup_business_id->editAttributes() ?>>
</span>
<?php echo $followup_add->followup_business_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_add->followup_by_emp_id->Visible) { // followup_by_emp_id ?>
	<div id="r_followup_by_emp_id" class="form-group row">
		<label id="elh_followup_followup_by_emp_id" for="x_followup_by_emp_id" class="<?php echo $followup_add->LeftColumnClass ?>"><?php echo $followup_add->followup_by_emp_id->caption() ?><?php echo $followup_add->followup_by_emp_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_add->RightColumnClass ?>"><div <?php echo $followup_add->followup_by_emp_id->cellAttributes() ?>>
<span id="el_followup_followup_by_emp_id">
<input type="text" data-table="followup" data-field="x_followup_by_emp_id" name="x_followup_by_emp_id" id="x_followup_by_emp_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($followup_add->followup_by_emp_id->getPlaceHolder()) ?>" value="<?php echo $followup_add->followup_by_emp_id->EditValue ?>"<?php echo $followup_add->followup_by_emp_id->editAttributes() ?>>
</span>
<?php echo $followup_add->followup_by_emp_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_add->followup_no_id->Visible) { // followup_no_id ?>
	<div id="r_followup_no_id" class="form-group row">
		<label id="elh_followup_followup_no_id" for="x_followup_no_id" class="<?php echo $followup_add->LeftColumnClass ?>"><?php echo $followup_add->followup_no_id->caption() ?><?php echo $followup_add->followup_no_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_add->RightColumnClass ?>"><div <?php echo $followup_add->followup_no_id->cellAttributes() ?>>
<span id="el_followup_followup_no_id">
<input type="text" data-table="followup" data-field="x_followup_no_id" name="x_followup_no_id" id="x_followup_no_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($followup_add->followup_no_id->getPlaceHolder()) ?>" value="<?php echo $followup_add->followup_no_id->EditValue ?>"<?php echo $followup_add->followup_no_id->editAttributes() ?>>
</span>
<?php echo $followup_add->followup_no_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_add->followup_date->Visible) { // followup_date ?>
	<div id="r_followup_date" class="form-group row">
		<label id="elh_followup_followup_date" for="x_followup_date" class="<?php echo $followup_add->LeftColumnClass ?>"><?php echo $followup_add->followup_date->caption() ?><?php echo $followup_add->followup_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_add->RightColumnClass ?>"><div <?php echo $followup_add->followup_date->cellAttributes() ?>>
<span id="el_followup_followup_date">
<input type="text" data-table="followup" data-field="x_followup_date" name="x_followup_date" id="x_followup_date" maxlength="19" placeholder="<?php echo HtmlEncode($followup_add->followup_date->getPlaceHolder()) ?>" value="<?php echo $followup_add->followup_date->EditValue ?>"<?php echo $followup_add->followup_date->editAttributes() ?>>
<?php if (!$followup_add->followup_date->ReadOnly && !$followup_add->followup_date->Disabled && !isset($followup_add->followup_date->EditAttrs["readonly"]) && !isset($followup_add->followup_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffollowupadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ffollowupadd", "x_followup_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $followup_add->followup_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_add->followup_comments->Visible) { // followup_comments ?>
	<div id="r_followup_comments" class="form-group row">
		<label id="elh_followup_followup_comments" for="x_followup_comments" class="<?php echo $followup_add->LeftColumnClass ?>"><?php echo $followup_add->followup_comments->caption() ?><?php echo $followup_add->followup_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_add->RightColumnClass ?>"><div <?php echo $followup_add->followup_comments->cellAttributes() ?>>
<span id="el_followup_followup_comments">
<textarea data-table="followup" data-field="x_followup_comments" name="x_followup_comments" id="x_followup_comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($followup_add->followup_comments->getPlaceHolder()) ?>"<?php echo $followup_add->followup_comments->editAttributes() ?>><?php echo $followup_add->followup_comments->EditValue ?></textarea>
</span>
<?php echo $followup_add->followup_comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_add->followup_response->Visible) { // followup_response ?>
	<div id="r_followup_response" class="form-group row">
		<label id="elh_followup_followup_response" class="<?php echo $followup_add->LeftColumnClass ?>"><?php echo $followup_add->followup_response->caption() ?><?php echo $followup_add->followup_response->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_add->RightColumnClass ?>"><div <?php echo $followup_add->followup_response->cellAttributes() ?>>
<span id="el_followup_followup_response">
<div id="tp_x_followup_response" class="ew-template"><input type="radio" class="custom-control-input" data-table="followup" data-field="x_followup_response" data-value-separator="<?php echo $followup_add->followup_response->displayValueSeparatorAttribute() ?>" name="x_followup_response" id="x_followup_response" value="{value}"<?php echo $followup_add->followup_response->editAttributes() ?>></div>
<div id="dsl_x_followup_response" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $followup_add->followup_response->radioButtonListHtml(FALSE, "x_followup_response") ?>
</div></div>
</span>
<?php echo $followup_add->followup_response->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_add->nxt_FU_date->Visible) { // nxt_FU_date ?>
	<div id="r_nxt_FU_date" class="form-group row">
		<label id="elh_followup_nxt_FU_date" for="x_nxt_FU_date" class="<?php echo $followup_add->LeftColumnClass ?>"><?php echo $followup_add->nxt_FU_date->caption() ?><?php echo $followup_add->nxt_FU_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_add->RightColumnClass ?>"><div <?php echo $followup_add->nxt_FU_date->cellAttributes() ?>>
<span id="el_followup_nxt_FU_date">
<input type="text" data-table="followup" data-field="x_nxt_FU_date" name="x_nxt_FU_date" id="x_nxt_FU_date" maxlength="19" placeholder="<?php echo HtmlEncode($followup_add->nxt_FU_date->getPlaceHolder()) ?>" value="<?php echo $followup_add->nxt_FU_date->EditValue ?>"<?php echo $followup_add->nxt_FU_date->editAttributes() ?>>
<?php if (!$followup_add->nxt_FU_date->ReadOnly && !$followup_add->nxt_FU_date->Disabled && !isset($followup_add->nxt_FU_date->EditAttrs["readonly"]) && !isset($followup_add->nxt_FU_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffollowupadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ffollowupadd", "x_nxt_FU_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $followup_add->nxt_FU_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_add->nxt_FU_plans->Visible) { // nxt_FU_plans ?>
	<div id="r_nxt_FU_plans" class="form-group row">
		<label id="elh_followup_nxt_FU_plans" for="x_nxt_FU_plans" class="<?php echo $followup_add->LeftColumnClass ?>"><?php echo $followup_add->nxt_FU_plans->caption() ?><?php echo $followup_add->nxt_FU_plans->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_add->RightColumnClass ?>"><div <?php echo $followup_add->nxt_FU_plans->cellAttributes() ?>>
<span id="el_followup_nxt_FU_plans">
<textarea data-table="followup" data-field="x_nxt_FU_plans" name="x_nxt_FU_plans" id="x_nxt_FU_plans" cols="35" rows="4" placeholder="<?php echo HtmlEncode($followup_add->nxt_FU_plans->getPlaceHolder()) ?>"<?php echo $followup_add->nxt_FU_plans->editAttributes() ?>><?php echo $followup_add->nxt_FU_plans->EditValue ?></textarea>
</span>
<?php echo $followup_add->nxt_FU_plans->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_add->current_FU_status->Visible) { // current_FU_status ?>
	<div id="r_current_FU_status" class="form-group row">
		<label id="elh_followup_current_FU_status" class="<?php echo $followup_add->LeftColumnClass ?>"><?php echo $followup_add->current_FU_status->caption() ?><?php echo $followup_add->current_FU_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_add->RightColumnClass ?>"><div <?php echo $followup_add->current_FU_status->cellAttributes() ?>>
<span id="el_followup_current_FU_status">
<div id="tp_x_current_FU_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="followup" data-field="x_current_FU_status" data-value-separator="<?php echo $followup_add->current_FU_status->displayValueSeparatorAttribute() ?>" name="x_current_FU_status" id="x_current_FU_status" value="{value}"<?php echo $followup_add->current_FU_status->editAttributes() ?>></div>
<div id="dsl_x_current_FU_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $followup_add->current_FU_status->radioButtonListHtml(FALSE, "x_current_FU_status") ?>
</div></div>
</span>
<?php echo $followup_add->current_FU_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$followup_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $followup_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $followup_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$followup_add->showPageFooter();
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
$followup_add->terminate();
?>