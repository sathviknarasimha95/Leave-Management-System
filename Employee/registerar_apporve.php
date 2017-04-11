<?php require_once('../Connections/Leave.php'); ?>
<?php include('../includes/headerregisterar.php'); ?>
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

$maxRows_app_registerar = 100;
$pageNum_app_registerar = 0;
if (isset($_GET['pageNum_app_registerar'])) {
  $pageNum_app_registerar = $_GET['pageNum_app_registerar'];
}
$startRow_app_registerar = $pageNum_app_registerar * $maxRows_app_registerar;

mysql_select_db($database_Leave, $Leave);
$query_app_registerar = "SELECT Leave_id, empid, empname, desig, department, leave_type, from_date, to_date, app_date, no_days, reason, leave_status, Approved_principal, Approved_registerar FROM leave_page";
$query_limit_app_registerar = sprintf("%s LIMIT %d, %d", $query_app_registerar, $startRow_app_registerar, $maxRows_app_registerar);
$app_registerar = mysql_query($query_limit_app_registerar, $Leave) or die(mysql_error());
$row_app_registerar = mysql_fetch_assoc($app_registerar);

if (isset($_GET['totalRows_app_registerar'])) {
  $totalRows_app_registerar = $_GET['totalRows_app_registerar'];
} else {
  $all_app_registerar = mysql_query($query_app_registerar);
  $totalRows_app_registerar = mysql_num_rows($all_app_registerar);
}
$totalPages_app_registerar = ceil($totalRows_app_registerar/$maxRows_app_registerar)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="../login/css/bootstrap.min.css" rel="stylesheet">
<title>Registerar Home</title>
</head>

<body>
<h1 align="center">Welcome to VVIET Registerar Pannel</h1>
<table border="1" align="center" class="gridtable">

  <tr>
    <th>Leave_id</th>
    <th>empid</th>
    <th>empname</th>
    <th>desig</th>
    <th>department</th>
    <th>leave_type</th>
    <th>from_date</th>
    <th>to_date</th>
    <th>app_date</th>
    <th>no_days</th>
    <th>reason</th>
    <th>HOD Status</th>
    <th>Principal Status</th>
    <th>Registerar Status</th>
    <th>Approve</th>
    <th>Decline</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_app_registerar['Leave_id']; ?></td>
      <td><?php echo $row_app_registerar['empid']; ?></td>
      <td><?php echo $row_app_registerar['empname']; ?></td>
      <td><?php echo $row_app_registerar['desig']; ?></td>
      <td><?php echo $row_app_registerar['department']; ?></td>
      <td><?php echo $row_app_registerar['leave_type']; ?></td>
      <td><?php echo $row_app_registerar['from_date']; ?></td>
      <td><?php echo $row_app_registerar['to_date']; ?></td>
      <td><?php echo $row_app_registerar['app_date']; ?></td>
      <td><?php echo $row_app_registerar['no_days']; ?></td>
      <td><?php echo $row_app_registerar['reason']; ?></td>
      <td><?php echo $row_app_registerar['leave_status']; ?></td>
      <td><?php echo $row_app_registerar['Approved_principal']; ?></td>
      <td><?php echo $row_app_registerar['Approved_registerar']; ?></td>
      <td><a href="registerarapp.php?Leave_id=<?php echo $row_app_registerar['Leave_id']; ?>">Apporve</a></td>
      <td><a href="registeraradec.php?Leave_id=<?php echo $row_app_registerar['Leave_id']; ?>">Decline</a></td>
    </tr>
    <?php } while ($row_app_registerar = mysql_fetch_assoc($app_registerar)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($app_registerar);
?>
