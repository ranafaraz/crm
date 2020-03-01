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
$business_list = new business_list();

// Run the page
$business_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$business_list->isExport()) { ?>
<script>
var fbusinesslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbusinesslist = currentForm = new ew.Form("fbusinesslist", "list");
	fbusinesslist.formKeyCountName = '<?php echo $business_list->FormKeyCountName ?>';
	loadjs.done("fbusinesslist");
});
var fbusinesslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbusinesslistsrch = currentSearchForm = new ew.Form("fbusinesslistsrch");

	// Dynamic selection lists
	// Filters

	fbusinesslistsrch.filterList = <?php echo $business_list->getFilterList() ?>;
	loadjs.done("fbusinesslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$business_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($business_list->TotalRecords > 0 && $business_list->ExportOptions->visible()) { ?>
<?php $business_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($business_list->ImportOptions->visible()) { ?>
<?php $business_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($business_list->SearchOptions->visible()) { ?>
<?php $business_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($business_list->FilterOptions->visible()) { ?>
<?php $business_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$business_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$business_list->isExport() && !$business->CurrentAction) { ?>
<form name="fbusinesslistsrch" id="fbusinesslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbusinesslistsrch-search-panel" class="<?php echo $business_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="business">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $business_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($business_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($business_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $business_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($business_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($business_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($business_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($business_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $business_list->showPageHeader(); ?>
<?php
$business_list->showMessage();
?>
<?php if ($business_list->TotalRecords > 0 || $business->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$business_list->isExport()) { ?>
<div>
<?php if (!$business_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $business_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $business_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbusinesslist" id="fbusinesslist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business">
<div class="row ew-multi-column-row">
<?php if ($business_list->TotalRecords > 0 || $business_list->isGridEdit()) { ?>
<?php
if ($business_list->ExportAll && $business_list->isExport()) {
	$business_list->StopRecord = $business_list->TotalRecords;
} else {

	// Set the last record to display
	if ($business_list->TotalRecords > $business_list->StartRecord + $business_list->DisplayRecords - 1)
		$business_list->StopRecord = $business_list->StartRecord + $business_list->DisplayRecords - 1;
	else
		$business_list->StopRecord = $business_list->TotalRecords;
}
$business_list->RecordCount = $business_list->StartRecord - 1;
if ($business_list->Recordset && !$business_list->Recordset->EOF) {
	$business_list->Recordset->moveFirst();
	$selectLimit = $business_list->UseSelectLimit;
	if (!$selectLimit && $business_list->StartRecord > 1)
		$business_list->Recordset->move($business_list->StartRecord - 1);
} elseif (!$business->AllowAddDeleteRow && $business_list->StopRecord == 0) {
	$business_list->StopRecord = $business->GridAddRowCount;
}
while ($business_list->RecordCount < $business_list->StopRecord) {
	$business_list->RecordCount++;
	if ($business_list->RecordCount >= $business_list->StartRecord) {
		$business_list->RowCount++;

		// Set up key count
		$business_list->KeyCount = $business_list->RowIndex;

		// Init row class and style
		$business->resetAttributes();
		$business->CssClass = "";
		if ($business_list->isGridAdd()) {
		} else {
			$business_list->loadRowValues($business_list->Recordset); // Load row values
		}
		$business->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$business->RowAttrs->merge(["data-rowindex" => $business_list->RowCount, "id" => "r" . $business_list->RowCount . "_business", "data-rowtype" => $business->RowType]);

		// Render row
		$business_list->renderRow();

		// Render list options
		$business_list->renderListOptions();
?>
<div class="<?php echo $business_list->getMultiColumnClass() ?>" <?php echo $business->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($business_list->b_id->Visible) { // b_id ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_id">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_id->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_id">
<span<?php echo $business_list->b_id->viewAttributes() ?>><?php echo $business_list->b_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_id">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_id->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_id->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_id">
<span<?php echo $business_list->b_id->viewAttributes() ?>><?php echo $business_list->b_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_branch_id->Visible) { // b_branch_id ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_branch_id">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_branch_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_branch_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_branch_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_branch_id->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_branch_id">
<span<?php echo $business_list->b_branch_id->viewAttributes() ?>><?php echo $business_list->b_branch_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_branch_id">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_branch_id->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_branch_id->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_branch_id">
<span<?php echo $business_list->b_branch_id->viewAttributes() ?>><?php echo $business_list->b_branch_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_b_type_id->Visible) { // b_b_type_id ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_b_type_id">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_b_type_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_b_type_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_b_type_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_b_type_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_b_type_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_b_type_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_b_type_id->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_b_type_id">
<span<?php echo $business_list->b_b_type_id->viewAttributes() ?>><?php echo $business_list->b_b_type_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_b_type_id">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_b_type_id->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_b_type_id->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_b_type_id">
<span<?php echo $business_list->b_b_type_id->viewAttributes() ?>><?php echo $business_list->b_b_type_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_b_nature_id->Visible) { // b_b_nature_id ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_b_nature_id">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_b_nature_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_b_nature_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_b_nature_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_b_nature_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_b_nature_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_b_nature_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_b_nature_id->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_b_nature_id">
<span<?php echo $business_list->b_b_nature_id->viewAttributes() ?>><?php echo $business_list->b_b_nature_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_b_nature_id">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_b_nature_id->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_b_nature_id->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_b_nature_id">
<span<?php echo $business_list->b_b_nature_id->viewAttributes() ?>><?php echo $business_list->b_b_nature_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_b_status_id->Visible) { // b_b_status_id ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_b_status_id">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_b_status_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_b_status_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_b_status_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_b_status_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_b_status_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_b_status_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_b_status_id->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_b_status_id">
<span<?php echo $business_list->b_b_status_id->viewAttributes() ?>><?php echo $business_list->b_b_status_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_b_status_id">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_b_status_id->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_b_status_id->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_b_status_id">
<span<?php echo $business_list->b_b_status_id->viewAttributes() ?>><?php echo $business_list->b_b_status_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_city_id->Visible) { // b_city_id ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_city_id">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_city_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_city_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_city_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_city_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_city_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_city_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_city_id->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_city_id">
<span<?php echo $business_list->b_city_id->viewAttributes() ?>><?php echo $business_list->b_city_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_city_id">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_city_id->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_city_id->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_city_id">
<span<?php echo $business_list->b_city_id->viewAttributes() ?>><?php echo $business_list->b_city_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_referral_id->Visible) { // b_referral_id ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_referral_id">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_referral_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_referral_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_referral_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_referral_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_referral_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_referral_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_referral_id->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_referral_id">
<span<?php echo $business_list->b_referral_id->viewAttributes() ?>><?php echo $business_list->b_referral_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_referral_id">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_referral_id->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_referral_id->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_referral_id">
<span<?php echo $business_list->b_referral_id->viewAttributes() ?>><?php echo $business_list->b_referral_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_name->Visible) { // b_name ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_name">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_name) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_name->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_name) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_name->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_name">
<span<?php echo $business_list->b_name->viewAttributes() ?>><?php echo $business_list->b_name->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_name">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_name->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_name->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_name">
<span<?php echo $business_list->b_name->viewAttributes() ?>><?php echo $business_list->b_name->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_owner->Visible) { // b_owner ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_owner">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_owner) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_owner->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_owner) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_owner->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_owner->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_owner->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_owner->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_owner">
<span<?php echo $business_list->b_owner->viewAttributes() ?>><?php echo $business_list->b_owner->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_owner">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_owner->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_owner->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_owner">
<span<?php echo $business_list->b_owner->viewAttributes() ?>><?php echo $business_list->b_owner->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_contact->Visible) { // b_contact ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_contact">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_contact) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_contact->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_contact) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_contact->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_contact->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_contact->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_contact->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_contact">
<span<?php echo $business_list->b_contact->viewAttributes() ?>><?php echo $business_list->b_contact->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_contact">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_contact->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_contact->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_contact">
<span<?php echo $business_list->b_contact->viewAttributes() ?>><?php echo $business_list->b_contact->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_address->Visible) { // b_address ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_address">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_address) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_address->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_address) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_address->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_address">
<span<?php echo $business_list->b_address->viewAttributes() ?>><?php echo $business_list->b_address->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_address">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_address->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_address->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_address">
<span<?php echo $business_list->b_address->viewAttributes() ?>><?php echo $business_list->b_address->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_email->Visible) { // b_email ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_email">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_email) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_email->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_email) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_email->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_email">
<span<?php echo $business_list->b_email->viewAttributes() ?>><?php echo $business_list->b_email->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_email">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_email->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_email->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_email">
<span<?php echo $business_list->b_email->viewAttributes() ?>><?php echo $business_list->b_email->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_ntn->Visible) { // b_ntn ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_ntn">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_ntn) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_ntn->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_ntn) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_ntn->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_ntn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_ntn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_ntn->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_ntn">
<span<?php echo $business_list->b_ntn->viewAttributes() ?>><?php echo $business_list->b_ntn->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_ntn">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_ntn->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_ntn->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_ntn">
<span<?php echo $business_list->b_ntn->viewAttributes() ?>><?php echo $business_list->b_ntn->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_logo->Visible) { // b_logo ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_logo">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_logo) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_logo->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_logo) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_logo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_logo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_logo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_logo->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_logo">
<span><?php echo GetFileViewTag($business_list->b_logo, $business_list->b_logo->getViewValue(), FALSE) ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_logo">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_logo->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_logo->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_logo">
<span><?php echo GetFileViewTag($business_list->b_logo, $business_list->b_logo->getViewValue(), FALSE) ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_no_of_emp->Visible) { // b_no_of_emp ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_no_of_emp">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_no_of_emp) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_no_of_emp->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_no_of_emp) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_no_of_emp->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_no_of_emp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_no_of_emp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_no_of_emp->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_no_of_emp">
<span<?php echo $business_list->b_no_of_emp->viewAttributes() ?>><?php echo $business_list->b_no_of_emp->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_no_of_emp">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_no_of_emp->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_no_of_emp->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_no_of_emp">
<span<?php echo $business_list->b_no_of_emp->viewAttributes() ?>><?php echo $business_list->b_no_of_emp->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_since->Visible) { // b_since ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_since">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_since) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_since->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_since) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_since->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_since->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_since->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_since->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_since">
<span<?php echo $business_list->b_since->viewAttributes() ?>><?php echo $business_list->b_since->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_since">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_since->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_since->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_since">
<span<?php echo $business_list->b_since->viewAttributes() ?>><?php echo $business_list->b_since->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_no_of_branches->Visible) { // b_no_of_branches ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_no_of_branches">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_no_of_branches) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_no_of_branches->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_no_of_branches) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_no_of_branches->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_no_of_branches->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_no_of_branches->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_no_of_branches->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_no_of_branches">
<span<?php echo $business_list->b_no_of_branches->viewAttributes() ?>><?php echo $business_list->b_no_of_branches->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_no_of_branches">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_no_of_branches->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_no_of_branches->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_no_of_branches">
<span<?php echo $business_list->b_no_of_branches->viewAttributes() ?>><?php echo $business_list->b_no_of_branches->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_deal_with_referral->Visible) { // b_deal_with_referral ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_deal_with_referral">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_deal_with_referral) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_deal_with_referral->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_deal_with_referral) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_deal_with_referral->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_deal_with_referral->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_deal_with_referral->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_deal_with_referral->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_deal_with_referral">
<span<?php echo $business_list->b_deal_with_referral->viewAttributes() ?>><?php echo $business_list->b_deal_with_referral->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_deal_with_referral">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_deal_with_referral->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_deal_with_referral->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_deal_with_referral">
<span<?php echo $business_list->b_deal_with_referral->viewAttributes() ?>><?php echo $business_list->b_deal_with_referral->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_list->b_comments->Visible) { // b_comments ?>
		<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_list->TableLeftColumnClass ?>"><span class="business_b_comments">
<?php if ($business_list->isExport() || $business_list->SortUrl($business_list->b_comments) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_list->b_comments->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->b_comments) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->b_comments->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->b_comments->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->b_comments->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_list->b_comments->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_comments">
<span<?php echo $business_list->b_comments->viewAttributes() ?>><?php echo $business_list->b_comments->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_b_comments">
			<label class="<?php echo $business_list->LeftColumnClass ?>"><?php echo $business_list->b_comments->caption() ?></label>
			<div class="<?php echo $business_list->RightColumnClass ?>"><div <?php echo $business_list->b_comments->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_b_comments">
<span<?php echo $business_list->b_comments->viewAttributes() ?>><?php echo $business_list->b_comments->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$business_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$business_list->ListOptions->render("body", "bottom", $business_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$business_list->isGridAdd())
		$business_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$business->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($business_list->Recordset)
	$business_list->Recordset->Close();
?>
<?php if (!$business_list->isExport()) { ?>
<div>
<?php if (!$business_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $business_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $business_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($business_list->TotalRecords == 0 && !$business->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $business_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$business_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$business_list->isExport()) { ?>
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
$business_list->terminate();
?>