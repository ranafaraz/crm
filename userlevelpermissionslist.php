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
$userlevelpermissions_list = new userlevelpermissions_list();

// Run the page
$userlevelpermissions_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$userlevelpermissions_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$userlevelpermissions_list->isExport()) { ?>
<script>
var fuserlevelpermissionslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fuserlevelpermissionslist = currentForm = new ew.Form("fuserlevelpermissionslist", "list");
	fuserlevelpermissionslist.formKeyCountName = '<?php echo $userlevelpermissions_list->FormKeyCountName ?>';
	loadjs.done("fuserlevelpermissionslist");
});
var fuserlevelpermissionslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fuserlevelpermissionslistsrch = currentSearchForm = new ew.Form("fuserlevelpermissionslistsrch");

	// Dynamic selection lists
	// Filters

	fuserlevelpermissionslistsrch.filterList = <?php echo $userlevelpermissions_list->getFilterList() ?>;
	loadjs.done("fuserlevelpermissionslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$userlevelpermissions_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($userlevelpermissions_list->TotalRecords > 0 && $userlevelpermissions_list->ExportOptions->visible()) { ?>
<?php $userlevelpermissions_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($userlevelpermissions_list->ImportOptions->visible()) { ?>
<?php $userlevelpermissions_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($userlevelpermissions_list->SearchOptions->visible()) { ?>
<?php $userlevelpermissions_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($userlevelpermissions_list->FilterOptions->visible()) { ?>
<?php $userlevelpermissions_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$userlevelpermissions_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$userlevelpermissions_list->isExport() && !$userlevelpermissions->CurrentAction) { ?>
<form name="fuserlevelpermissionslistsrch" id="fuserlevelpermissionslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fuserlevelpermissionslistsrch-search-panel" class="<?php echo $userlevelpermissions_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="userlevelpermissions">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $userlevelpermissions_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($userlevelpermissions_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($userlevelpermissions_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $userlevelpermissions_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($userlevelpermissions_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($userlevelpermissions_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($userlevelpermissions_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($userlevelpermissions_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $userlevelpermissions_list->showPageHeader(); ?>
<?php
$userlevelpermissions_list->showMessage();
?>
<?php if ($userlevelpermissions_list->TotalRecords > 0 || $userlevelpermissions->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$userlevelpermissions_list->isExport()) { ?>
<div>
<?php if (!$userlevelpermissions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $userlevelpermissions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $userlevelpermissions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fuserlevelpermissionslist" id="fuserlevelpermissionslist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="userlevelpermissions">
<div class="row ew-multi-column-row">
<?php if ($userlevelpermissions_list->TotalRecords > 0 || $userlevelpermissions_list->isGridEdit()) { ?>
<?php
if ($userlevelpermissions_list->ExportAll && $userlevelpermissions_list->isExport()) {
	$userlevelpermissions_list->StopRecord = $userlevelpermissions_list->TotalRecords;
} else {

	// Set the last record to display
	if ($userlevelpermissions_list->TotalRecords > $userlevelpermissions_list->StartRecord + $userlevelpermissions_list->DisplayRecords - 1)
		$userlevelpermissions_list->StopRecord = $userlevelpermissions_list->StartRecord + $userlevelpermissions_list->DisplayRecords - 1;
	else
		$userlevelpermissions_list->StopRecord = $userlevelpermissions_list->TotalRecords;
}
$userlevelpermissions_list->RecordCount = $userlevelpermissions_list->StartRecord - 1;
if ($userlevelpermissions_list->Recordset && !$userlevelpermissions_list->Recordset->EOF) {
	$userlevelpermissions_list->Recordset->moveFirst();
	$selectLimit = $userlevelpermissions_list->UseSelectLimit;
	if (!$selectLimit && $userlevelpermissions_list->StartRecord > 1)
		$userlevelpermissions_list->Recordset->move($userlevelpermissions_list->StartRecord - 1);
} elseif (!$userlevelpermissions->AllowAddDeleteRow && $userlevelpermissions_list->StopRecord == 0) {
	$userlevelpermissions_list->StopRecord = $userlevelpermissions->GridAddRowCount;
}
while ($userlevelpermissions_list->RecordCount < $userlevelpermissions_list->StopRecord) {
	$userlevelpermissions_list->RecordCount++;
	if ($userlevelpermissions_list->RecordCount >= $userlevelpermissions_list->StartRecord) {
		$userlevelpermissions_list->RowCount++;

		// Set up key count
		$userlevelpermissions_list->KeyCount = $userlevelpermissions_list->RowIndex;

		// Init row class and style
		$userlevelpermissions->resetAttributes();
		$userlevelpermissions->CssClass = "";
		if ($userlevelpermissions_list->isGridAdd()) {
		} else {
			$userlevelpermissions_list->loadRowValues($userlevelpermissions_list->Recordset); // Load row values
		}
		$userlevelpermissions->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$userlevelpermissions->RowAttrs->merge(["data-rowindex" => $userlevelpermissions_list->RowCount, "id" => "r" . $userlevelpermissions_list->RowCount . "_userlevelpermissions", "data-rowtype" => $userlevelpermissions->RowType]);

		// Render row
		$userlevelpermissions_list->renderRow();

		// Render list options
		$userlevelpermissions_list->renderListOptions();
?>
<div class="<?php echo $userlevelpermissions_list->getMultiColumnClass() ?>" <?php echo $userlevelpermissions->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($userlevelpermissions->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($userlevelpermissions_list->userlevelid->Visible) { // userlevelid ?>
		<?php if ($userlevelpermissions->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $userlevelpermissions_list->TableLeftColumnClass ?>"><span class="userlevelpermissions_userlevelid">
<?php if ($userlevelpermissions_list->isExport() || $userlevelpermissions_list->SortUrl($userlevelpermissions_list->userlevelid) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $userlevelpermissions_list->userlevelid->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $userlevelpermissions_list->SortUrl($userlevelpermissions_list->userlevelid) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $userlevelpermissions_list->userlevelid->caption() ?></span><span class="ew-table-header-sort"><?php if ($userlevelpermissions_list->userlevelid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($userlevelpermissions_list->userlevelid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $userlevelpermissions_list->userlevelid->cellAttributes() ?>>
<span id="el<?php echo $userlevelpermissions_list->RowCount ?>_userlevelpermissions_userlevelid">
<span<?php echo $userlevelpermissions_list->userlevelid->viewAttributes() ?>><?php echo $userlevelpermissions_list->userlevelid->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row userlevelpermissions_userlevelid">
			<label class="<?php echo $userlevelpermissions_list->LeftColumnClass ?>"><?php echo $userlevelpermissions_list->userlevelid->caption() ?></label>
			<div class="<?php echo $userlevelpermissions_list->RightColumnClass ?>"><div <?php echo $userlevelpermissions_list->userlevelid->cellAttributes() ?>>
<span id="el<?php echo $userlevelpermissions_list->RowCount ?>_userlevelpermissions_userlevelid">
<span<?php echo $userlevelpermissions_list->userlevelid->viewAttributes() ?>><?php echo $userlevelpermissions_list->userlevelid->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($userlevelpermissions_list->_tablename->Visible) { // tablename ?>
		<?php if ($userlevelpermissions->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $userlevelpermissions_list->TableLeftColumnClass ?>"><span class="userlevelpermissions__tablename">
<?php if ($userlevelpermissions_list->isExport() || $userlevelpermissions_list->SortUrl($userlevelpermissions_list->_tablename) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $userlevelpermissions_list->_tablename->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $userlevelpermissions_list->SortUrl($userlevelpermissions_list->_tablename) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $userlevelpermissions_list->_tablename->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($userlevelpermissions_list->_tablename->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($userlevelpermissions_list->_tablename->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $userlevelpermissions_list->_tablename->cellAttributes() ?>>
<span id="el<?php echo $userlevelpermissions_list->RowCount ?>_userlevelpermissions__tablename">
<span<?php echo $userlevelpermissions_list->_tablename->viewAttributes() ?>><?php echo $userlevelpermissions_list->_tablename->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row userlevelpermissions__tablename">
			<label class="<?php echo $userlevelpermissions_list->LeftColumnClass ?>"><?php echo $userlevelpermissions_list->_tablename->caption() ?></label>
			<div class="<?php echo $userlevelpermissions_list->RightColumnClass ?>"><div <?php echo $userlevelpermissions_list->_tablename->cellAttributes() ?>>
<span id="el<?php echo $userlevelpermissions_list->RowCount ?>_userlevelpermissions__tablename">
<span<?php echo $userlevelpermissions_list->_tablename->viewAttributes() ?>><?php echo $userlevelpermissions_list->_tablename->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($userlevelpermissions_list->permission->Visible) { // permission ?>
		<?php if ($userlevelpermissions->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $userlevelpermissions_list->TableLeftColumnClass ?>"><span class="userlevelpermissions_permission">
<?php if ($userlevelpermissions_list->isExport() || $userlevelpermissions_list->SortUrl($userlevelpermissions_list->permission) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $userlevelpermissions_list->permission->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $userlevelpermissions_list->SortUrl($userlevelpermissions_list->permission) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $userlevelpermissions_list->permission->caption() ?></span><span class="ew-table-header-sort"><?php if ($userlevelpermissions_list->permission->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($userlevelpermissions_list->permission->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $userlevelpermissions_list->permission->cellAttributes() ?>>
<span id="el<?php echo $userlevelpermissions_list->RowCount ?>_userlevelpermissions_permission">
<span<?php echo $userlevelpermissions_list->permission->viewAttributes() ?>><?php echo $userlevelpermissions_list->permission->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row userlevelpermissions_permission">
			<label class="<?php echo $userlevelpermissions_list->LeftColumnClass ?>"><?php echo $userlevelpermissions_list->permission->caption() ?></label>
			<div class="<?php echo $userlevelpermissions_list->RightColumnClass ?>"><div <?php echo $userlevelpermissions_list->permission->cellAttributes() ?>>
<span id="el<?php echo $userlevelpermissions_list->RowCount ?>_userlevelpermissions_permission">
<span<?php echo $userlevelpermissions_list->permission->viewAttributes() ?>><?php echo $userlevelpermissions_list->permission->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($userlevelpermissions->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$userlevelpermissions_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$userlevelpermissions_list->ListOptions->render("body", "bottom", $userlevelpermissions_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$userlevelpermissions_list->isGridAdd())
		$userlevelpermissions_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$userlevelpermissions->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($userlevelpermissions_list->Recordset)
	$userlevelpermissions_list->Recordset->Close();
?>
<?php if (!$userlevelpermissions_list->isExport()) { ?>
<div>
<?php if (!$userlevelpermissions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $userlevelpermissions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $userlevelpermissions_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($userlevelpermissions_list->TotalRecords == 0 && !$userlevelpermissions->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $userlevelpermissions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$userlevelpermissions_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$userlevelpermissions_list->isExport()) { ?>
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
$userlevelpermissions_list->terminate();
?>