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
$division_list = new division_list();

// Run the page
$division_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$division_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$division_list->isExport()) { ?>
<script>
var fdivisionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdivisionlist = currentForm = new ew.Form("fdivisionlist", "list");
	fdivisionlist.formKeyCountName = '<?php echo $division_list->FormKeyCountName ?>';
	loadjs.done("fdivisionlist");
});
var fdivisionlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdivisionlistsrch = currentSearchForm = new ew.Form("fdivisionlistsrch");

	// Dynamic selection lists
	// Filters

	fdivisionlistsrch.filterList = <?php echo $division_list->getFilterList() ?>;
	loadjs.done("fdivisionlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$division_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($division_list->TotalRecords > 0 && $division_list->ExportOptions->visible()) { ?>
<?php $division_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($division_list->ImportOptions->visible()) { ?>
<?php $division_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($division_list->SearchOptions->visible()) { ?>
<?php $division_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($division_list->FilterOptions->visible()) { ?>
<?php $division_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$division_list->renderOtherOptions();
?>
<?php if (!$division_list->isExport() && !$division->CurrentAction) { ?>
<form name="fdivisionlistsrch" id="fdivisionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdivisionlistsrch-search-panel" class="<?php echo $division_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="division">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $division_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($division_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($division_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $division_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($division_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($division_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($division_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($division_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $division_list->showPageHeader(); ?>
<?php
$division_list->showMessage();
?>
<?php if ($division_list->TotalRecords > 0 || $division->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($division_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> division">
<form name="fdivisionlist" id="fdivisionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="division">
<div id="gmp_division" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($division_list->TotalRecords > 0 || $division_list->isGridEdit()) { ?>
<table id="tbl_divisionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$division->RowType = ROWTYPE_HEADER;

// Render list options
$division_list->renderListOptions();

// Render list options (header, left)
$division_list->ListOptions->render("header", "left");
?>
<?php if ($division_list->division_id->Visible) { // division_id ?>
	<?php if ($division_list->SortUrl($division_list->division_id) == "") { ?>
		<th data-name="division_id" class="<?php echo $division_list->division_id->headerCellClass() ?>"><div id="elh_division_division_id" class="division_division_id"><div class="ew-table-header-caption"><?php echo $division_list->division_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="division_id" class="<?php echo $division_list->division_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $division_list->SortUrl($division_list->division_id) ?>', 1);"><div id="elh_division_division_id" class="division_division_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $division_list->division_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($division_list->division_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($division_list->division_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($division_list->division_state_id->Visible) { // division_state_id ?>
	<?php if ($division_list->SortUrl($division_list->division_state_id) == "") { ?>
		<th data-name="division_state_id" class="<?php echo $division_list->division_state_id->headerCellClass() ?>"><div id="elh_division_division_state_id" class="division_division_state_id"><div class="ew-table-header-caption"><?php echo $division_list->division_state_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="division_state_id" class="<?php echo $division_list->division_state_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $division_list->SortUrl($division_list->division_state_id) ?>', 1);"><div id="elh_division_division_state_id" class="division_division_state_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $division_list->division_state_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($division_list->division_state_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($division_list->division_state_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($division_list->division_name->Visible) { // division_name ?>
	<?php if ($division_list->SortUrl($division_list->division_name) == "") { ?>
		<th data-name="division_name" class="<?php echo $division_list->division_name->headerCellClass() ?>"><div id="elh_division_division_name" class="division_division_name"><div class="ew-table-header-caption"><?php echo $division_list->division_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="division_name" class="<?php echo $division_list->division_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $division_list->SortUrl($division_list->division_name) ?>', 1);"><div id="elh_division_division_name" class="division_division_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $division_list->division_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($division_list->division_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($division_list->division_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($division_list->division_desc->Visible) { // division_desc ?>
	<?php if ($division_list->SortUrl($division_list->division_desc) == "") { ?>
		<th data-name="division_desc" class="<?php echo $division_list->division_desc->headerCellClass() ?>"><div id="elh_division_division_desc" class="division_division_desc"><div class="ew-table-header-caption"><?php echo $division_list->division_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="division_desc" class="<?php echo $division_list->division_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $division_list->SortUrl($division_list->division_desc) ?>', 1);"><div id="elh_division_division_desc" class="division_division_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $division_list->division_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($division_list->division_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($division_list->division_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$division_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($division_list->ExportAll && $division_list->isExport()) {
	$division_list->StopRecord = $division_list->TotalRecords;
} else {

	// Set the last record to display
	if ($division_list->TotalRecords > $division_list->StartRecord + $division_list->DisplayRecords - 1)
		$division_list->StopRecord = $division_list->StartRecord + $division_list->DisplayRecords - 1;
	else
		$division_list->StopRecord = $division_list->TotalRecords;
}
$division_list->RecordCount = $division_list->StartRecord - 1;
if ($division_list->Recordset && !$division_list->Recordset->EOF) {
	$division_list->Recordset->moveFirst();
	$selectLimit = $division_list->UseSelectLimit;
	if (!$selectLimit && $division_list->StartRecord > 1)
		$division_list->Recordset->move($division_list->StartRecord - 1);
} elseif (!$division->AllowAddDeleteRow && $division_list->StopRecord == 0) {
	$division_list->StopRecord = $division->GridAddRowCount;
}

// Initialize aggregate
$division->RowType = ROWTYPE_AGGREGATEINIT;
$division->resetAttributes();
$division_list->renderRow();
while ($division_list->RecordCount < $division_list->StopRecord) {
	$division_list->RecordCount++;
	if ($division_list->RecordCount >= $division_list->StartRecord) {
		$division_list->RowCount++;

		// Set up key count
		$division_list->KeyCount = $division_list->RowIndex;

		// Init row class and style
		$division->resetAttributes();
		$division->CssClass = "";
		if ($division_list->isGridAdd()) {
		} else {
			$division_list->loadRowValues($division_list->Recordset); // Load row values
		}
		$division->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$division->RowAttrs->merge(["data-rowindex" => $division_list->RowCount, "id" => "r" . $division_list->RowCount . "_division", "data-rowtype" => $division->RowType]);

		// Render row
		$division_list->renderRow();

		// Render list options
		$division_list->renderListOptions();
?>
	<tr <?php echo $division->rowAttributes() ?>>
<?php

// Render list options (body, left)
$division_list->ListOptions->render("body", "left", $division_list->RowCount);
?>
	<?php if ($division_list->division_id->Visible) { // division_id ?>
		<td data-name="division_id" <?php echo $division_list->division_id->cellAttributes() ?>>
<span id="el<?php echo $division_list->RowCount ?>_division_division_id">
<span<?php echo $division_list->division_id->viewAttributes() ?>><?php echo $division_list->division_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($division_list->division_state_id->Visible) { // division_state_id ?>
		<td data-name="division_state_id" <?php echo $division_list->division_state_id->cellAttributes() ?>>
<span id="el<?php echo $division_list->RowCount ?>_division_division_state_id">
<span<?php echo $division_list->division_state_id->viewAttributes() ?>><?php echo $division_list->division_state_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($division_list->division_name->Visible) { // division_name ?>
		<td data-name="division_name" <?php echo $division_list->division_name->cellAttributes() ?>>
<span id="el<?php echo $division_list->RowCount ?>_division_division_name">
<span<?php echo $division_list->division_name->viewAttributes() ?>><?php echo $division_list->division_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($division_list->division_desc->Visible) { // division_desc ?>
		<td data-name="division_desc" <?php echo $division_list->division_desc->cellAttributes() ?>>
<span id="el<?php echo $division_list->RowCount ?>_division_division_desc">
<span<?php echo $division_list->division_desc->viewAttributes() ?>><?php echo $division_list->division_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$division_list->ListOptions->render("body", "right", $division_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$division_list->isGridAdd())
		$division_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$division->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($division_list->Recordset)
	$division_list->Recordset->Close();
?>
<?php if (!$division_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$division_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $division_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $division_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($division_list->TotalRecords == 0 && !$division->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $division_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$division_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$division_list->isExport()) { ?>
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
$division_list->terminate();
?>