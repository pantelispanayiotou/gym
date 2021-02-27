<?php
session_start();
include("../announcements/connect1.php");
include("../announcements/GeneralAuth.php");

   


?> 
<html>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> MS Fit Care Gym | Profile</title>
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
          <a class="nav-link" href="profile.php"> <i class="fas fa-user fa-fw"></i>Profile</a>
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
    
    <div class="jumbotron profile-cover jumbotron-fluid" id="top-jumpo">
  <div class="container text-center">
        <?php  if($_SESSION['customer_id']>=1){
     if ($_SESSION['role']=='Admin') { ?>
      <a href="seeUsers.php" class="btn btn-lg btn-success round float-right">Users Management</a>
       <?php  }
     } ?>
      <h1 class="text-center welcome">Profile</h1>
      <div class="row main-content">
  
    <div class="col-sm-9 col-md-8 col-lg-6">
         <?php $id = $_SESSION['customer_id']; 
    $fetch_ann = mysqli_query($conn,"select * from customers where customer_id='$id'");
    $fetched_ann=mysqli_fetch_array($fetch_ann); ?>
     
        <div class="card card-signin">
        <div class="card-body">
            <h5 class="card-title text-center manage-title">Manage Your Profile</h5>
     <form class="form-signin" action="profile.php?id=<?php echo $id;?>" method="post"> 
 <div class="form-label-group">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" class="form-control" value="<?php echo $fetched_ann["name"] ?>">
         </div>
  <div class="form-label-group">
    <label for="name">Surname</label>
    <input type="text" id="surname" name="surname" class="form-control"  value="<?php echo $fetched_ann["surname"] ?>">
         </div>
     <div class="form-label-group">
    <label for="Email">Email</label>
    <input type="email" id="email" name="email"  class="form-control"value="<?php echo $fetched_ann["email"] ?>">
         </div>
          <div class="form-label-group">
    <label for="Username">Username</label>
    <input type="text" id="username" name="username" class="form-control" value="<?php echo $fetched_ann["username"] ?>">
         </div>
          <div class="form-label-group">
    <label for="Telephone">Telephone</label>
    <input type="number" id="telephone" name="telephone" class="form-control" value="<?php echo $fetched_ann["telephone"] ?>">
         </div>
      
         <?php   if(!empty($_SESSION['program'])){      ?>
        
          <a href="<?php echo $_SESSION['program'] ?>" class="btn btn-lg btn-block btn-danger text-uppercase ">Download Program</a>

<?php  } else{
         $user='Admin';
        if(strcmp($user,$_SESSION['role'])!=0){ ?>
            <a class="btn btn-lg btn-block btn-danger text-uppercase disabled">Download Program</a> 
       <?php  }
           } ?> 
         
    <input type="submit" class="btn btn-lg btn-primary btn-block text-uppercase" name="send" type="submit" value="Change info"/>
    
       <a href="resetPass.php" class="btn btn-lg btn-success btn-block text-uppercase">Reset Password</a>

  </form>
            </div>
        </div>

          </div>
         
      </div>
  </div>
</div>
    <div class="profile-section mx-auto">
        <div class="container ">
            <h1 class="text-center py-3" id="book-h1"> Bookings </h1>
            <p class="text-center" id="book-p"> You can see below, all the bookings you have made throught our website.</p>
            <br>
        <?php 
     $role=$_SESSION['role'];
    $user=$_SESSION['username'];
   
     
