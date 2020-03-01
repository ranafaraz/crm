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
$state_edit = new state_edit();

// Run the page
$state_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$state_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstateedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fstateedit = currentForm = new ew.Form("fstateedit", "edit");

	// Validate form
	fstateedit.validate = function() {
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
			<?php if ($state_edit->state_id->Required) { ?>
				elm = this.getElements("x" + infix + "_state_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $state_edit->state_id->caption(), $state_edit->state_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($state_edit->state_country_id->Required) { ?>
				elm = this.getElements("x" + infix + "_state_country_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $state_edit->state_country_id->caption(), $state_edit->state_country_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($state_edit->state_name->Required) { ?>
				elm = this.getElements("x" + infix + "_state_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $state_edit->state_name->caption(), $state_edit->state_name->RequiredErrorMessage)) ?>");
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
	fstateedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstateedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstateedit.lists["x_state_country_id"] = <?php echo $state_edit->state_country_id->Lookup->toClientList($state_edit) ?>;
	fstateedit.lists["x_state_country_id"].options = <?php echo JsonEncode($state_edit->state_country_id->lookupOptions()) ?>;
	loadjs.done("fstateedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $state_edit->showPageHeader(); ?>
<?php
$state_edit->showMessage();
?>
<form name="fstateedit" id="fstateedit" class="<?php echo $state_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="state">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$state_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($state_edit->state_id->Visible) { // state_id ?>
	<div id="r_state_id" class="form-group row">
		<label id="elh_state_state_id" class="<?php echo $state_edit->LeftColumnClass ?>"><?php echo $state_edit->state_id->caption() ?><?php echo $state_edit->state_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $state_edit->RightColumnClass ?>"><div <?php echo $state_edit->state_id->cellAttributes() ?>>
<span id="el_state_state_id">
<span<?php echo $state_edit->state_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($state_edit->state_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="state" data-field="x_state_id" name="x_state_id" id="x_state_id" value="<?php echo HtmlEncode($state_edit->state_id->CurrentValue) ?>">
<?php echo $state_edit->state_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($state_edit->state_country_id->Visible) { // state_country_id ?>
	<div id="r_state_country_id" class="form-group row">
		<label id="elh_state_state_country_id" for="x_state_country_id" class="<?php echo $state_edit->LeftColumnClass ?>"><?php echo $state_edit->state_country_id->caption() ?><?php echo $state_edit->state_country_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $state_edit->RightColumnClass ?>"><div <?php echo $state_edit->state_country_id->cellAttributes() ?>>
<span id="el_state_state_country_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($state_edit->state_country_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $state_edit->state_country_id->ViewValue ?></button>
		<div id="dsl_x_state_country_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $state_edit->state_country_id->radioButtonListHtml(TRUE, "x_state_country_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_state_country_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="state" data-field="x_state_country_id" data-value-separator="<?php echo $state_edit->state_country_id->displayValueSeparatorAttribute() ?>" name="x_state_country_id" id="x_state_country_id" value="{value}"<?php echo $state_edit->state_country_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$state_edit->state_country_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $state_edit->state_country_id->Lookup->getParamTag($state_edit, "p_x_state_country_id") ?>
</span>
<?php echo $state_edit->state_country_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($state_edit->state_name->Visible) { // state_name ?>
	<div id="r_state_name" class="form-group row">
		<label id="elh_state_state_name" for="x_state_name" class="<?php echo $state_edit->LeftColumnClass ?>"><?php echo $state_edit->state_name->caption() ?><?php echo $state_edit->state_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $state_edit->RightColumnClass ?>"><div <?php echo $state_edit->state_name->cellAttributes() ?>>
<span id="el_state_state_name">
<input type="text" data-table="state" data-field="x_state_name" name="x_state_name" id="x_state_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($state_edit->state_name->getPlaceHolder()) ?>" value="<?php echo $state_edit->state_name->EditValue ?>"<?php echo $state_edit->state_name->editAttributes() ?>>
</span>
<?php echo $state_edit->state_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$state_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $state_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $state_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$state_edit->showPageFooter();
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
$state_edit->terminate();
?>