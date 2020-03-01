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
$user_type_delete = new user_type_delete();

// Run the page
$user_type_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuser_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fuser_typedelete = currentForm = new ew.Form("fuser_typedelete", "delete");
	loadjs.done("fuser_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $user_type_delete->showPageHeader(); ?>
<?php
$user_type_delete->showMessage();
?>
<form name="fuser_typedelete" id="fuser_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($user_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($user_type_delete->user_type_id->Visible) { // user_type_id ?>
		<th class="<?php echo $user_type_delete->user_type_id->headerCellClass() ?>"><span id="elh_user_type_user_type_id" class="user_type_user_type_id"><?php echo $user_type_delete->user_type_id->caption() ?></span></th>
<?php } ?>
<?php if ($user_type_delete->user_type_name->Visible) { // user_type_name ?>
		<th class="<?php echo $user_type_delete->user_type_name->headerCellClass() ?>"><span id="elh_user_type_user_type_name" class="user_type_user_type_name"><?php echo $user_type_delete->user_type_name->caption() ?></span></th>
<?php } ?>
<?php if ($user_type_delete->user_type_desc->Visible) { // user_type_desc ?>
		<th class="<?php echo $user_type_delete->user_type_desc->headerCellClass() ?>"><span id="elh_user_type_user_type_desc" class="user_type_user_type_desc"><?php echo $user_type_delete->user_type_desc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$user_type_delete->RecordCount = 0;
$i = 0;
while (!$user_type_delete->Recordset->EOF) {
	$user_type_delete->RecordCount++;
	$user_type_delete->RowCount++;

	// Set row properties
	$user_type->resetAttributes();
	$user_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$user_type_delete->loadRowValues($user_type_delete->Recordset);

	// Render row
	$user_type_delete->renderRow();
?>
	<tr <?php echo $user_type->rowAttributes() ?>>
<?php if ($user_type_delete->user_type_id->Visible) { // user_type_id ?>
		<td <?php echo $user_type_delete->user_type_id->cellAttributes() ?>>
<span id="el<?php echo $user_type_delete->RowCount ?>_user_type_user_type_id" class="user_type_user_type_id">
<span<?php echo $user_type_delete->user_type_id->viewAttributes() ?>><?php echo $user_type_delete->user_type_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_type_delete->user_type_name->Visible) { // user_type_name ?>
		<td <?php echo $user_type_delete->user_type_name->cellAttributes() ?>>
<span id="el<?php echo $user_type_delete->RowCount ?>_user_type_user_type_name" class="user_type_user_type_name">
<span<?php echo $user_type_delete->user_type_name->viewAttributes() ?>><?php echo $user_type_delete->user_type_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_type_delete->user_type_desc->Visible) { // user_type_desc ?>
		<td <?php echo $user_type_delete->user_type_desc->cellAttributes() ?>>
<span id="el<?php echo $user_type_delete->RowCount ?>_user_type_user_type_desc" class="user_type_user_type_desc">
<span<?php echo $user_type_delete->user_type_desc->viewAttributes() ?>><?php echo $user_type_delete->user_type_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$user_type_delete->Recordset->moveNext();
}
$user_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$user_type_delete->showPageFooter();
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
$user_type_delete->terminate();
?>