
<?php require_once('../Connections/Leave.php'); ?>
<?php include('../includes/headerprincipal.php'); ?>
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

mysql_select_db($database_Leave, $Leave);
$query_principal_apporve = "SELECT Leave_id, empid, empname, desig, department, rcl, rscl, rel, leave_type, from_date, to_date, app_date, no_days, reason, leave_status, Approved_principal FROM leave_page";
$principal_apporve = mysql_query($query_principal_apporve, $Leave) or die(mysql_error());
$row_principal_apporve = mysql_fetch_assoc($principal_apporve);
$totalRows_principal_apporve = mysql_num_rows($principal_apporve);
$query_principal_apporve = "SELECT Leave_id, empid, empname, desig, department, rcl, rscl, rel, leave_type, from_date, to_date, app_date, no_days, reason, leave_status, Approved_principal FROM leave_page";
$principal_apporve = mysql_query($query_principal_apporve, $Leave) or die(mysql_error());
$row_principal_apporve = mysql_fetch_assoc($principal_apporve);
$totalRows_principal_apporve = mysql_num_rows($principal_apporve);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="../login/css/bootstrap.min.css" rel="stylesheet">
<title>Principal Home</title>
</head>

<body>
<h1 align="center">Welcome to VVIET Principal Pannel</h1> 
<table border="1" align="center" class="gridtable" >
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
    <th>leave_status</th>
    <th>Approved_principal</th>
    <th>Approve</th>
    <th>Decline</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_principal_apporve['Leave_id']; ?></td>
      <td><?php echo $row_principal_apporve['empid']; ?></td>
      <td><?php echo $row_principal_apporve['empname']; ?></td>
      <td><?php echo $row_principal_apporve['desig']; ?></td>
      <td><?php echo $row_principal_apporve['department']; ?></td>
      
      <td><?php echo $row_principal_apporve['leave_type']; ?></td>
      <td><?php echo $row_principal_apporve['from_date']; ?></td>
      <td><?php echo $row_principal_apporve['to_date']; ?></td>
      <td><?php echo $row_principal_apporve['app_date']; ?></td>
      <td><?php echo $row_principal_apporve['no_days']; ?></td>
      <td><?php echo $row_principal_apporve['reason']; ?></td>
      <td><?php echo $row_principal_apporve['leave_status']; ?></td>
      <td><?php echo $row_principal_apporve['Approved_principal']; ?></td>
      <td><a href="principalapp.php?Leave_id=<?php echo $row_principal_apporve['Leave_id']; ?>">Approve</a></td>
      <td><a href="principaldec.php?Leave_id=<?php echo $row_principal_apporve['Leave_id']; ?>">Decline</a></td>
    </tr>
    <?php } while ($row_principal_apporve = mysql_fetch_assoc($principal_apporve)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($principal_apporve);
?>
