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
$city_edit = new city_edit();

// Run the page
$city_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$city_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcityedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcityedit = currentForm = new ew.Form("fcityedit", "edit");

	// Validate form
	fcityedit.validate = function() {
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
			<?php if ($city_edit->city_id->Required) { ?>
				elm = this.getElements("x" + infix + "_city_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $city_edit->city_id->caption(), $city_edit->city_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($city_edit->city_tehsil_id->Required) { ?>
				elm = this.getElements("x" + infix + "_city_tehsil_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $city_edit->city_tehsil_id->caption(), $city_edit->city_tehsil_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($city_edit->city_name->Required) { ?>
				elm = this.getElements("x" + infix + "_city_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $city_edit->city_name->caption(), $city_edit->city_name->RequiredErrorMessage)) ?>");
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
	fcityedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcityedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcityedit.lists["x_city_tehsil_id"] = <?php echo $city_edit->city_tehsil_id->Lookup->toClientList($city_edit) ?>;
	fcityedit.lists["x_city_tehsil_id"].options = <?php echo JsonEncode($city_edit->city_tehsil_id->lookupOptions()) ?>;
	loadjs.done("fcityedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $city_edit->showPageHeader(); ?>
<?php
$city_edit->showMessage();
?>
<form name="fcityedit" id="fcityedit" class="<?php echo $city_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="city">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$city_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($city_edit->city_id->Visible) { // city_id ?>
	<div id="r_city_id" class="form-group row">
		<label id="elh_city_city_id" class="<?php echo $city_edit->LeftColumnClass ?>"><?php echo $city_edit->city_id->caption() ?><?php echo $city_edit->city_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $city_edit->RightColumnClass ?>"><div <?php echo $city_edit->city_id->cellAttributes() ?>>
<span id="el_city_city_id">
<span<?php echo $city_edit->city_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($city_edit->city_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="city" data-field="x_city_id" name="x_city_id" id="x_city_id" value="<?php echo HtmlEncode($city_edit->city_id->CurrentValue) ?>">
<?php echo $city_edit->city_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($city_edit->city_tehsil_id->Visible) { // city_tehsil_id ?>
	<div id="r_city_tehsil_id" class="form-group row">
		<label id="elh_city_city_tehsil_id" for="x_city_tehsil_id" class="<?php echo $city_edit->LeftColumnClass ?>"><?php echo $city_edit->city_tehsil_id->caption() ?><?php echo $city_edit->city_tehsil_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $city_edit->RightColumnClass ?>"><div <?php echo $city_edit->city_tehsil_id->cellAttributes() ?>>
<span id="el_city_city_tehsil_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($city_edit->city_tehsil_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $city_edit->city_tehsil_id->ViewValue ?></button>
		<div id="dsl_x_city_tehsil_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $city_edit->city_tehsil_id->radioButtonListHtml(TRUE, "x_city_tehsil_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_city_tehsil_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="city" data-field="x_city_tehsil_id" data-value-separator="<?php echo $city_edit->city_tehsil_id->displayValueSeparatorAttribute() ?>" name="x_city_tehsil_id" id="x_city_tehsil_id" value="{value}"<?php echo $city_edit->city_tehsil_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$city_edit->city_tehsil_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $city_edit->city_tehsil_id->Lookup->getParamTag($city_edit, "p_x_city_tehsil_id") ?>
</span>
<?php echo $city_edit->city_tehsil_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($city_edit->city_name->Visible) { // city_name ?>
	<div id="r_city_name" class="form-group row">
		<label id="elh_city_city_name" for="x_city_name" class="<?php echo $city_edit->LeftColumnClass ?>"><?php echo $city_edit->city_name->caption() ?><?php echo $city_edit->city_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $city_edit->RightColumnClass ?>"><div <?php echo $city_edit->city_name->cellAttributes() ?>>
<span id="el_city_city_name">
<input type="text" data-table="city" data-field="x_city_name" name="x_city_name" id="x_city_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($city_edit->city_name->getPlaceHolder()) ?>" value="<?php echo $city_edit->city_name->EditValue ?>"<?php echo $city_edit->city_name->editAttributes() ?>>
</span>
<?php echo $city_edit->city_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$city_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $city_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $city_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$city_edit->showPageFooter();
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
$city_edit->terminate();
?>