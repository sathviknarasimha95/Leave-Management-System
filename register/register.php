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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "Register")) {
  $insertSQL = sprintf("INSERT INTO leave_login (username, password, first_name, last_name, email) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['firstname'], "text"),
                       GetSQLValueString($_POST['lastname'], "text"),
                       GetSQLValueString($_POST['email'], "text"));

  mysql_select_db($database_Leave, $Leave);
  $Result1 = mysql_query($insertSQL, $Leave) or die(mysql_error());

  $insertGoTo = "../index.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>codeplus</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript">
	window.onload = function(){
		document.body.style.zoom = "110%";	}
</script>
</head>
<body>
<form action="<?php echo $editFormAction; ?>" method="POST" name="Register">

<div id="login" align="center">
<a href="../index.html">Home</a>
<h1>Register page</h1>
<p>Username</p>
<input name="username" type="text" required placeholder="Username">
<br>
<label>First Name</label>
<input name="firstname" type="text" required placeholder="">
<label>Last name Name</label>
<input name="lastname" type="text" required placeholder="">

<p>Password</p>
<input name="password" type="password" required placeholder="Password">
<p>Email</p>
<input name="email" type="email" required placeholder="email">

<br><br><br>
<input type="submit" name="submit" id="submit" class="button">
</div>
<input type="hidden" name="MM_insert" value="Register">
</form>
</body>
</html>