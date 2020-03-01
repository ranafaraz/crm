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
$acc_transaction_list = new acc_transaction_list();

// Run the page
$acc_transaction_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acc_transaction_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$acc_transaction_list->isExport()) { ?>
<script>
var facc_transactionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	facc_transactionlist = currentForm = new ew.Form("facc_transactionlist", "list");
	facc_transactionlist.formKeyCountName = '<?php echo $acc_transaction_list->FormKeyCountName ?>';
	loadjs.done("facc_transactionlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$acc_transaction_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($acc_transaction_list->TotalRecords > 0 && $acc_transaction_list->ExportOptions->visible()) { ?>
<?php $acc_transaction_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($acc_transaction_list->ImportOptions->visible()) { ?>
<?php $acc_transaction_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$acc_transaction_list->renderOtherOptions();
?>
<?php $acc_transaction_list->showPageHeader(); ?>
<?php
$acc_transaction_list->showMessage();
?>
<?php if ($acc_transaction_list->TotalRecords > 0 || $acc_transaction->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$acc_transaction_list->isExport()) { ?>
<div>
<?php if (!$acc_transaction_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acc_transaction_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $acc_transaction_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="facc_transactionlist" id="facc_transactionlist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acc_transaction">
<div class="row ew-multi-column-row">
<?php if ($acc_transaction_list->TotalRecords > 0 || $acc_transaction_list->isGridEdit()) { ?>
<?php
if ($acc_transaction_list->ExportAll && $acc_transaction_list->isExport()) {
	$acc_transaction_list->StopRecord = $acc_transaction_list->TotalRecords;
} else {

	// Set the last record to display
	if ($acc_transaction_list->TotalRecords > $acc_transaction_list->StartRecord + $acc_transaction_list->DisplayRecords - 1)
		$acc_transaction_list->StopRecord = $acc_transaction_list->StartRecord + $acc_transaction_list->DisplayRecords - 1;
	else
		$acc_transaction_list->StopRecord = $acc_transaction_list->TotalRecords;
}
$acc_transaction_list->RecordCount = $acc_transaction_list->StartRecord - 1;
if ($acc_transaction_list->Recordset && !$acc_transaction_list->Recordset->EOF) {
	$acc_transaction_list->Recordset->moveFirst();
	$selectLimit = $acc_transaction_list->UseSelectLimit;
	if (!$selectLimit && $acc_transaction_list->StartRecord > 1)
		$acc_transaction_list->Recordset->move($acc_transaction_list->StartRecord - 1);
} elseif (!$acc_transaction->AllowAddDeleteRow && $acc_transaction_list->StopRecord == 0) {
	$acc_transaction_list->StopRecord = $acc_transaction->GridAddRowCount;
}
while ($acc_transaction_list->RecordCount < $acc_transaction_list->StopRecord) {
	$acc_transaction_list->RecordCount++;
	if ($acc_transaction_list->RecordCount >= $acc_transaction_list->StartRecord) {
		$acc_transaction_list->RowCount++;

		// Set up key count
		$acc_transaction_list->KeyCount = $acc_transaction_list->RowIndex;

		// Init row class and style
		$acc_transaction->resetAttributes();
		$acc_transaction->CssClass = "";
		if ($acc_transaction_list->isGridAdd()) {
		} else {
			$acc_transaction_list->loadRowValues($acc_transaction_list->Recordset); // Load row values
		}
		$acc_transaction->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$acc_transaction->RowAttrs->merge(["data-rowindex" => $acc_transaction_list->RowCount, "id" => "r" . $acc_transaction_list->RowCount . "_acc_transaction", "data-rowtype" => $acc_transaction->RowType]);

		// Render row
		$acc_transaction_list->renderRow();

		// Render list options
		$acc_transaction_list->renderListOptions();
?>
<div class="<?php echo $acc_transaction_list->getMultiColumnClass() ?>" <?php echo $acc_transaction->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($acc_transaction->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($acc_transaction_list->acc_trans_id->Visible) { // acc_trans_id ?>
		<?php if ($acc_transaction->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $acc_transaction_list->TableLeftColumnClass ?>"><span class="acc_transaction_acc_trans_id">
<?php if ($acc_transaction_list->isExport() || $acc_transaction_list->SortUrl($acc_transaction_list->acc_trans_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $acc_transaction_list->acc_trans_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acc_transaction_list->SortUrl($acc_transaction_list->acc_trans_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acc_transaction_list->acc_trans_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($acc_transaction_list->acc_trans_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acc_transaction_list->acc_trans_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $acc_transaction_list->acc_trans_id->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_list->RowCount ?>_acc_transaction_acc_trans_id">
<span<?php echo $acc_transaction_list->acc_trans_id->viewAttributes() ?>><?php echo $acc_transaction_list->acc_trans_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row acc_transaction_acc_trans_id">
			<label class="<?php echo $acc_transaction_list->LeftColumnClass ?>"><?php echo $acc_transaction_list->acc_trans_id->caption() ?></label>
			<div class="<?php echo $acc_transaction_list->RightColumnClass ?>"><div <?php echo $acc_transaction_list->acc_trans_id->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_list->RowCount ?>_acc_transaction_acc_trans_id">
<span<?php echo $acc_transaction_list->acc_trans_id->viewAttributes() ?>><?php echo $acc_transaction_list->acc_trans_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($acc_transaction_list->acc_trans_branch_id->Visible) { // acc_trans_branch_id ?>
		<?php if ($acc_transaction->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $acc_transaction_list->TableLeftColumnClass ?>"><span class="acc_transaction_acc_trans_branch_id">
<?php if ($acc_transaction_list->isExport() || $acc_transaction_list->SortUrl($acc_transaction_list->acc_trans_branch_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $acc_transaction_list->acc_trans_branch_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acc_transaction_list->SortUrl($acc_transaction_list->acc_trans_branch_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acc_transaction_list->acc_trans_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($acc_transaction_list->acc_trans_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acc_transaction_list->acc_trans_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $acc_transaction_list->acc_trans_branch_id->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_list->RowCount ?>_acc_transaction_acc_trans_branch_id">
<span<?php echo $acc_transaction_list->acc_trans_branch_id->viewAttributes() ?>><?php echo $acc_transaction_list->acc_trans_branch_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row acc_transaction_acc_trans_branch_id">
			<label class="<?php echo $acc_transaction_list->LeftColumnClass ?>"><?php echo $acc_transaction_list->acc_trans_branch_id->caption() ?></label>
			<div class="<?php echo $acc_transaction_list->RightColumnClass ?>"><div <?php echo $acc_transaction_list->acc_trans_branch_id->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_list->RowCount ?>_acc_transaction_acc_trans_branch_id">
<span<?php echo $acc_transaction_list->acc_trans_branch_id->viewAttributes() ?>><?php echo $acc_transaction_list->acc_trans_branch_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($acc_transaction_list->acc_trans_acc_head_id->Visible) { // acc_trans_acc_head_id ?>
		<?php if ($acc_transaction->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $acc_transaction_list->TableLeftColumnClass ?>"><span class="acc_transaction_acc_trans_acc_head_id">
<?php if ($acc_transaction_list->isExport() || $acc_transaction_list->SortUrl($acc_transaction_list->acc_trans_acc_head_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $acc_transaction_list->acc_trans_acc_head_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acc_transaction_list->SortUrl($acc_transaction_list->acc_trans_acc_head_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acc_transaction_list->acc_trans_acc_head_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($acc_transaction_list->acc_trans_acc_head_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acc_transaction_list->acc_trans_acc_head_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $acc_transaction_list->acc_trans_acc_head_id->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_list->RowCount ?>_acc_transaction_acc_trans_acc_head_id">
<span<?php echo $acc_transaction_list->acc_trans_acc_head_id->viewAttributes() ?>><?php echo $acc_transaction_list->acc_trans_acc_head_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row acc_transaction_acc_trans_acc_head_id">
			<label class="<?php echo $acc_transaction_list->LeftColumnClass ?>"><?php echo $acc_transaction_list->acc_trans_acc_head_id->caption() ?></label>
			<div class="<?php echo $acc_transaction_list->RightColumnClass ?>"><div <?php echo $acc_transaction_list->acc_trans_acc_head_id->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_list->RowCount ?>_acc_transaction_acc_trans_acc_head_id">
<span<?php echo $acc_transaction_list->acc_trans_acc_head_id->viewAttributes() ?>><?php echo $acc_transaction_list->acc_trans_acc_head_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($acc_transaction_list->acc_trans_amount->Visible) { // acc_trans_amount ?>
		<?php if ($acc_transaction->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $acc_transaction_list->TableLeftColumnClass ?>"><span class="acc_transaction_acc_trans_amount">
<?php if ($acc_transaction_list->isExport() || $acc_transaction_list->SortUrl($acc_transaction_list->acc_trans_amount) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $acc_transaction_list->acc_trans_amount->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acc_transaction_list->SortUrl($acc_transaction_list->acc_trans_amount) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acc_transaction_list->acc_trans_amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($acc_transaction_list->acc_trans_amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acc_transaction_list->acc_trans_amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $acc_transaction_list->acc_trans_amount->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_list->RowCount ?>_acc_transaction_acc_trans_amount">
<span<?php echo $acc_transaction_list->acc_trans_amount->viewAttributes() ?>><?php echo $acc_transaction_list->acc_trans_amount->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row acc_transaction_acc_trans_amount">
			<label class="<?php echo $acc_transaction_list->LeftColumnClass ?>"><?php echo $acc_transaction_list->acc_trans_amount->caption() ?></label>
			<div class="<?php echo $acc_transaction_list->RightColumnClass ?>"><div <?php echo $acc_transaction_list->acc_trans_amount->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_list->RowCount ?>_acc_transaction_acc_trans_amount">
<span<?php echo $acc_transaction_list->acc_trans_amount->viewAttributes() ?>><?php echo $acc_transaction_list->acc_trans_amount->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($acc_transaction_list->acc_trans_date->Visible) { // acc_trans_date ?>
		<?php if ($acc_transaction->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $acc_transaction_list->TableLeftColumnClass ?>"><span class="acc_transaction_acc_trans_date">
<?php if ($acc_transaction_list->isExport() || $acc_transaction_list->SortUrl($acc_transaction_list->acc_trans_date) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $acc_transaction_list->acc_trans_date->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acc_transaction_list->SortUrl($acc_transaction_list->acc_trans_date) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acc_transaction_list->acc_trans_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($acc_transaction_list->acc_trans_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acc_transaction_list->acc_trans_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $acc_transaction_list->acc_trans_date->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_list->RowCount ?>_acc_transaction_acc_trans_date">
<span<?php echo $acc_transaction_list->acc_trans_date->viewAttributes() ?>><?php echo $acc_transaction_list->acc_trans_date->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row acc_transaction_acc_trans_date">
			<label class="<?php echo $acc_transaction_list->LeftColumnClass ?>"><?php echo $acc_transaction_list->acc_trans_date->caption() ?></label>
			<div class="<?php echo $acc_transaction_list->RightColumnClass ?>"><div <?php echo $acc_transaction_list->acc_trans_date->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_list->RowCount ?>_acc_transaction_acc_trans_date">
<span<?php echo $acc_transaction_list->acc_trans_date->viewAttributes() ?>><?php echo $acc_transaction_list->acc_trans_date->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($acc_transaction->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$acc_transaction_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$acc_transaction_list->ListOptions->render("body", "bottom", $acc_transaction_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$acc_transaction_list->isGridAdd())
		$acc_transaction_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$acc_transaction->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($acc_transaction_list->Recordset)
	$acc_transaction_list->Recordset->Close();
?>
<?php if (!$acc_transaction_list->isExport()) { ?>
<div>
<?php if (!$acc_transaction_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acc_transaction_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $acc_transaction_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($acc_transaction_list->TotalRecords == 0 && !$acc_transaction->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $acc_transaction_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$acc_transaction_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$acc_transaction_list->isExport()) { ?>
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
$acc_transaction_list->terminate();
?>