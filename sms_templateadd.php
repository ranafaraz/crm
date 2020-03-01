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
$sms_template_add = new sms_template_add();

// Run the page
$sms_template_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_template_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsms_templateadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fsms_templateadd = currentForm = new ew.Form("fsms_templateadd", "add");

	// Validate form
	fsms_templateadd.validate = function() {
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
			<?php if ($sms_template_add->sms_temp_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_temp_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_template_add->sms_temp_branch_id->caption(), $sms_template_add->sms_temp_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sms_template_add->sms_temp_caption->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_temp_caption");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_template_add->sms_temp_caption->caption(), $sms_template_add->sms_temp_caption->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sms_template_add->sms_temp_msg->Required) { ?>
				elm = this.getElements("x" + infix + "_sms_temp_msg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sms_template_add->sms_temp_msg->caption(), $sms_template_add->sms_temp_msg->RequiredErrorMessage)) ?>");
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
	fsms_templateadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsms_templateadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fsms_templateadd.lists["x_sms_temp_branch_id"] = <?php echo $sms_template_add->sms_temp_branch_id->Lookup->toClientList($sms_template_add) ?>;
	fsms_templateadd.lists["x_sms_temp_branch_id"].options = <?php echo JsonEncode($sms_template_add->sms_temp_branch_id->lookupOptions()) ?>;
	loadjs.done("fsms_templateadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sms_template_add->showPageHeader(); ?>
<?php
$sms_template_add->showMessage();
?>
<form name="fsms_templateadd" id="fsms_templateadd" class="<?php echo $sms_template_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_template">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$sms_template_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($sms_template_add->sms_temp_branch_id->Visible) { // sms_temp_branch_id ?>
	<div id="r_sms_temp_branch_id" class="form-group row">
		<label id="elh_sms_template_sms_temp_branch_id" for="x_sms_temp_branch_id" class="<?php echo $sms_template_add->LeftColumnClass ?>"><?php echo $sms_template_add->sms_temp_branch_id->caption() ?><?php echo $sms_template_add->sms_temp_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_template_add->RightColumnClass ?>"><div <?php echo $sms_template_add->sms_temp_branch_id->cellAttributes() ?>>
<span id="el_sms_template_sms_temp_branch_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($sms_template_add->sms_temp_branch_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $sms_template_add->sms_temp_branch_id->ViewValue ?></button>
		<div id="dsl_x_sms_temp_branch_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $sms_template_add->sms_temp_branch_id->radioButtonListHtml(TRUE, "x_sms_temp_branch_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_sms_temp_branch_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="sms_template" data-field="x_sms_temp_branch_id" data-value-separator="<?php echo $sms_template_add->sms_temp_branch_id->displayValueSeparatorAttribute() ?>" name="x_sms_temp_branch_id" id="x_sms_temp_branch_id" value="{value}"<?php echo $sms_template_add->sms_temp_branch_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$sms_template_add->sms_temp_branch_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $sms_template_add->sms_temp_branch_id->Lookup->getParamTag($sms_template_add, "p_x_sms_temp_branch_id") ?>
</span>
<?php echo $sms_template_add->sms_temp_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_template_add->sms_temp_caption->Visible) { // sms_temp_caption ?>
	<div id="r_sms_temp_caption" class="form-group row">
		<label id="elh_sms_template_sms_temp_caption" for="x_sms_temp_caption" class="<?php echo $sms_template_add->LeftColumnClass ?>"><?php echo $sms_template_add->sms_temp_caption->caption() ?><?php echo $sms_template_add->sms_temp_caption->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_template_add->RightColumnClass ?>"><div <?php echo $sms_template_add->sms_temp_caption->cellAttributes() ?>>
<span id="el_sms_template_sms_temp_caption">
<input type="text" data-table="sms_template" data-field="x_sms_temp_caption" name="x_sms_temp_caption" id="x_sms_temp_caption" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($sms_template_add->sms_temp_caption->getPlaceHolder()) ?>" value="<?php echo $sms_template_add->sms_temp_caption->EditValue ?>"<?php echo $sms_template_add->sms_temp_caption->editAttributes() ?>>
</span>
<?php echo $sms_template_add->sms_temp_caption->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sms_template_add->sms_temp_msg->Visible) { // sms_temp_msg ?>
	<div id="r_sms_temp_msg" class="form-group row">
		<label id="elh_sms_template_sms_temp_msg" class="<?php echo $sms_template_add->LeftColumnClass ?>"><?php echo $sms_template_add->sms_temp_msg->caption() ?><?php echo $sms_template_add->sms_temp_msg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sms_template_add->RightColumnClass ?>"><div <?php echo $sms_template_add->sms_temp_msg->cellAttributes() ?>>
<span id="el_sms_template_sms_temp_msg">
<?php $sms_template_add->sms_temp_msg->EditAttrs->appendClass("editor"); ?>
<textarea data-table="sms_template" data-field="x_sms_temp_msg" name="x_sms_temp_msg" id="x_sms_temp_msg" cols="35" rows="4" placeholder="<?php echo HtmlEncode($sms_template_add->sms_temp_msg->getPlaceHolder()) ?>"<?php echo $sms_template_add->sms_temp_msg->editAttributes() ?>><?php echo $sms_template_add->sms_temp_msg->EditValue ?></textarea>
<script>
loadjs.ready(["fsms_templateadd", "editor"], function() {
	ew.createEditor("fsms_templateadd", "x_sms_temp_msg", 35, 4, <?php echo $sms_template_add->sms_temp_msg->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $sms_template_add->sms_temp_msg->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$sms_template_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $sms_template_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sms_template_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$sms_template_add->showPageFooter();
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
$sms_template_add->terminate();
?>