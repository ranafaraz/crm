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
$branch_add = new branch_add();

// Run the page
$branch_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$branch_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbranchadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fbranchadd = currentForm = new ew.Form("fbranchadd", "add");

	// Validate form
	fbranchadd.validate = function() {
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
			<?php if ($branch_add->branch_org_id->Required) { ?>
				elm = this.getElements("x" + infix + "_branch_org_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $branch_add->branch_org_id->caption(), $branch_add->branch_org_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($branch_add->branch_name->Required) { ?>
				elm = this.getElements("x" + infix + "_branch_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $branch_add->branch_name->caption(), $branch_add->branch_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($branch_add->branch_manager->Required) { ?>
				elm = this.getElements("x" + infix + "_branch_manager");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $branch_add->branch_manager->caption(), $branch_add->branch_manager->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($branch_add->branch_contact->Required) { ?>
				elm = this.getElements("x" + infix + "_branch_contact");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $branch_add->branch_contact->caption(), $branch_add->branch_contact->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($branch_add->branch_address->Required) { ?>
				elm = this.getElements("x" + infix + "_branch_address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $branch_add->branch_address->caption(), $branch_add->branch_address->RequiredErrorMessage)) ?>");
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
	fbranchadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbranchadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbranchadd.lists["x_branch_org_id"] = <?php echo $branch_add->branch_org_id->Lookup->toClientList($branch_add) ?>;
	fbranchadd.lists["x_branch_org_id"].options = <?php echo JsonEncode($branch_add->branch_org_id->lookupOptions()) ?>;
	loadjs.done("fbranchadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $branch_add->showPageHeader(); ?>
<?php
$branch_add->showMessage();
?>
<form name="fbranchadd" id="fbranchadd" class="<?php echo $branch_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="branch">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$branch_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($branch_add->branch_org_id->Visible) { // branch_org_id ?>
	<div id="r_branch_org_id" class="form-group row">
		<label id="elh_branch_branch_org_id" for="x_branch_org_id" class="<?php echo $branch_add->LeftColumnClass ?>"><?php echo $branch_add->branch_org_id->caption() ?><?php echo $branch_add->branch_org_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $branch_add->RightColumnClass ?>"><div <?php echo $branch_add->branch_org_id->cellAttributes() ?>>
<span id="el_branch_branch_org_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($branch_add->branch_org_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $branch_add->branch_org_id->ViewValue ?></button>
		<div id="dsl_x_branch_org_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $branch_add->branch_org_id->radioButtonListHtml(TRUE, "x_branch_org_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_branch_org_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="branch" data-field="x_branch_org_id" data-value-separator="<?php echo $branch_add->branch_org_id->displayValueSeparatorAttribute() ?>" name="x_branch_org_id" id="x_branch_org_id" value="{value}"<?php echo $branch_add->branch_org_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$branch_add->branch_org_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $branch_add->branch_org_id->Lookup->getParamTag($branch_add, "p_x_branch_org_id") ?>
</span>
<?php echo $branch_add->branch_org_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($branch_add->branch_name->Visible) { // branch_name ?>
	<div id="r_branch_name" class="form-group row">
		<label id="elh_branch_branch_name" for="x_branch_name" class="<?php echo $branch_add->LeftColumnClass ?>"><?php echo $branch_add->branch_name->caption() ?><?php echo $branch_add->branch_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $branch_add->RightColumnClass ?>"><div <?php echo $branch_add->branch_name->cellAttributes() ?>>
<span id="el_branch_branch_name">
<input type="text" data-table="branch" data-field="x_branch_name" name="x_branch_name" id="x_branch_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($branch_add->branch_name->getPlaceHolder()) ?>" value="<?php echo $branch_add->branch_name->EditValue ?>"<?php echo $branch_add->branch_name->editAttributes() ?>>
</span>
<?php echo $branch_add->branch_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($branch_add->branch_manager->Visible) { // branch_manager ?>
	<div id="r_branch_manager" class="form-group row">
		<label id="elh_branch_branch_manager" for="x_branch_manager" class="<?php echo $branch_add->LeftColumnClass ?>"><?php echo $branch_add->branch_manager->caption() ?><?php echo $branch_add->branch_manager->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $branch_add->RightColumnClass ?>"><div <?php echo $branch_add->branch_manager->cellAttributes() ?>>
<span id="el_branch_branch_manager">
<input type="text" data-table="branch" data-field="x_branch_manager" name="x_branch_manager" id="x_branch_manager" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($branch_add->branch_manager->getPlaceHolder()) ?>" value="<?php echo $branch_add->branch_manager->EditValue ?>"<?php echo $branch_add->branch_manager->editAttributes() ?>>
</span>
<?php echo $branch_add->branch_manager->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($branch_add->branch_contact->Visible) { // branch_contact ?>
	<div id="r_branch_contact" class="form-group row">
		<label id="elh_branch_branch_contact" for="x_branch_contact" class="<?php echo $branch_add->LeftColumnClass ?>"><?php echo $branch_add->branch_contact->caption() ?><?php echo $branch_add->branch_contact->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $branch_add->RightColumnClass ?>"><div <?php echo $branch_add->branch_contact->cellAttributes() ?>>
<span id="el_branch_branch_contact">
<input type="text" data-table="branch" data-field="x_branch_contact" name="x_branch_contact" id="x_branch_contact" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($branch_add->branch_contact->getPlaceHolder()) ?>" value="<?php echo $branch_add->branch_contact->EditValue ?>"<?php echo $branch_add->branch_contact->editAttributes() ?>>
</span>
<?php echo $branch_add->branch_contact->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($branch_add->branch_address->Visible) { // branch_address ?>
	<div id="r_branch_address" class="form-group row">
		<label id="elh_branch_branch_address" for="x_branch_address" class="<?php echo $branch_add->LeftColumnClass ?>"><?php echo $branch_add->branch_address->caption() ?><?php echo $branch_add->branch_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $branch_add->RightColumnClass ?>"><div <?php echo $branch_add->branch_address->cellAttributes() ?>>
<span id="el_branch_branch_address">
<textarea data-table="branch" data-field="x_branch_address" name="x_branch_address" id="x_branch_address" cols="35" rows="4" placeholder="<?php echo HtmlEncode($branch_add->branch_address->getPlaceHolder()) ?>"<?php echo $branch_add->branch_address->editAttributes() ?>><?php echo $branch_add->branch_address->EditValue ?></textarea>
</span>
<?php echo $branch_add->branch_address->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$branch_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $branch_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $branch_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$branch_add->showPageFooter();
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
$branch_add->terminate();
?>