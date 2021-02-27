<?php 
session_start();
include("../announcements/GeneralAuth.php");


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
  $(this).attr("autocomplete", "off");  
 
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
   
    
      changeMonth: true,
      numberOfMonths: 1,
        minDate: dateToday,
      onClose: function( selectedDate ) {
      },beforeShowDay: DisableSpecificDates
        
    });
  });
   
    $("#mydate").datepicker().datepicker("setDate", new Date());
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
        <a class="nav-link" href="../registration/login.php"><i class="fas fa-key fa-fw"></i>Login</a>
            <?php } else { ?>
        <a class="nav-link btn-danger round" id="logout" href="../registration/logout.php"><i class="fas fa-key fa-fw"></i>Logout</a> 
             <?php } ?>
      </li>
    </ul>
    
  </div>
</nav>
<?php } ?>
    


   <div class="jumbotron book-cover jumbotron-fluid" id="top-jumpo">
       <div class="container text-center">
            <h1 class="text-center welcome">Book Service</h1>
            <div class="row main-content">
		
            
     
  
    <div class="col-sm-10 col-md-8 col-lg-6">
        <div class="card card-signin">
        <div class="card-body book-content">
                 <?php  if (isset($_SESSION['error'])) {
                    $error = $_SESSION['error'];
                    echo '<div class="alert alert-danger">' .$error. '</div>';
                   unset($_SESSION['error']);
    } ?>
        
            <form action="index.php" method="post">
            
                <div class="form-group service-label">
            <label>Choose Service</label>
                    <?php 
                $sqls = "SELECT * FROM $servicestb ";
                       $ress = mysqli_query($conn, $sqls);
                
                ?>
  <select class="form-control" id="choose-service" name="service">
    
 

			 
           
                   
                    <?php
                     
                        
                while (  $rows = mysqli_fetch_assoc($ress) ) {
                       ?>
                        <option type="radio" value="<?php echo $rows['title']?>" ><?php echo $rows['title'];
                    } 
                                
                ?></option>
                    </select>
                </div>
		
                
                
             
               
				
				 <div class="form-group service-label">
                      <label>Choose Date</label>
                <div class='input-group date' id='datetimepicker1'>
                     <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                    <input type='text' id="from" class="form-control" name="day" />
                   
                </div>
            </div>
		
             
             <input type="submit" class="btn btn-lg btn-primary btn-block round " name="avalable" type="submit" value="Check Availability"/>
         
				</form>	
           
                 
					
    <?php       
        
    $day =  intval(strtotime(htmlspecialchars($_POST["day"])));
    $service = htmlspecialchars($_POST["service"]);
    
  
    if(isset($_POST["avalable"])) {
        $today =time();
             if($day<$today){
                 $_SESSION['error']="Please select date"; 
                  echo '<meta http-equiv="refresh" content="0">';
             }else{
        
        $sql3 = "SELECT * FROM $servicestb where title='$service' ";
       
        $count2 = mysqli_query($conn, $sql3);
        $row3=mysqli_fetch_array($count2);
        
       
        ?>
    
   
        <form action="index.php" method="post">
            <?php   $_POST["day"]=$day;
        $_POST["service"]=$service;
       
        $_SESSION["day"]=$day;
        $_SESSION["service"]=$service;
        
        
        
        ?>
            <div class="form-group service-label py-3">
                <label> Reservation Time</label>
                 <select class="form-control" id="choose-service" name="time">
          
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
            </div>
             <input name="book" type="submit" value="Book" class="btn btn-lg btn-success btn-block round "/>
		</form>
           
		
    <?php
             }
    
    }
    ?>
             <hr>
		<h5 class="text-left py-3">Cancel booking</h5>
            
             
		
		<form action="index.php" method="post">
			  <div class="form-group service-label">
                  <div class='input-group'>
                     <span class="input-group-addon">
                       ID
                    </span>
		<input type='text' id="from" class="form-control" name="id" />
                  </div>
            </div>
			<input name="cancel" type="submit" class="btn btn-lg btn-danger btn-block round"value="Cancel" />
           
		</form>
    
    
   
    
