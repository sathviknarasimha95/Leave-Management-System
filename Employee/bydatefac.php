<?php require_once('../Connections/Leave.php'); ?>
<?php include('../includes/headeruser1.php');?> 



<?php include('date.php');?> 
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

$maxRows_date = 10;
$pageNum_date = 0;
if (isset($_GET['pageNum_date'])) {
  $pageNum_date = $_GET['pageNum_date'];
}
$startRow_date = $pageNum_date * $maxRows_date;

$colname_date = "-1";
if (isset($_GET['from_date'])) {
  $colname_date = $_GET['from_date'];
  
}
$colname_empid = "-1";
if (isset($_GET['empid'])) {
  $colname_empid = $_GET['empid'];
  
}
mysql_select_db($database_Leave, $Leave);
$query_date = sprintf("SELECT Leave_id, empid, empname, desig, department, leave_type, from_date, to_date, app_date, no_days, leave_status, Approved_principal, Approved_registerar FROM leave_page WHERE from_date = %s AND empid = %s", GetSQLValueString($colname_date, "text"),GetSQLValueString($colname_empid, "text"));
$query_limit_date = sprintf("%s LIMIT %d, %d", $query_date, $startRow_date, $maxRows_date);
$date = mysql_query($query_limit_date, $Leave) or die(mysql_error());
$row_date = mysql_fetch_assoc($date);

if (isset($_GET['totalRows_date'])) {
  $totalRows_date = $_GET['totalRows_date'];
} else {
  $all_date = mysql_query($query_date);
  $totalRows_date = mysql_num_rows($all_date);
}
$totalPages_date = ceil($totalRows_date/$maxRows_date)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style2.css">
<link href="../includes/css/bootstrap.min.css" rel="stylesheet">
    <link href="../includes/css/style.css" rel="stylesheet">
<title>Date</title>
</head>

<body>
<table border="1" class="gridtable" align="center">
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
    <th>leave_status</th>
    <th>Approved_principal</th>
    <th>Approved_registerar</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_date['Leave_id']; ?></td>
      <td><?php echo $row_date['empid']; ?></td>
      <td><?php echo $row_date['empname']; ?></td>
      <td><?php echo $row_date['desig']; ?></td>
      <td><?php echo $row_date['department']; ?></td>
      <td><?php echo $row_date['leave_type']; ?></td>
      <td><?php echo $row_date['from_date']; ?></td>
      <td><?php echo $row_date['to_date']; ?></td>
      <td><?php echo $row_date['app_date']; ?></td>
      <td><?php echo $row_date['no_days']; ?></td>
      <td><?php echo $row_date['leave_status']; ?></td>
      <td><?php echo $row_date['Approved_principal']; ?></td>
      <td><?php echo $row_date['Approved_registerar']; ?></td>
    </tr>
    <?php } while ($row_date = mysql_fetch_assoc($date)); ?>
</table>

</body>
</html>
<?php
mysql_free_result($date);
?>

