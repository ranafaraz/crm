<?php
namespace PHPMaker2020\crm_live;

/**
 * Page class
 */
class branch_add extends branch
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}";

	// Table name
	public $TableName = 'branch';

	// Page object name
	public $PageObjName = "branch_add";

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

		// Table object (branch)
		if (!isset($GLOBALS["branch"]) || get_class($GLOBALS["branch"]) == PROJECT_NAMESPACE . "branch") {
			$GLOBALS["branch"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["branch"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'branch');

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
		global $branch;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($branch);
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
					if ($pageName == "branchview.php")
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
			$key .= @$ar['branch_id'];
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
			$this->branch_id->Visible = FALSE;
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
					$this->terminate(GetUrl("branchlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->branch_id->Visible = FALSE;
		$this->branch_org_id->setVisibility();
		$this->branch_name->setVisibility();
		$this->branch_manager->setVisibility();
		$this->branch_contact->setVisibility();
		$this->branch_address->setVisibility();
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
		$this->setupLookupOptions($this->branch_org_id);

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
			if (Get("branch_id") !== NULL) {
				$this->branch_id->setQueryStringValue(Get("branch_id"));
				$this->setKey("branch_id", $this->branch_id->CurrentValue); // Set up key
			} else {
				$this->setKey("branch_id", ""); // Clear key
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
					$this->terminate("branchlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "branchlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "branchview.php")
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
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->branch_id->CurrentValue = NULL;
		$this->branch_id->OldValue = $this->branch_id->CurrentValue;
		$this->branch_org_id->CurrentValue = NULL;
		$this->branch_org_id->OldValue = $this->branch_org_id->CurrentValue;
		$this->branch_name->CurrentValue = NULL;
		$this->branch_name->OldValue = $this->branch_name->CurrentValue;
		$this->branch_manager->CurrentValue = NULL;
		$this->branch_manager->OldValue = $this->branch_manager->CurrentValue;
		$this->branch_contact->CurrentValue = NULL;
		$this->branch_contact->OldValue = $this->branch_contact->CurrentValue;
		$this->branch_address->CurrentValue = NULL;
		$this->branch_address->OldValue = $this->branch_address->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'branch_org_id' first before field var 'x_branch_org_id'
		$val = $CurrentForm->hasValue("branch_org_id") ? $CurrentForm->getValue("branch_org_id") : $CurrentForm->getValue("x_branch_org_id");
		if (!$this->branch_org_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->branch_org_id->Visible = FALSE; // Disable update for API request
			else
				$this->branch_org_id->setFormValue($val);
		}

		// Check field name 'branch_name' first before field var 'x_branch_name'
		$val = $CurrentForm->hasValue("branch_name") ? $CurrentForm->getValue("branch_name") : $CurrentForm->getValue("x_branch_name");
		if (!$this->branch_name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->branch_name->Visible = FALSE; // Disable update for API request
			else
				$this->branch_name->setFormValue($val);
		}

		// Check field name 'branch_manager' first before field var 'x_branch_manager'
		$val = $CurrentForm->hasValue("branch_manager") ? $CurrentForm->getValue("branch_manager") : $CurrentForm->getValue("x_branch_manager");
		if (!$this->branch_manager->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->branch_manager->Visible = FALSE; // Disable update for API request
			else
				$this->branch_manager->setFormValue($val);
		}

		// Check field name 'branch_contact' first before field var 'x_branch_contact'
		$val = $CurrentForm->hasValue("branch_contact") ? $CurrentForm->getValue("branch_contact") : $CurrentForm->getValue("x_branch_contact");
		if (!$this->branch_contact->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->branch_contact->Visible = FALSE; // Disable update for API request
			else
				$this->branch_contact->setFormValue($val);
		}

		// Check field name 'branch_address' first before field var 'x_branch_address'
		$val = $CurrentForm->hasValue("branch_address") ? $CurrentForm->getValue("branch_address") : $CurrentForm->getValue("x_branch_address");
		if (!$this->branch_address->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->branch_address->Visible = FALSE; // Disable update for API request
			else
				$this->branch_address->setFormValue($val);
		}

		// Check field name 'branch_id' first before field var 'x_branch_id'
		$val = $CurrentForm->hasValue("branch_id") ? $CurrentForm->getValue("branch_id") : $CurrentForm->getValue("x_branch_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->branch_org_id->CurrentValue = $this->branch_org_id->FormValue;
		$this->branch_name->CurrentValue = $this->branch_name->FormValue;
		$this->branch_manager->CurrentValue = $this->branch_manager->FormValue;
		$this->branch_contact->CurrentValue = $this->branch_contact->FormValue;
		$this->branch_address->CurrentValue = $this->branch_address->FormValue;
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
		$this->branch_id->setDbValue($row['branch_id']);
		$this->branch_org_id->setDbValue($row['branch_org_id']);
		if (array_key_exists('EV__branch_org_id', $rs->fields)) {
			$this->branch_org_id->VirtualValue = $rs->fields('EV__branch_org_id'); // Set up virtual field value
		} else {
			$this->branch_org_id->VirtualValue = ""; // Clear value
		}
		$this->branch_name->setDbValue($row['branch_name']);
		$this->branch_manager->setDbValue($row['branch_manager']);
		$this->branch_contact->setDbValue($row['branch_contact']);
		$this->branch_address->setDbValue($row['branch_address']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['branch_id'] = $this->branch_id->CurrentValue;
		$row['branch_org_id'] = $this->branch_org_id->CurrentValue;
		$row['branch_name'] = $this->branch_name->CurrentValue;
		$row['branch_manager'] = $this->branch_manager->CurrentValue;
		$row['branch_contact'] = $this->branch_contact->CurrentValue;
		$row['branch_address'] = $this->branch_address->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("branch_id")) != "")
			$this->branch_id->OldValue = $this->getKey("branch_id"); // branch_id
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
		// branch_id
		// branch_org_id
		// branch_name
		// branch_manager
		// branch_contact
		// branch_address

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// branch_id
			$this->branch_id->ViewValue = $this->branch_id->CurrentValue;
			$this->branch_id->CssClass = "font-weight-bold";
			$this->branch_id->ViewCustomAttributes = "";

			// branch_org_id
			if ($this->branch_org_id->VirtualValue != "") {
				$this->branch_org_id->ViewValue = $this->branch_org_id->VirtualValue;
			} else {
				$curVal = strval($this->branch_org_id->CurrentValue);
				if ($curVal != "") {
					$this->branch_org_id->ViewValue = $this->branch_org_id->lookupCacheOption($curVal);
					if ($this->branch_org_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`org_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->branch_org_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->branch_org_id->ViewValue = $this->branch_org_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->branch_org_id->ViewValue = $this->branch_org_id->CurrentValue;
						}
					}
				} else {
					$this->branch_org_id->ViewValue = NULL;
				}
			}
			$this->branch_org_id->ViewCustomAttributes = "";

			// branch_name
			$this->branch_name->ViewValue = $this->branch_name->CurrentValue;
			$this->branch_name->ViewCustomAttributes = "";

			// branch_manager
			$this->branch_manager->ViewValue = $this->branch_manager->CurrentValue;
			$this->branch_manager->ViewCustomAttributes = "";

			// branch_contact
			$this->branch_contact->ViewValue = $this->branch_contact->CurrentValue;
			$this->branch_contact->ViewCustomAttributes = "";

			// branch_address
			$this->branch_address->ViewValue = $this->branch_address->CurrentValue;
			$this->branch_address->ViewCustomAttributes = "";

			// branch_org_id
			$this->branch_org_id->LinkCustomAttributes = "";
			$this->branch_org_id->HrefValue = "";
			$this->branch_org_id->TooltipValue = "";

			// branch_name
			$this->branch_name->LinkCustomAttributes = "";
			$this->branch_name->HrefValue = "";
			$this->branch_name->TooltipValue = "";

			// branch_manager
			$this->branch_manager->LinkCustomAttributes = "";
			$this->branch_manager->HrefValue = "";
			$this->branch_manager->TooltipValue = "";

			// branch_contact
			$this->branch_contact->LinkCustomAttributes = "";
			$this->branch_contact->HrefValue = "";
			$this->branch_contact->TooltipValue = "";

			// branch_address
			$this->branch_address->LinkCustomAttributes = "";
			$this->branch_address->HrefValue = "";
			$this->branch_address->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// branch_org_id
			$this->branch_org_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->branch_org_id->CurrentValue));
			if ($curVal != "")
				$this->branch_org_id->ViewValue = $this->branch_org_id->lookupCacheOption($curVal);
			else
				$this->branch_org_id->ViewValue = $this->branch_org_id->Lookup !== NULL && is_array($this->branch_org_id->Lookup->Options) ? $curVal : NULL;
			if ($this->branch_org_id->ViewValue !== NULL) { // Load from cache
				$this->branch_org_id->EditValue = array_values($this->branch_org_id->Lookup->Options);
				if ($this->branch_org_id->ViewValue == "")
					$this->branch_org_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`org_id`" . SearchString("=", $this->branch_org_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->branch_org_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->branch_org_id->ViewValue = $this->branch_org_id->displayValue($arwrk);
				} else {
					$this->branch_org_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->branch_org_id->EditValue = $arwrk;
			}

			// branch_name
			$this->branch_name->EditAttrs["class"] = "form-control";
			$this->branch_name->EditCustomAttributes = "";
			if (!$this->branch_name->Raw)
				$this->branch_name->CurrentValue = HtmlDecode($this->branch_name->CurrentValue);
			$this->branch_name->EditValue = HtmlEncode($this->branch_name->CurrentValue);
			$this->branch_name->PlaceHolder = RemoveHtml($this->branch_name->caption());

			// branch_manager
			$this->branch_manager->EditAttrs["class"] = "form-control";
			$this->branch_manager->EditCustomAttributes = "";
			if (!$this->branch_manager->Raw)
				$this->branch_manager->CurrentValue = HtmlDecode($this->branch_manager->CurrentValue);
			$this->branch_manager->EditValue = HtmlEncode($this->branch_manager->CurrentValue);
			$this->branch_manager->PlaceHolder = RemoveHtml($this->branch_manager->caption());

			// branch_contact
			$this->branch_contact->EditAttrs["class"] = "form-control";
			$this->branch_contact->EditCustomAttributes = "";
			if (!$this->branch_contact->Raw)
				$this->branch_contact->CurrentValue = HtmlDecode($this->branch_contact->CurrentValue);
			$this->branch_contact->EditValue = HtmlEncode($this->branch_contact->CurrentValue);
			$this->branch_contact->PlaceHolder = RemoveHtml($this->branch_contact->caption());

			// branch_address
			$this->branch_address->EditAttrs["class"] = "form-control";
			$this->branch_address->EditCustomAttributes = "";
			$this->branch_address->EditValue = HtmlEncode($this->branch_address->CurrentValue);
			$this->branch_address->PlaceHolder = RemoveHtml($this->branch_address->caption());

			// Add refer script
			// branch_org_id

			$this->branch_org_id->LinkCustomAttributes = "";
			$this->branch_org_id->HrefValue = "";

			// branch_name
			$this->branch_name->LinkCustomAttributes = "";
			$this->branch_name->HrefValue = "";

			// branch_manager
			$this->branch_manager->LinkCustomAttributes = "";
			$this->branch_manager->HrefValue = "";

			// branch_contact
			$this->branch_contact->LinkCustomAttributes = "";
			$this->branch_contact->HrefValue = "";

			// branch_address
			$this->branch_address->LinkCustomAttributes = "";
			$this->branch_address->HrefValue = "";
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
		if ($this->branch_org_id->Required) {
			if (!$this->branch_org_id->IsDetailKey && $this->branch_org_id->FormValue != NULL && $this->branch_org_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->branch_org_id->caption(), $this->branch_org_id->RequiredErrorMessage));
			}
		}
		if ($this->branch_name->Required) {
			if (!$this->branch_name->IsDetailKey && $this->branch_name->FormValue != NULL && $this->branch_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->branch_name->caption(), $this->branch_name->RequiredErrorMessage));
			}
		}
		if ($this->branch_manager->Required) {
			if (!$this->branch_manager->IsDetailKey && $this->branch_manager->FormValue != NULL && $this->branch_manager->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->branch_manager->caption(), $this->branch_manager->RequiredErrorMessage));
			}
		}
		if ($this->branch_contact->Required) {
			if (!$this->branch_contact->IsDetailKey && $this->branch_contact->FormValue != NULL && $this->branch_contact->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->branch_contact->caption(), $this->branch_contact->RequiredErrorMessage));
			}
		}
		if ($this->branch_address->Required) {
			if (!$this->branch_address->IsDetailKey && $this->branch_address->FormValue != NULL && $this->branch_address->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->branch_address->caption(), $this->branch_address->RequiredErrorMessage));
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

		// branch_org_id
		$this->branch_org_id->setDbValueDef($rsnew, $this->branch_org_id->CurrentValue, 0, FALSE);

		// branch_name
		$this->branch_name->setDbValueDef($rsnew, $this->branch_name->CurrentValue, "", FALSE);

		// branch_manager
		$this->branch_manager->setDbValueDef($rsnew, $this->branch_manager->CurrentValue, "", FALSE);

		// branch_contact
		$this->branch_contact->setDbValueDef($rsnew, $this->branch_contact->CurrentValue, "", FALSE);

		// branch_address
		$this->branch_address->setDbValueDef($rsnew, $this->branch_address->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("branchlist.php"), "", $this->TableVar, TRUE);
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
				case "x_branch_org_id":
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
						case "x_branch_org_id":
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