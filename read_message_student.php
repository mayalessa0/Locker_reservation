<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
	<title>Read Message</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
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

	</style>

</head>

<body>
  <div style="
  border-bottom: 3px solid #4f7778;
  background-color: #c1d6d7;
  padding-right: 1%;
  position: fixed;
  width: 100%;">
  <div><img alt="" src="/Locker_reservation/logo.png" style="width: 6%; height: 10%; float: right; margin-right: 3%;"/></div>
    <h3 style=" padding-left: 2%;color:#005e61;font-size:30px;font-family:Arial, Helvetica, sans-serif;"> Locker Reservation System</h3>
    <div style="width:100%; text-align:center; background-color:#7CA2A8;font-family:Arial, Helvetica, sans-serif;font-size:23px; padding-bottom: 10px; padding-top:5px;">
      <a style="margin-right:30px;color:black;"href="student_home.html"> <i class="fa fa-home"></i>  Home</a>
      <a style="margin-right:30px;color:black;" href="book_locker.php"> <i class="fa fa-lock"></i>   Reservations</a>
      <a style="margin-right:30px;color:black;"href="student_message.php"> <i class="fa fa-envelope"></i>   Messages </a>


    </div>
  </div>
&nbsp;
<div style="margin-top:10%;">
<?php
session_start();
if (isset($_GET['message_id'])) {
  	$msg_id = $_GET['message_id'];
  	include('server.php');
	$result = mysqli_query($con,"SELECT * FROM `Message`WHERE `id`='$msg_id'");

	if($row = mysqli_fetch_array($result))
	{
		$sender_id = $row['sender_id'];
		$receiver_id = $row['receiver_id'];
		$subject = $row['subject'];
		$datetime = $row['date/ time'];
		$content = $row['content'];
	}

	mysqli_close($con);
  }


?>

<p>From: <?php echo $sender_id ?></p>

<p>To: <?php echo $receiver_id ?></p>

<p>Date/ Time: <?php echo $datetime ?></p>

<p>Content: <?php echo $content ?></p>

<p>
    <button type="button" onclick="location.href='send_message.php?to=<?php echo $sender_id ?>&subject=<?php echo $subject?>'">Reply</button>

</p>
</div>
</body>
</html>
