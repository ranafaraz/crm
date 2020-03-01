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
$reference_letter_add = new reference_letter_add();

// Run the page
$reference_letter_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$reference_letter_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freference_letteradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	freference_letteradd = currentForm = new ew.Form("freference_letteradd", "add");

	// Validate form
	freference_letteradd.validate = function() {
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
			<?php if ($reference_letter_add->ref_letter_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_ref_letter_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reference_letter_add->ref_letter_branch_id->caption(), $reference_letter_add->ref_letter_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reference_letter_add->ref_letter_to_whom->Required) { ?>
				elm = this.getElements("x" + infix + "_ref_letter_to_whom");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reference_letter_add->ref_letter_to_whom->caption(), $reference_letter_add->ref_letter_to_whom->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reference_letter_add->ref_letter_by_whom->Required) { ?>
				elm = this.getElements("x" + infix + "_ref_letter_by_whom");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reference_letter_add->ref_letter_by_whom->caption(), $reference_letter_add->ref_letter_by_whom->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reference_letter_add->ref_letter_content->Required) { ?>
				elm = this.getElements("x" + infix + "_ref_letter_content");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reference_letter_add->ref_letter_content->caption(), $reference_letter_add->ref_letter_content->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reference_letter_add->ref_letter_scanned->Required) { ?>
				felm = this.getElements("x" + infix + "_ref_letter_scanned");
				elm = this.getElements("fn_x" + infix + "_ref_letter_scanned");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $reference_letter_add->ref_letter_scanned->caption(), $reference_letter_add->ref_letter_scanned->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reference_letter_add->ref_letter_date->Required) { ?>
				elm = this.getElements("x" + infix + "_ref_letter_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reference_letter_add->ref_letter_date->caption(), $reference_letter_add->ref_letter_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ref_letter_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($reference_letter_add->ref_letter_date->errorMessage()) ?>");
			<?php if ($reference_letter_add->ref_letter_comments->Required) { ?>
				elm = this.getElements("x" + infix + "_ref_letter_comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reference_letter_add->ref_letter_comments->caption(), $reference_letter_add->ref_letter_comments->RequiredErrorMessage)) ?>");
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
	freference_letteradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freference_letteradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freference_letteradd.lists["x_ref_letter_branch_id"] = <?php echo $reference_letter_add->ref_letter_branch_id->Lookup->toClientList($reference_letter_add) ?>;
	freference_letteradd.lists["x_ref_letter_branch_id"].options = <?php echo JsonEncode($reference_letter_add->ref_letter_branch_id->lookupOptions()) ?>;
	loadjs.done("freference_letteradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $reference_letter_add->showPageHeader(); ?>
<?php
$reference_letter_add->showMessage();
?>
<form name="freference_letteradd" id="freference_letteradd" class="<?php echo $reference_letter_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="reference_letter">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$reference_letter_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($reference_letter_add->ref_letter_branch_id->Visible) { // ref_letter_branch_id ?>
	<div id="r_ref_letter_branch_id" class="form-group row">
		<label id="elh_reference_letter_ref_letter_branch_id" for="x_ref_letter_branch_id" class="<?php echo $reference_letter_add->LeftColumnClass ?>"><?php echo $reference_letter_add->ref_letter_branch_id->caption() ?><?php echo $reference_letter_add->ref_letter_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_add->RightColumnClass ?>"><div <?php echo $reference_letter_add->ref_letter_branch_id->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_branch_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($reference_letter_add->ref_letter_branch_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $reference_letter_add->ref_letter_branch_id->ViewValue ?></button>
		<div id="dsl_x_ref_letter_branch_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $reference_letter_add->ref_letter_branch_id->radioButtonListHtml(TRUE, "x_ref_letter_branch_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_ref_letter_branch_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="reference_letter" data-field="x_ref_letter_branch_id" data-value-separator="<?php echo $reference_letter_add->ref_letter_branch_id->displayValueSeparatorAttribute() ?>" name="x_ref_letter_branch_id" id="x_ref_letter_branch_id" value="{value}"<?php echo $reference_letter_add->ref_letter_branch_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$reference_letter_add->ref_letter_branch_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $reference_letter_add->ref_letter_branch_id->Lookup->getParamTag($reference_letter_add, "p_x_ref_letter_branch_id") ?>
</span>
<?php echo $reference_letter_add->ref_letter_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reference_letter_add->ref_letter_to_whom->Visible) { // ref_letter_to_whom ?>
	<div id="r_ref_letter_to_whom" class="form-group row">
		<label id="elh_reference_letter_ref_letter_to_whom" for="x_ref_letter_to_whom" class="<?php echo $reference_letter_add->LeftColumnClass ?>"><?php echo $reference_letter_add->ref_letter_to_whom->caption() ?><?php echo $reference_letter_add->ref_letter_to_whom->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_add->RightColumnClass ?>"><div <?php echo $reference_letter_add->ref_letter_to_whom->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_to_whom">
<input type="text" data-table="reference_letter" data-field="x_ref_letter_to_whom" name="x_ref_letter_to_whom" id="x_ref_letter_to_whom" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($reference_letter_add->ref_letter_to_whom->getPlaceHolder()) ?>" value="<?php echo $reference_letter_add->ref_letter_to_whom->EditValue ?>"<?php echo $reference_letter_add->ref_letter_to_whom->editAttributes() ?>>
</span>
<?php echo $reference_letter_add->ref_letter_to_whom->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reference_letter_add->ref_letter_by_whom->Visible) { // ref_letter_by_whom ?>
	<div id="r_ref_letter_by_whom" class="form-group row">
		<label id="elh_reference_letter_ref_letter_by_whom" for="x_ref_letter_by_whom" class="<?php echo $reference_letter_add->LeftColumnClass ?>"><?php echo $reference_letter_add->ref_letter_by_whom->caption() ?><?php echo $reference_letter_add->ref_letter_by_whom->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_add->RightColumnClass ?>"><div <?php echo $reference_letter_add->ref_letter_by_whom->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_by_whom">
<input type="text" data-table="reference_letter" data-field="x_ref_letter_by_whom" name="x_ref_letter_by_whom" id="x_ref_letter_by_whom" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($reference_letter_add->ref_letter_by_whom->getPlaceHolder()) ?>" value="<?php echo $reference_letter_add->ref_letter_by_whom->EditValue ?>"<?php echo $reference_letter_add->ref_letter_by_whom->editAttributes() ?>>
</span>
<?php echo $reference_letter_add->ref_letter_by_whom->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reference_letter_add->ref_letter_content->Visible) { // ref_letter_content ?>
	<div id="r_ref_letter_content" class="form-group row">
		<label id="elh_reference_letter_ref_letter_content" class="<?php echo $reference_letter_add->LeftColumnClass ?>"><?php echo $reference_letter_add->ref_letter_content->caption() ?><?php echo $reference_letter_add->ref_letter_content->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_add->RightColumnClass ?>"><div <?php echo $reference_letter_add->ref_letter_content->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_content">
<?php $reference_letter_add->ref_letter_content->EditAttrs->appendClass("editor"); ?>
<textarea data-table="reference_letter" data-field="x_ref_letter_content" name="x_ref_letter_content" id="x_ref_letter_content" cols="35" rows="4" placeholder="<?php echo HtmlEncode($reference_letter_add->ref_letter_content->getPlaceHolder()) ?>"<?php echo $reference_letter_add->ref_letter_content->editAttributes() ?>><?php echo $reference_letter_add->ref_letter_content->EditValue ?></textarea>
<script>
loadjs.ready(["freference_letteradd", "editor"], function() {
	ew.createEditor("freference_letteradd", "x_ref_letter_content", 35, 4, <?php echo $reference_letter_add->ref_letter_content->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $reference_letter_add->ref_letter_content->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reference_letter_add->ref_letter_scanned->Visible) { // ref_letter_scanned ?>
	<div id="r_ref_letter_scanned" class="form-group row">
		<label id="elh_reference_letter_ref_letter_scanned" class="<?php echo $reference_letter_add->LeftColumnClass ?>"><?php echo $reference_letter_add->ref_letter_scanned->caption() ?><?php echo $reference_letter_add->ref_letter_scanned->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_add->RightColumnClass ?>"><div <?php echo $reference_letter_add->ref_letter_scanned->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_scanned">
<div id="fd_x_ref_letter_scanned">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $reference_letter_add->ref_letter_scanned->title() ?>" data-table="reference_letter" data-field="x_ref_letter_scanned" name="x_ref_letter_scanned" id="x_ref_letter_scanned" lang="<?php echo CurrentLanguageID() ?>"<?php echo $reference_letter_add->ref_letter_scanned->editAttributes() ?><?php if ($reference_letter_add->ref_letter_scanned->ReadOnly || $reference_letter_add->ref_letter_scanned->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_ref_letter_scanned"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_ref_letter_scanned" id= "fn_x_ref_letter_scanned" value="<?php echo $reference_letter_add->ref_letter_scanned->Upload->FileName ?>">
<input type="hidden" name="fa_x_ref_letter_scanned" id= "fa_x_ref_letter_scanned" value="0">
<input type="hidden" name="fs_x_ref_letter_scanned" id= "fs_x_ref_letter_scanned" value="100">
<input type="hidden" name="fx_x_ref_letter_scanned" id= "fx_x_ref_letter_scanned" value="<?php echo $reference_letter_add->ref_letter_scanned->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_ref_letter_scanned" id= "fm_x_ref_letter_scanned" value="<?php echo $reference_letter_add->ref_letter_scanned->UploadMaxFileSize ?>">
</div>
<table id="ft_x_ref_letter_scanned" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $reference_letter_add->ref_letter_scanned->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reference_letter_add->ref_letter_date->Visible) { // ref_letter_date ?>
	<div id="r_ref_letter_date" class="form-group row">
		<label id="elh_reference_letter_ref_letter_date" for="x_ref_letter_date" class="<?php echo $reference_letter_add->LeftColumnClass ?>"><?php echo $reference_letter_add->ref_letter_date->caption() ?><?php echo $reference_letter_add->ref_letter_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_add->RightColumnClass ?>"><div <?php echo $reference_letter_add->ref_letter_date->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_date">
<input type="text" data-table="reference_letter" data-field="x_ref_letter_date" data-format="2" name="x_ref_letter_date" id="x_ref_letter_date" maxlength="10" placeholder="<?php echo HtmlEncode($reference_letter_add->ref_letter_date->getPlaceHolder()) ?>" value="<?php echo $reference_letter_add->ref_letter_date->EditValue ?>"<?php echo $reference_letter_add->ref_letter_date->editAttributes() ?>>
<?php if (!$reference_letter_add->ref_letter_date->ReadOnly && !$reference_letter_add->ref_letter_date->Disabled && !isset($reference_letter_add->ref_letter_date->EditAttrs["readonly"]) && !isset($reference_letter_add->ref_letter_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freference_letteradd", "datetimepicker"], function() {
	ew.createDateTimePicker("freference_letteradd", "x_ref_letter_date", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
<?php } ?>
</span>
<?php echo $reference_letter_add->ref_letter_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reference_letter_add->ref_letter_comments->Visible) { // ref_letter_comments ?>
	<div id="r_ref_letter_comments" class="form-group row">
		<label id="elh_reference_letter_ref_letter_comments" class="<?php echo $reference_letter_add->LeftColumnClass ?>"><?php echo $reference_letter_add->ref_letter_comments->caption() ?><?php echo $reference_letter_add->ref_letter_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reference_letter_add->RightColumnClass ?>"><div <?php echo $reference_letter_add->ref_letter_comments->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_comments">
<?php $reference_letter_add->ref_letter_comments->EditAttrs->appendClass("editor"); ?>
<textarea data-table="reference_letter" data-field="x_ref_letter_comments" name="x_ref_letter_comments" id="x_ref_letter_comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($reference_letter_add->ref_letter_comments->getPlaceHolder()) ?>"<?php echo $reference_letter_add->ref_letter_comments->editAttributes() ?>><?php echo $reference_letter_add->ref_letter_comments->EditValue ?></textarea>
<script>
loadjs.ready(["freference_letteradd", "editor"], function() {
	ew.createEditor("freference_letteradd", "x_ref_letter_comments", 35, 4, <?php echo $reference_letter_add->ref_letter_comments->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $reference_letter_add->ref_letter_comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$reference_letter_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $reference_letter_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $reference_letter_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$reference_letter_add->showPageFooter();
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
$reference_letter_add->terminate();
?>