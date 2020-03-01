<?php
namespace PHPMaker2020\dexdevs_crm;

/**
 * Page class
 */
class cus_support_add extends cus_support
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{95D902CB-0C6D-412B-B939-09A42C7A8FBF}";

	// Table name
	public $TableName = 'cus_support';

	// Page object name
	public $PageObjName = "cus_support_add";

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
		global $UserTable;

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

		// Table object (cus_support)
		if (!isset($GLOBALS["cus_support"]) || get_class($GLOBALS["cus_support"]) == PROJECT_NAMESPACE . "cus_support") {
			$GLOBALS["cus_support"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cus_support"];
		}

		// Table object (user)
		if (!isset($GLOBALS['user']))
			$GLOBALS['user'] = new user();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'cus_support');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (user)
		$UserTable = $UserTable ?: new user();
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
		global $cus_support;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($cus_support);
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
					if ($pageName == "cus_supportview.php")
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
			$key .= @$ar['cus_sup_id'];
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
			$this->cus_sup_id->Visible = FALSE;
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
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
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
			if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
			if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
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
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("cus_supportlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->cus_sup_id->Visible = FALSE;
		$this->cus_sup_branch_id->setVisibility();
		$this->cus_sup_emp_id->setVisibility();
		$this->cus_sup_query->setVisibility();
		$this->cus_sup_screen_shots->setVisibility();
		$this->cus_sup_date->setVisibility();
		$this->cus_sup_status->setVisibility();
		$this->cus_sup_comments->setVisibility();
		$this->cus_sup_resolved_on->setVisibility();
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
		$this->setupLookupOptions($this->cus_sup_branch_id);
		$this->setupLookupOptions($this->cus_sup_emp_id);

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
			if (Get("cus_sup_id") !== NULL) {
				$this->cus_sup_id->setQueryStringValue(Get("cus_sup_id"));
				$this->setKey("cus_sup_id", $this->cus_sup_id->CurrentValue); // Set up key
			} else {
				$this->setKey("cus_sup_id", ""); // Clear key
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
					$this->terminate("cus_supportlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "cus_supportlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "cus_supportview.php")
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
		$this->cus_sup_screen_shots->Upload->Index = $CurrentForm->Index;
		$this->cus_sup_screen_shots->Upload->uploadFile();
		$this->cus_sup_screen_shots->CurrentValue = $this->cus_sup_screen_shots->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->cus_sup_id->CurrentValue = NULL;
		$this->cus_sup_id->OldValue = $this->cus_sup_id->CurrentValue;
		$this->cus_sup_branch_id->CurrentValue = NULL;
		$this->cus_sup_branch_id->OldValue = $this->cus_sup_branch_id->CurrentValue;
		$this->cus_sup_emp_id->CurrentValue = NULL;
		$this->cus_sup_emp_id->OldValue = $this->cus_sup_emp_id->CurrentValue;
		$this->cus_sup_query->CurrentValue = NULL;
		$this->cus_sup_query->OldValue = $this->cus_sup_query->CurrentValue;
		$this->cus_sup_screen_shots->Upload->DbValue = NULL;
		$this->cus_sup_screen_shots->OldValue = $this->cus_sup_screen_shots->Upload->DbValue;
		$this->cus_sup_screen_shots->CurrentValue = NULL; // Clear file related field
		$this->cus_sup_date->CurrentValue = NULL;
		$this->cus_sup_date->OldValue = $this->cus_sup_date->CurrentValue;
		$this->cus_sup_status->CurrentValue = NULL;
		$this->cus_sup_status->OldValue = $this->cus_sup_status->CurrentValue;
		$this->cus_sup_comments->CurrentValue = NULL;
		$this->cus_sup_comments->OldValue = $this->cus_sup_comments->CurrentValue;
		$this->cus_sup_resolved_on->CurrentValue = NULL;
		$this->cus_sup_resolved_on->OldValue = $this->cus_sup_resolved_on->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'cus_sup_branch_id' first before field var 'x_cus_sup_branch_id'
		$val = $CurrentForm->hasValue("cus_sup_branch_id") ? $CurrentForm->getValue("cus_sup_branch_id") : $CurrentForm->getValue("x_cus_sup_branch_id");
		if (!$this->cus_sup_branch_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cus_sup_branch_id->Visible = FALSE; // Disable update for API request
			else
				$this->cus_sup_branch_id->setFormValue($val);
		}

		// Check field name 'cus_sup_emp_id' first before field var 'x_cus_sup_emp_id'
		$val = $CurrentForm->hasValue("cus_sup_emp_id") ? $CurrentForm->getValue("cus_sup_emp_id") : $CurrentForm->getValue("x_cus_sup_emp_id");
		if (!$this->cus_sup_emp_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cus_sup_emp_id->Visible = FALSE; // Disable update for API request
			else
				$this->cus_sup_emp_id->setFormValue($val);
		}

		// Check field name 'cus_sup_query' first before field var 'x_cus_sup_query'
		$val = $CurrentForm->hasValue("cus_sup_query") ? $CurrentForm->getValue("cus_sup_query") : $CurrentForm->getValue("x_cus_sup_query");
		if (!$this->cus_sup_query->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cus_sup_query->Visible = FALSE; // Disable update for API request
			else
				$this->cus_sup_query->setFormValue($val);
		}

		// Check field name 'cus_sup_date' first before field var 'x_cus_sup_date'
		$val = $CurrentForm->hasValue("cus_sup_date") ? $CurrentForm->getValue("cus_sup_date") : $CurrentForm->getValue("x_cus_sup_date");
		if (!$this->cus_sup_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cus_sup_date->Visible = FALSE; // Disable update for API request
			else
				$this->cus_sup_date->setFormValue($val);
			$this->cus_sup_date->CurrentValue = UnFormatDateTime($this->cus_sup_date->CurrentValue, 1);
		}

		// Check field name 'cus_sup_status' first before field var 'x_cus_sup_status'
		$val = $CurrentForm->hasValue("cus_sup_status") ? $CurrentForm->getValue("cus_sup_status") : $CurrentForm->getValue("x_cus_sup_status");
		if (!$this->cus_sup_status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cus_sup_status->Visible = FALSE; // Disable update for API request
			else
				$this->cus_sup_status->setFormValue($val);
		}

		// Check field name 'cus_sup_comments' first before field var 'x_cus_sup_comments'
		$val = $CurrentForm->hasValue("cus_sup_comments") ? $CurrentForm->getValue("cus_sup_comments") : $CurrentForm->getValue("x_cus_sup_comments");
		if (!$this->cus_sup_comments->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cus_sup_comments->Visible = FALSE; // Disable update for API request
			else
				$this->cus_sup_comments->setFormValue($val);
		}

		// Check field name 'cus_sup_resolved_on' first before field var 'x_cus_sup_resolved_on'
		$val = $CurrentForm->hasValue("cus_sup_resolved_on") ? $CurrentForm->getValue("cus_sup_resolved_on") : $CurrentForm->getValue("x_cus_sup_resolved_on");
		if (!$this->cus_sup_resolved_on->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cus_sup_resolved_on->Visible = FALSE; // Disable update for API request
			else
				$this->cus_sup_resolved_on->setFormValue($val);
			$this->cus_sup_resolved_on->CurrentValue = UnFormatDateTime($this->cus_sup_resolved_on->CurrentValue, 1);
		}

		// Check field name 'cus_sup_id' first before field var 'x_cus_sup_id'
		$val = $CurrentForm->hasValue("cus_sup_id") ? $CurrentForm->getValue("cus_sup_id") : $CurrentForm->getValue("x_cus_sup_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->cus_sup_branch_id->CurrentValue = $this->cus_sup_branch_id->FormValue;
		$this->cus_sup_emp_id->CurrentValue = $this->cus_sup_emp_id->FormValue;
		$this->cus_sup_query->CurrentValue = $this->cus_sup_query->FormValue;
		$this->cus_sup_date->CurrentValue = $this->cus_sup_date->FormValue;
		$this->cus_sup_date->CurrentValue = UnFormatDateTime($this->cus_sup_date->CurrentValue, 1);
		$this->cus_sup_status->CurrentValue = $this->cus_sup_status->FormValue;
		$this->cus_sup_comments->CurrentValue = $this->cus_sup_comments->FormValue;
		$this->cus_sup_resolved_on->CurrentValue = $this->cus_sup_resolved_on->FormValue;
		$this->cus_sup_resolved_on->CurrentValue = UnFormatDateTime($this->cus_sup_resolved_on->CurrentValue, 1);
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
		$this->cus_sup_id->setDbValue($row['cus_sup_id']);
		$this->cus_sup_branch_id->setDbValue($row['cus_sup_branch_id']);
		$this->cus_sup_emp_id->setDbValue($row['cus_sup_emp_id']);
		if (array_key_exists('EV__cus_sup_emp_id', $rs->fields)) {
			$this->cus_sup_emp_id->VirtualValue = $rs->fields('EV__cus_sup_emp_id'); // Set up virtual field value
		} else {
			$this->cus_sup_emp_id->VirtualValue = ""; // Clear value
		}
		$this->cus_sup_query->setDbValue($row['cus_sup_query']);
		$this->cus_sup_screen_shots->Upload->DbValue = $row['cus_sup_screen_shots'];
		$this->cus_sup_screen_shots->setDbValue($this->cus_sup_screen_shots->Upload->DbValue);
		$this->cus_sup_date->setDbValue($row['cus_sup_date']);
		$this->cus_sup_status->setDbValue($row['cus_sup_status']);
		$this->cus_sup_comments->setDbValue($row['cus_sup_comments']);
		$this->cus_sup_resolved_on->setDbValue($row['cus_sup_resolved_on']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['cus_sup_id'] = $this->cus_sup_id->CurrentValue;
		$row['cus_sup_branch_id'] = $this->cus_sup_branch_id->CurrentValue;
		$row['cus_sup_emp_id'] = $this->cus_sup_emp_id->CurrentValue;
		$row['cus_sup_query'] = $this->cus_sup_query->CurrentValue;
		$row['cus_sup_screen_shots'] = $this->cus_sup_screen_shots->Upload->DbValue;
		$row['cus_sup_date'] = $this->cus_sup_date->CurrentValue;
		$row['cus_sup_status'] = $this->cus_sup_status->CurrentValue;
		$row['cus_sup_comments'] = $this->cus_sup_comments->CurrentValue;
		$row['cus_sup_resolved_on'] = $this->cus_sup_resolved_on->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("cus_sup_id")) != "")
			$this->cus_sup_id->OldValue = $this->getKey("cus_sup_id"); // cus_sup_id
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
		// cus_sup_id
		// cus_sup_branch_id
		// cus_sup_emp_id
		// cus_sup_query
		// cus_sup_screen_shots
		// cus_sup_date
		// cus_sup_status
		// cus_sup_comments
		// cus_sup_resolved_on

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// cus_sup_id
			$this->cus_sup_id->ViewValue = $this->cus_sup_id->CurrentValue;
			$this->cus_sup_id->CssClass = "font-weight-bold";
			$this->cus_sup_id->ViewCustomAttributes = "";

			// cus_sup_branch_id
			$curVal = strval($this->cus_sup_branch_id->CurrentValue);
			if ($curVal != "") {
				$this->cus_sup_branch_id->ViewValue = $this->cus_sup_branch_id->lookupCacheOption($curVal);
				if ($this->cus_sup_branch_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`branch_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->cus_sup_branch_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->cus_sup_branch_id->ViewValue = $this->cus_sup_branch_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->cus_sup_branch_id->ViewValue = $this->cus_sup_branch_id->CurrentValue;
					}
				}
			} else {
				$this->cus_sup_branch_id->ViewValue = NULL;
			}
			$this->cus_sup_branch_id->ViewCustomAttributes = "";

			// cus_sup_emp_id
			if ($this->cus_sup_emp_id->VirtualValue != "") {
				$this->cus_sup_emp_id->ViewValue = $this->cus_sup_emp_id->VirtualValue;
			} else {
				$curVal = strval($this->cus_sup_emp_id->CurrentValue);
				if ($curVal != "") {
					$this->cus_sup_emp_id->ViewValue = $this->cus_sup_emp_id->lookupCacheOption($curVal);
					if ($this->cus_sup_emp_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`emp_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->cus_sup_emp_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->cus_sup_emp_id->ViewValue = $this->cus_sup_emp_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->cus_sup_emp_id->ViewValue = $this->cus_sup_emp_id->CurrentValue;
						}
					}
				} else {
					$this->cus_sup_emp_id->ViewValue = NULL;
				}
			}
			$this->cus_sup_emp_id->ViewCustomAttributes = "";

			// cus_sup_query
			$this->cus_sup_query->ViewValue = $this->cus_sup_query->CurrentValue;
			$this->cus_sup_query->ViewCustomAttributes = "";

			// cus_sup_screen_shots
			if (!EmptyValue($this->cus_sup_screen_shots->Upload->DbValue)) {
				$this->cus_sup_screen_shots->ImageWidth = 200;
				$this->cus_sup_screen_shots->ImageHeight = 0;
				$this->cus_sup_screen_shots->ImageAlt = $this->cus_sup_screen_shots->alt();
				$this->cus_sup_screen_shots->ViewValue = $this->cus_sup_screen_shots->Upload->DbValue;
			} else {
				$this->cus_sup_screen_shots->ViewValue = "";
			}
			$this->cus_sup_screen_shots->ViewCustomAttributes = "";

			// cus_sup_date
			$this->cus_sup_date->ViewValue = $this->cus_sup_date->CurrentValue;
			$this->cus_sup_date->ViewValue = FormatDateTime($this->cus_sup_date->ViewValue, 1);
			$this->cus_sup_date->ViewCustomAttributes = "";

			// cus_sup_status
			if (strval($this->cus_sup_status->CurrentValue) != "") {
				$this->cus_sup_status->ViewValue = $this->cus_sup_status->optionCaption($this->cus_sup_status->CurrentValue);
			} else {
				$this->cus_sup_status->ViewValue = NULL;
			}
			$this->cus_sup_status->ViewCustomAttributes = "";

			// cus_sup_comments
			$this->cus_sup_comments->ViewValue = $this->cus_sup_comments->CurrentValue;
			$this->cus_sup_comments->ViewCustomAttributes = "";

			// cus_sup_resolved_on
			$this->cus_sup_resolved_on->ViewValue = $this->cus_sup_resolved_on->CurrentValue;
			$this->cus_sup_resolved_on->ViewValue = FormatDateTime($this->cus_sup_resolved_on->ViewValue, 1);
			$this->cus_sup_resolved_on->ViewCustomAttributes = "";

			// cus_sup_branch_id
			$this->cus_sup_branch_id->LinkCustomAttributes = "";
			$this->cus_sup_branch_id->HrefValue = "";
			$this->cus_sup_branch_id->TooltipValue = "";

			// cus_sup_emp_id
			$this->cus_sup_emp_id->LinkCustomAttributes = "";
			$this->cus_sup_emp_id->HrefValue = "";
			$this->cus_sup_emp_id->TooltipValue = "";

			// cus_sup_query
			$this->cus_sup_query->LinkCustomAttributes = "";
			$this->cus_sup_query->HrefValue = "";
			$this->cus_sup_query->TooltipValue = "";

			// cus_sup_screen_shots
			$this->cus_sup_screen_shots->LinkCustomAttributes = "";
			if (!EmptyValue($this->cus_sup_screen_shots->Upload->DbValue)) {
				$this->cus_sup_screen_shots->HrefValue = "%u"; // Add prefix/suffix
				$this->cus_sup_screen_shots->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->cus_sup_screen_shots->HrefValue = FullUrl($this->cus_sup_screen_shots->HrefValue, "href");
			} else {
				$this->cus_sup_screen_shots->HrefValue = "";
			}
			$this->cus_sup_screen_shots->ExportHrefValue = $this->cus_sup_screen_shots->UploadPath . $this->cus_sup_screen_shots->Upload->DbValue;
			$this->cus_sup_screen_shots->TooltipValue = "";
			if ($this->cus_sup_screen_shots->UseColorbox) {
				if (EmptyValue($this->cus_sup_screen_shots->TooltipValue))
					$this->cus_sup_screen_shots->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->cus_sup_screen_shots->LinkAttrs["data-rel"] = "cus_support_x_cus_sup_screen_shots";
				$this->cus_sup_screen_shots->LinkAttrs->appendClass("ew-lightbox");
			}

			// cus_sup_date
			$this->cus_sup_date->LinkCustomAttributes = "";
			$this->cus_sup_date->HrefValue = "";
			$this->cus_sup_date->TooltipValue = "";

			// cus_sup_status
			$this->cus_sup_status->LinkCustomAttributes = "";
			$this->cus_sup_status->HrefValue = "";
			$this->cus_sup_status->TooltipValue = "";

			// cus_sup_comments
			$this->cus_sup_comments->LinkCustomAttributes = "";
			$this->cus_sup_comments->HrefValue = "";
			$this->cus_sup_comments->TooltipValue = "";

			// cus_sup_resolved_on
			$this->cus_sup_resolved_on->LinkCustomAttributes = "";
			$this->cus_sup_resolved_on->HrefValue = "";
			$this->cus_sup_resolved_on->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// cus_sup_branch_id
			$this->cus_sup_branch_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->cus_sup_branch_id->CurrentValue));
			if ($curVal != "")
				$this->cus_sup_branch_id->ViewValue = $this->cus_sup_branch_id->lookupCacheOption($curVal);
			else
				$this->cus_sup_branch_id->ViewValue = $this->cus_sup_branch_id->Lookup !== NULL && is_array($this->cus_sup_branch_id->Lookup->Options) ? $curVal : NULL;
			if ($this->cus_sup_branch_id->ViewValue !== NULL) { // Load from cache
				$this->cus_sup_branch_id->EditValue = array_values($this->cus_sup_branch_id->Lookup->Options);
				if ($this->cus_sup_branch_id->ViewValue == "")
					$this->cus_sup_branch_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`branch_id`" . SearchString("=", $this->cus_sup_branch_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->cus_sup_branch_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->cus_sup_branch_id->ViewValue = $this->cus_sup_branch_id->displayValue($arwrk);
				} else {
					$this->cus_sup_branch_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->cus_sup_branch_id->EditValue = $arwrk;
			}

			// cus_sup_emp_id
			$this->cus_sup_emp_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->cus_sup_emp_id->CurrentValue));
			if ($curVal != "")
				$this->cus_sup_emp_id->ViewValue = $this->cus_sup_emp_id->lookupCacheOption($curVal);
			else
				$this->cus_sup_emp_id->ViewValue = $this->cus_sup_emp_id->Lookup !== NULL && is_array($this->cus_sup_emp_id->Lookup->Options) ? $curVal : NULL;
			if ($this->cus_sup_emp_id->ViewValue !== NULL) { // Load from cache
				$this->cus_sup_emp_id->EditValue = array_values($this->cus_sup_emp_id->Lookup->Options);
				if ($this->cus_sup_emp_id->ViewValue == "")
					$this->cus_sup_emp_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`emp_id`" . SearchString("=", $this->cus_sup_emp_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->cus_sup_emp_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->cus_sup_emp_id->ViewValue = $this->cus_sup_emp_id->displayValue($arwrk);
				} else {
					$this->cus_sup_emp_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->cus_sup_emp_id->EditValue = $arwrk;
			}

			// cus_sup_query
			$this->cus_sup_query->EditAttrs["class"] = "form-control";
			$this->cus_sup_query->EditCustomAttributes = "";
			$this->cus_sup_query->EditValue = HtmlEncode($this->cus_sup_query->CurrentValue);
			$this->cus_sup_query->PlaceHolder = RemoveHtml($this->cus_sup_query->caption());

			// cus_sup_screen_shots
			$this->cus_sup_screen_shots->EditAttrs["class"] = "form-control";
			$this->cus_sup_screen_shots->EditCustomAttributes = "";
			if (!EmptyValue($this->cus_sup_screen_shots->Upload->DbValue)) {
				$this->cus_sup_screen_shots->ImageWidth = 200;
				$this->cus_sup_screen_shots->ImageHeight = 0;
				$this->cus_sup_screen_shots->ImageAlt = $this->cus_sup_screen_shots->alt();
				$this->cus_sup_screen_shots->EditValue = $this->cus_sup_screen_shots->Upload->DbValue;
			} else {
				$this->cus_sup_screen_shots->EditValue = "";
			}
			if (!EmptyValue($this->cus_sup_screen_shots->CurrentValue))
					$this->cus_sup_screen_shots->Upload->FileName = $this->cus_sup_screen_shots->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->cus_sup_screen_shots);

			// cus_sup_date
			$this->cus_sup_date->EditAttrs["class"] = "form-control";
			$this->cus_sup_date->EditCustomAttributes = "";
			$this->cus_sup_date->EditValue = HtmlEncode(FormatDateTime($this->cus_sup_date->CurrentValue, 8));
			$this->cus_sup_date->PlaceHolder = RemoveHtml($this->cus_sup_date->caption());

			// cus_sup_status
			$this->cus_sup_status->EditCustomAttributes = "";
			$this->cus_sup_status->EditValue = $this->cus_sup_status->options(FALSE);

			// cus_sup_comments
			$this->cus_sup_comments->EditAttrs["class"] = "form-control";
			$this->cus_sup_comments->EditCustomAttributes = "";
			$this->cus_sup_comments->EditValue = HtmlEncode($this->cus_sup_comments->CurrentValue);
			$this->cus_sup_comments->PlaceHolder = RemoveHtml($this->cus_sup_comments->caption());

			// cus_sup_resolved_on
			$this->cus_sup_resolved_on->EditAttrs["class"] = "form-control";
			$this->cus_sup_resolved_on->EditCustomAttributes = "";
			$this->cus_sup_resolved_on->EditValue = HtmlEncode(FormatDateTime($this->cus_sup_resolved_on->CurrentValue, 8));
			$this->cus_sup_resolved_on->PlaceHolder = RemoveHtml($this->cus_sup_resolved_on->caption());

			// Add refer script
			// cus_sup_branch_id

			$this->cus_sup_branch_id->LinkCustomAttributes = "";
			$this->cus_sup_branch_id->HrefValue = "";

			// cus_sup_emp_id
			$this->cus_sup_emp_id->LinkCustomAttributes = "";
			$this->cus_sup_emp_id->HrefValue = "";

			// cus_sup_query
			$this->cus_sup_query->LinkCustomAttributes = "";
			$this->cus_sup_query->HrefValue = "";

			// cus_sup_screen_shots
			$this->cus_sup_screen_shots->LinkCustomAttributes = "";
			if (!EmptyValue($this->cus_sup_screen_shots->Upload->DbValue)) {
				$this->cus_sup_screen_shots->HrefValue = "%u"; // Add prefix/suffix
				$this->cus_sup_screen_shots->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->cus_sup_screen_shots->HrefValue = FullUrl($this->cus_sup_screen_shots->HrefValue, "href");
			} else {
				$this->cus_sup_screen_shots->HrefValue = "";
			}
			$this->cus_sup_screen_shots->ExportHrefValue = $this->cus_sup_screen_shots->UploadPath . $this->cus_sup_screen_shots->Upload->DbValue;

			// cus_sup_date
			$this->cus_sup_date->LinkCustomAttributes = "";
			$this->cus_sup_date->HrefValue = "";

			// cus_sup_status
			$this->cus_sup_status->LinkCustomAttributes = "";
			$this->cus_sup_status->HrefValue = "";

			// cus_sup_comments
			$this->cus_sup_comments->LinkCustomAttributes = "";
			$this->cus_sup_comments->HrefValue = "";

			// cus_sup_resolved_on
			$this->cus_sup_resolved_on->LinkCustomAttributes = "";
			$this->cus_sup_resolved_on->HrefValue = "";
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
		if ($this->cus_sup_branch_id->Required) {
			if (!$this->cus_sup_branch_id->IsDetailKey && $this->cus_sup_branch_id->FormValue != NULL && $this->cus_sup_branch_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cus_sup_branch_id->caption(), $this->cus_sup_branch_id->RequiredErrorMessage));
			}
		}
		if ($this->cus_sup_emp_id->Required) {
			if (!$this->cus_sup_emp_id->IsDetailKey && $this->cus_sup_emp_id->FormValue != NULL && $this->cus_sup_emp_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cus_sup_emp_id->caption(), $this->cus_sup_emp_id->RequiredErrorMessage));
			}
		}
		if ($this->cus_sup_query->Required) {
			if (!$this->cus_sup_query->IsDetailKey && $this->cus_sup_query->FormValue != NULL && $this->cus_sup_query->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cus_sup_query->caption(), $this->cus_sup_query->RequiredErrorMessage));
			}
		}
		if ($this->cus_sup_screen_shots->Required) {
			if ($this->cus_sup_screen_shots->Upload->FileName == "" && !$this->cus_sup_screen_shots->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->cus_sup_screen_shots->caption(), $this->cus_sup_screen_shots->RequiredErrorMessage));
			}
		}
		if ($this->cus_sup_date->Required) {
			if (!$this->cus_sup_date->IsDetailKey && $this->cus_sup_date->FormValue != NULL && $this->cus_sup_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cus_sup_date->caption(), $this->cus_sup_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->cus_sup_date->FormValue)) {
			AddMessage($FormError, $this->cus_sup_date->errorMessage());
		}
		if ($this->cus_sup_status->Required) {
			if ($this->cus_sup_status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cus_sup_status->caption(), $this->cus_sup_status->RequiredErrorMessage));
			}
		}
		if ($this->cus_sup_comments->Required) {
			if (!$this->cus_sup_comments->IsDetailKey && $this->cus_sup_comments->FormValue != NULL && $this->cus_sup_comments->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cus_sup_comments->caption(), $this->cus_sup_comments->RequiredErrorMessage));
			}
		}
		if ($this->cus_sup_resolved_on->Required) {
			if (!$this->cus_sup_resolved_on->IsDetailKey && $this->cus_sup_resolved_on->FormValue != NULL && $this->cus_sup_resolved_on->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cus_sup_resolved_on->caption(), $this->cus_sup_resolved_on->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->cus_sup_resolved_on->FormValue)) {
			AddMessage($FormError, $this->cus_sup_resolved_on->errorMessage());
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
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// cus_sup_branch_id
		$this->cus_sup_branch_id->setDbValueDef($rsnew, $this->cus_sup_branch_id->CurrentValue, 0, FALSE);

		// cus_sup_emp_id
		$this->cus_sup_emp_id->setDbValueDef($rsnew, $this->cus_sup_emp_id->CurrentValue, 0, FALSE);

		// cus_sup_query
		$this->cus_sup_query->setDbValueDef($rsnew, $this->cus_sup_query->CurrentValue, "", FALSE);

		// cus_sup_screen_shots
		if ($this->cus_sup_screen_shots->Visible && !$this->cus_sup_screen_shots->Upload->KeepFile) {
			$this->cus_sup_screen_shots->Upload->DbValue = ""; // No need to delete old file
			if ($this->cus_sup_screen_shots->Upload->FileName == "") {
				$rsnew['cus_sup_screen_shots'] = NULL;
			} else {
				$rsnew['cus_sup_screen_shots'] = $this->cus_sup_screen_shots->Upload->FileName;
			}
			$this->cus_sup_screen_shots->ImageWidth = 1000; // Resize width
			$this->cus_sup_screen_shots->ImageHeight = 0; // Resize height
		}

		// cus_sup_date
		$this->cus_sup_date->setDbValueDef($rsnew, UnFormatDateTime($this->cus_sup_date->CurrentValue, 1), CurrentDate(), FALSE);

		// cus_sup_status
		$this->cus_sup_status->setDbValueDef($rsnew, $this->cus_sup_status->CurrentValue, "", FALSE);

		// cus_sup_comments
		$this->cus_sup_comments->setDbValueDef($rsnew, $this->cus_sup_comments->CurrentValue, "", FALSE);

		// cus_sup_resolved_on
		$this->cus_sup_resolved_on->setDbValueDef($rsnew, UnFormatDateTime($this->cus_sup_resolved_on->CurrentValue, 1), CurrentDate(), FALSE);
		if ($this->cus_sup_screen_shots->Visible && !$this->cus_sup_screen_shots->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->cus_sup_screen_shots->Upload->DbValue) ? [] : explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $this->cus_sup_screen_shots->htmlDecode(strval($this->cus_sup_screen_shots->Upload->DbValue)));
			if (!EmptyValue($this->cus_sup_screen_shots->Upload->FileName)) {
				$newFiles = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), strval($this->cus_sup_screen_shots->Upload->FileName));
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->cus_sup_screen_shots, $this->cus_sup_screen_shots->Upload->Index);
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
							$file1 = UniqueFilename($this->cus_sup_screen_shots->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->cus_sup_screen_shots->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->cus_sup_screen_shots->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->cus_sup_screen_shots->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->cus_sup_screen_shots->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->cus_sup_screen_shots->setDbValueDef($rsnew, $this->cus_sup_screen_shots->Upload->FileName, "", FALSE);
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
				if ($this->cus_sup_screen_shots->Visible && !$this->cus_sup_screen_shots->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->cus_sup_screen_shots->Upload->DbValue) ? [] : explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $this->cus_sup_screen_shots->htmlDecode(strval($this->cus_sup_screen_shots->Upload->DbValue)));
					if (!EmptyValue($this->cus_sup_screen_shots->Upload->FileName)) {
						$newFiles = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $this->cus_sup_screen_shots->Upload->FileName);
						$newFiles2 = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $this->cus_sup_screen_shots->htmlDecode($rsnew['cus_sup_screen_shots']));
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->cus_sup_screen_shots, $this->cus_sup_screen_shots->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->cus_sup_screen_shots->Upload->ResizeAndSaveToFile($this->cus_sup_screen_shots->ImageWidth, $this->cus_sup_screen_shots->ImageHeight, 100, $newFiles[$i], TRUE, $i)) {
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
								@unlink($this->cus_sup_screen_shots->oldPhysicalUploadPath() . $oldFile);
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

			// cus_sup_screen_shots
			if ($this->cus_sup_screen_shots->Upload->FileToken != "")
				CleanUploadTempPath($this->cus_sup_screen_shots->Upload->FileToken, $this->cus_sup_screen_shots->Upload->Index);
			else
				CleanUploadTempPath($this->cus_sup_screen_shots, $this->cus_sup_screen_shots->Upload->Index);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("cus_supportlist.php"), "", $this->TableVar, TRUE);
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
				case "x_cus_sup_branch_id":
					break;
				case "x_cus_sup_emp_id":
					break;
				case "x_cus_sup_status":
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
						case "x_cus_sup_branch_id":
							break;
						case "x_cus_sup_emp_id":
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