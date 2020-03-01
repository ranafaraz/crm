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
$services_availed_by_customer_edit = new services_availed_by_customer_edit();

// Run the page
$services_availed_by_customer_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$services_availed_by_customer_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fservices_availed_by_customeredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fservices_availed_by_customeredit = currentForm = new ew.Form("fservices_availed_by_customeredit", "edit");

	// Validate form
	fservices_availed_by_customeredit.validate = function() {
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
			<?php if ($services_availed_by_customer_edit->sabc_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sabc_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_availed_by_customer_edit->sabc_id->caption(), $services_availed_by_customer_edit->sabc_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($services_availed_by_customer_edit->sabc_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sabc_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_availed_by_customer_edit->sabc_branch_id->caption(), $services_availed_by_customer_edit->sabc_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($services_availed_by_customer_edit->sabc_business_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sabc_business_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_availed_by_customer_edit->sabc_business_id->caption(), $services_availed_by_customer_edit->sabc_business_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($services_availed_by_customer_edit->sabc_service_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sabc_service_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_availed_by_customer_edit->sabc_service_id->caption(), $services_availed_by_customer_edit->sabc_service_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($services_availed_by_customer_edit->sabc_pkg->Required) { ?>
				elm = this.getElements("x" + infix + "_sabc_pkg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_availed_by_customer_edit->sabc_pkg->caption(), $services_availed_by_customer_edit->sabc_pkg->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($services_availed_by_customer_edit->sabc_amount->Required) { ?>
				elm = this.getElements("x" + infix + "_sabc_amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_availed_by_customer_edit->sabc_amount->caption(), $services_availed_by_customer_edit->sabc_amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sabc_amount");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($services_availed_by_customer_edit->sabc_amount->errorMessage()) ?>");
			<?php if ($services_availed_by_customer_edit->sabc_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_sabc_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_availed_by_customer_edit->sabc_desc->caption(), $services_availed_by_customer_edit->sabc_desc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($services_availed_by_customer_edit->sabc_signed_on->Required) { ?>
				elm = this.getElements("x" + infix + "_sabc_signed_on");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $services_availed_by_customer_edit->sabc_signed_on->caption(), $services_availed_by_customer_edit->sabc_signed_on->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sabc_signed_on");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($services_availed_by_customer_edit->sabc_signed_on->errorMessage()) ?>");

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
	fservices_availed_by_customeredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fservices_availed_by_customeredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fservices_availed_by_customeredit.lists["x_sabc_branch_id"] = <?php echo $services_availed_by_customer_edit->sabc_branch_id->Lookup->toClientList($services_availed_by_customer_edit) ?>;
	fservices_availed_by_customeredit.lists["x_sabc_branch_id"].options = <?php echo JsonEncode($services_availed_by_customer_edit->sabc_branch_id->lookupOptions()) ?>;
	fservices_availed_by_customeredit.lists["x_sabc_business_id"] = <?php echo $services_availed_by_customer_edit->sabc_business_id->Lookup->toClientList($services_availed_by_customer_edit) ?>;
	fservices_availed_by_customeredit.lists["x_sabc_business_id"].options = <?php echo JsonEncode($services_availed_by_customer_edit->sabc_business_id->lookupOptions()) ?>;
	fservices_availed_by_customeredit.lists["x_sabc_service_id"] = <?php echo $services_availed_by_customer_edit->sabc_service_id->Lookup->toClientList($services_availed_by_customer_edit) ?>;
	fservices_availed_by_customeredit.lists["x_sabc_service_id"].options = <?php echo JsonEncode($services_availed_by_customer_edit->sabc_service_id->lookupOptions()) ?>;
	fservices_availed_by_customeredit.lists["x_sabc_pkg"] = <?php echo $services_availed_by_customer_edit->sabc_pkg->Lookup->toClientList($services_availed_by_customer_edit) ?>;
	fservices_availed_by_customeredit.lists["x_sabc_pkg"].options = <?php echo JsonEncode($services_availed_by_customer_edit->sabc_pkg->options(FALSE, TRUE)) ?>;
	loadjs.done("fservices_availed_by_customeredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $services_availed_by_customer_edit->showPageHeader(); ?>
<?php
$services_availed_by_customer_edit->showMessage();
?>
<form name="fservices_availed_by_customeredit" id="fservices_availed_by_customeredit" class="<?php echo $services_availed_by_customer_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="services_availed_by_customer">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$services_availed_by_customer_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($services_availed_by_customer_edit->sabc_id->Visible) { // sabc_id ?>
	<div id="r_sabc_id" class="form-group row">
		<label id="elh_services_availed_by_customer_sabc_id" class="<?php echo $services_availed_by_customer_edit->LeftColumnClass ?>"><?php echo $services_availed_by_customer_edit->sabc_id->caption() ?><?php echo $services_availed_by_customer_edit->sabc_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $services_availed_by_customer_edit->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_edit->sabc_id->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_id">
<span<?php echo $services_availed_by_customer_edit->sabc_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($services_availed_by_customer_edit->sabc_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="services_availed_by_customer" data-field="x_sabc_id" name="x_sabc_id" id="x_sabc_id" value="<?php echo HtmlEncode($services_availed_by_customer_edit->sabc_id->CurrentValue) ?>">
<?php echo $services_availed_by_customer_edit->sabc_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($services_availed_by_customer_edit->sabc_branch_id->Visible) { // sabc_branch_id ?>
	<div id="r_sabc_branch_id" class="form-group row">
		<label id="elh_services_availed_by_customer_sabc_branch_id" for="x_sabc_branch_id" class="<?php echo $services_availed_by_customer_edit->LeftColumnClass ?>"><?php echo $services_availed_by_customer_edit->sabc_branch_id->caption() ?><?php echo $services_availed_by_customer_edit->sabc_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $services_availed_by_customer_edit->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_edit->sabc_branch_id->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_branch_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($services_availed_by_customer_edit->sabc_branch_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $services_availed_by_customer_edit->sabc_branch_id->ViewValue ?></button>
		<div id="dsl_x_sabc_branch_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $services_availed_by_customer_edit->sabc_branch_id->radioButtonListHtml(TRUE, "x_sabc_branch_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_sabc_branch_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="services_availed_by_customer" data-field="x_sabc_branch_id" data-value-separator="<?php echo $services_availed_by_customer_edit->sabc_branch_id->displayValueSeparatorAttribute() ?>" name="x_sabc_branch_id" id="x_sabc_branch_id" value="{value}"<?php echo $services_availed_by_customer_edit->sabc_branch_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$services_availed_by_customer_edit->sabc_branch_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $services_availed_by_customer_edit->sabc_branch_id->Lookup->getParamTag($services_availed_by_customer_edit, "p_x_sabc_branch_id") ?>
</span>
<?php echo $services_availed_by_customer_edit->sabc_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($services_availed_by_customer_edit->sabc_business_id->Visible) { // sabc_business_id ?>
	<div id="r_sabc_business_id" class="form-group row">
		<label id="elh_services_availed_by_customer_sabc_business_id" for="x_sabc_business_id" class="<?php echo $services_availed_by_customer_edit->LeftColumnClass ?>"><?php echo $services_availed_by_customer_edit->sabc_business_id->caption() ?><?php echo $services_availed_by_customer_edit->sabc_business_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $services_availed_by_customer_edit->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_edit->sabc_business_id->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_business_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_sabc_business_id"><?php echo EmptyValue(strval($services_availed_by_customer_edit->sabc_business_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $services_availed_by_customer_edit->sabc_business_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($services_availed_by_customer_edit->sabc_business_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($services_availed_by_customer_edit->sabc_business_id->ReadOnly || $services_availed_by_customer_edit->sabc_business_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_sabc_business_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
		<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_sabc_business_id" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $services_availed_by_customer_edit->sabc_business_id->caption() ?>" data-title="<?php echo $services_availed_by_customer_edit->sabc_business_id->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_sabc_business_id',url:'businessaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button>
	</div>
</div>
<?php echo $services_availed_by_customer_edit->sabc_business_id->Lookup->getParamTag($services_availed_by_customer_edit, "p_x_sabc_business_id") ?>
<input type="hidden" data-table="services_availed_by_customer" data-field="x_sabc_business_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $services_availed_by_customer_edit->sabc_business_id->displayValueSeparatorAttribute() ?>" name="x_sabc_business_id" id="x_sabc_business_id" value="<?php echo $services_availed_by_customer_edit->sabc_business_id->CurrentValue ?>"<?php echo $services_availed_by_customer_edit->sabc_business_id->editAttributes() ?>>
</span>
<?php echo $services_availed_by_customer_edit->sabc_business_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($services_availed_by_customer_edit->sabc_service_id->Visible) { // sabc_service_id ?>
	<div id="r_sabc_service_id" class="form-group row">
		<label id="elh_services_availed_by_customer_sabc_service_id" for="x_sabc_service_id" class="<?php echo $services_availed_by_customer_edit->LeftColumnClass ?>"><?php echo $services_availed_by_customer_edit->sabc_service_id->caption() ?><?php echo $services_availed_by_customer_edit->sabc_service_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $services_availed_by_customer_edit->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_edit->sabc_service_id->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_service_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_sabc_service_id"><?php echo EmptyValue(strval($services_availed_by_customer_edit->sabc_service_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $services_availed_by_customer_edit->sabc_service_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($services_availed_by_customer_edit->sabc_service_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($services_availed_by_customer_edit->sabc_service_id->ReadOnly || $services_availed_by_customer_edit->sabc_service_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_sabc_service_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $services_availed_by_customer_edit->sabc_service_id->Lookup->getParamTag($services_availed_by_customer_edit, "p_x_sabc_service_id") ?>
<input type="hidden" data-table="services_availed_by_customer" data-field="x_sabc_service_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $services_availed_by_customer_edit->sabc_service_id->displayValueSeparatorAttribute() ?>" name="x_sabc_service_id" id="x_sabc_service_id" value="<?php echo $services_availed_by_customer_edit->sabc_service_id->CurrentValue ?>"<?php echo $services_availed_by_customer_edit->sabc_service_id->editAttributes() ?>>
</span>
<?php echo $services_availed_by_customer_edit->sabc_service_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($services_availed_by_customer_edit->sabc_pkg->Visible) { // sabc_pkg ?>
	<div id="r_sabc_pkg" class="form-group row">
		<label id="elh_services_availed_by_customer_sabc_pkg" class="<?php echo $services_availed_by_customer_edit->LeftColumnClass ?>"><?php echo $services_availed_by_customer_edit->sabc_pkg->caption() ?><?php echo $services_availed_by_customer_edit->sabc_pkg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $services_availed_by_customer_edit->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_edit->sabc_pkg->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_pkg">
<div id="tp_x_sabc_pkg" class="ew-template"><input type="radio" class="custom-control-input" data-table="services_availed_by_customer" data-field="x_sabc_pkg" data-value-separator="<?php echo $services_availed_by_customer_edit->sabc_pkg->displayValueSeparatorAttribute() ?>" name="x_sabc_pkg" id="x_sabc_pkg" value="{value}"<?php echo $services_availed_by_customer_edit->sabc_pkg->editAttributes() ?>></div>
<div id="dsl_x_sabc_pkg" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $services_availed_by_customer_edit->sabc_pkg->radioButtonListHtml(FALSE, "x_sabc_pkg") ?>
</div></div>
</span>
<?php echo $services_availed_by_customer_edit->sabc_pkg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($services_availed_by_customer_edit->sabc_amount->Visible) { // sabc_amount ?>
	<div id="r_sabc_amount" class="form-group row">
		<label id="elh_services_availed_by_customer_sabc_amount" for="x_sabc_amount" class="<?php echo $services_availed_by_customer_edit->LeftColumnClass ?>"><?php echo $services_availed_by_customer_edit->sabc_amount->caption() ?><?php echo $services_availed_by_customer_edit->sabc_amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $services_availed_by_customer_edit->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_edit->sabc_amount->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_amount">
<input type="text" data-table="services_availed_by_customer" data-field="x_sabc_amount" name="x_sabc_amount" id="x_sabc_amount" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($services_availed_by_customer_edit->sabc_amount->getPlaceHolder()) ?>" value="<?php echo $services_availed_by_customer_edit->sabc_amount->EditValue ?>"<?php echo $services_availed_by_customer_edit->sabc_amount->editAttributes() ?>>
</span>
<?php echo $services_availed_by_customer_edit->sabc_amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($services_availed_by_customer_edit->sabc_desc->Visible) { // sabc_desc ?>
	<div id="r_sabc_desc" class="form-group row">
		<label id="elh_services_availed_by_customer_sabc_desc" class="<?php echo $services_availed_by_customer_edit->LeftColumnClass ?>"><?php echo $services_availed_by_customer_edit->sabc_desc->caption() ?><?php echo $services_availed_by_customer_edit->sabc_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $services_availed_by_customer_edit->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_edit->sabc_desc->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_desc">
<?php $services_availed_by_customer_edit->sabc_desc->EditAttrs->appendClass("editor"); ?>
<textarea data-table="services_availed_by_customer" data-field="x_sabc_desc" name="x_sabc_desc" id="x_sabc_desc" cols="35" rows="4" placeholder="<?php echo HtmlEncode($services_availed_by_customer_edit->sabc_desc->getPlaceHolder()) ?>"<?php echo $services_availed_by_customer_edit->sabc_desc->editAttributes() ?>><?php echo $services_availed_by_customer_edit->sabc_desc->EditValue ?></textarea>
<script>
loadjs.ready(["fservices_availed_by_customeredit", "editor"], function() {
	ew.createEditor("fservices_availed_by_customeredit", "x_sabc_desc", 35, 4, <?php echo $services_availed_by_customer_edit->sabc_desc->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $services_availed_by_customer_edit->sabc_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($services_availed_by_customer_edit->sabc_signed_on->Visible) { // sabc_signed_on ?>
	<div id="r_sabc_signed_on" class="form-group row">
		<label id="elh_services_availed_by_customer_sabc_signed_on" for="x_sabc_signed_on" class="<?php echo $services_availed_by_customer_edit->LeftColumnClass ?>"><?php echo $services_availed_by_customer_edit->sabc_signed_on->caption() ?><?php echo $services_availed_by_customer_edit->sabc_signed_on->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $services_availed_by_customer_edit->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_edit->sabc_signed_on->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_signed_on">
<input type="text" data-table="services_availed_by_customer" data-field="x_sabc_signed_on" data-format="2" name="x_sabc_signed_on" id="x_sabc_signed_on" maxlength="10" placeholder="<?php echo HtmlEncode($services_availed_by_customer_edit->sabc_signed_on->getPlaceHolder()) ?>" value="<?php echo $services_availed_by_customer_edit->sabc_signed_on->EditValue ?>"<?php echo $services_availed_by_customer_edit->sabc_signed_on->editAttributes() ?>>
<?php if (!$services_availed_by_customer_edit->sabc_signed_on->ReadOnly && !$services_availed_by_customer_edit->sabc_signed_on->Disabled && !isset($services_availed_by_customer_edit->sabc_signed_on->EditAttrs["readonly"]) && !isset($services_availed_by_customer_edit->sabc_signed_on->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fservices_availed_by_customeredit", "datetimepicker"], function() {
	ew.createDateTimePicker("fservices_availed_by_customeredit", "x_sabc_signed_on", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
<?php } ?>
</span>
<?php echo $services_availed_by_customer_edit->sabc_signed_on->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$services_availed_by_customer_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $services_availed_by_customer_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $services_availed_by_customer_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$services_availed_by_customer_edit->showPageFooter();
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
$services_availed_by_customer_edit->terminate();
?>