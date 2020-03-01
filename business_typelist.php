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
$business_type_list = new business_type_list();

// Run the page
$business_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$business_type_list->isExport()) { ?>
<script>
var fbusiness_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbusiness_typelist = currentForm = new ew.Form("fbusiness_typelist", "list");
	fbusiness_typelist.formKeyCountName = '<?php echo $business_type_list->FormKeyCountName ?>';
	loadjs.done("fbusiness_typelist");
});
var fbusiness_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbusiness_typelistsrch = currentSearchForm = new ew.Form("fbusiness_typelistsrch");

	// Dynamic selection lists
	// Filters

	fbusiness_typelistsrch.filterList = <?php echo $business_type_list->getFilterList() ?>;
	loadjs.done("fbusiness_typelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$business_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($business_type_list->TotalRecords > 0 && $business_type_list->ExportOptions->visible()) { ?>
<?php $business_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($business_type_list->ImportOptions->visible()) { ?>
<?php $business_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($business_type_list->SearchOptions->visible()) { ?>
<?php $business_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($business_type_list->FilterOptions->visible()) { ?>
<?php $business_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$business_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$business_type_list->isExport() && !$business_type->CurrentAction) { ?>
<form name="fbusiness_typelistsrch" id="fbusiness_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbusiness_typelistsrch-search-panel" class="<?php echo $business_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="business_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $business_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($business_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($business_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $business_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($business_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($business_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($business_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($business_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $business_type_list->showPageHeader(); ?>
<?php
$business_type_list->showMessage();
?>
<?php if ($business_type_list->TotalRecords > 0 || $business_type->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$business_type_list->isExport()) { ?>
<div>
<?php if (!$business_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $business_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $business_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbusiness_typelist" id="fbusiness_typelist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_type">
<div class="row ew-multi-column-row">
<?php if ($business_type_list->TotalRecords > 0 || $business_type_list->isGridEdit()) { ?>
<?php
if ($business_type_list->ExportAll && $business_type_list->isExport()) {
	$business_type_list->StopRecord = $business_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($business_type_list->TotalRecords > $business_type_list->StartRecord + $business_type_list->DisplayRecords - 1)
		$business_type_list->StopRecord = $business_type_list->StartRecord + $business_type_list->DisplayRecords - 1;
	else
		$business_type_list->StopRecord = $business_type_list->TotalRecords;
}
$business_type_list->RecordCount = $business_type_list->StartRecord - 1;
if ($business_type_list->Recordset && !$business_type_list->Recordset->EOF) {
	$business_type_list->Recordset->moveFirst();
	$selectLimit = $business_type_list->UseSelectLimit;
	if (!$selectLimit && $business_type_list->StartRecord > 1)
		$business_type_list->Recordset->move($business_type_list->StartRecord - 1);
} elseif (!$business_type->AllowAddDeleteRow && $business_type_list->StopRecord == 0) {
	$business_type_list->StopRecord = $business_type->GridAddRowCount;
}
while ($business_type_list->RecordCount < $business_type_list->StopRecord) {
	$business_type_list->RecordCount++;
	if ($business_type_list->RecordCount >= $business_type_list->StartRecord) {
		$business_type_list->RowCount++;

		// Set up key count
		$business_type_list->KeyCount = $business_type_list->RowIndex;

		// Init row class and style
		$business_type->resetAttributes();
		$business_type->CssClass = "";
		if ($business_type_list->isGridAdd()) {
		} else {
			$business_type_list->loadRowValues($business_type_list->Recordset); // Load row values
		}
		$business_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$business_type->RowAttrs->merge(["data-rowindex" => $business_type_list->RowCount, "id" => "r" . $business_type_list->RowCount . "_business_type", "data-rowtype" => $business_type->RowType]);

		// Render row
		$business_type_list->renderRow();

		// Render list options
		$business_type_list->renderListOptions();
?>
<div class="<?php echo $business_type_list->getMultiColumnClass() ?>" <?php echo $business_type->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($business_type->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($business_type_list->business_type_id->Visible) { // business_type_id ?>
		<?php if ($business_type->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_type_list->TableLeftColumnClass ?>"><span class="business_type_business_type_id">
<?php if ($business_type_list->isExport() || $business_type_list->SortUrl($business_type_list->business_type_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_type_list->business_type_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_type_list->SortUrl($business_type_list->business_type_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_type_list->business_type_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_type_list->business_type_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_type_list->business_type_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_type_list->business_type_id->cellAttributes() ?>>
<span id="el<?php echo $business_type_list->RowCount ?>_business_type_business_type_id">
<span<?php echo $business_type_list->business_type_id->viewAttributes() ?>><?php echo $business_type_list->business_type_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_type_business_type_id">
			<label class="<?php echo $business_type_list->LeftColumnClass ?>"><?php echo $business_type_list->business_type_id->caption() ?></label>
			<div class="<?php echo $business_type_list->RightColumnClass ?>"><div <?php echo $business_type_list->business_type_id->cellAttributes() ?>>
<span id="el<?php echo $business_type_list->RowCount ?>_business_type_business_type_id">
<span<?php echo $business_type_list->business_type_id->viewAttributes() ?>><?php echo $business_type_list->business_type_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_type_list->business_type_name->Visible) { // business_type_name ?>
		<?php if ($business_type->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_type_list->TableLeftColumnClass ?>"><span class="business_type_business_type_name">
<?php if ($business_type_list->isExport() || $business_type_list->SortUrl($business_type_list->business_type_name) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_type_list->business_type_name->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_type_list->SortUrl($business_type_list->business_type_name) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_type_list->business_type_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_type_list->business_type_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_type_list->business_type_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_type_list->business_type_name->cellAttributes() ?>>
<span id="el<?php echo $business_type_list->RowCount ?>_business_type_business_type_name">
<span<?php echo $business_type_list->business_type_name->viewAttributes() ?>><?php echo $business_type_list->business_type_name->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_type_business_type_name">
			<label class="<?php echo $business_type_list->LeftColumnClass ?>"><?php echo $business_type_list->business_type_name->caption() ?></label>
			<div class="<?php echo $business_type_list->RightColumnClass ?>"><div <?php echo $business_type_list->business_type_name->cellAttributes() ?>>
<span id="el<?php echo $business_type_list->RowCount ?>_business_type_business_type_name">
<span<?php echo $business_type_list->business_type_name->viewAttributes() ?>><?php echo $business_type_list->business_type_name->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_type_list->business_type_desc->Visible) { // business_type_desc ?>
		<?php if ($business_type->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $business_type_list->TableLeftColumnClass ?>"><span class="business_type_business_type_desc">
<?php if ($business_type_list->isExport() || $business_type_list->SortUrl($business_type_list->business_type_desc) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $business_type_list->business_type_desc->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_type_list->SortUrl($business_type_list->business_type_desc) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_type_list->business_type_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_type_list->business_type_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_type_list->business_type_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $business_type_list->business_type_desc->cellAttributes() ?>>
<span id="el<?php echo $business_type_list->RowCount ?>_business_type_business_type_desc">
<span<?php echo $business_type_list->business_type_desc->viewAttributes() ?>><?php echo $business_type_list->business_type_desc->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row business_type_business_type_desc">
			<label class="<?php echo $business_type_list->LeftColumnClass ?>"><?php echo $business_type_list->business_type_desc->caption() ?></label>
			<div class="<?php echo $business_type_list->RightColumnClass ?>"><div <?php echo $business_type_list->business_type_desc->cellAttributes() ?>>
<span id="el<?php echo $business_type_list->RowCount ?>_business_type_business_type_desc">
<span<?php echo $business_type_list->business_type_desc->viewAttributes() ?>><?php echo $business_type_list->business_type_desc->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($business_type->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$business_type_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$business_type_list->ListOptions->render("body", "bottom", $business_type_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$business_type_list->isGridAdd())
		$business_type_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$business_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($business_type_list->Recordset)
	$business_type_list->Recordset->Close();
?>
<?php if (!$business_type_list->isExport()) { ?>
<div>
<?php if (!$business_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $business_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $business_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($business_type_list->TotalRecords == 0 && !$business_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $business_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$business_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$business_type_list->isExport()) { ?>
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
$business_type_list->terminate();
?>