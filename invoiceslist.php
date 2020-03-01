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
<div class="card ew-card ew-grid<?php if ($invoices_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> invoices">
<?php if (!$invoices_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
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
<form name="finvoiceslist" id="finvoiceslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="invoices">
<div id="gmp_invoices" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($invoices_list->TotalRecords > 0 || $invoices_list->isGridEdit()) { ?>
<table id="tbl_invoiceslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$invoices->RowType = ROWTYPE_HEADER;

// Render list options
$invoices_list->renderListOptions();

// Render list options (header, left)
$invoices_list->ListOptions->render("header", "left");
?>
<?php if ($invoices_list->invoice_id->Visible) { // invoice_id ?>
	<?php if ($invoices_list->SortUrl($invoices_list->invoice_id) == "") { ?>
		<th data-name="invoice_id" class="<?php echo $invoices_list->invoice_id->headerCellClass() ?>"><div id="elh_invoices_invoice_id" class="invoices_invoice_id"><div class="ew-table-header-caption"><?php echo $invoices_list->invoice_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="invoice_id" class="<?php echo $invoices_list->invoice_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_id) ?>', 1);"><div id="elh_invoices_invoice_id" class="invoices_invoice_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($invoices_list->invoice_branch_id->Visible) { // invoice_branch_id ?>
	<?php if ($invoices_list->SortUrl($invoices_list->invoice_branch_id) == "") { ?>
		<th data-name="invoice_branch_id" class="<?php echo $invoices_list->invoice_branch_id->headerCellClass() ?>"><div id="elh_invoices_invoice_branch_id" class="invoices_invoice_branch_id"><div class="ew-table-header-caption"><?php echo $invoices_list->invoice_branch_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="invoice_branch_id" class="<?php echo $invoices_list->invoice_branch_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_branch_id) ?>', 1);"><div id="elh_invoices_invoice_branch_id" class="invoices_invoice_branch_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($invoices_list->invoice_business_id->Visible) { // invoice_business_id ?>
	<?php if ($invoices_list->SortUrl($invoices_list->invoice_business_id) == "") { ?>
		<th data-name="invoice_business_id" class="<?php echo $invoices_list->invoice_business_id->headerCellClass() ?>"><div id="elh_invoices_invoice_business_id" class="invoices_invoice_business_id"><div class="ew-table-header-caption"><?php echo $invoices_list->invoice_business_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="invoice_business_id" class="<?php echo $invoices_list->invoice_business_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_business_id) ?>', 1);"><div id="elh_invoices_invoice_business_id" class="invoices_invoice_business_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_business_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_business_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_business_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($invoices_list->invoice_service_id->Visible) { // invoice_service_id ?>
	<?php if ($invoices_list->SortUrl($invoices_list->invoice_service_id) == "") { ?>
		<th data-name="invoice_service_id" class="<?php echo $invoices_list->invoice_service_id->headerCellClass() ?>"><div id="elh_invoices_invoice_service_id" class="invoices_invoice_service_id"><div class="ew-table-header-caption"><?php echo $invoices_list->invoice_service_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="invoice_service_id" class="<?php echo $invoices_list->invoice_service_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_service_id) ?>', 1);"><div id="elh_invoices_invoice_service_id" class="invoices_invoice_service_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_service_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_service_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_service_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($invoices_list->invoice_amount->Visible) { // invoice_amount ?>
	<?php if ($invoices_list->SortUrl($invoices_list->invoice_amount) == "") { ?>
		<th data-name="invoice_amount" class="<?php echo $invoices_list->invoice_amount->headerCellClass() ?>"><div id="elh_invoices_invoice_amount" class="invoices_invoice_amount"><div class="ew-table-header-caption"><?php echo $invoices_list->invoice_amount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="invoice_amount" class="<?php echo $invoices_list->invoice_amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_amount) ?>', 1);"><div id="elh_invoices_invoice_amount" class="invoices_invoice_amount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($invoices_list->invoice_issue_date->Visible) { // invoice_issue_date ?>
	<?php if ($invoices_list->SortUrl($invoices_list->invoice_issue_date) == "") { ?>
		<th data-name="invoice_issue_date" class="<?php echo $invoices_list->invoice_issue_date->headerCellClass() ?>"><div id="elh_invoices_invoice_issue_date" class="invoices_invoice_issue_date"><div class="ew-table-header-caption"><?php echo $invoices_list->invoice_issue_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="invoice_issue_date" class="<?php echo $invoices_list->invoice_issue_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_issue_date) ?>', 1);"><div id="elh_invoices_invoice_issue_date" class="invoices_invoice_issue_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_issue_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_issue_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_issue_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($invoices_list->invoice_due_date->Visible) { // invoice_due_date ?>
	<?php if ($invoices_list->SortUrl($invoices_list->invoice_due_date) == "") { ?>
		<th data-name="invoice_due_date" class="<?php echo $invoices_list->invoice_due_date->headerCellClass() ?>"><div id="elh_invoices_invoice_due_date" class="invoices_invoice_due_date"><div class="ew-table-header-caption"><?php echo $invoices_list->invoice_due_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="invoice_due_date" class="<?php echo $invoices_list->invoice_due_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_due_date) ?>', 1);"><div id="elh_invoices_invoice_due_date" class="invoices_invoice_due_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_due_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_due_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_due_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($invoices_list->invoice_status->Visible) { // invoice_status ?>
	<?php if ($invoices_list->SortUrl($invoices_list->invoice_status) == "") { ?>
		<th data-name="invoice_status" class="<?php echo $invoices_list->invoice_status->headerCellClass() ?>"><div id="elh_invoices_invoice_status" class="invoices_invoice_status"><div class="ew-table-header-caption"><?php echo $invoices_list->invoice_status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="invoice_status" class="<?php echo $invoices_list->invoice_status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_status) ?>', 1);"><div id="elh_invoices_invoice_status" class="invoices_invoice_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_status->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($invoices_list->invoice_collected_amount->Visible) { // invoice_collected_amount ?>
	<?php if ($invoices_list->SortUrl($invoices_list->invoice_collected_amount) == "") { ?>
		<th data-name="invoice_collected_amount" class="<?php echo $invoices_list->invoice_collected_amount->headerCellClass() ?>"><div id="elh_invoices_invoice_collected_amount" class="invoices_invoice_collected_amount"><div class="ew-table-header-caption"><?php echo $invoices_list->invoice_collected_amount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="invoice_collected_amount" class="<?php echo $invoices_list->invoice_collected_amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_collected_amount) ?>', 1);"><div id="elh_invoices_invoice_collected_amount" class="invoices_invoice_collected_amount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_collected_amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_collected_amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_collected_amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($invoices_list->invoice_remaining_amount->Visible) { // invoice_remaining_amount ?>
	<?php if ($invoices_list->SortUrl($invoices_list->invoice_remaining_amount) == "") { ?>
		<th data-name="invoice_remaining_amount" class="<?php echo $invoices_list->invoice_remaining_amount->headerCellClass() ?>"><div id="elh_invoices_invoice_remaining_amount" class="invoices_invoice_remaining_amount"><div class="ew-table-header-caption"><?php echo $invoices_list->invoice_remaining_amount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="invoice_remaining_amount" class="<?php echo $invoices_list->invoice_remaining_amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_remaining_amount) ?>', 1);"><div id="elh_invoices_invoice_remaining_amount" class="invoices_invoice_remaining_amount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_remaining_amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_remaining_amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_remaining_amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($invoices_list->invoice_collection_date->Visible) { // invoice_collection_date ?>
	<?php if ($invoices_list->SortUrl($invoices_list->invoice_collection_date) == "") { ?>
		<th data-name="invoice_collection_date" class="<?php echo $invoices_list->invoice_collection_date->headerCellClass() ?>"><div id="elh_invoices_invoice_collection_date" class="invoices_invoice_collection_date"><div class="ew-table-header-caption"><?php echo $invoices_list->invoice_collection_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="invoice_collection_date" class="<?php echo $invoices_list->invoice_collection_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $invoices_list->SortUrl($invoices_list->invoice_collection_date) ?>', 1);"><div id="elh_invoices_invoice_collection_date" class="invoices_invoice_collection_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $invoices_list->invoice_collection_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($invoices_list->invoice_collection_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($invoices_list->invoice_collection_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$invoices_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
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

// Initialize aggregate
$invoices->RowType = ROWTYPE_AGGREGATEINIT;
$invoices->resetAttributes();
$invoices_list->renderRow();
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
	<tr <?php echo $invoices->rowAttributes() ?>>
<?php

// Render list options (body, left)
$invoices_list->ListOptions->render("body", "left", $invoices_list->RowCount);
?>
	<?php if ($invoices_list->invoice_id->Visible) { // invoice_id ?>
		<td data-name="invoice_id" <?php echo $invoices_list->invoice_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_id">
<span<?php echo $invoices_list->invoice_id->viewAttributes() ?>><?php echo $invoices_list->invoice_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($invoices_list->invoice_branch_id->Visible) { // invoice_branch_id ?>
		<td data-name="invoice_branch_id" <?php echo $invoices_list->invoice_branch_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_branch_id">
<span<?php echo $invoices_list->invoice_branch_id->viewAttributes() ?>><?php echo $invoices_list->invoice_branch_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($invoices_list->invoice_business_id->Visible) { // invoice_business_id ?>
		<td data-name="invoice_business_id" <?php echo $invoices_list->invoice_business_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_business_id">
<span<?php echo $invoices_list->invoice_business_id->viewAttributes() ?>><?php echo $invoices_list->invoice_business_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($invoices_list->invoice_service_id->Visible) { // invoice_service_id ?>
		<td data-name="invoice_service_id" <?php echo $invoices_list->invoice_service_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_service_id">
<span<?php echo $invoices_list->invoice_service_id->viewAttributes() ?>><?php echo $invoices_list->invoice_service_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($invoices_list->invoice_amount->Visible) { // invoice_amount ?>
		<td data-name="invoice_amount" <?php echo $invoices_list->invoice_amount->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_amount">
<span<?php echo $invoices_list->invoice_amount->viewAttributes() ?>><?php echo $invoices_list->invoice_amount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($invoices_list->invoice_issue_date->Visible) { // invoice_issue_date ?>
		<td data-name="invoice_issue_date" <?php echo $invoices_list->invoice_issue_date->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_issue_date">
<span<?php echo $invoices_list->invoice_issue_date->viewAttributes() ?>><?php echo $invoices_list->invoice_issue_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($invoices_list->invoice_due_date->Visible) { // invoice_due_date ?>
		<td data-name="invoice_due_date" <?php echo $invoices_list->invoice_due_date->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_due_date">
<span<?php echo $invoices_list->invoice_due_date->viewAttributes() ?>><?php echo $invoices_list->invoice_due_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($invoices_list->invoice_status->Visible) { // invoice_status ?>
		<td data-name="invoice_status" <?php echo $invoices_list->invoice_status->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_status">
<span<?php echo $invoices_list->invoice_status->viewAttributes() ?>><?php echo $invoices_list->invoice_status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($invoices_list->invoice_collected_amount->Visible) { // invoice_collected_amount ?>
		<td data-name="invoice_collected_amount" <?php echo $invoices_list->invoice_collected_amount->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_collected_amount">
<span<?php echo $invoices_list->invoice_collected_amount->viewAttributes() ?>><?php echo $invoices_list->invoice_collected_amount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($invoices_list->invoice_remaining_amount->Visible) { // invoice_remaining_amount ?>
		<td data-name="invoice_remaining_amount" <?php echo $invoices_list->invoice_remaining_amount->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_remaining_amount">
<span<?php echo $invoices_list->invoice_remaining_amount->viewAttributes() ?>><?php echo $invoices_list->invoice_remaining_amount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($invoices_list->invoice_collection_date->Visible) { // invoice_collection_date ?>
		<td data-name="invoice_collection_date" <?php echo $invoices_list->invoice_collection_date->cellAttributes() ?>>
<span id="el<?php echo $invoices_list->RowCount ?>_invoices_invoice_collection_date">
<span<?php echo $invoices_list->invoice_collection_date->viewAttributes() ?>><?php echo $invoices_list->invoice_collection_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$invoices_list->ListOptions->render("body", "right", $invoices_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$invoices_list->isGridAdd())
		$invoices_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
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
<div class="card-footer ew-grid-lower-panel">
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
</div><!-- /.ew-grid -->
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