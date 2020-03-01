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
$acc_nature_list = new acc_nature_list();

// Run the page
$acc_nature_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acc_nature_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$acc_nature_list->isExport()) { ?>
<script>
var facc_naturelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	facc_naturelist = currentForm = new ew.Form("facc_naturelist", "list");
	facc_naturelist.formKeyCountName = '<?php echo $acc_nature_list->FormKeyCountName ?>';
	loadjs.done("facc_naturelist");
});
var facc_naturelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	facc_naturelistsrch = currentSearchForm = new ew.Form("facc_naturelistsrch");

	// Dynamic selection lists
	// Filters

	facc_naturelistsrch.filterList = <?php echo $acc_nature_list->getFilterList() ?>;
	loadjs.done("facc_naturelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$acc_nature_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($acc_nature_list->TotalRecords > 0 && $acc_nature_list->ExportOptions->visible()) { ?>
<?php $acc_nature_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($acc_nature_list->ImportOptions->visible()) { ?>
<?php $acc_nature_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($acc_nature_list->SearchOptions->visible()) { ?>
<?php $acc_nature_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($acc_nature_list->FilterOptions->visible()) { ?>
<?php $acc_nature_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$acc_nature_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$acc_nature_list->isExport() && !$acc_nature->CurrentAction) { ?>
<form name="facc_naturelistsrch" id="facc_naturelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="facc_naturelistsrch-search-panel" class="<?php echo $acc_nature_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="acc_nature">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $acc_nature_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($acc_nature_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($acc_nature_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $acc_nature_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($acc_nature_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($acc_nature_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($acc_nature_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($acc_nature_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $acc_nature_list->showPageHeader(); ?>
<?php
$acc_nature_list->showMessage();
?>
<?php if ($acc_nature_list->TotalRecords > 0 || $acc_nature->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$acc_nature_list->isExport()) { ?>
<div>
<?php if (!$acc_nature_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acc_nature_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $acc_nature_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="facc_naturelist" id="facc_naturelist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acc_nature">
<div class="row ew-multi-column-row">
<?php if ($acc_nature_list->TotalRecords > 0 || $acc_nature_list->isGridEdit()) { ?>
<?php
if ($acc_nature_list->ExportAll && $acc_nature_list->isExport()) {
	$acc_nature_list->StopRecord = $acc_nature_list->TotalRecords;
} else {

	// Set the last record to display
	if ($acc_nature_list->TotalRecords > $acc_nature_list->StartRecord + $acc_nature_list->DisplayRecords - 1)
		$acc_nature_list->StopRecord = $acc_nature_list->StartRecord + $acc_nature_list->DisplayRecords - 1;
	else
		$acc_nature_list->StopRecord = $acc_nature_list->TotalRecords;
}
$acc_nature_list->RecordCount = $acc_nature_list->StartRecord - 1;
if ($acc_nature_list->Recordset && !$acc_nature_list->Recordset->EOF) {
	$acc_nature_list->Recordset->moveFirst();
	$selectLimit = $acc_nature_list->UseSelectLimit;
	if (!$selectLimit && $acc_nature_list->StartRecord > 1)
		$acc_nature_list->Recordset->move($acc_nature_list->StartRecord - 1);
} elseif (!$acc_nature->AllowAddDeleteRow && $acc_nature_list->StopRecord == 0) {
	$acc_nature_list->StopRecord = $acc_nature->GridAddRowCount;
}
while ($acc_nature_list->RecordCount < $acc_nature_list->StopRecord) {
	$acc_nature_list->RecordCount++;
	if ($acc_nature_list->RecordCount >= $acc_nature_list->StartRecord) {
		$acc_nature_list->RowCount++;

		// Set up key count
		$acc_nature_list->KeyCount = $acc_nature_list->RowIndex;

		// Init row class and style
		$acc_nature->resetAttributes();
		$acc_nature->CssClass = "";
		if ($acc_nature_list->isGridAdd()) {
		} else {
			$acc_nature_list->loadRowValues($acc_nature_list->Recordset); // Load row values
		}
		$acc_nature->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$acc_nature->RowAttrs->merge(["data-rowindex" => $acc_nature_list->RowCount, "id" => "r" . $acc_nature_list->RowCount . "_acc_nature", "data-rowtype" => $acc_nature->RowType]);

		// Render row
		$acc_nature_list->renderRow();

		// Render list options
		$acc_nature_list->renderListOptions();
?>
<div class="<?php echo $acc_nature_list->getMultiColumnClass() ?>" <?php echo $acc_nature->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($acc_nature->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($acc_nature_list->acc_nature_id->Visible) { // acc_nature_id ?>
		<?php if ($acc_nature->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $acc_nature_list->TableLeftColumnClass ?>"><span class="acc_nature_acc_nature_id">
<?php if ($acc_nature_list->isExport() || $acc_nature_list->SortUrl($acc_nature_list->acc_nature_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $acc_nature_list->acc_nature_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acc_nature_list->SortUrl($acc_nature_list->acc_nature_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acc_nature_list->acc_nature_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($acc_nature_list->acc_nature_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acc_nature_list->acc_nature_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $acc_nature_list->acc_nature_id->cellAttributes() ?>>
<span id="el<?php echo $acc_nature_list->RowCount ?>_acc_nature_acc_nature_id">
<span<?php echo $acc_nature_list->acc_nature_id->viewAttributes() ?>><?php echo $acc_nature_list->acc_nature_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row acc_nature_acc_nature_id">
			<label class="<?php echo $acc_nature_list->LeftColumnClass ?>"><?php echo $acc_nature_list->acc_nature_id->caption() ?></label>
			<div class="<?php echo $acc_nature_list->RightColumnClass ?>"><div <?php echo $acc_nature_list->acc_nature_id->cellAttributes() ?>>
<span id="el<?php echo $acc_nature_list->RowCount ?>_acc_nature_acc_nature_id">
<span<?php echo $acc_nature_list->acc_nature_id->viewAttributes() ?>><?php echo $acc_nature_list->acc_nature_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($acc_nature_list->acc_nature_name->Visible) { // acc_nature_name ?>
		<?php if ($acc_nature->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $acc_nature_list->TableLeftColumnClass ?>"><span class="acc_nature_acc_nature_name">
<?php if ($acc_nature_list->isExport() || $acc_nature_list->SortUrl($acc_nature_list->acc_nature_name) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $acc_nature_list->acc_nature_name->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acc_nature_list->SortUrl($acc_nature_list->acc_nature_name) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acc_nature_list->acc_nature_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($acc_nature_list->acc_nature_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acc_nature_list->acc_nature_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $acc_nature_list->acc_nature_name->cellAttributes() ?>>
<span id="el<?php echo $acc_nature_list->RowCount ?>_acc_nature_acc_nature_name">
<span<?php echo $acc_nature_list->acc_nature_name->viewAttributes() ?>><?php echo $acc_nature_list->acc_nature_name->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row acc_nature_acc_nature_name">
			<label class="<?php echo $acc_nature_list->LeftColumnClass ?>"><?php echo $acc_nature_list->acc_nature_name->caption() ?></label>
			<div class="<?php echo $acc_nature_list->RightColumnClass ?>"><div <?php echo $acc_nature_list->acc_nature_name->cellAttributes() ?>>
<span id="el<?php echo $acc_nature_list->RowCount ?>_acc_nature_acc_nature_name">
<span<?php echo $acc_nature_list->acc_nature_name->viewAttributes() ?>><?php echo $acc_nature_list->acc_nature_name->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($acc_nature->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$acc_nature_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$acc_nature_list->ListOptions->render("body", "bottom", $acc_nature_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$acc_nature_list->isGridAdd())
		$acc_nature_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$acc_nature->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($acc_nature_list->Recordset)
	$acc_nature_list->Recordset->Close();
?>
<?php if (!$acc_nature_list->isExport()) { ?>
<div>
<?php if (!$acc_nature_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acc_nature_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $acc_nature_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($acc_nature_list->TotalRecords == 0 && !$acc_nature->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $acc_nature_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$acc_nature_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$acc_nature_list->isExport()) { ?>
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
$acc_nature_list->terminate();
?>