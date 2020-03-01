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
$district_edit = new district_edit();

// Run the page
$district_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$district_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdistrictedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdistrictedit = currentForm = new ew.Form("fdistrictedit", "edit");

	// Validate form
	fdistrictedit.validate = function() {
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
			<?php if ($district_edit->district_id->Required) { ?>
				elm = this.getElements("x" + infix + "_district_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $district_edit->district_id->caption(), $district_edit->district_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($district_edit->district_division_id->Required) { ?>
				elm = this.getElements("x" + infix + "_district_division_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $district_edit->district_division_id->caption(), $district_edit->district_division_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($district_edit->district_name->Required) { ?>
				elm = this.getElements("x" + infix + "_district_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $district_edit->district_name->caption(), $district_edit->district_name->RequiredErrorMessage)) ?>");
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
	fdistrictedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdistrictedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdistrictedit.lists["x_district_division_id"] = <?php echo $district_edit->district_division_id->Lookup->toClientList($district_edit) ?>;
	fdistrictedit.lists["x_district_division_id"].options = <?php echo JsonEncode($district_edit->district_division_id->lookupOptions()) ?>;
	loadjs.done("fdistrictedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $district_edit->showPageHeader(); ?>
<?php
$district_edit->showMessage();
?>
<form name="fdistrictedit" id="fdistrictedit" class="<?php echo $district_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="district">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$district_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($district_edit->district_id->Visible) { // district_id ?>
	<div id="r_district_id" class="form-group row">
		<label id="elh_district_district_id" class="<?php echo $district_edit->LeftColumnClass ?>"><?php echo $district_edit->district_id->caption() ?><?php echo $district_edit->district_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $district_edit->RightColumnClass ?>"><div <?php echo $district_edit->district_id->cellAttributes() ?>>
<span id="el_district_district_id">
<span<?php echo $district_edit->district_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($district_edit->district_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="district" data-field="x_district_id" name="x_district_id" id="x_district_id" value="<?php echo HtmlEncode($district_edit->district_id->CurrentValue) ?>">
<?php echo $district_edit->district_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($district_edit->district_division_id->Visible) { // district_division_id ?>
	<div id="r_district_division_id" class="form-group row">
		<label id="elh_district_district_division_id" for="x_district_division_id" class="<?php echo $district_edit->LeftColumnClass ?>"><?php echo $district_edit->district_division_id->caption() ?><?php echo $district_edit->district_division_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $district_edit->RightColumnClass ?>"><div <?php echo $district_edit->district_division_id->cellAttributes() ?>>
<span id="el_district_district_division_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_district_division_id"><?php echo EmptyValue(strval($district_edit->district_division_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $district_edit->district_division_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($district_edit->district_division_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($district_edit->district_division_id->ReadOnly || $district_edit->district_division_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_district_division_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
		<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_district_division_id" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $district_edit->district_division_id->caption() ?>" data-title="<?php echo $district_edit->district_division_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_district_division_id',url:'divisionaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button>
	</div>
</div>
<?php echo $district_edit->district_division_id->Lookup->getParamTag($district_edit, "p_x_district_division_id") ?>
<input type="hidden" data-table="district" data-field="x_district_division_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $district_edit->district_division_id->displayValueSeparatorAttribute() ?>" name="x_district_division_id" id="x_district_division_id" value="<?php echo $district_edit->district_division_id->CurrentValue ?>"<?php echo $district_edit->district_division_id->editAttributes() ?>>
</span>
<?php echo $district_edit->district_division_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($district_edit->district_name->Visible) { // district_name ?>
	<div id="r_district_name" class="form-group row">
		<label id="elh_district_district_name" for="x_district_name" class="<?php echo $district_edit->LeftColumnClass ?>"><?php echo $district_edit->district_name->caption() ?><?php echo $district_edit->district_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $district_edit->RightColumnClass ?>"><div <?php echo $district_edit->district_name->cellAttributes() ?>>
<span id="el_district_district_name">
<input type="text" data-table="district" data-field="x_district_name" name="x_district_name" id="x_district_name" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($district_edit->district_name->getPlaceHolder()) ?>" value="<?php echo $district_edit->district_name->EditValue ?>"<?php echo $district_edit->district_name->editAttributes() ?>>
</span>
<?php echo $district_edit->district_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$district_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $district_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $district_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$district_edit->showPageFooter();
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
$district_edit->terminate();
?>