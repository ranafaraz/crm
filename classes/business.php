<?php namespace PHPMaker2020\project1; ?>
<?php

/**
 * Table class for business
 */
class business extends DbTable
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
	public $b_id;
	public $b_branch_id;
	public $b_b_type_id;
	public $b_b_status_id;
	public $b_b_nature_id;
	public $b_city_id;
	public $b_referral_id;
	public $b_name;
	public $b_owner;
	public $b_contact;
	public $b_address;
	public $b_email;
	public $b_ntn;
	public $b_logo;
	public $b_no_of_emp;
	public $b_since;
	public $b_no_of_branches;
	public $b_deal_with_referral;
	public $b_comments;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'business';
		$this->TableName = 'business';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`business`";
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

		// b_id
		$this->b_id = new DbField('business', 'business', 'x_b_id', 'b_id', '`b_id`', '`b_id`', 3, 12, -1, FALSE, '`b_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->b_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->b_id->IsPrimaryKey = TRUE; // Primary key field
		$this->b_id->Sortable = TRUE; // Allow sort
		$this->b_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['b_id'] = &$this->b_id;

		// b_branch_id
		$this->b_branch_id = new DbField('business', 'business', 'x_b_branch_id', 'b_branch_id', '`b_branch_id`', '`b_branch_id`', 3, 12, -1, FALSE, '`b_branch_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_branch_id->Nullable = FALSE; // NOT NULL field
		$this->b_branch_id->Required = TRUE; // Required field
		$this->b_branch_id->Sortable = TRUE; // Allow sort
		$this->b_branch_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['b_branch_id'] = &$this->b_branch_id;

		// b_b_type_id
		$this->b_b_type_id = new DbField('business', 'business', 'x_b_b_type_id', 'b_b_type_id', '`b_b_type_id`', '`b_b_type_id`', 3, 12, -1, FALSE, '`b_b_type_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_b_type_id->Nullable = FALSE; // NOT NULL field
		$this->b_b_type_id->Required = TRUE; // Required field
		$this->b_b_type_id->Sortable = TRUE; // Allow sort
		$this->b_b_type_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['b_b_type_id'] = &$this->b_b_type_id;

		// b_b_status_id
		$this->b_b_status_id = new DbField('business', 'business', 'x_b_b_status_id', 'b_b_status_id', '`b_b_status_id`', '`b_b_status_id`', 3, 12, -1, FALSE, '`b_b_status_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_b_status_id->Nullable = FALSE; // NOT NULL field
		$this->b_b_status_id->Required = TRUE; // Required field
		$this->b_b_status_id->Sortable = TRUE; // Allow sort
		$this->b_b_status_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['b_b_status_id'] = &$this->b_b_status_id;

		// b_b_nature_id
		$this->b_b_nature_id = new DbField('business', 'business', 'x_b_b_nature_id', 'b_b_nature_id', '`b_b_nature_id`', '`b_b_nature_id`', 3, 12, -1, FALSE, '`b_b_nature_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_b_nature_id->Nullable = FALSE; // NOT NULL field
		$this->b_b_nature_id->Required = TRUE; // Required field
		$this->b_b_nature_id->Sortable = TRUE; // Allow sort
		$this->b_b_nature_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['b_b_nature_id'] = &$this->b_b_nature_id;

		// b_city_id
		$this->b_city_id = new DbField('business', 'business', 'x_b_city_id', 'b_city_id', '`b_city_id`', '`b_city_id`', 3, 12, -1, FALSE, '`b_city_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_city_id->Nullable = FALSE; // NOT NULL field
		$this->b_city_id->Required = TRUE; // Required field
		$this->b_city_id->Sortable = TRUE; // Allow sort
		$this->b_city_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['b_city_id'] = &$this->b_city_id;

		// b_referral_id
		$this->b_referral_id = new DbField('business', 'business', 'x_b_referral_id', 'b_referral_id', '`b_referral_id`', '`b_referral_id`', 3, 12, -1, FALSE, '`b_referral_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_referral_id->Sortable = TRUE; // Allow sort
		$this->b_referral_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['b_referral_id'] = &$this->b_referral_id;

		// b_name
		$this->b_name = new DbField('business', 'business', 'x_b_name', 'b_name', '`b_name`', '`b_name`', 200, 100, -1, FALSE, '`b_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_name->Nullable = FALSE; // NOT NULL field
		$this->b_name->Required = TRUE; // Required field
		$this->b_name->Sortable = TRUE; // Allow sort
		$this->fields['b_name'] = &$this->b_name;

		// b_owner
		$this->b_owner = new DbField('business', 'business', 'x_b_owner', 'b_owner', '`b_owner`', '`b_owner`', 200, 100, -1, FALSE, '`b_owner`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_owner->Nullable = FALSE; // NOT NULL field
		$this->b_owner->Required = TRUE; // Required field
		$this->b_owner->Sortable = TRUE; // Allow sort
		$this->fields['b_owner'] = &$this->b_owner;

		// b_contact
		$this->b_contact = new DbField('business', 'business', 'x_b_contact', 'b_contact', '`b_contact`', '`b_contact`', 200, 50, -1, FALSE, '`b_contact`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_contact->Nullable = FALSE; // NOT NULL field
		$this->b_contact->Required = TRUE; // Required field
		$this->b_contact->Sortable = TRUE; // Allow sort
		$this->fields['b_contact'] = &$this->b_contact;

		// b_address
		$this->b_address = new DbField('business', 'business', 'x_b_address', 'b_address', '`b_address`', '`b_address`', 200, 100, -1, FALSE, '`b_address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_address->Nullable = FALSE; // NOT NULL field
		$this->b_address->Required = TRUE; // Required field
		$this->b_address->Sortable = TRUE; // Allow sort
		$this->fields['b_address'] = &$this->b_address;

		// b_email
		$this->b_email = new DbField('business', 'business', 'x_b_email', 'b_email', '`b_email`', '`b_email`', 200, 50, -1, FALSE, '`b_email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_email->Nullable = FALSE; // NOT NULL field
		$this->b_email->Required = TRUE; // Required field
		$this->b_email->Sortable = TRUE; // Allow sort
		$this->fields['b_email'] = &$this->b_email;

		// b_ntn
		$this->b_ntn = new DbField('business', 'business', 'x_b_ntn', 'b_ntn', '`b_ntn`', '`b_ntn`', 200, 10, -1, FALSE, '`b_ntn`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_ntn->Nullable = FALSE; // NOT NULL field
		$this->b_ntn->Required = TRUE; // Required field
		$this->b_ntn->Sortable = TRUE; // Allow sort
		$this->fields['b_ntn'] = &$this->b_ntn;

		// b_logo
		$this->b_logo = new DbField('business', 'business', 'x_b_logo', 'b_logo', '`b_logo`', '`b_logo`', 200, 100, -1, FALSE, '`b_logo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_logo->Nullable = FALSE; // NOT NULL field
		$this->b_logo->Required = TRUE; // Required field
		$this->b_logo->Sortable = TRUE; // Allow sort
		$this->fields['b_logo'] = &$this->b_logo;

		// b_no_of_emp
		$this->b_no_of_emp = new DbField('business', 'business', 'x_b_no_of_emp', 'b_no_of_emp', '`b_no_of_emp`', '`b_no_of_emp`', 3, 6, -1, FALSE, '`b_no_of_emp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_no_of_emp->Nullable = FALSE; // NOT NULL field
		$this->b_no_of_emp->Required = TRUE; // Required field
		$this->b_no_of_emp->Sortable = TRUE; // Allow sort
		$this->b_no_of_emp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['b_no_of_emp'] = &$this->b_no_of_emp;

		// b_since
		$this->b_since = new DbField('business', 'business', 'x_b_since', 'b_since', '`b_since`', '`b_since`', 200, 10, -1, FALSE, '`b_since`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_since->Nullable = FALSE; // NOT NULL field
		$this->b_since->Required = TRUE; // Required field
		$this->b_since->Sortable = TRUE; // Allow sort
		$this->fields['b_since'] = &$this->b_since;

		// b_no_of_branches
		$this->b_no_of_branches = new DbField('business', 'business', 'x_b_no_of_branches', 'b_no_of_branches', '`b_no_of_branches`', '`b_no_of_branches`', 3, 4, -1, FALSE, '`b_no_of_branches`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_no_of_branches->Nullable = FALSE; // NOT NULL field
		$this->b_no_of_branches->Required = TRUE; // Required field
		$this->b_no_of_branches->Sortable = TRUE; // Allow sort
		$this->b_no_of_branches->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['b_no_of_branches'] = &$this->b_no_of_branches;

		// b_deal_with_referral
		$this->b_deal_with_referral = new DbField('business', 'business', 'x_b_deal_with_referral', 'b_deal_with_referral', '`b_deal_with_referral`', '`b_deal_with_referral`', 200, 100, -1, FALSE, '`b_deal_with_referral`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_deal_with_referral->Sortable = TRUE; // Allow sort
		$this->fields['b_deal_with_referral'] = &$this->b_deal_with_referral;

		// b_comments
		$this->b_comments = new DbField('business', 'business', 'x_b_comments', 'b_comments', '`b_comments`', '`b_comments`', 200, 100, -1, FALSE, '`b_comments`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->b_comments->Nullable = FALSE; // NOT NULL field
		$this->b_comments->Required = TRUE; // Required field
		$this->b_comments->Sortable = TRUE; // Allow sort
		$this->fields['b_comments'] = &$this->b_comments;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`business`";
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
			$this->b_id->setDbValue($conn->insert_ID());
			$rs['b_id'] = $this->b_id->DbValue;
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
			if (array_key_exists('b_id', $rs))
				AddFilter($where, QuotedName('b_id', $this->Dbid) . '=' . QuotedValue($rs['b_id'], $this->b_id->DataType, $this->Dbid));
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
		$this->b_id->DbValue = $row['b_id'];
		$this->b_branch_id->DbValue = $row['b_branch_id'];
		$this->b_b_type_id->DbValue = $row['b_b_type_id'];
		$this->b_b_status_id->DbValue = $row['b_b_status_id'];
		$this->b_b_nature_id->DbValue = $row['b_b_nature_id'];
		$this->b_city_id->DbValue = $row['b_city_id'];
		$this->b_referral_id->DbValue = $row['b_referral_id'];
		$this->b_name->DbValue = $row['b_name'];
		$this->b_owner->DbValue = $row['b_owner'];
		$this->b_contact->DbValue = $row['b_contact'];
		$this->b_address->DbValue = $row['b_address'];
		$this->b_email->DbValue = $row['b_email'];
		$this->b_ntn->DbValue = $row['b_ntn'];
		$this->b_logo->DbValue = $row['b_logo'];
		$this->b_no_of_emp->DbValue = $row['b_no_of_emp'];
		$this->b_since->DbValue = $row['b_since'];
		$this->b_no_of_branches->DbValue = $row['b_no_of_branches'];
		$this->b_deal_with_referral->DbValue = $row['b_deal_with_referral'];
		$this->b_comments->DbValue = $row['b_comments'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`b_id` = @b_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('b_id', $row) ? $row['b_id'] : NULL;
		else
			$val = $this->b_id->OldValue !== NULL ? $this->b_id->OldValue : $this->b_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@b_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "businesslist.php";
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
		if ($pageName == "businessview.php")
			return $Language->phrase("View");
		elseif ($pageName == "businessedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "businessadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "businesslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("businessview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("businessview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "businessadd.php?" . $this->getUrlParm($parm);
		else
			$url = "businessadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("businessedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("businessadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("businessdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "b_id:" . JsonEncode($this->b_id->CurrentValue, "number");
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
		if ($this->b_id->CurrentValue != NULL) {
			$url .= "b_id=" . urlencode($this->b_id->CurrentValue);
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
			if (Param("b_id") !== NULL)
				$arKeys[] = Param("b_id");
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
				$this->b_id->CurrentValue = $key;
			else
				$this->b_id->OldValue = $key;
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
		$this->b_id->setDbValue($rs->fields('b_id'));
		$this->b_branch_id->setDbValue($rs->fields('b_branch_id'));
		$this->b_b_type_id->setDbValue($rs->fields('b_b_type_id'));
		$this->b_b_status_id->setDbValue($rs->fields('b_b_status_id'));
		$this->b_b_nature_id->setDbValue($rs->fields('b_b_nature_id'));
		$this->b_city_id->setDbValue($rs->fields('b_city_id'));
		$this->b_referral_id->setDbValue($rs->fields('b_referral_id'));
		$this->b_name->setDbValue($rs->fields('b_name'));
		$this->b_owner->setDbValue($rs->fields('b_owner'));
		$this->b_contact->setDbValue($rs->fields('b_contact'));
		$this->b_address->setDbValue($rs->fields('b_address'));
		$this->b_email->setDbValue($rs->fields('b_email'));
		$this->b_ntn->setDbValue($rs->fields('b_ntn'));
		$this->b_logo->setDbValue($rs->fields('b_logo'));
		$this->b_no_of_emp->setDbValue($rs->fields('b_no_of_emp'));
		$this->b_since->setDbValue($rs->fields('b_since'));
		$this->b_no_of_branches->setDbValue($rs->fields('b_no_of_branches'));
		$this->b_deal_with_referral->setDbValue($rs->fields('b_deal_with_referral'));
		$this->b_comments->setDbValue($rs->fields('b_comments'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
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

		// b_id
		$this->b_id->EditAttrs["class"] = "form-control";
		$this->b_id->EditCustomAttributes = "";
		$this->b_id->EditValue = $this->b_id->CurrentValue;
		$this->b_id->ViewCustomAttributes = "";

		// b_branch_id
		$this->b_branch_id->EditAttrs["class"] = "form-control";
		$this->b_branch_id->EditCustomAttributes = "";
		$this->b_branch_id->EditValue = $this->b_branch_id->CurrentValue;
		$this->b_branch_id->PlaceHolder = RemoveHtml($this->b_branch_id->caption());

		// b_b_type_id
		$this->b_b_type_id->EditAttrs["class"] = "form-control";
		$this->b_b_type_id->EditCustomAttributes = "";
		$this->b_b_type_id->EditValue = $this->b_b_type_id->CurrentValue;
		$this->b_b_type_id->PlaceHolder = RemoveHtml($this->b_b_type_id->caption());

		// b_b_status_id
		$this->b_b_status_id->EditAttrs["class"] = "form-control";
		$this->b_b_status_id->EditCustomAttributes = "";
		$this->b_b_status_id->EditValue = $this->b_b_status_id->CurrentValue;
		$this->b_b_status_id->PlaceHolder = RemoveHtml($this->b_b_status_id->caption());

		// b_b_nature_id
		$this->b_b_nature_id->EditAttrs["class"] = "form-control";
		$this->b_b_nature_id->EditCustomAttributes = "";
		$this->b_b_nature_id->EditValue = $this->b_b_nature_id->CurrentValue;
		$this->b_b_nature_id->PlaceHolder = RemoveHtml($this->b_b_nature_id->caption());

		// b_city_id
		$this->b_city_id->EditAttrs["class"] = "form-control";
		$this->b_city_id->EditCustomAttributes = "";
		$this->b_city_id->EditValue = $this->b_city_id->CurrentValue;
		$this->b_city_id->PlaceHolder = RemoveHtml($this->b_city_id->caption());

		// b_referral_id
		$this->b_referral_id->EditAttrs["class"] = "form-control";
		$this->b_referral_id->EditCustomAttributes = "";
		$this->b_referral_id->EditValue = $this->b_referral_id->CurrentValue;
		$this->b_referral_id->PlaceHolder = RemoveHtml($this->b_referral_id->caption());

		// b_name
		$this->b_name->EditAttrs["class"] = "form-control";
		$this->b_name->EditCustomAttributes = "";
		if (!$this->b_name->Raw)
			$this->b_name->CurrentValue = HtmlDecode($this->b_name->CurrentValue);
		$this->b_name->EditValue = $this->b_name->CurrentValue;
		$this->b_name->PlaceHolder = RemoveHtml($this->b_name->caption());

		// b_owner
		$this->b_owner->EditAttrs["class"] = "form-control";
		$this->b_owner->EditCustomAttributes = "";
		if (!$this->b_owner->Raw)
			$this->b_owner->CurrentValue = HtmlDecode($this->b_owner->CurrentValue);
		$this->b_owner->EditValue = $this->b_owner->CurrentValue;
		$this->b_owner->PlaceHolder = RemoveHtml($this->b_owner->caption());

		// b_contact
		$this->b_contact->EditAttrs["class"] = "form-control";
		$this->b_contact->EditCustomAttributes = "";
		if (!$this->b_contact->Raw)
			$this->b_contact->CurrentValue = HtmlDecode($this->b_contact->CurrentValue);
		$this->b_contact->EditValue = $this->b_contact->CurrentValue;
		$this->b_contact->PlaceHolder = RemoveHtml($this->b_contact->caption());

		// b_address
		$this->b_address->EditAttrs["class"] = "form-control";
		$this->b_address->EditCustomAttributes = "";
		if (!$this->b_address->Raw)
			$this->b_address->CurrentValue = HtmlDecode($this->b_address->CurrentValue);
		$this->b_address->EditValue = $this->b_address->CurrentValue;
		$this->b_address->PlaceHolder = RemoveHtml($this->b_address->caption());

		// b_email
		$this->b_email->EditAttrs["class"] = "form-control";
		$this->b_email->EditCustomAttributes = "";
		if (!$this->b_email->Raw)
			$this->b_email->CurrentValue = HtmlDecode($this->b_email->CurrentValue);
		$this->b_email->EditValue = $this->b_email->CurrentValue;
		$this->b_email->PlaceHolder = RemoveHtml($this->b_email->caption());

		// b_ntn
		$this->b_ntn->EditAttrs["class"] = "form-control";
		$this->b_ntn->EditCustomAttributes = "";
		if (!$this->b_ntn->Raw)
			$this->b_ntn->CurrentValue = HtmlDecode($this->b_ntn->CurrentValue);
		$this->b_ntn->EditValue = $this->b_ntn->CurrentValue;
		$this->b_ntn->PlaceHolder = RemoveHtml($this->b_ntn->caption());

		// b_logo
		$this->b_logo->EditAttrs["class"] = "form-control";
		$this->b_logo->EditCustomAttributes = "";
		if (!$this->b_logo->Raw)
			$this->b_logo->CurrentValue = HtmlDecode($this->b_logo->CurrentValue);
		$this->b_logo->EditValue = $this->b_logo->CurrentValue;
		$this->b_logo->PlaceHolder = RemoveHtml($this->b_logo->caption());

		// b_no_of_emp
		$this->b_no_of_emp->EditAttrs["class"] = "form-control";
		$this->b_no_of_emp->EditCustomAttributes = "";
		$this->b_no_of_emp->EditValue = $this->b_no_of_emp->CurrentValue;
		$this->b_no_of_emp->PlaceHolder = RemoveHtml($this->b_no_of_emp->caption());

		// b_since
		$this->b_since->EditAttrs["class"] = "form-control";
		$this->b_since->EditCustomAttributes = "";
		if (!$this->b_since->Raw)
			$this->b_since->CurrentValue = HtmlDecode($this->b_since->CurrentValue);
		$this->b_since->EditValue = $this->b_since->CurrentValue;
		$this->b_since->PlaceHolder = RemoveHtml($this->b_since->caption());

		// b_no_of_branches
		$this->b_no_of_branches->EditAttrs["class"] = "form-control";
		$this->b_no_of_branches->EditCustomAttributes = "";
		$this->b_no_of_branches->EditValue = $this->b_no_of_branches->CurrentValue;
		$this->b_no_of_branches->PlaceHolder = RemoveHtml($this->b_no_of_branches->caption());

		// b_deal_with_referral
		$this->b_deal_with_referral->EditAttrs["class"] = "form-control";
		$this->b_deal_with_referral->EditCustomAttributes = "";
		if (!$this->b_deal_with_referral->Raw)
			$this->b_deal_with_referral->CurrentValue = HtmlDecode($this->b_deal_with_referral->CurrentValue);
		$this->b_deal_with_referral->EditValue = $this->b_deal_with_referral->CurrentValue;
		$this->b_deal_with_referral->PlaceHolder = RemoveHtml($this->b_deal_with_referral->caption());

		// b_comments
		$this->b_comments->EditAttrs["class"] = "form-control";
		$this->b_comments->EditCustomAttributes = "";
		if (!$this->b_comments->Raw)
			$this->b_comments->CurrentValue = HtmlDecode($this->b_comments->CurrentValue);
		$this->b_comments->EditValue = $this->b_comments->CurrentValue;
		$this->b_comments->PlaceHolder = RemoveHtml($this->b_comments->caption());

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
					$doc->exportCaption($this->b_id);
					$doc->exportCaption($this->b_branch_id);
					$doc->exportCaption($this->b_b_type_id);
					$doc->exportCaption($this->b_b_status_id);
					$doc->exportCaption($this->b_b_nature_id);
					$doc->exportCaption($this->b_city_id);
					$doc->exportCaption($this->b_referral_id);
					$doc->exportCaption($this->b_name);
					$doc->exportCaption($this->b_owner);
					$doc->exportCaption($this->b_contact);
					$doc->exportCaption($this->b_address);
					$doc->exportCaption($this->b_email);
					$doc->exportCaption($this->b_ntn);
					$doc->exportCaption($this->b_logo);
					$doc->exportCaption($this->b_no_of_emp);
					$doc->exportCaption($this->b_since);
					$doc->exportCaption($this->b_no_of_branches);
					$doc->exportCaption($this->b_deal_with_referral);
					$doc->exportCaption($this->b_comments);
				} else {
					$doc->exportCaption($this->b_id);
					$doc->exportCaption($this->b_branch_id);
					$doc->exportCaption($this->b_b_type_id);
					$doc->exportCaption($this->b_b_status_id);
					$doc->exportCaption($this->b_b_nature_id);
					$doc->exportCaption($this->b_city_id);
					$doc->exportCaption($this->b_referral_id);
					$doc->exportCaption($this->b_name);
					$doc->exportCaption($this->b_owner);
					$doc->exportCaption($this->b_contact);
					$doc->exportCaption($this->b_address);
					$doc->exportCaption($this->b_email);
					$doc->exportCaption($this->b_ntn);
					$doc->exportCaption($this->b_logo);
					$doc->exportCaption($this->b_no_of_emp);
					$doc->exportCaption($this->b_since);
					$doc->exportCaption($this->b_no_of_branches);
					$doc->exportCaption($this->b_deal_with_referral);
					$doc->exportCaption($this->b_comments);
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
						$doc->exportField($this->b_id);
						$doc->exportField($this->b_branch_id);
						$doc->exportField($this->b_b_type_id);
						$doc->exportField($this->b_b_status_id);
						$doc->exportField($this->b_b_nature_id);
						$doc->exportField($this->b_city_id);
						$doc->exportField($this->b_referral_id);
						$doc->exportField($this->b_name);
						$doc->exportField($this->b_owner);
						$doc->exportField($this->b_contact);
						$doc->exportField($this->b_address);
						$doc->exportField($this->b_email);
						$doc->exportField($this->b_ntn);
						$doc->exportField($this->b_logo);
						$doc->exportField($this->b_no_of_emp);
						$doc->exportField($this->b_since);
						$doc->exportField($this->b_no_of_branches);
						$doc->exportField($this->b_deal_with_referral);
						$doc->exportField($this->b_comments);
					} else {
						$doc->exportField($this->b_id);
						$doc->exportField($this->b_branch_id);
						$doc->exportField($this->b_b_type_id);
						$doc->exportField($this->b_b_status_id);
						$doc->exportField($this->b_b_nature_id);
						$doc->exportField($this->b_city_id);
						$doc->exportField($this->b_referral_id);
						$doc->exportField($this->b_name);
						$doc->exportField($this->b_owner);
						$doc->exportField($this->b_contact);
						$doc->exportField($this->b_address);
						$doc->exportField($this->b_email);
						$doc->exportField($this->b_ntn);
						$doc->exportField($this->b_logo);
						$doc->exportField($this->b_no_of_emp);
						$doc->exportField($this->b_since);
						$doc->exportField($this->b_no_of_branches);
						$doc->exportField($this->b_deal_with_referral);
						$doc->exportField($this->b_comments);
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