<?php
    include('server.php');
    session_start();

    $content = $_GET['content'];
    $sender_id= $_GET['from'];
    $receiver= $_GET['to'];
    $subject= $_GET['subject'];
    $data_time = date("Y/m/d") . " " .date("h:i:sa");
    
    $insert_message_query = "INSERT INTO `Message`(`sender_id`, `receiver_id`, `subject`, `content`, `date/ time`) VALUES ('$sender_id','$receiver','$subject','$content','$data_time')";


	if (mysqli_query($con,$insert_message_query)) //check if record is inserted
  	{ 
		mysqli_close($con);
		if($_SESSION['user_type'] == "student"){
		    echo '<script>';
            echo 'window.location.href = "student_message.php";';
            echo 'alert("Your Message has been sent")';
            echo '</script>';
		}
		elseif($_SESSION['user_type']== "employee"){
		    echo '<script>';
            echo 'window.location.href = "message.php";';
            echo 'alert("Your Message has been sent")';
            echo '</script>';
		}                                 
    }
    
    
?>
    
    