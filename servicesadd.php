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
$services_add = new services_add();

// Run the page
$services_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$services_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fservicesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fservicesadd = currentForm = new ew.Form("fservicesadd", "add");

	// Validate form
	fservicesadd.validate = function() {
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
			<?php if ($services_add->service_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_service_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_add->service_branch_id->caption(), $services_add->service_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_service_branch_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($services_add->service_branch_id->errorMessage()) ?>");
			<?php if ($services_add->service_caption->Required) { ?>
				elm = this.getElements("x" + infix + "_service_caption");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_add->service_caption->caption(), $services_add->service_caption->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($services_add->service_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_service_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_add->service_desc->caption(), $services_add->service_desc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($services_add->service_logo->Required) { ?>
				elm = this.getElements("x" + infix + "_service_logo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_add->service_logo->caption(), $services_add->service_logo->RequiredErrorMessage)) ?>");
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
	fservicesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fservicesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fservicesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $services_add->showPageHeader(); ?>
<?php
$services_add->showMessage();
?>
<form name="fservicesadd" id="fservicesadd" class="<?php echo $services_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="services">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$services_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($services_add->service_branch_id->Visible) { // service_branch_id ?>
	<div id="r_service_branch_id" class="form-group row">
		<label id="elh_services_service_branch_id" for="x_service_branch_id" class="<?php echo $services_add->LeftColumnClass ?>"><?php echo $services_add->service_branch_id->caption() ?><?php echo $services_add->service_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $services_add->RightColumnClass ?>"><div <?php echo $services_add->service_branch_id->cellAttributes() ?>>
<span id="el_services_service_branch_id">
<input type="text" data-table="services" data-field="x_service_branch_id" name="x_service_branch_id" id="x_service_branch_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($services_add->service_branch_id->getPlaceHolder()) ?>" value="<?php echo $services_add->service_branch_id->EditValue ?>"<?php echo $services_add->service_branch_id->editAttributes() ?>>
</span>
<?php echo $services_add->service_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($services_add->service_caption->Visible) { // service_caption ?>
	<div id="r_service_caption" class="form-group row">
		<label id="elh_services_service_caption" for="x_service_caption" class="<?php echo $services_add->LeftColumnClass ?>"><?php echo $services_add->service_caption->caption() ?><?php echo $services_add->service_caption->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $services_add->RightColumnClass ?>"><div <?php echo $services_add->service_caption->cellAttributes() ?>>
<span id="el_services_service_caption">
<input type="text" data-table="services" data-field="x_service_caption" name="x_service_caption" id="x_service_caption" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($services_add->service_caption->getPlaceHolder()) ?>" value="<?php echo $services_add->service_caption->EditValue ?>"<?php echo $services_add->service_caption->editAttributes() ?>>
</span>
<?php echo $services_add->service_caption->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($services_add->service_desc->Visible) { // service_desc ?>
	<div id="r_service_desc" class="form-group row">
		<label id="elh_services_service_desc" for="x_service_desc" class="<?php echo $services_add->LeftColumnClass ?>"><?php echo $services_add->service_desc->caption() ?><?php echo $services_add->service_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $services_add->RightColumnClass ?>"><div <?php echo $services_add->service_desc->cellAttributes() ?>>
<span id="el_services_service_desc">
<textarea data-table="services" data-field="x_service_desc" name="x_service_desc" id="x_service_desc" cols="35" rows="4" placeholder="<?php echo HtmlEncode($services_add->service_desc->getPlaceHolder()) ?>"<?php echo $services_add->service_desc->editAttributes() ?>><?php echo $services_add->service_desc->EditValue ?></textarea>
</span>
<?php echo $services_add->service_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($services_add->service_logo->Visible) { // service_logo ?>
	<div id="r_service_logo" class="form-group row">
		<label id="elh_services_service_logo" for="x_service_logo" class="<?php echo $services_add->LeftColumnClass ?>"><?php echo $services_add->service_logo->caption() ?><?php echo $services_add->service_logo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $services_add->RightColumnClass ?>"><div <?php echo $services_add->service_logo->cellAttributes() ?>>
<span id="el_services_service_logo">
<input type="text" data-table="services" data-field="x_service_logo" name="x_service_logo" id="x_service_logo" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($services_add->service_logo->getPlaceHolder()) ?>" value="<?php echo $services_add->service_logo->EditValue ?>"<?php echo $services_add->service_logo->editAttributes() ?>>
</span>
<?php echo $services_add->service_logo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$services_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $services_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $services_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$services_add->showPageFooter();
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
$services_add->terminate();
?>