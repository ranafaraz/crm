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
$state_view = new state_view();

// Run the page
$state_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$state_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$state_view->isExport()) { ?>
<script>
var fstateview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fstateview = currentForm = new ew.Form("fstateview", "view");
	loadjs.done("fstateview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$state_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $state_view->ExportOptions->render("body") ?>
<?php $state_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $state_view->showPageHeader(); ?>
<?php
$state_view->showMessage();
?>
<form name="fstateview" id="fstateview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="state">
<input type="hidden" name="modal" value="<?php echo (int)$state_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($state_view->state_id->Visible) { // state_id ?>
	<tr id="r_state_id">
		<td class="<?php echo $state_view->TableLeftColumnClass ?>"><span id="elh_state_state_id"><?php echo $state_view->state_id->caption() ?></span></td>
		<td data-name="state_id" <?php echo $state_view->state_id->cellAttributes() ?>>
<span id="el_state_state_id">
<span<?php echo $state_view->state_id->viewAttributes() ?>><?php echo $state_view->state_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($state_view->state_country_id->Visible) { // state_country_id ?>
	<tr id="r_state_country_id">
		<td class="<?php echo $state_view->TableLeftColumnClass ?>"><span id="elh_state_state_country_id"><?php echo $state_view->state_country_id->caption() ?></span></td>
		<td data-name="state_country_id" <?php echo $state_view->state_country_id->cellAttributes() ?>>
<span id="el_state_state_country_id">
<span<?php echo $state_view->state_country_id->viewAttributes() ?>><?php echo $state_view->state_country_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($state_view->state_name->Visible) { // state_name ?>
	<tr id="r_state_name">
		<td class="<?php echo $state_view->TableLeftColumnClass ?>"><span id="elh_state_state_name"><?php echo $state_view->state_name->caption() ?></span></td>
		<td data-name="state_name" <?php echo $state_view->state_name->cellAttributes() ?>>
<span id="el_state_state_name">
<span<?php echo $state_view->state_name->viewAttributes() ?>><?php echo $state_view->state_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$state_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$state_view->isExport()) { ?>
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
$state_view->terminate();
?>