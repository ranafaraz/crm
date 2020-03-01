<?php namespace PHPMaker2020\project1; ?>
<?php

/**
 * Table class for invoices
 */
class invoices extends DbTable
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
	public $invoice_id;
	public $invoice_branch_id;
	public $invoice_business_id;
	public $invoice_service_id;
	public $invoice_amount;
	public $invoice_issue_date;
	public $invoice_due_date;
	public $invoice_status;
	public $invoice_collected_amount;
	public $invoice_remaining_amount;
	public $invoice_collection_date;
	public $invoice_content;
	public $invoice_comments;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'invoices';
		$this->TableName = 'invoices';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`invoices`";
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

		// invoice_id
		$this->invoice_id = new DbField('invoices', 'invoices', 'x_invoice_id', 'invoice_id', '`invoice_id`', '`invoice_id`', 3, 12, -1, FALSE, '`invoice_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->invoice_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->invoice_id->IsPrimaryKey = TRUE; // Primary key field
		$this->invoice_id->Sortable = TRUE; // Allow sort
		$this->invoice_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['invoice_id'] = &$this->invoice_id;

		// invoice_branch_id
		$this->invoice_branch_id = new DbField('invoices', 'invoices', 'x_invoice_branch_id', 'invoice_branch_id', '`invoice_branch_id`', '`invoice_branch_id`', 3, 12, -1, FALSE, '`invoice_branch_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->invoice_branch_id->Nullable = FALSE; // NOT NULL field
		$this->invoice_branch_id->Required = TRUE; // Required field
		$this->invoice_branch_id->Sortable = TRUE; // Allow sort
		$this->invoice_branch_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['invoice_branch_id'] = &$this->invoice_branch_id;

		// invoice_business_id
		$this->invoice_business_id = new DbField('invoices', 'invoices', 'x_invoice_business_id', 'invoice_business_id', '`invoice_business_id`', '`invoice_business_id`', 3, 12, -1, FALSE, '`invoice_business_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->invoice_business_id->Nullable = FALSE; // NOT NULL field
		$this->invoice_business_id->Required = TRUE; // Required field
		$this->invoice_business_id->Sortable = TRUE; // Allow sort
		$this->invoice_business_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['invoice_business_id'] = &$this->invoice_business_id;

		// invoice_service_id
		$this->invoice_service_id = new DbField('invoices', 'invoices', 'x_invoice_service_id', 'invoice_service_id', '`invoice_service_id`', '`invoice_service_id`', 3, 12, -1, FALSE, '`invoice_service_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->invoice_service_id->Nullable = FALSE; // NOT NULL field
		$this->invoice_service_id->Required = TRUE; // Required field
		$this->invoice_service_id->Sortable = TRUE; // Allow sort
		$this->invoice_service_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['invoice_service_id'] = &$this->invoice_service_id;

		// invoice_amount
		$this->invoice_amount = new DbField('invoices', 'invoices', 'x_invoice_amount', 'invoice_amount', '`invoice_amount`', '`invoice_amount`', 3, 12, -1, FALSE, '`invoice_amount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->invoice_amount->Nullable = FALSE; // NOT NULL field
		$this->invoice_amount->Required = TRUE; // Required field
		$this->invoice_amount->Sortable = TRUE; // Allow sort
		$this->invoice_amount->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['invoice_amount'] = &$this->invoice_amount;

		// invoice_issue_date
		$this->invoice_issue_date = new DbField('invoices', 'invoices', 'x_invoice_issue_date', 'invoice_issue_date', '`invoice_issue_date`', CastDateFieldForLike("`invoice_issue_date`", 0, "DB"), 133, 10, 0, FALSE, '`invoice_issue_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->invoice_issue_date->Nullable = FALSE; // NOT NULL field
		$this->invoice_issue_date->Required = TRUE; // Required field
		$this->invoice_issue_date->Sortable = TRUE; // Allow sort
		$this->invoice_issue_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['invoice_issue_date'] = &$this->invoice_issue_date;

		// invoice_due_date
		$this->invoice_due_date = new DbField('invoices', 'invoices', 'x_invoice_due_date', 'invoice_due_date', '`invoice_due_date`', CastDateFieldForLike("`invoice_due_date`", 0, "DB"), 133, 10, 0, FALSE, '`invoice_due_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->invoice_due_date->Nullable = FALSE; // NOT NULL field
		$this->invoice_due_date->Required = TRUE; // Required field
		$this->invoice_due_date->Sortable = TRUE; // Allow sort
		$this->invoice_due_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['invoice_due_date'] = &$this->invoice_due_date;

		// invoice_status
		$this->invoice_status = new DbField('invoices', 'invoices', 'x_invoice_status', 'invoice_status', '`invoice_status`', '`invoice_status`', 202, 42, -1, FALSE, '`invoice_status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->invoice_status->Nullable = FALSE; // NOT NULL field
		$this->invoice_status->Required = TRUE; // Required field
		$this->invoice_status->Sortable = TRUE; // Allow sort
		$this->invoice_status->Lookup = new Lookup('invoice_status', 'invoices', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->invoice_status->OptionCount = 3;
		$this->fields['invoice_status'] = &$this->invoice_status;

		// invoice_collected_amount
		$this->invoice_collected_amount = new DbField('invoices', 'invoices', 'x_invoice_collected_amount', 'invoice_collected_amount', '`invoice_collected_amount`', '`invoice_collected_amount`', 3, 12, -1, FALSE, '`invoice_collected_amount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->invoice_collected_amount->Nullable = FALSE; // NOT NULL field
		$this->invoice_collected_amount->Required = TRUE; // Required field
		$this->invoice_collected_amount->Sortable = TRUE; // Allow sort
		$this->invoice_collected_amount->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['invoice_collected_amount'] = &$this->invoice_collected_amount;

		// invoice_remaining_amount
		$this->invoice_remaining_amount = new DbField('invoices', 'invoices', 'x_invoice_remaining_amount', 'invoice_remaining_amount', '`invoice_remaining_amount`', '`invoice_remaining_amount`', 3, 12, -1, FALSE, '`invoice_remaining_amount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->invoice_remaining_amount->Nullable = FALSE; // NOT NULL field
		$this->invoice_remaining_amount->Required = TRUE; // Required field
		$this->invoice_remaining_amount->Sortable = TRUE; // Allow sort
		$this->invoice_remaining_amount->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['invoice_remaining_amount'] = &$this->invoice_remaining_amount;

		// invoice_collection_date
		$this->invoice_collection_date = new DbField('invoices', 'invoices', 'x_invoice_collection_date', 'invoice_collection_date', '`invoice_collection_date`', CastDateFieldForLike("`invoice_collection_date`", 0, "DB"), 133, 10, 0, FALSE, '`invoice_collection_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->invoice_collection_date->Nullable = FALSE; // NOT NULL field
		$this->invoice_collection_date->Required = TRUE; // Required field
		$this->invoice_collection_date->Sortable = TRUE; // Allow sort
		$this->invoice_collection_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['invoice_collection_date'] = &$this->invoice_collection_date;

		// invoice_content
		$this->invoice_content = new DbField('invoices', 'invoices', 'x_invoice_content', 'invoice_content', '`invoice_content`', '`invoice_content`', 201, 1000, -1, FALSE, '`invoice_content`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->invoice_content->Nullable = FALSE; // NOT NULL field
		$this->invoice_content->Required = TRUE; // Required field
		$this->invoice_content->Sortable = TRUE; // Allow sort
		$this->fields['invoice_content'] = &$this->invoice_content;

		// invoice_comments
		$this->invoice_comments = new DbField('invoices', 'invoices', 'x_invoice_comments', 'invoice_comments', '`invoice_comments`', '`invoice_comments`', 201, 1000, -1, FALSE, '`invoice_comments`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->invoice_comments->Nullable = FALSE; // NOT NULL field
		$this->invoice_comments->Required = TRUE; // Required field
		$this->invoice_comments->Sortable = TRUE; // Allow sort
		$this->fields['invoice_comments'] = &$this->invoice_comments;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`invoices`";
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
			$this->invoice_id->setDbValue($conn->insert_ID());
			$rs['invoice_id'] = $this->invoice_id->DbValue;
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
			if (array_key_exists('invoice_id', $rs))
				AddFilter($where, QuotedName('invoice_id', $this->Dbid) . '=' . QuotedValue($rs['invoice_id'], $this->invoice_id->DataType, $this->Dbid));
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
		$this->invoice_id->DbValue = $row['invoice_id'];
		$this->invoice_branch_id->DbValue = $row['invoice_branch_id'];
		$this->invoice_business_id->DbValue = $row['invoice_business_id'];
		$this->invoice_service_id->DbValue = $row['invoice_service_id'];
		$this->invoice_amount->DbValue = $row['invoice_amount'];
		$this->invoice_issue_date->DbValue = $row['invoice_issue_date'];
		$this->invoice_due_date->DbValue = $row['invoice_due_date'];
		$this->invoice_status->DbValue = $row['invoice_status'];
		$this->invoice_collected_amount->DbValue = $row['invoice_collected_amount'];
		$this->invoice_remaining_amount->DbValue = $row['invoice_remaining_amount'];
		$this->invoice_collection_date->DbValue = $row['invoice_collection_date'];
		$this->invoice_content->DbValue = $row['invoice_content'];
		$this->invoice_comments->DbValue = $row['invoice_comments'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`invoice_id` = @invoice_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('invoice_id', $row) ? $row['invoice_id'] : NULL;
		else
			$val = $this->invoice_id->OldValue !== NULL ? $this->invoice_id->OldValue : $this->invoice_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@invoice_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "invoiceslist.php";
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
		if ($pageName == "invoicesview.php")
			return $Language->phrase("View");
		elseif ($pageName == "invoicesedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "invoicesadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "invoiceslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("invoicesview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("invoicesview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "invoicesadd.php?" . $this->getUrlParm($parm);
		else
			$url = "invoicesadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("invoicesedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("invoicesadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("invoicesdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "invoice_id:" . JsonEncode($this->invoice_id->CurrentValue, "number");
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
		if ($this->invoice_id->CurrentValue != NULL) {
			$url .= "invoice_id=" . urlencode($this->invoice_id->CurrentValue);
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
			if (Param("invoice_id") !== NULL)
				$arKeys[] = Param("invoice_id");
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
				$this->invoice_id->CurrentValue = $key;
			else
				$this->invoice_id->OldValue = $key;
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
		$this->invoice_id->setDbValue($rs->fields('invoice_id'));
		$this->invoice_branch_id->setDbValue($rs->fields('invoice_branch_id'));
		$this->invoice_business_id->setDbValue($rs->fields('invoice_business_id'));
		$this->invoice_service_id->setDbValue($rs->fields('invoice_service_id'));
		$this->invoice_amount->setDbValue($rs->fields('invoice_amount'));
		$this->invoice_issue_date->setDbValue($rs->fields('invoice_issue_date'));
		$this->invoice_due_date->setDbValue($rs->fields('invoice_due_date'));
		$this->invoice_status->setDbValue($rs->fields('invoice_status'));
		$this->invoice_collected_amount->setDbValue($rs->fields('invoice_collected_amount'));
		$this->invoice_remaining_amount->setDbValue($rs->fields('invoice_remaining_amount'));
		$this->invoice_collection_date->setDbValue($rs->fields('invoice_collection_date'));
		$this->invoice_content->setDbValue($rs->fields('invoice_content'));
		$this->invoice_comments->setDbValue($rs->fields('invoice_comments'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// invoice_id
		// invoice_branch_id
		// invoice_business_id
		// invoice_service_id
		// invoice_amount
		// invoice_issue_date
		// invoice_due_date
		// invoice_status
		// invoice_collected_amount
		// invoice_remaining_amount
		// invoice_collection_date
		// invoice_content
		// invoice_comments
		// invoice_id

		$this->invoice_id->ViewValue = $this->invoice_id->CurrentValue;
		$this->invoice_id->ViewCustomAttributes = "";

		// invoice_branch_id
		$this->invoice_branch_id->ViewValue = $this->invoice_branch_id->CurrentValue;
		$this->invoice_branch_id->ViewValue = FormatNumber($this->invoice_branch_id->ViewValue, 0, -2, -2, -2);
		$this->invoice_branch_id->ViewCustomAttributes = "";

		// invoice_business_id
		$this->invoice_business_id->ViewValue = $this->invoice_business_id->CurrentValue;
		$this->invoice_business_id->ViewValue = FormatNumber($this->invoice_business_id->ViewValue, 0, -2, -2, -2);
		$this->invoice_business_id->ViewCustomAttributes = "";

		// invoice_service_id
		$this->invoice_service_id->ViewValue = $this->invoice_service_id->CurrentValue;
		$this->invoice_service_id->ViewValue = FormatNumber($this->invoice_service_id->ViewValue, 0, -2, -2, -2);
		$this->invoice_service_id->ViewCustomAttributes = "";

		// invoice_amount
		$this->invoice_amount->ViewValue = $this->invoice_amount->CurrentValue;
		$this->invoice_amount->ViewValue = FormatNumber($this->invoice_amount->ViewValue, 0, -2, -2, -2);
		$this->invoice_amount->ViewCustomAttributes = "";

		// invoice_issue_date
		$this->invoice_issue_date->ViewValue = $this->invoice_issue_date->CurrentValue;
		$this->invoice_issue_date->ViewValue = FormatDateTime($this->invoice_issue_date->ViewValue, 0);
		$this->invoice_issue_date->ViewCustomAttributes = "";

		// invoice_due_date
		$this->invoice_due_date->ViewValue = $this->invoice_due_date->CurrentValue;
		$this->invoice_due_date->ViewValue = FormatDateTime($this->invoice_due_date->ViewValue, 0);
		$this->invoice_due_date->ViewCustomAttributes = "";

		// invoice_status
		if (strval($this->invoice_status->CurrentValue) != "") {
			$this->invoice_status->ViewValue = $this->invoice_status->optionCaption($this->invoice_status->CurrentValue);
		} else {
			$this->invoice_status->ViewValue = NULL;
		}
		$this->invoice_status->ViewCustomAttributes = "";

		// invoice_collected_amount
		$this->invoice_collected_amount->ViewValue = $this->invoice_collected_amount->CurrentValue;
		$this->invoice_collected_amount->ViewValue = FormatNumber($this->invoice_collected_amount->ViewValue, 0, -2, -2, -2);
		$this->invoice_collected_amount->ViewCustomAttributes = "";

		// invoice_remaining_amount
		$this->invoice_remaining_amount->ViewValue = $this->invoice_remaining_amount->CurrentValue;
		$this->invoice_remaining_amount->ViewValue = FormatNumber($this->invoice_remaining_amount->ViewValue, 0, -2, -2, -2);
		$this->invoice_remaining_amount->ViewCustomAttributes = "";

		// invoice_collection_date
		$this->invoice_collection_date->ViewValue = $this->invoice_collection_date->CurrentValue;
		$this->invoice_collection_date->ViewValue = FormatDateTime($this->invoice_collection_date->ViewValue, 0);
		$this->invoice_collection_date->ViewCustomAttributes = "";

		// invoice_content
		$this->invoice_content->ViewValue = $this->invoice_content->CurrentValue;
		$this->invoice_content->ViewCustomAttributes = "";

		// invoice_comments
		$this->invoice_comments->ViewValue = $this->invoice_comments->CurrentValue;
		$this->invoice_comments->ViewCustomAttributes = "";

		// invoice_id
		$this->invoice_id->LinkCustomAttributes = "";
		$this->invoice_id->HrefValue = "";
		$this->invoice_id->TooltipValue = "";

		// invoice_branch_id
		$this->invoice_branch_id->LinkCustomAttributes = "";
		$this->invoice_branch_id->HrefValue = "";
		$this->invoice_branch_id->TooltipValue = "";

		// invoice_business_id
		$this->invoice_business_id->LinkCustomAttributes = "";
		$this->invoice_business_id->HrefValue = "";
		$this->invoice_business_id->TooltipValue = "";

		// invoice_service_id
		$this->invoice_service_id->LinkCustomAttributes = "";
		$this->invoice_service_id->HrefValue = "";
		$this->invoice_service_id->TooltipValue = "";

		// invoice_amount
		$this->invoice_amount->LinkCustomAttributes = "";
		$this->invoice_amount->HrefValue = "";
		$this->invoice_amount->TooltipValue = "";

		// invoice_issue_date
		$this->invoice_issue_date->LinkCustomAttributes = "";
		$this->invoice_issue_date->HrefValue = "";
		$this->invoice_issue_date->TooltipValue = "";

		// invoice_due_date
		$this->invoice_due_date->LinkCustomAttributes = "";
		$this->invoice_due_date->HrefValue = "";
		$this->invoice_due_date->TooltipValue = "";

		// invoice_status
		$this->invoice_status->LinkCustomAttributes = "";
		$this->invoice_status->HrefValue = "";
		$this->invoice_status->TooltipValue = "";

		// invoice_collected_amount
		$this->invoice_collected_amount->LinkCustomAttributes = "";
		$this->invoice_collected_amount->HrefValue = "";
		$this->invoice_collected_amount->TooltipValue = "";

		// invoice_remaining_amount
		$this->invoice_remaining_amount->LinkCustomAttributes = "";
		$this->invoice_remaining_amount->HrefValue = "";
		$this->invoice_remaining_amount->TooltipValue = "";

		// invoice_collection_date
		$this->invoice_collection_date->LinkCustomAttributes = "";
		$this->invoice_collection_date->HrefValue = "";
		$this->invoice_collection_date->TooltipValue = "";

		// invoice_content
		$this->invoice_content->LinkCustomAttributes = "";
		$this->invoice_content->HrefValue = "";
		$this->invoice_content->TooltipValue = "";

		// invoice_comments
		$this->invoice_comments->LinkCustomAttributes = "";
		$this->invoice_comments->HrefValue = "";
		$this->invoice_comments->TooltipValue = "";

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

		// invoice_id
		$this->invoice_id->EditAttrs["class"] = "form-control";
		$this->invoice_id->EditCustomAttributes = "";
		$this->invoice_id->EditValue = $this->invoice_id->CurrentValue;
		$this->invoice_id->ViewCustomAttributes = "";

		// invoice_branch_id
		$this->invoice_branch_id->EditAttrs["class"] = "form-control";
		$this->invoice_branch_id->EditCustomAttributes = "";
		$this->invoice_branch_id->EditValue = $this->invoice_branch_id->CurrentValue;
		$this->invoice_branch_id->PlaceHolder = RemoveHtml($this->invoice_branch_id->caption());

		// invoice_business_id
		$this->invoice_business_id->EditAttrs["class"] = "form-control";
		$this->invoice_business_id->EditCustomAttributes = "";
		$this->invoice_business_id->EditValue = $this->invoice_business_id->CurrentValue;
		$this->invoice_business_id->PlaceHolder = RemoveHtml($this->invoice_business_id->caption());

		// invoice_service_id
		$this->invoice_service_id->EditAttrs["class"] = "form-control";
		$this->invoice_service_id->EditCustomAttributes = "";
		$this->invoice_service_id->EditValue = $this->invoice_service_id->CurrentValue;
		$this->invoice_service_id->PlaceHolder = RemoveHtml($this->invoice_service_id->caption());

		// invoice_amount
		$this->invoice_amount->EditAttrs["class"] = "form-control";
		$this->invoice_amount->EditCustomAttributes = "";
		$this->invoice_amount->EditValue = $this->invoice_amount->CurrentValue;
		$this->invoice_amount->PlaceHolder = RemoveHtml($this->invoice_amount->caption());

		// invoice_issue_date
		$this->invoice_issue_date->EditAttrs["class"] = "form-control";
		$this->invoice_issue_date->EditCustomAttributes = "";
		$this->invoice_issue_date->EditValue = FormatDateTime($this->invoice_issue_date->CurrentValue, 8);
		$this->invoice_issue_date->PlaceHolder = RemoveHtml($this->invoice_issue_date->caption());

		// invoice_due_date
		$this->invoice_due_date->EditAttrs["class"] = "form-control";
		$this->invoice_due_date->EditCustomAttributes = "";
		$this->invoice_due_date->EditValue = FormatDateTime($this->invoice_due_date->CurrentValue, 8);
		$this->invoice_due_date->PlaceHolder = RemoveHtml($this->invoice_due_date->caption());

		// invoice_status
		$this->invoice_status->EditCustomAttributes = "";
		$this->invoice_status->EditValue = $this->invoice_status->options(FALSE);

		// invoice_collected_amount
		$this->invoice_collected_amount->EditAttrs["class"] = "form-control";
		$this->invoice_collected_amount->EditCustomAttributes = "";
		$this->invoice_collected_amount->EditValue = $this->invoice_collected_amount->CurrentValue;
		$this->invoice_collected_amount->PlaceHolder = RemoveHtml($this->invoice_collected_amount->caption());

		// invoice_remaining_amount
		$this->invoice_remaining_amount->EditAttrs["class"] = "form-control";
		$this->invoice_remaining_amount->EditCustomAttributes = "";
		$this->invoice_remaining_amount->EditValue = $this->invoice_remaining_amount->CurrentValue;
		$this->invoice_remaining_amount->PlaceHolder = RemoveHtml($this->invoice_remaining_amount->caption());

		// invoice_collection_date
		$this->invoice_collection_date->EditAttrs["class"] = "form-control";
		$this->invoice_collection_date->EditCustomAttributes = "";
		$this->invoice_collection_date->EditValue = FormatDateTime($this->invoice_collection_date->CurrentValue, 8);
		$this->invoice_collection_date->PlaceHolder = RemoveHtml($this->invoice_collection_date->caption());

		// invoice_content
		$this->invoice_content->EditAttrs["class"] = "form-control";
		$this->invoice_content->EditCustomAttributes = "";
		$this->invoice_content->EditValue = $this->invoice_content->CurrentValue;
		$this->invoice_content->PlaceHolder = RemoveHtml($this->invoice_content->caption());

		// invoice_comments
		$this->invoice_comments->EditAttrs["class"] = "form-control";
		$this->invoice_comments->EditCustomAttributes = "";
		$this->invoice_comments->EditValue = $this->invoice_comments->CurrentValue;
		$this->invoice_comments->PlaceHolder = RemoveHtml($this->invoice_comments->caption());

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
					$doc->exportCaption($this->invoice_id);
					$doc->exportCaption($this->invoice_branch_id);
					$doc->exportCaption($this->invoice_business_id);
					$doc->exportCaption($this->invoice_service_id);
					$doc->exportCaption($this->invoice_amount);
					$doc->exportCaption($this->invoice_issue_date);
					$doc->exportCaption($this->invoice_due_date);
					$doc->exportCaption($this->invoice_status);
					$doc->exportCaption($this->invoice_collected_amount);
					$doc->exportCaption($this->invoice_remaining_amount);
					$doc->exportCaption($this->invoice_collection_date);
					$doc->exportCaption($this->invoice_content);
					$doc->exportCaption($this->invoice_comments);
				} else {
					$doc->exportCaption($this->invoice_id);
					$doc->exportCaption($this->invoice_branch_id);
					$doc->exportCaption($this->invoice_business_id);
					$doc->exportCaption($this->invoice_service_id);
					$doc->exportCaption($this->invoice_amount);
					$doc->exportCaption($this->invoice_issue_date);
					$doc->exportCaption($this->invoice_due_date);
					$doc->exportCaption($this->invoice_status);
					$doc->exportCaption($this->invoice_collected_amount);
					$doc->exportCaption($this->invoice_remaining_amount);
					$doc->exportCaption($this->invoice_collection_date);
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
						$doc->exportField($this->invoice_id);
						$doc->exportField($this->invoice_branch_id);
						$doc->exportField($this->invoice_business_id);
						$doc->exportField($this->invoice_service_id);
						$doc->exportField($this->invoice_amount);
						$doc->exportField($this->invoice_issue_date);
						$doc->exportField($this->invoice_due_date);
						$doc->exportField($this->invoice_status);
						$doc->exportField($this->invoice_collected_amount);
						$doc->exportField($this->invoice_remaining_amount);
						$doc->exportField($this->invoice_collection_date);
						$doc->exportField($this->invoice_content);
						$doc->exportField($this->invoice_comments);
					} else {
						$doc->exportField($this->invoice_id);
						$doc->exportField($this->invoice_branch_id);
						$doc->exportField($this->invoice_business_id);
						$doc->exportField($this->invoice_service_id);
						$doc->exportField($this->invoice_amount);
						$doc->exportField($this->invoice_issue_date);
						$doc->exportField($this->invoice_due_date);
						$doc->exportField($this->invoice_status);
						$doc->exportField($this->invoice_collected_amount);
						$doc->exportField($this->invoice_remaining_amount);
						$doc->exportField($this->invoice_collection_date);
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