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
$business_nature_delete = new business_nature_delete();

// Run the page
$business_nature_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_nature_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusiness_naturedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbusiness_naturedelete = currentForm = new ew.Form("fbusiness_naturedelete", "delete");
	loadjs.done("fbusiness_naturedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_nature_delete->showPageHeader(); ?>
<?php
$business_nature_delete->showMessage();
?>
<form name="fbusiness_naturedelete" id="fbusiness_naturedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_nature">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($business_nature_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($business_nature_delete->b_nature_id->Visible) { // b_nature_id ?>
		<th class="<?php echo $business_nature_delete->b_nature_id->headerCellClass() ?>"><span id="elh_business_nature_b_nature_id" class="business_nature_b_nature_id"><?php echo $business_nature_delete->b_nature_id->caption() ?></span></th>
<?php } ?>
<?php if ($business_nature_delete->b_nature_caption->Visible) { // b_nature_caption ?>
		<th class="<?php echo $business_nature_delete->b_nature_caption->headerCellClass() ?>"><span id="elh_business_nature_b_nature_caption" class="business_nature_b_nature_caption"><?php echo $business_nature_delete->b_nature_caption->caption() ?></span></th>
<?php } ?>
<?php if ($business_nature_delete->b_nature_desc->Visible) { // b_nature_desc ?>
		<th class="<?php echo $business_nature_delete->b_nature_desc->headerCellClass() ?>"><span id="elh_business_nature_b_nature_desc" class="business_nature_b_nature_desc"><?php echo $business_nature_delete->b_nature_desc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$business_nature_delete->RecordCount = 0;
$i = 0;
while (!$business_nature_delete->Recordset->EOF) {
	$business_nature_delete->RecordCount++;
	$business_nature_delete->RowCount++;

	// Set row properties
	$business_nature->resetAttributes();
	$business_nature->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$business_nature_delete->loadRowValues($business_nature_delete->Recordset);

	// Render row
	$business_nature_delete->renderRow();
?>
	<tr <?php echo $business_nature->rowAttributes() ?>>
<?php if ($business_nature_delete->b_nature_id->Visible) { // b_nature_id ?>
		<td <?php echo $business_nature_delete->b_nature_id->cellAttributes() ?>>
<span id="el<?php echo $business_nature_delete->RowCount ?>_business_nature_b_nature_id" class="business_nature_b_nature_id">
<span<?php echo $business_nature_delete->b_nature_id->viewAttributes() ?>><?php echo $business_nature_delete->b_nature_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_nature_delete->b_nature_caption->Visible) { // b_nature_caption ?>
		<td <?php echo $business_nature_delete->b_nature_caption->cellAttributes() ?>>
<span id="el<?php echo $business_nature_delete->RowCount ?>_business_nature_b_nature_caption" class="business_nature_b_nature_caption">
<span<?php echo $business_nature_delete->b_nature_caption->viewAttributes() ?>><?php echo $business_nature_delete->b_nature_caption->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_nature_delete->b_nature_desc->Visible) { // b_nature_desc ?>
		<td <?php echo $business_nature_delete->b_nature_desc->cellAttributes() ?>>
<span id="el<?php echo $business_nature_delete->RowCount ?>_business_nature_b_nature_desc" class="business_nature_b_nature_desc">
<span<?php echo $business_nature_delete->b_nature_desc->viewAttributes() ?>><?php echo $business_nature_delete->b_nature_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$business_nature_delete->Recordset->moveNext();
}
$business_nature_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $business_nature_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$business_nature_delete->showPageFooter();
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
$business_nature_delete->terminate();
?>