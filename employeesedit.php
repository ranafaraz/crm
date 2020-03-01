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
$employees_edit = new employees_edit();

// Run the page
$employees_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployeesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	femployeesedit = currentForm = new ew.Form("femployeesedit", "edit");

	// Validate form
	femployeesedit.validate = function() {
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
			<?php if ($employees_edit->emp_id->Required) { ?>
				elm = this.getElements("x" + infix + "_emp_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->emp_id->caption(), $employees_edit->emp_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->emp_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_emp_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->emp_branch_id->caption(), $employees_edit->emp_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->emp_designation_id->Required) { ?>
				elm = this.getElements("x" + infix + "_emp_designation_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->emp_designation_id->caption(), $employees_edit->emp_designation_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->emp_name->Required) { ?>
				elm = this.getElements("x" + infix + "_emp_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->emp_name->caption(), $employees_edit->emp_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->emp_father->Required) { ?>
				elm = this.getElements("x" + infix + "_emp_father");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->emp_father->caption(), $employees_edit->emp_father->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->emp_cnic->Required) { ?>
				elm = this.getElements("x" + infix + "_emp_cnic");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->emp_cnic->caption(), $employees_edit->emp_cnic->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->emp_address->Required) { ?>
				elm = this.getElements("x" + infix + "_emp_address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->emp_address->caption(), $employees_edit->emp_address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->emp_city_id->Required) { ?>
				elm = this.getElements("x" + infix + "_emp_city_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->emp_city_id->caption(), $employees_edit->emp_city_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->emp_contact->Required) { ?>
				elm = this.getElements("x" + infix + "_emp_contact");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->emp_contact->caption(), $employees_edit->emp_contact->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->emp_email->Required) { ?>
				elm = this.getElements("x" + infix + "_emp_email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->emp_email->caption(), $employees_edit->emp_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->emp_photo->Required) { ?>
				felm = this.getElements("x" + infix + "_emp_photo");
				elm = this.getElements("fn_x" + infix + "_emp_photo");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $employees_edit->emp_photo->caption(), $employees_edit->emp_photo->RequiredErrorMessage)) ?>");
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
	femployeesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployeesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployeesedit.lists["x_emp_branch_id"] = <?php echo $employees_edit->emp_branch_id->Lookup->toClientList($employees_edit) ?>;
	femployeesedit.lists["x_emp_branch_id"].options = <?php echo JsonEncode($employees_edit->emp_branch_id->lookupOptions()) ?>;
	femployeesedit.lists["x_emp_designation_id"] = <?php echo $employees_edit->emp_designation_id->Lookup->toClientList($employees_edit) ?>;
	femployeesedit.lists["x_emp_designation_id"].options = <?php echo JsonEncode($employees_edit->emp_designation_id->lookupOptions()) ?>;
	femployeesedit.lists["x_emp_city_id"] = <?php echo $employees_edit->emp_city_id->Lookup->toClientList($employees_edit) ?>;
	femployeesedit.lists["x_emp_city_id"].options = <?php echo JsonEncode($employees_edit->emp_city_id->lookupOptions()) ?>;
	loadjs.done("femployeesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employees_edit->showPageHeader(); ?>
<?php
$employees_edit->showMessage();
?>
<form name="femployeesedit" id="femployeesedit" class="<?php echo $employees_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$employees_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($employees_edit->emp_id->Visible) { // emp_id ?>
	<div id="r_emp_id" class="form-group row">
		<label id="elh_employees_emp_id" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->emp_id->caption() ?><?php echo $employees_edit->emp_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->emp_id->cellAttributes() ?>>
<span id="el_employees_emp_id">
<span<?php echo $employees_edit->emp_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employees_edit->emp_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="employees" data-field="x_emp_id" name="x_emp_id" id="x_emp_id" value="<?php echo HtmlEncode($employees_edit->emp_id->CurrentValue) ?>">
<?php echo $employees_edit->emp_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->emp_branch_id->Visible) { // emp_branch_id ?>
	<div id="r_emp_branch_id" class="form-group row">
		<label id="elh_employees_emp_branch_id" for="x_emp_branch_id" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->emp_branch_id->caption() ?><?php echo $employees_edit->emp_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->emp_branch_id->cellAttributes() ?>>
<span id="el_employees_emp_branch_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($employees_edit->emp_branch_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $employees_edit->emp_branch_id->ViewValue ?></button>
		<div id="dsl_x_emp_branch_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $employees_edit->emp_branch_id->radioButtonListHtml(TRUE, "x_emp_branch_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_emp_branch_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="employees" data-field="x_emp_branch_id" data-value-separator="<?php echo $employees_edit->emp_branch_id->displayValueSeparatorAttribute() ?>" name="x_emp_branch_id" id="x_emp_branch_id" value="{value}"<?php echo $employees_edit->emp_branch_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$employees_edit->emp_branch_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $employees_edit->emp_branch_id->Lookup->getParamTag($employees_edit, "p_x_emp_branch_id") ?>
</span>
<?php echo $employees_edit->emp_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->emp_designation_id->Visible) { // emp_designation_id ?>
	<div id="r_emp_designation_id" class="form-group row">
		<label id="elh_employees_emp_designation_id" for="x_emp_designation_id" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->emp_designation_id->caption() ?><?php echo $employees_edit->emp_designation_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->emp_designation_id->cellAttributes() ?>>
<span id="el_employees_emp_designation_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($employees_edit->emp_designation_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $employees_edit->emp_designation_id->ViewValue ?></button>
		<div id="dsl_x_emp_designation_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $employees_edit->emp_designation_id->radioButtonListHtml(TRUE, "x_emp_designation_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_emp_designation_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="employees" data-field="x_emp_designation_id" data-value-separator="<?php echo $employees_edit->emp_designation_id->displayValueSeparatorAttribute() ?>" name="x_emp_designation_id" id="x_emp_designation_id" value="{value}"<?php echo $employees_edit->emp_designation_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$employees_edit->emp_designation_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $employees_edit->emp_designation_id->Lookup->getParamTag($employees_edit, "p_x_emp_designation_id") ?>
</span>
<?php echo $employees_edit->emp_designation_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->emp_name->Visible) { // emp_name ?>
	<div id="r_emp_name" class="form-group row">
		<label id="elh_employees_emp_name" for="x_emp_name" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->emp_name->caption() ?><?php echo $employees_edit->emp_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->emp_name->cellAttributes() ?>>
<span id="el_employees_emp_name">
<input type="text" data-table="employees" data-field="x_emp_name" name="x_emp_name" id="x_emp_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employees_edit->emp_name->getPlaceHolder()) ?>" value="<?php echo $employees_edit->emp_name->EditValue ?>"<?php echo $employees_edit->emp_name->editAttributes() ?>>
</span>
<?php echo $employees_edit->emp_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->emp_father->Visible) { // emp_father ?>
	<div id="r_emp_father" class="form-group row">
		<label id="elh_employees_emp_father" for="x_emp_father" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->emp_father->caption() ?><?php echo $employees_edit->emp_father->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->emp_father->cellAttributes() ?>>
<span id="el_employees_emp_father">
<input type="text" data-table="employees" data-field="x_emp_father" name="x_emp_father" id="x_emp_father" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employees_edit->emp_father->getPlaceHolder()) ?>" value="<?php echo $employees_edit->emp_father->EditValue ?>"<?php echo $employees_edit->emp_father->editAttributes() ?>>
</span>
<?php echo $employees_edit->emp_father->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->emp_cnic->Visible) { // emp_cnic ?>
	<div id="r_emp_cnic" class="form-group row">
		<label id="elh_employees_emp_cnic" for="x_emp_cnic" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->emp_cnic->caption() ?><?php echo $employees_edit->emp_cnic->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->emp_cnic->cellAttributes() ?>>
<span id="el_employees_emp_cnic">
<input type="text" data-table="employees" data-field="x_emp_cnic" name="x_emp_cnic" id="x_emp_cnic" size="30" maxlength="16" placeholder="<?php echo HtmlEncode($employees_edit->emp_cnic->getPlaceHolder()) ?>" value="<?php echo $employees_edit->emp_cnic->EditValue ?>"<?php echo $employees_edit->emp_cnic->editAttributes() ?>>
</span>
<?php echo $employees_edit->emp_cnic->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->emp_address->Visible) { // emp_address ?>
	<div id="r_emp_address" class="form-group row">
		<label id="elh_employees_emp_address" for="x_emp_address" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->emp_address->caption() ?><?php echo $employees_edit->emp_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->emp_address->cellAttributes() ?>>
<span id="el_employees_emp_address">
<textarea data-table="employees" data-field="x_emp_address" name="x_emp_address" id="x_emp_address" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employees_edit->emp_address->getPlaceHolder()) ?>"<?php echo $employees_edit->emp_address->editAttributes() ?>><?php echo $employees_edit->emp_address->EditValue ?></textarea>
</span>
<?php echo $employees_edit->emp_address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->emp_city_id->Visible) { // emp_city_id ?>
	<div id="r_emp_city_id" class="form-group row">
		<label id="elh_employees_emp_city_id" for="x_emp_city_id" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->emp_city_id->caption() ?><?php echo $employees_edit->emp_city_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->emp_city_id->cellAttributes() ?>>
<span id="el_employees_emp_city_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($employees_edit->emp_city_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $employees_edit->emp_city_id->ViewValue ?></button>
		<div id="dsl_x_emp_city_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $employees_edit->emp_city_id->radioButtonListHtml(TRUE, "x_emp_city_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_emp_city_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="employees" data-field="x_emp_city_id" data-value-separator="<?php echo $employees_edit->emp_city_id->displayValueSeparatorAttribute() ?>" name="x_emp_city_id" id="x_emp_city_id" value="{value}"<?php echo $employees_edit->emp_city_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$employees_edit->emp_city_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $employees_edit->emp_city_id->Lookup->getParamTag($employees_edit, "p_x_emp_city_id") ?>
</span>
<?php echo $employees_edit->emp_city_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->emp_contact->Visible) { // emp_contact ?>
	<div id="r_emp_contact" class="form-group row">
		<label id="elh_employees_emp_contact" for="x_emp_contact" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->emp_contact->caption() ?><?php echo $employees_edit->emp_contact->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->emp_contact->cellAttributes() ?>>
<span id="el_employees_emp_contact">
<input type="text" data-table="employees" data-field="x_emp_contact" name="x_emp_contact" id="x_emp_contact" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($employees_edit->emp_contact->getPlaceHolder()) ?>" value="<?php echo $employees_edit->emp_contact->EditValue ?>"<?php echo $employees_edit->emp_contact->editAttributes() ?>>
</span>
<?php echo $employees_edit->emp_contact->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->emp_email->Visible) { // emp_email ?>
	<div id="r_emp_email" class="form-group row">
		<label id="elh_employees_emp_email" for="x_emp_email" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->emp_email->caption() ?><?php echo $employees_edit->emp_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->emp_email->cellAttributes() ?>>
<span id="el_employees_emp_email">
<input type="text" data-table="employees" data-field="x_emp_email" name="x_emp_email" id="x_emp_email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employees_edit->emp_email->getPlaceHolder()) ?>" value="<?php echo $employees_edit->emp_email->EditValue ?>"<?php echo $employees_edit->emp_email->editAttributes() ?>>
</span>
<?php echo $employees_edit->emp_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->emp_photo->Visible) { // emp_photo ?>
	<div id="r_emp_photo" class="form-group row">
		<label id="elh_employees_emp_photo" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->emp_photo->caption() ?><?php echo $employees_edit->emp_photo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->emp_photo->cellAttributes() ?>>
<span id="el_employees_emp_photo">
<div id="fd_x_emp_photo">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $employees_edit->emp_photo->title() ?>" data-table="employees" data-field="x_emp_photo" name="x_emp_photo" id="x_emp_photo" lang="<?php echo CurrentLanguageID() ?>"<?php echo $employees_edit->emp_photo->editAttributes() ?><?php if ($employees_edit->emp_photo->ReadOnly || $employees_edit->emp_photo->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_emp_photo"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_emp_photo" id= "fn_x_emp_photo" value="<?php echo $employees_edit->emp_photo->Upload->FileName ?>">
<input type="hidden" name="fa_x_emp_photo" id= "fa_x_emp_photo" value="<?php echo (Post("fa_x_emp_photo") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_emp_photo" id= "fs_x_emp_photo" value="100">
<input type="hidden" name="fx_x_emp_photo" id= "fx_x_emp_photo" value="<?php echo $employees_edit->emp_photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_emp_photo" id= "fm_x_emp_photo" value="<?php echo $employees_edit->emp_photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_emp_photo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $employees_edit->emp_photo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employees_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employees_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employees_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employees_edit->showPageFooter();
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
$employees_edit->terminate();
?>