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

$maxRows_Leave_status = 10;
$pageNum_Leave_status = 0;
if (isset($_GET['pageNum_Leave_status'])) {
  $pageNum_Leave_status = $_GET['pageNum_Leave_status'];
}
$startRow_Leave_status = $pageNum_Leave_status * $maxRows_Leave_status;

$colname_Leave_status = "1";
if (isset($_GET['empid'])) {
  $colname_Leave_status = $_GET['empid'];
}
mysql_select_db($database_Leave, $Leave);
$query_Leave_status = sprintf("SELECT Leave_id, empid, empname, desig, department, leave_type, from_date, to_date, app_date, no_days, leave_status, Approved_principal, Approved_registerar FROM leave_page WHERE empid = %s ORDER BY Leave_id DESC", GetSQLValueString($colname_Leave_status, "text"));
$query_limit_Leave_status = sprintf("%s LIMIT %d, %d", $query_Leave_status, $startRow_Leave_status, $maxRows_Leave_status);
$Leave_status = mysql_query($query_limit_Leave_status, $Leave) or die(mysql_error());
$row_Leave_status = mysql_fetch_assoc($Leave_status);

if (isset($_GET['totalRows_Leave_status'])) {
  $totalRows_Leave_status = $_GET['totalRows_Leave_status'];
} else {
  $all_Leave_status = mysql_query($query_Leave_status);
  $totalRows_Leave_status = mysql_num_rows($all_Leave_status);
}
$totalPages_Leave_status = ceil($totalRows_Leave_status/$maxRows_Leave_status)-1;
include('../includes/headeruser.php'); 
?>

<html>
<head>
<title>Leave</title>
<link rel="stylesheet" type="text/css" href="css/style1.css">
<link href="../login/css/bootstrap.min.css" rel="stylesheet">
<link href="../login/css/style.css" rel="stylesheet">
</head>


<body>
<form action="" method="post" class="smart-green">
<br>
<br>
<h1 align="center">Status of Leave
	<span>The Status of Leave is Shown here</span>
	</h1>

<br>

	<br>
	
    <table border="1" align="center" class="gridtable">
      <tr>
        <th>Leave id</th>
        <th>Emp Id</th>
        <th>Name</th>
        <th>Designation</th>
        <th>Department</th>
        <th>Leave Type</th>
        <th>From Date</th>
        <th>To Date</th>
        <th>Applied Date</th>
        <th>Number of Days</th>
        <th>HOD Status</th>
        <th>Principal Status</th>
        <th>Registerar Status</th>
        <th>Report</th>
      </tr>
      <?php do { ?>
        <tr>
          <td><?php echo $row_Leave_status['Leave_id']; ?></td>
          <td><?php echo $row_Leave_status['empid']; ?></td>
          <td><?php echo $row_Leave_status['empname']; ?></td>
          <td><?php echo $row_Leave_status['desig']; ?></td>
          <td><?php echo $row_Leave_status['department']; ?></td>
          <td><?php echo $row_Leave_status['leave_type']; ?></td>
          <td><?php echo $row_Leave_status['from_date']; ?></td>
          <td><?php echo $row_Leave_status['to_date']; ?></td>
          <td><?php echo $row_Leave_status['app_date']; ?></td>
          <td><?php echo $row_Leave_status['no_days']; ?></td>
          <td><?php echo $row_Leave_status['leave_status']; ?></td>
          <td><?php echo $row_Leave_status['Approved_principal']; ?></td>
          <td><?php echo $row_Leave_status['Approved_registerar']; ?></td>
          <td><a href="../Report/report.php?Leave_id=<?php echo $row_Leave_status['Leave_id']; ?>">Report</a></td>
          
        </tr>
        <?php } while ($row_Leave_status = mysql_fetch_assoc($Leave_status)); ?>
    </table>
    <br>
    
    <p align="center">
    <a href="date.php">Search By Date</a>
    </p>
    <br>
    <br>
</body>
</html>
<?php
mysql_free_result($Leave_status);
?>
