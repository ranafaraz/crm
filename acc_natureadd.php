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
$acc_nature_add = new acc_nature_add();

// Run the page
$acc_nature_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acc_nature_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var facc_natureadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	facc_natureadd = currentForm = new ew.Form("facc_natureadd", "add");

	// Validate form
	facc_natureadd.validate = function() {
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
			<?php if ($acc_nature_add->acc_nature_name->Required) { ?>
				elm = this.getElements("x" + infix + "_acc_nature_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acc_nature_add->acc_nature_name->caption(), $acc_nature_add->acc_nature_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($acc_nature_add->acc_nature_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_acc_nature_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acc_nature_add->acc_nature_desc->caption(), $acc_nature_add->acc_nature_desc->RequiredErrorMessage)) ?>");
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
	facc_natureadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	facc_natureadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("facc_natureadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $acc_nature_add->showPageHeader(); ?>
<?php
$acc_nature_add->showMessage();
?>
<form name="facc_natureadd" id="facc_natureadd" class="<?php echo $acc_nature_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acc_nature">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$acc_nature_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($acc_nature_add->acc_nature_name->Visible) { // acc_nature_name ?>
	<div id="r_acc_nature_name" class="form-group row">
		<label id="elh_acc_nature_acc_nature_name" for="x_acc_nature_name" class="<?php echo $acc_nature_add->LeftColumnClass ?>"><?php echo $acc_nature_add->acc_nature_name->caption() ?><?php echo $acc_nature_add->acc_nature_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acc_nature_add->RightColumnClass ?>"><div <?php echo $acc_nature_add->acc_nature_name->cellAttributes() ?>>
<span id="el_acc_nature_acc_nature_name">
<input type="text" data-table="acc_nature" data-field="x_acc_nature_name" name="x_acc_nature_name" id="x_acc_nature_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($acc_nature_add->acc_nature_name->getPlaceHolder()) ?>" value="<?php echo $acc_nature_add->acc_nature_name->EditValue ?>"<?php echo $acc_nature_add->acc_nature_name->editAttributes() ?>>
</span>
<?php echo $acc_nature_add->acc_nature_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($acc_nature_add->acc_nature_desc->Visible) { // acc_nature_desc ?>
	<div id="r_acc_nature_desc" class="form-group row">
		<label id="elh_acc_nature_acc_nature_desc" class="<?php echo $acc_nature_add->LeftColumnClass ?>"><?php echo $acc_nature_add->acc_nature_desc->caption() ?><?php echo $acc_nature_add->acc_nature_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acc_nature_add->RightColumnClass ?>"><div <?php echo $acc_nature_add->acc_nature_desc->cellAttributes() ?>>
<span id="el_acc_nature_acc_nature_desc">
<?php $acc_nature_add->acc_nature_desc->EditAttrs->appendClass("editor"); ?>
<textarea data-table="acc_nature" data-field="x_acc_nature_desc" name="x_acc_nature_desc" id="x_acc_nature_desc" cols="35" rows="4" placeholder="<?php echo HtmlEncode($acc_nature_add->acc_nature_desc->getPlaceHolder()) ?>"<?php echo $acc_nature_add->acc_nature_desc->editAttributes() ?>><?php echo $acc_nature_add->acc_nature_desc->EditValue ?></textarea>
<script>
loadjs.ready(["facc_natureadd", "editor"], function() {
	ew.createEditor("facc_natureadd", "x_acc_nature_desc", 35, 4, <?php echo $acc_nature_add->acc_nature_desc->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $acc_nature_add->acc_nature_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$acc_nature_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $acc_nature_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $acc_nature_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$acc_nature_add->showPageFooter();
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
$acc_nature_add->terminate();
?>