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
$reference_letter_view = new reference_letter_view();

// Run the page
$reference_letter_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$reference_letter_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$reference_letter_view->isExport()) { ?>
<script>
var freference_letterview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	freference_letterview = currentForm = new ew.Form("freference_letterview", "view");
	loadjs.done("freference_letterview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$reference_letter_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $reference_letter_view->ExportOptions->render("body") ?>
<?php $reference_letter_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $reference_letter_view->showPageHeader(); ?>
<?php
$reference_letter_view->showMessage();
?>
<form name="freference_letterview" id="freference_letterview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="reference_letter">
<input type="hidden" name="modal" value="<?php echo (int)$reference_letter_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($reference_letter_view->ref_letter_id->Visible) { // ref_letter_id ?>
	<tr id="r_ref_letter_id">
		<td class="<?php echo $reference_letter_view->TableLeftColumnClass ?>"><span id="elh_reference_letter_ref_letter_id"><?php echo $reference_letter_view->ref_letter_id->caption() ?></span></td>
		<td data-name="ref_letter_id" <?php echo $reference_letter_view->ref_letter_id->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_id">
<span<?php echo $reference_letter_view->ref_letter_id->viewAttributes() ?>><?php echo $reference_letter_view->ref_letter_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reference_letter_view->ref_letter_branch_id->Visible) { // ref_letter_branch_id ?>
	<tr id="r_ref_letter_branch_id">
		<td class="<?php echo $reference_letter_view->TableLeftColumnClass ?>"><span id="elh_reference_letter_ref_letter_branch_id"><?php echo $reference_letter_view->ref_letter_branch_id->caption() ?></span></td>
		<td data-name="ref_letter_branch_id" <?php echo $reference_letter_view->ref_letter_branch_id->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_branch_id">
<span<?php echo $reference_letter_view->ref_letter_branch_id->viewAttributes() ?>><?php echo $reference_letter_view->ref_letter_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reference_letter_view->ref_letter_to_whom->Visible) { // ref_letter_to_whom ?>
	<tr id="r_ref_letter_to_whom">
		<td class="<?php echo $reference_letter_view->TableLeftColumnClass ?>"><span id="elh_reference_letter_ref_letter_to_whom"><?php echo $reference_letter_view->ref_letter_to_whom->caption() ?></span></td>
		<td data-name="ref_letter_to_whom" <?php echo $reference_letter_view->ref_letter_to_whom->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_to_whom">
<span<?php echo $reference_letter_view->ref_letter_to_whom->viewAttributes() ?>><?php echo $reference_letter_view->ref_letter_to_whom->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reference_letter_view->ref_letter_by_whom->Visible) { // ref_letter_by_whom ?>
	<tr id="r_ref_letter_by_whom">
		<td class="<?php echo $reference_letter_view->TableLeftColumnClass ?>"><span id="elh_reference_letter_ref_letter_by_whom"><?php echo $reference_letter_view->ref_letter_by_whom->caption() ?></span></td>
		<td data-name="ref_letter_by_whom" <?php echo $reference_letter_view->ref_letter_by_whom->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_by_whom">
<span<?php echo $reference_letter_view->ref_letter_by_whom->viewAttributes() ?>><?php echo $reference_letter_view->ref_letter_by_whom->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reference_letter_view->ref_letter_content->Visible) { // ref_letter_content ?>
	<tr id="r_ref_letter_content">
		<td class="<?php echo $reference_letter_view->TableLeftColumnClass ?>"><span id="elh_reference_letter_ref_letter_content"><?php echo $reference_letter_view->ref_letter_content->caption() ?></span></td>
		<td data-name="ref_letter_content" <?php echo $reference_letter_view->ref_letter_content->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_content">
<span<?php echo $reference_letter_view->ref_letter_content->viewAttributes() ?>><?php echo $reference_letter_view->ref_letter_content->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reference_letter_view->ref_letter_scanned->Visible) { // ref_letter_scanned ?>
	<tr id="r_ref_letter_scanned">
		<td class="<?php echo $reference_letter_view->TableLeftColumnClass ?>"><span id="elh_reference_letter_ref_letter_scanned"><?php echo $reference_letter_view->ref_letter_scanned->caption() ?></span></td>
		<td data-name="ref_letter_scanned" <?php echo $reference_letter_view->ref_letter_scanned->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_scanned">
<span<?php echo $reference_letter_view->ref_letter_scanned->viewAttributes() ?>><?php echo $reference_letter_view->ref_letter_scanned->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reference_letter_view->ref_letter_date->Visible) { // ref_letter_date ?>
	<tr id="r_ref_letter_date">
		<td class="<?php echo $reference_letter_view->TableLeftColumnClass ?>"><span id="elh_reference_letter_ref_letter_date"><?php echo $reference_letter_view->ref_letter_date->caption() ?></span></td>
		<td data-name="ref_letter_date" <?php echo $reference_letter_view->ref_letter_date->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_date">
<span<?php echo $reference_letter_view->ref_letter_date->viewAttributes() ?>><?php echo $reference_letter_view->ref_letter_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reference_letter_view->ref_letter_comments->Visible) { // ref_letter_comments ?>
	<tr id="r_ref_letter_comments">
		<td class="<?php echo $reference_letter_view->TableLeftColumnClass ?>"><span id="elh_reference_letter_ref_letter_comments"><?php echo $reference_letter_view->ref_letter_comments->caption() ?></span></td>
		<td data-name="ref_letter_comments" <?php echo $reference_letter_view->ref_letter_comments->cellAttributes() ?>>
<span id="el_reference_letter_ref_letter_comments">
<span<?php echo $reference_letter_view->ref_letter_comments->viewAttributes() ?>><?php echo $reference_letter_view->ref_letter_comments->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$reference_letter_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$reference_letter_view->isExport()) { ?>
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
$reference_letter_view->terminate();
?>