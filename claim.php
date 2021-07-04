<?php

//getting the post variable

$room=$_POST['room'];

// checking whether the room name is valid
if(strlen($room)>20 or strlen($room)<2){
   
    $message="Name length is either less than 2 or greater than 20.";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom/";';
    echo '</script>';
}

// checking whether name is alphaneumeric or not
else if(!ctype_alnum($room) && $room>0){
    $message="Name must be alphaneumeric.";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom/";';
    echo '</script>';
}

else{
    // connecting to the database
    include "db_connect.php";
}
// checking whether the roomname we use already exist or not
$sql="SELECT * FROM `rooms` WHERE room_name='$room'";
$result=mysqli_query($conn,$sql);
if($result){
        if(mysqli_num_rows($result)>0){
            $message="Room name already exist";
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/chatroom/";'; 
            echo '</script>';
        }
        else{
            $sql="INSERT INTO `rooms` ( `room_name`, `rtime`) VALUES ( '$room', current_timestamp());";
            $result=mysqli_query($conn,$sql);
            if($result){
                 $message="Your room is ready and you can chat now";
                 echo '<script language="javascript">';
                 echo 'alert("'.$message.'");';
                //  sending the control to rooms.php
                 echo 'window.location="http://localhost/chatroom/rooms.php?roomname='.$room.'";';
                 echo '</script>';
                 exit();
                }
            }    
        }
        else{
            echo "error".mysqli_error($conn);
        }

?>