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
$services_availed_by_customer_list = new services_availed_by_customer_list();

// Run the page
$services_availed_by_customer_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$services_availed_by_customer_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$services_availed_by_customer_list->isExport()) { ?>
<script>
var fservices_availed_by_customerlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fservices_availed_by_customerlist = currentForm = new ew.Form("fservices_availed_by_customerlist", "list");
	fservices_availed_by_customerlist.formKeyCountName = '<?php echo $services_availed_by_customer_list->FormKeyCountName ?>';
	loadjs.done("fservices_availed_by_customerlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$services_availed_by_customer_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($services_availed_by_customer_list->TotalRecords > 0 && $services_availed_by_customer_list->ExportOptions->visible()) { ?>
<?php $services_availed_by_customer_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($services_availed_by_customer_list->ImportOptions->visible()) { ?>
<?php $services_availed_by_customer_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$services_availed_by_customer_list->renderOtherOptions();
?>
<?php $services_availed_by_customer_list->showPageHeader(); ?>
<?php
$services_availed_by_customer_list->showMessage();
?>
<?php if ($services_availed_by_customer_list->TotalRecords > 0 || $services_availed_by_customer->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($services_availed_by_customer_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> services_availed_by_customer">
<?php if (!$services_availed_by_customer_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$services_availed_by_customer_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $services_availed_by_customer_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $services_availed_by_customer_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fservices_availed_by_customerlist" id="fservices_availed_by_customerlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="services_availed_by_customer">
<div id="gmp_services_availed_by_customer" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($services_availed_by_customer_list->TotalRecords > 0 || $services_availed_by_customer_list->isGridEdit()) { ?>
<table id="tbl_services_availed_by_customerlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$services_availed_by_customer->RowType = ROWTYPE_HEADER;

// Render list options
$services_availed_by_customer_list->renderListOptions();

// Render list options (header, left)
$services_availed_by_customer_list->ListOptions->render("header", "left");
?>
<?php if ($services_availed_by_customer_list->sabc_id->Visible) { // sabc_id ?>
	<?php if ($services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_id) == "") { ?>
		<th data-name="sabc_id" class="<?php echo $services_availed_by_customer_list->sabc_id->headerCellClass() ?>"><div id="elh_services_availed_by_customer_sabc_id" class="services_availed_by_customer_sabc_id"><div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sabc_id" class="<?php echo $services_availed_by_customer_list->sabc_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_id) ?>', 1);"><div id="elh_services_availed_by_customer_sabc_id" class="services_availed_by_customer_sabc_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($services_availed_by_customer_list->sabc_branch_id->Visible) { // sabc_branch_id ?>
	<?php if ($services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_branch_id) == "") { ?>
		<th data-name="sabc_branch_id" class="<?php echo $services_availed_by_customer_list->sabc_branch_id->headerCellClass() ?>"><div id="elh_services_availed_by_customer_sabc_branch_id" class="services_availed_by_customer_sabc_branch_id"><div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_branch_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sabc_branch_id" class="<?php echo $services_availed_by_customer_list->sabc_branch_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_branch_id) ?>', 1);"><div id="elh_services_availed_by_customer_sabc_branch_id" class="services_availed_by_customer_sabc_branch_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_branch_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_branch_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_branch_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($services_availed_by_customer_list->sabc_business_id->Visible) { // sabc_business_id ?>
	<?php if ($services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_business_id) == "") { ?>
		<th data-name="sabc_business_id" class="<?php echo $services_availed_by_customer_list->sabc_business_id->headerCellClass() ?>"><div id="elh_services_availed_by_customer_sabc_business_id" class="services_availed_by_customer_sabc_business_id"><div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_business_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sabc_business_id" class="<?php echo $services_availed_by_customer_list->sabc_business_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_business_id) ?>', 1);"><div id="elh_services_availed_by_customer_sabc_business_id" class="services_availed_by_customer_sabc_business_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_business_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_business_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_business_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($services_availed_by_customer_list->sabc_service_id->Visible) { // sabc_service_id ?>
	<?php if ($services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_service_id) == "") { ?>
		<th data-name="sabc_service_id" class="<?php echo $services_availed_by_customer_list->sabc_service_id->headerCellClass() ?>"><div id="elh_services_availed_by_customer_sabc_service_id" class="services_availed_by_customer_sabc_service_id"><div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_service_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sabc_service_id" class="<?php echo $services_availed_by_customer_list->sabc_service_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_service_id) ?>', 1);"><div id="elh_services_availed_by_customer_sabc_service_id" class="services_availed_by_customer_sabc_service_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_service_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_service_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_service_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($services_availed_by_customer_list->sabc_pkg->Visible) { // sabc_pkg ?>
	<?php if ($services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_pkg) == "") { ?>
		<th data-name="sabc_pkg" class="<?php echo $services_availed_by_customer_list->sabc_pkg->headerCellClass() ?>"><div id="elh_services_availed_by_customer_sabc_pkg" class="services_availed_by_customer_sabc_pkg"><div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_pkg->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sabc_pkg" class="<?php echo $services_availed_by_customer_list->sabc_pkg->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_pkg) ?>', 1);"><div id="elh_services_availed_by_customer_sabc_pkg" class="services_availed_by_customer_sabc_pkg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_pkg->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_pkg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_pkg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($services_availed_by_customer_list->sabc_amount->Visible) { // sabc_amount ?>
	<?php if ($services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_amount) == "") { ?>
		<th data-name="sabc_amount" class="<?php echo $services_availed_by_customer_list->sabc_amount->headerCellClass() ?>"><div id="elh_services_availed_by_customer_sabc_amount" class="services_availed_by_customer_sabc_amount"><div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_amount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sabc_amount" class="<?php echo $services_availed_by_customer_list->sabc_amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_amount) ?>', 1);"><div id="elh_services_availed_by_customer_sabc_amount" class="services_availed_by_customer_sabc_amount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($services_availed_by_customer_list->sabc_signed_on->Visible) { // sabc_signed_on ?>
	<?php if ($services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_signed_on) == "") { ?>
		<th data-name="sabc_signed_on" class="<?php echo $services_availed_by_customer_list->sabc_signed_on->headerCellClass() ?>"><div id="elh_services_availed_by_customer_sabc_signed_on" class="services_availed_by_customer_sabc_signed_on"><div class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_signed_on->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sabc_signed_on" class="<?php echo $services_availed_by_customer_list->sabc_signed_on->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $services_availed_by_customer_list->SortUrl($services_availed_by_customer_list->sabc_signed_on) ?>', 1);"><div id="elh_services_availed_by_customer_sabc_signed_on" class="services_availed_by_customer_sabc_signed_on">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $services_availed_by_customer_list->sabc_signed_on->caption() ?></span><span class="ew-table-header-sort"><?php if ($services_availed_by_customer_list->sabc_signed_on->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($services_availed_by_customer_list->sabc_signed_on->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$services_availed_by_customer_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($services_availed_by_customer_list->ExportAll && $services_availed_by_customer_list->isExport()) {
	$services_availed_by_customer_list->StopRecord = $services_availed_by_customer_list->TotalRecords;
} else {

	// Set the last record to display
	if ($services_availed_by_customer_list->TotalRecords > $services_availed_by_customer_list->StartRecord + $services_availed_by_customer_list->DisplayRecords - 1)
		$services_availed_by_customer_list->StopRecord = $services_availed_by_customer_list->StartRecord + $services_availed_by_customer_list->DisplayRecords - 1;
	else
		$services_availed_by_customer_list->StopRecord = $services_availed_by_customer_list->TotalRecords;
}
$services_availed_by_customer_list->RecordCount = $services_availed_by_customer_list->StartRecord - 1;
if ($services_availed_by_customer_list->Recordset && !$services_availed_by_customer_list->Recordset->EOF) {
	$services_availed_by_customer_list->Recordset->moveFirst();
	$selectLimit = $services_availed_by_customer_list->UseSelectLimit;
	if (!$selectLimit && $services_availed_by_customer_list->StartRecord > 1)
		$services_availed_by_customer_list->Recordset->move($services_availed_by_customer_list->StartRecord - 1);
} elseif (!$services_availed_by_customer->AllowAddDeleteRow && $services_availed_by_customer_list->StopRecord == 0) {
	$services_availed_by_customer_list->StopRecord = $services_availed_by_customer->GridAddRowCount;
}

// Initialize aggregate
$services_availed_by_customer->RowType = ROWTYPE_AGGREGATEINIT;
$services_availed_by_customer->resetAttributes();
$services_availed_by_customer_list->renderRow();
while ($services_availed_by_customer_list->RecordCount < $services_availed_by_customer_list->StopRecord) {
	$services_availed_by_customer_list->RecordCount++;
	if ($services_availed_by_customer_list->RecordCount >= $services_availed_by_customer_list->StartRecord) {
		$services_availed_by_customer_list->RowCount++;

		// Set up key count
		$services_availed_by_customer_list->KeyCount = $services_availed_by_customer_list->RowIndex;

		// Init row class and style
		$services_availed_by_customer->resetAttributes();
		$services_availed_by_customer->CssClass = "";
		if ($services_availed_by_customer_list->isGridAdd()) {
		} else {
			$services_availed_by_customer_list->loadRowValues($services_availed_by_customer_list->Recordset); // Load row values
		}
		$services_availed_by_customer->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$services_availed_by_customer->RowAttrs->merge(["data-rowindex" => $services_availed_by_customer_list->RowCount, "id" => "r" . $services_availed_by_customer_list->RowCount . "_services_availed_by_customer", "data-rowtype" => $services_availed_by_customer->RowType]);

		// Render row
		$services_availed_by_customer_list->renderRow();

		// Render list options
		$services_availed_by_customer_list->renderListOptions();
?>
	<tr <?php echo $services_availed_by_customer->rowAttributes() ?>>
<?php

// Render list options (body, left)
$services_availed_by_customer_list->ListOptions->render("body", "left", $services_availed_by_customer_list->RowCount);
?>
	<?php if ($services_availed_by_customer_list->sabc_id->Visible) { // sabc_id ?>
		<td data-name="sabc_id" <?php echo $services_availed_by_customer_list->sabc_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_id">
<span<?php echo $services_availed_by_customer_list->sabc_id->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($services_availed_by_customer_list->sabc_branch_id->Visible) { // sabc_branch_id ?>
		<td data-name="sabc_branch_id" <?php echo $services_availed_by_customer_list->sabc_branch_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_branch_id">
<span<?php echo $services_availed_by_customer_list->sabc_branch_id->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_branch_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($services_availed_by_customer_list->sabc_business_id->Visible) { // sabc_business_id ?>
		<td data-name="sabc_business_id" <?php echo $services_availed_by_customer_list->sabc_business_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_business_id">
<span<?php echo $services_availed_by_customer_list->sabc_business_id->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_business_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($services_availed_by_customer_list->sabc_service_id->Visible) { // sabc_service_id ?>
		<td data-name="sabc_service_id" <?php echo $services_availed_by_customer_list->sabc_service_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_service_id">
<span<?php echo $services_availed_by_customer_list->sabc_service_id->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_service_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($services_availed_by_customer_list->sabc_pkg->Visible) { // sabc_pkg ?>
		<td data-name="sabc_pkg" <?php echo $services_availed_by_customer_list->sabc_pkg->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_pkg">
<span<?php echo $services_availed_by_customer_list->sabc_pkg->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_pkg->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($services_availed_by_customer_list->sabc_amount->Visible) { // sabc_amount ?>
		<td data-name="sabc_amount" <?php echo $services_availed_by_customer_list->sabc_amount->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_amount">
<span<?php echo $services_availed_by_customer_list->sabc_amount->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_amount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($services_availed_by_customer_list->sabc_signed_on->Visible) { // sabc_signed_on ?>
		<td data-name="sabc_signed_on" <?php echo $services_availed_by_customer_list->sabc_signed_on->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_list->RowCount ?>_services_availed_by_customer_sabc_signed_on">
<span<?php echo $services_availed_by_customer_list->sabc_signed_on->viewAttributes() ?>><?php echo $services_availed_by_customer_list->sabc_signed_on->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$services_availed_by_customer_list->ListOptions->render("body", "right", $services_availed_by_customer_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$services_availed_by_customer_list->isGridAdd())
		$services_availed_by_customer_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$services_availed_by_customer->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($services_availed_by_customer_list->Recordset)
	$services_availed_by_customer_list->Recordset->Close();
?>
<?php if (!$services_availed_by_customer_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$services_availed_by_customer_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $services_availed_by_customer_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $services_availed_by_customer_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($services_availed_by_customer_list->TotalRecords == 0 && !$services_availed_by_customer->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $services_availed_by_customer_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$services_availed_by_customer_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$services_availed_by_customer_list->isExport()) { ?>
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
$services_availed_by_customer_list->terminate();
?>