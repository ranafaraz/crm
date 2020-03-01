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
$acc_head_view = new acc_head_view();

// Run the page
$acc_head_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acc_head_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$acc_head_view->isExport()) { ?>
<script>
var facc_headview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	facc_headview = currentForm = new ew.Form("facc_headview", "view");
	loadjs.done("facc_headview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$acc_head_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $acc_head_view->ExportOptions->render("body") ?>
<?php $acc_head_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $acc_head_view->showPageHeader(); ?>
<?php
$acc_head_view->showMessage();
?>
<form name="facc_headview" id="facc_headview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acc_head">
<input type="hidden" name="modal" value="<?php echo (int)$acc_head_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($acc_head_view->acc_head_id->Visible) { // acc_head_id ?>
	<tr id="r_acc_head_id">
		<td class="<?php echo $acc_head_view->TableLeftColumnClass ?>"><span id="elh_acc_head_acc_head_id"><?php echo $acc_head_view->acc_head_id->caption() ?></span></td>
		<td data-name="acc_head_id" <?php echo $acc_head_view->acc_head_id->cellAttributes() ?>>
<span id="el_acc_head_acc_head_id">
<span<?php echo $acc_head_view->acc_head_id->viewAttributes() ?>><?php echo $acc_head_view->acc_head_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($acc_head_view->acc_head_acc_nature_id->Visible) { // acc_head_acc_nature_id ?>
	<tr id="r_acc_head_acc_nature_id">
		<td class="<?php echo $acc_head_view->TableLeftColumnClass ?>"><span id="elh_acc_head_acc_head_acc_nature_id"><?php echo $acc_head_view->acc_head_acc_nature_id->caption() ?></span></td>
		<td data-name="acc_head_acc_nature_id" <?php echo $acc_head_view->acc_head_acc_nature_id->cellAttributes() ?>>
<span id="el_acc_head_acc_head_acc_nature_id">
<span<?php echo $acc_head_view->acc_head_acc_nature_id->viewAttributes() ?>><?php echo $acc_head_view->acc_head_acc_nature_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($acc_head_view->acc_head_caption->Visible) { // acc_head_caption ?>
	<tr id="r_acc_head_caption">
		<td class="<?php echo $acc_head_view->TableLeftColumnClass ?>"><span id="elh_acc_head_acc_head_caption"><?php echo $acc_head_view->acc_head_caption->caption() ?></span></td>
		<td data-name="acc_head_caption" <?php echo $acc_head_view->acc_head_caption->cellAttributes() ?>>
<span id="el_acc_head_acc_head_caption">
<span<?php echo $acc_head_view->acc_head_caption->viewAttributes() ?>><?php echo $acc_head_view->acc_head_caption->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($acc_head_view->acc_head_desc->Visible) { // acc_head_desc ?>
	<tr id="r_acc_head_desc">
		<td class="<?php echo $acc_head_view->TableLeftColumnClass ?>"><span id="elh_acc_head_acc_head_desc"><?php echo $acc_head_view->acc_head_desc->caption() ?></span></td>
		<td data-name="acc_head_desc" <?php echo $acc_head_view->acc_head_desc->cellAttributes() ?>>
<span id="el_acc_head_acc_head_desc">
<span<?php echo $acc_head_view->acc_head_desc->viewAttributes() ?>><?php echo $acc_head_view->acc_head_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$acc_head_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$acc_head_view->isExport()) { ?>
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
$acc_head_view->terminate();
?>