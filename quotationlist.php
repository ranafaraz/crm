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
$quotation_list = new quotation_list();

// Run the page
$quotation_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$quotation_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$quotation_list->isExport()) { ?>
<script>
var fquotationlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fquotationlist = currentForm = new ew.Form("fquotationlist", "list");
	fquotationlist.formKeyCountName = '<?php echo $quotation_list->FormKeyCountName ?>';
	loadjs.done("fquotationlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$quotation_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($quotation_list->TotalRecords > 0 && $quotation_list->ExportOptions->visible()) { ?>
<?php $quotation_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($quotation_list->ImportOptions->visible()) { ?>
<?php $quotation_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$quotation_list->renderOtherOptions();
?>
<?php $quotation_list->showPageHeader(); ?>
<?php
$quotation_list->showMessage();
?>
<?php if ($quotation_list->TotalRecords > 0 || $quotation->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<?php if (!$quotation_list->isExport()) { ?>
<div>
<?php if (!$quotation_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $quotation_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $quotation_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fquotationlist" id="fquotationlist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="quotation">
<div class="row ew-multi-column-row">
<?php if ($quotation_list->TotalRecords > 0 || $quotation_list->isGridEdit()) { ?>
<?php
if ($quotation_list->ExportAll && $quotation_list->isExport()) {
	$quotation_list->StopRecord = $quotation_list->TotalRecords;
} else {

	// Set the last record to display
	if ($quotation_list->TotalRecords > $quotation_list->StartRecord + $quotation_list->DisplayRecords - 1)
		$quotation_list->StopRecord = $quotation_list->StartRecord + $quotation_list->DisplayRecords - 1;
	else
		$quotation_list->StopRecord = $quotation_list->TotalRecords;
}
$quotation_list->RecordCount = $quotation_list->StartRecord - 1;
if ($quotation_list->Recordset && !$quotation_list->Recordset->EOF) {
	$quotation_list->Recordset->moveFirst();
	$selectLimit = $quotation_list->UseSelectLimit;
	if (!$selectLimit && $quotation_list->StartRecord > 1)
		$quotation_list->Recordset->move($quotation_list->StartRecord - 1);
} elseif (!$quotation->AllowAddDeleteRow && $quotation_list->StopRecord == 0) {
	$quotation_list->StopRecord = $quotation->GridAddRowCount;
}
while ($quotation_list->RecordCount < $quotation_list->StopRecord) {
	$quotation_list->RecordCount++;
	if ($quotation_list->RecordCount >= $quotation_list->StartRecord) {
		$quotation_list->RowCount++;

		// Set up key count
		$quotation_list->KeyCount = $quotation_list->RowIndex;

		// Init row class and style
		$quotation->resetAttributes();
		$quotation->CssClass = "";
		if ($quotation_list->isGridAdd()) {
		} else {
			$quotation_list->loadRowValues($quotation_list->Recordset); // Load row values
		}
		$quotation->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$quotation->RowAttrs->merge(["data-rowindex" => $quotation_list->RowCount, "id" => "r" . $quotation_list->RowCount . "_quotation", "data-rowtype" => $quotation->RowType]);

		// Render row
		$quotation_list->renderRow();

		// Render list options
		$quotation_list->renderListOptions();
?>
<div class="<?php echo $quotation_list->getMultiColumnClass() ?>" <?php echo $quotation->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($quotation->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($quotation_list->quote_id->Visible) { // quote_id ?>
		<?php if ($quotation->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $quotation_list->TableLeftColumnClass ?>"><span class="quotation_quote_id">
<?php if ($quotation_list->isExport() || $quotation_list->SortUrl($quotation_list->quote_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $quotation_list->quote_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quotation_list->SortUrl($quotation_list->quote_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quotation_list->quote_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($quotation_list->quote_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quotation_list->quote_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $quotation_list->quote_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_id">
<span<?php echo $quotation_list->quote_id->viewAttributes() ?>><?php echo $quotation_list->quote_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row quotation_quote_id">
			<label class="<?php echo $quotation_list->LeftColumnClass ?>"><?php echo $quotation_list->quote_id->caption() ?></label>
			<div class="<?php echo $quotation_list->RightColumnClass ?>"><div <?php echo $quotation_list->quote_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_id">
<span<?php echo $quotation_list->quote_id->viewAttributes() ?>><?php echo $quotation_list->quote_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($quotation_list->quote_branch_id->Visible) { // quote_branch_id ?>
		<?php if ($quotation->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $quotation_list->TableLeftColumnClass ?>"><span class="quotation_quote_branch_id">
<?php if ($quotation_list->isExport() || $quotation_list->SortUrl($quotation_list->quote_branch_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $quotation_list->quote_branch_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quotation_list->SortUrl($quotation_list->quote_branch_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quotation_list->quote_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($quotation_list->quote_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quotation_list->quote_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $quotation_list->quote_branch_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_branch_id">
<span<?php echo $quotation_list->quote_branch_id->viewAttributes() ?>><?php echo $quotation_list->quote_branch_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row quotation_quote_branch_id">
			<label class="<?php echo $quotation_list->LeftColumnClass ?>"><?php echo $quotation_list->quote_branch_id->caption() ?></label>
			<div class="<?php echo $quotation_list->RightColumnClass ?>"><div <?php echo $quotation_list->quote_branch_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_branch_id">
<span<?php echo $quotation_list->quote_branch_id->viewAttributes() ?>><?php echo $quotation_list->quote_branch_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($quotation_list->quote_business_id->Visible) { // quote_business_id ?>
		<?php if ($quotation->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $quotation_list->TableLeftColumnClass ?>"><span class="quotation_quote_business_id">
<?php if ($quotation_list->isExport() || $quotation_list->SortUrl($quotation_list->quote_business_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $quotation_list->quote_business_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quotation_list->SortUrl($quotation_list->quote_business_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quotation_list->quote_business_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($quotation_list->quote_business_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quotation_list->quote_business_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $quotation_list->quote_business_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_business_id">
<span<?php echo $quotation_list->quote_business_id->viewAttributes() ?>><?php echo $quotation_list->quote_business_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row quotation_quote_business_id">
			<label class="<?php echo $quotation_list->LeftColumnClass ?>"><?php echo $quotation_list->quote_business_id->caption() ?></label>
			<div class="<?php echo $quotation_list->RightColumnClass ?>"><div <?php echo $quotation_list->quote_business_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_business_id">
<span<?php echo $quotation_list->quote_business_id->viewAttributes() ?>><?php echo $quotation_list->quote_business_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($quotation_list->quote_service_id->Visible) { // quote_service_id ?>
		<?php if ($quotation->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $quotation_list->TableLeftColumnClass ?>"><span class="quotation_quote_service_id">
<?php if ($quotation_list->isExport() || $quotation_list->SortUrl($quotation_list->quote_service_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $quotation_list->quote_service_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quotation_list->SortUrl($quotation_list->quote_service_id) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quotation_list->quote_service_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($quotation_list->quote_service_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quotation_list->quote_service_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $quotation_list->quote_service_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_service_id">
<span<?php echo $quotation_list->quote_service_id->viewAttributes() ?>><?php echo $quotation_list->quote_service_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row quotation_quote_service_id">
			<label class="<?php echo $quotation_list->LeftColumnClass ?>"><?php echo $quotation_list->quote_service_id->caption() ?></label>
			<div class="<?php echo $quotation_list->RightColumnClass ?>"><div <?php echo $quotation_list->quote_service_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_service_id">
<span<?php echo $quotation_list->quote_service_id->viewAttributes() ?>><?php echo $quotation_list->quote_service_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($quotation_list->quote_issue_date->Visible) { // quote_issue_date ?>
		<?php if ($quotation->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $quotation_list->TableLeftColumnClass ?>"><span class="quotation_quote_issue_date">
<?php if ($quotation_list->isExport() || $quotation_list->SortUrl($quotation_list->quote_issue_date) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $quotation_list->quote_issue_date->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quotation_list->SortUrl($quotation_list->quote_issue_date) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quotation_list->quote_issue_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($quotation_list->quote_issue_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quotation_list->quote_issue_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $quotation_list->quote_issue_date->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_issue_date">
<span<?php echo $quotation_list->quote_issue_date->viewAttributes() ?>><?php echo $quotation_list->quote_issue_date->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row quotation_quote_issue_date">
			<label class="<?php echo $quotation_list->LeftColumnClass ?>"><?php echo $quotation_list->quote_issue_date->caption() ?></label>
			<div class="<?php echo $quotation_list->RightColumnClass ?>"><div <?php echo $quotation_list->quote_issue_date->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_issue_date">
<span<?php echo $quotation_list->quote_issue_date->viewAttributes() ?>><?php echo $quotation_list->quote_issue_date->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($quotation_list->quote_due_date->Visible) { // quote_due_date ?>
		<?php if ($quotation->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $quotation_list->TableLeftColumnClass ?>"><span class="quotation_quote_due_date">
<?php if ($quotation_list->isExport() || $quotation_list->SortUrl($quotation_list->quote_due_date) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $quotation_list->quote_due_date->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quotation_list->SortUrl($quotation_list->quote_due_date) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quotation_list->quote_due_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($quotation_list->quote_due_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quotation_list->quote_due_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $quotation_list->quote_due_date->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_due_date">
<span<?php echo $quotation_list->quote_due_date->viewAttributes() ?>><?php echo $quotation_list->quote_due_date->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row quotation_quote_due_date">
			<label class="<?php echo $quotation_list->LeftColumnClass ?>"><?php echo $quotation_list->quote_due_date->caption() ?></label>
			<div class="<?php echo $quotation_list->RightColumnClass ?>"><div <?php echo $quotation_list->quote_due_date->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_due_date">
<span<?php echo $quotation_list->quote_due_date->viewAttributes() ?>><?php echo $quotation_list->quote_due_date->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($quotation_list->quote_amount->Visible) { // quote_amount ?>
		<?php if ($quotation->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $quotation_list->TableLeftColumnClass ?>"><span class="quotation_quote_amount">
<?php if ($quotation_list->isExport() || $quotation_list->SortUrl($quotation_list->quote_amount) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $quotation_list->quote_amount->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quotation_list->SortUrl($quotation_list->quote_amount) ?>', 1);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quotation_list->quote_amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($quotation_list->quote_amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quotation_list->quote_amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $quotation_list->quote_amount->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_amount">
<span<?php echo $quotation_list->quote_amount->viewAttributes() ?>><?php echo $quotation_list->quote_amount->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row quotation_quote_amount">
			<label class="<?php echo $quotation_list->LeftColumnClass ?>"><?php echo $quotation_list->quote_amount->caption() ?></label>
			<div class="<?php echo $quotation_list->RightColumnClass ?>"><div <?php echo $quotation_list->quote_amount->cellAttributes() ?>>
<span id="el<?php echo $quotation_list->RowCount ?>_quotation_quote_amount">
<span<?php echo $quotation_list->quote_amount->viewAttributes() ?>><?php echo $quotation_list->quote_amount->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($quotation->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$quotation_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$quotation_list->ListOptions->render("body", "bottom", $quotation_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$quotation_list->isGridAdd())
		$quotation_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$quotation->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($quotation_list->Recordset)
	$quotation_list->Recordset->Close();
?>
<?php if (!$quotation_list->isExport()) { ?>
<div>
<?php if (!$quotation_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $quotation_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $quotation_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($quotation_list->TotalRecords == 0 && !$quotation->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $quotation_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$quotation_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$quotation_list->isExport()) { ?>
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
$quotation_list->terminate();
?>