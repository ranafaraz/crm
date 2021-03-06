<?php
namespace PHPMaker2020\crm_live;

/**
 * Page class
 */
class referral_add extends referral
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}";

	// Table name
	public $TableName = 'referral';

	// Page object name
	public $PageObjName = "referral_add";

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

		// Table object (referral)
		if (!isset($GLOBALS["referral"]) || get_class($GLOBALS["referral"]) == PROJECT_NAMESPACE . "referral") {
			$GLOBALS["referral"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["referral"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'referral');

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
		global $referral;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($referral);
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
					if ($pageName == "referralview.php")
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
			$key .= @$ar['referral_id'];
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
			$this->referral_id->Visible = FALSE;
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
					$this->terminate(GetUrl("referrallist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->referral_id->Visible = FALSE;
		$this->referral_branch_id->setVisibility();
		$this->referral_name->setVisibility();
		$this->referral_desc->setVisibility();
		$this->referral_deal_signed->setVisibility();
		$this->referral_scanned->setVisibility();
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
		$this->setupLookupOptions($this->referral_branch_id);

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
			if (Get("referral_id") !== NULL) {
				$this->referral_id->setQueryStringValue(Get("referral_id"));
				$this->setKey("referral_id", $this->referral_id->CurrentValue); // Set up key
			} else {
				$this->setKey("referral_id", ""); // Clear key
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
					$this->terminate("referrallist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "referrallist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "referralview.php")
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
		$this->referral_scanned->Upload->Index = $CurrentForm->Index;
		$this->referral_scanned->Upload->uploadFile();
		$this->referral_scanned->CurrentValue = $this->referral_scanned->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->referral_id->CurrentValue = NULL;
		$this->referral_id->OldValue = $this->referral_id->CurrentValue;
		$this->referral_branch_id->CurrentValue = NULL;
		$this->referral_branch_id->OldValue = $this->referral_branch_id->CurrentValue;
		$this->referral_name->CurrentValue = NULL;
		$this->referral_name->OldValue = $this->referral_name->CurrentValue;
		$this->referral_desc->CurrentValue = NULL;
		$this->referral_desc->OldValue = $this->referral_desc->CurrentValue;
		$this->referral_deal_signed->CurrentValue = NULL;
		$this->referral_deal_signed->OldValue = $this->referral_deal_signed->CurrentValue;
		$this->referral_scanned->Upload->DbValue = NULL;
		$this->referral_scanned->OldValue = $this->referral_scanned->Upload->DbValue;
		$this->referral_scanned->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'referral_branch_id' first before field var 'x_referral_branch_id'
		$val = $CurrentForm->hasValue("referral_branch_id") ? $CurrentForm->getValue("referral_branch_id") : $CurrentForm->getValue("x_referral_branch_id");
		if (!$this->referral_branch_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->referral_branch_id->Visible = FALSE; // Disable update for API request
			else
				$this->referral_branch_id->setFormValue($val);
		}

		// Check field name 'referral_name' first before field var 'x_referral_name'
		$val = $CurrentForm->hasValue("referral_name") ? $CurrentForm->getValue("referral_name") : $CurrentForm->getValue("x_referral_name");
		if (!$this->referral_name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->referral_name->Visible = FALSE; // Disable update for API request
			else
				$this->referral_name->setFormValue($val);
		}

		// Check field name 'referral_desc' first before field var 'x_referral_desc'
		$val = $CurrentForm->hasValue("referral_desc") ? $CurrentForm->getValue("referral_desc") : $CurrentForm->getValue("x_referral_desc");
		if (!$this->referral_desc->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->referral_desc->Visible = FALSE; // Disable update for API request
			else
				$this->referral_desc->setFormValue($val);
		}

		// Check field name 'referral_deal_signed' first before field var 'x_referral_deal_signed'
		$val = $CurrentForm->hasValue("referral_deal_signed") ? $CurrentForm->getValue("referral_deal_signed") : $CurrentForm->getValue("x_referral_deal_signed");
		if (!$this->referral_deal_signed->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->referral_deal_signed->Visible = FALSE; // Disable update for API request
			else
				$this->referral_deal_signed->setFormValue($val);
		}

		// Check field name 'referral_id' first before field var 'x_referral_id'
		$val = $CurrentForm->hasValue("referral_id") ? $CurrentForm->getValue("referral_id") : $CurrentForm->getValue("x_referral_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->referral_branch_id->CurrentValue = $this->referral_branch_id->FormValue;
		$this->referral_name->CurrentValue = $this->referral_name->FormValue;
		$this->referral_desc->CurrentValue = $this->referral_desc->FormValue;
		$this->referral_deal_signed->CurrentValue = $this->referral_deal_signed->FormValue;
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
		$this->referral_id->setDbValue($row['referral_id']);
		$this->referral_branch_id->setDbValue($row['referral_branch_id']);
		if (array_key_exists('EV__referral_branch_id', $rs->fields)) {
			$this->referral_branch_id->VirtualValue = $rs->fields('EV__referral_branch_id'); // Set up virtual field value
		} else {
			$this->referral_branch_id->VirtualValue = ""; // Clear value
		}
		$this->referral_name->setDbValue($row['referral_name']);
		$this->referral_desc->setDbValue($row['referral_desc']);
		$this->referral_deal_signed->setDbValue($row['referral_deal_signed']);
		$this->referral_scanned->Upload->DbValue = $row['referral_scanned'];
		$this->referral_scanned->setDbValue($this->referral_scanned->Upload->DbValue);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['referral_id'] = $this->referral_id->CurrentValue;
		$row['referral_branch_id'] = $this->referral_branch_id->CurrentValue;
		$row['referral_name'] = $this->referral_name->CurrentValue;
		$row['referral_desc'] = $this->referral_desc->CurrentValue;
		$row['referral_deal_signed'] = $this->referral_deal_signed->CurrentValue;
		$row['referral_scanned'] = $this->referral_scanned->Upload->DbValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("referral_id")) != "")
			$this->referral_id->OldValue = $this->getKey("referral_id"); // referral_id
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
		// referral_id
		// referral_branch_id
		// referral_name
		// referral_desc
		// referral_deal_signed
		// referral_scanned

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// referral_id
			$this->referral_id->ViewValue = $this->referral_id->CurrentValue;
			$this->referral_id->CssClass = "font-weight-bold";
			$this->referral_id->ViewCustomAttributes = "";

			// referral_branch_id
			if ($this->referral_branch_id->VirtualValue != "") {
				$this->referral_branch_id->ViewValue = $this->referral_branch_id->VirtualValue;
			} else {
				$curVal = strval($this->referral_branch_id->CurrentValue);
				if ($curVal != "") {
					$this->referral_branch_id->ViewValue = $this->referral_branch_id->lookupCacheOption($curVal);
					if ($this->referral_branch_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`branch_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->referral_branch_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->referral_branch_id->ViewValue = $this->referral_branch_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->referral_branch_id->ViewValue = $this->referral_branch_id->CurrentValue;
						}
					}
				} else {
					$this->referral_branch_id->ViewValue = NULL;
				}
			}
			$this->referral_branch_id->ViewCustomAttributes = "";

			// referral_name
			$this->referral_name->ViewValue = $this->referral_name->CurrentValue;
			$this->referral_name->ViewCustomAttributes = "";

			// referral_desc
			$this->referral_desc->ViewValue = $this->referral_desc->CurrentValue;
			$this->referral_desc->ViewCustomAttributes = "";

			// referral_deal_signed
			$this->referral_deal_signed->ViewValue = $this->referral_deal_signed->CurrentValue;
			$this->referral_deal_signed->ViewCustomAttributes = "";

			// referral_scanned
			if (!EmptyValue($this->referral_scanned->Upload->DbValue)) {
				$this->referral_scanned->ImageWidth = 200;
				$this->referral_scanned->ImageHeight = 0;
				$this->referral_scanned->ImageAlt = $this->referral_scanned->alt();
				$this->referral_scanned->ViewValue = $this->referral_scanned->Upload->DbValue;
			} else {
				$this->referral_scanned->ViewValue = "";
			}
			$this->referral_scanned->ViewCustomAttributes = "";

			// referral_branch_id
			$this->referral_branch_id->LinkCustomAttributes = "";
			$this->referral_branch_id->HrefValue = "";
			$this->referral_branch_id->TooltipValue = "";

			// referral_name
			$this->referral_name->LinkCustomAttributes = "";
			$this->referral_name->HrefValue = "";
			$this->referral_name->TooltipValue = "";

			// referral_desc
			$this->referral_desc->LinkCustomAttributes = "";
			$this->referral_desc->HrefValue = "";
			$this->referral_desc->TooltipValue = "";

			// referral_deal_signed
			$this->referral_deal_signed->LinkCustomAttributes = "";
			$this->referral_deal_signed->HrefValue = "";
			$this->referral_deal_signed->TooltipValue = "";

			// referral_scanned
			$this->referral_scanned->LinkCustomAttributes = "";
			if (!EmptyValue($this->referral_scanned->Upload->DbValue)) {
				$this->referral_scanned->HrefValue = GetFileUploadUrl($this->referral_scanned, $this->referral_scanned->htmlDecode($this->referral_scanned->Upload->DbValue)); // Add prefix/suffix
				$this->referral_scanned->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->referral_scanned->HrefValue = FullUrl($this->referral_scanned->HrefValue, "href");
			} else {
				$this->referral_scanned->HrefValue = "";
			}
			$this->referral_scanned->ExportHrefValue = $this->referral_scanned->UploadPath . $this->referral_scanned->Upload->DbValue;
			$this->referral_scanned->TooltipValue = "";
			if ($this->referral_scanned->UseColorbox) {
				if (EmptyValue($this->referral_scanned->TooltipValue))
					$this->referral_scanned->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->referral_scanned->LinkAttrs["data-rel"] = "referral_x_referral_scanned";
				$this->referral_scanned->LinkAttrs->appendClass("ew-lightbox");
			}
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// referral_branch_id
			$this->referral_branch_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->referral_branch_id->CurrentValue));
			if ($curVal != "")
				$this->referral_branch_id->ViewValue = $this->referral_branch_id->lookupCacheOption($curVal);
			else
				$this->referral_branch_id->ViewValue = $this->referral_branch_id->Lookup !== NULL && is_array($this->referral_branch_id->Lookup->Options) ? $curVal : NULL;
			if ($this->referral_branch_id->ViewValue !== NULL) { // Load from cache
				$this->referral_branch_id->EditValue = array_values($this->referral_branch_id->Lookup->Options);
				if ($this->referral_branch_id->ViewValue == "")
					$this->referral_branch_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`branch_id`" . SearchString("=", $this->referral_branch_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->referral_branch_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->referral_branch_id->ViewValue = $this->referral_branch_id->displayValue($arwrk);
				} else {
					$this->referral_branch_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->referral_branch_id->EditValue = $arwrk;
			}

			// referral_name
			$this->referral_name->EditAttrs["class"] = "form-control";
			$this->referral_name->EditCustomAttributes = "";
			if (!$this->referral_name->Raw)
				$this->referral_name->CurrentValue = HtmlDecode($this->referral_name->CurrentValue);
			$this->referral_name->EditValue = HtmlEncode($this->referral_name->CurrentValue);
			$this->referral_name->PlaceHolder = RemoveHtml($this->referral_name->caption());

			// referral_desc
			$this->referral_desc->EditAttrs["class"] = "form-control";
			$this->referral_desc->EditCustomAttributes = "";
			if (!$this->referral_desc->Raw)
				$this->referral_desc->CurrentValue = HtmlDecode($this->referral_desc->CurrentValue);
			$this->referral_desc->EditValue = HtmlEncode($this->referral_desc->CurrentValue);
			$this->referral_desc->PlaceHolder = RemoveHtml($this->referral_desc->caption());

			// referral_deal_signed
			$this->referral_deal_signed->EditAttrs["class"] = "form-control";
			$this->referral_deal_signed->EditCustomAttributes = "";
			$this->referral_deal_signed->EditValue = HtmlEncode($this->referral_deal_signed->CurrentValue);
			$this->referral_deal_signed->PlaceHolder = RemoveHtml($this->referral_deal_signed->caption());

			// referral_scanned
			$this->referral_scanned->EditAttrs["class"] = "form-control";
			$this->referral_scanned->EditCustomAttributes = "";
			if (!EmptyValue($this->referral_scanned->Upload->DbValue)) {
				$this->referral_scanned->ImageWidth = 200;
				$this->referral_scanned->ImageHeight = 0;
				$this->referral_scanned->ImageAlt = $this->referral_scanned->alt();
				$this->referral_scanned->EditValue = $this->referral_scanned->Upload->DbValue;
			} else {
				$this->referral_scanned->EditValue = "";
			}
			if (!EmptyValue($this->referral_scanned->CurrentValue))
					$this->referral_scanned->Upload->FileName = $this->referral_scanned->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->referral_scanned);

			// Add refer script
			// referral_branch_id

			$this->referral_branch_id->LinkCustomAttributes = "";
			$this->referral_branch_id->HrefValue = "";

			// referral_name
			$this->referral_name->LinkCustomAttributes = "";
			$this->referral_name->HrefValue = "";

			// referral_desc
			$this->referral_desc->LinkCustomAttributes = "";
			$this->referral_desc->HrefValue = "";

			// referral_deal_signed
			$this->referral_deal_signed->LinkCustomAttributes = "";
			$this->referral_deal_signed->HrefValue = "";

			// referral_scanned
			$this->referral_scanned->LinkCustomAttributes = "";
			if (!EmptyValue($this->referral_scanned->Upload->DbValue)) {
				$this->referral_scanned->HrefValue = GetFileUploadUrl($this->referral_scanned, $this->referral_scanned->htmlDecode($this->referral_scanned->Upload->DbValue)); // Add prefix/suffix
				$this->referral_scanned->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->referral_scanned->HrefValue = FullUrl($this->referral_scanned->HrefValue, "href");
			} else {
				$this->referral_scanned->HrefValue = "";
			}
			$this->referral_scanned->ExportHrefValue = $this->referral_scanned->UploadPath . $this->referral_scanned->Upload->DbValue;
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
		if ($this->referral_branch_id->Required) {
			if (!$this->referral_branch_id->IsDetailKey && $this->referral_branch_id->FormValue != NULL && $this->referral_branch_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->referral_branch_id->caption(), $this->referral_branch_id->RequiredErrorMessage));
			}
		}
		if ($this->referral_name->Required) {
			if (!$this->referral_name->IsDetailKey && $this->referral_name->FormValue != NULL && $this->referral_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->referral_name->caption(), $this->referral_name->RequiredErrorMessage));
			}
		}
		if ($this->referral_desc->Required) {
			if (!$this->referral_desc->IsDetailKey && $this->referral_desc->FormValue != NULL && $this->referral_desc->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->referral_desc->caption(), $this->referral_desc->RequiredErrorMessage));
			}
		}
		if ($this->referral_deal_signed->Required) {
			if (!$this->referral_deal_signed->IsDetailKey && $this->referral_deal_signed->FormValue != NULL && $this->referral_deal_signed->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->referral_deal_signed->caption(), $this->referral_deal_signed->RequiredErrorMessage));
			}
		}
		if ($this->referral_scanned->Required) {
			if ($this->referral_scanned->Upload->FileName == "" && !$this->referral_scanned->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->referral_scanned->caption(), $this->referral_scanned->RequiredErrorMessage));
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

		// referral_branch_id
		$this->referral_branch_id->setDbValueDef($rsnew, $this->referral_branch_id->CurrentValue, 0, FALSE);

		// referral_name
		$this->referral_name->setDbValueDef($rsnew, $this->referral_name->CurrentValue, "", FALSE);

		// referral_desc
		$this->referral_desc->setDbValueDef($rsnew, $this->referral_desc->CurrentValue, "", FALSE);

		// referral_deal_signed
		$this->referral_deal_signed->setDbValueDef($rsnew, $this->referral_deal_signed->CurrentValue, "", FALSE);

		// referral_scanned
		if ($this->referral_scanned->Visible && !$this->referral_scanned->Upload->KeepFile) {
			$this->referral_scanned->Upload->DbValue = ""; // No need to delete old file
			if ($this->referral_scanned->Upload->FileName == "") {
				$rsnew['referral_scanned'] = NULL;
			} else {
				$rsnew['referral_scanned'] = $this->referral_scanned->Upload->FileName;
			}
			$this->referral_scanned->ImageWidth = 1000; // Resize width
			$this->referral_scanned->ImageHeight = 0; // Resize height
		}
		if ($this->referral_scanned->Visible && !$this->referral_scanned->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->referral_scanned->Upload->DbValue) ? [] : [$this->referral_scanned->htmlDecode($this->referral_scanned->Upload->DbValue)];
			if (!EmptyValue($this->referral_scanned->Upload->FileName)) {
				$newFiles = [$this->referral_scanned->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->referral_scanned, $this->referral_scanned->Upload->Index);
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
							$file1 = UniqueFilename($this->referral_scanned->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->referral_scanned->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->referral_scanned->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->referral_scanned->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->referral_scanned->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->referral_scanned->setDbValueDef($rsnew, $this->referral_scanned->Upload->FileName, "", FALSE);
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
				if ($this->referral_scanned->Visible && !$this->referral_scanned->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->referral_scanned->Upload->DbValue) ? [] : [$this->referral_scanned->htmlDecode($this->referral_scanned->Upload->DbValue)];
					if (!EmptyValue($this->referral_scanned->Upload->FileName)) {
						$newFiles = [$this->referral_scanned->Upload->FileName];
						$newFiles2 = [$this->referral_scanned->htmlDecode($rsnew['referral_scanned'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->referral_scanned, $this->referral_scanned->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->referral_scanned->Upload->ResizeAndSaveToFile($this->referral_scanned->ImageWidth, $this->referral_scanned->ImageHeight, 100, $newFiles[$i], TRUE, $i)) {
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
								@unlink($this->referral_scanned->oldPhysicalUploadPath() . $oldFile);
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

			// referral_scanned
			if ($this->referral_scanned->Upload->FileToken != "")
				CleanUploadTempPath($this->referral_scanned->Upload->FileToken, $this->referral_scanned->Upload->Index);
			else
				CleanUploadTempPath($this->referral_scanned, $this->referral_scanned->Upload->Index);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("referrallist.php"), "", $this->TableVar, TRUE);
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
				case "x_referral_branch_id":
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
						case "x_referral_branch_id":
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