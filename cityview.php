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
$city_view = new city_view();

// Run the page
$city_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$city_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$city_view->isExport()) { ?>
<script>
var fcityview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcityview = currentForm = new ew.Form("fcityview", "view");
	loadjs.done("fcityview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$city_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $city_view->ExportOptions->render("body") ?>
<?php $city_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $city_view->showPageHeader(); ?>
<?php
$city_view->showMessage();
?>
<form name="fcityview" id="fcityview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="city">
<input type="hidden" name="modal" value="<?php echo (int)$city_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($city_view->city_id->Visible) { // city_id ?>
	<tr id="r_city_id">
		<td class="<?php echo $city_view->TableLeftColumnClass ?>"><span id="elh_city_city_id"><?php echo $city_view->city_id->caption() ?></span></td>
		<td data-name="city_id" <?php echo $city_view->city_id->cellAttributes() ?>>
<span id="el_city_city_id">
<span<?php echo $city_view->city_id->viewAttributes() ?>><?php echo $city_view->city_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($city_view->city_tehsil_id->Visible) { // city_tehsil_id ?>
	<tr id="r_city_tehsil_id">
		<td class="<?php echo $city_view->TableLeftColumnClass ?>"><span id="elh_city_city_tehsil_id"><?php echo $city_view->city_tehsil_id->caption() ?></span></td>
		<td data-name="city_tehsil_id" <?php echo $city_view->city_tehsil_id->cellAttributes() ?>>
<span id="el_city_city_tehsil_id">
<span<?php echo $city_view->city_tehsil_id->viewAttributes() ?>><?php echo $city_view->city_tehsil_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($city_view->city_name->Visible) { // city_name ?>
	<tr id="r_city_name">
		<td class="<?php echo $city_view->TableLeftColumnClass ?>"><span id="elh_city_city_name"><?php echo $city_view->city_name->caption() ?></span></td>
		<td data-name="city_name" <?php echo $city_view->city_name->cellAttributes() ?>>
<span id="el_city_city_name">
<span<?php echo $city_view->city_name->viewAttributes() ?>><?php echo $city_view->city_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$city_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$city_view->isExport()) { ?>
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
$city_view->terminate();
?>