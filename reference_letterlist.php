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
$reference_letter_list = new reference_letter_list();

// Run the page
$reference_letter_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$reference_letter_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$reference_letter_list->isExport()) { ?>
<script>
var freference_letterlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	freference_letterlist = currentForm = new ew.Form("freference_letterlist", "list");
	freference_letterlist.formKeyCountName = '<?php echo $reference_letter_list->FormKeyCountName ?>';
	loadjs.done("freference_letterlist");
});
var freference_letterlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	freference_letterlistsrch = currentSearchForm = new ew.Form("freference_letterlistsrch");

	// Dynamic selection lists
	// Filters

	freference_letterlistsrch.filterList = <?php echo $reference_letter_list->getFilterList() ?>;
	loadjs.done("freference_letterlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$reference_letter_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($reference_letter_list->TotalRecords > 0 && $reference_letter_list->ExportOptions->visible()) { ?>
<?php $reference_letter_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($reference_letter_list->ImportOptions->visible()) { ?>
<?php $reference_letter_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($reference_letter_list->SearchOptions->visible()) { ?>
<?php $reference_letter_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($reference_letter_list->FilterOptions->visible()) { ?>
<?php $reference_letter_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$reference_letter_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$reference_letter_list->isExport() && !$reference_letter->CurrentAction) { ?>
<form name="freference_letterlistsrch" id="freference_letterlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="freference_letterlistsrch-search-panel" class="<?php echo $reference_letter_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="reference_letter">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $reference_letter_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($reference_letter_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($reference_letter_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $reference_letter_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($reference_letter_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($reference_letter_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($reference_letter_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($reference_letter_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $reference_letter_list->showPageHeader(); ?>
<?php
$reference_letter_list->showMessage();
?>
<?php if ($reference_letter_list->TotalRecords > 0 || $reference_letter->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$reference_letter_list->isExport()) { ?>
<div>
<?php if (!$reference_letter_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $reference_letter_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $reference_letter_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="freference_letterlist" id="freference_letterlist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="reference_letter">
<div class="row ew-multi-column-row">
<?php if ($reference_letter_list->TotalRecords > 0 || $reference_letter_list->isGridEdit()) { ?>
<?php
if ($reference_letter_list->ExportAll && $reference_letter_list->isExport()) {
	$reference_letter_list->StopRecord = $reference_letter_list->TotalRecords;
} else {

	// Set the last record to display
	if ($reference_letter_list->TotalRecords > $reference_letter_list->StartRecord + $reference_letter_list->DisplayRecords - 1)
		$reference_letter_list->StopRecord = $reference_letter_list->StartRecord + $reference_letter_list->DisplayRecords - 1;
	else
		$reference_letter_list->StopRecord = $reference_letter_list->TotalRecords;
}
$reference_letter_list->RecordCount = $reference_letter_list->StartRecord - 1;
if ($reference_letter_list->Recordset && !$reference_letter_list->Recordset->EOF) {
	$reference_letter_list->Recordset->moveFirst();
	$selectLimit = $reference_letter_list->UseSelectLimit;
	if (!$selectLimit && $reference_letter_list->StartRecord > 1)
		$reference_letter_list->Recordset->move($reference_letter_list->StartRecord - 1);
} elseif (!$reference_letter->AllowAddDeleteRow && $reference_letter_list->StopRecord == 0) {
	$reference_letter_list->StopRecord = $reference_letter->GridAddRowCount;
}
while ($reference_letter_list->RecordCount < $reference_letter_list->StopRecord) {
	$reference_letter_list->RecordCount++;
	if ($reference_letter_list->RecordCount >= $reference_letter_list->StartRecord) {
		$reference_letter_list->RowCount++;

		// Set up key count
		$reference_letter_list->KeyCount = $reference_letter_list->RowIndex;

		// Init row class and style
		$reference_letter->resetAttributes();
		$reference_letter->CssClass = "";
		if ($reference_letter_list->isGridAdd()) {
		} else {
			$reference_letter_list->loadRowValues($reference_letter_list->Recordset); // Load row values
		}
		$reference_letter->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$reference_letter->RowAttrs->merge(["data-rowindex" => $reference_letter_list->RowCount, "id" => "r" . $reference_letter_list->RowCount . "_reference_letter", "data-rowtype" => $reference_letter->RowType]);

		// Render row
		$reference_letter_list->renderRow();

		// Render list options
		$reference_letter_list->renderListOptions();
?>
<div class="<?php echo $reference_letter_list->getMultiColumnClass() ?>" <?php echo $reference_letter->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($reference_letter->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($reference_letter_list->ref_letter_id->Visible) { // ref_letter_id ?>
		<?php if ($reference_letter->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $reference_letter_list->TableLeftColumnClass ?>"><span class="reference_letter_ref_letter_id">
<?php if ($reference_letter_list->isExport() || $reference_letter_list->SortUrl($reference_letter_list->ref_letter_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $reference_letter_list->ref_letter_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reference_letter_list->SortUrl($reference_letter_list->ref_letter_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reference_letter_list->ref_letter_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($reference_letter_list->ref_letter_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reference_letter_list->ref_letter_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $reference_letter_list->ref_letter_id->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_list->RowCount ?>_reference_letter_ref_letter_id">
<span<?php echo $reference_letter_list->ref_letter_id->viewAttributes() ?>><?php echo $reference_letter_list->ref_letter_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row reference_letter_ref_letter_id">
			<label class="<?php echo $reference_letter_list->LeftColumnClass ?>"><?php echo $reference_letter_list->ref_letter_id->caption() ?></label>
			<div class="<?php echo $reference_letter_list->RightColumnClass ?>"><div <?php echo $reference_letter_list->ref_letter_id->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_list->RowCount ?>_reference_letter_ref_letter_id">
<span<?php echo $reference_letter_list->ref_letter_id->viewAttributes() ?>><?php echo $reference_letter_list->ref_letter_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($reference_letter_list->ref_letter_branch_id->Visible) { // ref_letter_branch_id ?>
		<?php if ($reference_letter->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $reference_letter_list->TableLeftColumnClass ?>"><span class="reference_letter_ref_letter_branch_id">
<?php if ($reference_letter_list->isExport() || $reference_letter_list->SortUrl($reference_letter_list->ref_letter_branch_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $reference_letter_list->ref_letter_branch_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reference_letter_list->SortUrl($reference_letter_list->ref_letter_branch_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reference_letter_list->ref_letter_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($reference_letter_list->ref_letter_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reference_letter_list->ref_letter_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $reference_letter_list->ref_letter_branch_id->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_list->RowCount ?>_reference_letter_ref_letter_branch_id">
<span<?php echo $reference_letter_list->ref_letter_branch_id->viewAttributes() ?>><?php echo $reference_letter_list->ref_letter_branch_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row reference_letter_ref_letter_branch_id">
			<label class="<?php echo $reference_letter_list->LeftColumnClass ?>"><?php echo $reference_letter_list->ref_letter_branch_id->caption() ?></label>
			<div class="<?php echo $reference_letter_list->RightColumnClass ?>"><div <?php echo $reference_letter_list->ref_letter_branch_id->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_list->RowCount ?>_reference_letter_ref_letter_branch_id">
<span<?php echo $reference_letter_list->ref_letter_branch_id->viewAttributes() ?>><?php echo $reference_letter_list->ref_letter_branch_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($reference_letter_list->ref_letter_to_whom->Visible) { // ref_letter_to_whom ?>
		<?php if ($reference_letter->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $reference_letter_list->TableLeftColumnClass ?>"><span class="reference_letter_ref_letter_to_whom">
<?php if ($reference_letter_list->isExport() || $reference_letter_list->SortUrl($reference_letter_list->ref_letter_to_whom) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $reference_letter_list->ref_letter_to_whom->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reference_letter_list->SortUrl($reference_letter_list->ref_letter_to_whom) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reference_letter_list->ref_letter_to_whom->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($reference_letter_list->ref_letter_to_whom->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reference_letter_list->ref_letter_to_whom->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $reference_letter_list->ref_letter_to_whom->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_list->RowCount ?>_reference_letter_ref_letter_to_whom">
<span<?php echo $reference_letter_list->ref_letter_to_whom->viewAttributes() ?>><?php echo $reference_letter_list->ref_letter_to_whom->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row reference_letter_ref_letter_to_whom">
			<label class="<?php echo $reference_letter_list->LeftColumnClass ?>"><?php echo $reference_letter_list->ref_letter_to_whom->caption() ?></label>
			<div class="<?php echo $reference_letter_list->RightColumnClass ?>"><div <?php echo $reference_letter_list->ref_letter_to_whom->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_list->RowCount ?>_reference_letter_ref_letter_to_whom">
<span<?php echo $reference_letter_list->ref_letter_to_whom->viewAttributes() ?>><?php echo $reference_letter_list->ref_letter_to_whom->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($reference_letter_list->ref_letter_by_whom->Visible) { // ref_letter_by_whom ?>
		<?php if ($reference_letter->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $reference_letter_list->TableLeftColumnClass ?>"><span class="reference_letter_ref_letter_by_whom">
<?php if ($reference_letter_list->isExport() || $reference_letter_list->SortUrl($reference_letter_list->ref_letter_by_whom) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $reference_letter_list->ref_letter_by_whom->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reference_letter_list->SortUrl($reference_letter_list->ref_letter_by_whom) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reference_letter_list->ref_letter_by_whom->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($reference_letter_list->ref_letter_by_whom->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reference_letter_list->ref_letter_by_whom->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $reference_letter_list->ref_letter_by_whom->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_list->RowCount ?>_reference_letter_ref_letter_by_whom">
<span<?php echo $reference_letter_list->ref_letter_by_whom->viewAttributes() ?>><?php echo $reference_letter_list->ref_letter_by_whom->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row reference_letter_ref_letter_by_whom">
			<label class="<?php echo $reference_letter_list->LeftColumnClass ?>"><?php echo $reference_letter_list->ref_letter_by_whom->caption() ?></label>
			<div class="<?php echo $reference_letter_list->RightColumnClass ?>"><div <?php echo $reference_letter_list->ref_letter_by_whom->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_list->RowCount ?>_reference_letter_ref_letter_by_whom">
<span<?php echo $reference_letter_list->ref_letter_by_whom->viewAttributes() ?>><?php echo $reference_letter_list->ref_letter_by_whom->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($reference_letter_list->ref_letter_scanned->Visible) { // ref_letter_scanned ?>
		<?php if ($reference_letter->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $reference_letter_list->TableLeftColumnClass ?>"><span class="reference_letter_ref_letter_scanned">
<?php if ($reference_letter_list->isExport() || $reference_letter_list->SortUrl($reference_letter_list->ref_letter_scanned) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $reference_letter_list->ref_letter_scanned->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reference_letter_list->SortUrl($reference_letter_list->ref_letter_scanned) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reference_letter_list->ref_letter_scanned->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($reference_letter_list->ref_letter_scanned->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reference_letter_list->ref_letter_scanned->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $reference_letter_list->ref_letter_scanned->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_list->RowCount ?>_reference_letter_ref_letter_scanned">
<span><?php echo GetFileViewTag($reference_letter_list->ref_letter_scanned, $reference_letter_list->ref_letter_scanned->getViewValue(), FALSE) ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row reference_letter_ref_letter_scanned">
			<label class="<?php echo $reference_letter_list->LeftColumnClass ?>"><?php echo $reference_letter_list->ref_letter_scanned->caption() ?></label>
			<div class="<?php echo $reference_letter_list->RightColumnClass ?>"><div <?php echo $reference_letter_list->ref_letter_scanned->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_list->RowCount ?>_reference_letter_ref_letter_scanned">
<span><?php echo GetFileViewTag($reference_letter_list->ref_letter_scanned, $reference_letter_list->ref_letter_scanned->getViewValue(), FALSE) ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($reference_letter_list->ref_letter_date->Visible) { // ref_letter_date ?>
		<?php if ($reference_letter->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $reference_letter_list->TableLeftColumnClass ?>"><span class="reference_letter_ref_letter_date">
<?php if ($reference_letter_list->isExport() || $reference_letter_list->SortUrl($reference_letter_list->ref_letter_date) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $reference_letter_list->ref_letter_date->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reference_letter_list->SortUrl($reference_letter_list->ref_letter_date) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reference_letter_list->ref_letter_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($reference_letter_list->ref_letter_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reference_letter_list->ref_letter_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $reference_letter_list->ref_letter_date->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_list->RowCount ?>_reference_letter_ref_letter_date">
<span<?php echo $reference_letter_list->ref_letter_date->viewAttributes() ?>><?php echo $reference_letter_list->ref_letter_date->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row reference_letter_ref_letter_date">
			<label class="<?php echo $reference_letter_list->LeftColumnClass ?>"><?php echo $reference_letter_list->ref_letter_date->caption() ?></label>
			<div class="<?php echo $reference_letter_list->RightColumnClass ?>"><div <?php echo $reference_letter_list->ref_letter_date->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_list->RowCount ?>_reference_letter_ref_letter_date">
<span<?php echo $reference_letter_list->ref_letter_date->viewAttributes() ?>><?php echo $reference_letter_list->ref_letter_date->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($reference_letter->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$reference_letter_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$reference_letter_list->ListOptions->render("body", "bottom", $reference_letter_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$reference_letter_list->isGridAdd())
		$reference_letter_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$reference_letter->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($reference_letter_list->Recordset)
	$reference_letter_list->Recordset->Close();
?>
<?php if (!$reference_letter_list->isExport()) { ?>
<div>
<?php if (!$reference_letter_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $reference_letter_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $reference_letter_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($reference_letter_list->TotalRecords == 0 && !$reference_letter->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $reference_letter_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$reference_letter_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$reference_letter_list->isExport()) { ?>
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
$reference_letter_list->terminate();
?>