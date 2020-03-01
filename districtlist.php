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
$district_list = new district_list();

// Run the page
$district_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$district_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$district_list->isExport()) { ?>
<script>
var fdistrictlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdistrictlist = currentForm = new ew.Form("fdistrictlist", "list");
	fdistrictlist.formKeyCountName = '<?php echo $district_list->FormKeyCountName ?>';
	loadjs.done("fdistrictlist");
});
var fdistrictlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdistrictlistsrch = currentSearchForm = new ew.Form("fdistrictlistsrch");

	// Dynamic selection lists
	// Filters

	fdistrictlistsrch.filterList = <?php echo $district_list->getFilterList() ?>;
	loadjs.done("fdistrictlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$district_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($district_list->TotalRecords > 0 && $district_list->ExportOptions->visible()) { ?>
<?php $district_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($district_list->ImportOptions->visible()) { ?>
<?php $district_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($district_list->SearchOptions->visible()) { ?>
<?php $district_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($district_list->FilterOptions->visible()) { ?>
<?php $district_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$district_list->renderOtherOptions();
?>
<?php if (!$district_list->isExport() && !$district->CurrentAction) { ?>
<form name="fdistrictlistsrch" id="fdistrictlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdistrictlistsrch-search-panel" class="<?php echo $district_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="district">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $district_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($district_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($district_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $district_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($district_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($district_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($district_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($district_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $district_list->showPageHeader(); ?>
<?php
$district_list->showMessage();
?>
<?php if ($district_list->TotalRecords > 0 || $district->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($district_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> district">
<form name="fdistrictlist" id="fdistrictlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="district">
<div id="gmp_district" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($district_list->TotalRecords > 0 || $district_list->isGridEdit()) { ?>
<table id="tbl_districtlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$district->RowType = ROWTYPE_HEADER;

// Render list options
$district_list->renderListOptions();

// Render list options (header, left)
$district_list->ListOptions->render("header", "left");
?>
<?php if ($district_list->district_id->Visible) { // district_id ?>
	<?php if ($district_list->SortUrl($district_list->district_id) == "") { ?>
		<th data-name="district_id" class="<?php echo $district_list->district_id->headerCellClass() ?>"><div id="elh_district_district_id" class="district_district_id"><div class="ew-table-header-caption"><?php echo $district_list->district_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="district_id" class="<?php echo $district_list->district_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $district_list->SortUrl($district_list->district_id) ?>', 1);"><div id="elh_district_district_id" class="district_district_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $district_list->district_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($district_list->district_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($district_list->district_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($district_list->district_division_id->Visible) { // district_division_id ?>
	<?php if ($district_list->SortUrl($district_list->district_division_id) == "") { ?>
		<th data-name="district_division_id" class="<?php echo $district_list->district_division_id->headerCellClass() ?>"><div id="elh_district_district_division_id" class="district_district_division_id"><div class="ew-table-header-caption"><?php echo $district_list->district_division_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="district_division_id" class="<?php echo $district_list->district_division_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $district_list->SortUrl($district_list->district_division_id) ?>', 1);"><div id="elh_district_district_division_id" class="district_district_division_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $district_list->district_division_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($district_list->district_division_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($district_list->district_division_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($district_list->district_name->Visible) { // district_name ?>
	<?php if ($district_list->SortUrl($district_list->district_name) == "") { ?>
		<th data-name="district_name" class="<?php echo $district_list->district_name->headerCellClass() ?>"><div id="elh_district_district_name" class="district_district_name"><div class="ew-table-header-caption"><?php echo $district_list->district_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="district_name" class="<?php echo $district_list->district_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $district_list->SortUrl($district_list->district_name) ?>', 1);"><div id="elh_district_district_name" class="district_district_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $district_list->district_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($district_list->district_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($district_list->district_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$district_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($district_list->ExportAll && $district_list->isExport()) {
	$district_list->StopRecord = $district_list->TotalRecords;
} else {

	// Set the last record to display
	if ($district_list->TotalRecords > $district_list->StartRecord + $district_list->DisplayRecords - 1)
		$district_list->StopRecord = $district_list->StartRecord + $district_list->DisplayRecords - 1;
	else
		$district_list->StopRecord = $district_list->TotalRecords;
}
$district_list->RecordCount = $district_list->StartRecord - 1;
if ($district_list->Recordset && !$district_list->Recordset->EOF) {
	$district_list->Recordset->moveFirst();
	$selectLimit = $district_list->UseSelectLimit;
	if (!$selectLimit && $district_list->StartRecord > 1)
		$district_list->Recordset->move($district_list->StartRecord - 1);
} elseif (!$district->AllowAddDeleteRow && $district_list->StopRecord == 0) {
	$district_list->StopRecord = $district->GridAddRowCount;
}

// Initialize aggregate
$district->RowType = ROWTYPE_AGGREGATEINIT;
$district->resetAttributes();
$district_list->renderRow();
while ($district_list->RecordCount < $district_list->StopRecord) {
	$district_list->RecordCount++;
	if ($district_list->RecordCount >= $district_list->StartRecord) {
		$district_list->RowCount++;

		// Set up key count
		$district_list->KeyCount = $district_list->RowIndex;

		// Init row class and style
		$district->resetAttributes();
		$district->CssClass = "";
		if ($district_list->isGridAdd()) {
		} else {
			$district_list->loadRowValues($district_list->Recordset); // Load row values
		}
		$district->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$district->RowAttrs->merge(["data-rowindex" => $district_list->RowCount, "id" => "r" . $district_list->RowCount . "_district", "data-rowtype" => $district->RowType]);

		// Render row
		$district_list->renderRow();

		// Render list options
		$district_list->renderListOptions();
?>
	<tr <?php echo $district->rowAttributes() ?>>
<?php

// Render list options (body, left)
$district_list->ListOptions->render("body", "left", $district_list->RowCount);
?>
	<?php if ($district_list->district_id->Visible) { // district_id ?>
		<td data-name="district_id" <?php echo $district_list->district_id->cellAttributes() ?>>
<span id="el<?php echo $district_list->RowCount ?>_district_district_id">
<span<?php echo $district_list->district_id->viewAttributes() ?>><?php echo $district_list->district_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($district_list->district_division_id->Visible) { // district_division_id ?>
		<td data-name="district_division_id" <?php echo $district_list->district_division_id->cellAttributes() ?>>
<span id="el<?php echo $district_list->RowCount ?>_district_district_division_id">
<span<?php echo $district_list->district_division_id->viewAttributes() ?>><?php echo $district_list->district_division_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($district_list->district_name->Visible) { // district_name ?>
		<td data-name="district_name" <?php echo $district_list->district_name->cellAttributes() ?>>
<span id="el<?php echo $district_list->RowCount ?>_district_district_name">
<span<?php echo $district_list->district_name->viewAttributes() ?>><?php echo $district_list->district_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$district_list->ListOptions->render("body", "right", $district_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$district_list->isGridAdd())
		$district_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$district->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($district_list->Recordset)
	$district_list->Recordset->Close();
?>
<?php if (!$district_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$district_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $district_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $district_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($district_list->TotalRecords == 0 && !$district->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $district_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$district_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$district_list->isExport()) { ?>
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
$district_list->terminate();
?>