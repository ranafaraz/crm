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
$sms_api_list = new sms_api_list();

// Run the page
$sms_api_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_api_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sms_api_list->isExport()) { ?>
<script>
var fsms_apilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsms_apilist = currentForm = new ew.Form("fsms_apilist", "list");
	fsms_apilist.formKeyCountName = '<?php echo $sms_api_list->FormKeyCountName ?>';
	loadjs.done("fsms_apilist");
});
var fsms_apilistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsms_apilistsrch = currentSearchForm = new ew.Form("fsms_apilistsrch");

	// Dynamic selection lists
	// Filters

	fsms_apilistsrch.filterList = <?php echo $sms_api_list->getFilterList() ?>;
	loadjs.done("fsms_apilistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sms_api_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($sms_api_list->TotalRecords > 0 && $sms_api_list->ExportOptions->visible()) { ?>
<?php $sms_api_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($sms_api_list->ImportOptions->visible()) { ?>
<?php $sms_api_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($sms_api_list->SearchOptions->visible()) { ?>
<?php $sms_api_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($sms_api_list->FilterOptions->visible()) { ?>
<?php $sms_api_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$sms_api_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$sms_api_list->isExport() && !$sms_api->CurrentAction) { ?>
<form name="fsms_apilistsrch" id="fsms_apilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsms_apilistsrch-search-panel" class="<?php echo $sms_api_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="sms_api">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $sms_api_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($sms_api_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($sms_api_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $sms_api_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($sms_api_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($sms_api_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($sms_api_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($sms_api_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $sms_api_list->showPageHeader(); ?>
<?php
$sms_api_list->showMessage();
?>
<?php if ($sms_api_list->TotalRecords > 0 || $sms_api->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$sms_api_list->isExport()) { ?>
<div>
<?php if (!$sms_api_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sms_api_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sms_api_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsms_apilist" id="fsms_apilist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_api">
<div class="row ew-multi-column-row">
<?php if ($sms_api_list->TotalRecords > 0 || $sms_api_list->isGridEdit()) { ?>
<?php
if ($sms_api_list->ExportAll && $sms_api_list->isExport()) {
	$sms_api_list->StopRecord = $sms_api_list->TotalRecords;
} else {

	// Set the last record to display
	if ($sms_api_list->TotalRecords > $sms_api_list->StartRecord + $sms_api_list->DisplayRecords - 1)
		$sms_api_list->StopRecord = $sms_api_list->StartRecord + $sms_api_list->DisplayRecords - 1;
	else
		$sms_api_list->StopRecord = $sms_api_list->TotalRecords;
}
$sms_api_list->RecordCount = $sms_api_list->StartRecord - 1;
if ($sms_api_list->Recordset && !$sms_api_list->Recordset->EOF) {
	$sms_api_list->Recordset->moveFirst();
	$selectLimit = $sms_api_list->UseSelectLimit;
	if (!$selectLimit && $sms_api_list->StartRecord > 1)
		$sms_api_list->Recordset->move($sms_api_list->StartRecord - 1);
} elseif (!$sms_api->AllowAddDeleteRow && $sms_api_list->StopRecord == 0) {
	$sms_api_list->StopRecord = $sms_api->GridAddRowCount;
}
while ($sms_api_list->RecordCount < $sms_api_list->StopRecord) {
	$sms_api_list->RecordCount++;
	if ($sms_api_list->RecordCount >= $sms_api_list->StartRecord) {
		$sms_api_list->RowCount++;

		// Set up key count
		$sms_api_list->KeyCount = $sms_api_list->RowIndex;

		// Init row class and style
		$sms_api->resetAttributes();
		$sms_api->CssClass = "";
		if ($sms_api_list->isGridAdd()) {
		} else {
			$sms_api_list->loadRowValues($sms_api_list->Recordset); // Load row values
		}
		$sms_api->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$sms_api->RowAttrs->merge(["data-rowindex" => $sms_api_list->RowCount, "id" => "r" . $sms_api_list->RowCount . "_sms_api", "data-rowtype" => $sms_api->RowType]);

		// Render row
		$sms_api_list->renderRow();

		// Render list options
		$sms_api_list->renderListOptions();
?>
<div class="<?php echo $sms_api_list->getMultiColumnClass() ?>" <?php echo $sms_api->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($sms_api->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($sms_api_list->sms_api_id->Visible) { // sms_api_id ?>
		<?php if ($sms_api->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_api_list->TableLeftColumnClass ?>"><span class="sms_api_sms_api_id">
<?php if ($sms_api_list->isExport() || $sms_api_list->SortUrl($sms_api_list->sms_api_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_api_list->SortUrl($sms_api_list->sms_api_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_api_list->sms_api_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_api_list->sms_api_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_api_list->sms_api_id->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_id">
<span<?php echo $sms_api_list->sms_api_id->viewAttributes() ?>><?php echo $sms_api_list->sms_api_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_api_sms_api_id">
			<label class="<?php echo $sms_api_list->LeftColumnClass ?>"><?php echo $sms_api_list->sms_api_id->caption() ?></label>
			<div class="<?php echo $sms_api_list->RightColumnClass ?>"><div <?php echo $sms_api_list->sms_api_id->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_id">
<span<?php echo $sms_api_list->sms_api_id->viewAttributes() ?>><?php echo $sms_api_list->sms_api_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_api_list->sms_api_user->Visible) { // sms_api_user ?>
		<?php if ($sms_api->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_api_list->TableLeftColumnClass ?>"><span class="sms_api_sms_api_user">
<?php if ($sms_api_list->isExport() || $sms_api_list->SortUrl($sms_api_list->sms_api_user) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_user->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_api_list->SortUrl($sms_api_list->sms_api_user) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_user->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sms_api_list->sms_api_user->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_api_list->sms_api_user->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_api_list->sms_api_user->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_user">
<span<?php echo $sms_api_list->sms_api_user->viewAttributes() ?>><?php echo $sms_api_list->sms_api_user->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_api_sms_api_user">
			<label class="<?php echo $sms_api_list->LeftColumnClass ?>"><?php echo $sms_api_list->sms_api_user->caption() ?></label>
			<div class="<?php echo $sms_api_list->RightColumnClass ?>"><div <?php echo $sms_api_list->sms_api_user->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_user">
<span<?php echo $sms_api_list->sms_api_user->viewAttributes() ?>><?php echo $sms_api_list->sms_api_user->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_api_list->sms_api_pass->Visible) { // sms_api_pass ?>
		<?php if ($sms_api->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_api_list->TableLeftColumnClass ?>"><span class="sms_api_sms_api_pass">
<?php if ($sms_api_list->isExport() || $sms_api_list->SortUrl($sms_api_list->sms_api_pass) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_pass->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_api_list->SortUrl($sms_api_list->sms_api_pass) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_pass->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sms_api_list->sms_api_pass->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_api_list->sms_api_pass->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_api_list->sms_api_pass->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_pass">
<span<?php echo $sms_api_list->sms_api_pass->viewAttributes() ?>><?php echo $sms_api_list->sms_api_pass->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_api_sms_api_pass">
			<label class="<?php echo $sms_api_list->LeftColumnClass ?>"><?php echo $sms_api_list->sms_api_pass->caption() ?></label>
			<div class="<?php echo $sms_api_list->RightColumnClass ?>"><div <?php echo $sms_api_list->sms_api_pass->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_pass">
<span<?php echo $sms_api_list->sms_api_pass->viewAttributes() ?>><?php echo $sms_api_list->sms_api_pass->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_api_list->sms_api_url->Visible) { // sms_api_url ?>
		<?php if ($sms_api->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_api_list->TableLeftColumnClass ?>"><span class="sms_api_sms_api_url">
<?php if ($sms_api_list->isExport() || $sms_api_list->SortUrl($sms_api_list->sms_api_url) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_url->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_api_list->SortUrl($sms_api_list->sms_api_url) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_url->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sms_api_list->sms_api_url->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_api_list->sms_api_url->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_api_list->sms_api_url->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_url">
<span<?php echo $sms_api_list->sms_api_url->viewAttributes() ?>><?php echo $sms_api_list->sms_api_url->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_api_sms_api_url">
			<label class="<?php echo $sms_api_list->LeftColumnClass ?>"><?php echo $sms_api_list->sms_api_url->caption() ?></label>
			<div class="<?php echo $sms_api_list->RightColumnClass ?>"><div <?php echo $sms_api_list->sms_api_url->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_url">
<span<?php echo $sms_api_list->sms_api_url->viewAttributes() ?>><?php echo $sms_api_list->sms_api_url->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_api_list->sms_api_mask->Visible) { // sms_api_mask ?>
		<?php if ($sms_api->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_api_list->TableLeftColumnClass ?>"><span class="sms_api_sms_api_mask">
<?php if ($sms_api_list->isExport() || $sms_api_list->SortUrl($sms_api_list->sms_api_mask) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_mask->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_api_list->SortUrl($sms_api_list->sms_api_mask) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_mask->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sms_api_list->sms_api_mask->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_api_list->sms_api_mask->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_api_list->sms_api_mask->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_mask">
<span<?php echo $sms_api_list->sms_api_mask->viewAttributes() ?>><?php echo $sms_api_list->sms_api_mask->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_api_sms_api_mask">
			<label class="<?php echo $sms_api_list->LeftColumnClass ?>"><?php echo $sms_api_list->sms_api_mask->caption() ?></label>
			<div class="<?php echo $sms_api_list->RightColumnClass ?>"><div <?php echo $sms_api_list->sms_api_mask->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_mask">
<span<?php echo $sms_api_list->sms_api_mask->viewAttributes() ?>><?php echo $sms_api_list->sms_api_mask->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_api_list->sms_api_reg_date->Visible) { // sms_api_reg_date ?>
		<?php if ($sms_api->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_api_list->TableLeftColumnClass ?>"><span class="sms_api_sms_api_reg_date">
<?php if ($sms_api_list->isExport() || $sms_api_list->SortUrl($sms_api_list->sms_api_reg_date) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_reg_date->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_api_list->SortUrl($sms_api_list->sms_api_reg_date) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_reg_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_api_list->sms_api_reg_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_api_list->sms_api_reg_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_api_list->sms_api_reg_date->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_reg_date">
<span<?php echo $sms_api_list->sms_api_reg_date->viewAttributes() ?>><?php echo $sms_api_list->sms_api_reg_date->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_api_sms_api_reg_date">
			<label class="<?php echo $sms_api_list->LeftColumnClass ?>"><?php echo $sms_api_list->sms_api_reg_date->caption() ?></label>
			<div class="<?php echo $sms_api_list->RightColumnClass ?>"><div <?php echo $sms_api_list->sms_api_reg_date->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_reg_date">
<span<?php echo $sms_api_list->sms_api_reg_date->viewAttributes() ?>><?php echo $sms_api_list->sms_api_reg_date->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_api_list->sms_api_expiry_date->Visible) { // sms_api_expiry_date ?>
		<?php if ($sms_api->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_api_list->TableLeftColumnClass ?>"><span class="sms_api_sms_api_expiry_date">
<?php if ($sms_api_list->isExport() || $sms_api_list->SortUrl($sms_api_list->sms_api_expiry_date) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_expiry_date->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_api_list->SortUrl($sms_api_list->sms_api_expiry_date) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_expiry_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_api_list->sms_api_expiry_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_api_list->sms_api_expiry_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_api_list->sms_api_expiry_date->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_expiry_date">
<span<?php echo $sms_api_list->sms_api_expiry_date->viewAttributes() ?>><?php echo $sms_api_list->sms_api_expiry_date->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_api_sms_api_expiry_date">
			<label class="<?php echo $sms_api_list->LeftColumnClass ?>"><?php echo $sms_api_list->sms_api_expiry_date->caption() ?></label>
			<div class="<?php echo $sms_api_list->RightColumnClass ?>"><div <?php echo $sms_api_list->sms_api_expiry_date->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_expiry_date">
<span<?php echo $sms_api_list->sms_api_expiry_date->viewAttributes() ?>><?php echo $sms_api_list->sms_api_expiry_date->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_api_list->sms_api_total_sms->Visible) { // sms_api_total_sms ?>
		<?php if ($sms_api->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_api_list->TableLeftColumnClass ?>"><span class="sms_api_sms_api_total_sms">
<?php if ($sms_api_list->isExport() || $sms_api_list->SortUrl($sms_api_list->sms_api_total_sms) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_total_sms->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_api_list->SortUrl($sms_api_list->sms_api_total_sms) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_api_list->sms_api_total_sms->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_api_list->sms_api_total_sms->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_api_list->sms_api_total_sms->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_api_list->sms_api_total_sms->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_total_sms">
<span<?php echo $sms_api_list->sms_api_total_sms->viewAttributes() ?>><?php echo $sms_api_list->sms_api_total_sms->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_api_sms_api_total_sms">
			<label class="<?php echo $sms_api_list->LeftColumnClass ?>"><?php echo $sms_api_list->sms_api_total_sms->caption() ?></label>
			<div class="<?php echo $sms_api_list->RightColumnClass ?>"><div <?php echo $sms_api_list->sms_api_total_sms->cellAttributes() ?>>
<span id="el<?php echo $sms_api_list->RowCount ?>_sms_api_sms_api_total_sms">
<span<?php echo $sms_api_list->sms_api_total_sms->viewAttributes() ?>><?php echo $sms_api_list->sms_api_total_sms->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_api->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$sms_api_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$sms_api_list->ListOptions->render("body", "bottom", $sms_api_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$sms_api_list->isGridAdd())
		$sms_api_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$sms_api->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($sms_api_list->Recordset)
	$sms_api_list->Recordset->Close();
?>
<?php if (!$sms_api_list->isExport()) { ?>
<div>
<?php if (!$sms_api_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sms_api_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sms_api_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($sms_api_list->TotalRecords == 0 && !$sms_api->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $sms_api_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$sms_api_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sms_api_list->isExport()) { ?>
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
$sms_api_list->terminate();
?>