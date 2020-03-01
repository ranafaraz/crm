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
$district_add = new district_add();

// Run the page
$district_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$district_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdistrictadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdistrictadd = currentForm = new ew.Form("fdistrictadd", "add");

	// Validate form
	fdistrictadd.validate = function() {
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
			<?php if ($district_add->district_division_id->Required) { ?>
				elm = this.getElements("x" + infix + "_district_division_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $district_add->district_division_id->caption(), $district_add->district_division_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_district_division_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($district_add->district_division_id->errorMessage()) ?>");
			<?php if ($district_add->district_name->Required) { ?>
				elm = this.getElements("x" + infix + "_district_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $district_add->district_name->caption(), $district_add->district_name->RequiredErrorMessage)) ?>");
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
	fdistrictadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdistrictadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdistrictadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $district_add->showPageHeader(); ?>
<?php
$district_add->showMessage();
?>
<form name="fdistrictadd" id="fdistrictadd" class="<?php echo $district_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="district">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$district_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($district_add->district_division_id->Visible) { // district_division_id ?>
	<div id="r_district_division_id" class="form-group row">
		<label id="elh_district_district_division_id" for="x_district_division_id" class="<?php echo $district_add->LeftColumnClass ?>"><?php echo $district_add->district_division_id->caption() ?><?php echo $district_add->district_division_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $district_add->RightColumnClass ?>"><div <?php echo $district_add->district_division_id->cellAttributes() ?>>
<span id="el_district_district_division_id">
<input type="text" data-table="district" data-field="x_district_division_id" name="x_district_division_id" id="x_district_division_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($district_add->district_division_id->getPlaceHolder()) ?>" value="<?php echo $district_add->district_division_id->EditValue ?>"<?php echo $district_add->district_division_id->editAttributes() ?>>
</span>
<?php echo $district_add->district_division_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($district_add->district_name->Visible) { // district_name ?>
	<div id="r_district_name" class="form-group row">
		<label id="elh_district_district_name" for="x_district_name" class="<?php echo $district_add->LeftColumnClass ?>"><?php echo $district_add->district_name->caption() ?><?php echo $district_add->district_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $district_add->RightColumnClass ?>"><div <?php echo $district_add->district_name->cellAttributes() ?>>
<span id="el_district_district_name">
<input type="text" data-table="district" data-field="x_district_name" name="x_district_name" id="x_district_name" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($district_add->district_name->getPlaceHolder()) ?>" value="<?php echo $district_add->district_name->EditValue ?>"<?php echo $district_add->district_name->editAttributes() ?>>
</span>
<?php echo $district_add->district_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$district_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $district_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $district_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$district_add->showPageFooter();
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
$district_add->terminate();
?>