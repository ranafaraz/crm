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
$state_add = new state_add();

// Run the page
$state_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$state_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstateadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fstateadd = currentForm = new ew.Form("fstateadd", "add");

	// Validate form
	fstateadd.validate = function() {
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
			<?php if ($state_add->state_country_id->Required) { ?>
				elm = this.getElements("x" + infix + "_state_country_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $state_add->state_country_id->caption(), $state_add->state_country_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_state_country_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($state_add->state_country_id->errorMessage()) ?>");
			<?php if ($state_add->state_name->Required) { ?>
				elm = this.getElements("x" + infix + "_state_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $state_add->state_name->caption(), $state_add->state_name->RequiredErrorMessage)) ?>");
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
	fstateadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstateadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fstateadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $state_add->showPageHeader(); ?>
<?php
$state_add->showMessage();
?>
<form name="fstateadd" id="fstateadd" class="<?php echo $state_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="state">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$state_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($state_add->state_country_id->Visible) { // state_country_id ?>
	<div id="r_state_country_id" class="form-group row">
		<label id="elh_state_state_country_id" for="x_state_country_id" class="<?php echo $state_add->LeftColumnClass ?>"><?php echo $state_add->state_country_id->caption() ?><?php echo $state_add->state_country_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $state_add->RightColumnClass ?>"><div <?php echo $state_add->state_country_id->cellAttributes() ?>>
<span id="el_state_state_country_id">
<input type="text" data-table="state" data-field="x_state_country_id" name="x_state_country_id" id="x_state_country_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($state_add->state_country_id->getPlaceHolder()) ?>" value="<?php echo $state_add->state_country_id->EditValue ?>"<?php echo $state_add->state_country_id->editAttributes() ?>>
</span>
<?php echo $state_add->state_country_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($state_add->state_name->Visible) { // state_name ?>
	<div id="r_state_name" class="form-group row">
		<label id="elh_state_state_name" for="x_state_name" class="<?php echo $state_add->LeftColumnClass ?>"><?php echo $state_add->state_name->caption() ?><?php echo $state_add->state_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $state_add->RightColumnClass ?>"><div <?php echo $state_add->state_name->cellAttributes() ?>>
<span id="el_state_state_name">
<input type="text" data-table="state" data-field="x_state_name" name="x_state_name" id="x_state_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($state_add->state_name->getPlaceHolder()) ?>" value="<?php echo $state_add->state_name->EditValue ?>"<?php echo $state_add->state_name->editAttributes() ?>>
</span>
<?php echo $state_add->state_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$state_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $state_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $state_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$state_add->showPageFooter();
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
$state_add->terminate();
?>