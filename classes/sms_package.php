<?php namespace PHPMaker2020\project1; ?>
<?php

/**
 * Table class for sms_package
 */
class sms_package extends DbTable
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
	public $sms_pkg_id;
	public $sms_pkg_sms_api_id;
	public $sms_pkg_branch_id;
	public $sms_pkg_total_allowed_sms;
	public $sms_pkg_expiry_date;
	public $sms_pkg_per_sms_cost;
	public $sms_pkg_deal_details;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'sms_package';
		$this->TableName = 'sms_package';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`sms_package`";
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

		// sms_pkg_id
		$this->sms_pkg_id = new DbField('sms_package', 'sms_package', 'x_sms_pkg_id', 'sms_pkg_id', '`sms_pkg_id`', '`sms_pkg_id`', 3, 12, -1, FALSE, '`sms_pkg_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->sms_pkg_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->sms_pkg_id->IsPrimaryKey = TRUE; // Primary key field
		$this->sms_pkg_id->Sortable = TRUE; // Allow sort
		$this->sms_pkg_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sms_pkg_id'] = &$this->sms_pkg_id;

		// sms_pkg_sms_api_id
		$this->sms_pkg_sms_api_id = new DbField('sms_package', 'sms_package', 'x_sms_pkg_sms_api_id', 'sms_pkg_sms_api_id', '`sms_pkg_sms_api_id`', '`sms_pkg_sms_api_id`', 3, 12, -1, FALSE, '`sms_pkg_sms_api_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sms_pkg_sms_api_id->Nullable = FALSE; // NOT NULL field
		$this->sms_pkg_sms_api_id->Required = TRUE; // Required field
		$this->sms_pkg_sms_api_id->Sortable = TRUE; // Allow sort
		$this->sms_pkg_sms_api_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sms_pkg_sms_api_id'] = &$this->sms_pkg_sms_api_id;

		// sms_pkg_branch_id
		$this->sms_pkg_branch_id = new DbField('sms_package', 'sms_package', 'x_sms_pkg_branch_id', 'sms_pkg_branch_id', '`sms_pkg_branch_id`', '`sms_pkg_branch_id`', 3, 12, -1, FALSE, '`sms_pkg_branch_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sms_pkg_branch_id->Nullable = FALSE; // NOT NULL field
		$this->sms_pkg_branch_id->Required = TRUE; // Required field
		$this->sms_pkg_branch_id->Sortable = TRUE; // Allow sort
		$this->sms_pkg_branch_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sms_pkg_branch_id'] = &$this->sms_pkg_branch_id;

		// sms_pkg_total_allowed_sms
		$this->sms_pkg_total_allowed_sms = new DbField('sms_package', 'sms_package', 'x_sms_pkg_total_allowed_sms', 'sms_pkg_total_allowed_sms', '`sms_pkg_total_allowed_sms`', '`sms_pkg_total_allowed_sms`', 3, 10, -1, FALSE, '`sms_pkg_total_allowed_sms`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sms_pkg_total_allowed_sms->Nullable = FALSE; // NOT NULL field
		$this->sms_pkg_total_allowed_sms->Required = TRUE; // Required field
		$this->sms_pkg_total_allowed_sms->Sortable = TRUE; // Allow sort
		$this->sms_pkg_total_allowed_sms->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sms_pkg_total_allowed_sms'] = &$this->sms_pkg_total_allowed_sms;

		// sms_pkg_expiry_date
		$this->sms_pkg_expiry_date = new DbField('sms_package', 'sms_package', 'x_sms_pkg_expiry_date', 'sms_pkg_expiry_date', '`sms_pkg_expiry_date`', CastDateFieldForLike("`sms_pkg_expiry_date`", 0, "DB"), 133, 10, 0, FALSE, '`sms_pkg_expiry_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sms_pkg_expiry_date->Nullable = FALSE; // NOT NULL field
		$this->sms_pkg_expiry_date->Required = TRUE; // Required field
		$this->sms_pkg_expiry_date->Sortable = TRUE; // Allow sort
		$this->sms_pkg_expiry_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['sms_pkg_expiry_date'] = &$this->sms_pkg_expiry_date;

		// sms_pkg_per_sms_cost
		$this->sms_pkg_per_sms_cost = new DbField('sms_package', 'sms_package', 'x_sms_pkg_per_sms_cost', 'sms_pkg_per_sms_cost', '`sms_pkg_per_sms_cost`', '`sms_pkg_per_sms_cost`', 131, 11, -1, FALSE, '`sms_pkg_per_sms_cost`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sms_pkg_per_sms_cost->Nullable = FALSE; // NOT NULL field
		$this->sms_pkg_per_sms_cost->Required = TRUE; // Required field
		$this->sms_pkg_per_sms_cost->Sortable = TRUE; // Allow sort
		$this->sms_pkg_per_sms_cost->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['sms_pkg_per_sms_cost'] = &$this->sms_pkg_per_sms_cost;

		// sms_pkg_deal_details
		$this->sms_pkg_deal_details = new DbField('sms_package', 'sms_package', 'x_sms_pkg_deal_details', 'sms_pkg_deal_details', '`sms_pkg_deal_details`', '`sms_pkg_deal_details`', 201, 1000, -1, FALSE, '`sms_pkg_deal_details`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->sms_pkg_deal_details->Nullable = FALSE; // NOT NULL field
		$this->sms_pkg_deal_details->Required = TRUE; // Required field
		$this->sms_pkg_deal_details->Sortable = TRUE; // Allow sort
		$this->fields['sms_pkg_deal_details'] = &$this->sms_pkg_deal_details;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`sms_package`";
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
			$this->sms_pkg_id->setDbValue($conn->insert_ID());
			$rs['sms_pkg_id'] = $this->sms_pkg_id->DbValue;
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
			if (array_key_exists('sms_pkg_id', $rs))
				AddFilter($where, QuotedName('sms_pkg_id', $this->Dbid) . '=' . QuotedValue($rs['sms_pkg_id'], $this->sms_pkg_id->DataType, $this->Dbid));
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
		$this->sms_pkg_id->DbValue = $row['sms_pkg_id'];
		$this->sms_pkg_sms_api_id->DbValue = $row['sms_pkg_sms_api_id'];
		$this->sms_pkg_branch_id->DbValue = $row['sms_pkg_branch_id'];
		$this->sms_pkg_total_allowed_sms->DbValue = $row['sms_pkg_total_allowed_sms'];
		$this->sms_pkg_expiry_date->DbValue = $row['sms_pkg_expiry_date'];
		$this->sms_pkg_per_sms_cost->DbValue = $row['sms_pkg_per_sms_cost'];
		$this->sms_pkg_deal_details->DbValue = $row['sms_pkg_deal_details'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`sms_pkg_id` = @sms_pkg_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('sms_pkg_id', $row) ? $row['sms_pkg_id'] : NULL;
		else
			$val = $this->sms_pkg_id->OldValue !== NULL ? $this->sms_pkg_id->OldValue : $this->sms_pkg_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@sms_pkg_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "sms_packagelist.php";
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
		if ($pageName == "sms_packageview.php")
			return $Language->phrase("View");
		elseif ($pageName == "sms_packageedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "sms_packageadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "sms_packagelist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("sms_packageview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("sms_packageview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "sms_packageadd.php?" . $this->getUrlParm($parm);
		else
			$url = "sms_packageadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("sms_packageedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("sms_packageadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("sms_packagedelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "sms_pkg_id:" . JsonEncode($this->sms_pkg_id->CurrentValue, "number");
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
		if ($this->sms_pkg_id->CurrentValue != NULL) {
			$url .= "sms_pkg_id=" . urlencode($this->sms_pkg_id->CurrentValue);
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
			if (Param("sms_pkg_id") !== NULL)
				$arKeys[] = Param("sms_pkg_id");
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
				$this->sms_pkg_id->CurrentValue = $key;
			else
				$this->sms_pkg_id->OldValue = $key;
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
		$this->sms_pkg_id->setDbValue($rs->fields('sms_pkg_id'));
		$this->sms_pkg_sms_api_id->setDbValue($rs->fields('sms_pkg_sms_api_id'));
		$this->sms_pkg_branch_id->setDbValue($rs->fields('sms_pkg_branch_id'));
		$this->sms_pkg_total_allowed_sms->setDbValue($rs->fields('sms_pkg_total_allowed_sms'));
		$this->sms_pkg_expiry_date->setDbValue($rs->fields('sms_pkg_expiry_date'));
		$this->sms_pkg_per_sms_cost->setDbValue($rs->fields('sms_pkg_per_sms_cost'));
		$this->sms_pkg_deal_details->setDbValue($rs->fields('sms_pkg_deal_details'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// sms_pkg_id
		// sms_pkg_sms_api_id
		// sms_pkg_branch_id
		// sms_pkg_total_allowed_sms
		// sms_pkg_expiry_date
		// sms_pkg_per_sms_cost
		// sms_pkg_deal_details
		// sms_pkg_id

		$this->sms_pkg_id->ViewValue = $this->sms_pkg_id->CurrentValue;
		$this->sms_pkg_id->ViewCustomAttributes = "";

		// sms_pkg_sms_api_id
		$this->sms_pkg_sms_api_id->ViewValue = $this->sms_pkg_sms_api_id->CurrentValue;
		$this->sms_pkg_sms_api_id->ViewValue = FormatNumber($this->sms_pkg_sms_api_id->ViewValue, 0, -2, -2, -2);
		$this->sms_pkg_sms_api_id->ViewCustomAttributes = "";

		// sms_pkg_branch_id
		$this->sms_pkg_branch_id->ViewValue = $this->sms_pkg_branch_id->CurrentValue;
		$this->sms_pkg_branch_id->ViewValue = FormatNumber($this->sms_pkg_branch_id->ViewValue, 0, -2, -2, -2);
		$this->sms_pkg_branch_id->ViewCustomAttributes = "";

		// sms_pkg_total_allowed_sms
		$this->sms_pkg_total_allowed_sms->ViewValue = $this->sms_pkg_total_allowed_sms->CurrentValue;
		$this->sms_pkg_total_allowed_sms->ViewValue = FormatNumber($this->sms_pkg_total_allowed_sms->ViewValue, 0, -2, -2, -2);
		$this->sms_pkg_total_allowed_sms->ViewCustomAttributes = "";

		// sms_pkg_expiry_date
		$this->sms_pkg_expiry_date->ViewValue = $this->sms_pkg_expiry_date->CurrentValue;
		$this->sms_pkg_expiry_date->ViewValue = FormatDateTime($this->sms_pkg_expiry_date->ViewValue, 0);
		$this->sms_pkg_expiry_date->ViewCustomAttributes = "";

		// sms_pkg_per_sms_cost
		$this->sms_pkg_per_sms_cost->ViewValue = $this->sms_pkg_per_sms_cost->CurrentValue;
		$this->sms_pkg_per_sms_cost->ViewValue = FormatNumber($this->sms_pkg_per_sms_cost->ViewValue, 2, -2, -2, -2);
		$this->sms_pkg_per_sms_cost->ViewCustomAttributes = "";

		// sms_pkg_deal_details
		$this->sms_pkg_deal_details->ViewValue = $this->sms_pkg_deal_details->CurrentValue;
		$this->sms_pkg_deal_details->ViewCustomAttributes = "";

		// sms_pkg_id
		$this->sms_pkg_id->LinkCustomAttributes = "";
		$this->sms_pkg_id->HrefValue = "";
		$this->sms_pkg_id->TooltipValue = "";

		// sms_pkg_sms_api_id
		$this->sms_pkg_sms_api_id->LinkCustomAttributes = "";
		$this->sms_pkg_sms_api_id->HrefValue = "";
		$this->sms_pkg_sms_api_id->TooltipValue = "";

		// sms_pkg_branch_id
		$this->sms_pkg_branch_id->LinkCustomAttributes = "";
		$this->sms_pkg_branch_id->HrefValue = "";
		$this->sms_pkg_branch_id->TooltipValue = "";

		// sms_pkg_total_allowed_sms
		$this->sms_pkg_total_allowed_sms->LinkCustomAttributes = "";
		$this->sms_pkg_total_allowed_sms->HrefValue = "";
		$this->sms_pkg_total_allowed_sms->TooltipValue = "";

		// sms_pkg_expiry_date
		$this->sms_pkg_expiry_date->LinkCustomAttributes = "";
		$this->sms_pkg_expiry_date->HrefValue = "";
		$this->sms_pkg_expiry_date->TooltipValue = "";

		// sms_pkg_per_sms_cost
		$this->sms_pkg_per_sms_cost->LinkCustomAttributes = "";
		$this->sms_pkg_per_sms_cost->HrefValue = "";
		$this->sms_pkg_per_sms_cost->TooltipValue = "";

		// sms_pkg_deal_details
		$this->sms_pkg_deal_details->LinkCustomAttributes = "";
		$this->sms_pkg_deal_details->HrefValue = "";
		$this->sms_pkg_deal_details->TooltipValue = "";

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

		// sms_pkg_id
		$this->sms_pkg_id->EditAttrs["class"] = "form-control";
		$this->sms_pkg_id->EditCustomAttributes = "";
		$this->sms_pkg_id->EditValue = $this->sms_pkg_id->CurrentValue;
		$this->sms_pkg_id->ViewCustomAttributes = "";

		// sms_pkg_sms_api_id
		$this->sms_pkg_sms_api_id->EditAttrs["class"] = "form-control";
		$this->sms_pkg_sms_api_id->EditCustomAttributes = "";
		$this->sms_pkg_sms_api_id->EditValue = $this->sms_pkg_sms_api_id->CurrentValue;
		$this->sms_pkg_sms_api_id->PlaceHolder = RemoveHtml($this->sms_pkg_sms_api_id->caption());

		// sms_pkg_branch_id
		$this->sms_pkg_branch_id->EditAttrs["class"] = "form-control";
		$this->sms_pkg_branch_id->EditCustomAttributes = "";
		$this->sms_pkg_branch_id->EditValue = $this->sms_pkg_branch_id->CurrentValue;
		$this->sms_pkg_branch_id->PlaceHolder = RemoveHtml($this->sms_pkg_branch_id->caption());

		// sms_pkg_total_allowed_sms
		$this->sms_pkg_total_allowed_sms->EditAttrs["class"] = "form-control";
		$this->sms_pkg_total_allowed_sms->EditCustomAttributes = "";
		$this->sms_pkg_total_allowed_sms->EditValue = $this->sms_pkg_total_allowed_sms->CurrentValue;
		$this->sms_pkg_total_allowed_sms->PlaceHolder = RemoveHtml($this->sms_pkg_total_allowed_sms->caption());

		// sms_pkg_expiry_date
		$this->sms_pkg_expiry_date->EditAttrs["class"] = "form-control";
		$this->sms_pkg_expiry_date->EditCustomAttributes = "";
		$this->sms_pkg_expiry_date->EditValue = FormatDateTime($this->sms_pkg_expiry_date->CurrentValue, 8);
		$this->sms_pkg_expiry_date->PlaceHolder = RemoveHtml($this->sms_pkg_expiry_date->caption());

		// sms_pkg_per_sms_cost
		$this->sms_pkg_per_sms_cost->EditAttrs["class"] = "form-control";
		$this->sms_pkg_per_sms_cost->EditCustomAttributes = "";
		$this->sms_pkg_per_sms_cost->EditValue = $this->sms_pkg_per_sms_cost->CurrentValue;
		$this->sms_pkg_per_sms_cost->PlaceHolder = RemoveHtml($this->sms_pkg_per_sms_cost->caption());
		if (strval($this->sms_pkg_per_sms_cost->EditValue) != "" && is_numeric($this->sms_pkg_per_sms_cost->EditValue))
			$this->sms_pkg_per_sms_cost->EditValue = FormatNumber($this->sms_pkg_per_sms_cost->EditValue, -2, -2, -2, -2);
		

		// sms_pkg_deal_details
		$this->sms_pkg_deal_details->EditAttrs["class"] = "form-control";
		$this->sms_pkg_deal_details->EditCustomAttributes = "";
		$this->sms_pkg_deal_details->EditValue = $this->sms_pkg_deal_details->CurrentValue;
		$this->sms_pkg_deal_details->PlaceHolder = RemoveHtml($this->sms_pkg_deal_details->caption());

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
					$doc->exportCaption($this->sms_pkg_id);
					$doc->exportCaption($this->sms_pkg_sms_api_id);
					$doc->exportCaption($this->sms_pkg_branch_id);
					$doc->exportCaption($this->sms_pkg_total_allowed_sms);
					$doc->exportCaption($this->sms_pkg_expiry_date);
					$doc->exportCaption($this->sms_pkg_per_sms_cost);
					$doc->exportCaption($this->sms_pkg_deal_details);
				} else {
					$doc->exportCaption($this->sms_pkg_id);
					$doc->exportCaption($this->sms_pkg_sms_api_id);
					$doc->exportCaption($this->sms_pkg_branch_id);
					$doc->exportCaption($this->sms_pkg_total_allowed_sms);
					$doc->exportCaption($this->sms_pkg_expiry_date);
					$doc->exportCaption($this->sms_pkg_per_sms_cost);
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
						$doc->exportField($this->sms_pkg_id);
						$doc->exportField($this->sms_pkg_sms_api_id);
						$doc->exportField($this->sms_pkg_branch_id);
						$doc->exportField($this->sms_pkg_total_allowed_sms);
						$doc->exportField($this->sms_pkg_expiry_date);
						$doc->exportField($this->sms_pkg_per_sms_cost);
						$doc->exportField($this->sms_pkg_deal_details);
					} else {
						$doc->exportField($this->sms_pkg_id);
						$doc->exportField($this->sms_pkg_sms_api_id);
						$doc->exportField($this->sms_pkg_branch_id);
						$doc->exportField($this->sms_pkg_total_allowed_sms);
						$doc->exportField($this->sms_pkg_expiry_date);
						$doc->exportField($this->sms_pkg_per_sms_cost);
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