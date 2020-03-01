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
$referral_edit = new referral_edit();

// Run the page
$referral_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$referral_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freferraledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	freferraledit = currentForm = new ew.Form("freferraledit", "edit");

	// Validate form
	freferraledit.validate = function() {
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
			<?php if ($referral_edit->referral_id->Required) { ?>
				elm = this.getElements("x" + infix + "_referral_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $referral_edit->referral_id->caption(), $referral_edit->referral_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($referral_edit->referral_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_referral_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $referral_edit->referral_branch_id->caption(), $referral_edit->referral_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_referral_branch_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($referral_edit->referral_branch_id->errorMessage()) ?>");
			<?php if ($referral_edit->referral_name->Required) { ?>
				elm = this.getElements("x" + infix + "_referral_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $referral_edit->referral_name->caption(), $referral_edit->referral_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($referral_edit->referral_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_referral_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $referral_edit->referral_desc->caption(), $referral_edit->referral_desc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($referral_edit->referral_deal_signed->Required) { ?>
				elm = this.getElements("x" + infix + "_referral_deal_signed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $referral_edit->referral_deal_signed->caption(), $referral_edit->referral_deal_signed->RequiredErrorMessage)) ?>");
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
	freferraledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freferraledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("freferraledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $referral_edit->showPageHeader(); ?>
<?php
$referral_edit->showMessage();
?>
<form name="freferraledit" id="freferraledit" class="<?php echo $referral_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="referral">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$referral_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($referral_edit->referral_id->Visible) { // referral_id ?>
	<div id="r_referral_id" class="form-group row">
		<label id="elh_referral_referral_id" class="<?php echo $referral_edit->LeftColumnClass ?>"><?php echo $referral_edit->referral_id->caption() ?><?php echo $referral_edit->referral_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $referral_edit->RightColumnClass ?>"><div <?php echo $referral_edit->referral_id->cellAttributes() ?>>
<span id="el_referral_referral_id">
<span<?php echo $referral_edit->referral_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($referral_edit->referral_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="referral" data-field="x_referral_id" name="x_referral_id" id="x_referral_id" value="<?php echo HtmlEncode($referral_edit->referral_id->CurrentValue) ?>">
<?php echo $referral_edit->referral_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($referral_edit->referral_branch_id->Visible) { // referral_branch_id ?>
	<div id="r_referral_branch_id" class="form-group row">
		<label id="elh_referral_referral_branch_id" for="x_referral_branch_id" class="<?php echo $referral_edit->LeftColumnClass ?>"><?php echo $referral_edit->referral_branch_id->caption() ?><?php echo $referral_edit->referral_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $referral_edit->RightColumnClass ?>"><div <?php echo $referral_edit->referral_branch_id->cellAttributes() ?>>
<span id="el_referral_referral_branch_id">
<input type="text" data-table="referral" data-field="x_referral_branch_id" name="x_referral_branch_id" id="x_referral_branch_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($referral_edit->referral_branch_id->getPlaceHolder()) ?>" value="<?php echo $referral_edit->referral_branch_id->EditValue ?>"<?php echo $referral_edit->referral_branch_id->editAttributes() ?>>
</span>
<?php echo $referral_edit->referral_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($referral_edit->referral_name->Visible) { // referral_name ?>
	<div id="r_referral_name" class="form-group row">
		<label id="elh_referral_referral_name" for="x_referral_name" class="<?php echo $referral_edit->LeftColumnClass ?>"><?php echo $referral_edit->referral_name->caption() ?><?php echo $referral_edit->referral_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $referral_edit->RightColumnClass ?>"><div <?php echo $referral_edit->referral_name->cellAttributes() ?>>
<span id="el_referral_referral_name">
<input type="text" data-table="referral" data-field="x_referral_name" name="x_referral_name" id="x_referral_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($referral_edit->referral_name->getPlaceHolder()) ?>" value="<?php echo $referral_edit->referral_name->EditValue ?>"<?php echo $referral_edit->referral_name->editAttributes() ?>>
</span>
<?php echo $referral_edit->referral_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($referral_edit->referral_desc->Visible) { // referral_desc ?>
	<div id="r_referral_desc" class="form-group row">
		<label id="elh_referral_referral_desc" for="x_referral_desc" class="<?php echo $referral_edit->LeftColumnClass ?>"><?php echo $referral_edit->referral_desc->caption() ?><?php echo $referral_edit->referral_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $referral_edit->RightColumnClass ?>"><div <?php echo $referral_edit->referral_desc->cellAttributes() ?>>
<span id="el_referral_referral_desc">
<input type="text" data-table="referral" data-field="x_referral_desc" name="x_referral_desc" id="x_referral_desc" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($referral_edit->referral_desc->getPlaceHolder()) ?>" value="<?php echo $referral_edit->referral_desc->EditValue ?>"<?php echo $referral_edit->referral_desc->editAttributes() ?>>
</span>
<?php echo $referral_edit->referral_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($referral_edit->referral_deal_signed->Visible) { // referral_deal_signed ?>
	<div id="r_referral_deal_signed" class="form-group row">
		<label id="elh_referral_referral_deal_signed" for="x_referral_deal_signed" class="<?php echo $referral_edit->LeftColumnClass ?>"><?php echo $referral_edit->referral_deal_signed->caption() ?><?php echo $referral_edit->referral_deal_signed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $referral_edit->RightColumnClass ?>"><div <?php echo $referral_edit->referral_deal_signed->cellAttributes() ?>>
<span id="el_referral_referral_deal_signed">
<textarea data-table="referral" data-field="x_referral_deal_signed" name="x_referral_deal_signed" id="x_referral_deal_signed" cols="35" rows="4" placeholder="<?php echo HtmlEncode($referral_edit->referral_deal_signed->getPlaceHolder()) ?>"<?php echo $referral_edit->referral_deal_signed->editAttributes() ?>><?php echo $referral_edit->referral_deal_signed->EditValue ?></textarea>
</span>
<?php echo $referral_edit->referral_deal_signed->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$referral_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $referral_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $referral_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$referral_edit->showPageFooter();
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
$referral_edit->terminate();
?>