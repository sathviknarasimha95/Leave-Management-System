
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "Leave_page")) {
  $insertSQL = sprintf("INSERT INTO leave_page (empid, empname, desig, department, rcl, rscl, rel, leave_type, from_date, to_date, app_date, no_days, reason, leave_status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['empid'], "text"),
                       GetSQLValueString($_POST['empname'], "text"),
                       GetSQLValueString($_POST['design'], "text"),
                       GetSQLValueString($_POST['Dep'], "text"),
                       GetSQLValueString($_POST['rcl'], "int"),
                       GetSQLValueString($_POST['rscl'], "int"),
                       GetSQLValueString($_POST['rel'], "int"),
                       GetSQLValueString($_POST['leave'], "text"),
                       GetSQLValueString($_POST['from_date'], "text"),
                       GetSQLValueString($_POST['to_date'], "text"),
                       GetSQLValueString($_POST['applied_date'], "text"),
                       GetSQLValueString($_POST['no_days'], "int"),
                       GetSQLValueString($_POST['reason_text'], "text"),
                       GetSQLValueString($_POST['status'], "text"));

  mysql_select_db($database_Leave, $Leave);
  $Result1 = mysql_query($insertSQL, $Leave) or die(mysql_error());

  $insertGoTo = "../login/userhome.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_leave_page = "-1";
if (isset($_GET['emp_id'])) {
  $colname_leave_page = $_GET['emp_id'];
}
mysql_select_db($database_Leave, $Leave);
$query_leave_page = sprintf("SELECT * FROM emp_info WHERE emp_id = %s", GetSQLValueString($colname_leave_page, "text"));
$leave_page = mysql_query($query_leave_page, $Leave) or die(mysql_error());
$row_leave_page = mysql_fetch_assoc($leave_page);
$totalRows_leave_page = mysql_num_rows($leave_page);

?>
<?php include('../includes/headeruser.php'); ?>

<html>
<head>
<title>Leave</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="jquery-ui.css">
<link href="../login/css/bootstrap.min.css" rel="stylesheet">
    <link href="../login/css/style.css" rel="stylesheet">
  <script src="jquery-1.10.2.js"></script>
  <script src="jquery-ui.js"></script>
  
  <script>
  
  
 $(document).ready(function() {
  $( "#from_date" ).datepicker({
	dateFormat: "dd-mm-yy",
    altField: "#alternate",
    altFormat: "DD, d MM, yy",
    minDate: new Date(),
    maxDate: "+60D",
    onSelect: function(selected) {
      $("#").datepicker("option","minDate", selected);
      calcDiff();
    }
  });

  $( "#to_date" ).datepicker({
	  dateFormat: "dd-mm-yy",
    altField: "#alternate1",
    altFormat: "DD, d MM, yy",
    minDate: new Date(),
    maxDate:"+60D",
    onSelect: function(selected) {
      $("#from_date").datepicker("option","maxDate", selected);
      calcDiff();
    }
  });
   $( "#applied_date" ).datepicker({
	  dateFormat: "dd-mm-yy",
    altField: "#alternate1",
    altFormat: "DD, d MM, yy",
    //minDate: new Date( (new Date()).getTime() + 86400000 ),
    maxDate:"+60D",
    onSelect: function(selected) {
      $("#from").datepicker("option","maxDate", selected);
      calcDiff();
    }
  });

  function calcDiff() {
    var date1 = $('#from_date').datepicker('getDate');
    var date2 = $('#to_date').datepicker('getDate');
    var diff = 0;
    
   if (date1 && date2) {
      diff = Math.floor((date2.getTime() - date1.getTime()) / 86400000)+1; 
    }
    $('#no_days').val(diff);
  }
});


  </script>
  
</head>
<body>


<br>
<br>
<br>
<br>
<form action="<?php echo $editFormAction; ?>" method="POST" name="Leave_page" class="smart-green">
<a href="../login/userhome.php">Back</a>
<h1 align="center">Employee Details</h1>
<label>
<span>Employe Id</span>
<input name="empid" type="text"  required placeholder="Empid" value="<?php echo $row_leave_page['emp_id']; ?>" readonly>
</label>

<label>
<span>Employe Name</span>
<input name="empname" type="text" required placeholder="Employee Name" value="<?php echo $row_leave_page['first_name']; ?>"readonly>
</label>

<label>
<span>Designation</span>
<input name="design" type="text" required placeholder="Designation" value="<?php echo $row_leave_page['desig']; ?>"readonly>
</label>

<label>
<span>Department</span> 
<input name="Dep" type="text"  required Placeholder="Department" value="<?php echo $row_leave_page['department']; ?>"readonly>

</label>

<br>
<br>
<br>

    <h1 align="center">Leave Application </h2>
    <br>
    <br>
   <label>
<span>Remaining CL</span> 
<input name="rcl" type="text"  required value="<?php echo $row_leave_page['cl']; ?>"readonly>
</label>
<label>
<span>Remaining SCL</span> 
<input name="rscl" type="text"  required value="<?php echo $row_leave_page['scl']; ?>"readonly>
</label>
<label>
<span>Remaining EL</span> 
<input name="rel" type="text"  required value="<?php echo $row_leave_page['el']; ?>"readonly>
</label>
    <br>
    <br>
    <label>Leave type:</label>
    <select name="leave" >
      <option value="cl">Casual Leave</option>
      <option value="el">Earn Leave</option>
      <option value="scl">OOD/SCL</option>
      <option value="LOP">LOP</option>
      
    </select>
    
    
    
    <label>
    <span>From Date:</span>
    <input name="from_date" type="text" required id="from_date" placeholder="From Date">
    </label>
    <label>
    <span>TO Date:</span>
    <input name="to_date" type="text" required id="to_date" placeholder="To Date">
    </label>
    <label>
    <span>Applied Date:</span>
    <input name="applied_date" type="text" required id="applied_date" placeholder="Applied Date">
    </label>
    
    <label>
    <span>Number of Days:</span>
    <input name="no_days" type="text" required id="no_days" placeholder="Number of days">
    </label>
    <label>
    
    <br>
    <label>
    <span>Reason:</span>
    <textarea name="reason_text" cols="40" rows="5" required></textarea>
    </span>
    <label>Leave Status</label>
    <select name="status">
      <option value="pending" >Pending</option>
      <option value="apporved">Apporved</option>
      <option value="Decline">Decline</option>
    </select>
  <br>
    <br>
  <input name="emp_id" type="hidden" id="emp_id" value="<?php echo $row_leave_page['emp_id']; ?>">
  <br>
  <p align="center">

  <input type="submit" name="submit" value="submit" class="button">
</p>
<br>
<input type="hidden" name="MM_insert" value="Leave_page">
</div>
 
</form>   
</body>
</html>
<?php
mysql_free_result($leave_page);
?>
