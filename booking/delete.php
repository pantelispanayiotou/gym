<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Cancelled Bookings</title>
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
	if(empty($errors))
	{
		include 'config.php';

		// Create connection
		$conn = mysqli_connect($servername, $username, $password,  $dbname);

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

        $sql6 = "SELECT COUNT(*) from $booktb WHERE canceled=1  ";
         $canc = mysqli_query($conn, $sql6);
         $row6 = mysqli_fetch_array($canc);
        $cancelled=$row6[0];
    
    $sql7 = "SELECT * FROM $booktb WHERE canceled=1";
						
			$resu = mysqli_query($conn, $sql7);
    
    $c=0;
    if ($cancelled > 0) {
    			
     
            while($row = mysqli_fetch_assoc($resu)){
                   
                
                $sql8 = "DELETE FROM $booktb WHERE canceled=1 ";
				    if (mysqli_query($conn, $sql8)) {
                       
                        $c++;
                    }
                    else {
                        echo "Error: " . $sql8 . "<br>" . mysqli_error($conn);
                    }
                }
            
        echo "<h3>Total bookings cancelled: ".$c."</h3>";
        echo "<h3>Cancelled Bookings are Cleared</h3>";
        
        } else {
            echo "<h3>No cancelled Bookings</h3>";
        
}
        mysqli_close($conn);
	}
?>

<a href="index.php"><p>Back to the calendar</p></a>

</body>

</html>
