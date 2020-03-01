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
$tehsil_add = new tehsil_add();

// Run the page
$tehsil_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tehsil_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftehsiladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftehsiladd = currentForm = new ew.Form("ftehsiladd", "add");

	// Validate form
	ftehsiladd.validate = function() {
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
			<?php if ($tehsil_add->tehsil_district_id->Required) { ?>
				elm = this.getElements("x" + infix + "_tehsil_district_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tehsil_add->tehsil_district_id->caption(), $tehsil_add->tehsil_district_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tehsil_district_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tehsil_add->tehsil_district_id->errorMessage()) ?>");
			<?php if ($tehsil_add->tehsil_name->Required) { ?>
				elm = this.getElements("x" + infix + "_tehsil_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tehsil_add->tehsil_name->caption(), $tehsil_add->tehsil_name->RequiredErrorMessage)) ?>");
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
	ftehsiladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftehsiladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftehsiladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tehsil_add->showPageHeader(); ?>
<?php
$tehsil_add->showMessage();
?>
<form name="ftehsiladd" id="ftehsiladd" class="<?php echo $tehsil_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tehsil">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tehsil_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tehsil_add->tehsil_district_id->Visible) { // tehsil_district_id ?>
	<div id="r_tehsil_district_id" class="form-group row">
		<label id="elh_tehsil_tehsil_district_id" for="x_tehsil_district_id" class="<?php echo $tehsil_add->LeftColumnClass ?>"><?php echo $tehsil_add->tehsil_district_id->caption() ?><?php echo $tehsil_add->tehsil_district_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tehsil_add->RightColumnClass ?>"><div <?php echo $tehsil_add->tehsil_district_id->cellAttributes() ?>>
<span id="el_tehsil_tehsil_district_id">
<input type="text" data-table="tehsil" data-field="x_tehsil_district_id" name="x_tehsil_district_id" id="x_tehsil_district_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($tehsil_add->tehsil_district_id->getPlaceHolder()) ?>" value="<?php echo $tehsil_add->tehsil_district_id->EditValue ?>"<?php echo $tehsil_add->tehsil_district_id->editAttributes() ?>>
</span>
<?php echo $tehsil_add->tehsil_district_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tehsil_add->tehsil_name->Visible) { // tehsil_name ?>
	<div id="r_tehsil_name" class="form-group row">
		<label id="elh_tehsil_tehsil_name" for="x_tehsil_name" class="<?php echo $tehsil_add->LeftColumnClass ?>"><?php echo $tehsil_add->tehsil_name->caption() ?><?php echo $tehsil_add->tehsil_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tehsil_add->RightColumnClass ?>"><div <?php echo $tehsil_add->tehsil_name->cellAttributes() ?>>
<span id="el_tehsil_tehsil_name">
<input type="text" data-table="tehsil" data-field="x_tehsil_name" name="x_tehsil_name" id="x_tehsil_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tehsil_add->tehsil_name->getPlaceHolder()) ?>" value="<?php echo $tehsil_add->tehsil_name->EditValue ?>"<?php echo $tehsil_add->tehsil_name->editAttributes() ?>>
</span>
<?php echo $tehsil_add->tehsil_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tehsil_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tehsil_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tehsil_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tehsil_add->showPageFooter();
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
$tehsil_add->terminate();
?>