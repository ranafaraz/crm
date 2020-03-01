<?php namespace PHPMaker2020\project1; ?>
<?php

/**
 * Table class for services_availed_by_customer
 */
class services_availed_by_customer extends DbTable
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
	public $sabc_id;
	public $sabc_branch_id;
	public $sabc_business_id;
	public $sabc_service_id;
	public $sabc_pkg;
	public $sabc_amount;
	public $sabc_desc;
	public $sabc_signed_on;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'services_availed_by_customer';
		$this->TableName = 'services_availed_by_customer';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`services_availed_by_customer`";
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

		// sabc_id
		$this->sabc_id = new DbField('services_availed_by_customer', 'services_availed_by_customer', 'x_sabc_id', 'sabc_id', '`sabc_id`', '`sabc_id`', 3, 12, -1, FALSE, '`sabc_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->sabc_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->sabc_id->IsPrimaryKey = TRUE; // Primary key field
		$this->sabc_id->Sortable = TRUE; // Allow sort
		$this->sabc_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sabc_id'] = &$this->sabc_id;

		// sabc_branch_id
		$this->sabc_branch_id = new DbField('services_availed_by_customer', 'services_availed_by_customer', 'x_sabc_branch_id', 'sabc_branch_id', '`sabc_branch_id`', '`sabc_branch_id`', 3, 12, -1, FALSE, '`sabc_branch_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sabc_branch_id->Nullable = FALSE; // NOT NULL field
		$this->sabc_branch_id->Required = TRUE; // Required field
		$this->sabc_branch_id->Sortable = TRUE; // Allow sort
		$this->sabc_branch_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sabc_branch_id'] = &$this->sabc_branch_id;

		// sabc_business_id
		$this->sabc_business_id = new DbField('services_availed_by_customer', 'services_availed_by_customer', 'x_sabc_business_id', 'sabc_business_id', '`sabc_business_id`', '`sabc_business_id`', 3, 12, -1, FALSE, '`sabc_business_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sabc_business_id->Nullable = FALSE; // NOT NULL field
		$this->sabc_business_id->Required = TRUE; // Required field
		$this->sabc_business_id->Sortable = TRUE; // Allow sort
		$this->sabc_business_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sabc_business_id'] = &$this->sabc_business_id;

		// sabc_service_id
		$this->sabc_service_id = new DbField('services_availed_by_customer', 'services_availed_by_customer', 'x_sabc_service_id', 'sabc_service_id', '`sabc_service_id`', '`sabc_service_id`', 3, 12, -1, FALSE, '`sabc_service_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sabc_service_id->Nullable = FALSE; // NOT NULL field
		$this->sabc_service_id->Required = TRUE; // Required field
		$this->sabc_service_id->Sortable = TRUE; // Allow sort
		$this->sabc_service_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sabc_service_id'] = &$this->sabc_service_id;

		// sabc_pkg
		$this->sabc_pkg = new DbField('services_availed_by_customer', 'services_availed_by_customer', 'x_sabc_pkg', 'sabc_pkg', '`sabc_pkg`', '`sabc_pkg`', 202, 36, -1, FALSE, '`sabc_pkg`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->sabc_pkg->Nullable = FALSE; // NOT NULL field
		$this->sabc_pkg->Required = TRUE; // Required field
		$this->sabc_pkg->Sortable = TRUE; // Allow sort
		$this->sabc_pkg->Lookup = new Lookup('sabc_pkg', 'services_availed_by_customer', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->sabc_pkg->OptionCount = 4;
		$this->fields['sabc_pkg'] = &$this->sabc_pkg;

		// sabc_amount
		$this->sabc_amount = new DbField('services_availed_by_customer', 'services_availed_by_customer', 'x_sabc_amount', 'sabc_amount', '`sabc_amount`', '`sabc_amount`', 3, 11, -1, FALSE, '`sabc_amount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sabc_amount->Nullable = FALSE; // NOT NULL field
		$this->sabc_amount->Required = TRUE; // Required field
		$this->sabc_amount->Sortable = TRUE; // Allow sort
		$this->sabc_amount->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sabc_amount'] = &$this->sabc_amount;

		// sabc_desc
		$this->sabc_desc = new DbField('services_availed_by_customer', 'services_availed_by_customer', 'x_sabc_desc', 'sabc_desc', '`sabc_desc`', '`sabc_desc`', 201, 1000, -1, FALSE, '`sabc_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->sabc_desc->Nullable = FALSE; // NOT NULL field
		$this->sabc_desc->Required = TRUE; // Required field
		$this->sabc_desc->Sortable = TRUE; // Allow sort
		$this->fields['sabc_desc'] = &$this->sabc_desc;

		// sabc_signed_on
		$this->sabc_signed_on = new DbField('services_availed_by_customer', 'services_availed_by_customer', 'x_sabc_signed_on', 'sabc_signed_on', '`sabc_signed_on`', CastDateFieldForLike("`sabc_signed_on`", 0, "DB"), 133, 10, 0, FALSE, '`sabc_signed_on`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sabc_signed_on->Nullable = FALSE; // NOT NULL field
		$this->sabc_signed_on->Required = TRUE; // Required field
		$this->sabc_signed_on->Sortable = TRUE; // Allow sort
		$this->sabc_signed_on->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['sabc_signed_on'] = &$this->sabc_signed_on;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`services_availed_by_customer`";
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
			$this->sabc_id->setDbValue($conn->insert_ID());
			$rs['sabc_id'] = $this->sabc_id->DbValue;
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
			if (array_key_exists('sabc_id', $rs))
				AddFilter($where, QuotedName('sabc_id', $this->Dbid) . '=' . QuotedValue($rs['sabc_id'], $this->sabc_id->DataType, $this->Dbid));
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
		$this->sabc_id->DbValue = $row['sabc_id'];
		$this->sabc_branch_id->DbValue = $row['sabc_branch_id'];
		$this->sabc_business_id->DbValue = $row['sabc_business_id'];
		$this->sabc_service_id->DbValue = $row['sabc_service_id'];
		$this->sabc_pkg->DbValue = $row['sabc_pkg'];
		$this->sabc_amount->DbValue = $row['sabc_amount'];
		$this->sabc_desc->DbValue = $row['sabc_desc'];
		$this->sabc_signed_on->DbValue = $row['sabc_signed_on'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`sabc_id` = @sabc_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('sabc_id', $row) ? $row['sabc_id'] : NULL;
		else
			$val = $this->sabc_id->OldValue !== NULL ? $this->sabc_id->OldValue : $this->sabc_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@sabc_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "services_availed_by_customerlist.php";
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
		if ($pageName == "services_availed_by_customerview.php")
			return $Language->phrase("View");
		elseif ($pageName == "services_availed_by_customeredit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "services_availed_by_customeradd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "services_availed_by_customerlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("services_availed_by_customerview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("services_availed_by_customerview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "services_availed_by_customeradd.php?" . $this->getUrlParm($parm);
		else
			$url = "services_availed_by_customeradd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("services_availed_by_customeredit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("services_availed_by_customeradd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("services_availed_by_customerdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "sabc_id:" . JsonEncode($this->sabc_id->CurrentValue, "number");
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
		if ($this->sabc_id->CurrentValue != NULL) {
			$url .= "sabc_id=" . urlencode($this->sabc_id->CurrentValue);
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
			if (Param("sabc_id") !== NULL)
				$arKeys[] = Param("sabc_id");
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
				$this->sabc_id->CurrentValue = $key;
			else
				$this->sabc_id->OldValue = $key;
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
		$this->sabc_id->setDbValue($rs->fields('sabc_id'));
		$this->sabc_branch_id->setDbValue($rs->fields('sabc_branch_id'));
		$this->sabc_business_id->setDbValue($rs->fields('sabc_business_id'));
		$this->sabc_service_id->setDbValue($rs->fields('sabc_service_id'));
		$this->sabc_pkg->setDbValue($rs->fields('sabc_pkg'));
		$this->sabc_amount->setDbValue($rs->fields('sabc_amount'));
		$this->sabc_desc->setDbValue($rs->fields('sabc_desc'));
		$this->sabc_signed_on->setDbValue($rs->fields('sabc_signed_on'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// sabc_id
		// sabc_branch_id
		// sabc_business_id
		// sabc_service_id
		// sabc_pkg
		// sabc_amount
		// sabc_desc
		// sabc_signed_on
		// sabc_id

		$this->sabc_id->ViewValue = $this->sabc_id->CurrentValue;
		$this->sabc_id->ViewCustomAttributes = "";

		// sabc_branch_id
		$this->sabc_branch_id->ViewValue = $this->sabc_branch_id->CurrentValue;
		$this->sabc_branch_id->ViewValue = FormatNumber($this->sabc_branch_id->ViewValue, 0, -2, -2, -2);
		$this->sabc_branch_id->ViewCustomAttributes = "";

		// sabc_business_id
		$this->sabc_business_id->ViewValue = $this->sabc_business_id->CurrentValue;
		$this->sabc_business_id->ViewValue = FormatNumber($this->sabc_business_id->ViewValue, 0, -2, -2, -2);
		$this->sabc_business_id->ViewCustomAttributes = "";

		// sabc_service_id
		$this->sabc_service_id->ViewValue = $this->sabc_service_id->CurrentValue;
		$this->sabc_service_id->ViewValue = FormatNumber($this->sabc_service_id->ViewValue, 0, -2, -2, -2);
		$this->sabc_service_id->ViewCustomAttributes = "";

		// sabc_pkg
		if (strval($this->sabc_pkg->CurrentValue) != "") {
			$this->sabc_pkg->ViewValue = $this->sabc_pkg->optionCaption($this->sabc_pkg->CurrentValue);
		} else {
			$this->sabc_pkg->ViewValue = NULL;
		}
		$this->sabc_pkg->ViewCustomAttributes = "";

		// sabc_amount
		$this->sabc_amount->ViewValue = $this->sabc_amount->CurrentValue;
		$this->sabc_amount->ViewValue = FormatNumber($this->sabc_amount->ViewValue, 0, -2, -2, -2);
		$this->sabc_amount->ViewCustomAttributes = "";

		// sabc_desc
		$this->sabc_desc->ViewValue = $this->sabc_desc->CurrentValue;
		$this->sabc_desc->ViewCustomAttributes = "";

		// sabc_signed_on
		$this->sabc_signed_on->ViewValue = $this->sabc_signed_on->CurrentValue;
		$this->sabc_signed_on->ViewValue = FormatDateTime($this->sabc_signed_on->ViewValue, 0);
		$this->sabc_signed_on->ViewCustomAttributes = "";

		// sabc_id
		$this->sabc_id->LinkCustomAttributes = "";
		$this->sabc_id->HrefValue = "";
		$this->sabc_id->TooltipValue = "";

		// sabc_branch_id
		$this->sabc_branch_id->LinkCustomAttributes = "";
		$this->sabc_branch_id->HrefValue = "";
		$this->sabc_branch_id->TooltipValue = "";

		// sabc_business_id
		$this->sabc_business_id->LinkCustomAttributes = "";
		$this->sabc_business_id->HrefValue = "";
		$this->sabc_business_id->TooltipValue = "";

		// sabc_service_id
		$this->sabc_service_id->LinkCustomAttributes = "";
		$this->sabc_service_id->HrefValue = "";
		$this->sabc_service_id->TooltipValue = "";

		// sabc_pkg
		$this->sabc_pkg->LinkCustomAttributes = "";
		$this->sabc_pkg->HrefValue = "";
		$this->sabc_pkg->TooltipValue = "";

		// sabc_amount
		$this->sabc_amount->LinkCustomAttributes = "";
		$this->sabc_amount->HrefValue = "";
		$this->sabc_amount->TooltipValue = "";

		// sabc_desc
		$this->sabc_desc->LinkCustomAttributes = "";
		$this->sabc_desc->HrefValue = "";
		$this->sabc_desc->TooltipValue = "";

		// sabc_signed_on
		$this->sabc_signed_on->LinkCustomAttributes = "";
		$this->sabc_signed_on->HrefValue = "";
		$this->sabc_signed_on->TooltipValue = "";

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

		// sabc_id
		$this->sabc_id->EditAttrs["class"] = "form-control";
		$this->sabc_id->EditCustomAttributes = "";
		$this->sabc_id->EditValue = $this->sabc_id->CurrentValue;
		$this->sabc_id->ViewCustomAttributes = "";

		// sabc_branch_id
		$this->sabc_branch_id->EditAttrs["class"] = "form-control";
		$this->sabc_branch_id->EditCustomAttributes = "";
		$this->sabc_branch_id->EditValue = $this->sabc_branch_id->CurrentValue;
		$this->sabc_branch_id->PlaceHolder = RemoveHtml($this->sabc_branch_id->caption());

		// sabc_business_id
		$this->sabc_business_id->EditAttrs["class"] = "form-control";
		$this->sabc_business_id->EditCustomAttributes = "";
		$this->sabc_business_id->EditValue = $this->sabc_business_id->CurrentValue;
		$this->sabc_business_id->PlaceHolder = RemoveHtml($this->sabc_business_id->caption());

		// sabc_service_id
		$this->sabc_service_id->EditAttrs["class"] = "form-control";
		$this->sabc_service_id->EditCustomAttributes = "";
		$this->sabc_service_id->EditValue = $this->sabc_service_id->CurrentValue;
		$this->sabc_service_id->PlaceHolder = RemoveHtml($this->sabc_service_id->caption());

		// sabc_pkg
		$this->sabc_pkg->EditCustomAttributes = "";
		$this->sabc_pkg->EditValue = $this->sabc_pkg->options(FALSE);

		// sabc_amount
		$this->sabc_amount->EditAttrs["class"] = "form-control";
		$this->sabc_amount->EditCustomAttributes = "";
		$this->sabc_amount->EditValue = $this->sabc_amount->CurrentValue;
		$this->sabc_amount->PlaceHolder = RemoveHtml($this->sabc_amount->caption());

		// sabc_desc
		$this->sabc_desc->EditAttrs["class"] = "form-control";
		$this->sabc_desc->EditCustomAttributes = "";
		$this->sabc_desc->EditValue = $this->sabc_desc->CurrentValue;
		$this->sabc_desc->PlaceHolder = RemoveHtml($this->sabc_desc->caption());

		// sabc_signed_on
		$this->sabc_signed_on->EditAttrs["class"] = "form-control";
		$this->sabc_signed_on->EditCustomAttributes = "";
		$this->sabc_signed_on->EditValue = FormatDateTime($this->sabc_signed_on->CurrentValue, 8);
		$this->sabc_signed_on->PlaceHolder = RemoveHtml($this->sabc_signed_on->caption());

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
					$doc->exportCaption($this->sabc_id);
					$doc->exportCaption($this->sabc_branch_id);
					$doc->exportCaption($this->sabc_business_id);
					$doc->exportCaption($this->sabc_service_id);
					$doc->exportCaption($this->sabc_pkg);
					$doc->exportCaption($this->sabc_amount);
					$doc->exportCaption($this->sabc_desc);
					$doc->exportCaption($this->sabc_signed_on);
				} else {
					$doc->exportCaption($this->sabc_id);
					$doc->exportCaption($this->sabc_branch_id);
					$doc->exportCaption($this->sabc_business_id);
					$doc->exportCaption($this->sabc_service_id);
					$doc->exportCaption($this->sabc_pkg);
					$doc->exportCaption($this->sabc_amount);
					$doc->exportCaption($this->sabc_signed_on);
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
						$doc->exportField($this->sabc_id);
						$doc->exportField($this->sabc_branch_id);
						$doc->exportField($this->sabc_business_id);
						$doc->exportField($this->sabc_service_id);
						$doc->exportField($this->sabc_pkg);
						$doc->exportField($this->sabc_amount);
						$doc->exportField($this->sabc_desc);
						$doc->exportField($this->sabc_signed_on);
					} else {
						$doc->exportField($this->sabc_id);
						$doc->exportField($this->sabc_branch_id);
						$doc->exportField($this->sabc_business_id);
						$doc->exportField($this->sabc_service_id);
						$doc->exportField($this->sabc_pkg);
						$doc->exportField($this->sabc_amount);
						$doc->exportField($this->sabc_signed_on);
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