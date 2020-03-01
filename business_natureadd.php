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
$business_nature_add = new business_nature_add();

// Run the page
$business_nature_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_nature_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusiness_natureadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fbusiness_natureadd = currentForm = new ew.Form("fbusiness_natureadd", "add");

	// Validate form
	fbusiness_natureadd.validate = function() {
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
			<?php if ($business_nature_add->b_nature_caption->Required) { ?>
				elm = this.getElements("x" + infix + "_b_nature_caption");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_nature_add->b_nature_caption->caption(), $business_nature_add->b_nature_caption->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_nature_add->b_nature_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_b_nature_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_nature_add->b_nature_desc->caption(), $business_nature_add->b_nature_desc->RequiredErrorMessage)) ?>");
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
	fbusiness_natureadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbusiness_natureadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbusiness_natureadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_nature_add->showPageHeader(); ?>
<?php
$business_nature_add->showMessage();
?>
<form name="fbusiness_natureadd" id="fbusiness_natureadd" class="<?php echo $business_nature_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_nature">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$business_nature_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($business_nature_add->b_nature_caption->Visible) { // b_nature_caption ?>
	<div id="r_b_nature_caption" class="form-group row">
		<label id="elh_business_nature_b_nature_caption" for="x_b_nature_caption" class="<?php echo $business_nature_add->LeftColumnClass ?>"><?php echo $business_nature_add->b_nature_caption->caption() ?><?php echo $business_nature_add->b_nature_caption->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_nature_add->RightColumnClass ?>"><div <?php echo $business_nature_add->b_nature_caption->cellAttributes() ?>>
<span id="el_business_nature_b_nature_caption">
<input type="text" data-table="business_nature" data-field="x_b_nature_caption" name="x_b_nature_caption" id="x_b_nature_caption" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($business_nature_add->b_nature_caption->getPlaceHolder()) ?>" value="<?php echo $business_nature_add->b_nature_caption->EditValue ?>"<?php echo $business_nature_add->b_nature_caption->editAttributes() ?>>
</span>
<?php echo $business_nature_add->b_nature_caption->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_nature_add->b_nature_desc->Visible) { // b_nature_desc ?>
	<div id="r_b_nature_desc" class="form-group row">
		<label id="elh_business_nature_b_nature_desc" for="x_b_nature_desc" class="<?php echo $business_nature_add->LeftColumnClass ?>"><?php echo $business_nature_add->b_nature_desc->caption() ?><?php echo $business_nature_add->b_nature_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_nature_add->RightColumnClass ?>"><div <?php echo $business_nature_add->b_nature_desc->cellAttributes() ?>>
<span id="el_business_nature_b_nature_desc">
<input type="text" data-table="business_nature" data-field="x_b_nature_desc" name="x_b_nature_desc" id="x_b_nature_desc" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($business_nature_add->b_nature_desc->getPlaceHolder()) ?>" value="<?php echo $business_nature_add->b_nature_desc->EditValue ?>"<?php echo $business_nature_add->b_nature_desc->editAttributes() ?>>
</span>
<?php echo $business_nature_add->b_nature_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$business_nature_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $business_nature_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $business_nature_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$business_nature_add->showPageFooter();
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
$business_nature_add->terminate();
?>