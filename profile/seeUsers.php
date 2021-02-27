<?php
session_start();
include("../announcements/auth.php");
include("../announcements/connect1.php");

?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <title> MS Fit Care Gym | Manage Users</title>
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
 
     <div class="jumbotron profile-cover profile-space jumbotron-fluid" id="top-jumpo">
  <div class="container  text-center">
       
      <h1 class="text-center welcome">Manage Users</h1>
      <div class="row  main-content">
          <p class="mx-auto"> You can edit or delete the users of the gym</p>
      </div>
         </div>
    </div>

 <div class="profile-section mx-auto">
        <div class="container py-3 ">
        
            
             <table class="table table-hover table-edit">
                <thead>
                <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Username</th>
                <th>Sex</th>
                <th>Role</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody>
     <?php mysqli_select_db($conn,"database"); 
    
            $sql=mysqli_query($conn,"select * from customers");
   
  
           
         while ($row=mysqli_fetch_array($sql)) { 
            
    if ($row['role']!='Admin') { ?>
            <tr>
                <td><p ><?php echo $row["name"]; ?></p></td>
           
                <td><p><?php echo $row["surname"]; ?></p></td>
           
                <td> <p> <?php echo $row["telephone"]; ?></p></td>
           
              <td> <p> <?php echo $row["email"]; ?></p></td>
           
                <td> <p><?php echo $row["username"]; ?></p></td>
       
                <td> <p><?php echo $row["sex"]; ?></p></td>
          
                <td><p><?php echo $row["role"]; ?></p></td>
    	
     	
     	<td><?php  echo ' <a href="editU.php?customer_id='.$row["customer_id"].' "> <i class="fas fa-pencil-alt"></i></a>
        <a href="deleteU.php?customer_id='.$row["customer_id"].'"> <i class="fa fa-trash"></i> </a>'; ?> </td>
                </tr>
          
     
       <?php  } ?>
  
                
            
            <?php } ?>
               
                </tbody>
            </table>
    
     
            <br>
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