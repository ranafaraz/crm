<?php
namespace PHPMaker2020\dexdevs_crm;

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
$tehsil_list = new tehsil_list();

// Run the page
$tehsil_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tehsil_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tehsil_list->isExport()) { ?>
<script>
var ftehsillist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftehsillist = currentForm = new ew.Form("ftehsillist", "list");
	ftehsillist.formKeyCountName = '<?php echo $tehsil_list->FormKeyCountName ?>';
	loadjs.done("ftehsillist");
});
var ftehsillistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftehsillistsrch = currentSearchForm = new ew.Form("ftehsillistsrch");

	// Dynamic selection lists
	// Filters

	ftehsillistsrch.filterList = <?php echo $tehsil_list->getFilterList() ?>;
	loadjs.done("ftehsillistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tehsil_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tehsil_list->TotalRecords > 0 && $tehsil_list->ExportOptions->visible()) { ?>
<?php $tehsil_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tehsil_list->ImportOptions->visible()) { ?>
<?php $tehsil_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tehsil_list->SearchOptions->visible()) { ?>
<?php $tehsil_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tehsil_list->FilterOptions->visible()) { ?>
<?php $tehsil_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tehsil_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tehsil_list->isExport() && !$tehsil->CurrentAction) { ?>
<form name="ftehsillistsrch" id="ftehsillistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftehsillistsrch-search-panel" class="<?php echo $tehsil_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tehsil">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tehsil_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tehsil_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tehsil_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tehsil_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tehsil_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tehsil_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tehsil_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tehsil_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tehsil_list->showPageHeader(); ?>
<?php
$tehsil_list->showMessage();
?>
<?php if ($tehsil_list->TotalRecords > 0 || $tehsil->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$tehsil_list->isExport()) { ?>
<div>
<?php if (!$tehsil_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tehsil_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tehsil_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftehsillist" id="ftehsillist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tehsil">
<div class="row ew-multi-column-row">
<?php if ($tehsil_list->TotalRecords > 0 || $tehsil_list->isGridEdit()) { ?>
<?php
if ($tehsil_list->ExportAll && $tehsil_list->isExport()) {
	$tehsil_list->StopRecord = $tehsil_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tehsil_list->TotalRecords > $tehsil_list->StartRecord + $tehsil_list->DisplayRecords - 1)
		$tehsil_list->StopRecord = $tehsil_list->StartRecord + $tehsil_list->DisplayRecords - 1;
	else
		$tehsil_list->StopRecord = $tehsil_list->TotalRecords;
}
$tehsil_list->RecordCount = $tehsil_list->StartRecord - 1;
if ($tehsil_list->Recordset && !$tehsil_list->Recordset->EOF) {
	$tehsil_list->Recordset->moveFirst();
	$selectLimit = $tehsil_list->UseSelectLimit;
	if (!$selectLimit && $tehsil_list->StartRecord > 1)
		$tehsil_list->Recordset->move($tehsil_list->StartRecord - 1);
} elseif (!$tehsil->AllowAddDeleteRow && $tehsil_list->StopRecord == 0) {
	$tehsil_list->StopRecord = $tehsil->GridAddRowCount;
}
while ($tehsil_list->RecordCount < $tehsil_list->StopRecord) {
	$tehsil_list->RecordCount++;
	if ($tehsil_list->RecordCount >= $tehsil_list->StartRecord) {
		$tehsil_list->RowCount++;

		// Set up key count
		$tehsil_list->KeyCount = $tehsil_list->RowIndex;

		// Init row class and style
		$tehsil->resetAttributes();
		$tehsil->CssClass = "";
		if ($tehsil_list->isGridAdd()) {
		} else {
			$tehsil_list->loadRowValues($tehsil_list->Recordset); // Load row values
		}
		$tehsil->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tehsil->RowAttrs->merge(["data-rowindex" => $tehsil_list->RowCount, "id" => "r" . $tehsil_list->RowCount . "_tehsil", "data-rowtype" => $tehsil->RowType]);

		// Render row
		$tehsil_list->renderRow();

		// Render list options
		$tehsil_list->renderListOptions();
?>
<div class="<?php echo $tehsil_list->getMultiColumnClass() ?>" <?php echo $tehsil->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($tehsil->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($tehsil_list->tehsil_id->Visible) { // tehsil_id ?>
		<?php if ($tehsil->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $tehsil_list->TableLeftColumnClass ?>"><span class="tehsil_tehsil_id">
<?php if ($tehsil_list->isExport() || $tehsil_list->SortUrl($tehsil_list->tehsil_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $tehsil_list->tehsil_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tehsil_list->SortUrl($tehsil_list->tehsil_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tehsil_list->tehsil_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tehsil_list->tehsil_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tehsil_list->tehsil_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $tehsil_list->tehsil_id->cellAttributes() ?>>
<span id="el<?php echo $tehsil_list->RowCount ?>_tehsil_tehsil_id">
<span<?php echo $tehsil_list->tehsil_id->viewAttributes() ?>><?php echo $tehsil_list->tehsil_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row tehsil_tehsil_id">
			<label class="<?php echo $tehsil_list->LeftColumnClass ?>"><?php echo $tehsil_list->tehsil_id->caption() ?></label>
			<div class="<?php echo $tehsil_list->RightColumnClass ?>"><div <?php echo $tehsil_list->tehsil_id->cellAttributes() ?>>
<span id="el<?php echo $tehsil_list->RowCount ?>_tehsil_tehsil_id">
<span<?php echo $tehsil_list->tehsil_id->viewAttributes() ?>><?php echo $tehsil_list->tehsil_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($tehsil_list->tehsil_district_id->Visible) { // tehsil_district_id ?>
		<?php if ($tehsil->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $tehsil_list->TableLeftColumnClass ?>"><span class="tehsil_tehsil_district_id">
<?php if ($tehsil_list->isExport() || $tehsil_list->SortUrl($tehsil_list->tehsil_district_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $tehsil_list->tehsil_district_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tehsil_list->SortUrl($tehsil_list->tehsil_district_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tehsil_list->tehsil_district_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tehsil_list->tehsil_district_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tehsil_list->tehsil_district_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $tehsil_list->tehsil_district_id->cellAttributes() ?>>
<span id="el<?php echo $tehsil_list->RowCount ?>_tehsil_tehsil_district_id">
<span<?php echo $tehsil_list->tehsil_district_id->viewAttributes() ?>><?php echo $tehsil_list->tehsil_district_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row tehsil_tehsil_district_id">
			<label class="<?php echo $tehsil_list->LeftColumnClass ?>"><?php echo $tehsil_list->tehsil_district_id->caption() ?></label>
			<div class="<?php echo $tehsil_list->RightColumnClass ?>"><div <?php echo $tehsil_list->tehsil_district_id->cellAttributes() ?>>
<span id="el<?php echo $tehsil_list->RowCount ?>_tehsil_tehsil_district_id">
<span<?php echo $tehsil_list->tehsil_district_id->viewAttributes() ?>><?php echo $tehsil_list->tehsil_district_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($tehsil_list->tehsil_name->Visible) { // tehsil_name ?>
		<?php if ($tehsil->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $tehsil_list->TableLeftColumnClass ?>"><span class="tehsil_tehsil_name">
<?php if ($tehsil_list->isExport() || $tehsil_list->SortUrl($tehsil_list->tehsil_name) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $tehsil_list->tehsil_name->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tehsil_list->SortUrl($tehsil_list->tehsil_name) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tehsil_list->tehsil_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tehsil_list->tehsil_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tehsil_list->tehsil_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $tehsil_list->tehsil_name->cellAttributes() ?>>
<span id="el<?php echo $tehsil_list->RowCount ?>_tehsil_tehsil_name">
<span<?php echo $tehsil_list->tehsil_name->viewAttributes() ?>><?php echo $tehsil_list->tehsil_name->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row tehsil_tehsil_name">
			<label class="<?php echo $tehsil_list->LeftColumnClass ?>"><?php echo $tehsil_list->tehsil_name->caption() ?></label>
			<div class="<?php echo $tehsil_list->RightColumnClass ?>"><div <?php echo $tehsil_list->tehsil_name->cellAttributes() ?>>
<span id="el<?php echo $tehsil_list->RowCount ?>_tehsil_tehsil_name">
<span<?php echo $tehsil_list->tehsil_name->viewAttributes() ?>><?php echo $tehsil_list->tehsil_name->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($tehsil->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$tehsil_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$tehsil_list->ListOptions->render("body", "bottom", $tehsil_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$tehsil_list->isGridAdd())
		$tehsil_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$tehsil->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tehsil_list->Recordset)
	$tehsil_list->Recordset->Close();
?>
<?php if (!$tehsil_list->isExport()) { ?>
<div>
<?php if (!$tehsil_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tehsil_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tehsil_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($tehsil_list->TotalRecords == 0 && !$tehsil->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tehsil_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tehsil_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tehsil_list->isExport()) { ?>
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
$tehsil_list->terminate();
?>