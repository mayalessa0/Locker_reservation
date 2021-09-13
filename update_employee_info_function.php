<?php
include('server.php');


$name= $_POST['name'];
$ID = $_POST['ID'];
$password= $_POST['password'];
$email= $_POST['email'];


$validation_query = "SELECT * FROM `User` WHERE `email`='$email' AND NOT `id`='$ID'";

$result1 = mysqli_query($con, $validation_query);

if (mysqli_num_rows($result1) != 0) {
    echo '<script type="text/javascript">
        alert("Your updated email is already taken by another user !!");
        window.location.href = "employeeinfo.php";
         </script>';

}else

        $update_user_query = "UPDATE `User` SET `password`='$password',`email`='$email' WHERE `id`='$ID'";
        if (mysqli_query($con,$update_user_query))
         {
        	$_SESSION['user_email'] = $email;

            if (mysqli_query($con,$update_emp_query))
            {
        	    mysqli_close($con);
              $_SESSION['user_email'] = $email;
            	echo '<script>';
                echo 'window.location.href = "employee_home.html";';
                echo 'alert("Your account has been updated")';
                echo '</script>';
            }


        }


?>
