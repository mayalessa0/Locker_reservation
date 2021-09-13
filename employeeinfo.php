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
$empid_id = $result1['id'];
$password = $result1['password'];

$get_emplyee_info_query = "SELECT * FROM `Employee` WHERE `id`='$empid_id'";

$run_query2 = mysqli_query($con,$get_emplyee_info_query);
$result2 = mysqli_fetch_array($run_query2);
$name = $result2['name'];

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

    <form  action="update_employee_info_function.php" method="post" enctype="multipart/form-data">


        <div class="input-group">

          <label for="name"><b>Full Name</b></label>
          <input type="text" name="name" value="<?php echo $name ?>" required>

            <label for="ID"><b>Employee ID</b></label>
            <input type="text" name="ID" value="<?php echo $empid_id ?>" required>

            <label for="password"><b>Password</b></label>
            <input type="text"  name="password" value="<?php echo $password ?>" required>

            <label for="email"><b>Email</b></label>
            <input type="text"  name="email" value="<?php echo $user_email ?>" required>

            <button type="submit">Save And Update</button>
        </div>


    </form>
</body>
</html>
