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
$designation_edit = new designation_edit();

// Run the page
$designation_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$designation_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdesignationedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdesignationedit = currentForm = new ew.Form("fdesignationedit", "edit");

	// Validate form
	fdesignationedit.validate = function() {
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
			<?php if ($designation_edit->designation_id->Required) { ?>
				elm = this.getElements("x" + infix + "_designation_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $designation_edit->designation_id->caption(), $designation_edit->designation_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($designation_edit->designation_caption->Required) { ?>
				elm = this.getElements("x" + infix + "_designation_caption");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $designation_edit->designation_caption->caption(), $designation_edit->designation_caption->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($designation_edit->designation_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_designation_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $designation_edit->designation_desc->caption(), $designation_edit->designation_desc->RequiredErrorMessage)) ?>");
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
	fdesignationedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdesignationedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdesignationedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $designation_edit->showPageHeader(); ?>
<?php
$designation_edit->showMessage();
?>
<form name="fdesignationedit" id="fdesignationedit" class="<?php echo $designation_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="designation">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$designation_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($designation_edit->designation_id->Visible) { // designation_id ?>
	<div id="r_designation_id" class="form-group row">
		<label id="elh_designation_designation_id" class="<?php echo $designation_edit->LeftColumnClass ?>"><?php echo $designation_edit->designation_id->caption() ?><?php echo $designation_edit->designation_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $designation_edit->RightColumnClass ?>"><div <?php echo $designation_edit->designation_id->cellAttributes() ?>>
<span id="el_designation_designation_id">
<span<?php echo $designation_edit->designation_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($designation_edit->designation_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="designation" data-field="x_designation_id" name="x_designation_id" id="x_designation_id" value="<?php echo HtmlEncode($designation_edit->designation_id->CurrentValue) ?>">
<?php echo $designation_edit->designation_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($designation_edit->designation_caption->Visible) { // designation_caption ?>
	<div id="r_designation_caption" class="form-group row">
		<label id="elh_designation_designation_caption" for="x_designation_caption" class="<?php echo $designation_edit->LeftColumnClass ?>"><?php echo $designation_edit->designation_caption->caption() ?><?php echo $designation_edit->designation_caption->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $designation_edit->RightColumnClass ?>"><div <?php echo $designation_edit->designation_caption->cellAttributes() ?>>
<span id="el_designation_designation_caption">
<input type="text" data-table="designation" data-field="x_designation_caption" name="x_designation_caption" id="x_designation_caption" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($designation_edit->designation_caption->getPlaceHolder()) ?>" value="<?php echo $designation_edit->designation_caption->EditValue ?>"<?php echo $designation_edit->designation_caption->editAttributes() ?>>
</span>
<?php echo $designation_edit->designation_caption->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($designation_edit->designation_desc->Visible) { // designation_desc ?>
	<div id="r_designation_desc" class="form-group row">
		<label id="elh_designation_designation_desc" for="x_designation_desc" class="<?php echo $designation_edit->LeftColumnClass ?>"><?php echo $designation_edit->designation_desc->caption() ?><?php echo $designation_edit->designation_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $designation_edit->RightColumnClass ?>"><div <?php echo $designation_edit->designation_desc->cellAttributes() ?>>
<span id="el_designation_designation_desc">
<textarea data-table="designation" data-field="x_designation_desc" name="x_designation_desc" id="x_designation_desc" cols="35" rows="4" placeholder="<?php echo HtmlEncode($designation_edit->designation_desc->getPlaceHolder()) ?>"<?php echo $designation_edit->designation_desc->editAttributes() ?>><?php echo $designation_edit->designation_desc->EditValue ?></textarea>
</span>
<?php echo $designation_edit->designation_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$designation_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $designation_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $designation_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$designation_edit->showPageFooter();
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
$designation_edit->terminate();
?>