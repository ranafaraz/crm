<?php namespace PHPMaker2020\crm_live; ?>
<?php

/**
 * Table class for organization
 */
class organization extends DbTable
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
	public $org_id;
	public $org_city_id;
	public $org_name;
	public $org_head_office;
	public $org_owner;
	public $org_contact_no;
	public $org_logo;
	public $org_bank_acc;
	public $org_ntn;
	public $org_email;
	public $org_website;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'organization';
		$this->TableName = 'organization';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`organization`";
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

		// org_id
		$this->org_id = new DbField('organization', 'organization', 'x_org_id', 'org_id', '`org_id`', '`org_id`', 3, 12, -1, FALSE, '`org_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->org_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->org_id->IsPrimaryKey = TRUE; // Primary key field
		$this->org_id->Sortable = TRUE; // Allow sort
		$this->org_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['org_id'] = &$this->org_id;

		// org_city_id
		$this->org_city_id = new DbField('organization', 'organization', 'x_org_city_id', 'org_city_id', '`org_city_id`', '`org_city_id`', 3, 12, -1, FALSE, '`EV__org_city_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->org_city_id->Nullable = FALSE; // NOT NULL field
		$this->org_city_id->Required = TRUE; // Required field
		$this->org_city_id->Sortable = TRUE; // Allow sort
		$this->org_city_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->org_city_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->org_city_id->Lookup = new Lookup('org_city_id', 'city', FALSE, 'city_id', ["city_name","","",""], [], [], [], [], [], [], '', '');
		$this->org_city_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['org_city_id'] = &$this->org_city_id;

		// org_name
		$this->org_name = new DbField('organization', 'organization', 'x_org_name', 'org_name', '`org_name`', '`org_name`', 200, 100, -1, FALSE, '`org_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->org_name->Nullable = FALSE; // NOT NULL field
		$this->org_name->Required = TRUE; // Required field
		$this->org_name->Sortable = TRUE; // Allow sort
		$this->fields['org_name'] = &$this->org_name;

		// org_head_office
		$this->org_head_office = new DbField('organization', 'organization', 'x_org_head_office', 'org_head_office', '`org_head_office`', '`org_head_office`', 200, 100, -1, FALSE, '`org_head_office`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->org_head_office->Nullable = FALSE; // NOT NULL field
		$this->org_head_office->Required = TRUE; // Required field
		$this->org_head_office->Sortable = TRUE; // Allow sort
		$this->fields['org_head_office'] = &$this->org_head_office;

		// org_owner
		$this->org_owner = new DbField('organization', 'organization', 'x_org_owner', 'org_owner', '`org_owner`', '`org_owner`', 200, 50, -1, FALSE, '`org_owner`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->org_owner->Nullable = FALSE; // NOT NULL field
		$this->org_owner->Required = TRUE; // Required field
		$this->org_owner->Sortable = TRUE; // Allow sort
		$this->fields['org_owner'] = &$this->org_owner;

		// org_contact_no
		$this->org_contact_no = new DbField('organization', 'organization', 'x_org_contact_no', 'org_contact_no', '`org_contact_no`', '`org_contact_no`', 200, 20, -1, FALSE, '`org_contact_no`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->org_contact_no->Nullable = FALSE; // NOT NULL field
		$this->org_contact_no->Required = TRUE; // Required field
		$this->org_contact_no->Sortable = TRUE; // Allow sort
		$this->fields['org_contact_no'] = &$this->org_contact_no;

		// org_logo
		$this->org_logo = new DbField('organization', 'organization', 'x_org_logo', 'org_logo', '`org_logo`', '`org_logo`', 200, 200, -1, TRUE, '`org_logo`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->org_logo->Nullable = FALSE; // NOT NULL field
		$this->org_logo->Required = TRUE; // Required field
		$this->org_logo->Sortable = TRUE; // Allow sort
		$this->org_logo->ImageResize = TRUE;
		$this->fields['org_logo'] = &$this->org_logo;

		// org_bank_acc
		$this->org_bank_acc = new DbField('organization', 'organization', 'x_org_bank_acc', 'org_bank_acc', '`org_bank_acc`', '`org_bank_acc`', 200, 20, -1, FALSE, '`org_bank_acc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->org_bank_acc->Nullable = FALSE; // NOT NULL field
		$this->org_bank_acc->Required = TRUE; // Required field
		$this->org_bank_acc->Sortable = TRUE; // Allow sort
		$this->fields['org_bank_acc'] = &$this->org_bank_acc;

		// org_ntn
		$this->org_ntn = new DbField('organization', 'organization', 'x_org_ntn', 'org_ntn', '`org_ntn`', '`org_ntn`', 200, 20, -1, FALSE, '`org_ntn`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->org_ntn->Nullable = FALSE; // NOT NULL field
		$this->org_ntn->Required = TRUE; // Required field
		$this->org_ntn->Sortable = TRUE; // Allow sort
		$this->fields['org_ntn'] = &$this->org_ntn;

		// org_email
		$this->org_email = new DbField('organization', 'organization', 'x_org_email', 'org_email', '`org_email`', '`org_email`', 200, 30, -1, FALSE, '`org_email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->org_email->Nullable = FALSE; // NOT NULL field
		$this->org_email->Required = TRUE; // Required field
		$this->org_email->Sortable = TRUE; // Allow sort
		$this->fields['org_email'] = &$this->org_email;

		// org_website
		$this->org_website = new DbField('organization', 'organization', 'x_org_website', 'org_website', '`org_website`', '`org_website`', 200, 100, -1, FALSE, '`org_website`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->org_website->Nullable = FALSE; // NOT NULL field
		$this->org_website->Required = TRUE; // Required field
		$this->org_website->Sortable = TRUE; // Allow sort
		$this->fields['org_website'] = &$this->org_website;
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
			$sortFieldList = ($fld->VirtualExpression != "") ? $fld->VirtualExpression : $sortField;
			$this->setSessionOrderByList($sortFieldList . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Session ORDER BY for List page
	public function getSessionOrderByList()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")];
	}
	public function setSessionOrderByList($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")] = $v;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`organization`";
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
	public function getSqlSelectList() // Select for List page
	{
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT `city_name` FROM `city` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`city_id` = `organization`.`org_city_id` LIMIT 1) AS `EV__org_city_id` FROM `organization`" .
			") `TMP_TABLE`";
		return ($this->SqlSelectList != "") ? $this->SqlSelectList : $select;
	}
	public function sqlSelectList() // For backward compatibility
	{
		return $this->getSqlSelectList();
	}
	public function setSqlSelectList($v)
	{
		$this->SqlSelectList = $v;
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
		if ($this->useVirtualFields()) {
			$select = $this->getSqlSelectList();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		} else {
			$select = $this->getSqlSelect();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		}
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = ($this->useVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Check if virtual fields is used in SQL
	protected function useVirtualFields()
	{
		$where = $this->UseSessionForListSql ? $this->getSessionWhere() : $this->CurrentFilter;
		$orderBy = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		if ($where != "")
			$where = " " . str_replace(["(", ")"], ["", ""], $where) . " ";
		if ($orderBy != "")
			$orderBy = " " . str_replace(["(", ")"], ["", ""], $orderBy) . " ";
		if ($this->org_city_id->AdvancedSearch->SearchValue != "" ||
			$this->org_city_id->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->org_city_id->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->org_city_id->VirtualExpression . " "))
			return TRUE;
		return FALSE;
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
		if ($this->useVirtualFields())
			$sql = BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		else
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
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->org_id->setDbValue($conn->insert_ID());
			$rs['org_id'] = $this->org_id->DbValue;
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
			if (array_key_exists('org_id', $rs))
				AddFilter($where, QuotedName('org_id', $this->Dbid) . '=' . QuotedValue($rs['org_id'], $this->org_id->DataType, $this->Dbid));
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
		$this->org_id->DbValue = $row['org_id'];
		$this->org_city_id->DbValue = $row['org_city_id'];
		$this->org_name->DbValue = $row['org_name'];
		$this->org_head_office->DbValue = $row['org_head_office'];
		$this->org_owner->DbValue = $row['org_owner'];
		$this->org_contact_no->DbValue = $row['org_contact_no'];
		$this->org_logo->Upload->DbValue = $row['org_logo'];
		$this->org_bank_acc->DbValue = $row['org_bank_acc'];
		$this->org_ntn->DbValue = $row['org_ntn'];
		$this->org_email->DbValue = $row['org_email'];
		$this->org_website->DbValue = $row['org_website'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['org_logo']) ? [] : [$row['org_logo']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->org_logo->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->org_logo->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`org_id` = @org_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('org_id', $row) ? $row['org_id'] : NULL;
		else
			$val = $this->org_id->OldValue !== NULL ? $this->org_id->OldValue : $this->org_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@org_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "organizationlist.php";
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
		if ($pageName == "organizationview.php")
			return $Language->phrase("View");
		elseif ($pageName == "organizationedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "organizationadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "organizationlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("organizationview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("organizationview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "organizationadd.php?" . $this->getUrlParm($parm);
		else
			$url = "organizationadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("organizationedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("organizationadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("organizationdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "org_id:" . JsonEncode($this->org_id->CurrentValue, "number");
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
		if ($this->org_id->CurrentValue != NULL) {
			$url .= "org_id=" . urlencode($this->org_id->CurrentValue);
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
			if (Param("org_id") !== NULL)
				$arKeys[] = Param("org_id");
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
				$this->org_id->CurrentValue = $key;
			else
				$this->org_id->OldValue = $key;
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
		$this->org_id->setDbValue($rs->fields('org_id'));
		$this->org_city_id->setDbValue($rs->fields('org_city_id'));
		$this->org_name->setDbValue($rs->fields('org_name'));
		$this->org_head_office->setDbValue($rs->fields('org_head_office'));
		$this->org_owner->setDbValue($rs->fields('org_owner'));
		$this->org_contact_no->setDbValue($rs->fields('org_contact_no'));
		$this->org_logo->Upload->DbValue = $rs->fields('org_logo');
		$this->org_bank_acc->setDbValue($rs->fields('org_bank_acc'));
		$this->org_ntn->setDbValue($rs->fields('org_ntn'));
		$this->org_email->setDbValue($rs->fields('org_email'));
		$this->org_website->setDbValue($rs->fields('org_website'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// org_id
		// org_city_id
		// org_name
		// org_head_office
		// org_owner
		// org_contact_no
		// org_logo
		// org_bank_acc
		// org_ntn
		// org_email
		// org_website
		// org_id

		$this->org_id->ViewValue = $this->org_id->CurrentValue;
		$this->org_id->CssClass = "font-weight-bold";
		$this->org_id->ViewCustomAttributes = "";

		// org_city_id
		if ($this->org_city_id->VirtualValue != "") {
			$this->org_city_id->ViewValue = $this->org_city_id->VirtualValue;
		} else {
			$curVal = strval($this->org_city_id->CurrentValue);
			if ($curVal != "") {
				$this->org_city_id->ViewValue = $this->org_city_id->lookupCacheOption($curVal);
				if ($this->org_city_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`city_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->org_city_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->org_city_id->ViewValue = $this->org_city_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->org_city_id->ViewValue = $this->org_city_id->CurrentValue;
					}
				}
			} else {
				$this->org_city_id->ViewValue = NULL;
			}
		}
		$this->org_city_id->ViewCustomAttributes = "";

		// org_name
		$this->org_name->ViewValue = $this->org_name->CurrentValue;
		$this->org_name->ViewCustomAttributes = "";

		// org_head_office
		$this->org_head_office->ViewValue = $this->org_head_office->CurrentValue;
		$this->org_head_office->ViewCustomAttributes = "";

		// org_owner
		$this->org_owner->ViewValue = $this->org_owner->CurrentValue;
		$this->org_owner->ViewCustomAttributes = "";

		// org_contact_no
		$this->org_contact_no->ViewValue = $this->org_contact_no->CurrentValue;
		$this->org_contact_no->ViewCustomAttributes = "";

		// org_logo
		if (!EmptyValue($this->org_logo->Upload->DbValue)) {
			$this->org_logo->ImageWidth = 200;
			$this->org_logo->ImageHeight = 0;
			$this->org_logo->ImageAlt = $this->org_logo->alt();
			$this->org_logo->ViewValue = $this->org_logo->Upload->DbValue;
		} else {
			$this->org_logo->ViewValue = "";
		}
		$this->org_logo->ViewCustomAttributes = "";

		// org_bank_acc
		$this->org_bank_acc->ViewValue = $this->org_bank_acc->CurrentValue;
		$this->org_bank_acc->ViewCustomAttributes = "";

		// org_ntn
		$this->org_ntn->ViewValue = $this->org_ntn->CurrentValue;
		$this->org_ntn->ViewCustomAttributes = "";

		// org_email
		$this->org_email->ViewValue = $this->org_email->CurrentValue;
		$this->org_email->ViewCustomAttributes = "";

		// org_website
		$this->org_website->ViewValue = $this->org_website->CurrentValue;
		$this->org_website->ViewCustomAttributes = "";

		// org_id
		$this->org_id->LinkCustomAttributes = "";
		$this->org_id->HrefValue = "";
		$this->org_id->TooltipValue = "";

		// org_city_id
		$this->org_city_id->LinkCustomAttributes = "";
		$this->org_city_id->HrefValue = "";
		$this->org_city_id->TooltipValue = "";

		// org_name
		$this->org_name->LinkCustomAttributes = "";
		$this->org_name->HrefValue = "";
		$this->org_name->TooltipValue = "";

		// org_head_office
		$this->org_head_office->LinkCustomAttributes = "";
		$this->org_head_office->HrefValue = "";
		$this->org_head_office->TooltipValue = "";

		// org_owner
		$this->org_owner->LinkCustomAttributes = "";
		$this->org_owner->HrefValue = "";
		$this->org_owner->TooltipValue = "";

		// org_contact_no
		$this->org_contact_no->LinkCustomAttributes = "";
		$this->org_contact_no->HrefValue = "";
		$this->org_contact_no->TooltipValue = "";

		// org_logo
		$this->org_logo->LinkCustomAttributes = "";
		if (!EmptyValue($this->org_logo->Upload->DbValue)) {
			$this->org_logo->HrefValue = GetFileUploadUrl($this->org_logo, $this->org_logo->htmlDecode($this->org_logo->Upload->DbValue)); // Add prefix/suffix
			$this->org_logo->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport())
				$this->org_logo->HrefValue = FullUrl($this->org_logo->HrefValue, "href");
		} else {
			$this->org_logo->HrefValue = "";
		}
		$this->org_logo->ExportHrefValue = $this->org_logo->UploadPath . $this->org_logo->Upload->DbValue;
		$this->org_logo->TooltipValue = "";
		if ($this->org_logo->UseColorbox) {
			if (EmptyValue($this->org_logo->TooltipValue))
				$this->org_logo->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
			$this->org_logo->LinkAttrs["data-rel"] = "organization_x_org_logo";
			$this->org_logo->LinkAttrs->appendClass("ew-lightbox");
		}

		// org_bank_acc
		$this->org_bank_acc->LinkCustomAttributes = "";
		$this->org_bank_acc->HrefValue = "";
		$this->org_bank_acc->TooltipValue = "";

		// org_ntn
		$this->org_ntn->LinkCustomAttributes = "";
		$this->org_ntn->HrefValue = "";
		$this->org_ntn->TooltipValue = "";

		// org_email
		$this->org_email->LinkCustomAttributes = "";
		$this->org_email->HrefValue = "";
		$this->org_email->TooltipValue = "";

		// org_website
		$this->org_website->LinkCustomAttributes = "";
		$this->org_website->HrefValue = "";
		$this->org_website->TooltipValue = "";

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

		// org_id
		$this->org_id->EditAttrs["class"] = "form-control";
		$this->org_id->EditCustomAttributes = "";
		$this->org_id->EditValue = $this->org_id->CurrentValue;
		$this->org_id->CssClass = "font-weight-bold";
		$this->org_id->ViewCustomAttributes = "";

		// org_city_id
		$this->org_city_id->EditAttrs["class"] = "form-control";
		$this->org_city_id->EditCustomAttributes = "";

		// org_name
		$this->org_name->EditAttrs["class"] = "form-control";
		$this->org_name->EditCustomAttributes = "";
		if (!$this->org_name->Raw)
			$this->org_name->CurrentValue = HtmlDecode($this->org_name->CurrentValue);
		$this->org_name->EditValue = $this->org_name->CurrentValue;
		$this->org_name->PlaceHolder = RemoveHtml($this->org_name->caption());

		// org_head_office
		$this->org_head_office->EditAttrs["class"] = "form-control";
		$this->org_head_office->EditCustomAttributes = "";
		if (!$this->org_head_office->Raw)
			$this->org_head_office->CurrentValue = HtmlDecode($this->org_head_office->CurrentValue);
		$this->org_head_office->EditValue = $this->org_head_office->CurrentValue;
		$this->org_head_office->PlaceHolder = RemoveHtml($this->org_head_office->caption());

		// org_owner
		$this->org_owner->EditAttrs["class"] = "form-control";
		$this->org_owner->EditCustomAttributes = "";
		if (!$this->org_owner->Raw)
			$this->org_owner->CurrentValue = HtmlDecode($this->org_owner->CurrentValue);
		$this->org_owner->EditValue = $this->org_owner->CurrentValue;
		$this->org_owner->PlaceHolder = RemoveHtml($this->org_owner->caption());

		// org_contact_no
		$this->org_contact_no->EditAttrs["class"] = "form-control";
		$this->org_contact_no->EditCustomAttributes = "";
		if (!$this->org_contact_no->Raw)
			$this->org_contact_no->CurrentValue = HtmlDecode($this->org_contact_no->CurrentValue);
		$this->org_contact_no->EditValue = $this->org_contact_no->CurrentValue;
		$this->org_contact_no->PlaceHolder = RemoveHtml($this->org_contact_no->caption());

		// org_logo
		$this->org_logo->EditAttrs["class"] = "form-control";
		$this->org_logo->EditCustomAttributes = "";
		if (!EmptyValue($this->org_logo->Upload->DbValue)) {
			$this->org_logo->ImageWidth = 200;
			$this->org_logo->ImageHeight = 0;
			$this->org_logo->ImageAlt = $this->org_logo->alt();
			$this->org_logo->EditValue = $this->org_logo->Upload->DbValue;
		} else {
			$this->org_logo->EditValue = "";
		}
		if (!EmptyValue($this->org_logo->CurrentValue))
				$this->org_logo->Upload->FileName = $this->org_logo->CurrentValue;

		// org_bank_acc
		$this->org_bank_acc->EditAttrs["class"] = "form-control";
		$this->org_bank_acc->EditCustomAttributes = "";
		if (!$this->org_bank_acc->Raw)
			$this->org_bank_acc->CurrentValue = HtmlDecode($this->org_bank_acc->CurrentValue);
		$this->org_bank_acc->EditValue = $this->org_bank_acc->CurrentValue;
		$this->org_bank_acc->PlaceHolder = RemoveHtml($this->org_bank_acc->caption());

		// org_ntn
		$this->org_ntn->EditAttrs["class"] = "form-control";
		$this->org_ntn->EditCustomAttributes = "";
		if (!$this->org_ntn->Raw)
			$this->org_ntn->CurrentValue = HtmlDecode($this->org_ntn->CurrentValue);
		$this->org_ntn->EditValue = $this->org_ntn->CurrentValue;
		$this->org_ntn->PlaceHolder = RemoveHtml($this->org_ntn->caption());

		// org_email
		$this->org_email->EditAttrs["class"] = "form-control";
		$this->org_email->EditCustomAttributes = "";
		if (!$this->org_email->Raw)
			$this->org_email->CurrentValue = HtmlDecode($this->org_email->CurrentValue);
		$this->org_email->EditValue = $this->org_email->CurrentValue;
		$this->org_email->PlaceHolder = RemoveHtml($this->org_email->caption());

		// org_website
		$this->org_website->EditAttrs["class"] = "form-control";
		$this->org_website->EditCustomAttributes = "";
		if (!$this->org_website->Raw)
			$this->org_website->CurrentValue = HtmlDecode($this->org_website->CurrentValue);
		$this->org_website->EditValue = $this->org_website->CurrentValue;
		$this->org_website->PlaceHolder = RemoveHtml($this->org_website->caption());

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
					$doc->exportCaption($this->org_id);
					$doc->exportCaption($this->org_city_id);
					$doc->exportCaption($this->org_name);
					$doc->exportCaption($this->org_head_office);
					$doc->exportCaption($this->org_owner);
					$doc->exportCaption($this->org_contact_no);
					$doc->exportCaption($this->org_logo);
					$doc->exportCaption($this->org_bank_acc);
					$doc->exportCaption($this->org_ntn);
					$doc->exportCaption($this->org_email);
					$doc->exportCaption($this->org_website);
				} else {
					$doc->exportCaption($this->org_id);
					$doc->exportCaption($this->org_city_id);
					$doc->exportCaption($this->org_name);
					$doc->exportCaption($this->org_head_office);
					$doc->exportCaption($this->org_owner);
					$doc->exportCaption($this->org_contact_no);
					$doc->exportCaption($this->org_logo);
					$doc->exportCaption($this->org_bank_acc);
					$doc->exportCaption($this->org_ntn);
					$doc->exportCaption($this->org_email);
					$doc->exportCaption($this->org_website);
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
						$doc->exportField($this->org_id);
						$doc->exportField($this->org_city_id);
						$doc->exportField($this->org_name);
						$doc->exportField($this->org_head_office);
						$doc->exportField($this->org_owner);
						$doc->exportField($this->org_contact_no);
						$doc->exportField($this->org_logo);
						$doc->exportField($this->org_bank_acc);
						$doc->exportField($this->org_ntn);
						$doc->exportField($this->org_email);
						$doc->exportField($this->org_website);
					} else {
						$doc->exportField($this->org_id);
						$doc->exportField($this->org_city_id);
						$doc->exportField($this->org_name);
						$doc->exportField($this->org_head_office);
						$doc->exportField($this->org_owner);
						$doc->exportField($this->org_contact_no);
						$doc->exportField($this->org_logo);
						$doc->exportField($this->org_bank_acc);
						$doc->exportField($this->org_ntn);
						$doc->exportField($this->org_email);
						$doc->exportField($this->org_website);
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
		if ($fldparm == 'org_logo') {
			$fldName = "org_logo";
			$fileNameFld = "org_logo";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->org_id->CurrentValue = $ar[0];
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