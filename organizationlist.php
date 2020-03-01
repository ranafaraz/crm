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
$organization_list = new organization_list();

// Run the page
$organization_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$organization_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$organization_list->isExport()) { ?>
<script>
var forganizationlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	forganizationlist = currentForm = new ew.Form("forganizationlist", "list");
	forganizationlist.formKeyCountName = '<?php echo $organization_list->FormKeyCountName ?>';
	loadjs.done("forganizationlist");
});
var forganizationlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	forganizationlistsrch = currentSearchForm = new ew.Form("forganizationlistsrch");

	// Dynamic selection lists
	// Filters

	forganizationlistsrch.filterList = <?php echo $organization_list->getFilterList() ?>;
	loadjs.done("forganizationlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$organization_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($organization_list->TotalRecords > 0 && $organization_list->ExportOptions->visible()) { ?>
<?php $organization_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($organization_list->ImportOptions->visible()) { ?>
<?php $organization_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($organization_list->SearchOptions->visible()) { ?>
<?php $organization_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($organization_list->FilterOptions->visible()) { ?>
<?php $organization_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$organization_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$organization_list->isExport() && !$organization->CurrentAction) { ?>
<form name="forganizationlistsrch" id="forganizationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="forganizationlistsrch-search-panel" class="<?php echo $organization_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="organization">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $organization_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($organization_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($organization_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $organization_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($organization_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($organization_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($organization_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($organization_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $organization_list->showPageHeader(); ?>
<?php
$organization_list->showMessage();
?>
<?php if ($organization_list->TotalRecords > 0 || $organization->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($organization_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> organization">
<?php if (!$organization_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$organization_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $organization_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $organization_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="forganizationlist" id="forganizationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="organization">
<div id="gmp_organization" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($organization_list->TotalRecords > 0 || $organization_list->isGridEdit()) { ?>
<table id="tbl_organizationlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$organization->RowType = ROWTYPE_HEADER;

// Render list options
$organization_list->renderListOptions();

// Render list options (header, left)
$organization_list->ListOptions->render("header", "left");
?>
<?php if ($organization_list->org_id->Visible) { // org_id ?>
	<?php if ($organization_list->SortUrl($organization_list->org_id) == "") { ?>
		<th data-name="org_id" class="<?php echo $organization_list->org_id->headerCellClass() ?>"><div id="elh_organization_org_id" class="organization_org_id"><div class="ew-table-header-caption"><?php echo $organization_list->org_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="org_id" class="<?php echo $organization_list->org_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $organization_list->SortUrl($organization_list->org_id) ?>', 1);"><div id="elh_organization_org_id" class="organization_org_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $organization_list->org_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($organization_list->org_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($organization_list->org_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($organization_list->org_city_id->Visible) { // org_city_id ?>
	<?php if ($organization_list->SortUrl($organization_list->org_city_id) == "") { ?>
		<th data-name="org_city_id" class="<?php echo $organization_list->org_city_id->headerCellClass() ?>"><div id="elh_organization_org_city_id" class="organization_org_city_id"><div class="ew-table-header-caption"><?php echo $organization_list->org_city_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="org_city_id" class="<?php echo $organization_list->org_city_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $organization_list->SortUrl($organization_list->org_city_id) ?>', 1);"><div id="elh_organization_org_city_id" class="organization_org_city_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $organization_list->org_city_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($organization_list->org_city_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($organization_list->org_city_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($organization_list->org_name->Visible) { // org_name ?>
	<?php if ($organization_list->SortUrl($organization_list->org_name) == "") { ?>
		<th data-name="org_name" class="<?php echo $organization_list->org_name->headerCellClass() ?>"><div id="elh_organization_org_name" class="organization_org_name"><div class="ew-table-header-caption"><?php echo $organization_list->org_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="org_name" class="<?php echo $organization_list->org_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $organization_list->SortUrl($organization_list->org_name) ?>', 1);"><div id="elh_organization_org_name" class="organization_org_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $organization_list->org_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($organization_list->org_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($organization_list->org_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($organization_list->org_head_office->Visible) { // org_head_office ?>
	<?php if ($organization_list->SortUrl($organization_list->org_head_office) == "") { ?>
		<th data-name="org_head_office" class="<?php echo $organization_list->org_head_office->headerCellClass() ?>"><div id="elh_organization_org_head_office" class="organization_org_head_office"><div class="ew-table-header-caption"><?php echo $organization_list->org_head_office->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="org_head_office" class="<?php echo $organization_list->org_head_office->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $organization_list->SortUrl($organization_list->org_head_office) ?>', 1);"><div id="elh_organization_org_head_office" class="organization_org_head_office">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $organization_list->org_head_office->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($organization_list->org_head_office->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($organization_list->org_head_office->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($organization_list->org_owner->Visible) { // org_owner ?>
	<?php if ($organization_list->SortUrl($organization_list->org_owner) == "") { ?>
		<th data-name="org_owner" class="<?php echo $organization_list->org_owner->headerCellClass() ?>"><div id="elh_organization_org_owner" class="organization_org_owner"><div class="ew-table-header-caption"><?php echo $organization_list->org_owner->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="org_owner" class="<?php echo $organization_list->org_owner->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $organization_list->SortUrl($organization_list->org_owner) ?>', 1);"><div id="elh_organization_org_owner" class="organization_org_owner">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $organization_list->org_owner->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($organization_list->org_owner->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($organization_list->org_owner->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($organization_list->org_contact_no->Visible) { // org_contact_no ?>
	<?php if ($organization_list->SortUrl($organization_list->org_contact_no) == "") { ?>
		<th data-name="org_contact_no" class="<?php echo $organization_list->org_contact_no->headerCellClass() ?>"><div id="elh_organization_org_contact_no" class="organization_org_contact_no"><div class="ew-table-header-caption"><?php echo $organization_list->org_contact_no->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="org_contact_no" class="<?php echo $organization_list->org_contact_no->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $organization_list->SortUrl($organization_list->org_contact_no) ?>', 1);"><div id="elh_organization_org_contact_no" class="organization_org_contact_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $organization_list->org_contact_no->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($organization_list->org_contact_no->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($organization_list->org_contact_no->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($organization_list->org_logo->Visible) { // org_logo ?>
	<?php if ($organization_list->SortUrl($organization_list->org_logo) == "") { ?>
		<th data-name="org_logo" class="<?php echo $organization_list->org_logo->headerCellClass() ?>"><div id="elh_organization_org_logo" class="organization_org_logo"><div class="ew-table-header-caption"><?php echo $organization_list->org_logo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="org_logo" class="<?php echo $organization_list->org_logo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $organization_list->SortUrl($organization_list->org_logo) ?>', 1);"><div id="elh_organization_org_logo" class="organization_org_logo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $organization_list->org_logo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($organization_list->org_logo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($organization_list->org_logo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($organization_list->org_bank_acc->Visible) { // org_bank_acc ?>
	<?php if ($organization_list->SortUrl($organization_list->org_bank_acc) == "") { ?>
		<th data-name="org_bank_acc" class="<?php echo $organization_list->org_bank_acc->headerCellClass() ?>"><div id="elh_organization_org_bank_acc" class="organization_org_bank_acc"><div class="ew-table-header-caption"><?php echo $organization_list->org_bank_acc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="org_bank_acc" class="<?php echo $organization_list->org_bank_acc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $organization_list->SortUrl($organization_list->org_bank_acc) ?>', 1);"><div id="elh_organization_org_bank_acc" class="organization_org_bank_acc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $organization_list->org_bank_acc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($organization_list->org_bank_acc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($organization_list->org_bank_acc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($organization_list->org_ntn->Visible) { // org_ntn ?>
	<?php if ($organization_list->SortUrl($organization_list->org_ntn) == "") { ?>
		<th data-name="org_ntn" class="<?php echo $organization_list->org_ntn->headerCellClass() ?>"><div id="elh_organization_org_ntn" class="organization_org_ntn"><div class="ew-table-header-caption"><?php echo $organization_list->org_ntn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="org_ntn" class="<?php echo $organization_list->org_ntn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $organization_list->SortUrl($organization_list->org_ntn) ?>', 1);"><div id="elh_organization_org_ntn" class="organization_org_ntn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $organization_list->org_ntn->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($organization_list->org_ntn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($organization_list->org_ntn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($organization_list->org_email->Visible) { // org_email ?>
	<?php if ($organization_list->SortUrl($organization_list->org_email) == "") { ?>
		<th data-name="org_email" class="<?php echo $organization_list->org_email->headerCellClass() ?>"><div id="elh_organization_org_email" class="organization_org_email"><div class="ew-table-header-caption"><?php echo $organization_list->org_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="org_email" class="<?php echo $organization_list->org_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $organization_list->SortUrl($organization_list->org_email) ?>', 1);"><div id="elh_organization_org_email" class="organization_org_email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $organization_list->org_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($organization_list->org_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($organization_list->org_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($organization_list->org_website->Visible) { // org_website ?>
	<?php if ($organization_list->SortUrl($organization_list->org_website) == "") { ?>
		<th data-name="org_website" class="<?php echo $organization_list->org_website->headerCellClass() ?>"><div id="elh_organization_org_website" class="organization_org_website"><div class="ew-table-header-caption"><?php echo $organization_list->org_website->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="org_website" class="<?php echo $organization_list->org_website->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $organization_list->SortUrl($organization_list->org_website) ?>', 1);"><div id="elh_organization_org_website" class="organization_org_website">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $organization_list->org_website->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($organization_list->org_website->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($organization_list->org_website->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$organization_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($organization_list->ExportAll && $organization_list->isExport()) {
	$organization_list->StopRecord = $organization_list->TotalRecords;
} else {

	// Set the last record to display
	if ($organization_list->TotalRecords > $organization_list->StartRecord + $organization_list->DisplayRecords - 1)
		$organization_list->StopRecord = $organization_list->StartRecord + $organization_list->DisplayRecords - 1;
	else
		$organization_list->StopRecord = $organization_list->TotalRecords;
}
$organization_list->RecordCount = $organization_list->StartRecord - 1;
if ($organization_list->Recordset && !$organization_list->Recordset->EOF) {
	$organization_list->Recordset->moveFirst();
	$selectLimit = $organization_list->UseSelectLimit;
	if (!$selectLimit && $organization_list->StartRecord > 1)
		$organization_list->Recordset->move($organization_list->StartRecord - 1);
} elseif (!$organization->AllowAddDeleteRow && $organization_list->StopRecord == 0) {
	$organization_list->StopRecord = $organization->GridAddRowCount;
}

// Initialize aggregate
$organization->RowType = ROWTYPE_AGGREGATEINIT;
$organization->resetAttributes();
$organization_list->renderRow();
while ($organization_list->RecordCount < $organization_list->StopRecord) {
	$organization_list->RecordCount++;
	if ($organization_list->RecordCount >= $organization_list->StartRecord) {
		$organization_list->RowCount++;

		// Set up key count
		$organization_list->KeyCount = $organization_list->RowIndex;

		// Init row class and style
		$organization->resetAttributes();
		$organization->CssClass = "";
		if ($organization_list->isGridAdd()) {
		} else {
			$organization_list->loadRowValues($organization_list->Recordset); // Load row values
		}
		$organization->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$organization->RowAttrs->merge(["data-rowindex" => $organization_list->RowCount, "id" => "r" . $organization_list->RowCount . "_organization", "data-rowtype" => $organization->RowType]);

		// Render row
		$organization_list->renderRow();

		// Render list options
		$organization_list->renderListOptions();
?>
	<tr <?php echo $organization->rowAttributes() ?>>
<?php

// Render list options (body, left)
$organization_list->ListOptions->render("body", "left", $organization_list->RowCount);
?>
	<?php if ($organization_list->org_id->Visible) { // org_id ?>
		<td data-name="org_id" <?php echo $organization_list->org_id->cellAttributes() ?>>
<span id="el<?php echo $organization_list->RowCount ?>_organization_org_id">
<span<?php echo $organization_list->org_id->viewAttributes() ?>><?php echo $organization_list->org_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($organization_list->org_city_id->Visible) { // org_city_id ?>
		<td data-name="org_city_id" <?php echo $organization_list->org_city_id->cellAttributes() ?>>
<span id="el<?php echo $organization_list->RowCount ?>_organization_org_city_id">
<span<?php echo $organization_list->org_city_id->viewAttributes() ?>><?php echo $organization_list->org_city_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($organization_list->org_name->Visible) { // org_name ?>
		<td data-name="org_name" <?php echo $organization_list->org_name->cellAttributes() ?>>
<span id="el<?php echo $organization_list->RowCount ?>_organization_org_name">
<span<?php echo $organization_list->org_name->viewAttributes() ?>><?php echo $organization_list->org_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($organization_list->org_head_office->Visible) { // org_head_office ?>
		<td data-name="org_head_office" <?php echo $organization_list->org_head_office->cellAttributes() ?>>
<span id="el<?php echo $organization_list->RowCount ?>_organization_org_head_office">
<span<?php echo $organization_list->org_head_office->viewAttributes() ?>><?php echo $organization_list->org_head_office->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($organization_list->org_owner->Visible) { // org_owner ?>
		<td data-name="org_owner" <?php echo $organization_list->org_owner->cellAttributes() ?>>
<span id="el<?php echo $organization_list->RowCount ?>_organization_org_owner">
<span<?php echo $organization_list->org_owner->viewAttributes() ?>><?php echo $organization_list->org_owner->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($organization_list->org_contact_no->Visible) { // org_contact_no ?>
		<td data-name="org_contact_no" <?php echo $organization_list->org_contact_no->cellAttributes() ?>>
<span id="el<?php echo $organization_list->RowCount ?>_organization_org_contact_no">
<span<?php echo $organization_list->org_contact_no->viewAttributes() ?>><?php echo $organization_list->org_contact_no->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($organization_list->org_logo->Visible) { // org_logo ?>
		<td data-name="org_logo" <?php echo $organization_list->org_logo->cellAttributes() ?>>
<span id="el<?php echo $organization_list->RowCount ?>_organization_org_logo">
<span><?php echo GetFileViewTag($organization_list->org_logo, $organization_list->org_logo->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($organization_list->org_bank_acc->Visible) { // org_bank_acc ?>
		<td data-name="org_bank_acc" <?php echo $organization_list->org_bank_acc->cellAttributes() ?>>
<span id="el<?php echo $organization_list->RowCount ?>_organization_org_bank_acc">
<span<?php echo $organization_list->org_bank_acc->viewAttributes() ?>><?php echo $organization_list->org_bank_acc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($organization_list->org_ntn->Visible) { // org_ntn ?>
		<td data-name="org_ntn" <?php echo $organization_list->org_ntn->cellAttributes() ?>>
<span id="el<?php echo $organization_list->RowCount ?>_organization_org_ntn">
<span<?php echo $organization_list->org_ntn->viewAttributes() ?>><?php echo $organization_list->org_ntn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($organization_list->org_email->Visible) { // org_email ?>
		<td data-name="org_email" <?php echo $organization_list->org_email->cellAttributes() ?>>
<span id="el<?php echo $organization_list->RowCount ?>_organization_org_email">
<span<?php echo $organization_list->org_email->viewAttributes() ?>><?php echo $organization_list->org_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($organization_list->org_website->Visible) { // org_website ?>
		<td data-name="org_website" <?php echo $organization_list->org_website->cellAttributes() ?>>
<span id="el<?php echo $organization_list->RowCount ?>_organization_org_website">
<span<?php echo $organization_list->org_website->viewAttributes() ?>><?php echo $organization_list->org_website->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$organization_list->ListOptions->render("body", "right", $organization_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$organization_list->isGridAdd())
		$organization_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$organization->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($organization_list->Recordset)
	$organization_list->Recordset->Close();
?>
<?php if (!$organization_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$organization_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $organization_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $organization_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($organization_list->TotalRecords == 0 && !$organization->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $organization_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$organization_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$organization_list->isExport()) { ?>
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
$organization_list->terminate();
?>