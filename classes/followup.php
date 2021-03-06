<?php namespace PHPMaker2020\crm_live; ?>
<?php

/**
 * Table class for followup
 */
class followup extends DbTable
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
	public $followup_id;
	public $followup_branch_id;
	public $followup_business_id;
	public $followup_by_emp_id;
	public $followup_no_id;
	public $followup_date;
	public $followup_comments;
	public $followup_response;
	public $nxt_FU_date;
	public $nxt_FU_plans;
	public $current_FU_status;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'followup';
		$this->TableName = 'followup';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`followup`";
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

		// followup_id
		$this->followup_id = new DbField('followup', 'followup', 'x_followup_id', 'followup_id', '`followup_id`', '`followup_id`', 3, 12, -1, FALSE, '`followup_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->followup_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->followup_id->IsPrimaryKey = TRUE; // Primary key field
		$this->followup_id->Sortable = TRUE; // Allow sort
		$this->followup_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['followup_id'] = &$this->followup_id;

		// followup_branch_id
		$this->followup_branch_id = new DbField('followup', 'followup', 'x_followup_branch_id', 'followup_branch_id', '`followup_branch_id`', '`followup_branch_id`', 3, 12, -1, FALSE, '`EV__followup_branch_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->followup_branch_id->Nullable = FALSE; // NOT NULL field
		$this->followup_branch_id->Required = TRUE; // Required field
		$this->followup_branch_id->Sortable = TRUE; // Allow sort
		$this->followup_branch_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->followup_branch_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->followup_branch_id->Lookup = new Lookup('followup_branch_id', 'branch', FALSE, 'branch_id', ["branch_name","","",""], [], [], [], [], [], [], '', '');
		$this->followup_branch_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['followup_branch_id'] = &$this->followup_branch_id;

		// followup_business_id
		$this->followup_business_id = new DbField('followup', 'followup', 'x_followup_business_id', 'followup_business_id', '`followup_business_id`', '`followup_business_id`', 3, 12, -1, FALSE, '`EV__followup_business_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->followup_business_id->Nullable = FALSE; // NOT NULL field
		$this->followup_business_id->Required = TRUE; // Required field
		$this->followup_business_id->Sortable = TRUE; // Allow sort
		$this->followup_business_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->followup_business_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->followup_business_id->Lookup = new Lookup('followup_business_id', 'business', FALSE, 'b_id', ["b_name","","",""], [], [], [], [], [], [], '', '');
		$this->followup_business_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['followup_business_id'] = &$this->followup_business_id;

		// followup_by_emp_id
		$this->followup_by_emp_id = new DbField('followup', 'followup', 'x_followup_by_emp_id', 'followup_by_emp_id', '`followup_by_emp_id`', '`followup_by_emp_id`', 3, 12, -1, FALSE, '`EV__followup_by_emp_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->followup_by_emp_id->Nullable = FALSE; // NOT NULL field
		$this->followup_by_emp_id->Required = TRUE; // Required field
		$this->followup_by_emp_id->Sortable = TRUE; // Allow sort
		$this->followup_by_emp_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->followup_by_emp_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->followup_by_emp_id->Lookup = new Lookup('followup_by_emp_id', 'employees', FALSE, 'emp_id', ["emp_name","","",""], [], [], [], [], [], [], '', '');
		$this->followup_by_emp_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['followup_by_emp_id'] = &$this->followup_by_emp_id;

		// followup_no_id
		$this->followup_no_id = new DbField('followup', 'followup', 'x_followup_no_id', 'followup_no_id', '`followup_no_id`', '`followup_no_id`', 3, 12, -1, FALSE, '`EV__followup_no_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->followup_no_id->Nullable = FALSE; // NOT NULL field
		$this->followup_no_id->Required = TRUE; // Required field
		$this->followup_no_id->Sortable = TRUE; // Allow sort
		$this->followup_no_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->followup_no_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->followup_no_id->Lookup = new Lookup('followup_no_id', 'followup_no', FALSE, 'followup_no_id', ["followup_no_caption","","",""], [], [], [], [], [], [], '', '');
		$this->followup_no_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['followup_no_id'] = &$this->followup_no_id;

		// followup_date
		$this->followup_date = new DbField('followup', 'followup', 'x_followup_date', 'followup_date', '`followup_date`', CastDateFieldForLike("`followup_date`", 1, "DB"), 135, 19, 1, FALSE, '`followup_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->followup_date->Nullable = FALSE; // NOT NULL field
		$this->followup_date->Required = TRUE; // Required field
		$this->followup_date->Sortable = TRUE; // Allow sort
		$this->followup_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['followup_date'] = &$this->followup_date;

		// followup_comments
		$this->followup_comments = new DbField('followup', 'followup', 'x_followup_comments', 'followup_comments', '`followup_comments`', '`followup_comments`', 201, 65535, -1, FALSE, '`followup_comments`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->followup_comments->Nullable = FALSE; // NOT NULL field
		$this->followup_comments->Required = TRUE; // Required field
		$this->followup_comments->Sortable = TRUE; // Allow sort
		$this->fields['followup_comments'] = &$this->followup_comments;

		// followup_response
		$this->followup_response = new DbField('followup', 'followup', 'x_followup_response', 'followup_response', '`followup_response`', '`followup_response`', 202, 54, -1, FALSE, '`followup_response`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->followup_response->Nullable = FALSE; // NOT NULL field
		$this->followup_response->Required = TRUE; // Required field
		$this->followup_response->Sortable = TRUE; // Allow sort
		$this->followup_response->Lookup = new Lookup('followup_response', 'followup', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->followup_response->OptionCount = 5;
		$this->fields['followup_response'] = &$this->followup_response;

		// nxt_FU_date
		$this->nxt_FU_date = new DbField('followup', 'followup', 'x_nxt_FU_date', 'nxt_FU_date', '`nxt_FU_date`', CastDateFieldForLike("`nxt_FU_date`", 1, "DB"), 135, 19, 1, FALSE, '`nxt_FU_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nxt_FU_date->Nullable = FALSE; // NOT NULL field
		$this->nxt_FU_date->Required = TRUE; // Required field
		$this->nxt_FU_date->Sortable = TRUE; // Allow sort
		$this->nxt_FU_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['nxt_FU_date'] = &$this->nxt_FU_date;

		// nxt_FU_plans
		$this->nxt_FU_plans = new DbField('followup', 'followup', 'x_nxt_FU_plans', 'nxt_FU_plans', '`nxt_FU_plans`', '`nxt_FU_plans`', 201, 65535, -1, FALSE, '`nxt_FU_plans`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->nxt_FU_plans->Nullable = FALSE; // NOT NULL field
		$this->nxt_FU_plans->Required = TRUE; // Required field
		$this->nxt_FU_plans->Sortable = TRUE; // Allow sort
		$this->fields['nxt_FU_plans'] = &$this->nxt_FU_plans;

		// current_FU_status
		$this->current_FU_status = new DbField('followup', 'followup', 'x_current_FU_status', 'current_FU_status', '`current_FU_status`', '`current_FU_status`', 202, 39, -1, FALSE, '`current_FU_status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->current_FU_status->Nullable = FALSE; // NOT NULL field
		$this->current_FU_status->Required = TRUE; // Required field
		$this->current_FU_status->Sortable = TRUE; // Allow sort
		$this->current_FU_status->Lookup = new Lookup('current_FU_status', 'followup', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->current_FU_status->OptionCount = 4;
		$this->fields['current_FU_status'] = &$this->current_FU_status;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`followup`";
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
			"SELECT *, (SELECT `branch_name` FROM `branch` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`branch_id` = `followup`.`followup_branch_id` LIMIT 1) AS `EV__followup_branch_id`, (SELECT `b_name` FROM `business` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`b_id` = `followup`.`followup_business_id` LIMIT 1) AS `EV__followup_business_id`, (SELECT `emp_name` FROM `employees` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`emp_id` = `followup`.`followup_by_emp_id` LIMIT 1) AS `EV__followup_by_emp_id`, (SELECT `followup_no_caption` FROM `followup_no` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`followup_no_id` = `followup`.`followup_no_id` LIMIT 1) AS `EV__followup_no_id` FROM `followup`" .
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
		if ($this->followup_branch_id->AdvancedSearch->SearchValue != "" ||
			$this->followup_branch_id->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->followup_branch_id->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->followup_branch_id->VirtualExpression . " "))
			return TRUE;
		if ($this->followup_business_id->AdvancedSearch->SearchValue != "" ||
			$this->followup_business_id->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->followup_business_id->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->followup_business_id->VirtualExpression . " "))
			return TRUE;
		if ($this->followup_by_emp_id->AdvancedSearch->SearchValue != "" ||
			$this->followup_by_emp_id->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->followup_by_emp_id->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->followup_by_emp_id->VirtualExpression . " "))
			return TRUE;
		if ($this->followup_no_id->AdvancedSearch->SearchValue != "" ||
			$this->followup_no_id->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->followup_no_id->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->followup_no_id->VirtualExpression . " "))
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
			$this->followup_id->setDbValue($conn->insert_ID());
			$rs['followup_id'] = $this->followup_id->DbValue;
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
			if (array_key_exists('followup_id', $rs))
				AddFilter($where, QuotedName('followup_id', $this->Dbid) . '=' . QuotedValue($rs['followup_id'], $this->followup_id->DataType, $this->Dbid));
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
		$this->followup_id->DbValue = $row['followup_id'];
		$this->followup_branch_id->DbValue = $row['followup_branch_id'];
		$this->followup_business_id->DbValue = $row['followup_business_id'];
		$this->followup_by_emp_id->DbValue = $row['followup_by_emp_id'];
		$this->followup_no_id->DbValue = $row['followup_no_id'];
		$this->followup_date->DbValue = $row['followup_date'];
		$this->followup_comments->DbValue = $row['followup_comments'];
		$this->followup_response->DbValue = $row['followup_response'];
		$this->nxt_FU_date->DbValue = $row['nxt_FU_date'];
		$this->nxt_FU_plans->DbValue = $row['nxt_FU_plans'];
		$this->current_FU_status->DbValue = $row['current_FU_status'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`followup_id` = @followup_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('followup_id', $row) ? $row['followup_id'] : NULL;
		else
			$val = $this->followup_id->OldValue !== NULL ? $this->followup_id->OldValue : $this->followup_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@followup_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "followuplist.php";
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
		if ($pageName == "followupview.php")
			return $Language->phrase("View");
		elseif ($pageName == "followupedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "followupadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "followuplist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("followupview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("followupview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "followupadd.php?" . $this->getUrlParm($parm);
		else
			$url = "followupadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("followupedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("followupadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("followupdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "followup_id:" . JsonEncode($this->followup_id->CurrentValue, "number");
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
		if ($this->followup_id->CurrentValue != NULL) {
			$url .= "followup_id=" . urlencode($this->followup_id->CurrentValue);
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
			if (Param("followup_id") !== NULL)
				$arKeys[] = Param("followup_id");
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
				$this->followup_id->CurrentValue = $key;
			else
				$this->followup_id->OldValue = $key;
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
		$this->followup_id->setDbValue($rs->fields('followup_id'));
		$this->followup_branch_id->setDbValue($rs->fields('followup_branch_id'));
		$this->followup_business_id->setDbValue($rs->fields('followup_business_id'));
		$this->followup_by_emp_id->setDbValue($rs->fields('followup_by_emp_id'));
		$this->followup_no_id->setDbValue($rs->fields('followup_no_id'));
		$this->followup_date->setDbValue($rs->fields('followup_date'));
		$this->followup_comments->setDbValue($rs->fields('followup_comments'));
		$this->followup_response->setDbValue($rs->fields('followup_response'));
		$this->nxt_FU_date->setDbValue($rs->fields('nxt_FU_date'));
		$this->nxt_FU_plans->setDbValue($rs->fields('nxt_FU_plans'));
		$this->current_FU_status->setDbValue($rs->fields('current_FU_status'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
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
		// followup_id

		$this->followup_id->ViewValue = $this->followup_id->CurrentValue;
		$this->followup_id->CssClass = "font-weight-bold";
		$this->followup_id->ViewCustomAttributes = "";

		// followup_branch_id
		if ($this->followup_branch_id->VirtualValue != "") {
			$this->followup_branch_id->ViewValue = $this->followup_branch_id->VirtualValue;
		} else {
			$curVal = strval($this->followup_branch_id->CurrentValue);
			if ($curVal != "") {
				$this->followup_branch_id->ViewValue = $this->followup_branch_id->lookupCacheOption($curVal);
				if ($this->followup_branch_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`branch_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->followup_branch_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->followup_branch_id->ViewValue = $this->followup_branch_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->followup_branch_id->ViewValue = $this->followup_branch_id->CurrentValue;
					}
				}
			} else {
				$this->followup_branch_id->ViewValue = NULL;
			}
		}
		$this->followup_branch_id->ViewCustomAttributes = "";

		// followup_business_id
		if ($this->followup_business_id->VirtualValue != "") {
			$this->followup_business_id->ViewValue = $this->followup_business_id->VirtualValue;
		} else {
			$curVal = strval($this->followup_business_id->CurrentValue);
			if ($curVal != "") {
				$this->followup_business_id->ViewValue = $this->followup_business_id->lookupCacheOption($curVal);
				if ($this->followup_business_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`b_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->followup_business_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->followup_business_id->ViewValue = $this->followup_business_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->followup_business_id->ViewValue = $this->followup_business_id->CurrentValue;
					}
				}
			} else {
				$this->followup_business_id->ViewValue = NULL;
			}
		}
		$this->followup_business_id->ViewCustomAttributes = "";

		// followup_by_emp_id
		if ($this->followup_by_emp_id->VirtualValue != "") {
			$this->followup_by_emp_id->ViewValue = $this->followup_by_emp_id->VirtualValue;
		} else {
			$curVal = strval($this->followup_by_emp_id->CurrentValue);
			if ($curVal != "") {
				$this->followup_by_emp_id->ViewValue = $this->followup_by_emp_id->lookupCacheOption($curVal);
				if ($this->followup_by_emp_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`emp_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->followup_by_emp_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->followup_by_emp_id->ViewValue = $this->followup_by_emp_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->followup_by_emp_id->ViewValue = $this->followup_by_emp_id->CurrentValue;
					}
				}
			} else {
				$this->followup_by_emp_id->ViewValue = NULL;
			}
		}
		$this->followup_by_emp_id->ViewCustomAttributes = "";

		// followup_no_id
		if ($this->followup_no_id->VirtualValue != "") {
			$this->followup_no_id->ViewValue = $this->followup_no_id->VirtualValue;
		} else {
			$curVal = strval($this->followup_no_id->CurrentValue);
			if ($curVal != "") {
				$this->followup_no_id->ViewValue = $this->followup_no_id->lookupCacheOption($curVal);
				if ($this->followup_no_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`followup_no_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->followup_no_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->followup_no_id->ViewValue = $this->followup_no_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->followup_no_id->ViewValue = $this->followup_no_id->CurrentValue;
					}
				}
			} else {
				$this->followup_no_id->ViewValue = NULL;
			}
		}
		$this->followup_no_id->ViewCustomAttributes = "";

		// followup_date
		$this->followup_date->ViewValue = $this->followup_date->CurrentValue;
		$this->followup_date->ViewValue = FormatDateTime($this->followup_date->ViewValue, 1);
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
		$this->nxt_FU_date->ViewValue = FormatDateTime($this->nxt_FU_date->ViewValue, 1);
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

		// followup_id
		$this->followup_id->EditAttrs["class"] = "form-control";
		$this->followup_id->EditCustomAttributes = "";
		$this->followup_id->EditValue = $this->followup_id->CurrentValue;
		$this->followup_id->CssClass = "font-weight-bold";
		$this->followup_id->ViewCustomAttributes = "";

		// followup_branch_id
		$this->followup_branch_id->EditCustomAttributes = "";

		// followup_business_id
		$this->followup_business_id->EditAttrs["class"] = "form-control";
		$this->followup_business_id->EditCustomAttributes = "";

		// followup_by_emp_id
		$this->followup_by_emp_id->EditAttrs["class"] = "form-control";
		$this->followup_by_emp_id->EditCustomAttributes = "";

		// followup_no_id
		$this->followup_no_id->EditAttrs["class"] = "form-control";
		$this->followup_no_id->EditCustomAttributes = "";

		// followup_date
		$this->followup_date->EditAttrs["class"] = "form-control";
		$this->followup_date->EditCustomAttributes = "";
		$this->followup_date->EditValue = FormatDateTime($this->followup_date->CurrentValue, 8);
		$this->followup_date->PlaceHolder = RemoveHtml($this->followup_date->caption());

		// followup_comments
		$this->followup_comments->EditAttrs["class"] = "form-control";
		$this->followup_comments->EditCustomAttributes = "";
		$this->followup_comments->EditValue = $this->followup_comments->CurrentValue;
		$this->followup_comments->PlaceHolder = RemoveHtml($this->followup_comments->caption());

		// followup_response
		$this->followup_response->EditCustomAttributes = "";
		$this->followup_response->EditValue = $this->followup_response->options(FALSE);

		// nxt_FU_date
		$this->nxt_FU_date->EditAttrs["class"] = "form-control";
		$this->nxt_FU_date->EditCustomAttributes = "";
		$this->nxt_FU_date->EditValue = FormatDateTime($this->nxt_FU_date->CurrentValue, 8);
		$this->nxt_FU_date->PlaceHolder = RemoveHtml($this->nxt_FU_date->caption());

		// nxt_FU_plans
		$this->nxt_FU_plans->EditAttrs["class"] = "form-control";
		$this->nxt_FU_plans->EditCustomAttributes = "";
		$this->nxt_FU_plans->EditValue = $this->nxt_FU_plans->CurrentValue;
		$this->nxt_FU_plans->PlaceHolder = RemoveHtml($this->nxt_FU_plans->caption());

		// current_FU_status
		$this->current_FU_status->EditCustomAttributes = "";
		$this->current_FU_status->EditValue = $this->current_FU_status->options(FALSE);

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
					$doc->exportCaption($this->followup_id);
					$doc->exportCaption($this->followup_branch_id);
					$doc->exportCaption($this->followup_business_id);
					$doc->exportCaption($this->followup_by_emp_id);
					$doc->exportCaption($this->followup_no_id);
					$doc->exportCaption($this->followup_date);
					$doc->exportCaption($this->followup_comments);
					$doc->exportCaption($this->followup_response);
					$doc->exportCaption($this->nxt_FU_date);
					$doc->exportCaption($this->nxt_FU_plans);
					$doc->exportCaption($this->current_FU_status);
				} else {
					$doc->exportCaption($this->followup_id);
					$doc->exportCaption($this->followup_branch_id);
					$doc->exportCaption($this->followup_business_id);
					$doc->exportCaption($this->followup_by_emp_id);
					$doc->exportCaption($this->followup_no_id);
					$doc->exportCaption($this->followup_date);
					$doc->exportCaption($this->followup_response);
					$doc->exportCaption($this->nxt_FU_date);
					$doc->exportCaption($this->current_FU_status);
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
						$doc->exportField($this->followup_id);
						$doc->exportField($this->followup_branch_id);
						$doc->exportField($this->followup_business_id);
						$doc->exportField($this->followup_by_emp_id);
						$doc->exportField($this->followup_no_id);
						$doc->exportField($this->followup_date);
						$doc->exportField($this->followup_comments);
						$doc->exportField($this->followup_response);
						$doc->exportField($this->nxt_FU_date);
						$doc->exportField($this->nxt_FU_plans);
						$doc->exportField($this->current_FU_status);
					} else {
						$doc->exportField($this->followup_id);
						$doc->exportField($this->followup_branch_id);
						$doc->exportField($this->followup_business_id);
						$doc->exportField($this->followup_by_emp_id);
						$doc->exportField($this->followup_no_id);
						$doc->exportField($this->followup_date);
						$doc->exportField($this->followup_response);
						$doc->exportField($this->nxt_FU_date);
						$doc->exportField($this->current_FU_status);
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

		// No binary fields
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