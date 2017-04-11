<?php require_once('../Connections/Leave.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "emp_update")) {
  $updateSQL = sprintf("UPDATE emp_info SET first_name=%s, last_name=%s, doj=%s, desig=%s, department=%s, cl=%s, scl=%s, el=%s WHERE emp_id=%s",
                       GetSQLValueString($_POST['First_name'], "text"),
                       GetSQLValueString($_POST['Last_name'], "text"),
                       GetSQLValueString($_POST['doj'], "text"),
                       GetSQLValueString($_POST['designation'], "text"),
                       GetSQLValueString($_POST['department'], "text"),
                       GetSQLValueString($_POST['cl'], "int"),
                       GetSQLValueString($_POST['scl'], "int"),
                       GetSQLValueString($_POST['el'], "int"),
                       GetSQLValueString($_POST['emp_id'], "text"));

  mysql_select_db($database_Leave, $Leave);
  $Result1 = mysql_query($updateSQL, $Leave) or die(mysql_error());

  $updateGoTo = "editemploye.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_update_emp = "-1";
if (isset($_GET['emp_id'])) {
  $colname_update_emp = $_GET['emp_id'];
}
mysql_select_db($database_Leave, $Leave);
$query_update_emp = sprintf("SELECT emp_id, first_name, last_name, doj, desig, department, cl, scl, el FROM emp_info WHERE emp_id = %s", GetSQLValueString($colname_update_emp, "text"));
$update_emp = mysql_query($query_update_emp, $Leave) or die(mysql_error());
$row_update_emp = mysql_fetch_assoc($update_emp);
$totalRows_update_emp = mysql_num_rows($update_emp);
?>
<?php include('../includes/headeradmin.php'); ?>
<html>
<head>
<title>Leave</title>
<link rel="stylesheet" type="text/css" href="css/style1.css">
<link href="../login/css/bootstrap.min.css" rel="stylesheet">
<link href="../login/css/style.css" rel="stylesheet">
</head>
<body>
<form action="<?php echo $editFormAction; ?>" name="emp_update" method="POST" class="smart-green">
<a href="editemploye.php">Back</a>

<h1 align="center">Update Employee Details
	<span>Update faculty details here</span>
	</h1>
<label>
<span>First Name:</span>
<input name="First_name" type="text"  placeholder="First name" value="<?php echo $row_update_emp['first_name']; ?>">
</label>

<label>
<span>Last Name:</span>
<input name="Last_name" type="text"  placeholder="Last name" value="<?php echo $row_update_emp['last_name']; ?>">
</label>

<label>
<span>Faculty Id:</span>
<input name="id" type="text"  placeholder="ID" value="<?php echo $row_update_emp['emp_id']; ?>">
</label>

<label>
<span>Date of Joining:</span>
<input name="doj" type="text" placeholder="DOJ" value="<?php echo $row_update_emp['doj']; ?>">
</label>

<label>
<span>Designation:</span>
<input name="designation" type="text"  placeholder="Designation" value="<?php echo $row_update_emp['desig']; ?>">
</label>

<label>
<span>Department:</span>
<input name="department" type="text"  placeholder="Department" value="<?php echo $row_update_emp['department']; ?>">
</label>

<label>
<span>Total Cl:</span>
<input name="cl" type="text"  placeholder="CL" value="<?php echo $row_update_emp['cl']; ?>">
</label>

<label>
<span>Total SCL:</span>
<input name="scl" type="text"  placeholder="SCL" value="<?php echo $row_update_emp['scl']; ?>">
</label>

<label>
<span>Total EL:</span>
<input name="el" type="text" required placeholder="EL" value="<?php echo $row_update_emp['el']; ?>">
</label>

<label>
<span>&nbsp;</span>
<input type="submit" class="button" value="submit"><input name="emp_id" type="hidden" id="emp_id" value="<?php echo $row_update_emp['emp_id']; ?>">
</label>
<input type="hidden" name="MM_update" value="emp_update">
</form>
</body>
</htm>
<?php
mysql_free_result($update_emp);
?>
l>