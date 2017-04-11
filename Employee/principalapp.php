
<?php
include('../Connections/Leave.php');

mysql_query("UPDATE leave_page SET Approved_principal='Approve' where Leave_id='$_GET[Leave_id]'");
header("location: principal_apporve.php");
?>