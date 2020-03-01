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
$division_edit = new division_edit();

// Run the page
$division_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$division_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdivisionedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdivisionedit = currentForm = new ew.Form("fdivisionedit", "edit");

	// Validate form
	fdivisionedit.validate = function() {
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
			<?php if ($division_edit->division_id->Required) { ?>
				elm = this.getElements("x" + infix + "_division_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_edit->division_id->caption(), $division_edit->division_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($division_edit->division_state_id->Required) { ?>
				elm = this.getElements("x" + infix + "_division_state_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_edit->division_state_id->caption(), $division_edit->division_state_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_division_state_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($division_edit->division_state_id->errorMessage()) ?>");
			<?php if ($division_edit->division_name->Required) { ?>
				elm = this.getElements("x" + infix + "_division_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_edit->division_name->caption(), $division_edit->division_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($division_edit->division_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_division_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_edit->division_desc->caption(), $division_edit->division_desc->RequiredErrorMessage)) ?>");
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
	fdivisionedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdivisionedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdivisionedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $division_edit->showPageHeader(); ?>
<?php
$division_edit->showMessage();
?>
<form name="fdivisionedit" id="fdivisionedit" class="<?php echo $division_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="division">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$division_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($division_edit->division_id->Visible) { // division_id ?>
	<div id="r_division_id" class="form-group row">
		<label id="elh_division_division_id" class="<?php echo $division_edit->LeftColumnClass ?>"><?php echo $division_edit->division_id->caption() ?><?php echo $division_edit->division_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $division_edit->RightColumnClass ?>"><div <?php echo $division_edit->division_id->cellAttributes() ?>>
<span id="el_division_division_id">
<span<?php echo $division_edit->division_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($division_edit->division_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="division" data-field="x_division_id" name="x_division_id" id="x_division_id" value="<?php echo HtmlEncode($division_edit->division_id->CurrentValue) ?>">
<?php echo $division_edit->division_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($division_edit->division_state_id->Visible) { // division_state_id ?>
	<div id="r_division_state_id" class="form-group row">
		<label id="elh_division_division_state_id" for="x_division_state_id" class="<?php echo $division_edit->LeftColumnClass ?>"><?php echo $division_edit->division_state_id->caption() ?><?php echo $division_edit->division_state_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $division_edit->RightColumnClass ?>"><div <?php echo $division_edit->division_state_id->cellAttributes() ?>>
<span id="el_division_division_state_id">
<input type="text" data-table="division" data-field="x_division_state_id" name="x_division_state_id" id="x_division_state_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($division_edit->division_state_id->getPlaceHolder()) ?>" value="<?php echo $division_edit->division_state_id->EditValue ?>"<?php echo $division_edit->division_state_id->editAttributes() ?>>
</span>
<?php echo $division_edit->division_state_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($division_edit->division_name->Visible) { // division_name ?>
	<div id="r_division_name" class="form-group row">
		<label id="elh_division_division_name" for="x_division_name" class="<?php echo $division_edit->LeftColumnClass ?>"><?php echo $division_edit->division_name->caption() ?><?php echo $division_edit->division_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $division_edit->RightColumnClass ?>"><div <?php echo $division_edit->division_name->cellAttributes() ?>>
<span id="el_division_division_name">
<input type="text" data-table="division" data-field="x_division_name" name="x_division_name" id="x_division_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($division_edit->division_name->getPlaceHolder()) ?>" value="<?php echo $division_edit->division_name->EditValue ?>"<?php echo $division_edit->division_name->editAttributes() ?>>
</span>
<?php echo $division_edit->division_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($division_edit->division_desc->Visible) { // division_desc ?>
	<div id="r_division_desc" class="form-group row">
		<label id="elh_division_division_desc" for="x_division_desc" class="<?php echo $division_edit->LeftColumnClass ?>"><?php echo $division_edit->division_desc->caption() ?><?php echo $division_edit->division_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $division_edit->RightColumnClass ?>"><div <?php echo $division_edit->division_desc->cellAttributes() ?>>
<span id="el_division_division_desc">
<input type="text" data-table="division" data-field="x_division_desc" name="x_division_desc" id="x_division_desc" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($division_edit->division_desc->getPlaceHolder()) ?>" value="<?php echo $division_edit->division_desc->EditValue ?>"<?php echo $division_edit->division_desc->editAttributes() ?>>
</span>
<?php echo $division_edit->division_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$division_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $division_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $division_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$division_edit->showPageFooter();
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
$division_edit->terminate();
?>