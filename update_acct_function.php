<?php
include('server.php');


$ID = $_POST['ID'];
$password= $_POST['password'];
$email= $_POST['email'];
$name= $_POST['name'];
$phone= $_POST['phone'];

$validation_query = "SELECT * FROM `User` WHERE `email`='$email' AND NOT `id`='$ID'";
    
$result1 = mysqli_query($con, $validation_query);

if (mysqli_num_rows($result1) != 0) { 
    echo '<script type="text/javascript">
        alert("Your updated email is already taken by another user !!");
        window.location.href = "update_account.php";
         </script>'; 

}else{
    
    if(isset($_FILES['image'])&& !empty( $_FILES["image"]["name"] )){
            
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
            $update_user_query = "UPDATE `User` SET `password`='$password',`email`='$email' WHERE `id`='$ID'";
            if (mysqli_query($con,$update_user_query))
             { 
            	
            	
            	$update_std_query = "UPDATE `Student` SET `name`='$name',`phone_number`='$phone',`card_student_picture`='$image_dirction' WHERE `id`='$ID'";
            	
                if (mysqli_query($con,$update_std_query))
                { 
            	    mysqli_close($con);
            	    $_SESSION['user_email'] = $email;                                     
                	echo '<script>';
                    echo 'window.location.href = "student_home.html";';
                    echo 'alert("Your account has been updated")';
                    echo '</script>';
                }
                
            
            }
        }
        else{
            print_r($errors);
        }
    }else{
        $update_user_query = "UPDATE `User` SET `password`='$password',`email`='$email' WHERE `id`='$ID'";
        if (mysqli_query($con,$update_user_query))
         { 
        	$_SESSION['user_email'] = $email;                   
            $update_std_query = "UPDATE `Student` SET `name`='$name',`phone_number`='$phone' WHERE `id`='$ID'";
        	
            if (mysqli_query($con,$update_std_query))
            { 
        	    mysqli_close($con);
            	echo '<script>';
                echo 'window.location.href = "student_home.html";';
                echo 'alert("Your account has been updated")';
                echo '</script>';
            }
            
        
        }
    }
            
}



    
    
?>
    
    