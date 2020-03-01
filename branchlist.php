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
$branch_list = new branch_list();

// Run the page
$branch_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$branch_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$branch_list->isExport()) { ?>
<script>
var fbranchlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbranchlist = currentForm = new ew.Form("fbranchlist", "list");
	fbranchlist.formKeyCountName = '<?php echo $branch_list->FormKeyCountName ?>';
	loadjs.done("fbranchlist");
});
var fbranchlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbranchlistsrch = currentSearchForm = new ew.Form("fbranchlistsrch");

	// Dynamic selection lists
	// Filters

	fbranchlistsrch.filterList = <?php echo $branch_list->getFilterList() ?>;
	loadjs.done("fbranchlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$branch_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($branch_list->TotalRecords > 0 && $branch_list->ExportOptions->visible()) { ?>
<?php $branch_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($branch_list->ImportOptions->visible()) { ?>
<?php $branch_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($branch_list->SearchOptions->visible()) { ?>
<?php $branch_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($branch_list->FilterOptions->visible()) { ?>
<?php $branch_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$branch_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$branch_list->isExport() && !$branch->CurrentAction) { ?>
<form name="fbranchlistsrch" id="fbranchlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbranchlistsrch-search-panel" class="<?php echo $branch_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="branch">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $branch_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($branch_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($branch_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $branch_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($branch_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($branch_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($branch_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($branch_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $branch_list->showPageHeader(); ?>
<?php
$branch_list->showMessage();
?>
<?php if ($branch_list->TotalRecords > 0 || $branch->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$branch_list->isExport()) { ?>
<div>
<?php if (!$branch_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $branch_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $branch_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbranchlist" id="fbranchlist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="branch">
<div class="row ew-multi-column-row">
<?php if ($branch_list->TotalRecords > 0 || $branch_list->isGridEdit()) { ?>
<?php
if ($branch_list->ExportAll && $branch_list->isExport()) {
	$branch_list->StopRecord = $branch_list->TotalRecords;
} else {

	// Set the last record to display
	if ($branch_list->TotalRecords > $branch_list->StartRecord + $branch_list->DisplayRecords - 1)
		$branch_list->StopRecord = $branch_list->StartRecord + $branch_list->DisplayRecords - 1;
	else
		$branch_list->StopRecord = $branch_list->TotalRecords;
}
$branch_list->RecordCount = $branch_list->StartRecord - 1;
if ($branch_list->Recordset && !$branch_list->Recordset->EOF) {
	$branch_list->Recordset->moveFirst();
	$selectLimit = $branch_list->UseSelectLimit;
	if (!$selectLimit && $branch_list->StartRecord > 1)
		$branch_list->Recordset->move($branch_list->StartRecord - 1);
} elseif (!$branch->AllowAddDeleteRow && $branch_list->StopRecord == 0) {
	$branch_list->StopRecord = $branch->GridAddRowCount;
}
while ($branch_list->RecordCount < $branch_list->StopRecord) {
	$branch_list->RecordCount++;
	if ($branch_list->RecordCount >= $branch_list->StartRecord) {
		$branch_list->RowCount++;

		// Set up key count
		$branch_list->KeyCount = $branch_list->RowIndex;

		// Init row class and style
		$branch->resetAttributes();
		$branch->CssClass = "";
		if ($branch_list->isGridAdd()) {
		} else {
			$branch_list->loadRowValues($branch_list->Recordset); // Load row values
		}
		$branch->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$branch->RowAttrs->merge(["data-rowindex" => $branch_list->RowCount, "id" => "r" . $branch_list->RowCount . "_branch", "data-rowtype" => $branch->RowType]);

		// Render row
		$branch_list->renderRow();

		// Render list options
		$branch_list->renderListOptions();
?>
<div class="<?php echo $branch_list->getMultiColumnClass() ?>" <?php echo $branch->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($branch->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($branch_list->branch_id->Visible) { // branch_id ?>
		<?php if ($branch->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $branch_list->TableLeftColumnClass ?>"><span class="branch_branch_id">
<?php if ($branch_list->isExport() || $branch_list->SortUrl($branch_list->branch_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $branch_list->branch_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $branch_list->SortUrl($branch_list->branch_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $branch_list->branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($branch_list->branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($branch_list->branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $branch_list->branch_id->cellAttributes() ?>>
<span id="el<?php echo $branch_list->RowCount ?>_branch_branch_id">
<span<?php echo $branch_list->branch_id->viewAttributes() ?>><?php echo $branch_list->branch_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row branch_branch_id">
			<label class="<?php echo $branch_list->LeftColumnClass ?>"><?php echo $branch_list->branch_id->caption() ?></label>
			<div class="<?php echo $branch_list->RightColumnClass ?>"><div <?php echo $branch_list->branch_id->cellAttributes() ?>>
<span id="el<?php echo $branch_list->RowCount ?>_branch_branch_id">
<span<?php echo $branch_list->branch_id->viewAttributes() ?>><?php echo $branch_list->branch_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($branch_list->branch_org_id->Visible) { // branch_org_id ?>
		<?php if ($branch->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $branch_list->TableLeftColumnClass ?>"><span class="branch_branch_org_id">
<?php if ($branch_list->isExport() || $branch_list->SortUrl($branch_list->branch_org_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $branch_list->branch_org_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $branch_list->SortUrl($branch_list->branch_org_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $branch_list->branch_org_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($branch_list->branch_org_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($branch_list->branch_org_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $branch_list->branch_org_id->cellAttributes() ?>>
<span id="el<?php echo $branch_list->RowCount ?>_branch_branch_org_id">
<span<?php echo $branch_list->branch_org_id->viewAttributes() ?>><?php echo $branch_list->branch_org_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row branch_branch_org_id">
			<label class="<?php echo $branch_list->LeftColumnClass ?>"><?php echo $branch_list->branch_org_id->caption() ?></label>
			<div class="<?php echo $branch_list->RightColumnClass ?>"><div <?php echo $branch_list->branch_org_id->cellAttributes() ?>>
<span id="el<?php echo $branch_list->RowCount ?>_branch_branch_org_id">
<span<?php echo $branch_list->branch_org_id->viewAttributes() ?>><?php echo $branch_list->branch_org_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($branch_list->branch_name->Visible) { // branch_name ?>
		<?php if ($branch->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $branch_list->TableLeftColumnClass ?>"><span class="branch_branch_name">
<?php if ($branch_list->isExport() || $branch_list->SortUrl($branch_list->branch_name) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $branch_list->branch_name->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $branch_list->SortUrl($branch_list->branch_name) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $branch_list->branch_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($branch_list->branch_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($branch_list->branch_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $branch_list->branch_name->cellAttributes() ?>>
<span id="el<?php echo $branch_list->RowCount ?>_branch_branch_name">
<span<?php echo $branch_list->branch_name->viewAttributes() ?>><?php echo $branch_list->branch_name->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row branch_branch_name">
			<label class="<?php echo $branch_list->LeftColumnClass ?>"><?php echo $branch_list->branch_name->caption() ?></label>
			<div class="<?php echo $branch_list->RightColumnClass ?>"><div <?php echo $branch_list->branch_name->cellAttributes() ?>>
<span id="el<?php echo $branch_list->RowCount ?>_branch_branch_name">
<span<?php echo $branch_list->branch_name->viewAttributes() ?>><?php echo $branch_list->branch_name->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($branch_list->branch_manager->Visible) { // branch_manager ?>
		<?php if ($branch->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $branch_list->TableLeftColumnClass ?>"><span class="branch_branch_manager">
<?php if ($branch_list->isExport() || $branch_list->SortUrl($branch_list->branch_manager) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $branch_list->branch_manager->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $branch_list->SortUrl($branch_list->branch_manager) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $branch_list->branch_manager->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($branch_list->branch_manager->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($branch_list->branch_manager->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $branch_list->branch_manager->cellAttributes() ?>>
<span id="el<?php echo $branch_list->RowCount ?>_branch_branch_manager">
<span<?php echo $branch_list->branch_manager->viewAttributes() ?>><?php echo $branch_list->branch_manager->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row branch_branch_manager">
			<label class="<?php echo $branch_list->LeftColumnClass ?>"><?php echo $branch_list->branch_manager->caption() ?></label>
			<div class="<?php echo $branch_list->RightColumnClass ?>"><div <?php echo $branch_list->branch_manager->cellAttributes() ?>>
<span id="el<?php echo $branch_list->RowCount ?>_branch_branch_manager">
<span<?php echo $branch_list->branch_manager->viewAttributes() ?>><?php echo $branch_list->branch_manager->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($branch_list->branch_contact->Visible) { // branch_contact ?>
		<?php if ($branch->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $branch_list->TableLeftColumnClass ?>"><span class="branch_branch_contact">
<?php if ($branch_list->isExport() || $branch_list->SortUrl($branch_list->branch_contact) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $branch_list->branch_contact->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $branch_list->SortUrl($branch_list->branch_contact) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $branch_list->branch_contact->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($branch_list->branch_contact->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($branch_list->branch_contact->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $branch_list->branch_contact->cellAttributes() ?>>
<span id="el<?php echo $branch_list->RowCount ?>_branch_branch_contact">
<span<?php echo $branch_list->branch_contact->viewAttributes() ?>><?php echo $branch_list->branch_contact->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row branch_branch_contact">
			<label class="<?php echo $branch_list->LeftColumnClass ?>"><?php echo $branch_list->branch_contact->caption() ?></label>
			<div class="<?php echo $branch_list->RightColumnClass ?>"><div <?php echo $branch_list->branch_contact->cellAttributes() ?>>
<span id="el<?php echo $branch_list->RowCount ?>_branch_branch_contact">
<span<?php echo $branch_list->branch_contact->viewAttributes() ?>><?php echo $branch_list->branch_contact->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($branch_list->branch_address->Visible) { // branch_address ?>
		<?php if ($branch->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $branch_list->TableLeftColumnClass ?>"><span class="branch_branch_address">
<?php if ($branch_list->isExport() || $branch_list->SortUrl($branch_list->branch_address) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $branch_list->branch_address->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $branch_list->SortUrl($branch_list->branch_address) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $branch_list->branch_address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($branch_list->branch_address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($branch_list->branch_address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $branch_list->branch_address->cellAttributes() ?>>
<span id="el<?php echo $branch_list->RowCount ?>_branch_branch_address">
<span<?php echo $branch_list->branch_address->viewAttributes() ?>><?php echo $branch_list->branch_address->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row branch_branch_address">
			<label class="<?php echo $branch_list->LeftColumnClass ?>"><?php echo $branch_list->branch_address->caption() ?></label>
			<div class="<?php echo $branch_list->RightColumnClass ?>"><div <?php echo $branch_list->branch_address->cellAttributes() ?>>
<span id="el<?php echo $branch_list->RowCount ?>_branch_branch_address">
<span<?php echo $branch_list->branch_address->viewAttributes() ?>><?php echo $branch_list->branch_address->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($branch->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$branch_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$branch_list->ListOptions->render("body", "bottom", $branch_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$branch_list->isGridAdd())
		$branch_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$branch->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($branch_list->Recordset)
	$branch_list->Recordset->Close();
?>
<?php if (!$branch_list->isExport()) { ?>
<div>
<?php if (!$branch_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $branch_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $branch_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($branch_list->TotalRecords == 0 && !$branch->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $branch_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$branch_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$branch_list->isExport()) { ?>
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
$branch_list->terminate();
?>