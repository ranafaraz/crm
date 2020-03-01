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
$sms_log_edit = new sms_log_edit();

// Run the page
$sms_log_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_log_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsms_logedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fsms_logedit = currentForm = new ew.Form("fsms_logedit", "edit");

	// Validate form
	fsms_logedit.validate = function() {
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
			<?php if ($sms_log_edit->sms_log_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_log_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_log_edit->sms_log_id->caption(), $sms_log_edit->sms_log_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sms_log_edit->sms_log_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_log_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_log_edit->sms_log_branch_id->caption(), $sms_log_edit->sms_log_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sms_log_edit->sms_log_sms_api_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_log_sms_api_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_log_edit->sms_log_sms_api_id->caption(), $sms_log_edit->sms_log_sms_api_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sms_log_edit->sms_log_message->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_log_message");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_log_edit->sms_log_message->caption(), $sms_log_edit->sms_log_message->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sms_log_edit->sms_log_to->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_log_to");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_log_edit->sms_log_to->caption(), $sms_log_edit->sms_log_to->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sms_log_edit->sms_log_date->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_log_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_log_edit->sms_log_date->caption(), $sms_log_edit->sms_log_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sms_log_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($sms_log_edit->sms_log_date->errorMessage()) ?>");

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
	fsms_logedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsms_logedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fsms_logedit.lists["x_sms_log_branch_id"] = <?php echo $sms_log_edit->sms_log_branch_id->Lookup->toClientList($sms_log_edit) ?>;
	fsms_logedit.lists["x_sms_log_branch_id"].options = <?php echo JsonEncode($sms_log_edit->sms_log_branch_id->lookupOptions()) ?>;
	fsms_logedit.lists["x_sms_log_sms_api_id"] = <?php echo $sms_log_edit->sms_log_sms_api_id->Lookup->toClientList($sms_log_edit) ?>;
	fsms_logedit.lists["x_sms_log_sms_api_id"].options = <?php echo JsonEncode($sms_log_edit->sms_log_sms_api_id->lookupOptions()) ?>;
	loadjs.done("fsms_logedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sms_log_edit->showPageHeader(); ?>
<?php
$sms_log_edit->showMessage();
?>
<form name="fsms_logedit" id="fsms_logedit" class="<?php echo $sms_log_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_log">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$sms_log_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($sms_log_edit->sms_log_id->Visible) { // sms_log_id ?>
	<div id="r_sms_log_id" class="form-group row">
		<label id="elh_sms_log_sms_log_id" class="<?php echo $sms_log_edit->LeftColumnClass ?>"><?php echo $sms_log_edit->sms_log_id->caption() ?><?php echo $sms_log_edit->sms_log_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_log_edit->RightColumnClass ?>"><div <?php echo $sms_log_edit->sms_log_id->cellAttributes() ?>>
<span id="el_sms_log_sms_log_id">
<span<?php echo $sms_log_edit->sms_log_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($sms_log_edit->sms_log_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="sms_log" data-field="x_sms_log_id" name="x_sms_log_id" id="x_sms_log_id" value="<?php echo HtmlEncode($sms_log_edit->sms_log_id->CurrentValue) ?>">
<?php echo $sms_log_edit->sms_log_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_log_edit->sms_log_branch_id->Visible) { // sms_log_branch_id ?>
	<div id="r_sms_log_branch_id" class="form-group row">
		<label id="elh_sms_log_sms_log_branch_id" for="x_sms_log_branch_id" class="<?php echo $sms_log_edit->LeftColumnClass ?>"><?php echo $sms_log_edit->sms_log_branch_id->caption() ?><?php echo $sms_log_edit->sms_log_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_log_edit->RightColumnClass ?>"><div <?php echo $sms_log_edit->sms_log_branch_id->cellAttributes() ?>>
<span id="el_sms_log_sms_log_branch_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($sms_log_edit->sms_log_branch_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $sms_log_edit->sms_log_branch_id->ViewValue ?></button>
		<div id="dsl_x_sms_log_branch_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $sms_log_edit->sms_log_branch_id->radioButtonListHtml(TRUE, "x_sms_log_branch_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_sms_log_branch_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="sms_log" data-field="x_sms_log_branch_id" data-value-separator="<?php echo $sms_log_edit->sms_log_branch_id->displayValueSeparatorAttribute() ?>" name="x_sms_log_branch_id" id="x_sms_log_branch_id" value="{value}"<?php echo $sms_log_edit->sms_log_branch_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$sms_log_edit->sms_log_branch_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $sms_log_edit->sms_log_branch_id->Lookup->getParamTag($sms_log_edit, "p_x_sms_log_branch_id") ?>
</span>
<?php echo $sms_log_edit->sms_log_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_log_edit->sms_log_sms_api_id->Visible) { // sms_log_sms_api_id ?>
	<div id="r_sms_log_sms_api_id" class="form-group row">
		<label id="elh_sms_log_sms_log_sms_api_id" for="x_sms_log_sms_api_id" class="<?php echo $sms_log_edit->LeftColumnClass ?>"><?php echo $sms_log_edit->sms_log_sms_api_id->caption() ?><?php echo $sms_log_edit->sms_log_sms_api_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_log_edit->RightColumnClass ?>"><div <?php echo $sms_log_edit->sms_log_sms_api_id->cellAttributes() ?>>
<span id="el_sms_log_sms_log_sms_api_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($sms_log_edit->sms_log_sms_api_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $sms_log_edit->sms_log_sms_api_id->ViewValue ?></button>
		<div id="dsl_x_sms_log_sms_api_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $sms_log_edit->sms_log_sms_api_id->radioButtonListHtml(TRUE, "x_sms_log_sms_api_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_sms_log_sms_api_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="sms_log" data-field="x_sms_log_sms_api_id" data-value-separator="<?php echo $sms_log_edit->sms_log_sms_api_id->displayValueSeparatorAttribute() ?>" name="x_sms_log_sms_api_id" id="x_sms_log_sms_api_id" value="{value}"<?php echo $sms_log_edit->sms_log_sms_api_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$sms_log_edit->sms_log_sms_api_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $sms_log_edit->sms_log_sms_api_id->Lookup->getParamTag($sms_log_edit, "p_x_sms_log_sms_api_id") ?>
</span>
<?php echo $sms_log_edit->sms_log_sms_api_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_log_edit->sms_log_message->Visible) { // sms_log_message ?>
	<div id="r_sms_log_message" class="form-group row">
		<label id="elh_sms_log_sms_log_message" class="<?php echo $sms_log_edit->LeftColumnClass ?>"><?php echo $sms_log_edit->sms_log_message->caption() ?><?php echo $sms_log_edit->sms_log_message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_log_edit->RightColumnClass ?>"><div <?php echo $sms_log_edit->sms_log_message->cellAttributes() ?>>
<span id="el_sms_log_sms_log_message">
<?php $sms_log_edit->sms_log_message->EditAttrs->appendClass("editor"); ?>
<textarea data-table="sms_log" data-field="x_sms_log_message" name="x_sms_log_message" id="x_sms_log_message" cols="35" rows="4" placeholder="<?php echo HtmlEncode($sms_log_edit->sms_log_message->getPlaceHolder()) ?>"<?php echo $sms_log_edit->sms_log_message->editAttributes() ?>><?php echo $sms_log_edit->sms_log_message->EditValue ?></textarea>
<script>
loadjs.ready(["fsms_logedit", "editor"], function() {
	ew.createEditor("fsms_logedit", "x_sms_log_message", 35, 4, <?php echo $sms_log_edit->sms_log_message->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $sms_log_edit->sms_log_message->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_log_edit->sms_log_to->Visible) { // sms_log_to ?>
	<div id="r_sms_log_to" class="form-group row">
		<label id="elh_sms_log_sms_log_to" for="x_sms_log_to" class="<?php echo $sms_log_edit->LeftColumnClass ?>"><?php echo $sms_log_edit->sms_log_to->caption() ?><?php echo $sms_log_edit->sms_log_to->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_log_edit->RightColumnClass ?>"><div <?php echo $sms_log_edit->sms_log_to->cellAttributes() ?>>
<span id="el_sms_log_sms_log_to">
<textarea data-table="sms_log" data-field="x_sms_log_to" name="x_sms_log_to" id="x_sms_log_to" cols="35" rows="4" placeholder="<?php echo HtmlEncode($sms_log_edit->sms_log_to->getPlaceHolder()) ?>"<?php echo $sms_log_edit->sms_log_to->editAttributes() ?>><?php echo $sms_log_edit->sms_log_to->EditValue ?></textarea>
</span>
<?php echo $sms_log_edit->sms_log_to->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_log_edit->sms_log_date->Visible) { // sms_log_date ?>
	<div id="r_sms_log_date" class="form-group row">
		<label id="elh_sms_log_sms_log_date" for="x_sms_log_date" class="<?php echo $sms_log_edit->LeftColumnClass ?>"><?php echo $sms_log_edit->sms_log_date->caption() ?><?php echo $sms_log_edit->sms_log_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_log_edit->RightColumnClass ?>"><div <?php echo $sms_log_edit->sms_log_date->cellAttributes() ?>>
<span id="el_sms_log_sms_log_date">
<input type="text" data-table="sms_log" data-field="x_sms_log_date" name="x_sms_log_date" id="x_sms_log_date" maxlength="10" placeholder="<?php echo HtmlEncode($sms_log_edit->sms_log_date->getPlaceHolder()) ?>" value="<?php echo $sms_log_edit->sms_log_date->EditValue ?>"<?php echo $sms_log_edit->sms_log_date->editAttributes() ?>>
<?php if (!$sms_log_edit->sms_log_date->ReadOnly && !$sms_log_edit->sms_log_date->Disabled && !isset($sms_log_edit->sms_log_date->EditAttrs["readonly"]) && !isset($sms_log_edit->sms_log_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsms_logedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fsms_logedit", "x_sms_log_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $sms_log_edit->sms_log_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$sms_log_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $sms_log_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sms_log_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$sms_log_edit->showPageFooter();
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
$sms_log_edit->terminate();
?>