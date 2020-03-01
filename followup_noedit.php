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
$followup_no_edit = new followup_no_edit();

// Run the page
$followup_no_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$followup_no_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ffollowup_noedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ffollowup_noedit = currentForm = new ew.Form("ffollowup_noedit", "edit");

	// Validate form
	ffollowup_noedit.validate = function() {
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
			<?php if ($followup_no_edit->followup_no_id->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_no_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_no_edit->followup_no_id->caption(), $followup_no_edit->followup_no_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($followup_no_edit->followup_no_caption->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_no_caption");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_no_edit->followup_no_caption->caption(), $followup_no_edit->followup_no_caption->RequiredErrorMessage)) ?>");
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
	ffollowup_noedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ffollowup_noedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ffollowup_noedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $followup_no_edit->showPageHeader(); ?>
<?php
$followup_no_edit->showMessage();
?>
<form name="ffollowup_noedit" id="ffollowup_noedit" class="<?php echo $followup_no_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="followup_no">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$followup_no_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($followup_no_edit->followup_no_id->Visible) { // followup_no_id ?>
	<div id="r_followup_no_id" class="form-group row">
		<label id="elh_followup_no_followup_no_id" class="<?php echo $followup_no_edit->LeftColumnClass ?>"><?php echo $followup_no_edit->followup_no_id->caption() ?><?php echo $followup_no_edit->followup_no_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_no_edit->RightColumnClass ?>"><div <?php echo $followup_no_edit->followup_no_id->cellAttributes() ?>>
<span id="el_followup_no_followup_no_id">
<span<?php echo $followup_no_edit->followup_no_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($followup_no_edit->followup_no_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="followup_no" data-field="x_followup_no_id" name="x_followup_no_id" id="x_followup_no_id" value="<?php echo HtmlEncode($followup_no_edit->followup_no_id->CurrentValue) ?>">
<?php echo $followup_no_edit->followup_no_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_no_edit->followup_no_caption->Visible) { // followup_no_caption ?>
	<div id="r_followup_no_caption" class="form-group row">
		<label id="elh_followup_no_followup_no_caption" for="x_followup_no_caption" class="<?php echo $followup_no_edit->LeftColumnClass ?>"><?php echo $followup_no_edit->followup_no_caption->caption() ?><?php echo $followup_no_edit->followup_no_caption->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_no_edit->RightColumnClass ?>"><div <?php echo $followup_no_edit->followup_no_caption->cellAttributes() ?>>
<span id="el_followup_no_followup_no_caption">
<input type="text" data-table="followup_no" data-field="x_followup_no_caption" name="x_followup_no_caption" id="x_followup_no_caption" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($followup_no_edit->followup_no_caption->getPlaceHolder()) ?>" value="<?php echo $followup_no_edit->followup_no_caption->EditValue ?>"<?php echo $followup_no_edit->followup_no_caption->editAttributes() ?>>
</span>
<?php echo $followup_no_edit->followup_no_caption->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$followup_no_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $followup_no_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $followup_no_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$followup_no_edit->showPageFooter();
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
$followup_no_edit->terminate();
?>