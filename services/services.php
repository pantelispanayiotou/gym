<?php session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>MS Fit Care Gym | Services </title>
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
        <a class="nav-link" href="../registration/login.php"><i class="fas fa-key fa-fw"></i>Login</a>
            <?php } else { ?>
        <a class="nav-link btn-danger round" id="logout" href="../registration/logout.php"><i class="fas fa-key fa-fw"></i>Logout</a> 
             <?php } ?>
      </li>
    </ul>
    
  </div>
</nav>
    <?php } ?>

<div class="jumbotron shop-cover jumbotron-fluid" id="top-jumpo2">
  <div class="container text-center">
      
      <div class="row">
   <div class="col-md-2"></div>
    <div class="col-md-8"><p> </p> 
          <div class="text-center">
        <h1> Services </h1>
              <p> Have a look at the services that our gym provides. For more information do not hesitate to contact us.</p>
        </div>

          </div>
          <div class="col-md-2"></div>
      </div>
  </div>
</div>
    
    <div class= "container-fluid  merge-button">
    
        <div class="row add justify-content-center">
        <a href="../booking/index.php" class="btn btn-register round" >Book Service</a>
          <?php  
            if($_SESSION['customer_id']>=1){
     if ($_SESSION['role']=='Admin') { ?>  
         <a href="add-service.html" class="btn btn-primary round add-btn-color">Add Service</a>
         <?php  }
     } ?>
          <div class="modal fade" id="modalAddProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
         <div class="modal-dialog" role="document">
    <div class="modal-content">
        
             </div>
              </div>
</div>
    </div>
        
        
    </div>
    
    <div class="products-section" id="load-products">
    
        <br>
      <br>
       
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
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>

   <script src="services.js"></script>
</body>
</html>