<?php 


include 'config.php';
$role=$_SESSION['role'];
$user=$_SESSION['username'];

      
    
if (($role=="Admin")||($role=="physiotherapist")||($role=="MassageTherapist")){  
    
    
if ($role=="physiotherapist")  {
    $sql9 = "SELECT COUNT(*) from $booktb WHERE service='Physiotherapy'and canceled=0 ";
         $use = mysqli_query($conn, $sql9);
         $row9 = mysqli_fetch_array($use);
        $userows=$row9[0];
    
    $sql10 = "SELECT * FROM $booktb WHERE service='Physiotherapy' and canceled=0 Order by day";
						
			$result10 = mysqli_query($conn, $sql10);
    
    $c=0;
    if ($userows > 0) {
       
        echo "Bookings of Physiotherapy: "; 
     
         echo "\tBookID\tUsername\tService\tDate\tTime\t";
      
        while ($row10 = mysqli_fetch_assoc($result10)) {
             
           echo $row10["id"]."\t".$row10["service"]."\t";
           echo date('m/d/Y',$row10["day"]);
              echo "\t".$row10["time"];
         
            $c++;
            echo "<br>";
        }
    
        echo "Total ".$c." bookings";
    } else {
        echo "<h3>No Bookings of Physiotherapy</h3>";
        }

    
}else if ($role=="MassageTherapist")  {
    $sql9 = "SELECT COUNT(*) from $booktb WHERE service='Massage' and canceled=0";
         $use = mysqli_query($conn, $sql9);
         $row9 = mysqli_fetch_array($use);
        $userows=$row9[0];
    
    $sql10 = "SELECT * FROM $booktb WHERE service='Massage' and canceled=0 Order by day";
						
			$result10 = mysqli_query($conn, $sql10);
    
    $c=0;
    if ($userows > 0) {
         
        echo "Bookings of Massage: "; 
         
         echo "\tBookID\tUsername\tService\tDate\tTime\t";
         
        while ($row10 = mysqli_fetch_assoc($result10)) {
             
           echo $row10["id"]."\t".$row10["service"]."\t";
           echo date('m/d/Y',$row10["day"]);
              echo "\t".$row10["time"];
             
            $c++;
            echo "<br>";
        }
         
        echo "Total ".$c." bookings";
    } else {
        echo "<h3>No Bookings of Massage</h3>";
        }
  
}
}
?>
   
 
<?php
  
   
         if(isset($_POST["book"])) {
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
              $_SESSION['error']="Unfortunately you booked an other service for this time and date."; 
           
          
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
		
		
		
        
          $_SESSION['error']="Booking succeed."; 
              echo '<meta http-equiv="refresh" content="0">';
         
  
         }
    
    if(isset($_POST["cancel"])) {
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
       
        
        $sqlid= "SELECT canceled from $booktb where id=$id";
         $serid = mysqli_query($conn, $sqlid);
         $rowid = mysqli_fetch_array($serid);
       
        if ((($row0[0]==1)||($role=="Admin")||(($row5[0]=="Physiotherapy")&&($role=="physiotherapist"))||(($row5[0]=="Massage")&&($role=="MassageTherapist")))&&($rowid[0]==0)){
           
            
            
		  $sql = "UPDATE $booktb SET canceled=1 WHERE id = $id";
		  if (mysqli_query($conn, $sql)) {
			
                $_SESSION['error']="Booking cancelled.";
              $email=$_SESSION['email'];

$msg= "This is MS FiT Care Gym. \n\nYour booking with ID:".$_POST["id"]." was succesfully cancelled!";
        $msg=wordwrap($msg,70);
        
        mail($email,"Booking Cancelation ",$msg);
              
		  }
		  else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		  }
            
        }
        else{
            if ($rowid[0]==1){
                $_SESSION['error']="You already cancelled this booking";
            }else{
             $_SESSION['error']="This is not your booking";
            }
        }
      echo '<meta http-equiv="refresh" content="0">';
    }
    
   
    ?>
            </div>
            </div>
        </div>
          </div>
           
          </div>
            </div>  
    <?php  if($_SESSION['customer_id']>=1){
     if ($_SESSION['role']=='Admin') { ?>
    <div class="admin-bookings">
    <div class="container">
        <?php if(isset($_POST["delete"])) {
    
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
            
       
        $_SESSION['error']= "Cancelled Bookings are Cleared, total bookings cancelled: $c";
           
        } else {
            $_SESSION['error'] = "No bookings deleted";
            
         
        
        }
    echo '<meta http-equiv="refresh" content="0">';
         
    } ?>
            
        
     <?php   if(isset($_POST["past"])) {
         
        
        
         
         
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
            
       
     

         $_SESSION['error'] ="Past Bookings are Cleared, total bookings cancelled: $c";
       
        
        } else {
         $_SESSION['error']="No past Bookings"; 
            
        
        }
 echo '<meta http-equiv="refresh" content="0">';
    
	}  ?>
           <form  method="post" class="py-3" action="index.php">
          <input name="past" type="submit" class="btn btn-lg btn-danger round " value="Clear Past Bookings" />
		</form>
        
         <form method="post" class="py-2"action="index.php">
          <input name="delete" type="submit" class="btn btn-lg btn-success round "value="Clear Cancelled Bookings" />
		</form>
      <a href="pdf.php" class="btn btn-lg btn-success round ">PDF File</a>
        <br>

    <div class="row">
        <div class="col-lg-12 col-md-10">
      <div id="accordion">
       
   
           <?php if ($role=="Admin"){
    
 
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
                        if ($userows > 0) { ?>
             <div class="card">
                    <div class="card-header" id="<?php echo $servicet; ?>">
                                <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-<?php echo $servicet; ?>" aria-expanded="true" aria-controls="collapse<?php echo $servicet; ?>">
                       <?php echo '<h5>' .$servicet. '</h5>'; ?>
                </button>
                    </h5>
                    </div>
        
                    <div id="collapse-<?php echo $servicet; ?>" class="collapse" aria-labelledby="<?php echo $servicet; ?>" data-parent="#accordion">
      <div class="card-body">
                              <?php
                                 
                               
            
                                while ($row10 = mysqli_fetch_assoc($result10)) {
                                     
                             
                                        
                                    echo $row10["id"]."\t".$row10["username"]."\t".$row10["service"]."\t";
                                    echo date('m/d/Y',$row10["day"]);
                                    if ($row10["canceled"]==1){
                                    echo "\t".$row10["time"]."\t"."cancelled";
                                    }else{
                                        echo "\t".$row10["time"];
                                    }
                                    $c++;
                                    echo "<br>";
                                }
                                 
                                echo "Total ".$c." bookings";
                                } ?>
                        </div>
                 </div>
          </div>
        
                
    
                      
    
               <?php } 
                                
              
  } ?>
           
        
        
    
        
        </div>
    </div>
    </div>
        </div>
        <br>
    <br>
    </div>
    <?php  }
     } ?>
  <footer class="page-footer top-menu color-footer">
  
      
      <div class="container"> 
				
					
						
							<div class="row">
								<div class="col-md-4 py-4">
                                  
								 <i class="fas fa-mobile-alt mx-auto"></i>
                                    <div class="loc">
										
										<p> Tel. 24726444, 99481883 <br> mspetsioti81@hotmail.com</p>
                                       
									</div>
                                   
								</div>
								<div class="col-md-4 py-4">
                                    
                                    <i class="fas fa-map-marker-alt mx-auto"></i>
                                    <div class="loc">
										
										<p> Nikos Theophanous,<br> Xylophagou 7520, Larnaca</p>
									</div>
                                        </div>
								
								<div class="col-md-3 py-4">
                                   
                                   
                                       <a href="http://facebook.com">    <i class="fab fa-facebook mx-auto"></i>        </a>                                
                                   
                                    <div class="loc">
										
										<p> Socialise with us!</p>
									</div>
								</div>
                                
							</div>
						
					
				</div>
			

  </footer>
  
</body>

</html>
