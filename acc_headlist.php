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
$acc_head_list = new acc_head_list();

// Run the page
$acc_head_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acc_head_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$acc_head_list->isExport()) { ?>
<script>
var facc_headlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	facc_headlist = currentForm = new ew.Form("facc_headlist", "list");
	facc_headlist.formKeyCountName = '<?php echo $acc_head_list->FormKeyCountName ?>';
	loadjs.done("facc_headlist");
});
var facc_headlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	facc_headlistsrch = currentSearchForm = new ew.Form("facc_headlistsrch");

	// Dynamic selection lists
	// Filters

	facc_headlistsrch.filterList = <?php echo $acc_head_list->getFilterList() ?>;
	loadjs.done("facc_headlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$acc_head_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($acc_head_list->TotalRecords > 0 && $acc_head_list->ExportOptions->visible()) { ?>
<?php $acc_head_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($acc_head_list->ImportOptions->visible()) { ?>
<?php $acc_head_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($acc_head_list->SearchOptions->visible()) { ?>
<?php $acc_head_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($acc_head_list->FilterOptions->visible()) { ?>
<?php $acc_head_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$acc_head_list->renderOtherOptions();
?>
<?php if (!$acc_head_list->isExport() && !$acc_head->CurrentAction) { ?>
<form name="facc_headlistsrch" id="facc_headlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="facc_headlistsrch-search-panel" class="<?php echo $acc_head_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="acc_head">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $acc_head_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($acc_head_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($acc_head_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $acc_head_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($acc_head_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($acc_head_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($acc_head_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($acc_head_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $acc_head_list->showPageHeader(); ?>
<?php
$acc_head_list->showMessage();
?>
<?php if ($acc_head_list->TotalRecords > 0 || $acc_head->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($acc_head_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> acc_head">
<form name="facc_headlist" id="facc_headlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acc_head">
<div id="gmp_acc_head" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($acc_head_list->TotalRecords > 0 || $acc_head_list->isGridEdit()) { ?>
<table id="tbl_acc_headlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$acc_head->RowType = ROWTYPE_HEADER;

// Render list options
$acc_head_list->renderListOptions();

// Render list options (header, left)
$acc_head_list->ListOptions->render("header", "left");
?>
<?php if ($acc_head_list->acc_head_id->Visible) { // acc_head_id ?>
	<?php if ($acc_head_list->SortUrl($acc_head_list->acc_head_id) == "") { ?>
		<th data-name="acc_head_id" class="<?php echo $acc_head_list->acc_head_id->headerCellClass() ?>"><div id="elh_acc_head_acc_head_id" class="acc_head_acc_head_id"><div class="ew-table-header-caption"><?php echo $acc_head_list->acc_head_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="acc_head_id" class="<?php echo $acc_head_list->acc_head_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acc_head_list->SortUrl($acc_head_list->acc_head_id) ?>', 1);"><div id="elh_acc_head_acc_head_id" class="acc_head_acc_head_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acc_head_list->acc_head_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($acc_head_list->acc_head_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acc_head_list->acc_head_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($acc_head_list->acc_head_acc_nature_id->Visible) { // acc_head_acc_nature_id ?>
	<?php if ($acc_head_list->SortUrl($acc_head_list->acc_head_acc_nature_id) == "") { ?>
		<th data-name="acc_head_acc_nature_id" class="<?php echo $acc_head_list->acc_head_acc_nature_id->headerCellClass() ?>"><div id="elh_acc_head_acc_head_acc_nature_id" class="acc_head_acc_head_acc_nature_id"><div class="ew-table-header-caption"><?php echo $acc_head_list->acc_head_acc_nature_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="acc_head_acc_nature_id" class="<?php echo $acc_head_list->acc_head_acc_nature_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acc_head_list->SortUrl($acc_head_list->acc_head_acc_nature_id) ?>', 1);"><div id="elh_acc_head_acc_head_acc_nature_id" class="acc_head_acc_head_acc_nature_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acc_head_list->acc_head_acc_nature_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($acc_head_list->acc_head_acc_nature_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acc_head_list->acc_head_acc_nature_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($acc_head_list->acc_head_caption->Visible) { // acc_head_caption ?>
	<?php if ($acc_head_list->SortUrl($acc_head_list->acc_head_caption) == "") { ?>
		<th data-name="acc_head_caption" class="<?php echo $acc_head_list->acc_head_caption->headerCellClass() ?>"><div id="elh_acc_head_acc_head_caption" class="acc_head_acc_head_caption"><div class="ew-table-header-caption"><?php echo $acc_head_list->acc_head_caption->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="acc_head_caption" class="<?php echo $acc_head_list->acc_head_caption->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acc_head_list->SortUrl($acc_head_list->acc_head_caption) ?>', 1);"><div id="elh_acc_head_acc_head_caption" class="acc_head_acc_head_caption">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acc_head_list->acc_head_caption->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($acc_head_list->acc_head_caption->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acc_head_list->acc_head_caption->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($acc_head_list->acc_head_desc->Visible) { // acc_head_desc ?>
	<?php if ($acc_head_list->SortUrl($acc_head_list->acc_head_desc) == "") { ?>
		<th data-name="acc_head_desc" class="<?php echo $acc_head_list->acc_head_desc->headerCellClass() ?>"><div id="elh_acc_head_acc_head_desc" class="acc_head_acc_head_desc"><div class="ew-table-header-caption"><?php echo $acc_head_list->acc_head_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="acc_head_desc" class="<?php echo $acc_head_list->acc_head_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acc_head_list->SortUrl($acc_head_list->acc_head_desc) ?>', 1);"><div id="elh_acc_head_acc_head_desc" class="acc_head_acc_head_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acc_head_list->acc_head_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($acc_head_list->acc_head_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acc_head_list->acc_head_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$acc_head_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($acc_head_list->ExportAll && $acc_head_list->isExport()) {
	$acc_head_list->StopRecord = $acc_head_list->TotalRecords;
} else {

	// Set the last record to display
	if ($acc_head_list->TotalRecords > $acc_head_list->StartRecord + $acc_head_list->DisplayRecords - 1)
		$acc_head_list->StopRecord = $acc_head_list->StartRecord + $acc_head_list->DisplayRecords - 1;
	else
		$acc_head_list->StopRecord = $acc_head_list->TotalRecords;
}
$acc_head_list->RecordCount = $acc_head_list->StartRecord - 1;
if ($acc_head_list->Recordset && !$acc_head_list->Recordset->EOF) {
	$acc_head_list->Recordset->moveFirst();
	$selectLimit = $acc_head_list->UseSelectLimit;
	if (!$selectLimit && $acc_head_list->StartRecord > 1)
		$acc_head_list->Recordset->move($acc_head_list->StartRecord - 1);
} elseif (!$acc_head->AllowAddDeleteRow && $acc_head_list->StopRecord == 0) {
	$acc_head_list->StopRecord = $acc_head->GridAddRowCount;
}

// Initialize aggregate
$acc_head->RowType = ROWTYPE_AGGREGATEINIT;
$acc_head->resetAttributes();
$acc_head_list->renderRow();
while ($acc_head_list->RecordCount < $acc_head_list->StopRecord) {
	$acc_head_list->RecordCount++;
	if ($acc_head_list->RecordCount >= $acc_head_list->StartRecord) {
		$acc_head_list->RowCount++;

		// Set up key count
		$acc_head_list->KeyCount = $acc_head_list->RowIndex;

		// Init row class and style
		$acc_head->resetAttributes();
		$acc_head->CssClass = "";
		if ($acc_head_list->isGridAdd()) {
		} else {
			$acc_head_list->loadRowValues($acc_head_list->Recordset); // Load row values
		}
		$acc_head->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$acc_head->RowAttrs->merge(["data-rowindex" => $acc_head_list->RowCount, "id" => "r" . $acc_head_list->RowCount . "_acc_head", "data-rowtype" => $acc_head->RowType]);

		// Render row
		$acc_head_list->renderRow();

		// Render list options
		$acc_head_list->renderListOptions();
?>
	<tr <?php echo $acc_head->rowAttributes() ?>>
<?php

// Render list options (body, left)
$acc_head_list->ListOptions->render("body", "left", $acc_head_list->RowCount);
?>
	<?php if ($acc_head_list->acc_head_id->Visible) { // acc_head_id ?>
		<td data-name="acc_head_id" <?php echo $acc_head_list->acc_head_id->cellAttributes() ?>>
<span id="el<?php echo $acc_head_list->RowCount ?>_acc_head_acc_head_id">
<span<?php echo $acc_head_list->acc_head_id->viewAttributes() ?>><?php echo $acc_head_list->acc_head_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($acc_head_list->acc_head_acc_nature_id->Visible) { // acc_head_acc_nature_id ?>
		<td data-name="acc_head_acc_nature_id" <?php echo $acc_head_list->acc_head_acc_nature_id->cellAttributes() ?>>
<span id="el<?php echo $acc_head_list->RowCount ?>_acc_head_acc_head_acc_nature_id">
<span<?php echo $acc_head_list->acc_head_acc_nature_id->viewAttributes() ?>><?php echo $acc_head_list->acc_head_acc_nature_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($acc_head_list->acc_head_caption->Visible) { // acc_head_caption ?>
		<td data-name="acc_head_caption" <?php echo $acc_head_list->acc_head_caption->cellAttributes() ?>>
<span id="el<?php echo $acc_head_list->RowCount ?>_acc_head_acc_head_caption">
<span<?php echo $acc_head_list->acc_head_caption->viewAttributes() ?>><?php echo $acc_head_list->acc_head_caption->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($acc_head_list->acc_head_desc->Visible) { // acc_head_desc ?>
		<td data-name="acc_head_desc" <?php echo $acc_head_list->acc_head_desc->cellAttributes() ?>>
<span id="el<?php echo $acc_head_list->RowCount ?>_acc_head_acc_head_desc">
<span<?php echo $acc_head_list->acc_head_desc->viewAttributes() ?>><?php echo $acc_head_list->acc_head_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$acc_head_list->ListOptions->render("body", "right", $acc_head_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$acc_head_list->isGridAdd())
		$acc_head_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$acc_head->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($acc_head_list->Recordset)
	$acc_head_list->Recordset->Close();
?>
<?php if (!$acc_head_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$acc_head_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acc_head_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $acc_head_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($acc_head_list->TotalRecords == 0 && !$acc_head->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $acc_head_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$acc_head_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$acc_head_list->isExport()) { ?>
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
$acc_head_list->terminate();
?>