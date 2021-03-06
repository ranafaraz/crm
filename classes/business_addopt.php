<?php
namespace PHPMaker2020\crm_live;

/**
 * Page class
 */
class business_addopt extends business
{

	// Page ID
	public $PageID = "addopt";

	// Project ID
	public $ProjectID = "{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}";

	// Table name
	public $TableName = 'business';

	// Page object name
	public $PageObjName = "business_addopt";

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
		$hidden = FALSE;
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

		// Table object (business)
		if (!isset($GLOBALS["business"]) || get_class($GLOBALS["business"]) == PROJECT_NAMESPACE . "business") {
			$GLOBALS["business"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["business"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'addopt');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'business');

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
		global $business;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($business);
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
			SaveDebugMessage();
			AddHeader("Location", $url);
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
			$key .= @$ar['b_id'];
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
			$this->b_id->Visible = FALSE;
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

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError;

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
					$this->terminate(GetUrl("businesslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->b_id->Visible = FALSE;
		$this->b_branch_id->setVisibility();
		$this->b_b_type_id->setVisibility();
		$this->b_b_status_id->setVisibility();
		$this->b_b_nature_id->setVisibility();
		$this->b_city_id->setVisibility();
		$this->b_referral_id->setVisibility();
		$this->b_name->setVisibility();
		$this->b_owner->setVisibility();
		$this->b_contact->setVisibility();
		$this->b_address->setVisibility();
		$this->b_email->setVisibility();
		$this->b_ntn->setVisibility();
		$this->b_logo->setVisibility();
		$this->b_no_of_emp->setVisibility();
		$this->b_since->setVisibility();
		$this->b_no_of_branches->setVisibility();
		$this->b_deal_with_referral->setVisibility();
		$this->b_comments->setVisibility();
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
		$this->setupLookupOptions($this->b_branch_id);
		$this->setupLookupOptions($this->b_b_type_id);
		$this->setupLookupOptions($this->b_b_status_id);
		$this->setupLookupOptions($this->b_b_nature_id);
		$this->setupLookupOptions($this->b_city_id);
		$this->setupLookupOptions($this->b_referral_id);
		set_error_handler(PROJECT_NAMESPACE . "ErrorHandler");

		// Set up Breadcrumb
		//$this->setupBreadcrumb(); // Not used

		$this->loadRowValues(); // Load default values

		// Render row
		$this->RowType = ROWTYPE_ADD; // Render add type
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->b_logo->Upload->Index = $CurrentForm->Index;
		$this->b_logo->Upload->uploadFile();
		$this->b_logo->CurrentValue = $this->b_logo->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->b_id->CurrentValue = NULL;
		$this->b_id->OldValue = $this->b_id->CurrentValue;
		$this->b_branch_id->CurrentValue = NULL;
		$this->b_branch_id->OldValue = $this->b_branch_id->CurrentValue;
		$this->b_b_type_id->CurrentValue = NULL;
		$this->b_b_type_id->OldValue = $this->b_b_type_id->CurrentValue;
		$this->b_b_status_id->CurrentValue = NULL;
		$this->b_b_status_id->OldValue = $this->b_b_status_id->CurrentValue;
		$this->b_b_nature_id->CurrentValue = NULL;
		$this->b_b_nature_id->OldValue = $this->b_b_nature_id->CurrentValue;
		$this->b_city_id->CurrentValue = NULL;
		$this->b_city_id->OldValue = $this->b_city_id->CurrentValue;
		$this->b_referral_id->CurrentValue = NULL;
		$this->b_referral_id->OldValue = $this->b_referral_id->CurrentValue;
		$this->b_name->CurrentValue = NULL;
		$this->b_name->OldValue = $this->b_name->CurrentValue;
		$this->b_owner->CurrentValue = NULL;
		$this->b_owner->OldValue = $this->b_owner->CurrentValue;
		$this->b_contact->CurrentValue = NULL;
		$this->b_contact->OldValue = $this->b_contact->CurrentValue;
		$this->b_address->CurrentValue = NULL;
		$this->b_address->OldValue = $this->b_address->CurrentValue;
		$this->b_email->CurrentValue = NULL;
		$this->b_email->OldValue = $this->b_email->CurrentValue;
		$this->b_ntn->CurrentValue = NULL;
		$this->b_ntn->OldValue = $this->b_ntn->CurrentValue;
		$this->b_logo->Upload->DbValue = NULL;
		$this->b_logo->OldValue = $this->b_logo->Upload->DbValue;
		$this->b_logo->CurrentValue = NULL; // Clear file related field
		$this->b_no_of_emp->CurrentValue = NULL;
		$this->b_no_of_emp->OldValue = $this->b_no_of_emp->CurrentValue;
		$this->b_since->CurrentValue = NULL;
		$this->b_since->OldValue = $this->b_since->CurrentValue;
		$this->b_no_of_branches->CurrentValue = NULL;
		$this->b_no_of_branches->OldValue = $this->b_no_of_branches->CurrentValue;
		$this->b_deal_with_referral->CurrentValue = NULL;
		$this->b_deal_with_referral->OldValue = $this->b_deal_with_referral->CurrentValue;
		$this->b_comments->CurrentValue = NULL;
		$this->b_comments->OldValue = $this->b_comments->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'b_branch_id' first before field var 'x_b_branch_id'
		$val = $CurrentForm->hasValue("b_branch_id") ? $CurrentForm->getValue("b_branch_id") : $CurrentForm->getValue("x_b_branch_id");
		if (!$this->b_branch_id->IsDetailKey) {
			$this->b_branch_id->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_b_type_id' first before field var 'x_b_b_type_id'
		$val = $CurrentForm->hasValue("b_b_type_id") ? $CurrentForm->getValue("b_b_type_id") : $CurrentForm->getValue("x_b_b_type_id");
		if (!$this->b_b_type_id->IsDetailKey) {
			$this->b_b_type_id->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_b_status_id' first before field var 'x_b_b_status_id'
		$val = $CurrentForm->hasValue("b_b_status_id") ? $CurrentForm->getValue("b_b_status_id") : $CurrentForm->getValue("x_b_b_status_id");
		if (!$this->b_b_status_id->IsDetailKey) {
			$this->b_b_status_id->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_b_nature_id' first before field var 'x_b_b_nature_id'
		$val = $CurrentForm->hasValue("b_b_nature_id") ? $CurrentForm->getValue("b_b_nature_id") : $CurrentForm->getValue("x_b_b_nature_id");
		if (!$this->b_b_nature_id->IsDetailKey) {
			$this->b_b_nature_id->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_city_id' first before field var 'x_b_city_id'
		$val = $CurrentForm->hasValue("b_city_id") ? $CurrentForm->getValue("b_city_id") : $CurrentForm->getValue("x_b_city_id");
		if (!$this->b_city_id->IsDetailKey) {
			$this->b_city_id->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_referral_id' first before field var 'x_b_referral_id'
		$val = $CurrentForm->hasValue("b_referral_id") ? $CurrentForm->getValue("b_referral_id") : $CurrentForm->getValue("x_b_referral_id");
		if (!$this->b_referral_id->IsDetailKey) {
			$this->b_referral_id->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_name' first before field var 'x_b_name'
		$val = $CurrentForm->hasValue("b_name") ? $CurrentForm->getValue("b_name") : $CurrentForm->getValue("x_b_name");
		if (!$this->b_name->IsDetailKey) {
			$this->b_name->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_owner' first before field var 'x_b_owner'
		$val = $CurrentForm->hasValue("b_owner") ? $CurrentForm->getValue("b_owner") : $CurrentForm->getValue("x_b_owner");
		if (!$this->b_owner->IsDetailKey) {
			$this->b_owner->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_contact' first before field var 'x_b_contact'
		$val = $CurrentForm->hasValue("b_contact") ? $CurrentForm->getValue("b_contact") : $CurrentForm->getValue("x_b_contact");
		if (!$this->b_contact->IsDetailKey) {
			$this->b_contact->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_address' first before field var 'x_b_address'
		$val = $CurrentForm->hasValue("b_address") ? $CurrentForm->getValue("b_address") : $CurrentForm->getValue("x_b_address");
		if (!$this->b_address->IsDetailKey) {
			$this->b_address->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_email' first before field var 'x_b_email'
		$val = $CurrentForm->hasValue("b_email") ? $CurrentForm->getValue("b_email") : $CurrentForm->getValue("x_b_email");
		if (!$this->b_email->IsDetailKey) {
			$this->b_email->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_ntn' first before field var 'x_b_ntn'
		$val = $CurrentForm->hasValue("b_ntn") ? $CurrentForm->getValue("b_ntn") : $CurrentForm->getValue("x_b_ntn");
		if (!$this->b_ntn->IsDetailKey) {
			$this->b_ntn->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_no_of_emp' first before field var 'x_b_no_of_emp'
		$val = $CurrentForm->hasValue("b_no_of_emp") ? $CurrentForm->getValue("b_no_of_emp") : $CurrentForm->getValue("x_b_no_of_emp");
		if (!$this->b_no_of_emp->IsDetailKey) {
			$this->b_no_of_emp->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_since' first before field var 'x_b_since'
		$val = $CurrentForm->hasValue("b_since") ? $CurrentForm->getValue("b_since") : $CurrentForm->getValue("x_b_since");
		if (!$this->b_since->IsDetailKey) {
			$this->b_since->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_no_of_branches' first before field var 'x_b_no_of_branches'
		$val = $CurrentForm->hasValue("b_no_of_branches") ? $CurrentForm->getValue("b_no_of_branches") : $CurrentForm->getValue("x_b_no_of_branches");
		if (!$this->b_no_of_branches->IsDetailKey) {
			$this->b_no_of_branches->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_deal_with_referral' first before field var 'x_b_deal_with_referral'
		$val = $CurrentForm->hasValue("b_deal_with_referral") ? $CurrentForm->getValue("b_deal_with_referral") : $CurrentForm->getValue("x_b_deal_with_referral");
		if (!$this->b_deal_with_referral->IsDetailKey) {
			$this->b_deal_with_referral->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_comments' first before field var 'x_b_comments'
		$val = $CurrentForm->hasValue("b_comments") ? $CurrentForm->getValue("b_comments") : $CurrentForm->getValue("x_b_comments");
		if (!$this->b_comments->IsDetailKey) {
			$this->b_comments->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'b_id' first before field var 'x_b_id'
		$val = $CurrentForm->hasValue("b_id") ? $CurrentForm->getValue("b_id") : $CurrentForm->getValue("x_b_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->b_branch_id->CurrentValue = ConvertToUtf8($this->b_branch_id->FormValue);
		$this->b_b_type_id->CurrentValue = ConvertToUtf8($this->b_b_type_id->FormValue);
		$this->b_b_status_id->CurrentValue = ConvertToUtf8($this->b_b_status_id->FormValue);
		$this->b_b_nature_id->CurrentValue = ConvertToUtf8($this->b_b_nature_id->FormValue);
		$this->b_city_id->CurrentValue = ConvertToUtf8($this->b_city_id->FormValue);
		$this->b_referral_id->CurrentValue = ConvertToUtf8($this->b_referral_id->FormValue);
		$this->b_name->CurrentValue = ConvertToUtf8($this->b_name->FormValue);
		$this->b_owner->CurrentValue = ConvertToUtf8($this->b_owner->FormValue);
		$this->b_contact->CurrentValue = ConvertToUtf8($this->b_contact->FormValue);
		$this->b_address->CurrentValue = ConvertToUtf8($this->b_address->FormValue);
		$this->b_email->CurrentValue = ConvertToUtf8($this->b_email->FormValue);
		$this->b_ntn->CurrentValue = ConvertToUtf8($this->b_ntn->FormValue);
		$this->b_no_of_emp->CurrentValue = ConvertToUtf8($this->b_no_of_emp->FormValue);
		$this->b_since->CurrentValue = ConvertToUtf8($this->b_since->FormValue);
		$this->b_no_of_branches->CurrentValue = ConvertToUtf8($this->b_no_of_branches->FormValue);
		$this->b_deal_with_referral->CurrentValue = ConvertToUtf8($this->b_deal_with_referral->FormValue);
		$this->b_comments->CurrentValue = ConvertToUtf8($this->b_comments->FormValue);
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
		$this->b_id->setDbValue($row['b_id']);
		$this->b_branch_id->setDbValue($row['b_branch_id']);
		if (array_key_exists('EV__b_branch_id', $rs->fields)) {
			$this->b_branch_id->VirtualValue = $rs->fields('EV__b_branch_id'); // Set up virtual field value
		} else {
			$this->b_branch_id->VirtualValue = ""; // Clear value
		}
		$this->b_b_type_id->setDbValue($row['b_b_type_id']);
		if (array_key_exists('EV__b_b_type_id', $rs->fields)) {
			$this->b_b_type_id->VirtualValue = $rs->fields('EV__b_b_type_id'); // Set up virtual field value
		} else {
			$this->b_b_type_id->VirtualValue = ""; // Clear value
		}
		$this->b_b_status_id->setDbValue($row['b_b_status_id']);
		if (array_key_exists('EV__b_b_status_id', $rs->fields)) {
			$this->b_b_status_id->VirtualValue = $rs->fields('EV__b_b_status_id'); // Set up virtual field value
		} else {
			$this->b_b_status_id->VirtualValue = ""; // Clear value
		}
		$this->b_b_nature_id->setDbValue($row['b_b_nature_id']);
		if (array_key_exists('EV__b_b_nature_id', $rs->fields)) {
			$this->b_b_nature_id->VirtualValue = $rs->fields('EV__b_b_nature_id'); // Set up virtual field value
		} else {
			$this->b_b_nature_id->VirtualValue = ""; // Clear value
		}
		$this->b_city_id->setDbValue($row['b_city_id']);
		if (array_key_exists('EV__b_city_id', $rs->fields)) {
			$this->b_city_id->VirtualValue = $rs->fields('EV__b_city_id'); // Set up virtual field value
		} else {
			$this->b_city_id->VirtualValue = ""; // Clear value
		}
		$this->b_referral_id->setDbValue($row['b_referral_id']);
		if (array_key_exists('EV__b_referral_id', $rs->fields)) {
			$this->b_referral_id->VirtualValue = $rs->fields('EV__b_referral_id'); // Set up virtual field value
		} else {
			$this->b_referral_id->VirtualValue = ""; // Clear value
		}
		$this->b_name->setDbValue($row['b_name']);
		$this->b_owner->setDbValue($row['b_owner']);
		$this->b_contact->setDbValue($row['b_contact']);
		$this->b_address->setDbValue($row['b_address']);
		$this->b_email->setDbValue($row['b_email']);
		$this->b_ntn->setDbValue($row['b_ntn']);
		$this->b_logo->Upload->DbValue = $row['b_logo'];
		$this->b_logo->setDbValue($this->b_logo->Upload->DbValue);
		$this->b_no_of_emp->setDbValue($row['b_no_of_emp']);
		$this->b_since->setDbValue($row['b_since']);
		$this->b_no_of_branches->setDbValue($row['b_no_of_branches']);
		$this->b_deal_with_referral->setDbValue($row['b_deal_with_referral']);
		$this->b_comments->setDbValue($row['b_comments']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['b_id'] = $this->b_id->CurrentValue;
		$row['b_branch_id'] = $this->b_branch_id->CurrentValue;
		$row['b_b_type_id'] = $this->b_b_type_id->CurrentValue;
		$row['b_b_status_id'] = $this->b_b_status_id->CurrentValue;
		$row['b_b_nature_id'] = $this->b_b_nature_id->CurrentValue;
		$row['b_city_id'] = $this->b_city_id->CurrentValue;
		$row['b_referral_id'] = $this->b_referral_id->CurrentValue;
		$row['b_name'] = $this->b_name->CurrentValue;
		$row['b_owner'] = $this->b_owner->CurrentValue;
		$row['b_contact'] = $this->b_contact->CurrentValue;
		$row['b_address'] = $this->b_address->CurrentValue;
		$row['b_email'] = $this->b_email->CurrentValue;
		$row['b_ntn'] = $this->b_ntn->CurrentValue;
		$row['b_logo'] = $this->b_logo->Upload->DbValue;
		$row['b_no_of_emp'] = $this->b_no_of_emp->CurrentValue;
		$row['b_since'] = $this->b_since->CurrentValue;
		$row['b_no_of_branches'] = $this->b_no_of_branches->CurrentValue;
		$row['b_deal_with_referral'] = $this->b_deal_with_referral->CurrentValue;
		$row['b_comments'] = $this->b_comments->CurrentValue;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// b_id
		// b_branch_id
		// b_b_type_id
		// b_b_status_id
		// b_b_nature_id
		// b_city_id
		// b_referral_id
		// b_name
		// b_owner
		// b_contact
		// b_address
		// b_email
		// b_ntn
		// b_logo
		// b_no_of_emp
		// b_since
		// b_no_of_branches
		// b_deal_with_referral
		// b_comments

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// b_id
			$this->b_id->ViewValue = $this->b_id->CurrentValue;
			$this->b_id->CssClass = "font-weight-bold";
			$this->b_id->ViewCustomAttributes = "";

			// b_branch_id
			if ($this->b_branch_id->VirtualValue != "") {
				$this->b_branch_id->ViewValue = $this->b_branch_id->VirtualValue;
			} else {
				$curVal = strval($this->b_branch_id->CurrentValue);
				if ($curVal != "") {
					$this->b_branch_id->ViewValue = $this->b_branch_id->lookupCacheOption($curVal);
					if ($this->b_branch_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`branch_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->b_branch_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->b_branch_id->ViewValue = $this->b_branch_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->b_branch_id->ViewValue = $this->b_branch_id->CurrentValue;
						}
					}
				} else {
					$this->b_branch_id->ViewValue = NULL;
				}
			}
			$this->b_branch_id->ViewCustomAttributes = "";

			// b_b_type_id
			if ($this->b_b_type_id->VirtualValue != "") {
				$this->b_b_type_id->ViewValue = $this->b_b_type_id->VirtualValue;
			} else {
				$curVal = strval($this->b_b_type_id->CurrentValue);
				if ($curVal != "") {
					$this->b_b_type_id->ViewValue = $this->b_b_type_id->lookupCacheOption($curVal);
					if ($this->b_b_type_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`business_type_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->b_b_type_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->b_b_type_id->ViewValue = $this->b_b_type_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->b_b_type_id->ViewValue = $this->b_b_type_id->CurrentValue;
						}
					}
				} else {
					$this->b_b_type_id->ViewValue = NULL;
				}
			}
			$this->b_b_type_id->ViewCustomAttributes = "";

			// b_b_status_id
			if ($this->b_b_status_id->VirtualValue != "") {
				$this->b_b_status_id->ViewValue = $this->b_b_status_id->VirtualValue;
			} else {
				$curVal = strval($this->b_b_status_id->CurrentValue);
				if ($curVal != "") {
					$this->b_b_status_id->ViewValue = $this->b_b_status_id->lookupCacheOption($curVal);
					if ($this->b_b_status_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`business_status_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->b_b_status_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->b_b_status_id->ViewValue = $this->b_b_status_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->b_b_status_id->ViewValue = $this->b_b_status_id->CurrentValue;
						}
					}
				} else {
					$this->b_b_status_id->ViewValue = NULL;
				}
			}
			$this->b_b_status_id->ViewCustomAttributes = "";

			// b_b_nature_id
			if ($this->b_b_nature_id->VirtualValue != "") {
				$this->b_b_nature_id->ViewValue = $this->b_b_nature_id->VirtualValue;
			} else {
				$curVal = strval($this->b_b_nature_id->CurrentValue);
				if ($curVal != "") {
					$this->b_b_nature_id->ViewValue = $this->b_b_nature_id->lookupCacheOption($curVal);
					if ($this->b_b_nature_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`b_nature_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->b_b_nature_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->b_b_nature_id->ViewValue = $this->b_b_nature_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->b_b_nature_id->ViewValue = $this->b_b_nature_id->CurrentValue;
						}
					}
				} else {
					$this->b_b_nature_id->ViewValue = NULL;
				}
			}
			$this->b_b_nature_id->ViewCustomAttributes = "";

			// b_city_id
			if ($this->b_city_id->VirtualValue != "") {
				$this->b_city_id->ViewValue = $this->b_city_id->VirtualValue;
			} else {
				$curVal = strval($this->b_city_id->CurrentValue);
				if ($curVal != "") {
					$this->b_city_id->ViewValue = $this->b_city_id->lookupCacheOption($curVal);
					if ($this->b_city_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`city_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->b_city_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->b_city_id->ViewValue = $this->b_city_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->b_city_id->ViewValue = $this->b_city_id->CurrentValue;
						}
					}
				} else {
					$this->b_city_id->ViewValue = NULL;
				}
			}
			$this->b_city_id->ViewCustomAttributes = "";

			// b_referral_id
			if ($this->b_referral_id->VirtualValue != "") {
				$this->b_referral_id->ViewValue = $this->b_referral_id->VirtualValue;
			} else {
				$curVal = strval($this->b_referral_id->CurrentValue);
				if ($curVal != "") {
					$this->b_referral_id->ViewValue = $this->b_referral_id->lookupCacheOption($curVal);
					if ($this->b_referral_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`referral_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->b_referral_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->b_referral_id->ViewValue = $this->b_referral_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->b_referral_id->ViewValue = $this->b_referral_id->CurrentValue;
						}
					}
				} else {
					$this->b_referral_id->ViewValue = NULL;
				}
			}
			$this->b_referral_id->ViewCustomAttributes = "";

			// b_name
			$this->b_name->ViewValue = $this->b_name->CurrentValue;
			$this->b_name->ViewCustomAttributes = "";

			// b_owner
			$this->b_owner->ViewValue = $this->b_owner->CurrentValue;
			$this->b_owner->ViewCustomAttributes = "";

			// b_contact
			$this->b_contact->ViewValue = $this->b_contact->CurrentValue;
			$this->b_contact->ViewCustomAttributes = "";

			// b_address
			$this->b_address->ViewValue = $this->b_address->CurrentValue;
			$this->b_address->ViewCustomAttributes = "";

			// b_email
			$this->b_email->ViewValue = $this->b_email->CurrentValue;
			$this->b_email->ViewCustomAttributes = "";

			// b_ntn
			$this->b_ntn->ViewValue = $this->b_ntn->CurrentValue;
			$this->b_ntn->ViewCustomAttributes = "";

			// b_logo
			if (!EmptyValue($this->b_logo->Upload->DbValue)) {
				$this->b_logo->ImageWidth = 200;
				$this->b_logo->ImageHeight = 0;
				$this->b_logo->ImageAlt = $this->b_logo->alt();
				$this->b_logo->ViewValue = $this->b_logo->Upload->DbValue;
			} else {
				$this->b_logo->ViewValue = "";
			}
			$this->b_logo->ViewCustomAttributes = "";

			// b_no_of_emp
			$this->b_no_of_emp->ViewValue = $this->b_no_of_emp->CurrentValue;
			$this->b_no_of_emp->ViewValue = FormatNumber($this->b_no_of_emp->ViewValue, 0, -2, -2, -2);
			$this->b_no_of_emp->ViewCustomAttributes = "";

			// b_since
			$this->b_since->ViewValue = $this->b_since->CurrentValue;
			$this->b_since->ViewCustomAttributes = "";

			// b_no_of_branches
			$this->b_no_of_branches->ViewValue = $this->b_no_of_branches->CurrentValue;
			$this->b_no_of_branches->ViewValue = FormatNumber($this->b_no_of_branches->ViewValue, 0, -2, -2, -2);
			$this->b_no_of_branches->ViewCustomAttributes = "";

			// b_deal_with_referral
			$this->b_deal_with_referral->ViewValue = $this->b_deal_with_referral->CurrentValue;
			$this->b_deal_with_referral->ViewCustomAttributes = "";

			// b_comments
			$this->b_comments->ViewValue = $this->b_comments->CurrentValue;
			$this->b_comments->ViewCustomAttributes = "";

			// b_branch_id
			$this->b_branch_id->LinkCustomAttributes = "";
			$this->b_branch_id->HrefValue = "";
			$this->b_branch_id->TooltipValue = "";

			// b_b_type_id
			$this->b_b_type_id->LinkCustomAttributes = "";
			$this->b_b_type_id->HrefValue = "";
			$this->b_b_type_id->TooltipValue = "";

			// b_b_status_id
			$this->b_b_status_id->LinkCustomAttributes = "";
			$this->b_b_status_id->HrefValue = "";
			$this->b_b_status_id->TooltipValue = "";

			// b_b_nature_id
			$this->b_b_nature_id->LinkCustomAttributes = "";
			$this->b_b_nature_id->HrefValue = "";
			$this->b_b_nature_id->TooltipValue = "";

			// b_city_id
			$this->b_city_id->LinkCustomAttributes = "";
			$this->b_city_id->HrefValue = "";
			$this->b_city_id->TooltipValue = "";

			// b_referral_id
			$this->b_referral_id->LinkCustomAttributes = "";
			$this->b_referral_id->HrefValue = "";
			$this->b_referral_id->TooltipValue = "";

			// b_name
			$this->b_name->LinkCustomAttributes = "";
			$this->b_name->HrefValue = "";
			$this->b_name->TooltipValue = "";

			// b_owner
			$this->b_owner->LinkCustomAttributes = "";
			$this->b_owner->HrefValue = "";
			$this->b_owner->TooltipValue = "";

			// b_contact
			$this->b_contact->LinkCustomAttributes = "";
			$this->b_contact->HrefValue = "";
			$this->b_contact->TooltipValue = "";

			// b_address
			$this->b_address->LinkCustomAttributes = "";
			$this->b_address->HrefValue = "";
			$this->b_address->TooltipValue = "";

			// b_email
			$this->b_email->LinkCustomAttributes = "";
			$this->b_email->HrefValue = "";
			$this->b_email->TooltipValue = "";

			// b_ntn
			$this->b_ntn->LinkCustomAttributes = "";
			$this->b_ntn->HrefValue = "";
			$this->b_ntn->TooltipValue = "";

			// b_logo
			$this->b_logo->LinkCustomAttributes = "";
			if (!EmptyValue($this->b_logo->Upload->DbValue)) {
				$this->b_logo->HrefValue = GetFileUploadUrl($this->b_logo, $this->b_logo->htmlDecode($this->b_logo->Upload->DbValue)); // Add prefix/suffix
				$this->b_logo->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->b_logo->HrefValue = FullUrl($this->b_logo->HrefValue, "href");
			} else {
				$this->b_logo->HrefValue = "";
			}
			$this->b_logo->ExportHrefValue = $this->b_logo->UploadPath . $this->b_logo->Upload->DbValue;
			$this->b_logo->TooltipValue = "";
			if ($this->b_logo->UseColorbox) {
				if (EmptyValue($this->b_logo->TooltipValue))
					$this->b_logo->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->b_logo->LinkAttrs["data-rel"] = "business_x_b_logo";
				$this->b_logo->LinkAttrs->appendClass("ew-lightbox");
			}

			// b_no_of_emp
			$this->b_no_of_emp->LinkCustomAttributes = "";
			$this->b_no_of_emp->HrefValue = "";
			$this->b_no_of_emp->TooltipValue = "";

			// b_since
			$this->b_since->LinkCustomAttributes = "";
			$this->b_since->HrefValue = "";
			$this->b_since->TooltipValue = "";

			// b_no_of_branches
			$this->b_no_of_branches->LinkCustomAttributes = "";
			$this->b_no_of_branches->HrefValue = "";
			$this->b_no_of_branches->TooltipValue = "";

			// b_deal_with_referral
			$this->b_deal_with_referral->LinkCustomAttributes = "";
			$this->b_deal_with_referral->HrefValue = "";
			$this->b_deal_with_referral->TooltipValue = "";

			// b_comments
			$this->b_comments->LinkCustomAttributes = "";
			$this->b_comments->HrefValue = "";
			$this->b_comments->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// b_branch_id
			$this->b_branch_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->b_branch_id->CurrentValue));
			if ($curVal != "")
				$this->b_branch_id->ViewValue = $this->b_branch_id->lookupCacheOption($curVal);
			else
				$this->b_branch_id->ViewValue = $this->b_branch_id->Lookup !== NULL && is_array($this->b_branch_id->Lookup->Options) ? $curVal : NULL;
			if ($this->b_branch_id->ViewValue !== NULL) { // Load from cache
				$this->b_branch_id->EditValue = array_values($this->b_branch_id->Lookup->Options);
				if ($this->b_branch_id->ViewValue == "")
					$this->b_branch_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`branch_id`" . SearchString("=", $this->b_branch_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->b_branch_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->b_branch_id->ViewValue = $this->b_branch_id->displayValue($arwrk);
				} else {
					$this->b_branch_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->b_branch_id->EditValue = $arwrk;
			}

			// b_b_type_id
			$this->b_b_type_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->b_b_type_id->CurrentValue));
			if ($curVal != "")
				$this->b_b_type_id->ViewValue = $this->b_b_type_id->lookupCacheOption($curVal);
			else
				$this->b_b_type_id->ViewValue = $this->b_b_type_id->Lookup !== NULL && is_array($this->b_b_type_id->Lookup->Options) ? $curVal : NULL;
			if ($this->b_b_type_id->ViewValue !== NULL) { // Load from cache
				$this->b_b_type_id->EditValue = array_values($this->b_b_type_id->Lookup->Options);
				if ($this->b_b_type_id->ViewValue == "")
					$this->b_b_type_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`business_type_id`" . SearchString("=", $this->b_b_type_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->b_b_type_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->b_b_type_id->ViewValue = $this->b_b_type_id->displayValue($arwrk);
				} else {
					$this->b_b_type_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->b_b_type_id->EditValue = $arwrk;
			}

			// b_b_status_id
			$this->b_b_status_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->b_b_status_id->CurrentValue));
			if ($curVal != "")
				$this->b_b_status_id->ViewValue = $this->b_b_status_id->lookupCacheOption($curVal);
			else
				$this->b_b_status_id->ViewValue = $this->b_b_status_id->Lookup !== NULL && is_array($this->b_b_status_id->Lookup->Options) ? $curVal : NULL;
			if ($this->b_b_status_id->ViewValue !== NULL) { // Load from cache
				$this->b_b_status_id->EditValue = array_values($this->b_b_status_id->Lookup->Options);
				if ($this->b_b_status_id->ViewValue == "")
					$this->b_b_status_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`business_status_id`" . SearchString("=", $this->b_b_status_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->b_b_status_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->b_b_status_id->ViewValue = $this->b_b_status_id->displayValue($arwrk);
				} else {
					$this->b_b_status_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->b_b_status_id->EditValue = $arwrk;
			}

			// b_b_nature_id
			$this->b_b_nature_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->b_b_nature_id->CurrentValue));
			if ($curVal != "")
				$this->b_b_nature_id->ViewValue = $this->b_b_nature_id->lookupCacheOption($curVal);
			else
				$this->b_b_nature_id->ViewValue = $this->b_b_nature_id->Lookup !== NULL && is_array($this->b_b_nature_id->Lookup->Options) ? $curVal : NULL;
			if ($this->b_b_nature_id->ViewValue !== NULL) { // Load from cache
				$this->b_b_nature_id->EditValue = array_values($this->b_b_nature_id->Lookup->Options);
				if ($this->b_b_nature_id->ViewValue == "")
					$this->b_b_nature_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`b_nature_id`" . SearchString("=", $this->b_b_nature_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->b_b_nature_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->b_b_nature_id->ViewValue = $this->b_b_nature_id->displayValue($arwrk);
				} else {
					$this->b_b_nature_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->b_b_nature_id->EditValue = $arwrk;
			}

			// b_city_id
			$this->b_city_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->b_city_id->CurrentValue));
			if ($curVal != "")
				$this->b_city_id->ViewValue = $this->b_city_id->lookupCacheOption($curVal);
			else
				$this->b_city_id->ViewValue = $this->b_city_id->Lookup !== NULL && is_array($this->b_city_id->Lookup->Options) ? $curVal : NULL;
			if ($this->b_city_id->ViewValue !== NULL) { // Load from cache
				$this->b_city_id->EditValue = array_values($this->b_city_id->Lookup->Options);
				if ($this->b_city_id->ViewValue == "")
					$this->b_city_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`city_id`" . SearchString("=", $this->b_city_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->b_city_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->b_city_id->ViewValue = $this->b_city_id->displayValue($arwrk);
				} else {
					$this->b_city_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->b_city_id->EditValue = $arwrk;
			}

			// b_referral_id
			$this->b_referral_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->b_referral_id->CurrentValue));
			if ($curVal != "")
				$this->b_referral_id->ViewValue = $this->b_referral_id->lookupCacheOption($curVal);
			else
				$this->b_referral_id->ViewValue = $this->b_referral_id->Lookup !== NULL && is_array($this->b_referral_id->Lookup->Options) ? $curVal : NULL;
			if ($this->b_referral_id->ViewValue !== NULL) { // Load from cache
				$this->b_referral_id->EditValue = array_values($this->b_referral_id->Lookup->Options);
				if ($this->b_referral_id->ViewValue == "")
					$this->b_referral_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`referral_id`" . SearchString("=", $this->b_referral_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->b_referral_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->b_referral_id->ViewValue = $this->b_referral_id->displayValue($arwrk);
				} else {
					$this->b_referral_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->b_referral_id->EditValue = $arwrk;
			}

			// b_name
			$this->b_name->EditAttrs["class"] = "form-control";
			$this->b_name->EditCustomAttributes = "";
			if (!$this->b_name->Raw)
				$this->b_name->CurrentValue = HtmlDecode($this->b_name->CurrentValue);
			$this->b_name->EditValue = HtmlEncode($this->b_name->CurrentValue);
			$this->b_name->PlaceHolder = RemoveHtml($this->b_name->caption());

			// b_owner
			$this->b_owner->EditAttrs["class"] = "form-control";
			$this->b_owner->EditCustomAttributes = "";
			if (!$this->b_owner->Raw)
				$this->b_owner->CurrentValue = HtmlDecode($this->b_owner->CurrentValue);
			$this->b_owner->EditValue = HtmlEncode($this->b_owner->CurrentValue);
			$this->b_owner->PlaceHolder = RemoveHtml($this->b_owner->caption());

			// b_contact
			$this->b_contact->EditAttrs["class"] = "form-control";
			$this->b_contact->EditCustomAttributes = "";
			if (!$this->b_contact->Raw)
				$this->b_contact->CurrentValue = HtmlDecode($this->b_contact->CurrentValue);
			$this->b_contact->EditValue = HtmlEncode($this->b_contact->CurrentValue);
			$this->b_contact->PlaceHolder = RemoveHtml($this->b_contact->caption());

			// b_address
			$this->b_address->EditAttrs["class"] = "form-control";
			$this->b_address->EditCustomAttributes = "";
			$this->b_address->EditValue = HtmlEncode($this->b_address->CurrentValue);
			$this->b_address->PlaceHolder = RemoveHtml($this->b_address->caption());

			// b_email
			$this->b_email->EditAttrs["class"] = "form-control";
			$this->b_email->EditCustomAttributes = "";
			if (!$this->b_email->Raw)
				$this->b_email->CurrentValue = HtmlDecode($this->b_email->CurrentValue);
			$this->b_email->EditValue = HtmlEncode($this->b_email->CurrentValue);
			$this->b_email->PlaceHolder = RemoveHtml($this->b_email->caption());

			// b_ntn
			$this->b_ntn->EditAttrs["class"] = "form-control";
			$this->b_ntn->EditCustomAttributes = "";
			if (!$this->b_ntn->Raw)
				$this->b_ntn->CurrentValue = HtmlDecode($this->b_ntn->CurrentValue);
			$this->b_ntn->EditValue = HtmlEncode($this->b_ntn->CurrentValue);
			$this->b_ntn->PlaceHolder = RemoveHtml($this->b_ntn->caption());

			// b_logo
			$this->b_logo->EditAttrs["class"] = "form-control";
			$this->b_logo->EditCustomAttributes = "";
			if (!EmptyValue($this->b_logo->Upload->DbValue)) {
				$this->b_logo->ImageWidth = 200;
				$this->b_logo->ImageHeight = 0;
				$this->b_logo->ImageAlt = $this->b_logo->alt();
				$this->b_logo->EditValue = $this->b_logo->Upload->DbValue;
			} else {
				$this->b_logo->EditValue = "";
			}
			if (!EmptyValue($this->b_logo->CurrentValue))
					$this->b_logo->Upload->FileName = $this->b_logo->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->b_logo);

			// b_no_of_emp
			$this->b_no_of_emp->EditAttrs["class"] = "form-control";
			$this->b_no_of_emp->EditCustomAttributes = "";
			$this->b_no_of_emp->EditValue = HtmlEncode($this->b_no_of_emp->CurrentValue);
			$this->b_no_of_emp->PlaceHolder = RemoveHtml($this->b_no_of_emp->caption());

			// b_since
			$this->b_since->EditAttrs["class"] = "form-control";
			$this->b_since->EditCustomAttributes = "";
			if (!$this->b_since->Raw)
				$this->b_since->CurrentValue = HtmlDecode($this->b_since->CurrentValue);
			$this->b_since->EditValue = HtmlEncode($this->b_since->CurrentValue);
			$this->b_since->PlaceHolder = RemoveHtml($this->b_since->caption());

			// b_no_of_branches
			$this->b_no_of_branches->EditAttrs["class"] = "form-control";
			$this->b_no_of_branches->EditCustomAttributes = "";
			$this->b_no_of_branches->EditValue = HtmlEncode($this->b_no_of_branches->CurrentValue);
			$this->b_no_of_branches->PlaceHolder = RemoveHtml($this->b_no_of_branches->caption());

			// b_deal_with_referral
			$this->b_deal_with_referral->EditAttrs["class"] = "form-control";
			$this->b_deal_with_referral->EditCustomAttributes = "";
			$this->b_deal_with_referral->EditValue = HtmlEncode($this->b_deal_with_referral->CurrentValue);
			$this->b_deal_with_referral->PlaceHolder = RemoveHtml($this->b_deal_with_referral->caption());

			// b_comments
			$this->b_comments->EditAttrs["class"] = "form-control";
			$this->b_comments->EditCustomAttributes = "";
			$this->b_comments->EditValue = HtmlEncode($this->b_comments->CurrentValue);
			$this->b_comments->PlaceHolder = RemoveHtml($this->b_comments->caption());

			// Add refer script
			// b_branch_id

			$this->b_branch_id->LinkCustomAttributes = "";
			$this->b_branch_id->HrefValue = "";

			// b_b_type_id
			$this->b_b_type_id->LinkCustomAttributes = "";
			$this->b_b_type_id->HrefValue = "";

			// b_b_status_id
			$this->b_b_status_id->LinkCustomAttributes = "";
			$this->b_b_status_id->HrefValue = "";

			// b_b_nature_id
			$this->b_b_nature_id->LinkCustomAttributes = "";
			$this->b_b_nature_id->HrefValue = "";

			// b_city_id
			$this->b_city_id->LinkCustomAttributes = "";
			$this->b_city_id->HrefValue = "";

			// b_referral_id
			$this->b_referral_id->LinkCustomAttributes = "";
			$this->b_referral_id->HrefValue = "";

			// b_name
			$this->b_name->LinkCustomAttributes = "";
			$this->b_name->HrefValue = "";

			// b_owner
			$this->b_owner->LinkCustomAttributes = "";
			$this->b_owner->HrefValue = "";

			// b_contact
			$this->b_contact->LinkCustomAttributes = "";
			$this->b_contact->HrefValue = "";

			// b_address
			$this->b_address->LinkCustomAttributes = "";
			$this->b_address->HrefValue = "";

			// b_email
			$this->b_email->LinkCustomAttributes = "";
			$this->b_email->HrefValue = "";

			// b_ntn
			$this->b_ntn->LinkCustomAttributes = "";
			$this->b_ntn->HrefValue = "";

			// b_logo
			$this->b_logo->LinkCustomAttributes = "";
			if (!EmptyValue($this->b_logo->Upload->DbValue)) {
				$this->b_logo->HrefValue = GetFileUploadUrl($this->b_logo, $this->b_logo->htmlDecode($this->b_logo->Upload->DbValue)); // Add prefix/suffix
				$this->b_logo->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->b_logo->HrefValue = FullUrl($this->b_logo->HrefValue, "href");
			} else {
				$this->b_logo->HrefValue = "";
			}
			$this->b_logo->ExportHrefValue = $this->b_logo->UploadPath . $this->b_logo->Upload->DbValue;

			// b_no_of_emp
			$this->b_no_of_emp->LinkCustomAttributes = "";
			$this->b_no_of_emp->HrefValue = "";

			// b_since
			$this->b_since->LinkCustomAttributes = "";
			$this->b_since->HrefValue = "";

			// b_no_of_branches
			$this->b_no_of_branches->LinkCustomAttributes = "";
			$this->b_no_of_branches->HrefValue = "";

			// b_deal_with_referral
			$this->b_deal_with_referral->LinkCustomAttributes = "";
			$this->b_deal_with_referral->HrefValue = "";

			// b_comments
			$this->b_comments->LinkCustomAttributes = "";
			$this->b_comments->HrefValue = "";
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
		if ($this->b_branch_id->Required) {
			if (!$this->b_branch_id->IsDetailKey && $this->b_branch_id->FormValue != NULL && $this->b_branch_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_branch_id->caption(), $this->b_branch_id->RequiredErrorMessage));
			}
		}
		if ($this->b_b_type_id->Required) {
			if (!$this->b_b_type_id->IsDetailKey && $this->b_b_type_id->FormValue != NULL && $this->b_b_type_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_b_type_id->caption(), $this->b_b_type_id->RequiredErrorMessage));
			}
		}
		if ($this->b_b_status_id->Required) {
			if (!$this->b_b_status_id->IsDetailKey && $this->b_b_status_id->FormValue != NULL && $this->b_b_status_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_b_status_id->caption(), $this->b_b_status_id->RequiredErrorMessage));
			}
		}
		if ($this->b_b_nature_id->Required) {
			if (!$this->b_b_nature_id->IsDetailKey && $this->b_b_nature_id->FormValue != NULL && $this->b_b_nature_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_b_nature_id->caption(), $this->b_b_nature_id->RequiredErrorMessage));
			}
		}
		if ($this->b_city_id->Required) {
			if (!$this->b_city_id->IsDetailKey && $this->b_city_id->FormValue != NULL && $this->b_city_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_city_id->caption(), $this->b_city_id->RequiredErrorMessage));
			}
		}
		if ($this->b_referral_id->Required) {
			if (!$this->b_referral_id->IsDetailKey && $this->b_referral_id->FormValue != NULL && $this->b_referral_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_referral_id->caption(), $this->b_referral_id->RequiredErrorMessage));
			}
		}
		if ($this->b_name->Required) {
			if (!$this->b_name->IsDetailKey && $this->b_name->FormValue != NULL && $this->b_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_name->caption(), $this->b_name->RequiredErrorMessage));
			}
		}
		if ($this->b_owner->Required) {
			if (!$this->b_owner->IsDetailKey && $this->b_owner->FormValue != NULL && $this->b_owner->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_owner->caption(), $this->b_owner->RequiredErrorMessage));
			}
		}
		if ($this->b_contact->Required) {
			if (!$this->b_contact->IsDetailKey && $this->b_contact->FormValue != NULL && $this->b_contact->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_contact->caption(), $this->b_contact->RequiredErrorMessage));
			}
		}
		if ($this->b_address->Required) {
			if (!$this->b_address->IsDetailKey && $this->b_address->FormValue != NULL && $this->b_address->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_address->caption(), $this->b_address->RequiredErrorMessage));
			}
		}
		if ($this->b_email->Required) {
			if (!$this->b_email->IsDetailKey && $this->b_email->FormValue != NULL && $this->b_email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_email->caption(), $this->b_email->RequiredErrorMessage));
			}
		}
		if ($this->b_ntn->Required) {
			if (!$this->b_ntn->IsDetailKey && $this->b_ntn->FormValue != NULL && $this->b_ntn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_ntn->caption(), $this->b_ntn->RequiredErrorMessage));
			}
		}
		if ($this->b_logo->Required) {
			if ($this->b_logo->Upload->FileName == "" && !$this->b_logo->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->b_logo->caption(), $this->b_logo->RequiredErrorMessage));
			}
		}
		if ($this->b_no_of_emp->Required) {
			if (!$this->b_no_of_emp->IsDetailKey && $this->b_no_of_emp->FormValue != NULL && $this->b_no_of_emp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_no_of_emp->caption(), $this->b_no_of_emp->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->b_no_of_emp->FormValue)) {
			AddMessage($FormError, $this->b_no_of_emp->errorMessage());
		}
		if ($this->b_since->Required) {
			if (!$this->b_since->IsDetailKey && $this->b_since->FormValue != NULL && $this->b_since->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_since->caption(), $this->b_since->RequiredErrorMessage));
			}
		}
		if ($this->b_no_of_branches->Required) {
			if (!$this->b_no_of_branches->IsDetailKey && $this->b_no_of_branches->FormValue != NULL && $this->b_no_of_branches->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_no_of_branches->caption(), $this->b_no_of_branches->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->b_no_of_branches->FormValue)) {
			AddMessage($FormError, $this->b_no_of_branches->errorMessage());
		}
		if ($this->b_deal_with_referral->Required) {
			if (!$this->b_deal_with_referral->IsDetailKey && $this->b_deal_with_referral->FormValue != NULL && $this->b_deal_with_referral->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_deal_with_referral->caption(), $this->b_deal_with_referral->RequiredErrorMessage));
			}
		}
		if ($this->b_comments->Required) {
			if (!$this->b_comments->IsDetailKey && $this->b_comments->FormValue != NULL && $this->b_comments->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_comments->caption(), $this->b_comments->RequiredErrorMessage));
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

		// b_branch_id
		$this->b_branch_id->setDbValueDef($rsnew, $this->b_branch_id->CurrentValue, 0, FALSE);

		// b_b_type_id
		$this->b_b_type_id->setDbValueDef($rsnew, $this->b_b_type_id->CurrentValue, 0, FALSE);

		// b_b_status_id
		$this->b_b_status_id->setDbValueDef($rsnew, $this->b_b_status_id->CurrentValue, 0, FALSE);

		// b_b_nature_id
		$this->b_b_nature_id->setDbValueDef($rsnew, $this->b_b_nature_id->CurrentValue, 0, FALSE);

		// b_city_id
		$this->b_city_id->setDbValueDef($rsnew, $this->b_city_id->CurrentValue, 0, FALSE);

		// b_referral_id
		$this->b_referral_id->setDbValueDef($rsnew, $this->b_referral_id->CurrentValue, NULL, FALSE);

		// b_name
		$this->b_name->setDbValueDef($rsnew, $this->b_name->CurrentValue, "", FALSE);

		// b_owner
		$this->b_owner->setDbValueDef($rsnew, $this->b_owner->CurrentValue, "", FALSE);

		// b_contact
		$this->b_contact->setDbValueDef($rsnew, $this->b_contact->CurrentValue, "", FALSE);

		// b_address
		$this->b_address->setDbValueDef($rsnew, $this->b_address->CurrentValue, "", FALSE);

		// b_email
		$this->b_email->setDbValueDef($rsnew, $this->b_email->CurrentValue, "", FALSE);

		// b_ntn
		$this->b_ntn->setDbValueDef($rsnew, $this->b_ntn->CurrentValue, "", FALSE);

		// b_logo
		if ($this->b_logo->Visible && !$this->b_logo->Upload->KeepFile) {
			$this->b_logo->Upload->DbValue = ""; // No need to delete old file
			if ($this->b_logo->Upload->FileName == "") {
				$rsnew['b_logo'] = NULL;
			} else {
				$rsnew['b_logo'] = $this->b_logo->Upload->FileName;
			}
			$this->b_logo->ImageWidth = 1000; // Resize width
			$this->b_logo->ImageHeight = 0; // Resize height
		}

		// b_no_of_emp
		$this->b_no_of_emp->setDbValueDef($rsnew, $this->b_no_of_emp->CurrentValue, 0, FALSE);

		// b_since
		$this->b_since->setDbValueDef($rsnew, $this->b_since->CurrentValue, "", FALSE);

		// b_no_of_branches
		$this->b_no_of_branches->setDbValueDef($rsnew, $this->b_no_of_branches->CurrentValue, 0, FALSE);

		// b_deal_with_referral
		$this->b_deal_with_referral->setDbValueDef($rsnew, $this->b_deal_with_referral->CurrentValue, NULL, FALSE);

		// b_comments
		$this->b_comments->setDbValueDef($rsnew, $this->b_comments->CurrentValue, "", FALSE);
		if ($this->b_logo->Visible && !$this->b_logo->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->b_logo->Upload->DbValue) ? [] : [$this->b_logo->htmlDecode($this->b_logo->Upload->DbValue)];
			if (!EmptyValue($this->b_logo->Upload->FileName)) {
				$newFiles = [$this->b_logo->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->b_logo, $this->b_logo->Upload->Index);
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
							$file1 = UniqueFilename($this->b_logo->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->b_logo->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->b_logo->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->b_logo->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->b_logo->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->b_logo->setDbValueDef($rsnew, $this->b_logo->Upload->FileName, "", FALSE);
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
				if ($this->b_logo->Visible && !$this->b_logo->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->b_logo->Upload->DbValue) ? [] : [$this->b_logo->htmlDecode($this->b_logo->Upload->DbValue)];
					if (!EmptyValue($this->b_logo->Upload->FileName)) {
						$newFiles = [$this->b_logo->Upload->FileName];
						$newFiles2 = [$this->b_logo->htmlDecode($rsnew['b_logo'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->b_logo, $this->b_logo->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->b_logo->Upload->ResizeAndSaveToFile($this->b_logo->ImageWidth, $this->b_logo->ImageHeight, 100, $newFiles[$i], TRUE, $i)) {
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
								@unlink($this->b_logo->oldPhysicalUploadPath() . $oldFile);
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

			// b_logo
			if ($this->b_logo->Upload->FileToken != "")
				CleanUploadTempPath($this->b_logo->Upload->FileToken, $this->b_logo->Upload->Index);
			else
				CleanUploadTempPath($this->b_logo, $this->b_logo->Upload->Index);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("businesslist.php"), "", $this->TableVar, TRUE);
		$pageId = "addopt";
		$Breadcrumb->add("addopt", $pageId, $url);
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
				case "x_b_branch_id":
					break;
				case "x_b_b_type_id":
					break;
				case "x_b_b_status_id":
					break;
				case "x_b_b_nature_id":
					break;
				case "x_b_city_id":
					break;
				case "x_b_referral_id":
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
						case "x_b_branch_id":
							break;
						case "x_b_b_type_id":
							break;
						case "x_b_b_status_id":
							break;
						case "x_b_b_nature_id":
							break;
						case "x_b_city_id":
							break;
						case "x_b_referral_id":
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
} // End class
?>