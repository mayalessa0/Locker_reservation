
<!DOCTYPE html>
<html>
<head><meta charset="utf-8">
	<title>Select The Locker</title>
	<style type="text/css">

table {
  border-collapse: collapse;

}



td{
   height:100px;
   width: 90px;
   text-align:center;
}

button {

  width: 10%;
  height: 10px;
   border: none;
}
body  {
  background-image: url("background3.PNG");
 background-size:100%;

}
</style>
</head>
<body>


<div>
<?php

include('server.php');
$floor = $_GET['floor'];
$block = $_GET['block'];
$line = 1;
echo "<p style='color:#005e61;font-size:25px;font-family:Arial, Helvetica, sans-serif; '> <b>Your Locker will be in floor $floor at Block $block, Please choose one of the following avaliable lockers:</b></p>";


while($line<=5)
{
    echo "<table border='1' style='float: left;'>";
    echo "<tr>";
    echo "<th>$line</th>";
    echo "</tr>";
    $result = mysqli_query($con,"SELECT `id`,`status` FROM `Locker` WHERE `floor`='$floor' AND `block`='$block' AND `line`='$line'");

	while($row = mysqli_fetch_array($result))
	{
		$locker_id = $row['id'];
		switch($row['status']){
		    case "available":{
		        $color = "#F6DDCC";//pige
		        $go_to_payment = "payment.php?locker_id=".$locker_id;
		        break;
		    }
		    case"reserved":{
		        $color = "#DF2D1C";//red
		        $go_to_payment="";
		        break;

		    }
		    case "out of order":{
		        $color = "#27AE60";//green
		        $go_to_payment="";
		        break;
		    }

		}
		echo "<tr>";
		echo "<td style='background-color: $color;'><a href='$go_to_payment'>". $floor."-".$block."-".$locker_id . "</a></td>";?>
		</tr>
		<?php
	}
	$line ++;
}
echo "</table>";
mysqli_close($con);


?>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<div>
    <button style="background-color:#F6DDCC;"></button>
    Avialable
    </div>
	<div> <button style="background-color:#DF2D1C"></button>
	Reserved</div>
	<div> <button style="background-color:#27AE60"></button>
	Out of order</div>




</body>
</html>
