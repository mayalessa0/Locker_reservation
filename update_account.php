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
$get_user_info_query = "SELECT * FROM `User` WHERE `email`='$user_email'";

$run_query1 = mysqli_query($con,$get_user_info_query);
$result1 = mysqli_fetch_array($run_query1);
$std_id = $result1['id'];
$password = $result1['password'];

$get_std_info_query = "SELECT * FROM `Student` WHERE `id`='$std_id'";

$run_query2 = mysqli_query($con,$get_std_info_query);
$result2 = mysqli_fetch_array($run_query2);
$name = $result2['name'];
$phone_number= $result2['phone_number'];
$card_student_picture= $result2['card_student_picture'];

?>

<!DOCTYPE html>
<html>
    
<head>
    <title>Update Your Account</title>
    <link rel="stylesheet" type="text/css" href="login.css">


</head>
<body>

  
    <div class="imgcontainer">
        <img src="logo.png" alt="Avatar" class="avatar">
    </div>
    
    <form  action="update_acct_function.php" method="post" enctype="multipart/form-data">
        

        <div class="input-group">
            
            <label for="ID"><b>Student ID</b></label>
            <input type="text" name="ID" value="<?php echo $std_id ?>" required>
            
            <label for="password"><b>Password</b></label>
            <input type="text"  name="password" value="<?php echo $password ?>" required>
            
            <label for="email"><b>Email</b></label>
            <input type="text"  name="email" value="<?php echo $user_email ?>" required>
            
            <label for="name"><b>Full Name</b></label>
            <input type="text" name="name" value="<?php echo $name ?>" required>
            
            
            <label for="phone"><b>Phone number</b></label>
            <input type="text"  name="phone" value="<?php echo $phone_number ?>" required>
            
            <label for="image"><b>Student ID Card</b></label><br><br>
            <img src="<?php echo $card_student_picture ?>" alt="Avatar" class="avatar"><br><br>
            <label for="image" style="font-size:12px">Click on <u>Chooes File</u> to upload a new copy:</label><br><br>
            <input type="file" name="image" /><br><br>
            
        
            <button type="submit">Save And Update</button>
        </div>
        
       
    </form>
</body>
</html>