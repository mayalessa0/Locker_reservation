<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=us-ascii"><meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Employee Home</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

	<style>
	table, td, th {
	  border: 1px solid black;
	}

	table {
	  border-collapse: collapse;
		width: 90%;
	  height: 50px;
text-align: center;
font-family:Arial, Helvetica, sans-serif;font-size:20px;
margin-left:80px;
	}

	th {
	  text-align: center;
		background-color: #d7f3f4;
	}

	</style>
</head>
<body>
	<body style="background-color:white;">
			<div style="
			border-bottom: 3px solid #4f7778;
			background-color: #c1d6d7;
			padding-right: 1%;

			position: fixed;
			width: 100%;">
			<div><img alt="" src="/Locker_reservation/logo.png" style="width: 6%; height: 10%; float: right; margin-right: 3%;"/></div>
				<h3 style=" padding-left: 2%;color:#005e61;font-size:30px;font-family:Arial, Helvetica, sans-serif;"> Locker Reservation System</h3>
				<div style="width:100%; text-align:center; background-color:#7CA2A8;font-family:Arial, Helvetica, sans-serif;font-size:23px; padding-bottom: 10px; padding-top:5px;">
					<a style="margin-right:30px;color:black;"href="employee_home.html"> <i class="fa fa-home"></i>  Home</a>
					<a style="margin-right:30px;color:black;"class="active" href="#"> <i class="fa fa-lock"></i>   Reservations</a>
					<a style="margin-right:30px;color:black;"href="message.php"> <i class="fa fa-envelope"></i>   Messages </a>


				</div>
			</div>
<!-- Page Content -->
&nbsp;

<table border='1'style="margin-top: 10%;" >
	  <tr>
	    <th>Locker ID</th>
		<th>Student ID</th>
		<th>Rent Period</th>
		<th>Status</th>
		<th>*</th>
		<th>*</th>
	  </tr>

	<?php
	session_start();
	include('server.php');
	$result = mysqli_query($con,"SELECT * FROM `reservation`");

	while($row = mysqli_fetch_array($result))
	{
		$rser_id = $row['id'];
		$locker_id = $row['locker_id'];
		$student_id = $row['student_id'];
		$period = $row['period'];
		$status = $row['status'];
		$passcode = $row['passcode'];

		echo "<tr>";
		echo "<td>" . $locker_id . "</td>";
		echo "<td>" . $student_id  . "</td>";
		echo "<td>" . $period . "</td>";
		echo "<td>" . $status . "</td>";?>

		<td><a href='print_reservation.php?rser_id=<?php echo $rser_id ?>&locker_id=<?php echo $locker_id ?>&student_id=<?php echo $student_id ?>&period=<?php echo $period ?>&status=<?php echo $status ?>&passcode=<?php echo $passcode ?>'>Print </a></td>

		<td><a href='confirm_reservation.php?rser_id=<?php echo $rser_id ?>&locker_id=<?php echo $locker_id ?>&student_id=<?php echo $student_id ?>'>Confirm </a></td>

		</tr>
		<?php
	}
	echo "</table>";
	mysqli_close($con);
	?>


</body>
</html>
