<?php
namespace PHPMaker2020\crm_live;

/**
 * Page class
 */
class sms_package_edit extends sms_package
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}";

	// Table name
	public $TableName = 'sms_package';

	// Page object name
	public $PageObjName = "sms_package_edit";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (sms_package)
		if (!isset($GLOBALS["sms_package"]) || get_class($GLOBALS["sms_package"]) == PROJECT_NAMESPACE . "sms_package") {
			$GLOBALS["sms_package"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["sms_package"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'sms_package');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $sms_package;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($sms_package);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "sms_packageview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['sms_pkg_id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->sms_pkg_id->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!$this->setupApiRequest())
			return FALSE;

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		if (!$Security->isLoggedIn()) // Logged in
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API request
	public function setupApiRequest()
	{
		global $Security;

		// Check security for API request
		If (ValidApiRequest()) {
			return TRUE;
		}
		return FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (!$this->setupApiRequest()) {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("sms_packagelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->sms_pkg_id->setVisibility();
		$this->sms_pkg_sms_api_id->setVisibility();
		$this->sms_pkg_branch_id->setVisibility();
		$this->sms_pkg_total_allowed_sms->setVisibility();
		$this->sms_pkg_expiry_date->setVisibility();
		$this->sms_pkg_per_sms_cost->setVisibility();
		$this->sms_pkg_deal_details->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->sms_pkg_sms_api_id);
		$this->setupLookupOptions($this->sms_pkg_branch_id);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_sms_pkg_id")) {
				$this->sms_pkg_id->setFormValue($CurrentForm->getValue("x_sms_pkg_id"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("sms_pkg_id") !== NULL) {
				$this->sms_pkg_id->setQueryStringValue(Get("sms_pkg_id"));
				$loadByQuery = TRUE;
			} else {
				$this->sms_pkg_id->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->loadRow();

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("sms_packagelist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "sms_packagelist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'sms_pkg_id' first before field var 'x_sms_pkg_id'
		$val = $CurrentForm->hasValue("sms_pkg_id") ? $CurrentForm->getValue("sms_pkg_id") : $CurrentForm->getValue("x_sms_pkg_id");
		if (!$this->sms_pkg_id->IsDetailKey)
			$this->sms_pkg_id->setFormValue($val);

		// Check field name 'sms_pkg_sms_api_id' first before field var 'x_sms_pkg_sms_api_id'
		$val = $CurrentForm->hasValue("sms_pkg_sms_api_id") ? $CurrentForm->getValue("sms_pkg_sms_api_id") : $CurrentForm->getValue("x_sms_pkg_sms_api_id");
		if (!$this->sms_pkg_sms_api_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->sms_pkg_sms_api_id->Visible = FALSE; // Disable update for API request
			else
				$this->sms_pkg_sms_api_id->setFormValue($val);
		}

		// Check field name 'sms_pkg_branch_id' first before field var 'x_sms_pkg_branch_id'
		$val = $CurrentForm->hasValue("sms_pkg_branch_id") ? $CurrentForm->getValue("sms_pkg_branch_id") : $CurrentForm->getValue("x_sms_pkg_branch_id");
		if (!$this->sms_pkg_branch_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->sms_pkg_branch_id->Visible = FALSE; // Disable update for API request
			else
				$this->sms_pkg_branch_id->setFormValue($val);
		}

		// Check field name 'sms_pkg_total_allowed_sms' first before field var 'x_sms_pkg_total_allowed_sms'
		$val = $CurrentForm->hasValue("sms_pkg_total_allowed_sms") ? $CurrentForm->getValue("sms_pkg_total_allowed_sms") : $CurrentForm->getValue("x_sms_pkg_total_allowed_sms");
		if (!$this->sms_pkg_total_allowed_sms->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->sms_pkg_total_allowed_sms->Visible = FALSE; // Disable update for API request
			else
				$this->sms_pkg_total_allowed_sms->setFormValue($val);
		}

		// Check field name 'sms_pkg_expiry_date' first before field var 'x_sms_pkg_expiry_date'
		$val = $CurrentForm->hasValue("sms_pkg_expiry_date") ? $CurrentForm->getValue("sms_pkg_expiry_date") : $CurrentForm->getValue("x_sms_pkg_expiry_date");
		if (!$this->sms_pkg_expiry_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->sms_pkg_expiry_date->Visible = FALSE; // Disable update for API request
			else
				$this->sms_pkg_expiry_date->setFormValue($val);
			$this->sms_pkg_expiry_date->CurrentValue = UnFormatDateTime($this->sms_pkg_expiry_date->CurrentValue, 0);
		}

		// Check field name 'sms_pkg_per_sms_cost' first before field var 'x_sms_pkg_per_sms_cost'
		$val = $CurrentForm->hasValue("sms_pkg_per_sms_cost") ? $CurrentForm->getValue("sms_pkg_per_sms_cost") : $CurrentForm->getValue("x_sms_pkg_per_sms_cost");
		if (!$this->sms_pkg_per_sms_cost->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->sms_pkg_per_sms_cost->Visible = FALSE; // Disable update for API request
			else
				$this->sms_pkg_per_sms_cost->setFormValue($val);
		}

		// Check field name 'sms_pkg_deal_details' first before field var 'x_sms_pkg_deal_details'
		$val = $CurrentForm->hasValue("sms_pkg_deal_details") ? $CurrentForm->getValue("sms_pkg_deal_details") : $CurrentForm->getValue("x_sms_pkg_deal_details");
		if (!$this->sms_pkg_deal_details->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->sms_pkg_deal_details->Visible = FALSE; // Disable update for API request
			else
				$this->sms_pkg_deal_details->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->sms_pkg_id->CurrentValue = $this->sms_pkg_id->FormValue;
		$this->sms_pkg_sms_api_id->CurrentValue = $this->sms_pkg_sms_api_id->FormValue;
		$this->sms_pkg_branch_id->CurrentValue = $this->sms_pkg_branch_id->FormValue;
		$this->sms_pkg_total_allowed_sms->CurrentValue = $this->sms_pkg_total_allowed_sms->FormValue;
		$this->sms_pkg_expiry_date->CurrentValue = $this->sms_pkg_expiry_date->FormValue;
		$this->sms_pkg_expiry_date->CurrentValue = UnFormatDateTime($this->sms_pkg_expiry_date->CurrentValue, 0);
		$this->sms_pkg_per_sms_cost->CurrentValue = $this->sms_pkg_per_sms_cost->FormValue;
		$this->sms_pkg_deal_details->CurrentValue = $this->sms_pkg_deal_details->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->sms_pkg_id->setDbValue($row['sms_pkg_id']);
		$this->sms_pkg_sms_api_id->setDbValue($row['sms_pkg_sms_api_id']);
		if (array_key_exists('EV__sms_pkg_sms_api_id', $rs->fields)) {
			$this->sms_pkg_sms_api_id->VirtualValue = $rs->fields('EV__sms_pkg_sms_api_id'); // Set up virtual field value
		} else {
			$this->sms_pkg_sms_api_id->VirtualValue = ""; // Clear value
		}
		$this->sms_pkg_branch_id->setDbValue($row['sms_pkg_branch_id']);
		if (array_key_exists('EV__sms_pkg_branch_id', $rs->fields)) {
			$this->sms_pkg_branch_id->VirtualValue = $rs->fields('EV__sms_pkg_branch_id'); // Set up virtual field value
		} else {
			$this->sms_pkg_branch_id->VirtualValue = ""; // Clear value
		}
		$this->sms_pkg_total_allowed_sms->setDbValue($row['sms_pkg_total_allowed_sms']);
		$this->sms_pkg_expiry_date->setDbValue($row['sms_pkg_expiry_date']);
		$this->sms_pkg_per_sms_cost->setDbValue($row['sms_pkg_per_sms_cost']);
		$this->sms_pkg_deal_details->setDbValue($row['sms_pkg_deal_details']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['sms_pkg_id'] = NULL;
		$row['sms_pkg_sms_api_id'] = NULL;
		$row['sms_pkg_branch_id'] = NULL;
		$row['sms_pkg_total_allowed_sms'] = NULL;
		$row['sms_pkg_expiry_date'] = NULL;
		$row['sms_pkg_per_sms_cost'] = NULL;
		$row['sms_pkg_deal_details'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("sms_pkg_id")) != "")
			$this->sms_pkg_id->OldValue = $this->getKey("sms_pkg_id"); // sms_pkg_id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->sms_pkg_per_sms_cost->FormValue == $this->sms_pkg_per_sms_cost->CurrentValue && is_numeric(ConvertToFloatString($this->sms_pkg_per_sms_cost->CurrentValue)))
			$this->sms_pkg_per_sms_cost->CurrentValue = ConvertToFloatString($this->sms_pkg_per_sms_cost->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// sms_pkg_id
		// sms_pkg_sms_api_id
		// sms_pkg_branch_id
		// sms_pkg_total_allowed_sms
		// sms_pkg_expiry_date
		// sms_pkg_per_sms_cost
		// sms_pkg_deal_details

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// sms_pkg_id
			$this->sms_pkg_id->ViewValue = $this->sms_pkg_id->CurrentValue;
			$this->sms_pkg_id->CssClass = "font-weight-bold";
			$this->sms_pkg_id->ViewCustomAttributes = "";

			// sms_pkg_sms_api_id
			if ($this->sms_pkg_sms_api_id->VirtualValue != "") {
				$this->sms_pkg_sms_api_id->ViewValue = $this->sms_pkg_sms_api_id->VirtualValue;
			} else {
				$curVal = strval($this->sms_pkg_sms_api_id->CurrentValue);
				if ($curVal != "") {
					$this->sms_pkg_sms_api_id->ViewValue = $this->sms_pkg_sms_api_id->lookupCacheOption($curVal);
					if ($this->sms_pkg_sms_api_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`sms_api_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->sms_pkg_sms_api_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->sms_pkg_sms_api_id->ViewValue = $this->sms_pkg_sms_api_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->sms_pkg_sms_api_id->ViewValue = $this->sms_pkg_sms_api_id->CurrentValue;
						}
					}
				} else {
					$this->sms_pkg_sms_api_id->ViewValue = NULL;
				}
			}
			$this->sms_pkg_sms_api_id->ViewCustomAttributes = "";

			// sms_pkg_branch_id
			if ($this->sms_pkg_branch_id->VirtualValue != "") {
				$this->sms_pkg_branch_id->ViewValue = $this->sms_pkg_branch_id->VirtualValue;
			} else {
				$curVal = strval($this->sms_pkg_branch_id->CurrentValue);
				if ($curVal != "") {
					$this->sms_pkg_branch_id->ViewValue = $this->sms_pkg_branch_id->lookupCacheOption($curVal);
					if ($this->sms_pkg_branch_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`branch_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->sms_pkg_branch_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->sms_pkg_branch_id->ViewValue = $this->sms_pkg_branch_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->sms_pkg_branch_id->ViewValue = $this->sms_pkg_branch_id->CurrentValue;
						}
					}
				} else {
					$this->sms_pkg_branch_id->ViewValue = NULL;
				}
			}
			$this->sms_pkg_branch_id->ViewCustomAttributes = "";

			// sms_pkg_total_allowed_sms
			$this->sms_pkg_total_allowed_sms->ViewValue = $this->sms_pkg_total_allowed_sms->CurrentValue;
			$this->sms_pkg_total_allowed_sms->ViewValue = FormatNumber($this->sms_pkg_total_allowed_sms->ViewValue, 0, -2, -2, -2);
			$this->sms_pkg_total_allowed_sms->ViewCustomAttributes = "";

			// sms_pkg_expiry_date
			$this->sms_pkg_expiry_date->ViewValue = $this->sms_pkg_expiry_date->CurrentValue;
			$this->sms_pkg_expiry_date->ViewValue = FormatDateTime($this->sms_pkg_expiry_date->ViewValue, 0);
			$this->sms_pkg_expiry_date->ViewCustomAttributes = "";

			// sms_pkg_per_sms_cost
			$this->sms_pkg_per_sms_cost->ViewValue = $this->sms_pkg_per_sms_cost->CurrentValue;
			$this->sms_pkg_per_sms_cost->ViewValue = FormatNumber($this->sms_pkg_per_sms_cost->ViewValue, 2, -2, -2, -2);
			$this->sms_pkg_per_sms_cost->ViewCustomAttributes = "";

			// sms_pkg_deal_details
			$this->sms_pkg_deal_details->ViewValue = $this->sms_pkg_deal_details->CurrentValue;
			$this->sms_pkg_deal_details->ViewCustomAttributes = "";

			// sms_pkg_id
			$this->sms_pkg_id->LinkCustomAttributes = "";
			$this->sms_pkg_id->HrefValue = "";
			$this->sms_pkg_id->TooltipValue = "";

			// sms_pkg_sms_api_id
			$this->sms_pkg_sms_api_id->LinkCustomAttributes = "";
			$this->sms_pkg_sms_api_id->HrefValue = "";
			$this->sms_pkg_sms_api_id->TooltipValue = "";

			// sms_pkg_branch_id
			$this->sms_pkg_branch_id->LinkCustomAttributes = "";
			$this->sms_pkg_branch_id->HrefValue = "";
			$this->sms_pkg_branch_id->TooltipValue = "";

			// sms_pkg_total_allowed_sms
			$this->sms_pkg_total_allowed_sms->LinkCustomAttributes = "";
			$this->sms_pkg_total_allowed_sms->HrefValue = "";
			$this->sms_pkg_total_allowed_sms->TooltipValue = "";

			// sms_pkg_expiry_date
			$this->sms_pkg_expiry_date->LinkCustomAttributes = "";
			$this->sms_pkg_expiry_date->HrefValue = "";
			$this->sms_pkg_expiry_date->TooltipValue = "";

			// sms_pkg_per_sms_cost
			$this->sms_pkg_per_sms_cost->LinkCustomAttributes = "";
			$this->sms_pkg_per_sms_cost->HrefValue = "";
			$this->sms_pkg_per_sms_cost->TooltipValue = "";

			// sms_pkg_deal_details
			$this->sms_pkg_deal_details->LinkCustomAttributes = "";
			$this->sms_pkg_deal_details->HrefValue = "";
			$this->sms_pkg_deal_details->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// sms_pkg_id
			$this->sms_pkg_id->EditAttrs["class"] = "form-control";
			$this->sms_pkg_id->EditCustomAttributes = "";
			$this->sms_pkg_id->EditValue = $this->sms_pkg_id->CurrentValue;
			$this->sms_pkg_id->CssClass = "font-weight-bold";
			$this->sms_pkg_id->ViewCustomAttributes = "";

			// sms_pkg_sms_api_id
			$this->sms_pkg_sms_api_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->sms_pkg_sms_api_id->CurrentValue));
			if ($curVal != "")
				$this->sms_pkg_sms_api_id->ViewValue = $this->sms_pkg_sms_api_id->lookupCacheOption($curVal);
			else
				$this->sms_pkg_sms_api_id->ViewValue = $this->sms_pkg_sms_api_id->Lookup !== NULL && is_array($this->sms_pkg_sms_api_id->Lookup->Options) ? $curVal : NULL;
			if ($this->sms_pkg_sms_api_id->ViewValue !== NULL) { // Load from cache
				$this->sms_pkg_sms_api_id->EditValue = array_values($this->sms_pkg_sms_api_id->Lookup->Options);
				if ($this->sms_pkg_sms_api_id->ViewValue == "")
					$this->sms_pkg_sms_api_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`sms_api_id`" . SearchString("=", $this->sms_pkg_sms_api_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->sms_pkg_sms_api_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->sms_pkg_sms_api_id->ViewValue = $this->sms_pkg_sms_api_id->displayValue($arwrk);
				} else {
					$this->sms_pkg_sms_api_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->sms_pkg_sms_api_id->EditValue = $arwrk;
			}

			// sms_pkg_branch_id
			$this->sms_pkg_branch_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->sms_pkg_branch_id->CurrentValue));
			if ($curVal != "")
				$this->sms_pkg_branch_id->ViewValue = $this->sms_pkg_branch_id->lookupCacheOption($curVal);
			else
				$this->sms_pkg_branch_id->ViewValue = $this->sms_pkg_branch_id->Lookup !== NULL && is_array($this->sms_pkg_branch_id->Lookup->Options) ? $curVal : NULL;
			if ($this->sms_pkg_branch_id->ViewValue !== NULL) { // Load from cache
				$this->sms_pkg_branch_id->EditValue = array_values($this->sms_pkg_branch_id->Lookup->Options);
				if ($this->sms_pkg_branch_id->ViewValue == "")
					$this->sms_pkg_branch_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`branch_id`" . SearchString("=", $this->sms_pkg_branch_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->sms_pkg_branch_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->sms_pkg_branch_id->ViewValue = $this->sms_pkg_branch_id->displayValue($arwrk);
				} else {
					$this->sms_pkg_branch_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->sms_pkg_branch_id->EditValue = $arwrk;
			}

			// sms_pkg_total_allowed_sms
			$this->sms_pkg_total_allowed_sms->EditAttrs["class"] = "form-control";
			$this->sms_pkg_total_allowed_sms->EditCustomAttributes = "";
			$this->sms_pkg_total_allowed_sms->EditValue = HtmlEncode($this->sms_pkg_total_allowed_sms->CurrentValue);
			$this->sms_pkg_total_allowed_sms->PlaceHolder = RemoveHtml($this->sms_pkg_total_allowed_sms->caption());

			// sms_pkg_expiry_date
			$this->sms_pkg_expiry_date->EditAttrs["class"] = "form-control";
			$this->sms_pkg_expiry_date->EditCustomAttributes = "";
			$this->sms_pkg_expiry_date->EditValue = HtmlEncode(FormatDateTime($this->sms_pkg_expiry_date->CurrentValue, 8));
			$this->sms_pkg_expiry_date->PlaceHolder = RemoveHtml($this->sms_pkg_expiry_date->caption());

			// sms_pkg_per_sms_cost
			$this->sms_pkg_per_sms_cost->EditAttrs["class"] = "form-control";
			$this->sms_pkg_per_sms_cost->EditCustomAttributes = "";
			$this->sms_pkg_per_sms_cost->EditValue = HtmlEncode($this->sms_pkg_per_sms_cost->CurrentValue);
			$this->sms_pkg_per_sms_cost->PlaceHolder = RemoveHtml($this->sms_pkg_per_sms_cost->caption());
			if (strval($this->sms_pkg_per_sms_cost->EditValue) != "" && is_numeric($this->sms_pkg_per_sms_cost->EditValue))
				$this->sms_pkg_per_sms_cost->EditValue = FormatNumber($this->sms_pkg_per_sms_cost->EditValue, -2, -2, -2, -2);
			

			// sms_pkg_deal_details
			$this->sms_pkg_deal_details->EditAttrs["class"] = "form-control";
			$this->sms_pkg_deal_details->EditCustomAttributes = "";
			$this->sms_pkg_deal_details->EditValue = HtmlEncode($this->sms_pkg_deal_details->CurrentValue);
			$this->sms_pkg_deal_details->PlaceHolder = RemoveHtml($this->sms_pkg_deal_details->caption());

			// Edit refer script
			// sms_pkg_id

			$this->sms_pkg_id->LinkCustomAttributes = "";
			$this->sms_pkg_id->HrefValue = "";

			// sms_pkg_sms_api_id
			$this->sms_pkg_sms_api_id->LinkCustomAttributes = "";
			$this->sms_pkg_sms_api_id->HrefValue = "";

			// sms_pkg_branch_id
			$this->sms_pkg_branch_id->LinkCustomAttributes = "";
			$this->sms_pkg_branch_id->HrefValue = "";

			// sms_pkg_total_allowed_sms
			$this->sms_pkg_total_allowed_sms->LinkCustomAttributes = "";
			$this->sms_pkg_total_allowed_sms->HrefValue = "";

			// sms_pkg_expiry_date
			$this->sms_pkg_expiry_date->LinkCustomAttributes = "";
			$this->sms_pkg_expiry_date->HrefValue = "";

			// sms_pkg_per_sms_cost
			$this->sms_pkg_per_sms_cost->LinkCustomAttributes = "";
			$this->sms_pkg_per_sms_cost->HrefValue = "";

			// sms_pkg_deal_details
			$this->sms_pkg_deal_details->LinkCustomAttributes = "";
			$this->sms_pkg_deal_details->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->sms_pkg_id->Required) {
			if (!$this->sms_pkg_id->IsDetailKey && $this->sms_pkg_id->FormValue != NULL && $this->sms_pkg_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sms_pkg_id->caption(), $this->sms_pkg_id->RequiredErrorMessage));
			}
		}
		if ($this->sms_pkg_sms_api_id->Required) {
			if (!$this->sms_pkg_sms_api_id->IsDetailKey && $this->sms_pkg_sms_api_id->FormValue != NULL && $this->sms_pkg_sms_api_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sms_pkg_sms_api_id->caption(), $this->sms_pkg_sms_api_id->RequiredErrorMessage));
			}
		}
		if ($this->sms_pkg_branch_id->Required) {
			if (!$this->sms_pkg_branch_id->IsDetailKey && $this->sms_pkg_branch_id->FormValue != NULL && $this->sms_pkg_branch_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sms_pkg_branch_id->caption(), $this->sms_pkg_branch_id->RequiredErrorMessage));
			}
		}
		if ($this->sms_pkg_total_allowed_sms->Required) {
			if (!$this->sms_pkg_total_allowed_sms->IsDetailKey && $this->sms_pkg_total_allowed_sms->FormValue != NULL && $this->sms_pkg_total_allowed_sms->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sms_pkg_total_allowed_sms->caption(), $this->sms_pkg_total_allowed_sms->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->sms_pkg_total_allowed_sms->FormValue)) {
			AddMessage($FormError, $this->sms_pkg_total_allowed_sms->errorMessage());
		}
		if ($this->sms_pkg_expiry_date->Required) {
			if (!$this->sms_pkg_expiry_date->IsDetailKey && $this->sms_pkg_expiry_date->FormValue != NULL && $this->sms_pkg_expiry_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sms_pkg_expiry_date->caption(), $this->sms_pkg_expiry_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->sms_pkg_expiry_date->FormValue)) {
			AddMessage($FormError, $this->sms_pkg_expiry_date->errorMessage());
		}
		if ($this->sms_pkg_per_sms_cost->Required) {
			if (!$this->sms_pkg_per_sms_cost->IsDetailKey && $this->sms_pkg_per_sms_cost->FormValue != NULL && $this->sms_pkg_per_sms_cost->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sms_pkg_per_sms_cost->caption(), $this->sms_pkg_per_sms_cost->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->sms_pkg_per_sms_cost->FormValue)) {
			AddMessage($FormError, $this->sms_pkg_per_sms_cost->errorMessage());
		}
		if ($this->sms_pkg_deal_details->Required) {
			if (!$this->sms_pkg_deal_details->IsDetailKey && $this->sms_pkg_deal_details->FormValue != NULL && $this->sms_pkg_deal_details->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sms_pkg_deal_details->caption(), $this->sms_pkg_deal_details->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// sms_pkg_sms_api_id
			$this->sms_pkg_sms_api_id->setDbValueDef($rsnew, $this->sms_pkg_sms_api_id->CurrentValue, 0, $this->sms_pkg_sms_api_id->ReadOnly);

			// sms_pkg_branch_id
			$this->sms_pkg_branch_id->setDbValueDef($rsnew, $this->sms_pkg_branch_id->CurrentValue, 0, $this->sms_pkg_branch_id->ReadOnly);

			// sms_pkg_total_allowed_sms
			$this->sms_pkg_total_allowed_sms->setDbValueDef($rsnew, $this->sms_pkg_total_allowed_sms->CurrentValue, 0, $this->sms_pkg_total_allowed_sms->ReadOnly);

			// sms_pkg_expiry_date
			$this->sms_pkg_expiry_date->setDbValueDef($rsnew, UnFormatDateTime($this->sms_pkg_expiry_date->CurrentValue, 0), CurrentDate(), $this->sms_pkg_expiry_date->ReadOnly);

			// sms_pkg_per_sms_cost
			$this->sms_pkg_per_sms_cost->setDbValueDef($rsnew, $this->sms_pkg_per_sms_cost->CurrentValue, 0, $this->sms_pkg_per_sms_cost->ReadOnly);

			// sms_pkg_deal_details
			$this->sms_pkg_deal_details->setDbValueDef($rsnew, $this->sms_pkg_deal_details->CurrentValue, "", $this->sms_pkg_deal_details->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("sms_packagelist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_sms_pkg_sms_api_id":
					break;
				case "x_sms_pkg_branch_id":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_sms_pkg_sms_api_id":
							break;
						case "x_sms_pkg_branch_id":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>