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
$referral_add = new referral_add();

// Run the page
$referral_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$referral_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freferraladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	freferraladd = currentForm = new ew.Form("freferraladd", "add");

	// Validate form
	freferraladd.validate = function() {
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
			<?php if ($referral_add->referral_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_referral_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $referral_add->referral_branch_id->caption(), $referral_add->referral_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($referral_add->referral_name->Required) { ?>
				elm = this.getElements("x" + infix + "_referral_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $referral_add->referral_name->caption(), $referral_add->referral_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($referral_add->referral_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_referral_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $referral_add->referral_desc->caption(), $referral_add->referral_desc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($referral_add->referral_deal_signed->Required) { ?>
				elm = this.getElements("x" + infix + "_referral_deal_signed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $referral_add->referral_deal_signed->caption(), $referral_add->referral_deal_signed->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($referral_add->referral_scanned->Required) { ?>
				felm = this.getElements("x" + infix + "_referral_scanned");
				elm = this.getElements("fn_x" + infix + "_referral_scanned");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $referral_add->referral_scanned->caption(), $referral_add->referral_scanned->RequiredErrorMessage)) ?>");
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
	freferraladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freferraladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freferraladd.lists["x_referral_branch_id"] = <?php echo $referral_add->referral_branch_id->Lookup->toClientList($referral_add) ?>;
	freferraladd.lists["x_referral_branch_id"].options = <?php echo JsonEncode($referral_add->referral_branch_id->lookupOptions()) ?>;
	loadjs.done("freferraladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $referral_add->showPageHeader(); ?>
<?php
$referral_add->showMessage();
?>
<form name="freferraladd" id="freferraladd" class="<?php echo $referral_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="referral">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$referral_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($referral_add->referral_branch_id->Visible) { // referral_branch_id ?>
	<div id="r_referral_branch_id" class="form-group row">
		<label id="elh_referral_referral_branch_id" for="x_referral_branch_id" class="<?php echo $referral_add->LeftColumnClass ?>"><?php echo $referral_add->referral_branch_id->caption() ?><?php echo $referral_add->referral_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $referral_add->RightColumnClass ?>"><div <?php echo $referral_add->referral_branch_id->cellAttributes() ?>>
<span id="el_referral_referral_branch_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($referral_add->referral_branch_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $referral_add->referral_branch_id->ViewValue ?></button>
		<div id="dsl_x_referral_branch_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $referral_add->referral_branch_id->radioButtonListHtml(TRUE, "x_referral_branch_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_referral_branch_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="referral" data-field="x_referral_branch_id" data-value-separator="<?php echo $referral_add->referral_branch_id->displayValueSeparatorAttribute() ?>" name="x_referral_branch_id" id="x_referral_branch_id" value="{value}"<?php echo $referral_add->referral_branch_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$referral_add->referral_branch_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $referral_add->referral_branch_id->Lookup->getParamTag($referral_add, "p_x_referral_branch_id") ?>
</span>
<?php echo $referral_add->referral_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($referral_add->referral_name->Visible) { // referral_name ?>
	<div id="r_referral_name" class="form-group row">
		<label id="elh_referral_referral_name" for="x_referral_name" class="<?php echo $referral_add->LeftColumnClass ?>"><?php echo $referral_add->referral_name->caption() ?><?php echo $referral_add->referral_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $referral_add->RightColumnClass ?>"><div <?php echo $referral_add->referral_name->cellAttributes() ?>>
<span id="el_referral_referral_name">
<input type="text" data-table="referral" data-field="x_referral_name" name="x_referral_name" id="x_referral_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($referral_add->referral_name->getPlaceHolder()) ?>" value="<?php echo $referral_add->referral_name->EditValue ?>"<?php echo $referral_add->referral_name->editAttributes() ?>>
</span>
<?php echo $referral_add->referral_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($referral_add->referral_desc->Visible) { // referral_desc ?>
	<div id="r_referral_desc" class="form-group row">
		<label id="elh_referral_referral_desc" for="x_referral_desc" class="<?php echo $referral_add->LeftColumnClass ?>"><?php echo $referral_add->referral_desc->caption() ?><?php echo $referral_add->referral_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $referral_add->RightColumnClass ?>"><div <?php echo $referral_add->referral_desc->cellAttributes() ?>>
<span id="el_referral_referral_desc">
<input type="text" data-table="referral" data-field="x_referral_desc" name="x_referral_desc" id="x_referral_desc" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($referral_add->referral_desc->getPlaceHolder()) ?>" value="<?php echo $referral_add->referral_desc->EditValue ?>"<?php echo $referral_add->referral_desc->editAttributes() ?>>
</span>
<?php echo $referral_add->referral_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($referral_add->referral_deal_signed->Visible) { // referral_deal_signed ?>
	<div id="r_referral_deal_signed" class="form-group row">
		<label id="elh_referral_referral_deal_signed" class="<?php echo $referral_add->LeftColumnClass ?>"><?php echo $referral_add->referral_deal_signed->caption() ?><?php echo $referral_add->referral_deal_signed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $referral_add->RightColumnClass ?>"><div <?php echo $referral_add->referral_deal_signed->cellAttributes() ?>>
<span id="el_referral_referral_deal_signed">
<?php $referral_add->referral_deal_signed->EditAttrs->appendClass("editor"); ?>
<textarea data-table="referral" data-field="x_referral_deal_signed" name="x_referral_deal_signed" id="x_referral_deal_signed" cols="35" rows="4" placeholder="<?php echo HtmlEncode($referral_add->referral_deal_signed->getPlaceHolder()) ?>"<?php echo $referral_add->referral_deal_signed->editAttributes() ?>><?php echo $referral_add->referral_deal_signed->EditValue ?></textarea>
<script>
loadjs.ready(["freferraladd", "editor"], function() {
	ew.createEditor("freferraladd", "x_referral_deal_signed", 35, 4, <?php echo $referral_add->referral_deal_signed->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $referral_add->referral_deal_signed->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($referral_add->referral_scanned->Visible) { // referral_scanned ?>
	<div id="r_referral_scanned" class="form-group row">
		<label id="elh_referral_referral_scanned" class="<?php echo $referral_add->LeftColumnClass ?>"><?php echo $referral_add->referral_scanned->caption() ?><?php echo $referral_add->referral_scanned->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $referral_add->RightColumnClass ?>"><div <?php echo $referral_add->referral_scanned->cellAttributes() ?>>
<span id="el_referral_referral_scanned">
<div id="fd_x_referral_scanned">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $referral_add->referral_scanned->title() ?>" data-table="referral" data-field="x_referral_scanned" name="x_referral_scanned" id="x_referral_scanned" lang="<?php echo CurrentLanguageID() ?>"<?php echo $referral_add->referral_scanned->editAttributes() ?><?php if ($referral_add->referral_scanned->ReadOnly || $referral_add->referral_scanned->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_referral_scanned"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_referral_scanned" id= "fn_x_referral_scanned" value="<?php echo $referral_add->referral_scanned->Upload->FileName ?>">
<input type="hidden" name="fa_x_referral_scanned" id= "fa_x_referral_scanned" value="0">
<input type="hidden" name="fs_x_referral_scanned" id= "fs_x_referral_scanned" value="500">
<input type="hidden" name="fx_x_referral_scanned" id= "fx_x_referral_scanned" value="<?php echo $referral_add->referral_scanned->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_referral_scanned" id= "fm_x_referral_scanned" value="<?php echo $referral_add->referral_scanned->UploadMaxFileSize ?>">
</div>
<table id="ft_x_referral_scanned" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $referral_add->referral_scanned->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$referral_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $referral_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $referral_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$referral_add->showPageFooter();
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
$referral_add->terminate();
?>