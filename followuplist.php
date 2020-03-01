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
$followup_list = new followup_list();

// Run the page
$followup_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$followup_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$followup_list->isExport()) { ?>
<script>
var ffollowuplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ffollowuplist = currentForm = new ew.Form("ffollowuplist", "list");
	ffollowuplist.formKeyCountName = '<?php echo $followup_list->FormKeyCountName ?>';
	loadjs.done("ffollowuplist");
});
var ffollowuplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ffollowuplistsrch = currentSearchForm = new ew.Form("ffollowuplistsrch");

	// Dynamic selection lists
	// Filters

	ffollowuplistsrch.filterList = <?php echo $followup_list->getFilterList() ?>;
	loadjs.done("ffollowuplistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$followup_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($followup_list->TotalRecords > 0 && $followup_list->ExportOptions->visible()) { ?>
<?php $followup_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($followup_list->ImportOptions->visible()) { ?>
<?php $followup_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($followup_list->SearchOptions->visible()) { ?>
<?php $followup_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($followup_list->FilterOptions->visible()) { ?>
<?php $followup_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$followup_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$followup_list->isExport() && !$followup->CurrentAction) { ?>
<form name="ffollowuplistsrch" id="ffollowuplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ffollowuplistsrch-search-panel" class="<?php echo $followup_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="followup">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $followup_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($followup_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($followup_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $followup_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($followup_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($followup_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($followup_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($followup_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $followup_list->showPageHeader(); ?>
<?php
$followup_list->showMessage();
?>
<?php if ($followup_list->TotalRecords > 0 || $followup->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$followup_list->isExport()) { ?>
<div>
<?php if (!$followup_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $followup_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $followup_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ffollowuplist" id="ffollowuplist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="followup">
<div class="row ew-multi-column-row">
<?php if ($followup_list->TotalRecords > 0 || $followup_list->isGridEdit()) { ?>
<?php
if ($followup_list->ExportAll && $followup_list->isExport()) {
	$followup_list->StopRecord = $followup_list->TotalRecords;
} else {

	// Set the last record to display
	if ($followup_list->TotalRecords > $followup_list->StartRecord + $followup_list->DisplayRecords - 1)
		$followup_list->StopRecord = $followup_list->StartRecord + $followup_list->DisplayRecords - 1;
	else
		$followup_list->StopRecord = $followup_list->TotalRecords;
}
$followup_list->RecordCount = $followup_list->StartRecord - 1;
if ($followup_list->Recordset && !$followup_list->Recordset->EOF) {
	$followup_list->Recordset->moveFirst();
	$selectLimit = $followup_list->UseSelectLimit;
	if (!$selectLimit && $followup_list->StartRecord > 1)
		$followup_list->Recordset->move($followup_list->StartRecord - 1);
} elseif (!$followup->AllowAddDeleteRow && $followup_list->StopRecord == 0) {
	$followup_list->StopRecord = $followup->GridAddRowCount;
}
while ($followup_list->RecordCount < $followup_list->StopRecord) {
	$followup_list->RecordCount++;
	if ($followup_list->RecordCount >= $followup_list->StartRecord) {
		$followup_list->RowCount++;

		// Set up key count
		$followup_list->KeyCount = $followup_list->RowIndex;

		// Init row class and style
		$followup->resetAttributes();
		$followup->CssClass = "";
		if ($followup_list->isGridAdd()) {
		} else {
			$followup_list->loadRowValues($followup_list->Recordset); // Load row values
		}
		$followup->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$followup->RowAttrs->merge(["data-rowindex" => $followup_list->RowCount, "id" => "r" . $followup_list->RowCount . "_followup", "data-rowtype" => $followup->RowType]);

		// Render row
		$followup_list->renderRow();

		// Render list options
		$followup_list->renderListOptions();
?>
<div class="<?php echo $followup_list->getMultiColumnClass() ?>" <?php echo $followup->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($followup->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($followup_list->followup_id->Visible) { // followup_id ?>
		<?php if ($followup->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $followup_list->TableLeftColumnClass ?>"><span class="followup_followup_id">
<?php if ($followup_list->isExport() || $followup_list->SortUrl($followup_list->followup_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $followup_list->followup_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $followup_list->followup_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_id">
<span<?php echo $followup_list->followup_id->viewAttributes() ?>><?php echo $followup_list->followup_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row followup_followup_id">
			<label class="<?php echo $followup_list->LeftColumnClass ?>"><?php echo $followup_list->followup_id->caption() ?></label>
			<div class="<?php echo $followup_list->RightColumnClass ?>"><div <?php echo $followup_list->followup_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_id">
<span<?php echo $followup_list->followup_id->viewAttributes() ?>><?php echo $followup_list->followup_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($followup_list->followup_branch_id->Visible) { // followup_branch_id ?>
		<?php if ($followup->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $followup_list->TableLeftColumnClass ?>"><span class="followup_followup_branch_id">
<?php if ($followup_list->isExport() || $followup_list->SortUrl($followup_list->followup_branch_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $followup_list->followup_branch_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_branch_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $followup_list->followup_branch_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_branch_id">
<span<?php echo $followup_list->followup_branch_id->viewAttributes() ?>><?php echo $followup_list->followup_branch_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row followup_followup_branch_id">
			<label class="<?php echo $followup_list->LeftColumnClass ?>"><?php echo $followup_list->followup_branch_id->caption() ?></label>
			<div class="<?php echo $followup_list->RightColumnClass ?>"><div <?php echo $followup_list->followup_branch_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_branch_id">
<span<?php echo $followup_list->followup_branch_id->viewAttributes() ?>><?php echo $followup_list->followup_branch_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($followup_list->followup_business_id->Visible) { // followup_business_id ?>
		<?php if ($followup->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $followup_list->TableLeftColumnClass ?>"><span class="followup_followup_business_id">
<?php if ($followup_list->isExport() || $followup_list->SortUrl($followup_list->followup_business_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $followup_list->followup_business_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_business_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_business_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_business_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_business_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $followup_list->followup_business_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_business_id">
<span<?php echo $followup_list->followup_business_id->viewAttributes() ?>><?php echo $followup_list->followup_business_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row followup_followup_business_id">
			<label class="<?php echo $followup_list->LeftColumnClass ?>"><?php echo $followup_list->followup_business_id->caption() ?></label>
			<div class="<?php echo $followup_list->RightColumnClass ?>"><div <?php echo $followup_list->followup_business_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_business_id">
<span<?php echo $followup_list->followup_business_id->viewAttributes() ?>><?php echo $followup_list->followup_business_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($followup_list->followup_by_emp_id->Visible) { // followup_by_emp_id ?>
		<?php if ($followup->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $followup_list->TableLeftColumnClass ?>"><span class="followup_followup_by_emp_id">
<?php if ($followup_list->isExport() || $followup_list->SortUrl($followup_list->followup_by_emp_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $followup_list->followup_by_emp_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_by_emp_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_by_emp_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_by_emp_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_by_emp_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $followup_list->followup_by_emp_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_by_emp_id">
<span<?php echo $followup_list->followup_by_emp_id->viewAttributes() ?>><?php echo $followup_list->followup_by_emp_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row followup_followup_by_emp_id">
			<label class="<?php echo $followup_list->LeftColumnClass ?>"><?php echo $followup_list->followup_by_emp_id->caption() ?></label>
			<div class="<?php echo $followup_list->RightColumnClass ?>"><div <?php echo $followup_list->followup_by_emp_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_by_emp_id">
<span<?php echo $followup_list->followup_by_emp_id->viewAttributes() ?>><?php echo $followup_list->followup_by_emp_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($followup_list->followup_no_id->Visible) { // followup_no_id ?>
		<?php if ($followup->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $followup_list->TableLeftColumnClass ?>"><span class="followup_followup_no_id">
<?php if ($followup_list->isExport() || $followup_list->SortUrl($followup_list->followup_no_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $followup_list->followup_no_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_no_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_no_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_no_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_no_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $followup_list->followup_no_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_no_id">
<span<?php echo $followup_list->followup_no_id->viewAttributes() ?>><?php echo $followup_list->followup_no_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row followup_followup_no_id">
			<label class="<?php echo $followup_list->LeftColumnClass ?>"><?php echo $followup_list->followup_no_id->caption() ?></label>
			<div class="<?php echo $followup_list->RightColumnClass ?>"><div <?php echo $followup_list->followup_no_id->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_no_id">
<span<?php echo $followup_list->followup_no_id->viewAttributes() ?>><?php echo $followup_list->followup_no_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($followup_list->followup_date->Visible) { // followup_date ?>
		<?php if ($followup->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $followup_list->TableLeftColumnClass ?>"><span class="followup_followup_date">
<?php if ($followup_list->isExport() || $followup_list->SortUrl($followup_list->followup_date) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $followup_list->followup_date->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_date) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $followup_list->followup_date->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_date">
<span<?php echo $followup_list->followup_date->viewAttributes() ?>><?php echo $followup_list->followup_date->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row followup_followup_date">
			<label class="<?php echo $followup_list->LeftColumnClass ?>"><?php echo $followup_list->followup_date->caption() ?></label>
			<div class="<?php echo $followup_list->RightColumnClass ?>"><div <?php echo $followup_list->followup_date->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_date">
<span<?php echo $followup_list->followup_date->viewAttributes() ?>><?php echo $followup_list->followup_date->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($followup_list->followup_comments->Visible) { // followup_comments ?>
		<?php if ($followup->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $followup_list->TableLeftColumnClass ?>"><span class="followup_followup_comments">
<?php if ($followup_list->isExport() || $followup_list->SortUrl($followup_list->followup_comments) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $followup_list->followup_comments->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_comments) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_comments->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_comments->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_comments->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $followup_list->followup_comments->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_comments">
<span<?php echo $followup_list->followup_comments->viewAttributes() ?>><?php echo $followup_list->followup_comments->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row followup_followup_comments">
			<label class="<?php echo $followup_list->LeftColumnClass ?>"><?php echo $followup_list->followup_comments->caption() ?></label>
			<div class="<?php echo $followup_list->RightColumnClass ?>"><div <?php echo $followup_list->followup_comments->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_comments">
<span<?php echo $followup_list->followup_comments->viewAttributes() ?>><?php echo $followup_list->followup_comments->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($followup_list->followup_response->Visible) { // followup_response ?>
		<?php if ($followup->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $followup_list->TableLeftColumnClass ?>"><span class="followup_followup_response">
<?php if ($followup_list->isExport() || $followup_list->SortUrl($followup_list->followup_response) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $followup_list->followup_response->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->followup_response) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->followup_response->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->followup_response->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->followup_response->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $followup_list->followup_response->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_response">
<span<?php echo $followup_list->followup_response->viewAttributes() ?>><?php echo $followup_list->followup_response->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row followup_followup_response">
			<label class="<?php echo $followup_list->LeftColumnClass ?>"><?php echo $followup_list->followup_response->caption() ?></label>
			<div class="<?php echo $followup_list->RightColumnClass ?>"><div <?php echo $followup_list->followup_response->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_followup_response">
<span<?php echo $followup_list->followup_response->viewAttributes() ?>><?php echo $followup_list->followup_response->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($followup_list->nxt_FU_date->Visible) { // nxt_FU_date ?>
		<?php if ($followup->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $followup_list->TableLeftColumnClass ?>"><span class="followup_nxt_FU_date">
<?php if ($followup_list->isExport() || $followup_list->SortUrl($followup_list->nxt_FU_date) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $followup_list->nxt_FU_date->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->nxt_FU_date) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->nxt_FU_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->nxt_FU_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->nxt_FU_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $followup_list->nxt_FU_date->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_nxt_FU_date">
<span<?php echo $followup_list->nxt_FU_date->viewAttributes() ?>><?php echo $followup_list->nxt_FU_date->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row followup_nxt_FU_date">
			<label class="<?php echo $followup_list->LeftColumnClass ?>"><?php echo $followup_list->nxt_FU_date->caption() ?></label>
			<div class="<?php echo $followup_list->RightColumnClass ?>"><div <?php echo $followup_list->nxt_FU_date->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_nxt_FU_date">
<span<?php echo $followup_list->nxt_FU_date->viewAttributes() ?>><?php echo $followup_list->nxt_FU_date->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($followup_list->nxt_FU_plans->Visible) { // nxt_FU_plans ?>
		<?php if ($followup->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $followup_list->TableLeftColumnClass ?>"><span class="followup_nxt_FU_plans">
<?php if ($followup_list->isExport() || $followup_list->SortUrl($followup_list->nxt_FU_plans) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $followup_list->nxt_FU_plans->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->nxt_FU_plans) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->nxt_FU_plans->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($followup_list->nxt_FU_plans->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->nxt_FU_plans->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $followup_list->nxt_FU_plans->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_nxt_FU_plans">
<span<?php echo $followup_list->nxt_FU_plans->viewAttributes() ?>><?php echo $followup_list->nxt_FU_plans->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row followup_nxt_FU_plans">
			<label class="<?php echo $followup_list->LeftColumnClass ?>"><?php echo $followup_list->nxt_FU_plans->caption() ?></label>
			<div class="<?php echo $followup_list->RightColumnClass ?>"><div <?php echo $followup_list->nxt_FU_plans->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_nxt_FU_plans">
<span<?php echo $followup_list->nxt_FU_plans->viewAttributes() ?>><?php echo $followup_list->nxt_FU_plans->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($followup_list->current_FU_status->Visible) { // current_FU_status ?>
		<?php if ($followup->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $followup_list->TableLeftColumnClass ?>"><span class="followup_current_FU_status">
<?php if ($followup_list->isExport() || $followup_list->SortUrl($followup_list->current_FU_status) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $followup_list->current_FU_status->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $followup_list->SortUrl($followup_list->current_FU_status) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $followup_list->current_FU_status->caption() ?></span><span class="ew-table-header-sort"><?php if ($followup_list->current_FU_status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($followup_list->current_FU_status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $followup_list->current_FU_status->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_current_FU_status">
<span<?php echo $followup_list->current_FU_status->viewAttributes() ?>><?php echo $followup_list->current_FU_status->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row followup_current_FU_status">
			<label class="<?php echo $followup_list->LeftColumnClass ?>"><?php echo $followup_list->current_FU_status->caption() ?></label>
			<div class="<?php echo $followup_list->RightColumnClass ?>"><div <?php echo $followup_list->current_FU_status->cellAttributes() ?>>
<span id="el<?php echo $followup_list->RowCount ?>_followup_current_FU_status">
<span<?php echo $followup_list->current_FU_status->viewAttributes() ?>><?php echo $followup_list->current_FU_status->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($followup->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$followup_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$followup_list->ListOptions->render("body", "bottom", $followup_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$followup_list->isGridAdd())
		$followup_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$followup->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($followup_list->Recordset)
	$followup_list->Recordset->Close();
?>
<?php if (!$followup_list->isExport()) { ?>
<div>
<?php if (!$followup_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $followup_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $followup_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($followup_list->TotalRecords == 0 && !$followup->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $followup_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$followup_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$followup_list->isExport()) { ?>
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
$followup_list->terminate();
?>