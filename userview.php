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
$user_view = new user_view();

// Run the page
$user_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$user_view->isExport()) { ?>
<script>
var fuserview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fuserview = currentForm = new ew.Form("fuserview", "view");
	loadjs.done("fuserview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$user_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $user_view->ExportOptions->render("body") ?>
<?php $user_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $user_view->showPageHeader(); ?>
<?php
$user_view->showMessage();
?>
<form name="fuserview" id="fuserview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="modal" value="<?php echo (int)$user_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($user_view->user_id->Visible) { // user_id ?>
	<tr id="r_user_id">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_user_id"><?php echo $user_view->user_id->caption() ?></span></td>
		<td data-name="user_id" <?php echo $user_view->user_id->cellAttributes() ?>>
<span id="el_user_user_id">
<span<?php echo $user_view->user_id->viewAttributes() ?>><?php echo $user_view->user_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user_view->user_branch_id->Visible) { // user_branch_id ?>
	<tr id="r_user_branch_id">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_user_branch_id"><?php echo $user_view->user_branch_id->caption() ?></span></td>
		<td data-name="user_branch_id" <?php echo $user_view->user_branch_id->cellAttributes() ?>>
<span id="el_user_user_branch_id">
<span<?php echo $user_view->user_branch_id->viewAttributes() ?>><?php echo $user_view->user_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user_view->user_type_id->Visible) { // user_type_id ?>
	<tr id="r_user_type_id">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_user_type_id"><?php echo $user_view->user_type_id->caption() ?></span></td>
		<td data-name="user_type_id" <?php echo $user_view->user_type_id->cellAttributes() ?>>
<span id="el_user_user_type_id">
<span<?php echo $user_view->user_type_id->viewAttributes() ?>><?php echo $user_view->user_type_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user_view->user_name->Visible) { // user_name ?>
	<tr id="r_user_name">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_user_name"><?php echo $user_view->user_name->caption() ?></span></td>
		<td data-name="user_name" <?php echo $user_view->user_name->cellAttributes() ?>>
<span id="el_user_user_name">
<span<?php echo $user_view->user_name->viewAttributes() ?>><?php echo $user_view->user_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user_view->user_password->Visible) { // user_password ?>
	<tr id="r_user_password">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_user_password"><?php echo $user_view->user_password->caption() ?></span></td>
		<td data-name="user_password" <?php echo $user_view->user_password->cellAttributes() ?>>
<span id="el_user_user_password">
<span<?php echo $user_view->user_password->viewAttributes() ?>><?php echo $user_view->user_password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user_view->user_email->Visible) { // user_email ?>
	<tr id="r_user_email">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_user_email"><?php echo $user_view->user_email->caption() ?></span></td>
		<td data-name="user_email" <?php echo $user_view->user_email->cellAttributes() ?>>
<span id="el_user_user_email">
<span<?php echo $user_view->user_email->viewAttributes() ?>><?php echo $user_view->user_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user_view->user_father->Visible) { // user_father ?>
	<tr id="r_user_father">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_user_father"><?php echo $user_view->user_father->caption() ?></span></td>
		<td data-name="user_father" <?php echo $user_view->user_father->cellAttributes() ?>>
<span id="el_user_user_father">
<span<?php echo $user_view->user_father->viewAttributes() ?>><?php echo $user_view->user_father->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user_view->user_photo->Visible) { // user_photo ?>
	<tr id="r_user_photo">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_user_photo"><?php echo $user_view->user_photo->caption() ?></span></td>
		<td data-name="user_photo" <?php echo $user_view->user_photo->cellAttributes() ?>>
<span id="el_user_user_photo">
<span<?php echo $user_view->user_photo->viewAttributes() ?>><?php echo $user_view->user_photo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user_view->user_cnic->Visible) { // user_cnic ?>
	<tr id="r_user_cnic">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_user_cnic"><?php echo $user_view->user_cnic->caption() ?></span></td>
		<td data-name="user_cnic" <?php echo $user_view->user_cnic->cellAttributes() ?>>
<span id="el_user_user_cnic">
<span<?php echo $user_view->user_cnic->viewAttributes() ?>><?php echo $user_view->user_cnic->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$user_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$user_view->isExport()) { ?>
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
$user_view->terminate();
?>