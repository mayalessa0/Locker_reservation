<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
     <link rel="stylesheet" type="text/css" href="login.css">
    <style>
    select{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    }


    </style>
</head>
<body>


<div class="imgcontainer">
    <img src="logo.png" alt="Avatar" class="avatar">
</div>

<?php

session_start();
if (!isset ($_SESSION['user_email']))
{
    echo '<script type="text/javascript">
        alert("Your session terminated, please login again");
        window.location.href = "login.html";
         </script>';
}
else{
    $owner_id= $_SESSION['user_email'];

    include('server.php');

    $get_student_id = mysqli_query($con,"SELECT `id` FROM `User` WHERE `email`='$owner_id'");
    $row = mysqli_fetch_array($get_student_id);
    $student_id = $row['id'];

    $check_query = mysqli_query($con,"SELECT * FROM `reservation` WHERE `student_id`='$student_id'");


    if (mysqli_num_rows($check_query) == 0 && !isset($_GET['locker_id'] )) {
        echo '<script type="text/javascript">
            alert("You should have initial or active reservation to access this page.You will be transferred to BOOK A NEW LOCKER page.");
            window.location.href = "book_locker.php";
             </script>';

    }
    if (mysqli_num_rows($check_query) != 0 ){
        $row = mysqli_fetch_array($check_query);
        $locker_id = $row['locker_id'];
    }
    if ( isset($_GET['locker_id'] ) ) {
  	    $locker_id = $_GET['locker_id'];

    }
}
?>

<form  method="get" action="payment_function.php">


    <div class="input-group">


        <label for="student_id"><b>Student ID</b></label>
        <input type="text"  name="student_id" value ="<?php echo $student_id?>"required>


        <label for="locker_id"><b>Locker ID</b></label>
        <input type="text"  name="locker_id" value ="<?php echo $locker_id?>"required>

        <label for="duration"><b>Duration of Rental</b></label><br>
        <select id ="duration" name="duration" onchange="set_duration" required>
            <option value="year">Year ---> 150 SAR</option>
            <option value="semester">Semester ---> 50 SAR</option>
            <option value="month">Month ---> 15 SAR</option>
        </select>


        <label for="passcode"><b>Locker Passcode</b></label>
            <input type="text" placeholder="Enter a locker passcode (must be 4 digit)" minlength="4"maxlength="4" name="passcode" id="passcode" required> <br><br>


         <label><u><b>Payment Information</b></u></label><br><br>


        <label for="card_number"><b>Card Number</b></label>
        <input type="text" placeholder="Enter the card number" name="card_number" minlength="16" maxlength="16"required>

        <label for="card_holder"><b>Card Holder</b></label>
        <input type="text" placeholder="Enter the card holder name as shown in the card" name="card_holder" required>

        <label for="card_expiry_date"><b>Card Expiry Date</b></label>
        <input type="text" placeholder="Enter the expiry date" name="card_expiry_date" maxlength="5"required>


        <label for="CVVCVC"><b>CVV/CVC</b></label>
        <input type="text" placeholder="Enter CVV/CVC (3 digit number behind your card)" minlength="3" maxlength="3"name="CVVCVC" required>

        <label for="IBAN"><b>IBAN</b></label>
        <input type="text" placeholder="Enter IBAN" name="IBAN" minlength="24" maxlength="24"required>

        <div class="container" style="background-color:#f1f1f1">
                    <input type="checkbox" id="agreement" name="agreement" value="agreement" required>
                    <label for="agreement" >I agree to the terms and the conditions of
                    <a href="contract_tearms.html" target="_blank">Locker Reservation Contract</a>.</label>
            </div>


        <button style="background-color: #00858a;"type="submit">Pay</button>

    </div>

</form>


</body>
</html>
