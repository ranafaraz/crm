<?php
namespace PHPMaker2020\dexdevs_crm;

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
$designation_add = new designation_add();

// Run the page
$designation_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$designation_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdesignationadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdesignationadd = currentForm = new ew.Form("fdesignationadd", "add");

	// Validate form
	fdesignationadd.validate = function() {
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
			<?php if ($designation_add->designation_caption->Required) { ?>
				elm = this.getElements("x" + infix + "_designation_caption");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $designation_add->designation_caption->caption(), $designation_add->designation_caption->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($designation_add->designation_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_designation_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $designation_add->designation_desc->caption(), $designation_add->designation_desc->RequiredErrorMessage)) ?>");
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
	fdesignationadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdesignationadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdesignationadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $designation_add->showPageHeader(); ?>
<?php
$designation_add->showMessage();
?>
<form name="fdesignationadd" id="fdesignationadd" class="<?php echo $designation_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="designation">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$designation_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($designation_add->designation_caption->Visible) { // designation_caption ?>
	<div id="r_designation_caption" class="form-group row">
		<label id="elh_designation_designation_caption" for="x_designation_caption" class="<?php echo $designation_add->LeftColumnClass ?>"><?php echo $designation_add->designation_caption->caption() ?><?php echo $designation_add->designation_caption->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $designation_add->RightColumnClass ?>"><div <?php echo $designation_add->designation_caption->cellAttributes() ?>>
<span id="el_designation_designation_caption">
<input type="text" data-table="designation" data-field="x_designation_caption" name="x_designation_caption" id="x_designation_caption" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($designation_add->designation_caption->getPlaceHolder()) ?>" value="<?php echo $designation_add->designation_caption->EditValue ?>"<?php echo $designation_add->designation_caption->editAttributes() ?>>
</span>
<?php echo $designation_add->designation_caption->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($designation_add->designation_desc->Visible) { // designation_desc ?>
	<div id="r_designation_desc" class="form-group row">
		<label id="elh_designation_designation_desc" for="x_designation_desc" class="<?php echo $designation_add->LeftColumnClass ?>"><?php echo $designation_add->designation_desc->caption() ?><?php echo $designation_add->designation_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $designation_add->RightColumnClass ?>"><div <?php echo $designation_add->designation_desc->cellAttributes() ?>>
<span id="el_designation_designation_desc">
<textarea data-table="designation" data-field="x_designation_desc" name="x_designation_desc" id="x_designation_desc" cols="35" rows="4" placeholder="<?php echo HtmlEncode($designation_add->designation_desc->getPlaceHolder()) ?>"<?php echo $designation_add->designation_desc->editAttributes() ?>><?php echo $designation_add->designation_desc->EditValue ?></textarea>
</span>
<?php echo $designation_add->designation_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$designation_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $designation_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $designation_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$designation_add->showPageFooter();
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
$designation_add->terminate();
?>