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
$business_status_addopt = new business_status_addopt();

// Run the page
$business_status_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_status_addopt->Page_Render();
?>
<script>
var fbusiness_statusaddopt, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "addopt";
	fbusiness_statusaddopt = currentForm = new ew.Form("fbusiness_statusaddopt", "addopt");

	// Validate form
	fbusiness_statusaddopt.validate = function() {
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
			<?php if ($business_status_addopt->business_status_caption->Required) { ?>
				elm = this.getElements("x" + infix + "_business_status_caption");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_status_addopt->business_status_caption->caption(), $business_status_addopt->business_status_caption->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_status_addopt->b_status_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_b_status_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_status_addopt->b_status_desc->caption(), $business_status_addopt->b_status_desc->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fbusiness_statusaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbusiness_statusaddopt.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbusiness_statusaddopt");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_status_addopt->showPageHeader(); ?>
<?php
$business_status_addopt->showMessage();
?>
<form name="fbusiness_statusaddopt" id="fbusiness_statusaddopt" class="ew-form ew-horizontal" action="<?php echo Config("API_URL") ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="<?php echo Config("API_ACTION_NAME") ?>" id="<?php echo Config("API_ACTION_NAME") ?>" value="<?php echo Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?php echo Config("API_OBJECT_NAME") ?>" id="<?php echo Config("API_OBJECT_NAME") ?>" value="<?php echo $business_status_addopt->TableVar ?>">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($business_status_addopt->business_status_caption->Visible) { // business_status_caption ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_business_status_caption"><?php echo $business_status_addopt->business_status_caption->caption() ?><?php echo $business_status_addopt->business_status_caption->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="business_status" data-field="x_business_status_caption" name="x_business_status_caption" id="x_business_status_caption" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($business_status_addopt->business_status_caption->getPlaceHolder()) ?>" value="<?php echo $business_status_addopt->business_status_caption->EditValue ?>"<?php echo $business_status_addopt->business_status_caption->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($business_status_addopt->b_status_desc->Visible) { // b_status_desc ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_status_desc"><?php echo $business_status_addopt->b_status_desc->caption() ?><?php echo $business_status_addopt->b_status_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<textarea data-table="business_status" data-field="x_b_status_desc" name="x_b_status_desc" id="x_b_status_desc" cols="35" rows="4" placeholder="<?php echo HtmlEncode($business_status_addopt->b_status_desc->getPlaceHolder()) ?>"<?php echo $business_status_addopt->b_status_desc->editAttributes() ?>><?php echo $business_status_addopt->b_status_desc->EditValue ?></textarea>
</div>
	</div>
<?php } ?>
</form>
<?php
$business_status_addopt->showPageFooter();
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
<?php
$business_status_addopt->terminate();
?>