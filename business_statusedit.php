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
$business_status_edit = new business_status_edit();

// Run the page
$business_status_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_status_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusiness_statusedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fbusiness_statusedit = currentForm = new ew.Form("fbusiness_statusedit", "edit");

	// Validate form
	fbusiness_statusedit.validate = function() {
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
			<?php if ($business_status_edit->business_status_id->Required) { ?>
				elm = this.getElements("x" + infix + "_business_status_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_status_edit->business_status_id->caption(), $business_status_edit->business_status_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_status_edit->business_status_caption->Required) { ?>
				elm = this.getElements("x" + infix + "_business_status_caption");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_status_edit->business_status_caption->caption(), $business_status_edit->business_status_caption->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_status_edit->b_status_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_b_status_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_status_edit->b_status_desc->caption(), $business_status_edit->b_status_desc->RequiredErrorMessage)) ?>");
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
	fbusiness_statusedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbusiness_statusedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbusiness_statusedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_status_edit->showPageHeader(); ?>
<?php
$business_status_edit->showMessage();
?>
<form name="fbusiness_statusedit" id="fbusiness_statusedit" class="<?php echo $business_status_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_status">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$business_status_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($business_status_edit->business_status_id->Visible) { // business_status_id ?>
	<div id="r_business_status_id" class="form-group row">
		<label id="elh_business_status_business_status_id" class="<?php echo $business_status_edit->LeftColumnClass ?>"><?php echo $business_status_edit->business_status_id->caption() ?><?php echo $business_status_edit->business_status_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_status_edit->RightColumnClass ?>"><div <?php echo $business_status_edit->business_status_id->cellAttributes() ?>>
<span id="el_business_status_business_status_id">
<span<?php echo $business_status_edit->business_status_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($business_status_edit->business_status_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="business_status" data-field="x_business_status_id" name="x_business_status_id" id="x_business_status_id" value="<?php echo HtmlEncode($business_status_edit->business_status_id->CurrentValue) ?>">
<?php echo $business_status_edit->business_status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_status_edit->business_status_caption->Visible) { // business_status_caption ?>
	<div id="r_business_status_caption" class="form-group row">
		<label id="elh_business_status_business_status_caption" for="x_business_status_caption" class="<?php echo $business_status_edit->LeftColumnClass ?>"><?php echo $business_status_edit->business_status_caption->caption() ?><?php echo $business_status_edit->business_status_caption->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_status_edit->RightColumnClass ?>"><div <?php echo $business_status_edit->business_status_caption->cellAttributes() ?>>
<span id="el_business_status_business_status_caption">
<input type="text" data-table="business_status" data-field="x_business_status_caption" name="x_business_status_caption" id="x_business_status_caption" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($business_status_edit->business_status_caption->getPlaceHolder()) ?>" value="<?php echo $business_status_edit->business_status_caption->EditValue ?>"<?php echo $business_status_edit->business_status_caption->editAttributes() ?>>
</span>
<?php echo $business_status_edit->business_status_caption->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_status_edit->b_status_desc->Visible) { // b_status_desc ?>
	<div id="r_b_status_desc" class="form-group row">
		<label id="elh_business_status_b_status_desc" for="x_b_status_desc" class="<?php echo $business_status_edit->LeftColumnClass ?>"><?php echo $business_status_edit->b_status_desc->caption() ?><?php echo $business_status_edit->b_status_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_status_edit->RightColumnClass ?>"><div <?php echo $business_status_edit->b_status_desc->cellAttributes() ?>>
<span id="el_business_status_b_status_desc">
<textarea data-table="business_status" data-field="x_b_status_desc" name="x_b_status_desc" id="x_b_status_desc" cols="35" rows="4" placeholder="<?php echo HtmlEncode($business_status_edit->b_status_desc->getPlaceHolder()) ?>"<?php echo $business_status_edit->b_status_desc->editAttributes() ?>><?php echo $business_status_edit->b_status_desc->EditValue ?></textarea>
</span>
<?php echo $business_status_edit->b_status_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$business_status_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $business_status_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $business_status_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$business_status_edit->showPageFooter();
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
$business_status_edit->terminate();
?>