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
$business_nature_view = new business_nature_view();

// Run the page
$business_nature_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_nature_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$business_nature_view->isExport()) { ?>
<script>
var fbusiness_natureview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbusiness_natureview = currentForm = new ew.Form("fbusiness_natureview", "view");
	loadjs.done("fbusiness_natureview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$business_nature_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $business_nature_view->ExportOptions->render("body") ?>
<?php $business_nature_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $business_nature_view->showPageHeader(); ?>
<?php
$business_nature_view->showMessage();
?>
<form name="fbusiness_natureview" id="fbusiness_natureview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_nature">
<input type="hidden" name="modal" value="<?php echo (int)$business_nature_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($business_nature_view->b_nature_id->Visible) { // b_nature_id ?>
	<tr id="r_b_nature_id">
		<td class="<?php echo $business_nature_view->TableLeftColumnClass ?>"><span id="elh_business_nature_b_nature_id"><?php echo $business_nature_view->b_nature_id->caption() ?></span></td>
		<td data-name="b_nature_id" <?php echo $business_nature_view->b_nature_id->cellAttributes() ?>>
<span id="el_business_nature_b_nature_id">
<span<?php echo $business_nature_view->b_nature_id->viewAttributes() ?>><?php echo $business_nature_view->b_nature_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_nature_view->b_nature_caption->Visible) { // b_nature_caption ?>
	<tr id="r_b_nature_caption">
		<td class="<?php echo $business_nature_view->TableLeftColumnClass ?>"><span id="elh_business_nature_b_nature_caption"><?php echo $business_nature_view->b_nature_caption->caption() ?></span></td>
		<td data-name="b_nature_caption" <?php echo $business_nature_view->b_nature_caption->cellAttributes() ?>>
<span id="el_business_nature_b_nature_caption">
<span<?php echo $business_nature_view->b_nature_caption->viewAttributes() ?>><?php echo $business_nature_view->b_nature_caption->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_nature_view->b_nature_desc->Visible) { // b_nature_desc ?>
	<tr id="r_b_nature_desc">
		<td class="<?php echo $business_nature_view->TableLeftColumnClass ?>"><span id="elh_business_nature_b_nature_desc"><?php echo $business_nature_view->b_nature_desc->caption() ?></span></td>
		<td data-name="b_nature_desc" <?php echo $business_nature_view->b_nature_desc->cellAttributes() ?>>
<span id="el_business_nature_b_nature_desc">
<span<?php echo $business_nature_view->b_nature_desc->viewAttributes() ?>><?php echo $business_nature_view->b_nature_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$business_nature_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$business_nature_view->isExport()) { ?>
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
$business_nature_view->terminate();
?>