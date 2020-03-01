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
$user_type_add = new user_type_add();

// Run the page
$user_type_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuser_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fuser_typeadd = currentForm = new ew.Form("fuser_typeadd", "add");

	// Validate form
	fuser_typeadd.validate = function() {
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
			<?php if ($user_type_add->user_type_name->Required) { ?>
				elm = this.getElements("x" + infix + "_user_type_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_type_add->user_type_name->caption(), $user_type_add->user_type_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_type_add->user_type_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_user_type_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_type_add->user_type_desc->caption(), $user_type_add->user_type_desc->RequiredErrorMessage)) ?>");
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
	fuser_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fuser_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fuser_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $user_type_add->showPageHeader(); ?>
<?php
$user_type_add->showMessage();
?>
<form name="fuser_typeadd" id="fuser_typeadd" class="<?php echo $user_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$user_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($user_type_add->user_type_name->Visible) { // user_type_name ?>
	<div id="r_user_type_name" class="form-group row">
		<label id="elh_user_type_user_type_name" for="x_user_type_name" class="<?php echo $user_type_add->LeftColumnClass ?>"><?php echo $user_type_add->user_type_name->caption() ?><?php echo $user_type_add->user_type_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_type_add->RightColumnClass ?>"><div <?php echo $user_type_add->user_type_name->cellAttributes() ?>>
<span id="el_user_type_user_type_name">
<input type="text" data-table="user_type" data-field="x_user_type_name" name="x_user_type_name" id="x_user_type_name" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($user_type_add->user_type_name->getPlaceHolder()) ?>" value="<?php echo $user_type_add->user_type_name->EditValue ?>"<?php echo $user_type_add->user_type_name->editAttributes() ?>>
</span>
<?php echo $user_type_add->user_type_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_type_add->user_type_desc->Visible) { // user_type_desc ?>
	<div id="r_user_type_desc" class="form-group row">
		<label id="elh_user_type_user_type_desc" for="x_user_type_desc" class="<?php echo $user_type_add->LeftColumnClass ?>"><?php echo $user_type_add->user_type_desc->caption() ?><?php echo $user_type_add->user_type_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_type_add->RightColumnClass ?>"><div <?php echo $user_type_add->user_type_desc->cellAttributes() ?>>
<span id="el_user_type_user_type_desc">
<input type="text" data-table="user_type" data-field="x_user_type_desc" name="x_user_type_desc" id="x_user_type_desc" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user_type_add->user_type_desc->getPlaceHolder()) ?>" value="<?php echo $user_type_add->user_type_desc->EditValue ?>"<?php echo $user_type_add->user_type_desc->editAttributes() ?>>
</span>
<?php echo $user_type_add->user_type_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$user_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $user_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$user_type_add->showPageFooter();
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
$user_type_add->terminate();
?>