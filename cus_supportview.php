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
$cus_support_view = new cus_support_view();

// Run the page
$cus_support_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cus_support_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cus_support_view->isExport()) { ?>
<script>
var fcus_supportview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcus_supportview = currentForm = new ew.Form("fcus_supportview", "view");
	loadjs.done("fcus_supportview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cus_support_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $cus_support_view->ExportOptions->render("body") ?>
<?php $cus_support_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $cus_support_view->showPageHeader(); ?>
<?php
$cus_support_view->showMessage();
?>
<form name="fcus_supportview" id="fcus_supportview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cus_support">
<input type="hidden" name="modal" value="<?php echo (int)$cus_support_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($cus_support_view->cus_sup_id->Visible) { // cus_sup_id ?>
	<tr id="r_cus_sup_id">
		<td class="<?php echo $cus_support_view->TableLeftColumnClass ?>"><span id="elh_cus_support_cus_sup_id"><?php echo $cus_support_view->cus_sup_id->caption() ?></span></td>
		<td data-name="cus_sup_id" <?php echo $cus_support_view->cus_sup_id->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_id">
<span<?php echo $cus_support_view->cus_sup_id->viewAttributes() ?>><?php echo $cus_support_view->cus_sup_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cus_support_view->cus_sup_branch_id->Visible) { // cus_sup_branch_id ?>
	<tr id="r_cus_sup_branch_id">
		<td class="<?php echo $cus_support_view->TableLeftColumnClass ?>"><span id="elh_cus_support_cus_sup_branch_id"><?php echo $cus_support_view->cus_sup_branch_id->caption() ?></span></td>
		<td data-name="cus_sup_branch_id" <?php echo $cus_support_view->cus_sup_branch_id->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_branch_id">
<span<?php echo $cus_support_view->cus_sup_branch_id->viewAttributes() ?>><?php echo $cus_support_view->cus_sup_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cus_support_view->cus_sup_emp_id->Visible) { // cus_sup_emp_id ?>
	<tr id="r_cus_sup_emp_id">
		<td class="<?php echo $cus_support_view->TableLeftColumnClass ?>"><span id="elh_cus_support_cus_sup_emp_id"><?php echo $cus_support_view->cus_sup_emp_id->caption() ?></span></td>
		<td data-name="cus_sup_emp_id" <?php echo $cus_support_view->cus_sup_emp_id->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_emp_id">
<span<?php echo $cus_support_view->cus_sup_emp_id->viewAttributes() ?>><?php echo $cus_support_view->cus_sup_emp_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cus_support_view->cus_sup_query->Visible) { // cus_sup_query ?>
	<tr id="r_cus_sup_query">
		<td class="<?php echo $cus_support_view->TableLeftColumnClass ?>"><span id="elh_cus_support_cus_sup_query"><?php echo $cus_support_view->cus_sup_query->caption() ?></span></td>
		<td data-name="cus_sup_query" <?php echo $cus_support_view->cus_sup_query->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_query">
<span<?php echo $cus_support_view->cus_sup_query->viewAttributes() ?>><?php echo $cus_support_view->cus_sup_query->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cus_support_view->cus_sup_screen_shots->Visible) { // cus_sup_screen_shots ?>
	<tr id="r_cus_sup_screen_shots">
		<td class="<?php echo $cus_support_view->TableLeftColumnClass ?>"><span id="elh_cus_support_cus_sup_screen_shots"><?php echo $cus_support_view->cus_sup_screen_shots->caption() ?></span></td>
		<td data-name="cus_sup_screen_shots" <?php echo $cus_support_view->cus_sup_screen_shots->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_screen_shots">
<span><?php echo GetFileViewTag($cus_support_view->cus_sup_screen_shots, $cus_support_view->cus_sup_screen_shots->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cus_support_view->cus_sup_date->Visible) { // cus_sup_date ?>
	<tr id="r_cus_sup_date">
		<td class="<?php echo $cus_support_view->TableLeftColumnClass ?>"><span id="elh_cus_support_cus_sup_date"><?php echo $cus_support_view->cus_sup_date->caption() ?></span></td>
		<td data-name="cus_sup_date" <?php echo $cus_support_view->cus_sup_date->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_date">
<span<?php echo $cus_support_view->cus_sup_date->viewAttributes() ?>><?php echo $cus_support_view->cus_sup_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cus_support_view->cus_sup_status->Visible) { // cus_sup_status ?>
	<tr id="r_cus_sup_status">
		<td class="<?php echo $cus_support_view->TableLeftColumnClass ?>"><span id="elh_cus_support_cus_sup_status"><?php echo $cus_support_view->cus_sup_status->caption() ?></span></td>
		<td data-name="cus_sup_status" <?php echo $cus_support_view->cus_sup_status->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_status">
<span<?php echo $cus_support_view->cus_sup_status->viewAttributes() ?>><?php echo $cus_support_view->cus_sup_status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cus_support_view->cus_sup_comments->Visible) { // cus_sup_comments ?>
	<tr id="r_cus_sup_comments">
		<td class="<?php echo $cus_support_view->TableLeftColumnClass ?>"><span id="elh_cus_support_cus_sup_comments"><?php echo $cus_support_view->cus_sup_comments->caption() ?></span></td>
		<td data-name="cus_sup_comments" <?php echo $cus_support_view->cus_sup_comments->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_comments">
<span<?php echo $cus_support_view->cus_sup_comments->viewAttributes() ?>><?php echo $cus_support_view->cus_sup_comments->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cus_support_view->cus_sup_resolved_on->Visible) { // cus_sup_resolved_on ?>
	<tr id="r_cus_sup_resolved_on">
		<td class="<?php echo $cus_support_view->TableLeftColumnClass ?>"><span id="elh_cus_support_cus_sup_resolved_on"><?php echo $cus_support_view->cus_sup_resolved_on->caption() ?></span></td>
		<td data-name="cus_sup_resolved_on" <?php echo $cus_support_view->cus_sup_resolved_on->cellAttributes() ?>>
<span id="el_cus_support_cus_sup_resolved_on">
<span<?php echo $cus_support_view->cus_sup_resolved_on->viewAttributes() ?>><?php echo $cus_support_view->cus_sup_resolved_on->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$cus_support_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cus_support_view->isExport()) { ?>
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
$cus_support_view->terminate();
?>