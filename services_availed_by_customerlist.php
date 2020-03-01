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
$services_availed_by_customer_list = new services_availed_by_customer_list();

// Run the page
$services_availed_by_customer_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$services_availed_by_customer_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$services_availed_by_customer_list->isExport()) { ?>
<script>
var fservices_availed_by_customerlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fservices_availed_by_customerlist = currentForm = new ew.Form("fservices_availed_by_customerlist", "list");
	fservices_availed_by_customerlist.formKeyCountName = '<?php echo $services_availed_by_customer_list->FormKeyCountName ?>';
	loadjs.done("fservices_availed_by_customerlist");
});
var fservices_availed_by_customerlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fservices_availed_by_customerlistsrch = currentSearchForm = new ew.Form("fservices_availed_by_customerlistsrch");

	// Dynamic selection lists
	// Filters

	fservices_availed_by_customerlistsrch.filterList = <?php echo $services_availed_by_customer_list->getFilterList() ?>;
	loadjs.done("fservices_availed_by_customerlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$services_availed_by_customer_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($services_availed_by_customer_list->TotalRecords > 0 && $services_availed_by_customer_list->ExportOptions->visible()) { ?>
<?php $services_availed_by_customer_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($services_availed_by_customer_list->ImportOptions->visible()) { ?>
<?php $services_availed_by_customer_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($services_availed_by_customer_list->SearchOptions->visible()) { ?>
<?php $services_availed_by_customer_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($services_availed_by_customer_list->FilterOptions->visible()) { ?>
<?php $services_availed_by_customer_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$services_availed_by_customer_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$services_availed_by_customer_list->isExport() && !$services_availed_by_customer->CurrentAction) { ?>
<form name="fservices_availed_by_customerlistsrch" id="fservices_availed_by_customerlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fservices_availed_by_customerlistsrch-search-panel" class="<?php echo $services_availed_by_customer_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="services_availed_by_customer">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $services_availed_by_customer_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($services_availed_by_customer_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($services_availed_by_customer_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $services_availed_by_customer_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($services_availed_by_customer_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($services_availed_by_customer_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($services_availed_by_customer_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($services_availed_by_customer_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $services_availed_by_customer_list->showPageHeader(); ?>
<?php
$services_availed_by_customer_list->showMessage();
?>
<?php if ($services_availed_by_customer_list->TotalRecords > 0 || $services_availed_by_customer->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$services_availed_by_customer_list->isExport()) { ?>
<div>
<?php if (!$services_availed_by_customer_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $services_availed_by_customer_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $services_availed_by_customer_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fservices_availed_by_customerlist" id="fservices_availed_by_customerlist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="services_availed_by_customer">
<div class="row ew-multi-column-row">
<?php if ($services_availed_by_customer_list->TotalRecords > 0 || $services_availed_by_customer_list->isGridEdit()) { ?>
<?php
if ($services_availed_by_customer_list->ExportAll && $services_availed_by_customer_list->isExport()) {
	$services_availed_by_customer_list->StopRecord = $services_availed_by_customer_list->TotalRecords;
} else {

	// Set the last record to display
	if ($services_availed_by_customer_list->TotalRecords > $services_availed_by_customer_list->StartRecord + $services_availed_by_customer_list->DisplayRecords - 1)
		$services_availed_by_customer_list->StopRecord = $services_availed_by_customer_list->StartRecord + $services_availed_by_customer_list->DisplayRecords - 1;
	else
		$services_availed_by_customer_list->StopRecord = $services_availed_by_customer_list->TotalRecords;
}
$services_availed_by_customer_list->RecordCount = $services_availed_by_customer_list->StartRecord - 1;
if ($services_availed_by_customer_list->Recordset && !$services_availed_by_customer_list->Recordset->EOF) {
	$services_availed_by_customer_list->Recordset->moveFirst();
	$selectLimit = $services_availed_by_customer_list->UseSelectLimit;
	if (!$selectLimit && $services_availed_by_customer_list->StartRecord > 1)
		$services_availed_by_customer_list->Recordset->move($services_availed_by_customer_list->StartRecord - 1);
} elseif (!$services_availed_by_customer->AllowAddDeleteRow && $services_availed_by_customer_list->StopRecord == 0) {
	$services_availed_by_customer_list->StopRecord = $services_availed_by_customer->GridAddRowCount;
}
while ($services_availed_by_customer_list->RecordCount < $services_availed_by_customer_list->StopRecord) {
	$services_availed_by_customer_list->RecordCount++;
	if ($services_availed_by_customer_list->RecordCount >= $services_availed_by_customer_list->StartRecord) {
		$services_availed_by_customer_list->RowCount++;

		// Set up key count
		$services_availed_by_customer_list->KeyCount = $services_availed_by_customer_list->RowIndex;

		// Init row class and style
		$services_availed_by_customer->resetAttributes();
		$services_availed_by_customer->CssClass = "";
		if ($services_availed_by_customer_list->isGridAdd()) {
		} else {
			$services_availed_by_customer_list->loadRowValues($services_availed_by_customer_list->Recordset); // Load row values
		}
		$services_availed_by_customer->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$services_availed_by_customer->RowAttrs->merge(["data-rowindex" => $services_availed_by_customer_list->RowCount, "id" => "r" . $services_availed_by_customer_list->RowCount . "_services_availed_by_customer", "data-rowtype" => $services_availed_by_customer->RowType]);

		// Render row
		$services_availed_by_customer_list->renderRow();

		// Render list options
		$services_availed_by_customer_list->renderListOptions();
?>
<div class="<?php echo $services_availed_by_customer_list->getMultiColumnClass() ?>" <?php echo $services_availed_by_customer->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($services_availed_by_customer->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($services_availed_by_customer_list->sabc_id->Visible) { // sabc_id ?>
		<?php if ($services_availed_by_customer->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $services_availed_by_customer_list->TableLeftColumnClass ?>"><span class="services_availed_by_customer_sabc_id">
<?php if ($services_availed_by_customer_list->isExport() || $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $services_availed_by_customer_list->sabc_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_id">
<span<?php echo $services_availed_by_customer_list->sabc_id->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row services_availed_by_customer_sabc_id">
			<label class="<?php echo $services_availed_by_customer_list->LeftColumnClass ?>"><?php echo $services_availed_by_customer_list->sabc_id->caption() ?></label>
			<div class="<?php echo $services_availed_by_customer_list->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_list->sabc_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_id">
<span<?php echo $services_availed_by_customer_list->sabc_id->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($services_availed_by_customer_list->sabc_branch_id->Visible) { // sabc_branch_id ?>
		<?php if ($services_availed_by_customer->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $services_availed_by_customer_list->TableLeftColumnClass ?>"><span class="services_availed_by_customer_sabc_branch_id">
<?php if ($services_availed_by_customer_list->isExport() || $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_branch_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_branch_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_branch_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $services_availed_by_customer_list->sabc_branch_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_branch_id">
<span<?php echo $services_availed_by_customer_list->sabc_branch_id->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_branch_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row services_availed_by_customer_sabc_branch_id">
			<label class="<?php echo $services_availed_by_customer_list->LeftColumnClass ?>"><?php echo $services_availed_by_customer_list->sabc_branch_id->caption() ?></label>
			<div class="<?php echo $services_availed_by_customer_list->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_list->sabc_branch_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_branch_id">
<span<?php echo $services_availed_by_customer_list->sabc_branch_id->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_branch_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($services_availed_by_customer_list->sabc_business_id->Visible) { // sabc_business_id ?>
		<?php if ($services_availed_by_customer->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $services_availed_by_customer_list->TableLeftColumnClass ?>"><span class="services_availed_by_customer_sabc_business_id">
<?php if ($services_availed_by_customer_list->isExport() || $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_business_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_business_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_business_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_business_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_business_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_business_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $services_availed_by_customer_list->sabc_business_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_business_id">
<span<?php echo $services_availed_by_customer_list->sabc_business_id->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_business_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row services_availed_by_customer_sabc_business_id">
			<label class="<?php echo $services_availed_by_customer_list->LeftColumnClass ?>"><?php echo $services_availed_by_customer_list->sabc_business_id->caption() ?></label>
			<div class="<?php echo $services_availed_by_customer_list->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_list->sabc_business_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_business_id">
<span<?php echo $services_availed_by_customer_list->sabc_business_id->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_business_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($services_availed_by_customer_list->sabc_service_id->Visible) { // sabc_service_id ?>
		<?php if ($services_availed_by_customer->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $services_availed_by_customer_list->TableLeftColumnClass ?>"><span class="services_availed_by_customer_sabc_service_id">
<?php if ($services_availed_by_customer_list->isExport() || $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_service_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_service_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_service_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_service_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_service_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_service_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $services_availed_by_customer_list->sabc_service_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_service_id">
<span<?php echo $services_availed_by_customer_list->sabc_service_id->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_service_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row services_availed_by_customer_sabc_service_id">
			<label class="<?php echo $services_availed_by_customer_list->LeftColumnClass ?>"><?php echo $services_availed_by_customer_list->sabc_service_id->caption() ?></label>
			<div class="<?php echo $services_availed_by_customer_list->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_list->sabc_service_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_service_id">
<span<?php echo $services_availed_by_customer_list->sabc_service_id->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_service_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($services_availed_by_customer_list->sabc_pkg->Visible) { // sabc_pkg ?>
		<?php if ($services_availed_by_customer->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $services_availed_by_customer_list->TableLeftColumnClass ?>"><span class="services_availed_by_customer_sabc_pkg">
<?php if ($services_availed_by_customer_list->isExport() || $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_pkg) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_pkg->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_pkg) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_pkg->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_pkg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_pkg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $services_availed_by_customer_list->sabc_pkg->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_pkg">
<span<?php echo $services_availed_by_customer_list->sabc_pkg->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_pkg->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row services_availed_by_customer_sabc_pkg">
			<label class="<?php echo $services_availed_by_customer_list->LeftColumnClass ?>"><?php echo $services_availed_by_customer_list->sabc_pkg->caption() ?></label>
			<div class="<?php echo $services_availed_by_customer_list->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_list->sabc_pkg->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_pkg">
<span<?php echo $services_availed_by_customer_list->sabc_pkg->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_pkg->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($services_availed_by_customer_list->sabc_amount->Visible) { // sabc_amount ?>
		<?php if ($services_availed_by_customer->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $services_availed_by_customer_list->TableLeftColumnClass ?>"><span class="services_availed_by_customer_sabc_amount">
<?php if ($services_availed_by_customer_list->isExport() || $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_amount) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_amount->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_amount) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $services_availed_by_customer_list->sabc_amount->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_amount">
<span<?php echo $services_availed_by_customer_list->sabc_amount->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_amount->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row services_availed_by_customer_sabc_amount">
			<label class="<?php echo $services_availed_by_customer_list->LeftColumnClass ?>"><?php echo $services_availed_by_customer_list->sabc_amount->caption() ?></label>
			<div class="<?php echo $services_availed_by_customer_list->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_list->sabc_amount->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_amount">
<span<?php echo $services_availed_by_customer_list->sabc_amount->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_amount->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($services_availed_by_customer_list->sabc_desc->Visible) { // sabc_desc ?>
		<?php if ($services_availed_by_customer->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $services_availed_by_customer_list->TableLeftColumnClass ?>"><span class="services_availed_by_customer_sabc_desc">
<?php if ($services_availed_by_customer_list->isExport() || $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_desc) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_desc->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_desc) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $services_availed_by_customer_list->sabc_desc->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_desc">
<span<?php echo $services_availed_by_customer_list->sabc_desc->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_desc->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row services_availed_by_customer_sabc_desc">
			<label class="<?php echo $services_availed_by_customer_list->LeftColumnClass ?>"><?php echo $services_availed_by_customer_list->sabc_desc->caption() ?></label>
			<div class="<?php echo $services_availed_by_customer_list->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_list->sabc_desc->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_desc">
<span<?php echo $services_availed_by_customer_list->sabc_desc->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_desc->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($services_availed_by_customer_list->sabc_signed_on->Visible) { // sabc_signed_on ?>
		<?php if ($services_availed_by_customer->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $services_availed_by_customer_list->TableLeftColumnClass ?>"><span class="services_availed_by_customer_sabc_signed_on">
<?php if ($services_availed_by_customer_list->isExport() || $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_signed_on) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_signed_on->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_signed_on) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_signed_on->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_signed_on->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_signed_on->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $services_availed_by_customer_list->sabc_signed_on->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_signed_on">
<span<?php echo $services_availed_by_customer_list->sabc_signed_on->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_signed_on->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row services_availed_by_customer_sabc_signed_on">
			<label class="<?php echo $services_availed_by_customer_list->LeftColumnClass ?>"><?php echo $services_availed_by_customer_list->sabc_signed_on->caption() ?></label>
			<div class="<?php echo $services_availed_by_customer_list->RightColumnClass ?>"><div <?php echo $services_availed_by_customer_list->sabc_signed_on->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_signed_on">
<span<?php echo $services_availed_by_customer_list->sabc_signed_on->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_signed_on->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($services_availed_by_customer->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$services_availed_by_customer_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$services_availed_by_customer_list->ListOptions->render("body", "bottom", $services_availed_by_customer_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$services_availed_by_customer_list->isGridAdd())
		$services_availed_by_customer_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$services_availed_by_customer->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($services_availed_by_customer_list->Recordset)
	$services_availed_by_customer_list->Recordset->Close();
?>
<?php if (!$services_availed_by_customer_list->isExport()) { ?>
<div>
<?php if (!$services_availed_by_customer_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $services_availed_by_customer_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $services_availed_by_customer_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($services_availed_by_customer_list->TotalRecords == 0 && !$services_availed_by_customer->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $services_availed_by_customer_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$services_availed_by_customer_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$services_availed_by_customer_list->isExport()) { ?>
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
$services_availed_by_customer_list->terminate();
?>