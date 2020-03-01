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
$acc_nature_list = new acc_nature_list();

// Run the page
$acc_nature_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acc_nature_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$acc_nature_list->isExport()) { ?>
<script>
var facc_naturelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	facc_naturelist = currentForm = new ew.Form("facc_naturelist", "list");
	facc_naturelist.formKeyCountName = '<?php echo $acc_nature_list->FormKeyCountName ?>';
	loadjs.done("facc_naturelist");
});
var facc_naturelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	facc_naturelistsrch = currentSearchForm = new ew.Form("facc_naturelistsrch");

	// Dynamic selection lists
	// Filters

	facc_naturelistsrch.filterList = <?php echo $acc_nature_list->getFilterList() ?>;
	loadjs.done("facc_naturelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$acc_nature_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($acc_nature_list->TotalRecords > 0 && $acc_nature_list->ExportOptions->visible()) { ?>
<?php $acc_nature_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($acc_nature_list->ImportOptions->visible()) { ?>
<?php $acc_nature_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($acc_nature_list->SearchOptions->visible()) { ?>
<?php $acc_nature_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($acc_nature_list->FilterOptions->visible()) { ?>
<?php $acc_nature_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$acc_nature_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$acc_nature_list->isExport() && !$acc_nature->CurrentAction) { ?>
<form name="facc_naturelistsrch" id="facc_naturelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="facc_naturelistsrch-search-panel" class="<?php echo $acc_nature_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="acc_nature">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $acc_nature_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($acc_nature_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($acc_nature_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $acc_nature_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($acc_nature_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($acc_nature_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($acc_nature_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($acc_nature_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $acc_nature_list->showPageHeader(); ?>
<?php
$acc_nature_list->showMessage();
?>
<?php if ($acc_nature_list->TotalRecords > 0 || $acc_nature->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($acc_nature_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> acc_nature">
<?php if (!$acc_nature_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$acc_nature_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acc_nature_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $acc_nature_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="facc_naturelist" id="facc_naturelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acc_nature">
<div id="gmp_acc_nature" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($acc_nature_list->TotalRecords > 0 || $acc_nature_list->isGridEdit()) { ?>
<table id="tbl_acc_naturelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$acc_nature->RowType = ROWTYPE_HEADER;

// Render list options
$acc_nature_list->renderListOptions();

// Render list options (header, left)
$acc_nature_list->ListOptions->render("header", "left");
?>
<?php if ($acc_nature_list->acc_nature_id->Visible) { // acc_nature_id ?>
	<?php if ($acc_nature_list->SortUrl($acc_nature_list->acc_nature_id) == "") { ?>
		<th data-name="acc_nature_id" class="<?php echo $acc_nature_list->acc_nature_id->headerCellClass() ?>"><div id="elh_acc_nature_acc_nature_id" class="acc_nature_acc_nature_id"><div class="ew-table-header-caption"><?php echo $acc_nature_list->acc_nature_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="acc_nature_id" class="<?php echo $acc_nature_list->acc_nature_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acc_nature_list->SortUrl($acc_nature_list->acc_nature_id) ?>', 1);"><div id="elh_acc_nature_acc_nature_id" class="acc_nature_acc_nature_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acc_nature_list->acc_nature_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($acc_nature_list->acc_nature_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acc_nature_list->acc_nature_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($acc_nature_list->acc_nature_name->Visible) { // acc_nature_name ?>
	<?php if ($acc_nature_list->SortUrl($acc_nature_list->acc_nature_name) == "") { ?>
		<th data-name="acc_nature_name" class="<?php echo $acc_nature_list->acc_nature_name->headerCellClass() ?>"><div id="elh_acc_nature_acc_nature_name" class="acc_nature_acc_nature_name"><div class="ew-table-header-caption"><?php echo $acc_nature_list->acc_nature_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="acc_nature_name" class="<?php echo $acc_nature_list->acc_nature_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acc_nature_list->SortUrl($acc_nature_list->acc_nature_name) ?>', 1);"><div id="elh_acc_nature_acc_nature_name" class="acc_nature_acc_nature_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acc_nature_list->acc_nature_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($acc_nature_list->acc_nature_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acc_nature_list->acc_nature_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$acc_nature_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($acc_nature_list->ExportAll && $acc_nature_list->isExport()) {
	$acc_nature_list->StopRecord = $acc_nature_list->TotalRecords;
} else {

	// Set the last record to display
	if ($acc_nature_list->TotalRecords > $acc_nature_list->StartRecord + $acc_nature_list->DisplayRecords - 1)
		$acc_nature_list->StopRecord = $acc_nature_list->StartRecord + $acc_nature_list->DisplayRecords - 1;
	else
		$acc_nature_list->StopRecord = $acc_nature_list->TotalRecords;
}
$acc_nature_list->RecordCount = $acc_nature_list->StartRecord - 1;
if ($acc_nature_list->Recordset && !$acc_nature_list->Recordset->EOF) {
	$acc_nature_list->Recordset->moveFirst();
	$selectLimit = $acc_nature_list->UseSelectLimit;
	if (!$selectLimit && $acc_nature_list->StartRecord > 1)
		$acc_nature_list->Recordset->move($acc_nature_list->StartRecord - 1);
} elseif (!$acc_nature->AllowAddDeleteRow && $acc_nature_list->StopRecord == 0) {
	$acc_nature_list->StopRecord = $acc_nature->GridAddRowCount;
}

// Initialize aggregate
$acc_nature->RowType = ROWTYPE_AGGREGATEINIT;
$acc_nature->resetAttributes();
$acc_nature_list->renderRow();
while ($acc_nature_list->RecordCount < $acc_nature_list->StopRecord) {
	$acc_nature_list->RecordCount++;
	if ($acc_nature_list->RecordCount >= $acc_nature_list->StartRecord) {
		$acc_nature_list->RowCount++;

		// Set up key count
		$acc_nature_list->KeyCount = $acc_nature_list->RowIndex;

		// Init row class and style
		$acc_nature->resetAttributes();
		$acc_nature->CssClass = "";
		if ($acc_nature_list->isGridAdd()) {
		} else {
			$acc_nature_list->loadRowValues($acc_nature_list->Recordset); // Load row values
		}
		$acc_nature->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$acc_nature->RowAttrs->merge(["data-rowindex" => $acc_nature_list->RowCount, "id" => "r" . $acc_nature_list->RowCount . "_acc_nature", "data-rowtype" => $acc_nature->RowType]);

		// Render row
		$acc_nature_list->renderRow();

		// Render list options
		$acc_nature_list->renderListOptions();
?>
	<tr <?php echo $acc_nature->rowAttributes() ?>>
<?php

// Render list options (body, left)
$acc_nature_list->ListOptions->render("body", "left", $acc_nature_list->RowCount);
?>
	<?php if ($acc_nature_list->acc_nature_id->Visible) { // acc_nature_id ?>
		<td data-name="acc_nature_id" <?php echo $acc_nature_list->acc_nature_id->cellAttributes() ?>>
<span id="el<?php echo $acc_nature_list->RowCount ?>_acc_nature_acc_nature_id">
<span<?php echo $acc_nature_list->acc_nature_id->viewAttributes() ?>><?php echo $acc_nature_list->acc_nature_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($acc_nature_list->acc_nature_name->Visible) { // acc_nature_name ?>
		<td data-name="acc_nature_name" <?php echo $acc_nature_list->acc_nature_name->cellAttributes() ?>>
<span id="el<?php echo $acc_nature_list->RowCount ?>_acc_nature_acc_nature_name">
<span<?php echo $acc_nature_list->acc_nature_name->viewAttributes() ?>><?php echo $acc_nature_list->acc_nature_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$acc_nature_list->ListOptions->render("body", "right", $acc_nature_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$acc_nature_list->isGridAdd())
		$acc_nature_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$acc_nature->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($acc_nature_list->Recordset)
	$acc_nature_list->Recordset->Close();
?>
<?php if (!$acc_nature_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$acc_nature_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acc_nature_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $acc_nature_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($acc_nature_list->TotalRecords == 0 && !$acc_nature->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $acc_nature_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$acc_nature_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$acc_nature_list->isExport()) { ?>
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
$acc_nature_list->terminate();
?>