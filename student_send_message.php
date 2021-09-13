<!DOCTYPE html>
<html>

<head>
    <title>Send Message</title>
    <link rel="stylesheet" type="text/css" href="send_Message.css">
</head>
<body>


<div class="imgcontainer">
    <img src="logo.png" alt="Avatar" class="avatar">
</div>

<?php
session_start();
if (!isset ($_SESSION['user_email'])){
    echo '<script type="text/javascript">
        alert("Your session terminated, please login again");
        window.location.href = "login.html";
         </script>'; 	}
else{
    $sender = $_SESSION['user_email'];
    include('server.php');
    $result = mysqli_query($con,"SELECT * FROM `User`WHERE `email`='$sender'");

	$row = mysqli_fetch_array($result);
	$sender_id = $row['id'];

    if ( isset($_GET['to'] ) && isset( $_GET['subject'] ) ) {
      	$receiver = $_GET['to'];
      	$subject = "Re: ".$_GET['subject'];

    }
    else{
        $receiver = "";
      	$subject = "";
    }

}


?>

<form  method="get" action="student_send_function.php">


    <div class="input-group">

        <label for="from"><b>from</b></label>
        <input type="text" placeholder="Enter sender id" name="from" id="from" value ="<?php echo $sender_id?>" required>



        <label for="to"><b>Employee ID</b></label><br>
        <select style="width: 15%;" name="to" id="to" required>
            <option value="<?php echo $receiver=12345;?>">12345</option>
            <option value="<?php echo $receiver=23456;?>">23456</option>

        </select>
        <br>



        <label for="subject"><b>Subject</b></label>
        <input type="text" placeholder="Enter subject" name="subject" value ="<?php echo $subject?>"required>

        <label for="content"><b>Content</b></label>
        <textarea name="content" placeholder="Type your message content" rows="10" cols="50"></textarea>


       <button style="background-color: #00858a;" type="submit">Send</button>




</body>
</html>
