<?php
namespace PHPMaker2020\project1;

/**
 * Page class
 */
class followup_edit extends followup
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{5525D2B6-89E2-4D25-84CF-86BD784D9909}";

	// Table name
	public $TableName = 'followup';

	// Page object name
	public $PageObjName = "followup_edit";

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

		// Table object (followup)
		if (!isset($GLOBALS["followup"]) || get_class($GLOBALS["followup"]) == PROJECT_NAMESPACE . "followup") {
			$GLOBALS["followup"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["followup"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'followup');

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
		global $followup;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($followup);
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
					if ($pageName == "followupview.php")
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
			$key .= @$ar['followup_id'];
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
			$this->followup_id->Visible = FALSE;
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
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->followup_id->setVisibility();
		$this->followup_branch_id->setVisibility();
		$this->followup_business_id->setVisibility();
		$this->followup_by_emp_id->setVisibility();
		$this->followup_no_id->setVisibility();
		$this->followup_date->setVisibility();
		$this->followup_comments->setVisibility();
		$this->followup_response->setVisibility();
		$this->nxt_FU_date->setVisibility();
		$this->nxt_FU_plans->setVisibility();
		$this->current_FU_status->setVisibility();
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
			if ($CurrentForm->hasValue("x_followup_id")) {
				$this->followup_id->setFormValue($CurrentForm->getValue("x_followup_id"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("followup_id") !== NULL) {
				$this->followup_id->setQueryStringValue(Get("followup_id"));
				$loadByQuery = TRUE;
			} else {
				$this->followup_id->CurrentValue = NULL;
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
					$this->terminate("followuplist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "followuplist.php")
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

		// Check field name 'followup_id' first before field var 'x_followup_id'
		$val = $CurrentForm->hasValue("followup_id") ? $CurrentForm->getValue("followup_id") : $CurrentForm->getValue("x_followup_id");
		if (!$this->followup_id->IsDetailKey)
			$this->followup_id->setFormValue($val);

		// Check field name 'followup_branch_id' first before field var 'x_followup_branch_id'
		$val = $CurrentForm->hasValue("followup_branch_id") ? $CurrentForm->getValue("followup_branch_id") : $CurrentForm->getValue("x_followup_branch_id");
		if (!$this->followup_branch_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->followup_branch_id->Visible = FALSE; // Disable update for API request
			else
				$this->followup_branch_id->setFormValue($val);
		}

		// Check field name 'followup_business_id' first before field var 'x_followup_business_id'
		$val = $CurrentForm->hasValue("followup_business_id") ? $CurrentForm->getValue("followup_business_id") : $CurrentForm->getValue("x_followup_business_id");
		if (!$this->followup_business_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->followup_business_id->Visible = FALSE; // Disable update for API request
			else
				$this->followup_business_id->setFormValue($val);
		}

		// Check field name 'followup_by_emp_id' first before field var 'x_followup_by_emp_id'
		$val = $CurrentForm->hasValue("followup_by_emp_id") ? $CurrentForm->getValue("followup_by_emp_id") : $CurrentForm->getValue("x_followup_by_emp_id");
		if (!$this->followup_by_emp_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->followup_by_emp_id->Visible = FALSE; // Disable update for API request
			else
				$this->followup_by_emp_id->setFormValue($val);
		}

		// Check field name 'followup_no_id' first before field var 'x_followup_no_id'
		$val = $CurrentForm->hasValue("followup_no_id") ? $CurrentForm->getValue("followup_no_id") : $CurrentForm->getValue("x_followup_no_id");
		if (!$this->followup_no_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->followup_no_id->Visible = FALSE; // Disable update for API request
			else
				$this->followup_no_id->setFormValue($val);
		}

		// Check field name 'followup_date' first before field var 'x_followup_date'
		$val = $CurrentForm->hasValue("followup_date") ? $CurrentForm->getValue("followup_date") : $CurrentForm->getValue("x_followup_date");
		if (!$this->followup_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->followup_date->Visible = FALSE; // Disable update for API request
			else
				$this->followup_date->setFormValue($val);
			$this->followup_date->CurrentValue = UnFormatDateTime($this->followup_date->CurrentValue, 0);
		}

		// Check field name 'followup_comments' first before field var 'x_followup_comments'
		$val = $CurrentForm->hasValue("followup_comments") ? $CurrentForm->getValue("followup_comments") : $CurrentForm->getValue("x_followup_comments");
		if (!$this->followup_comments->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->followup_comments->Visible = FALSE; // Disable update for API request
			else
				$this->followup_comments->setFormValue($val);
		}

		// Check field name 'followup_response' first before field var 'x_followup_response'
		$val = $CurrentForm->hasValue("followup_response") ? $CurrentForm->getValue("followup_response") : $CurrentForm->getValue("x_followup_response");
		if (!$this->followup_response->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->followup_response->Visible = FALSE; // Disable update for API request
			else
				$this->followup_response->setFormValue($val);
		}

		// Check field name 'nxt_FU_date' first before field var 'x_nxt_FU_date'
		$val = $CurrentForm->hasValue("nxt_FU_date") ? $CurrentForm->getValue("nxt_FU_date") : $CurrentForm->getValue("x_nxt_FU_date");
		if (!$this->nxt_FU_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nxt_FU_date->Visible = FALSE; // Disable update for API request
			else
				$this->nxt_FU_date->setFormValue($val);
			$this->nxt_FU_date->CurrentValue = UnFormatDateTime($this->nxt_FU_date->CurrentValue, 0);
		}

		// Check field name 'nxt_FU_plans' first before field var 'x_nxt_FU_plans'
		$val = $CurrentForm->hasValue("nxt_FU_plans") ? $CurrentForm->getValue("nxt_FU_plans") : $CurrentForm->getValue("x_nxt_FU_plans");
		if (!$this->nxt_FU_plans->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nxt_FU_plans->Visible = FALSE; // Disable update for API request
			else
				$this->nxt_FU_plans->setFormValue($val);
		}

		// Check field name 'current_FU_status' first before field var 'x_current_FU_status'
		$val = $CurrentForm->hasValue("current_FU_status") ? $CurrentForm->getValue("current_FU_status") : $CurrentForm->getValue("x_current_FU_status");
		if (!$this->current_FU_status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->current_FU_status->Visible = FALSE; // Disable update for API request
			else
				$this->current_FU_status->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->followup_id->CurrentValue = $this->followup_id->FormValue;
		$this->followup_branch_id->CurrentValue = $this->followup_branch_id->FormValue;
		$this->followup_business_id->CurrentValue = $this->followup_business_id->FormValue;
		$this->followup_by_emp_id->CurrentValue = $this->followup_by_emp_id->FormValue;
		$this->followup_no_id->CurrentValue = $this->followup_no_id->FormValue;
		$this->followup_date->CurrentValue = $this->followup_date->FormValue;
		$this->followup_date->CurrentValue = UnFormatDateTime($this->followup_date->CurrentValue, 0);
		$this->followup_comments->CurrentValue = $this->followup_comments->FormValue;
		$this->followup_response->CurrentValue = $this->followup_response->FormValue;
		$this->nxt_FU_date->CurrentValue = $this->nxt_FU_date->FormValue;
		$this->nxt_FU_date->CurrentValue = UnFormatDateTime($this->nxt_FU_date->CurrentValue, 0);
		$this->nxt_FU_plans->CurrentValue = $this->nxt_FU_plans->FormValue;
		$this->current_FU_status->CurrentValue = $this->current_FU_status->FormValue;
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
		$this->followup_id->setDbValue($row['followup_id']);
		$this->followup_branch_id->setDbValue($row['followup_branch_id']);
		$this->followup_business_id->setDbValue($row['followup_business_id']);
		$this->followup_by_emp_id->setDbValue($row['followup_by_emp_id']);
		$this->followup_no_id->setDbValue($row['followup_no_id']);
		$this->followup_date->setDbValue($row['followup_date']);
		$this->followup_comments->setDbValue($row['followup_comments']);
		$this->followup_response->setDbValue($row['followup_response']);
		$this->nxt_FU_date->setDbValue($row['nxt_FU_date']);
		$this->nxt_FU_plans->setDbValue($row['nxt_FU_plans']);
		$this->current_FU_status->setDbValue($row['current_FU_status']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['followup_id'] = NULL;
		$row['followup_branch_id'] = NULL;
		$row['followup_business_id'] = NULL;
		$row['followup_by_emp_id'] = NULL;
		$row['followup_no_id'] = NULL;
		$row['followup_date'] = NULL;
		$row['followup_comments'] = NULL;
		$row['followup_response'] = NULL;
		$row['nxt_FU_date'] = NULL;
		$row['nxt_FU_plans'] = NULL;
		$row['current_FU_status'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("followup_id")) != "")
			$this->followup_id->OldValue = $this->getKey("followup_id"); // followup_id
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
		// followup_id
		// followup_branch_id
		// followup_business_id
		// followup_by_emp_id
		// followup_no_id
		// followup_date
		// followup_comments
		// followup_response
		// nxt_FU_date
		// nxt_FU_plans
		// current_FU_status

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// followup_id
			$this->followup_id->ViewValue = $this->followup_id->CurrentValue;
			$this->followup_id->ViewCustomAttributes = "";

			// followup_branch_id
			$this->followup_branch_id->ViewValue = $this->followup_branch_id->CurrentValue;
			$this->followup_branch_id->ViewValue = FormatNumber($this->followup_branch_id->ViewValue, 0, -2, -2, -2);
			$this->followup_branch_id->ViewCustomAttributes = "";

			// followup_business_id
			$this->followup_business_id->ViewValue = $this->followup_business_id->CurrentValue;
			$this->followup_business_id->ViewValue = FormatNumber($this->followup_business_id->ViewValue, 0, -2, -2, -2);
			$this->followup_business_id->ViewCustomAttributes = "";

			// followup_by_emp_id
			$this->followup_by_emp_id->ViewValue = $this->followup_by_emp_id->CurrentValue;
			$this->followup_by_emp_id->ViewValue = FormatNumber($this->followup_by_emp_id->ViewValue, 0, -2, -2, -2);
			$this->followup_by_emp_id->ViewCustomAttributes = "";

			// followup_no_id
			$this->followup_no_id->ViewValue = $this->followup_no_id->CurrentValue;
			$this->followup_no_id->ViewValue = FormatNumber($this->followup_no_id->ViewValue, 0, -2, -2, -2);
			$this->followup_no_id->ViewCustomAttributes = "";

			// followup_date
			$this->followup_date->ViewValue = $this->followup_date->CurrentValue;
			$this->followup_date->ViewValue = FormatDateTime($this->followup_date->ViewValue, 0);
			$this->followup_date->ViewCustomAttributes = "";

			// followup_comments
			$this->followup_comments->ViewValue = $this->followup_comments->CurrentValue;
			$this->followup_comments->ViewCustomAttributes = "";

			// followup_response
			if (strval($this->followup_response->CurrentValue) != "") {
				$this->followup_response->ViewValue = $this->followup_response->optionCaption($this->followup_response->CurrentValue);
			} else {
				$this->followup_response->ViewValue = NULL;
			}
			$this->followup_response->ViewCustomAttributes = "";

			// nxt_FU_date
			$this->nxt_FU_date->ViewValue = $this->nxt_FU_date->CurrentValue;
			$this->nxt_FU_date->ViewValue = FormatDateTime($this->nxt_FU_date->ViewValue, 0);
			$this->nxt_FU_date->ViewCustomAttributes = "";

			// nxt_FU_plans
			$this->nxt_FU_plans->ViewValue = $this->nxt_FU_plans->CurrentValue;
			$this->nxt_FU_plans->ViewCustomAttributes = "";

			// current_FU_status
			if (strval($this->current_FU_status->CurrentValue) != "") {
				$this->current_FU_status->ViewValue = $this->current_FU_status->optionCaption($this->current_FU_status->CurrentValue);
			} else {
				$this->current_FU_status->ViewValue = NULL;
			}
			$this->current_FU_status->ViewCustomAttributes = "";

			// followup_id
			$this->followup_id->LinkCustomAttributes = "";
			$this->followup_id->HrefValue = "";
			$this->followup_id->TooltipValue = "";

			// followup_branch_id
			$this->followup_branch_id->LinkCustomAttributes = "";
			$this->followup_branch_id->HrefValue = "";
			$this->followup_branch_id->TooltipValue = "";

			// followup_business_id
			$this->followup_business_id->LinkCustomAttributes = "";
			$this->followup_business_id->HrefValue = "";
			$this->followup_business_id->TooltipValue = "";

			// followup_by_emp_id
			$this->followup_by_emp_id->LinkCustomAttributes = "";
			$this->followup_by_emp_id->HrefValue = "";
			$this->followup_by_emp_id->TooltipValue = "";

			// followup_no_id
			$this->followup_no_id->LinkCustomAttributes = "";
			$this->followup_no_id->HrefValue = "";
			$this->followup_no_id->TooltipValue = "";

			// followup_date
			$this->followup_date->LinkCustomAttributes = "";
			$this->followup_date->HrefValue = "";
			$this->followup_date->TooltipValue = "";

			// followup_comments
			$this->followup_comments->LinkCustomAttributes = "";
			$this->followup_comments->HrefValue = "";
			$this->followup_comments->TooltipValue = "";

			// followup_response
			$this->followup_response->LinkCustomAttributes = "";
			$this->followup_response->HrefValue = "";
			$this->followup_response->TooltipValue = "";

			// nxt_FU_date
			$this->nxt_FU_date->LinkCustomAttributes = "";
			$this->nxt_FU_date->HrefValue = "";
			$this->nxt_FU_date->TooltipValue = "";

			// nxt_FU_plans
			$this->nxt_FU_plans->LinkCustomAttributes = "";
			$this->nxt_FU_plans->HrefValue = "";
			$this->nxt_FU_plans->TooltipValue = "";

			// current_FU_status
			$this->current_FU_status->LinkCustomAttributes = "";
			$this->current_FU_status->HrefValue = "";
			$this->current_FU_status->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// followup_id
			$this->followup_id->EditAttrs["class"] = "form-control";
			$this->followup_id->EditCustomAttributes = "";
			$this->followup_id->EditValue = $this->followup_id->CurrentValue;
			$this->followup_id->ViewCustomAttributes = "";

			// followup_branch_id
			$this->followup_branch_id->EditAttrs["class"] = "form-control";
			$this->followup_branch_id->EditCustomAttributes = "";
			$this->followup_branch_id->EditValue = HtmlEncode($this->followup_branch_id->CurrentValue);
			$this->followup_branch_id->PlaceHolder = RemoveHtml($this->followup_branch_id->caption());

			// followup_business_id
			$this->followup_business_id->EditAttrs["class"] = "form-control";
			$this->followup_business_id->EditCustomAttributes = "";
			$this->followup_business_id->EditValue = HtmlEncode($this->followup_business_id->CurrentValue);
			$this->followup_business_id->PlaceHolder = RemoveHtml($this->followup_business_id->caption());

			// followup_by_emp_id
			$this->followup_by_emp_id->EditAttrs["class"] = "form-control";
			$this->followup_by_emp_id->EditCustomAttributes = "";
			$this->followup_by_emp_id->EditValue = HtmlEncode($this->followup_by_emp_id->CurrentValue);
			$this->followup_by_emp_id->PlaceHolder = RemoveHtml($this->followup_by_emp_id->caption());

			// followup_no_id
			$this->followup_no_id->EditAttrs["class"] = "form-control";
			$this->followup_no_id->EditCustomAttributes = "";
			$this->followup_no_id->EditValue = HtmlEncode($this->followup_no_id->CurrentValue);
			$this->followup_no_id->PlaceHolder = RemoveHtml($this->followup_no_id->caption());

			// followup_date
			$this->followup_date->EditAttrs["class"] = "form-control";
			$this->followup_date->EditCustomAttributes = "";
			$this->followup_date->EditValue = HtmlEncode(FormatDateTime($this->followup_date->CurrentValue, 8));
			$this->followup_date->PlaceHolder = RemoveHtml($this->followup_date->caption());

			// followup_comments
			$this->followup_comments->EditAttrs["class"] = "form-control";
			$this->followup_comments->EditCustomAttributes = "";
			$this->followup_comments->EditValue = HtmlEncode($this->followup_comments->CurrentValue);
			$this->followup_comments->PlaceHolder = RemoveHtml($this->followup_comments->caption());

			// followup_response
			$this->followup_response->EditCustomAttributes = "";
			$this->followup_response->EditValue = $this->followup_response->options(FALSE);

			// nxt_FU_date
			$this->nxt_FU_date->EditAttrs["class"] = "form-control";
			$this->nxt_FU_date->EditCustomAttributes = "";
			$this->nxt_FU_date->EditValue = HtmlEncode(FormatDateTime($this->nxt_FU_date->CurrentValue, 8));
			$this->nxt_FU_date->PlaceHolder = RemoveHtml($this->nxt_FU_date->caption());

			// nxt_FU_plans
			$this->nxt_FU_plans->EditAttrs["class"] = "form-control";
			$this->nxt_FU_plans->EditCustomAttributes = "";
			$this->nxt_FU_plans->EditValue = HtmlEncode($this->nxt_FU_plans->CurrentValue);
			$this->nxt_FU_plans->PlaceHolder = RemoveHtml($this->nxt_FU_plans->caption());

			// current_FU_status
			$this->current_FU_status->EditCustomAttributes = "";
			$this->current_FU_status->EditValue = $this->current_FU_status->options(FALSE);

			// Edit refer script
			// followup_id

			$this->followup_id->LinkCustomAttributes = "";
			$this->followup_id->HrefValue = "";

			// followup_branch_id
			$this->followup_branch_id->LinkCustomAttributes = "";
			$this->followup_branch_id->HrefValue = "";

			// followup_business_id
			$this->followup_business_id->LinkCustomAttributes = "";
			$this->followup_business_id->HrefValue = "";

			// followup_by_emp_id
			$this->followup_by_emp_id->LinkCustomAttributes = "";
			$this->followup_by_emp_id->HrefValue = "";

			// followup_no_id
			$this->followup_no_id->LinkCustomAttributes = "";
			$this->followup_no_id->HrefValue = "";

			// followup_date
			$this->followup_date->LinkCustomAttributes = "";
			$this->followup_date->HrefValue = "";

			// followup_comments
			$this->followup_comments->LinkCustomAttributes = "";
			$this->followup_comments->HrefValue = "";

			// followup_response
			$this->followup_response->LinkCustomAttributes = "";
			$this->followup_response->HrefValue = "";

			// nxt_FU_date
			$this->nxt_FU_date->LinkCustomAttributes = "";
			$this->nxt_FU_date->HrefValue = "";

			// nxt_FU_plans
			$this->nxt_FU_plans->LinkCustomAttributes = "";
			$this->nxt_FU_plans->HrefValue = "";

			// current_FU_status
			$this->current_FU_status->LinkCustomAttributes = "";
			$this->current_FU_status->HrefValue = "";
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
		if ($this->followup_id->Required) {
			if (!$this->followup_id->IsDetailKey && $this->followup_id->FormValue != NULL && $this->followup_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->followup_id->caption(), $this->followup_id->RequiredErrorMessage));
			}
		}
		if ($this->followup_branch_id->Required) {
			if (!$this->followup_branch_id->IsDetailKey && $this->followup_branch_id->FormValue != NULL && $this->followup_branch_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->followup_branch_id->caption(), $this->followup_branch_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->followup_branch_id->FormValue)) {
			AddMessage($FormError, $this->followup_branch_id->errorMessage());
		}
		if ($this->followup_business_id->Required) {
			if (!$this->followup_business_id->IsDetailKey && $this->followup_business_id->FormValue != NULL && $this->followup_business_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->followup_business_id->caption(), $this->followup_business_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->followup_business_id->FormValue)) {
			AddMessage($FormError, $this->followup_business_id->errorMessage());
		}
		if ($this->followup_by_emp_id->Required) {
			if (!$this->followup_by_emp_id->IsDetailKey && $this->followup_by_emp_id->FormValue != NULL && $this->followup_by_emp_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->followup_by_emp_id->caption(), $this->followup_by_emp_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->followup_by_emp_id->FormValue)) {
			AddMessage($FormError, $this->followup_by_emp_id->errorMessage());
		}
		if ($this->followup_no_id->Required) {
			if (!$this->followup_no_id->IsDetailKey && $this->followup_no_id->FormValue != NULL && $this->followup_no_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->followup_no_id->caption(), $this->followup_no_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->followup_no_id->FormValue)) {
			AddMessage($FormError, $this->followup_no_id->errorMessage());
		}
		if ($this->followup_date->Required) {
			if (!$this->followup_date->IsDetailKey && $this->followup_date->FormValue != NULL && $this->followup_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->followup_date->caption(), $this->followup_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->followup_date->FormValue)) {
			AddMessage($FormError, $this->followup_date->errorMessage());
		}
		if ($this->followup_comments->Required) {
			if (!$this->followup_comments->IsDetailKey && $this->followup_comments->FormValue != NULL && $this->followup_comments->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->followup_comments->caption(), $this->followup_comments->RequiredErrorMessage));
			}
		}
		if ($this->followup_response->Required) {
			if ($this->followup_response->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->followup_response->caption(), $this->followup_response->RequiredErrorMessage));
			}
		}
		if ($this->nxt_FU_date->Required) {
			if (!$this->nxt_FU_date->IsDetailKey && $this->nxt_FU_date->FormValue != NULL && $this->nxt_FU_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nxt_FU_date->caption(), $this->nxt_FU_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->nxt_FU_date->FormValue)) {
			AddMessage($FormError, $this->nxt_FU_date->errorMessage());
		}
		if ($this->nxt_FU_plans->Required) {
			if (!$this->nxt_FU_plans->IsDetailKey && $this->nxt_FU_plans->FormValue != NULL && $this->nxt_FU_plans->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nxt_FU_plans->caption(), $this->nxt_FU_plans->RequiredErrorMessage));
			}
		}
		if ($this->current_FU_status->Required) {
			if ($this->current_FU_status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->current_FU_status->caption(), $this->current_FU_status->RequiredErrorMessage));
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

			// followup_branch_id
			$this->followup_branch_id->setDbValueDef($rsnew, $this->followup_branch_id->CurrentValue, 0, $this->followup_branch_id->ReadOnly);

			// followup_business_id
			$this->followup_business_id->setDbValueDef($rsnew, $this->followup_business_id->CurrentValue, 0, $this->followup_business_id->ReadOnly);

			// followup_by_emp_id
			$this->followup_by_emp_id->setDbValueDef($rsnew, $this->followup_by_emp_id->CurrentValue, 0, $this->followup_by_emp_id->ReadOnly);

			// followup_no_id
			$this->followup_no_id->setDbValueDef($rsnew, $this->followup_no_id->CurrentValue, 0, $this->followup_no_id->ReadOnly);

			// followup_date
			$this->followup_date->setDbValueDef($rsnew, UnFormatDateTime($this->followup_date->CurrentValue, 0), CurrentDate(), $this->followup_date->ReadOnly);

			// followup_comments
			$this->followup_comments->setDbValueDef($rsnew, $this->followup_comments->CurrentValue, "", $this->followup_comments->ReadOnly);

			// followup_response
			$this->followup_response->setDbValueDef($rsnew, $this->followup_response->CurrentValue, "", $this->followup_response->ReadOnly);

			// nxt_FU_date
			$this->nxt_FU_date->setDbValueDef($rsnew, UnFormatDateTime($this->nxt_FU_date->CurrentValue, 0), CurrentDate(), $this->nxt_FU_date->ReadOnly);

			// nxt_FU_plans
			$this->nxt_FU_plans->setDbValueDef($rsnew, $this->nxt_FU_plans->CurrentValue, "", $this->nxt_FU_plans->ReadOnly);

			// current_FU_status
			$this->current_FU_status->setDbValueDef($rsnew, $this->current_FU_status->CurrentValue, "", $this->current_FU_status->ReadOnly);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("followuplist.php"), "", $this->TableVar, TRUE);
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
				case "x_followup_response":
					break;
				case "x_current_FU_status":
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