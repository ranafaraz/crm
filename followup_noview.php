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
$followup_no_view = new followup_no_view();

// Run the page
$followup_no_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$followup_no_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$followup_no_view->isExport()) { ?>
<script>
var ffollowup_noview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ffollowup_noview = currentForm = new ew.Form("ffollowup_noview", "view");
	loadjs.done("ffollowup_noview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$followup_no_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $followup_no_view->ExportOptions->render("body") ?>
<?php $followup_no_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $followup_no_view->showPageHeader(); ?>
<?php
$followup_no_view->showMessage();
?>
<?php if (!$followup_no_view->IsModal) { ?>
<?php if (!$followup_no_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $followup_no_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ffollowup_noview" id="ffollowup_noview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="followup_no">
<input type="hidden" name="modal" value="<?php echo (int)$followup_no_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($followup_no_view->followup_no_id->Visible) { // followup_no_id ?>
	<tr id="r_followup_no_id">
		<td class="<?php echo $followup_no_view->TableLeftColumnClass ?>"><span id="elh_followup_no_followup_no_id"><?php echo $followup_no_view->followup_no_id->caption() ?></span></td>
		<td data-name="followup_no_id" <?php echo $followup_no_view->followup_no_id->cellAttributes() ?>>
<span id="el_followup_no_followup_no_id">
<span<?php echo $followup_no_view->followup_no_id->viewAttributes() ?>><?php echo $followup_no_view->followup_no_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($followup_no_view->followup_no_caption->Visible) { // followup_no_caption ?>
	<tr id="r_followup_no_caption">
		<td class="<?php echo $followup_no_view->TableLeftColumnClass ?>"><span id="elh_followup_no_followup_no_caption"><?php echo $followup_no_view->followup_no_caption->caption() ?></span></td>
		<td data-name="followup_no_caption" <?php echo $followup_no_view->followup_no_caption->cellAttributes() ?>>
<span id="el_followup_no_followup_no_caption">
<span<?php echo $followup_no_view->followup_no_caption->viewAttributes() ?>><?php echo $followup_no_view->followup_no_caption->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$followup_no_view->IsModal) { ?>
<?php if (!$followup_no_view->isExport()) { ?>
<?php echo $followup_no_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$followup_no_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$followup_no_view->isExport()) { ?>
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
$followup_no_view->terminate();
?>