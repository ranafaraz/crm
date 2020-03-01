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
$referral_view = new referral_view();

// Run the page
$referral_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$referral_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$referral_view->isExport()) { ?>
<script>
var freferralview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	freferralview = currentForm = new ew.Form("freferralview", "view");
	loadjs.done("freferralview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$referral_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $referral_view->ExportOptions->render("body") ?>
<?php $referral_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $referral_view->showPageHeader(); ?>
<?php
$referral_view->showMessage();
?>
<?php if (!$referral_view->IsModal) { ?>
<?php if (!$referral_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $referral_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="freferralview" id="freferralview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="referral">
<input type="hidden" name="modal" value="<?php echo (int)$referral_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($referral_view->referral_id->Visible) { // referral_id ?>
	<tr id="r_referral_id">
		<td class="<?php echo $referral_view->TableLeftColumnClass ?>"><span id="elh_referral_referral_id"><?php echo $referral_view->referral_id->caption() ?></span></td>
		<td data-name="referral_id" <?php echo $referral_view->referral_id->cellAttributes() ?>>
<span id="el_referral_referral_id">
<span<?php echo $referral_view->referral_id->viewAttributes() ?>><?php echo $referral_view->referral_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($referral_view->referral_branch_id->Visible) { // referral_branch_id ?>
	<tr id="r_referral_branch_id">
		<td class="<?php echo $referral_view->TableLeftColumnClass ?>"><span id="elh_referral_referral_branch_id"><?php echo $referral_view->referral_branch_id->caption() ?></span></td>
		<td data-name="referral_branch_id" <?php echo $referral_view->referral_branch_id->cellAttributes() ?>>
<span id="el_referral_referral_branch_id">
<span<?php echo $referral_view->referral_branch_id->viewAttributes() ?>><?php echo $referral_view->referral_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($referral_view->referral_name->Visible) { // referral_name ?>
	<tr id="r_referral_name">
		<td class="<?php echo $referral_view->TableLeftColumnClass ?>"><span id="elh_referral_referral_name"><?php echo $referral_view->referral_name->caption() ?></span></td>
		<td data-name="referral_name" <?php echo $referral_view->referral_name->cellAttributes() ?>>
<span id="el_referral_referral_name">
<span<?php echo $referral_view->referral_name->viewAttributes() ?>><?php echo $referral_view->referral_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($referral_view->referral_desc->Visible) { // referral_desc ?>
	<tr id="r_referral_desc">
		<td class="<?php echo $referral_view->TableLeftColumnClass ?>"><span id="elh_referral_referral_desc"><?php echo $referral_view->referral_desc->caption() ?></span></td>
		<td data-name="referral_desc" <?php echo $referral_view->referral_desc->cellAttributes() ?>>
<span id="el_referral_referral_desc">
<span<?php echo $referral_view->referral_desc->viewAttributes() ?>><?php echo $referral_view->referral_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($referral_view->referral_deal_signed->Visible) { // referral_deal_signed ?>
	<tr id="r_referral_deal_signed">
		<td class="<?php echo $referral_view->TableLeftColumnClass ?>"><span id="elh_referral_referral_deal_signed"><?php echo $referral_view->referral_deal_signed->caption() ?></span></td>
		<td data-name="referral_deal_signed" <?php echo $referral_view->referral_deal_signed->cellAttributes() ?>>
<span id="el_referral_referral_deal_signed">
<span<?php echo $referral_view->referral_deal_signed->viewAttributes() ?>><?php echo $referral_view->referral_deal_signed->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$referral_view->IsModal) { ?>
<?php if (!$referral_view->isExport()) { ?>
<?php echo $referral_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$referral_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$referral_view->isExport()) { ?>
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
$referral_view->terminate();
?>