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
$acc_nature_view = new acc_nature_view();

// Run the page
$acc_nature_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acc_nature_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$acc_nature_view->isExport()) { ?>
<script>
var facc_natureview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	facc_natureview = currentForm = new ew.Form("facc_natureview", "view");
	loadjs.done("facc_natureview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$acc_nature_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $acc_nature_view->ExportOptions->render("body") ?>
<?php $acc_nature_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $acc_nature_view->showPageHeader(); ?>
<?php
$acc_nature_view->showMessage();
?>
<form name="facc_natureview" id="facc_natureview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acc_nature">
<input type="hidden" name="modal" value="<?php echo (int)$acc_nature_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($acc_nature_view->acc_nature_id->Visible) { // acc_nature_id ?>
	<tr id="r_acc_nature_id">
		<td class="<?php echo $acc_nature_view->TableLeftColumnClass ?>"><span id="elh_acc_nature_acc_nature_id"><?php echo $acc_nature_view->acc_nature_id->caption() ?></span></td>
		<td data-name="acc_nature_id" <?php echo $acc_nature_view->acc_nature_id->cellAttributes() ?>>
<span id="el_acc_nature_acc_nature_id">
<span<?php echo $acc_nature_view->acc_nature_id->viewAttributes() ?>><?php echo $acc_nature_view->acc_nature_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($acc_nature_view->acc_nature_name->Visible) { // acc_nature_name ?>
	<tr id="r_acc_nature_name">
		<td class="<?php echo $acc_nature_view->TableLeftColumnClass ?>"><span id="elh_acc_nature_acc_nature_name"><?php echo $acc_nature_view->acc_nature_name->caption() ?></span></td>
		<td data-name="acc_nature_name" <?php echo $acc_nature_view->acc_nature_name->cellAttributes() ?>>
<span id="el_acc_nature_acc_nature_name">
<span<?php echo $acc_nature_view->acc_nature_name->viewAttributes() ?>><?php echo $acc_nature_view->acc_nature_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($acc_nature_view->acc_nature_desc->Visible) { // acc_nature_desc ?>
	<tr id="r_acc_nature_desc">
		<td class="<?php echo $acc_nature_view->TableLeftColumnClass ?>"><span id="elh_acc_nature_acc_nature_desc"><?php echo $acc_nature_view->acc_nature_desc->caption() ?></span></td>
		<td data-name="acc_nature_desc" <?php echo $acc_nature_view->acc_nature_desc->cellAttributes() ?>>
<span id="el_acc_nature_acc_nature_desc">
<span<?php echo $acc_nature_view->acc_nature_desc->viewAttributes() ?>><?php echo $acc_nature_view->acc_nature_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$acc_nature_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$acc_nature_view->isExport()) { ?>
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
$acc_nature_view->terminate();
?>