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
$business_add = new business_add();

// Run the page
$business_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusinessadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fbusinessadd = currentForm = new ew.Form("fbusinessadd", "add");

	// Validate form
	fbusinessadd.validate = function() {
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
			<?php if ($business_add->b_branch_id->Required) { ?>
				elm = this.getElements("x" + infix + "_b_branch_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_branch_id->caption(), $business_add->b_branch_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_b_type_id->Required) { ?>
				elm = this.getElements("x" + infix + "_b_b_type_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_b_type_id->caption(), $business_add->b_b_type_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_b_nature_id->Required) { ?>
				elm = this.getElements("x" + infix + "_b_b_nature_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_b_nature_id->caption(), $business_add->b_b_nature_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_b_status_id->Required) { ?>
				elm = this.getElements("x" + infix + "_b_b_status_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_b_status_id->caption(), $business_add->b_b_status_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_city_id->Required) { ?>
				elm = this.getElements("x" + infix + "_b_city_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_city_id->caption(), $business_add->b_city_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_referral_id->Required) { ?>
				elm = this.getElements("x" + infix + "_b_referral_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_referral_id->caption(), $business_add->b_referral_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_name->Required) { ?>
				elm = this.getElements("x" + infix + "_b_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_name->caption(), $business_add->b_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_owner->Required) { ?>
				elm = this.getElements("x" + infix + "_b_owner");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_owner->caption(), $business_add->b_owner->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_contact->Required) { ?>
				elm = this.getElements("x" + infix + "_b_contact");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_contact->caption(), $business_add->b_contact->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_address->Required) { ?>
				elm = this.getElements("x" + infix + "_b_address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_address->caption(), $business_add->b_address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_email->Required) { ?>
				elm = this.getElements("x" + infix + "_b_email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_email->caption(), $business_add->b_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_ntn->Required) { ?>
				elm = this.getElements("x" + infix + "_b_ntn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_ntn->caption(), $business_add->b_ntn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_logo->Required) { ?>
				felm = this.getElements("x" + infix + "_b_logo");
				elm = this.getElements("fn_x" + infix + "_b_logo");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $business_add->b_logo->caption(), $business_add->b_logo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_no_of_emp->Required) { ?>
				elm = this.getElements("x" + infix + "_b_no_of_emp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_no_of_emp->caption(), $business_add->b_no_of_emp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_b_no_of_emp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_add->b_no_of_emp->errorMessage()) ?>");
			<?php if ($business_add->b_since->Required) { ?>
				elm = this.getElements("x" + infix + "_b_since");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_since->caption(), $business_add->b_since->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_no_of_branches->Required) { ?>
				elm = this.getElements("x" + infix + "_b_no_of_branches");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_no_of_branches->caption(), $business_add->b_no_of_branches->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_b_no_of_branches");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_add->b_no_of_branches->errorMessage()) ?>");
			<?php if ($business_add->b_deal_with_referral->Required) { ?>
				elm = this.getElements("x" + infix + "_b_deal_with_referral");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_deal_with_referral->caption(), $business_add->b_deal_with_referral->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->b_comments->Required) { ?>
				elm = this.getElements("x" + infix + "_b_comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->b_comments->caption(), $business_add->b_comments->RequiredErrorMessage)) ?>");
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
	fbusinessadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbusinessadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbusinessadd.lists["x_b_branch_id"] = <?php echo $business_add->b_branch_id->Lookup->toClientList($business_add) ?>;
	fbusinessadd.lists["x_b_branch_id"].options = <?php echo JsonEncode($business_add->b_branch_id->lookupOptions()) ?>;
	fbusinessadd.lists["x_b_b_type_id"] = <?php echo $business_add->b_b_type_id->Lookup->toClientList($business_add) ?>;
	fbusinessadd.lists["x_b_b_type_id"].options = <?php echo JsonEncode($business_add->b_b_type_id->lookupOptions()) ?>;
	fbusinessadd.lists["x_b_b_nature_id"] = <?php echo $business_add->b_b_nature_id->Lookup->toClientList($business_add) ?>;
	fbusinessadd.lists["x_b_b_nature_id"].options = <?php echo JsonEncode($business_add->b_b_nature_id->lookupOptions()) ?>;
	fbusinessadd.lists["x_b_b_status_id"] = <?php echo $business_add->b_b_status_id->Lookup->toClientList($business_add) ?>;
	fbusinessadd.lists["x_b_b_status_id"].options = <?php echo JsonEncode($business_add->b_b_status_id->lookupOptions()) ?>;
	fbusinessadd.lists["x_b_city_id"] = <?php echo $business_add->b_city_id->Lookup->toClientList($business_add) ?>;
	fbusinessadd.lists["x_b_city_id"].options = <?php echo JsonEncode($business_add->b_city_id->lookupOptions()) ?>;
	fbusinessadd.lists["x_b_referral_id"] = <?php echo $business_add->b_referral_id->Lookup->toClientList($business_add) ?>;
	fbusinessadd.lists["x_b_referral_id"].options = <?php echo JsonEncode($business_add->b_referral_id->lookupOptions()) ?>;
	loadjs.done("fbusinessadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_add->showPageHeader(); ?>
<?php
$business_add->showMessage();
?>
<form name="fbusinessadd" id="fbusinessadd" class="<?php echo $business_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$business_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($business_add->b_branch_id->Visible) { // b_branch_id ?>
	<div id="r_b_branch_id" class="form-group row">
		<label id="elh_business_b_branch_id" for="x_b_branch_id" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_branch_id->caption() ?><?php echo $business_add->b_branch_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_branch_id->cellAttributes() ?>>
<span id="el_business_b_branch_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($business_add->b_branch_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $business_add->b_branch_id->ViewValue ?></button>
		<div id="dsl_x_b_branch_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $business_add->b_branch_id->radioButtonListHtml(TRUE, "x_b_branch_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_b_branch_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="business" data-field="x_b_branch_id" data-value-separator="<?php echo $business_add->b_branch_id->displayValueSeparatorAttribute() ?>" name="x_b_branch_id" id="x_b_branch_id" value="{value}"<?php echo $business_add->b_branch_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$business_add->b_branch_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $business_add->b_branch_id->Lookup->getParamTag($business_add, "p_x_b_branch_id") ?>
</span>
<?php echo $business_add->b_branch_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_b_type_id->Visible) { // b_b_type_id ?>
	<div id="r_b_b_type_id" class="form-group row">
		<label id="elh_business_b_b_type_id" for="x_b_b_type_id" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_b_type_id->caption() ?><?php echo $business_add->b_b_type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_b_type_id->cellAttributes() ?>>
<span id="el_business_b_b_type_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($business_add->b_b_type_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $business_add->b_b_type_id->ViewValue ?></button>
		<div id="dsl_x_b_b_type_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $business_add->b_b_type_id->radioButtonListHtml(TRUE, "x_b_b_type_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_b_b_type_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="business" data-field="x_b_b_type_id" data-value-separator="<?php echo $business_add->b_b_type_id->displayValueSeparatorAttribute() ?>" name="x_b_b_type_id" id="x_b_b_type_id" value="{value}"<?php echo $business_add->b_b_type_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$business_add->b_b_type_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $business_add->b_b_type_id->Lookup->getParamTag($business_add, "p_x_b_b_type_id") ?>
</span>
<?php echo $business_add->b_b_type_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_b_nature_id->Visible) { // b_b_nature_id ?>
	<div id="r_b_b_nature_id" class="form-group row">
		<label id="elh_business_b_b_nature_id" for="x_b_b_nature_id" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_b_nature_id->caption() ?><?php echo $business_add->b_b_nature_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_b_nature_id->cellAttributes() ?>>
<span id="el_business_b_b_nature_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($business_add->b_b_nature_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $business_add->b_b_nature_id->ViewValue ?></button>
		<div id="dsl_x_b_b_nature_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $business_add->b_b_nature_id->radioButtonListHtml(TRUE, "x_b_b_nature_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_b_b_nature_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="business" data-field="x_b_b_nature_id" data-value-separator="<?php echo $business_add->b_b_nature_id->displayValueSeparatorAttribute() ?>" name="x_b_b_nature_id" id="x_b_b_nature_id" value="{value}"<?php echo $business_add->b_b_nature_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$business_add->b_b_nature_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $business_add->b_b_nature_id->Lookup->getParamTag($business_add, "p_x_b_b_nature_id") ?>
</span>
<?php echo $business_add->b_b_nature_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_b_status_id->Visible) { // b_b_status_id ?>
	<div id="r_b_b_status_id" class="form-group row">
		<label id="elh_business_b_b_status_id" for="x_b_b_status_id" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_b_status_id->caption() ?><?php echo $business_add->b_b_status_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_b_status_id->cellAttributes() ?>>
<span id="el_business_b_b_status_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($business_add->b_b_status_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $business_add->b_b_status_id->ViewValue ?></button>
		<div id="dsl_x_b_b_status_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $business_add->b_b_status_id->radioButtonListHtml(TRUE, "x_b_b_status_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_b_b_status_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="business" data-field="x_b_b_status_id" data-value-separator="<?php echo $business_add->b_b_status_id->displayValueSeparatorAttribute() ?>" name="x_b_b_status_id" id="x_b_b_status_id" value="{value}"<?php echo $business_add->b_b_status_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$business_add->b_b_status_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $business_add->b_b_status_id->Lookup->getParamTag($business_add, "p_x_b_b_status_id") ?>
</span>
<?php echo $business_add->b_b_status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_city_id->Visible) { // b_city_id ?>
	<div id="r_b_city_id" class="form-group row">
		<label id="elh_business_b_city_id" for="x_b_city_id" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_city_id->caption() ?><?php echo $business_add->b_city_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_city_id->cellAttributes() ?>>
<span id="el_business_b_city_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($business_add->b_city_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $business_add->b_city_id->ViewValue ?></button>
		<div id="dsl_x_b_city_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $business_add->b_city_id->radioButtonListHtml(TRUE, "x_b_city_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_b_city_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="business" data-field="x_b_city_id" data-value-separator="<?php echo $business_add->b_city_id->displayValueSeparatorAttribute() ?>" name="x_b_city_id" id="x_b_city_id" value="{value}"<?php echo $business_add->b_city_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$business_add->b_city_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $business_add->b_city_id->Lookup->getParamTag($business_add, "p_x_b_city_id") ?>
</span>
<?php echo $business_add->b_city_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_referral_id->Visible) { // b_referral_id ?>
	<div id="r_b_referral_id" class="form-group row">
		<label id="elh_business_b_referral_id" for="x_b_referral_id" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_referral_id->caption() ?><?php echo $business_add->b_referral_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_referral_id->cellAttributes() ?>>
<span id="el_business_b_referral_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($business_add->b_referral_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $business_add->b_referral_id->ViewValue ?></button>
		<div id="dsl_x_b_referral_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $business_add->b_referral_id->radioButtonListHtml(TRUE, "x_b_referral_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_b_referral_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="business" data-field="x_b_referral_id" data-value-separator="<?php echo $business_add->b_referral_id->displayValueSeparatorAttribute() ?>" name="x_b_referral_id" id="x_b_referral_id" value="{value}"<?php echo $business_add->b_referral_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$business_add->b_referral_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $business_add->b_referral_id->Lookup->getParamTag($business_add, "p_x_b_referral_id") ?>
</span>
<?php echo $business_add->b_referral_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_name->Visible) { // b_name ?>
	<div id="r_b_name" class="form-group row">
		<label id="elh_business_b_name" for="x_b_name" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_name->caption() ?><?php echo $business_add->b_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_name->cellAttributes() ?>>
<span id="el_business_b_name">
<input type="text" data-table="business" data-field="x_b_name" name="x_b_name" id="x_b_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($business_add->b_name->getPlaceHolder()) ?>" value="<?php echo $business_add->b_name->EditValue ?>"<?php echo $business_add->b_name->editAttributes() ?>>
</span>
<?php echo $business_add->b_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_owner->Visible) { // b_owner ?>
	<div id="r_b_owner" class="form-group row">
		<label id="elh_business_b_owner" for="x_b_owner" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_owner->caption() ?><?php echo $business_add->b_owner->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_owner->cellAttributes() ?>>
<span id="el_business_b_owner">
<input type="text" data-table="business" data-field="x_b_owner" name="x_b_owner" id="x_b_owner" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($business_add->b_owner->getPlaceHolder()) ?>" value="<?php echo $business_add->b_owner->EditValue ?>"<?php echo $business_add->b_owner->editAttributes() ?>>
</span>
<?php echo $business_add->b_owner->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_contact->Visible) { // b_contact ?>
	<div id="r_b_contact" class="form-group row">
		<label id="elh_business_b_contact" for="x_b_contact" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_contact->caption() ?><?php echo $business_add->b_contact->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_contact->cellAttributes() ?>>
<span id="el_business_b_contact">
<input type="text" data-table="business" data-field="x_b_contact" name="x_b_contact" id="x_b_contact" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($business_add->b_contact->getPlaceHolder()) ?>" value="<?php echo $business_add->b_contact->EditValue ?>"<?php echo $business_add->b_contact->editAttributes() ?>>
</span>
<?php echo $business_add->b_contact->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_address->Visible) { // b_address ?>
	<div id="r_b_address" class="form-group row">
		<label id="elh_business_b_address" for="x_b_address" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_address->caption() ?><?php echo $business_add->b_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_address->cellAttributes() ?>>
<span id="el_business_b_address">
<textarea data-table="business" data-field="x_b_address" name="x_b_address" id="x_b_address" cols="35" rows="4" placeholder="<?php echo HtmlEncode($business_add->b_address->getPlaceHolder()) ?>"<?php echo $business_add->b_address->editAttributes() ?>><?php echo $business_add->b_address->EditValue ?></textarea>
</span>
<?php echo $business_add->b_address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_email->Visible) { // b_email ?>
	<div id="r_b_email" class="form-group row">
		<label id="elh_business_b_email" for="x_b_email" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_email->caption() ?><?php echo $business_add->b_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_email->cellAttributes() ?>>
<span id="el_business_b_email">
<input type="text" data-table="business" data-field="x_b_email" name="x_b_email" id="x_b_email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($business_add->b_email->getPlaceHolder()) ?>" value="<?php echo $business_add->b_email->EditValue ?>"<?php echo $business_add->b_email->editAttributes() ?>>
</span>
<?php echo $business_add->b_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_ntn->Visible) { // b_ntn ?>
	<div id="r_b_ntn" class="form-group row">
		<label id="elh_business_b_ntn" for="x_b_ntn" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_ntn->caption() ?><?php echo $business_add->b_ntn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_ntn->cellAttributes() ?>>
<span id="el_business_b_ntn">
<input type="text" data-table="business" data-field="x_b_ntn" name="x_b_ntn" id="x_b_ntn" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($business_add->b_ntn->getPlaceHolder()) ?>" value="<?php echo $business_add->b_ntn->EditValue ?>"<?php echo $business_add->b_ntn->editAttributes() ?>>
</span>
<?php echo $business_add->b_ntn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_logo->Visible) { // b_logo ?>
	<div id="r_b_logo" class="form-group row">
		<label id="elh_business_b_logo" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_logo->caption() ?><?php echo $business_add->b_logo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_logo->cellAttributes() ?>>
<span id="el_business_b_logo">
<div id="fd_x_b_logo">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $business_add->b_logo->title() ?>" data-table="business" data-field="x_b_logo" name="x_b_logo" id="x_b_logo" lang="<?php echo CurrentLanguageID() ?>"<?php echo $business_add->b_logo->editAttributes() ?><?php if ($business_add->b_logo->ReadOnly || $business_add->b_logo->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_b_logo"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_b_logo" id= "fn_x_b_logo" value="<?php echo $business_add->b_logo->Upload->FileName ?>">
<input type="hidden" name="fa_x_b_logo" id= "fa_x_b_logo" value="0">
<input type="hidden" name="fs_x_b_logo" id= "fs_x_b_logo" value="100">
<input type="hidden" name="fx_x_b_logo" id= "fx_x_b_logo" value="<?php echo $business_add->b_logo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_b_logo" id= "fm_x_b_logo" value="<?php echo $business_add->b_logo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_b_logo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $business_add->b_logo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_no_of_emp->Visible) { // b_no_of_emp ?>
	<div id="r_b_no_of_emp" class="form-group row">
		<label id="elh_business_b_no_of_emp" for="x_b_no_of_emp" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_no_of_emp->caption() ?><?php echo $business_add->b_no_of_emp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_no_of_emp->cellAttributes() ?>>
<span id="el_business_b_no_of_emp">
<input type="text" data-table="business" data-field="x_b_no_of_emp" name="x_b_no_of_emp" id="x_b_no_of_emp" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($business_add->b_no_of_emp->getPlaceHolder()) ?>" value="<?php echo $business_add->b_no_of_emp->EditValue ?>"<?php echo $business_add->b_no_of_emp->editAttributes() ?>>
</span>
<?php echo $business_add->b_no_of_emp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_since->Visible) { // b_since ?>
	<div id="r_b_since" class="form-group row">
		<label id="elh_business_b_since" for="x_b_since" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_since->caption() ?><?php echo $business_add->b_since->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_since->cellAttributes() ?>>
<span id="el_business_b_since">
<input type="text" data-table="business" data-field="x_b_since" name="x_b_since" id="x_b_since" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($business_add->b_since->getPlaceHolder()) ?>" value="<?php echo $business_add->b_since->EditValue ?>"<?php echo $business_add->b_since->editAttributes() ?>>
</span>
<?php echo $business_add->b_since->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_no_of_branches->Visible) { // b_no_of_branches ?>
	<div id="r_b_no_of_branches" class="form-group row">
		<label id="elh_business_b_no_of_branches" for="x_b_no_of_branches" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_no_of_branches->caption() ?><?php echo $business_add->b_no_of_branches->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_no_of_branches->cellAttributes() ?>>
<span id="el_business_b_no_of_branches">
<input type="text" data-table="business" data-field="x_b_no_of_branches" name="x_b_no_of_branches" id="x_b_no_of_branches" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($business_add->b_no_of_branches->getPlaceHolder()) ?>" value="<?php echo $business_add->b_no_of_branches->EditValue ?>"<?php echo $business_add->b_no_of_branches->editAttributes() ?>>
</span>
<?php echo $business_add->b_no_of_branches->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_deal_with_referral->Visible) { // b_deal_with_referral ?>
	<div id="r_b_deal_with_referral" class="form-group row">
		<label id="elh_business_b_deal_with_referral" for="x_b_deal_with_referral" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_deal_with_referral->caption() ?><?php echo $business_add->b_deal_with_referral->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_deal_with_referral->cellAttributes() ?>>
<span id="el_business_b_deal_with_referral">
<textarea data-table="business" data-field="x_b_deal_with_referral" name="x_b_deal_with_referral" id="x_b_deal_with_referral" cols="35" rows="4" placeholder="<?php echo HtmlEncode($business_add->b_deal_with_referral->getPlaceHolder()) ?>"<?php echo $business_add->b_deal_with_referral->editAttributes() ?>><?php echo $business_add->b_deal_with_referral->EditValue ?></textarea>
</span>
<?php echo $business_add->b_deal_with_referral->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->b_comments->Visible) { // b_comments ?>
	<div id="r_b_comments" class="form-group row">
		<label id="elh_business_b_comments" for="x_b_comments" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->b_comments->caption() ?><?php echo $business_add->b_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->b_comments->cellAttributes() ?>>
<span id="el_business_b_comments">
<textarea data-table="business" data-field="x_b_comments" name="x_b_comments" id="x_b_comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($business_add->b_comments->getPlaceHolder()) ?>"<?php echo $business_add->b_comments->editAttributes() ?>><?php echo $business_add->b_comments->EditValue ?></textarea>
</span>
<?php echo $business_add->b_comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$business_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $business_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $business_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$business_add->showPageFooter();
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
$business_add->terminate();
?>