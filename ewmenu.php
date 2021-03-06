<?php
namespace PHPMaker2020\crm_live;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(16, "mi_followup", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "followuplist.php", -1, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}followup'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_cus_support", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "cus_supportlist.php", -1, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}cus_support'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_business", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "businesslist.php", -1, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}business'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mi_business_nature", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "business_naturelist.php", 5, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}business_nature'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(7, "mi_business_status", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "business_statuslist.php", 5, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}business_status'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_business_type", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "business_typelist.php", 5, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}business_type'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(24, "mi_services_availed_by_customer", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "services_availed_by_customerlist.php", -1, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}services_availed_by_customer'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(23, "mi_services", $MenuLanguage->MenuPhrase("23", "MenuText"), $MenuRelativePath . "serviceslist.php", 24, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}services'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(22, "mi_referral", $MenuLanguage->MenuPhrase("22", "MenuText"), $MenuRelativePath . "referrallist.php", -1, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}referral'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(18, "mi_invoices", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "invoiceslist.php", -1, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}invoices'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(20, "mi_quotation", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "quotationlist.php", -1, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}quotation'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(21, "mi_reference_letter", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "reference_letterlist.php", -1, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}reference_letter'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(15, "mi_employees", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "employeeslist.php", -1, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}employees'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(38, "mci_SMS", $MenuLanguage->MenuPhrase("38", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(28, "mi_sms_template", $MenuLanguage->MenuPhrase("28", "MenuText"), $MenuRelativePath . "sms_templatelist.php", 38, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}sms_template'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(25, "mi_sms_api", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "sms_apilist.php", 38, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}sms_api'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(27, "mi_sms_package", $MenuLanguage->MenuPhrase("27", "MenuText"), $MenuRelativePath . "sms_packagelist.php", 38, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}sms_package'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(26, "mi_sms_log", $MenuLanguage->MenuPhrase("26", "MenuText"), $MenuRelativePath . "sms_loglist.php", 38, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}sms_log'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(31, "mi_user", $MenuLanguage->MenuPhrase("31", "MenuText"), $MenuRelativePath . "userlist.php", -1, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}user'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(32, "mi_user_type", $MenuLanguage->MenuPhrase("32", "MenuText"), $MenuRelativePath . "user_typelist.php", 31, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}user_type'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(33, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("33", "MenuText"), $MenuRelativePath . "userlevelpermissionslist.php", 31, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}userlevelpermissions'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(34, "mi_userlevels", $MenuLanguage->MenuPhrase("34", "MenuText"), $MenuRelativePath . "userlevelslist.php", 31, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}userlevels'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(35, "mci_Accounts", $MenuLanguage->MenuPhrase("35", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(1, "mi_acc_head", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "acc_headlist.php", 35, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}acc_head'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_acc_nature", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "acc_naturelist.php", 35, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}acc_nature'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_acc_transaction", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "acc_transactionlist.php", 35, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}acc_transaction'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(36, "mci_Settings", $MenuLanguage->MenuPhrase("36", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(19, "mi_organization", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "organizationlist.php", 36, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}organization'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_branch", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "branchlist.php", 36, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}branch'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(12, "mi_designation", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "designationlist.php", 36, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}designation'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(37, "mci_Location", $MenuLanguage->MenuPhrase("37", "MenuText"), "", 36, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mi_country", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "countrylist.php", 37, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}country'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(29, "mi_state", $MenuLanguage->MenuPhrase("29", "MenuText"), $MenuRelativePath . "statelist.php", 37, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}state'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(14, "mi_division", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "divisionlist.php", 37, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}division'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(13, "mi_district", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "districtlist.php", 37, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}district'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(30, "mi_tehsil", $MenuLanguage->MenuPhrase("30", "MenuText"), $MenuRelativePath . "tehsillist.php", 37, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}tehsil'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mi_city", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "citylist.php", 37, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}city'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(17, "mi_followup_no", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "followup_nolist.php", 36, "", IsLoggedIn() || AllowListMenu('{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}followup_no'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>