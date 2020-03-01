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
$user_edit = new user_edit();

// Run the page
$user_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuseredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fuseredit = currentForm = new ew.Form("fuseredit", "edit");

	// Validate form
	fuseredit.validate = function() {
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
			<?php if ($user_edit->user_id->Required) { ?>
				elm = this.getElements("x" + infix + "_user_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->user_id->caption(), $user_edit->user_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_edit->user_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_user_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->user_branch_id->caption(), $user_edit->user_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_edit->user_type_id->Required) { ?>
				elm = this.getElements("x" + infix + "_user_type_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->user_type_id->caption(), $user_edit->user_type_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_edit->user_name->Required) { ?>
				elm = this.getElements("x" + infix + "_user_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->user_name->caption(), $user_edit->user_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_edit->user_password->Required) { ?>
				elm = this.getElements("x" + infix + "_user_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->user_password->caption(), $user_edit->user_password->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_user_password");
				if (elm && $(elm).hasClass("ew-password-strength") && !$(elm).data("validated"))
					return this.onError(elm, ew.language.phrase("PasswordTooSimple"));
			<?php if ($user_edit->user_email->Required) { ?>
				elm = this.getElements("x" + infix + "_user_email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->user_email->caption(), $user_edit->user_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_edit->user_father->Required) { ?>
				elm = this.getElements("x" + infix + "_user_father");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->user_father->caption(), $user_edit->user_father->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_edit->user_photo->Required) { ?>
				felm = this.getElements("x" + infix + "_user_photo");
				elm = this.getElements("fn_x" + infix + "_user_photo");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $user_edit->user_photo->caption(), $user_edit->user_photo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_edit->user_cnic->Required) { ?>
				elm = this.getElements("x" + infix + "_user_cnic");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->user_cnic->caption(), $user_edit->user_cnic->RequiredErrorMessage)) ?>");
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
	fuseredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fuseredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fuseredit.lists["x_user_branch_id"] = <?php echo $user_edit->user_branch_id->Lookup->toClientList($user_edit) ?>;
	fuseredit.lists["x_user_branch_id"].options = <?php echo JsonEncode($user_edit->user_branch_id->lookupOptions()) ?>;
	fuseredit.lists["x_user_type_id"] = <?php echo $user_edit->user_type_id->Lookup->toClientList($user_edit) ?>;
	fuseredit.lists["x_user_type_id"].options = <?php echo JsonEncode($user_edit->user_type_id->lookupOptions()) ?>;
	loadjs.done("fuseredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $user_edit->showPageHeader(); ?>
<?php
$user_edit->showMessage();
?>
<form name="fuseredit" id="fuseredit" class="<?php echo $user_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$user_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($user_edit->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group row">
		<label id="elh_user_user_id" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->user_id->caption() ?><?php echo $user_edit->user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->user_id->cellAttributes() ?>>
<span id="el_user_user_id">
<span<?php echo $user_edit->user_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($user_edit->user_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_user_id" name="x_user_id" id="x_user_id" value="<?php echo HtmlEncode($user_edit->user_id->CurrentValue) ?>">
<?php echo $user_edit->user_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->user_branch_id->Visible) { // user_branch_id ?>
	<div id="r_user_branch_id" class="form-group row">
		<label id="elh_user_user_branch_id" for="x_user_branch_id" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->user_branch_id->caption() ?><?php echo $user_edit->user_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->user_branch_id->cellAttributes() ?>>
<span id="el_user_user_branch_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($user_edit->user_branch_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $user_edit->user_branch_id->ViewValue ?></button>
		<div id="dsl_x_user_branch_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $user_edit->user_branch_id->radioButtonListHtml(TRUE, "x_user_branch_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_user_branch_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="user" data-field="x_user_branch_id" data-value-separator="<?php echo $user_edit->user_branch_id->displayValueSeparatorAttribute() ?>" name="x_user_branch_id" id="x_user_branch_id" value="{value}"<?php echo $user_edit->user_branch_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$user_edit->user_branch_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $user_edit->user_branch_id->Lookup->getParamTag($user_edit, "p_x_user_branch_id") ?>
</span>
<?php echo $user_edit->user_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->user_type_id->Visible) { // user_type_id ?>
	<div id="r_user_type_id" class="form-group row">
		<label id="elh_user_user_type_id" for="x_user_type_id" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->user_type_id->caption() ?><?php echo $user_edit->user_type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->user_type_id->cellAttributes() ?>>
<span id="el_user_user_type_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($user_edit->user_type_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $user_edit->user_type_id->ViewValue ?></button>
		<div id="dsl_x_user_type_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $user_edit->user_type_id->radioButtonListHtml(TRUE, "x_user_type_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_user_type_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="user" data-field="x_user_type_id" data-value-separator="<?php echo $user_edit->user_type_id->displayValueSeparatorAttribute() ?>" name="x_user_type_id" id="x_user_type_id" value="{value}"<?php echo $user_edit->user_type_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$user_edit->user_type_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $user_edit->user_type_id->Lookup->getParamTag($user_edit, "p_x_user_type_id") ?>
</span>
<?php echo $user_edit->user_type_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->user_name->Visible) { // user_name ?>
	<div id="r_user_name" class="form-group row">
		<label id="elh_user_user_name" for="x_user_name" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->user_name->caption() ?><?php echo $user_edit->user_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->user_name->cellAttributes() ?>>
<span id="el_user_user_name">
<input type="text" data-table="user" data-field="x_user_name" name="x_user_name" id="x_user_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($user_edit->user_name->getPlaceHolder()) ?>" value="<?php echo $user_edit->user_name->EditValue ?>"<?php echo $user_edit->user_name->editAttributes() ?>>
</span>
<?php echo $user_edit->user_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->user_password->Visible) { // user_password ?>
	<div id="r_user_password" class="form-group row">
		<label id="elh_user_user_password" for="x_user_password" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->user_password->caption() ?><?php echo $user_edit->user_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->user_password->cellAttributes() ?>>
<span id="el_user_user_password">
<div class="input-group" id="ig_user_password">
<input type="password" autocomplete="new-password" data-password-strength="pst_user_password" data-table="user" data-field="x_user_password" name="x_user_password" id="x_user_password" value="<?php echo $user_edit->user_password->EditValue ?>" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($user_edit->user_password->getPlaceHolder()) ?>"<?php echo $user_edit->user_password->editAttributes() ?>>
<div class="input-group-append">
	<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
	<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x_user_password" data-password-confirm="c_user_password" data-password-strength="pst_user_password"><?php echo $Language->phrase("GeneratePassword") ?></button>
</div>
</div>
<div class="progress ew-password-strength-bar form-text mt-1 d-none" id="pst_user_password">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span>
<?php echo $user_edit->user_password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->user_email->Visible) { // user_email ?>
	<div id="r_user_email" class="form-group row">
		<label id="elh_user_user_email" for="x_user_email" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->user_email->caption() ?><?php echo $user_edit->user_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->user_email->cellAttributes() ?>>
<span id="el_user_user_email">
<input type="text" data-table="user" data-field="x_user_email" name="x_user_email" id="x_user_email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($user_edit->user_email->getPlaceHolder()) ?>" value="<?php echo $user_edit->user_email->EditValue ?>"<?php echo $user_edit->user_email->editAttributes() ?>>
</span>
<?php echo $user_edit->user_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->user_father->Visible) { // user_father ?>
	<div id="r_user_father" class="form-group row">
		<label id="elh_user_user_father" for="x_user_father" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->user_father->caption() ?><?php echo $user_edit->user_father->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->user_father->cellAttributes() ?>>
<span id="el_user_user_father">
<input type="text" data-table="user" data-field="x_user_father" name="x_user_father" id="x_user_father" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($user_edit->user_father->getPlaceHolder()) ?>" value="<?php echo $user_edit->user_father->EditValue ?>"<?php echo $user_edit->user_father->editAttributes() ?>>
</span>
<?php echo $user_edit->user_father->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->user_photo->Visible) { // user_photo ?>
	<div id="r_user_photo" class="form-group row">
		<label id="elh_user_user_photo" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->user_photo->caption() ?><?php echo $user_edit->user_photo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->user_photo->cellAttributes() ?>>
<span id="el_user_user_photo">
<div id="fd_x_user_photo">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $user_edit->user_photo->title() ?>" data-table="user" data-field="x_user_photo" name="x_user_photo" id="x_user_photo" lang="<?php echo CurrentLanguageID() ?>"<?php echo $user_edit->user_photo->editAttributes() ?><?php if ($user_edit->user_photo->ReadOnly || $user_edit->user_photo->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_user_photo"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_user_photo" id= "fn_x_user_photo" value="<?php echo $user_edit->user_photo->Upload->FileName ?>">
<input type="hidden" name="fa_x_user_photo" id= "fa_x_user_photo" value="<?php echo (Post("fa_x_user_photo") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_user_photo" id= "fs_x_user_photo" value="500">
<input type="hidden" name="fx_x_user_photo" id= "fx_x_user_photo" value="<?php echo $user_edit->user_photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_user_photo" id= "fm_x_user_photo" value="<?php echo $user_edit->user_photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_user_photo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $user_edit->user_photo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->user_cnic->Visible) { // user_cnic ?>
	<div id="r_user_cnic" class="form-group row">
		<label id="elh_user_user_cnic" for="x_user_cnic" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->user_cnic->caption() ?><?php echo $user_edit->user_cnic->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->user_cnic->cellAttributes() ?>>
<span id="el_user_user_cnic">
<input type="text" data-table="user" data-field="x_user_cnic" name="x_user_cnic" id="x_user_cnic" size="30" maxlength="16" placeholder="<?php echo HtmlEncode($user_edit->user_cnic->getPlaceHolder()) ?>" value="<?php echo $user_edit->user_cnic->EditValue ?>"<?php echo $user_edit->user_cnic->editAttributes() ?>>
</span>
<?php echo $user_edit->user_cnic->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$user_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $user_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$user_edit->showPageFooter();
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
$user_edit->terminate();
?>