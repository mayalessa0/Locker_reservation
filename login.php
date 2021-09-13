
<!DOCTYPE html>
<html>
    
<head>
    <script src="jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="login.css">

</head>

<body>
    <div id="snackbar"><strong>Successful login:</strong> Welcome to Locker Reservation system.</div>

    
    <?php
    session_start();
    
    require "server.php";
    
    // define variables from user input
    $email = mysqli_real_escape_string($con, $_POST['email']);;
    $password = mysqli_real_escape_string($con, $_POST['psw']);;
    
    
        
    $validation_query = "SELECT * FROM `User` WHERE `email`='$email' AND `password` = '$password'";
    
    //run the query
    $result1 = mysqli_query($con, $validation_query);
    
    if (mysqli_num_rows($result1) == 0) { 
        
        // in case that user enter incorrect data, show error message through javascript
        echo '<script type="text/javascript">
            alert("Failed Login, Please ensure that email or password entered correctly");
            window.location.href = "login.html";
             </script>'; 
    
    }else{// check if there is result
    
        // fetch result
        $user_info = mysqli_fetch_array($result1, MYSQLI_ASSOC);
        
        // get element by his tag
        $user_type= $user_info["type"];
        
        // defined varaible that hold registered user email
        $_SESSION['user_email'] = $user_info["email"];
        // defined varaible that hold registered user type
        $_SESSION['user_type'] = $user_type;
        
        // show successed login message by javascript
        echo 
           '<script type="text/javascript">
            $( document ).ready(function() {
                myFunction();
            });
            function myFunction() {
                var x = document.getElementById("snackbar");
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    
      
            }
            </script>';
            
        if ($user_type == "student"){
            // move to student home page by javascript
            echo '<script type="text/javascript">
                window.setTimeout(function() {
                window.location.href="student_home.html"; }, 2000);
                </script>';
    
        }
        
        if ($user_type == "employee"){
            // move to student home page by javascript
            echo '<script type="text/javascript">
                window.setTimeout(function() {
                window.location.href="employee_home.html"; }, 2000);
                </script>';
            
        }
    }
    ?>


</body>
</html>
