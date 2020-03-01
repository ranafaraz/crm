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
$cus_support_add = new cus_support_add();

// Run the page
$cus_support_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cus_support_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcus_supportadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcus_supportadd = currentForm = new ew.Form("fcus_supportadd", "add");

	// Validate form
	fcus_supportadd.validate = function() {
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
			<?php if ($cus_support_add->cus_sup_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_add->cus_sup_branch_id->caption(), $cus_support_add->cus_sup_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cus_support_add->cus_sup_emp_id->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_emp_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_add->cus_sup_emp_id->caption(), $cus_support_add->cus_sup_emp_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cus_support_add->cus_sup_query->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_query");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_add->cus_sup_query->caption(), $cus_support_add->cus_sup_query->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cus_support_add->cus_sup_screen_shots->Required) { ?>
				felm = this.getElements("x" + infix + "_cus_sup_screen_shots");
				elm = this.getElements("fn_x" + infix + "_cus_sup_screen_shots");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $cus_support_add->cus_sup_screen_shots->caption(), $cus_support_add->cus_sup_screen_shots->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cus_support_add->cus_sup_date->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_add->cus_sup_date->caption(), $cus_support_add->cus_sup_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_cus_sup_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cus_support_add->cus_sup_date->errorMessage()) ?>");
			<?php if ($cus_support_add->cus_sup_status->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_add->cus_sup_status->caption(), $cus_support_add->cus_sup_status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cus_support_add->cus_sup_comments->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_add->cus_sup_comments->caption(), $cus_support_add->cus_sup_comments->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cus_support_add->cus_sup_resolved_on->Required) { ?>
				elm = this.getElements("x" + infix + "_cus_sup_resolved_on");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cus_support_add->cus_sup_resolved_on->caption(), $cus_support_add->cus_sup_resolved_on->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_cus_sup_resolved_on");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cus_support_add->cus_sup_resolved_on->errorMessage()) ?>");

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
	fcus_supportadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcus_supportadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcus_supportadd.lists["x_cus_sup_branch_id"] = <?php echo $cus_support_add->cus_sup_branch_id->Lookup->toClientList($cus_support_add) ?>;
	fcus_supportadd.lists["x_cus_sup_branch_id"].options = <?php echo JsonEncode($cus_support_add->cus_sup_branch_id->lookupOptions()) ?>;
	fcus_supportadd.lists["x_cus_sup_emp_id"] = <?php echo $cus_support_add->cus_sup_emp_id->Lookup->toClientList($cus_support_add) ?>;
	fcus_supportadd.lists["x_cus_sup_emp_id"].options = <?php echo JsonEncode($cus_support_add->cus_sup_emp_id->lookupOptions()) ?>;
	fcus_supportadd.lists["x_cus_sup_status"] = <?php echo $cus_support_add->cus_sup_status->Lookup->toClientList($cus_support_add) ?>;
	fcus_supportadd.lists["x_cus_sup_status"].options = <?php echo JsonEncode($cus_support_add->cus_sup_status->options(FALSE, TRUE)) ?>;
	loadjs.done("fcus_supportadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cus_support_add->showPageHeader(); ?>
<?php
$cus_support_add->showMessage();
?>
<form name="fcus_supportadd" id="fcus_supportadd" class="<?php echo $cus_support_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cus_support">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$cus_support_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($cus_support_add->cus_sup_branch_id->Visible) { // cus_sup_branch_id ?>
	<div id="r_cus_sup_branch_id" class="form-group row">
		<label id="elh_cus_support_cus_sup_branch_id" for="x_cus_sup_branch_id" class="<?php echo $cus_support_add->LeftColumnClass ?>"><?php echo $cus_support_add->cus_sup_branch_id->caption() ?><?php echo $cus_support_add->cus_sup_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_add->RightColumnClass ?>"><div <?php echo $cus_support_add->cus_sup_branch_id->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_branch_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($cus_support_add->cus_sup_branch_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $cus_support_add->cus_sup_branch_id->ViewValue ?></button>
		<div id="dsl_x_cus_sup_branch_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $cus_support_add->cus_sup_branch_id->radioButtonListHtml(TRUE, "x_cus_sup_branch_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_cus_sup_branch_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="cus_support" data-field="x_cus_sup_branch_id" data-value-separator="<?php echo $cus_support_add->cus_sup_branch_id->displayValueSeparatorAttribute() ?>" name="x_cus_sup_branch_id" id="x_cus_sup_branch_id" value="{value}"<?php echo $cus_support_add->cus_sup_branch_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$cus_support_add->cus_sup_branch_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $cus_support_add->cus_sup_branch_id->Lookup->getParamTag($cus_support_add, "p_x_cus_sup_branch_id") ?>
</span>
<?php echo $cus_support_add->cus_sup_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_add->cus_sup_emp_id->Visible) { // cus_sup_emp_id ?>
	<div id="r_cus_sup_emp_id" class="form-group row">
		<label id="elh_cus_support_cus_sup_emp_id" for="x_cus_sup_emp_id" class="<?php echo $cus_support_add->LeftColumnClass ?>"><?php echo $cus_support_add->cus_sup_emp_id->caption() ?><?php echo $cus_support_add->cus_sup_emp_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_add->RightColumnClass ?>"><div <?php echo $cus_support_add->cus_sup_emp_id->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_emp_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_cus_sup_emp_id"><?php echo EmptyValue(strval($cus_support_add->cus_sup_emp_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $cus_support_add->cus_sup_emp_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($cus_support_add->cus_sup_emp_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($cus_support_add->cus_sup_emp_id->ReadOnly || $cus_support_add->cus_sup_emp_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_cus_sup_emp_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $cus_support_add->cus_sup_emp_id->Lookup->getParamTag($cus_support_add, "p_x_cus_sup_emp_id") ?>
<input type="hidden" data-table="cus_support" data-field="x_cus_sup_emp_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cus_support_add->cus_sup_emp_id->displayValueSeparatorAttribute() ?>" name="x_cus_sup_emp_id" id="x_cus_sup_emp_id" value="<?php echo $cus_support_add->cus_sup_emp_id->CurrentValue ?>"<?php echo $cus_support_add->cus_sup_emp_id->editAttributes() ?>>
</span>
<?php echo $cus_support_add->cus_sup_emp_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_add->cus_sup_query->Visible) { // cus_sup_query ?>
	<div id="r_cus_sup_query" class="form-group row">
		<label id="elh_cus_support_cus_sup_query" class="<?php echo $cus_support_add->LeftColumnClass ?>"><?php echo $cus_support_add->cus_sup_query->caption() ?><?php echo $cus_support_add->cus_sup_query->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_add->RightColumnClass ?>"><div <?php echo $cus_support_add->cus_sup_query->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_query">
<?php $cus_support_add->cus_sup_query->EditAttrs->appendClass("editor"); ?>
<textarea data-table="cus_support" data-field="x_cus_sup_query" name="x_cus_sup_query" id="x_cus_sup_query" cols="35" rows="4" placeholder="<?php echo HtmlEncode($cus_support_add->cus_sup_query->getPlaceHolder()) ?>"<?php echo $cus_support_add->cus_sup_query->editAttributes() ?>><?php echo $cus_support_add->cus_sup_query->EditValue ?></textarea>
<script>
loadjs.ready(["fcus_supportadd", "editor"], function() {
	ew.createEditor("fcus_supportadd", "x_cus_sup_query", 0, 0, <?php echo $cus_support_add->cus_sup_query->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $cus_support_add->cus_sup_query->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_add->cus_sup_screen_shots->Visible) { // cus_sup_screen_shots ?>
	<div id="r_cus_sup_screen_shots" class="form-group row">
		<label id="elh_cus_support_cus_sup_screen_shots" class="<?php echo $cus_support_add->LeftColumnClass ?>"><?php echo $cus_support_add->cus_sup_screen_shots->caption() ?><?php echo $cus_support_add->cus_sup_screen_shots->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_add->RightColumnClass ?>"><div <?php echo $cus_support_add->cus_sup_screen_shots->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_screen_shots">
<div id="fd_x_cus_sup_screen_shots">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $cus_support_add->cus_sup_screen_shots->title() ?>" data-table="cus_support" data-field="x_cus_sup_screen_shots" name="x_cus_sup_screen_shots" id="x_cus_sup_screen_shots" lang="<?php echo CurrentLanguageID() ?>" multiple="multiple"<?php echo $cus_support_add->cus_sup_screen_shots->editAttributes() ?><?php if ($cus_support_add->cus_sup_screen_shots->ReadOnly || $cus_support_add->cus_sup_screen_shots->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_cus_sup_screen_shots"><?php echo $Language->phrase("ChooseFiles") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_cus_sup_screen_shots" id= "fn_x_cus_sup_screen_shots" value="<?php echo $cus_support_add->cus_sup_screen_shots->Upload->FileName ?>">
<input type="hidden" name="fa_x_cus_sup_screen_shots" id= "fa_x_cus_sup_screen_shots" value="0">
<input type="hidden" name="fs_x_cus_sup_screen_shots" id= "fs_x_cus_sup_screen_shots" value="65535">
<input type="hidden" name="fx_x_cus_sup_screen_shots" id= "fx_x_cus_sup_screen_shots" value="<?php echo $cus_support_add->cus_sup_screen_shots->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_cus_sup_screen_shots" id= "fm_x_cus_sup_screen_shots" value="<?php echo $cus_support_add->cus_sup_screen_shots->UploadMaxFileSize ?>">
<input type="hidden" name="fc_x_cus_sup_screen_shots" id= "fc_x_cus_sup_screen_shots" value="<?php echo $cus_support_add->cus_sup_screen_shots->UploadMaxFileCount ?>">
</div>
<table id="ft_x_cus_sup_screen_shots" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $cus_support_add->cus_sup_screen_shots->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_add->cus_sup_date->Visible) { // cus_sup_date ?>
	<div id="r_cus_sup_date" class="form-group row">
		<label id="elh_cus_support_cus_sup_date" for="x_cus_sup_date" class="<?php echo $cus_support_add->LeftColumnClass ?>"><?php echo $cus_support_add->cus_sup_date->caption() ?><?php echo $cus_support_add->cus_sup_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_add->RightColumnClass ?>"><div <?php echo $cus_support_add->cus_sup_date->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_date">
<input type="text" data-table="cus_support" data-field="x_cus_sup_date" data-format="1" name="x_cus_sup_date" id="x_cus_sup_date" maxlength="19" placeholder="<?php echo HtmlEncode($cus_support_add->cus_sup_date->getPlaceHolder()) ?>" value="<?php echo $cus_support_add->cus_sup_date->EditValue ?>"<?php echo $cus_support_add->cus_sup_date->editAttributes() ?>>
<?php if (!$cus_support_add->cus_sup_date->ReadOnly && !$cus_support_add->cus_sup_date->Disabled && !isset($cus_support_add->cus_sup_date->EditAttrs["readonly"]) && !isset($cus_support_add->cus_sup_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcus_supportadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcus_supportadd", "x_cus_sup_date", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<?php echo $cus_support_add->cus_sup_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_add->cus_sup_status->Visible) { // cus_sup_status ?>
	<div id="r_cus_sup_status" class="form-group row">
		<label id="elh_cus_support_cus_sup_status" class="<?php echo $cus_support_add->LeftColumnClass ?>"><?php echo $cus_support_add->cus_sup_status->caption() ?><?php echo $cus_support_add->cus_sup_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_add->RightColumnClass ?>"><div <?php echo $cus_support_add->cus_sup_status->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_status">
<div id="tp_x_cus_sup_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="cus_support" data-field="x_cus_sup_status" data-value-separator="<?php echo $cus_support_add->cus_sup_status->displayValueSeparatorAttribute() ?>" name="x_cus_sup_status" id="x_cus_sup_status" value="{value}"<?php echo $cus_support_add->cus_sup_status->editAttributes() ?>></div>
<div id="dsl_x_cus_sup_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $cus_support_add->cus_sup_status->radioButtonListHtml(FALSE, "x_cus_sup_status") ?>
</div></div>
</span>
<?php echo $cus_support_add->cus_sup_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_add->cus_sup_comments->Visible) { // cus_sup_comments ?>
	<div id="r_cus_sup_comments" class="form-group row">
		<label id="elh_cus_support_cus_sup_comments" class="<?php echo $cus_support_add->LeftColumnClass ?>"><?php echo $cus_support_add->cus_sup_comments->caption() ?><?php echo $cus_support_add->cus_sup_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_add->RightColumnClass ?>"><div <?php echo $cus_support_add->cus_sup_comments->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_comments">
<?php $cus_support_add->cus_sup_comments->EditAttrs->appendClass("editor"); ?>
<textarea data-table="cus_support" data-field="x_cus_sup_comments" name="x_cus_sup_comments" id="x_cus_sup_comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($cus_support_add->cus_sup_comments->getPlaceHolder()) ?>"<?php echo $cus_support_add->cus_sup_comments->editAttributes() ?>><?php echo $cus_support_add->cus_sup_comments->EditValue ?></textarea>
<script>
loadjs.ready(["fcus_supportadd", "editor"], function() {
	ew.createEditor("fcus_supportadd", "x_cus_sup_comments", 35, 4, <?php echo $cus_support_add->cus_sup_comments->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $cus_support_add->cus_sup_comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cus_support_add->cus_sup_resolved_on->Visible) { // cus_sup_resolved_on ?>
	<div id="r_cus_sup_resolved_on" class="form-group row">
		<label id="elh_cus_support_cus_sup_resolved_on" for="x_cus_sup_resolved_on" class="<?php echo $cus_support_add->LeftColumnClass ?>"><?php echo $cus_support_add->cus_sup_resolved_on->caption() ?><?php echo $cus_support_add->cus_sup_resolved_on->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cus_support_add->RightColumnClass ?>"><div <?php echo $cus_support_add->cus_sup_resolved_on->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_resolved_on">
<input type="text" data-table="cus_support" data-field="x_cus_sup_resolved_on" data-format="1" name="x_cus_sup_resolved_on" id="x_cus_sup_resolved_on" maxlength="19" placeholder="<?php echo HtmlEncode($cus_support_add->cus_sup_resolved_on->getPlaceHolder()) ?>" value="<?php echo $cus_support_add->cus_sup_resolved_on->EditValue ?>"<?php echo $cus_support_add->cus_sup_resolved_on->editAttributes() ?>>
<?php if (!$cus_support_add->cus_sup_resolved_on->ReadOnly && !$cus_support_add->cus_sup_resolved_on->Disabled && !isset($cus_support_add->cus_sup_resolved_on->EditAttrs["readonly"]) && !isset($cus_support_add->cus_sup_resolved_on->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcus_supportadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcus_supportadd", "x_cus_sup_resolved_on", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<?php echo $cus_support_add->cus_sup_resolved_on->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cus_support_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cus_support_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cus_support_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cus_support_add->showPageFooter();
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
$cus_support_add->terminate();
?>