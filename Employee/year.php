<?php
include('../Connections/Leave.php');

//$query =  "UPDATE `leave_managment`.`emp_info` SET `cl` = '15', `el` = '15',`scl` = `scl`+30;";
mysql_query($query);
echo $query;

?>