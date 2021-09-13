
<!DOCTYPE html>
<html>
    
<head>
    <script src="jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="login.css">

</head>

<body>
    <div id="snackbar"><strong>Email has been sent:</strong>please check your inbox.</div>
    
    
    <?php
    session_start();
    
    require "server.php";
    
    // define variables from user input
    $email = mysqli_real_escape_string($con, $_POST['registered_email']);;

    
        
    $get_password = "SELECT `password` FROM `User` WHERE `email`='$email'";
    
    //run the query
    $result = mysqli_query($con, $get_password);
    
    if (mysqli_num_rows($result) == 0) { 
        
        // in case that user enter incorrect data, show error message through javascript
        echo '<script type="text/javascript">
            alert("Failed, Please make sure that you entered your email correctly");
            window.location.href = "login.html";
             </script>'; 
    
    }else{// check if there is result
    
        // fetch result
        $user_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        // get element by his tag
        $user_password= $user_info["password"];
        
        //send email contiens password ///
        // the message
        $msg = "Dear,\n\n\nThis email sent based on your request to retrieve your password.\n\n" 
        . "Your password is: ".$user_password;
        
        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);
        
        // send email
        mail($email,"Retrieve Password",$msg);

        
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
            
            // move to login page by javascript
            echo '<script type="text/javascript">
                window.setTimeout(function() {
                window.location.href="login.html"; }, 2000);
                </script>';
        
    }
    ?>
</body>
</html>