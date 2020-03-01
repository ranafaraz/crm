<?php
namespace PHPMaker2020\crm_live;

/**
 * Page class
 */
class reference_letter_add extends reference_letter
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}";

	// Table name
	public $TableName = 'reference_letter';

	// Page object name
	public $PageObjName = "reference_letter_add";

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

		// Table object (reference_letter)
		if (!isset($GLOBALS["reference_letter"]) || get_class($GLOBALS["reference_letter"]) == PROJECT_NAMESPACE . "reference_letter") {
			$GLOBALS["reference_letter"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["reference_letter"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'reference_letter');

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
		global $reference_letter;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($reference_letter);
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
					if ($pageName == "reference_letterview.php")
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
			$key .= @$ar['ref_letter_id'];
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
			$this->ref_letter_id->Visible = FALSE;
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
					$this->terminate(GetUrl("reference_letterlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ref_letter_id->Visible = FALSE;
		$this->ref_letter_branch_id->setVisibility();
		$this->ref_letter_to_whom->setVisibility();
		$this->ref_letter_by_whom->setVisibility();
		$this->ref_letter_content->setVisibility();
		$this->ref_letter_scanned->setVisibility();
		$this->ref_letter_date->setVisibility();
		$this->ref_letter_comments->setVisibility();
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
		$this->setupLookupOptions($this->ref_letter_branch_id);

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
			if (Get("ref_letter_id") !== NULL) {
				$this->ref_letter_id->setQueryStringValue(Get("ref_letter_id"));
				$this->setKey("ref_letter_id", $this->ref_letter_id->CurrentValue); // Set up key
			} else {
				$this->setKey("ref_letter_id", ""); // Clear key
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
					$this->terminate("reference_letterlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "reference_letterlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "reference_letterview.php")
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
		$this->ref_letter_scanned->Upload->Index = $CurrentForm->Index;
		$this->ref_letter_scanned->Upload->uploadFile();
		$this->ref_letter_scanned->CurrentValue = $this->ref_letter_scanned->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ref_letter_id->CurrentValue = NULL;
		$this->ref_letter_id->OldValue = $this->ref_letter_id->CurrentValue;
		$this->ref_letter_branch_id->CurrentValue = NULL;
		$this->ref_letter_branch_id->OldValue = $this->ref_letter_branch_id->CurrentValue;
		$this->ref_letter_to_whom->CurrentValue = NULL;
		$this->ref_letter_to_whom->OldValue = $this->ref_letter_to_whom->CurrentValue;
		$this->ref_letter_by_whom->CurrentValue = NULL;
		$this->ref_letter_by_whom->OldValue = $this->ref_letter_by_whom->CurrentValue;
		$this->ref_letter_content->CurrentValue = NULL;
		$this->ref_letter_content->OldValue = $this->ref_letter_content->CurrentValue;
		$this->ref_letter_scanned->Upload->DbValue = NULL;
		$this->ref_letter_scanned->OldValue = $this->ref_letter_scanned->Upload->DbValue;
		$this->ref_letter_scanned->CurrentValue = NULL; // Clear file related field
		$this->ref_letter_date->CurrentValue = NULL;
		$this->ref_letter_date->OldValue = $this->ref_letter_date->CurrentValue;
		$this->ref_letter_comments->CurrentValue = NULL;
		$this->ref_letter_comments->OldValue = $this->ref_letter_comments->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'ref_letter_branch_id' first before field var 'x_ref_letter_branch_id'
		$val = $CurrentForm->hasValue("ref_letter_branch_id") ? $CurrentForm->getValue("ref_letter_branch_id") : $CurrentForm->getValue("x_ref_letter_branch_id");
		if (!$this->ref_letter_branch_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ref_letter_branch_id->Visible = FALSE; // Disable update for API request
			else
				$this->ref_letter_branch_id->setFormValue($val);
		}

		// Check field name 'ref_letter_to_whom' first before field var 'x_ref_letter_to_whom'
		$val = $CurrentForm->hasValue("ref_letter_to_whom") ? $CurrentForm->getValue("ref_letter_to_whom") : $CurrentForm->getValue("x_ref_letter_to_whom");
		if (!$this->ref_letter_to_whom->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ref_letter_to_whom->Visible = FALSE; // Disable update for API request
			else
				$this->ref_letter_to_whom->setFormValue($val);
		}

		// Check field name 'ref_letter_by_whom' first before field var 'x_ref_letter_by_whom'
		$val = $CurrentForm->hasValue("ref_letter_by_whom") ? $CurrentForm->getValue("ref_letter_by_whom") : $CurrentForm->getValue("x_ref_letter_by_whom");
		if (!$this->ref_letter_by_whom->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ref_letter_by_whom->Visible = FALSE; // Disable update for API request
			else
				$this->ref_letter_by_whom->setFormValue($val);
		}

		// Check field name 'ref_letter_content' first before field var 'x_ref_letter_content'
		$val = $CurrentForm->hasValue("ref_letter_content") ? $CurrentForm->getValue("ref_letter_content") : $CurrentForm->getValue("x_ref_letter_content");
		if (!$this->ref_letter_content->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ref_letter_content->Visible = FALSE; // Disable update for API request
			else
				$this->ref_letter_content->setFormValue($val);
		}

		// Check field name 'ref_letter_date' first before field var 'x_ref_letter_date'
		$val = $CurrentForm->hasValue("ref_letter_date") ? $CurrentForm->getValue("ref_letter_date") : $CurrentForm->getValue("x_ref_letter_date");
		if (!$this->ref_letter_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ref_letter_date->Visible = FALSE; // Disable update for API request
			else
				$this->ref_letter_date->setFormValue($val);
			$this->ref_letter_date->CurrentValue = UnFormatDateTime($this->ref_letter_date->CurrentValue, 2);
		}

		// Check field name 'ref_letter_comments' first before field var 'x_ref_letter_comments'
		$val = $CurrentForm->hasValue("ref_letter_comments") ? $CurrentForm->getValue("ref_letter_comments") : $CurrentForm->getValue("x_ref_letter_comments");
		if (!$this->ref_letter_comments->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ref_letter_comments->Visible = FALSE; // Disable update for API request
			else
				$this->ref_letter_comments->setFormValue($val);
		}

		// Check field name 'ref_letter_id' first before field var 'x_ref_letter_id'
		$val = $CurrentForm->hasValue("ref_letter_id") ? $CurrentForm->getValue("ref_letter_id") : $CurrentForm->getValue("x_ref_letter_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ref_letter_branch_id->CurrentValue = $this->ref_letter_branch_id->FormValue;
		$this->ref_letter_to_whom->CurrentValue = $this->ref_letter_to_whom->FormValue;
		$this->ref_letter_by_whom->CurrentValue = $this->ref_letter_by_whom->FormValue;
		$this->ref_letter_content->CurrentValue = $this->ref_letter_content->FormValue;
		$this->ref_letter_date->CurrentValue = $this->ref_letter_date->FormValue;
		$this->ref_letter_date->CurrentValue = UnFormatDateTime($this->ref_letter_date->CurrentValue, 2);
		$this->ref_letter_comments->CurrentValue = $this->ref_letter_comments->FormValue;
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
		$this->ref_letter_id->setDbValue($row['ref_letter_id']);
		$this->ref_letter_branch_id->setDbValue($row['ref_letter_branch_id']);
		if (array_key_exists('EV__ref_letter_branch_id', $rs->fields)) {
			$this->ref_letter_branch_id->VirtualValue = $rs->fields('EV__ref_letter_branch_id'); // Set up virtual field value
		} else {
			$this->ref_letter_branch_id->VirtualValue = ""; // Clear value
		}
		$this->ref_letter_to_whom->setDbValue($row['ref_letter_to_whom']);
		$this->ref_letter_by_whom->setDbValue($row['ref_letter_by_whom']);
		$this->ref_letter_content->setDbValue($row['ref_letter_content']);
		$this->ref_letter_scanned->Upload->DbValue = $row['ref_letter_scanned'];
		$this->ref_letter_scanned->setDbValue($this->ref_letter_scanned->Upload->DbValue);
		$this->ref_letter_date->setDbValue($row['ref_letter_date']);
		$this->ref_letter_comments->setDbValue($row['ref_letter_comments']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ref_letter_id'] = $this->ref_letter_id->CurrentValue;
		$row['ref_letter_branch_id'] = $this->ref_letter_branch_id->CurrentValue;
		$row['ref_letter_to_whom'] = $this->ref_letter_to_whom->CurrentValue;
		$row['ref_letter_by_whom'] = $this->ref_letter_by_whom->CurrentValue;
		$row['ref_letter_content'] = $this->ref_letter_content->CurrentValue;
		$row['ref_letter_scanned'] = $this->ref_letter_scanned->Upload->DbValue;
		$row['ref_letter_date'] = $this->ref_letter_date->CurrentValue;
		$row['ref_letter_comments'] = $this->ref_letter_comments->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ref_letter_id")) != "")
			$this->ref_letter_id->OldValue = $this->getKey("ref_letter_id"); // ref_letter_id
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
		// ref_letter_id
		// ref_letter_branch_id
		// ref_letter_to_whom
		// ref_letter_by_whom
		// ref_letter_content
		// ref_letter_scanned
		// ref_letter_date
		// ref_letter_comments

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ref_letter_id
			$this->ref_letter_id->ViewValue = $this->ref_letter_id->CurrentValue;
			$this->ref_letter_id->CssClass = "font-weight-bold";
			$this->ref_letter_id->ViewCustomAttributes = "";

			// ref_letter_branch_id
			if ($this->ref_letter_branch_id->VirtualValue != "") {
				$this->ref_letter_branch_id->ViewValue = $this->ref_letter_branch_id->VirtualValue;
			} else {
				$curVal = strval($this->ref_letter_branch_id->CurrentValue);
				if ($curVal != "") {
					$this->ref_letter_branch_id->ViewValue = $this->ref_letter_branch_id->lookupCacheOption($curVal);
					if ($this->ref_letter_branch_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`branch_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ref_letter_branch_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->ref_letter_branch_id->ViewValue = $this->ref_letter_branch_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ref_letter_branch_id->ViewValue = $this->ref_letter_branch_id->CurrentValue;
						}
					}
				} else {
					$this->ref_letter_branch_id->ViewValue = NULL;
				}
			}
			$this->ref_letter_branch_id->ViewCustomAttributes = "";

			// ref_letter_to_whom
			$this->ref_letter_to_whom->ViewValue = $this->ref_letter_to_whom->CurrentValue;
			$this->ref_letter_to_whom->ViewCustomAttributes = "";

			// ref_letter_by_whom
			$this->ref_letter_by_whom->ViewValue = $this->ref_letter_by_whom->CurrentValue;
			$this->ref_letter_by_whom->ViewCustomAttributes = "";

			// ref_letter_content
			$this->ref_letter_content->ViewValue = $this->ref_letter_content->CurrentValue;
			$this->ref_letter_content->ViewCustomAttributes = "";

			// ref_letter_scanned
			if (!EmptyValue($this->ref_letter_scanned->Upload->DbValue)) {
				$this->ref_letter_scanned->ImageWidth = 200;
				$this->ref_letter_scanned->ImageHeight = 0;
				$this->ref_letter_scanned->ImageAlt = $this->ref_letter_scanned->alt();
				$this->ref_letter_scanned->ViewValue = $this->ref_letter_scanned->Upload->DbValue;
			} else {
				$this->ref_letter_scanned->ViewValue = "";
			}
			$this->ref_letter_scanned->ViewCustomAttributes = "";

			// ref_letter_date
			$this->ref_letter_date->ViewValue = $this->ref_letter_date->CurrentValue;
			$this->ref_letter_date->ViewValue = FormatDateTime($this->ref_letter_date->ViewValue, 2);
			$this->ref_letter_date->ViewCustomAttributes = "";

			// ref_letter_comments
			$this->ref_letter_comments->ViewValue = $this->ref_letter_comments->CurrentValue;
			$this->ref_letter_comments->ViewCustomAttributes = "";

			// ref_letter_branch_id
			$this->ref_letter_branch_id->LinkCustomAttributes = "";
			$this->ref_letter_branch_id->HrefValue = "";
			$this->ref_letter_branch_id->TooltipValue = "";

			// ref_letter_to_whom
			$this->ref_letter_to_whom->LinkCustomAttributes = "";
			$this->ref_letter_to_whom->HrefValue = "";
			$this->ref_letter_to_whom->TooltipValue = "";

			// ref_letter_by_whom
			$this->ref_letter_by_whom->LinkCustomAttributes = "";
			$this->ref_letter_by_whom->HrefValue = "";
			$this->ref_letter_by_whom->TooltipValue = "";

			// ref_letter_content
			$this->ref_letter_content->LinkCustomAttributes = "";
			$this->ref_letter_content->HrefValue = "";
			$this->ref_letter_content->TooltipValue = "";

			// ref_letter_scanned
			$this->ref_letter_scanned->LinkCustomAttributes = "";
			if (!EmptyValue($this->ref_letter_scanned->Upload->DbValue)) {
				$this->ref_letter_scanned->HrefValue = GetFileUploadUrl($this->ref_letter_scanned, $this->ref_letter_scanned->htmlDecode($this->ref_letter_scanned->Upload->DbValue)); // Add prefix/suffix
				$this->ref_letter_scanned->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->ref_letter_scanned->HrefValue = FullUrl($this->ref_letter_scanned->HrefValue, "href");
			} else {
				$this->ref_letter_scanned->HrefValue = "";
			}
			$this->ref_letter_scanned->ExportHrefValue = $this->ref_letter_scanned->UploadPath . $this->ref_letter_scanned->Upload->DbValue;
			$this->ref_letter_scanned->TooltipValue = "";
			if ($this->ref_letter_scanned->UseColorbox) {
				if (EmptyValue($this->ref_letter_scanned->TooltipValue))
					$this->ref_letter_scanned->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->ref_letter_scanned->LinkAttrs["data-rel"] = "reference_letter_x_ref_letter_scanned";
				$this->ref_letter_scanned->LinkAttrs->appendClass("ew-lightbox");
			}

			// ref_letter_date
			$this->ref_letter_date->LinkCustomAttributes = "";
			$this->ref_letter_date->HrefValue = "";
			$this->ref_letter_date->TooltipValue = "";

			// ref_letter_comments
			$this->ref_letter_comments->LinkCustomAttributes = "";
			$this->ref_letter_comments->HrefValue = "";
			$this->ref_letter_comments->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ref_letter_branch_id
			$this->ref_letter_branch_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->ref_letter_branch_id->CurrentValue));
			if ($curVal != "")
				$this->ref_letter_branch_id->ViewValue = $this->ref_letter_branch_id->lookupCacheOption($curVal);
			else
				$this->ref_letter_branch_id->ViewValue = $this->ref_letter_branch_id->Lookup !== NULL && is_array($this->ref_letter_branch_id->Lookup->Options) ? $curVal : NULL;
			if ($this->ref_letter_branch_id->ViewValue !== NULL) { // Load from cache
				$this->ref_letter_branch_id->EditValue = array_values($this->ref_letter_branch_id->Lookup->Options);
				if ($this->ref_letter_branch_id->ViewValue == "")
					$this->ref_letter_branch_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`branch_id`" . SearchString("=", $this->ref_letter_branch_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ref_letter_branch_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ref_letter_branch_id->ViewValue = $this->ref_letter_branch_id->displayValue($arwrk);
				} else {
					$this->ref_letter_branch_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ref_letter_branch_id->EditValue = $arwrk;
			}

			// ref_letter_to_whom
			$this->ref_letter_to_whom->EditAttrs["class"] = "form-control";
			$this->ref_letter_to_whom->EditCustomAttributes = "";
			if (!$this->ref_letter_to_whom->Raw)
				$this->ref_letter_to_whom->CurrentValue = HtmlDecode($this->ref_letter_to_whom->CurrentValue);
			$this->ref_letter_to_whom->EditValue = HtmlEncode($this->ref_letter_to_whom->CurrentValue);
			$this->ref_letter_to_whom->PlaceHolder = RemoveHtml($this->ref_letter_to_whom->caption());

			// ref_letter_by_whom
			$this->ref_letter_by_whom->EditAttrs["class"] = "form-control";
			$this->ref_letter_by_whom->EditCustomAttributes = "";
			if (!$this->ref_letter_by_whom->Raw)
				$this->ref_letter_by_whom->CurrentValue = HtmlDecode($this->ref_letter_by_whom->CurrentValue);
			$this->ref_letter_by_whom->EditValue = HtmlEncode($this->ref_letter_by_whom->CurrentValue);
			$this->ref_letter_by_whom->PlaceHolder = RemoveHtml($this->ref_letter_by_whom->caption());

			// ref_letter_content
			$this->ref_letter_content->EditAttrs["class"] = "form-control";
			$this->ref_letter_content->EditCustomAttributes = "";
			$this->ref_letter_content->EditValue = HtmlEncode($this->ref_letter_content->CurrentValue);
			$this->ref_letter_content->PlaceHolder = RemoveHtml($this->ref_letter_content->caption());

			// ref_letter_scanned
			$this->ref_letter_scanned->EditAttrs["class"] = "form-control";
			$this->ref_letter_scanned->EditCustomAttributes = "";
			if (!EmptyValue($this->ref_letter_scanned->Upload->DbValue)) {
				$this->ref_letter_scanned->ImageWidth = 200;
				$this->ref_letter_scanned->ImageHeight = 0;
				$this->ref_letter_scanned->ImageAlt = $this->ref_letter_scanned->alt();
				$this->ref_letter_scanned->EditValue = $this->ref_letter_scanned->Upload->DbValue;
			} else {
				$this->ref_letter_scanned->EditValue = "";
			}
			if (!EmptyValue($this->ref_letter_scanned->CurrentValue))
					$this->ref_letter_scanned->Upload->FileName = $this->ref_letter_scanned->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->ref_letter_scanned);

			// ref_letter_date
			$this->ref_letter_date->EditAttrs["class"] = "form-control";
			$this->ref_letter_date->EditCustomAttributes = "";
			$this->ref_letter_date->EditValue = HtmlEncode(FormatDateTime($this->ref_letter_date->CurrentValue, 2));
			$this->ref_letter_date->PlaceHolder = RemoveHtml($this->ref_letter_date->caption());

			// ref_letter_comments
			$this->ref_letter_comments->EditAttrs["class"] = "form-control";
			$this->ref_letter_comments->EditCustomAttributes = "";
			$this->ref_letter_comments->EditValue = HtmlEncode($this->ref_letter_comments->CurrentValue);
			$this->ref_letter_comments->PlaceHolder = RemoveHtml($this->ref_letter_comments->caption());

			// Add refer script
			// ref_letter_branch_id

			$this->ref_letter_branch_id->LinkCustomAttributes = "";
			$this->ref_letter_branch_id->HrefValue = "";

			// ref_letter_to_whom
			$this->ref_letter_to_whom->LinkCustomAttributes = "";
			$this->ref_letter_to_whom->HrefValue = "";

			// ref_letter_by_whom
			$this->ref_letter_by_whom->LinkCustomAttributes = "";
			$this->ref_letter_by_whom->HrefValue = "";

			// ref_letter_content
			$this->ref_letter_content->LinkCustomAttributes = "";
			$this->ref_letter_content->HrefValue = "";

			// ref_letter_scanned
			$this->ref_letter_scanned->LinkCustomAttributes = "";
			if (!EmptyValue($this->ref_letter_scanned->Upload->DbValue)) {
				$this->ref_letter_scanned->HrefValue = GetFileUploadUrl($this->ref_letter_scanned, $this->ref_letter_scanned->htmlDecode($this->ref_letter_scanned->Upload->DbValue)); // Add prefix/suffix
				$this->ref_letter_scanned->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->ref_letter_scanned->HrefValue = FullUrl($this->ref_letter_scanned->HrefValue, "href");
			} else {
				$this->ref_letter_scanned->HrefValue = "";
			}
			$this->ref_letter_scanned->ExportHrefValue = $this->ref_letter_scanned->UploadPath . $this->ref_letter_scanned->Upload->DbValue;

			// ref_letter_date
			$this->ref_letter_date->LinkCustomAttributes = "";
			$this->ref_letter_date->HrefValue = "";

			// ref_letter_comments
			$this->ref_letter_comments->LinkCustomAttributes = "";
			$this->ref_letter_comments->HrefValue = "";
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
		if ($this->ref_letter_branch_id->Required) {
			if (!$this->ref_letter_branch_id->IsDetailKey && $this->ref_letter_branch_id->FormValue != NULL && $this->ref_letter_branch_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ref_letter_branch_id->caption(), $this->ref_letter_branch_id->RequiredErrorMessage));
			}
		}
		if ($this->ref_letter_to_whom->Required) {
			if (!$this->ref_letter_to_whom->IsDetailKey && $this->ref_letter_to_whom->FormValue != NULL && $this->ref_letter_to_whom->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ref_letter_to_whom->caption(), $this->ref_letter_to_whom->RequiredErrorMessage));
			}
		}
		if ($this->ref_letter_by_whom->Required) {
			if (!$this->ref_letter_by_whom->IsDetailKey && $this->ref_letter_by_whom->FormValue != NULL && $this->ref_letter_by_whom->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ref_letter_by_whom->caption(), $this->ref_letter_by_whom->RequiredErrorMessage));
			}
		}
		if ($this->ref_letter_content->Required) {
			if (!$this->ref_letter_content->IsDetailKey && $this->ref_letter_content->FormValue != NULL && $this->ref_letter_content->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ref_letter_content->caption(), $this->ref_letter_content->RequiredErrorMessage));
			}
		}
		if ($this->ref_letter_scanned->Required) {
			if ($this->ref_letter_scanned->Upload->FileName == "" && !$this->ref_letter_scanned->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->ref_letter_scanned->caption(), $this->ref_letter_scanned->RequiredErrorMessage));
			}
		}
		if ($this->ref_letter_date->Required) {
			if (!$this->ref_letter_date->IsDetailKey && $this->ref_letter_date->FormValue != NULL && $this->ref_letter_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ref_letter_date->caption(), $this->ref_letter_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ref_letter_date->FormValue)) {
			AddMessage($FormError, $this->ref_letter_date->errorMessage());
		}
		if ($this->ref_letter_comments->Required) {
			if (!$this->ref_letter_comments->IsDetailKey && $this->ref_letter_comments->FormValue != NULL && $this->ref_letter_comments->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ref_letter_comments->caption(), $this->ref_letter_comments->RequiredErrorMessage));
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

		// ref_letter_branch_id
		$this->ref_letter_branch_id->setDbValueDef($rsnew, $this->ref_letter_branch_id->CurrentValue, 0, FALSE);

		// ref_letter_to_whom
		$this->ref_letter_to_whom->setDbValueDef($rsnew, $this->ref_letter_to_whom->CurrentValue, "", FALSE);

		// ref_letter_by_whom
		$this->ref_letter_by_whom->setDbValueDef($rsnew, $this->ref_letter_by_whom->CurrentValue, "", FALSE);

		// ref_letter_content
		$this->ref_letter_content->setDbValueDef($rsnew, $this->ref_letter_content->CurrentValue, "", FALSE);

		// ref_letter_scanned
		if ($this->ref_letter_scanned->Visible && !$this->ref_letter_scanned->Upload->KeepFile) {
			$this->ref_letter_scanned->Upload->DbValue = ""; // No need to delete old file
			if ($this->ref_letter_scanned->Upload->FileName == "") {
				$rsnew['ref_letter_scanned'] = NULL;
			} else {
				$rsnew['ref_letter_scanned'] = $this->ref_letter_scanned->Upload->FileName;
			}
			$this->ref_letter_scanned->ImageWidth = 1000; // Resize width
			$this->ref_letter_scanned->ImageHeight = 0; // Resize height
		}

		// ref_letter_date
		$this->ref_letter_date->setDbValueDef($rsnew, UnFormatDateTime($this->ref_letter_date->CurrentValue, 2), CurrentDate(), FALSE);

		// ref_letter_comments
		$this->ref_letter_comments->setDbValueDef($rsnew, $this->ref_letter_comments->CurrentValue, "", FALSE);
		if ($this->ref_letter_scanned->Visible && !$this->ref_letter_scanned->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->ref_letter_scanned->Upload->DbValue) ? [] : [$this->ref_letter_scanned->htmlDecode($this->ref_letter_scanned->Upload->DbValue)];
			if (!EmptyValue($this->ref_letter_scanned->Upload->FileName)) {
				$newFiles = [$this->ref_letter_scanned->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->ref_letter_scanned, $this->ref_letter_scanned->Upload->Index);
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
							$file1 = UniqueFilename($this->ref_letter_scanned->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->ref_letter_scanned->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->ref_letter_scanned->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->ref_letter_scanned->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->ref_letter_scanned->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->ref_letter_scanned->setDbValueDef($rsnew, $this->ref_letter_scanned->Upload->FileName, "", FALSE);
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
				if ($this->ref_letter_scanned->Visible && !$this->ref_letter_scanned->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->ref_letter_scanned->Upload->DbValue) ? [] : [$this->ref_letter_scanned->htmlDecode($this->ref_letter_scanned->Upload->DbValue)];
					if (!EmptyValue($this->ref_letter_scanned->Upload->FileName)) {
						$newFiles = [$this->ref_letter_scanned->Upload->FileName];
						$newFiles2 = [$this->ref_letter_scanned->htmlDecode($rsnew['ref_letter_scanned'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->ref_letter_scanned, $this->ref_letter_scanned->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->ref_letter_scanned->Upload->ResizeAndSaveToFile($this->ref_letter_scanned->ImageWidth, $this->ref_letter_scanned->ImageHeight, 100, $newFiles[$i], TRUE, $i)) {
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
								@unlink($this->ref_letter_scanned->oldPhysicalUploadPath() . $oldFile);
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

			// ref_letter_scanned
			if ($this->ref_letter_scanned->Upload->FileToken != "")
				CleanUploadTempPath($this->ref_letter_scanned->Upload->FileToken, $this->ref_letter_scanned->Upload->Index);
			else
				CleanUploadTempPath($this->ref_letter_scanned, $this->ref_letter_scanned->Upload->Index);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("reference_letterlist.php"), "", $this->TableVar, TRUE);
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
				case "x_ref_letter_branch_id":
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
						case "x_ref_letter_branch_id":
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