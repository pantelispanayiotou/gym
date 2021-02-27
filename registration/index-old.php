<?php 
session_start();

?> 
<!DOCTYPE html>
<html lang="en">

<head>

 <title>MS Fit Care Gym | Book Services</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  var holidays= [[1,1],[6,1], [25,3], [1,4], [1,5], [15,8], [1,10], [28,10], [25,12], [26,12]];
    
function DisableSpecificDates(date) {
 
 
 for (var j = 0; j < holidays.length; j++) {
    var m= holidays[j][1]-1;
    var d=holidays[j][0];
   
    var dd=date.getDate();
     var mm = date.getMonth();
 //disable sundays
    var day = date.getDay();
    if ((day == 0)){
        return [false];}
  else if((d == dd)&&(m==mm)){
     
       return [false];
    }
 } return [true];    
}
    
 
 
 
    $(function() {
	var dateToday = new Date(); 
    $( "#from" ).datepicker({
    
    defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
        minDate: dateToday,
      onClose: function( selectedDate ) {
      },beforeShowDay: DisableSpecificDates
    });
  });
   
    
    </script>
    
    
</head>

<body>
    <?php
    include 'config.php';

	// Create connection
	$conn = mysqli_connect($servername, $username, $password,  $dbname);

	// Check connection
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}
    
  $day=0;
    $service=0;
    $username=0;
    $time=0;  
   

   ?>
    <?php if (!($_SERVER['HTTP_X_REQUESTED_WITH'] == "com.example.gym")) { ?> 
<nav class="navbar navbar-expand-lg navbar-light bg-custom">
 
  <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

        
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <a class="navbar-brand ml-auto mx-auto" href="#">
          <img src="../img/logo-test.png" alt="" width="70" height="90">
        </a>
     <ul class="navbar-nav navbar-light bg-light ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="../index.php"><i class="fas fa-home fa-fw"> </i>Home </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="../profile/profile.php"> <i class="fas fa-user fa-fw"></i>Profile</a>
      </li>
     <li class="nav-item">
        <a class="nav-link" href="../programs.html"><i class="fas fa-dumbbell fa-fw"></i>Programs</a>
      </li>
    
          <li class="nav-item">
        <a class="nav-link" href="../services/services.php"><i class="fas fa-calendar-check fa-fw"></i>Services</a>
      </li>
         <li class="nav-item">
        <a class="nav-link" href="../shop/shop.php"><i class="fas fa-shopping-cart fa-fw"></i>Shop</a>
      </li>
         <li class="nav-item">
        <a class="nav-link" href="../prices/prices.php"><i class="fas fa-dollar-sign fa-fw"></i>Prices</a>
      </li>
         <li class="nav-item">
        <a class="nav-link" href="../announcements/announcement.php"><i class="fas fa-bullhorn fa-fw"></i>Announcements</a>
      </li>
          <li class="nav-item">
             <?php if(!isset($_SESSION['customer_id'])){ ?>
        <a class="nav-link" href="registration/login.php"><i class="fas fa-key fa-fw"></i>Login</a>
            <?php } else { ?>
        <a class="nav-link btn-danger round" id="logout" href="registration/logout.php"><i class="fas fa-key fa-fw"></i>Logout</a> 
             <?php } ?>
      </li>
    </ul>
    
  </div>
</nav>
<?php } ?>
    


   <div class="jumbotron book-cover jumbotron-fluid" id="top-jumpo">
       <div class="container text-center">
		<form action="index-old.php" method="post">
             <h1 class="text-center welcome">Book Service</h1>
      <div class="row main-content">
  
    <div class="col-sm-9 col-md-8 col-lg-6">
        <div class="card card-signin">
        <div class="card-body">
            </div>
        </div>
          </div>
            </div>
			 <?php 
                $sqls = "SELECT * FROM $servicestb ";
                       $ress = mysqli_query($conn, $sqls);
                
                ?>
           
                   <p>
                    <?php
                     
                        
                while (  $rows = mysqli_fetch_assoc($ress) ) {
                       ?>
                        <input name="service" type="radio" value="<?php echo $rows['title']?>" /><?php echo $rows['title'];
                    } 
                                
                ?></p>
                
		
                
                
             Reservation Date:
               
				
				 <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' id="from" class="form-control" name="day" />
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
		
                   <br>
            <br>
         
            <input name="avalable" type="submit" value="avaliable hours" class="btn btn-info"/>
				</form>	
        
          </div>
            </div>
           
           <br>
    <br>
    
    
    
	
                  
					
    <?php       
        
    $day =  intval(strtotime(htmlspecialchars($_POST["day"])));
    $service = htmlspecialchars($_POST["service"]);
    
  
 
    
    if(isset($_REQUEST["avalable"])) {
      
      
      
    
   
    
echo "Reservation time:";
    
echo "<br>";    
  
        
    
       
        $sql3 = "SELECT * FROM $servicestb where title='$service' ";
       
        $count2 = mysqli_query($conn, $sql3);
        $row3=mysqli_fetch_array($count2);
        
       
        
       
       
		
        
        
        ?>
    
   
        <form action="index-old.php" method="post">
            <?php   $_POST["day"]=$day;
        $_POST["service"]=$service;
       
        $_SESSION["day"]=$day;
        $_SESSION["service"]=$service;
        
        
        
        ?>
           
            <select name="time">
        <?php  
         
        
        $sql2 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='09:00-10:00' and day='$day' ";
        $count = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($count); 
        
        if (!($row2[0]>=$row3['capacity'])){ ?>
                  
			<option selected="selected">09:00-10:00</option> <?php } ?> 
                     
        <?php        
        $sql2 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='10:00-11:00' and day='$day' ";
        $count = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($count); 
        
        if (!($row2[0]>=$row3['capacity'])){ ?>          
            
            <option>10:00-11:00</option> <?php } ?> 
                   
        <?php        
        $sql2 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='11:00-12:00' and day='$day' ";
        $count = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($count); 
        
        if (!($row2[0]>=$row3['capacity'])){ ?> 
                     
			<option>11:00-12:00</option> <?php } ?>
                     
        <?php        
        $sql2 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='12:00-13:00' and day='$day' ";
        $count = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($count); 
        
        if (!($row2[0]>=$row3['capacity'])){ ?> 
			
            <option>12:00-13:00</option> <?php } ?>
                     
        <?php        
        $sql2 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='13:00-14:00' and day='$day' ";
        $count = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($count); 
        
        if (!($row2[0]>=$row3['capacity'])){ ?> 
			
            <option>13:00-14:00</option><?php } ?>
                     
        <?php        
        $sql2 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='14:00-15:00' and day='$day' ";
        $count = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($count); 
        
        if (!($row2[0]>=$row3['capacity'])){ ?> 
                     
			<option>14:00-15:00</option> <?php } ?>
                     
        <?php        
        $sql2 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='15:00-16:00' and day='$day' ";
        $count = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($count); 
        
        if (!($row2[0]>=$row3['capacity'])){ ?> 
                             
			<option>15:00-16:00</option> <?php } ?>
                     
        <?php        
        $sql2 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='16:00-17:00' and day='$day' ";
        $count = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($count); 
        
        if (!($row2[0]>=$row3['capacity'])){ ?> 
                     
			<option>16:00-17:00</option> <?php } ?>
                     
        <?php        
        $sql2 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='17:00-18:00' and day='$day' ";
        $count = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($count); 
        
        if (!($row2[0]>=$row3['capacity'])){ ?> 
                     
			<option>17:00-18:00</option> <?php } ?>
                     
        <?php        
        $sql2 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='18:00-19:00' and day='$day' ";
        $count = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($count); 
        
        if (!($row2[0]>=$row3['capacity'])){ ?> 
                     
			<option>18:00-19:00</option> <?php } ?>
                     
        <?php        
        $sql2 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='19:00-20:00' and day='$day' ";
        $count = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($count); 
        
        if (!($row2[0]>=$row3['capacity'])){ ?> 
                     
			<option>19:00-20:00</option> <?php } ?>
                     
        <?php        
        $sql2 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='20:00-21:00' and day='$day' ";
        $count = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($count); 
        
        if (!($row2[0]>=$row3['capacity'])){ ?> 
                     
			<option>20:00-21:00</option> <?php } ?>
			
			</select>
			
			  <br>
            <br>
			
         <input name="book" type="submit" value="Book" class="btn btn-info"/>
		</form>
		
    <?php
    
    
    }
    ?>
		<h3>Cancel booking</h3>
		<form action="index-old.php" method="post">
			<p></p>
			ID: <input name="id" required="" type="text" /><br />
			<br>
			<p><input name="cancel" type="submit" value="Cancel" /></p>
		</form>
    
    <br>
    <br>
   
    
