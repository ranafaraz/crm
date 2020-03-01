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
$tehsil_edit = new tehsil_edit();

// Run the page
$tehsil_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tehsil_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftehsiledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftehsiledit = currentForm = new ew.Form("ftehsiledit", "edit");

	// Validate form
	ftehsiledit.validate = function() {
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
			<?php if ($tehsil_edit->tehsil_id->Required) { ?>
				elm = this.getElements("x" + infix + "_tehsil_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tehsil_edit->tehsil_id->caption(), $tehsil_edit->tehsil_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tehsil_edit->tehsil_district_id->Required) { ?>
				elm = this.getElements("x" + infix + "_tehsil_district_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tehsil_edit->tehsil_district_id->caption(), $tehsil_edit->tehsil_district_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tehsil_edit->tehsil_name->Required) { ?>
				elm = this.getElements("x" + infix + "_tehsil_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tehsil_edit->tehsil_name->caption(), $tehsil_edit->tehsil_name->RequiredErrorMessage)) ?>");
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
	ftehsiledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftehsiledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftehsiledit.lists["x_tehsil_district_id"] = <?php echo $tehsil_edit->tehsil_district_id->Lookup->toClientList($tehsil_edit) ?>;
	ftehsiledit.lists["x_tehsil_district_id"].options = <?php echo JsonEncode($tehsil_edit->tehsil_district_id->lookupOptions()) ?>;
	loadjs.done("ftehsiledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tehsil_edit->showPageHeader(); ?>
<?php
$tehsil_edit->showMessage();
?>
<form name="ftehsiledit" id="ftehsiledit" class="<?php echo $tehsil_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tehsil">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tehsil_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tehsil_edit->tehsil_id->Visible) { // tehsil_id ?>
	<div id="r_tehsil_id" class="form-group row">
		<label id="elh_tehsil_tehsil_id" class="<?php echo $tehsil_edit->LeftColumnClass ?>"><?php echo $tehsil_edit->tehsil_id->caption() ?><?php echo $tehsil_edit->tehsil_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tehsil_edit->RightColumnClass ?>"><div <?php echo $tehsil_edit->tehsil_id->cellAttributes() ?>>
<span id="el_tehsil_tehsil_id">
<span<?php echo $tehsil_edit->tehsil_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tehsil_edit->tehsil_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="tehsil" data-field="x_tehsil_id" name="x_tehsil_id" id="x_tehsil_id" value="<?php echo HtmlEncode($tehsil_edit->tehsil_id->CurrentValue) ?>">
<?php echo $tehsil_edit->tehsil_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tehsil_edit->tehsil_district_id->Visible) { // tehsil_district_id ?>
	<div id="r_tehsil_district_id" class="form-group row">
		<label id="elh_tehsil_tehsil_district_id" for="x_tehsil_district_id" class="<?php echo $tehsil_edit->LeftColumnClass ?>"><?php echo $tehsil_edit->tehsil_district_id->caption() ?><?php echo $tehsil_edit->tehsil_district_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tehsil_edit->RightColumnClass ?>"><div <?php echo $tehsil_edit->tehsil_district_id->cellAttributes() ?>>
<span id="el_tehsil_tehsil_district_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($tehsil_edit->tehsil_district_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $tehsil_edit->tehsil_district_id->ViewValue ?></button>
		<div id="dsl_x_tehsil_district_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $tehsil_edit->tehsil_district_id->radioButtonListHtml(TRUE, "x_tehsil_district_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_tehsil_district_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="tehsil" data-field="x_tehsil_district_id" data-value-separator="<?php echo $tehsil_edit->tehsil_district_id->displayValueSeparatorAttribute() ?>" name="x_tehsil_district_id" id="x_tehsil_district_id" value="{value}"<?php echo $tehsil_edit->tehsil_district_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$tehsil_edit->tehsil_district_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $tehsil_edit->tehsil_district_id->Lookup->getParamTag($tehsil_edit, "p_x_tehsil_district_id") ?>
</span>
<?php echo $tehsil_edit->tehsil_district_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tehsil_edit->tehsil_name->Visible) { // tehsil_name ?>
	<div id="r_tehsil_name" class="form-group row">
		<label id="elh_tehsil_tehsil_name" for="x_tehsil_name" class="<?php echo $tehsil_edit->LeftColumnClass ?>"><?php echo $tehsil_edit->tehsil_name->caption() ?><?php echo $tehsil_edit->tehsil_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tehsil_edit->RightColumnClass ?>"><div <?php echo $tehsil_edit->tehsil_name->cellAttributes() ?>>
<span id="el_tehsil_tehsil_name">
<input type="text" data-table="tehsil" data-field="x_tehsil_name" name="x_tehsil_name" id="x_tehsil_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tehsil_edit->tehsil_name->getPlaceHolder()) ?>" value="<?php echo $tehsil_edit->tehsil_name->EditValue ?>"<?php echo $tehsil_edit->tehsil_name->editAttributes() ?>>
</span>
<?php echo $tehsil_edit->tehsil_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tehsil_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tehsil_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tehsil_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tehsil_edit->showPageFooter();
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
$tehsil_edit->terminate();
?>