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
$cus_support_list = new cus_support_list();

// Run the page
$cus_support_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cus_support_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cus_support_list->isExport()) { ?>
<script>
var fcus_supportlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcus_supportlist = currentForm = new ew.Form("fcus_supportlist", "list");
	fcus_supportlist.formKeyCountName = '<?php echo $cus_support_list->FormKeyCountName ?>';
	loadjs.done("fcus_supportlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cus_support_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cus_support_list->TotalRecords > 0 && $cus_support_list->ExportOptions->visible()) { ?>
<?php $cus_support_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cus_support_list->ImportOptions->visible()) { ?>
<?php $cus_support_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cus_support_list->renderOtherOptions();
?>
<?php $cus_support_list->showPageHeader(); ?>
<?php
$cus_support_list->showMessage();
?>
<?php if ($cus_support_list->TotalRecords > 0 || $cus_support->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cus_support_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cus_support">
<?php if (!$cus_support_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cus_support_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cus_support_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cus_support_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcus_supportlist" id="fcus_supportlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cus_support">
<div id="gmp_cus_support" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cus_support_list->TotalRecords > 0 || $cus_support_list->isGridEdit()) { ?>
<table id="tbl_cus_supportlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cus_support->RowType = ROWTYPE_HEADER;

// Render list options
$cus_support_list->renderListOptions();

// Render list options (header, left)
$cus_support_list->ListOptions->render("header", "left");
?>
<?php if ($cus_support_list->cus_sup_id->Visible) { // cus_sup_id ?>
	<?php if ($cus_support_list->SortUrl($cus_support_list->cus_sup_id) == "") { ?>
		<th data-name="cus_sup_id" class="<?php echo $cus_support_list->cus_sup_id->headerCellClass() ?>"><div id="elh_cus_support_cus_sup_id" class="cus_support_cus_sup_id"><div class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cus_sup_id" class="<?php echo $cus_support_list->cus_sup_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cus_support_list->SortUrl($cus_support_list->cus_sup_id) ?>', 1);"><div id="elh_cus_support_cus_sup_id" class="cus_support_cus_sup_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($cus_support_list->cus_sup_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cus_support_list->cus_sup_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cus_support_list->cus_sup_branch_id->Visible) { // cus_sup_branch_id ?>
	<?php if ($cus_support_list->SortUrl($cus_support_list->cus_sup_branch_id) == "") { ?>
		<th data-name="cus_sup_branch_id" class="<?php echo $cus_support_list->cus_sup_branch_id->headerCellClass() ?>"><div id="elh_cus_support_cus_sup_branch_id" class="cus_support_cus_sup_branch_id"><div class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_branch_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cus_sup_branch_id" class="<?php echo $cus_support_list->cus_sup_branch_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cus_support_list->SortUrl($cus_support_list->cus_sup_branch_id) ?>', 1);"><div id="elh_cus_support_cus_sup_branch_id" class="cus_support_cus_sup_branch_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($cus_support_list->cus_sup_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cus_support_list->cus_sup_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cus_support_list->cus_sup_emp_id->Visible) { // cus_sup_emp_id ?>
	<?php if ($cus_support_list->SortUrl($cus_support_list->cus_sup_emp_id) == "") { ?>
		<th data-name="cus_sup_emp_id" class="<?php echo $cus_support_list->cus_sup_emp_id->headerCellClass() ?>"><div id="elh_cus_support_cus_sup_emp_id" class="cus_support_cus_sup_emp_id"><div class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_emp_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cus_sup_emp_id" class="<?php echo $cus_support_list->cus_sup_emp_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cus_support_list->SortUrl($cus_support_list->cus_sup_emp_id) ?>', 1);"><div id="elh_cus_support_cus_sup_emp_id" class="cus_support_cus_sup_emp_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_emp_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($cus_support_list->cus_sup_emp_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cus_support_list->cus_sup_emp_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cus_support_list->cus_sup_date->Visible) { // cus_sup_date ?>
	<?php if ($cus_support_list->SortUrl($cus_support_list->cus_sup_date) == "") { ?>
		<th data-name="cus_sup_date" class="<?php echo $cus_support_list->cus_sup_date->headerCellClass() ?>"><div id="elh_cus_support_cus_sup_date" class="cus_support_cus_sup_date"><div class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cus_sup_date" class="<?php echo $cus_support_list->cus_sup_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cus_support_list->SortUrl($cus_support_list->cus_sup_date) ?>', 1);"><div id="elh_cus_support_cus_sup_date" class="cus_support_cus_sup_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($cus_support_list->cus_sup_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cus_support_list->cus_sup_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cus_support_list->cus_sup_status->Visible) { // cus_sup_status ?>
	<?php if ($cus_support_list->SortUrl($cus_support_list->cus_sup_status) == "") { ?>
		<th data-name="cus_sup_status" class="<?php echo $cus_support_list->cus_sup_status->headerCellClass() ?>"><div id="elh_cus_support_cus_sup_status" class="cus_support_cus_sup_status"><div class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cus_sup_status" class="<?php echo $cus_support_list->cus_sup_status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cus_support_list->SortUrl($cus_support_list->cus_sup_status) ?>', 1);"><div id="elh_cus_support_cus_sup_status" class="cus_support_cus_sup_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_status->caption() ?></span><span class="ew-table-header-sort"><?php if ($cus_support_list->cus_sup_status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cus_support_list->cus_sup_status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cus_support_list->cus_sup_resolved_on->Visible) { // cus_sup_resolved_on ?>
	<?php if ($cus_support_list->SortUrl($cus_support_list->cus_sup_resolved_on) == "") { ?>
		<th data-name="cus_sup_resolved_on" class="<?php echo $cus_support_list->cus_sup_resolved_on->headerCellClass() ?>"><div id="elh_cus_support_cus_sup_resolved_on" class="cus_support_cus_sup_resolved_on"><div class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_resolved_on->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cus_sup_resolved_on" class="<?php echo $cus_support_list->cus_sup_resolved_on->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cus_support_list->SortUrl($cus_support_list->cus_sup_resolved_on) ?>', 1);"><div id="elh_cus_support_cus_sup_resolved_on" class="cus_support_cus_sup_resolved_on">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_resolved_on->caption() ?></span><span class="ew-table-header-sort"><?php if ($cus_support_list->cus_sup_resolved_on->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cus_support_list->cus_sup_resolved_on->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cus_support_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cus_support_list->ExportAll && $cus_support_list->isExport()) {
	$cus_support_list->StopRecord = $cus_support_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cus_support_list->TotalRecords > $cus_support_list->StartRecord + $cus_support_list->DisplayRecords - 1)
		$cus_support_list->StopRecord = $cus_support_list->StartRecord + $cus_support_list->DisplayRecords - 1;
	else
		$cus_support_list->StopRecord = $cus_support_list->TotalRecords;
}
$cus_support_list->RecordCount = $cus_support_list->StartRecord - 1;
if ($cus_support_list->Recordset && !$cus_support_list->Recordset->EOF) {
	$cus_support_list->Recordset->moveFirst();
	$selectLimit = $cus_support_list->UseSelectLimit;
	if (!$selectLimit && $cus_support_list->StartRecord > 1)
		$cus_support_list->Recordset->move($cus_support_list->StartRecord - 1);
} elseif (!$cus_support->AllowAddDeleteRow && $cus_support_list->StopRecord == 0) {
	$cus_support_list->StopRecord = $cus_support->GridAddRowCount;
}

// Initialize aggregate
$cus_support->RowType = ROWTYPE_AGGREGATEINIT;
$cus_support->resetAttributes();
$cus_support_list->renderRow();
while ($cus_support_list->RecordCount < $cus_support_list->StopRecord) {
	$cus_support_list->RecordCount++;
	if ($cus_support_list->RecordCount >= $cus_support_list->StartRecord) {
		$cus_support_list->RowCount++;

		// Set up key count
		$cus_support_list->KeyCount = $cus_support_list->RowIndex;

		// Init row class and style
		$cus_support->resetAttributes();
		$cus_support->CssClass = "";
		if ($cus_support_list->isGridAdd()) {
		} else {
			$cus_support_list->loadRowValues($cus_support_list->Recordset); // Load row values
		}
		$cus_support->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cus_support->RowAttrs->merge(["data-rowindex" => $cus_support_list->RowCount, "id" => "r" . $cus_support_list->RowCount . "_cus_support", "data-rowtype" => $cus_support->RowType]);

		// Render row
		$cus_support_list->renderRow();

		// Render list options
		$cus_support_list->renderListOptions();
?>
	<tr <?php echo $cus_support->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cus_support_list->ListOptions->render("body", "left", $cus_support_list->RowCount);
?>
	<?php if ($cus_support_list->cus_sup_id->Visible) { // cus_sup_id ?>
		<td data-name="cus_sup_id" <?php echo $cus_support_list->cus_sup_id->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_id">
<span<?php echo $cus_support_list->cus_sup_id->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cus_support_list->cus_sup_branch_id->Visible) { // cus_sup_branch_id ?>
		<td data-name="cus_sup_branch_id" <?php echo $cus_support_list->cus_sup_branch_id->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_branch_id">
<span<?php echo $cus_support_list->cus_sup_branch_id->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_branch_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cus_support_list->cus_sup_emp_id->Visible) { // cus_sup_emp_id ?>
		<td data-name="cus_sup_emp_id" <?php echo $cus_support_list->cus_sup_emp_id->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_emp_id">
<span<?php echo $cus_support_list->cus_sup_emp_id->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_emp_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cus_support_list->cus_sup_date->Visible) { // cus_sup_date ?>
		<td data-name="cus_sup_date" <?php echo $cus_support_list->cus_sup_date->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_date">
<span<?php echo $cus_support_list->cus_sup_date->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cus_support_list->cus_sup_status->Visible) { // cus_sup_status ?>
		<td data-name="cus_sup_status" <?php echo $cus_support_list->cus_sup_status->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_status">
<span<?php echo $cus_support_list->cus_sup_status->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cus_support_list->cus_sup_resolved_on->Visible) { // cus_sup_resolved_on ?>
		<td data-name="cus_sup_resolved_on" <?php echo $cus_support_list->cus_sup_resolved_on->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_resolved_on">
<span<?php echo $cus_support_list->cus_sup_resolved_on->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_resolved_on->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cus_support_list->ListOptions->render("body", "right", $cus_support_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cus_support_list->isGridAdd())
		$cus_support_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cus_support->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cus_support_list->Recordset)
	$cus_support_list->Recordset->Close();
?>
<?php if (!$cus_support_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cus_support_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cus_support_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cus_support_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cus_support_list->TotalRecords == 0 && !$cus_support->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cus_support_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cus_support_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cus_support_list->isExport()) { ?>
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
$cus_support_list->terminate();
?>