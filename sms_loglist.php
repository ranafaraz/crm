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
$sms_log_list = new sms_log_list();

// Run the page
$sms_log_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_log_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sms_log_list->isExport()) { ?>
<script>
var fsms_loglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsms_loglist = currentForm = new ew.Form("fsms_loglist", "list");
	fsms_loglist.formKeyCountName = '<?php echo $sms_log_list->FormKeyCountName ?>';
	loadjs.done("fsms_loglist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sms_log_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($sms_log_list->TotalRecords > 0 && $sms_log_list->ExportOptions->visible()) { ?>
<?php $sms_log_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($sms_log_list->ImportOptions->visible()) { ?>
<?php $sms_log_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$sms_log_list->renderOtherOptions();
?>
<?php $sms_log_list->showPageHeader(); ?>
<?php
$sms_log_list->showMessage();
?>
<?php if ($sms_log_list->TotalRecords > 0 || $sms_log->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($sms_log_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> sms_log">
<?php if (!$sms_log_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$sms_log_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sms_log_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sms_log_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsms_loglist" id="fsms_loglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_log">
<div id="gmp_sms_log" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($sms_log_list->TotalRecords > 0 || $sms_log_list->isGridEdit()) { ?>
<table id="tbl_sms_loglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$sms_log->RowType = ROWTYPE_HEADER;

// Render list options
$sms_log_list->renderListOptions();

// Render list options (header, left)
$sms_log_list->ListOptions->render("header", "left");
?>
<?php if ($sms_log_list->sms_log_id->Visible) { // sms_log_id ?>
	<?php if ($sms_log_list->SortUrl($sms_log_list->sms_log_id) == "") { ?>
		<th data-name="sms_log_id" class="<?php echo $sms_log_list->sms_log_id->headerCellClass() ?>"><div id="elh_sms_log_sms_log_id" class="sms_log_sms_log_id"><div class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sms_log_id" class="<?php echo $sms_log_list->sms_log_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_log_list->SortUrl($sms_log_list->sms_log_id) ?>', 1);"><div id="elh_sms_log_sms_log_id" class="sms_log_sms_log_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_log_list->sms_log_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_log_list->sms_log_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sms_log_list->sms_log_branch_id->Visible) { // sms_log_branch_id ?>
	<?php if ($sms_log_list->SortUrl($sms_log_list->sms_log_branch_id) == "") { ?>
		<th data-name="sms_log_branch_id" class="<?php echo $sms_log_list->sms_log_branch_id->headerCellClass() ?>"><div id="elh_sms_log_sms_log_branch_id" class="sms_log_sms_log_branch_id"><div class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_branch_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sms_log_branch_id" class="<?php echo $sms_log_list->sms_log_branch_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_log_list->SortUrl($sms_log_list->sms_log_branch_id) ?>', 1);"><div id="elh_sms_log_sms_log_branch_id" class="sms_log_sms_log_branch_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_log_list->sms_log_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_log_list->sms_log_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sms_log_list->sms_log_sms_api_id->Visible) { // sms_log_sms_api_id ?>
	<?php if ($sms_log_list->SortUrl($sms_log_list->sms_log_sms_api_id) == "") { ?>
		<th data-name="sms_log_sms_api_id" class="<?php echo $sms_log_list->sms_log_sms_api_id->headerCellClass() ?>"><div id="elh_sms_log_sms_log_sms_api_id" class="sms_log_sms_log_sms_api_id"><div class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_sms_api_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sms_log_sms_api_id" class="<?php echo $sms_log_list->sms_log_sms_api_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_log_list->SortUrl($sms_log_list->sms_log_sms_api_id) ?>', 1);"><div id="elh_sms_log_sms_log_sms_api_id" class="sms_log_sms_log_sms_api_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_sms_api_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_log_list->sms_log_sms_api_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_log_list->sms_log_sms_api_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sms_log_list->sms_log_date->Visible) { // sms_log_date ?>
	<?php if ($sms_log_list->SortUrl($sms_log_list->sms_log_date) == "") { ?>
		<th data-name="sms_log_date" class="<?php echo $sms_log_list->sms_log_date->headerCellClass() ?>"><div id="elh_sms_log_sms_log_date" class="sms_log_sms_log_date"><div class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sms_log_date" class="<?php echo $sms_log_list->sms_log_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_log_list->SortUrl($sms_log_list->sms_log_date) ?>', 1);"><div id="elh_sms_log_sms_log_date" class="sms_log_sms_log_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_log_list->sms_log_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_log_list->sms_log_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$sms_log_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($sms_log_list->ExportAll && $sms_log_list->isExport()) {
	$sms_log_list->StopRecord = $sms_log_list->TotalRecords;
} else {

	// Set the last record to display
	if ($sms_log_list->TotalRecords > $sms_log_list->StartRecord + $sms_log_list->DisplayRecords - 1)
		$sms_log_list->StopRecord = $sms_log_list->StartRecord + $sms_log_list->DisplayRecords - 1;
	else
		$sms_log_list->StopRecord = $sms_log_list->TotalRecords;
}
$sms_log_list->RecordCount = $sms_log_list->StartRecord - 1;
if ($sms_log_list->Recordset && !$sms_log_list->Recordset->EOF) {
	$sms_log_list->Recordset->moveFirst();
	$selectLimit = $sms_log_list->UseSelectLimit;
	if (!$selectLimit && $sms_log_list->StartRecord > 1)
		$sms_log_list->Recordset->move($sms_log_list->StartRecord - 1);
} elseif (!$sms_log->AllowAddDeleteRow && $sms_log_list->StopRecord == 0) {
	$sms_log_list->StopRecord = $sms_log->GridAddRowCount;
}

// Initialize aggregate
$sms_log->RowType = ROWTYPE_AGGREGATEINIT;
$sms_log->resetAttributes();
$sms_log_list->renderRow();
while ($sms_log_list->RecordCount < $sms_log_list->StopRecord) {
	$sms_log_list->RecordCount++;
	if ($sms_log_list->RecordCount >= $sms_log_list->StartRecord) {
		$sms_log_list->RowCount++;

		// Set up key count
		$sms_log_list->KeyCount = $sms_log_list->RowIndex;

		// Init row class and style
		$sms_log->resetAttributes();
		$sms_log->CssClass = "";
		if ($sms_log_list->isGridAdd()) {
		} else {
			$sms_log_list->loadRowValues($sms_log_list->Recordset); // Load row values
		}
		$sms_log->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$sms_log->RowAttrs->merge(["data-rowindex" => $sms_log_list->RowCount, "id" => "r" . $sms_log_list->RowCount . "_sms_log", "data-rowtype" => $sms_log->RowType]);

		// Render row
		$sms_log_list->renderRow();

		// Render list options
		$sms_log_list->renderListOptions();
?>
	<tr <?php echo $sms_log->rowAttributes() ?>>
<?php

// Render list options (body, left)
$sms_log_list->ListOptions->render("body", "left", $sms_log_list->RowCount);
?>
	<?php if ($sms_log_list->sms_log_id->Visible) { // sms_log_id ?>
		<td data-name="sms_log_id" <?php echo $sms_log_list->sms_log_id->cellAttributes() ?>>
<span id="el<?php echo $sms_log_list->RowCount ?>_sms_log_sms_log_id">
<span<?php echo $sms_log_list->sms_log_id->viewAttributes() ?>><?php echo $sms_log_list->sms_log_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sms_log_list->sms_log_branch_id->Visible) { // sms_log_branch_id ?>
		<td data-name="sms_log_branch_id" <?php echo $sms_log_list->sms_log_branch_id->cellAttributes() ?>>
<span id="el<?php echo $sms_log_list->RowCount ?>_sms_log_sms_log_branch_id">
<span<?php echo $sms_log_list->sms_log_branch_id->viewAttributes() ?>><?php echo $sms_log_list->sms_log_branch_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sms_log_list->sms_log_sms_api_id->Visible) { // sms_log_sms_api_id ?>
		<td data-name="sms_log_sms_api_id" <?php echo $sms_log_list->sms_log_sms_api_id->cellAttributes() ?>>
<span id="el<?php echo $sms_log_list->RowCount ?>_sms_log_sms_log_sms_api_id">
<span<?php echo $sms_log_list->sms_log_sms_api_id->viewAttributes() ?>><?php echo $sms_log_list->sms_log_sms_api_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sms_log_list->sms_log_date->Visible) { // sms_log_date ?>
		<td data-name="sms_log_date" <?php echo $sms_log_list->sms_log_date->cellAttributes() ?>>
<span id="el<?php echo $sms_log_list->RowCount ?>_sms_log_sms_log_date">
<span<?php echo $sms_log_list->sms_log_date->viewAttributes() ?>><?php echo $sms_log_list->sms_log_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sms_log_list->ListOptions->render("body", "right", $sms_log_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$sms_log_list->isGridAdd())
		$sms_log_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$sms_log->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($sms_log_list->Recordset)
	$sms_log_list->Recordset->Close();
?>
<?php if (!$sms_log_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$sms_log_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sms_log_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sms_log_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($sms_log_list->TotalRecords == 0 && !$sms_log->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $sms_log_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$sms_log_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sms_log_list->isExport()) { ?>
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
$sms_log_list->terminate();
?>