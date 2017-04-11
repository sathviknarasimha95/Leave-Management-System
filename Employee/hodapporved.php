<?php require_once('../Connections/Leave.php'); ?>
<?php include('../includes/headerhod.php'); ?>
<br>
<br>
<br>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "sums")) {
  $updateSQL = sprintf("UPDATE leave_page SET empid=%s, empname=%s, desig=%s, department=%s, rcl=%s, rscl=%s, rel=%s, leave_type=%s, from_date=%s, to_date=%s, app_date=%s, no_days=%s, reason=%s, leave_status=%s WHERE Leave_id=%s",
                       GetSQLValueString($_POST['empid'], "text"),
                       GetSQLValueString($_POST['empname'], "text"),
                       GetSQLValueString($_POST['design'], "text"),
                       GetSQLValueString($_POST['Dep'], "text"),
                       GetSQLValueString($_POST['cl'], "text"),
                       GetSQLValueString($_POST['scl'], "text"),
                       GetSQLValueString($_POST['el'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['from_date'], "text"),
                       GetSQLValueString($_POST['to_date'], "text"),
                       GetSQLValueString($_POST['applied_date'], "text"),
                       GetSQLValueString($_POST['no'], "text"),
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "sums")) {
  $updateSQL = sprintf("UPDATE emp_info SET cl=%s, scl=%s, el=%s WHERE emp_id=%s",
                       GetSQLValueString($_POST['cl'], "int"),
                       GetSQLValueString($_POST['scl'], "int"),
                       GetSQLValueString($_POST['el'], "int"),
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

$colname_hodapp = "-1";
if (isset($_GET['Leave_id'])) {
  $colname_hodapp = $_GET['Leave_id'];
}
mysql_select_db($database_Leave, $Leave);
$query_hodapp = sprintf("SELECT Leave_id, empid, empname, desig, department, rcl, rscl, rel, leave_type, from_date, to_date, app_date, no_days, reason, leave_status FROM leave_page WHERE Leave_id = %s", GetSQLValueString($colname_hodapp, "int"));
$hodapp = mysql_query($query_hodapp, $Leave) or die(mysql_error());
$row_hodapp = mysql_fetch_assoc($hodapp);
$totalRows_hodapp = mysql_num_rows($hodapp);
?>
<html>
<head>
<title>The Leave</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="../login/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript">
function sum() {
 
 var status = document.getElementById('status').value;
 var type = document.getElementById('leave_type').value;
 var cl = document.getElementById('cl').value;
 var scl = document.getElementById('scl').value;
 var el = document.getElementById('el').value;
 var no = document.getElementById('no').value;
 if(type == "cl")
 {
 if(status == "apporved")
 {
 var ans = +cl - +no;
document.sums.cl.value = ans;
 }
}
if(type == "scl")
 {
 if(status == "apporved")
 {
 var ans = +scl - +no;
document.sums.scl.value = ans;
 }
}
if(type == "el")
 {
 if(status == "apporved")
 {
 var ans = +el - +no;
document.sums.el.value = ans;
 }
}
}

</script>

</head>
<body>
<form method="POST" action="<?php echo $editFormAction; ?>" name="sums" class="smart-green">

<h1 align="center">The Leave Page</h1>
<label>
<span>Employe Id</span>
<input name="empid" type="text" required placeholder="Empid" value="<?php echo $row_hodapp['empid']; ?>">
</label>

<label>
<span>Employe Name</span>
<input name="empname" type="text" required placeholder="Employee Name" value="<?php echo $row_hodapp['empname']; ?>">
</label>

<label>
<span>Designation</span>
<input name="design" type="text" required placeholder="Designation" value="<?php echo $row_hodapp['desig']; ?>">
</label>

<label>
<span>Department</span> 
<input name="Dep" type="text" required Placeholder="Department" value="<?php echo $row_hodapp['department']; ?>">
</label>


<label>
<span>Remaining CL:</span>
<input type="text" name="cl" id="cl" value="<?php echo $row_hodapp['rcl']; ?>"/>
</label>

<label>
<span>Remaining SCL:</span>
<input type="text" name="scl" id="scl" value="<?php echo $row_hodapp['rscl']; ?>"/>
</label>

<label>
<span>Remaining EL</span>
<input type="text" name="el" id="el" value="<?php echo $row_hodapp['rel']; ?>"/>
</label>

<label>
<span>Leave Type</span>
<input type="text" name="type" id="leave_type" value="<?php echo $row_hodapp['leave_type']; ?>">
</label>

<label>
<span>From Date:</span>
<input name="from_date" type="text" required id="from_date" placeholder="From Date" value="<?php echo $row_hodapp['from_date']; ?>">
</label>

<label>
<span>TO Date:</span>
<input name="to_date" type="text" required id="to_date" placeholder="To Date" value="<?php echo $row_hodapp['to_date']; ?>">
</label>

<label>
<span>Applied Date:</span>
<input name="applied_date" type="text" required id="applied_date" placeholder="Applied Date" value="<?php echo $row_hodapp['app_date']; ?>">
</label>

<label>
<span>Number of Days:</span>
<input type="text" name="no" id="no" value="<?php echo $row_hodapp['no_days']; ?>"/>
</label>

 <label>
<span>Reason:</span>
<textarea name="reason_text" cols="40" rows="5" required><?php echo $row_hodapp['reason']; ?></textarea>
</label>

<label>Status</label>
<select name="status" id="status" onChange="sum()" >
  <option value="pending" <?php if (!(strcmp("pending", $row_hodapp['leave_status']))) {echo "selected=\"selected\"";} ?>>Pending</option>
  <option value="apporved" <?php if (!(strcmp("apporved", $row_hodapp['leave_status']))) {echo "selected=\"selected\"";} ?>>Aporved</option>
  <option value="declined"  <?php if (!(strcmp("declined", $row_hodapp['leave_status']))) {echo "selected=\"selected\"";} ?>>Declined</option>
</select>


<input type="submit" name="submit" value="submit" class="button">
<input name="Leave_id" type="hidden" id="Leave_id" value="<?php echo $row_hodapp['Leave_id']; ?>">
<input type="hidden" name="MM_update" value="sums">
</form>
</body>
</html>
<?php
mysql_free_result($hodapp);
?>
