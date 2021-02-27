<?php
$servername = "localhost";
$username = "gym";
$password = "VzuNPZeNYErTHXGT";
$database="gym";
//$charset='utf8'; // specify the character set
//$collation='utf8_general_ci'; //specify what collation you wish to use

// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>



<?php 

$errormsg= "DEF";

if(isset($_POST['submit'])){ 

//check if form was submitted
$username = $_POST['username']; 

mysqli_select_db($conn,$database);
$sqlquery = "select * from customers where username='$username' ";
$check_user = mysqli_query($conn , $sqlquery) or
die("Database error detected: " . mysql_error());

$number = mysqli_num_rows( $check_user );
if ( $number == 0)	{
$errormsg = "NO";
}else  {



//fetch user
$sqlquery = "select * from customers where username='$username' ";
$user = mysqli_query($conn , $sqlquery) or
die("Database error detected: " . mysql_error());

$fetched_user=mysqli_fetch_array($user);


//create new password
$rand1=strval(rand(1000000,9999999));
$rand2=strval(rand(1000000,9999999));

$new_pass= $rand1;
$new_pass.= $fetched_user["username"];
$new_pass.= $rand2;


//encypt new pass
$enc_password = hash('sha256', $new_pass);


//push new password to DB
$temp_user=$fetched_user["username"];
$push_pass=mysqli_query($conn,"UPDATE customers SET password='$enc_password' where username='$temp_user' "); 

//send email
$email=$fetched_user["email"];


$msg="This is MS FiT Care Gym. \n \n Your new password is: ";
$msg.= $new_pass;
$msg.="\n\nThank you!";
$msg=wordwrap($msg,70);

mail($email,"Reset Password",$msg);
$errormsg = "YES";

}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>MS Fit Care Gym | Reset Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
  
</head>
<body>
    
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
        <a class="nav-link" href="../programs/program.php"><i class="fas fa-dumbbell fa-fw"></i>Programs</a>
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
        <a class="nav-link btn-danger round" id="logout" href="registration/logout.php"><i class="fas fa-key fa-fw"></i>Logout</a> 
             <?php } ?>
      </li>
    </ul>
    
  </div>
</nav>
<?php } ?>
    <div class="login-cover">
  <div class="container text-center">
     <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-9 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Reset password</h5>
               <?php
             if ($errormsg !="DEF") {
            if ($errormsg == "NO") {
                echo '<div class="alert alert-danger"><strong>Error: Your username does not exists. Please try again. </strong> </div>';
            }
              else {
                  echo '<div class="alert alert-success"><strong>Please check your email for further instructions to change your password </strong>  </div>';
              }
             }
        
             
            ?>
           <form action="resetpass.php" method="post" class="form-signin">
              <div class="form-label-group">
                <input type="text"  class="form-control" name="username" placeholder="Enter username here.." />
              
              </div>
               
              <input type="submit" class="btn btn-lg btn-register btn-block text-uppercase" name="submit" value="Reset"/>
             
               

            </form>
               
          </div>
        </div>
      </div>
      
      
      </div>
  </div>
</div>
<!-- Footer -->
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
  <!-- Footer -->
 
</body>
</html>

