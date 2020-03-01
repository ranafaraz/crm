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
$services_list = new services_list();

// Run the page
$services_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$services_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$services_list->isExport()) { ?>
<script>
var fserviceslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fserviceslist = currentForm = new ew.Form("fserviceslist", "list");
	fserviceslist.formKeyCountName = '<?php echo $services_list->FormKeyCountName ?>';
	loadjs.done("fserviceslist");
});
var fserviceslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fserviceslistsrch = currentSearchForm = new ew.Form("fserviceslistsrch");

	// Dynamic selection lists
	// Filters

	fserviceslistsrch.filterList = <?php echo $services_list->getFilterList() ?>;
	loadjs.done("fserviceslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$services_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($services_list->TotalRecords > 0 && $services_list->ExportOptions->visible()) { ?>
<?php $services_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($services_list->ImportOptions->visible()) { ?>
<?php $services_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($services_list->SearchOptions->visible()) { ?>
<?php $services_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($services_list->FilterOptions->visible()) { ?>
<?php $services_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$services_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$services_list->isExport() && !$services->CurrentAction) { ?>
<form name="fserviceslistsrch" id="fserviceslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fserviceslistsrch-search-panel" class="<?php echo $services_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="services">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $services_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($services_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($services_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $services_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($services_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($services_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($services_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($services_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $services_list->showPageHeader(); ?>
<?php
$services_list->showMessage();
?>
<?php if ($services_list->TotalRecords > 0 || $services->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$services_list->isExport()) { ?>
<div>
<?php if (!$services_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $services_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $services_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fserviceslist" id="fserviceslist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="services">
<div class="row ew-multi-column-row">
<?php if ($services_list->TotalRecords > 0 || $services_list->isGridEdit()) { ?>
<?php
if ($services_list->ExportAll && $services_list->isExport()) {
	$services_list->StopRecord = $services_list->TotalRecords;
} else {

	// Set the last record to display
	if ($services_list->TotalRecords > $services_list->StartRecord + $services_list->DisplayRecords - 1)
		$services_list->StopRecord = $services_list->StartRecord + $services_list->DisplayRecords - 1;
	else
		$services_list->StopRecord = $services_list->TotalRecords;
}
$services_list->RecordCount = $services_list->StartRecord - 1;
if ($services_list->Recordset && !$services_list->Recordset->EOF) {
	$services_list->Recordset->moveFirst();
	$selectLimit = $services_list->UseSelectLimit;
	if (!$selectLimit && $services_list->StartRecord > 1)
		$services_list->Recordset->move($services_list->StartRecord - 1);
} elseif (!$services->AllowAddDeleteRow && $services_list->StopRecord == 0) {
	$services_list->StopRecord = $services->GridAddRowCount;
}
while ($services_list->RecordCount < $services_list->StopRecord) {
	$services_list->RecordCount++;
	if ($services_list->RecordCount >= $services_list->StartRecord) {
		$services_list->RowCount++;

		// Set up key count
		$services_list->KeyCount = $services_list->RowIndex;

		// Init row class and style
		$services->resetAttributes();
		$services->CssClass = "";
		if ($services_list->isGridAdd()) {
		} else {
			$services_list->loadRowValues($services_list->Recordset); // Load row values
		}
		$services->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$services->RowAttrs->merge(["data-rowindex" => $services_list->RowCount, "id" => "r" . $services_list->RowCount . "_services", "data-rowtype" => $services->RowType]);

		// Render row
		$services_list->renderRow();

		// Render list options
		$services_list->renderListOptions();
?>
<div class="<?php echo $services_list->getMultiColumnClass() ?>" <?php echo $services->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($services->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($services_list->service_id->Visible) { // service_id ?>
		<?php if ($services->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $services_list->TableLeftColumnClass ?>"><span class="services_service_id">
<?php if ($services_list->isExport() || $services_list->SortUrl($services_list->service_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $services_list->service_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_list->SortUrl($services_list->service_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_list->service_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_list->service_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_list->service_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $services_list->service_id->cellAttributes() ?>>
<span id="el<?php echo $services_list->RowCount ?>_services_service_id">
<span<?php echo $services_list->service_id->viewAttributes() ?>><?php echo $services_list->service_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row services_service_id">
			<label class="<?php echo $services_list->LeftColumnClass ?>"><?php echo $services_list->service_id->caption() ?></label>
			<div class="<?php echo $services_list->RightColumnClass ?>"><div <?php echo $services_list->service_id->cellAttributes() ?>>
<span id="el<?php echo $services_list->RowCount ?>_services_service_id">
<span<?php echo $services_list->service_id->viewAttributes() ?>><?php echo $services_list->service_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($services_list->service_branch_id->Visible) { // service_branch_id ?>
		<?php if ($services->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $services_list->TableLeftColumnClass ?>"><span class="services_service_branch_id">
<?php if ($services_list->isExport() || $services_list->SortUrl($services_list->service_branch_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $services_list->service_branch_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_list->SortUrl($services_list->service_branch_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_list->service_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_list->service_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_list->service_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $services_list->service_branch_id->cellAttributes() ?>>
<span id="el<?php echo $services_list->RowCount ?>_services_service_branch_id">
<span<?php echo $services_list->service_branch_id->viewAttributes() ?>><?php echo $services_list->service_branch_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row services_service_branch_id">
			<label class="<?php echo $services_list->LeftColumnClass ?>"><?php echo $services_list->service_branch_id->caption() ?></label>
			<div class="<?php echo $services_list->RightColumnClass ?>"><div <?php echo $services_list->service_branch_id->cellAttributes() ?>>
<span id="el<?php echo $services_list->RowCount ?>_services_service_branch_id">
<span<?php echo $services_list->service_branch_id->viewAttributes() ?>><?php echo $services_list->service_branch_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($services_list->service_caption->Visible) { // service_caption ?>
		<?php if ($services->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $services_list->TableLeftColumnClass ?>"><span class="services_service_caption">
<?php if ($services_list->isExport() || $services_list->SortUrl($services_list->service_caption) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $services_list->service_caption->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_list->SortUrl($services_list->service_caption) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_list->service_caption->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($services_list->service_caption->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_list->service_caption->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $services_list->service_caption->cellAttributes() ?>>
<span id="el<?php echo $services_list->RowCount ?>_services_service_caption">
<span<?php echo $services_list->service_caption->viewAttributes() ?>><?php echo $services_list->service_caption->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row services_service_caption">
			<label class="<?php echo $services_list->LeftColumnClass ?>"><?php echo $services_list->service_caption->caption() ?></label>
			<div class="<?php echo $services_list->RightColumnClass ?>"><div <?php echo $services_list->service_caption->cellAttributes() ?>>
<span id="el<?php echo $services_list->RowCount ?>_services_service_caption">
<span<?php echo $services_list->service_caption->viewAttributes() ?>><?php echo $services_list->service_caption->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($services_list->service_desc->Visible) { // service_desc ?>
		<?php if ($services->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $services_list->TableLeftColumnClass ?>"><span class="services_service_desc">
<?php if ($services_list->isExport() || $services_list->SortUrl($services_list->service_desc) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $services_list->service_desc->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_list->SortUrl($services_list->service_desc) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_list->service_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($services_list->service_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_list->service_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $services_list->service_desc->cellAttributes() ?>>
<span id="el<?php echo $services_list->RowCount ?>_services_service_desc">
<span<?php echo $services_list->service_desc->viewAttributes() ?>><?php echo $services_list->service_desc->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row services_service_desc">
			<label class="<?php echo $services_list->LeftColumnClass ?>"><?php echo $services_list->service_desc->caption() ?></label>
			<div class="<?php echo $services_list->RightColumnClass ?>"><div <?php echo $services_list->service_desc->cellAttributes() ?>>
<span id="el<?php echo $services_list->RowCount ?>_services_service_desc">
<span<?php echo $services_list->service_desc->viewAttributes() ?>><?php echo $services_list->service_desc->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($services_list->service_logo->Visible) { // service_logo ?>
		<?php if ($services->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $services_list->TableLeftColumnClass ?>"><span class="services_service_logo">
<?php if ($services_list->isExport() || $services_list->SortUrl($services_list->service_logo) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $services_list->service_logo->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_list->SortUrl($services_list->service_logo) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_list->service_logo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($services_list->service_logo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_list->service_logo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $services_list->service_logo->cellAttributes() ?>>
<span id="el<?php echo $services_list->RowCount ?>_services_service_logo">
<span><?php echo GetFileViewTag($services_list->service_logo, $services_list->service_logo->getViewValue(), FALSE) ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row services_service_logo">
			<label class="<?php echo $services_list->LeftColumnClass ?>"><?php echo $services_list->service_logo->caption() ?></label>
			<div class="<?php echo $services_list->RightColumnClass ?>"><div <?php echo $services_list->service_logo->cellAttributes() ?>>
<span id="el<?php echo $services_list->RowCount ?>_services_service_logo">
<span><?php echo GetFileViewTag($services_list->service_logo, $services_list->service_logo->getViewValue(), FALSE) ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($services->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$services_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$services_list->ListOptions->render("body", "bottom", $services_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$services_list->isGridAdd())
		$services_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$services->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($services_list->Recordset)
	$services_list->Recordset->Close();
?>
<?php if (!$services_list->isExport()) { ?>
<div>
<?php if (!$services_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $services_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $services_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($services_list->TotalRecords == 0 && !$services->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $services_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$services_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$services_list->isExport()) { ?>
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
$services_list->terminate();
?>