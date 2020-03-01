<?php namespace PHPMaker2020\crm_live; ?>
<?php

/**
 * Table class for referral
 */
class referral extends DbTable
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
	public $referral_id;
	public $referral_branch_id;
	public $referral_name;
	public $referral_desc;
	public $referral_deal_signed;
	public $referral_scanned;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'referral';
		$this->TableName = 'referral';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`referral`";
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

		// referral_id
		$this->referral_id = new DbField('referral', 'referral', 'x_referral_id', 'referral_id', '`referral_id`', '`referral_id`', 3, 12, -1, FALSE, '`referral_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->referral_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->referral_id->IsPrimaryKey = TRUE; // Primary key field
		$this->referral_id->Sortable = TRUE; // Allow sort
		$this->referral_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['referral_id'] = &$this->referral_id;

		// referral_branch_id
		$this->referral_branch_id = new DbField('referral', 'referral', 'x_referral_branch_id', 'referral_branch_id', '`referral_branch_id`', '`referral_branch_id`', 3, 12, -1, FALSE, '`EV__referral_branch_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->referral_branch_id->Nullable = FALSE; // NOT NULL field
		$this->referral_branch_id->Required = TRUE; // Required field
		$this->referral_branch_id->Sortable = TRUE; // Allow sort
		$this->referral_branch_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->referral_branch_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->referral_branch_id->Lookup = new Lookup('referral_branch_id', 'branch', FALSE, 'branch_id', ["branch_name","","",""], [], [], [], [], [], [], '', '');
		$this->referral_branch_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['referral_branch_id'] = &$this->referral_branch_id;

		// referral_name
		$this->referral_name = new DbField('referral', 'referral', 'x_referral_name', 'referral_name', '`referral_name`', '`referral_name`', 200, 50, -1, FALSE, '`referral_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->referral_name->Nullable = FALSE; // NOT NULL field
		$this->referral_name->Required = TRUE; // Required field
		$this->referral_name->Sortable = TRUE; // Allow sort
		$this->fields['referral_name'] = &$this->referral_name;

		// referral_desc
		$this->referral_desc = new DbField('referral', 'referral', 'x_referral_desc', 'referral_desc', '`referral_desc`', '`referral_desc`', 200, 200, -1, FALSE, '`referral_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->referral_desc->Nullable = FALSE; // NOT NULL field
		$this->referral_desc->Required = TRUE; // Required field
		$this->referral_desc->Sortable = TRUE; // Allow sort
		$this->fields['referral_desc'] = &$this->referral_desc;

		// referral_deal_signed
		$this->referral_deal_signed = new DbField('referral', 'referral', 'x_referral_deal_signed', 'referral_deal_signed', '`referral_deal_signed`', '`referral_deal_signed`', 201, 1000, -1, FALSE, '`referral_deal_signed`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->referral_deal_signed->Nullable = FALSE; // NOT NULL field
		$this->referral_deal_signed->Required = TRUE; // Required field
		$this->referral_deal_signed->Sortable = TRUE; // Allow sort
		$this->fields['referral_deal_signed'] = &$this->referral_deal_signed;

		// referral_scanned
		$this->referral_scanned = new DbField('referral', 'referral', 'x_referral_scanned', 'referral_scanned', '`referral_scanned`', '`referral_scanned`', 201, 500, -1, TRUE, '`referral_scanned`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->referral_scanned->Nullable = FALSE; // NOT NULL field
		$this->referral_scanned->Required = TRUE; // Required field
		$this->referral_scanned->Sortable = TRUE; // Allow sort
		$this->referral_scanned->ImageResize = TRUE;
		$this->fields['referral_scanned'] = &$this->referral_scanned;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`referral`";
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
			"SELECT *, (SELECT `branch_name` FROM `branch` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`branch_id` = `referral`.`referral_branch_id` LIMIT 1) AS `EV__referral_branch_id` FROM `referral`" .
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
		if ($this->referral_branch_id->AdvancedSearch->SearchValue != "" ||
			$this->referral_branch_id->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->referral_branch_id->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->referral_branch_id->VirtualExpression . " "))
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
			$this->referral_id->setDbValue($conn->insert_ID());
			$rs['referral_id'] = $this->referral_id->DbValue;
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
			if (array_key_exists('referral_id', $rs))
				AddFilter($where, QuotedName('referral_id', $this->Dbid) . '=' . QuotedValue($rs['referral_id'], $this->referral_id->DataType, $this->Dbid));
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
		$this->referral_id->DbValue = $row['referral_id'];
		$this->referral_branch_id->DbValue = $row['referral_branch_id'];
		$this->referral_name->DbValue = $row['referral_name'];
		$this->referral_desc->DbValue = $row['referral_desc'];
		$this->referral_deal_signed->DbValue = $row['referral_deal_signed'];
		$this->referral_scanned->Upload->DbValue = $row['referral_scanned'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['referral_scanned']) ? [] : [$row['referral_scanned']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->referral_scanned->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->referral_scanned->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`referral_id` = @referral_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('referral_id', $row) ? $row['referral_id'] : NULL;
		else
			$val = $this->referral_id->OldValue !== NULL ? $this->referral_id->OldValue : $this->referral_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@referral_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "referrallist.php";
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
		if ($pageName == "referralview.php")
			return $Language->phrase("View");
		elseif ($pageName == "referraledit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "referraladd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "referrallist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("referralview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("referralview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "referraladd.php?" . $this->getUrlParm($parm);
		else
			$url = "referraladd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("referraledit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("referraladd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("referraldelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "referral_id:" . JsonEncode($this->referral_id->CurrentValue, "number");
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
		if ($this->referral_id->CurrentValue != NULL) {
			$url .= "referral_id=" . urlencode($this->referral_id->CurrentValue);
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
			if (Param("referral_id") !== NULL)
				$arKeys[] = Param("referral_id");
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
				$this->referral_id->CurrentValue = $key;
			else
				$this->referral_id->OldValue = $key;
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
		$this->referral_id->setDbValue($rs->fields('referral_id'));
		$this->referral_branch_id->setDbValue($rs->fields('referral_branch_id'));
		$this->referral_name->setDbValue($rs->fields('referral_name'));
		$this->referral_desc->setDbValue($rs->fields('referral_desc'));
		$this->referral_deal_signed->setDbValue($rs->fields('referral_deal_signed'));
		$this->referral_scanned->Upload->DbValue = $rs->fields('referral_scanned');
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// referral_id
		// referral_branch_id
		// referral_name
		// referral_desc
		// referral_deal_signed
		// referral_scanned
		// referral_id

		$this->referral_id->ViewValue = $this->referral_id->CurrentValue;
		$this->referral_id->CssClass = "font-weight-bold";
		$this->referral_id->ViewCustomAttributes = "";

		// referral_branch_id
		if ($this->referral_branch_id->VirtualValue != "") {
			$this->referral_branch_id->ViewValue = $this->referral_branch_id->VirtualValue;
		} else {
			$curVal = strval($this->referral_branch_id->CurrentValue);
			if ($curVal != "") {
				$this->referral_branch_id->ViewValue = $this->referral_branch_id->lookupCacheOption($curVal);
				if ($this->referral_branch_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`branch_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->referral_branch_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->referral_branch_id->ViewValue = $this->referral_branch_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->referral_branch_id->ViewValue = $this->referral_branch_id->CurrentValue;
					}
				}
			} else {
				$this->referral_branch_id->ViewValue = NULL;
			}
		}
		$this->referral_branch_id->ViewCustomAttributes = "";

		// referral_name
		$this->referral_name->ViewValue = $this->referral_name->CurrentValue;
		$this->referral_name->ViewCustomAttributes = "";

		// referral_desc
		$this->referral_desc->ViewValue = $this->referral_desc->CurrentValue;
		$this->referral_desc->ViewCustomAttributes = "";

		// referral_deal_signed
		$this->referral_deal_signed->ViewValue = $this->referral_deal_signed->CurrentValue;
		$this->referral_deal_signed->ViewCustomAttributes = "";

		// referral_scanned
		if (!EmptyValue($this->referral_scanned->Upload->DbValue)) {
			$this->referral_scanned->ImageWidth = 200;
			$this->referral_scanned->ImageHeight = 0;
			$this->referral_scanned->ImageAlt = $this->referral_scanned->alt();
			$this->referral_scanned->ViewValue = $this->referral_scanned->Upload->DbValue;
		} else {
			$this->referral_scanned->ViewValue = "";
		}
		$this->referral_scanned->ViewCustomAttributes = "";

		// referral_id
		$this->referral_id->LinkCustomAttributes = "";
		$this->referral_id->HrefValue = "";
		$this->referral_id->TooltipValue = "";

		// referral_branch_id
		$this->referral_branch_id->LinkCustomAttributes = "";
		$this->referral_branch_id->HrefValue = "";
		$this->referral_branch_id->TooltipValue = "";

		// referral_name
		$this->referral_name->LinkCustomAttributes = "";
		$this->referral_name->HrefValue = "";
		$this->referral_name->TooltipValue = "";

		// referral_desc
		$this->referral_desc->LinkCustomAttributes = "";
		$this->referral_desc->HrefValue = "";
		$this->referral_desc->TooltipValue = "";

		// referral_deal_signed
		$this->referral_deal_signed->LinkCustomAttributes = "";
		$this->referral_deal_signed->HrefValue = "";
		$this->referral_deal_signed->TooltipValue = "";

		// referral_scanned
		$this->referral_scanned->LinkCustomAttributes = "";
		if (!EmptyValue($this->referral_scanned->Upload->DbValue)) {
			$this->referral_scanned->HrefValue = GetFileUploadUrl($this->referral_scanned, $this->referral_scanned->htmlDecode($this->referral_scanned->Upload->DbValue)); // Add prefix/suffix
			$this->referral_scanned->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport())
				$this->referral_scanned->HrefValue = FullUrl($this->referral_scanned->HrefValue, "href");
		} else {
			$this->referral_scanned->HrefValue = "";
		}
		$this->referral_scanned->ExportHrefValue = $this->referral_scanned->UploadPath . $this->referral_scanned->Upload->DbValue;
		$this->referral_scanned->TooltipValue = "";
		if ($this->referral_scanned->UseColorbox) {
			if (EmptyValue($this->referral_scanned->TooltipValue))
				$this->referral_scanned->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
			$this->referral_scanned->LinkAttrs["data-rel"] = "referral_x_referral_scanned";
			$this->referral_scanned->LinkAttrs->appendClass("ew-lightbox");
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

		// referral_id
		$this->referral_id->EditAttrs["class"] = "form-control";
		$this->referral_id->EditCustomAttributes = "";
		$this->referral_id->EditValue = $this->referral_id->CurrentValue;
		$this->referral_id->CssClass = "font-weight-bold";
		$this->referral_id->ViewCustomAttributes = "";

		// referral_branch_id
		$this->referral_branch_id->EditCustomAttributes = "";

		// referral_name
		$this->referral_name->EditAttrs["class"] = "form-control";
		$this->referral_name->EditCustomAttributes = "";
		if (!$this->referral_name->Raw)
			$this->referral_name->CurrentValue = HtmlDecode($this->referral_name->CurrentValue);
		$this->referral_name->EditValue = $this->referral_name->CurrentValue;
		$this->referral_name->PlaceHolder = RemoveHtml($this->referral_name->caption());

		// referral_desc
		$this->referral_desc->EditAttrs["class"] = "form-control";
		$this->referral_desc->EditCustomAttributes = "";
		if (!$this->referral_desc->Raw)
			$this->referral_desc->CurrentValue = HtmlDecode($this->referral_desc->CurrentValue);
		$this->referral_desc->EditValue = $this->referral_desc->CurrentValue;
		$this->referral_desc->PlaceHolder = RemoveHtml($this->referral_desc->caption());

		// referral_deal_signed
		$this->referral_deal_signed->EditAttrs["class"] = "form-control";
		$this->referral_deal_signed->EditCustomAttributes = "";
		$this->referral_deal_signed->EditValue = $this->referral_deal_signed->CurrentValue;
		$this->referral_deal_signed->PlaceHolder = RemoveHtml($this->referral_deal_signed->caption());

		// referral_scanned
		$this->referral_scanned->EditAttrs["class"] = "form-control";
		$this->referral_scanned->EditCustomAttributes = "";
		if (!EmptyValue($this->referral_scanned->Upload->DbValue)) {
			$this->referral_scanned->ImageWidth = 200;
			$this->referral_scanned->ImageHeight = 0;
			$this->referral_scanned->ImageAlt = $this->referral_scanned->alt();
			$this->referral_scanned->EditValue = $this->referral_scanned->Upload->DbValue;
		} else {
			$this->referral_scanned->EditValue = "";
		}
		if (!EmptyValue($this->referral_scanned->CurrentValue))
				$this->referral_scanned->Upload->FileName = $this->referral_scanned->CurrentValue;

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
					$doc->exportCaption($this->referral_id);
					$doc->exportCaption($this->referral_branch_id);
					$doc->exportCaption($this->referral_name);
					$doc->exportCaption($this->referral_desc);
					$doc->exportCaption($this->referral_deal_signed);
					$doc->exportCaption($this->referral_scanned);
				} else {
					$doc->exportCaption($this->referral_id);
					$doc->exportCaption($this->referral_branch_id);
					$doc->exportCaption($this->referral_name);
					$doc->exportCaption($this->referral_desc);
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
						$doc->exportField($this->referral_id);
						$doc->exportField($this->referral_branch_id);
						$doc->exportField($this->referral_name);
						$doc->exportField($this->referral_desc);
						$doc->exportField($this->referral_deal_signed);
						$doc->exportField($this->referral_scanned);
					} else {
						$doc->exportField($this->referral_id);
						$doc->exportField($this->referral_branch_id);
						$doc->exportField($this->referral_name);
						$doc->exportField($this->referral_desc);
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
		if ($fldparm == 'referral_scanned') {
			$fldName = "referral_scanned";
			$fileNameFld = "referral_scanned";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->referral_id->CurrentValue = $ar[0];
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