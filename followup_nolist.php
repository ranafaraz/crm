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
$followup_no_list = new followup_no_list();

// Run the page
$followup_no_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$followup_no_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$followup_no_list->isExport()) { ?>
<script>
var ffollowup_nolist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ffollowup_nolist = currentForm = new ew.Form("ffollowup_nolist", "list");
	ffollowup_nolist.formKeyCountName = '<?php echo $followup_no_list->FormKeyCountName ?>';
	loadjs.done("ffollowup_nolist");
});
var ffollowup_nolistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ffollowup_nolistsrch = currentSearchForm = new ew.Form("ffollowup_nolistsrch");

	// Dynamic selection lists
	// Filters

	ffollowup_nolistsrch.filterList = <?php echo $followup_no_list->getFilterList() ?>;
	loadjs.done("ffollowup_nolistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$followup_no_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($followup_no_list->TotalRecords > 0 && $followup_no_list->ExportOptions->visible()) { ?>
<?php $followup_no_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($followup_no_list->ImportOptions->visible()) { ?>
<?php $followup_no_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($followup_no_list->SearchOptions->visible()) { ?>
<?php $followup_no_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($followup_no_list->FilterOptions->visible()) { ?>
<?php $followup_no_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$followup_no_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$followup_no_list->isExport() && !$followup_no->CurrentAction) { ?>
<form name="ffollowup_nolistsrch" id="ffollowup_nolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ffollowup_nolistsrch-search-panel" class="<?php echo $followup_no_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="followup_no">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $followup_no_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($followup_no_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($followup_no_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $followup_no_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($followup_no_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($followup_no_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($followup_no_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($followup_no_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $followup_no_list->showPageHeader(); ?>
<?php
$followup_no_list->showMessage();
?>
<?php if ($followup_no_list->TotalRecords > 0 || $followup_no->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($followup_no_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> followup_no">
<?php if (!$followup_no_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$followup_no_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $followup_no_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $followup_no_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ffollowup_nolist" id="ffollowup_nolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="followup_no">
<div id="gmp_followup_no" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($followup_no_list->TotalRecords > 0 || $followup_no_list->isGridEdit()) { ?>
<table id="tbl_followup_nolist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$followup_no->RowType = ROWTYPE_HEADER;

// Render list options
$followup_no_list->renderListOptions();

// Render list options (header, left)
$followup_no_list->ListOptions->render("header", "left");
?>
<?php if ($followup_no_list->followup_no_id->Visible) { // followup_no_id ?>
	<?php if ($followup_no_list->SortUrl($followup_no_list->followup_no_id) == "") { ?>
		<th data-name="followup_no_id" class="<?php echo $followup_no_list->followup_no_id->headerCellClass() ?>"><div id="elh_followup_no_followup_no_id" class="followup_no_followup_no_id"><div class="ew-table-header-caption"><?php echo $followup_no_list->followup_no_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="followup_no_id" class="<?php echo $followup_no_list->followup_no_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_no_list->SortUrl($followup_no_list->followup_no_id) ?>', 1);"><div id="elh_followup_no_followup_no_id" class="followup_no_followup_no_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_no_list->followup_no_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_no_list->followup_no_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_no_list->followup_no_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($followup_no_list->followup_no_caption->Visible) { // followup_no_caption ?>
	<?php if ($followup_no_list->SortUrl($followup_no_list->followup_no_caption) == "") { ?>
		<th data-name="followup_no_caption" class="<?php echo $followup_no_list->followup_no_caption->headerCellClass() ?>"><div id="elh_followup_no_followup_no_caption" class="followup_no_followup_no_caption"><div class="ew-table-header-caption"><?php echo $followup_no_list->followup_no_caption->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="followup_no_caption" class="<?php echo $followup_no_list->followup_no_caption->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_no_list->SortUrl($followup_no_list->followup_no_caption) ?>', 1);"><div id="elh_followup_no_followup_no_caption" class="followup_no_followup_no_caption">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_no_list->followup_no_caption->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($followup_no_list->followup_no_caption->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_no_list->followup_no_caption->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$followup_no_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($followup_no_list->ExportAll && $followup_no_list->isExport()) {
	$followup_no_list->StopRecord = $followup_no_list->TotalRecords;
} else {

	// Set the last record to display
	if ($followup_no_list->TotalRecords > $followup_no_list->StartRecord + $followup_no_list->DisplayRecords - 1)
		$followup_no_list->StopRecord = $followup_no_list->StartRecord + $followup_no_list->DisplayRecords - 1;
	else
		$followup_no_list->StopRecord = $followup_no_list->TotalRecords;
}
$followup_no_list->RecordCount = $followup_no_list->StartRecord - 1;
if ($followup_no_list->Recordset && !$followup_no_list->Recordset->EOF) {
	$followup_no_list->Recordset->moveFirst();
	$selectLimit = $followup_no_list->UseSelectLimit;
	if (!$selectLimit && $followup_no_list->StartRecord > 1)
		$followup_no_list->Recordset->move($followup_no_list->StartRecord - 1);
} elseif (!$followup_no->AllowAddDeleteRow && $followup_no_list->StopRecord == 0) {
	$followup_no_list->StopRecord = $followup_no->GridAddRowCount;
}

// Initialize aggregate
$followup_no->RowType = ROWTYPE_AGGREGATEINIT;
$followup_no->resetAttributes();
$followup_no_list->renderRow();
while ($followup_no_list->RecordCount < $followup_no_list->StopRecord) {
	$followup_no_list->RecordCount++;
	if ($followup_no_list->RecordCount >= $followup_no_list->StartRecord) {
		$followup_no_list->RowCount++;

		// Set up key count
		$followup_no_list->KeyCount = $followup_no_list->RowIndex;

		// Init row class and style
		$followup_no->resetAttributes();
		$followup_no->CssClass = "";
		if ($followup_no_list->isGridAdd()) {
		} else {
			$followup_no_list->loadRowValues($followup_no_list->Recordset); // Load row values
		}
		$followup_no->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$followup_no->RowAttrs->merge(["data-rowindex" => $followup_no_list->RowCount, "id" => "r" . $followup_no_list->RowCount . "_followup_no", "data-rowtype" => $followup_no->RowType]);

		// Render row
		$followup_no_list->renderRow();

		// Render list options
		$followup_no_list->renderListOptions();
?>
	<tr <?php echo $followup_no->rowAttributes() ?>>
<?php

// Render list options (body, left)
$followup_no_list->ListOptions->render("body", "left", $followup_no_list->RowCount);
?>
	<?php if ($followup_no_list->followup_no_id->Visible) { // followup_no_id ?>
		<td data-name="followup_no_id" <?php echo $followup_no_list->followup_no_id->cellAttributes() ?>>
<span id="el<?php echo $followup_no_list->RowCount ?>_followup_no_followup_no_id">
<span<?php echo $followup_no_list->followup_no_id->viewAttributes() ?>><?php echo $followup_no_list->followup_no_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($followup_no_list->followup_no_caption->Visible) { // followup_no_caption ?>
		<td data-name="followup_no_caption" <?php echo $followup_no_list->followup_no_caption->cellAttributes() ?>>
<span id="el<?php echo $followup_no_list->RowCount ?>_followup_no_followup_no_caption">
<span<?php echo $followup_no_list->followup_no_caption->viewAttributes() ?>><?php echo $followup_no_list->followup_no_caption->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$followup_no_list->ListOptions->render("body", "right", $followup_no_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$followup_no_list->isGridAdd())
		$followup_no_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$followup_no->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($followup_no_list->Recordset)
	$followup_no_list->Recordset->Close();
?>
<?php if (!$followup_no_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$followup_no_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $followup_no_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $followup_no_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($followup_no_list->TotalRecords == 0 && !$followup_no->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $followup_no_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$followup_no_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$followup_no_list->isExport()) { ?>
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
$followup_no_list->terminate();
?>