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
$invoices_list = new invoices_list();

// Run the page
$invoices_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$invoices_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$invoices_list->isExport()) { ?>
<script>
var finvoiceslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	finvoiceslist = currentForm = new ew.Form("finvoiceslist", "list");
	finvoiceslist.formKeyCountName = '<?php echo $invoices_list->FormKeyCountName ?>';
	loadjs.done("finvoiceslist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$invoices_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($invoices_list->TotalRecords > 0 && $invoices_list->ExportOptions->visible()) { ?>
<?php $invoices_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($invoices_list->ImportOptions->visible()) { ?>
<?php $invoices_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$invoices_list->renderOtherOptions();
?>
<?php $invoices_list->showPageHeader(); ?>
<?php
$invoices_list->showMessage();
?>
<?php if ($invoices_list->TotalRecords > 0 || $invoices->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$invoices_list->isExport()) { ?>
<div>
<?php if (!$invoices_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $invoices_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $invoices_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="finvoiceslist" id="finvoiceslist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="invoices">
<div class="row ew-multi-column-row">
<?php if ($invoices_list->TotalRecords > 0 || $invoices_list->isGridEdit()) { ?>
<?php
if ($invoices_list->ExportAll && $invoices_list->isExport()) {
	$invoices_list->StopRecord = $invoices_list->TotalRecords;
} else {

	// Set the last record to display
	if ($invoices_list->TotalRecords > $invoices_list->StartRecord + $invoices_list->DisplayRecords - 1)
		$invoices_list->StopRecord = $invoices_list->StartRecord + $invoices_list->DisplayRecords - 1;
	else
		$invoices_list->StopRecord = $invoices_list->TotalRecords;
}
$invoices_list->RecordCount = $invoices_list->StartRecord - 1;
if ($invoices_list->Recordset && !$invoices_list->Recordset->EOF) {
	$invoices_list->Recordset->moveFirst();
	$selectLimit = $invoices_list->UseSelectLimit;
	if (!$selectLimit && $invoices_list->StartRecord > 1)
		$invoices_list->Recordset->move($invoices_list->StartRecord - 1);
} elseif (!$invoices->AllowAddDeleteRow && $invoices_list->StopRecord == 0) {
	$invoices_list->StopRecord = $invoices->GridAddRowCount;
}
while ($invoices_list->RecordCount < $invoices_list->StopRecord) {
	$invoices_list->RecordCount++;
	if ($invoices_list->RecordCount >= $invoices_list->StartRecord) {
		$invoices_list->RowCount++;

		// Set up key count
		$invoices_list->KeyCount = $invoices_list->RowIndex;

		// Init row class and style
		$invoices->resetAttributes();
		$invoices->CssClass = "";
		if ($invoices_list->isGridAdd()) {
		} else {
			$invoices_list->loadRowValues($invoices_list->Recordset); // Load row values
		}
		$invoices->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$invoices->RowAttrs->merge(["data-rowindex" => $invoices_list->RowCount, "id" => "r" . $invoices_list->RowCount . "_invoices", "data-rowtype" => $invoices->RowType]);

		// Render row
		$invoices_list->renderRow();

		// Render list options
		$invoices_list->renderListOptions();
?>
<div class="<?php echo $invoices_list->getMultiColumnClass() ?>" <?php echo $invoices->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($invoices->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($invoices_list->invoice_id->Visible) { // invoice_id ?>
		<?php if ($invoices->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $invoices_list->TableLeftColumnClass ?>"><span class="invoices_invoice_id">
<?php if ($invoices_list->isExport() || $invoices_list->SortUrl($invoices_list->invoice_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $invoices_list->invoice_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $invoices_list->invoice_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_id">
<span<?php echo $invoices_list->invoice_id->viewAttributes() ?>><?php echo $invoices_list->invoice_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row invoices_invoice_id">
			<label class="<?php echo $invoices_list->LeftColumnClass ?>"><?php echo $invoices_list->invoice_id->caption() ?></label>
			<div class="<?php echo $invoices_list->RightColumnClass ?>"><div <?php echo $invoices_list->invoice_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_id">
<span<?php echo $invoices_list->invoice_id->viewAttributes() ?>><?php echo $invoices_list->invoice_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($invoices_list->invoice_branch_id->Visible) { // invoice_branch_id ?>
		<?php if ($invoices->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $invoices_list->TableLeftColumnClass ?>"><span class="invoices_invoice_branch_id">
<?php if ($invoices_list->isExport() || $invoices_list->SortUrl($invoices_list->invoice_branch_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $invoices_list->invoice_branch_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_branch_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $invoices_list->invoice_branch_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_branch_id">
<span<?php echo $invoices_list->invoice_branch_id->viewAttributes() ?>><?php echo $invoices_list->invoice_branch_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row invoices_invoice_branch_id">
			<label class="<?php echo $invoices_list->LeftColumnClass ?>"><?php echo $invoices_list->invoice_branch_id->caption() ?></label>
			<div class="<?php echo $invoices_list->RightColumnClass ?>"><div <?php echo $invoices_list->invoice_branch_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_branch_id">
<span<?php echo $invoices_list->invoice_branch_id->viewAttributes() ?>><?php echo $invoices_list->invoice_branch_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($invoices_list->invoice_business_id->Visible) { // invoice_business_id ?>
		<?php if ($invoices->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $invoices_list->TableLeftColumnClass ?>"><span class="invoices_invoice_business_id">
<?php if ($invoices_list->isExport() || $invoices_list->SortUrl($invoices_list->invoice_business_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $invoices_list->invoice_business_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_business_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_business_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_business_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_business_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $invoices_list->invoice_business_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_business_id">
<span<?php echo $invoices_list->invoice_business_id->viewAttributes() ?>><?php echo $invoices_list->invoice_business_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row invoices_invoice_business_id">
			<label class="<?php echo $invoices_list->LeftColumnClass ?>"><?php echo $invoices_list->invoice_business_id->caption() ?></label>
			<div class="<?php echo $invoices_list->RightColumnClass ?>"><div <?php echo $invoices_list->invoice_business_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_business_id">
<span<?php echo $invoices_list->invoice_business_id->viewAttributes() ?>><?php echo $invoices_list->invoice_business_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($invoices_list->invoice_service_id->Visible) { // invoice_service_id ?>
		<?php if ($invoices->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $invoices_list->TableLeftColumnClass ?>"><span class="invoices_invoice_service_id">
<?php if ($invoices_list->isExport() || $invoices_list->SortUrl($invoices_list->invoice_service_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $invoices_list->invoice_service_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_service_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_service_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_service_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_service_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $invoices_list->invoice_service_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_service_id">
<span<?php echo $invoices_list->invoice_service_id->viewAttributes() ?>><?php echo $invoices_list->invoice_service_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row invoices_invoice_service_id">
			<label class="<?php echo $invoices_list->LeftColumnClass ?>"><?php echo $invoices_list->invoice_service_id->caption() ?></label>
			<div class="<?php echo $invoices_list->RightColumnClass ?>"><div <?php echo $invoices_list->invoice_service_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_service_id">
<span<?php echo $invoices_list->invoice_service_id->viewAttributes() ?>><?php echo $invoices_list->invoice_service_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($invoices_list->invoice_amount->Visible) { // invoice_amount ?>
		<?php if ($invoices->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $invoices_list->TableLeftColumnClass ?>"><span class="invoices_invoice_amount">
<?php if ($invoices_list->isExport() || $invoices_list->SortUrl($invoices_list->invoice_amount) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $invoices_list->invoice_amount->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_amount) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $invoices_list->invoice_amount->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_amount">
<span<?php echo $invoices_list->invoice_amount->viewAttributes() ?>><?php echo $invoices_list->invoice_amount->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row invoices_invoice_amount">
			<label class="<?php echo $invoices_list->LeftColumnClass ?>"><?php echo $invoices_list->invoice_amount->caption() ?></label>
			<div class="<?php echo $invoices_list->RightColumnClass ?>"><div <?php echo $invoices_list->invoice_amount->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_amount">
<span<?php echo $invoices_list->invoice_amount->viewAttributes() ?>><?php echo $invoices_list->invoice_amount->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($invoices_list->invoice_issue_date->Visible) { // invoice_issue_date ?>
		<?php if ($invoices->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $invoices_list->TableLeftColumnClass ?>"><span class="invoices_invoice_issue_date">
<?php if ($invoices_list->isExport() || $invoices_list->SortUrl($invoices_list->invoice_issue_date) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $invoices_list->invoice_issue_date->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_issue_date) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_issue_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_issue_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_issue_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $invoices_list->invoice_issue_date->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_issue_date">
<span<?php echo $invoices_list->invoice_issue_date->viewAttributes() ?>><?php echo $invoices_list->invoice_issue_date->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row invoices_invoice_issue_date">
			<label class="<?php echo $invoices_list->LeftColumnClass ?>"><?php echo $invoices_list->invoice_issue_date->caption() ?></label>
			<div class="<?php echo $invoices_list->RightColumnClass ?>"><div <?php echo $invoices_list->invoice_issue_date->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_issue_date">
<span<?php echo $invoices_list->invoice_issue_date->viewAttributes() ?>><?php echo $invoices_list->invoice_issue_date->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($invoices_list->invoice_due_date->Visible) { // invoice_due_date ?>
		<?php if ($invoices->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $invoices_list->TableLeftColumnClass ?>"><span class="invoices_invoice_due_date">
<?php if ($invoices_list->isExport() || $invoices_list->SortUrl($invoices_list->invoice_due_date) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $invoices_list->invoice_due_date->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_due_date) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_due_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_due_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_due_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $invoices_list->invoice_due_date->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_due_date">
<span<?php echo $invoices_list->invoice_due_date->viewAttributes() ?>><?php echo $invoices_list->invoice_due_date->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row invoices_invoice_due_date">
			<label class="<?php echo $invoices_list->LeftColumnClass ?>"><?php echo $invoices_list->invoice_due_date->caption() ?></label>
			<div class="<?php echo $invoices_list->RightColumnClass ?>"><div <?php echo $invoices_list->invoice_due_date->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_due_date">
<span<?php echo $invoices_list->invoice_due_date->viewAttributes() ?>><?php echo $invoices_list->invoice_due_date->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($invoices_list->invoice_status->Visible) { // invoice_status ?>
		<?php if ($invoices->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $invoices_list->TableLeftColumnClass ?>"><span class="invoices_invoice_status">
<?php if ($invoices_list->isExport() || $invoices_list->SortUrl($invoices_list->invoice_status) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $invoices_list->invoice_status->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_status) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_status->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $invoices_list->invoice_status->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_status">
<span<?php echo $invoices_list->invoice_status->viewAttributes() ?>><?php echo $invoices_list->invoice_status->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row invoices_invoice_status">
			<label class="<?php echo $invoices_list->LeftColumnClass ?>"><?php echo $invoices_list->invoice_status->caption() ?></label>
			<div class="<?php echo $invoices_list->RightColumnClass ?>"><div <?php echo $invoices_list->invoice_status->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_status">
<span<?php echo $invoices_list->invoice_status->viewAttributes() ?>><?php echo $invoices_list->invoice_status->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($invoices_list->invoice_collected_amount->Visible) { // invoice_collected_amount ?>
		<?php if ($invoices->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $invoices_list->TableLeftColumnClass ?>"><span class="invoices_invoice_collected_amount">
<?php if ($invoices_list->isExport() || $invoices_list->SortUrl($invoices_list->invoice_collected_amount) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $invoices_list->invoice_collected_amount->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_collected_amount) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_collected_amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_collected_amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_collected_amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $invoices_list->invoice_collected_amount->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_collected_amount">
<span<?php echo $invoices_list->invoice_collected_amount->viewAttributes() ?>><?php echo $invoices_list->invoice_collected_amount->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row invoices_invoice_collected_amount">
			<label class="<?php echo $invoices_list->LeftColumnClass ?>"><?php echo $invoices_list->invoice_collected_amount->caption() ?></label>
			<div class="<?php echo $invoices_list->RightColumnClass ?>"><div <?php echo $invoices_list->invoice_collected_amount->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_collected_amount">
<span<?php echo $invoices_list->invoice_collected_amount->viewAttributes() ?>><?php echo $invoices_list->invoice_collected_amount->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($invoices_list->invoice_remaining_amount->Visible) { // invoice_remaining_amount ?>
		<?php if ($invoices->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $invoices_list->TableLeftColumnClass ?>"><span class="invoices_invoice_remaining_amount">
<?php if ($invoices_list->isExport() || $invoices_list->SortUrl($invoices_list->invoice_remaining_amount) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $invoices_list->invoice_remaining_amount->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_remaining_amount) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_remaining_amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_remaining_amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_remaining_amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $invoices_list->invoice_remaining_amount->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_remaining_amount">
<span<?php echo $invoices_list->invoice_remaining_amount->viewAttributes() ?>><?php echo $invoices_list->invoice_remaining_amount->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row invoices_invoice_remaining_amount">
			<label class="<?php echo $invoices_list->LeftColumnClass ?>"><?php echo $invoices_list->invoice_remaining_amount->caption() ?></label>
			<div class="<?php echo $invoices_list->RightColumnClass ?>"><div <?php echo $invoices_list->invoice_remaining_amount->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_remaining_amount">
<span<?php echo $invoices_list->invoice_remaining_amount->viewAttributes() ?>><?php echo $invoices_list->invoice_remaining_amount->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($invoices_list->invoice_collection_date->Visible) { // invoice_collection_date ?>
		<?php if ($invoices->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $invoices_list->TableLeftColumnClass ?>"><span class="invoices_invoice_collection_date">
<?php if ($invoices_list->isExport() || $invoices_list->SortUrl($invoices_list->invoice_collection_date) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $invoices_list->invoice_collection_date->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_collection_date) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_collection_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_collection_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_collection_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $invoices_list->invoice_collection_date->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_collection_date">
<span<?php echo $invoices_list->invoice_collection_date->viewAttributes() ?>><?php echo $invoices_list->invoice_collection_date->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row invoices_invoice_collection_date">
			<label class="<?php echo $invoices_list->LeftColumnClass ?>"><?php echo $invoices_list->invoice_collection_date->caption() ?></label>
			<div class="<?php echo $invoices_list->RightColumnClass ?>"><div <?php echo $invoices_list->invoice_collection_date->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_collection_date">
<span<?php echo $invoices_list->invoice_collection_date->viewAttributes() ?>><?php echo $invoices_list->invoice_collection_date->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($invoices->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$invoices_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$invoices_list->ListOptions->render("body", "bottom", $invoices_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$invoices_list->isGridAdd())
		$invoices_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$invoices->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($invoices_list->Recordset)
	$invoices_list->Recordset->Close();
?>
<?php if (!$invoices_list->isExport()) { ?>
<div>
<?php if (!$invoices_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $invoices_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $invoices_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($invoices_list->TotalRecords == 0 && !$invoices->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $invoices_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$invoices_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$invoices_list->isExport()) { ?>
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
$invoices_list->terminate();
?>