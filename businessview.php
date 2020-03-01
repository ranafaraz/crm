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
$business_view = new business_view();

// Run the page
$business_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$business_view->isExport()) { ?>
<script>
var fbusinessview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbusinessview = currentForm = new ew.Form("fbusinessview", "view");
	loadjs.done("fbusinessview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$business_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $business_view->ExportOptions->render("body") ?>
<?php $business_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $business_view->showPageHeader(); ?>
<?php
$business_view->showMessage();
?>
<form name="fbusinessview" id="fbusinessview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business">
<input type="hidden" name="modal" value="<?php echo (int)$business_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($business_view->b_id->Visible) { // b_id ?>
	<tr id="r_b_id">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_id"><?php echo $business_view->b_id->caption() ?></span></td>
		<td data-name="b_id" <?php echo $business_view->b_id->cellAttributes() ?>>
<span id="el_business_b_id">
<span<?php echo $business_view->b_id->viewAttributes() ?>><?php echo $business_view->b_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_branch_id->Visible) { // b_branch_id ?>
	<tr id="r_b_branch_id">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_branch_id"><?php echo $business_view->b_branch_id->caption() ?></span></td>
		<td data-name="b_branch_id" <?php echo $business_view->b_branch_id->cellAttributes() ?>>
<span id="el_business_b_branch_id">
<span<?php echo $business_view->b_branch_id->viewAttributes() ?>><?php echo $business_view->b_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_b_type_id->Visible) { // b_b_type_id ?>
	<tr id="r_b_b_type_id">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_b_type_id"><?php echo $business_view->b_b_type_id->caption() ?></span></td>
		<td data-name="b_b_type_id" <?php echo $business_view->b_b_type_id->cellAttributes() ?>>
<span id="el_business_b_b_type_id">
<span<?php echo $business_view->b_b_type_id->viewAttributes() ?>><?php echo $business_view->b_b_type_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_b_status_id->Visible) { // b_b_status_id ?>
	<tr id="r_b_b_status_id">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_b_status_id"><?php echo $business_view->b_b_status_id->caption() ?></span></td>
		<td data-name="b_b_status_id" <?php echo $business_view->b_b_status_id->cellAttributes() ?>>
<span id="el_business_b_b_status_id">
<span<?php echo $business_view->b_b_status_id->viewAttributes() ?>><?php echo $business_view->b_b_status_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_b_nature_id->Visible) { // b_b_nature_id ?>
	<tr id="r_b_b_nature_id">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_b_nature_id"><?php echo $business_view->b_b_nature_id->caption() ?></span></td>
		<td data-name="b_b_nature_id" <?php echo $business_view->b_b_nature_id->cellAttributes() ?>>
<span id="el_business_b_b_nature_id">
<span<?php echo $business_view->b_b_nature_id->viewAttributes() ?>><?php echo $business_view->b_b_nature_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_city_id->Visible) { // b_city_id ?>
	<tr id="r_b_city_id">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_city_id"><?php echo $business_view->b_city_id->caption() ?></span></td>
		<td data-name="b_city_id" <?php echo $business_view->b_city_id->cellAttributes() ?>>
<span id="el_business_b_city_id">
<span<?php echo $business_view->b_city_id->viewAttributes() ?>><?php echo $business_view->b_city_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_referral_id->Visible) { // b_referral_id ?>
	<tr id="r_b_referral_id">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_referral_id"><?php echo $business_view->b_referral_id->caption() ?></span></td>
		<td data-name="b_referral_id" <?php echo $business_view->b_referral_id->cellAttributes() ?>>
<span id="el_business_b_referral_id">
<span<?php echo $business_view->b_referral_id->viewAttributes() ?>><?php echo $business_view->b_referral_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_name->Visible) { // b_name ?>
	<tr id="r_b_name">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_name"><?php echo $business_view->b_name->caption() ?></span></td>
		<td data-name="b_name" <?php echo $business_view->b_name->cellAttributes() ?>>
<span id="el_business_b_name">
<span<?php echo $business_view->b_name->viewAttributes() ?>><?php echo $business_view->b_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_owner->Visible) { // b_owner ?>
	<tr id="r_b_owner">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_owner"><?php echo $business_view->b_owner->caption() ?></span></td>
		<td data-name="b_owner" <?php echo $business_view->b_owner->cellAttributes() ?>>
<span id="el_business_b_owner">
<span<?php echo $business_view->b_owner->viewAttributes() ?>><?php echo $business_view->b_owner->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_contact->Visible) { // b_contact ?>
	<tr id="r_b_contact">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_contact"><?php echo $business_view->b_contact->caption() ?></span></td>
		<td data-name="b_contact" <?php echo $business_view->b_contact->cellAttributes() ?>>
<span id="el_business_b_contact">
<span<?php echo $business_view->b_contact->viewAttributes() ?>><?php echo $business_view->b_contact->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_address->Visible) { // b_address ?>
	<tr id="r_b_address">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_address"><?php echo $business_view->b_address->caption() ?></span></td>
		<td data-name="b_address" <?php echo $business_view->b_address->cellAttributes() ?>>
<span id="el_business_b_address">
<span<?php echo $business_view->b_address->viewAttributes() ?>><?php echo $business_view->b_address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_email->Visible) { // b_email ?>
	<tr id="r_b_email">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_email"><?php echo $business_view->b_email->caption() ?></span></td>
		<td data-name="b_email" <?php echo $business_view->b_email->cellAttributes() ?>>
<span id="el_business_b_email">
<span<?php echo $business_view->b_email->viewAttributes() ?>><?php echo $business_view->b_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_ntn->Visible) { // b_ntn ?>
	<tr id="r_b_ntn">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_ntn"><?php echo $business_view->b_ntn->caption() ?></span></td>
		<td data-name="b_ntn" <?php echo $business_view->b_ntn->cellAttributes() ?>>
<span id="el_business_b_ntn">
<span<?php echo $business_view->b_ntn->viewAttributes() ?>><?php echo $business_view->b_ntn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_logo->Visible) { // b_logo ?>
	<tr id="r_b_logo">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_logo"><?php echo $business_view->b_logo->caption() ?></span></td>
		<td data-name="b_logo" <?php echo $business_view->b_logo->cellAttributes() ?>>
<span id="el_business_b_logo">
<span><?php echo GetFileViewTag($business_view->b_logo, $business_view->b_logo->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_no_of_emp->Visible) { // b_no_of_emp ?>
	<tr id="r_b_no_of_emp">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_no_of_emp"><?php echo $business_view->b_no_of_emp->caption() ?></span></td>
		<td data-name="b_no_of_emp" <?php echo $business_view->b_no_of_emp->cellAttributes() ?>>
<span id="el_business_b_no_of_emp">
<span<?php echo $business_view->b_no_of_emp->viewAttributes() ?>><?php echo $business_view->b_no_of_emp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_since->Visible) { // b_since ?>
	<tr id="r_b_since">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_since"><?php echo $business_view->b_since->caption() ?></span></td>
		<td data-name="b_since" <?php echo $business_view->b_since->cellAttributes() ?>>
<span id="el_business_b_since">
<span<?php echo $business_view->b_since->viewAttributes() ?>><?php echo $business_view->b_since->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_no_of_branches->Visible) { // b_no_of_branches ?>
	<tr id="r_b_no_of_branches">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_no_of_branches"><?php echo $business_view->b_no_of_branches->caption() ?></span></td>
		<td data-name="b_no_of_branches" <?php echo $business_view->b_no_of_branches->cellAttributes() ?>>
<span id="el_business_b_no_of_branches">
<span<?php echo $business_view->b_no_of_branches->viewAttributes() ?>><?php echo $business_view->b_no_of_branches->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_deal_with_referral->Visible) { // b_deal_with_referral ?>
	<tr id="r_b_deal_with_referral">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_deal_with_referral"><?php echo $business_view->b_deal_with_referral->caption() ?></span></td>
		<td data-name="b_deal_with_referral" <?php echo $business_view->b_deal_with_referral->cellAttributes() ?>>
<span id="el_business_b_deal_with_referral">
<span<?php echo $business_view->b_deal_with_referral->viewAttributes() ?>><?php echo $business_view->b_deal_with_referral->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->b_comments->Visible) { // b_comments ?>
	<tr id="r_b_comments">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_b_comments"><?php echo $business_view->b_comments->caption() ?></span></td>
		<td data-name="b_comments" <?php echo $business_view->b_comments->cellAttributes() ?>>
<span id="el_business_b_comments">
<span<?php echo $business_view->b_comments->viewAttributes() ?>><?php echo $business_view->b_comments->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$business_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$business_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$business_view->terminate();
?>