<?php
include('server.php');


$id = $_GET['locker_id'];
$student_id = $_GET['student_id'];
$duration= $_GET['duration'];
$passcode= $_GET['passcode'];
$card_number= $_GET['card_number'];
$card_holder= $_GET['card_holder'];
$card_expiry_date= $_GET['card_expiry_date'];
$CVVCVC= $_GET['CVVCVC'];
$IBAN = $_GET['IBAN'];


//To get next AUTO_INCREMENT key
$sql = "SELECT  `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA =  'locker_reservation' AND TABLE_NAME =  'reservation'";
$result = mysqli_query($con,$sql);
$res = mysqli_fetch_array($result, MYSQLI_ASSOC);
$reser_id = $res["AUTO_INCREMENT"];

$insert_reservation = "INSERT INTO `reservation`(`locker_id`, `student_id`, `passcode`, `period`) VALUES ('$id','$student_id','$passcode','$duration')";




if (mysqli_query($con,$insert_reservation)) //check if record is inserted
{
    	$insert_payment = "INSERT INTO `Payment`(`reservation_id`, `card_number`, `card_holder`, `card_expiry_date`, `CVV/CVC`, `IBAN`) VALUES ('$reser_id','$card_number','$card_holder','$card_expiry_date','$CVVCVC','$IBAN')";
    
    	if (mysqli_query($con,$insert_payment)) //check if record is inserted
    	{
              $update_locker_status = "UPDATE `Locker` SET `status`='reserved' WHERE `id`='$id'";
              if (mysqli_query($con,$update_locker_status)) //check if status has been updated to 'reserved'
              {
                  mysqli_close($con);
                  echo '<script>';
                  echo 'window.location.href = "student_home.html";';
                  echo 'alert("Your reservation has been initiated, you will be able to us it after get confirmation through your email")';
                  echo '</script>';
              }
              
         }

}


?>
