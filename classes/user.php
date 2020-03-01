<?php namespace PHPMaker2020\dexdevs_crm; ?>
<?php

/**
 * Table class for user
 */
class user extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $user_id;
	public $user_branch_id;
	public $user_type_id;
	public $user_name;
	public $user_password;
	public $user_email;
	public $user_cnic;
	public $user_father;
	public $user_photo;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'user';
		$this->TableName = 'user';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`user`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// user_id
		$this->user_id = new DbField('user', 'user', 'x_user_id', 'user_id', '`user_id`', '`user_id`', 3, 12, -1, FALSE, '`user_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->user_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->user_id->IsPrimaryKey = TRUE; // Primary key field
		$this->user_id->Sortable = TRUE; // Allow sort
		$this->user_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['user_id'] = &$this->user_id;

		// user_branch_id
		$this->user_branch_id = new DbField('user', 'user', 'x_user_branch_id', 'user_branch_id', '`user_branch_id`', '`user_branch_id`', 3, 12, -1, FALSE, '`user_branch_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->user_branch_id->Nullable = FALSE; // NOT NULL field
		$this->user_branch_id->Required = TRUE; // Required field
		$this->user_branch_id->Sortable = TRUE; // Allow sort
		$this->user_branch_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->user_branch_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->user_branch_id->Lookup = new Lookup('user_branch_id', 'branch', FALSE, 'branch_id', ["branch_name","","",""], [], [], [], [], [], [], '', '');
		$this->user_branch_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['user_branch_id'] = &$this->user_branch_id;

		// user_type_id
		$this->user_type_id = new DbField('user', 'user', 'x_user_type_id', 'user_type_id', '`user_type_id`', '`user_type_id`', 3, 12, -1, FALSE, '`user_type_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->user_type_id->Required = TRUE; // Required field
		$this->user_type_id->Sortable = TRUE; // Allow sort
		$this->user_type_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->user_type_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->user_type_id->Lookup = new Lookup('user_type_id', 'userlevels', FALSE, 'userlevelid', ["userlevelname","","",""], [], [], [], [], [], [], '', '');
		$this->user_type_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['user_type_id'] = &$this->user_type_id;

		// user_name
		$this->user_name = new DbField('user', 'user', 'x_user_name', 'user_name', '`user_name`', '`user_name`', 200, 50, -1, FALSE, '`user_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_name->Nullable = FALSE; // NOT NULL field
		$this->user_name->Required = TRUE; // Required field
		$this->user_name->Sortable = TRUE; // Allow sort
		$this->fields['user_name'] = &$this->user_name;

		// user_password
		$this->user_password = new DbField('user', 'user', 'x_user_password', 'user_password', '`user_password`', '`user_password`', 200, 255, -1, FALSE, '`user_password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'PASSWORD');
		$this->user_password->Nullable = FALSE; // NOT NULL field
		$this->user_password->Required = TRUE; // Required field
		$this->user_password->Sortable = TRUE; // Allow sort
		$this->fields['user_password'] = &$this->user_password;

		// user_email
		$this->user_email = new DbField('user', 'user', 'x_user_email', 'user_email', '`user_email`', '`user_email`', 200, 50, -1, FALSE, '`user_email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_email->Nullable = FALSE; // NOT NULL field
		$this->user_email->Required = TRUE; // Required field
		$this->user_email->Sortable = TRUE; // Allow sort
		$this->fields['user_email'] = &$this->user_email;

		// user_cnic
		$this->user_cnic = new DbField('user', 'user', 'x_user_cnic', 'user_cnic', '`user_cnic`', '`user_cnic`', 200, 16, -1, FALSE, '`user_cnic`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_cnic->Nullable = FALSE; // NOT NULL field
		$this->user_cnic->Required = TRUE; // Required field
		$this->user_cnic->Sortable = TRUE; // Allow sort
		$this->fields['user_cnic'] = &$this->user_cnic;

		// user_father
		$this->user_father = new DbField('user', 'user', 'x_user_father', 'user_father', '`user_father`', '`user_father`', 200, 50, -1, FALSE, '`user_father`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_father->Nullable = FALSE; // NOT NULL field
		$this->user_father->Required = TRUE; // Required field
		$this->user_father->Sortable = TRUE; // Allow sort
		$this->fields['user_father'] = &$this->user_father;

		// user_photo
		$this->user_photo = new DbField('user', 'user', 'x_user_photo', 'user_photo', '`user_photo`', '`user_photo`', 201, 65535, -1, TRUE, '`user_photo`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->user_photo->Nullable = FALSE; // NOT NULL field
		$this->user_photo->Required = TRUE; // Required field
		$this->user_photo->Sortable = TRUE; // Allow sort
		$this->user_photo->ImageResize = TRUE;
		$this->fields['user_photo'] = &$this->user_photo;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`user`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = Config("USER_ID_ALLOW");
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME"))
				$value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->user_id->setDbValue($conn->insert_ID());
			$rs['user_id'] = $this->user_id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
				if ($value == $this->fields[$name]->OldValue) // No need to update hashed password if not changed
					continue;
				$value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
			}
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('user_id', $rs))
				AddFilter($where, QuotedName('user_id', $this->Dbid) . '=' . QuotedValue($rs['user_id'], $this->user_id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->user_id->DbValue = $row['user_id'];
		$this->user_branch_id->DbValue = $row['user_branch_id'];
		$this->user_type_id->DbValue = $row['user_type_id'];
		$this->user_name->DbValue = $row['user_name'];
		$this->user_password->DbValue = $row['user_password'];
		$this->user_email->DbValue = $row['user_email'];
		$this->user_cnic->DbValue = $row['user_cnic'];
		$this->user_father->DbValue = $row['user_father'];
		$this->user_photo->Upload->DbValue = $row['user_photo'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['user_photo']) ? [] : [$row['user_photo']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->user_photo->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->user_photo->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`user_id` = @user_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('user_id', $row) ? $row['user_id'] : NULL;
		else
			$val = $this->user_id->OldValue !== NULL ? $this->user_id->OldValue : $this->user_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@user_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "userlist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "userview.php")
			return $Language->phrase("View");
		elseif ($pageName == "useredit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "useradd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "userlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("userview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("userview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "useradd.php?" . $this->getUrlParm($parm);
		else
			$url = "useradd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("useredit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("useradd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("userdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "user_id:" . JsonEncode($this->user_id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->user_id->CurrentValue != NULL) {
			$url .= "user_id=" . urlencode($this->user_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("user_id") !== NULL)
				$arKeys[] = Param("user_id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->user_id->CurrentValue = $key;
			else
				$this->user_id->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->user_id->setDbValue($rs->fields('user_id'));
		$this->user_branch_id->setDbValue($rs->fields('user_branch_id'));
		$this->user_type_id->setDbValue($rs->fields('user_type_id'));
		$this->user_name->setDbValue($rs->fields('user_name'));
		$this->user_password->setDbValue($rs->fields('user_password'));
		$this->user_email->setDbValue($rs->fields('user_email'));
		$this->user_cnic->setDbValue($rs->fields('user_cnic'));
		$this->user_father->setDbValue($rs->fields('user_father'));
		$this->user_photo->Upload->DbValue = $rs->fields('user_photo');
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// user_id
		// user_branch_id
		// user_type_id
		// user_name
		// user_password
		// user_email
		// user_cnic
		// user_father
		// user_photo
		// user_id

		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// user_branch_id
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
		$this->user_branch_id->ViewCustomAttributes = "";

		// user_type_id
		$curVal = strval($this->user_type_id->CurrentValue);
		if ($curVal != "") {
			$this->user_type_id->ViewValue = $this->user_type_id->lookupCacheOption($curVal);
			if ($this->user_type_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
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

		// user_cnic
		$this->user_cnic->ViewValue = $this->user_cnic->CurrentValue;
		$this->user_cnic->ViewCustomAttributes = "";

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

		// user_cnic
		$this->user_cnic->LinkCustomAttributes = "";
		$this->user_cnic->HrefValue = "";
		$this->user_cnic->TooltipValue = "";

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

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// user_id
		$this->user_id->EditAttrs["class"] = "form-control";
		$this->user_id->EditCustomAttributes = "";
		$this->user_id->EditValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// user_branch_id
		$this->user_branch_id->EditCustomAttributes = "";

		// user_type_id
		$this->user_type_id->EditCustomAttributes = "";

		// user_name
		$this->user_name->EditAttrs["class"] = "form-control";
		$this->user_name->EditCustomAttributes = "";
		if (!$this->user_name->Raw)
			$this->user_name->CurrentValue = HtmlDecode($this->user_name->CurrentValue);
		$this->user_name->EditValue = $this->user_name->CurrentValue;
		$this->user_name->PlaceHolder = RemoveHtml($this->user_name->caption());

		// user_password
		$this->user_password->EditAttrs["class"] = "form-control ew-password-strength";
		$this->user_password->EditCustomAttributes = "";
		$this->user_password->EditValue = $this->user_password->CurrentValue;
		$this->user_password->PlaceHolder = RemoveHtml($this->user_password->caption());

		// user_email
		$this->user_email->EditAttrs["class"] = "form-control";
		$this->user_email->EditCustomAttributes = "";
		if (!$this->user_email->Raw)
			$this->user_email->CurrentValue = HtmlDecode($this->user_email->CurrentValue);
		$this->user_email->EditValue = $this->user_email->CurrentValue;
		$this->user_email->PlaceHolder = RemoveHtml($this->user_email->caption());

		// user_cnic
		$this->user_cnic->EditAttrs["class"] = "form-control";
		$this->user_cnic->EditCustomAttributes = "";
		if (!$this->user_cnic->Raw)
			$this->user_cnic->CurrentValue = HtmlDecode($this->user_cnic->CurrentValue);
		$this->user_cnic->EditValue = $this->user_cnic->CurrentValue;
		$this->user_cnic->PlaceHolder = RemoveHtml($this->user_cnic->caption());

		// user_father
		$this->user_father->EditAttrs["class"] = "form-control";
		$this->user_father->EditCustomAttributes = "";
		if (!$this->user_father->Raw)
			$this->user_father->CurrentValue = HtmlDecode($this->user_father->CurrentValue);
		$this->user_father->EditValue = $this->user_father->CurrentValue;
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

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->user_id);
					$doc->exportCaption($this->user_branch_id);
					$doc->exportCaption($this->user_type_id);
					$doc->exportCaption($this->user_name);
					$doc->exportCaption($this->user_password);
					$doc->exportCaption($this->user_email);
					$doc->exportCaption($this->user_cnic);
					$doc->exportCaption($this->user_father);
					$doc->exportCaption($this->user_photo);
				} else {
					$doc->exportCaption($this->user_id);
					$doc->exportCaption($this->user_branch_id);
					$doc->exportCaption($this->user_type_id);
					$doc->exportCaption($this->user_name);
					$doc->exportCaption($this->user_password);
					$doc->exportCaption($this->user_email);
					$doc->exportCaption($this->user_cnic);
					$doc->exportCaption($this->user_father);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->user_id);
						$doc->exportField($this->user_branch_id);
						$doc->exportField($this->user_type_id);
						$doc->exportField($this->user_name);
						$doc->exportField($this->user_password);
						$doc->exportField($this->user_email);
						$doc->exportField($this->user_cnic);
						$doc->exportField($this->user_father);
						$doc->exportField($this->user_photo);
					} else {
						$doc->exportField($this->user_id);
						$doc->exportField($this->user_branch_id);
						$doc->exportField($this->user_type_id);
						$doc->exportField($this->user_name);
						$doc->exportField($this->user_password);
						$doc->exportField($this->user_email);
						$doc->exportField($this->user_cnic);
						$doc->exportField($this->user_father);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{
		$width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
		$height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'user_photo') {
			$fldName = "user_photo";
			$fileNameFld = "user_photo";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->user_id->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype != "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld != "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					if ($fileNameFld != "" && !EmptyValue($rs->fields($fileNameFld))) {
						$fileName = $rs->fields($fileNameFld);
						$pathinfo = pathinfo($fileName);
						$ext = strtolower(@$pathinfo["extension"]);
						$isPdf = SameText($ext, "pdf");
						if (!Config("EMBED_PDF") || !$isPdf) // Skip header if embed PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					}

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear any debug message
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>