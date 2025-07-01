<?php
$server = "localhost";
$username = "u639500956_employees";
$password = "eMp12345";
$database = "u639500956_employee";
$connection = mysqli_connect("$server","$username","$password");
$select_db = mysqli_select_db($connection, $database);
if(!$select_db)
{
	echo("connection terminated");
}
?>