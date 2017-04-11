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

$maxRows_req_leave = 10000000;
$pageNum_req_leave = 0;
if (isset($_GET['pageNum_req_leave'])) {
  $pageNum_req_leave = $_GET['pageNum_req_leave'];
}
$startRow_req_leave = $pageNum_req_leave * $maxRows_req_leave;

mysql_select_db($database_Leave, $Leave);
$query_req_leave = "SELECT Leave_id, empid, empname, desig, department, leave_type, from_date, to_date, app_date, no_days, reason, leave_status FROM leave_page ORDER BY Leave_id DESC";
$query_limit_req_leave = sprintf("%s LIMIT %d, %d", $query_req_leave, $startRow_req_leave, $maxRows_req_leave);
$req_leave = mysql_query($query_limit_req_leave, $Leave) or die(mysql_error());
$row_req_leave = mysql_fetch_assoc($req_leave);

if (isset($_GET['totalRows_req_leave'])) {
  $totalRows_req_leave = $_GET['totalRows_req_leave'];
} else {
  $all_req_leave = mysql_query($query_req_leave);
  $totalRows_req_leave = mysql_num_rows($all_req_leave);
}
$totalPages_req_leave = ceil($totalRows_req_leave/$maxRows_req_leave)-1;
?>

<html>
<head>
<title>Leave</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/style1.css">
<link href="../login/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form action="" method="post" class="smart-green">
<h1 align="center">List of Requisted Leave
	<span>The list of requisted Leave are shown here</span>
	</h1>
	<br>
	<br>
	<br>
	<br>
	<br>
	
<table border="1" align="center" class="gridtable">
      <tr>
        <th>Leave Id</th>
        <th>Emp Id</th>
        <th>Name</th>
        <th>Designation</th>
        <th>Department</th>
        <th>Leave Type</th>
        <th>From Date</th>
        <th>To Date</th>
        <th>Applied Date</th>
        <th>Number of Days</th>
        <th>Reason</th>
        <th>Leave_Status</th>
        <th>Approve/Decline</th>
      </tr>
      <?php do { ?>
        <tr>
          <td><?php echo $row_req_leave['Leave_id']; ?></td>
          <td><?php echo $row_req_leave['empid']; ?></td>
          <td><?php echo $row_req_leave['empname']; ?></td>
          <td><?php echo $row_req_leave['desig']; ?></td>
          <td><?php echo $row_req_leave['department']; ?></td>
          <td><?php echo $row_req_leave['leave_type']; ?></td>
          <td><?php echo $row_req_leave['from_date']; ?></td>
          <td><?php echo $row_req_leave['to_date']; ?></td>
          <td><?php echo $row_req_leave['app_date']; ?></td>
          <td><?php echo $row_req_leave['no_days']; ?></td>
          <td><?php echo $row_req_leave['reason']; ?></td>
          <td><?php echo $row_req_leave['leave_status']; ?></td>
          <td><a href="hodapporved.php?Leave_id=<?php echo $row_req_leave['Leave_id']; ?>">Approve/Decline</a></td>
        </tr>
        <?php } while ($row_req_leave = mysql_fetch_assoc($req_leave)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($req_leave);
?>
