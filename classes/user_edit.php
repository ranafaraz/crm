<?php
namespace PHPMaker2020\crm_live;

/**
 * Page class
 */
class user_edit extends user
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{BFF6A03D-187E-47A2-84E2-79ECDD25AAA0}";

	// Table name
	public $TableName = 'user';

	// Page object name
	public $PageObjName = "user_edit";

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

		// Table object (user)
		if (!isset($GLOBALS["user"]) || get_class($GLOBALS["user"]) == PROJECT_NAMESPACE . "user") {
			$GLOBALS["user"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["user"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'user');

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
		global $user;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($user);
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
					if ($pageName == "userview.php")
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
			$key .= @$ar['user_id'];
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
			$this->user_id->Visible = FALSE;
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
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("userlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->user_id->setVisibility();
		$this->user_branch_id->setVisibility();
		$this->user_type_id->setVisibility();
		$this->user_name->setVisibility();
		$this->user_password->setVisibility();
		$this->user_email->setVisibility();
		$this->user_father->setVisibility();
		$this->user_photo->setVisibility();
		$this->user_cnic->setVisibility();
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
		$this->setupLookupOptions($this->user_branch_id);
		$this->setupLookupOptions($this->user_type_id);

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
			if ($CurrentForm->hasValue("x_user_id")) {
				$this->user_id->setFormValue($CurrentForm->getValue("x_user_id"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("user_id") !== NULL) {
				$this->user_id->setQueryStringValue(Get("user_id"));
				$loadByQuery = TRUE;
			} else {
				$this->user_id->CurrentValue = NULL;
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
					$this->terminate("userlist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "userlist.php")
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
		$this->user_photo->Upload->Index = $CurrentForm->Index;
		$this->user_photo->Upload->uploadFile();
		$this->user_photo->CurrentValue = $this->user_photo->Upload->FileName;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'user_id' first before field var 'x_user_id'
		$val = $CurrentForm->hasValue("user_id") ? $CurrentForm->getValue("user_id") : $CurrentForm->getValue("x_user_id");
		if (!$this->user_id->IsDetailKey)
			$this->user_id->setFormValue($val);

		// Check field name 'user_branch_id' first before field var 'x_user_branch_id'
		$val = $CurrentForm->hasValue("user_branch_id") ? $CurrentForm->getValue("user_branch_id") : $CurrentForm->getValue("x_user_branch_id");
		if (!$this->user_branch_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->user_branch_id->Visible = FALSE; // Disable update for API request
			else
				$this->user_branch_id->setFormValue($val);
		}

		// Check field name 'user_type_id' first before field var 'x_user_type_id'
		$val = $CurrentForm->hasValue("user_type_id") ? $CurrentForm->getValue("user_type_id") : $CurrentForm->getValue("x_user_type_id");
		if (!$this->user_type_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->user_type_id->Visible = FALSE; // Disable update for API request
			else
				$this->user_type_id->setFormValue($val);
		}

		// Check field name 'user_name' first before field var 'x_user_name'
		$val = $CurrentForm->hasValue("user_name") ? $CurrentForm->getValue("user_name") : $CurrentForm->getValue("x_user_name");
		if (!$this->user_name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->user_name->Visible = FALSE; // Disable update for API request
			else
				$this->user_name->setFormValue($val);
		}

		// Check field name 'user_password' first before field var 'x_user_password'
		$val = $CurrentForm->hasValue("user_password") ? $CurrentForm->getValue("user_password") : $CurrentForm->getValue("x_user_password");
		if (!$this->user_password->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->user_password->Visible = FALSE; // Disable update for API request
			else
				$this->user_password->setFormValue($val);
		}

		// Check field name 'user_email' first before field var 'x_user_email'
		$val = $CurrentForm->hasValue("user_email") ? $CurrentForm->getValue("user_email") : $CurrentForm->getValue("x_user_email");
		if (!$this->user_email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->user_email->Visible = FALSE; // Disable update for API request
			else
				$this->user_email->setFormValue($val);
		}

		// Check field name 'user_father' first before field var 'x_user_father'
		$val = $CurrentForm->hasValue("user_father") ? $CurrentForm->getValue("user_father") : $CurrentForm->getValue("x_user_father");
		if (!$this->user_father->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->user_father->Visible = FALSE; // Disable update for API request
			else
				$this->user_father->setFormValue($val);
		}

		// Check field name 'user_cnic' first before field var 'x_user_cnic'
		$val = $CurrentForm->hasValue("user_cnic") ? $CurrentForm->getValue("user_cnic") : $CurrentForm->getValue("x_user_cnic");
		if (!$this->user_cnic->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->user_cnic->Visible = FALSE; // Disable update for API request
			else
				$this->user_cnic->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->user_branch_id->CurrentValue = $this->user_branch_id->FormValue;
		$this->user_type_id->CurrentValue = $this->user_type_id->FormValue;
		$this->user_name->CurrentValue = $this->user_name->FormValue;
		$this->user_password->CurrentValue = $this->user_password->FormValue;
		$this->user_email->CurrentValue = $this->user_email->FormValue;
		$this->user_father->CurrentValue = $this->user_father->FormValue;
		$this->user_cnic->CurrentValue = $this->user_cnic->FormValue;
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
		$this->user_id->setDbValue($row['user_id']);
		$this->user_branch_id->setDbValue($row['user_branch_id']);
		if (array_key_exists('EV__user_branch_id', $rs->fields)) {
			$this->user_branch_id->VirtualValue = $rs->fields('EV__user_branch_id'); // Set up virtual field value
		} else {
			$this->user_branch_id->VirtualValue = ""; // Clear value
		}
		$this->user_type_id->setDbValue($row['user_type_id']);
		if (array_key_exists('EV__user_type_id', $rs->fields)) {
			$this->user_type_id->VirtualValue = $rs->fields('EV__user_type_id'); // Set up virtual field value
		} else {
			$this->user_type_id->VirtualValue = ""; // Clear value
		}
		$this->user_name->setDbValue($row['user_name']);
		$this->user_password->setDbValue($row['user_password']);
		$this->user_email->setDbValue($row['user_email']);
		$this->user_father->setDbValue($row['user_father']);
		$this->user_photo->Upload->DbValue = $row['user_photo'];
		$this->user_photo->setDbValue($this->user_photo->Upload->DbValue);
		$this->user_cnic->setDbValue($row['user_cnic']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['user_id'] = NULL;
		$row['user_branch_id'] = NULL;
		$row['user_type_id'] = NULL;
		$row['user_name'] = NULL;
		$row['user_password'] = NULL;
		$row['user_email'] = NULL;
		$row['user_father'] = NULL;
		$row['user_photo'] = NULL;
		$row['user_cnic'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("user_id")) != "")
			$this->user_id->OldValue = $this->getKey("user_id"); // user_id
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
		// user_id
		// user_branch_id
		// user_type_id
		// user_name
		// user_password
		// user_email
		// user_father
		// user_photo
		// user_cnic

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// user_id
			$this->user_id->ViewValue = $this->user_id->CurrentValue;
			$this->user_id->CssClass = "font-weight-bold";
			$this->user_id->ViewCustomAttributes = "";

			// user_branch_id
			if ($this->user_branch_id->VirtualValue != "") {
				$this->user_branch_id->ViewValue = $this->user_branch_id->VirtualValue;
			} else {
				$curVal = strval($this->user_branch_id->CurrentValue);
				if ($curVal != "") {
					$this->user_branch_id->ViewValue = $this->user_branch_id->lookupCacheOption($curVal);
					if ($this->user_branch_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`branch_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->user_branch_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->user_branch_id->ViewValue = $this->user_branch_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->user_branch_id->ViewValue = $this->user_branch_id->CurrentValue;
						}
					}
				} else {
					$this->user_branch_id->ViewValue = NULL;
				}
			}
			$this->user_branch_id->ViewCustomAttributes = "";

			// user_type_id
			if ($this->user_type_id->VirtualValue != "") {
				$this->user_type_id->ViewValue = $this->user_type_id->VirtualValue;
			} else {
				$curVal = strval($this->user_type_id->CurrentValue);
				if ($curVal != "") {
					$this->user_type_id->ViewValue = $this->user_type_id->lookupCacheOption($curVal);
					if ($this->user_type_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`user_type_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->user_type_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->user_type_id->ViewValue = $this->user_type_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->user_type_id->ViewValue = $this->user_type_id->CurrentValue;
						}
					}
				} else {
					$this->user_type_id->ViewValue = NULL;
				}
			}
			$this->user_type_id->ViewCustomAttributes = "";

			// user_name
			$this->user_name->ViewValue = $this->user_name->CurrentValue;
			$this->user_name->ViewCustomAttributes = "";

			// user_password
			$this->user_password->ViewValue = $Language->phrase("PasswordMask");
			$this->user_password->ViewCustomAttributes = "";

			// user_email
			$this->user_email->ViewValue = $this->user_email->CurrentValue;
			$this->user_email->ViewCustomAttributes = "";

			// user_father
			$this->user_father->ViewValue = $this->user_father->CurrentValue;
			$this->user_father->ViewCustomAttributes = "";

			// user_photo
			if (!EmptyValue($this->user_photo->Upload->DbValue)) {
				$this->user_photo->ImageWidth = 200;
				$this->user_photo->ImageHeight = 0;
				$this->user_photo->ImageAlt = $this->user_photo->alt();
				$this->user_photo->ViewValue = $this->user_photo->Upload->DbValue;
			} else {
				$this->user_photo->ViewValue = "";
			}
			$this->user_photo->ViewCustomAttributes = "";

			// user_cnic
			$this->user_cnic->ViewValue = $this->user_cnic->CurrentValue;
			$this->user_cnic->ViewCustomAttributes = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// user_branch_id
			$this->user_branch_id->LinkCustomAttributes = "";
			$this->user_branch_id->HrefValue = "";
			$this->user_branch_id->TooltipValue = "";

			// user_type_id
			$this->user_type_id->LinkCustomAttributes = "";
			$this->user_type_id->HrefValue = "";
			$this->user_type_id->TooltipValue = "";

			// user_name
			$this->user_name->LinkCustomAttributes = "";
			$this->user_name->HrefValue = "";
			$this->user_name->TooltipValue = "";

			// user_password
			$this->user_password->LinkCustomAttributes = "";
			$this->user_password->HrefValue = "";
			$this->user_password->TooltipValue = "";

			// user_email
			$this->user_email->LinkCustomAttributes = "";
			$this->user_email->HrefValue = "";
			$this->user_email->TooltipValue = "";

			// user_father
			$this->user_father->LinkCustomAttributes = "";
			$this->user_father->HrefValue = "";
			$this->user_father->TooltipValue = "";

			// user_photo
			$this->user_photo->LinkCustomAttributes = "";
			if (!EmptyValue($this->user_photo->Upload->DbValue)) {
				$this->user_photo->HrefValue = GetFileUploadUrl($this->user_photo, $this->user_photo->htmlDecode($this->user_photo->Upload->DbValue)); // Add prefix/suffix
				$this->user_photo->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->user_photo->HrefValue = FullUrl($this->user_photo->HrefValue, "href");
			} else {
				$this->user_photo->HrefValue = "";
			}
			$this->user_photo->ExportHrefValue = $this->user_photo->UploadPath . $this->user_photo->Upload->DbValue;
			$this->user_photo->TooltipValue = "";
			if ($this->user_photo->UseColorbox) {
				if (EmptyValue($this->user_photo->TooltipValue))
					$this->user_photo->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->user_photo->LinkAttrs["data-rel"] = "user_x_user_photo";
				$this->user_photo->LinkAttrs->appendClass("ew-lightbox");
			}

			// user_cnic
			$this->user_cnic->LinkCustomAttributes = "";
			$this->user_cnic->HrefValue = "";
			$this->user_cnic->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// user_id
			$this->user_id->EditAttrs["class"] = "form-control";
			$this->user_id->EditCustomAttributes = "";
			$this->user_id->EditValue = $this->user_id->CurrentValue;
			$this->user_id->CssClass = "font-weight-bold";
			$this->user_id->ViewCustomAttributes = "";

			// user_branch_id
			$this->user_branch_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->user_branch_id->CurrentValue));
			if ($curVal != "")
				$this->user_branch_id->ViewValue = $this->user_branch_id->lookupCacheOption($curVal);
			else
				$this->user_branch_id->ViewValue = $this->user_branch_id->Lookup !== NULL && is_array($this->user_branch_id->Lookup->Options) ? $curVal : NULL;
			if ($this->user_branch_id->ViewValue !== NULL) { // Load from cache
				$this->user_branch_id->EditValue = array_values($this->user_branch_id->Lookup->Options);
				if ($this->user_branch_id->ViewValue == "")
					$this->user_branch_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`branch_id`" . SearchString("=", $this->user_branch_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->user_branch_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->user_branch_id->ViewValue = $this->user_branch_id->displayValue($arwrk);
				} else {
					$this->user_branch_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->user_branch_id->EditValue = $arwrk;
			}

			// user_type_id
			$this->user_type_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->user_type_id->CurrentValue));
			if ($curVal != "")
				$this->user_type_id->ViewValue = $this->user_type_id->lookupCacheOption($curVal);
			else
				$this->user_type_id->ViewValue = $this->user_type_id->Lookup !== NULL && is_array($this->user_type_id->Lookup->Options) ? $curVal : NULL;
			if ($this->user_type_id->ViewValue !== NULL) { // Load from cache
				$this->user_type_id->EditValue = array_values($this->user_type_id->Lookup->Options);
				if ($this->user_type_id->ViewValue == "")
					$this->user_type_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`user_type_id`" . SearchString("=", $this->user_type_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->user_type_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->user_type_id->ViewValue = $this->user_type_id->displayValue($arwrk);
				} else {
					$this->user_type_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->user_type_id->EditValue = $arwrk;
			}

			// user_name
			$this->user_name->EditAttrs["class"] = "form-control";
			$this->user_name->EditCustomAttributes = "";
			if (!$this->user_name->Raw)
				$this->user_name->CurrentValue = HtmlDecode($this->user_name->CurrentValue);
			$this->user_name->EditValue = HtmlEncode($this->user_name->CurrentValue);
			$this->user_name->PlaceHolder = RemoveHtml($this->user_name->caption());

			// user_password
			$this->user_password->EditAttrs["class"] = "form-control ew-password-strength";
			$this->user_password->EditCustomAttributes = "";
			$this->user_password->EditValue = HtmlEncode($this->user_password->CurrentValue);
			$this->user_password->PlaceHolder = RemoveHtml($this->user_password->caption());

			// user_email
			$this->user_email->EditAttrs["class"] = "form-control";
			$this->user_email->EditCustomAttributes = "";
			if (!$this->user_email->Raw)
				$this->user_email->CurrentValue = HtmlDecode($this->user_email->CurrentValue);
			$this->user_email->EditValue = HtmlEncode($this->user_email->CurrentValue);
			$this->user_email->PlaceHolder = RemoveHtml($this->user_email->caption());

			// user_father
			$this->user_father->EditAttrs["class"] = "form-control";
			$this->user_father->EditCustomAttributes = "";
			if (!$this->user_father->Raw)
				$this->user_father->CurrentValue = HtmlDecode($this->user_father->CurrentValue);
			$this->user_father->EditValue = HtmlEncode($this->user_father->CurrentValue);
			$this->user_father->PlaceHolder = RemoveHtml($this->user_father->caption());

			// user_photo
			$this->user_photo->EditAttrs["class"] = "form-control";
			$this->user_photo->EditCustomAttributes = "";
			if (!EmptyValue($this->user_photo->Upload->DbValue)) {
				$this->user_photo->ImageWidth = 200;
				$this->user_photo->ImageHeight = 0;
				$this->user_photo->ImageAlt = $this->user_photo->alt();
				$this->user_photo->EditValue = $this->user_photo->Upload->DbValue;
			} else {
				$this->user_photo->EditValue = "";
			}
			if (!EmptyValue($this->user_photo->CurrentValue))
					$this->user_photo->Upload->FileName = $this->user_photo->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->user_photo);

			// user_cnic
			$this->user_cnic->EditAttrs["class"] = "form-control";
			$this->user_cnic->EditCustomAttributes = "";
			if (!$this->user_cnic->Raw)
				$this->user_cnic->CurrentValue = HtmlDecode($this->user_cnic->CurrentValue);
			$this->user_cnic->EditValue = HtmlEncode($this->user_cnic->CurrentValue);
			$this->user_cnic->PlaceHolder = RemoveHtml($this->user_cnic->caption());

			// Edit refer script
			// user_id

			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// user_branch_id
			$this->user_branch_id->LinkCustomAttributes = "";
			$this->user_branch_id->HrefValue = "";

			// user_type_id
			$this->user_type_id->LinkCustomAttributes = "";
			$this->user_type_id->HrefValue = "";

			// user_name
			$this->user_name->LinkCustomAttributes = "";
			$this->user_name->HrefValue = "";

			// user_password
			$this->user_password->LinkCustomAttributes = "";
			$this->user_password->HrefValue = "";

			// user_email
			$this->user_email->LinkCustomAttributes = "";
			$this->user_email->HrefValue = "";

			// user_father
			$this->user_father->LinkCustomAttributes = "";
			$this->user_father->HrefValue = "";

			// user_photo
			$this->user_photo->LinkCustomAttributes = "";
			if (!EmptyValue($this->user_photo->Upload->DbValue)) {
				$this->user_photo->HrefValue = GetFileUploadUrl($this->user_photo, $this->user_photo->htmlDecode($this->user_photo->Upload->DbValue)); // Add prefix/suffix
				$this->user_photo->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->user_photo->HrefValue = FullUrl($this->user_photo->HrefValue, "href");
			} else {
				$this->user_photo->HrefValue = "";
			}
			$this->user_photo->ExportHrefValue = $this->user_photo->UploadPath . $this->user_photo->Upload->DbValue;

			// user_cnic
			$this->user_cnic->LinkCustomAttributes = "";
			$this->user_cnic->HrefValue = "";
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
		if ($this->user_id->Required) {
			if (!$this->user_id->IsDetailKey && $this->user_id->FormValue != NULL && $this->user_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_id->caption(), $this->user_id->RequiredErrorMessage));
			}
		}
		if ($this->user_branch_id->Required) {
			if (!$this->user_branch_id->IsDetailKey && $this->user_branch_id->FormValue != NULL && $this->user_branch_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_branch_id->caption(), $this->user_branch_id->RequiredErrorMessage));
			}
		}
		if ($this->user_type_id->Required) {
			if (!$this->user_type_id->IsDetailKey && $this->user_type_id->FormValue != NULL && $this->user_type_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_type_id->caption(), $this->user_type_id->RequiredErrorMessage));
			}
		}
		if ($this->user_name->Required) {
			if (!$this->user_name->IsDetailKey && $this->user_name->FormValue != NULL && $this->user_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_name->caption(), $this->user_name->RequiredErrorMessage));
			}
		}
		if ($this->user_password->Required) {
			if (!$this->user_password->IsDetailKey && $this->user_password->FormValue != NULL && $this->user_password->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_password->caption(), $this->user_password->RequiredErrorMessage));
			}
		}
		if ($this->user_email->Required) {
			if (!$this->user_email->IsDetailKey && $this->user_email->FormValue != NULL && $this->user_email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_email->caption(), $this->user_email->RequiredErrorMessage));
			}
		}
		if ($this->user_father->Required) {
			if (!$this->user_father->IsDetailKey && $this->user_father->FormValue != NULL && $this->user_father->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_father->caption(), $this->user_father->RequiredErrorMessage));
			}
		}
		if ($this->user_photo->Required) {
			if ($this->user_photo->Upload->FileName == "" && !$this->user_photo->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->user_photo->caption(), $this->user_photo->RequiredErrorMessage));
			}
		}
		if ($this->user_cnic->Required) {
			if (!$this->user_cnic->IsDetailKey && $this->user_cnic->FormValue != NULL && $this->user_cnic->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_cnic->caption(), $this->user_cnic->RequiredErrorMessage));
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

			// user_branch_id
			$this->user_branch_id->setDbValueDef($rsnew, $this->user_branch_id->CurrentValue, 0, $this->user_branch_id->ReadOnly);

			// user_type_id
			$this->user_type_id->setDbValueDef($rsnew, $this->user_type_id->CurrentValue, NULL, $this->user_type_id->ReadOnly);

			// user_name
			$this->user_name->setDbValueDef($rsnew, $this->user_name->CurrentValue, "", $this->user_name->ReadOnly);

			// user_password
			$this->user_password->setDbValueDef($rsnew, $this->user_password->CurrentValue, "", $this->user_password->ReadOnly);

			// user_email
			$this->user_email->setDbValueDef($rsnew, $this->user_email->CurrentValue, "", $this->user_email->ReadOnly);

			// user_father
			$this->user_father->setDbValueDef($rsnew, $this->user_father->CurrentValue, "", $this->user_father->ReadOnly);

			// user_photo
			if ($this->user_photo->Visible && !$this->user_photo->ReadOnly && !$this->user_photo->Upload->KeepFile) {
				$this->user_photo->Upload->DbValue = $rsold['user_photo']; // Get original value
				if ($this->user_photo->Upload->FileName == "") {
					$rsnew['user_photo'] = NULL;
				} else {
					$rsnew['user_photo'] = $this->user_photo->Upload->FileName;
				}
				$this->user_photo->ImageWidth = 1000; // Resize width
				$this->user_photo->ImageHeight = 0; // Resize height
			}

			// user_cnic
			$this->user_cnic->setDbValueDef($rsnew, $this->user_cnic->CurrentValue, "", $this->user_cnic->ReadOnly);
			if ($this->user_photo->Visible && !$this->user_photo->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->user_photo->Upload->DbValue) ? [] : [$this->user_photo->htmlDecode($this->user_photo->Upload->DbValue)];
				if (!EmptyValue($this->user_photo->Upload->FileName)) {
					$newFiles = [$this->user_photo->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->user_photo, $this->user_photo->Upload->Index);
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
								$file1 = UniqueFilename($this->user_photo->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->user_photo->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->user_photo->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->user_photo->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->user_photo->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->user_photo->setDbValueDef($rsnew, $this->user_photo->Upload->FileName, "", $this->user_photo->ReadOnly);
				}
			}

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
					if ($this->user_photo->Visible && !$this->user_photo->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->user_photo->Upload->DbValue) ? [] : [$this->user_photo->htmlDecode($this->user_photo->Upload->DbValue)];
						if (!EmptyValue($this->user_photo->Upload->FileName)) {
							$newFiles = [$this->user_photo->Upload->FileName];
							$newFiles2 = [$this->user_photo->htmlDecode($rsnew['user_photo'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->user_photo, $this->user_photo->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->user_photo->Upload->ResizeAndSaveToFile($this->user_photo->ImageWidth, $this->user_photo->ImageHeight, 100, $newFiles[$i], TRUE, $i)) {
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
									@unlink($this->user_photo->oldPhysicalUploadPath() . $oldFile);
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

			// user_photo
			if ($this->user_photo->Upload->FileToken != "")
				CleanUploadTempPath($this->user_photo->Upload->FileToken, $this->user_photo->Upload->Index);
			else
				CleanUploadTempPath($this->user_photo, $this->user_photo->Upload->Index);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("userlist.php"), "", $this->TableVar, TRUE);
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
				case "x_user_branch_id":
					break;
				case "x_user_type_id":
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
						case "x_user_branch_id":
							break;
						case "x_user_type_id":
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