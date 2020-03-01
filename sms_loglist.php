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
$sms_log_list = new sms_log_list();

// Run the page
$sms_log_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_log_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sms_log_list->isExport()) { ?>
<script>
var fsms_loglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsms_loglist = currentForm = new ew.Form("fsms_loglist", "list");
	fsms_loglist.formKeyCountName = '<?php echo $sms_log_list->FormKeyCountName ?>';
	loadjs.done("fsms_loglist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sms_log_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($sms_log_list->TotalRecords > 0 && $sms_log_list->ExportOptions->visible()) { ?>
<?php $sms_log_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($sms_log_list->ImportOptions->visible()) { ?>
<?php $sms_log_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$sms_log_list->renderOtherOptions();
?>
<?php $sms_log_list->showPageHeader(); ?>
<?php
$sms_log_list->showMessage();
?>
<?php if ($sms_log_list->TotalRecords > 0 || $sms_log->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$sms_log_list->isExport()) { ?>
<div>
<?php if (!$sms_log_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sms_log_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sms_log_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsms_loglist" id="fsms_loglist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_log">
<div class="row ew-multi-column-row">
<?php if ($sms_log_list->TotalRecords > 0 || $sms_log_list->isGridEdit()) { ?>
<?php
if ($sms_log_list->ExportAll && $sms_log_list->isExport()) {
	$sms_log_list->StopRecord = $sms_log_list->TotalRecords;
} else {

	// Set the last record to display
	if ($sms_log_list->TotalRecords > $sms_log_list->StartRecord + $sms_log_list->DisplayRecords - 1)
		$sms_log_list->StopRecord = $sms_log_list->StartRecord + $sms_log_list->DisplayRecords - 1;
	else
		$sms_log_list->StopRecord = $sms_log_list->TotalRecords;
}
$sms_log_list->RecordCount = $sms_log_list->StartRecord - 1;
if ($sms_log_list->Recordset && !$sms_log_list->Recordset->EOF) {
	$sms_log_list->Recordset->moveFirst();
	$selectLimit = $sms_log_list->UseSelectLimit;
	if (!$selectLimit && $sms_log_list->StartRecord > 1)
		$sms_log_list->Recordset->move($sms_log_list->StartRecord - 1);
} elseif (!$sms_log->AllowAddDeleteRow && $sms_log_list->StopRecord == 0) {
	$sms_log_list->StopRecord = $sms_log->GridAddRowCount;
}
while ($sms_log_list->RecordCount < $sms_log_list->StopRecord) {
	$sms_log_list->RecordCount++;
	if ($sms_log_list->RecordCount >= $sms_log_list->StartRecord) {
		$sms_log_list->RowCount++;

		// Set up key count
		$sms_log_list->KeyCount = $sms_log_list->RowIndex;

		// Init row class and style
		$sms_log->resetAttributes();
		$sms_log->CssClass = "";
		if ($sms_log_list->isGridAdd()) {
		} else {
			$sms_log_list->loadRowValues($sms_log_list->Recordset); // Load row values
		}
		$sms_log->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$sms_log->RowAttrs->merge(["data-rowindex" => $sms_log_list->RowCount, "id" => "r" . $sms_log_list->RowCount . "_sms_log", "data-rowtype" => $sms_log->RowType]);

		// Render row
		$sms_log_list->renderRow();

		// Render list options
		$sms_log_list->renderListOptions();
?>
<div class="<?php echo $sms_log_list->getMultiColumnClass() ?>" <?php echo $sms_log->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($sms_log->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($sms_log_list->sms_log_id->Visible) { // sms_log_id ?>
		<?php if ($sms_log->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_log_list->TableLeftColumnClass ?>"><span class="sms_log_sms_log_id">
<?php if ($sms_log_list->isExport() || $sms_log_list->SortUrl($sms_log_list->sms_log_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_log_list->SortUrl($sms_log_list->sms_log_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_log_list->sms_log_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_log_list->sms_log_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_log_list->sms_log_id->cellAttributes() ?>>
<span id="el<?php echo $sms_log_list->RowCount ?>_sms_log_sms_log_id">
<span<?php echo $sms_log_list->sms_log_id->viewAttributes() ?>><?php echo $sms_log_list->sms_log_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_log_sms_log_id">
			<label class="<?php echo $sms_log_list->LeftColumnClass ?>"><?php echo $sms_log_list->sms_log_id->caption() ?></label>
			<div class="<?php echo $sms_log_list->RightColumnClass ?>"><div <?php echo $sms_log_list->sms_log_id->cellAttributes() ?>>
<span id="el<?php echo $sms_log_list->RowCount ?>_sms_log_sms_log_id">
<span<?php echo $sms_log_list->sms_log_id->viewAttributes() ?>><?php echo $sms_log_list->sms_log_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_log_list->sms_log_branch_id->Visible) { // sms_log_branch_id ?>
		<?php if ($sms_log->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_log_list->TableLeftColumnClass ?>"><span class="sms_log_sms_log_branch_id">
<?php if ($sms_log_list->isExport() || $sms_log_list->SortUrl($sms_log_list->sms_log_branch_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_branch_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_log_list->SortUrl($sms_log_list->sms_log_branch_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_log_list->sms_log_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_log_list->sms_log_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_log_list->sms_log_branch_id->cellAttributes() ?>>
<span id="el<?php echo $sms_log_list->RowCount ?>_sms_log_sms_log_branch_id">
<span<?php echo $sms_log_list->sms_log_branch_id->viewAttributes() ?>><?php echo $sms_log_list->sms_log_branch_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_log_sms_log_branch_id">
			<label class="<?php echo $sms_log_list->LeftColumnClass ?>"><?php echo $sms_log_list->sms_log_branch_id->caption() ?></label>
			<div class="<?php echo $sms_log_list->RightColumnClass ?>"><div <?php echo $sms_log_list->sms_log_branch_id->cellAttributes() ?>>
<span id="el<?php echo $sms_log_list->RowCount ?>_sms_log_sms_log_branch_id">
<span<?php echo $sms_log_list->sms_log_branch_id->viewAttributes() ?>><?php echo $sms_log_list->sms_log_branch_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_log_list->sms_log_sms_api_id->Visible) { // sms_log_sms_api_id ?>
		<?php if ($sms_log->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_log_list->TableLeftColumnClass ?>"><span class="sms_log_sms_log_sms_api_id">
<?php if ($sms_log_list->isExport() || $sms_log_list->SortUrl($sms_log_list->sms_log_sms_api_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_sms_api_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_log_list->SortUrl($sms_log_list->sms_log_sms_api_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_sms_api_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_log_list->sms_log_sms_api_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_log_list->sms_log_sms_api_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_log_list->sms_log_sms_api_id->cellAttributes() ?>>
<span id="el<?php echo $sms_log_list->RowCount ?>_sms_log_sms_log_sms_api_id">
<span<?php echo $sms_log_list->sms_log_sms_api_id->viewAttributes() ?>><?php echo $sms_log_list->sms_log_sms_api_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_log_sms_log_sms_api_id">
			<label class="<?php echo $sms_log_list->LeftColumnClass ?>"><?php echo $sms_log_list->sms_log_sms_api_id->caption() ?></label>
			<div class="<?php echo $sms_log_list->RightColumnClass ?>"><div <?php echo $sms_log_list->sms_log_sms_api_id->cellAttributes() ?>>
<span id="el<?php echo $sms_log_list->RowCount ?>_sms_log_sms_log_sms_api_id">
<span<?php echo $sms_log_list->sms_log_sms_api_id->viewAttributes() ?>><?php echo $sms_log_list->sms_log_sms_api_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_log_list->sms_log_date->Visible) { // sms_log_date ?>
		<?php if ($sms_log->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_log_list->TableLeftColumnClass ?>"><span class="sms_log_sms_log_date">
<?php if ($sms_log_list->isExport() || $sms_log_list->SortUrl($sms_log_list->sms_log_date) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_date->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_log_list->SortUrl($sms_log_list->sms_log_date) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_log_list->sms_log_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_log_list->sms_log_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_log_list->sms_log_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_log_list->sms_log_date->cellAttributes() ?>>
<span id="el<?php echo $sms_log_list->RowCount ?>_sms_log_sms_log_date">
<span<?php echo $sms_log_list->sms_log_date->viewAttributes() ?>><?php echo $sms_log_list->sms_log_date->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_log_sms_log_date">
			<label class="<?php echo $sms_log_list->LeftColumnClass ?>"><?php echo $sms_log_list->sms_log_date->caption() ?></label>
			<div class="<?php echo $sms_log_list->RightColumnClass ?>"><div <?php echo $sms_log_list->sms_log_date->cellAttributes() ?>>
<span id="el<?php echo $sms_log_list->RowCount ?>_sms_log_sms_log_date">
<span<?php echo $sms_log_list->sms_log_date->viewAttributes() ?>><?php echo $sms_log_list->sms_log_date->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_log->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$sms_log_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$sms_log_list->ListOptions->render("body", "bottom", $sms_log_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$sms_log_list->isGridAdd())
		$sms_log_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$sms_log->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($sms_log_list->Recordset)
	$sms_log_list->Recordset->Close();
?>
<?php if (!$sms_log_list->isExport()) { ?>
<div>
<?php if (!$sms_log_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sms_log_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sms_log_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($sms_log_list->TotalRecords == 0 && !$sms_log->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $sms_log_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$sms_log_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sms_log_list->isExport()) { ?>
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
$sms_log_list->terminate();
?>