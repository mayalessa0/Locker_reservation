
<!DOCTYPE html>
<html>
    
<head>
    <script src="jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="login.css">

</head>

<body>
    <div id="snackbar"><strong>Successful Register:</strong> Welcome to Locker Reservation system.</div>

    
    <?php
    session_start();
    
    require "server.php";
    
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $id = mysqli_real_escape_string($con, $_POST['ID']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

    
        
    $validation_query = "SELECT * FROM `User` WHERE `email`='$email' AND `id` = '$id'";
    
    $result1 = mysqli_query($con, $validation_query);
    
    if (mysqli_num_rows($result1) != 0) { 
        echo '<script type="text/javascript">
            alert("Your ID or email are already registered !!");
            window.location.href = "register.html";
             </script>'; 
    
    }else{
    
        if(isset($_FILES['image'])){
            
            $file_name = time() . '_' .$_FILES['image']['name'];
            $image_dirction = "images/".$file_name;
      	    $errors= array();
            $file_size =$_FILES['image']['size'];
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
              
            $extensions= array("jpeg","jpg","png");
              
            if(in_array($file_ext,$extensions)=== false){
                 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
              
            if($file_size > 2097152){
                $errors[]='File size must be excately 2 MB';
            }
              
            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"images/".$file_name);
                
                $insert_user_info = "INSERT INTO `User`(`id`, `password`, `email`) VALUES ('$id','$password','$email')";
                $insert_student_info = "INSERT INTO `Student`(`id`, `name`, `phone_number`, `card_student_picture`) VALUES ('$id','$name','$phone','$image_dirction')";
        
                if (mysqli_query($con,$insert_user_info) && mysqli_query($con,$insert_student_info)) //check if record is inserted
      	        { 
                
                mysqli_close($con);
    		                                         
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
                
                echo '<script type="text/javascript">
                    window.setTimeout(function() {
                    window.location.href="student_home.html"; }, 2000);
                    </script>';
      	        }
            }else{
            
                print_r($errors);
            }
        }
    }
?>


</body>
</html>
