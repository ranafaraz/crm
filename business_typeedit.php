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
$business_type_edit = new business_type_edit();

// Run the page
$business_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusiness_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fbusiness_typeedit = currentForm = new ew.Form("fbusiness_typeedit", "edit");

	// Validate form
	fbusiness_typeedit.validate = function() {
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
			<?php if ($business_type_edit->business_type_id->Required) { ?>
				elm = this.getElements("x" + infix + "_business_type_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_type_edit->business_type_id->caption(), $business_type_edit->business_type_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_type_edit->business_type_name->Required) { ?>
				elm = this.getElements("x" + infix + "_business_type_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_type_edit->business_type_name->caption(), $business_type_edit->business_type_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_type_edit->business_type_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_business_type_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_type_edit->business_type_desc->caption(), $business_type_edit->business_type_desc->RequiredErrorMessage)) ?>");
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
	fbusiness_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbusiness_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbusiness_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_type_edit->showPageHeader(); ?>
<?php
$business_type_edit->showMessage();
?>
<form name="fbusiness_typeedit" id="fbusiness_typeedit" class="<?php echo $business_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$business_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($business_type_edit->business_type_id->Visible) { // business_type_id ?>
	<div id="r_business_type_id" class="form-group row">
		<label id="elh_business_type_business_type_id" class="<?php echo $business_type_edit->LeftColumnClass ?>"><?php echo $business_type_edit->business_type_id->caption() ?><?php echo $business_type_edit->business_type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_type_edit->RightColumnClass ?>"><div <?php echo $business_type_edit->business_type_id->cellAttributes() ?>>
<span id="el_business_type_business_type_id">
<span<?php echo $business_type_edit->business_type_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($business_type_edit->business_type_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="business_type" data-field="x_business_type_id" name="x_business_type_id" id="x_business_type_id" value="<?php echo HtmlEncode($business_type_edit->business_type_id->CurrentValue) ?>">
<?php echo $business_type_edit->business_type_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_type_edit->business_type_name->Visible) { // business_type_name ?>
	<div id="r_business_type_name" class="form-group row">
		<label id="elh_business_type_business_type_name" for="x_business_type_name" class="<?php echo $business_type_edit->LeftColumnClass ?>"><?php echo $business_type_edit->business_type_name->caption() ?><?php echo $business_type_edit->business_type_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_type_edit->RightColumnClass ?>"><div <?php echo $business_type_edit->business_type_name->cellAttributes() ?>>
<span id="el_business_type_business_type_name">
<input type="text" data-table="business_type" data-field="x_business_type_name" name="x_business_type_name" id="x_business_type_name" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($business_type_edit->business_type_name->getPlaceHolder()) ?>" value="<?php echo $business_type_edit->business_type_name->EditValue ?>"<?php echo $business_type_edit->business_type_name->editAttributes() ?>>
</span>
<?php echo $business_type_edit->business_type_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_type_edit->business_type_desc->Visible) { // business_type_desc ?>
	<div id="r_business_type_desc" class="form-group row">
		<label id="elh_business_type_business_type_desc" for="x_business_type_desc" class="<?php echo $business_type_edit->LeftColumnClass ?>"><?php echo $business_type_edit->business_type_desc->caption() ?><?php echo $business_type_edit->business_type_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_type_edit->RightColumnClass ?>"><div <?php echo $business_type_edit->business_type_desc->cellAttributes() ?>>
<span id="el_business_type_business_type_desc">
<input type="text" data-table="business_type" data-field="x_business_type_desc" name="x_business_type_desc" id="x_business_type_desc" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($business_type_edit->business_type_desc->getPlaceHolder()) ?>" value="<?php echo $business_type_edit->business_type_desc->EditValue ?>"<?php echo $business_type_edit->business_type_desc->editAttributes() ?>>
</span>
<?php echo $business_type_edit->business_type_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$business_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $business_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $business_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$business_type_edit->showPageFooter();
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
$business_type_edit->terminate();
?>