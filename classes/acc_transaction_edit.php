<?php
namespace PHPMaker2020\project1;

/**
 * Page class
 */
class acc_transaction_edit extends acc_transaction
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{5525D2B6-89E2-4D25-84CF-86BD784D9909}";

	// Table name
	public $TableName = 'acc_transaction';

	// Page object name
	public $PageObjName = "acc_transaction_edit";

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

		// Table object (acc_transaction)
		if (!isset($GLOBALS["acc_transaction"]) || get_class($GLOBALS["acc_transaction"]) == PROJECT_NAMESPACE . "acc_transaction") {
			$GLOBALS["acc_transaction"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["acc_transaction"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'acc_transaction');

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
		global $acc_transaction;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($acc_transaction);
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
					if ($pageName == "acc_transactionview.php")
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
			$key .= @$ar['acc_trans_id'];
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
			$this->acc_trans_id->Visible = FALSE;
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
		$this->acc_trans_id->setVisibility();
		$this->acc_trans_branch_id->setVisibility();
		$this->acc_trans_acc_head_id->setVisibility();
		$this->acc_trans_narration->setVisibility();
		$this->acc_trans_amount->setVisibility();
		$this->acc_trans_date->setVisibility();
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
			if ($CurrentForm->hasValue("x_acc_trans_id")) {
				$this->acc_trans_id->setFormValue($CurrentForm->getValue("x_acc_trans_id"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("acc_trans_id") !== NULL) {
				$this->acc_trans_id->setQueryStringValue(Get("acc_trans_id"));
				$loadByQuery = TRUE;
			} else {
				$this->acc_trans_id->CurrentValue = NULL;
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
					$this->terminate("acc_transactionlist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "acc_transactionlist.php")
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

		// Check field name 'acc_trans_id' first before field var 'x_acc_trans_id'
		$val = $CurrentForm->hasValue("acc_trans_id") ? $CurrentForm->getValue("acc_trans_id") : $CurrentForm->getValue("x_acc_trans_id");
		if (!$this->acc_trans_id->IsDetailKey)
			$this->acc_trans_id->setFormValue($val);

		// Check field name 'acc_trans_branch_id' first before field var 'x_acc_trans_branch_id'
		$val = $CurrentForm->hasValue("acc_trans_branch_id") ? $CurrentForm->getValue("acc_trans_branch_id") : $CurrentForm->getValue("x_acc_trans_branch_id");
		if (!$this->acc_trans_branch_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->acc_trans_branch_id->Visible = FALSE; // Disable update for API request
			else
				$this->acc_trans_branch_id->setFormValue($val);
		}

		// Check field name 'acc_trans_acc_head_id' first before field var 'x_acc_trans_acc_head_id'
		$val = $CurrentForm->hasValue("acc_trans_acc_head_id") ? $CurrentForm->getValue("acc_trans_acc_head_id") : $CurrentForm->getValue("x_acc_trans_acc_head_id");
		if (!$this->acc_trans_acc_head_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->acc_trans_acc_head_id->Visible = FALSE; // Disable update for API request
			else
				$this->acc_trans_acc_head_id->setFormValue($val);
		}

		// Check field name 'acc_trans_narration' first before field var 'x_acc_trans_narration'
		$val = $CurrentForm->hasValue("acc_trans_narration") ? $CurrentForm->getValue("acc_trans_narration") : $CurrentForm->getValue("x_acc_trans_narration");
		if (!$this->acc_trans_narration->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->acc_trans_narration->Visible = FALSE; // Disable update for API request
			else
				$this->acc_trans_narration->setFormValue($val);
		}

		// Check field name 'acc_trans_amount' first before field var 'x_acc_trans_amount'
		$val = $CurrentForm->hasValue("acc_trans_amount") ? $CurrentForm->getValue("acc_trans_amount") : $CurrentForm->getValue("x_acc_trans_amount");
		if (!$this->acc_trans_amount->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->acc_trans_amount->Visible = FALSE; // Disable update for API request
			else
				$this->acc_trans_amount->setFormValue($val);
		}

		// Check field name 'acc_trans_date' first before field var 'x_acc_trans_date'
		$val = $CurrentForm->hasValue("acc_trans_date") ? $CurrentForm->getValue("acc_trans_date") : $CurrentForm->getValue("x_acc_trans_date");
		if (!$this->acc_trans_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->acc_trans_date->Visible = FALSE; // Disable update for API request
			else
				$this->acc_trans_date->setFormValue($val);
			$this->acc_trans_date->CurrentValue = UnFormatDateTime($this->acc_trans_date->CurrentValue, 0);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->acc_trans_id->CurrentValue = $this->acc_trans_id->FormValue;
		$this->acc_trans_branch_id->CurrentValue = $this->acc_trans_branch_id->FormValue;
		$this->acc_trans_acc_head_id->CurrentValue = $this->acc_trans_acc_head_id->FormValue;
		$this->acc_trans_narration->CurrentValue = $this->acc_trans_narration->FormValue;
		$this->acc_trans_amount->CurrentValue = $this->acc_trans_amount->FormValue;
		$this->acc_trans_date->CurrentValue = $this->acc_trans_date->FormValue;
		$this->acc_trans_date->CurrentValue = UnFormatDateTime($this->acc_trans_date->CurrentValue, 0);
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
		$this->acc_trans_id->setDbValue($row['acc_trans_id']);
		$this->acc_trans_branch_id->setDbValue($row['acc_trans_branch_id']);
		$this->acc_trans_acc_head_id->setDbValue($row['acc_trans_acc_head_id']);
		$this->acc_trans_narration->setDbValue($row['acc_trans_narration']);
		$this->acc_trans_amount->setDbValue($row['acc_trans_amount']);
		$this->acc_trans_date->setDbValue($row['acc_trans_date']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['acc_trans_id'] = NULL;
		$row['acc_trans_branch_id'] = NULL;
		$row['acc_trans_acc_head_id'] = NULL;
		$row['acc_trans_narration'] = NULL;
		$row['acc_trans_amount'] = NULL;
		$row['acc_trans_date'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("acc_trans_id")) != "")
			$this->acc_trans_id->OldValue = $this->getKey("acc_trans_id"); // acc_trans_id
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
		// acc_trans_id
		// acc_trans_branch_id
		// acc_trans_acc_head_id
		// acc_trans_narration
		// acc_trans_amount
		// acc_trans_date

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// acc_trans_id
			$this->acc_trans_id->ViewValue = $this->acc_trans_id->CurrentValue;
			$this->acc_trans_id->ViewCustomAttributes = "";

			// acc_trans_branch_id
			$this->acc_trans_branch_id->ViewValue = $this->acc_trans_branch_id->CurrentValue;
			$this->acc_trans_branch_id->ViewValue = FormatNumber($this->acc_trans_branch_id->ViewValue, 0, -2, -2, -2);
			$this->acc_trans_branch_id->ViewCustomAttributes = "";

			// acc_trans_acc_head_id
			$this->acc_trans_acc_head_id->ViewValue = $this->acc_trans_acc_head_id->CurrentValue;
			$this->acc_trans_acc_head_id->ViewValue = FormatNumber($this->acc_trans_acc_head_id->ViewValue, 0, -2, -2, -2);
			$this->acc_trans_acc_head_id->ViewCustomAttributes = "";

			// acc_trans_narration
			$this->acc_trans_narration->ViewValue = $this->acc_trans_narration->CurrentValue;
			$this->acc_trans_narration->ViewCustomAttributes = "";

			// acc_trans_amount
			$this->acc_trans_amount->ViewValue = $this->acc_trans_amount->CurrentValue;
			$this->acc_trans_amount->ViewValue = FormatNumber($this->acc_trans_amount->ViewValue, 0, -2, -2, -2);
			$this->acc_trans_amount->ViewCustomAttributes = "";

			// acc_trans_date
			$this->acc_trans_date->ViewValue = $this->acc_trans_date->CurrentValue;
			$this->acc_trans_date->ViewValue = FormatDateTime($this->acc_trans_date->ViewValue, 0);
			$this->acc_trans_date->ViewCustomAttributes = "";

			// acc_trans_id
			$this->acc_trans_id->LinkCustomAttributes = "";
			$this->acc_trans_id->HrefValue = "";
			$this->acc_trans_id->TooltipValue = "";

			// acc_trans_branch_id
			$this->acc_trans_branch_id->LinkCustomAttributes = "";
			$this->acc_trans_branch_id->HrefValue = "";
			$this->acc_trans_branch_id->TooltipValue = "";

			// acc_trans_acc_head_id
			$this->acc_trans_acc_head_id->LinkCustomAttributes = "";
			$this->acc_trans_acc_head_id->HrefValue = "";
			$this->acc_trans_acc_head_id->TooltipValue = "";

			// acc_trans_narration
			$this->acc_trans_narration->LinkCustomAttributes = "";
			$this->acc_trans_narration->HrefValue = "";
			$this->acc_trans_narration->TooltipValue = "";

			// acc_trans_amount
			$this->acc_trans_amount->LinkCustomAttributes = "";
			$this->acc_trans_amount->HrefValue = "";
			$this->acc_trans_amount->TooltipValue = "";

			// acc_trans_date
			$this->acc_trans_date->LinkCustomAttributes = "";
			$this->acc_trans_date->HrefValue = "";
			$this->acc_trans_date->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// acc_trans_id
			$this->acc_trans_id->EditAttrs["class"] = "form-control";
			$this->acc_trans_id->EditCustomAttributes = "";
			$this->acc_trans_id->EditValue = $this->acc_trans_id->CurrentValue;
			$this->acc_trans_id->ViewCustomAttributes = "";

			// acc_trans_branch_id
			$this->acc_trans_branch_id->EditAttrs["class"] = "form-control";
			$this->acc_trans_branch_id->EditCustomAttributes = "";
			$this->acc_trans_branch_id->EditValue = HtmlEncode($this->acc_trans_branch_id->CurrentValue);
			$this->acc_trans_branch_id->PlaceHolder = RemoveHtml($this->acc_trans_branch_id->caption());

			// acc_trans_acc_head_id
			$this->acc_trans_acc_head_id->EditAttrs["class"] = "form-control";
			$this->acc_trans_acc_head_id->EditCustomAttributes = "";
			$this->acc_trans_acc_head_id->EditValue = HtmlEncode($this->acc_trans_acc_head_id->CurrentValue);
			$this->acc_trans_acc_head_id->PlaceHolder = RemoveHtml($this->acc_trans_acc_head_id->caption());

			// acc_trans_narration
			$this->acc_trans_narration->EditAttrs["class"] = "form-control";
			$this->acc_trans_narration->EditCustomAttributes = "";
			$this->acc_trans_narration->EditValue = HtmlEncode($this->acc_trans_narration->CurrentValue);
			$this->acc_trans_narration->PlaceHolder = RemoveHtml($this->acc_trans_narration->caption());

			// acc_trans_amount
			$this->acc_trans_amount->EditAttrs["class"] = "form-control";
			$this->acc_trans_amount->EditCustomAttributes = "";
			$this->acc_trans_amount->EditValue = HtmlEncode($this->acc_trans_amount->CurrentValue);
			$this->acc_trans_amount->PlaceHolder = RemoveHtml($this->acc_trans_amount->caption());

			// acc_trans_date
			$this->acc_trans_date->EditAttrs["class"] = "form-control";
			$this->acc_trans_date->EditCustomAttributes = "";
			$this->acc_trans_date->EditValue = HtmlEncode(FormatDateTime($this->acc_trans_date->CurrentValue, 8));
			$this->acc_trans_date->PlaceHolder = RemoveHtml($this->acc_trans_date->caption());

			// Edit refer script
			// acc_trans_id

			$this->acc_trans_id->LinkCustomAttributes = "";
			$this->acc_trans_id->HrefValue = "";

			// acc_trans_branch_id
			$this->acc_trans_branch_id->LinkCustomAttributes = "";
			$this->acc_trans_branch_id->HrefValue = "";

			// acc_trans_acc_head_id
			$this->acc_trans_acc_head_id->LinkCustomAttributes = "";
			$this->acc_trans_acc_head_id->HrefValue = "";

			// acc_trans_narration
			$this->acc_trans_narration->LinkCustomAttributes = "";
			$this->acc_trans_narration->HrefValue = "";

			// acc_trans_amount
			$this->acc_trans_amount->LinkCustomAttributes = "";
			$this->acc_trans_amount->HrefValue = "";

			// acc_trans_date
			$this->acc_trans_date->LinkCustomAttributes = "";
			$this->acc_trans_date->HrefValue = "";
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
		if ($this->acc_trans_id->Required) {
			if (!$this->acc_trans_id->IsDetailKey && $this->acc_trans_id->FormValue != NULL && $this->acc_trans_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->acc_trans_id->caption(), $this->acc_trans_id->RequiredErrorMessage));
			}
		}
		if ($this->acc_trans_branch_id->Required) {
			if (!$this->acc_trans_branch_id->IsDetailKey && $this->acc_trans_branch_id->FormValue != NULL && $this->acc_trans_branch_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->acc_trans_branch_id->caption(), $this->acc_trans_branch_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->acc_trans_branch_id->FormValue)) {
			AddMessage($FormError, $this->acc_trans_branch_id->errorMessage());
		}
		if ($this->acc_trans_acc_head_id->Required) {
			if (!$this->acc_trans_acc_head_id->IsDetailKey && $this->acc_trans_acc_head_id->FormValue != NULL && $this->acc_trans_acc_head_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->acc_trans_acc_head_id->caption(), $this->acc_trans_acc_head_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->acc_trans_acc_head_id->FormValue)) {
			AddMessage($FormError, $this->acc_trans_acc_head_id->errorMessage());
		}
		if ($this->acc_trans_narration->Required) {
			if (!$this->acc_trans_narration->IsDetailKey && $this->acc_trans_narration->FormValue != NULL && $this->acc_trans_narration->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->acc_trans_narration->caption(), $this->acc_trans_narration->RequiredErrorMessage));
			}
		}
		if ($this->acc_trans_amount->Required) {
			if (!$this->acc_trans_amount->IsDetailKey && $this->acc_trans_amount->FormValue != NULL && $this->acc_trans_amount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->acc_trans_amount->caption(), $this->acc_trans_amount->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->acc_trans_amount->FormValue)) {
			AddMessage($FormError, $this->acc_trans_amount->errorMessage());
		}
		if ($this->acc_trans_date->Required) {
			if (!$this->acc_trans_date->IsDetailKey && $this->acc_trans_date->FormValue != NULL && $this->acc_trans_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->acc_trans_date->caption(), $this->acc_trans_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->acc_trans_date->FormValue)) {
			AddMessage($FormError, $this->acc_trans_date->errorMessage());
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

			// acc_trans_branch_id
			$this->acc_trans_branch_id->setDbValueDef($rsnew, $this->acc_trans_branch_id->CurrentValue, 0, $this->acc_trans_branch_id->ReadOnly);

			// acc_trans_acc_head_id
			$this->acc_trans_acc_head_id->setDbValueDef($rsnew, $this->acc_trans_acc_head_id->CurrentValue, 0, $this->acc_trans_acc_head_id->ReadOnly);

			// acc_trans_narration
			$this->acc_trans_narration->setDbValueDef($rsnew, $this->acc_trans_narration->CurrentValue, "", $this->acc_trans_narration->ReadOnly);

			// acc_trans_amount
			$this->acc_trans_amount->setDbValueDef($rsnew, $this->acc_trans_amount->CurrentValue, 0, $this->acc_trans_amount->ReadOnly);

			// acc_trans_date
			$this->acc_trans_date->setDbValueDef($rsnew, UnFormatDateTime($this->acc_trans_date->CurrentValue, 0), CurrentDate(), $this->acc_trans_date->ReadOnly);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("acc_transactionlist.php"), "", $this->TableVar, TRUE);
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