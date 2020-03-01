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
$user_delete = new user_delete();

// Run the page
$user_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuserdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fuserdelete = currentForm = new ew.Form("fuserdelete", "delete");
	loadjs.done("fuserdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $user_delete->showPageHeader(); ?>
<?php
$user_delete->showMessage();
?>
<form name="fuserdelete" id="fuserdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($user_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($user_delete->user_id->Visible) { // user_id ?>
		<th class="<?php echo $user_delete->user_id->headerCellClass() ?>"><span id="elh_user_user_id" class="user_user_id"><?php echo $user_delete->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($user_delete->user_branch_id->Visible) { // user_branch_id ?>
		<th class="<?php echo $user_delete->user_branch_id->headerCellClass() ?>"><span id="elh_user_user_branch_id" class="user_user_branch_id"><?php echo $user_delete->user_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($user_delete->user_type_id->Visible) { // user_type_id ?>
		<th class="<?php echo $user_delete->user_type_id->headerCellClass() ?>"><span id="elh_user_user_type_id" class="user_user_type_id"><?php echo $user_delete->user_type_id->caption() ?></span></th>
<?php } ?>
<?php if ($user_delete->user_name->Visible) { // user_name ?>
		<th class="<?php echo $user_delete->user_name->headerCellClass() ?>"><span id="elh_user_user_name" class="user_user_name"><?php echo $user_delete->user_name->caption() ?></span></th>
<?php } ?>
<?php if ($user_delete->user_password->Visible) { // user_password ?>
		<th class="<?php echo $user_delete->user_password->headerCellClass() ?>"><span id="elh_user_user_password" class="user_user_password"><?php echo $user_delete->user_password->caption() ?></span></th>
<?php } ?>
<?php if ($user_delete->user_email->Visible) { // user_email ?>
		<th class="<?php echo $user_delete->user_email->headerCellClass() ?>"><span id="elh_user_user_email" class="user_user_email"><?php echo $user_delete->user_email->caption() ?></span></th>
<?php } ?>
<?php if ($user_delete->user_father->Visible) { // user_father ?>
		<th class="<?php echo $user_delete->user_father->headerCellClass() ?>"><span id="elh_user_user_father" class="user_user_father"><?php echo $user_delete->user_father->caption() ?></span></th>
<?php } ?>
<?php if ($user_delete->user_cnic->Visible) { // user_cnic ?>
		<th class="<?php echo $user_delete->user_cnic->headerCellClass() ?>"><span id="elh_user_user_cnic" class="user_user_cnic"><?php echo $user_delete->user_cnic->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$user_delete->RecordCount = 0;
$i = 0;
while (!$user_delete->Recordset->EOF) {
	$user_delete->RecordCount++;
	$user_delete->RowCount++;

	// Set row properties
	$user->resetAttributes();
	$user->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$user_delete->loadRowValues($user_delete->Recordset);

	// Render row
	$user_delete->renderRow();
?>
	<tr <?php echo $user->rowAttributes() ?>>
<?php if ($user_delete->user_id->Visible) { // user_id ?>
		<td <?php echo $user_delete->user_id->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCount ?>_user_user_id" class="user_user_id">
<span<?php echo $user_delete->user_id->viewAttributes() ?>><?php echo $user_delete->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_delete->user_branch_id->Visible) { // user_branch_id ?>
		<td <?php echo $user_delete->user_branch_id->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCount ?>_user_user_branch_id" class="user_user_branch_id">
<span<?php echo $user_delete->user_branch_id->viewAttributes() ?>><?php echo $user_delete->user_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_delete->user_type_id->Visible) { // user_type_id ?>
		<td <?php echo $user_delete->user_type_id->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCount ?>_user_user_type_id" class="user_user_type_id">
<span<?php echo $user_delete->user_type_id->viewAttributes() ?>><?php echo $user_delete->user_type_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_delete->user_name->Visible) { // user_name ?>
		<td <?php echo $user_delete->user_name->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCount ?>_user_user_name" class="user_user_name">
<span<?php echo $user_delete->user_name->viewAttributes() ?>><?php echo $user_delete->user_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_delete->user_password->Visible) { // user_password ?>
		<td <?php echo $user_delete->user_password->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCount ?>_user_user_password" class="user_user_password">
<span<?php echo $user_delete->user_password->viewAttributes() ?>><?php echo $user_delete->user_password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_delete->user_email->Visible) { // user_email ?>
		<td <?php echo $user_delete->user_email->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCount ?>_user_user_email" class="user_user_email">
<span<?php echo $user_delete->user_email->viewAttributes() ?>><?php echo $user_delete->user_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_delete->user_father->Visible) { // user_father ?>
		<td <?php echo $user_delete->user_father->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCount ?>_user_user_father" class="user_user_father">
<span<?php echo $user_delete->user_father->viewAttributes() ?>><?php echo $user_delete->user_father->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_delete->user_cnic->Visible) { // user_cnic ?>
		<td <?php echo $user_delete->user_cnic->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCount ?>_user_user_cnic" class="user_user_cnic">
<span<?php echo $user_delete->user_cnic->viewAttributes() ?>><?php echo $user_delete->user_cnic->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$user_delete->Recordset->moveNext();
}
$user_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$user_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$user_delete->terminate();
?>