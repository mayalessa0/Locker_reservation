<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=us-ascii"><meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Message</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="employee_home.css">
	<style>
	table, td, th {
	  border: 1px solid black;
	}

	table {
	  border-collapse: collapse;
	  width: 90%;
	 height: 100px;

	}

	th {
	  text-align: center;
		background-color: #d7f3f4;

	}
	body  {
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
				<a style="margin-right:30px;color:black;"href="book_locker.php"> <i class="fa fa-lock"></i>   Locker reservation</a>
				<a style="margin-right:30px;color:black;"href="#"> <i class="fa fa-envelope"></i>   Support </a>

		</div>
	</div>
&nbsp;


<!-- Page Content -->
<table border='1' style="margin-top: 10%;" >
	  <tr>
	    <th>From</th>
		<th>Subject</th>
		<th>Date / time</th>
		<th>messege</th>
	  </tr>

	<?php
	session_start();
	$user_email= $_SESSION['user_email'];
	include('server.php');
	$result = mysqli_query($con,"SELECT * FROM `Message` WHERE `receiver_id`=(SELECT `id` FROM `User` WHERE `email`='$user_email')");

	while($row = mysqli_fetch_array($result))
	{
		$message_id = $row['id'];
		echo "<tr>";
		echo "<td>" . $row['sender_id'] . "</td>";
		echo "<td>" . $row['subject'] . "</td>";
		echo "<td>" . $row['date/ time'] . "</td>";?>
		<td><a href='read_message_student.php?message_id=<?php echo $message_id ?>'>Open </a></td>
		</tr>
		<?php
	}
	echo "</table>";
	mysqli_close($con);
	?>
	<!--insert horizantil line -->
	<hr style="width:80%">
	<br>
	<a href="student_send_message.php"><button class="btn" style="background-color: #00858a;">New Message</button></a>



</body>
</html>
