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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "emp_info")) {
  $insertSQL = sprintf("INSERT INTO emp_info (emp_id, first_name, last_name, username, password, doj, desig, department, `role`, cl, scl, el) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "text"),
                       GetSQLValueString($_POST['First_name'], "text"),
                       GetSQLValueString($_POST['Last_name'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['doj'], "text"),
                       GetSQLValueString($_POST['designation'], "text"),
                       GetSQLValueString($_POST['department'], "text"),
                       GetSQLValueString($_POST['role'], "text"),
                       GetSQLValueString($_POST['cl'], "int"),
                       GetSQLValueString($_POST['scl'], "int"),
                       GetSQLValueString($_POST['el'], "int"));

  mysql_select_db($database_Leave, $Leave);
  $Result1 = mysql_query($insertSQL, $Leave) or die(mysql_error());

  $insertGoTo = "../login/adminhome.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_Leave, $Leave);
$query_emp_info = "SELECT * FROM emp_info";
$emp_info = mysql_query($query_emp_info, $Leave) or die(mysql_error());
$row_emp_info = mysql_fetch_assoc($emp_info);
$totalRows_emp_info = mysql_num_rows($emp_info);
?>
<?php include('../includes/headeradmin.php'); ?>
<html>
<head>
<title>Leave</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="../login/css/bootstrap.min.css" rel="stylesheet">
<link href="../login/css/style.css" rel="stylesheet">
</head>
<body>
<form action="<?php echo $editFormAction; ?>" name="emp_info" method="POST" class="smart-green">

<h1 align="center">New Employee Application
	<span>Enter the faculty details here</span>
	</h1>
<label>
<span>First Name:</span>
<input type="text" name="First_name"  placeholder="First name">
</label>

<label>
<span>Last Name:</span>
<input type="text" name="Last_name"  placeholder="Last name">
</label>

<label>
<span>Faculty Id:</span>
<input type="text" name="id"  placeholder="ID">
</label>

<label>
<span>Date of Joining:</span>
<input type="text" name="doj" placeholder="DOJ">
</label>

<label>
<span>Designation:</span>
<input type="text" name="designation"  placeholder="Designation">
</label>

<label>
<span>Department:</span>
<input type="text" name="department"  placeholder="Department">
</label>

<label>
<span>Username:</span>
<input type="text" name="username"  placeholder="username">
</label>

<label>
<span>Password:</span>
<input type="text" name="password"  placeholder="password">
</label>

<label>
<span>Role</span>
<input type="text" name="role"  placeholder="role">
</label>


<label>
<span>Total Cl:</span>
<input type="text" name="cl"  placeholder="CL">
</label>

<label>
<span>Total SCL:</span>
<input type="text" name="scl"  placeholder="SCL">
</label>

<label>
<span>Total EL:</span>
<input type="text" name="el" required placeholder="EL">
</label>

<label>
<span>&nbsp;</span>
<input type="submit" class="button" value="submit">
</label>
<input type="hidden" name="MM_insert" value="emp_info">
</form>
</body>
</html>
<?php
mysql_free_result($emp_info);
?>
