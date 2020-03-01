<?php
namespace PHPMaker2020\project1;

/**
 * Page class
 */
class invoices_add extends invoices
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{5525D2B6-89E2-4D25-84CF-86BD784D9909}";

	// Table name
	public $TableName = 'invoices';

	// Page object name
	public $PageObjName = "invoices_add";

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

		// Table object (invoices)
		if (!isset($GLOBALS["invoices"]) || get_class($GLOBALS["invoices"]) == PROJECT_NAMESPACE . "invoices") {
			$GLOBALS["invoices"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["invoices"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'invoices');

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
		global $invoices;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($invoices);
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
					if ($pageName == "invoicesview.php")
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
			$key .= @$ar['invoice_id'];
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
			$this->invoice_id->Visible = FALSE;
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
		$this->invoice_id->Visible = FALSE;
		$this->invoice_branch_id->setVisibility();
		$this->invoice_business_id->setVisibility();
		$this->invoice_service_id->setVisibility();
		$this->invoice_amount->setVisibility();
		$this->invoice_issue_date->setVisibility();
		$this->invoice_due_date->setVisibility();
		$this->invoice_status->setVisibility();
		$this->invoice_collected_amount->setVisibility();
		$this->invoice_remaining_amount->setVisibility();
		$this->invoice_collection_date->setVisibility();
		$this->invoice_content->setVisibility();
		$this->invoice_comments->setVisibility();
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
			if (Get("invoice_id") !== NULL) {
				$this->invoice_id->setQueryStringValue(Get("invoice_id"));
				$this->setKey("invoice_id", $this->invoice_id->CurrentValue); // Set up key
			} else {
				$this->setKey("invoice_id", ""); // Clear key
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
					$this->terminate("invoiceslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "invoiceslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "invoicesview.php")
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
		$this->invoice_id->CurrentValue = NULL;
		$this->invoice_id->OldValue = $this->invoice_id->CurrentValue;
		$this->invoice_branch_id->CurrentValue = NULL;
		$this->invoice_branch_id->OldValue = $this->invoice_branch_id->CurrentValue;
		$this->invoice_business_id->CurrentValue = NULL;
		$this->invoice_business_id->OldValue = $this->invoice_business_id->CurrentValue;
		$this->invoice_service_id->CurrentValue = NULL;
		$this->invoice_service_id->OldValue = $this->invoice_service_id->CurrentValue;
		$this->invoice_amount->CurrentValue = NULL;
		$this->invoice_amount->OldValue = $this->invoice_amount->CurrentValue;
		$this->invoice_issue_date->CurrentValue = NULL;
		$this->invoice_issue_date->OldValue = $this->invoice_issue_date->CurrentValue;
		$this->invoice_due_date->CurrentValue = NULL;
		$this->invoice_due_date->OldValue = $this->invoice_due_date->CurrentValue;
		$this->invoice_status->CurrentValue = NULL;
		$this->invoice_status->OldValue = $this->invoice_status->CurrentValue;
		$this->invoice_collected_amount->CurrentValue = NULL;
		$this->invoice_collected_amount->OldValue = $this->invoice_collected_amount->CurrentValue;
		$this->invoice_remaining_amount->CurrentValue = NULL;
		$this->invoice_remaining_amount->OldValue = $this->invoice_remaining_amount->CurrentValue;
		$this->invoice_collection_date->CurrentValue = NULL;
		$this->invoice_collection_date->OldValue = $this->invoice_collection_date->CurrentValue;
		$this->invoice_content->CurrentValue = NULL;
		$this->invoice_content->OldValue = $this->invoice_content->CurrentValue;
		$this->invoice_comments->CurrentValue = NULL;
		$this->invoice_comments->OldValue = $this->invoice_comments->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'invoice_branch_id' first before field var 'x_invoice_branch_id'
		$val = $CurrentForm->hasValue("invoice_branch_id") ? $CurrentForm->getValue("invoice_branch_id") : $CurrentForm->getValue("x_invoice_branch_id");
		if (!$this->invoice_branch_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->invoice_branch_id->Visible = FALSE; // Disable update for API request
			else
				$this->invoice_branch_id->setFormValue($val);
		}

		// Check field name 'invoice_business_id' first before field var 'x_invoice_business_id'
		$val = $CurrentForm->hasValue("invoice_business_id") ? $CurrentForm->getValue("invoice_business_id") : $CurrentForm->getValue("x_invoice_business_id");
		if (!$this->invoice_business_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->invoice_business_id->Visible = FALSE; // Disable update for API request
			else
				$this->invoice_business_id->setFormValue($val);
		}

		// Check field name 'invoice_service_id' first before field var 'x_invoice_service_id'
		$val = $CurrentForm->hasValue("invoice_service_id") ? $CurrentForm->getValue("invoice_service_id") : $CurrentForm->getValue("x_invoice_service_id");
		if (!$this->invoice_service_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->invoice_service_id->Visible = FALSE; // Disable update for API request
			else
				$this->invoice_service_id->setFormValue($val);
		}

		// Check field name 'invoice_amount' first before field var 'x_invoice_amount'
		$val = $CurrentForm->hasValue("invoice_amount") ? $CurrentForm->getValue("invoice_amount") : $CurrentForm->getValue("x_invoice_amount");
		if (!$this->invoice_amount->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->invoice_amount->Visible = FALSE; // Disable update for API request
			else
				$this->invoice_amount->setFormValue($val);
		}

		// Check field name 'invoice_issue_date' first before field var 'x_invoice_issue_date'
		$val = $CurrentForm->hasValue("invoice_issue_date") ? $CurrentForm->getValue("invoice_issue_date") : $CurrentForm->getValue("x_invoice_issue_date");
		if (!$this->invoice_issue_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->invoice_issue_date->Visible = FALSE; // Disable update for API request
			else
				$this->invoice_issue_date->setFormValue($val);
			$this->invoice_issue_date->CurrentValue = UnFormatDateTime($this->invoice_issue_date->CurrentValue, 0);
		}

		// Check field name 'invoice_due_date' first before field var 'x_invoice_due_date'
		$val = $CurrentForm->hasValue("invoice_due_date") ? $CurrentForm->getValue("invoice_due_date") : $CurrentForm->getValue("x_invoice_due_date");
		if (!$this->invoice_due_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->invoice_due_date->Visible = FALSE; // Disable update for API request
			else
				$this->invoice_due_date->setFormValue($val);
			$this->invoice_due_date->CurrentValue = UnFormatDateTime($this->invoice_due_date->CurrentValue, 0);
		}

		// Check field name 'invoice_status' first before field var 'x_invoice_status'
		$val = $CurrentForm->hasValue("invoice_status") ? $CurrentForm->getValue("invoice_status") : $CurrentForm->getValue("x_invoice_status");
		if (!$this->invoice_status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->invoice_status->Visible = FALSE; // Disable update for API request
			else
				$this->invoice_status->setFormValue($val);
		}

		// Check field name 'invoice_collected_amount' first before field var 'x_invoice_collected_amount'
		$val = $CurrentForm->hasValue("invoice_collected_amount") ? $CurrentForm->getValue("invoice_collected_amount") : $CurrentForm->getValue("x_invoice_collected_amount");
		if (!$this->invoice_collected_amount->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->invoice_collected_amount->Visible = FALSE; // Disable update for API request
			else
				$this->invoice_collected_amount->setFormValue($val);
		}

		// Check field name 'invoice_remaining_amount' first before field var 'x_invoice_remaining_amount'
		$val = $CurrentForm->hasValue("invoice_remaining_amount") ? $CurrentForm->getValue("invoice_remaining_amount") : $CurrentForm->getValue("x_invoice_remaining_amount");
		if (!$this->invoice_remaining_amount->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->invoice_remaining_amount->Visible = FALSE; // Disable update for API request
			else
				$this->invoice_remaining_amount->setFormValue($val);
		}

		// Check field name 'invoice_collection_date' first before field var 'x_invoice_collection_date'
		$val = $CurrentForm->hasValue("invoice_collection_date") ? $CurrentForm->getValue("invoice_collection_date") : $CurrentForm->getValue("x_invoice_collection_date");
		if (!$this->invoice_collection_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->invoice_collection_date->Visible = FALSE; // Disable update for API request
			else
				$this->invoice_collection_date->setFormValue($val);
			$this->invoice_collection_date->CurrentValue = UnFormatDateTime($this->invoice_collection_date->CurrentValue, 0);
		}

		// Check field name 'invoice_content' first before field var 'x_invoice_content'
		$val = $CurrentForm->hasValue("invoice_content") ? $CurrentForm->getValue("invoice_content") : $CurrentForm->getValue("x_invoice_content");
		if (!$this->invoice_content->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->invoice_content->Visible = FALSE; // Disable update for API request
			else
				$this->invoice_content->setFormValue($val);
		}

		// Check field name 'invoice_comments' first before field var 'x_invoice_comments'
		$val = $CurrentForm->hasValue("invoice_comments") ? $CurrentForm->getValue("invoice_comments") : $CurrentForm->getValue("x_invoice_comments");
		if (!$this->invoice_comments->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->invoice_comments->Visible = FALSE; // Disable update for API request
			else
				$this->invoice_comments->setFormValue($val);
		}

		// Check field name 'invoice_id' first before field var 'x_invoice_id'
		$val = $CurrentForm->hasValue("invoice_id") ? $CurrentForm->getValue("invoice_id") : $CurrentForm->getValue("x_invoice_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->invoice_branch_id->CurrentValue = $this->invoice_branch_id->FormValue;
		$this->invoice_business_id->CurrentValue = $this->invoice_business_id->FormValue;
		$this->invoice_service_id->CurrentValue = $this->invoice_service_id->FormValue;
		$this->invoice_amount->CurrentValue = $this->invoice_amount->FormValue;
		$this->invoice_issue_date->CurrentValue = $this->invoice_issue_date->FormValue;
		$this->invoice_issue_date->CurrentValue = UnFormatDateTime($this->invoice_issue_date->CurrentValue, 0);
		$this->invoice_due_date->CurrentValue = $this->invoice_due_date->FormValue;
		$this->invoice_due_date->CurrentValue = UnFormatDateTime($this->invoice_due_date->CurrentValue, 0);
		$this->invoice_status->CurrentValue = $this->invoice_status->FormValue;
		$this->invoice_collected_amount->CurrentValue = $this->invoice_collected_amount->FormValue;
		$this->invoice_remaining_amount->CurrentValue = $this->invoice_remaining_amount->FormValue;
		$this->invoice_collection_date->CurrentValue = $this->invoice_collection_date->FormValue;
		$this->invoice_collection_date->CurrentValue = UnFormatDateTime($this->invoice_collection_date->CurrentValue, 0);
		$this->invoice_content->CurrentValue = $this->invoice_content->FormValue;
		$this->invoice_comments->CurrentValue = $this->invoice_comments->FormValue;
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
		$this->invoice_id->setDbValue($row['invoice_id']);
		$this->invoice_branch_id->setDbValue($row['invoice_branch_id']);
		$this->invoice_business_id->setDbValue($row['invoice_business_id']);
		$this->invoice_service_id->setDbValue($row['invoice_service_id']);
		$this->invoice_amount->setDbValue($row['invoice_amount']);
		$this->invoice_issue_date->setDbValue($row['invoice_issue_date']);
		$this->invoice_due_date->setDbValue($row['invoice_due_date']);
		$this->invoice_status->setDbValue($row['invoice_status']);
		$this->invoice_collected_amount->setDbValue($row['invoice_collected_amount']);
		$this->invoice_remaining_amount->setDbValue($row['invoice_remaining_amount']);
		$this->invoice_collection_date->setDbValue($row['invoice_collection_date']);
		$this->invoice_content->setDbValue($row['invoice_content']);
		$this->invoice_comments->setDbValue($row['invoice_comments']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['invoice_id'] = $this->invoice_id->CurrentValue;
		$row['invoice_branch_id'] = $this->invoice_branch_id->CurrentValue;
		$row['invoice_business_id'] = $this->invoice_business_id->CurrentValue;
		$row['invoice_service_id'] = $this->invoice_service_id->CurrentValue;
		$row['invoice_amount'] = $this->invoice_amount->CurrentValue;
		$row['invoice_issue_date'] = $this->invoice_issue_date->CurrentValue;
		$row['invoice_due_date'] = $this->invoice_due_date->CurrentValue;
		$row['invoice_status'] = $this->invoice_status->CurrentValue;
		$row['invoice_collected_amount'] = $this->invoice_collected_amount->CurrentValue;
		$row['invoice_remaining_amount'] = $this->invoice_remaining_amount->CurrentValue;
		$row['invoice_collection_date'] = $this->invoice_collection_date->CurrentValue;
		$row['invoice_content'] = $this->invoice_content->CurrentValue;
		$row['invoice_comments'] = $this->invoice_comments->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("invoice_id")) != "")
			$this->invoice_id->OldValue = $this->getKey("invoice_id"); // invoice_id
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
		// invoice_id
		// invoice_branch_id
		// invoice_business_id
		// invoice_service_id
		// invoice_amount
		// invoice_issue_date
		// invoice_due_date
		// invoice_status
		// invoice_collected_amount
		// invoice_remaining_amount
		// invoice_collection_date
		// invoice_content
		// invoice_comments

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// invoice_id
			$this->invoice_id->ViewValue = $this->invoice_id->CurrentValue;
			$this->invoice_id->ViewCustomAttributes = "";

			// invoice_branch_id
			$this->invoice_branch_id->ViewValue = $this->invoice_branch_id->CurrentValue;
			$this->invoice_branch_id->ViewValue = FormatNumber($this->invoice_branch_id->ViewValue, 0, -2, -2, -2);
			$this->invoice_branch_id->ViewCustomAttributes = "";

			// invoice_business_id
			$this->invoice_business_id->ViewValue = $this->invoice_business_id->CurrentValue;
			$this->invoice_business_id->ViewValue = FormatNumber($this->invoice_business_id->ViewValue, 0, -2, -2, -2);
			$this->invoice_business_id->ViewCustomAttributes = "";

			// invoice_service_id
			$this->invoice_service_id->ViewValue = $this->invoice_service_id->CurrentValue;
			$this->invoice_service_id->ViewValue = FormatNumber($this->invoice_service_id->ViewValue, 0, -2, -2, -2);
			$this->invoice_service_id->ViewCustomAttributes = "";

			// invoice_amount
			$this->invoice_amount->ViewValue = $this->invoice_amount->CurrentValue;
			$this->invoice_amount->ViewValue = FormatNumber($this->invoice_amount->ViewValue, 0, -2, -2, -2);
			$this->invoice_amount->ViewCustomAttributes = "";

			// invoice_issue_date
			$this->invoice_issue_date->ViewValue = $this->invoice_issue_date->CurrentValue;
			$this->invoice_issue_date->ViewValue = FormatDateTime($this->invoice_issue_date->ViewValue, 0);
			$this->invoice_issue_date->ViewCustomAttributes = "";

			// invoice_due_date
			$this->invoice_due_date->ViewValue = $this->invoice_due_date->CurrentValue;
			$this->invoice_due_date->ViewValue = FormatDateTime($this->invoice_due_date->ViewValue, 0);
			$this->invoice_due_date->ViewCustomAttributes = "";

			// invoice_status
			if (strval($this->invoice_status->CurrentValue) != "") {
				$this->invoice_status->ViewValue = $this->invoice_status->optionCaption($this->invoice_status->CurrentValue);
			} else {
				$this->invoice_status->ViewValue = NULL;
			}
			$this->invoice_status->ViewCustomAttributes = "";

			// invoice_collected_amount
			$this->invoice_collected_amount->ViewValue = $this->invoice_collected_amount->CurrentValue;
			$this->invoice_collected_amount->ViewValue = FormatNumber($this->invoice_collected_amount->ViewValue, 0, -2, -2, -2);
			$this->invoice_collected_amount->ViewCustomAttributes = "";

			// invoice_remaining_amount
			$this->invoice_remaining_amount->ViewValue = $this->invoice_remaining_amount->CurrentValue;
			$this->invoice_remaining_amount->ViewValue = FormatNumber($this->invoice_remaining_amount->ViewValue, 0, -2, -2, -2);
			$this->invoice_remaining_amount->ViewCustomAttributes = "";

			// invoice_collection_date
			$this->invoice_collection_date->ViewValue = $this->invoice_collection_date->CurrentValue;
			$this->invoice_collection_date->ViewValue = FormatDateTime($this->invoice_collection_date->ViewValue, 0);
			$this->invoice_collection_date->ViewCustomAttributes = "";

			// invoice_content
			$this->invoice_content->ViewValue = $this->invoice_content->CurrentValue;
			$this->invoice_content->ViewCustomAttributes = "";

			// invoice_comments
			$this->invoice_comments->ViewValue = $this->invoice_comments->CurrentValue;
			$this->invoice_comments->ViewCustomAttributes = "";

			// invoice_branch_id
			$this->invoice_branch_id->LinkCustomAttributes = "";
			$this->invoice_branch_id->HrefValue = "";
			$this->invoice_branch_id->TooltipValue = "";

			// invoice_business_id
			$this->invoice_business_id->LinkCustomAttributes = "";
			$this->invoice_business_id->HrefValue = "";
			$this->invoice_business_id->TooltipValue = "";

			// invoice_service_id
			$this->invoice_service_id->LinkCustomAttributes = "";
			$this->invoice_service_id->HrefValue = "";
			$this->invoice_service_id->TooltipValue = "";

			// invoice_amount
			$this->invoice_amount->LinkCustomAttributes = "";
			$this->invoice_amount->HrefValue = "";
			$this->invoice_amount->TooltipValue = "";

			// invoice_issue_date
			$this->invoice_issue_date->LinkCustomAttributes = "";
			$this->invoice_issue_date->HrefValue = "";
			$this->invoice_issue_date->TooltipValue = "";

			// invoice_due_date
			$this->invoice_due_date->LinkCustomAttributes = "";
			$this->invoice_due_date->HrefValue = "";
			$this->invoice_due_date->TooltipValue = "";

			// invoice_status
			$this->invoice_status->LinkCustomAttributes = "";
			$this->invoice_status->HrefValue = "";
			$this->invoice_status->TooltipValue = "";

			// invoice_collected_amount
			$this->invoice_collected_amount->LinkCustomAttributes = "";
			$this->invoice_collected_amount->HrefValue = "";
			$this->invoice_collected_amount->TooltipValue = "";

			// invoice_remaining_amount
			$this->invoice_remaining_amount->LinkCustomAttributes = "";
			$this->invoice_remaining_amount->HrefValue = "";
			$this->invoice_remaining_amount->TooltipValue = "";

			// invoice_collection_date
			$this->invoice_collection_date->LinkCustomAttributes = "";
			$this->invoice_collection_date->HrefValue = "";
			$this->invoice_collection_date->TooltipValue = "";

			// invoice_content
			$this->invoice_content->LinkCustomAttributes = "";
			$this->invoice_content->HrefValue = "";
			$this->invoice_content->TooltipValue = "";

			// invoice_comments
			$this->invoice_comments->LinkCustomAttributes = "";
			$this->invoice_comments->HrefValue = "";
			$this->invoice_comments->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// invoice_branch_id
			$this->invoice_branch_id->EditAttrs["class"] = "form-control";
			$this->invoice_branch_id->EditCustomAttributes = "";
			$this->invoice_branch_id->EditValue = HtmlEncode($this->invoice_branch_id->CurrentValue);
			$this->invoice_branch_id->PlaceHolder = RemoveHtml($this->invoice_branch_id->caption());

			// invoice_business_id
			$this->invoice_business_id->EditAttrs["class"] = "form-control";
			$this->invoice_business_id->EditCustomAttributes = "";
			$this->invoice_business_id->EditValue = HtmlEncode($this->invoice_business_id->CurrentValue);
			$this->invoice_business_id->PlaceHolder = RemoveHtml($this->invoice_business_id->caption());

			// invoice_service_id
			$this->invoice_service_id->EditAttrs["class"] = "form-control";
			$this->invoice_service_id->EditCustomAttributes = "";
			$this->invoice_service_id->EditValue = HtmlEncode($this->invoice_service_id->CurrentValue);
			$this->invoice_service_id->PlaceHolder = RemoveHtml($this->invoice_service_id->caption());

			// invoice_amount
			$this->invoice_amount->EditAttrs["class"] = "form-control";
			$this->invoice_amount->EditCustomAttributes = "";
			$this->invoice_amount->EditValue = HtmlEncode($this->invoice_amount->CurrentValue);
			$this->invoice_amount->PlaceHolder = RemoveHtml($this->invoice_amount->caption());

			// invoice_issue_date
			$this->invoice_issue_date->EditAttrs["class"] = "form-control";
			$this->invoice_issue_date->EditCustomAttributes = "";
			$this->invoice_issue_date->EditValue = HtmlEncode(FormatDateTime($this->invoice_issue_date->CurrentValue, 8));
			$this->invoice_issue_date->PlaceHolder = RemoveHtml($this->invoice_issue_date->caption());

			// invoice_due_date
			$this->invoice_due_date->EditAttrs["class"] = "form-control";
			$this->invoice_due_date->EditCustomAttributes = "";
			$this->invoice_due_date->EditValue = HtmlEncode(FormatDateTime($this->invoice_due_date->CurrentValue, 8));
			$this->invoice_due_date->PlaceHolder = RemoveHtml($this->invoice_due_date->caption());

			// invoice_status
			$this->invoice_status->EditCustomAttributes = "";
			$this->invoice_status->EditValue = $this->invoice_status->options(FALSE);

			// invoice_collected_amount
			$this->invoice_collected_amount->EditAttrs["class"] = "form-control";
			$this->invoice_collected_amount->EditCustomAttributes = "";
			$this->invoice_collected_amount->EditValue = HtmlEncode($this->invoice_collected_amount->CurrentValue);
			$this->invoice_collected_amount->PlaceHolder = RemoveHtml($this->invoice_collected_amount->caption());

			// invoice_remaining_amount
			$this->invoice_remaining_amount->EditAttrs["class"] = "form-control";
			$this->invoice_remaining_amount->EditCustomAttributes = "";
			$this->invoice_remaining_amount->EditValue = HtmlEncode($this->invoice_remaining_amount->CurrentValue);
			$this->invoice_remaining_amount->PlaceHolder = RemoveHtml($this->invoice_remaining_amount->caption());

			// invoice_collection_date
			$this->invoice_collection_date->EditAttrs["class"] = "form-control";
			$this->invoice_collection_date->EditCustomAttributes = "";
			$this->invoice_collection_date->EditValue = HtmlEncode(FormatDateTime($this->invoice_collection_date->CurrentValue, 8));
			$this->invoice_collection_date->PlaceHolder = RemoveHtml($this->invoice_collection_date->caption());

			// invoice_content
			$this->invoice_content->EditAttrs["class"] = "form-control";
			$this->invoice_content->EditCustomAttributes = "";
			$this->invoice_content->EditValue = HtmlEncode($this->invoice_content->CurrentValue);
			$this->invoice_content->PlaceHolder = RemoveHtml($this->invoice_content->caption());

			// invoice_comments
			$this->invoice_comments->EditAttrs["class"] = "form-control";
			$this->invoice_comments->EditCustomAttributes = "";
			$this->invoice_comments->EditValue = HtmlEncode($this->invoice_comments->CurrentValue);
			$this->invoice_comments->PlaceHolder = RemoveHtml($this->invoice_comments->caption());

			// Add refer script
			// invoice_branch_id

			$this->invoice_branch_id->LinkCustomAttributes = "";
			$this->invoice_branch_id->HrefValue = "";

			// invoice_business_id
			$this->invoice_business_id->LinkCustomAttributes = "";
			$this->invoice_business_id->HrefValue = "";

			// invoice_service_id
			$this->invoice_service_id->LinkCustomAttributes = "";
			$this->invoice_service_id->HrefValue = "";

			// invoice_amount
			$this->invoice_amount->LinkCustomAttributes = "";
			$this->invoice_amount->HrefValue = "";

			// invoice_issue_date
			$this->invoice_issue_date->LinkCustomAttributes = "";
			$this->invoice_issue_date->HrefValue = "";

			// invoice_due_date
			$this->invoice_due_date->LinkCustomAttributes = "";
			$this->invoice_due_date->HrefValue = "";

			// invoice_status
			$this->invoice_status->LinkCustomAttributes = "";
			$this->invoice_status->HrefValue = "";

			// invoice_collected_amount
			$this->invoice_collected_amount->LinkCustomAttributes = "";
			$this->invoice_collected_amount->HrefValue = "";

			// invoice_remaining_amount
			$this->invoice_remaining_amount->LinkCustomAttributes = "";
			$this->invoice_remaining_amount->HrefValue = "";

			// invoice_collection_date
			$this->invoice_collection_date->LinkCustomAttributes = "";
			$this->invoice_collection_date->HrefValue = "";

			// invoice_content
			$this->invoice_content->LinkCustomAttributes = "";
			$this->invoice_content->HrefValue = "";

			// invoice_comments
			$this->invoice_comments->LinkCustomAttributes = "";
			$this->invoice_comments->HrefValue = "";
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
		if ($this->invoice_branch_id->Required) {
			if (!$this->invoice_branch_id->IsDetailKey && $this->invoice_branch_id->FormValue != NULL && $this->invoice_branch_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->invoice_branch_id->caption(), $this->invoice_branch_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->invoice_branch_id->FormValue)) {
			AddMessage($FormError, $this->invoice_branch_id->errorMessage());
		}
		if ($this->invoice_business_id->Required) {
			if (!$this->invoice_business_id->IsDetailKey && $this->invoice_business_id->FormValue != NULL && $this->invoice_business_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->invoice_business_id->caption(), $this->invoice_business_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->invoice_business_id->FormValue)) {
			AddMessage($FormError, $this->invoice_business_id->errorMessage());
		}
		if ($this->invoice_service_id->Required) {
			if (!$this->invoice_service_id->IsDetailKey && $this->invoice_service_id->FormValue != NULL && $this->invoice_service_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->invoice_service_id->caption(), $this->invoice_service_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->invoice_service_id->FormValue)) {
			AddMessage($FormError, $this->invoice_service_id->errorMessage());
		}
		if ($this->invoice_amount->Required) {
			if (!$this->invoice_amount->IsDetailKey && $this->invoice_amount->FormValue != NULL && $this->invoice_amount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->invoice_amount->caption(), $this->invoice_amount->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->invoice_amount->FormValue)) {
			AddMessage($FormError, $this->invoice_amount->errorMessage());
		}
		if ($this->invoice_issue_date->Required) {
			if (!$this->invoice_issue_date->IsDetailKey && $this->invoice_issue_date->FormValue != NULL && $this->invoice_issue_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->invoice_issue_date->caption(), $this->invoice_issue_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->invoice_issue_date->FormValue)) {
			AddMessage($FormError, $this->invoice_issue_date->errorMessage());
		}
		if ($this->invoice_due_date->Required) {
			if (!$this->invoice_due_date->IsDetailKey && $this->invoice_due_date->FormValue != NULL && $this->invoice_due_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->invoice_due_date->caption(), $this->invoice_due_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->invoice_due_date->FormValue)) {
			AddMessage($FormError, $this->invoice_due_date->errorMessage());
		}
		if ($this->invoice_status->Required) {
			if ($this->invoice_status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->invoice_status->caption(), $this->invoice_status->RequiredErrorMessage));
			}
		}
		if ($this->invoice_collected_amount->Required) {
			if (!$this->invoice_collected_amount->IsDetailKey && $this->invoice_collected_amount->FormValue != NULL && $this->invoice_collected_amount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->invoice_collected_amount->caption(), $this->invoice_collected_amount->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->invoice_collected_amount->FormValue)) {
			AddMessage($FormError, $this->invoice_collected_amount->errorMessage());
		}
		if ($this->invoice_remaining_amount->Required) {
			if (!$this->invoice_remaining_amount->IsDetailKey && $this->invoice_remaining_amount->FormValue != NULL && $this->invoice_remaining_amount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->invoice_remaining_amount->caption(), $this->invoice_remaining_amount->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->invoice_remaining_amount->FormValue)) {
			AddMessage($FormError, $this->invoice_remaining_amount->errorMessage());
		}
		if ($this->invoice_collection_date->Required) {
			if (!$this->invoice_collection_date->IsDetailKey && $this->invoice_collection_date->FormValue != NULL && $this->invoice_collection_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->invoice_collection_date->caption(), $this->invoice_collection_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->invoice_collection_date->FormValue)) {
			AddMessage($FormError, $this->invoice_collection_date->errorMessage());
		}
		if ($this->invoice_content->Required) {
			if (!$this->invoice_content->IsDetailKey && $this->invoice_content->FormValue != NULL && $this->invoice_content->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->invoice_content->caption(), $this->invoice_content->RequiredErrorMessage));
			}
		}
		if ($this->invoice_comments->Required) {
			if (!$this->invoice_comments->IsDetailKey && $this->invoice_comments->FormValue != NULL && $this->invoice_comments->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->invoice_comments->caption(), $this->invoice_comments->RequiredErrorMessage));
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

		// invoice_branch_id
		$this->invoice_branch_id->setDbValueDef($rsnew, $this->invoice_branch_id->CurrentValue, 0, FALSE);

		// invoice_business_id
		$this->invoice_business_id->setDbValueDef($rsnew, $this->invoice_business_id->CurrentValue, 0, FALSE);

		// invoice_service_id
		$this->invoice_service_id->setDbValueDef($rsnew, $this->invoice_service_id->CurrentValue, 0, FALSE);

		// invoice_amount
		$this->invoice_amount->setDbValueDef($rsnew, $this->invoice_amount->CurrentValue, 0, FALSE);

		// invoice_issue_date
		$this->invoice_issue_date->setDbValueDef($rsnew, UnFormatDateTime($this->invoice_issue_date->CurrentValue, 0), CurrentDate(), FALSE);

		// invoice_due_date
		$this->invoice_due_date->setDbValueDef($rsnew, UnFormatDateTime($this->invoice_due_date->CurrentValue, 0), CurrentDate(), FALSE);

		// invoice_status
		$this->invoice_status->setDbValueDef($rsnew, $this->invoice_status->CurrentValue, "", FALSE);

		// invoice_collected_amount
		$this->invoice_collected_amount->setDbValueDef($rsnew, $this->invoice_collected_amount->CurrentValue, 0, FALSE);

		// invoice_remaining_amount
		$this->invoice_remaining_amount->setDbValueDef($rsnew, $this->invoice_remaining_amount->CurrentValue, 0, FALSE);

		// invoice_collection_date
		$this->invoice_collection_date->setDbValueDef($rsnew, UnFormatDateTime($this->invoice_collection_date->CurrentValue, 0), CurrentDate(), FALSE);

		// invoice_content
		$this->invoice_content->setDbValueDef($rsnew, $this->invoice_content->CurrentValue, "", FALSE);

		// invoice_comments
		$this->invoice_comments->setDbValueDef($rsnew, $this->invoice_comments->CurrentValue, "", FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("invoiceslist.php"), "", $this->TableVar, TRUE);
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
				case "x_invoice_status":
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