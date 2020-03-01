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
$sms_package_list = new sms_package_list();

// Run the page
$sms_package_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_package_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sms_package_list->isExport()) { ?>
<script>
var fsms_packagelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsms_packagelist = currentForm = new ew.Form("fsms_packagelist", "list");
	fsms_packagelist.formKeyCountName = '<?php echo $sms_package_list->FormKeyCountName ?>';
	loadjs.done("fsms_packagelist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sms_package_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($sms_package_list->TotalRecords > 0 && $sms_package_list->ExportOptions->visible()) { ?>
<?php $sms_package_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($sms_package_list->ImportOptions->visible()) { ?>
<?php $sms_package_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$sms_package_list->renderOtherOptions();
?>
<?php $sms_package_list->showPageHeader(); ?>
<?php
$sms_package_list->showMessage();
?>
<?php if ($sms_package_list->TotalRecords > 0 || $sms_package->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$sms_package_list->isExport()) { ?>
<div>
<?php if (!$sms_package_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sms_package_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sms_package_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsms_packagelist" id="fsms_packagelist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_package">
<div class="row ew-multi-column-row">
<?php if ($sms_package_list->TotalRecords > 0 || $sms_package_list->isGridEdit()) { ?>
<?php
if ($sms_package_list->ExportAll && $sms_package_list->isExport()) {
	$sms_package_list->StopRecord = $sms_package_list->TotalRecords;
} else {

	// Set the last record to display
	if ($sms_package_list->TotalRecords > $sms_package_list->StartRecord + $sms_package_list->DisplayRecords - 1)
		$sms_package_list->StopRecord = $sms_package_list->StartRecord + $sms_package_list->DisplayRecords - 1;
	else
		$sms_package_list->StopRecord = $sms_package_list->TotalRecords;
}
$sms_package_list->RecordCount = $sms_package_list->StartRecord - 1;
if ($sms_package_list->Recordset && !$sms_package_list->Recordset->EOF) {
	$sms_package_list->Recordset->moveFirst();
	$selectLimit = $sms_package_list->UseSelectLimit;
	if (!$selectLimit && $sms_package_list->StartRecord > 1)
		$sms_package_list->Recordset->move($sms_package_list->StartRecord - 1);
} elseif (!$sms_package->AllowAddDeleteRow && $sms_package_list->StopRecord == 0) {
	$sms_package_list->StopRecord = $sms_package->GridAddRowCount;
}
while ($sms_package_list->RecordCount < $sms_package_list->StopRecord) {
	$sms_package_list->RecordCount++;
	if ($sms_package_list->RecordCount >= $sms_package_list->StartRecord) {
		$sms_package_list->RowCount++;

		// Set up key count
		$sms_package_list->KeyCount = $sms_package_list->RowIndex;

		// Init row class and style
		$sms_package->resetAttributes();
		$sms_package->CssClass = "";
		if ($sms_package_list->isGridAdd()) {
		} else {
			$sms_package_list->loadRowValues($sms_package_list->Recordset); // Load row values
		}
		$sms_package->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$sms_package->RowAttrs->merge(["data-rowindex" => $sms_package_list->RowCount, "id" => "r" . $sms_package_list->RowCount . "_sms_package", "data-rowtype" => $sms_package->RowType]);

		// Render row
		$sms_package_list->renderRow();

		// Render list options
		$sms_package_list->renderListOptions();
?>
<div class="<?php echo $sms_package_list->getMultiColumnClass() ?>" <?php echo $sms_package->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($sms_package->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($sms_package_list->sms_pkg_id->Visible) { // sms_pkg_id ?>
		<?php if ($sms_package->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_package_list->TableLeftColumnClass ?>"><span class="sms_package_sms_pkg_id">
<?php if ($sms_package_list->isExport() || $sms_package_list->SortUrl($sms_package_list->sms_pkg_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_package_list->SortUrl($sms_package_list->sms_pkg_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_package_list->sms_pkg_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_package_list->sms_pkg_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_package_list->sms_pkg_id->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_id">
<span<?php echo $sms_package_list->sms_pkg_id->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_package_sms_pkg_id">
			<label class="<?php echo $sms_package_list->LeftColumnClass ?>"><?php echo $sms_package_list->sms_pkg_id->caption() ?></label>
			<div class="<?php echo $sms_package_list->RightColumnClass ?>"><div <?php echo $sms_package_list->sms_pkg_id->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_id">
<span<?php echo $sms_package_list->sms_pkg_id->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_package_list->sms_pkg_branch_id->Visible) { // sms_pkg_branch_id ?>
		<?php if ($sms_package->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_package_list->TableLeftColumnClass ?>"><span class="sms_package_sms_pkg_branch_id">
<?php if ($sms_package_list->isExport() || $sms_package_list->SortUrl($sms_package_list->sms_pkg_branch_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_branch_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_package_list->SortUrl($sms_package_list->sms_pkg_branch_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_package_list->sms_pkg_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_package_list->sms_pkg_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_package_list->sms_pkg_branch_id->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_branch_id">
<span<?php echo $sms_package_list->sms_pkg_branch_id->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_branch_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_package_sms_pkg_branch_id">
			<label class="<?php echo $sms_package_list->LeftColumnClass ?>"><?php echo $sms_package_list->sms_pkg_branch_id->caption() ?></label>
			<div class="<?php echo $sms_package_list->RightColumnClass ?>"><div <?php echo $sms_package_list->sms_pkg_branch_id->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_branch_id">
<span<?php echo $sms_package_list->sms_pkg_branch_id->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_branch_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_package_list->sms_pkg_sms_api_id->Visible) { // sms_pkg_sms_api_id ?>
		<?php if ($sms_package->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_package_list->TableLeftColumnClass ?>"><span class="sms_package_sms_pkg_sms_api_id">
<?php if ($sms_package_list->isExport() || $sms_package_list->SortUrl($sms_package_list->sms_pkg_sms_api_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_sms_api_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_package_list->SortUrl($sms_package_list->sms_pkg_sms_api_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_sms_api_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_package_list->sms_pkg_sms_api_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_package_list->sms_pkg_sms_api_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_package_list->sms_pkg_sms_api_id->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_sms_api_id">
<span<?php echo $sms_package_list->sms_pkg_sms_api_id->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_sms_api_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_package_sms_pkg_sms_api_id">
			<label class="<?php echo $sms_package_list->LeftColumnClass ?>"><?php echo $sms_package_list->sms_pkg_sms_api_id->caption() ?></label>
			<div class="<?php echo $sms_package_list->RightColumnClass ?>"><div <?php echo $sms_package_list->sms_pkg_sms_api_id->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_sms_api_id">
<span<?php echo $sms_package_list->sms_pkg_sms_api_id->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_sms_api_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_package_list->sms_pkg_total_allowed_sms->Visible) { // sms_pkg_total_allowed_sms ?>
		<?php if ($sms_package->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_package_list->TableLeftColumnClass ?>"><span class="sms_package_sms_pkg_total_allowed_sms">
<?php if ($sms_package_list->isExport() || $sms_package_list->SortUrl($sms_package_list->sms_pkg_total_allowed_sms) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_total_allowed_sms->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_package_list->SortUrl($sms_package_list->sms_pkg_total_allowed_sms) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_total_allowed_sms->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_package_list->sms_pkg_total_allowed_sms->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_package_list->sms_pkg_total_allowed_sms->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_package_list->sms_pkg_total_allowed_sms->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_total_allowed_sms">
<span<?php echo $sms_package_list->sms_pkg_total_allowed_sms->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_total_allowed_sms->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_package_sms_pkg_total_allowed_sms">
			<label class="<?php echo $sms_package_list->LeftColumnClass ?>"><?php echo $sms_package_list->sms_pkg_total_allowed_sms->caption() ?></label>
			<div class="<?php echo $sms_package_list->RightColumnClass ?>"><div <?php echo $sms_package_list->sms_pkg_total_allowed_sms->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_total_allowed_sms">
<span<?php echo $sms_package_list->sms_pkg_total_allowed_sms->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_total_allowed_sms->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_package_list->sms_pkg_expiry_date->Visible) { // sms_pkg_expiry_date ?>
		<?php if ($sms_package->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_package_list->TableLeftColumnClass ?>"><span class="sms_package_sms_pkg_expiry_date">
<?php if ($sms_package_list->isExport() || $sms_package_list->SortUrl($sms_package_list->sms_pkg_expiry_date) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_expiry_date->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_package_list->SortUrl($sms_package_list->sms_pkg_expiry_date) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_expiry_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_package_list->sms_pkg_expiry_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_package_list->sms_pkg_expiry_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_package_list->sms_pkg_expiry_date->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_expiry_date">
<span<?php echo $sms_package_list->sms_pkg_expiry_date->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_expiry_date->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_package_sms_pkg_expiry_date">
			<label class="<?php echo $sms_package_list->LeftColumnClass ?>"><?php echo $sms_package_list->sms_pkg_expiry_date->caption() ?></label>
			<div class="<?php echo $sms_package_list->RightColumnClass ?>"><div <?php echo $sms_package_list->sms_pkg_expiry_date->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_expiry_date">
<span<?php echo $sms_package_list->sms_pkg_expiry_date->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_expiry_date->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_package_list->sms_pkg_per_sms_cost->Visible) { // sms_pkg_per_sms_cost ?>
		<?php if ($sms_package->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $sms_package_list->TableLeftColumnClass ?>"><span class="sms_package_sms_pkg_per_sms_cost">
<?php if ($sms_package_list->isExport() || $sms_package_list->SortUrl($sms_package_list->sms_pkg_per_sms_cost) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_per_sms_cost->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sms_package_list->SortUrl($sms_package_list->sms_pkg_per_sms_cost) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sms_package_list->sms_pkg_per_sms_cost->caption() ?></span><span class="ew-table-header-sort"><?php if ($sms_package_list->sms_pkg_per_sms_cost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sms_package_list->sms_pkg_per_sms_cost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $sms_package_list->sms_pkg_per_sms_cost->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_per_sms_cost">
<span<?php echo $sms_package_list->sms_pkg_per_sms_cost->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_per_sms_cost->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row sms_package_sms_pkg_per_sms_cost">
			<label class="<?php echo $sms_package_list->LeftColumnClass ?>"><?php echo $sms_package_list->sms_pkg_per_sms_cost->caption() ?></label>
			<div class="<?php echo $sms_package_list->RightColumnClass ?>"><div <?php echo $sms_package_list->sms_pkg_per_sms_cost->cellAttributes() ?>>
<span id="el<?php echo $sms_package_list->RowCount ?>_sms_package_sms_pkg_per_sms_cost">
<span<?php echo $sms_package_list->sms_pkg_per_sms_cost->viewAttributes() ?>><?php echo $sms_package_list->sms_pkg_per_sms_cost->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($sms_package->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$sms_package_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$sms_package_list->ListOptions->render("body", "bottom", $sms_package_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$sms_package_list->isGridAdd())
		$sms_package_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$sms_package->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($sms_package_list->Recordset)
	$sms_package_list->Recordset->Close();
?>
<?php if (!$sms_package_list->isExport()) { ?>
<div>
<?php if (!$sms_package_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sms_package_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sms_package_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($sms_package_list->TotalRecords == 0 && !$sms_package->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $sms_package_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$sms_package_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sms_package_list->isExport()) { ?>
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
$sms_package_list->terminate();
?>