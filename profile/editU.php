<?php

session_start();
include("../announcements/connect1.php");
include("../announcements/auth.php");

      $flag_msg="";
    $id = $_GET['customer_id']; 
mysqli_select_db($conn,"database");
    if(isset($_POST['send'])) {	
               
   $name = $_FILES['file']['name'];  
    $temp_name = $_FILES['file']['tmp_name'];  
    if(isset($name)){
        if(!empty($name)){      
            $location = '../uploads/';      
            if(move_uploaded_file($temp_name, $location.$name)){
                if(empty($_POST['role'])){
     $sqledit=mysqli_query($conn,"UPDATE customers SET program='$location$name' where customer_id='$id'");
                    $flag_msg='Only the program of the user has been updated successfully' ;
} else {
                    $role = $_POST['role'] ;
  $sqledit=mysqli_query($conn,"UPDATE customers SET role='$role' , program='$location.$name' where customer_id='$id'");              
                $flag_msg='The role and the program of the user have been updated successfully' ; }
            }
        }else{
            
         if(empty($_POST['role'])){
    $flag_msg='No any updates' ;
} else{
             $role = $_POST['role'] ;
        $sqledit=mysqli_query($conn,"UPDATE customers SET role='$role' where customer_id='$id'"); 
       $flag_msg='Only the role of the user has been updated successfully' ;
        }
            
        }
        
        
        
    }  else {
        
        if(empty($_POST['role'])){
     $flag_msg='No any updates' ;
} else{
            $role = $_POST['role'] ;
        $sqledit=mysqli_query($conn,"UPDATE customers SET role='$role' where customer_id='$id'"); 
        $flag_msg='Only the role of the user has been updated successfully' ; 
        }
        
    }
    
     
  
    
     }
?> 
<html>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> MS Fit Care Gym | Edit User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  
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
        <a class="nav-link" href="registration/login.php"><i class="fas fa-key fa-fw"></i>Login</a>
            <?php } else { ?>
        <a class="nav-link btn-danger round" id="logout" href="../registration/logout.php"><i class="fas fa-key fa-fw"></i>Logout</a> 
             <?php } ?>
      </li>
    </ul>
    
  </div>
</nav>
<?php } ?>
    
    <?php $id = $_GET['customer_id']; 
       
    $fetch_user = mysqli_query($conn,"select * from customers where customer_id='$id'");
    $fetched_user=mysqli_fetch_array($fetch_user); 
   ?>
    
     <div class="login-cover">
  <div class="container text-center">
     <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-9 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Edit User<?php echo " " . $fetched_user["name"]; ?></h5>
    <?php 
      if ($flag_msg != "") {
                echo '<div class="alert alert-success"> <strong>' . $flag_msg . '</strong></div>';
            }
 ?>
  
     <form class="form-signin" action="editU.php?customer_id=<?php echo $_GET['customer_id'];?>" method="post" method="post" enctype="multipart/form-data"> 
         
         <div class="form-group">
             <label for=""></label>
    <?php   echo "Role of the user : " .$fetched_user["role"]; ?>
             <br>
    Change to : <br>
   
    <select name="role" class="form-control" id="exampleFormControlSelect1">
        <option hidden disabled selected value> -- select an option -- </option>
      <option>Admin</option>
      <option>Customer</option>
      <option>Physiotherapist</option>
      <option>Coach</option>
      <option>MassageTherapist</option>
    </select>
     
     <label for="file">File:</label>
    <input type="file" name="file" id="file" />
        <br>
        
         </div>
          <input class="btn btn-lg btn-register btn-block text-uppercase" name="send" type="submit" value="Submit">
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



 