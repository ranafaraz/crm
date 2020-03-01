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
$followup_edit = new followup_edit();

// Run the page
$followup_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$followup_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ffollowupedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ffollowupedit = currentForm = new ew.Form("ffollowupedit", "edit");

	// Validate form
	ffollowupedit.validate = function() {
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
			<?php if ($followup_edit->followup_id->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_edit->followup_id->caption(), $followup_edit->followup_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($followup_edit->followup_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_edit->followup_branch_id->caption(), $followup_edit->followup_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($followup_edit->followup_business_id->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_business_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_edit->followup_business_id->caption(), $followup_edit->followup_business_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($followup_edit->followup_by_emp_id->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_by_emp_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_edit->followup_by_emp_id->caption(), $followup_edit->followup_by_emp_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($followup_edit->followup_no_id->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_no_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_edit->followup_no_id->caption(), $followup_edit->followup_no_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($followup_edit->followup_date->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_edit->followup_date->caption(), $followup_edit->followup_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_followup_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($followup_edit->followup_date->errorMessage()) ?>");
			<?php if ($followup_edit->followup_comments->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_edit->followup_comments->caption(), $followup_edit->followup_comments->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($followup_edit->followup_response->Required) { ?>
				elm = this.getElements("x" + infix + "_followup_response");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_edit->followup_response->caption(), $followup_edit->followup_response->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($followup_edit->nxt_FU_date->Required) { ?>
				elm = this.getElements("x" + infix + "_nxt_FU_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_edit->nxt_FU_date->caption(), $followup_edit->nxt_FU_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nxt_FU_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($followup_edit->nxt_FU_date->errorMessage()) ?>");
			<?php if ($followup_edit->nxt_FU_plans->Required) { ?>
				elm = this.getElements("x" + infix + "_nxt_FU_plans");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_edit->nxt_FU_plans->caption(), $followup_edit->nxt_FU_plans->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($followup_edit->current_FU_status->Required) { ?>
				elm = this.getElements("x" + infix + "_current_FU_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $followup_edit->current_FU_status->caption(), $followup_edit->current_FU_status->RequiredErrorMessage)) ?>");
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
	ffollowupedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ffollowupedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ffollowupedit.lists["x_followup_branch_id"] = <?php echo $followup_edit->followup_branch_id->Lookup->toClientList($followup_edit) ?>;
	ffollowupedit.lists["x_followup_branch_id"].options = <?php echo JsonEncode($followup_edit->followup_branch_id->lookupOptions()) ?>;
	ffollowupedit.lists["x_followup_business_id"] = <?php echo $followup_edit->followup_business_id->Lookup->toClientList($followup_edit) ?>;
	ffollowupedit.lists["x_followup_business_id"].options = <?php echo JsonEncode($followup_edit->followup_business_id->lookupOptions()) ?>;
	ffollowupedit.lists["x_followup_by_emp_id"] = <?php echo $followup_edit->followup_by_emp_id->Lookup->toClientList($followup_edit) ?>;
	ffollowupedit.lists["x_followup_by_emp_id"].options = <?php echo JsonEncode($followup_edit->followup_by_emp_id->lookupOptions()) ?>;
	ffollowupedit.lists["x_followup_no_id"] = <?php echo $followup_edit->followup_no_id->Lookup->toClientList($followup_edit) ?>;
	ffollowupedit.lists["x_followup_no_id"].options = <?php echo JsonEncode($followup_edit->followup_no_id->lookupOptions()) ?>;
	ffollowupedit.lists["x_followup_response"] = <?php echo $followup_edit->followup_response->Lookup->toClientList($followup_edit) ?>;
	ffollowupedit.lists["x_followup_response"].options = <?php echo JsonEncode($followup_edit->followup_response->options(FALSE, TRUE)) ?>;
	ffollowupedit.lists["x_current_FU_status"] = <?php echo $followup_edit->current_FU_status->Lookup->toClientList($followup_edit) ?>;
	ffollowupedit.lists["x_current_FU_status"].options = <?php echo JsonEncode($followup_edit->current_FU_status->options(FALSE, TRUE)) ?>;
	loadjs.done("ffollowupedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $followup_edit->showPageHeader(); ?>
<?php
$followup_edit->showMessage();
?>
<form name="ffollowupedit" id="ffollowupedit" class="<?php echo $followup_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="followup">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$followup_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($followup_edit->followup_id->Visible) { // followup_id ?>
	<div id="r_followup_id" class="form-group row">
		<label id="elh_followup_followup_id" class="<?php echo $followup_edit->LeftColumnClass ?>"><?php echo $followup_edit->followup_id->caption() ?><?php echo $followup_edit->followup_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_edit->RightColumnClass ?>"><div <?php echo $followup_edit->followup_id->cellAttributes() ?>>
<span id="el_followup_followup_id">
<span<?php echo $followup_edit->followup_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($followup_edit->followup_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="followup" data-field="x_followup_id" name="x_followup_id" id="x_followup_id" value="<?php echo HtmlEncode($followup_edit->followup_id->CurrentValue) ?>">
<?php echo $followup_edit->followup_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_edit->followup_branch_id->Visible) { // followup_branch_id ?>
	<div id="r_followup_branch_id" class="form-group row">
		<label id="elh_followup_followup_branch_id" for="x_followup_branch_id" class="<?php echo $followup_edit->LeftColumnClass ?>"><?php echo $followup_edit->followup_branch_id->caption() ?><?php echo $followup_edit->followup_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_edit->RightColumnClass ?>"><div <?php echo $followup_edit->followup_branch_id->cellAttributes() ?>>
<span id="el_followup_followup_branch_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($followup_edit->followup_branch_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $followup_edit->followup_branch_id->ViewValue ?></button>
		<div id="dsl_x_followup_branch_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $followup_edit->followup_branch_id->radioButtonListHtml(TRUE, "x_followup_branch_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_followup_branch_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="followup" data-field="x_followup_branch_id" data-value-separator="<?php echo $followup_edit->followup_branch_id->displayValueSeparatorAttribute() ?>" name="x_followup_branch_id" id="x_followup_branch_id" value="{value}"<?php echo $followup_edit->followup_branch_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$followup_edit->followup_branch_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $followup_edit->followup_branch_id->Lookup->getParamTag($followup_edit, "p_x_followup_branch_id") ?>
</span>
<?php echo $followup_edit->followup_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_edit->followup_business_id->Visible) { // followup_business_id ?>
	<div id="r_followup_business_id" class="form-group row">
		<label id="elh_followup_followup_business_id" for="x_followup_business_id" class="<?php echo $followup_edit->LeftColumnClass ?>"><?php echo $followup_edit->followup_business_id->caption() ?><?php echo $followup_edit->followup_business_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_edit->RightColumnClass ?>"><div <?php echo $followup_edit->followup_business_id->cellAttributes() ?>>
<span id="el_followup_followup_business_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($followup_edit->followup_business_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $followup_edit->followup_business_id->ViewValue ?></button>
		<div id="dsl_x_followup_business_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $followup_edit->followup_business_id->radioButtonListHtml(TRUE, "x_followup_business_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_followup_business_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="followup" data-field="x_followup_business_id" data-value-separator="<?php echo $followup_edit->followup_business_id->displayValueSeparatorAttribute() ?>" name="x_followup_business_id" id="x_followup_business_id" value="{value}"<?php echo $followup_edit->followup_business_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$followup_edit->followup_business_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $followup_edit->followup_business_id->Lookup->getParamTag($followup_edit, "p_x_followup_business_id") ?>
</span>
<?php echo $followup_edit->followup_business_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_edit->followup_by_emp_id->Visible) { // followup_by_emp_id ?>
	<div id="r_followup_by_emp_id" class="form-group row">
		<label id="elh_followup_followup_by_emp_id" for="x_followup_by_emp_id" class="<?php echo $followup_edit->LeftColumnClass ?>"><?php echo $followup_edit->followup_by_emp_id->caption() ?><?php echo $followup_edit->followup_by_emp_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_edit->RightColumnClass ?>"><div <?php echo $followup_edit->followup_by_emp_id->cellAttributes() ?>>
<span id="el_followup_followup_by_emp_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($followup_edit->followup_by_emp_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $followup_edit->followup_by_emp_id->ViewValue ?></button>
		<div id="dsl_x_followup_by_emp_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $followup_edit->followup_by_emp_id->radioButtonListHtml(TRUE, "x_followup_by_emp_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_followup_by_emp_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="followup" data-field="x_followup_by_emp_id" data-value-separator="<?php echo $followup_edit->followup_by_emp_id->displayValueSeparatorAttribute() ?>" name="x_followup_by_emp_id" id="x_followup_by_emp_id" value="{value}"<?php echo $followup_edit->followup_by_emp_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$followup_edit->followup_by_emp_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $followup_edit->followup_by_emp_id->Lookup->getParamTag($followup_edit, "p_x_followup_by_emp_id") ?>
</span>
<?php echo $followup_edit->followup_by_emp_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_edit->followup_no_id->Visible) { // followup_no_id ?>
	<div id="r_followup_no_id" class="form-group row">
		<label id="elh_followup_followup_no_id" for="x_followup_no_id" class="<?php echo $followup_edit->LeftColumnClass ?>"><?php echo $followup_edit->followup_no_id->caption() ?><?php echo $followup_edit->followup_no_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_edit->RightColumnClass ?>"><div <?php echo $followup_edit->followup_no_id->cellAttributes() ?>>
<span id="el_followup_followup_no_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($followup_edit->followup_no_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $followup_edit->followup_no_id->ViewValue ?></button>
		<div id="dsl_x_followup_no_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $followup_edit->followup_no_id->radioButtonListHtml(TRUE, "x_followup_no_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_followup_no_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="followup" data-field="x_followup_no_id" data-value-separator="<?php echo $followup_edit->followup_no_id->displayValueSeparatorAttribute() ?>" name="x_followup_no_id" id="x_followup_no_id" value="{value}"<?php echo $followup_edit->followup_no_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$followup_edit->followup_no_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $followup_edit->followup_no_id->Lookup->getParamTag($followup_edit, "p_x_followup_no_id") ?>
</span>
<?php echo $followup_edit->followup_no_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_edit->followup_date->Visible) { // followup_date ?>
	<div id="r_followup_date" class="form-group row">
		<label id="elh_followup_followup_date" for="x_followup_date" class="<?php echo $followup_edit->LeftColumnClass ?>"><?php echo $followup_edit->followup_date->caption() ?><?php echo $followup_edit->followup_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_edit->RightColumnClass ?>"><div <?php echo $followup_edit->followup_date->cellAttributes() ?>>
<span id="el_followup_followup_date">
<input type="text" data-table="followup" data-field="x_followup_date" name="x_followup_date" id="x_followup_date" maxlength="19" placeholder="<?php echo HtmlEncode($followup_edit->followup_date->getPlaceHolder()) ?>" value="<?php echo $followup_edit->followup_date->EditValue ?>"<?php echo $followup_edit->followup_date->editAttributes() ?>>
<?php if (!$followup_edit->followup_date->ReadOnly && !$followup_edit->followup_date->Disabled && !isset($followup_edit->followup_date->EditAttrs["readonly"]) && !isset($followup_edit->followup_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffollowupedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ffollowupedit", "x_followup_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $followup_edit->followup_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_edit->followup_comments->Visible) { // followup_comments ?>
	<div id="r_followup_comments" class="form-group row">
		<label id="elh_followup_followup_comments" class="<?php echo $followup_edit->LeftColumnClass ?>"><?php echo $followup_edit->followup_comments->caption() ?><?php echo $followup_edit->followup_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_edit->RightColumnClass ?>"><div <?php echo $followup_edit->followup_comments->cellAttributes() ?>>
<span id="el_followup_followup_comments">
<?php $followup_edit->followup_comments->EditAttrs->appendClass("editor"); ?>
<textarea data-table="followup" data-field="x_followup_comments" name="x_followup_comments" id="x_followup_comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($followup_edit->followup_comments->getPlaceHolder()) ?>"<?php echo $followup_edit->followup_comments->editAttributes() ?>><?php echo $followup_edit->followup_comments->EditValue ?></textarea>
<script>
loadjs.ready(["ffollowupedit", "editor"], function() {
	ew.createEditor("ffollowupedit", "x_followup_comments", 0, 0, <?php echo $followup_edit->followup_comments->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $followup_edit->followup_comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_edit->followup_response->Visible) { // followup_response ?>
	<div id="r_followup_response" class="form-group row">
		<label id="elh_followup_followup_response" class="<?php echo $followup_edit->LeftColumnClass ?>"><?php echo $followup_edit->followup_response->caption() ?><?php echo $followup_edit->followup_response->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_edit->RightColumnClass ?>"><div <?php echo $followup_edit->followup_response->cellAttributes() ?>>
<span id="el_followup_followup_response">
<div id="tp_x_followup_response" class="ew-template"><input type="radio" class="custom-control-input" data-table="followup" data-field="x_followup_response" data-value-separator="<?php echo $followup_edit->followup_response->displayValueSeparatorAttribute() ?>" name="x_followup_response" id="x_followup_response" value="{value}"<?php echo $followup_edit->followup_response->editAttributes() ?>></div>
<div id="dsl_x_followup_response" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $followup_edit->followup_response->radioButtonListHtml(FALSE, "x_followup_response") ?>
</div></div>
</span>
<?php echo $followup_edit->followup_response->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_edit->nxt_FU_date->Visible) { // nxt_FU_date ?>
	<div id="r_nxt_FU_date" class="form-group row">
		<label id="elh_followup_nxt_FU_date" for="x_nxt_FU_date" class="<?php echo $followup_edit->LeftColumnClass ?>"><?php echo $followup_edit->nxt_FU_date->caption() ?><?php echo $followup_edit->nxt_FU_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_edit->RightColumnClass ?>"><div <?php echo $followup_edit->nxt_FU_date->cellAttributes() ?>>
<span id="el_followup_nxt_FU_date">
<input type="text" data-table="followup" data-field="x_nxt_FU_date" data-format="1" name="x_nxt_FU_date" id="x_nxt_FU_date" maxlength="19" placeholder="<?php echo HtmlEncode($followup_edit->nxt_FU_date->getPlaceHolder()) ?>" value="<?php echo $followup_edit->nxt_FU_date->EditValue ?>"<?php echo $followup_edit->nxt_FU_date->editAttributes() ?>>
<?php if (!$followup_edit->nxt_FU_date->ReadOnly && !$followup_edit->nxt_FU_date->Disabled && !isset($followup_edit->nxt_FU_date->EditAttrs["readonly"]) && !isset($followup_edit->nxt_FU_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffollowupedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ffollowupedit", "x_nxt_FU_date", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<?php echo $followup_edit->nxt_FU_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_edit->nxt_FU_plans->Visible) { // nxt_FU_plans ?>
	<div id="r_nxt_FU_plans" class="form-group row">
		<label id="elh_followup_nxt_FU_plans" class="<?php echo $followup_edit->LeftColumnClass ?>"><?php echo $followup_edit->nxt_FU_plans->caption() ?><?php echo $followup_edit->nxt_FU_plans->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_edit->RightColumnClass ?>"><div <?php echo $followup_edit->nxt_FU_plans->cellAttributes() ?>>
<span id="el_followup_nxt_FU_plans">
<?php $followup_edit->nxt_FU_plans->EditAttrs->appendClass("editor"); ?>
<textarea data-table="followup" data-field="x_nxt_FU_plans" name="x_nxt_FU_plans" id="x_nxt_FU_plans" cols="35" rows="4" placeholder="<?php echo HtmlEncode($followup_edit->nxt_FU_plans->getPlaceHolder()) ?>"<?php echo $followup_edit->nxt_FU_plans->editAttributes() ?>><?php echo $followup_edit->nxt_FU_plans->EditValue ?></textarea>
<script>
loadjs.ready(["ffollowupedit", "editor"], function() {
	ew.createEditor("ffollowupedit", "x_nxt_FU_plans", 0, 0, <?php echo $followup_edit->nxt_FU_plans->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $followup_edit->nxt_FU_plans->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($followup_edit->current_FU_status->Visible) { // current_FU_status ?>
	<div id="r_current_FU_status" class="form-group row">
		<label id="elh_followup_current_FU_status" class="<?php echo $followup_edit->LeftColumnClass ?>"><?php echo $followup_edit->current_FU_status->caption() ?><?php echo $followup_edit->current_FU_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $followup_edit->RightColumnClass ?>"><div <?php echo $followup_edit->current_FU_status->cellAttributes() ?>>
<span id="el_followup_current_FU_status">
<div id="tp_x_current_FU_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="followup" data-field="x_current_FU_status" data-value-separator="<?php echo $followup_edit->current_FU_status->displayValueSeparatorAttribute() ?>" name="x_current_FU_status" id="x_current_FU_status" value="{value}"<?php echo $followup_edit->current_FU_status->editAttributes() ?>></div>
<div id="dsl_x_current_FU_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $followup_edit->current_FU_status->radioButtonListHtml(FALSE, "x_current_FU_status") ?>
</div></div>
</span>
<?php echo $followup_edit->current_FU_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$followup_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $followup_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $followup_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$followup_edit->showPageFooter();
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
$followup_edit->terminate();
?>