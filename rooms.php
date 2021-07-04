<?php
// storing the get parameter
$roomname=$_GET['roomname'];

// connecting to the database
include "db_connect.php";

// check whether the room alredy exist or not 
$sql="SELECT * FROM `rooms` WHERE room_name='$roomname'";
$result=mysqli_query($conn,$sql);
if($result){

if (mysqli_num_rows($result)==0){
    $message="Room does not exist. Try creating a new one";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom/";'; 
    echo '</script>';
}
else{
    
}
}
else{
    "Error : ".mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/product/">



<!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/product.css" rel="stylesheet">


<style>

body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
  height:427px;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyclass{
  height:400px;
  overflow-y:scroll;
}
</style>
</head>
<body>

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column bg-dark">
        <header class="mb-auto ">
            <div>
                <h3 class="float-md-start mb-0 text-light display-6">MyAnonymous Chat</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end display-7">
                    <a class="nav-link active text-light" aria-current="page" href="http://localhost/chatroom/">Home</a>
                    <a class="nav-link text-light" href="#">Features</a>
                    <a class="nav-link text-light" href="#">Contact</a>
                </nav>
            </div>
        </header>

    </div>

<h2>Chat Messages</h2>

<div class="container ">
<div class="anyclass">

  </div>
</div>

<!-- if the room does not exist then for the user message -->
<div >
<input type="text" class="form_control" name="usermsg" id="usermsg" placeholder="Ad Message" size=101><br>
</div>
<button type="submit" class="btn btn-primary my-2" name="submitmsg" id="submitmsg">Send</button>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
// check for new message every one second
setInterval(runFunction,1000);
function runFunction()
{
  $.post("htcont.php",{room:'<?php echo $roomname ?>'},
    function(data,status){
      document.getElementsByClassName('anyclass')[0].innerHTML=data; 
    }
  )
}

// pressing enter to send a message
var input = document.getElementById("usermsg");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("submitmsg").click();
  }
});
// sending the control to postmsg.php with several arguments like text,room and ip
  $("#submitmsg").click(function(){
    var clientmsg=$("#usermsg").val();
  $.post("postmsg.php", {text:clientmsg,room:'<?php echo $roomname ?>',ip: '<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
  function(data,status){
    document.getElementsByClassName('anyclass')[0].innerHTML = data;});
  $("#usermsg").val("");
  return false;
  
  });

</script>

</body>
</html>