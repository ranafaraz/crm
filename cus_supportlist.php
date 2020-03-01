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
$cus_support_list = new cus_support_list();

// Run the page
$cus_support_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cus_support_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cus_support_list->isExport()) { ?>
<script>
var fcus_supportlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcus_supportlist = currentForm = new ew.Form("fcus_supportlist", "list");
	fcus_supportlist.formKeyCountName = '<?php echo $cus_support_list->FormKeyCountName ?>';
	loadjs.done("fcus_supportlist");
});
var fcus_supportlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcus_supportlistsrch = currentSearchForm = new ew.Form("fcus_supportlistsrch");

	// Dynamic selection lists
	// Filters

	fcus_supportlistsrch.filterList = <?php echo $cus_support_list->getFilterList() ?>;
	loadjs.done("fcus_supportlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cus_support_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cus_support_list->TotalRecords > 0 && $cus_support_list->ExportOptions->visible()) { ?>
<?php $cus_support_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cus_support_list->ImportOptions->visible()) { ?>
<?php $cus_support_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cus_support_list->SearchOptions->visible()) { ?>
<?php $cus_support_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cus_support_list->FilterOptions->visible()) { ?>
<?php $cus_support_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cus_support_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cus_support_list->isExport() && !$cus_support->CurrentAction) { ?>
<form name="fcus_supportlistsrch" id="fcus_supportlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcus_supportlistsrch-search-panel" class="<?php echo $cus_support_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cus_support">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $cus_support_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($cus_support_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($cus_support_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cus_support_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cus_support_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cus_support_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cus_support_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cus_support_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $cus_support_list->showPageHeader(); ?>
<?php
$cus_support_list->showMessage();
?>
<?php if ($cus_support_list->TotalRecords > 0 || $cus_support->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$cus_support_list->isExport()) { ?>
<div>
<?php if (!$cus_support_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cus_support_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cus_support_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcus_supportlist" id="fcus_supportlist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cus_support">
<div class="row ew-multi-column-row">
<?php if ($cus_support_list->TotalRecords > 0 || $cus_support_list->isGridEdit()) { ?>
<?php
if ($cus_support_list->ExportAll && $cus_support_list->isExport()) {
	$cus_support_list->StopRecord = $cus_support_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cus_support_list->TotalRecords > $cus_support_list->StartRecord + $cus_support_list->DisplayRecords - 1)
		$cus_support_list->StopRecord = $cus_support_list->StartRecord + $cus_support_list->DisplayRecords - 1;
	else
		$cus_support_list->StopRecord = $cus_support_list->TotalRecords;
}
$cus_support_list->RecordCount = $cus_support_list->StartRecord - 1;
if ($cus_support_list->Recordset && !$cus_support_list->Recordset->EOF) {
	$cus_support_list->Recordset->moveFirst();
	$selectLimit = $cus_support_list->UseSelectLimit;
	if (!$selectLimit && $cus_support_list->StartRecord > 1)
		$cus_support_list->Recordset->move($cus_support_list->StartRecord - 1);
} elseif (!$cus_support->AllowAddDeleteRow && $cus_support_list->StopRecord == 0) {
	$cus_support_list->StopRecord = $cus_support->GridAddRowCount;
}
while ($cus_support_list->RecordCount < $cus_support_list->StopRecord) {
	$cus_support_list->RecordCount++;
	if ($cus_support_list->RecordCount >= $cus_support_list->StartRecord) {
		$cus_support_list->RowCount++;

		// Set up key count
		$cus_support_list->KeyCount = $cus_support_list->RowIndex;

		// Init row class and style
		$cus_support->resetAttributes();
		$cus_support->CssClass = "";
		if ($cus_support_list->isGridAdd()) {
		} else {
			$cus_support_list->loadRowValues($cus_support_list->Recordset); // Load row values
		}
		$cus_support->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cus_support->RowAttrs->merge(["data-rowindex" => $cus_support_list->RowCount, "id" => "r" . $cus_support_list->RowCount . "_cus_support", "data-rowtype" => $cus_support->RowType]);

		// Render row
		$cus_support_list->renderRow();

		// Render list options
		$cus_support_list->renderListOptions();
?>
<div class="<?php echo $cus_support_list->getMultiColumnClass() ?>" <?php echo $cus_support->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($cus_support->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($cus_support_list->cus_sup_id->Visible) { // cus_sup_id ?>
		<?php if ($cus_support->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $cus_support_list->TableLeftColumnClass ?>"><span class="cus_support_cus_sup_id">
<?php if ($cus_support_list->isExport() || $cus_support_list->SortUrl($cus_support_list->cus_sup_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cus_support_list->SortUrl($cus_support_list->cus_sup_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($cus_support_list->cus_sup_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cus_support_list->cus_sup_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $cus_support_list->cus_sup_id->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_id">
<span<?php echo $cus_support_list->cus_sup_id->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row cus_support_cus_sup_id">
			<label class="<?php echo $cus_support_list->LeftColumnClass ?>"><?php echo $cus_support_list->cus_sup_id->caption() ?></label>
			<div class="<?php echo $cus_support_list->RightColumnClass ?>"><div <?php echo $cus_support_list->cus_sup_id->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_id">
<span<?php echo $cus_support_list->cus_sup_id->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($cus_support_list->cus_sup_branch_id->Visible) { // cus_sup_branch_id ?>
		<?php if ($cus_support->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $cus_support_list->TableLeftColumnClass ?>"><span class="cus_support_cus_sup_branch_id">
<?php if ($cus_support_list->isExport() || $cus_support_list->SortUrl($cus_support_list->cus_sup_branch_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_branch_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cus_support_list->SortUrl($cus_support_list->cus_sup_branch_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($cus_support_list->cus_sup_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cus_support_list->cus_sup_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $cus_support_list->cus_sup_branch_id->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_branch_id">
<span<?php echo $cus_support_list->cus_sup_branch_id->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_branch_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row cus_support_cus_sup_branch_id">
			<label class="<?php echo $cus_support_list->LeftColumnClass ?>"><?php echo $cus_support_list->cus_sup_branch_id->caption() ?></label>
			<div class="<?php echo $cus_support_list->RightColumnClass ?>"><div <?php echo $cus_support_list->cus_sup_branch_id->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_branch_id">
<span<?php echo $cus_support_list->cus_sup_branch_id->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_branch_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($cus_support_list->cus_sup_emp_id->Visible) { // cus_sup_emp_id ?>
		<?php if ($cus_support->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $cus_support_list->TableLeftColumnClass ?>"><span class="cus_support_cus_sup_emp_id">
<?php if ($cus_support_list->isExport() || $cus_support_list->SortUrl($cus_support_list->cus_sup_emp_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_emp_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cus_support_list->SortUrl($cus_support_list->cus_sup_emp_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_emp_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($cus_support_list->cus_sup_emp_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cus_support_list->cus_sup_emp_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $cus_support_list->cus_sup_emp_id->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_emp_id">
<span<?php echo $cus_support_list->cus_sup_emp_id->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_emp_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row cus_support_cus_sup_emp_id">
			<label class="<?php echo $cus_support_list->LeftColumnClass ?>"><?php echo $cus_support_list->cus_sup_emp_id->caption() ?></label>
			<div class="<?php echo $cus_support_list->RightColumnClass ?>"><div <?php echo $cus_support_list->cus_sup_emp_id->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_emp_id">
<span<?php echo $cus_support_list->cus_sup_emp_id->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_emp_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($cus_support_list->cus_sup_query->Visible) { // cus_sup_query ?>
		<?php if ($cus_support->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $cus_support_list->TableLeftColumnClass ?>"><span class="cus_support_cus_sup_query">
<?php if ($cus_support_list->isExport() || $cus_support_list->SortUrl($cus_support_list->cus_sup_query) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_query->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cus_support_list->SortUrl($cus_support_list->cus_sup_query) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_query->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cus_support_list->cus_sup_query->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cus_support_list->cus_sup_query->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $cus_support_list->cus_sup_query->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_query">
<span<?php echo $cus_support_list->cus_sup_query->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_query->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row cus_support_cus_sup_query">
			<label class="<?php echo $cus_support_list->LeftColumnClass ?>"><?php echo $cus_support_list->cus_sup_query->caption() ?></label>
			<div class="<?php echo $cus_support_list->RightColumnClass ?>"><div <?php echo $cus_support_list->cus_sup_query->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_query">
<span<?php echo $cus_support_list->cus_sup_query->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_query->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($cus_support_list->cus_sup_date->Visible) { // cus_sup_date ?>
		<?php if ($cus_support->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $cus_support_list->TableLeftColumnClass ?>"><span class="cus_support_cus_sup_date">
<?php if ($cus_support_list->isExport() || $cus_support_list->SortUrl($cus_support_list->cus_sup_date) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_date->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cus_support_list->SortUrl($cus_support_list->cus_sup_date) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($cus_support_list->cus_sup_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cus_support_list->cus_sup_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $cus_support_list->cus_sup_date->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_date">
<span<?php echo $cus_support_list->cus_sup_date->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_date->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row cus_support_cus_sup_date">
			<label class="<?php echo $cus_support_list->LeftColumnClass ?>"><?php echo $cus_support_list->cus_sup_date->caption() ?></label>
			<div class="<?php echo $cus_support_list->RightColumnClass ?>"><div <?php echo $cus_support_list->cus_sup_date->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_date">
<span<?php echo $cus_support_list->cus_sup_date->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_date->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($cus_support_list->cus_sup_status->Visible) { // cus_sup_status ?>
		<?php if ($cus_support->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $cus_support_list->TableLeftColumnClass ?>"><span class="cus_support_cus_sup_status">
<?php if ($cus_support_list->isExport() || $cus_support_list->SortUrl($cus_support_list->cus_sup_status) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_status->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cus_support_list->SortUrl($cus_support_list->cus_sup_status) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_status->caption() ?></span><span class="ew-table-header-sort"><?php if ($cus_support_list->cus_sup_status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cus_support_list->cus_sup_status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $cus_support_list->cus_sup_status->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_status">
<span<?php echo $cus_support_list->cus_sup_status->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_status->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row cus_support_cus_sup_status">
			<label class="<?php echo $cus_support_list->LeftColumnClass ?>"><?php echo $cus_support_list->cus_sup_status->caption() ?></label>
			<div class="<?php echo $cus_support_list->RightColumnClass ?>"><div <?php echo $cus_support_list->cus_sup_status->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_status">
<span<?php echo $cus_support_list->cus_sup_status->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_status->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($cus_support_list->cus_sup_resolved_on->Visible) { // cus_sup_resolved_on ?>
		<?php if ($cus_support->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $cus_support_list->TableLeftColumnClass ?>"><span class="cus_support_cus_sup_resolved_on">
<?php if ($cus_support_list->isExport() || $cus_support_list->SortUrl($cus_support_list->cus_sup_resolved_on) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_resolved_on->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cus_support_list->SortUrl($cus_support_list->cus_sup_resolved_on) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cus_support_list->cus_sup_resolved_on->caption() ?></span><span class="ew-table-header-sort"><?php if ($cus_support_list->cus_sup_resolved_on->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cus_support_list->cus_sup_resolved_on->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $cus_support_list->cus_sup_resolved_on->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_resolved_on">
<span<?php echo $cus_support_list->cus_sup_resolved_on->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_resolved_on->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row cus_support_cus_sup_resolved_on">
			<label class="<?php echo $cus_support_list->LeftColumnClass ?>"><?php echo $cus_support_list->cus_sup_resolved_on->caption() ?></label>
			<div class="<?php echo $cus_support_list->RightColumnClass ?>"><div <?php echo $cus_support_list->cus_sup_resolved_on->cellAttributes() ?>>
<span id="el<?php echo $cus_support_list->RowCount ?>_cus_support_cus_sup_resolved_on">
<span<?php echo $cus_support_list->cus_sup_resolved_on->viewAttributes() ?>><?php echo $cus_support_list->cus_sup_resolved_on->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($cus_support->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$cus_support_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$cus_support_list->ListOptions->render("body", "bottom", $cus_support_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$cus_support_list->isGridAdd())
		$cus_support_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$cus_support->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cus_support_list->Recordset)
	$cus_support_list->Recordset->Close();
?>
<?php if (!$cus_support_list->isExport()) { ?>
<div>
<?php if (!$cus_support_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cus_support_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cus_support_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($cus_support_list->TotalRecords == 0 && !$cus_support->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cus_support_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cus_support_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cus_support_list->isExport()) { ?>
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
$cus_support_list->terminate();
?>