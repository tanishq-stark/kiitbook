<?php
ob_start();//Turns on output buffer
session_start();
$timezone= date_default_timezone_set("Indian/Maldives");

$conn=mysqli_connect("localhost","tanishq","mondal","kiitbook");
if(mysqli_connect_errno())
{
	echo "ERROR in database connection".mysqli_connect_errno();
}
 ?>