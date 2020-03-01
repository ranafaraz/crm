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
$acc_transaction_add = new acc_transaction_add();

// Run the page
$acc_transaction_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acc_transaction_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var facc_transactionadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	facc_transactionadd = currentForm = new ew.Form("facc_transactionadd", "add");

	// Validate form
	facc_transactionadd.validate = function() {
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
			<?php if ($acc_transaction_add->acc_trans_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_acc_trans_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acc_transaction_add->acc_trans_branch_id->caption(), $acc_transaction_add->acc_trans_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_acc_trans_branch_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($acc_transaction_add->acc_trans_branch_id->errorMessage()) ?>");
			<?php if ($acc_transaction_add->acc_trans_acc_head_id->Required) { ?>
				elm = this.getElements("x" + infix + "_acc_trans_acc_head_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acc_transaction_add->acc_trans_acc_head_id->caption(), $acc_transaction_add->acc_trans_acc_head_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_acc_trans_acc_head_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($acc_transaction_add->acc_trans_acc_head_id->errorMessage()) ?>");
			<?php if ($acc_transaction_add->acc_trans_narration->Required) { ?>
				elm = this.getElements("x" + infix + "_acc_trans_narration");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acc_transaction_add->acc_trans_narration->caption(), $acc_transaction_add->acc_trans_narration->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($acc_transaction_add->acc_trans_amount->Required) { ?>
				elm = this.getElements("x" + infix + "_acc_trans_amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acc_transaction_add->acc_trans_amount->caption(), $acc_transaction_add->acc_trans_amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_acc_trans_amount");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($acc_transaction_add->acc_trans_amount->errorMessage()) ?>");
			<?php if ($acc_transaction_add->acc_trans_date->Required) { ?>
				elm = this.getElements("x" + infix + "_acc_trans_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acc_transaction_add->acc_trans_date->caption(), $acc_transaction_add->acc_trans_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_acc_trans_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($acc_transaction_add->acc_trans_date->errorMessage()) ?>");

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
	facc_transactionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	facc_transactionadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("facc_transactionadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $acc_transaction_add->showPageHeader(); ?>
<?php
$acc_transaction_add->showMessage();
?>
<form name="facc_transactionadd" id="facc_transactionadd" class="<?php echo $acc_transaction_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acc_transaction">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$acc_transaction_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($acc_transaction_add->acc_trans_branch_id->Visible) { // acc_trans_branch_id ?>
	<div id="r_acc_trans_branch_id" class="form-group row">
		<label id="elh_acc_transaction_acc_trans_branch_id" for="x_acc_trans_branch_id" class="<?php echo $acc_transaction_add->LeftColumnClass ?>"><?php echo $acc_transaction_add->acc_trans_branch_id->caption() ?><?php echo $acc_transaction_add->acc_trans_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acc_transaction_add->RightColumnClass ?>"><div <?php echo $acc_transaction_add->acc_trans_branch_id->cellAttributes() ?>>
<span id="el_acc_transaction_acc_trans_branch_id">
<input type="text" data-table="acc_transaction" data-field="x_acc_trans_branch_id" name="x_acc_trans_branch_id" id="x_acc_trans_branch_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($acc_transaction_add->acc_trans_branch_id->getPlaceHolder()) ?>" value="<?php echo $acc_transaction_add->acc_trans_branch_id->EditValue ?>"<?php echo $acc_transaction_add->acc_trans_branch_id->editAttributes() ?>>
</span>
<?php echo $acc_transaction_add->acc_trans_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($acc_transaction_add->acc_trans_acc_head_id->Visible) { // acc_trans_acc_head_id ?>
	<div id="r_acc_trans_acc_head_id" class="form-group row">
		<label id="elh_acc_transaction_acc_trans_acc_head_id" for="x_acc_trans_acc_head_id" class="<?php echo $acc_transaction_add->LeftColumnClass ?>"><?php echo $acc_transaction_add->acc_trans_acc_head_id->caption() ?><?php echo $acc_transaction_add->acc_trans_acc_head_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acc_transaction_add->RightColumnClass ?>"><div <?php echo $acc_transaction_add->acc_trans_acc_head_id->cellAttributes() ?>>
<span id="el_acc_transaction_acc_trans_acc_head_id">
<input type="text" data-table="acc_transaction" data-field="x_acc_trans_acc_head_id" name="x_acc_trans_acc_head_id" id="x_acc_trans_acc_head_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($acc_transaction_add->acc_trans_acc_head_id->getPlaceHolder()) ?>" value="<?php echo $acc_transaction_add->acc_trans_acc_head_id->EditValue ?>"<?php echo $acc_transaction_add->acc_trans_acc_head_id->editAttributes() ?>>
</span>
<?php echo $acc_transaction_add->acc_trans_acc_head_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($acc_transaction_add->acc_trans_narration->Visible) { // acc_trans_narration ?>
	<div id="r_acc_trans_narration" class="form-group row">
		<label id="elh_acc_transaction_acc_trans_narration" for="x_acc_trans_narration" class="<?php echo $acc_transaction_add->LeftColumnClass ?>"><?php echo $acc_transaction_add->acc_trans_narration->caption() ?><?php echo $acc_transaction_add->acc_trans_narration->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acc_transaction_add->RightColumnClass ?>"><div <?php echo $acc_transaction_add->acc_trans_narration->cellAttributes() ?>>
<span id="el_acc_transaction_acc_trans_narration">
<textarea data-table="acc_transaction" data-field="x_acc_trans_narration" name="x_acc_trans_narration" id="x_acc_trans_narration" cols="35" rows="4" placeholder="<?php echo HtmlEncode($acc_transaction_add->acc_trans_narration->getPlaceHolder()) ?>"<?php echo $acc_transaction_add->acc_trans_narration->editAttributes() ?>><?php echo $acc_transaction_add->acc_trans_narration->EditValue ?></textarea>
</span>
<?php echo $acc_transaction_add->acc_trans_narration->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($acc_transaction_add->acc_trans_amount->Visible) { // acc_trans_amount ?>
	<div id="r_acc_trans_amount" class="form-group row">
		<label id="elh_acc_transaction_acc_trans_amount" for="x_acc_trans_amount" class="<?php echo $acc_transaction_add->LeftColumnClass ?>"><?php echo $acc_transaction_add->acc_trans_amount->caption() ?><?php echo $acc_transaction_add->acc_trans_amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acc_transaction_add->RightColumnClass ?>"><div <?php echo $acc_transaction_add->acc_trans_amount->cellAttributes() ?>>
<span id="el_acc_transaction_acc_trans_amount">
<input type="text" data-table="acc_transaction" data-field="x_acc_trans_amount" name="x_acc_trans_amount" id="x_acc_trans_amount" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($acc_transaction_add->acc_trans_amount->getPlaceHolder()) ?>" value="<?php echo $acc_transaction_add->acc_trans_amount->EditValue ?>"<?php echo $acc_transaction_add->acc_trans_amount->editAttributes() ?>>
</span>
<?php echo $acc_transaction_add->acc_trans_amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($acc_transaction_add->acc_trans_date->Visible) { // acc_trans_date ?>
	<div id="r_acc_trans_date" class="form-group row">
		<label id="elh_acc_transaction_acc_trans_date" for="x_acc_trans_date" class="<?php echo $acc_transaction_add->LeftColumnClass ?>"><?php echo $acc_transaction_add->acc_trans_date->caption() ?><?php echo $acc_transaction_add->acc_trans_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acc_transaction_add->RightColumnClass ?>"><div <?php echo $acc_transaction_add->acc_trans_date->cellAttributes() ?>>
<span id="el_acc_transaction_acc_trans_date">
<input type="text" data-table="acc_transaction" data-field="x_acc_trans_date" name="x_acc_trans_date" id="x_acc_trans_date" maxlength="10" placeholder="<?php echo HtmlEncode($acc_transaction_add->acc_trans_date->getPlaceHolder()) ?>" value="<?php echo $acc_transaction_add->acc_trans_date->EditValue ?>"<?php echo $acc_transaction_add->acc_trans_date->editAttributes() ?>>
<?php if (!$acc_transaction_add->acc_trans_date->ReadOnly && !$acc_transaction_add->acc_trans_date->Disabled && !isset($acc_transaction_add->acc_trans_date->EditAttrs["readonly"]) && !isset($acc_transaction_add->acc_trans_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["facc_transactionadd", "datetimepicker"], function() {
	ew.createDateTimePicker("facc_transactionadd", "x_acc_trans_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $acc_transaction_add->acc_trans_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$acc_transaction_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $acc_transaction_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $acc_transaction_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$acc_transaction_add->showPageFooter();
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
$acc_transaction_add->terminate();
?>