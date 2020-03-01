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
$user_list = new user_list();

// Run the page
$user_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$user_list->isExport()) { ?>
<script>
var fuserlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fuserlist = currentForm = new ew.Form("fuserlist", "list");
	fuserlist.formKeyCountName = '<?php echo $user_list->FormKeyCountName ?>';
	loadjs.done("fuserlist");
});
var fuserlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fuserlistsrch = currentSearchForm = new ew.Form("fuserlistsrch");

	// Dynamic selection lists
	// Filters

	fuserlistsrch.filterList = <?php echo $user_list->getFilterList() ?>;
	loadjs.done("fuserlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$user_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($user_list->TotalRecords > 0 && $user_list->ExportOptions->visible()) { ?>
<?php $user_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($user_list->ImportOptions->visible()) { ?>
<?php $user_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($user_list->SearchOptions->visible()) { ?>
<?php $user_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($user_list->FilterOptions->visible()) { ?>
<?php $user_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$user_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$user_list->isExport() && !$user->CurrentAction) { ?>
<form name="fuserlistsrch" id="fuserlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fuserlistsrch-search-panel" class="<?php echo $user_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="user">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $user_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($user_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($user_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $user_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($user_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($user_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($user_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($user_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $user_list->showPageHeader(); ?>
<?php
$user_list->showMessage();
?>
<?php if ($user_list->TotalRecords > 0 || $user->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$user_list->isExport()) { ?>
<div>
<?php if (!$user_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $user_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $user_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fuserlist" id="fuserlist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<div class="row ew-multi-column-row">
<?php if ($user_list->TotalRecords > 0 || $user_list->isGridEdit()) { ?>
<?php
if ($user_list->ExportAll && $user_list->isExport()) {
	$user_list->StopRecord = $user_list->TotalRecords;
} else {

	// Set the last record to display
	if ($user_list->TotalRecords > $user_list->StartRecord + $user_list->DisplayRecords - 1)
		$user_list->StopRecord = $user_list->StartRecord + $user_list->DisplayRecords - 1;
	else
		$user_list->StopRecord = $user_list->TotalRecords;
}
$user_list->RecordCount = $user_list->StartRecord - 1;
if ($user_list->Recordset && !$user_list->Recordset->EOF) {
	$user_list->Recordset->moveFirst();
	$selectLimit = $user_list->UseSelectLimit;
	if (!$selectLimit && $user_list->StartRecord > 1)
		$user_list->Recordset->move($user_list->StartRecord - 1);
} elseif (!$user->AllowAddDeleteRow && $user_list->StopRecord == 0) {
	$user_list->StopRecord = $user->GridAddRowCount;
}
while ($user_list->RecordCount < $user_list->StopRecord) {
	$user_list->RecordCount++;
	if ($user_list->RecordCount >= $user_list->StartRecord) {
		$user_list->RowCount++;

		// Set up key count
		$user_list->KeyCount = $user_list->RowIndex;

		// Init row class and style
		$user->resetAttributes();
		$user->CssClass = "";
		if ($user_list->isGridAdd()) {
		} else {
			$user_list->loadRowValues($user_list->Recordset); // Load row values
		}
		$user->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$user->RowAttrs->merge(["data-rowindex" => $user_list->RowCount, "id" => "r" . $user_list->RowCount . "_user", "data-rowtype" => $user->RowType]);

		// Render row
		$user_list->renderRow();

		// Render list options
		$user_list->renderListOptions();
?>
<div class="<?php echo $user_list->getMultiColumnClass() ?>" <?php echo $user->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($user_list->user_id->Visible) { // user_id ?>
		<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $user_list->TableLeftColumnClass ?>"><span class="user_user_id">
<?php if ($user_list->isExport() || $user_list->SortUrl($user_list->user_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $user_list->user_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $user_list->SortUrl($user_list->user_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_list->user_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($user_list->user_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($user_list->user_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $user_list->user_id->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_id">
<span<?php echo $user_list->user_id->viewAttributes() ?>><?php echo $user_list->user_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row user_user_id">
			<label class="<?php echo $user_list->LeftColumnClass ?>"><?php echo $user_list->user_id->caption() ?></label>
			<div class="<?php echo $user_list->RightColumnClass ?>"><div <?php echo $user_list->user_id->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_id">
<span<?php echo $user_list->user_id->viewAttributes() ?>><?php echo $user_list->user_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($user_list->user_branch_id->Visible) { // user_branch_id ?>
		<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $user_list->TableLeftColumnClass ?>"><span class="user_user_branch_id">
<?php if ($user_list->isExport() || $user_list->SortUrl($user_list->user_branch_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $user_list->user_branch_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $user_list->SortUrl($user_list->user_branch_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_list->user_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($user_list->user_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($user_list->user_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $user_list->user_branch_id->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_branch_id">
<span<?php echo $user_list->user_branch_id->viewAttributes() ?>><?php echo $user_list->user_branch_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row user_user_branch_id">
			<label class="<?php echo $user_list->LeftColumnClass ?>"><?php echo $user_list->user_branch_id->caption() ?></label>
			<div class="<?php echo $user_list->RightColumnClass ?>"><div <?php echo $user_list->user_branch_id->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_branch_id">
<span<?php echo $user_list->user_branch_id->viewAttributes() ?>><?php echo $user_list->user_branch_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($user_list->user_type_id->Visible) { // user_type_id ?>
		<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $user_list->TableLeftColumnClass ?>"><span class="user_user_type_id">
<?php if ($user_list->isExport() || $user_list->SortUrl($user_list->user_type_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $user_list->user_type_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $user_list->SortUrl($user_list->user_type_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_list->user_type_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($user_list->user_type_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($user_list->user_type_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $user_list->user_type_id->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_type_id">
<span<?php echo $user_list->user_type_id->viewAttributes() ?>><?php echo $user_list->user_type_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row user_user_type_id">
			<label class="<?php echo $user_list->LeftColumnClass ?>"><?php echo $user_list->user_type_id->caption() ?></label>
			<div class="<?php echo $user_list->RightColumnClass ?>"><div <?php echo $user_list->user_type_id->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_type_id">
<span<?php echo $user_list->user_type_id->viewAttributes() ?>><?php echo $user_list->user_type_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($user_list->user_name->Visible) { // user_name ?>
		<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $user_list->TableLeftColumnClass ?>"><span class="user_user_name">
<?php if ($user_list->isExport() || $user_list->SortUrl($user_list->user_name) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $user_list->user_name->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $user_list->SortUrl($user_list->user_name) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_list->user_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user_list->user_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($user_list->user_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $user_list->user_name->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_name">
<span<?php echo $user_list->user_name->viewAttributes() ?>><?php echo $user_list->user_name->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row user_user_name">
			<label class="<?php echo $user_list->LeftColumnClass ?>"><?php echo $user_list->user_name->caption() ?></label>
			<div class="<?php echo $user_list->RightColumnClass ?>"><div <?php echo $user_list->user_name->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_name">
<span<?php echo $user_list->user_name->viewAttributes() ?>><?php echo $user_list->user_name->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($user_list->user_password->Visible) { // user_password ?>
		<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $user_list->TableLeftColumnClass ?>"><span class="user_user_password">
<?php if ($user_list->isExport() || $user_list->SortUrl($user_list->user_password) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $user_list->user_password->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $user_list->SortUrl($user_list->user_password) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_list->user_password->caption() ?></span><span class="ew-table-header-sort"><?php if ($user_list->user_password->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($user_list->user_password->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $user_list->user_password->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_password">
<span<?php echo $user_list->user_password->viewAttributes() ?>><?php echo $user_list->user_password->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row user_user_password">
			<label class="<?php echo $user_list->LeftColumnClass ?>"><?php echo $user_list->user_password->caption() ?></label>
			<div class="<?php echo $user_list->RightColumnClass ?>"><div <?php echo $user_list->user_password->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_password">
<span<?php echo $user_list->user_password->viewAttributes() ?>><?php echo $user_list->user_password->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($user_list->user_email->Visible) { // user_email ?>
		<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $user_list->TableLeftColumnClass ?>"><span class="user_user_email">
<?php if ($user_list->isExport() || $user_list->SortUrl($user_list->user_email) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $user_list->user_email->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $user_list->SortUrl($user_list->user_email) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_list->user_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user_list->user_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($user_list->user_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $user_list->user_email->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_email">
<span<?php echo $user_list->user_email->viewAttributes() ?>><?php echo $user_list->user_email->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row user_user_email">
			<label class="<?php echo $user_list->LeftColumnClass ?>"><?php echo $user_list->user_email->caption() ?></label>
			<div class="<?php echo $user_list->RightColumnClass ?>"><div <?php echo $user_list->user_email->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_email">
<span<?php echo $user_list->user_email->viewAttributes() ?>><?php echo $user_list->user_email->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($user_list->user_cnic->Visible) { // user_cnic ?>
		<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $user_list->TableLeftColumnClass ?>"><span class="user_user_cnic">
<?php if ($user_list->isExport() || $user_list->SortUrl($user_list->user_cnic) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $user_list->user_cnic->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $user_list->SortUrl($user_list->user_cnic) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_list->user_cnic->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user_list->user_cnic->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($user_list->user_cnic->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $user_list->user_cnic->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_cnic">
<span<?php echo $user_list->user_cnic->viewAttributes() ?>><?php echo $user_list->user_cnic->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row user_user_cnic">
			<label class="<?php echo $user_list->LeftColumnClass ?>"><?php echo $user_list->user_cnic->caption() ?></label>
			<div class="<?php echo $user_list->RightColumnClass ?>"><div <?php echo $user_list->user_cnic->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_cnic">
<span<?php echo $user_list->user_cnic->viewAttributes() ?>><?php echo $user_list->user_cnic->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($user_list->user_father->Visible) { // user_father ?>
		<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $user_list->TableLeftColumnClass ?>"><span class="user_user_father">
<?php if ($user_list->isExport() || $user_list->SortUrl($user_list->user_father) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $user_list->user_father->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $user_list->SortUrl($user_list->user_father) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_list->user_father->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user_list->user_father->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($user_list->user_father->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $user_list->user_father->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_father">
<span<?php echo $user_list->user_father->viewAttributes() ?>><?php echo $user_list->user_father->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row user_user_father">
			<label class="<?php echo $user_list->LeftColumnClass ?>"><?php echo $user_list->user_father->caption() ?></label>
			<div class="<?php echo $user_list->RightColumnClass ?>"><div <?php echo $user_list->user_father->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_user_father">
<span<?php echo $user_list->user_father->viewAttributes() ?>><?php echo $user_list->user_father->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$user_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$user_list->ListOptions->render("body", "bottom", $user_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$user_list->isGridAdd())
		$user_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$user->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($user_list->Recordset)
	$user_list->Recordset->Close();
?>
<?php if (!$user_list->isExport()) { ?>
<div>
<?php if (!$user_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $user_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $user_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($user_list->TotalRecords == 0 && !$user->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $user_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$user_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$user_list->isExport()) { ?>
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
$user_list->terminate();
?>