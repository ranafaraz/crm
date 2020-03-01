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
$referral_delete = new referral_delete();

// Run the page
$referral_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$referral_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freferraldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	freferraldelete = currentForm = new ew.Form("freferraldelete", "delete");
	loadjs.done("freferraldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $referral_delete->showPageHeader(); ?>
<?php
$referral_delete->showMessage();
?>
<form name="freferraldelete" id="freferraldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="referral">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($referral_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($referral_delete->referral_id->Visible) { // referral_id ?>
		<th class="<?php echo $referral_delete->referral_id->headerCellClass() ?>"><span id="elh_referral_referral_id" class="referral_referral_id"><?php echo $referral_delete->referral_id->caption() ?></span></th>
<?php } ?>
<?php if ($referral_delete->referral_branch_id->Visible) { // referral_branch_id ?>
		<th class="<?php echo $referral_delete->referral_branch_id->headerCellClass() ?>"><span id="elh_referral_referral_branch_id" class="referral_referral_branch_id"><?php echo $referral_delete->referral_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($referral_delete->referral_name->Visible) { // referral_name ?>
		<th class="<?php echo $referral_delete->referral_name->headerCellClass() ?>"><span id="elh_referral_referral_name" class="referral_referral_name"><?php echo $referral_delete->referral_name->caption() ?></span></th>
<?php } ?>
<?php if ($referral_delete->referral_desc->Visible) { // referral_desc ?>
		<th class="<?php echo $referral_delete->referral_desc->headerCellClass() ?>"><span id="elh_referral_referral_desc" class="referral_referral_desc"><?php echo $referral_delete->referral_desc->caption() ?></span></th>
<?php } ?>
<?php if ($referral_delete->referral_deal_signed->Visible) { // referral_deal_signed ?>
		<th class="<?php echo $referral_delete->referral_deal_signed->headerCellClass() ?>"><span id="elh_referral_referral_deal_signed" class="referral_referral_deal_signed"><?php echo $referral_delete->referral_deal_signed->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$referral_delete->RecordCount = 0;
$i = 0;
while (!$referral_delete->Recordset->EOF) {
	$referral_delete->RecordCount++;
	$referral_delete->RowCount++;

	// Set row properties
	$referral->resetAttributes();
	$referral->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$referral_delete->loadRowValues($referral_delete->Recordset);

	// Render row
	$referral_delete->renderRow();
?>
	<tr <?php echo $referral->rowAttributes() ?>>
<?php if ($referral_delete->referral_id->Visible) { // referral_id ?>
		<td <?php echo $referral_delete->referral_id->cellAttributes() ?>>
<span id="el<?php echo $referral_delete->RowCount ?>_referral_referral_id" class="referral_referral_id">
<span<?php echo $referral_delete->referral_id->viewAttributes() ?>><?php echo $referral_delete->referral_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($referral_delete->referral_branch_id->Visible) { // referral_branch_id ?>
		<td <?php echo $referral_delete->referral_branch_id->cellAttributes() ?>>
<span id="el<?php echo $referral_delete->RowCount ?>_referral_referral_branch_id" class="referral_referral_branch_id">
<span<?php echo $referral_delete->referral_branch_id->viewAttributes() ?>><?php echo $referral_delete->referral_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($referral_delete->referral_name->Visible) { // referral_name ?>
		<td <?php echo $referral_delete->referral_name->cellAttributes() ?>>
<span id="el<?php echo $referral_delete->RowCount ?>_referral_referral_name" class="referral_referral_name">
<span<?php echo $referral_delete->referral_name->viewAttributes() ?>><?php echo $referral_delete->referral_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($referral_delete->referral_desc->Visible) { // referral_desc ?>
		<td <?php echo $referral_delete->referral_desc->cellAttributes() ?>>
<span id="el<?php echo $referral_delete->RowCount ?>_referral_referral_desc" class="referral_referral_desc">
<span<?php echo $referral_delete->referral_desc->viewAttributes() ?>><?php echo $referral_delete->referral_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($referral_delete->referral_deal_signed->Visible) { // referral_deal_signed ?>
		<td <?php echo $referral_delete->referral_deal_signed->cellAttributes() ?>>
<span id="el<?php echo $referral_delete->RowCount ?>_referral_referral_deal_signed" class="referral_referral_deal_signed">
<span<?php echo $referral_delete->referral_deal_signed->viewAttributes() ?>><?php echo $referral_delete->referral_deal_signed->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$referral_delete->Recordset->moveNext();
}
$referral_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $referral_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$referral_delete->showPageFooter();
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
$referral_delete->terminate();
?>