
<!DOCTYPE html>
<html>
    
<head>
    <script src="jquery-3.5.1.min.js"></script>
<style>
    #snackbar {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #B53471;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 45%;
    bottom: 30px;
    font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
</style>
</head>

<body>
    <?php
session_start();
	
  	$rser_id = $_GET['rser_id'];
    $locker_id = $_GET['locker_id'];
  	$student_id = $_GET['student_id'];

?>
    <div id="snackbar"><strong>This Reservation with locker id ( <?php echo $locker_id ?> ) has been confirmed for student id :</strong><?php echo $student_id ?> .</div>
    
    
<?php

    require "server.php";
        
    $update_status = "UPDATE `reservation` SET `status`='confirmed' WHERE `id`='$rser_id'";
    mysqli_query($con,$update_status);
  
    
    if(mysqli_affected_rows($con) >0 ) { 
        
        $result = mysqli_query($con,"SELECT `email` FROM `User` WHERE `id`='$student_id'");
        $row = mysqli_fetch_array($result);
        $email = $row['email'];
  
        
        //content of message
        $msg = "Dear Student,\n\nCongratulation, Your reservation locker has been confirmed.\n\nYou can start use it from this moment until the due date according your selected period rent";
        
        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);
        
        // send email
        mail($email,"Confirmation Locker",$msg);

        
        
        echo 
           '<script type="text/javascript">
            $( document ).ready(function() {
                myFunction();
            });
            function myFunction() {
                var x = document.getElementById("snackbar");
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
    
      
            }
            </script>';
            
            echo '<script type="text/javascript">
                window.setTimeout(function() {
                window.location.href="reservation.php"; }, 5000);
                </script>';
                
    
    }else{
       
        echo '<script type="text/javascript">
            alert("Failed, This reservation has confirmed already.");
            window.location.href = "reservation.php";
             </script>'; 
    }
?>
</body>
</html>