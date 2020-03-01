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
$cus_support_edit = new cus_support_edit();

// Run the page
$cus_support_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cus_support_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcus_supportedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcus_supportedit = currentForm = new ew.Form("fcus_supportedit", "edit");

	// Validate form
	fcus_supportedit.validate = function() {
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
			<?php if ($cus_support_edit->cus_sup_id->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_edit->cus_sup_id->caption(), $cus_support_edit->cus_sup_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cus_support_edit->cus_sup_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_edit->cus_sup_branch_id->caption(), $cus_support_edit->cus_sup_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_cus_sup_branch_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cus_support_edit->cus_sup_branch_id->errorMessage()) ?>");
			<?php if ($cus_support_edit->cus_sup_emp_id->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_emp_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_edit->cus_sup_emp_id->caption(), $cus_support_edit->cus_sup_emp_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_cus_sup_emp_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cus_support_edit->cus_sup_emp_id->errorMessage()) ?>");
			<?php if ($cus_support_edit->cus_sup_query->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_query");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_edit->cus_sup_query->caption(), $cus_support_edit->cus_sup_query->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cus_support_edit->cus_sup_screen_shots->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_screen_shots");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_edit->cus_sup_screen_shots->caption(), $cus_support_edit->cus_sup_screen_shots->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cus_support_edit->cus_sup_date->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_edit->cus_sup_date->caption(), $cus_support_edit->cus_sup_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_cus_sup_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cus_support_edit->cus_sup_date->errorMessage()) ?>");
			<?php if ($cus_support_edit->cus_sup_status->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_edit->cus_sup_status->caption(), $cus_support_edit->cus_sup_status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cus_support_edit->cus_sup_comments->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_edit->cus_sup_comments->caption(), $cus_support_edit->cus_sup_comments->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cus_support_edit->cus_sup_resolved_on->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_resolved_on");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_edit->cus_sup_resolved_on->caption(), $cus_support_edit->cus_sup_resolved_on->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_cus_sup_resolved_on");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cus_support_edit->cus_sup_resolved_on->errorMessage()) ?>");

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
	fcus_supportedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcus_supportedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcus_supportedit.lists["x_cus_sup_status"] = <?php echo $cus_support_edit->cus_sup_status->Lookup->toClientList($cus_support_edit) ?>;
	fcus_supportedit.lists["x_cus_sup_status"].options = <?php echo JsonEncode($cus_support_edit->cus_sup_status->options(FALSE, TRUE)) ?>;
	loadjs.done("fcus_supportedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cus_support_edit->showPageHeader(); ?>
<?php
$cus_support_edit->showMessage();
?>
<form name="fcus_supportedit" id="fcus_supportedit" class="<?php echo $cus_support_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cus_support">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$cus_support_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($cus_support_edit->cus_sup_id->Visible) { // cus_sup_id ?>
	<div id="r_cus_sup_id" class="form-group row">
		<label id="elh_cus_support_cus_sup_id" class="<?php echo $cus_support_edit->LeftColumnClass ?>"><?php echo $cus_support_edit->cus_sup_id->caption() ?><?php echo $cus_support_edit->cus_sup_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_edit->RightColumnClass ?>"><div <?php echo $cus_support_edit->cus_sup_id->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_id">
<span<?php echo $cus_support_edit->cus_sup_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cus_support_edit->cus_sup_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cus_support" data-field="x_cus_sup_id" name="x_cus_sup_id" id="x_cus_sup_id" value="<?php echo HtmlEncode($cus_support_edit->cus_sup_id->CurrentValue) ?>">
<?php echo $cus_support_edit->cus_sup_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_edit->cus_sup_branch_id->Visible) { // cus_sup_branch_id ?>
	<div id="r_cus_sup_branch_id" class="form-group row">
		<label id="elh_cus_support_cus_sup_branch_id" for="x_cus_sup_branch_id" class="<?php echo $cus_support_edit->LeftColumnClass ?>"><?php echo $cus_support_edit->cus_sup_branch_id->caption() ?><?php echo $cus_support_edit->cus_sup_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_edit->RightColumnClass ?>"><div <?php echo $cus_support_edit->cus_sup_branch_id->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_branch_id">
<input type="text" data-table="cus_support" data-field="x_cus_sup_branch_id" name="x_cus_sup_branch_id" id="x_cus_sup_branch_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($cus_support_edit->cus_sup_branch_id->getPlaceHolder()) ?>" value="<?php echo $cus_support_edit->cus_sup_branch_id->EditValue ?>"<?php echo $cus_support_edit->cus_sup_branch_id->editAttributes() ?>>
</span>
<?php echo $cus_support_edit->cus_sup_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_edit->cus_sup_emp_id->Visible) { // cus_sup_emp_id ?>
	<div id="r_cus_sup_emp_id" class="form-group row">
		<label id="elh_cus_support_cus_sup_emp_id" for="x_cus_sup_emp_id" class="<?php echo $cus_support_edit->LeftColumnClass ?>"><?php echo $cus_support_edit->cus_sup_emp_id->caption() ?><?php echo $cus_support_edit->cus_sup_emp_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_edit->RightColumnClass ?>"><div <?php echo $cus_support_edit->cus_sup_emp_id->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_emp_id">
<input type="text" data-table="cus_support" data-field="x_cus_sup_emp_id" name="x_cus_sup_emp_id" id="x_cus_sup_emp_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($cus_support_edit->cus_sup_emp_id->getPlaceHolder()) ?>" value="<?php echo $cus_support_edit->cus_sup_emp_id->EditValue ?>"<?php echo $cus_support_edit->cus_sup_emp_id->editAttributes() ?>>
</span>
<?php echo $cus_support_edit->cus_sup_emp_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_edit->cus_sup_query->Visible) { // cus_sup_query ?>
	<div id="r_cus_sup_query" class="form-group row">
		<label id="elh_cus_support_cus_sup_query" for="x_cus_sup_query" class="<?php echo $cus_support_edit->LeftColumnClass ?>"><?php echo $cus_support_edit->cus_sup_query->caption() ?><?php echo $cus_support_edit->cus_sup_query->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_edit->RightColumnClass ?>"><div <?php echo $cus_support_edit->cus_sup_query->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_query">
<textarea data-table="cus_support" data-field="x_cus_sup_query" name="x_cus_sup_query" id="x_cus_sup_query" cols="35" rows="4" placeholder="<?php echo HtmlEncode($cus_support_edit->cus_sup_query->getPlaceHolder()) ?>"<?php echo $cus_support_edit->cus_sup_query->editAttributes() ?>><?php echo $cus_support_edit->cus_sup_query->EditValue ?></textarea>
</span>
<?php echo $cus_support_edit->cus_sup_query->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_edit->cus_sup_screen_shots->Visible) { // cus_sup_screen_shots ?>
	<div id="r_cus_sup_screen_shots" class="form-group row">
		<label id="elh_cus_support_cus_sup_screen_shots" for="x_cus_sup_screen_shots" class="<?php echo $cus_support_edit->LeftColumnClass ?>"><?php echo $cus_support_edit->cus_sup_screen_shots->caption() ?><?php echo $cus_support_edit->cus_sup_screen_shots->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_edit->RightColumnClass ?>"><div <?php echo $cus_support_edit->cus_sup_screen_shots->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_screen_shots">
<textarea data-table="cus_support" data-field="x_cus_sup_screen_shots" name="x_cus_sup_screen_shots" id="x_cus_sup_screen_shots" cols="35" rows="4" placeholder="<?php echo HtmlEncode($cus_support_edit->cus_sup_screen_shots->getPlaceHolder()) ?>"<?php echo $cus_support_edit->cus_sup_screen_shots->editAttributes() ?>><?php echo $cus_support_edit->cus_sup_screen_shots->EditValue ?></textarea>
</span>
<?php echo $cus_support_edit->cus_sup_screen_shots->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_edit->cus_sup_date->Visible) { // cus_sup_date ?>
	<div id="r_cus_sup_date" class="form-group row">
		<label id="elh_cus_support_cus_sup_date" for="x_cus_sup_date" class="<?php echo $cus_support_edit->LeftColumnClass ?>"><?php echo $cus_support_edit->cus_sup_date->caption() ?><?php echo $cus_support_edit->cus_sup_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_edit->RightColumnClass ?>"><div <?php echo $cus_support_edit->cus_sup_date->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_date">
<input type="text" data-table="cus_support" data-field="x_cus_sup_date" name="x_cus_sup_date" id="x_cus_sup_date" maxlength="19" placeholder="<?php echo HtmlEncode($cus_support_edit->cus_sup_date->getPlaceHolder()) ?>" value="<?php echo $cus_support_edit->cus_sup_date->EditValue ?>"<?php echo $cus_support_edit->cus_sup_date->editAttributes() ?>>
<?php if (!$cus_support_edit->cus_sup_date->ReadOnly && !$cus_support_edit->cus_sup_date->Disabled && !isset($cus_support_edit->cus_sup_date->EditAttrs["readonly"]) && !isset($cus_support_edit->cus_sup_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcus_supportedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcus_supportedit", "x_cus_sup_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $cus_support_edit->cus_sup_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_edit->cus_sup_status->Visible) { // cus_sup_status ?>
	<div id="r_cus_sup_status" class="form-group row">
		<label id="elh_cus_support_cus_sup_status" class="<?php echo $cus_support_edit->LeftColumnClass ?>"><?php echo $cus_support_edit->cus_sup_status->caption() ?><?php echo $cus_support_edit->cus_sup_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_edit->RightColumnClass ?>"><div <?php echo $cus_support_edit->cus_sup_status->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_status">
<div id="tp_x_cus_sup_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="cus_support" data-field="x_cus_sup_status" data-value-separator="<?php echo $cus_support_edit->cus_sup_status->displayValueSeparatorAttribute() ?>" name="x_cus_sup_status" id="x_cus_sup_status" value="{value}"<?php echo $cus_support_edit->cus_sup_status->editAttributes() ?>></div>
<div id="dsl_x_cus_sup_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $cus_support_edit->cus_sup_status->radioButtonListHtml(FALSE, "x_cus_sup_status") ?>
</div></div>
</span>
<?php echo $cus_support_edit->cus_sup_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_edit->cus_sup_comments->Visible) { // cus_sup_comments ?>
	<div id="r_cus_sup_comments" class="form-group row">
		<label id="elh_cus_support_cus_sup_comments" for="x_cus_sup_comments" class="<?php echo $cus_support_edit->LeftColumnClass ?>"><?php echo $cus_support_edit->cus_sup_comments->caption() ?><?php echo $cus_support_edit->cus_sup_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_edit->RightColumnClass ?>"><div <?php echo $cus_support_edit->cus_sup_comments->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_comments">
<textarea data-table="cus_support" data-field="x_cus_sup_comments" name="x_cus_sup_comments" id="x_cus_sup_comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($cus_support_edit->cus_sup_comments->getPlaceHolder()) ?>"<?php echo $cus_support_edit->cus_sup_comments->editAttributes() ?>><?php echo $cus_support_edit->cus_sup_comments->EditValue ?></textarea>
</span>
<?php echo $cus_support_edit->cus_sup_comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_edit->cus_sup_resolved_on->Visible) { // cus_sup_resolved_on ?>
	<div id="r_cus_sup_resolved_on" class="form-group row">
		<label id="elh_cus_support_cus_sup_resolved_on" for="x_cus_sup_resolved_on" class="<?php echo $cus_support_edit->LeftColumnClass ?>"><?php echo $cus_support_edit->cus_sup_resolved_on->caption() ?><?php echo $cus_support_edit->cus_sup_resolved_on->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_edit->RightColumnClass ?>"><div <?php echo $cus_support_edit->cus_sup_resolved_on->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_resolved_on">
<input type="text" data-table="cus_support" data-field="x_cus_sup_resolved_on" name="x_cus_sup_resolved_on" id="x_cus_sup_resolved_on" maxlength="19" placeholder="<?php echo HtmlEncode($cus_support_edit->cus_sup_resolved_on->getPlaceHolder()) ?>" value="<?php echo $cus_support_edit->cus_sup_resolved_on->EditValue ?>"<?php echo $cus_support_edit->cus_sup_resolved_on->editAttributes() ?>>
<?php if (!$cus_support_edit->cus_sup_resolved_on->ReadOnly && !$cus_support_edit->cus_sup_resolved_on->Disabled && !isset($cus_support_edit->cus_sup_resolved_on->EditAttrs["readonly"]) && !isset($cus_support_edit->cus_sup_resolved_on->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcus_supportedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcus_supportedit", "x_cus_sup_resolved_on", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $cus_support_edit->cus_sup_resolved_on->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cus_support_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cus_support_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cus_support_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cus_support_edit->showPageFooter();
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
$cus_support_edit->terminate();
?>