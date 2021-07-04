<?php
// creating and connecting to the database

$servername="localhost";
$username="root";
$password="";
$db="chatroom";

$conn=mysqli_connect($servername,$username,$password,$db);

// checking whether the database is created 
if(!$conn){
    die("database is not created".mysqli_connect_error());
}

?>