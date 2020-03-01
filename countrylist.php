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
$country_list = new country_list();

// Run the page
$country_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$country_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$country_list->isExport()) { ?>
<script>
var fcountrylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcountrylist = currentForm = new ew.Form("fcountrylist", "list");
	fcountrylist.formKeyCountName = '<?php echo $country_list->FormKeyCountName ?>';
	loadjs.done("fcountrylist");
});
var fcountrylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcountrylistsrch = currentSearchForm = new ew.Form("fcountrylistsrch");

	// Dynamic selection lists
	// Filters

	fcountrylistsrch.filterList = <?php echo $country_list->getFilterList() ?>;
	loadjs.done("fcountrylistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$country_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($country_list->TotalRecords > 0 && $country_list->ExportOptions->visible()) { ?>
<?php $country_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($country_list->ImportOptions->visible()) { ?>
<?php $country_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($country_list->SearchOptions->visible()) { ?>
<?php $country_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($country_list->FilterOptions->visible()) { ?>
<?php $country_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$country_list->renderOtherOptions();
?>
<?php if (!$country_list->isExport() && !$country->CurrentAction) { ?>
<form name="fcountrylistsrch" id="fcountrylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcountrylistsrch-search-panel" class="<?php echo $country_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="country">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $country_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($country_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($country_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $country_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($country_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($country_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($country_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($country_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $country_list->showPageHeader(); ?>
<?php
$country_list->showMessage();
?>
<?php if ($country_list->TotalRecords > 0 || $country->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($country_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> country">
<form name="fcountrylist" id="fcountrylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="country">
<div id="gmp_country" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($country_list->TotalRecords > 0 || $country_list->isGridEdit()) { ?>
<table id="tbl_countrylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$country->RowType = ROWTYPE_HEADER;

// Render list options
$country_list->renderListOptions();

// Render list options (header, left)
$country_list->ListOptions->render("header", "left");
?>
<?php if ($country_list->country_id->Visible) { // country_id ?>
	<?php if ($country_list->SortUrl($country_list->country_id) == "") { ?>
		<th data-name="country_id" class="<?php echo $country_list->country_id->headerCellClass() ?>"><div id="elh_country_country_id" class="country_country_id"><div class="ew-table-header-caption"><?php echo $country_list->country_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="country_id" class="<?php echo $country_list->country_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $country_list->SortUrl($country_list->country_id) ?>', 1);"><div id="elh_country_country_id" class="country_country_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $country_list->country_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($country_list->country_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($country_list->country_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($country_list->country_name->Visible) { // country_name ?>
	<?php if ($country_list->SortUrl($country_list->country_name) == "") { ?>
		<th data-name="country_name" class="<?php echo $country_list->country_name->headerCellClass() ?>"><div id="elh_country_country_name" class="country_country_name"><div class="ew-table-header-caption"><?php echo $country_list->country_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="country_name" class="<?php echo $country_list->country_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $country_list->SortUrl($country_list->country_name) ?>', 1);"><div id="elh_country_country_name" class="country_country_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $country_list->country_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($country_list->country_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($country_list->country_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$country_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($country_list->ExportAll && $country_list->isExport()) {
	$country_list->StopRecord = $country_list->TotalRecords;
} else {

	// Set the last record to display
	if ($country_list->TotalRecords > $country_list->StartRecord + $country_list->DisplayRecords - 1)
		$country_list->StopRecord = $country_list->StartRecord + $country_list->DisplayRecords - 1;
	else
		$country_list->StopRecord = $country_list->TotalRecords;
}
$country_list->RecordCount = $country_list->StartRecord - 1;
if ($country_list->Recordset && !$country_list->Recordset->EOF) {
	$country_list->Recordset->moveFirst();
	$selectLimit = $country_list->UseSelectLimit;
	if (!$selectLimit && $country_list->StartRecord > 1)
		$country_list->Recordset->move($country_list->StartRecord - 1);
} elseif (!$country->AllowAddDeleteRow && $country_list->StopRecord == 0) {
	$country_list->StopRecord = $country->GridAddRowCount;
}

// Initialize aggregate
$country->RowType = ROWTYPE_AGGREGATEINIT;
$country->resetAttributes();
$country_list->renderRow();
while ($country_list->RecordCount < $country_list->StopRecord) {
	$country_list->RecordCount++;
	if ($country_list->RecordCount >= $country_list->StartRecord) {
		$country_list->RowCount++;

		// Set up key count
		$country_list->KeyCount = $country_list->RowIndex;

		// Init row class and style
		$country->resetAttributes();
		$country->CssClass = "";
		if ($country_list->isGridAdd()) {
		} else {
			$country_list->loadRowValues($country_list->Recordset); // Load row values
		}
		$country->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$country->RowAttrs->merge(["data-rowindex" => $country_list->RowCount, "id" => "r" . $country_list->RowCount . "_country", "data-rowtype" => $country->RowType]);

		// Render row
		$country_list->renderRow();

		// Render list options
		$country_list->renderListOptions();
?>
	<tr <?php echo $country->rowAttributes() ?>>
<?php

// Render list options (body, left)
$country_list->ListOptions->render("body", "left", $country_list->RowCount);
?>
	<?php if ($country_list->country_id->Visible) { // country_id ?>
		<td data-name="country_id" <?php echo $country_list->country_id->cellAttributes() ?>>
<span id="el<?php echo $country_list->RowCount ?>_country_country_id">
<span<?php echo $country_list->country_id->viewAttributes() ?>><?php echo $country_list->country_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($country_list->country_name->Visible) { // country_name ?>
		<td data-name="country_name" <?php echo $country_list->country_name->cellAttributes() ?>>
<span id="el<?php echo $country_list->RowCount ?>_country_country_name">
<span<?php echo $country_list->country_name->viewAttributes() ?>><?php echo $country_list->country_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$country_list->ListOptions->render("body", "right", $country_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$country_list->isGridAdd())
		$country_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$country->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($country_list->Recordset)
	$country_list->Recordset->Close();
?>
<?php if (!$country_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$country_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $country_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $country_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($country_list->TotalRecords == 0 && !$country->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $country_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$country_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$country_list->isExport()) { ?>
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
$country_list->terminate();
?>