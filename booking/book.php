<?php
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Make booking</title>
</head>

<body>


<?php
// Captcha
/*if(empty($_SESSION['captcha'] ) ||
	strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0)
	{
		//Note: the captcha code is compared case insensitively.
		//if you want case sensitive match, update the check above to
		// strcmp()
		$errors = "<h3><font color=\"red\">Wrong code!</font></h3>";
		echo $errors;
	}
	*/
	if(empty($errors))
	{
		include 'config.php';
		
		// Create connection
		$conn = mysqli_connect($servername, $username, $password,  $dbname);
		
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
        
        
        
		$day =  intval(strtotime(htmlspecialchars($_POST["day"])));
		$time = htmlspecialchars($_POST["time"]);
		$username = $_SESSION['username'];
		$service = htmlspecialchars($_POST["service"]);
		
		//check capacity
        
        $sql2 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='$time' and day='$day' ";
         $count = mysqli_query($conn, $sql2);
         $row2 = mysqli_fetch_array($count);
        
        $sql3 = "SELECT * FROM $servicestb where title='$service' ";
       
        $count2 = mysqli_query($conn, $sql3);
        $row3=mysqli_fetch_array($count2);
        
       
        
        
        
        if ($row2[0]>=$row3['capacity']){
            echo '<h3><font color="red">Unfortunately ' . $service . ' is fully book for this time and date.</font></h3>';
            goto end;
        }
		
		// prevent double booking
		$sql = "SELECT * FROM $booktb WHERE service='$service' AND day=$day  AND canceled=0";
        
         $sql4 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='$time' and day='$day' and username='$username' ";
         $count4 = mysqli_query($conn, $sql4);
         $row4 = mysqli_fetch_array($count4);
        
        
        
        if($row4[0]>0){
            echo '<h3><font color="red">Unfortunately you booked an other service for this time and date.</font></h3>';
            goto end;
        }
        
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			// handle every row
			while($row = mysqli_fetch_assoc($result)) {
				// check overlapping at 10 minutes interval
				
					if ((($time==$row["time"])&&($service==$row["service"]))&&($row2[0]>=$row3['capacity'])) {
						echo '<h3><font color="red">Unfortunately ' . $service . ' has already been booked for the time requested.</font></h3>';
						goto end;
					}
				}
			}			
		
				
		$sql = "INSERT INTO $booktb (username, service, day, time, canceled)
			VALUES ('$username', '$service', '$day', '$time', 0)";
        
        
        
        
        
		if (mysqli_query($conn, $sql)) {
		   echo "<h3>Booking succeed.</h3>";
           $corday= date('m/d/Y',$day);
       
        
        $email=$_SESSION['email'];
        
         $sql10 = "SELECT * FROM $booktb WHERE username='$username' and day='$day' and time='$time' and service='$service'";
						
			$re = mysqli_query($conn, $sql10);
        $id=mysqli_fetch_array($re);
        
        
        $msg= "This is MS FiT Care Gym. \n\nYour booking for ".$service." on ".$corday." at ".$time." with ID:".$id["id"]." was succesfully registered!";
        $msg=wordwrap($msg,70);
        
        mail($email,"Booking Confirmation ",$msg);
        
       
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		end:
		mysqli_close($conn);
	}

    
    ?>

<a href="index.php"><p>Back to the booking calendar</p></a>

</body>

</html>
