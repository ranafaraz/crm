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
$business_delete = new business_delete();

// Run the page
$business_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusinessdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbusinessdelete = currentForm = new ew.Form("fbusinessdelete", "delete");
	loadjs.done("fbusinessdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_delete->showPageHeader(); ?>
<?php
$business_delete->showMessage();
?>
<form name="fbusinessdelete" id="fbusinessdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($business_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($business_delete->b_id->Visible) { // b_id ?>
		<th class="<?php echo $business_delete->b_id->headerCellClass() ?>"><span id="elh_business_b_id" class="business_b_id"><?php echo $business_delete->b_id->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_branch_id->Visible) { // b_branch_id ?>
		<th class="<?php echo $business_delete->b_branch_id->headerCellClass() ?>"><span id="elh_business_b_branch_id" class="business_b_branch_id"><?php echo $business_delete->b_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_b_type_id->Visible) { // b_b_type_id ?>
		<th class="<?php echo $business_delete->b_b_type_id->headerCellClass() ?>"><span id="elh_business_b_b_type_id" class="business_b_b_type_id"><?php echo $business_delete->b_b_type_id->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_b_nature_id->Visible) { // b_b_nature_id ?>
		<th class="<?php echo $business_delete->b_b_nature_id->headerCellClass() ?>"><span id="elh_business_b_b_nature_id" class="business_b_b_nature_id"><?php echo $business_delete->b_b_nature_id->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_b_status_id->Visible) { // b_b_status_id ?>
		<th class="<?php echo $business_delete->b_b_status_id->headerCellClass() ?>"><span id="elh_business_b_b_status_id" class="business_b_b_status_id"><?php echo $business_delete->b_b_status_id->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_city_id->Visible) { // b_city_id ?>
		<th class="<?php echo $business_delete->b_city_id->headerCellClass() ?>"><span id="elh_business_b_city_id" class="business_b_city_id"><?php echo $business_delete->b_city_id->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_referral_id->Visible) { // b_referral_id ?>
		<th class="<?php echo $business_delete->b_referral_id->headerCellClass() ?>"><span id="elh_business_b_referral_id" class="business_b_referral_id"><?php echo $business_delete->b_referral_id->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_name->Visible) { // b_name ?>
		<th class="<?php echo $business_delete->b_name->headerCellClass() ?>"><span id="elh_business_b_name" class="business_b_name"><?php echo $business_delete->b_name->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_owner->Visible) { // b_owner ?>
		<th class="<?php echo $business_delete->b_owner->headerCellClass() ?>"><span id="elh_business_b_owner" class="business_b_owner"><?php echo $business_delete->b_owner->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_contact->Visible) { // b_contact ?>
		<th class="<?php echo $business_delete->b_contact->headerCellClass() ?>"><span id="elh_business_b_contact" class="business_b_contact"><?php echo $business_delete->b_contact->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_address->Visible) { // b_address ?>
		<th class="<?php echo $business_delete->b_address->headerCellClass() ?>"><span id="elh_business_b_address" class="business_b_address"><?php echo $business_delete->b_address->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_email->Visible) { // b_email ?>
		<th class="<?php echo $business_delete->b_email->headerCellClass() ?>"><span id="elh_business_b_email" class="business_b_email"><?php echo $business_delete->b_email->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_ntn->Visible) { // b_ntn ?>
		<th class="<?php echo $business_delete->b_ntn->headerCellClass() ?>"><span id="elh_business_b_ntn" class="business_b_ntn"><?php echo $business_delete->b_ntn->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_logo->Visible) { // b_logo ?>
		<th class="<?php echo $business_delete->b_logo->headerCellClass() ?>"><span id="elh_business_b_logo" class="business_b_logo"><?php echo $business_delete->b_logo->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_no_of_emp->Visible) { // b_no_of_emp ?>
		<th class="<?php echo $business_delete->b_no_of_emp->headerCellClass() ?>"><span id="elh_business_b_no_of_emp" class="business_b_no_of_emp"><?php echo $business_delete->b_no_of_emp->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_since->Visible) { // b_since ?>
		<th class="<?php echo $business_delete->b_since->headerCellClass() ?>"><span id="elh_business_b_since" class="business_b_since"><?php echo $business_delete->b_since->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_no_of_branches->Visible) { // b_no_of_branches ?>
		<th class="<?php echo $business_delete->b_no_of_branches->headerCellClass() ?>"><span id="elh_business_b_no_of_branches" class="business_b_no_of_branches"><?php echo $business_delete->b_no_of_branches->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_deal_with_referral->Visible) { // b_deal_with_referral ?>
		<th class="<?php echo $business_delete->b_deal_with_referral->headerCellClass() ?>"><span id="elh_business_b_deal_with_referral" class="business_b_deal_with_referral"><?php echo $business_delete->b_deal_with_referral->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->b_comments->Visible) { // b_comments ?>
		<th class="<?php echo $business_delete->b_comments->headerCellClass() ?>"><span id="elh_business_b_comments" class="business_b_comments"><?php echo $business_delete->b_comments->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$business_delete->RecordCount = 0;
$i = 0;
while (!$business_delete->Recordset->EOF) {
	$business_delete->RecordCount++;
	$business_delete->RowCount++;

	// Set row properties
	$business->resetAttributes();
	$business->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$business_delete->loadRowValues($business_delete->Recordset);

	// Render row
	$business_delete->renderRow();
?>
	<tr <?php echo $business->rowAttributes() ?>>
<?php if ($business_delete->b_id->Visible) { // b_id ?>
		<td <?php echo $business_delete->b_id->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_id" class="business_b_id">
<span<?php echo $business_delete->b_id->viewAttributes() ?>><?php echo $business_delete->b_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_branch_id->Visible) { // b_branch_id ?>
		<td <?php echo $business_delete->b_branch_id->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_branch_id" class="business_b_branch_id">
<span<?php echo $business_delete->b_branch_id->viewAttributes() ?>><?php echo $business_delete->b_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_b_type_id->Visible) { // b_b_type_id ?>
		<td <?php echo $business_delete->b_b_type_id->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_b_type_id" class="business_b_b_type_id">
<span<?php echo $business_delete->b_b_type_id->viewAttributes() ?>><?php echo $business_delete->b_b_type_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_b_nature_id->Visible) { // b_b_nature_id ?>
		<td <?php echo $business_delete->b_b_nature_id->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_b_nature_id" class="business_b_b_nature_id">
<span<?php echo $business_delete->b_b_nature_id->viewAttributes() ?>><?php echo $business_delete->b_b_nature_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_b_status_id->Visible) { // b_b_status_id ?>
		<td <?php echo $business_delete->b_b_status_id->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_b_status_id" class="business_b_b_status_id">
<span<?php echo $business_delete->b_b_status_id->viewAttributes() ?>><?php echo $business_delete->b_b_status_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_city_id->Visible) { // b_city_id ?>
		<td <?php echo $business_delete->b_city_id->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_city_id" class="business_b_city_id">
<span<?php echo $business_delete->b_city_id->viewAttributes() ?>><?php echo $business_delete->b_city_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_referral_id->Visible) { // b_referral_id ?>
		<td <?php echo $business_delete->b_referral_id->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_referral_id" class="business_b_referral_id">
<span<?php echo $business_delete->b_referral_id->viewAttributes() ?>><?php echo $business_delete->b_referral_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_name->Visible) { // b_name ?>
		<td <?php echo $business_delete->b_name->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_name" class="business_b_name">
<span<?php echo $business_delete->b_name->viewAttributes() ?>><?php echo $business_delete->b_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_owner->Visible) { // b_owner ?>
		<td <?php echo $business_delete->b_owner->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_owner" class="business_b_owner">
<span<?php echo $business_delete->b_owner->viewAttributes() ?>><?php echo $business_delete->b_owner->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_contact->Visible) { // b_contact ?>
		<td <?php echo $business_delete->b_contact->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_contact" class="business_b_contact">
<span<?php echo $business_delete->b_contact->viewAttributes() ?>><?php echo $business_delete->b_contact->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_address->Visible) { // b_address ?>
		<td <?php echo $business_delete->b_address->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_address" class="business_b_address">
<span<?php echo $business_delete->b_address->viewAttributes() ?>><?php echo $business_delete->b_address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_email->Visible) { // b_email ?>
		<td <?php echo $business_delete->b_email->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_email" class="business_b_email">
<span<?php echo $business_delete->b_email->viewAttributes() ?>><?php echo $business_delete->b_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_ntn->Visible) { // b_ntn ?>
		<td <?php echo $business_delete->b_ntn->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_ntn" class="business_b_ntn">
<span<?php echo $business_delete->b_ntn->viewAttributes() ?>><?php echo $business_delete->b_ntn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_logo->Visible) { // b_logo ?>
		<td <?php echo $business_delete->b_logo->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_logo" class="business_b_logo">
<span><?php echo GetFileViewTag($business_delete->b_logo, $business_delete->b_logo->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_no_of_emp->Visible) { // b_no_of_emp ?>
		<td <?php echo $business_delete->b_no_of_emp->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_no_of_emp" class="business_b_no_of_emp">
<span<?php echo $business_delete->b_no_of_emp->viewAttributes() ?>><?php echo $business_delete->b_no_of_emp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_since->Visible) { // b_since ?>
		<td <?php echo $business_delete->b_since->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_since" class="business_b_since">
<span<?php echo $business_delete->b_since->viewAttributes() ?>><?php echo $business_delete->b_since->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_no_of_branches->Visible) { // b_no_of_branches ?>
		<td <?php echo $business_delete->b_no_of_branches->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_no_of_branches" class="business_b_no_of_branches">
<span<?php echo $business_delete->b_no_of_branches->viewAttributes() ?>><?php echo $business_delete->b_no_of_branches->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_deal_with_referral->Visible) { // b_deal_with_referral ?>
		<td <?php echo $business_delete->b_deal_with_referral->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_deal_with_referral" class="business_b_deal_with_referral">
<span<?php echo $business_delete->b_deal_with_referral->viewAttributes() ?>><?php echo $business_delete->b_deal_with_referral->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->b_comments->Visible) { // b_comments ?>
		<td <?php echo $business_delete->b_comments->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_b_comments" class="business_b_comments">
<span<?php echo $business_delete->b_comments->viewAttributes() ?>><?php echo $business_delete->b_comments->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$business_delete->Recordset->moveNext();
}
$business_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $business_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$business_delete->showPageFooter();
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
$business_delete->terminate();
?>