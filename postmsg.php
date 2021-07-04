<?php
include "db_connect.php";
// saving all the argumenst in variables.
$room=$_POST['room'];
$msg=$_POST['text'];
$ip=$_POST['ip'];
// insert those value into mgs database.
$sql="INSERT INTO `mgs` ( `msg`, `room`, `mtime`,`ip`) VALUES ('$msg', '$room', current_timestamp(),'$ip');";
mysqli_query($conn,$sql);
mysqli_close($conn);

?>