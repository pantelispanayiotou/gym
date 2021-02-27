<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Cancel booking</title>
</head>

<body>

<?php
// Captcha
/*if(empty($_SESSION['captcha2'] ) ||
	strcasecmp($_SESSION['captcha2'], $_POST['captcha2']) != 0)
	{
		//Note: the captcha code is compared case insensitively.
		//if you want case sensitive match, update the check above to
		// strcmp()
		$errors = "<h3><font color=\"red\">Wrong code!</font></h3>";
		echo $errors;
	}
	*/
	//if(empty($errors))
	{
		include 'config.php';

		// Create connection
		$conn = mysqli_connect($servername, $username, $password,  $dbname);

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

        
        
        
        
		$id = intval(htmlspecialchars($_POST["id"]));
        $username=$_SESSION['username'];
        $role=$_SESSION['role'];
        
        //check if user cansels HIS booking
        
        $sql0 = "SELECT COUNT(*) from $booktb WHERE id = $id  and username='$username'";
         $count0 = mysqli_query($conn, $sql0);
         $row0 = mysqli_fetch_array($count0);
       
        $sql5= "SELECT service from $booktb where id=$id";
         $serv = mysqli_query($conn, $sql5);
         $row5 = mysqli_fetch_array($serv);
       
       
        if (($row0[0]==1)||($role=="Admin")||(($row5[0]=="Physiotherapy")&&($role=="physiotherapist"))||(($row5[0]=="Massage")&&($role=="MassageTherapist"))){
           
            
            
		  $sql = "UPDATE $booktb SET canceled=1 WHERE id = $id";
		  if (mysqli_query($conn, $sql)) {
			echo "<h3>Booking cancelled.</h3>";
              
		  }
		  else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		  }
            
        }
        else{
            
            echo "This is not your booking";
        }
		mysqli_close($conn);
	}
?>

<a href="index.php"><p>Back to the booking calendar</p></a>

</body>

</html>
