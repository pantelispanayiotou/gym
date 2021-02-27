<?php

session_start();
include("../announcements/connect1.php");
include("../announcements/GeneralAuth.php");
 
$login_error_message = '';
$flag ="A";

if (!empty($_POST['btnLogin'])) {
 
    $currentpassword = trim($_POST['currentpassword']);
    $NEWpassword = trim($_POST['NEWpassword']);
    $RnewPassword= trim($_POST['RnewPassword']);
    $enc_password = hash('sha256', $currentpassword);
    
    if ($currentpassword == "") {
        $login_error_message = 'Current password field is required!';
    } else if ($NEWpassword == "") {
        $login_error_message = 'New Password field is required!';
    }else if ($RnewPassword==""){
        $login_error_message = 'Rewrite new Password field is required!';
    
    }else if((strcmp($enc_password,$_SESSION['password'])!=0)){    
        $login_error_message = 'Wrong current password';
        
    }else if((strcmp( $NEWpassword,$RnewPassword)!=0)){
        $login_error_message = 'The two fields of new password are not the same';
        
    }else if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST['NEWpassword']) === 0){
        $login_error_message = '<p class="errText">Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit</p>';
    } else {
    $enc_passwordF = hash('sha256', $NEWpassword);
       
        $id=$_SESSION['customer_id'];
  $sqledit=mysqli_query($conn," UPDATE customers SET password='$enc_passwordF' where customer_id= '$id'"); 
        $flag="B";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>MS Fit Care Gym | Change your password</title>
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
        <a class="nav-link" href="../registration/login.php"><i class="fas fa-key fa-fw"></i>Login</a>
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
            <h5 class="card-title text-center">Reset Your Password</h5>
               <?php
             
            if ($login_error_message != "") {
                echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $login_error_message . '</div>';
            }
              if ($flag == "B") { 
               echo '<div class="alert alert-success"><strong>Success: Your password has been changed successfully </strong> </div>';
              }
        
             
            ?>
           <form action="resetPass.php" method="post" class="form-signin">
              <div class="form-label-group">
                <input type="password"  class="form-control" name="currentpassword" placeholder="Current Password" />
              
              </div>
               <div class="form-label-group">
                <input type="password" class="form-control" name="NEWpassword" placeholder="Type a new password" />
                
              </div>
               <div class="form-label-group">
                <input type="password" id="inputEmail" class="form-control" name="RnewPassword" placeholder="Re-Type your new password" />
              
              </div>
              
             
              <input type="submit" class="btn btn-lg btn-register btn-block text-uppercase" name="btnLogin" value="Change"/>
             
               

            </form>
               
          </div>
        </div>
      </div>
      
      
      </div>
  </div>
</div>
    
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