<?php
namespace PHPMaker2020\project1;

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
$referral_list = new referral_list();

// Run the page
$referral_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$referral_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$referral_list->isExport()) { ?>
<script>
var freferrallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	freferrallist = currentForm = new ew.Form("freferrallist", "list");
	freferrallist.formKeyCountName = '<?php echo $referral_list->FormKeyCountName ?>';
	loadjs.done("freferrallist");
});
var freferrallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	freferrallistsrch = currentSearchForm = new ew.Form("freferrallistsrch");

	// Dynamic selection lists
	// Filters

	freferrallistsrch.filterList = <?php echo $referral_list->getFilterList() ?>;
	loadjs.done("freferrallistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$referral_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($referral_list->TotalRecords > 0 && $referral_list->ExportOptions->visible()) { ?>
<?php $referral_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($referral_list->ImportOptions->visible()) { ?>
<?php $referral_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($referral_list->SearchOptions->visible()) { ?>
<?php $referral_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($referral_list->FilterOptions->visible()) { ?>
<?php $referral_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$referral_list->renderOtherOptions();
?>
<?php if (!$referral_list->isExport() && !$referral->CurrentAction) { ?>
<form name="freferrallistsrch" id="freferrallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="freferrallistsrch-search-panel" class="<?php echo $referral_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="referral">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $referral_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($referral_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($referral_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $referral_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($referral_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($referral_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($referral_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($referral_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $referral_list->showPageHeader(); ?>
<?php
$referral_list->showMessage();
?>
<?php if ($referral_list->TotalRecords > 0 || $referral->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($referral_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> referral">
<form name="freferrallist" id="freferrallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="referral">
<div id="gmp_referral" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($referral_list->TotalRecords > 0 || $referral_list->isGridEdit()) { ?>
<table id="tbl_referrallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$referral->RowType = ROWTYPE_HEADER;

// Render list options
$referral_list->renderListOptions();

// Render list options (header, left)
$referral_list->ListOptions->render("header", "left");
?>
<?php if ($referral_list->referral_id->Visible) { // referral_id ?>
	<?php if ($referral_list->SortUrl($referral_list->referral_id) == "") { ?>
		<th data-name="referral_id" class="<?php echo $referral_list->referral_id->headerCellClass() ?>"><div id="elh_referral_referral_id" class="referral_referral_id"><div class="ew-table-header-caption"><?php echo $referral_list->referral_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="referral_id" class="<?php echo $referral_list->referral_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $referral_list->SortUrl($referral_list->referral_id) ?>', 1);"><div id="elh_referral_referral_id" class="referral_referral_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $referral_list->referral_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($referral_list->referral_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($referral_list->referral_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($referral_list->referral_branch_id->Visible) { // referral_branch_id ?>
	<?php if ($referral_list->SortUrl($referral_list->referral_branch_id) == "") { ?>
		<th data-name="referral_branch_id" class="<?php echo $referral_list->referral_branch_id->headerCellClass() ?>"><div id="elh_referral_referral_branch_id" class="referral_referral_branch_id"><div class="ew-table-header-caption"><?php echo $referral_list->referral_branch_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="referral_branch_id" class="<?php echo $referral_list->referral_branch_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $referral_list->SortUrl($referral_list->referral_branch_id) ?>', 1);"><div id="elh_referral_referral_branch_id" class="referral_referral_branch_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $referral_list->referral_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($referral_list->referral_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($referral_list->referral_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($referral_list->referral_name->Visible) { // referral_name ?>
	<?php if ($referral_list->SortUrl($referral_list->referral_name) == "") { ?>
		<th data-name="referral_name" class="<?php echo $referral_list->referral_name->headerCellClass() ?>"><div id="elh_referral_referral_name" class="referral_referral_name"><div class="ew-table-header-caption"><?php echo $referral_list->referral_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="referral_name" class="<?php echo $referral_list->referral_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $referral_list->SortUrl($referral_list->referral_name) ?>', 1);"><div id="elh_referral_referral_name" class="referral_referral_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $referral_list->referral_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($referral_list->referral_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($referral_list->referral_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($referral_list->referral_desc->Visible) { // referral_desc ?>
	<?php if ($referral_list->SortUrl($referral_list->referral_desc) == "") { ?>
		<th data-name="referral_desc" class="<?php echo $referral_list->referral_desc->headerCellClass() ?>"><div id="elh_referral_referral_desc" class="referral_referral_desc"><div class="ew-table-header-caption"><?php echo $referral_list->referral_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="referral_desc" class="<?php echo $referral_list->referral_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $referral_list->SortUrl($referral_list->referral_desc) ?>', 1);"><div id="elh_referral_referral_desc" class="referral_referral_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $referral_list->referral_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($referral_list->referral_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($referral_list->referral_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$referral_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($referral_list->ExportAll && $referral_list->isExport()) {
	$referral_list->StopRecord = $referral_list->TotalRecords;
} else {

	// Set the last record to display
	if ($referral_list->TotalRecords > $referral_list->StartRecord + $referral_list->DisplayRecords - 1)
		$referral_list->StopRecord = $referral_list->StartRecord + $referral_list->DisplayRecords - 1;
	else
		$referral_list->StopRecord = $referral_list->TotalRecords;
}
$referral_list->RecordCount = $referral_list->StartRecord - 1;
if ($referral_list->Recordset && !$referral_list->Recordset->EOF) {
	$referral_list->Recordset->moveFirst();
	$selectLimit = $referral_list->UseSelectLimit;
	if (!$selectLimit && $referral_list->StartRecord > 1)
		$referral_list->Recordset->move($referral_list->StartRecord - 1);
} elseif (!$referral->AllowAddDeleteRow && $referral_list->StopRecord == 0) {
	$referral_list->StopRecord = $referral->GridAddRowCount;
}

// Initialize aggregate
$referral->RowType = ROWTYPE_AGGREGATEINIT;
$referral->resetAttributes();
$referral_list->renderRow();
while ($referral_list->RecordCount < $referral_list->StopRecord) {
	$referral_list->RecordCount++;
	if ($referral_list->RecordCount >= $referral_list->StartRecord) {
		$referral_list->RowCount++;

		// Set up key count
		$referral_list->KeyCount = $referral_list->RowIndex;

		// Init row class and style
		$referral->resetAttributes();
		$referral->CssClass = "";
		if ($referral_list->isGridAdd()) {
		} else {
			$referral_list->loadRowValues($referral_list->Recordset); // Load row values
		}
		$referral->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$referral->RowAttrs->merge(["data-rowindex" => $referral_list->RowCount, "id" => "r" . $referral_list->RowCount . "_referral", "data-rowtype" => $referral->RowType]);

		// Render row
		$referral_list->renderRow();

		// Render list options
		$referral_list->renderListOptions();
?>
	<tr <?php echo $referral->rowAttributes() ?>>
<?php

// Render list options (body, left)
$referral_list->ListOptions->render("body", "left", $referral_list->RowCount);
?>
	<?php if ($referral_list->referral_id->Visible) { // referral_id ?>
		<td data-name="referral_id" <?php echo $referral_list->referral_id->cellAttributes() ?>>
<span id="el<?php echo $referral_list->RowCount ?>_referral_referral_id">
<span<?php echo $referral_list->referral_id->viewAttributes() ?>><?php echo $referral_list->referral_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($referral_list->referral_branch_id->Visible) { // referral_branch_id ?>
		<td data-name="referral_branch_id" <?php echo $referral_list->referral_branch_id->cellAttributes() ?>>
<span id="el<?php echo $referral_list->RowCount ?>_referral_referral_branch_id">
<span<?php echo $referral_list->referral_branch_id->viewAttributes() ?>><?php echo $referral_list->referral_branch_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($referral_list->referral_name->Visible) { // referral_name ?>
		<td data-name="referral_name" <?php echo $referral_list->referral_name->cellAttributes() ?>>
<span id="el<?php echo $referral_list->RowCount ?>_referral_referral_name">
<span<?php echo $referral_list->referral_name->viewAttributes() ?>><?php echo $referral_list->referral_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($referral_list->referral_desc->Visible) { // referral_desc ?>
		<td data-name="referral_desc" <?php echo $referral_list->referral_desc->cellAttributes() ?>>
<span id="el<?php echo $referral_list->RowCount ?>_referral_referral_desc">
<span<?php echo $referral_list->referral_desc->viewAttributes() ?>><?php echo $referral_list->referral_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$referral_list->ListOptions->render("body", "right", $referral_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$referral_list->isGridAdd())
		$referral_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$referral->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($referral_list->Recordset)
	$referral_list->Recordset->Close();
?>
<?php if (!$referral_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$referral_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $referral_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $referral_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($referral_list->TotalRecords == 0 && !$referral->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $referral_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$referral_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$referral_list->isExport()) { ?>
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
$referral_list->terminate();
?>