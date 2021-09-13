<?php


//initialize variables
$server_name = "182.50.151.11";
$mysql_user = "l_r_user";
$mysql_pass = "l_r_password";
$db_name = "locker_reservation";

// connect to the database
$con = mysqli_connect($server_name, $mysql_user, $mysql_pass, $db_name);


//record error message if connection not succeed (error will recorded in error_log file at the same directory)
if(!$con){
    error_log("Unable to connect to the database.", 0);
}

?>