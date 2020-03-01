<?php
namespace PHPMaker2020\project1;

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
$business_type_view = new business_type_view();

// Run the page
$business_type_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$business_type_view->isExport()) { ?>
<script>
var fbusiness_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbusiness_typeview = currentForm = new ew.Form("fbusiness_typeview", "view");
	loadjs.done("fbusiness_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$business_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $business_type_view->ExportOptions->render("body") ?>
<?php $business_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $business_type_view->showPageHeader(); ?>
<?php
$business_type_view->showMessage();
?>
<form name="fbusiness_typeview" id="fbusiness_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_type">
<input type="hidden" name="modal" value="<?php echo (int)$business_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($business_type_view->business_type_id->Visible) { // business_type_id ?>
	<tr id="r_business_type_id">
		<td class="<?php echo $business_type_view->TableLeftColumnClass ?>"><span id="elh_business_type_business_type_id"><?php echo $business_type_view->business_type_id->caption() ?></span></td>
		<td data-name="business_type_id" <?php echo $business_type_view->business_type_id->cellAttributes() ?>>
<span id="el_business_type_business_type_id">
<span<?php echo $business_type_view->business_type_id->viewAttributes() ?>><?php echo $business_type_view->business_type_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_type_view->business_type_name->Visible) { // business_type_name ?>
	<tr id="r_business_type_name">
		<td class="<?php echo $business_type_view->TableLeftColumnClass ?>"><span id="elh_business_type_business_type_name"><?php echo $business_type_view->business_type_name->caption() ?></span></td>
		<td data-name="business_type_name" <?php echo $business_type_view->business_type_name->cellAttributes() ?>>
<span id="el_business_type_business_type_name">
<span<?php echo $business_type_view->business_type_name->viewAttributes() ?>><?php echo $business_type_view->business_type_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_type_view->business_type_desc->Visible) { // business_type_desc ?>
	<tr id="r_business_type_desc">
		<td class="<?php echo $business_type_view->TableLeftColumnClass ?>"><span id="elh_business_type_business_type_desc"><?php echo $business_type_view->business_type_desc->caption() ?></span></td>
		<td data-name="business_type_desc" <?php echo $business_type_view->business_type_desc->cellAttributes() ?>>
<span id="el_business_type_business_type_desc">
<span<?php echo $business_type_view->business_type_desc->viewAttributes() ?>><?php echo $business_type_view->business_type_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$business_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$business_type_view->isExport()) { ?>
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
$business_type_view->terminate();
?>