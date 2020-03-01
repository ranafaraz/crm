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
$user_edit = new user_edit();

// Run the page
$user_edit->run();

// Setup login status
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
				elm = this.getElements("x" + infix + "_user_branch_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($user_edit->user_branch_id->errorMessage()) ?>");
			<?php if ($user_edit->user_type_id->Required) { ?>
				elm = this.getElements("x" + infix + "_user_type_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->user_type_id->caption(), $user_edit->user_type_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_user_type_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($user_edit->user_type_id->errorMessage()) ?>");
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
				elm = this.getElements("x" + infix + "_user_photo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->user_photo->caption(), $user_edit->user_photo->RequiredErrorMessage)) ?>");
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
<input type="text" data-table="user" data-field="x_user_branch_id" name="x_user_branch_id" id="x_user_branch_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($user_edit->user_branch_id->getPlaceHolder()) ?>" value="<?php echo $user_edit->user_branch_id->EditValue ?>"<?php echo $user_edit->user_branch_id->editAttributes() ?>>
</span>
<?php echo $user_edit->user_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->user_type_id->Visible) { // user_type_id ?>
	<div id="r_user_type_id" class="form-group row">
		<label id="elh_user_user_type_id" for="x_user_type_id" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->user_type_id->caption() ?><?php echo $user_edit->user_type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->user_type_id->cellAttributes() ?>>
<span id="el_user_user_type_id">
<input type="text" data-table="user" data-field="x_user_type_id" name="x_user_type_id" id="x_user_type_id" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($user_edit->user_type_id->getPlaceHolder()) ?>" value="<?php echo $user_edit->user_type_id->EditValue ?>"<?php echo $user_edit->user_type_id->editAttributes() ?>>
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
<input type="text" data-table="user" data-field="x_user_password" name="x_user_password" id="x_user_password" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($user_edit->user_password->getPlaceHolder()) ?>" value="<?php echo $user_edit->user_password->EditValue ?>"<?php echo $user_edit->user_password->editAttributes() ?>>
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
		<label id="elh_user_user_photo" for="x_user_photo" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->user_photo->caption() ?><?php echo $user_edit->user_photo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->user_photo->cellAttributes() ?>>
<span id="el_user_user_photo">
<textarea data-table="user" data-field="x_user_photo" name="x_user_photo" id="x_user_photo" cols="35" rows="4" placeholder="<?php echo HtmlEncode($user_edit->user_photo->getPlaceHolder()) ?>"<?php echo $user_edit->user_photo->editAttributes() ?>><?php echo $user_edit->user_photo->EditValue ?></textarea>
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