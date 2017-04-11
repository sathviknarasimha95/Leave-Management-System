<?php require_once('../Connections/Leave.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "Leave_page")) {
  $updateSQL = sprintf("UPDATE leave_page SET empid=%s, empname=%s, desig=%s, department=%s, rcl=%s, rscl=%s, rel=%s, leave_type=%s, from_date=%s, to_date=%s, app_date=%s, no_days=%s, reason=%s, leave_status=%s WHERE Leave_id=%s",
                       GetSQLValueString($_POST['empid'], "text"),
                       GetSQLValueString($_POST['empname'], "text"),
                       GetSQLValueString($_POST['design'], "text"),
                       GetSQLValueString($_POST['Dep'], "text"),
                       GetSQLValueString($_POST['rcl'], "int"),
                       GetSQLValueString($_POST['rscl'], "int"),
                       GetSQLValueString($_POST['rel'], "int"),
                       GetSQLValueString($_POST['leave'], "text"),
                       GetSQLValueString($_POST['from_date'], "text"),
                       GetSQLValueString($_POST['to_date'], "text"),
                       GetSQLValueString($_POST['applied_date'], "text"),
                       GetSQLValueString($_POST['no_days'], "text"),
                       GetSQLValueString($_POST['reason_text'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['Leave_id'], "int"));

  mysql_select_db($database_Leave, $Leave);
  $Result1 = mysql_query($updateSQL, $Leave) or die(mysql_error());

  $updateGoTo = "reqleave.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "Leave_page")) {
  $updateSQL = sprintf("UPDATE emp_info SET cl=%s, scl=%s, el=%s WHERE emp_id=%s",
                       GetSQLValueString($_POST['rcl'], "int"),
                       GetSQLValueString($_POST['rscl'], "int"),
                       GetSQLValueString($_POST['rel'], "int"),
                       GetSQLValueString($_POST['empid'], "text"));

  mysql_select_db($database_Leave, $Leave);
  $Result1 = mysql_query($updateSQL, $Leave) or die(mysql_error());

  $updateGoTo = "reqleave.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_hod_approve = "1";
if (isset($_GET['Leave_id'])) {
  $colname_hod_approve = $_GET['Leave_id'];
}
mysql_select_db($database_Leave, $Leave);
$query_hod_approve = sprintf("SELECT Leave_id, empid, empname, desig, department, rcl, rscl, rel, leave_type, from_date, to_date, app_date, no_days, reason, leave_status FROM leave_page WHERE Leave_id = %s", GetSQLValueString($colname_hod_approve, "int"));
$hod_approve = mysql_query($query_hod_approve, $Leave) or die(mysql_error());
$row_hod_approve = mysql_fetch_assoc($hod_approve);
$totalRows_hod_approve = mysql_num_rows($hod_approve);
?>
<html>
<head>
<title>Leave</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript">
function sum() {
 
 var status = document.getElementById('status').value;
 var type = document.getElementById('leave_type').value;
 var cl = document.getElementById('cl').value
 var scl = document.getElementById('scl').value;
 var el = document.getElementById('el').value;
 var no = document.getElementById('no').value;
 if(type == "CL")
 {
 if(status == "apporved")
 {
 var ans = +cl - +no;
document.Leave_page.cl.value = ans;
 }
}
if(type == "SCL")
 {
 if(status == "apporved")
 {
 var ans = +scl - +no;
document.Leave_page.scl.value = ans;
 }
}
if(type == "EL")
 {
 if(status == "apporved")
 {
 var ans = +el - +no;
document.Leave_page.el.value = ans;
 }
}
}
</script>
</head>
<body>
<form action="<?php echo $editFormAction; ?>" method="POST" name="Leave_page" class="smart-green">
<a href="../Login Sucess.php">Back</a>
<h1 align="center">Employee Details</h1>
<label>
<span>Employe Id</span>
<input name="empid" type="text" required placeholder="Empid" value="<?php echo $row_hod_approve['empid']; ?>">
</label>

<label>
<span>Employe Name</span>
<input name="empname" type="text" required placeholder="Employee Name" value="<?php echo $row_hod_approve['empname']; ?>">
</label>

<label>
<span>Designation</span>
<input name="design" type="text" required placeholder="Designation" value="<?php echo $row_hod_approve['desig']; ?>">
</label>

<label>
<span>Department</span> 
<input name="Dep" type="text" required Placeholder="Department" value="<?php echo $row_hod_approve['department']; ?>">

</label>

<br>
<br>

<span>Remaining CL</span> 
<input name="rcl" type="text" name="cl" id="cl" required value="<?php echo $row_hod_approve['rcl']; ?>" >
</label>
<label>
<span>Remaining SCL</span> 
<input name="rscl" type="text" name="scl" id="scl" required value="<?php echo $row_hod_approve['rscl']; ?>" >
</label>
<label>
<span>Remaining EL</span> 
<input name="rel" type="text" name="el" id="el" required value="<?php echo $row_hod_approve['rel']; ?>" >
</label>
    <br>
    <br>
    <label>Leave type:</label>
    <select name="leave" id="leave_type" disabled >
      <option value="cl" <?php if (!(strcmp("CL", $row_hod_approve['leave_type']))) {echo "selected=\"selected\"";} ?>>Casual Leave</option>
      <option value="el" <?php if (!(strcmp("EL", $row_hod_approve['leave_type']))) {echo "selected=\"selected\"";} ?>>Earn Leave</option>
      <option value="scl" <?php if (!(strcmp("OOD/SCL", $row_hod_approve['leave_type']))) {echo "selected=\"selected\"";} ?>>OOD/SCL</option>
      <option value="LOP" <?php if (!(strcmp("LOP", $row_hod_approve['leave_type']))) {echo "selected=\"selected\"";} ?>>LOP</option>
      
    </select>
    
    
    
    <label>
    <span>From Date:</span>
    <input name="from_date" type="text" required id="from_date" placeholder="From Date" value="<?php echo $row_hod_approve['from_date']; ?>">
    </label>
    <label>
    <span>TO Date:</span>
    <input name="to_date" type="text" required id="to_date" placeholder="To Date" value="<?php echo $row_hod_approve['to_date']; ?>">
    </label>
    <label>
    <span>Applied Date:</span>
    <input name="applied_date" type="text" required id="applied_date" placeholder="Applied Date" value="<?php echo $row_hod_approve['app_date']; ?>">
    </label>
    
    <label>
    <span>Number of Days:</span>
    <input name="no_days" type="text" required id="no" placeholder="Number of days" value="<?php echo $row_hod_approve['no_days']; ?>">
    </label>
    <label>
    
    <br>
    <label>
    <span>Reason:</span>
    <textarea name="reason_text" cols="40" rows="5" required><?php echo $row_hod_approve['reason']; ?></textarea>
    </span>
    <label>Leave Status</label>
    <select name="status" id="status" onclick="sum()" >
      <option value="pending" <?php if (!(strcmp("pending", $row_hod_approve['leave_status']))) {echo "selected=\"selected\"";} ?>>Pending</option>
      <option value="apporved" <?php if (!(strcmp("apporved", $row_hod_approve['leave_status']))) {echo "selected=\"selected\"";} ?>>Apporved</option>
      <option value="Decline" <?php if (!(strcmp("Decline", $row_hod_approve['leave_status']))) {echo "selected=\"selected\"";} ?>>Decline</option>
    </select>
  <br>
    <br>
  
  <input type="submit" name="submit" value="submit" class="button">
  <input name="Leave_id" type="hidden" id="Leave_id" value="<?php echo $row_hod_approve['Leave_id']; ?>">
  <br>
  <input type="hidden" name="MM_update" value="Leave_page">

</div>
 
</form>   
</body>
</html>
<?php
mysql_free_result($hod_approve);
?>
