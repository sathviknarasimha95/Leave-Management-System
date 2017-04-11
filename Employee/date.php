<?php require_once('../Connections/Leave.php'); ?>
<br>
<?php include('../includes/headeruser.php');?> 
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

mysql_select_db($database_Leave, $Leave);
$query_empid = "SELECT Leave_id, empid, empname FROM leave_page";
$empid = mysql_query($query_empid, $Leave) or die(mysql_error());
$row_empid = mysql_fetch_assoc($empid);
$totalRows_empid = mysql_num_rows($empid);
?>

<br>
<br>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<link href="../includes/css/bootstrap.min.css" rel="stylesheet">
    <link href="../includes/css/style.css" rel="stylesheet">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style2.css">
<title>Search by Date</title>
</head>

<body>




<form action="bydatefac.php" name="bydatefac" method="get" class="smart-green" >

<h1 align="center">Search By Date</h1>
<label>Date</label>

<input name="from_date" type="text" id="from_date"/>
<input name="empid" type="hidden" id="empid" value="<?php echo $row_empid['empid']; ?>"/>
<p align="center">
<br>
<input  align="center" type="submit" name="submit" value="submit" class="button" />
</p>

</form>

</body>
</html>
<?php
mysql_free_result($empid);

// Turn off all error reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
?>