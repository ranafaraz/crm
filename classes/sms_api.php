<?php namespace PHPMaker2020\crm_live; ?>
<?php

/**
 * Table class for sms_api
 */
class sms_api extends DbTable
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
	public $sms_api_id;
	public $sms_api_user;
	public $sms_api_pass;
	public $sms_api_url;
	public $sms_api_mask;
	public $sms_api_reg_date;
	public $sms_api_expiry_date;
	public $sms_api_total_sms;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'sms_api';
		$this->TableName = 'sms_api';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`sms_api`";
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

		// sms_api_id
		$this->sms_api_id = new DbField('sms_api', 'sms_api', 'x_sms_api_id', 'sms_api_id', '`sms_api_id`', '`sms_api_id`', 3, 12, -1, FALSE, '`sms_api_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->sms_api_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->sms_api_id->IsPrimaryKey = TRUE; // Primary key field
		$this->sms_api_id->Sortable = TRUE; // Allow sort
		$this->sms_api_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sms_api_id'] = &$this->sms_api_id;

		// sms_api_user
		$this->sms_api_user = new DbField('sms_api', 'sms_api', 'x_sms_api_user', 'sms_api_user', '`sms_api_user`', '`sms_api_user`', 200, 20, -1, FALSE, '`sms_api_user`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sms_api_user->Nullable = FALSE; // NOT NULL field
		$this->sms_api_user->Required = TRUE; // Required field
		$this->sms_api_user->Sortable = TRUE; // Allow sort
		$this->fields['sms_api_user'] = &$this->sms_api_user;

		// sms_api_pass
		$this->sms_api_pass = new DbField('sms_api', 'sms_api', 'x_sms_api_pass', 'sms_api_pass', '`sms_api_pass`', '`sms_api_pass`', 200, 30, -1, FALSE, '`sms_api_pass`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sms_api_pass->Nullable = FALSE; // NOT NULL field
		$this->sms_api_pass->Required = TRUE; // Required field
		$this->sms_api_pass->Sortable = TRUE; // Allow sort
		$this->fields['sms_api_pass'] = &$this->sms_api_pass;

		// sms_api_url
		$this->sms_api_url = new DbField('sms_api', 'sms_api', 'x_sms_api_url', 'sms_api_url', '`sms_api_url`', '`sms_api_url`', 200, 100, -1, FALSE, '`sms_api_url`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sms_api_url->Nullable = FALSE; // NOT NULL field
		$this->sms_api_url->Required = TRUE; // Required field
		$this->sms_api_url->Sortable = TRUE; // Allow sort
		$this->fields['sms_api_url'] = &$this->sms_api_url;

		// sms_api_mask
		$this->sms_api_mask = new DbField('sms_api', 'sms_api', 'x_sms_api_mask', 'sms_api_mask', '`sms_api_mask`', '`sms_api_mask`', 200, 10, -1, FALSE, '`sms_api_mask`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sms_api_mask->Nullable = FALSE; // NOT NULL field
		$this->sms_api_mask->Required = TRUE; // Required field
		$this->sms_api_mask->Sortable = TRUE; // Allow sort
		$this->fields['sms_api_mask'] = &$this->sms_api_mask;

		// sms_api_reg_date
		$this->sms_api_reg_date = new DbField('sms_api', 'sms_api', 'x_sms_api_reg_date', 'sms_api_reg_date', '`sms_api_reg_date`', CastDateFieldForLike("`sms_api_reg_date`", 2, "DB"), 133, 10, 2, FALSE, '`sms_api_reg_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sms_api_reg_date->Nullable = FALSE; // NOT NULL field
		$this->sms_api_reg_date->Required = TRUE; // Required field
		$this->sms_api_reg_date->Sortable = TRUE; // Allow sort
		$this->sms_api_reg_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['sms_api_reg_date'] = &$this->sms_api_reg_date;

		// sms_api_expiry_date
		$this->sms_api_expiry_date = new DbField('sms_api', 'sms_api', 'x_sms_api_expiry_date', 'sms_api_expiry_date', '`sms_api_expiry_date`', CastDateFieldForLike("`sms_api_expiry_date`", 2, "DB"), 133, 10, 2, FALSE, '`sms_api_expiry_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sms_api_expiry_date->Nullable = FALSE; // NOT NULL field
		$this->sms_api_expiry_date->Required = TRUE; // Required field
		$this->sms_api_expiry_date->Sortable = TRUE; // Allow sort
		$this->sms_api_expiry_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['sms_api_expiry_date'] = &$this->sms_api_expiry_date;

		// sms_api_total_sms
		$this->sms_api_total_sms = new DbField('sms_api', 'sms_api', 'x_sms_api_total_sms', 'sms_api_total_sms', '`sms_api_total_sms`', '`sms_api_total_sms`', 3, 10, -1, FALSE, '`sms_api_total_sms`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sms_api_total_sms->Nullable = FALSE; // NOT NULL field
		$this->sms_api_total_sms->Required = TRUE; // Required field
		$this->sms_api_total_sms->Sortable = TRUE; // Allow sort
		$this->sms_api_total_sms->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sms_api_total_sms'] = &$this->sms_api_total_sms;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`sms_api`";
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
			$this->sms_api_id->setDbValue($conn->insert_ID());
			$rs['sms_api_id'] = $this->sms_api_id->DbValue;
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
			if (array_key_exists('sms_api_id', $rs))
				AddFilter($where, QuotedName('sms_api_id', $this->Dbid) . '=' . QuotedValue($rs['sms_api_id'], $this->sms_api_id->DataType, $this->Dbid));
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
		$this->sms_api_id->DbValue = $row['sms_api_id'];
		$this->sms_api_user->DbValue = $row['sms_api_user'];
		$this->sms_api_pass->DbValue = $row['sms_api_pass'];
		$this->sms_api_url->DbValue = $row['sms_api_url'];
		$this->sms_api_mask->DbValue = $row['sms_api_mask'];
		$this->sms_api_reg_date->DbValue = $row['sms_api_reg_date'];
		$this->sms_api_expiry_date->DbValue = $row['sms_api_expiry_date'];
		$this->sms_api_total_sms->DbValue = $row['sms_api_total_sms'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`sms_api_id` = @sms_api_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('sms_api_id', $row) ? $row['sms_api_id'] : NULL;
		else
			$val = $this->sms_api_id->OldValue !== NULL ? $this->sms_api_id->OldValue : $this->sms_api_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@sms_api_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "sms_apilist.php";
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
		if ($pageName == "sms_apiview.php")
			return $Language->phrase("View");
		elseif ($pageName == "sms_apiedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "sms_apiadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "sms_apilist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("sms_apiview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("sms_apiview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "sms_apiadd.php?" . $this->getUrlParm($parm);
		else
			$url = "sms_apiadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("sms_apiedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("sms_apiadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("sms_apidelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "sms_api_id:" . JsonEncode($this->sms_api_id->CurrentValue, "number");
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
		if ($this->sms_api_id->CurrentValue != NULL) {
			$url .= "sms_api_id=" . urlencode($this->sms_api_id->CurrentValue);
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
			if (Param("sms_api_id") !== NULL)
				$arKeys[] = Param("sms_api_id");
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
				$this->sms_api_id->CurrentValue = $key;
			else
				$this->sms_api_id->OldValue = $key;
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
		$this->sms_api_id->setDbValue($rs->fields('sms_api_id'));
		$this->sms_api_user->setDbValue($rs->fields('sms_api_user'));
		$this->sms_api_pass->setDbValue($rs->fields('sms_api_pass'));
		$this->sms_api_url->setDbValue($rs->fields('sms_api_url'));
		$this->sms_api_mask->setDbValue($rs->fields('sms_api_mask'));
		$this->sms_api_reg_date->setDbValue($rs->fields('sms_api_reg_date'));
		$this->sms_api_expiry_date->setDbValue($rs->fields('sms_api_expiry_date'));
		$this->sms_api_total_sms->setDbValue($rs->fields('sms_api_total_sms'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// sms_api_id
		// sms_api_user
		// sms_api_pass
		// sms_api_url
		// sms_api_mask
		// sms_api_reg_date
		// sms_api_expiry_date
		// sms_api_total_sms
		// sms_api_id

		$this->sms_api_id->ViewValue = $this->sms_api_id->CurrentValue;
		$this->sms_api_id->CssClass = "font-weight-bold";
		$this->sms_api_id->ViewCustomAttributes = "";

		// sms_api_user
		$this->sms_api_user->ViewValue = $this->sms_api_user->CurrentValue;
		$this->sms_api_user->ViewCustomAttributes = "";

		// sms_api_pass
		$this->sms_api_pass->ViewValue = $this->sms_api_pass->CurrentValue;
		$this->sms_api_pass->ViewCustomAttributes = "";

		// sms_api_url
		$this->sms_api_url->ViewValue = $this->sms_api_url->CurrentValue;
		$this->sms_api_url->ViewCustomAttributes = "";

		// sms_api_mask
		$this->sms_api_mask->ViewValue = $this->sms_api_mask->CurrentValue;
		$this->sms_api_mask->ViewCustomAttributes = "";

		// sms_api_reg_date
		$this->sms_api_reg_date->ViewValue = $this->sms_api_reg_date->CurrentValue;
		$this->sms_api_reg_date->ViewValue = FormatDateTime($this->sms_api_reg_date->ViewValue, 2);
		$this->sms_api_reg_date->ViewCustomAttributes = "";

		// sms_api_expiry_date
		$this->sms_api_expiry_date->ViewValue = $this->sms_api_expiry_date->CurrentValue;
		$this->sms_api_expiry_date->ViewValue = FormatDateTime($this->sms_api_expiry_date->ViewValue, 2);
		$this->sms_api_expiry_date->ViewCustomAttributes = "";

		// sms_api_total_sms
		$this->sms_api_total_sms->ViewValue = $this->sms_api_total_sms->CurrentValue;
		$this->sms_api_total_sms->ViewValue = FormatNumber($this->sms_api_total_sms->ViewValue, 0, -2, -2, -2);
		$this->sms_api_total_sms->ViewCustomAttributes = "";

		// sms_api_id
		$this->sms_api_id->LinkCustomAttributes = "";
		$this->sms_api_id->HrefValue = "";
		$this->sms_api_id->TooltipValue = "";

		// sms_api_user
		$this->sms_api_user->LinkCustomAttributes = "";
		$this->sms_api_user->HrefValue = "";
		$this->sms_api_user->TooltipValue = "";

		// sms_api_pass
		$this->sms_api_pass->LinkCustomAttributes = "";
		$this->sms_api_pass->HrefValue = "";
		$this->sms_api_pass->TooltipValue = "";

		// sms_api_url
		$this->sms_api_url->LinkCustomAttributes = "";
		$this->sms_api_url->HrefValue = "";
		$this->sms_api_url->TooltipValue = "";

		// sms_api_mask
		$this->sms_api_mask->LinkCustomAttributes = "";
		$this->sms_api_mask->HrefValue = "";
		$this->sms_api_mask->TooltipValue = "";

		// sms_api_reg_date
		$this->sms_api_reg_date->LinkCustomAttributes = "";
		$this->sms_api_reg_date->HrefValue = "";
		$this->sms_api_reg_date->TooltipValue = "";

		// sms_api_expiry_date
		$this->sms_api_expiry_date->LinkCustomAttributes = "";
		$this->sms_api_expiry_date->HrefValue = "";
		$this->sms_api_expiry_date->TooltipValue = "";

		// sms_api_total_sms
		$this->sms_api_total_sms->LinkCustomAttributes = "";
		$this->sms_api_total_sms->HrefValue = "";
		$this->sms_api_total_sms->TooltipValue = "";

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

		// sms_api_id
		$this->sms_api_id->EditAttrs["class"] = "form-control";
		$this->sms_api_id->EditCustomAttributes = "";
		$this->sms_api_id->EditValue = $this->sms_api_id->CurrentValue;
		$this->sms_api_id->CssClass = "font-weight-bold";
		$this->sms_api_id->ViewCustomAttributes = "";

		// sms_api_user
		$this->sms_api_user->EditAttrs["class"] = "form-control";
		$this->sms_api_user->EditCustomAttributes = "";
		if (!$this->sms_api_user->Raw)
			$this->sms_api_user->CurrentValue = HtmlDecode($this->sms_api_user->CurrentValue);
		$this->sms_api_user->EditValue = $this->sms_api_user->CurrentValue;
		$this->sms_api_user->PlaceHolder = RemoveHtml($this->sms_api_user->caption());

		// sms_api_pass
		$this->sms_api_pass->EditAttrs["class"] = "form-control";
		$this->sms_api_pass->EditCustomAttributes = "";
		if (!$this->sms_api_pass->Raw)
			$this->sms_api_pass->CurrentValue = HtmlDecode($this->sms_api_pass->CurrentValue);
		$this->sms_api_pass->EditValue = $this->sms_api_pass->CurrentValue;
		$this->sms_api_pass->PlaceHolder = RemoveHtml($this->sms_api_pass->caption());

		// sms_api_url
		$this->sms_api_url->EditAttrs["class"] = "form-control";
		$this->sms_api_url->EditCustomAttributes = "";
		if (!$this->sms_api_url->Raw)
			$this->sms_api_url->CurrentValue = HtmlDecode($this->sms_api_url->CurrentValue);
		$this->sms_api_url->EditValue = $this->sms_api_url->CurrentValue;
		$this->sms_api_url->PlaceHolder = RemoveHtml($this->sms_api_url->caption());

		// sms_api_mask
		$this->sms_api_mask->EditAttrs["class"] = "form-control";
		$this->sms_api_mask->EditCustomAttributes = "";
		if (!$this->sms_api_mask->Raw)
			$this->sms_api_mask->CurrentValue = HtmlDecode($this->sms_api_mask->CurrentValue);
		$this->sms_api_mask->EditValue = $this->sms_api_mask->CurrentValue;
		$this->sms_api_mask->PlaceHolder = RemoveHtml($this->sms_api_mask->caption());

		// sms_api_reg_date
		$this->sms_api_reg_date->EditAttrs["class"] = "form-control";
		$this->sms_api_reg_date->EditCustomAttributes = "";
		$this->sms_api_reg_date->EditValue = FormatDateTime($this->sms_api_reg_date->CurrentValue, 2);
		$this->sms_api_reg_date->PlaceHolder = RemoveHtml($this->sms_api_reg_date->caption());

		// sms_api_expiry_date
		$this->sms_api_expiry_date->EditAttrs["class"] = "form-control";
		$this->sms_api_expiry_date->EditCustomAttributes = "";
		$this->sms_api_expiry_date->EditValue = FormatDateTime($this->sms_api_expiry_date->CurrentValue, 2);
		$this->sms_api_expiry_date->PlaceHolder = RemoveHtml($this->sms_api_expiry_date->caption());

		// sms_api_total_sms
		$this->sms_api_total_sms->EditAttrs["class"] = "form-control";
		$this->sms_api_total_sms->EditCustomAttributes = "";
		$this->sms_api_total_sms->EditValue = $this->sms_api_total_sms->CurrentValue;
		$this->sms_api_total_sms->PlaceHolder = RemoveHtml($this->sms_api_total_sms->caption());

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
					$doc->exportCaption($this->sms_api_id);
					$doc->exportCaption($this->sms_api_user);
					$doc->exportCaption($this->sms_api_pass);
					$doc->exportCaption($this->sms_api_url);
					$doc->exportCaption($this->sms_api_mask);
					$doc->exportCaption($this->sms_api_reg_date);
					$doc->exportCaption($this->sms_api_expiry_date);
					$doc->exportCaption($this->sms_api_total_sms);
				} else {
					$doc->exportCaption($this->sms_api_id);
					$doc->exportCaption($this->sms_api_user);
					$doc->exportCaption($this->sms_api_pass);
					$doc->exportCaption($this->sms_api_url);
					$doc->exportCaption($this->sms_api_mask);
					$doc->exportCaption($this->sms_api_reg_date);
					$doc->exportCaption($this->sms_api_expiry_date);
					$doc->exportCaption($this->sms_api_total_sms);
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
						$doc->exportField($this->sms_api_id);
						$doc->exportField($this->sms_api_user);
						$doc->exportField($this->sms_api_pass);
						$doc->exportField($this->sms_api_url);
						$doc->exportField($this->sms_api_mask);
						$doc->exportField($this->sms_api_reg_date);
						$doc->exportField($this->sms_api_expiry_date);
						$doc->exportField($this->sms_api_total_sms);
					} else {
						$doc->exportField($this->sms_api_id);
						$doc->exportField($this->sms_api_user);
						$doc->exportField($this->sms_api_pass);
						$doc->exportField($this->sms_api_url);
						$doc->exportField($this->sms_api_mask);
						$doc->exportField($this->sms_api_reg_date);
						$doc->exportField($this->sms_api_expiry_date);
						$doc->exportField($this->sms_api_total_sms);
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