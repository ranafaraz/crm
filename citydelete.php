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
$city_delete = new city_delete();

// Run the page
$city_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$city_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcitydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcitydelete = currentForm = new ew.Form("fcitydelete", "delete");
	loadjs.done("fcitydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $city_delete->showPageHeader(); ?>
<?php
$city_delete->showMessage();
?>
<form name="fcitydelete" id="fcitydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="city">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($city_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($city_delete->city_id->Visible) { // city_id ?>
		<th class="<?php echo $city_delete->city_id->headerCellClass() ?>"><span id="elh_city_city_id" class="city_city_id"><?php echo $city_delete->city_id->caption() ?></span></th>
<?php } ?>
<?php if ($city_delete->city_tehsil_id->Visible) { // city_tehsil_id ?>
		<th class="<?php echo $city_delete->city_tehsil_id->headerCellClass() ?>"><span id="elh_city_city_tehsil_id" class="city_city_tehsil_id"><?php echo $city_delete->city_tehsil_id->caption() ?></span></th>
<?php } ?>
<?php if ($city_delete->city_name->Visible) { // city_name ?>
		<th class="<?php echo $city_delete->city_name->headerCellClass() ?>"><span id="elh_city_city_name" class="city_city_name"><?php echo $city_delete->city_name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$city_delete->RecordCount = 0;
$i = 0;
while (!$city_delete->Recordset->EOF) {
	$city_delete->RecordCount++;
	$city_delete->RowCount++;

	// Set row properties
	$city->resetAttributes();
	$city->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$city_delete->loadRowValues($city_delete->Recordset);

	// Render row
	$city_delete->renderRow();
?>
	<tr <?php echo $city->rowAttributes() ?>>
<?php if ($city_delete->city_id->Visible) { // city_id ?>
		<td <?php echo $city_delete->city_id->cellAttributes() ?>>
<span id="el<?php echo $city_delete->RowCount ?>_city_city_id" class="city_city_id">
<span<?php echo $city_delete->city_id->viewAttributes() ?>><?php echo $city_delete->city_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($city_delete->city_tehsil_id->Visible) { // city_tehsil_id ?>
		<td <?php echo $city_delete->city_tehsil_id->cellAttributes() ?>>
<span id="el<?php echo $city_delete->RowCount ?>_city_city_tehsil_id" class="city_city_tehsil_id">
<span<?php echo $city_delete->city_tehsil_id->viewAttributes() ?>><?php echo $city_delete->city_tehsil_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($city_delete->city_name->Visible) { // city_name ?>
		<td <?php echo $city_delete->city_name->cellAttributes() ?>>
<span id="el<?php echo $city_delete->RowCount ?>_city_city_name" class="city_city_name">
<span<?php echo $city_delete->city_name->viewAttributes() ?>><?php echo $city_delete->city_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$city_delete->Recordset->moveNext();
}
$city_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $city_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$city_delete->showPageFooter();
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
$city_delete->terminate();
?>