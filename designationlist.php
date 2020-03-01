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
$designation_list = new designation_list();

// Run the page
$designation_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$designation_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$designation_list->isExport()) { ?>
<script>
var fdesignationlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdesignationlist = currentForm = new ew.Form("fdesignationlist", "list");
	fdesignationlist.formKeyCountName = '<?php echo $designation_list->FormKeyCountName ?>';
	loadjs.done("fdesignationlist");
});
var fdesignationlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdesignationlistsrch = currentSearchForm = new ew.Form("fdesignationlistsrch");

	// Dynamic selection lists
	// Filters

	fdesignationlistsrch.filterList = <?php echo $designation_list->getFilterList() ?>;
	loadjs.done("fdesignationlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$designation_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($designation_list->TotalRecords > 0 && $designation_list->ExportOptions->visible()) { ?>
<?php $designation_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($designation_list->ImportOptions->visible()) { ?>
<?php $designation_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($designation_list->SearchOptions->visible()) { ?>
<?php $designation_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($designation_list->FilterOptions->visible()) { ?>
<?php $designation_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$designation_list->renderOtherOptions();
?>
<?php if (!$designation_list->isExport() && !$designation->CurrentAction) { ?>
<form name="fdesignationlistsrch" id="fdesignationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdesignationlistsrch-search-panel" class="<?php echo $designation_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="designation">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $designation_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($designation_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($designation_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $designation_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($designation_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($designation_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($designation_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($designation_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $designation_list->showPageHeader(); ?>
<?php
$designation_list->showMessage();
?>
<?php if ($designation_list->TotalRecords > 0 || $designation->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($designation_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> designation">
<form name="fdesignationlist" id="fdesignationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="designation">
<div id="gmp_designation" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($designation_list->TotalRecords > 0 || $designation_list->isGridEdit()) { ?>
<table id="tbl_designationlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$designation->RowType = ROWTYPE_HEADER;

// Render list options
$designation_list->renderListOptions();

// Render list options (header, left)
$designation_list->ListOptions->render("header", "left");
?>
<?php if ($designation_list->designation_id->Visible) { // designation_id ?>
	<?php if ($designation_list->SortUrl($designation_list->designation_id) == "") { ?>
		<th data-name="designation_id" class="<?php echo $designation_list->designation_id->headerCellClass() ?>"><div id="elh_designation_designation_id" class="designation_designation_id"><div class="ew-table-header-caption"><?php echo $designation_list->designation_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="designation_id" class="<?php echo $designation_list->designation_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $designation_list->SortUrl($designation_list->designation_id) ?>', 1);"><div id="elh_designation_designation_id" class="designation_designation_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $designation_list->designation_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($designation_list->designation_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($designation_list->designation_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($designation_list->designation_caption->Visible) { // designation_caption ?>
	<?php if ($designation_list->SortUrl($designation_list->designation_caption) == "") { ?>
		<th data-name="designation_caption" class="<?php echo $designation_list->designation_caption->headerCellClass() ?>"><div id="elh_designation_designation_caption" class="designation_designation_caption"><div class="ew-table-header-caption"><?php echo $designation_list->designation_caption->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="designation_caption" class="<?php echo $designation_list->designation_caption->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $designation_list->SortUrl($designation_list->designation_caption) ?>', 1);"><div id="elh_designation_designation_caption" class="designation_designation_caption">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $designation_list->designation_caption->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($designation_list->designation_caption->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($designation_list->designation_caption->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($designation_list->designation_desc->Visible) { // designation_desc ?>
	<?php if ($designation_list->SortUrl($designation_list->designation_desc) == "") { ?>
		<th data-name="designation_desc" class="<?php echo $designation_list->designation_desc->headerCellClass() ?>"><div id="elh_designation_designation_desc" class="designation_designation_desc"><div class="ew-table-header-caption"><?php echo $designation_list->designation_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="designation_desc" class="<?php echo $designation_list->designation_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $designation_list->SortUrl($designation_list->designation_desc) ?>', 1);"><div id="elh_designation_designation_desc" class="designation_designation_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $designation_list->designation_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($designation_list->designation_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($designation_list->designation_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$designation_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($designation_list->ExportAll && $designation_list->isExport()) {
	$designation_list->StopRecord = $designation_list->TotalRecords;
} else {

	// Set the last record to display
	if ($designation_list->TotalRecords > $designation_list->StartRecord + $designation_list->DisplayRecords - 1)
		$designation_list->StopRecord = $designation_list->StartRecord + $designation_list->DisplayRecords - 1;
	else
		$designation_list->StopRecord = $designation_list->TotalRecords;
}
$designation_list->RecordCount = $designation_list->StartRecord - 1;
if ($designation_list->Recordset && !$designation_list->Recordset->EOF) {
	$designation_list->Recordset->moveFirst();
	$selectLimit = $designation_list->UseSelectLimit;
	if (!$selectLimit && $designation_list->StartRecord > 1)
		$designation_list->Recordset->move($designation_list->StartRecord - 1);
} elseif (!$designation->AllowAddDeleteRow && $designation_list->StopRecord == 0) {
	$designation_list->StopRecord = $designation->GridAddRowCount;
}

// Initialize aggregate
$designation->RowType = ROWTYPE_AGGREGATEINIT;
$designation->resetAttributes();
$designation_list->renderRow();
while ($designation_list->RecordCount < $designation_list->StopRecord) {
	$designation_list->RecordCount++;
	if ($designation_list->RecordCount >= $designation_list->StartRecord) {
		$designation_list->RowCount++;

		// Set up key count
		$designation_list->KeyCount = $designation_list->RowIndex;

		// Init row class and style
		$designation->resetAttributes();
		$designation->CssClass = "";
		if ($designation_list->isGridAdd()) {
		} else {
			$designation_list->loadRowValues($designation_list->Recordset); // Load row values
		}
		$designation->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$designation->RowAttrs->merge(["data-rowindex" => $designation_list->RowCount, "id" => "r" . $designation_list->RowCount . "_designation", "data-rowtype" => $designation->RowType]);

		// Render row
		$designation_list->renderRow();

		// Render list options
		$designation_list->renderListOptions();
?>
	<tr <?php echo $designation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$designation_list->ListOptions->render("body", "left", $designation_list->RowCount);
?>
	<?php if ($designation_list->designation_id->Visible) { // designation_id ?>
		<td data-name="designation_id" <?php echo $designation_list->designation_id->cellAttributes() ?>>
<span id="el<?php echo $designation_list->RowCount ?>_designation_designation_id">
<span<?php echo $designation_list->designation_id->viewAttributes() ?>><?php echo $designation_list->designation_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($designation_list->designation_caption->Visible) { // designation_caption ?>
		<td data-name="designation_caption" <?php echo $designation_list->designation_caption->cellAttributes() ?>>
<span id="el<?php echo $designation_list->RowCount ?>_designation_designation_caption">
<span<?php echo $designation_list->designation_caption->viewAttributes() ?>><?php echo $designation_list->designation_caption->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($designation_list->designation_desc->Visible) { // designation_desc ?>
		<td data-name="designation_desc" <?php echo $designation_list->designation_desc->cellAttributes() ?>>
<span id="el<?php echo $designation_list->RowCount ?>_designation_designation_desc">
<span<?php echo $designation_list->designation_desc->viewAttributes() ?>><?php echo $designation_list->designation_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$designation_list->ListOptions->render("body", "right", $designation_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$designation_list->isGridAdd())
		$designation_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$designation->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($designation_list->Recordset)
	$designation_list->Recordset->Close();
?>
<?php if (!$designation_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$designation_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $designation_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $designation_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($designation_list->TotalRecords == 0 && !$designation->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $designation_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$designation_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$designation_list->isExport()) { ?>
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
$designation_list->terminate();
?>