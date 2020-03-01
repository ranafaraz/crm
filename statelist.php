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
$state_list = new state_list();

// Run the page
$state_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$state_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$state_list->isExport()) { ?>
<script>
var fstatelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fstatelist = currentForm = new ew.Form("fstatelist", "list");
	fstatelist.formKeyCountName = '<?php echo $state_list->FormKeyCountName ?>';
	loadjs.done("fstatelist");
});
var fstatelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fstatelistsrch = currentSearchForm = new ew.Form("fstatelistsrch");

	// Dynamic selection lists
	// Filters

	fstatelistsrch.filterList = <?php echo $state_list->getFilterList() ?>;
	loadjs.done("fstatelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$state_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($state_list->TotalRecords > 0 && $state_list->ExportOptions->visible()) { ?>
<?php $state_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($state_list->ImportOptions->visible()) { ?>
<?php $state_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($state_list->SearchOptions->visible()) { ?>
<?php $state_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($state_list->FilterOptions->visible()) { ?>
<?php $state_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$state_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$state_list->isExport() && !$state->CurrentAction) { ?>
<form name="fstatelistsrch" id="fstatelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fstatelistsrch-search-panel" class="<?php echo $state_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="state">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $state_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($state_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($state_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $state_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($state_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($state_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($state_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($state_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $state_list->showPageHeader(); ?>
<?php
$state_list->showMessage();
?>
<?php if ($state_list->TotalRecords > 0 || $state->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($state_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> state">
<?php if (!$state_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$state_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $state_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $state_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fstatelist" id="fstatelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="state">
<div id="gmp_state" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($state_list->TotalRecords > 0 || $state_list->isGridEdit()) { ?>
<table id="tbl_statelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$state->RowType = ROWTYPE_HEADER;

// Render list options
$state_list->renderListOptions();

// Render list options (header, left)
$state_list->ListOptions->render("header", "left");
?>
<?php if ($state_list->state_id->Visible) { // state_id ?>
	<?php if ($state_list->SortUrl($state_list->state_id) == "") { ?>
		<th data-name="state_id" class="<?php echo $state_list->state_id->headerCellClass() ?>"><div id="elh_state_state_id" class="state_state_id"><div class="ew-table-header-caption"><?php echo $state_list->state_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="state_id" class="<?php echo $state_list->state_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $state_list->SortUrl($state_list->state_id) ?>', 1);"><div id="elh_state_state_id" class="state_state_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $state_list->state_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($state_list->state_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($state_list->state_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($state_list->state_country_id->Visible) { // state_country_id ?>
	<?php if ($state_list->SortUrl($state_list->state_country_id) == "") { ?>
		<th data-name="state_country_id" class="<?php echo $state_list->state_country_id->headerCellClass() ?>"><div id="elh_state_state_country_id" class="state_state_country_id"><div class="ew-table-header-caption"><?php echo $state_list->state_country_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="state_country_id" class="<?php echo $state_list->state_country_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $state_list->SortUrl($state_list->state_country_id) ?>', 1);"><div id="elh_state_state_country_id" class="state_state_country_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $state_list->state_country_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($state_list->state_country_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($state_list->state_country_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($state_list->state_name->Visible) { // state_name ?>
	<?php if ($state_list->SortUrl($state_list->state_name) == "") { ?>
		<th data-name="state_name" class="<?php echo $state_list->state_name->headerCellClass() ?>"><div id="elh_state_state_name" class="state_state_name"><div class="ew-table-header-caption"><?php echo $state_list->state_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="state_name" class="<?php echo $state_list->state_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $state_list->SortUrl($state_list->state_name) ?>', 1);"><div id="elh_state_state_name" class="state_state_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $state_list->state_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($state_list->state_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($state_list->state_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$state_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($state_list->ExportAll && $state_list->isExport()) {
	$state_list->StopRecord = $state_list->TotalRecords;
} else {

	// Set the last record to display
	if ($state_list->TotalRecords > $state_list->StartRecord + $state_list->DisplayRecords - 1)
		$state_list->StopRecord = $state_list->StartRecord + $state_list->DisplayRecords - 1;
	else
		$state_list->StopRecord = $state_list->TotalRecords;
}
$state_list->RecordCount = $state_list->StartRecord - 1;
if ($state_list->Recordset && !$state_list->Recordset->EOF) {
	$state_list->Recordset->moveFirst();
	$selectLimit = $state_list->UseSelectLimit;
	if (!$selectLimit && $state_list->StartRecord > 1)
		$state_list->Recordset->move($state_list->StartRecord - 1);
} elseif (!$state->AllowAddDeleteRow && $state_list->StopRecord == 0) {
	$state_list->StopRecord = $state->GridAddRowCount;
}

// Initialize aggregate
$state->RowType = ROWTYPE_AGGREGATEINIT;
$state->resetAttributes();
$state_list->renderRow();
while ($state_list->RecordCount < $state_list->StopRecord) {
	$state_list->RecordCount++;
	if ($state_list->RecordCount >= $state_list->StartRecord) {
		$state_list->RowCount++;

		// Set up key count
		$state_list->KeyCount = $state_list->RowIndex;

		// Init row class and style
		$state->resetAttributes();
		$state->CssClass = "";
		if ($state_list->isGridAdd()) {
		} else {
			$state_list->loadRowValues($state_list->Recordset); // Load row values
		}
		$state->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$state->RowAttrs->merge(["data-rowindex" => $state_list->RowCount, "id" => "r" . $state_list->RowCount . "_state", "data-rowtype" => $state->RowType]);

		// Render row
		$state_list->renderRow();

		// Render list options
		$state_list->renderListOptions();
?>
	<tr <?php echo $state->rowAttributes() ?>>
<?php

// Render list options (body, left)
$state_list->ListOptions->render("body", "left", $state_list->RowCount);
?>
	<?php if ($state_list->state_id->Visible) { // state_id ?>
		<td data-name="state_id" <?php echo $state_list->state_id->cellAttributes() ?>>
<span id="el<?php echo $state_list->RowCount ?>_state_state_id">
<span<?php echo $state_list->state_id->viewAttributes() ?>><?php echo $state_list->state_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($state_list->state_country_id->Visible) { // state_country_id ?>
		<td data-name="state_country_id" <?php echo $state_list->state_country_id->cellAttributes() ?>>
<span id="el<?php echo $state_list->RowCount ?>_state_state_country_id">
<span<?php echo $state_list->state_country_id->viewAttributes() ?>><?php echo $state_list->state_country_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($state_list->state_name->Visible) { // state_name ?>
		<td data-name="state_name" <?php echo $state_list->state_name->cellAttributes() ?>>
<span id="el<?php echo $state_list->RowCount ?>_state_state_name">
<span<?php echo $state_list->state_name->viewAttributes() ?>><?php echo $state_list->state_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$state_list->ListOptions->render("body", "right", $state_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$state_list->isGridAdd())
		$state_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$state->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($state_list->Recordset)
	$state_list->Recordset->Close();
?>
<?php if (!$state_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$state_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $state_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $state_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($state_list->TotalRecords == 0 && !$state->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $state_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$state_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$state_list->isExport()) { ?>
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
$state_list->terminate();
?>