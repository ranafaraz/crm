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
$acc_head_edit = new acc_head_edit();

// Run the page
$acc_head_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acc_head_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var facc_headedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	facc_headedit = currentForm = new ew.Form("facc_headedit", "edit");

	// Validate form
	facc_headedit.validate = function() {
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
			<?php if ($acc_head_edit->acc_head_id->Required) { ?>
				elm = this.getElements("x" + infix + "_acc_head_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acc_head_edit->acc_head_id->caption(), $acc_head_edit->acc_head_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($acc_head_edit->acc_head_acc_nature_id->Required) { ?>
				elm = this.getElements("x" + infix + "_acc_head_acc_nature_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acc_head_edit->acc_head_acc_nature_id->caption(), $acc_head_edit->acc_head_acc_nature_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_acc_head_acc_nature_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($acc_head_edit->acc_head_acc_nature_id->errorMessage()) ?>");
			<?php if ($acc_head_edit->acc_head_caption->Required) { ?>
				elm = this.getElements("x" + infix + "_acc_head_caption");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acc_head_edit->acc_head_caption->caption(), $acc_head_edit->acc_head_caption->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($acc_head_edit->acc_head_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_acc_head_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acc_head_edit->acc_head_desc->caption(), $acc_head_edit->acc_head_desc->RequiredErrorMessage)) ?>");
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
	facc_headedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	facc_headedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("facc_headedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $acc_head_edit->showPageHeader(); ?>
<?php
$acc_head_edit->showMessage();
?>
<form name="facc_headedit" id="facc_headedit" class="<?php echo $acc_head_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acc_head">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$acc_head_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($acc_head_edit->acc_head_id->Visible) { // acc_head_id ?>
	<div id="r_acc_head_id" class="form-group row">
		<label id="elh_acc_head_acc_head_id" class="<?php echo $acc_head_edit->LeftColumnClass ?>"><?php echo $acc_head_edit->acc_head_id->caption() ?><?php echo $acc_head_edit->acc_head_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acc_head_edit->RightColumnClass ?>"><div <?php echo $acc_head_edit->acc_head_id->cellAttributes() ?>>
<span id="el_acc_head_acc_head_id">
<span<?php echo $acc_head_edit->acc_head_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($acc_head_edit->acc_head_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="acc_head" data-field="x_acc_head_id" name="x_acc_head_id" id="x_acc_head_id" value="<?php echo HtmlEncode($acc_head_edit->acc_head_id->CurrentValue) ?>">
<?php echo $acc_head_edit->acc_head_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($acc_head_edit->acc_head_acc_nature_id->Visible) { // acc_head_acc_nature_id ?>
	<div id="r_acc_head_acc_nature_id" class="form-group row">
		<label id="elh_acc_head_acc_head_acc_nature_id" for="x_acc_head_acc_nature_id" class="<?php echo $acc_head_edit->LeftColumnClass ?>"><?php echo $acc_head_edit->acc_head_acc_nature_id->caption() ?><?php echo $acc_head_edit->acc_head_acc_nature_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acc_head_edit->RightColumnClass ?>"><div <?php echo $acc_head_edit->acc_head_acc_nature_id->cellAttributes() ?>>
<span id="el_acc_head_acc_head_acc_nature_id">
<input type="text" data-table="acc_head" data-field="x_acc_head_acc_nature_id" name="x_acc_head_acc_nature_id" id="x_acc_head_acc_nature_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($acc_head_edit->acc_head_acc_nature_id->getPlaceHolder()) ?>" value="<?php echo $acc_head_edit->acc_head_acc_nature_id->EditValue ?>"<?php echo $acc_head_edit->acc_head_acc_nature_id->editAttributes() ?>>
</span>
<?php echo $acc_head_edit->acc_head_acc_nature_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($acc_head_edit->acc_head_caption->Visible) { // acc_head_caption ?>
	<div id="r_acc_head_caption" class="form-group row">
		<label id="elh_acc_head_acc_head_caption" for="x_acc_head_caption" class="<?php echo $acc_head_edit->LeftColumnClass ?>"><?php echo $acc_head_edit->acc_head_caption->caption() ?><?php echo $acc_head_edit->acc_head_caption->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acc_head_edit->RightColumnClass ?>"><div <?php echo $acc_head_edit->acc_head_caption->cellAttributes() ?>>
<span id="el_acc_head_acc_head_caption">
<input type="text" data-table="acc_head" data-field="x_acc_head_caption" name="x_acc_head_caption" id="x_acc_head_caption" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($acc_head_edit->acc_head_caption->getPlaceHolder()) ?>" value="<?php echo $acc_head_edit->acc_head_caption->EditValue ?>"<?php echo $acc_head_edit->acc_head_caption->editAttributes() ?>>
</span>
<?php echo $acc_head_edit->acc_head_caption->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($acc_head_edit->acc_head_desc->Visible) { // acc_head_desc ?>
	<div id="r_acc_head_desc" class="form-group row">
		<label id="elh_acc_head_acc_head_desc" for="x_acc_head_desc" class="<?php echo $acc_head_edit->LeftColumnClass ?>"><?php echo $acc_head_edit->acc_head_desc->caption() ?><?php echo $acc_head_edit->acc_head_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acc_head_edit->RightColumnClass ?>"><div <?php echo $acc_head_edit->acc_head_desc->cellAttributes() ?>>
<span id="el_acc_head_acc_head_desc">
<input type="text" data-table="acc_head" data-field="x_acc_head_desc" name="x_acc_head_desc" id="x_acc_head_desc" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($acc_head_edit->acc_head_desc->getPlaceHolder()) ?>" value="<?php echo $acc_head_edit->acc_head_desc->EditValue ?>"<?php echo $acc_head_edit->acc_head_desc->editAttributes() ?>>
</span>
<?php echo $acc_head_edit->acc_head_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$acc_head_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $acc_head_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $acc_head_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$acc_head_edit->showPageFooter();
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
$acc_head_edit->terminate();
?>