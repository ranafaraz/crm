<?php namespace PHPMaker2020\crm_live; ?>
<?php

/**
 * Table class for quotation
 */
class quotation extends DbTable
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
	public $quote_id;
	public $quote_branch_id;
	public $quote_business_id;
	public $quote_service_id;
	public $quote_issue_date;
	public $quote_due_date;
	public $quote_amount;
	public $quote_content;
	public $quote_comments;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'quotation';
		$this->TableName = 'quotation';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`quotation`";
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

		// quote_id
		$this->quote_id = new DbField('quotation', 'quotation', 'x_quote_id', 'quote_id', '`quote_id`', '`quote_id`', 3, 12, -1, FALSE, '`quote_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->quote_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->quote_id->IsPrimaryKey = TRUE; // Primary key field
		$this->quote_id->Sortable = TRUE; // Allow sort
		$this->quote_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['quote_id'] = &$this->quote_id;

		// quote_branch_id
		$this->quote_branch_id = new DbField('quotation', 'quotation', 'x_quote_branch_id', 'quote_branch_id', '`quote_branch_id`', '`quote_branch_id`', 3, 12, -1, FALSE, '`EV__quote_branch_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->quote_branch_id->Nullable = FALSE; // NOT NULL field
		$this->quote_branch_id->Required = TRUE; // Required field
		$this->quote_branch_id->Sortable = TRUE; // Allow sort
		$this->quote_branch_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->quote_branch_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->quote_branch_id->Lookup = new Lookup('quote_branch_id', 'branch', FALSE, 'branch_id', ["branch_name","","",""], [], [], [], [], [], [], '', '');
		$this->quote_branch_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['quote_branch_id'] = &$this->quote_branch_id;

		// quote_business_id
		$this->quote_business_id = new DbField('quotation', 'quotation', 'x_quote_business_id', 'quote_business_id', '`quote_business_id`', '`quote_business_id`', 3, 12, -1, FALSE, '`EV__quote_business_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->quote_business_id->Nullable = FALSE; // NOT NULL field
		$this->quote_business_id->Required = TRUE; // Required field
		$this->quote_business_id->Sortable = TRUE; // Allow sort
		$this->quote_business_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->quote_business_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->quote_business_id->Lookup = new Lookup('quote_business_id', 'business', FALSE, 'b_id', ["b_name","","",""], [], [], [], [], [], [], '', '');
		$this->quote_business_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['quote_business_id'] = &$this->quote_business_id;

		// quote_service_id
		$this->quote_service_id = new DbField('quotation', 'quotation', 'x_quote_service_id', 'quote_service_id', '`quote_service_id`', '`quote_service_id`', 3, 12, -1, FALSE, '`EV__quote_service_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->quote_service_id->Nullable = FALSE; // NOT NULL field
		$this->quote_service_id->Required = TRUE; // Required field
		$this->quote_service_id->Sortable = TRUE; // Allow sort
		$this->quote_service_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->quote_service_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->quote_service_id->Lookup = new Lookup('quote_service_id', 'services', FALSE, 'service_id', ["service_caption","","",""], [], [], [], [], [], [], '', '');
		$this->quote_service_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['quote_service_id'] = &$this->quote_service_id;

		// quote_issue_date
		$this->quote_issue_date = new DbField('quotation', 'quotation', 'x_quote_issue_date', 'quote_issue_date', '`quote_issue_date`', CastDateFieldForLike("`quote_issue_date`", 2, "DB"), 133, 10, 2, FALSE, '`quote_issue_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->quote_issue_date->Nullable = FALSE; // NOT NULL field
		$this->quote_issue_date->Required = TRUE; // Required field
		$this->quote_issue_date->Sortable = TRUE; // Allow sort
		$this->quote_issue_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['quote_issue_date'] = &$this->quote_issue_date;

		// quote_due_date
		$this->quote_due_date = new DbField('quotation', 'quotation', 'x_quote_due_date', 'quote_due_date', '`quote_due_date`', CastDateFieldForLike("`quote_due_date`", 2, "DB"), 133, 10, 2, FALSE, '`quote_due_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->quote_due_date->Nullable = FALSE; // NOT NULL field
		$this->quote_due_date->Required = TRUE; // Required field
		$this->quote_due_date->Sortable = TRUE; // Allow sort
		$this->quote_due_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['quote_due_date'] = &$this->quote_due_date;

		// quote_amount
		$this->quote_amount = new DbField('quotation', 'quotation', 'x_quote_amount', 'quote_amount', '`quote_amount`', '`quote_amount`', 3, 12, -1, FALSE, '`quote_amount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->quote_amount->Nullable = FALSE; // NOT NULL field
		$this->quote_amount->Required = TRUE; // Required field
		$this->quote_amount->Sortable = TRUE; // Allow sort
		$this->quote_amount->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['quote_amount'] = &$this->quote_amount;

		// quote_content
		$this->quote_content = new DbField('quotation', 'quotation', 'x_quote_content', 'quote_content', '`quote_content`', '`quote_content`', 201, 65535, -1, FALSE, '`quote_content`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->quote_content->Nullable = FALSE; // NOT NULL field
		$this->quote_content->Required = TRUE; // Required field
		$this->quote_content->Sortable = TRUE; // Allow sort
		$this->fields['quote_content'] = &$this->quote_content;

		// quote_comments
		$this->quote_comments = new DbField('quotation', 'quotation', 'x_quote_comments', 'quote_comments', '`quote_comments`', '`quote_comments`', 201, 65535, -1, FALSE, '`quote_comments`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->quote_comments->Nullable = FALSE; // NOT NULL field
		$this->quote_comments->Required = TRUE; // Required field
		$this->quote_comments->Sortable = TRUE; // Allow sort
		$this->fields['quote_comments'] = &$this->quote_comments;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`quotation`";
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
			"SELECT *, (SELECT `branch_name` FROM `branch` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`branch_id` = `quotation`.`quote_branch_id` LIMIT 1) AS `EV__quote_branch_id`, (SELECT `b_name` FROM `business` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`b_id` = `quotation`.`quote_business_id` LIMIT 1) AS `EV__quote_business_id`, (SELECT `service_caption` FROM `services` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`service_id` = `quotation`.`quote_service_id` LIMIT 1) AS `EV__quote_service_id` FROM `quotation`" .
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
		if ($this->quote_branch_id->AdvancedSearch->SearchValue != "" ||
			$this->quote_branch_id->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->quote_branch_id->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->quote_branch_id->VirtualExpression . " "))
			return TRUE;
		if ($this->quote_business_id->AdvancedSearch->SearchValue != "" ||
			$this->quote_business_id->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->quote_business_id->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->quote_business_id->VirtualExpression . " "))
			return TRUE;
		if ($this->quote_service_id->AdvancedSearch->SearchValue != "" ||
			$this->quote_service_id->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->quote_service_id->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->quote_service_id->VirtualExpression . " "))
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
			$this->quote_id->setDbValue($conn->insert_ID());
			$rs['quote_id'] = $this->quote_id->DbValue;
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
			if (array_key_exists('quote_id', $rs))
				AddFilter($where, QuotedName('quote_id', $this->Dbid) . '=' . QuotedValue($rs['quote_id'], $this->quote_id->DataType, $this->Dbid));
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
		$this->quote_id->DbValue = $row['quote_id'];
		$this->quote_branch_id->DbValue = $row['quote_branch_id'];
		$this->quote_business_id->DbValue = $row['quote_business_id'];
		$this->quote_service_id->DbValue = $row['quote_service_id'];
		$this->quote_issue_date->DbValue = $row['quote_issue_date'];
		$this->quote_due_date->DbValue = $row['quote_due_date'];
		$this->quote_amount->DbValue = $row['quote_amount'];
		$this->quote_content->DbValue = $row['quote_content'];
		$this->quote_comments->DbValue = $row['quote_comments'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`quote_id` = @quote_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('quote_id', $row) ? $row['quote_id'] : NULL;
		else
			$val = $this->quote_id->OldValue !== NULL ? $this->quote_id->OldValue : $this->quote_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@quote_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "quotationlist.php";
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
		if ($pageName == "quotationview.php")
			return $Language->phrase("View");
		elseif ($pageName == "quotationedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "quotationadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "quotationlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("quotationview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("quotationview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "quotationadd.php?" . $this->getUrlParm($parm);
		else
			$url = "quotationadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("quotationedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("quotationadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("quotationdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "quote_id:" . JsonEncode($this->quote_id->CurrentValue, "number");
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
		if ($this->quote_id->CurrentValue != NULL) {
			$url .= "quote_id=" . urlencode($this->quote_id->CurrentValue);
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
			if (Param("quote_id") !== NULL)
				$arKeys[] = Param("quote_id");
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
				$this->quote_id->CurrentValue = $key;
			else
				$this->quote_id->OldValue = $key;
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
		$this->quote_id->setDbValue($rs->fields('quote_id'));
		$this->quote_branch_id->setDbValue($rs->fields('quote_branch_id'));
		$this->quote_business_id->setDbValue($rs->fields('quote_business_id'));
		$this->quote_service_id->setDbValue($rs->fields('quote_service_id'));
		$this->quote_issue_date->setDbValue($rs->fields('quote_issue_date'));
		$this->quote_due_date->setDbValue($rs->fields('quote_due_date'));
		$this->quote_amount->setDbValue($rs->fields('quote_amount'));
		$this->quote_content->setDbValue($rs->fields('quote_content'));
		$this->quote_comments->setDbValue($rs->fields('quote_comments'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// quote_id
		// quote_branch_id
		// quote_business_id
		// quote_service_id
		// quote_issue_date
		// quote_due_date
		// quote_amount
		// quote_content
		// quote_comments
		// quote_id

		$this->quote_id->ViewValue = $this->quote_id->CurrentValue;
		$this->quote_id->CssClass = "font-weight-bold";
		$this->quote_id->ViewCustomAttributes = "";

		// quote_branch_id
		if ($this->quote_branch_id->VirtualValue != "") {
			$this->quote_branch_id->ViewValue = $this->quote_branch_id->VirtualValue;
		} else {
			$curVal = strval($this->quote_branch_id->CurrentValue);
			if ($curVal != "") {
				$this->quote_branch_id->ViewValue = $this->quote_branch_id->lookupCacheOption($curVal);
				if ($this->quote_branch_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`branch_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->quote_branch_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->quote_branch_id->ViewValue = $this->quote_branch_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->quote_branch_id->ViewValue = $this->quote_branch_id->CurrentValue;
					}
				}
			} else {
				$this->quote_branch_id->ViewValue = NULL;
			}
		}
		$this->quote_branch_id->ViewCustomAttributes = "";

		// quote_business_id
		if ($this->quote_business_id->VirtualValue != "") {
			$this->quote_business_id->ViewValue = $this->quote_business_id->VirtualValue;
		} else {
			$curVal = strval($this->quote_business_id->CurrentValue);
			if ($curVal != "") {
				$this->quote_business_id->ViewValue = $this->quote_business_id->lookupCacheOption($curVal);
				if ($this->quote_business_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`b_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->quote_business_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->quote_business_id->ViewValue = $this->quote_business_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->quote_business_id->ViewValue = $this->quote_business_id->CurrentValue;
					}
				}
			} else {
				$this->quote_business_id->ViewValue = NULL;
			}
		}
		$this->quote_business_id->ViewCustomAttributes = "";

		// quote_service_id
		if ($this->quote_service_id->VirtualValue != "") {
			$this->quote_service_id->ViewValue = $this->quote_service_id->VirtualValue;
		} else {
			$curVal = strval($this->quote_service_id->CurrentValue);
			if ($curVal != "") {
				$this->quote_service_id->ViewValue = $this->quote_service_id->lookupCacheOption($curVal);
				if ($this->quote_service_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`service_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->quote_service_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->quote_service_id->ViewValue = $this->quote_service_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->quote_service_id->ViewValue = $this->quote_service_id->CurrentValue;
					}
				}
			} else {
				$this->quote_service_id->ViewValue = NULL;
			}
		}
		$this->quote_service_id->ViewCustomAttributes = "";

		// quote_issue_date
		$this->quote_issue_date->ViewValue = $this->quote_issue_date->CurrentValue;
		$this->quote_issue_date->ViewValue = FormatDateTime($this->quote_issue_date->ViewValue, 2);
		$this->quote_issue_date->ViewCustomAttributes = "";

		// quote_due_date
		$this->quote_due_date->ViewValue = $this->quote_due_date->CurrentValue;
		$this->quote_due_date->ViewValue = FormatDateTime($this->quote_due_date->ViewValue, 2);
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

		// quote_id
		$this->quote_id->LinkCustomAttributes = "";
		$this->quote_id->HrefValue = "";
		$this->quote_id->TooltipValue = "";

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

		// quote_id
		$this->quote_id->EditAttrs["class"] = "form-control";
		$this->quote_id->EditCustomAttributes = "";
		$this->quote_id->EditValue = $this->quote_id->CurrentValue;
		$this->quote_id->CssClass = "font-weight-bold";
		$this->quote_id->ViewCustomAttributes = "";

		// quote_branch_id
		$this->quote_branch_id->EditCustomAttributes = "";

		// quote_business_id
		$this->quote_business_id->EditAttrs["class"] = "form-control";
		$this->quote_business_id->EditCustomAttributes = "";

		// quote_service_id
		$this->quote_service_id->EditAttrs["class"] = "form-control";
		$this->quote_service_id->EditCustomAttributes = "";

		// quote_issue_date
		$this->quote_issue_date->EditAttrs["class"] = "form-control";
		$this->quote_issue_date->EditCustomAttributes = "";
		$this->quote_issue_date->EditValue = FormatDateTime($this->quote_issue_date->CurrentValue, 2);
		$this->quote_issue_date->PlaceHolder = RemoveHtml($this->quote_issue_date->caption());

		// quote_due_date
		$this->quote_due_date->EditAttrs["class"] = "form-control";
		$this->quote_due_date->EditCustomAttributes = "";
		$this->quote_due_date->EditValue = FormatDateTime($this->quote_due_date->CurrentValue, 2);
		$this->quote_due_date->PlaceHolder = RemoveHtml($this->quote_due_date->caption());

		// quote_amount
		$this->quote_amount->EditAttrs["class"] = "form-control";
		$this->quote_amount->EditCustomAttributes = "";
		$this->quote_amount->EditValue = $this->quote_amount->CurrentValue;
		$this->quote_amount->PlaceHolder = RemoveHtml($this->quote_amount->caption());

		// quote_content
		$this->quote_content->EditAttrs["class"] = "form-control";
		$this->quote_content->EditCustomAttributes = "";
		$this->quote_content->EditValue = $this->quote_content->CurrentValue;
		$this->quote_content->PlaceHolder = RemoveHtml($this->quote_content->caption());

		// quote_comments
		$this->quote_comments->EditAttrs["class"] = "form-control";
		$this->quote_comments->EditCustomAttributes = "";
		$this->quote_comments->EditValue = $this->quote_comments->CurrentValue;
		$this->quote_comments->PlaceHolder = RemoveHtml($this->quote_comments->caption());

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
					$doc->exportCaption($this->quote_id);
					$doc->exportCaption($this->quote_branch_id);
					$doc->exportCaption($this->quote_business_id);
					$doc->exportCaption($this->quote_service_id);
					$doc->exportCaption($this->quote_issue_date);
					$doc->exportCaption($this->quote_due_date);
					$doc->exportCaption($this->quote_amount);
					$doc->exportCaption($this->quote_content);
					$doc->exportCaption($this->quote_comments);
				} else {
					$doc->exportCaption($this->quote_id);
					$doc->exportCaption($this->quote_branch_id);
					$doc->exportCaption($this->quote_business_id);
					$doc->exportCaption($this->quote_service_id);
					$doc->exportCaption($this->quote_issue_date);
					$doc->exportCaption($this->quote_due_date);
					$doc->exportCaption($this->quote_amount);
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
						$doc->exportField($this->quote_id);
						$doc->exportField($this->quote_branch_id);
						$doc->exportField($this->quote_business_id);
						$doc->exportField($this->quote_service_id);
						$doc->exportField($this->quote_issue_date);
						$doc->exportField($this->quote_due_date);
						$doc->exportField($this->quote_amount);
						$doc->exportField($this->quote_content);
						$doc->exportField($this->quote_comments);
					} else {
						$doc->exportField($this->quote_id);
						$doc->exportField($this->quote_branch_id);
						$doc->exportField($this->quote_business_id);
						$doc->exportField($this->quote_service_id);
						$doc->exportField($this->quote_issue_date);
						$doc->exportField($this->quote_due_date);
						$doc->exportField($this->quote_amount);
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