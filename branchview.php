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
$branch_view = new branch_view();

// Run the page
$branch_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$branch_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$branch_view->isExport()) { ?>
<script>
var fbranchview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbranchview = currentForm = new ew.Form("fbranchview", "view");
	loadjs.done("fbranchview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$branch_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $branch_view->ExportOptions->render("body") ?>
<?php $branch_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $branch_view->showPageHeader(); ?>
<?php
$branch_view->showMessage();
?>
<form name="fbranchview" id="fbranchview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="branch">
<input type="hidden" name="modal" value="<?php echo (int)$branch_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($branch_view->branch_id->Visible) { // branch_id ?>
	<tr id="r_branch_id">
		<td class="<?php echo $branch_view->TableLeftColumnClass ?>"><span id="elh_branch_branch_id"><?php echo $branch_view->branch_id->caption() ?></span></td>
		<td data-name="branch_id" <?php echo $branch_view->branch_id->cellAttributes() ?>>
<span id="el_branch_branch_id">
<span<?php echo $branch_view->branch_id->viewAttributes() ?>><?php echo $branch_view->branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($branch_view->branch_org_id->Visible) { // branch_org_id ?>
	<tr id="r_branch_org_id">
		<td class="<?php echo $branch_view->TableLeftColumnClass ?>"><span id="elh_branch_branch_org_id"><?php echo $branch_view->branch_org_id->caption() ?></span></td>
		<td data-name="branch_org_id" <?php echo $branch_view->branch_org_id->cellAttributes() ?>>
<span id="el_branch_branch_org_id">
<span<?php echo $branch_view->branch_org_id->viewAttributes() ?>><?php echo $branch_view->branch_org_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($branch_view->branch_name->Visible) { // branch_name ?>
	<tr id="r_branch_name">
		<td class="<?php echo $branch_view->TableLeftColumnClass ?>"><span id="elh_branch_branch_name"><?php echo $branch_view->branch_name->caption() ?></span></td>
		<td data-name="branch_name" <?php echo $branch_view->branch_name->cellAttributes() ?>>
<span id="el_branch_branch_name">
<span<?php echo $branch_view->branch_name->viewAttributes() ?>><?php echo $branch_view->branch_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($branch_view->branch_manager->Visible) { // branch_manager ?>
	<tr id="r_branch_manager">
		<td class="<?php echo $branch_view->TableLeftColumnClass ?>"><span id="elh_branch_branch_manager"><?php echo $branch_view->branch_manager->caption() ?></span></td>
		<td data-name="branch_manager" <?php echo $branch_view->branch_manager->cellAttributes() ?>>
<span id="el_branch_branch_manager">
<span<?php echo $branch_view->branch_manager->viewAttributes() ?>><?php echo $branch_view->branch_manager->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($branch_view->branch_contact->Visible) { // branch_contact ?>
	<tr id="r_branch_contact">
		<td class="<?php echo $branch_view->TableLeftColumnClass ?>"><span id="elh_branch_branch_contact"><?php echo $branch_view->branch_contact->caption() ?></span></td>
		<td data-name="branch_contact" <?php echo $branch_view->branch_contact->cellAttributes() ?>>
<span id="el_branch_branch_contact">
<span<?php echo $branch_view->branch_contact->viewAttributes() ?>><?php echo $branch_view->branch_contact->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($branch_view->branch_address->Visible) { // branch_address ?>
	<tr id="r_branch_address">
		<td class="<?php echo $branch_view->TableLeftColumnClass ?>"><span id="elh_branch_branch_address"><?php echo $branch_view->branch_address->caption() ?></span></td>
		<td data-name="branch_address" <?php echo $branch_view->branch_address->cellAttributes() ?>>
<span id="el_branch_branch_address">
<span<?php echo $branch_view->branch_address->viewAttributes() ?>><?php echo $branch_view->branch_address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$branch_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$branch_view->isExport()) { ?>
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
$branch_view->terminate();
?>