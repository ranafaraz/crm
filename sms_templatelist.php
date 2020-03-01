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
$sms_template_list = new sms_template_list();

// Run the page
$sms_template_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_template_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sms_template_list->isExport()) { ?>
<script>
var fsms_templatelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsms_templatelist = currentForm = new ew.Form("fsms_templatelist", "list");
	fsms_templatelist.formKeyCountName = '<?php echo $sms_template_list->FormKeyCountName ?>';
	loadjs.done("fsms_templatelist");
});
var fsms_templatelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsms_templatelistsrch = currentSearchForm = new ew.Form("fsms_templatelistsrch");

	// Dynamic selection lists
	// Filters

	fsms_templatelistsrch.filterList = <?php echo $sms_template_list->getFilterList() ?>;
	loadjs.done("fsms_templatelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sms_template_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($sms_template_list->TotalRecords > 0 && $sms_template_list->ExportOptions->visible()) { ?>
<?php $sms_template_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($sms_template_list->ImportOptions->visible()) { ?>
<?php $sms_template_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($sms_template_list->SearchOptions->visible()) { ?>
<?php $sms_template_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($sms_template_list->FilterOptions->visible()) { ?>
<?php $sms_template_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$sms_template_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$sms_template_list->isExport() && !$sms_template->CurrentAction) { ?>
<form name="fsms_templatelistsrch" id="fsms_templatelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsms_templatelistsrch-search-panel" class="<?php echo $sms_template_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="sms_template">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $sms_template_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($sms_template_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($sms_template_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $sms_template_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($sms_template_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($sms_template_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($sms_template_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($sms_template_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $sms_template_list->showPageHeader(); ?>
<?php
$sms_template_list->showMessage();
?>
<?php if ($sms_template_list->TotalRecords > 0 || $sms_template->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($sms_template_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> sms_template">
<?php if (!$sms_template_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$sms_template_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sms_template_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sms_template_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsms_templatelist" id="fsms_templatelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_template">
<div id="gmp_sms_template" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($sms_template_list->TotalRecords > 0 || $sms_template_list->isGridEdit()) { ?>
<table id="tbl_sms_templatelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$sms_template->RowType = ROWTYPE_HEADER;

// Render list options
$sms_template_list->renderListOptions();

// Render list options (header, left)
$sms_template_list->ListOptions->render("header", "left");
?>
<?php if ($sms_template_list->sms_temp_id->Visible) { // sms_temp_id ?>
	<?php if ($sms_template_list->SortUrl($sms_template_list->sms_temp_id) == "") { ?>
		<th data-name="sms_temp_id" class="<?php echo $sms_template_list->sms_temp_id->headerCellClass() ?>"><div id="elh_sms_template_sms_temp_id" class="sms_template_sms_temp_id"><div class="ew-table-header-caption"><?php echo $sms_template_list->sms_temp_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sms_temp_id" class="<?php echo $sms_template_list->sms_temp_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_template_list->SortUrl($sms_template_list->sms_temp_id) ?>', 1);"><div id="elh_sms_template_sms_temp_id" class="sms_template_sms_temp_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_template_list->sms_temp_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_template_list->sms_temp_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_template_list->sms_temp_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sms_template_list->sms_temp_branch_id->Visible) { // sms_temp_branch_id ?>
	<?php if ($sms_template_list->SortUrl($sms_template_list->sms_temp_branch_id) == "") { ?>
		<th data-name="sms_temp_branch_id" class="<?php echo $sms_template_list->sms_temp_branch_id->headerCellClass() ?>"><div id="elh_sms_template_sms_temp_branch_id" class="sms_template_sms_temp_branch_id"><div class="ew-table-header-caption"><?php echo $sms_template_list->sms_temp_branch_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sms_temp_branch_id" class="<?php echo $sms_template_list->sms_temp_branch_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_template_list->SortUrl($sms_template_list->sms_temp_branch_id) ?>', 1);"><div id="elh_sms_template_sms_temp_branch_id" class="sms_template_sms_temp_branch_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_template_list->sms_temp_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_template_list->sms_temp_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_template_list->sms_temp_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sms_template_list->sms_temp_caption->Visible) { // sms_temp_caption ?>
	<?php if ($sms_template_list->SortUrl($sms_template_list->sms_temp_caption) == "") { ?>
		<th data-name="sms_temp_caption" class="<?php echo $sms_template_list->sms_temp_caption->headerCellClass() ?>"><div id="elh_sms_template_sms_temp_caption" class="sms_template_sms_temp_caption"><div class="ew-table-header-caption"><?php echo $sms_template_list->sms_temp_caption->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sms_temp_caption" class="<?php echo $sms_template_list->sms_temp_caption->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_template_list->SortUrl($sms_template_list->sms_temp_caption) ?>', 1);"><div id="elh_sms_template_sms_temp_caption" class="sms_template_sms_temp_caption">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_template_list->sms_temp_caption->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sms_template_list->sms_temp_caption->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_template_list->sms_temp_caption->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sms_template_list->sms_temp_msg->Visible) { // sms_temp_msg ?>
	<?php if ($sms_template_list->SortUrl($sms_template_list->sms_temp_msg) == "") { ?>
		<th data-name="sms_temp_msg" class="<?php echo $sms_template_list->sms_temp_msg->headerCellClass() ?>"><div id="elh_sms_template_sms_temp_msg" class="sms_template_sms_temp_msg"><div class="ew-table-header-caption"><?php echo $sms_template_list->sms_temp_msg->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sms_temp_msg" class="<?php echo $sms_template_list->sms_temp_msg->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_template_list->SortUrl($sms_template_list->sms_temp_msg) ?>', 1);"><div id="elh_sms_template_sms_temp_msg" class="sms_template_sms_temp_msg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_template_list->sms_temp_msg->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sms_template_list->sms_temp_msg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_template_list->sms_temp_msg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$sms_template_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($sms_template_list->ExportAll && $sms_template_list->isExport()) {
	$sms_template_list->StopRecord = $sms_template_list->TotalRecords;
} else {

	// Set the last record to display
	if ($sms_template_list->TotalRecords > $sms_template_list->StartRecord + $sms_template_list->DisplayRecords - 1)
		$sms_template_list->StopRecord = $sms_template_list->StartRecord + $sms_template_list->DisplayRecords - 1;
	else
		$sms_template_list->StopRecord = $sms_template_list->TotalRecords;
}
$sms_template_list->RecordCount = $sms_template_list->StartRecord - 1;
if ($sms_template_list->Recordset && !$sms_template_list->Recordset->EOF) {
	$sms_template_list->Recordset->moveFirst();
	$selectLimit = $sms_template_list->UseSelectLimit;
	if (!$selectLimit && $sms_template_list->StartRecord > 1)
		$sms_template_list->Recordset->move($sms_template_list->StartRecord - 1);
} elseif (!$sms_template->AllowAddDeleteRow && $sms_template_list->StopRecord == 0) {
	$sms_template_list->StopRecord = $sms_template->GridAddRowCount;
}

// Initialize aggregate
$sms_template->RowType = ROWTYPE_AGGREGATEINIT;
$sms_template->resetAttributes();
$sms_template_list->renderRow();
while ($sms_template_list->RecordCount < $sms_template_list->StopRecord) {
	$sms_template_list->RecordCount++;
	if ($sms_template_list->RecordCount >= $sms_template_list->StartRecord) {
		$sms_template_list->RowCount++;

		// Set up key count
		$sms_template_list->KeyCount = $sms_template_list->RowIndex;

		// Init row class and style
		$sms_template->resetAttributes();
		$sms_template->CssClass = "";
		if ($sms_template_list->isGridAdd()) {
		} else {
			$sms_template_list->loadRowValues($sms_template_list->Recordset); // Load row values
		}
		$sms_template->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$sms_template->RowAttrs->merge(["data-rowindex" => $sms_template_list->RowCount, "id" => "r" . $sms_template_list->RowCount . "_sms_template", "data-rowtype" => $sms_template->RowType]);

		// Render row
		$sms_template_list->renderRow();

		// Render list options
		$sms_template_list->renderListOptions();
?>
	<tr <?php echo $sms_template->rowAttributes() ?>>
<?php

// Render list options (body, left)
$sms_template_list->ListOptions->render("body", "left", $sms_template_list->RowCount);
?>
	<?php if ($sms_template_list->sms_temp_id->Visible) { // sms_temp_id ?>
		<td data-name="sms_temp_id" <?php echo $sms_template_list->sms_temp_id->cellAttributes() ?>>
<span id="el<?php echo $sms_template_list->RowCount ?>_sms_template_sms_temp_id">
<span<?php echo $sms_template_list->sms_temp_id->viewAttributes() ?>><?php echo $sms_template_list->sms_temp_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sms_template_list->sms_temp_branch_id->Visible) { // sms_temp_branch_id ?>
		<td data-name="sms_temp_branch_id" <?php echo $sms_template_list->sms_temp_branch_id->cellAttributes() ?>>
<span id="el<?php echo $sms_template_list->RowCount ?>_sms_template_sms_temp_branch_id">
<span<?php echo $sms_template_list->sms_temp_branch_id->viewAttributes() ?>><?php echo $sms_template_list->sms_temp_branch_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sms_template_list->sms_temp_caption->Visible) { // sms_temp_caption ?>
		<td data-name="sms_temp_caption" <?php echo $sms_template_list->sms_temp_caption->cellAttributes() ?>>
<span id="el<?php echo $sms_template_list->RowCount ?>_sms_template_sms_temp_caption">
<span<?php echo $sms_template_list->sms_temp_caption->viewAttributes() ?>><?php echo $sms_template_list->sms_temp_caption->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sms_template_list->sms_temp_msg->Visible) { // sms_temp_msg ?>
		<td data-name="sms_temp_msg" <?php echo $sms_template_list->sms_temp_msg->cellAttributes() ?>>
<span id="el<?php echo $sms_template_list->RowCount ?>_sms_template_sms_temp_msg">
<span<?php echo $sms_template_list->sms_temp_msg->viewAttributes() ?>><?php echo $sms_template_list->sms_temp_msg->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sms_template_list->ListOptions->render("body", "right", $sms_template_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$sms_template_list->isGridAdd())
		$sms_template_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$sms_template->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($sms_template_list->Recordset)
	$sms_template_list->Recordset->Close();
?>
<?php if (!$sms_template_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$sms_template_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sms_template_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sms_template_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($sms_template_list->TotalRecords == 0 && !$sms_template->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $sms_template_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$sms_template_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sms_template_list->isExport()) { ?>
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
$sms_template_list->terminate();
?>