$sql9 = "SELECT COUNT(*) from book WHERE username='$user'and canceled=0";
         $use = mysqli_query($conn, $sql9);
         $row9 = mysqli_fetch_array($use);
        $userows=$row9[0];
    
    $sql10 = "SELECT * FROM book WHERE username='$user'and canceled=0";
						
			$result10 = mysqli_query($conn, $sql10);
    
    $c=0;
    if ($userows > 0) {
  
        while ($row10 = mysqli_fetch_assoc($result10)) { ?>
            <div class="row bookings">
               
            <div class="col-md-3">
                <p >Booking ID: <?php echo $row10["id"]; ?></p>
            </div>
            <div class="col-md-3">
             <p> Service: <?php echo $row10["service"]; ?></p>
            </div>
             <div class="col-md-3">
               <p>Date: <?php echo date('m/d/Y',$row10["day"]);?></p>
            </div>
             <div class="col-md-3">
               <p>Time: <?php echo $row10["time"]; ?></p>
            </div>
             
            </div>
            <br>
   <?php } } else {
       echo '<h1> No bookings to show</h1>';
        }
    
    ?>
            <br>
        </div>
        </div>
    
    
     <?php 
   
	 mysqli_select_db($conn,"database");
    if(isset($_POST['send'])) {		
     $nam = str_replace("\"", " ",$_POST['name']) ;
	$name = str_replace(";", " ",$nam) ;
     $surnam = str_replace("\"", " ",$_POST['surname']) ;
     $surname = str_replace(";", " ",$surnam) ;
     $emai =str_replace("\"", " ", $_POST['email']) ;
     $email =str_replace(";", " ", $emai) ;
     $usernam= str_replace("\"", " ",$_POST['username']) ;
     $username = str_replace(";", " ",$usernam) ;
     $telephon = str_replace("\"", " ",$_POST['telephone']) ;
     $telephone = str_replace(";", " ",$telephon) ;
       
 	if (empty(trim($name))) {
        $name= $fetched_ann["name"];
            }
	if (empty(trim($surname))) {
        $surname= $fetched_ann["surname"];
            }
	if (empty(trim($email))) {
        $email= $fetched_ann["email"];
            }
	if (empty(trim($username))) {
        $username= $fetched_ann["username"];
            }
	if (empty(trim($telephone))) {
        $telephone= $fetched_ann["telephone"];
            }

        $query1 = mysqli_query($conn,"SELECT * FROM customers WHERE email='$email'");
        $num_rows1 = mysqli_num_rows($query1);
        $query2= mysqli_query($conn,"SELECT * FROM customers WHERE username='$username'");
        $num_rows2 = mysqli_num_rows($query2);
	
	
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address!";
        }else if((strcmp($email,$_SESSION['email'])!=0)&&$num_rows1>0){
            $query1 = mysqli_query($conn,"SELECT customer_id FROM customers WHERE email='$email'");
            while ($row = mysqli_fetch_assoc($query1))
            $numid=$row['customer_id'];
            echo "hey" .$numid;
            echo "hi" .$id;
            if($numid!=$id){
        echo "Email " .$email .  " is already in use!";
            }else{
            $sqledit=mysqli_query($conn,"UPDATE customers SET name='$name' , surname='$surname' , email='$email' , username='$username' where customer_id='$id'");  
            $query1 = mysqli_query($conn,"SELECT surname , name , email , telephone , username FROM customers WHERE customer_id='$id'");
            while($row =mysqli_fetch_assoc($query1)) {
            $_SESSION['surname']=$row["surname"];
            $_SESSION['name']= $row["name"];
            $_SESSION['email']= $row["email"];
            $_SESSION['telephone']=$row["telephone"];
            $_SESSION['username']=$row["username"];
            }
         header('Location: profile.php');      
            }
         }else if((strcmp($username,$_SESSION['username'])!=0)&&$num_rows2>0){
        $query1 = mysqli_query($conn,"SELECT customer_id FROM customers WHERE username='$username'");
            while ($row = mysqli_fetch_assoc($query1))
            $numid=$row['customer_id'];
            
        if($numid!=$id){
        echo "Username " .$username .  " is already in use!";
        }else{
            $sqledit=mysqli_query($conn,"UPDATE customers SET name='$name' , surname='$surname' , email='$email' , username='$username' where customer_id='$id'");
            $query1 = mysqli_query($conn,"SELECT surname , name , email , telephone , username FROM customers WHERE customer_id='$id'");
            while($row =mysqli_fetch_assoc($query1)) {
            $_SESSION['surname']=$row["surname"];
            $_SESSION['name']= $row["name"];
            $_SESSION['email']= $row["email"];
            $_SESSION['telephone']=$row["telephone"];
            $_SESSION['username']=$row["username"];
            }
echo '<meta http-equiv="refresh" content="0">';
         }
            
         }else{
        
   $sqledit=mysqli_query($conn,"UPDATE customers SET name='$name' , surname='$surname' , email='$email' , username='$username' , telephone='$telephone' where customer_id='$id'");
            $query1 = mysqli_query($conn,"SELECT surname , name , email , telephone , username FROM customers WHERE customer_id='$id'");
            while($row =mysqli_fetch_assoc($query1)) {
            $_SESSION['surname']=$row["surname"];
            $_SESSION['name']= $row["name"];
            $_SESSION['email']= $row["email"];
            $_SESSION['telephone']=$row["telephone"];
            $_SESSION['username']=$row["username"];
            }
     
    echo '<meta http-equiv="refresh" content="0">';} } ?>
    
 
    
    
    
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



 
