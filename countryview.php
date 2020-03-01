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
$country_view = new country_view();

// Run the page
$country_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$country_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$country_view->isExport()) { ?>
<script>
var fcountryview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcountryview = currentForm = new ew.Form("fcountryview", "view");
	loadjs.done("fcountryview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$country_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $country_view->ExportOptions->render("body") ?>
<?php $country_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $country_view->showPageHeader(); ?>
<?php
$country_view->showMessage();
?>
<form name="fcountryview" id="fcountryview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="country">
<input type="hidden" name="modal" value="<?php echo (int)$country_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($country_view->country_id->Visible) { // country_id ?>
	<tr id="r_country_id">
		<td class="<?php echo $country_view->TableLeftColumnClass ?>"><span id="elh_country_country_id"><?php echo $country_view->country_id->caption() ?></span></td>
		<td data-name="country_id" <?php echo $country_view->country_id->cellAttributes() ?>>
<span id="el_country_country_id">
<span<?php echo $country_view->country_id->viewAttributes() ?>><?php echo $country_view->country_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($country_view->country_name->Visible) { // country_name ?>
	<tr id="r_country_name">
		<td class="<?php echo $country_view->TableLeftColumnClass ?>"><span id="elh_country_country_name"><?php echo $country_view->country_name->caption() ?></span></td>
		<td data-name="country_name" <?php echo $country_view->country_name->cellAttributes() ?>>
<span id="el_country_country_name">
<span<?php echo $country_view->country_name->viewAttributes() ?>><?php echo $country_view->country_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$country_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$country_view->isExport()) { ?>
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
$country_view->terminate();
?>