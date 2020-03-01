<?php
namespace PHPMaker2020\project1;

/**
 * Page class
 */
class quotation_add extends quotation
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{5525D2B6-89E2-4D25-84CF-86BD784D9909}";

	// Table name
	public $TableName = 'quotation';

	// Page object name
	public $PageObjName = "quotation_add";

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

		// Table object (quotation)
		if (!isset($GLOBALS["quotation"]) || get_class($GLOBALS["quotation"]) == PROJECT_NAMESPACE . "quotation") {
			$GLOBALS["quotation"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["quotation"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'quotation');

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
		global $quotation;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($quotation);
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
					if ($pageName == "quotationview.php")
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
			$key .= @$ar['quote_id'];
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
			$this->quote_id->Visible = FALSE;
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
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->quote_id->Visible = FALSE;
		$this->quote_branch_id->setVisibility();
		$this->quote_business_id->setVisibility();
		$this->quote_service_id->setVisibility();
		$this->quote_issue_date->setVisibility();
		$this->quote_due_date->setVisibility();
		$this->quote_amount->setVisibility();
		$this->quote_content->setVisibility();
		$this->quote_comments->setVisibility();
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
			if (Get("quote_id") !== NULL) {
				$this->quote_id->setQueryStringValue(Get("quote_id"));
				$this->setKey("quote_id", $this->quote_id->CurrentValue); // Set up key
			} else {
				$this->setKey("quote_id", ""); // Clear key
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
					$this->terminate("quotationlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "quotationlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "quotationview.php")
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
		$this->quote_id->CurrentValue = NULL;
		$this->quote_id->OldValue = $this->quote_id->CurrentValue;
		$this->quote_branch_id->CurrentValue = NULL;
		$this->quote_branch_id->OldValue = $this->quote_branch_id->CurrentValue;
		$this->quote_business_id->CurrentValue = NULL;
		$this->quote_business_id->OldValue = $this->quote_business_id->CurrentValue;
		$this->quote_service_id->CurrentValue = NULL;
		$this->quote_service_id->OldValue = $this->quote_service_id->CurrentValue;
		$this->quote_issue_date->CurrentValue = NULL;
		$this->quote_issue_date->OldValue = $this->quote_issue_date->CurrentValue;
		$this->quote_due_date->CurrentValue = NULL;
		$this->quote_due_date->OldValue = $this->quote_due_date->CurrentValue;
		$this->quote_amount->CurrentValue = NULL;
		$this->quote_amount->OldValue = $this->quote_amount->CurrentValue;
		$this->quote_content->CurrentValue = NULL;
		$this->quote_content->OldValue = $this->quote_content->CurrentValue;
		$this->quote_comments->CurrentValue = NULL;
		$this->quote_comments->OldValue = $this->quote_comments->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'quote_branch_id' first before field var 'x_quote_branch_id'
		$val = $CurrentForm->hasValue("quote_branch_id") ? $CurrentForm->getValue("quote_branch_id") : $CurrentForm->getValue("x_quote_branch_id");
		if (!$this->quote_branch_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->quote_branch_id->Visible = FALSE; // Disable update for API request
			else
				$this->quote_branch_id->setFormValue($val);
		}

		// Check field name 'quote_business_id' first before field var 'x_quote_business_id'
		$val = $CurrentForm->hasValue("quote_business_id") ? $CurrentForm->getValue("quote_business_id") : $CurrentForm->getValue("x_quote_business_id");
		if (!$this->quote_business_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->quote_business_id->Visible = FALSE; // Disable update for API request
			else
				$this->quote_business_id->setFormValue($val);
		}

		// Check field name 'quote_service_id' first before field var 'x_quote_service_id'
		$val = $CurrentForm->hasValue("quote_service_id") ? $CurrentForm->getValue("quote_service_id") : $CurrentForm->getValue("x_quote_service_id");
		if (!$this->quote_service_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->quote_service_id->Visible = FALSE; // Disable update for API request
			else
				$this->quote_service_id->setFormValue($val);
		}

		// Check field name 'quote_issue_date' first before field var 'x_quote_issue_date'
		$val = $CurrentForm->hasValue("quote_issue_date") ? $CurrentForm->getValue("quote_issue_date") : $CurrentForm->getValue("x_quote_issue_date");
		if (!$this->quote_issue_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->quote_issue_date->Visible = FALSE; // Disable update for API request
			else
				$this->quote_issue_date->setFormValue($val);
			$this->quote_issue_date->CurrentValue = UnFormatDateTime($this->quote_issue_date->CurrentValue, 0);
		}

		// Check field name 'quote_due_date' first before field var 'x_quote_due_date'
		$val = $CurrentForm->hasValue("quote_due_date") ? $CurrentForm->getValue("quote_due_date") : $CurrentForm->getValue("x_quote_due_date");
		if (!$this->quote_due_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->quote_due_date->Visible = FALSE; // Disable update for API request
			else
				$this->quote_due_date->setFormValue($val);
			$this->quote_due_date->CurrentValue = UnFormatDateTime($this->quote_due_date->CurrentValue, 0);
		}

		// Check field name 'quote_amount' first before field var 'x_quote_amount'
		$val = $CurrentForm->hasValue("quote_amount") ? $CurrentForm->getValue("quote_amount") : $CurrentForm->getValue("x_quote_amount");
		if (!$this->quote_amount->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->quote_amount->Visible = FALSE; // Disable update for API request
			else
				$this->quote_amount->setFormValue($val);
		}

		// Check field name 'quote_content' first before field var 'x_quote_content'
		$val = $CurrentForm->hasValue("quote_content") ? $CurrentForm->getValue("quote_content") : $CurrentForm->getValue("x_quote_content");
		if (!$this->quote_content->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->quote_content->Visible = FALSE; // Disable update for API request
			else
				$this->quote_content->setFormValue($val);
		}

		// Check field name 'quote_comments' first before field var 'x_quote_comments'
		$val = $CurrentForm->hasValue("quote_comments") ? $CurrentForm->getValue("quote_comments") : $CurrentForm->getValue("x_quote_comments");
		if (!$this->quote_comments->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->quote_comments->Visible = FALSE; // Disable update for API request
			else
				$this->quote_comments->setFormValue($val);
		}

		// Check field name 'quote_id' first before field var 'x_quote_id'
		$val = $CurrentForm->hasValue("quote_id") ? $CurrentForm->getValue("quote_id") : $CurrentForm->getValue("x_quote_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->quote_branch_id->CurrentValue = $this->quote_branch_id->FormValue;
		$this->quote_business_id->CurrentValue = $this->quote_business_id->FormValue;
		$this->quote_service_id->CurrentValue = $this->quote_service_id->FormValue;
		$this->quote_issue_date->CurrentValue = $this->quote_issue_date->FormValue;
		$this->quote_issue_date->CurrentValue = UnFormatDateTime($this->quote_issue_date->CurrentValue, 0);
		$this->quote_due_date->CurrentValue = $this->quote_due_date->FormValue;
		$this->quote_due_date->CurrentValue = UnFormatDateTime($this->quote_due_date->CurrentValue, 0);
		$this->quote_amount->CurrentValue = $this->quote_amount->FormValue;
		$this->quote_content->CurrentValue = $this->quote_content->FormValue;
		$this->quote_comments->CurrentValue = $this->quote_comments->FormValue;
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
		$this->quote_id->setDbValue($row['quote_id']);
		$this->quote_branch_id->setDbValue($row['quote_branch_id']);
		$this->quote_business_id->setDbValue($row['quote_business_id']);
		$this->quote_service_id->setDbValue($row['quote_service_id']);
		$this->quote_issue_date->setDbValue($row['quote_issue_date']);
		$this->quote_due_date->setDbValue($row['quote_due_date']);
		$this->quote_amount->setDbValue($row['quote_amount']);
		$this->quote_content->setDbValue($row['quote_content']);
		$this->quote_comments->setDbValue($row['quote_comments']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['quote_id'] = $this->quote_id->CurrentValue;
		$row['quote_branch_id'] = $this->quote_branch_id->CurrentValue;
		$row['quote_business_id'] = $this->quote_business_id->CurrentValue;
		$row['quote_service_id'] = $this->quote_service_id->CurrentValue;
		$row['quote_issue_date'] = $this->quote_issue_date->CurrentValue;
		$row['quote_due_date'] = $this->quote_due_date->CurrentValue;
		$row['quote_amount'] = $this->quote_amount->CurrentValue;
		$row['quote_content'] = $this->quote_content->CurrentValue;
		$row['quote_comments'] = $this->quote_comments->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("quote_id")) != "")
			$this->quote_id->OldValue = $this->getKey("quote_id"); // quote_id
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
		// quote_id
		// quote_branch_id
		// quote_business_id
		// quote_service_id
		// quote_issue_date
		// quote_due_date
		// quote_amount
		// quote_content
		// quote_comments

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// quote_id
			$this->quote_id->ViewValue = $this->quote_id->CurrentValue;
			$this->quote_id->ViewCustomAttributes = "";

			// quote_branch_id
			$this->quote_branch_id->ViewValue = $this->quote_branch_id->CurrentValue;
			$this->quote_branch_id->ViewValue = FormatNumber($this->quote_branch_id->ViewValue, 0, -2, -2, -2);
			$this->quote_branch_id->ViewCustomAttributes = "";

			// quote_business_id
			$this->quote_business_id->ViewValue = $this->quote_business_id->CurrentValue;
			$this->quote_business_id->ViewValue = FormatNumber($this->quote_business_id->ViewValue, 0, -2, -2, -2);
			$this->quote_business_id->ViewCustomAttributes = "";

			// quote_service_id
			$this->quote_service_id->ViewValue = $this->quote_service_id->CurrentValue;
			$this->quote_service_id->ViewValue = FormatNumber($this->quote_service_id->ViewValue, 0, -2, -2, -2);
			$this->quote_service_id->ViewCustomAttributes = "";

			// quote_issue_date
			$this->quote_issue_date->ViewValue = $this->quote_issue_date->CurrentValue;
			$this->quote_issue_date->ViewValue = FormatDateTime($this->quote_issue_date->ViewValue, 0);
			$this->quote_issue_date->ViewCustomAttributes = "";

			// quote_due_date
			$this->quote_due_date->ViewValue = $this->quote_due_date->CurrentValue;
			$this->quote_due_date->ViewValue = FormatDateTime($this->quote_due_date->ViewValue, 0);
			$this->quote_due_date->ViewCustomAttributes = "";

			// quote_amount
			$this->quote_amount->ViewValue = $this->quote_amount->CurrentValue;
			$this->quote_amount->ViewValue = FormatNumber($this->quote_amount->ViewValue, 0, -2, -2, -2);
			$this->quote_amount->ViewCustomAttributes = "";

			// quote_content
			$this->quote_content->ViewValue = $this->quote_content->CurrentValue;
			$this->quote_content->ViewCustomAttributes = "";

			// quote_comments
			$this->quote_comments->ViewValue = $this->quote_comments->CurrentValue;
			$this->quote_comments->ViewCustomAttributes = "";

			// quote_branch_id
			$this->quote_branch_id->LinkCustomAttributes = "";
			$this->quote_branch_id->HrefValue = "";
			$this->quote_branch_id->TooltipValue = "";

			// quote_business_id
			$this->quote_business_id->LinkCustomAttributes = "";
			$this->quote_business_id->HrefValue = "";
			$this->quote_business_id->TooltipValue = "";

			// quote_service_id
			$this->quote_service_id->LinkCustomAttributes = "";
			$this->quote_service_id->HrefValue = "";
			$this->quote_service_id->TooltipValue = "";

			// quote_issue_date
			$this->quote_issue_date->LinkCustomAttributes = "";
			$this->quote_issue_date->HrefValue = "";
			$this->quote_issue_date->TooltipValue = "";

			// quote_due_date
			$this->quote_due_date->LinkCustomAttributes = "";
			$this->quote_due_date->HrefValue = "";
			$this->quote_due_date->TooltipValue = "";

			// quote_amount
			$this->quote_amount->LinkCustomAttributes = "";
			$this->quote_amount->HrefValue = "";
			$this->quote_amount->TooltipValue = "";

			// quote_content
			$this->quote_content->LinkCustomAttributes = "";
			$this->quote_content->HrefValue = "";
			$this->quote_content->TooltipValue = "";

			// quote_comments
			$this->quote_comments->LinkCustomAttributes = "";
			$this->quote_comments->HrefValue = "";
			$this->quote_comments->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// quote_branch_id
			$this->quote_branch_id->EditAttrs["class"] = "form-control";
			$this->quote_branch_id->EditCustomAttributes = "";
			$this->quote_branch_id->EditValue = HtmlEncode($this->quote_branch_id->CurrentValue);
			$this->quote_branch_id->PlaceHolder = RemoveHtml($this->quote_branch_id->caption());

			// quote_business_id
			$this->quote_business_id->EditAttrs["class"] = "form-control";
			$this->quote_business_id->EditCustomAttributes = "";
			$this->quote_business_id->EditValue = HtmlEncode($this->quote_business_id->CurrentValue);
			$this->quote_business_id->PlaceHolder = RemoveHtml($this->quote_business_id->caption());

			// quote_service_id
			$this->quote_service_id->EditAttrs["class"] = "form-control";
			$this->quote_service_id->EditCustomAttributes = "";
			$this->quote_service_id->EditValue = HtmlEncode($this->quote_service_id->CurrentValue);
			$this->quote_service_id->PlaceHolder = RemoveHtml($this->quote_service_id->caption());

			// quote_issue_date
			$this->quote_issue_date->EditAttrs["class"] = "form-control";
			$this->quote_issue_date->EditCustomAttributes = "";
			$this->quote_issue_date->EditValue = HtmlEncode(FormatDateTime($this->quote_issue_date->CurrentValue, 8));
			$this->quote_issue_date->PlaceHolder = RemoveHtml($this->quote_issue_date->caption());

			// quote_due_date
			$this->quote_due_date->EditAttrs["class"] = "form-control";
			$this->quote_due_date->EditCustomAttributes = "";
			$this->quote_due_date->EditValue = HtmlEncode(FormatDateTime($this->quote_due_date->CurrentValue, 8));
			$this->quote_due_date->PlaceHolder = RemoveHtml($this->quote_due_date->caption());

			// quote_amount
			$this->quote_amount->EditAttrs["class"] = "form-control";
			$this->quote_amount->EditCustomAttributes = "";
			$this->quote_amount->EditValue = HtmlEncode($this->quote_amount->CurrentValue);
			$this->quote_amount->PlaceHolder = RemoveHtml($this->quote_amount->caption());

			// quote_content
			$this->quote_content->EditAttrs["class"] = "form-control";
			$this->quote_content->EditCustomAttributes = "";
			$this->quote_content->EditValue = HtmlEncode($this->quote_content->CurrentValue);
			$this->quote_content->PlaceHolder = RemoveHtml($this->quote_content->caption());

			// quote_comments
			$this->quote_comments->EditAttrs["class"] = "form-control";
			$this->quote_comments->EditCustomAttributes = "";
			$this->quote_comments->EditValue = HtmlEncode($this->quote_comments->CurrentValue);
			$this->quote_comments->PlaceHolder = RemoveHtml($this->quote_comments->caption());

			// Add refer script
			// quote_branch_id

			$this->quote_branch_id->LinkCustomAttributes = "";
			$this->quote_branch_id->HrefValue = "";

			// quote_business_id
			$this->quote_business_id->LinkCustomAttributes = "";
			$this->quote_business_id->HrefValue = "";

			// quote_service_id
			$this->quote_service_id->LinkCustomAttributes = "";
			$this->quote_service_id->HrefValue = "";

			// quote_issue_date
			$this->quote_issue_date->LinkCustomAttributes = "";
			$this->quote_issue_date->HrefValue = "";

			// quote_due_date
			$this->quote_due_date->LinkCustomAttributes = "";
			$this->quote_due_date->HrefValue = "";

			// quote_amount
			$this->quote_amount->LinkCustomAttributes = "";
			$this->quote_amount->HrefValue = "";

			// quote_content
			$this->quote_content->LinkCustomAttributes = "";
			$this->quote_content->HrefValue = "";

			// quote_comments
			$this->quote_comments->LinkCustomAttributes = "";
			$this->quote_comments->HrefValue = "";
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
		if ($this->quote_branch_id->Required) {
			if (!$this->quote_branch_id->IsDetailKey && $this->quote_branch_id->FormValue != NULL && $this->quote_branch_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->quote_branch_id->caption(), $this->quote_branch_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->quote_branch_id->FormValue)) {
			AddMessage($FormError, $this->quote_branch_id->errorMessage());
		}
		if ($this->quote_business_id->Required) {
			if (!$this->quote_business_id->IsDetailKey && $this->quote_business_id->FormValue != NULL && $this->quote_business_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->quote_business_id->caption(), $this->quote_business_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->quote_business_id->FormValue)) {
			AddMessage($FormError, $this->quote_business_id->errorMessage());
		}
		if ($this->quote_service_id->Required) {
			if (!$this->quote_service_id->IsDetailKey && $this->quote_service_id->FormValue != NULL && $this->quote_service_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->quote_service_id->caption(), $this->quote_service_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->quote_service_id->FormValue)) {
			AddMessage($FormError, $this->quote_service_id->errorMessage());
		}
		if ($this->quote_issue_date->Required) {
			if (!$this->quote_issue_date->IsDetailKey && $this->quote_issue_date->FormValue != NULL && $this->quote_issue_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->quote_issue_date->caption(), $this->quote_issue_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->quote_issue_date->FormValue)) {
			AddMessage($FormError, $this->quote_issue_date->errorMessage());
		}
		if ($this->quote_due_date->Required) {
			if (!$this->quote_due_date->IsDetailKey && $this->quote_due_date->FormValue != NULL && $this->quote_due_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->quote_due_date->caption(), $this->quote_due_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->quote_due_date->FormValue)) {
			AddMessage($FormError, $this->quote_due_date->errorMessage());
		}
		if ($this->quote_amount->Required) {
			if (!$this->quote_amount->IsDetailKey && $this->quote_amount->FormValue != NULL && $this->quote_amount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->quote_amount->caption(), $this->quote_amount->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->quote_amount->FormValue)) {
			AddMessage($FormError, $this->quote_amount->errorMessage());
		}
		if ($this->quote_content->Required) {
			if (!$this->quote_content->IsDetailKey && $this->quote_content->FormValue != NULL && $this->quote_content->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->quote_content->caption(), $this->quote_content->RequiredErrorMessage));
			}
		}
		if ($this->quote_comments->Required) {
			if (!$this->quote_comments->IsDetailKey && $this->quote_comments->FormValue != NULL && $this->quote_comments->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->quote_comments->caption(), $this->quote_comments->RequiredErrorMessage));
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

		// quote_branch_id
		$this->quote_branch_id->setDbValueDef($rsnew, $this->quote_branch_id->CurrentValue, 0, FALSE);

		// quote_business_id
		$this->quote_business_id->setDbValueDef($rsnew, $this->quote_business_id->CurrentValue, 0, FALSE);

		// quote_service_id
		$this->quote_service_id->setDbValueDef($rsnew, $this->quote_service_id->CurrentValue, 0, FALSE);

		// quote_issue_date
		$this->quote_issue_date->setDbValueDef($rsnew, UnFormatDateTime($this->quote_issue_date->CurrentValue, 0), CurrentDate(), FALSE);

		// quote_due_date
		$this->quote_due_date->setDbValueDef($rsnew, UnFormatDateTime($this->quote_due_date->CurrentValue, 0), CurrentDate(), FALSE);

		// quote_amount
		$this->quote_amount->setDbValueDef($rsnew, $this->quote_amount->CurrentValue, 0, FALSE);

		// quote_content
		$this->quote_content->setDbValueDef($rsnew, $this->quote_content->CurrentValue, "", FALSE);

		// quote_comments
		$this->quote_comments->setDbValueDef($rsnew, $this->quote_comments->CurrentValue, "", FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("quotationlist.php"), "", $this->TableVar, TRUE);
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