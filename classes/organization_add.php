<?php
namespace PHPMaker2020\crm_live;

/**
 * Page class
 */
class organization_add extends organization
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}";

	// Table name
	public $TableName = 'organization';

	// Page object name
	public $PageObjName = "organization_add";

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

		// Table object (organization)
		if (!isset($GLOBALS["organization"]) || get_class($GLOBALS["organization"]) == PROJECT_NAMESPACE . "organization") {
			$GLOBALS["organization"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["organization"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'organization');

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
		global $organization;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($organization);
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
					if ($pageName == "organizationview.php")
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
			$key .= @$ar['org_id'];
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
			$this->org_id->Visible = FALSE;
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
					$this->terminate(GetUrl("organizationlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->org_id->Visible = FALSE;
		$this->org_city_id->setVisibility();
		$this->org_name->setVisibility();
		$this->org_head_office->setVisibility();
		$this->org_owner->setVisibility();
		$this->org_contact_no->setVisibility();
		$this->org_logo->setVisibility();
		$this->org_bank_acc->setVisibility();
		$this->org_ntn->setVisibility();
		$this->org_email->setVisibility();
		$this->org_website->setVisibility();
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
		$this->setupLookupOptions($this->org_city_id);

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
			if (Get("org_id") !== NULL) {
				$this->org_id->setQueryStringValue(Get("org_id"));
				$this->setKey("org_id", $this->org_id->CurrentValue); // Set up key
			} else {
				$this->setKey("org_id", ""); // Clear key
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
					$this->terminate("organizationlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "organizationlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "organizationview.php")
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
		$this->org_logo->Upload->Index = $CurrentForm->Index;
		$this->org_logo->Upload->uploadFile();
		$this->org_logo->CurrentValue = $this->org_logo->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->org_id->CurrentValue = NULL;
		$this->org_id->OldValue = $this->org_id->CurrentValue;
		$this->org_city_id->CurrentValue = NULL;
		$this->org_city_id->OldValue = $this->org_city_id->CurrentValue;
		$this->org_name->CurrentValue = NULL;
		$this->org_name->OldValue = $this->org_name->CurrentValue;
		$this->org_head_office->CurrentValue = NULL;
		$this->org_head_office->OldValue = $this->org_head_office->CurrentValue;
		$this->org_owner->CurrentValue = NULL;
		$this->org_owner->OldValue = $this->org_owner->CurrentValue;
		$this->org_contact_no->CurrentValue = NULL;
		$this->org_contact_no->OldValue = $this->org_contact_no->CurrentValue;
		$this->org_logo->Upload->DbValue = NULL;
		$this->org_logo->OldValue = $this->org_logo->Upload->DbValue;
		$this->org_logo->CurrentValue = NULL; // Clear file related field
		$this->org_bank_acc->CurrentValue = NULL;
		$this->org_bank_acc->OldValue = $this->org_bank_acc->CurrentValue;
		$this->org_ntn->CurrentValue = NULL;
		$this->org_ntn->OldValue = $this->org_ntn->CurrentValue;
		$this->org_email->CurrentValue = NULL;
		$this->org_email->OldValue = $this->org_email->CurrentValue;
		$this->org_website->CurrentValue = NULL;
		$this->org_website->OldValue = $this->org_website->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'org_city_id' first before field var 'x_org_city_id'
		$val = $CurrentForm->hasValue("org_city_id") ? $CurrentForm->getValue("org_city_id") : $CurrentForm->getValue("x_org_city_id");
		if (!$this->org_city_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->org_city_id->Visible = FALSE; // Disable update for API request
			else
				$this->org_city_id->setFormValue($val);
		}

		// Check field name 'org_name' first before field var 'x_org_name'
		$val = $CurrentForm->hasValue("org_name") ? $CurrentForm->getValue("org_name") : $CurrentForm->getValue("x_org_name");
		if (!$this->org_name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->org_name->Visible = FALSE; // Disable update for API request
			else
				$this->org_name->setFormValue($val);
		}

		// Check field name 'org_head_office' first before field var 'x_org_head_office'
		$val = $CurrentForm->hasValue("org_head_office") ? $CurrentForm->getValue("org_head_office") : $CurrentForm->getValue("x_org_head_office");
		if (!$this->org_head_office->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->org_head_office->Visible = FALSE; // Disable update for API request
			else
				$this->org_head_office->setFormValue($val);
		}

		// Check field name 'org_owner' first before field var 'x_org_owner'
		$val = $CurrentForm->hasValue("org_owner") ? $CurrentForm->getValue("org_owner") : $CurrentForm->getValue("x_org_owner");
		if (!$this->org_owner->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->org_owner->Visible = FALSE; // Disable update for API request
			else
				$this->org_owner->setFormValue($val);
		}

		// Check field name 'org_contact_no' first before field var 'x_org_contact_no'
		$val = $CurrentForm->hasValue("org_contact_no") ? $CurrentForm->getValue("org_contact_no") : $CurrentForm->getValue("x_org_contact_no");
		if (!$this->org_contact_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->org_contact_no->Visible = FALSE; // Disable update for API request
			else
				$this->org_contact_no->setFormValue($val);
		}

		// Check field name 'org_bank_acc' first before field var 'x_org_bank_acc'
		$val = $CurrentForm->hasValue("org_bank_acc") ? $CurrentForm->getValue("org_bank_acc") : $CurrentForm->getValue("x_org_bank_acc");
		if (!$this->org_bank_acc->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->org_bank_acc->Visible = FALSE; // Disable update for API request
			else
				$this->org_bank_acc->setFormValue($val);
		}

		// Check field name 'org_ntn' first before field var 'x_org_ntn'
		$val = $CurrentForm->hasValue("org_ntn") ? $CurrentForm->getValue("org_ntn") : $CurrentForm->getValue("x_org_ntn");
		if (!$this->org_ntn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->org_ntn->Visible = FALSE; // Disable update for API request
			else
				$this->org_ntn->setFormValue($val);
		}

		// Check field name 'org_email' first before field var 'x_org_email'
		$val = $CurrentForm->hasValue("org_email") ? $CurrentForm->getValue("org_email") : $CurrentForm->getValue("x_org_email");
		if (!$this->org_email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->org_email->Visible = FALSE; // Disable update for API request
			else
				$this->org_email->setFormValue($val);
		}

		// Check field name 'org_website' first before field var 'x_org_website'
		$val = $CurrentForm->hasValue("org_website") ? $CurrentForm->getValue("org_website") : $CurrentForm->getValue("x_org_website");
		if (!$this->org_website->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->org_website->Visible = FALSE; // Disable update for API request
			else
				$this->org_website->setFormValue($val);
		}

		// Check field name 'org_id' first before field var 'x_org_id'
		$val = $CurrentForm->hasValue("org_id") ? $CurrentForm->getValue("org_id") : $CurrentForm->getValue("x_org_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->org_city_id->CurrentValue = $this->org_city_id->FormValue;
		$this->org_name->CurrentValue = $this->org_name->FormValue;
		$this->org_head_office->CurrentValue = $this->org_head_office->FormValue;
		$this->org_owner->CurrentValue = $this->org_owner->FormValue;
		$this->org_contact_no->CurrentValue = $this->org_contact_no->FormValue;
		$this->org_bank_acc->CurrentValue = $this->org_bank_acc->FormValue;
		$this->org_ntn->CurrentValue = $this->org_ntn->FormValue;
		$this->org_email->CurrentValue = $this->org_email->FormValue;
		$this->org_website->CurrentValue = $this->org_website->FormValue;
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
		$this->org_id->setDbValue($row['org_id']);
		$this->org_city_id->setDbValue($row['org_city_id']);
		if (array_key_exists('EV__org_city_id', $rs->fields)) {
			$this->org_city_id->VirtualValue = $rs->fields('EV__org_city_id'); // Set up virtual field value
		} else {
			$this->org_city_id->VirtualValue = ""; // Clear value
		}
		$this->org_name->setDbValue($row['org_name']);
		$this->org_head_office->setDbValue($row['org_head_office']);
		$this->org_owner->setDbValue($row['org_owner']);
		$this->org_contact_no->setDbValue($row['org_contact_no']);
		$this->org_logo->Upload->DbValue = $row['org_logo'];
		$this->org_logo->setDbValue($this->org_logo->Upload->DbValue);
		$this->org_bank_acc->setDbValue($row['org_bank_acc']);
		$this->org_ntn->setDbValue($row['org_ntn']);
		$this->org_email->setDbValue($row['org_email']);
		$this->org_website->setDbValue($row['org_website']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['org_id'] = $this->org_id->CurrentValue;
		$row['org_city_id'] = $this->org_city_id->CurrentValue;
		$row['org_name'] = $this->org_name->CurrentValue;
		$row['org_head_office'] = $this->org_head_office->CurrentValue;
		$row['org_owner'] = $this->org_owner->CurrentValue;
		$row['org_contact_no'] = $this->org_contact_no->CurrentValue;
		$row['org_logo'] = $this->org_logo->Upload->DbValue;
		$row['org_bank_acc'] = $this->org_bank_acc->CurrentValue;
		$row['org_ntn'] = $this->org_ntn->CurrentValue;
		$row['org_email'] = $this->org_email->CurrentValue;
		$row['org_website'] = $this->org_website->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("org_id")) != "")
			$this->org_id->OldValue = $this->getKey("org_id"); // org_id
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
		// org_id
		// org_city_id
		// org_name
		// org_head_office
		// org_owner
		// org_contact_no
		// org_logo
		// org_bank_acc
		// org_ntn
		// org_email
		// org_website

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// org_id
			$this->org_id->ViewValue = $this->org_id->CurrentValue;
			$this->org_id->CssClass = "font-weight-bold";
			$this->org_id->ViewCustomAttributes = "";

			// org_city_id
			if ($this->org_city_id->VirtualValue != "") {
				$this->org_city_id->ViewValue = $this->org_city_id->VirtualValue;
			} else {
				$curVal = strval($this->org_city_id->CurrentValue);
				if ($curVal != "") {
					$this->org_city_id->ViewValue = $this->org_city_id->lookupCacheOption($curVal);
					if ($this->org_city_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`city_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->org_city_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->org_city_id->ViewValue = $this->org_city_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->org_city_id->ViewValue = $this->org_city_id->CurrentValue;
						}
					}
				} else {
					$this->org_city_id->ViewValue = NULL;
				}
			}
			$this->org_city_id->ViewCustomAttributes = "";

			// org_name
			$this->org_name->ViewValue = $this->org_name->CurrentValue;
			$this->org_name->ViewCustomAttributes = "";

			// org_head_office
			$this->org_head_office->ViewValue = $this->org_head_office->CurrentValue;
			$this->org_head_office->ViewCustomAttributes = "";

			// org_owner
			$this->org_owner->ViewValue = $this->org_owner->CurrentValue;
			$this->org_owner->ViewCustomAttributes = "";

			// org_contact_no
			$this->org_contact_no->ViewValue = $this->org_contact_no->CurrentValue;
			$this->org_contact_no->ViewCustomAttributes = "";

			// org_logo
			if (!EmptyValue($this->org_logo->Upload->DbValue)) {
				$this->org_logo->ImageWidth = 200;
				$this->org_logo->ImageHeight = 0;
				$this->org_logo->ImageAlt = $this->org_logo->alt();
				$this->org_logo->ViewValue = $this->org_logo->Upload->DbValue;
			} else {
				$this->org_logo->ViewValue = "";
			}
			$this->org_logo->ViewCustomAttributes = "";

			// org_bank_acc
			$this->org_bank_acc->ViewValue = $this->org_bank_acc->CurrentValue;
			$this->org_bank_acc->ViewCustomAttributes = "";

			// org_ntn
			$this->org_ntn->ViewValue = $this->org_ntn->CurrentValue;
			$this->org_ntn->ViewCustomAttributes = "";

			// org_email
			$this->org_email->ViewValue = $this->org_email->CurrentValue;
			$this->org_email->ViewCustomAttributes = "";

			// org_website
			$this->org_website->ViewValue = $this->org_website->CurrentValue;
			$this->org_website->ViewCustomAttributes = "";

			// org_city_id
			$this->org_city_id->LinkCustomAttributes = "";
			$this->org_city_id->HrefValue = "";
			$this->org_city_id->TooltipValue = "";

			// org_name
			$this->org_name->LinkCustomAttributes = "";
			$this->org_name->HrefValue = "";
			$this->org_name->TooltipValue = "";

			// org_head_office
			$this->org_head_office->LinkCustomAttributes = "";
			$this->org_head_office->HrefValue = "";
			$this->org_head_office->TooltipValue = "";

			// org_owner
			$this->org_owner->LinkCustomAttributes = "";
			$this->org_owner->HrefValue = "";
			$this->org_owner->TooltipValue = "";

			// org_contact_no
			$this->org_contact_no->LinkCustomAttributes = "";
			$this->org_contact_no->HrefValue = "";
			$this->org_contact_no->TooltipValue = "";

			// org_logo
			$this->org_logo->LinkCustomAttributes = "";
			if (!EmptyValue($this->org_logo->Upload->DbValue)) {
				$this->org_logo->HrefValue = GetFileUploadUrl($this->org_logo, $this->org_logo->htmlDecode($this->org_logo->Upload->DbValue)); // Add prefix/suffix
				$this->org_logo->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->org_logo->HrefValue = FullUrl($this->org_logo->HrefValue, "href");
			} else {
				$this->org_logo->HrefValue = "";
			}
			$this->org_logo->ExportHrefValue = $this->org_logo->UploadPath . $this->org_logo->Upload->DbValue;
			$this->org_logo->TooltipValue = "";
			if ($this->org_logo->UseColorbox) {
				if (EmptyValue($this->org_logo->TooltipValue))
					$this->org_logo->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->org_logo->LinkAttrs["data-rel"] = "organization_x_org_logo";
				$this->org_logo->LinkAttrs->appendClass("ew-lightbox");
			}

			// org_bank_acc
			$this->org_bank_acc->LinkCustomAttributes = "";
			$this->org_bank_acc->HrefValue = "";
			$this->org_bank_acc->TooltipValue = "";

			// org_ntn
			$this->org_ntn->LinkCustomAttributes = "";
			$this->org_ntn->HrefValue = "";
			$this->org_ntn->TooltipValue = "";

			// org_email
			$this->org_email->LinkCustomAttributes = "";
			$this->org_email->HrefValue = "";
			$this->org_email->TooltipValue = "";

			// org_website
			$this->org_website->LinkCustomAttributes = "";
			$this->org_website->HrefValue = "";
			$this->org_website->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// org_city_id
			$this->org_city_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->org_city_id->CurrentValue));
			if ($curVal != "")
				$this->org_city_id->ViewValue = $this->org_city_id->lookupCacheOption($curVal);
			else
				$this->org_city_id->ViewValue = $this->org_city_id->Lookup !== NULL && is_array($this->org_city_id->Lookup->Options) ? $curVal : NULL;
			if ($this->org_city_id->ViewValue !== NULL) { // Load from cache
				$this->org_city_id->EditValue = array_values($this->org_city_id->Lookup->Options);
				if ($this->org_city_id->ViewValue == "")
					$this->org_city_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`city_id`" . SearchString("=", $this->org_city_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->org_city_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->org_city_id->ViewValue = $this->org_city_id->displayValue($arwrk);
				} else {
					$this->org_city_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->org_city_id->EditValue = $arwrk;
			}

			// org_name
			$this->org_name->EditAttrs["class"] = "form-control";
			$this->org_name->EditCustomAttributes = "";
			if (!$this->org_name->Raw)
				$this->org_name->CurrentValue = HtmlDecode($this->org_name->CurrentValue);
			$this->org_name->EditValue = HtmlEncode($this->org_name->CurrentValue);
			$this->org_name->PlaceHolder = RemoveHtml($this->org_name->caption());

			// org_head_office
			$this->org_head_office->EditAttrs["class"] = "form-control";
			$this->org_head_office->EditCustomAttributes = "";
			if (!$this->org_head_office->Raw)
				$this->org_head_office->CurrentValue = HtmlDecode($this->org_head_office->CurrentValue);
			$this->org_head_office->EditValue = HtmlEncode($this->org_head_office->CurrentValue);
			$this->org_head_office->PlaceHolder = RemoveHtml($this->org_head_office->caption());

			// org_owner
			$this->org_owner->EditAttrs["class"] = "form-control";
			$this->org_owner->EditCustomAttributes = "";
			if (!$this->org_owner->Raw)
				$this->org_owner->CurrentValue = HtmlDecode($this->org_owner->CurrentValue);
			$this->org_owner->EditValue = HtmlEncode($this->org_owner->CurrentValue);
			$this->org_owner->PlaceHolder = RemoveHtml($this->org_owner->caption());

			// org_contact_no
			$this->org_contact_no->EditAttrs["class"] = "form-control";
			$this->org_contact_no->EditCustomAttributes = "";
			if (!$this->org_contact_no->Raw)
				$this->org_contact_no->CurrentValue = HtmlDecode($this->org_contact_no->CurrentValue);
			$this->org_contact_no->EditValue = HtmlEncode($this->org_contact_no->CurrentValue);
			$this->org_contact_no->PlaceHolder = RemoveHtml($this->org_contact_no->caption());

			// org_logo
			$this->org_logo->EditAttrs["class"] = "form-control";
			$this->org_logo->EditCustomAttributes = "";
			if (!EmptyValue($this->org_logo->Upload->DbValue)) {
				$this->org_logo->ImageWidth = 200;
				$this->org_logo->ImageHeight = 0;
				$this->org_logo->ImageAlt = $this->org_logo->alt();
				$this->org_logo->EditValue = $this->org_logo->Upload->DbValue;
			} else {
				$this->org_logo->EditValue = "";
			}
			if (!EmptyValue($this->org_logo->CurrentValue))
					$this->org_logo->Upload->FileName = $this->org_logo->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->org_logo);

			// org_bank_acc
			$this->org_bank_acc->EditAttrs["class"] = "form-control";
			$this->org_bank_acc->EditCustomAttributes = "";
			if (!$this->org_bank_acc->Raw)
				$this->org_bank_acc->CurrentValue = HtmlDecode($this->org_bank_acc->CurrentValue);
			$this->org_bank_acc->EditValue = HtmlEncode($this->org_bank_acc->CurrentValue);
			$this->org_bank_acc->PlaceHolder = RemoveHtml($this->org_bank_acc->caption());

			// org_ntn
			$this->org_ntn->EditAttrs["class"] = "form-control";
			$this->org_ntn->EditCustomAttributes = "";
			if (!$this->org_ntn->Raw)
				$this->org_ntn->CurrentValue = HtmlDecode($this->org_ntn->CurrentValue);
			$this->org_ntn->EditValue = HtmlEncode($this->org_ntn->CurrentValue);
			$this->org_ntn->PlaceHolder = RemoveHtml($this->org_ntn->caption());

			// org_email
			$this->org_email->EditAttrs["class"] = "form-control";
			$this->org_email->EditCustomAttributes = "";
			if (!$this->org_email->Raw)
				$this->org_email->CurrentValue = HtmlDecode($this->org_email->CurrentValue);
			$this->org_email->EditValue = HtmlEncode($this->org_email->CurrentValue);
			$this->org_email->PlaceHolder = RemoveHtml($this->org_email->caption());

			// org_website
			$this->org_website->EditAttrs["class"] = "form-control";
			$this->org_website->EditCustomAttributes = "";
			if (!$this->org_website->Raw)
				$this->org_website->CurrentValue = HtmlDecode($this->org_website->CurrentValue);
			$this->org_website->EditValue = HtmlEncode($this->org_website->CurrentValue);
			$this->org_website->PlaceHolder = RemoveHtml($this->org_website->caption());

			// Add refer script
			// org_city_id

			$this->org_city_id->LinkCustomAttributes = "";
			$this->org_city_id->HrefValue = "";

			// org_name
			$this->org_name->LinkCustomAttributes = "";
			$this->org_name->HrefValue = "";

			// org_head_office
			$this->org_head_office->LinkCustomAttributes = "";
			$this->org_head_office->HrefValue = "";

			// org_owner
			$this->org_owner->LinkCustomAttributes = "";
			$this->org_owner->HrefValue = "";

			// org_contact_no
			$this->org_contact_no->LinkCustomAttributes = "";
			$this->org_contact_no->HrefValue = "";

			// org_logo
			$this->org_logo->LinkCustomAttributes = "";
			if (!EmptyValue($this->org_logo->Upload->DbValue)) {
				$this->org_logo->HrefValue = GetFileUploadUrl($this->org_logo, $this->org_logo->htmlDecode($this->org_logo->Upload->DbValue)); // Add prefix/suffix
				$this->org_logo->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->org_logo->HrefValue = FullUrl($this->org_logo->HrefValue, "href");
			} else {
				$this->org_logo->HrefValue = "";
			}
			$this->org_logo->ExportHrefValue = $this->org_logo->UploadPath . $this->org_logo->Upload->DbValue;

			// org_bank_acc
			$this->org_bank_acc->LinkCustomAttributes = "";
			$this->org_bank_acc->HrefValue = "";

			// org_ntn
			$this->org_ntn->LinkCustomAttributes = "";
			$this->org_ntn->HrefValue = "";

			// org_email
			$this->org_email->LinkCustomAttributes = "";
			$this->org_email->HrefValue = "";

			// org_website
			$this->org_website->LinkCustomAttributes = "";
			$this->org_website->HrefValue = "";
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
		if ($this->org_city_id->Required) {
			if (!$this->org_city_id->IsDetailKey && $this->org_city_id->FormValue != NULL && $this->org_city_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->org_city_id->caption(), $this->org_city_id->RequiredErrorMessage));
			}
		}
		if ($this->org_name->Required) {
			if (!$this->org_name->IsDetailKey && $this->org_name->FormValue != NULL && $this->org_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->org_name->caption(), $this->org_name->RequiredErrorMessage));
			}
		}
		if ($this->org_head_office->Required) {
			if (!$this->org_head_office->IsDetailKey && $this->org_head_office->FormValue != NULL && $this->org_head_office->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->org_head_office->caption(), $this->org_head_office->RequiredErrorMessage));
			}
		}
		if ($this->org_owner->Required) {
			if (!$this->org_owner->IsDetailKey && $this->org_owner->FormValue != NULL && $this->org_owner->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->org_owner->caption(), $this->org_owner->RequiredErrorMessage));
			}
		}
		if ($this->org_contact_no->Required) {
			if (!$this->org_contact_no->IsDetailKey && $this->org_contact_no->FormValue != NULL && $this->org_contact_no->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->org_contact_no->caption(), $this->org_contact_no->RequiredErrorMessage));
			}
		}
		if ($this->org_logo->Required) {
			if ($this->org_logo->Upload->FileName == "" && !$this->org_logo->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->org_logo->caption(), $this->org_logo->RequiredErrorMessage));
			}
		}
		if ($this->org_bank_acc->Required) {
			if (!$this->org_bank_acc->IsDetailKey && $this->org_bank_acc->FormValue != NULL && $this->org_bank_acc->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->org_bank_acc->caption(), $this->org_bank_acc->RequiredErrorMessage));
			}
		}
		if ($this->org_ntn->Required) {
			if (!$this->org_ntn->IsDetailKey && $this->org_ntn->FormValue != NULL && $this->org_ntn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->org_ntn->caption(), $this->org_ntn->RequiredErrorMessage));
			}
		}
		if ($this->org_email->Required) {
			if (!$this->org_email->IsDetailKey && $this->org_email->FormValue != NULL && $this->org_email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->org_email->caption(), $this->org_email->RequiredErrorMessage));
			}
		}
		if ($this->org_website->Required) {
			if (!$this->org_website->IsDetailKey && $this->org_website->FormValue != NULL && $this->org_website->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->org_website->caption(), $this->org_website->RequiredErrorMessage));
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
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// org_city_id
		$this->org_city_id->setDbValueDef($rsnew, $this->org_city_id->CurrentValue, 0, FALSE);

		// org_name
		$this->org_name->setDbValueDef($rsnew, $this->org_name->CurrentValue, "", FALSE);

		// org_head_office
		$this->org_head_office->setDbValueDef($rsnew, $this->org_head_office->CurrentValue, "", FALSE);

		// org_owner
		$this->org_owner->setDbValueDef($rsnew, $this->org_owner->CurrentValue, "", FALSE);

		// org_contact_no
		$this->org_contact_no->setDbValueDef($rsnew, $this->org_contact_no->CurrentValue, "", FALSE);

		// org_logo
		if ($this->org_logo->Visible && !$this->org_logo->Upload->KeepFile) {
			$this->org_logo->Upload->DbValue = ""; // No need to delete old file
			if ($this->org_logo->Upload->FileName == "") {
				$rsnew['org_logo'] = NULL;
			} else {
				$rsnew['org_logo'] = $this->org_logo->Upload->FileName;
			}
			$this->org_logo->ImageWidth = 1000; // Resize width
			$this->org_logo->ImageHeight = 0; // Resize height
		}

		// org_bank_acc
		$this->org_bank_acc->setDbValueDef($rsnew, $this->org_bank_acc->CurrentValue, "", FALSE);

		// org_ntn
		$this->org_ntn->setDbValueDef($rsnew, $this->org_ntn->CurrentValue, "", FALSE);

		// org_email
		$this->org_email->setDbValueDef($rsnew, $this->org_email->CurrentValue, "", FALSE);

		// org_website
		$this->org_website->setDbValueDef($rsnew, $this->org_website->CurrentValue, "", FALSE);
		if ($this->org_logo->Visible && !$this->org_logo->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->org_logo->Upload->DbValue) ? [] : [$this->org_logo->htmlDecode($this->org_logo->Upload->DbValue)];
			if (!EmptyValue($this->org_logo->Upload->FileName)) {
				$newFiles = [$this->org_logo->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->org_logo, $this->org_logo->Upload->Index);
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
							$file1 = UniqueFilename($this->org_logo->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->org_logo->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->org_logo->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->org_logo->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->org_logo->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->org_logo->setDbValueDef($rsnew, $this->org_logo->Upload->FileName, "", FALSE);
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
				if ($this->org_logo->Visible && !$this->org_logo->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->org_logo->Upload->DbValue) ? [] : [$this->org_logo->htmlDecode($this->org_logo->Upload->DbValue)];
					if (!EmptyValue($this->org_logo->Upload->FileName)) {
						$newFiles = [$this->org_logo->Upload->FileName];
						$newFiles2 = [$this->org_logo->htmlDecode($rsnew['org_logo'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->org_logo, $this->org_logo->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->org_logo->Upload->ResizeAndSaveToFile($this->org_logo->ImageWidth, $this->org_logo->ImageHeight, 100, $newFiles[$i], TRUE, $i)) {
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
								@unlink($this->org_logo->oldPhysicalUploadPath() . $oldFile);
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

			// org_logo
			if ($this->org_logo->Upload->FileToken != "")
				CleanUploadTempPath($this->org_logo->Upload->FileToken, $this->org_logo->Upload->Index);
			else
				CleanUploadTempPath($this->org_logo, $this->org_logo->Upload->Index);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("organizationlist.php"), "", $this->TableVar, TRUE);
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
				case "x_org_city_id":
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
						case "x_org_city_id":
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