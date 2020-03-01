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
$followup_list = new followup_list();

// Run the page
$followup_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$followup_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$followup_list->isExport()) { ?>
<script>
var ffollowuplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ffollowuplist = currentForm = new ew.Form("ffollowuplist", "list");
	ffollowuplist.formKeyCountName = '<?php echo $followup_list->FormKeyCountName ?>';
	loadjs.done("ffollowuplist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$followup_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($followup_list->TotalRecords > 0 && $followup_list->ExportOptions->visible()) { ?>
<?php $followup_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($followup_list->ImportOptions->visible()) { ?>
<?php $followup_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$followup_list->renderOtherOptions();
?>
<?php $followup_list->showPageHeader(); ?>
<?php
$followup_list->showMessage();
?>
<?php if ($followup_list->TotalRecords > 0 || $followup->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($followup_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> followup">
<form name="ffollowuplist" id="ffollowuplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="followup">
<div id="gmp_followup" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($followup_list->TotalRecords > 0 || $followup_list->isGridEdit()) { ?>
<table id="tbl_followuplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$followup->RowType = ROWTYPE_HEADER;

// Render list options
$followup_list->renderListOptions();

// Render list options (header, left)
$followup_list->ListOptions->render("header", "left");
?>
<?php if ($followup_list->followup_id->Visible) { // followup_id ?>
	<?php if ($followup_list->SortUrl($followup_list->followup_id) == "") { ?>
		<th data-name="followup_id" class="<?php echo $followup_list->followup_id->headerCellClass() ?>"><div id="elh_followup_followup_id" class="followup_followup_id"><div class="ew-table-header-caption"><?php echo $followup_list->followup_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="followup_id" class="<?php echo $followup_list->followup_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_id) ?>', 1);"><div id="elh_followup_followup_id" class="followup_followup_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($followup_list->followup_branch_id->Visible) { // followup_branch_id ?>
	<?php if ($followup_list->SortUrl($followup_list->followup_branch_id) == "") { ?>
		<th data-name="followup_branch_id" class="<?php echo $followup_list->followup_branch_id->headerCellClass() ?>"><div id="elh_followup_followup_branch_id" class="followup_followup_branch_id"><div class="ew-table-header-caption"><?php echo $followup_list->followup_branch_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="followup_branch_id" class="<?php echo $followup_list->followup_branch_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_branch_id) ?>', 1);"><div id="elh_followup_followup_branch_id" class="followup_followup_branch_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($followup_list->followup_business_id->Visible) { // followup_business_id ?>
	<?php if ($followup_list->SortUrl($followup_list->followup_business_id) == "") { ?>
		<th data-name="followup_business_id" class="<?php echo $followup_list->followup_business_id->headerCellClass() ?>"><div id="elh_followup_followup_business_id" class="followup_followup_business_id"><div class="ew-table-header-caption"><?php echo $followup_list->followup_business_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="followup_business_id" class="<?php echo $followup_list->followup_business_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_business_id) ?>', 1);"><div id="elh_followup_followup_business_id" class="followup_followup_business_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_business_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_business_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_business_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($followup_list->followup_by_emp_id->Visible) { // followup_by_emp_id ?>
	<?php if ($followup_list->SortUrl($followup_list->followup_by_emp_id) == "") { ?>
		<th data-name="followup_by_emp_id" class="<?php echo $followup_list->followup_by_emp_id->headerCellClass() ?>"><div id="elh_followup_followup_by_emp_id" class="followup_followup_by_emp_id"><div class="ew-table-header-caption"><?php echo $followup_list->followup_by_emp_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="followup_by_emp_id" class="<?php echo $followup_list->followup_by_emp_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_by_emp_id) ?>', 1);"><div id="elh_followup_followup_by_emp_id" class="followup_followup_by_emp_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_by_emp_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_by_emp_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_by_emp_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($followup_list->followup_no_id->Visible) { // followup_no_id ?>
	<?php if ($followup_list->SortUrl($followup_list->followup_no_id) == "") { ?>
		<th data-name="followup_no_id" class="<?php echo $followup_list->followup_no_id->headerCellClass() ?>"><div id="elh_followup_followup_no_id" class="followup_followup_no_id"><div class="ew-table-header-caption"><?php echo $followup_list->followup_no_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="followup_no_id" class="<?php echo $followup_list->followup_no_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_no_id) ?>', 1);"><div id="elh_followup_followup_no_id" class="followup_followup_no_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_no_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_no_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_no_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($followup_list->followup_date->Visible) { // followup_date ?>
	<?php if ($followup_list->SortUrl($followup_list->followup_date) == "") { ?>
		<th data-name="followup_date" class="<?php echo $followup_list->followup_date->headerCellClass() ?>"><div id="elh_followup_followup_date" class="followup_followup_date"><div class="ew-table-header-caption"><?php echo $followup_list->followup_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="followup_date" class="<?php echo $followup_list->followup_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_date) ?>', 1);"><div id="elh_followup_followup_date" class="followup_followup_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($followup_list->followup_response->Visible) { // followup_response ?>
	<?php if ($followup_list->SortUrl($followup_list->followup_response) == "") { ?>
		<th data-name="followup_response" class="<?php echo $followup_list->followup_response->headerCellClass() ?>"><div id="elh_followup_followup_response" class="followup_followup_response"><div class="ew-table-header-caption"><?php echo $followup_list->followup_response->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="followup_response" class="<?php echo $followup_list->followup_response->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_response) ?>', 1);"><div id="elh_followup_followup_response" class="followup_followup_response">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_response->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_response->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_response->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($followup_list->nxt_FU_date->Visible) { // nxt_FU_date ?>
	<?php if ($followup_list->SortUrl($followup_list->nxt_FU_date) == "") { ?>
		<th data-name="nxt_FU_date" class="<?php echo $followup_list->nxt_FU_date->headerCellClass() ?>"><div id="elh_followup_nxt_FU_date" class="followup_nxt_FU_date"><div class="ew-table-header-caption"><?php echo $followup_list->nxt_FU_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nxt_FU_date" class="<?php echo $followup_list->nxt_FU_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->nxt_FU_date) ?>', 1);"><div id="elh_followup_nxt_FU_date" class="followup_nxt_FU_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->nxt_FU_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->nxt_FU_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->nxt_FU_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($followup_list->current_FU_status->Visible) { // current_FU_status ?>
	<?php if ($followup_list->SortUrl($followup_list->current_FU_status) == "") { ?>
		<th data-name="current_FU_status" class="<?php echo $followup_list->current_FU_status->headerCellClass() ?>"><div id="elh_followup_current_FU_status" class="followup_current_FU_status"><div class="ew-table-header-caption"><?php echo $followup_list->current_FU_status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="current_FU_status" class="<?php echo $followup_list->current_FU_status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->current_FU_status) ?>', 1);"><div id="elh_followup_current_FU_status" class="followup_current_FU_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->current_FU_status->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->current_FU_status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->current_FU_status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$followup_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($followup_list->ExportAll && $followup_list->isExport()) {
	$followup_list->StopRecord = $followup_list->TotalRecords;
} else {

	// Set the last record to display
	if ($followup_list->TotalRecords > $followup_list->StartRecord + $followup_list->DisplayRecords - 1)
		$followup_list->StopRecord = $followup_list->StartRecord + $followup_list->DisplayRecords - 1;
	else
		$followup_list->StopRecord = $followup_list->TotalRecords;
}
$followup_list->RecordCount = $followup_list->StartRecord - 1;
if ($followup_list->Recordset && !$followup_list->Recordset->EOF) {
	$followup_list->Recordset->moveFirst();
	$selectLimit = $followup_list->UseSelectLimit;
	if (!$selectLimit && $followup_list->StartRecord > 1)
		$followup_list->Recordset->move($followup_list->StartRecord - 1);
} elseif (!$followup->AllowAddDeleteRow && $followup_list->StopRecord == 0) {
	$followup_list->StopRecord = $followup->GridAddRowCount;
}

// Initialize aggregate
$followup->RowType = ROWTYPE_AGGREGATEINIT;
$followup->resetAttributes();
$followup_list->renderRow();
while ($followup_list->RecordCount < $followup_list->StopRecord) {
	$followup_list->RecordCount++;
	if ($followup_list->RecordCount >= $followup_list->StartRecord) {
		$followup_list->RowCount++;

		// Set up key count
		$followup_list->KeyCount = $followup_list->RowIndex;

		// Init row class and style
		$followup->resetAttributes();
		$followup->CssClass = "";
		if ($followup_list->isGridAdd()) {
		} else {
			$followup_list->loadRowValues($followup_list->Recordset); // Load row values
		}
		$followup->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$followup->RowAttrs->merge(["data-rowindex" => $followup_list->RowCount, "id" => "r" . $followup_list->RowCount . "_followup", "data-rowtype" => $followup->RowType]);

		// Render row
		$followup_list->renderRow();

		// Render list options
		$followup_list->renderListOptions();
?>
	<tr <?php echo $followup->rowAttributes() ?>>
<?php

// Render list options (body, left)
$followup_list->ListOptions->render("body", "left", $followup_list->RowCount);
?>
	<?php if ($followup_list->followup_id->Visible) { // followup_id ?>
		<td data-name="followup_id" <?php echo $followup_list->followup_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_id">
<span<?php echo $followup_list->followup_id->viewAttributes() ?>><?php echo $followup_list->followup_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($followup_list->followup_branch_id->Visible) { // followup_branch_id ?>
		<td data-name="followup_branch_id" <?php echo $followup_list->followup_branch_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_branch_id">
<span<?php echo $followup_list->followup_branch_id->viewAttributes() ?>><?php echo $followup_list->followup_branch_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($followup_list->followup_business_id->Visible) { // followup_business_id ?>
		<td data-name="followup_business_id" <?php echo $followup_list->followup_business_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_business_id">
<span<?php echo $followup_list->followup_business_id->viewAttributes() ?>><?php echo $followup_list->followup_business_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($followup_list->followup_by_emp_id->Visible) { // followup_by_emp_id ?>
		<td data-name="followup_by_emp_id" <?php echo $followup_list->followup_by_emp_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_by_emp_id">
<span<?php echo $followup_list->followup_by_emp_id->viewAttributes() ?>><?php echo $followup_list->followup_by_emp_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($followup_list->followup_no_id->Visible) { // followup_no_id ?>
		<td data-name="followup_no_id" <?php echo $followup_list->followup_no_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_no_id">
<span<?php echo $followup_list->followup_no_id->viewAttributes() ?>><?php echo $followup_list->followup_no_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($followup_list->followup_date->Visible) { // followup_date ?>
		<td data-name="followup_date" <?php echo $followup_list->followup_date->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_date">
<span<?php echo $followup_list->followup_date->viewAttributes() ?>><?php echo $followup_list->followup_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($followup_list->followup_response->Visible) { // followup_response ?>
		<td data-name="followup_response" <?php echo $followup_list->followup_response->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_response">
<span<?php echo $followup_list->followup_response->viewAttributes() ?>><?php echo $followup_list->followup_response->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($followup_list->nxt_FU_date->Visible) { // nxt_FU_date ?>
		<td data-name="nxt_FU_date" <?php echo $followup_list->nxt_FU_date->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_nxt_FU_date">
<span<?php echo $followup_list->nxt_FU_date->viewAttributes() ?>><?php echo $followup_list->nxt_FU_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($followup_list->current_FU_status->Visible) { // current_FU_status ?>
		<td data-name="current_FU_status" <?php echo $followup_list->current_FU_status->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_current_FU_status">
<span<?php echo $followup_list->current_FU_status->viewAttributes() ?>><?php echo $followup_list->current_FU_status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$followup_list->ListOptions->render("body", "right", $followup_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$followup_list->isGridAdd())
		$followup_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$followup->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($followup_list->Recordset)
	$followup_list->Recordset->Close();
?>
<?php if (!$followup_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$followup_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $followup_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $followup_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($followup_list->TotalRecords == 0 && !$followup->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $followup_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$followup_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$followup_list->isExport()) { ?>
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
$followup_list->terminate();
?>