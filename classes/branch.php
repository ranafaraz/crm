<?php namespace PHPMaker2020\dexdevs_crm; ?>
<?php

/**
 * Table class for branch
 */
class branch extends DbTable
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
	public $branch_id;
	public $branch_org_id;
	public $branch_name;
	public $branch_manager;
	public $branch_contact;
	public $branch_address;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'branch';
		$this->TableName = 'branch';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`branch`";
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

		// branch_id
		$this->branch_id = new DbField('branch', 'branch', 'x_branch_id', 'branch_id', '`branch_id`', '`branch_id`', 3, 12, -1, FALSE, '`branch_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->branch_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->branch_id->IsPrimaryKey = TRUE; // Primary key field
		$this->branch_id->Sortable = TRUE; // Allow sort
		$this->branch_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['branch_id'] = &$this->branch_id;

		// branch_org_id
		$this->branch_org_id = new DbField('branch', 'branch', 'x_branch_org_id', 'branch_org_id', '`branch_org_id`', '`branch_org_id`', 3, 12, -1, FALSE, '`branch_org_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->branch_org_id->Nullable = FALSE; // NOT NULL field
		$this->branch_org_id->Required = TRUE; // Required field
		$this->branch_org_id->Sortable = TRUE; // Allow sort
		$this->branch_org_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->branch_org_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->branch_org_id->Lookup = new Lookup('branch_org_id', 'organization', FALSE, 'org_id', ["org_name","","",""], [], [], [], [], [], [], '', '');
		$this->branch_org_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['branch_org_id'] = &$this->branch_org_id;

		// branch_name
		$this->branch_name = new DbField('branch', 'branch', 'x_branch_name', 'branch_name', '`branch_name`', '`branch_name`', 200, 100, -1, FALSE, '`branch_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->branch_name->Nullable = FALSE; // NOT NULL field
		$this->branch_name->Required = TRUE; // Required field
		$this->branch_name->Sortable = TRUE; // Allow sort
		$this->fields['branch_name'] = &$this->branch_name;

		// branch_manager
		$this->branch_manager = new DbField('branch', 'branch', 'x_branch_manager', 'branch_manager', '`branch_manager`', '`branch_manager`', 200, 50, -1, FALSE, '`branch_manager`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->branch_manager->Nullable = FALSE; // NOT NULL field
		$this->branch_manager->Required = TRUE; // Required field
		$this->branch_manager->Sortable = TRUE; // Allow sort
		$this->fields['branch_manager'] = &$this->branch_manager;

		// branch_contact
		$this->branch_contact = new DbField('branch', 'branch', 'x_branch_contact', 'branch_contact', '`branch_contact`', '`branch_contact`', 200, 20, -1, FALSE, '`branch_contact`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->branch_contact->Nullable = FALSE; // NOT NULL field
		$this->branch_contact->Required = TRUE; // Required field
		$this->branch_contact->Sortable = TRUE; // Allow sort
		$this->fields['branch_contact'] = &$this->branch_contact;

		// branch_address
		$this->branch_address = new DbField('branch', 'branch', 'x_branch_address', 'branch_address', '`branch_address`', '`branch_address`', 200, 100, -1, FALSE, '`branch_address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->branch_address->Nullable = FALSE; // NOT NULL field
		$this->branch_address->Required = TRUE; // Required field
		$this->branch_address->Sortable = TRUE; // Allow sort
		$this->fields['branch_address'] = &$this->branch_address;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`branch`";
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
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->branch_id->setDbValue($conn->insert_ID());
			$rs['branch_id'] = $this->branch_id->DbValue;
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
			if (array_key_exists('branch_id', $rs))
				AddFilter($where, QuotedName('branch_id', $this->Dbid) . '=' . QuotedValue($rs['branch_id'], $this->branch_id->DataType, $this->Dbid));
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
		$this->branch_id->DbValue = $row['branch_id'];
		$this->branch_org_id->DbValue = $row['branch_org_id'];
		$this->branch_name->DbValue = $row['branch_name'];
		$this->branch_manager->DbValue = $row['branch_manager'];
		$this->branch_contact->DbValue = $row['branch_contact'];
		$this->branch_address->DbValue = $row['branch_address'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`branch_id` = @branch_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('branch_id', $row) ? $row['branch_id'] : NULL;
		else
			$val = $this->branch_id->OldValue !== NULL ? $this->branch_id->OldValue : $this->branch_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@branch_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "branchlist.php";
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
		if ($pageName == "branchview.php")
			return $Language->phrase("View");
		elseif ($pageName == "branchedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "branchadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "branchlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("branchview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("branchview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "branchadd.php?" . $this->getUrlParm($parm);
		else
			$url = "branchadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("branchedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("branchadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("branchdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "branch_id:" . JsonEncode($this->branch_id->CurrentValue, "number");
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
		if ($this->branch_id->CurrentValue != NULL) {
			$url .= "branch_id=" . urlencode($this->branch_id->CurrentValue);
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
			if (Param("branch_id") !== NULL)
				$arKeys[] = Param("branch_id");
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
				$this->branch_id->CurrentValue = $key;
			else
				$this->branch_id->OldValue = $key;
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
		$this->branch_id->setDbValue($rs->fields('branch_id'));
		$this->branch_org_id->setDbValue($rs->fields('branch_org_id'));
		$this->branch_name->setDbValue($rs->fields('branch_name'));
		$this->branch_manager->setDbValue($rs->fields('branch_manager'));
		$this->branch_contact->setDbValue($rs->fields('branch_contact'));
		$this->branch_address->setDbValue($rs->fields('branch_address'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// branch_id
		// branch_org_id
		// branch_name
		// branch_manager
		// branch_contact
		// branch_address
		// branch_id

		$this->branch_id->ViewValue = $this->branch_id->CurrentValue;
		$this->branch_id->CssClass = "font-weight-bold";
		$this->branch_id->ViewCustomAttributes = "";

		// branch_org_id
		$curVal = strval($this->branch_org_id->CurrentValue);
		if ($curVal != "") {
			$this->branch_org_id->ViewValue = $this->branch_org_id->lookupCacheOption($curVal);
			if ($this->branch_org_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`org_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->branch_org_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->branch_org_id->ViewValue = $this->branch_org_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->branch_org_id->ViewValue = $this->branch_org_id->CurrentValue;
				}
			}
		} else {
			$this->branch_org_id->ViewValue = NULL;
		}
		$this->branch_org_id->ViewCustomAttributes = "";

		// branch_name
		$this->branch_name->ViewValue = $this->branch_name->CurrentValue;
		$this->branch_name->ViewCustomAttributes = "";

		// branch_manager
		$this->branch_manager->ViewValue = $this->branch_manager->CurrentValue;
		$this->branch_manager->ViewCustomAttributes = "";

		// branch_contact
		$this->branch_contact->ViewValue = $this->branch_contact->CurrentValue;
		$this->branch_contact->ViewCustomAttributes = "";

		// branch_address
		$this->branch_address->ViewValue = $this->branch_address->CurrentValue;
		$this->branch_address->ViewCustomAttributes = "";

		// branch_id
		$this->branch_id->LinkCustomAttributes = "";
		$this->branch_id->HrefValue = "";
		$this->branch_id->TooltipValue = "";

		// branch_org_id
		$this->branch_org_id->LinkCustomAttributes = "";
		$this->branch_org_id->HrefValue = "";
		$this->branch_org_id->TooltipValue = "";

		// branch_name
		$this->branch_name->LinkCustomAttributes = "";
		$this->branch_name->HrefValue = "";
		$this->branch_name->TooltipValue = "";

		// branch_manager
		$this->branch_manager->LinkCustomAttributes = "";
		$this->branch_manager->HrefValue = "";
		$this->branch_manager->TooltipValue = "";

		// branch_contact
		$this->branch_contact->LinkCustomAttributes = "";
		$this->branch_contact->HrefValue = "";
		$this->branch_contact->TooltipValue = "";

		// branch_address
		$this->branch_address->LinkCustomAttributes = "";
		$this->branch_address->HrefValue = "";
		$this->branch_address->TooltipValue = "";

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

		// branch_id
		$this->branch_id->EditAttrs["class"] = "form-control";
		$this->branch_id->EditCustomAttributes = "";
		$this->branch_id->EditValue = $this->branch_id->CurrentValue;
		$this->branch_id->CssClass = "font-weight-bold";
		$this->branch_id->ViewCustomAttributes = "";

		// branch_org_id
		$this->branch_org_id->EditCustomAttributes = "";

		// branch_name
		$this->branch_name->EditAttrs["class"] = "form-control";
		$this->branch_name->EditCustomAttributes = "";
		if (!$this->branch_name->Raw)
			$this->branch_name->CurrentValue = HtmlDecode($this->branch_name->CurrentValue);
		$this->branch_name->EditValue = $this->branch_name->CurrentValue;
		$this->branch_name->PlaceHolder = RemoveHtml($this->branch_name->caption());

		// branch_manager
		$this->branch_manager->EditAttrs["class"] = "form-control";
		$this->branch_manager->EditCustomAttributes = "";
		if (!$this->branch_manager->Raw)
			$this->branch_manager->CurrentValue = HtmlDecode($this->branch_manager->CurrentValue);
		$this->branch_manager->EditValue = $this->branch_manager->CurrentValue;
		$this->branch_manager->PlaceHolder = RemoveHtml($this->branch_manager->caption());

		// branch_contact
		$this->branch_contact->EditAttrs["class"] = "form-control";
		$this->branch_contact->EditCustomAttributes = "";
		if (!$this->branch_contact->Raw)
			$this->branch_contact->CurrentValue = HtmlDecode($this->branch_contact->CurrentValue);
		$this->branch_contact->EditValue = $this->branch_contact->CurrentValue;
		$this->branch_contact->PlaceHolder = RemoveHtml($this->branch_contact->caption());

		// branch_address
		$this->branch_address->EditAttrs["class"] = "form-control";
		$this->branch_address->EditCustomAttributes = "";
		$this->branch_address->EditValue = $this->branch_address->CurrentValue;
		$this->branch_address->PlaceHolder = RemoveHtml($this->branch_address->caption());

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
					$doc->exportCaption($this->branch_id);
					$doc->exportCaption($this->branch_org_id);
					$doc->exportCaption($this->branch_name);
					$doc->exportCaption($this->branch_manager);
					$doc->exportCaption($this->branch_contact);
					$doc->exportCaption($this->branch_address);
				} else {
					$doc->exportCaption($this->branch_id);
					$doc->exportCaption($this->branch_org_id);
					$doc->exportCaption($this->branch_name);
					$doc->exportCaption($this->branch_manager);
					$doc->exportCaption($this->branch_contact);
					$doc->exportCaption($this->branch_address);
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
						$doc->exportField($this->branch_id);
						$doc->exportField($this->branch_org_id);
						$doc->exportField($this->branch_name);
						$doc->exportField($this->branch_manager);
						$doc->exportField($this->branch_contact);
						$doc->exportField($this->branch_address);
					} else {
						$doc->exportField($this->branch_id);
						$doc->exportField($this->branch_org_id);
						$doc->exportField($this->branch_name);
						$doc->exportField($this->branch_manager);
						$doc->exportField($this->branch_contact);
						$doc->exportField($this->branch_address);
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