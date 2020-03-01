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
$sms_package_list = new sms_package_list();

// Run the page
$sms_package_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_package_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sms_package_list->isExport()) { ?>
<script>
var fsms_packagelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsms_packagelist = currentForm = new ew.Form("fsms_packagelist", "list");
	fsms_packagelist.formKeyCountName = '<?php echo $sms_package_list->FormKeyCountName ?>';
	loadjs.done("fsms_packagelist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sms_package_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($sms_package_list->TotalRecords > 0 && $sms_package_list->ExportOptions->visible()) { ?>
<?php $sms_package_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($sms_package_list->ImportOptions->visible()) { ?>
<?php $sms_package_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$sms_package_list->renderOtherOptions();
?>
<?php $sms_package_list->showPageHeader(); ?>
<?php
$sms_package_list->showMessage();
?>
<?php if ($sms_package_list->TotalRecords > 0 || $sms_package->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($sms_package_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> sms_package">
<?php if (!$sms_package_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$sms_package_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sms_package_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sms_package_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsms_packagelist" id="fsms_packagelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_package">
<div id="gmp_sms_package" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($sms_package_list->TotalRecords > 0 || $sms_package_list->isGridEdit()) { ?>
<table id="tbl_sms_packagelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$sms_package->RowType = ROWTYPE_HEADER;

// Render list options
$sms_package_list->renderListOptions();

// Render list options (header, left)
$sms_package_list->ListOptions->render("header", "left");
?>
<?php if ($sms_package_list->sms_pkg_id->Visible) { // sms_pkg_id ?>
	<?php if ($sms_package_list->SortUrl($sms_package_list->sms_pkg_id) == "") { ?>
		<th data-name="sms_pkg_id" class="<?php echo $sms_package_list->sms_pkg_id->headerCellClass() ?>"><div id="elh_sms_package_sms_pkg_id" class="sms_package_sms_pkg_id"><div class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sms_pkg_id" class="<?php echo $sms_package_list->sms_pkg_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_package_list->SortUrl($sms_package_list->sms_pkg_id) ?>', 1);"><div id="elh_sms_package_sms_pkg_id" class="sms_package_sms_pkg_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_package_list->sms_pkg_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_package_list->sms_pkg_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sms_package_list->sms_pkg_sms_api_id->Visible) { // sms_pkg_sms_api_id ?>
	<?php if ($sms_package_list->SortUrl($sms_package_list->sms_pkg_sms_api_id) == "") { ?>
		<th data-name="sms_pkg_sms_api_id" class="<?php echo $sms_package_list->sms_pkg_sms_api_id->headerCellClass() ?>"><div id="elh_sms_package_sms_pkg_sms_api_id" class="sms_package_sms_pkg_sms_api_id"><div class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_sms_api_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sms_pkg_sms_api_id" class="<?php echo $sms_package_list->sms_pkg_sms_api_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_package_list->SortUrl($sms_package_list->sms_pkg_sms_api_id) ?>', 1);"><div id="elh_sms_package_sms_pkg_sms_api_id" class="sms_package_sms_pkg_sms_api_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_sms_api_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_package_list->sms_pkg_sms_api_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_package_list->sms_pkg_sms_api_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sms_package_list->sms_pkg_branch_id->Visible) { // sms_pkg_branch_id ?>
	<?php if ($sms_package_list->SortUrl($sms_package_list->sms_pkg_branch_id) == "") { ?>
		<th data-name="sms_pkg_branch_id" class="<?php echo $sms_package_list->sms_pkg_branch_id->headerCellClass() ?>"><div id="elh_sms_package_sms_pkg_branch_id" class="sms_package_sms_pkg_branch_id"><div class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_branch_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sms_pkg_branch_id" class="<?php echo $sms_package_list->sms_pkg_branch_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_package_list->SortUrl($sms_package_list->sms_pkg_branch_id) ?>', 1);"><div id="elh_sms_package_sms_pkg_branch_id" class="sms_package_sms_pkg_branch_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_package_list->sms_pkg_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_package_list->sms_pkg_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sms_package_list->sms_pkg_total_allowed_sms->Visible) { // sms_pkg_total_allowed_sms ?>
	<?php if ($sms_package_list->SortUrl($sms_package_list->sms_pkg_total_allowed_sms) == "") { ?>
		<th data-name="sms_pkg_total_allowed_sms" class="<?php echo $sms_package_list->sms_pkg_total_allowed_sms->headerCellClass() ?>"><div id="elh_sms_package_sms_pkg_total_allowed_sms" class="sms_package_sms_pkg_total_allowed_sms"><div class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_total_allowed_sms->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sms_pkg_total_allowed_sms" class="<?php echo $sms_package_list->sms_pkg_total_allowed_sms->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_package_list->SortUrl($sms_package_list->sms_pkg_total_allowed_sms) ?>', 1);"><div id="elh_sms_package_sms_pkg_total_allowed_sms" class="sms_package_sms_pkg_total_allowed_sms">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_total_allowed_sms->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_package_list->sms_pkg_total_allowed_sms->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_package_list->sms_pkg_total_allowed_sms->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sms_package_list->sms_pkg_expiry_date->Visible) { // sms_pkg_expiry_date ?>
	<?php if ($sms_package_list->SortUrl($sms_package_list->sms_pkg_expiry_date) == "") { ?>
		<th data-name="sms_pkg_expiry_date" class="<?php echo $sms_package_list->sms_pkg_expiry_date->headerCellClass() ?>"><div id="elh_sms_package_sms_pkg_expiry_date" class="sms_package_sms_pkg_expiry_date"><div class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_expiry_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sms_pkg_expiry_date" class="<?php echo $sms_package_list->sms_pkg_expiry_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_package_list->SortUrl($sms_package_list->sms_pkg_expiry_date) ?>', 1);"><div id="elh_sms_package_sms_pkg_expiry_date" class="sms_package_sms_pkg_expiry_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_expiry_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_package_list->sms_pkg_expiry_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_package_list->sms_pkg_expiry_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sms_package_list->sms_pkg_per_sms_cost->Visible) { // sms_pkg_per_sms_cost ?>
	<?php if ($sms_package_list->SortUrl($sms_package_list->sms_pkg_per_sms_cost) == "") { ?>
		<th data-name="sms_pkg_per_sms_cost" class="<?php echo $sms_package_list->sms_pkg_per_sms_cost->headerCellClass() ?>"><div id="elh_sms_package_sms_pkg_per_sms_cost" class="sms_package_sms_pkg_per_sms_cost"><div class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_per_sms_cost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sms_pkg_per_sms_cost" class="<?php echo $sms_package_list->sms_pkg_per_sms_cost->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_package_list->SortUrl($sms_package_list->sms_pkg_per_sms_cost) ?>', 1);"><div id="elh_sms_package_sms_pkg_per_sms_cost" class="sms_package_sms_pkg_per_sms_cost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_per_sms_cost->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_package_list->sms_pkg_per_sms_cost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_package_list->sms_pkg_per_sms_cost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$sms_package_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($sms_package_list->ExportAll && $sms_package_list->isExport()) {
	$sms_package_list->StopRecord = $sms_package_list->TotalRecords;
} else {

	// Set the last record to display
	if ($sms_package_list->TotalRecords > $sms_package_list->StartRecord + $sms_package_list->DisplayRecords - 1)
		$sms_package_list->StopRecord = $sms_package_list->StartRecord + $sms_package_list->DisplayRecords - 1;
	else
		$sms_package_list->StopRecord = $sms_package_list->TotalRecords;
}
$sms_package_list->RecordCount = $sms_package_list->StartRecord - 1;
if ($sms_package_list->Recordset && !$sms_package_list->Recordset->EOF) {
	$sms_package_list->Recordset->moveFirst();
	$selectLimit = $sms_package_list->UseSelectLimit;
	if (!$selectLimit && $sms_package_list->StartRecord > 1)
		$sms_package_list->Recordset->move($sms_package_list->StartRecord - 1);
} elseif (!$sms_package->AllowAddDeleteRow && $sms_package_list->StopRecord == 0) {
	$sms_package_list->StopRecord = $sms_package->GridAddRowCount;
}

// Initialize aggregate
$sms_package->RowType = ROWTYPE_AGGREGATEINIT;
$sms_package->resetAttributes();
$sms_package_list->renderRow();
while ($sms_package_list->RecordCount < $sms_package_list->StopRecord) {
	$sms_package_list->RecordCount++;
	if ($sms_package_list->RecordCount >= $sms_package_list->StartRecord) {
		$sms_package_list->RowCount++;

		// Set up key count
		$sms_package_list->KeyCount = $sms_package_list->RowIndex;

		// Init row class and style
		$sms_package->resetAttributes();
		$sms_package->CssClass = "";
		if ($sms_package_list->isGridAdd()) {
		} else {
			$sms_package_list->loadRowValues($sms_package_list->Recordset); // Load row values
		}
		$sms_package->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$sms_package->RowAttrs->merge(["data-rowindex" => $sms_package_list->RowCount, "id" => "r" . $sms_package_list->RowCount . "_sms_package", "data-rowtype" => $sms_package->RowType]);

		// Render row
		$sms_package_list->renderRow();

		// Render list options
		$sms_package_list->renderListOptions();
?>
	<tr <?php echo $sms_package->rowAttributes() ?>>
<?php

// Render list options (body, left)
$sms_package_list->ListOptions->render("body", "left", $sms_package_list->RowCount);
?>
	<?php if ($sms_package_list->sms_pkg_id->Visible) { // sms_pkg_id ?>
		<td data-name="sms_pkg_id" <?php echo $sms_package_list->sms_pkg_id->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_id">
<span<?php echo $sms_package_list->sms_pkg_id->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sms_package_list->sms_pkg_sms_api_id->Visible) { // sms_pkg_sms_api_id ?>
		<td data-name="sms_pkg_sms_api_id" <?php echo $sms_package_list->sms_pkg_sms_api_id->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_sms_api_id">
<span<?php echo $sms_package_list->sms_pkg_sms_api_id->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_sms_api_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sms_package_list->sms_pkg_branch_id->Visible) { // sms_pkg_branch_id ?>
		<td data-name="sms_pkg_branch_id" <?php echo $sms_package_list->sms_pkg_branch_id->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_branch_id">
<span<?php echo $sms_package_list->sms_pkg_branch_id->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_branch_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sms_package_list->sms_pkg_total_allowed_sms->Visible) { // sms_pkg_total_allowed_sms ?>
		<td data-name="sms_pkg_total_allowed_sms" <?php echo $sms_package_list->sms_pkg_total_allowed_sms->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_total_allowed_sms">
<span<?php echo $sms_package_list->sms_pkg_total_allowed_sms->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_total_allowed_sms->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sms_package_list->sms_pkg_expiry_date->Visible) { // sms_pkg_expiry_date ?>
		<td data-name="sms_pkg_expiry_date" <?php echo $sms_package_list->sms_pkg_expiry_date->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_expiry_date">
<span<?php echo $sms_package_list->sms_pkg_expiry_date->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_expiry_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sms_package_list->sms_pkg_per_sms_cost->Visible) { // sms_pkg_per_sms_cost ?>
		<td data-name="sms_pkg_per_sms_cost" <?php echo $sms_package_list->sms_pkg_per_sms_cost->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_per_sms_cost">
<span<?php echo $sms_package_list->sms_pkg_per_sms_cost->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_per_sms_cost->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sms_package_list->ListOptions->render("body", "right", $sms_package_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$sms_package_list->isGridAdd())
		$sms_package_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$sms_package->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($sms_package_list->Recordset)
	$sms_package_list->Recordset->Close();
?>
<?php if (!$sms_package_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$sms_package_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sms_package_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sms_package_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($sms_package_list->TotalRecords == 0 && !$sms_package->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $sms_package_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$sms_package_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sms_package_list->isExport()) { ?>
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
$sms_package_list->terminate();
?>