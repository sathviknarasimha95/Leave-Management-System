<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Leave = "localhost";
$database_Leave = "leave_managment";
$username_Leave = "root";
$password_Leave = "";
$Leave = mysql_pconnect($hostname_Leave, $username_Leave, $password_Leave) or trigger_error(mysql_error(),E_USER_ERROR); 
?>