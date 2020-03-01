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
$city_list = new city_list();

// Run the page
$city_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$city_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$city_list->isExport()) { ?>
<script>
var fcitylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcitylist = currentForm = new ew.Form("fcitylist", "list");
	fcitylist.formKeyCountName = '<?php echo $city_list->FormKeyCountName ?>';
	loadjs.done("fcitylist");
});
var fcitylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcitylistsrch = currentSearchForm = new ew.Form("fcitylistsrch");

	// Dynamic selection lists
	// Filters

	fcitylistsrch.filterList = <?php echo $city_list->getFilterList() ?>;
	loadjs.done("fcitylistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$city_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($city_list->TotalRecords > 0 && $city_list->ExportOptions->visible()) { ?>
<?php $city_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($city_list->ImportOptions->visible()) { ?>
<?php $city_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($city_list->SearchOptions->visible()) { ?>
<?php $city_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($city_list->FilterOptions->visible()) { ?>
<?php $city_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$city_list->renderOtherOptions();
?>
<?php if (!$city_list->isExport() && !$city->CurrentAction) { ?>
<form name="fcitylistsrch" id="fcitylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcitylistsrch-search-panel" class="<?php echo $city_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="city">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $city_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($city_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($city_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $city_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($city_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($city_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($city_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($city_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $city_list->showPageHeader(); ?>
<?php
$city_list->showMessage();
?>
<?php if ($city_list->TotalRecords > 0 || $city->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($city_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> city">
<form name="fcitylist" id="fcitylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="city">
<div id="gmp_city" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($city_list->TotalRecords > 0 || $city_list->isGridEdit()) { ?>
<table id="tbl_citylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$city->RowType = ROWTYPE_HEADER;

// Render list options
$city_list->renderListOptions();

// Render list options (header, left)
$city_list->ListOptions->render("header", "left");
?>
<?php if ($city_list->city_id->Visible) { // city_id ?>
	<?php if ($city_list->SortUrl($city_list->city_id) == "") { ?>
		<th data-name="city_id" class="<?php echo $city_list->city_id->headerCellClass() ?>"><div id="elh_city_city_id" class="city_city_id"><div class="ew-table-header-caption"><?php echo $city_list->city_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="city_id" class="<?php echo $city_list->city_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $city_list->SortUrl($city_list->city_id) ?>', 1);"><div id="elh_city_city_id" class="city_city_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $city_list->city_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($city_list->city_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($city_list->city_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($city_list->city_tehsil_id->Visible) { // city_tehsil_id ?>
	<?php if ($city_list->SortUrl($city_list->city_tehsil_id) == "") { ?>
		<th data-name="city_tehsil_id" class="<?php echo $city_list->city_tehsil_id->headerCellClass() ?>"><div id="elh_city_city_tehsil_id" class="city_city_tehsil_id"><div class="ew-table-header-caption"><?php echo $city_list->city_tehsil_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="city_tehsil_id" class="<?php echo $city_list->city_tehsil_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $city_list->SortUrl($city_list->city_tehsil_id) ?>', 1);"><div id="elh_city_city_tehsil_id" class="city_city_tehsil_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $city_list->city_tehsil_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($city_list->city_tehsil_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($city_list->city_tehsil_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($city_list->city_name->Visible) { // city_name ?>
	<?php if ($city_list->SortUrl($city_list->city_name) == "") { ?>
		<th data-name="city_name" class="<?php echo $city_list->city_name->headerCellClass() ?>"><div id="elh_city_city_name" class="city_city_name"><div class="ew-table-header-caption"><?php echo $city_list->city_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="city_name" class="<?php echo $city_list->city_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $city_list->SortUrl($city_list->city_name) ?>', 1);"><div id="elh_city_city_name" class="city_city_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $city_list->city_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($city_list->city_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($city_list->city_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$city_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($city_list->ExportAll && $city_list->isExport()) {
	$city_list->StopRecord = $city_list->TotalRecords;
} else {

	// Set the last record to display
	if ($city_list->TotalRecords > $city_list->StartRecord + $city_list->DisplayRecords - 1)
		$city_list->StopRecord = $city_list->StartRecord + $city_list->DisplayRecords - 1;
	else
		$city_list->StopRecord = $city_list->TotalRecords;
}
$city_list->RecordCount = $city_list->StartRecord - 1;
if ($city_list->Recordset && !$city_list->Recordset->EOF) {
	$city_list->Recordset->moveFirst();
	$selectLimit = $city_list->UseSelectLimit;
	if (!$selectLimit && $city_list->StartRecord > 1)
		$city_list->Recordset->move($city_list->StartRecord - 1);
} elseif (!$city->AllowAddDeleteRow && $city_list->StopRecord == 0) {
	$city_list->StopRecord = $city->GridAddRowCount;
}

// Initialize aggregate
$city->RowType = ROWTYPE_AGGREGATEINIT;
$city->resetAttributes();
$city_list->renderRow();
while ($city_list->RecordCount < $city_list->StopRecord) {
	$city_list->RecordCount++;
	if ($city_list->RecordCount >= $city_list->StartRecord) {
		$city_list->RowCount++;

		// Set up key count
		$city_list->KeyCount = $city_list->RowIndex;

		// Init row class and style
		$city->resetAttributes();
		$city->CssClass = "";
		if ($city_list->isGridAdd()) {
		} else {
			$city_list->loadRowValues($city_list->Recordset); // Load row values
		}
		$city->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$city->RowAttrs->merge(["data-rowindex" => $city_list->RowCount, "id" => "r" . $city_list->RowCount . "_city", "data-rowtype" => $city->RowType]);

		// Render row
		$city_list->renderRow();

		// Render list options
		$city_list->renderListOptions();
?>
	<tr <?php echo $city->rowAttributes() ?>>
<?php

// Render list options (body, left)
$city_list->ListOptions->render("body", "left", $city_list->RowCount);
?>
	<?php if ($city_list->city_id->Visible) { // city_id ?>
		<td data-name="city_id" <?php echo $city_list->city_id->cellAttributes() ?>>
<span id="el<?php echo $city_list->RowCount ?>_city_city_id">
<span<?php echo $city_list->city_id->viewAttributes() ?>><?php echo $city_list->city_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($city_list->city_tehsil_id->Visible) { // city_tehsil_id ?>
		<td data-name="city_tehsil_id" <?php echo $city_list->city_tehsil_id->cellAttributes() ?>>
<span id="el<?php echo $city_list->RowCount ?>_city_city_tehsil_id">
<span<?php echo $city_list->city_tehsil_id->viewAttributes() ?>><?php echo $city_list->city_tehsil_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($city_list->city_name->Visible) { // city_name ?>
		<td data-name="city_name" <?php echo $city_list->city_name->cellAttributes() ?>>
<span id="el<?php echo $city_list->RowCount ?>_city_city_name">
<span<?php echo $city_list->city_name->viewAttributes() ?>><?php echo $city_list->city_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$city_list->ListOptions->render("body", "right", $city_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$city_list->isGridAdd())
		$city_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$city->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($city_list->Recordset)
	$city_list->Recordset->Close();
?>
<?php if (!$city_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$city_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $city_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $city_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($city_list->TotalRecords == 0 && !$city->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $city_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$city_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$city_list->isExport()) { ?>
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
$city_list->terminate();
?>