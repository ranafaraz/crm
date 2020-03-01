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
$country_delete = new country_delete();

// Run the page
$country_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$country_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcountrydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcountrydelete = currentForm = new ew.Form("fcountrydelete", "delete");
	loadjs.done("fcountrydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $country_delete->showPageHeader(); ?>
<?php
$country_delete->showMessage();
?>
<form name="fcountrydelete" id="fcountrydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="country">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($country_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($country_delete->country_id->Visible) { // country_id ?>
		<th class="<?php echo $country_delete->country_id->headerCellClass() ?>"><span id="elh_country_country_id" class="country_country_id"><?php echo $country_delete->country_id->caption() ?></span></th>
<?php } ?>
<?php if ($country_delete->country_name->Visible) { // country_name ?>
		<th class="<?php echo $country_delete->country_name->headerCellClass() ?>"><span id="elh_country_country_name" class="country_country_name"><?php echo $country_delete->country_name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$country_delete->RecordCount = 0;
$i = 0;
while (!$country_delete->Recordset->EOF) {
	$country_delete->RecordCount++;
	$country_delete->RowCount++;

	// Set row properties
	$country->resetAttributes();
	$country->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$country_delete->loadRowValues($country_delete->Recordset);

	// Render row
	$country_delete->renderRow();
?>
	<tr <?php echo $country->rowAttributes() ?>>
<?php if ($country_delete->country_id->Visible) { // country_id ?>
		<td <?php echo $country_delete->country_id->cellAttributes() ?>>
<span id="el<?php echo $country_delete->RowCount ?>_country_country_id" class="country_country_id">
<span<?php echo $country_delete->country_id->viewAttributes() ?>><?php echo $country_delete->country_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($country_delete->country_name->Visible) { // country_name ?>
		<td <?php echo $country_delete->country_name->cellAttributes() ?>>
<span id="el<?php echo $country_delete->RowCount ?>_country_country_name" class="country_country_name">
<span<?php echo $country_delete->country_name->viewAttributes() ?>><?php echo $country_delete->country_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$country_delete->Recordset->moveNext();
}
$country_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $country_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$country_delete->showPageFooter();
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
$country_delete->terminate();
?>