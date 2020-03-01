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
$followup_no_addopt = new followup_no_addopt();

// Run the page
$followup_no_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$followup_no_addopt->Page_Render();
?>
<script>
var ffollowup_noaddopt, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "addopt";
	ffollowup_noaddopt = currentForm = new ew.Form("ffollowup_noaddopt", "addopt");

	// Validate form
	ffollowup_noaddopt.validate = function() {
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
			<?php if ($followup_no_addopt->followup_no_caption->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_no_caption");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_no_addopt->followup_no_caption->caption(), $followup_no_addopt->followup_no_caption->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	ffollowup_noaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ffollowup_noaddopt.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ffollowup_noaddopt");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $followup_no_addopt->showPageHeader(); ?>
<?php
$followup_no_addopt->showMessage();
?>
<form name="ffollowup_noaddopt" id="ffollowup_noaddopt" class="ew-form ew-horizontal" action="<?php echo Config("API_URL") ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="<?php echo Config("API_ACTION_NAME") ?>" id="<?php echo Config("API_ACTION_NAME") ?>" value="<?php echo Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?php echo Config("API_OBJECT_NAME") ?>" id="<?php echo Config("API_OBJECT_NAME") ?>" value="<?php echo $followup_no_addopt->TableVar ?>">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($followup_no_addopt->followup_no_caption->Visible) { // followup_no_caption ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_followup_no_caption"><?php echo $followup_no_addopt->followup_no_caption->caption() ?><?php echo $followup_no_addopt->followup_no_caption->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="followup_no" data-field="x_followup_no_caption" name="x_followup_no_caption" id="x_followup_no_caption" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($followup_no_addopt->followup_no_caption->getPlaceHolder()) ?>" value="<?php echo $followup_no_addopt->followup_no_caption->EditValue ?>"<?php echo $followup_no_addopt->followup_no_caption->editAttributes() ?>>
</div>
	</div>
<?php } ?>
</form>
<?php
$followup_no_addopt->showPageFooter();
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
$followup_no_addopt->terminate();
?>