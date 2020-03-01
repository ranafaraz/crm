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
$reference_letter_edit = new reference_letter_edit();

// Run the page
$reference_letter_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$reference_letter_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freference_letteredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	freference_letteredit = currentForm = new ew.Form("freference_letteredit", "edit");

	// Validate form
	freference_letteredit.validate = function() {
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
			<?php if ($reference_letter_edit->ref_letter_id->Required) { ?>
				elm = this.getElements("x" + infix + "_ref_letter_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reference_letter_edit->ref_letter_id->caption(), $reference_letter_edit->ref_letter_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reference_letter_edit->ref_letter_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_ref_letter_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reference_letter_edit->ref_letter_branch_id->caption(), $reference_letter_edit->ref_letter_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ref_letter_branch_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($reference_letter_edit->ref_letter_branch_id->errorMessage()) ?>");
			<?php if ($reference_letter_edit->ref_letter_to_whom->Required) { ?>
				elm = this.getElements("x" + infix + "_ref_letter_to_whom");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reference_letter_edit->ref_letter_to_whom->caption(), $reference_letter_edit->ref_letter_to_whom->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reference_letter_edit->ref_letter_by_whom->Required) { ?>
				elm = this.getElements("x" + infix + "_ref_letter_by_whom");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reference_letter_edit->ref_letter_by_whom->caption(), $reference_letter_edit->ref_letter_by_whom->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reference_letter_edit->ref_letter_content->Required) { ?>
				elm = this.getElements("x" + infix + "_ref_letter_content");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reference_letter_edit->ref_letter_content->caption(), $reference_letter_edit->ref_letter_content->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reference_letter_edit->ref_letter_scanned->Required) { ?>
				elm = this.getElements("x" + infix + "_ref_letter_scanned");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reference_letter_edit->ref_letter_scanned->caption(), $reference_letter_edit->ref_letter_scanned->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reference_letter_edit->ref_letter_date->Required) { ?>
				elm = this.getElements("x" + infix + "_ref_letter_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reference_letter_edit->ref_letter_date->caption(), $reference_letter_edit->ref_letter_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ref_letter_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($reference_letter_edit->ref_letter_date->errorMessage()) ?>");
			<?php if ($reference_letter_edit->ref_letter_comments->Required) { ?>
				elm = this.getElements("x" + infix + "_ref_letter_comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reference_letter_edit->ref_letter_comments->caption(), $reference_letter_edit->ref_letter_comments->RequiredErrorMessage)) ?>");
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
	freference_letteredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freference_letteredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("freference_letteredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $reference_letter_edit->showPageHeader(); ?>
<?php
$reference_letter_edit->showMessage();
?>
<form name="freference_letteredit" id="freference_letteredit" class="<?php echo $reference_letter_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="reference_letter">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$reference_letter_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($reference_letter_edit->ref_letter_id->Visible) { // ref_letter_id ?>
	<div id="r_ref_letter_id" class="form-group row">
		<label id="elh_reference_letter_ref_letter_id" class="<?php echo $reference_letter_edit->LeftColumnClass ?>"><?php echo $reference_letter_edit->ref_letter_id->caption() ?><?php echo $reference_letter_edit->ref_letter_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_edit->RightColumnClass ?>"><div <?php echo $reference_letter_edit->ref_letter_id->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_id">
<span<?php echo $reference_letter_edit->ref_letter_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($reference_letter_edit->ref_letter_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="reference_letter" data-field="x_ref_letter_id" name="x_ref_letter_id" id="x_ref_letter_id" value="<?php echo HtmlEncode($reference_letter_edit->ref_letter_id->CurrentValue) ?>">
<?php echo $reference_letter_edit->ref_letter_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reference_letter_edit->ref_letter_branch_id->Visible) { // ref_letter_branch_id ?>
	<div id="r_ref_letter_branch_id" class="form-group row">
		<label id="elh_reference_letter_ref_letter_branch_id" for="x_ref_letter_branch_id" class="<?php echo $reference_letter_edit->LeftColumnClass ?>"><?php echo $reference_letter_edit->ref_letter_branch_id->caption() ?><?php echo $reference_letter_edit->ref_letter_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_edit->RightColumnClass ?>"><div <?php echo $reference_letter_edit->ref_letter_branch_id->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_branch_id">
<input type="text" data-table="reference_letter" data-field="x_ref_letter_branch_id" name="x_ref_letter_branch_id" id="x_ref_letter_branch_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($reference_letter_edit->ref_letter_branch_id->getPlaceHolder()) ?>" value="<?php echo $reference_letter_edit->ref_letter_branch_id->EditValue ?>"<?php echo $reference_letter_edit->ref_letter_branch_id->editAttributes() ?>>
</span>
<?php echo $reference_letter_edit->ref_letter_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reference_letter_edit->ref_letter_to_whom->Visible) { // ref_letter_to_whom ?>
	<div id="r_ref_letter_to_whom" class="form-group row">
		<label id="elh_reference_letter_ref_letter_to_whom" for="x_ref_letter_to_whom" class="<?php echo $reference_letter_edit->LeftColumnClass ?>"><?php echo $reference_letter_edit->ref_letter_to_whom->caption() ?><?php echo $reference_letter_edit->ref_letter_to_whom->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_edit->RightColumnClass ?>"><div <?php echo $reference_letter_edit->ref_letter_to_whom->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_to_whom">
<input type="text" data-table="reference_letter" data-field="x_ref_letter_to_whom" name="x_ref_letter_to_whom" id="x_ref_letter_to_whom" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($reference_letter_edit->ref_letter_to_whom->getPlaceHolder()) ?>" value="<?php echo $reference_letter_edit->ref_letter_to_whom->EditValue ?>"<?php echo $reference_letter_edit->ref_letter_to_whom->editAttributes() ?>>
</span>
<?php echo $reference_letter_edit->ref_letter_to_whom->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reference_letter_edit->ref_letter_by_whom->Visible) { // ref_letter_by_whom ?>
	<div id="r_ref_letter_by_whom" class="form-group row">
		<label id="elh_reference_letter_ref_letter_by_whom" for="x_ref_letter_by_whom" class="<?php echo $reference_letter_edit->LeftColumnClass ?>"><?php echo $reference_letter_edit->ref_letter_by_whom->caption() ?><?php echo $reference_letter_edit->ref_letter_by_whom->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_edit->RightColumnClass ?>"><div <?php echo $reference_letter_edit->ref_letter_by_whom->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_by_whom">
<input type="text" data-table="reference_letter" data-field="x_ref_letter_by_whom" name="x_ref_letter_by_whom" id="x_ref_letter_by_whom" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($reference_letter_edit->ref_letter_by_whom->getPlaceHolder()) ?>" value="<?php echo $reference_letter_edit->ref_letter_by_whom->EditValue ?>"<?php echo $reference_letter_edit->ref_letter_by_whom->editAttributes() ?>>
</span>
<?php echo $reference_letter_edit->ref_letter_by_whom->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reference_letter_edit->ref_letter_content->Visible) { // ref_letter_content ?>
	<div id="r_ref_letter_content" class="form-group row">
		<label id="elh_reference_letter_ref_letter_content" for="x_ref_letter_content" class="<?php echo $reference_letter_edit->LeftColumnClass ?>"><?php echo $reference_letter_edit->ref_letter_content->caption() ?><?php echo $reference_letter_edit->ref_letter_content->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_edit->RightColumnClass ?>"><div <?php echo $reference_letter_edit->ref_letter_content->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_content">
<textarea data-table="reference_letter" data-field="x_ref_letter_content" name="x_ref_letter_content" id="x_ref_letter_content" cols="35" rows="4" placeholder="<?php echo HtmlEncode($reference_letter_edit->ref_letter_content->getPlaceHolder()) ?>"<?php echo $reference_letter_edit->ref_letter_content->editAttributes() ?>><?php echo $reference_letter_edit->ref_letter_content->EditValue ?></textarea>
</span>
<?php echo $reference_letter_edit->ref_letter_content->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reference_letter_edit->ref_letter_scanned->Visible) { // ref_letter_scanned ?>
	<div id="r_ref_letter_scanned" class="form-group row">
		<label id="elh_reference_letter_ref_letter_scanned" for="x_ref_letter_scanned" class="<?php echo $reference_letter_edit->LeftColumnClass ?>"><?php echo $reference_letter_edit->ref_letter_scanned->caption() ?><?php echo $reference_letter_edit->ref_letter_scanned->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_edit->RightColumnClass ?>"><div <?php echo $reference_letter_edit->ref_letter_scanned->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_scanned">
<input type="text" data-table="reference_letter" data-field="x_ref_letter_scanned" name="x_ref_letter_scanned" id="x_ref_letter_scanned" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($reference_letter_edit->ref_letter_scanned->getPlaceHolder()) ?>" value="<?php echo $reference_letter_edit->ref_letter_scanned->EditValue ?>"<?php echo $reference_letter_edit->ref_letter_scanned->editAttributes() ?>>
</span>
<?php echo $reference_letter_edit->ref_letter_scanned->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reference_letter_edit->ref_letter_date->Visible) { // ref_letter_date ?>
	<div id="r_ref_letter_date" class="form-group row">
		<label id="elh_reference_letter_ref_letter_date" for="x_ref_letter_date" class="<?php echo $reference_letter_edit->LeftColumnClass ?>"><?php echo $reference_letter_edit->ref_letter_date->caption() ?><?php echo $reference_letter_edit->ref_letter_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_edit->RightColumnClass ?>"><div <?php echo $reference_letter_edit->ref_letter_date->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_date">
<input type="text" data-table="reference_letter" data-field="x_ref_letter_date" name="x_ref_letter_date" id="x_ref_letter_date" maxlength="10" placeholder="<?php echo HtmlEncode($reference_letter_edit->ref_letter_date->getPlaceHolder()) ?>" value="<?php echo $reference_letter_edit->ref_letter_date->EditValue ?>"<?php echo $reference_letter_edit->ref_letter_date->editAttributes() ?>>
<?php if (!$reference_letter_edit->ref_letter_date->ReadOnly && !$reference_letter_edit->ref_letter_date->Disabled && !isset($reference_letter_edit->ref_letter_date->EditAttrs["readonly"]) && !isset($reference_letter_edit->ref_letter_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freference_letteredit", "datetimepicker"], function() {
	ew.createDateTimePicker("freference_letteredit", "x_ref_letter_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $reference_letter_edit->ref_letter_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reference_letter_edit->ref_letter_comments->Visible) { // ref_letter_comments ?>
	<div id="r_ref_letter_comments" class="form-group row">
		<label id="elh_reference_letter_ref_letter_comments" for="x_ref_letter_comments" class="<?php echo $reference_letter_edit->LeftColumnClass ?>"><?php echo $reference_letter_edit->ref_letter_comments->caption() ?><?php echo $reference_letter_edit->ref_letter_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_edit->RightColumnClass ?>"><div <?php echo $reference_letter_edit->ref_letter_comments->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_comments">
<textarea data-table="reference_letter" data-field="x_ref_letter_comments" name="x_ref_letter_comments" id="x_ref_letter_comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($reference_letter_edit->ref_letter_comments->getPlaceHolder()) ?>"<?php echo $reference_letter_edit->ref_letter_comments->editAttributes() ?>><?php echo $reference_letter_edit->ref_letter_comments->EditValue ?></textarea>
</span>
<?php echo $reference_letter_edit->ref_letter_comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$reference_letter_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $reference_letter_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $reference_letter_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$reference_letter_edit->showPageFooter();
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
$reference_letter_edit->terminate();
?>