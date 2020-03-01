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
$employees_list = new employees_list();

// Run the page
$employees_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employees_list->isExport()) { ?>
<script>
var femployeeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femployeeslist = currentForm = new ew.Form("femployeeslist", "list");
	femployeeslist.formKeyCountName = '<?php echo $employees_list->FormKeyCountName ?>';
	loadjs.done("femployeeslist");
});
var femployeeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	femployeeslistsrch = currentSearchForm = new ew.Form("femployeeslistsrch");

	// Dynamic selection lists
	// Filters

	femployeeslistsrch.filterList = <?php echo $employees_list->getFilterList() ?>;
	loadjs.done("femployeeslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$employees_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employees_list->TotalRecords > 0 && $employees_list->ExportOptions->visible()) { ?>
<?php $employees_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employees_list->ImportOptions->visible()) { ?>
<?php $employees_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employees_list->SearchOptions->visible()) { ?>
<?php $employees_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employees_list->FilterOptions->visible()) { ?>
<?php $employees_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$employees_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employees_list->isExport() && !$employees->CurrentAction) { ?>
<form name="femployeeslistsrch" id="femployeeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="femployeeslistsrch-search-panel" class="<?php echo $employees_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employees">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $employees_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($employees_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($employees_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employees_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $employees_list->showPageHeader(); ?>
<?php
$employees_list->showMessage();
?>
<?php if ($employees_list->TotalRecords > 0 || $employees->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employees_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employees">
<?php if (!$employees_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$employees_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employees_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employees_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="femployeeslist" id="femployeeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<div id="gmp_employees" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employees_list->TotalRecords > 0 || $employees_list->isGridEdit()) { ?>
<table id="tbl_employeeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employees->RowType = ROWTYPE_HEADER;

// Render list options
$employees_list->renderListOptions();

// Render list options (header, left)
$employees_list->ListOptions->render("header", "left");
?>
<?php if ($employees_list->emp_id->Visible) { // emp_id ?>
	<?php if ($employees_list->SortUrl($employees_list->emp_id) == "") { ?>
		<th data-name="emp_id" class="<?php echo $employees_list->emp_id->headerCellClass() ?>"><div id="elh_employees_emp_id" class="employees_emp_id"><div class="ew-table-header-caption"><?php echo $employees_list->emp_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="emp_id" class="<?php echo $employees_list->emp_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->emp_id) ?>', 1);"><div id="elh_employees_emp_id" class="employees_emp_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->emp_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees_list->emp_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->emp_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->emp_branch_id->Visible) { // emp_branch_id ?>
	<?php if ($employees_list->SortUrl($employees_list->emp_branch_id) == "") { ?>
		<th data-name="emp_branch_id" class="<?php echo $employees_list->emp_branch_id->headerCellClass() ?>"><div id="elh_employees_emp_branch_id" class="employees_emp_branch_id"><div class="ew-table-header-caption"><?php echo $employees_list->emp_branch_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="emp_branch_id" class="<?php echo $employees_list->emp_branch_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->emp_branch_id) ?>', 1);"><div id="elh_employees_emp_branch_id" class="employees_emp_branch_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->emp_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees_list->emp_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->emp_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->emp_designation_id->Visible) { // emp_designation_id ?>
	<?php if ($employees_list->SortUrl($employees_list->emp_designation_id) == "") { ?>
		<th data-name="emp_designation_id" class="<?php echo $employees_list->emp_designation_id->headerCellClass() ?>"><div id="elh_employees_emp_designation_id" class="employees_emp_designation_id"><div class="ew-table-header-caption"><?php echo $employees_list->emp_designation_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="emp_designation_id" class="<?php echo $employees_list->emp_designation_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->emp_designation_id) ?>', 1);"><div id="elh_employees_emp_designation_id" class="employees_emp_designation_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->emp_designation_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees_list->emp_designation_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->emp_designation_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->emp_city_id->Visible) { // emp_city_id ?>
	<?php if ($employees_list->SortUrl($employees_list->emp_city_id) == "") { ?>
		<th data-name="emp_city_id" class="<?php echo $employees_list->emp_city_id->headerCellClass() ?>"><div id="elh_employees_emp_city_id" class="employees_emp_city_id"><div class="ew-table-header-caption"><?php echo $employees_list->emp_city_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="emp_city_id" class="<?php echo $employees_list->emp_city_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->emp_city_id) ?>', 1);"><div id="elh_employees_emp_city_id" class="employees_emp_city_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->emp_city_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees_list->emp_city_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->emp_city_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->emp_name->Visible) { // emp_name ?>
	<?php if ($employees_list->SortUrl($employees_list->emp_name) == "") { ?>
		<th data-name="emp_name" class="<?php echo $employees_list->emp_name->headerCellClass() ?>"><div id="elh_employees_emp_name" class="employees_emp_name"><div class="ew-table-header-caption"><?php echo $employees_list->emp_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="emp_name" class="<?php echo $employees_list->emp_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->emp_name) ?>', 1);"><div id="elh_employees_emp_name" class="employees_emp_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->emp_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->emp_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->emp_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->emp_father->Visible) { // emp_father ?>
	<?php if ($employees_list->SortUrl($employees_list->emp_father) == "") { ?>
		<th data-name="emp_father" class="<?php echo $employees_list->emp_father->headerCellClass() ?>"><div id="elh_employees_emp_father" class="employees_emp_father"><div class="ew-table-header-caption"><?php echo $employees_list->emp_father->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="emp_father" class="<?php echo $employees_list->emp_father->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->emp_father) ?>', 1);"><div id="elh_employees_emp_father" class="employees_emp_father">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->emp_father->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->emp_father->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->emp_father->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->emp_cnic->Visible) { // emp_cnic ?>
	<?php if ($employees_list->SortUrl($employees_list->emp_cnic) == "") { ?>
		<th data-name="emp_cnic" class="<?php echo $employees_list->emp_cnic->headerCellClass() ?>"><div id="elh_employees_emp_cnic" class="employees_emp_cnic"><div class="ew-table-header-caption"><?php echo $employees_list->emp_cnic->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="emp_cnic" class="<?php echo $employees_list->emp_cnic->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->emp_cnic) ?>', 1);"><div id="elh_employees_emp_cnic" class="employees_emp_cnic">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->emp_cnic->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->emp_cnic->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->emp_cnic->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->emp_address->Visible) { // emp_address ?>
	<?php if ($employees_list->SortUrl($employees_list->emp_address) == "") { ?>
		<th data-name="emp_address" class="<?php echo $employees_list->emp_address->headerCellClass() ?>"><div id="elh_employees_emp_address" class="employees_emp_address"><div class="ew-table-header-caption"><?php echo $employees_list->emp_address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="emp_address" class="<?php echo $employees_list->emp_address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->emp_address) ?>', 1);"><div id="elh_employees_emp_address" class="employees_emp_address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->emp_address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->emp_address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->emp_address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->emp_contact->Visible) { // emp_contact ?>
	<?php if ($employees_list->SortUrl($employees_list->emp_contact) == "") { ?>
		<th data-name="emp_contact" class="<?php echo $employees_list->emp_contact->headerCellClass() ?>"><div id="elh_employees_emp_contact" class="employees_emp_contact"><div class="ew-table-header-caption"><?php echo $employees_list->emp_contact->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="emp_contact" class="<?php echo $employees_list->emp_contact->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->emp_contact) ?>', 1);"><div id="elh_employees_emp_contact" class="employees_emp_contact">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->emp_contact->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->emp_contact->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->emp_contact->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->emp_email->Visible) { // emp_email ?>
	<?php if ($employees_list->SortUrl($employees_list->emp_email) == "") { ?>
		<th data-name="emp_email" class="<?php echo $employees_list->emp_email->headerCellClass() ?>"><div id="elh_employees_emp_email" class="employees_emp_email"><div class="ew-table-header-caption"><?php echo $employees_list->emp_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="emp_email" class="<?php echo $employees_list->emp_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->emp_email) ?>', 1);"><div id="elh_employees_emp_email" class="employees_emp_email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->emp_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->emp_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->emp_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->emp_photo->Visible) { // emp_photo ?>
	<?php if ($employees_list->SortUrl($employees_list->emp_photo) == "") { ?>
		<th data-name="emp_photo" class="<?php echo $employees_list->emp_photo->headerCellClass() ?>"><div id="elh_employees_emp_photo" class="employees_emp_photo"><div class="ew-table-header-caption"><?php echo $employees_list->emp_photo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="emp_photo" class="<?php echo $employees_list->emp_photo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->emp_photo) ?>', 1);"><div id="elh_employees_emp_photo" class="employees_emp_photo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->emp_photo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->emp_photo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->emp_photo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employees_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employees_list->ExportAll && $employees_list->isExport()) {
	$employees_list->StopRecord = $employees_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employees_list->TotalRecords > $employees_list->StartRecord + $employees_list->DisplayRecords - 1)
		$employees_list->StopRecord = $employees_list->StartRecord + $employees_list->DisplayRecords - 1;
	else
		$employees_list->StopRecord = $employees_list->TotalRecords;
}
$employees_list->RecordCount = $employees_list->StartRecord - 1;
if ($employees_list->Recordset && !$employees_list->Recordset->EOF) {
	$employees_list->Recordset->moveFirst();
	$selectLimit = $employees_list->UseSelectLimit;
	if (!$selectLimit && $employees_list->StartRecord > 1)
		$employees_list->Recordset->move($employees_list->StartRecord - 1);
} elseif (!$employees->AllowAddDeleteRow && $employees_list->StopRecord == 0) {
	$employees_list->StopRecord = $employees->GridAddRowCount;
}

// Initialize aggregate
$employees->RowType = ROWTYPE_AGGREGATEINIT;
$employees->resetAttributes();
$employees_list->renderRow();
while ($employees_list->RecordCount < $employees_list->StopRecord) {
	$employees_list->RecordCount++;
	if ($employees_list->RecordCount >= $employees_list->StartRecord) {
		$employees_list->RowCount++;

		// Set up key count
		$employees_list->KeyCount = $employees_list->RowIndex;

		// Init row class and style
		$employees->resetAttributes();
		$employees->CssClass = "";
		if ($employees_list->isGridAdd()) {
		} else {
			$employees_list->loadRowValues($employees_list->Recordset); // Load row values
		}
		$employees->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$employees->RowAttrs->merge(["data-rowindex" => $employees_list->RowCount, "id" => "r" . $employees_list->RowCount . "_employees", "data-rowtype" => $employees->RowType]);

		// Render row
		$employees_list->renderRow();

		// Render list options
		$employees_list->renderListOptions();
?>
	<tr <?php echo $employees->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employees_list->ListOptions->render("body", "left", $employees_list->RowCount);
?>
	<?php if ($employees_list->emp_id->Visible) { // emp_id ?>
		<td data-name="emp_id" <?php echo $employees_list->emp_id->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_emp_id">
<span<?php echo $employees_list->emp_id->viewAttributes() ?>><?php echo $employees_list->emp_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->emp_branch_id->Visible) { // emp_branch_id ?>
		<td data-name="emp_branch_id" <?php echo $employees_list->emp_branch_id->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_emp_branch_id">
<span<?php echo $employees_list->emp_branch_id->viewAttributes() ?>><?php echo $employees_list->emp_branch_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->emp_designation_id->Visible) { // emp_designation_id ?>
		<td data-name="emp_designation_id" <?php echo $employees_list->emp_designation_id->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_emp_designation_id">
<span<?php echo $employees_list->emp_designation_id->viewAttributes() ?>><?php echo $employees_list->emp_designation_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->emp_city_id->Visible) { // emp_city_id ?>
		<td data-name="emp_city_id" <?php echo $employees_list->emp_city_id->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_emp_city_id">
<span<?php echo $employees_list->emp_city_id->viewAttributes() ?>><?php echo $employees_list->emp_city_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->emp_name->Visible) { // emp_name ?>
		<td data-name="emp_name" <?php echo $employees_list->emp_name->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_emp_name">
<span<?php echo $employees_list->emp_name->viewAttributes() ?>><?php echo $employees_list->emp_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->emp_father->Visible) { // emp_father ?>
		<td data-name="emp_father" <?php echo $employees_list->emp_father->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_emp_father">
<span<?php echo $employees_list->emp_father->viewAttributes() ?>><?php echo $employees_list->emp_father->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->emp_cnic->Visible) { // emp_cnic ?>
		<td data-name="emp_cnic" <?php echo $employees_list->emp_cnic->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_emp_cnic">
<span<?php echo $employees_list->emp_cnic->viewAttributes() ?>><?php echo $employees_list->emp_cnic->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->emp_address->Visible) { // emp_address ?>
		<td data-name="emp_address" <?php echo $employees_list->emp_address->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_emp_address">
<span<?php echo $employees_list->emp_address->viewAttributes() ?>><?php echo $employees_list->emp_address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->emp_contact->Visible) { // emp_contact ?>
		<td data-name="emp_contact" <?php echo $employees_list->emp_contact->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_emp_contact">
<span<?php echo $employees_list->emp_contact->viewAttributes() ?>><?php echo $employees_list->emp_contact->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->emp_email->Visible) { // emp_email ?>
		<td data-name="emp_email" <?php echo $employees_list->emp_email->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_emp_email">
<span<?php echo $employees_list->emp_email->viewAttributes() ?>><?php echo $employees_list->emp_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->emp_photo->Visible) { // emp_photo ?>
		<td data-name="emp_photo" <?php echo $employees_list->emp_photo->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_emp_photo">
<span><?php echo GetFileViewTag($employees_list->emp_photo, $employees_list->emp_photo->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employees_list->ListOptions->render("body", "right", $employees_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$employees_list->isGridAdd())
		$employees_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$employees->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employees_list->Recordset)
	$employees_list->Recordset->Close();
?>
<?php if (!$employees_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employees_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employees_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employees_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employees_list->TotalRecords == 0 && !$employees->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employees_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employees_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employees_list->isExport()) { ?>
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
$employees_list->terminate();
?>