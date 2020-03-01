<?php
namespace PHPMaker2020\crm_live;

/**
 * Page class
 */
class employees_add extends employees
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}";

	// Table name
	public $TableName = 'employees';

	// Page object name
	public $PageObjName = "employees_add";

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

		// Table object (employees)
		if (!isset($GLOBALS["employees"]) || get_class($GLOBALS["employees"]) == PROJECT_NAMESPACE . "employees") {
			$GLOBALS["employees"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["employees"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'employees');

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
		global $employees;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($employees);
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
					if ($pageName == "employeesview.php")
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
			$key .= @$ar['emp_id'];
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
			$this->emp_id->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("employeeslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->emp_id->Visible = FALSE;
		$this->emp_branch_id->setVisibility();
		$this->emp_designation_id->setVisibility();
		$this->emp_city_id->setVisibility();
		$this->emp_name->setVisibility();
		$this->emp_father->setVisibility();
		$this->emp_cnic->setVisibility();
		$this->emp_address->setVisibility();
		$this->emp_contact->setVisibility();
		$this->emp_email->setVisibility();
		$this->emp_photo->setVisibility();
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
		$this->setupLookupOptions($this->emp_branch_id);
		$this->setupLookupOptions($this->emp_designation_id);
		$this->setupLookupOptions($this->emp_city_id);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("emp_id") !== NULL) {
				$this->emp_id->setQueryStringValue(Get("emp_id"));
				$this->setKey("emp_id", $this->emp_id->CurrentValue); // Set up key
			} else {
				$this->setKey("emp_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("employeeslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "employeeslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "employeesview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->emp_photo->Upload->Index = $CurrentForm->Index;
		$this->emp_photo->Upload->uploadFile();
		$this->emp_photo->CurrentValue = $this->emp_photo->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->emp_id->CurrentValue = NULL;
		$this->emp_id->OldValue = $this->emp_id->CurrentValue;
		$this->emp_branch_id->CurrentValue = NULL;
		$this->emp_branch_id->OldValue = $this->emp_branch_id->CurrentValue;
		$this->emp_designation_id->CurrentValue = NULL;
		$this->emp_designation_id->OldValue = $this->emp_designation_id->CurrentValue;
		$this->emp_city_id->CurrentValue = NULL;
		$this->emp_city_id->OldValue = $this->emp_city_id->CurrentValue;
		$this->emp_name->CurrentValue = NULL;
		$this->emp_name->OldValue = $this->emp_name->CurrentValue;
		$this->emp_father->CurrentValue = NULL;
		$this->emp_father->OldValue = $this->emp_father->CurrentValue;
		$this->emp_cnic->CurrentValue = NULL;
		$this->emp_cnic->OldValue = $this->emp_cnic->CurrentValue;
		$this->emp_address->CurrentValue = NULL;
		$this->emp_address->OldValue = $this->emp_address->CurrentValue;
		$this->emp_contact->CurrentValue = NULL;
		$this->emp_contact->OldValue = $this->emp_contact->CurrentValue;
		$this->emp_email->CurrentValue = NULL;
		$this->emp_email->OldValue = $this->emp_email->CurrentValue;
		$this->emp_photo->Upload->DbValue = NULL;
		$this->emp_photo->OldValue = $this->emp_photo->Upload->DbValue;
		$this->emp_photo->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'emp_branch_id' first before field var 'x_emp_branch_id'
		$val = $CurrentForm->hasValue("emp_branch_id") ? $CurrentForm->getValue("emp_branch_id") : $CurrentForm->getValue("x_emp_branch_id");
		if (!$this->emp_branch_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->emp_branch_id->Visible = FALSE; // Disable update for API request
			else
				$this->emp_branch_id->setFormValue($val);
		}

		// Check field name 'emp_designation_id' first before field var 'x_emp_designation_id'
		$val = $CurrentForm->hasValue("emp_designation_id") ? $CurrentForm->getValue("emp_designation_id") : $CurrentForm->getValue("x_emp_designation_id");
		if (!$this->emp_designation_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->emp_designation_id->Visible = FALSE; // Disable update for API request
			else
				$this->emp_designation_id->setFormValue($val);
		}

		// Check field name 'emp_city_id' first before field var 'x_emp_city_id'
		$val = $CurrentForm->hasValue("emp_city_id") ? $CurrentForm->getValue("emp_city_id") : $CurrentForm->getValue("x_emp_city_id");
		if (!$this->emp_city_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->emp_city_id->Visible = FALSE; // Disable update for API request
			else
				$this->emp_city_id->setFormValue($val);
		}

		// Check field name 'emp_name' first before field var 'x_emp_name'
		$val = $CurrentForm->hasValue("emp_name") ? $CurrentForm->getValue("emp_name") : $CurrentForm->getValue("x_emp_name");
		if (!$this->emp_name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->emp_name->Visible = FALSE; // Disable update for API request
			else
				$this->emp_name->setFormValue($val);
		}

		// Check field name 'emp_father' first before field var 'x_emp_father'
		$val = $CurrentForm->hasValue("emp_father") ? $CurrentForm->getValue("emp_father") : $CurrentForm->getValue("x_emp_father");
		if (!$this->emp_father->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->emp_father->Visible = FALSE; // Disable update for API request
			else
				$this->emp_father->setFormValue($val);
		}

		// Check field name 'emp_cnic' first before field var 'x_emp_cnic'
		$val = $CurrentForm->hasValue("emp_cnic") ? $CurrentForm->getValue("emp_cnic") : $CurrentForm->getValue("x_emp_cnic");
		if (!$this->emp_cnic->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->emp_cnic->Visible = FALSE; // Disable update for API request
			else
				$this->emp_cnic->setFormValue($val);
		}

		// Check field name 'emp_address' first before field var 'x_emp_address'
		$val = $CurrentForm->hasValue("emp_address") ? $CurrentForm->getValue("emp_address") : $CurrentForm->getValue("x_emp_address");
		if (!$this->emp_address->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->emp_address->Visible = FALSE; // Disable update for API request
			else
				$this->emp_address->setFormValue($val);
		}

		// Check field name 'emp_contact' first before field var 'x_emp_contact'
		$val = $CurrentForm->hasValue("emp_contact") ? $CurrentForm->getValue("emp_contact") : $CurrentForm->getValue("x_emp_contact");
		if (!$this->emp_contact->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->emp_contact->Visible = FALSE; // Disable update for API request
			else
				$this->emp_contact->setFormValue($val);
		}

		// Check field name 'emp_email' first before field var 'x_emp_email'
		$val = $CurrentForm->hasValue("emp_email") ? $CurrentForm->getValue("emp_email") : $CurrentForm->getValue("x_emp_email");
		if (!$this->emp_email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->emp_email->Visible = FALSE; // Disable update for API request
			else
				$this->emp_email->setFormValue($val);
		}

		// Check field name 'emp_id' first before field var 'x_emp_id'
		$val = $CurrentForm->hasValue("emp_id") ? $CurrentForm->getValue("emp_id") : $CurrentForm->getValue("x_emp_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->emp_branch_id->CurrentValue = $this->emp_branch_id->FormValue;
		$this->emp_designation_id->CurrentValue = $this->emp_designation_id->FormValue;
		$this->emp_city_id->CurrentValue = $this->emp_city_id->FormValue;
		$this->emp_name->CurrentValue = $this->emp_name->FormValue;
		$this->emp_father->CurrentValue = $this->emp_father->FormValue;
		$this->emp_cnic->CurrentValue = $this->emp_cnic->FormValue;
		$this->emp_address->CurrentValue = $this->emp_address->FormValue;
		$this->emp_contact->CurrentValue = $this->emp_contact->FormValue;
		$this->emp_email->CurrentValue = $this->emp_email->FormValue;
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
		$this->emp_id->setDbValue($row['emp_id']);
		$this->emp_branch_id->setDbValue($row['emp_branch_id']);
		if (array_key_exists('EV__emp_branch_id', $rs->fields)) {
			$this->emp_branch_id->VirtualValue = $rs->fields('EV__emp_branch_id'); // Set up virtual field value
		} else {
			$this->emp_branch_id->VirtualValue = ""; // Clear value
		}
		$this->emp_designation_id->setDbValue($row['emp_designation_id']);
		if (array_key_exists('EV__emp_designation_id', $rs->fields)) {
			$this->emp_designation_id->VirtualValue = $rs->fields('EV__emp_designation_id'); // Set up virtual field value
		} else {
			$this->emp_designation_id->VirtualValue = ""; // Clear value
		}
		$this->emp_city_id->setDbValue($row['emp_city_id']);
		if (array_key_exists('EV__emp_city_id', $rs->fields)) {
			$this->emp_city_id->VirtualValue = $rs->fields('EV__emp_city_id'); // Set up virtual field value
		} else {
			$this->emp_city_id->VirtualValue = ""; // Clear value
		}
		$this->emp_name->setDbValue($row['emp_name']);
		$this->emp_father->setDbValue($row['emp_father']);
		$this->emp_cnic->setDbValue($row['emp_cnic']);
		$this->emp_address->setDbValue($row['emp_address']);
		$this->emp_contact->setDbValue($row['emp_contact']);
		$this->emp_email->setDbValue($row['emp_email']);
		$this->emp_photo->Upload->DbValue = $row['emp_photo'];
		$this->emp_photo->setDbValue($this->emp_photo->Upload->DbValue);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['emp_id'] = $this->emp_id->CurrentValue;
		$row['emp_branch_id'] = $this->emp_branch_id->CurrentValue;
		$row['emp_designation_id'] = $this->emp_designation_id->CurrentValue;
		$row['emp_city_id'] = $this->emp_city_id->CurrentValue;
		$row['emp_name'] = $this->emp_name->CurrentValue;
		$row['emp_father'] = $this->emp_father->CurrentValue;
		$row['emp_cnic'] = $this->emp_cnic->CurrentValue;
		$row['emp_address'] = $this->emp_address->CurrentValue;
		$row['emp_contact'] = $this->emp_contact->CurrentValue;
		$row['emp_email'] = $this->emp_email->CurrentValue;
		$row['emp_photo'] = $this->emp_photo->Upload->DbValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("emp_id")) != "")
			$this->emp_id->OldValue = $this->getKey("emp_id"); // emp_id
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// emp_id
		// emp_branch_id
		// emp_designation_id
		// emp_city_id
		// emp_name
		// emp_father
		// emp_cnic
		// emp_address
		// emp_contact
		// emp_email
		// emp_photo

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// emp_id
			$this->emp_id->ViewValue = $this->emp_id->CurrentValue;
			$this->emp_id->CssClass = "font-weight-bold";
			$this->emp_id->ViewCustomAttributes = "";

			// emp_branch_id
			if ($this->emp_branch_id->VirtualValue != "") {
				$this->emp_branch_id->ViewValue = $this->emp_branch_id->VirtualValue;
			} else {
				$curVal = strval($this->emp_branch_id->CurrentValue);
				if ($curVal != "") {
					$this->emp_branch_id->ViewValue = $this->emp_branch_id->lookupCacheOption($curVal);
					if ($this->emp_branch_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`branch_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->emp_branch_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->emp_branch_id->ViewValue = $this->emp_branch_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->emp_branch_id->ViewValue = $this->emp_branch_id->CurrentValue;
						}
					}
				} else {
					$this->emp_branch_id->ViewValue = NULL;
				}
			}
			$this->emp_branch_id->ViewCustomAttributes = "";

			// emp_designation_id
			if ($this->emp_designation_id->VirtualValue != "") {
				$this->emp_designation_id->ViewValue = $this->emp_designation_id->VirtualValue;
			} else {
				$curVal = strval($this->emp_designation_id->CurrentValue);
				if ($curVal != "") {
					$this->emp_designation_id->ViewValue = $this->emp_designation_id->lookupCacheOption($curVal);
					if ($this->emp_designation_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`designation_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->emp_designation_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->emp_designation_id->ViewValue = $this->emp_designation_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->emp_designation_id->ViewValue = $this->emp_designation_id->CurrentValue;
						}
					}
				} else {
					$this->emp_designation_id->ViewValue = NULL;
				}
			}
			$this->emp_designation_id->ViewCustomAttributes = "";

			// emp_city_id
			if ($this->emp_city_id->VirtualValue != "") {
				$this->emp_city_id->ViewValue = $this->emp_city_id->VirtualValue;
			} else {
				$curVal = strval($this->emp_city_id->CurrentValue);
				if ($curVal != "") {
					$this->emp_city_id->ViewValue = $this->emp_city_id->lookupCacheOption($curVal);
					if ($this->emp_city_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`city_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->emp_city_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->emp_city_id->ViewValue = $this->emp_city_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->emp_city_id->ViewValue = $this->emp_city_id->CurrentValue;
						}
					}
				} else {
					$this->emp_city_id->ViewValue = NULL;
				}
			}
			$this->emp_city_id->ViewCustomAttributes = "";

			// emp_name
			$this->emp_name->ViewValue = $this->emp_name->CurrentValue;
			$this->emp_name->ViewCustomAttributes = "";

			// emp_father
			$this->emp_father->ViewValue = $this->emp_father->CurrentValue;
			$this->emp_father->ViewCustomAttributes = "";

			// emp_cnic
			$this->emp_cnic->ViewValue = $this->emp_cnic->CurrentValue;
			$this->emp_cnic->ViewCustomAttributes = "";

			// emp_address
			$this->emp_address->ViewValue = $this->emp_address->CurrentValue;
			$this->emp_address->ViewCustomAttributes = "";

			// emp_contact
			$this->emp_contact->ViewValue = $this->emp_contact->CurrentValue;
			$this->emp_contact->ViewCustomAttributes = "";

			// emp_email
			$this->emp_email->ViewValue = $this->emp_email->CurrentValue;
			$this->emp_email->ViewCustomAttributes = "";

			// emp_photo
			if (!EmptyValue($this->emp_photo->Upload->DbValue)) {
				$this->emp_photo->ImageWidth = 200;
				$this->emp_photo->ImageHeight = 0;
				$this->emp_photo->ImageAlt = $this->emp_photo->alt();
				$this->emp_photo->ViewValue = $this->emp_photo->Upload->DbValue;
			} else {
				$this->emp_photo->ViewValue = "";
			}
			$this->emp_photo->ViewCustomAttributes = "";

			// emp_branch_id
			$this->emp_branch_id->LinkCustomAttributes = "";
			$this->emp_branch_id->HrefValue = "";
			$this->emp_branch_id->TooltipValue = "";

			// emp_designation_id
			$this->emp_designation_id->LinkCustomAttributes = "";
			$this->emp_designation_id->HrefValue = "";
			$this->emp_designation_id->TooltipValue = "";

			// emp_city_id
			$this->emp_city_id->LinkCustomAttributes = "";
			$this->emp_city_id->HrefValue = "";
			$this->emp_city_id->TooltipValue = "";

			// emp_name
			$this->emp_name->LinkCustomAttributes = "";
			$this->emp_name->HrefValue = "";
			$this->emp_name->TooltipValue = "";

			// emp_father
			$this->emp_father->LinkCustomAttributes = "";
			$this->emp_father->HrefValue = "";
			$this->emp_father->TooltipValue = "";

			// emp_cnic
			$this->emp_cnic->LinkCustomAttributes = "";
			$this->emp_cnic->HrefValue = "";
			$this->emp_cnic->TooltipValue = "";

			// emp_address
			$this->emp_address->LinkCustomAttributes = "";
			$this->emp_address->HrefValue = "";
			$this->emp_address->TooltipValue = "";

			// emp_contact
			$this->emp_contact->LinkCustomAttributes = "";
			$this->emp_contact->HrefValue = "";
			$this->emp_contact->TooltipValue = "";

			// emp_email
			$this->emp_email->LinkCustomAttributes = "";
			$this->emp_email->HrefValue = "";
			$this->emp_email->TooltipValue = "";

			// emp_photo
			$this->emp_photo->LinkCustomAttributes = "";
			if (!EmptyValue($this->emp_photo->Upload->DbValue)) {
				$this->emp_photo->HrefValue = GetFileUploadUrl($this->emp_photo, $this->emp_photo->htmlDecode($this->emp_photo->Upload->DbValue)); // Add prefix/suffix
				$this->emp_photo->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->emp_photo->HrefValue = FullUrl($this->emp_photo->HrefValue, "href");
			} else {
				$this->emp_photo->HrefValue = "";
			}
			$this->emp_photo->ExportHrefValue = $this->emp_photo->UploadPath . $this->emp_photo->Upload->DbValue;
			$this->emp_photo->TooltipValue = "";
			if ($this->emp_photo->UseColorbox) {
				if (EmptyValue($this->emp_photo->TooltipValue))
					$this->emp_photo->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->emp_photo->LinkAttrs["data-rel"] = "employees_x_emp_photo";
				$this->emp_photo->LinkAttrs->appendClass("ew-lightbox");
			}
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// emp_branch_id
			$this->emp_branch_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->emp_branch_id->CurrentValue));
			if ($curVal != "")
				$this->emp_branch_id->ViewValue = $this->emp_branch_id->lookupCacheOption($curVal);
			else
				$this->emp_branch_id->ViewValue = $this->emp_branch_id->Lookup !== NULL && is_array($this->emp_branch_id->Lookup->Options) ? $curVal : NULL;
			if ($this->emp_branch_id->ViewValue !== NULL) { // Load from cache
				$this->emp_branch_id->EditValue = array_values($this->emp_branch_id->Lookup->Options);
				if ($this->emp_branch_id->ViewValue == "")
					$this->emp_branch_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`branch_id`" . SearchString("=", $this->emp_branch_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->emp_branch_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->emp_branch_id->ViewValue = $this->emp_branch_id->displayValue($arwrk);
				} else {
					$this->emp_branch_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->emp_branch_id->EditValue = $arwrk;
			}

			// emp_designation_id
			$this->emp_designation_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->emp_designation_id->CurrentValue));
			if ($curVal != "")
				$this->emp_designation_id->ViewValue = $this->emp_designation_id->lookupCacheOption($curVal);
			else
				$this->emp_designation_id->ViewValue = $this->emp_designation_id->Lookup !== NULL && is_array($this->emp_designation_id->Lookup->Options) ? $curVal : NULL;
			if ($this->emp_designation_id->ViewValue !== NULL) { // Load from cache
				$this->emp_designation_id->EditValue = array_values($this->emp_designation_id->Lookup->Options);
				if ($this->emp_designation_id->ViewValue == "")
					$this->emp_designation_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`designation_id`" . SearchString("=", $this->emp_designation_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->emp_designation_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->emp_designation_id->ViewValue = $this->emp_designation_id->displayValue($arwrk);
				} else {
					$this->emp_designation_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->emp_designation_id->EditValue = $arwrk;
			}

			// emp_city_id
			$this->emp_city_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->emp_city_id->CurrentValue));
			if ($curVal != "")
				$this->emp_city_id->ViewValue = $this->emp_city_id->lookupCacheOption($curVal);
			else
				$this->emp_city_id->ViewValue = $this->emp_city_id->Lookup !== NULL && is_array($this->emp_city_id->Lookup->Options) ? $curVal : NULL;
			if ($this->emp_city_id->ViewValue !== NULL) { // Load from cache
				$this->emp_city_id->EditValue = array_values($this->emp_city_id->Lookup->Options);
				if ($this->emp_city_id->ViewValue == "")
					$this->emp_city_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`city_id`" . SearchString("=", $this->emp_city_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->emp_city_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->emp_city_id->ViewValue = $this->emp_city_id->displayValue($arwrk);
				} else {
					$this->emp_city_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->emp_city_id->EditValue = $arwrk;
			}

			// emp_name
			$this->emp_name->EditAttrs["class"] = "form-control";
			$this->emp_name->EditCustomAttributes = "";
			if (!$this->emp_name->Raw)
				$this->emp_name->CurrentValue = HtmlDecode($this->emp_name->CurrentValue);
			$this->emp_name->EditValue = HtmlEncode($this->emp_name->CurrentValue);
			$this->emp_name->PlaceHolder = RemoveHtml($this->emp_name->caption());

			// emp_father
			$this->emp_father->EditAttrs["class"] = "form-control";
			$this->emp_father->EditCustomAttributes = "";
			if (!$this->emp_father->Raw)
				$this->emp_father->CurrentValue = HtmlDecode($this->emp_father->CurrentValue);
			$this->emp_father->EditValue = HtmlEncode($this->emp_father->CurrentValue);
			$this->emp_father->PlaceHolder = RemoveHtml($this->emp_father->caption());

			// emp_cnic
			$this->emp_cnic->EditAttrs["class"] = "form-control";
			$this->emp_cnic->EditCustomAttributes = "";
			if (!$this->emp_cnic->Raw)
				$this->emp_cnic->CurrentValue = HtmlDecode($this->emp_cnic->CurrentValue);
			$this->emp_cnic->EditValue = HtmlEncode($this->emp_cnic->CurrentValue);
			$this->emp_cnic->PlaceHolder = RemoveHtml($this->emp_cnic->caption());

			// emp_address
			$this->emp_address->EditAttrs["class"] = "form-control";
			$this->emp_address->EditCustomAttributes = "";
			if (!$this->emp_address->Raw)
				$this->emp_address->CurrentValue = HtmlDecode($this->emp_address->CurrentValue);
			$this->emp_address->EditValue = HtmlEncode($this->emp_address->CurrentValue);
			$this->emp_address->PlaceHolder = RemoveHtml($this->emp_address->caption());

			// emp_contact
			$this->emp_contact->EditAttrs["class"] = "form-control";
			$this->emp_contact->EditCustomAttributes = "";
			if (!$this->emp_contact->Raw)
				$this->emp_contact->CurrentValue = HtmlDecode($this->emp_contact->CurrentValue);
			$this->emp_contact->EditValue = HtmlEncode($this->emp_contact->CurrentValue);
			$this->emp_contact->PlaceHolder = RemoveHtml($this->emp_contact->caption());

			// emp_email
			$this->emp_email->EditAttrs["class"] = "form-control";
			$this->emp_email->EditCustomAttributes = "";
			if (!$this->emp_email->Raw)
				$this->emp_email->CurrentValue = HtmlDecode($this->emp_email->CurrentValue);
			$this->emp_email->EditValue = HtmlEncode($this->emp_email->CurrentValue);
			$this->emp_email->PlaceHolder = RemoveHtml($this->emp_email->caption());

			// emp_photo
			$this->emp_photo->EditAttrs["class"] = "form-control";
			$this->emp_photo->EditCustomAttributes = "";
			if (!EmptyValue($this->emp_photo->Upload->DbValue)) {
				$this->emp_photo->ImageWidth = 200;
				$this->emp_photo->ImageHeight = 0;
				$this->emp_photo->ImageAlt = $this->emp_photo->alt();
				$this->emp_photo->EditValue = $this->emp_photo->Upload->DbValue;
			} else {
				$this->emp_photo->EditValue = "";
			}
			if (!EmptyValue($this->emp_photo->CurrentValue))
					$this->emp_photo->Upload->FileName = $this->emp_photo->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->emp_photo);

			// Add refer script
			// emp_branch_id

			$this->emp_branch_id->LinkCustomAttributes = "";
			$this->emp_branch_id->HrefValue = "";

			// emp_designation_id
			$this->emp_designation_id->LinkCustomAttributes = "";
			$this->emp_designation_id->HrefValue = "";

			// emp_city_id
			$this->emp_city_id->LinkCustomAttributes = "";
			$this->emp_city_id->HrefValue = "";

			// emp_name
			$this->emp_name->LinkCustomAttributes = "";
			$this->emp_name->HrefValue = "";

			// emp_father
			$this->emp_father->LinkCustomAttributes = "";
			$this->emp_father->HrefValue = "";

			// emp_cnic
			$this->emp_cnic->LinkCustomAttributes = "";
			$this->emp_cnic->HrefValue = "";

			// emp_address
			$this->emp_address->LinkCustomAttributes = "";
			$this->emp_address->HrefValue = "";

			// emp_contact
			$this->emp_contact->LinkCustomAttributes = "";
			$this->emp_contact->HrefValue = "";

			// emp_email
			$this->emp_email->LinkCustomAttributes = "";
			$this->emp_email->HrefValue = "";

			// emp_photo
			$this->emp_photo->LinkCustomAttributes = "";
			if (!EmptyValue($this->emp_photo->Upload->DbValue)) {
				$this->emp_photo->HrefValue = GetFileUploadUrl($this->emp_photo, $this->emp_photo->htmlDecode($this->emp_photo->Upload->DbValue)); // Add prefix/suffix
				$this->emp_photo->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->emp_photo->HrefValue = FullUrl($this->emp_photo->HrefValue, "href");
			} else {
				$this->emp_photo->HrefValue = "";
			}
			$this->emp_photo->ExportHrefValue = $this->emp_photo->UploadPath . $this->emp_photo->Upload->DbValue;
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
		if ($this->emp_branch_id->Required) {
			if (!$this->emp_branch_id->IsDetailKey && $this->emp_branch_id->FormValue != NULL && $this->emp_branch_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->emp_branch_id->caption(), $this->emp_branch_id->RequiredErrorMessage));
			}
		}
		if ($this->emp_designation_id->Required) {
			if (!$this->emp_designation_id->IsDetailKey && $this->emp_designation_id->FormValue != NULL && $this->emp_designation_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->emp_designation_id->caption(), $this->emp_designation_id->RequiredErrorMessage));
			}
		}
		if ($this->emp_city_id->Required) {
			if (!$this->emp_city_id->IsDetailKey && $this->emp_city_id->FormValue != NULL && $this->emp_city_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->emp_city_id->caption(), $this->emp_city_id->RequiredErrorMessage));
			}
		}
		if ($this->emp_name->Required) {
			if (!$this->emp_name->IsDetailKey && $this->emp_name->FormValue != NULL && $this->emp_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->emp_name->caption(), $this->emp_name->RequiredErrorMessage));
			}
		}
		if ($this->emp_father->Required) {
			if (!$this->emp_father->IsDetailKey && $this->emp_father->FormValue != NULL && $this->emp_father->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->emp_father->caption(), $this->emp_father->RequiredErrorMessage));
			}
		}
		if ($this->emp_cnic->Required) {
			if (!$this->emp_cnic->IsDetailKey && $this->emp_cnic->FormValue != NULL && $this->emp_cnic->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->emp_cnic->caption(), $this->emp_cnic->RequiredErrorMessage));
			}
		}
		if ($this->emp_address->Required) {
			if (!$this->emp_address->IsDetailKey && $this->emp_address->FormValue != NULL && $this->emp_address->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->emp_address->caption(), $this->emp_address->RequiredErrorMessage));
			}
		}
		if ($this->emp_contact->Required) {
			if (!$this->emp_contact->IsDetailKey && $this->emp_contact->FormValue != NULL && $this->emp_contact->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->emp_contact->caption(), $this->emp_contact->RequiredErrorMessage));
			}
		}
		if ($this->emp_email->Required) {
			if (!$this->emp_email->IsDetailKey && $this->emp_email->FormValue != NULL && $this->emp_email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->emp_email->caption(), $this->emp_email->RequiredErrorMessage));
			}
		}
		if ($this->emp_photo->Required) {
			if ($this->emp_photo->Upload->FileName == "" && !$this->emp_photo->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->emp_photo->caption(), $this->emp_photo->RequiredErrorMessage));
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		if ($this->emp_cnic->CurrentValue != "") { // Check field with unique index
			$filter = "(emp_cnic = '" . AdjustSql($this->emp_cnic->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->emp_cnic->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->emp_cnic->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// emp_branch_id
		$this->emp_branch_id->setDbValueDef($rsnew, $this->emp_branch_id->CurrentValue, 0, FALSE);

		// emp_designation_id
		$this->emp_designation_id->setDbValueDef($rsnew, $this->emp_designation_id->CurrentValue, 0, FALSE);

		// emp_city_id
		$this->emp_city_id->setDbValueDef($rsnew, $this->emp_city_id->CurrentValue, 0, FALSE);

		// emp_name
		$this->emp_name->setDbValueDef($rsnew, $this->emp_name->CurrentValue, "", FALSE);

		// emp_father
		$this->emp_father->setDbValueDef($rsnew, $this->emp_father->CurrentValue, "", FALSE);

		// emp_cnic
		$this->emp_cnic->setDbValueDef($rsnew, $this->emp_cnic->CurrentValue, "", FALSE);

		// emp_address
		$this->emp_address->setDbValueDef($rsnew, $this->emp_address->CurrentValue, "", FALSE);

		// emp_contact
		$this->emp_contact->setDbValueDef($rsnew, $this->emp_contact->CurrentValue, "", FALSE);

		// emp_email
		$this->emp_email->setDbValueDef($rsnew, $this->emp_email->CurrentValue, "", FALSE);

		// emp_photo
		if ($this->emp_photo->Visible && !$this->emp_photo->Upload->KeepFile) {
			$this->emp_photo->Upload->DbValue = ""; // No need to delete old file
			if ($this->emp_photo->Upload->FileName == "") {
				$rsnew['emp_photo'] = NULL;
			} else {
				$rsnew['emp_photo'] = $this->emp_photo->Upload->FileName;
			}
			$this->emp_photo->ImageWidth = 1000; // Resize width
			$this->emp_photo->ImageHeight = 0; // Resize height
		}
		if ($this->emp_photo->Visible && !$this->emp_photo->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->emp_photo->Upload->DbValue) ? [] : [$this->emp_photo->htmlDecode($this->emp_photo->Upload->DbValue)];
			if (!EmptyValue($this->emp_photo->Upload->FileName)) {
				$newFiles = [$this->emp_photo->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->emp_photo, $this->emp_photo->Upload->Index);
						if (file_exists($tempPath . $file)) {
							if (Config("DELETE_UPLOADED_FILES")) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->emp_photo->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->emp_photo->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->emp_photo->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->emp_photo->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->emp_photo->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->emp_photo->setDbValueDef($rsnew, $this->emp_photo->Upload->FileName, "", FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
				if ($this->emp_photo->Visible && !$this->emp_photo->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->emp_photo->Upload->DbValue) ? [] : [$this->emp_photo->htmlDecode($this->emp_photo->Upload->DbValue)];
					if (!EmptyValue($this->emp_photo->Upload->FileName)) {
						$newFiles = [$this->emp_photo->Upload->FileName];
						$newFiles2 = [$this->emp_photo->htmlDecode($rsnew['emp_photo'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->emp_photo, $this->emp_photo->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->emp_photo->Upload->ResizeAndSaveToFile($this->emp_photo->ImageWidth, $this->emp_photo->ImageHeight, 100, $newFiles[$i], TRUE, $i)) {
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = [];
					}
					if (Config("DELETE_UPLOADED_FILES")) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile != "" && !in_array($oldFile, $newFiles))
								@unlink($this->emp_photo->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {

			// emp_photo
			if ($this->emp_photo->Upload->FileToken != "")
				CleanUploadTempPath($this->emp_photo->Upload->FileToken, $this->emp_photo->Upload->Index);
			else
				CleanUploadTempPath($this->emp_photo, $this->emp_photo->Upload->Index);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("employeeslist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
				case "x_emp_branch_id":
					break;
				case "x_emp_designation_id":
					break;
				case "x_emp_city_id":
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
						case "x_emp_branch_id":
							break;
						case "x_emp_designation_id":
							break;
						case "x_emp_city_id":
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