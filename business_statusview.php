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
$business_status_view = new business_status_view();

// Run the page
$business_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$business_status_view->isExport()) { ?>
<script>
var fbusiness_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbusiness_statusview = currentForm = new ew.Form("fbusiness_statusview", "view");
	loadjs.done("fbusiness_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$business_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $business_status_view->ExportOptions->render("body") ?>
<?php $business_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $business_status_view->showPageHeader(); ?>
<?php
$business_status_view->showMessage();
?>
<?php if (!$business_status_view->IsModal) { ?>
<?php if (!$business_status_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $business_status_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbusiness_statusview" id="fbusiness_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_status">
<input type="hidden" name="modal" value="<?php echo (int)$business_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($business_status_view->business_status_id->Visible) { // business_status_id ?>
	<tr id="r_business_status_id">
		<td class="<?php echo $business_status_view->TableLeftColumnClass ?>"><span id="elh_business_status_business_status_id"><?php echo $business_status_view->business_status_id->caption() ?></span></td>
		<td data-name="business_status_id" <?php echo $business_status_view->business_status_id->cellAttributes() ?>>
<span id="el_business_status_business_status_id">
<span<?php echo $business_status_view->business_status_id->viewAttributes() ?>><?php echo $business_status_view->business_status_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_status_view->business_status_caption->Visible) { // business_status_caption ?>
	<tr id="r_business_status_caption">
		<td class="<?php echo $business_status_view->TableLeftColumnClass ?>"><span id="elh_business_status_business_status_caption"><?php echo $business_status_view->business_status_caption->caption() ?></span></td>
		<td data-name="business_status_caption" <?php echo $business_status_view->business_status_caption->cellAttributes() ?>>
<span id="el_business_status_business_status_caption">
<span<?php echo $business_status_view->business_status_caption->viewAttributes() ?>><?php echo $business_status_view->business_status_caption->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$business_status_view->IsModal) { ?>
<?php if (!$business_status_view->isExport()) { ?>
<?php echo $business_status_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$business_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$business_status_view->isExport()) { ?>
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
$business_status_view->terminate();
?>