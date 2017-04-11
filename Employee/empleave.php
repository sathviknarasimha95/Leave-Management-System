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

$maxRows_emp_leave = 100000;
$pageNum_emp_leave = 0;
if (isset($_GET['pageNum_emp_leave'])) {
  $pageNum_emp_leave = $_GET['pageNum_emp_leave'];
}
$startRow_emp_leave = $pageNum_emp_leave * $maxRows_emp_leave;

$colname_emp_leave = "-1";
if (isset($_GET['leave_status'])) {
  $colname_emp_leave = $_GET['leave_status'];
}
mysql_select_db($database_Leave, $Leave);
$query_emp_leave = sprintf("SELECT Leave_id, empid, empname, desig, department, leave_type, from_date, to_date, app_date, reason, leave_status FROM leave_page WHERE leave_status = %s ORDER BY Leave_id DESC", GetSQLValueString($colname_emp_leave, "text"));
$query_limit_emp_leave = sprintf("%s LIMIT %d, %d", $query_emp_leave, $startRow_emp_leave, $maxRows_emp_leave);
$emp_leave = mysql_query($query_limit_emp_leave, $Leave) or die(mysql_error());
$row_emp_leave = mysql_fetch_assoc($emp_leave);

if (isset($_GET['totalRows_emp_leave'])) {
  $totalRows_emp_leave = $_GET['totalRows_emp_leave'];
} else {
  $all_emp_leave = mysql_query($query_emp_leave);
  $totalRows_emp_leave = mysql_num_rows($all_emp_leave);
}
$totalPages_emp_leave = ceil($totalRows_emp_leave/$maxRows_emp_leave)-1;
?>
<?php include('../includes/headerhod.php'); ?>

<html>
<head>
<title>Leave</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="../login/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form action="" method="post" class="smart-green">

<h1 align="center">Employee Leave info
	<span>The Leave of Employee is Shown here</span>
	</h1>
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
        <th>Applided Date</th>
        <th>Reason</th>
        <th>Leave Status</th>
  </tr>
      <?php do { ?>
        <tr>
          <td><?php echo $row_emp_leave['Leave_id']; ?></td>
          <td><?php echo $row_emp_leave['empid']; ?></td>
          <td><?php echo $row_emp_leave['empname']; ?></td>
          <td><?php echo $row_emp_leave['desig']; ?></td>
          <td><?php echo $row_emp_leave['department']; ?></td>
          <td><?php echo $row_emp_leave['leave_type']; ?></td>
          <td><?php echo $row_emp_leave['from_date']; ?></td>
          <td><?php echo $row_emp_leave['to_date']; ?></td>
          <td><?php echo $row_emp_leave['app_date']; ?></td>
          <td><?php echo $row_emp_leave['reason']; ?></td>
          <td><?php echo $row_emp_leave['leave_status']; ?></td>
        </tr>
        <?php } while ($row_emp_leave = mysql_fetch_assoc($emp_leave)); ?>
  </table>
</body>
</html>
<?php
mysql_free_result($emp_leave);
?>