<?php 


include 'config.php';
$role=$_SESSION['role'];
$user=$_SESSION['username'];

      
      

    echo "<br>";
    

    
    
if (($role=="Admin")||($role=="physiotherapist")||($role=="MassageTherapist")){  
    
    ?>
         
    <form action="index-old.php">
          <p><input name="delete" type="submit" value="Clear Cancelled Bookings!" /></p>
		</form>
    
    <form action="index-old.php">
          <p><input name="past" type="submit" value="Clear Past Bookings!" /></p>
		</form>
    
<?php 
    
if ($role=="physiotherapist")  {
    $sql9 = "SELECT COUNT(*) from $booktb WHERE service='Physiotherapy'and canceled=0 ";
         $use = mysqli_query($conn, $sql9);
         $row9 = mysqli_fetch_array($use);
        $userows=$row9[0];
    
    $sql10 = "SELECT * FROM $booktb WHERE service='Physiotherapy' and canceled=0 Order by day";
						
			$result10 = mysqli_query($conn, $sql10);
    
    $c=0;
    if ($userows > 0) {
        echo "<br>";
        echo "Bookings of Physiotherapy: "; 
        echo "<br>";
         echo "\tBookID\tUsername\tService\tDate\tTime\t";
         echo "<br>";
        while ($row10 = mysqli_fetch_assoc($result10)) {
            echo "<br>";
           echo $row10["id"]."\t".$row10["service"]."\t";
           echo date('m/d/Y',$row10["day"]);
              echo "\t".$row10["time"];
            echo "<br>";
            $c++;
        }
        echo "<br>";
        echo "Total ".$c." bookings";
    } else {
        echo "<h3>No Bookings of Physiotherapy</h3>";
        }
        
    
    
    echo "<br>";
    
    
}else if ($role=="MassageTherapist")  {
    $sql9 = "SELECT COUNT(*) from $booktb WHERE service='Massage' and canceled=0";
         $use = mysqli_query($conn, $sql9);
         $row9 = mysqli_fetch_array($use);
        $userows=$row9[0];
    
    $sql10 = "SELECT * FROM $booktb WHERE service='Massage' and canceled=0 Order by day";
						
			$result10 = mysqli_query($conn, $sql10);
    
    $c=0;
    if ($userows > 0) {
        echo "<br>";
        echo "Bookings of Massage: "; 
        echo "<br>";
         echo "\tBookID\tUsername\tService\tDate\tTime\t";
        echo "<br>";
        while ($row10 = mysqli_fetch_assoc($result10)) {
            echo "<br>";
           echo $row10["id"]."\t".$row10["service"]."\t";
           echo date('m/d/Y',$row10["day"]);
              echo "\t".$row10["time"];
            echo "<br>";
            $c++;
        }
        echo "<br>";
        echo "Total ".$c." bookings";
    } else {
        echo "<h3>No Bookings of Massage</h3>";
        }
        
    
    
    echo "<br>";
    
    
}else if ($role=="Admin"){
    
    ?>
 

 <?php
                $sqls = "SELECT * FROM $servicestb ";
                       $serv = mysqli_query($conn, $sqls);
                
                
                  
                   
                       
                while (  $rowser = mysqli_fetch_assoc($serv) ) {
                    
                      $servicet= $rowser['title'];
                        
                        $sql9 = "SELECT COUNT(*) from $booktb WHERE service='$servicet' ";
                        $use = mysqli_query($conn, $sql9);
                        $row9 = mysqli_fetch_array($use);
                        $userows=$row9[0];
    
                        $sql10 = "SELECT * FROM $booktb WHERE service='$servicet' Order by day";
						
                        $result10 = mysqli_query($conn, $sql10);
    
                        $c=0;
                        if ($userows > 0) {
                                echo "<br>";
                                echo "Bookings for ".$servicet.":";
                                echo "<br>";
                                echo "\tBookID\tUsername\tDate\tTime\tCanceled";
                                echo "<br>";
                                while ($row10 = mysqli_fetch_assoc($result10)) {
                                    echo "<br>";
                                    echo $row10["id"]."\t".$row10["username"]."\t".$row10["service"]."\t";
                                    echo date('m/d/Y',$row10["day"]);
                                    echo "\t".$row10["time"]."\t".$row10["canceled"];
                                    echo "<br>";
                                    $c++;
                                }
                                echo "<br>";
                                echo "Total ".$c." bookings";
                                } else {
                            echo "<h3>No Bookings of ".$servicet."</h3>";
                        }
        
    
    
                    echo "<br>";
    
                } 
                                
              
  }
}
?>
   
 
<?php
  
   
         if(isset($_REQUEST["book"])) {
		$time = htmlspecialchars($_POST["time"]);
		$username = $_SESSION['username'];
		$service=$_SESSION["service"];
        $day=$_SESSION["day"];
		 $_SESSION["time"]=$time;
    
       
		// prevent double booking
		
        
         $sql4 = "SELECT COUNT(*) from $booktb WHERE service='$service' and canceled=0  and time='$time' and day='$day' and username='$username' ";
        $count4 = mysqli_query($conn, $sql4);
         $row4 = mysqli_fetch_array($count4);
        
        
        
        if($row4[0]>0){
             header("Location: index-old.php?error=Unfortunately you booked an other service for this time and date."); 
           
            goto end;
        }
      
    
		$sql = "INSERT INTO $booktb (username, service, day, time, canceled)
			VALUES ('$username', '$service', '$day', '$time', 0)";
     
        
        
        
		if (mysqli_query($conn, $sql)) {
		  
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
		
        
         header("Location: index-old.php?error=Booking succeed."); 
         }
  

    if(isset($_REQUEST["past"])) {
        
         
       $timenow = time();
        
       
    
    $sql6 = "SELECT COUNT(*) from $booktb WHERE day<'$timenow'  ";
         $canc = mysqli_query($conn, $sql6);
         $row6 = mysqli_fetch_array($canc);
        $cancelled=$row6[0];
    
    $sql7 = "SELECT * FROM $booktb WHERE day<'$timenow'";
						
			$resu = mysqli_query($conn, $sql7);
    
    $c=0;
    if ($cancelled > 0) {
    			
     
            while($row = mysqli_fetch_assoc($resu)){
                   
                
                $sql8 = "DELETE FROM $booktb WHERE day<'$timenow'";
				    if (mysqli_query($conn, $sql8)) {
                       
                        $c++;
                    }
                    else {
                        echo "Error: " . $sql8 . "<br>" . mysqli_error($conn);
                    }
                }
            
       
         header("Location: index-old.php?error=Past Bookings are Cleared, total bookings cancelled: $c");
        } else {
        header("Location: index-old.php?error=No past Bookings"); 
            
        
        }
 
    
	}
    
    
    if(isset($_REQUEST["delete"])) {
    
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
            
       
         header("Location: index-old.php?error=Cancelled Bookings are Cleared, total bookings cancelled: $c");
        } else {
           header("Location: index-old.php?error=No cancelled Bookings"); 
        
        }
         
    }
    
    if(isset($_REQUEST["cancel"])) {
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
			
               header("Location: index-old.php?error=Booking cancelled.");
              
		  }
		  else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		  }
            
        }
        else{
             header("Location: index-old.php?error=This is not your booking");
           
        }
     
    }
    
    if (isset($_GET['error'])) {
        echo $_GET['error'];
    }
    ?>
    <footer class="page-footer top-menu color-footer">
  
      
      <div class="container">
				
					
						
							<div class="row">
								<div class="col-md-4">
                                 <div class="top-margin">
									<div class="icon"> <i class="fas fa-mobile-alt"></i></div>
                                    <div class="loc">
										
										<p> Tel. 24726444, 99481883 <br>Email: mspetsioti81@hotmail.com</p>
                                       
									</div>
                                    </div>
								</div>
								<div class="col-md-4 ">
                                     <div class="top-margin">
                                   <div class="icon"> <i class="fas fa-map-marker-alt"></i></div>
                                    <div class="loc">
										
										<p> Nikos Theophanous,<br> Xylophagou 7520, Larnaca</p>
									</div>
                                        </div>
								</div>
								<div class="col-md-4">
                                    <div class="top-margin-cstm text-center">
                                   <p> Socialise with us!</p>
                                       <a href="http://facebook.com">    <i class="fab fa-facebook"></i>        </a>                                
                                    </div>
								</div>
                                
							</div>
						
					
				</div>
			

  </footer>
</body>

</html>
