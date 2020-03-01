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
$business_addopt = new business_addopt();

// Run the page
$business_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_addopt->Page_Render();
?>
<script>
var fbusinessaddopt, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "addopt";
	fbusinessaddopt = currentForm = new ew.Form("fbusinessaddopt", "addopt");

	// Validate form
	fbusinessaddopt.validate = function() {
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
			<?php if ($business_addopt->b_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_b_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_branch_id->caption(), $business_addopt->b_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_b_type_id->Required) { ?>
				elm = this.getElements("x" + infix + "_b_b_type_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_b_type_id->caption(), $business_addopt->b_b_type_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_b_status_id->Required) { ?>
				elm = this.getElements("x" + infix + "_b_b_status_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_b_status_id->caption(), $business_addopt->b_b_status_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_b_nature_id->Required) { ?>
				elm = this.getElements("x" + infix + "_b_b_nature_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_b_nature_id->caption(), $business_addopt->b_b_nature_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_city_id->Required) { ?>
				elm = this.getElements("x" + infix + "_b_city_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_city_id->caption(), $business_addopt->b_city_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_referral_id->Required) { ?>
				elm = this.getElements("x" + infix + "_b_referral_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_referral_id->caption(), $business_addopt->b_referral_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_name->Required) { ?>
				elm = this.getElements("x" + infix + "_b_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_name->caption(), $business_addopt->b_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_owner->Required) { ?>
				elm = this.getElements("x" + infix + "_b_owner");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_owner->caption(), $business_addopt->b_owner->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_contact->Required) { ?>
				elm = this.getElements("x" + infix + "_b_contact");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_contact->caption(), $business_addopt->b_contact->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_address->Required) { ?>
				elm = this.getElements("x" + infix + "_b_address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_address->caption(), $business_addopt->b_address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_email->Required) { ?>
				elm = this.getElements("x" + infix + "_b_email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_email->caption(), $business_addopt->b_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_ntn->Required) { ?>
				elm = this.getElements("x" + infix + "_b_ntn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_ntn->caption(), $business_addopt->b_ntn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_logo->Required) { ?>
				felm = this.getElements("x" + infix + "_b_logo");
				elm = this.getElements("fn_x" + infix + "_b_logo");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_logo->caption(), $business_addopt->b_logo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_no_of_emp->Required) { ?>
				elm = this.getElements("x" + infix + "_b_no_of_emp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_no_of_emp->caption(), $business_addopt->b_no_of_emp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_b_no_of_emp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_addopt->b_no_of_emp->errorMessage()) ?>");
			<?php if ($business_addopt->b_since->Required) { ?>
				elm = this.getElements("x" + infix + "_b_since");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_since->caption(), $business_addopt->b_since->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_no_of_branches->Required) { ?>
				elm = this.getElements("x" + infix + "_b_no_of_branches");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_no_of_branches->caption(), $business_addopt->b_no_of_branches->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_b_no_of_branches");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_addopt->b_no_of_branches->errorMessage()) ?>");
			<?php if ($business_addopt->b_deal_with_referral->Required) { ?>
				elm = this.getElements("x" + infix + "_b_deal_with_referral");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_deal_with_referral->caption(), $business_addopt->b_deal_with_referral->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_addopt->b_comments->Required) { ?>
				elm = this.getElements("x" + infix + "_b_comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_addopt->b_comments->caption(), $business_addopt->b_comments->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fbusinessaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbusinessaddopt.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbusinessaddopt.lists["x_b_branch_id"] = <?php echo $business_addopt->b_branch_id->Lookup->toClientList($business_addopt) ?>;
	fbusinessaddopt.lists["x_b_branch_id"].options = <?php echo JsonEncode($business_addopt->b_branch_id->lookupOptions()) ?>;
	fbusinessaddopt.lists["x_b_b_type_id"] = <?php echo $business_addopt->b_b_type_id->Lookup->toClientList($business_addopt) ?>;
	fbusinessaddopt.lists["x_b_b_type_id"].options = <?php echo JsonEncode($business_addopt->b_b_type_id->lookupOptions()) ?>;
	fbusinessaddopt.lists["x_b_b_status_id"] = <?php echo $business_addopt->b_b_status_id->Lookup->toClientList($business_addopt) ?>;
	fbusinessaddopt.lists["x_b_b_status_id"].options = <?php echo JsonEncode($business_addopt->b_b_status_id->lookupOptions()) ?>;
	fbusinessaddopt.lists["x_b_b_nature_id"] = <?php echo $business_addopt->b_b_nature_id->Lookup->toClientList($business_addopt) ?>;
	fbusinessaddopt.lists["x_b_b_nature_id"].options = <?php echo JsonEncode($business_addopt->b_b_nature_id->lookupOptions()) ?>;
	fbusinessaddopt.lists["x_b_city_id"] = <?php echo $business_addopt->b_city_id->Lookup->toClientList($business_addopt) ?>;
	fbusinessaddopt.lists["x_b_city_id"].options = <?php echo JsonEncode($business_addopt->b_city_id->lookupOptions()) ?>;
	fbusinessaddopt.lists["x_b_referral_id"] = <?php echo $business_addopt->b_referral_id->Lookup->toClientList($business_addopt) ?>;
	fbusinessaddopt.lists["x_b_referral_id"].options = <?php echo JsonEncode($business_addopt->b_referral_id->lookupOptions()) ?>;
	loadjs.done("fbusinessaddopt");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_addopt->showPageHeader(); ?>
<?php
$business_addopt->showMessage();
?>
<form name="fbusinessaddopt" id="fbusinessaddopt" class="ew-form ew-horizontal" action="<?php echo Config("API_URL") ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="<?php echo Config("API_ACTION_NAME") ?>" id="<?php echo Config("API_ACTION_NAME") ?>" value="<?php echo Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?php echo Config("API_OBJECT_NAME") ?>" id="<?php echo Config("API_OBJECT_NAME") ?>" value="<?php echo $business_addopt->TableVar ?>">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($business_addopt->b_branch_id->Visible) { // b_branch_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_branch_id"><?php echo $business_addopt->b_branch_id->caption() ?><?php echo $business_addopt->b_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($business_addopt->b_branch_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $business_addopt->b_branch_id->ViewValue ?></button>
		<div id="dsl_x_b_branch_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $business_addopt->b_branch_id->radioButtonListHtml(TRUE, "x_b_branch_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_b_branch_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="business" data-field="x_b_branch_id" data-value-separator="<?php echo $business_addopt->b_branch_id->displayValueSeparatorAttribute() ?>" name="x_b_branch_id" id="x_b_branch_id" value="{value}"<?php echo $business_addopt->b_branch_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$business_addopt->b_branch_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $business_addopt->b_branch_id->Lookup->getParamTag($business_addopt, "p_x_b_branch_id") ?>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_b_type_id->Visible) { // b_b_type_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_b_type_id"><?php echo $business_addopt->b_b_type_id->caption() ?><?php echo $business_addopt->b_b_type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_b_b_type_id"><?php echo EmptyValue(strval($business_addopt->b_b_type_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $business_addopt->b_b_type_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($business_addopt->b_b_type_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($business_addopt->b_b_type_id->ReadOnly || $business_addopt->b_b_type_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_b_b_type_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $business_addopt->b_b_type_id->Lookup->getParamTag($business_addopt, "p_x_b_b_type_id") ?>
<input type="hidden" data-table="business" data-field="x_b_b_type_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $business_addopt->b_b_type_id->displayValueSeparatorAttribute() ?>" name="x_b_b_type_id" id="x_b_b_type_id" value="<?php echo $business_addopt->b_b_type_id->CurrentValue ?>"<?php echo $business_addopt->b_b_type_id->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_b_status_id->Visible) { // b_b_status_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_b_status_id"><?php echo $business_addopt->b_b_status_id->caption() ?><?php echo $business_addopt->b_b_status_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_b_b_status_id"><?php echo EmptyValue(strval($business_addopt->b_b_status_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $business_addopt->b_b_status_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($business_addopt->b_b_status_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($business_addopt->b_b_status_id->ReadOnly || $business_addopt->b_b_status_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_b_b_status_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $business_addopt->b_b_status_id->Lookup->getParamTag($business_addopt, "p_x_b_b_status_id") ?>
<input type="hidden" data-table="business" data-field="x_b_b_status_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $business_addopt->b_b_status_id->displayValueSeparatorAttribute() ?>" name="x_b_b_status_id" id="x_b_b_status_id" value="<?php echo $business_addopt->b_b_status_id->CurrentValue ?>"<?php echo $business_addopt->b_b_status_id->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_b_nature_id->Visible) { // b_b_nature_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_b_nature_id"><?php echo $business_addopt->b_b_nature_id->caption() ?><?php echo $business_addopt->b_b_nature_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_b_b_nature_id"><?php echo EmptyValue(strval($business_addopt->b_b_nature_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $business_addopt->b_b_nature_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($business_addopt->b_b_nature_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($business_addopt->b_b_nature_id->ReadOnly || $business_addopt->b_b_nature_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_b_b_nature_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $business_addopt->b_b_nature_id->Lookup->getParamTag($business_addopt, "p_x_b_b_nature_id") ?>
<input type="hidden" data-table="business" data-field="x_b_b_nature_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $business_addopt->b_b_nature_id->displayValueSeparatorAttribute() ?>" name="x_b_b_nature_id" id="x_b_b_nature_id" value="<?php echo $business_addopt->b_b_nature_id->CurrentValue ?>"<?php echo $business_addopt->b_b_nature_id->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_city_id->Visible) { // b_city_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_city_id"><?php echo $business_addopt->b_city_id->caption() ?><?php echo $business_addopt->b_city_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_b_city_id"><?php echo EmptyValue(strval($business_addopt->b_city_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $business_addopt->b_city_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($business_addopt->b_city_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($business_addopt->b_city_id->ReadOnly || $business_addopt->b_city_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_b_city_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $business_addopt->b_city_id->Lookup->getParamTag($business_addopt, "p_x_b_city_id") ?>
<input type="hidden" data-table="business" data-field="x_b_city_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $business_addopt->b_city_id->displayValueSeparatorAttribute() ?>" name="x_b_city_id" id="x_b_city_id" value="<?php echo $business_addopt->b_city_id->CurrentValue ?>"<?php echo $business_addopt->b_city_id->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_referral_id->Visible) { // b_referral_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_referral_id"><?php echo $business_addopt->b_referral_id->caption() ?><?php echo $business_addopt->b_referral_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_b_referral_id"><?php echo EmptyValue(strval($business_addopt->b_referral_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $business_addopt->b_referral_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($business_addopt->b_referral_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($business_addopt->b_referral_id->ReadOnly || $business_addopt->b_referral_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_b_referral_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $business_addopt->b_referral_id->Lookup->getParamTag($business_addopt, "p_x_b_referral_id") ?>
<input type="hidden" data-table="business" data-field="x_b_referral_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $business_addopt->b_referral_id->displayValueSeparatorAttribute() ?>" name="x_b_referral_id" id="x_b_referral_id" value="<?php echo $business_addopt->b_referral_id->CurrentValue ?>"<?php echo $business_addopt->b_referral_id->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_name->Visible) { // b_name ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_name"><?php echo $business_addopt->b_name->caption() ?><?php echo $business_addopt->b_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="business" data-field="x_b_name" name="x_b_name" id="x_b_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($business_addopt->b_name->getPlaceHolder()) ?>" value="<?php echo $business_addopt->b_name->EditValue ?>"<?php echo $business_addopt->b_name->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_owner->Visible) { // b_owner ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_owner"><?php echo $business_addopt->b_owner->caption() ?><?php echo $business_addopt->b_owner->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="business" data-field="x_b_owner" name="x_b_owner" id="x_b_owner" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($business_addopt->b_owner->getPlaceHolder()) ?>" value="<?php echo $business_addopt->b_owner->EditValue ?>"<?php echo $business_addopt->b_owner->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_contact->Visible) { // b_contact ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_contact"><?php echo $business_addopt->b_contact->caption() ?><?php echo $business_addopt->b_contact->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="business" data-field="x_b_contact" name="x_b_contact" id="x_b_contact" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($business_addopt->b_contact->getPlaceHolder()) ?>" value="<?php echo $business_addopt->b_contact->EditValue ?>"<?php echo $business_addopt->b_contact->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_address->Visible) { // b_address ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_address"><?php echo $business_addopt->b_address->caption() ?><?php echo $business_addopt->b_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<textarea data-table="business" data-field="x_b_address" name="x_b_address" id="x_b_address" cols="35" rows="4" placeholder="<?php echo HtmlEncode($business_addopt->b_address->getPlaceHolder()) ?>"<?php echo $business_addopt->b_address->editAttributes() ?>><?php echo $business_addopt->b_address->EditValue ?></textarea>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_email->Visible) { // b_email ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_email"><?php echo $business_addopt->b_email->caption() ?><?php echo $business_addopt->b_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="business" data-field="x_b_email" name="x_b_email" id="x_b_email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($business_addopt->b_email->getPlaceHolder()) ?>" value="<?php echo $business_addopt->b_email->EditValue ?>"<?php echo $business_addopt->b_email->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_ntn->Visible) { // b_ntn ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_ntn"><?php echo $business_addopt->b_ntn->caption() ?><?php echo $business_addopt->b_ntn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="business" data-field="x_b_ntn" name="x_b_ntn" id="x_b_ntn" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($business_addopt->b_ntn->getPlaceHolder()) ?>" value="<?php echo $business_addopt->b_ntn->EditValue ?>"<?php echo $business_addopt->b_ntn->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_logo->Visible) { // b_logo ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label"><?php echo $business_addopt->b_logo->caption() ?><?php echo $business_addopt->b_logo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div id="fd_x_b_logo">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $business_addopt->b_logo->title() ?>" data-table="business" data-field="x_b_logo" name="x_b_logo" id="x_b_logo" lang="<?php echo CurrentLanguageID() ?>"<?php echo $business_addopt->b_logo->editAttributes() ?><?php if ($business_addopt->b_logo->ReadOnly || $business_addopt->b_logo->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_b_logo"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_b_logo" id= "fn_x_b_logo" value="<?php echo $business_addopt->b_logo->Upload->FileName ?>">
<input type="hidden" name="fa_x_b_logo" id= "fa_x_b_logo" value="0">
<input type="hidden" name="fs_x_b_logo" id= "fs_x_b_logo" value="100">
<input type="hidden" name="fx_x_b_logo" id= "fx_x_b_logo" value="<?php echo $business_addopt->b_logo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_b_logo" id= "fm_x_b_logo" value="<?php echo $business_addopt->b_logo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_b_logo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_no_of_emp->Visible) { // b_no_of_emp ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_no_of_emp"><?php echo $business_addopt->b_no_of_emp->caption() ?><?php echo $business_addopt->b_no_of_emp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="business" data-field="x_b_no_of_emp" name="x_b_no_of_emp" id="x_b_no_of_emp" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($business_addopt->b_no_of_emp->getPlaceHolder()) ?>" value="<?php echo $business_addopt->b_no_of_emp->EditValue ?>"<?php echo $business_addopt->b_no_of_emp->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_since->Visible) { // b_since ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_since"><?php echo $business_addopt->b_since->caption() ?><?php echo $business_addopt->b_since->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="business" data-field="x_b_since" name="x_b_since" id="x_b_since" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($business_addopt->b_since->getPlaceHolder()) ?>" value="<?php echo $business_addopt->b_since->EditValue ?>"<?php echo $business_addopt->b_since->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_no_of_branches->Visible) { // b_no_of_branches ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_b_no_of_branches"><?php echo $business_addopt->b_no_of_branches->caption() ?><?php echo $business_addopt->b_no_of_branches->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="business" data-field="x_b_no_of_branches" name="x_b_no_of_branches" id="x_b_no_of_branches" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($business_addopt->b_no_of_branches->getPlaceHolder()) ?>" value="<?php echo $business_addopt->b_no_of_branches->EditValue ?>"<?php echo $business_addopt->b_no_of_branches->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_deal_with_referral->Visible) { // b_deal_with_referral ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label"><?php echo $business_addopt->b_deal_with_referral->caption() ?><?php echo $business_addopt->b_deal_with_referral->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<?php $business_addopt->b_deal_with_referral->EditAttrs->appendClass("editor"); ?>
<textarea data-table="business" data-field="x_b_deal_with_referral" name="x_b_deal_with_referral" id="x_b_deal_with_referral" cols="35" rows="4" placeholder="<?php echo HtmlEncode($business_addopt->b_deal_with_referral->getPlaceHolder()) ?>"<?php echo $business_addopt->b_deal_with_referral->editAttributes() ?>><?php echo $business_addopt->b_deal_with_referral->EditValue ?></textarea>
<script>
loadjs.ready(["fbusinessaddopt", "editor"], function() {
	ew.createEditor("fbusinessaddopt", "x_b_deal_with_referral", 0, 0, <?php echo $business_addopt->b_deal_with_referral->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</div>
	</div>
<?php } ?>
<?php if ($business_addopt->b_comments->Visible) { // b_comments ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label"><?php echo $business_addopt->b_comments->caption() ?><?php echo $business_addopt->b_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<?php $business_addopt->b_comments->EditAttrs->appendClass("editor"); ?>
<textarea data-table="business" data-field="x_b_comments" name="x_b_comments" id="x_b_comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($business_addopt->b_comments->getPlaceHolder()) ?>"<?php echo $business_addopt->b_comments->editAttributes() ?>><?php echo $business_addopt->b_comments->EditValue ?></textarea>
<script>
loadjs.ready(["fbusinessaddopt", "editor"], function() {
	ew.createEditor("fbusinessaddopt", "x_b_comments", 0, 0, <?php echo $business_addopt->b_comments->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</div>
	</div>
<?php } ?>
</form>
<?php
$business_addopt->showPageFooter();
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
<?php
$business_addopt->terminate();
?>