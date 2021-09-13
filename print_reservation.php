<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
	<title>Show Reservation</title>

	<style type="text/css">
	p  {
        border: 2px solid #00858a;
        font-family: courier;
        background-color: white;
        width:40%;
        margin: 0px auto;
        padding: 30px;

    }
    button {
      background-color: #00858a;
      color: white;
      padding: 14px 20px;
      width: 100%;
      border: none;
      border-radius: 5px;
      cursor: pointer;

    }
    h1{
        text-align: center;

    }
	</style>

</head>

<body>
<h1><img alt="" src="/Locker_reservation/logo.png" style="width: 120px; height: 120px;" /></h1>

<?php
session_start();
if (isset($_GET['rser_id']) && isset($_GET['locker_id']) && isset($_GET['student_id']) && isset($_GET['period']) && isset($_GET['status'])&& isset($_GET['passcode'])) {

	$id = $_GET['rser_id'];
	$locker_id = $_GET['locker_id'];
	$student_id = $_GET['student_id'];
	$period = $_GET['period'];
	$status = $_GET['status'];
	$passcode = $_GET['passcode'];


  }


?>

<p><b>Reservation ID:</b> <?php echo $id ?></p>

<p><b>Locker ID:</b> <?php echo $locker_id ?></p>

<p><b>Student Owner ID:</b> <?php echo $student_id ?></p>

<p><b>Ownership Period:</b> <?php echo $period ?></p>

<p><b>Reservation Status:</b> <?php echo $status ?></p>

<p><b>Locker Passcode:</b> <?php echo $passcode ?></p>


<p>
    <button type="button" onclick="window.print()">Print</button>

</p>
</body>
</html>
