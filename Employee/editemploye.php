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

$maxRows_Recordset1 = 100;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_Leave, $Leave);
$query_Recordset1 = "SELECT emp_id, first_name, last_name, doj, desig, department FROM emp_info ORDER BY emp_id ASC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $Leave) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
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
<form action="" name="Edit_emp"  method="post" class="smart-green">
<br>

<a href="../login/adminhome.php">Back</a>

<h1 align="center">Edit Employee List
	<span>Edit The Employee List</span>
	</h1>
	<br>
	<br>
	<br>
	<br>
	

	<table border="1" align="center" class="gridtable">
	  <tr>
	    <th>Emp ID</th>
	    <th>First Name</th>
	    <th>Last Name</th>
	    <th>DOJ</th>
	    <th>Designation</th>
	    <th>Department</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
	  <?php do { ?>
	    <tr>
	      <td><?php echo $row_Recordset1['emp_id']; ?></td>
	      <td><?php echo $row_Recordset1['first_name']; ?></td>
	      <td><?php echo $row_Recordset1['last_name']; ?></td>
	      <td><?php echo $row_Recordset1['doj']; ?></td>
	      <td><?php echo $row_Recordset1['desig']; ?></td>
	      <td><?php echo $row_Recordset1['department']; ?></td>
          <td><a href="update_emp.php?emp_id=<?php echo $row_Recordset1['emp_id']; ?>">Edit</a></td>
          <td><a href="emp_delete.php?emp_id=<?php echo $row_Recordset1['emp_id']; ?>">Delete</a></td>
      </tr>
	    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
>