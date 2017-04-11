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

$colname_credit_leave = "1";
if (isset($_GET['emp_id'])) {
  $colname_credit_leave = $_GET['emp_id'];
}
mysql_select_db($database_Leave, $Leave);
$query_credit_leave = sprintf("SELECT emp_id, first_name, cl, scl, el FROM emp_info WHERE emp_id = %s", GetSQLValueString($colname_credit_leave, "text"));
$credit_leave = mysql_query($query_credit_leave, $Leave) or die(mysql_error());
$row_credit_leave = mysql_fetch_assoc($credit_leave);
$totalRows_credit_leave = mysql_num_rows($credit_leave);
?>
<?php include('../includes/headeruser.php'); ?>
<html>
<head>
<title>Leave</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="../login/css/bootstrap.min.css" rel="stylesheet">
<link href="../login/css/style.css" rel="stylesheet">
</head>
<body>
<form action="" method="post" class="smart-green">
<br>
  <br>
  
<h1 align="center">Credit of Leave
	<span>Number of remaining leaves are shown here</span>
	</h1>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
<label>Emp Id:</label>
 <input name="emp_id" type="text" value="<?php echo $row_credit_leave['emp_id']; ?>"readonly/>
 <br>
<label>Name:</label>
<input name="ename" type="text" value="<?php echo $row_credit_leave['first_name']; ?>"readonly/>
<br>
<label>Number of CL:</label>
<input name="rcl" type="text" value="<?php echo $row_credit_leave['cl']; ?>"readonly/>
<br>
<label>Number of SCL:</label>
<input name="rscl" type="text" value="<?php echo $row_credit_leave['scl']; ?>"readonly/>
<br>
<label>Number of EL:</label>
<input name="rel" type="text" value="<?php echo $row_credit_leave['el']; ?>"readonly/>
<br>
<p align="center">
<a href="../login/userhome.php">
Back</a>
</p>
<input name="emp_id" type="hidden" id="emp_id" value="<?php echo $row_credit_leave['emp_id']; ?>">
</form>
</body>
</html>
<?php
mysql_free_result($credit_leave);
?>
