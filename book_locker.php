	<?php
	session_start();

	if (isset ($_SESSION['user_email']))
	{
	    $user_email= $_SESSION['user_email'];
	}
	else{
	     echo '<script type="text/javascript">
            alert("Your session terminated, please login again");
            window.location.href = "login.html";
             </script>';
	}
	include('server.php');

	$check_query = mysqli_query($con,"SELECT * FROM `reservation` WHERE `student_id`=(SELECT `id` FROM `User` WHERE `email`='$user_email')");


	if (mysqli_num_rows($check_query) != 0) {
        echo '<script type="text/javascript">
            alert("You already had active reservation!! So you should select REBOOK option to proceed the booking process with your current locker");
            window.location.href = "student_home.html";
             </script>';

    }

    if ( isset($_GET['locker_id'] ) ) {
  	    $locker_id = $_GET['locker_id'];
  	    header("Location:payment.php?locker_id=".$locker_id);


    }
	;?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8">
	<title>Book A Locker</title>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
body {
	background-image: url("background1.PNG");
	background-size:100%;

}

</style>
</head>
<body>

	<div style="
	border-bottom: 3px solid #4f7778;
	background-color: #c1d6d7;

 position: fixed;
 width: 100%;">
 <div><img alt="" src="/Locker_reservation/logo.png" style="width: 6%; height: 10%; float: right;"/></div>
		<h3 style=" padding-left: 2%;color:#005e61;font-size:30px;font-family:Arial, Helvetica, sans-serif;"> Locker Reservation System</h3>
		<div style="width:100%; text-align:center; background-color:#7CA2A8;font-family:Arial, Helvetica, sans-serif;font-size:23px; padding-bottom: 10px; padding-top:5px;">
		    <a style="margin-right:30px;color:black;"href="student_home.html"> <i class="fa fa-home"></i>  Home</a>
		    <a style="margin-right:30px;color:black;"class="active" href="#"> <i class="fa fa-lock"></i>   Locker reservation</a>
		    <a style="margin-right:30px;color:black;"href="student_message.php"> <i class="fa fa-envelope"></i>   Support </a>

		</div>
</div>

	&nbsp;


<form action="" method="post" style="width:65%;   margin-top: 8%; margin-left:17%">
<p style="color:#005e61;font-size:30px;font-family:Arial, Helvetica, sans-serif; text-align: center;"><b>Please locate your preferred locker!</b></p>

<p style="color:#005e61;font-size:25px;font-family:Arial, Helvetica, sans-serif; text-align: center;">
    <label for="floor"><b>Floor</b></label>
    <select id ="floor" name="floor" onchange="change_floor()" required style="font-size: 20px; padding: 4px;">
        <option value=""></option>
        <option value="G">G</option>
        <option value="1">1</option>
        <option value="2">2</option>
    </select>
    <label for="block"><b>Block</b></label>
    <select id="block" name="block" onchange="change_block()" required style="font-size: 20px; padding: 4px;">
        <option value=""></option>
        <option value="A">A</option>
        <option value="B">B</option>
    </select>
</p>


<p style="text-align: center;">
    <img class="map" src="/Locker_reservation/G-floor.png" style=" margin-right: 20px;border: 2px solid;" id="G-floor"/>
    <img class="map" src="/Locker_reservation/1-floor.png"style=" margin-right: 20px;border: 2px solid;" id="1-floor"/>
    <img class="map" src="/Locker_reservation/2-floor.png" style=" margin-right: 20px;border: 2px solid;"id="2-floor"/>
</p>



<script>
function change_floor() {


    var floor = document.getElementById("floor").value;
    switch (floor) {
        case "G":{
        document.getElementById("G-floor").src = "/Locker_reservation/G-floor.png";
        document.getElementById("1-floor").src = "";
        document.getElementById("2-floor").src = "";
        break;}
        case "1":{
        document.getElementById("G-floor").src = "";
        document.getElementById("1-floor").src = "/Locker_reservation/1-floor.png";
        document.getElementById("2-floor").src = "";
        break;}
        case "2":{
        document.getElementById("G-floor").src = "";
        document.getElementById("1-floor").src = "";
        document.getElementById("2-floor").src = "/Locker_reservation/2-floor.png";
        break;
        }
    }
}

function change_block() {


    var floor = document.getElementById("floor").value;
    var block = document.getElementById("block").value;


    switch (floor) {
        case "G":{
            switch (block) {
                case "A":{
                    document.getElementById("G-floor").src = "/Locker_reservation/G-Block1.png";

                    window.open("get_locker.php?floor=G&block=A","_parent", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");


                    break;

                }
                case "B":{
                    document.getElementById("G-floor").src = "/Locker_reservation/G-Block2.png";
                    window.open("get_locker.php?floor=G&block=B","_parent", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
                    break;

                }
            }
        break;

        }
        case "1":{
        switch (block) {
                case "A":{
                    document.getElementById("1-floor").src = "/Locker_reservation/1-Block1.png";
                    window.open("get_locker.php?floor=1&block=A","_parent", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
                    break;

                }
                case "B":{
                    document.getElementById("1-floor").src = "/Locker_reservation/1-Block2.png";
                    window.open("get_locker.php?floor=1&block=B","_parent", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
                    break;

                }
            }
        break;

        }
        case "2":{
        switch (block) {
                case "A":{
                    document.getElementById("2-floor").src = "/Locker_reservation/2-Block1.png";
                    window.open("get_locker.php?floor=2&block=A","_parent", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
                    break;

                }
                case "B":{
                    document.getElementById("2-floor").src = "/Locker_reservation/2-Block2.png";
                    window.open("get_locker.php?floor=2&block=B","_parent", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
                    break;

                }
            }
        break;
        }
    }
}


</script>

</form>

</body>
</html>
