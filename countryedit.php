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
$country_edit = new country_edit();

// Run the page
$country_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$country_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcountryedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcountryedit = currentForm = new ew.Form("fcountryedit", "edit");

	// Validate form
	fcountryedit.validate = function() {
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
			<?php if ($country_edit->country_id->Required) { ?>
				elm = this.getElements("x" + infix + "_country_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $country_edit->country_id->caption(), $country_edit->country_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($country_edit->country_name->Required) { ?>
				elm = this.getElements("x" + infix + "_country_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $country_edit->country_name->caption(), $country_edit->country_name->RequiredErrorMessage)) ?>");
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
	fcountryedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcountryedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcountryedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $country_edit->showPageHeader(); ?>
<?php
$country_edit->showMessage();
?>
<form name="fcountryedit" id="fcountryedit" class="<?php echo $country_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="country">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$country_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($country_edit->country_id->Visible) { // country_id ?>
	<div id="r_country_id" class="form-group row">
		<label id="elh_country_country_id" class="<?php echo $country_edit->LeftColumnClass ?>"><?php echo $country_edit->country_id->caption() ?><?php echo $country_edit->country_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $country_edit->RightColumnClass ?>"><div <?php echo $country_edit->country_id->cellAttributes() ?>>
<span id="el_country_country_id">
<span<?php echo $country_edit->country_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($country_edit->country_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="country" data-field="x_country_id" name="x_country_id" id="x_country_id" value="<?php echo HtmlEncode($country_edit->country_id->CurrentValue) ?>">
<?php echo $country_edit->country_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($country_edit->country_name->Visible) { // country_name ?>
	<div id="r_country_name" class="form-group row">
		<label id="elh_country_country_name" for="x_country_name" class="<?php echo $country_edit->LeftColumnClass ?>"><?php echo $country_edit->country_name->caption() ?><?php echo $country_edit->country_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $country_edit->RightColumnClass ?>"><div <?php echo $country_edit->country_name->cellAttributes() ?>>
<span id="el_country_country_name">
<input type="text" data-table="country" data-field="x_country_name" name="x_country_name" id="x_country_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($country_edit->country_name->getPlaceHolder()) ?>" value="<?php echo $country_edit->country_name->EditValue ?>"<?php echo $country_edit->country_name->editAttributes() ?>>
</span>
<?php echo $country_edit->country_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$country_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $country_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $country_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$country_edit->showPageFooter();
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
$country_edit->terminate();
?>