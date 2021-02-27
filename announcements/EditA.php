<?php
session_start();

include("connect1.php");
include("auth.php");

     $flag=0;
	  
	 mysqli_select_db($conn,"database");
 if(isset($_POST['send'])) {		
    $date = $_POST['date'] ;
	$sub = str_replace("\"", " ",$_POST['subject']);
	$subject = str_replace(";", " ",$sub);
	$mess =str_replace("\"", " ", $_POST['maintext']);
	$message =str_replace(";", " ", $mess);
	$id = $_POST['id']; 

    
	  $sqledit=mysqli_query($conn,"UPDATE announcements SET date='$date', subject='$subject', maintext='$message' where id='$id'"); 
      $flag=1;
       }  
   
  
	


?> 
 
<!DOCTYPE html>
<html lang="en">
<head>
  <title>MS Fit Care Gym | Edit Announcement</title>
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
   
 <div class="login-cover">
  <div class="container text-center">
     <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
              
                <?php $id = $_GET['id']; 
            
    $fetch_ann = mysqli_query($conn,"select * from announcements where id='$id'");
    $fetched_ann=mysqli_fetch_array($fetch_ann); ?>
              
            <h5 class="card-title text-center">Edit an Announcement</h5>
              <?php
            if ($flag ==1) {
                echo '<div class="alert alert-success"><strong>The announcement was updated successfully. </strong>  </div>';
            }
            ?>
            <form action="EditA.php" method="post" class="form-signin">
              <div class="form-label-group">
                  <label for="date">Date</label>
                <input type="date" class="form-control" name="date" value="<?php echo $fetched_ann["date"] ?>" />
                
              </div>

              <div class="form-label-group">
                  <label for="date">Subject</label>
                <input type="text" class="form-control" name="subject" value="<?php echo $fetched_ann["subject"] ?>"/>
                
              </div>
            <div class="form-label-group">
                 <label for="date">Main Text</label>
                <input type="text" class="form-control" name="maintext" value="<?php echo $fetched_ann["maintext"] ?>" />
                
              </div>
             <input name="id" value="<?php echo $id; ?>" type="hidden">
              <input type="submit" class="btn btn-lg btn-primary btn-block text-uppercase" name="send" type="submit" value="Add"/>
           
              
             
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
    
  
    
</body>
</html>
