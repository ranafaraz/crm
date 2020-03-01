<?php
namespace PHPMaker2020\project1;

/**
 * Page class
 */
class business_edit extends business
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{5525D2B6-89E2-4D25-84CF-86BD784D9909}";

	// Table name
	public $TableName = 'business';

	// Page object name
	public $PageObjName = "business_edit";

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

		// Table object (business)
		if (!isset($GLOBALS["business"]) || get_class($GLOBALS["business"]) == PROJECT_NAMESPACE . "business") {
			$GLOBALS["business"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["business"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "businessview.php")
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
		$this->b_id->setVisibility();
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
			if ($CurrentForm->hasValue("x_b_id")) {
				$this->b_id->setFormValue($CurrentForm->getValue("x_b_id"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("b_id") !== NULL) {
				$this->b_id->setQueryStringValue(Get("b_id"));
				$loadByQuery = TRUE;
			} else {
				$this->b_id->CurrentValue = NULL;
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
					$this->terminate("businesslist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "businesslist.php")
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

		// Check field name 'b_id' first before field var 'x_b_id'
		$val = $CurrentForm->hasValue("b_id") ? $CurrentForm->getValue("b_id") : $CurrentForm->getValue("x_b_id");
		if (!$this->b_id->IsDetailKey)
			$this->b_id->setFormValue($val);

		// Check field name 'b_branch_id' first before field var 'x_b_branch_id'
		$val = $CurrentForm->hasValue("b_branch_id") ? $CurrentForm->getValue("b_branch_id") : $CurrentForm->getValue("x_b_branch_id");
		if (!$this->b_branch_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_branch_id->Visible = FALSE; // Disable update for API request
			else
				$this->b_branch_id->setFormValue($val);
		}

		// Check field name 'b_b_type_id' first before field var 'x_b_b_type_id'
		$val = $CurrentForm->hasValue("b_b_type_id") ? $CurrentForm->getValue("b_b_type_id") : $CurrentForm->getValue("x_b_b_type_id");
		if (!$this->b_b_type_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_b_type_id->Visible = FALSE; // Disable update for API request
			else
				$this->b_b_type_id->setFormValue($val);
		}

		// Check field name 'b_b_status_id' first before field var 'x_b_b_status_id'
		$val = $CurrentForm->hasValue("b_b_status_id") ? $CurrentForm->getValue("b_b_status_id") : $CurrentForm->getValue("x_b_b_status_id");
		if (!$this->b_b_status_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_b_status_id->Visible = FALSE; // Disable update for API request
			else
				$this->b_b_status_id->setFormValue($val);
		}

		// Check field name 'b_b_nature_id' first before field var 'x_b_b_nature_id'
		$val = $CurrentForm->hasValue("b_b_nature_id") ? $CurrentForm->getValue("b_b_nature_id") : $CurrentForm->getValue("x_b_b_nature_id");
		if (!$this->b_b_nature_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_b_nature_id->Visible = FALSE; // Disable update for API request
			else
				$this->b_b_nature_id->setFormValue($val);
		}

		// Check field name 'b_city_id' first before field var 'x_b_city_id'
		$val = $CurrentForm->hasValue("b_city_id") ? $CurrentForm->getValue("b_city_id") : $CurrentForm->getValue("x_b_city_id");
		if (!$this->b_city_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_city_id->Visible = FALSE; // Disable update for API request
			else
				$this->b_city_id->setFormValue($val);
		}

		// Check field name 'b_referral_id' first before field var 'x_b_referral_id'
		$val = $CurrentForm->hasValue("b_referral_id") ? $CurrentForm->getValue("b_referral_id") : $CurrentForm->getValue("x_b_referral_id");
		if (!$this->b_referral_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_referral_id->Visible = FALSE; // Disable update for API request
			else
				$this->b_referral_id->setFormValue($val);
		}

		// Check field name 'b_name' first before field var 'x_b_name'
		$val = $CurrentForm->hasValue("b_name") ? $CurrentForm->getValue("b_name") : $CurrentForm->getValue("x_b_name");
		if (!$this->b_name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_name->Visible = FALSE; // Disable update for API request
			else
				$this->b_name->setFormValue($val);
		}

		// Check field name 'b_owner' first before field var 'x_b_owner'
		$val = $CurrentForm->hasValue("b_owner") ? $CurrentForm->getValue("b_owner") : $CurrentForm->getValue("x_b_owner");
		if (!$this->b_owner->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_owner->Visible = FALSE; // Disable update for API request
			else
				$this->b_owner->setFormValue($val);
		}

		// Check field name 'b_contact' first before field var 'x_b_contact'
		$val = $CurrentForm->hasValue("b_contact") ? $CurrentForm->getValue("b_contact") : $CurrentForm->getValue("x_b_contact");
		if (!$this->b_contact->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_contact->Visible = FALSE; // Disable update for API request
			else
				$this->b_contact->setFormValue($val);
		}

		// Check field name 'b_address' first before field var 'x_b_address'
		$val = $CurrentForm->hasValue("b_address") ? $CurrentForm->getValue("b_address") : $CurrentForm->getValue("x_b_address");
		if (!$this->b_address->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_address->Visible = FALSE; // Disable update for API request
			else
				$this->b_address->setFormValue($val);
		}

		// Check field name 'b_email' first before field var 'x_b_email'
		$val = $CurrentForm->hasValue("b_email") ? $CurrentForm->getValue("b_email") : $CurrentForm->getValue("x_b_email");
		if (!$this->b_email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_email->Visible = FALSE; // Disable update for API request
			else
				$this->b_email->setFormValue($val);
		}

		// Check field name 'b_ntn' first before field var 'x_b_ntn'
		$val = $CurrentForm->hasValue("b_ntn") ? $CurrentForm->getValue("b_ntn") : $CurrentForm->getValue("x_b_ntn");
		if (!$this->b_ntn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_ntn->Visible = FALSE; // Disable update for API request
			else
				$this->b_ntn->setFormValue($val);
		}

		// Check field name 'b_logo' first before field var 'x_b_logo'
		$val = $CurrentForm->hasValue("b_logo") ? $CurrentForm->getValue("b_logo") : $CurrentForm->getValue("x_b_logo");
		if (!$this->b_logo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_logo->Visible = FALSE; // Disable update for API request
			else
				$this->b_logo->setFormValue($val);
		}

		// Check field name 'b_no_of_emp' first before field var 'x_b_no_of_emp'
		$val = $CurrentForm->hasValue("b_no_of_emp") ? $CurrentForm->getValue("b_no_of_emp") : $CurrentForm->getValue("x_b_no_of_emp");
		if (!$this->b_no_of_emp->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_no_of_emp->Visible = FALSE; // Disable update for API request
			else
				$this->b_no_of_emp->setFormValue($val);
		}

		// Check field name 'b_since' first before field var 'x_b_since'
		$val = $CurrentForm->hasValue("b_since") ? $CurrentForm->getValue("b_since") : $CurrentForm->getValue("x_b_since");
		if (!$this->b_since->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_since->Visible = FALSE; // Disable update for API request
			else
				$this->b_since->setFormValue($val);
		}

		// Check field name 'b_no_of_branches' first before field var 'x_b_no_of_branches'
		$val = $CurrentForm->hasValue("b_no_of_branches") ? $CurrentForm->getValue("b_no_of_branches") : $CurrentForm->getValue("x_b_no_of_branches");
		if (!$this->b_no_of_branches->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_no_of_branches->Visible = FALSE; // Disable update for API request
			else
				$this->b_no_of_branches->setFormValue($val);
		}

		// Check field name 'b_deal_with_referral' first before field var 'x_b_deal_with_referral'
		$val = $CurrentForm->hasValue("b_deal_with_referral") ? $CurrentForm->getValue("b_deal_with_referral") : $CurrentForm->getValue("x_b_deal_with_referral");
		if (!$this->b_deal_with_referral->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_deal_with_referral->Visible = FALSE; // Disable update for API request
			else
				$this->b_deal_with_referral->setFormValue($val);
		}

		// Check field name 'b_comments' first before field var 'x_b_comments'
		$val = $CurrentForm->hasValue("b_comments") ? $CurrentForm->getValue("b_comments") : $CurrentForm->getValue("x_b_comments");
		if (!$this->b_comments->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->b_comments->Visible = FALSE; // Disable update for API request
			else
				$this->b_comments->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->b_id->CurrentValue = $this->b_id->FormValue;
		$this->b_branch_id->CurrentValue = $this->b_branch_id->FormValue;
		$this->b_b_type_id->CurrentValue = $this->b_b_type_id->FormValue;
		$this->b_b_status_id->CurrentValue = $this->b_b_status_id->FormValue;
		$this->b_b_nature_id->CurrentValue = $this->b_b_nature_id->FormValue;
		$this->b_city_id->CurrentValue = $this->b_city_id->FormValue;
		$this->b_referral_id->CurrentValue = $this->b_referral_id->FormValue;
		$this->b_name->CurrentValue = $this->b_name->FormValue;
		$this->b_owner->CurrentValue = $this->b_owner->FormValue;
		$this->b_contact->CurrentValue = $this->b_contact->FormValue;
		$this->b_address->CurrentValue = $this->b_address->FormValue;
		$this->b_email->CurrentValue = $this->b_email->FormValue;
		$this->b_ntn->CurrentValue = $this->b_ntn->FormValue;
		$this->b_logo->CurrentValue = $this->b_logo->FormValue;
		$this->b_no_of_emp->CurrentValue = $this->b_no_of_emp->FormValue;
		$this->b_since->CurrentValue = $this->b_since->FormValue;
		$this->b_no_of_branches->CurrentValue = $this->b_no_of_branches->FormValue;
		$this->b_deal_with_referral->CurrentValue = $this->b_deal_with_referral->FormValue;
		$this->b_comments->CurrentValue = $this->b_comments->FormValue;
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
		$this->b_b_type_id->setDbValue($row['b_b_type_id']);
		$this->b_b_status_id->setDbValue($row['b_b_status_id']);
		$this->b_b_nature_id->setDbValue($row['b_b_nature_id']);
		$this->b_city_id->setDbValue($row['b_city_id']);
		$this->b_referral_id->setDbValue($row['b_referral_id']);
		$this->b_name->setDbValue($row['b_name']);
		$this->b_owner->setDbValue($row['b_owner']);
		$this->b_contact->setDbValue($row['b_contact']);
		$this->b_address->setDbValue($row['b_address']);
		$this->b_email->setDbValue($row['b_email']);
		$this->b_ntn->setDbValue($row['b_ntn']);
		$this->b_logo->setDbValue($row['b_logo']);
		$this->b_no_of_emp->setDbValue($row['b_no_of_emp']);
		$this->b_since->setDbValue($row['b_since']);
		$this->b_no_of_branches->setDbValue($row['b_no_of_branches']);
		$this->b_deal_with_referral->setDbValue($row['b_deal_with_referral']);
		$this->b_comments->setDbValue($row['b_comments']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['b_id'] = NULL;
		$row['b_branch_id'] = NULL;
		$row['b_b_type_id'] = NULL;
		$row['b_b_status_id'] = NULL;
		$row['b_b_nature_id'] = NULL;
		$row['b_city_id'] = NULL;
		$row['b_referral_id'] = NULL;
		$row['b_name'] = NULL;
		$row['b_owner'] = NULL;
		$row['b_contact'] = NULL;
		$row['b_address'] = NULL;
		$row['b_email'] = NULL;
		$row['b_ntn'] = NULL;
		$row['b_logo'] = NULL;
		$row['b_no_of_emp'] = NULL;
		$row['b_since'] = NULL;
		$row['b_no_of_branches'] = NULL;
		$row['b_deal_with_referral'] = NULL;
		$row['b_comments'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("b_id")) != "")
			$this->b_id->OldValue = $this->getKey("b_id"); // b_id
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
			$this->b_id->ViewCustomAttributes = "";

			// b_branch_id
			$this->b_branch_id->ViewValue = $this->b_branch_id->CurrentValue;
			$this->b_branch_id->ViewValue = FormatNumber($this->b_branch_id->ViewValue, 0, -2, -2, -2);
			$this->b_branch_id->ViewCustomAttributes = "";

			// b_b_type_id
			$this->b_b_type_id->ViewValue = $this->b_b_type_id->CurrentValue;
			$this->b_b_type_id->ViewValue = FormatNumber($this->b_b_type_id->ViewValue, 0, -2, -2, -2);
			$this->b_b_type_id->ViewCustomAttributes = "";

			// b_b_status_id
			$this->b_b_status_id->ViewValue = $this->b_b_status_id->CurrentValue;
			$this->b_b_status_id->ViewValue = FormatNumber($this->b_b_status_id->ViewValue, 0, -2, -2, -2);
			$this->b_b_status_id->ViewCustomAttributes = "";

			// b_b_nature_id
			$this->b_b_nature_id->ViewValue = $this->b_b_nature_id->CurrentValue;
			$this->b_b_nature_id->ViewValue = FormatNumber($this->b_b_nature_id->ViewValue, 0, -2, -2, -2);
			$this->b_b_nature_id->ViewCustomAttributes = "";

			// b_city_id
			$this->b_city_id->ViewValue = $this->b_city_id->CurrentValue;
			$this->b_city_id->ViewValue = FormatNumber($this->b_city_id->ViewValue, 0, -2, -2, -2);
			$this->b_city_id->ViewCustomAttributes = "";

			// b_referral_id
			$this->b_referral_id->ViewValue = $this->b_referral_id->CurrentValue;
			$this->b_referral_id->ViewValue = FormatNumber($this->b_referral_id->ViewValue, 0, -2, -2, -2);
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
			$this->b_logo->ViewValue = $this->b_logo->CurrentValue;
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

			// b_id
			$this->b_id->LinkCustomAttributes = "";
			$this->b_id->HrefValue = "";
			$this->b_id->TooltipValue = "";

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
			$this->b_logo->HrefValue = "";
			$this->b_logo->TooltipValue = "";

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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// b_id
			$this->b_id->EditAttrs["class"] = "form-control";
			$this->b_id->EditCustomAttributes = "";
			$this->b_id->EditValue = $this->b_id->CurrentValue;
			$this->b_id->ViewCustomAttributes = "";

			// b_branch_id
			$this->b_branch_id->EditAttrs["class"] = "form-control";
			$this->b_branch_id->EditCustomAttributes = "";
			$this->b_branch_id->EditValue = HtmlEncode($this->b_branch_id->CurrentValue);
			$this->b_branch_id->PlaceHolder = RemoveHtml($this->b_branch_id->caption());

			// b_b_type_id
			$this->b_b_type_id->EditAttrs["class"] = "form-control";
			$this->b_b_type_id->EditCustomAttributes = "";
			$this->b_b_type_id->EditValue = HtmlEncode($this->b_b_type_id->CurrentValue);
			$this->b_b_type_id->PlaceHolder = RemoveHtml($this->b_b_type_id->caption());

			// b_b_status_id
			$this->b_b_status_id->EditAttrs["class"] = "form-control";
			$this->b_b_status_id->EditCustomAttributes = "";
			$this->b_b_status_id->EditValue = HtmlEncode($this->b_b_status_id->CurrentValue);
			$this->b_b_status_id->PlaceHolder = RemoveHtml($this->b_b_status_id->caption());

			// b_b_nature_id
			$this->b_b_nature_id->EditAttrs["class"] = "form-control";
			$this->b_b_nature_id->EditCustomAttributes = "";
			$this->b_b_nature_id->EditValue = HtmlEncode($this->b_b_nature_id->CurrentValue);
			$this->b_b_nature_id->PlaceHolder = RemoveHtml($this->b_b_nature_id->caption());

			// b_city_id
			$this->b_city_id->EditAttrs["class"] = "form-control";
			$this->b_city_id->EditCustomAttributes = "";
			$this->b_city_id->EditValue = HtmlEncode($this->b_city_id->CurrentValue);
			$this->b_city_id->PlaceHolder = RemoveHtml($this->b_city_id->caption());

			// b_referral_id
			$this->b_referral_id->EditAttrs["class"] = "form-control";
			$this->b_referral_id->EditCustomAttributes = "";
			$this->b_referral_id->EditValue = HtmlEncode($this->b_referral_id->CurrentValue);
			$this->b_referral_id->PlaceHolder = RemoveHtml($this->b_referral_id->caption());

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
			if (!$this->b_address->Raw)
				$this->b_address->CurrentValue = HtmlDecode($this->b_address->CurrentValue);
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
			if (!$this->b_logo->Raw)
				$this->b_logo->CurrentValue = HtmlDecode($this->b_logo->CurrentValue);
			$this->b_logo->EditValue = HtmlEncode($this->b_logo->CurrentValue);
			$this->b_logo->PlaceHolder = RemoveHtml($this->b_logo->caption());

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
			if (!$this->b_deal_with_referral->Raw)
				$this->b_deal_with_referral->CurrentValue = HtmlDecode($this->b_deal_with_referral->CurrentValue);
			$this->b_deal_with_referral->EditValue = HtmlEncode($this->b_deal_with_referral->CurrentValue);
			$this->b_deal_with_referral->PlaceHolder = RemoveHtml($this->b_deal_with_referral->caption());

			// b_comments
			$this->b_comments->EditAttrs["class"] = "form-control";
			$this->b_comments->EditCustomAttributes = "";
			if (!$this->b_comments->Raw)
				$this->b_comments->CurrentValue = HtmlDecode($this->b_comments->CurrentValue);
			$this->b_comments->EditValue = HtmlEncode($this->b_comments->CurrentValue);
			$this->b_comments->PlaceHolder = RemoveHtml($this->b_comments->caption());

			// Edit refer script
			// b_id

			$this->b_id->LinkCustomAttributes = "";
			$this->b_id->HrefValue = "";

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
			$this->b_logo->HrefValue = "";

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
		if ($this->b_id->Required) {
			if (!$this->b_id->IsDetailKey && $this->b_id->FormValue != NULL && $this->b_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_id->caption(), $this->b_id->RequiredErrorMessage));
			}
		}
		if ($this->b_branch_id->Required) {
			if (!$this->b_branch_id->IsDetailKey && $this->b_branch_id->FormValue != NULL && $this->b_branch_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_branch_id->caption(), $this->b_branch_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->b_branch_id->FormValue)) {
			AddMessage($FormError, $this->b_branch_id->errorMessage());
		}
		if ($this->b_b_type_id->Required) {
			if (!$this->b_b_type_id->IsDetailKey && $this->b_b_type_id->FormValue != NULL && $this->b_b_type_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_b_type_id->caption(), $this->b_b_type_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->b_b_type_id->FormValue)) {
			AddMessage($FormError, $this->b_b_type_id->errorMessage());
		}
		if ($this->b_b_status_id->Required) {
			if (!$this->b_b_status_id->IsDetailKey && $this->b_b_status_id->FormValue != NULL && $this->b_b_status_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_b_status_id->caption(), $this->b_b_status_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->b_b_status_id->FormValue)) {
			AddMessage($FormError, $this->b_b_status_id->errorMessage());
		}
		if ($this->b_b_nature_id->Required) {
			if (!$this->b_b_nature_id->IsDetailKey && $this->b_b_nature_id->FormValue != NULL && $this->b_b_nature_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_b_nature_id->caption(), $this->b_b_nature_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->b_b_nature_id->FormValue)) {
			AddMessage($FormError, $this->b_b_nature_id->errorMessage());
		}
		if ($this->b_city_id->Required) {
			if (!$this->b_city_id->IsDetailKey && $this->b_city_id->FormValue != NULL && $this->b_city_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_city_id->caption(), $this->b_city_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->b_city_id->FormValue)) {
			AddMessage($FormError, $this->b_city_id->errorMessage());
		}
		if ($this->b_referral_id->Required) {
			if (!$this->b_referral_id->IsDetailKey && $this->b_referral_id->FormValue != NULL && $this->b_referral_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->b_referral_id->caption(), $this->b_referral_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->b_referral_id->FormValue)) {
			AddMessage($FormError, $this->b_referral_id->errorMessage());
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
			if (!$this->b_logo->IsDetailKey && $this->b_logo->FormValue != NULL && $this->b_logo->FormValue == "") {
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

			// b_branch_id
			$this->b_branch_id->setDbValueDef($rsnew, $this->b_branch_id->CurrentValue, 0, $this->b_branch_id->ReadOnly);

			// b_b_type_id
			$this->b_b_type_id->setDbValueDef($rsnew, $this->b_b_type_id->CurrentValue, 0, $this->b_b_type_id->ReadOnly);

			// b_b_status_id
			$this->b_b_status_id->setDbValueDef($rsnew, $this->b_b_status_id->CurrentValue, 0, $this->b_b_status_id->ReadOnly);

			// b_b_nature_id
			$this->b_b_nature_id->setDbValueDef($rsnew, $this->b_b_nature_id->CurrentValue, 0, $this->b_b_nature_id->ReadOnly);

			// b_city_id
			$this->b_city_id->setDbValueDef($rsnew, $this->b_city_id->CurrentValue, 0, $this->b_city_id->ReadOnly);

			// b_referral_id
			$this->b_referral_id->setDbValueDef($rsnew, $this->b_referral_id->CurrentValue, NULL, $this->b_referral_id->ReadOnly);

			// b_name
			$this->b_name->setDbValueDef($rsnew, $this->b_name->CurrentValue, "", $this->b_name->ReadOnly);

			// b_owner
			$this->b_owner->setDbValueDef($rsnew, $this->b_owner->CurrentValue, "", $this->b_owner->ReadOnly);

			// b_contact
			$this->b_contact->setDbValueDef($rsnew, $this->b_contact->CurrentValue, "", $this->b_contact->ReadOnly);

			// b_address
			$this->b_address->setDbValueDef($rsnew, $this->b_address->CurrentValue, "", $this->b_address->ReadOnly);

			// b_email
			$this->b_email->setDbValueDef($rsnew, $this->b_email->CurrentValue, "", $this->b_email->ReadOnly);

			// b_ntn
			$this->b_ntn->setDbValueDef($rsnew, $this->b_ntn->CurrentValue, "", $this->b_ntn->ReadOnly);

			// b_logo
			$this->b_logo->setDbValueDef($rsnew, $this->b_logo->CurrentValue, "", $this->b_logo->ReadOnly);

			// b_no_of_emp
			$this->b_no_of_emp->setDbValueDef($rsnew, $this->b_no_of_emp->CurrentValue, 0, $this->b_no_of_emp->ReadOnly);

			// b_since
			$this->b_since->setDbValueDef($rsnew, $this->b_since->CurrentValue, "", $this->b_since->ReadOnly);

			// b_no_of_branches
			$this->b_no_of_branches->setDbValueDef($rsnew, $this->b_no_of_branches->CurrentValue, 0, $this->b_no_of_branches->ReadOnly);

			// b_deal_with_referral
			$this->b_deal_with_referral->setDbValueDef($rsnew, $this->b_deal_with_referral->CurrentValue, NULL, $this->b_deal_with_referral->ReadOnly);

			// b_comments
			$this->b_comments->setDbValueDef($rsnew, $this->b_comments->CurrentValue, "", $this->b_comments->ReadOnly);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("businesslist.php"), "", $this->TableVar, TRUE);
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