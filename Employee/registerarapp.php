<?php
include('../Connections/Leave.php');

mysql_query("UPDATE leave_page SET Approved_registerar='Approve' where Leave_id='$_GET[Leave_id]'");
header("location: registerar_apporve.php");
?>