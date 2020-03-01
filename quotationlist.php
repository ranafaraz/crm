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
$quotation_list = new quotation_list();

// Run the page
$quotation_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$quotation_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$quotation_list->isExport()) { ?>
<script>
var fquotationlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fquotationlist = currentForm = new ew.Form("fquotationlist", "list");
	fquotationlist.formKeyCountName = '<?php echo $quotation_list->FormKeyCountName ?>';
	loadjs.done("fquotationlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$quotation_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($quotation_list->TotalRecords > 0 && $quotation_list->ExportOptions->visible()) { ?>
<?php $quotation_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($quotation_list->ImportOptions->visible()) { ?>
<?php $quotation_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$quotation_list->renderOtherOptions();
?>
<?php $quotation_list->showPageHeader(); ?>
<?php
$quotation_list->showMessage();
?>
<?php if ($quotation_list->TotalRecords > 0 || $quotation->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($quotation_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> quotation">
<form name="fquotationlist" id="fquotationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="quotation">
<div id="gmp_quotation" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($quotation_list->TotalRecords > 0 || $quotation_list->isGridEdit()) { ?>
<table id="tbl_quotationlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$quotation->RowType = ROWTYPE_HEADER;

// Render list options
$quotation_list->renderListOptions();

// Render list options (header, left)
$quotation_list->ListOptions->render("header", "left");
?>
<?php if ($quotation_list->quote_id->Visible) { // quote_id ?>
	<?php if ($quotation_list->SortUrl($quotation_list->quote_id) == "") { ?>
		<th data-name="quote_id" class="<?php echo $quotation_list->quote_id->headerCellClass() ?>"><div id="elh_quotation_quote_id" class="quotation_quote_id"><div class="ew-table-header-caption"><?php echo $quotation_list->quote_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="quote_id" class="<?php echo $quotation_list->quote_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quotation_list->SortUrl($quotation_list->quote_id) ?>', 1);"><div id="elh_quotation_quote_id" class="quotation_quote_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quotation_list->quote_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($quotation_list->quote_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quotation_list->quote_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($quotation_list->quote_branch_id->Visible) { // quote_branch_id ?>
	<?php if ($quotation_list->SortUrl($quotation_list->quote_branch_id) == "") { ?>
		<th data-name="quote_branch_id" class="<?php echo $quotation_list->quote_branch_id->headerCellClass() ?>"><div id="elh_quotation_quote_branch_id" class="quotation_quote_branch_id"><div class="ew-table-header-caption"><?php echo $quotation_list->quote_branch_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="quote_branch_id" class="<?php echo $quotation_list->quote_branch_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quotation_list->SortUrl($quotation_list->quote_branch_id) ?>', 1);"><div id="elh_quotation_quote_branch_id" class="quotation_quote_branch_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quotation_list->quote_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($quotation_list->quote_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quotation_list->quote_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($quotation_list->quote_business_id->Visible) { // quote_business_id ?>
	<?php if ($quotation_list->SortUrl($quotation_list->quote_business_id) == "") { ?>
		<th data-name="quote_business_id" class="<?php echo $quotation_list->quote_business_id->headerCellClass() ?>"><div id="elh_quotation_quote_business_id" class="quotation_quote_business_id"><div class="ew-table-header-caption"><?php echo $quotation_list->quote_business_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="quote_business_id" class="<?php echo $quotation_list->quote_business_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quotation_list->SortUrl($quotation_list->quote_business_id) ?>', 1);"><div id="elh_quotation_quote_business_id" class="quotation_quote_business_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quotation_list->quote_business_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($quotation_list->quote_business_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quotation_list->quote_business_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($quotation_list->quote_service_id->Visible) { // quote_service_id ?>
	<?php if ($quotation_list->SortUrl($quotation_list->quote_service_id) == "") { ?>
		<th data-name="quote_service_id" class="<?php echo $quotation_list->quote_service_id->headerCellClass() ?>"><div id="elh_quotation_quote_service_id" class="quotation_quote_service_id"><div class="ew-table-header-caption"><?php echo $quotation_list->quote_service_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="quote_service_id" class="<?php echo $quotation_list->quote_service_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quotation_list->SortUrl($quotation_list->quote_service_id) ?>', 1);"><div id="elh_quotation_quote_service_id" class="quotation_quote_service_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quotation_list->quote_service_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($quotation_list->quote_service_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quotation_list->quote_service_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($quotation_list->quote_issue_date->Visible) { // quote_issue_date ?>
	<?php if ($quotation_list->SortUrl($quotation_list->quote_issue_date) == "") { ?>
		<th data-name="quote_issue_date" class="<?php echo $quotation_list->quote_issue_date->headerCellClass() ?>"><div id="elh_quotation_quote_issue_date" class="quotation_quote_issue_date"><div class="ew-table-header-caption"><?php echo $quotation_list->quote_issue_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="quote_issue_date" class="<?php echo $quotation_list->quote_issue_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quotation_list->SortUrl($quotation_list->quote_issue_date) ?>', 1);"><div id="elh_quotation_quote_issue_date" class="quotation_quote_issue_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quotation_list->quote_issue_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($quotation_list->quote_issue_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quotation_list->quote_issue_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($quotation_list->quote_due_date->Visible) { // quote_due_date ?>
	<?php if ($quotation_list->SortUrl($quotation_list->quote_due_date) == "") { ?>
		<th data-name="quote_due_date" class="<?php echo $quotation_list->quote_due_date->headerCellClass() ?>"><div id="elh_quotation_quote_due_date" class="quotation_quote_due_date"><div class="ew-table-header-caption"><?php echo $quotation_list->quote_due_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="quote_due_date" class="<?php echo $quotation_list->quote_due_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quotation_list->SortUrl($quotation_list->quote_due_date) ?>', 1);"><div id="elh_quotation_quote_due_date" class="quotation_quote_due_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quotation_list->quote_due_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($quotation_list->quote_due_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quotation_list->quote_due_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($quotation_list->quote_amount->Visible) { // quote_amount ?>
	<?php if ($quotation_list->SortUrl($quotation_list->quote_amount) == "") { ?>
		<th data-name="quote_amount" class="<?php echo $quotation_list->quote_amount->headerCellClass() ?>"><div id="elh_quotation_quote_amount" class="quotation_quote_amount"><div class="ew-table-header-caption"><?php echo $quotation_list->quote_amount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="quote_amount" class="<?php echo $quotation_list->quote_amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quotation_list->SortUrl($quotation_list->quote_amount) ?>', 1);"><div id="elh_quotation_quote_amount" class="quotation_quote_amount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quotation_list->quote_amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($quotation_list->quote_amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quotation_list->quote_amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$quotation_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($quotation_list->ExportAll && $quotation_list->isExport()) {
	$quotation_list->StopRecord = $quotation_list->TotalRecords;
} else {

	// Set the last record to display
	if ($quotation_list->TotalRecords > $quotation_list->StartRecord + $quotation_list->DisplayRecords - 1)
		$quotation_list->StopRecord = $quotation_list->StartRecord + $quotation_list->DisplayRecords - 1;
	else
		$quotation_list->StopRecord = $quotation_list->TotalRecords;
}
$quotation_list->RecordCount = $quotation_list->StartRecord - 1;
if ($quotation_list->Recordset && !$quotation_list->Recordset->EOF) {
	$quotation_list->Recordset->moveFirst();
	$selectLimit = $quotation_list->UseSelectLimit;
	if (!$selectLimit && $quotation_list->StartRecord > 1)
		$quotation_list->Recordset->move($quotation_list->StartRecord - 1);
} elseif (!$quotation->AllowAddDeleteRow && $quotation_list->StopRecord == 0) {
	$quotation_list->StopRecord = $quotation->GridAddRowCount;
}

// Initialize aggregate
$quotation->RowType = ROWTYPE_AGGREGATEINIT;
$quotation->resetAttributes();
$quotation_list->renderRow();
while ($quotation_list->RecordCount < $quotation_list->StopRecord) {
	$quotation_list->RecordCount++;
	if ($quotation_list->RecordCount >= $quotation_list->StartRecord) {
		$quotation_list->RowCount++;

		// Set up key count
		$quotation_list->KeyCount = $quotation_list->RowIndex;

		// Init row class and style
		$quotation->resetAttributes();
		$quotation->CssClass = "";
		if ($quotation_list->isGridAdd()) {
		} else {
			$quotation_list->loadRowValues($quotation_list->Recordset); // Load row values
		}
		$quotation->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$quotation->RowAttrs->merge(["data-rowindex" => $quotation_list->RowCount, "id" => "r" . $quotation_list->RowCount . "_quotation", "data-rowtype" => $quotation->RowType]);

		// Render row
		$quotation_list->renderRow();

		// Render list options
		$quotation_list->renderListOptions();
?>
	<tr <?php echo $quotation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$quotation_list->ListOptions->render("body", "left", $quotation_list->RowCount);
?>
	<?php if ($quotation_list->quote_id->Visible) { // quote_id ?>
		<td data-name="quote_id" <?php echo $quotation_list->quote_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_id">
<span<?php echo $quotation_list->quote_id->viewAttributes() ?>><?php echo $quotation_list->quote_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($quotation_list->quote_branch_id->Visible) { // quote_branch_id ?>
		<td data-name="quote_branch_id" <?php echo $quotation_list->quote_branch_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_branch_id">
<span<?php echo $quotation_list->quote_branch_id->viewAttributes() ?>><?php echo $quotation_list->quote_branch_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($quotation_list->quote_business_id->Visible) { // quote_business_id ?>
		<td data-name="quote_business_id" <?php echo $quotation_list->quote_business_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_business_id">
<span<?php echo $quotation_list->quote_business_id->viewAttributes() ?>><?php echo $quotation_list->quote_business_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($quotation_list->quote_service_id->Visible) { // quote_service_id ?>
		<td data-name="quote_service_id" <?php echo $quotation_list->quote_service_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_service_id">
<span<?php echo $quotation_list->quote_service_id->viewAttributes() ?>><?php echo $quotation_list->quote_service_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($quotation_list->quote_issue_date->Visible) { // quote_issue_date ?>
		<td data-name="quote_issue_date" <?php echo $quotation_list->quote_issue_date->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_issue_date">
<span<?php echo $quotation_list->quote_issue_date->viewAttributes() ?>><?php echo $quotation_list->quote_issue_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($quotation_list->quote_due_date->Visible) { // quote_due_date ?>
		<td data-name="quote_due_date" <?php echo $quotation_list->quote_due_date->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_due_date">
<span<?php echo $quotation_list->quote_due_date->viewAttributes() ?>><?php echo $quotation_list->quote_due_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($quotation_list->quote_amount->Visible) { // quote_amount ?>
		<td data-name="quote_amount" <?php echo $quotation_list->quote_amount->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_amount">
<span<?php echo $quotation_list->quote_amount->viewAttributes() ?>><?php echo $quotation_list->quote_amount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$quotation_list->ListOptions->render("body", "right", $quotation_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$quotation_list->isGridAdd())
		$quotation_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$quotation->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($quotation_list->Recordset)
	$quotation_list->Recordset->Close();
?>
<?php if (!$quotation_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$quotation_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $quotation_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $quotation_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($quotation_list->TotalRecords == 0 && !$quotation->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $quotation_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$quotation_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$quotation_list->isExport()) { ?>
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
$quotation_list->terminate();
?>