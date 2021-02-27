<?php
 session_start();
require_once'regChecker.php';
$app = new Checker();
 
 
$register_error_message = '';

if (!empty($_POST['btnRegister'])) {
   
    $response = $_POST['g-recaptcha-response'];
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $key = '6LeGdJcUAAAAAFdBb3jEgmGOVzHmx3ObeT_ZCc_m';
    $data = array('secret' => $key, 'response' => $response);
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => "POST",
            'content' => http_build_query($data)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if($result === false){
        echo 'Failed to contact reCAPTCHA';
    }else{
        $result = json_decode($result);
        if($result->success){
         
        }else{
            $error = true;
            $register_error_message= 'You did not succesfully complete the captcha, please try again';
        }
    }
   
    
    if (trim($_POST['name']) == "") {
        $register_error_message = 'Name field is required!';
    } else if (trim($_POST['surname']) == "") {
        $register_error_message = 'Surname field is required!';
    } else if ($_POST['tos'] == "") {
        $register_error_message = 'You did not agree to the terms and conditions';
    }
    else if (trim($_POST['email']) == "") {
        $register_error_message = 'Email field is required!';
    } else if (trim($_POST['username']) == "") {
        $register_error_message = 'Username field is required!';
    } else if (trim($_POST['password']) == "") {
        $register_error_message = 'Password field is required!';
    }else if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST['password']) === 0){
        $register_error_message = '<p class="errText">Password must be at least 8 characters and must contain 
	at least one lower case letter, one upper case letter and one digit</p>';
    }else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $register_error_message = 'Invalid email address!';
    } else if ($app->isEmail($DBcon,$_POST['email'])) {
        $register_error_message = 'Email is already in use!';
    } else if ($app->isUsername($DBcon,$_POST['username'])) {
        $register_error_message = 'Username is already in use!';
    } else {
    

        
    $customer_id=$app->Register($DBcon,$_POST['name'],$_POST['surname'],$_POST['telephone'],$_POST['email'], $_POST['username'], $_POST['password'], $_POST['sex'] );
      
        $_SESSION['customer_id'] = $customer_id;
        
        header("Location: register-success.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>MS Fit Care Gym | Register</title>
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
      <div class="col-sm-12 col-md-12 col-lg-9 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Register</h5>
               <?php
             
            if ($register_error_message != "") {
                echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $register_error_message . '</div>';
            }
        
             
            ?>
           <form action="register.php" method="post" class="form-signin">
              <div class="form-label-group">
                <input type="text" id="input" class="form-control" name="name" placeholder="*Name" />
              
              </div>
               <div class="form-label-group">
                <input type="text" class="form-control" name="surname" placeholder="*Surname" />
                
              </div>
               <div class="form-label-group">
                <input type="number" id="inputT" class="form-control" name="telephone" placeholder="Telephone" />
              
              </div>
               <div class="form-label-group">
                <input type="text" id="inputA" class="form-control" name="email" placeholder="*Email address" />
                
              </div>
               <div class="form-label-group">
                <input type="text" class="form-control" name="username" placeholder="*Username" />
                
              </div>
              <div class="form-label-group">
		<h8><span style="font-size: 70%; color:red;">Password must be at least 8 characters and must contain 
	at least one lower case letter, one upper case letter and one digit</span></h8>
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="*Password"/>
                
              </div>
            <div class="form-check-inline">
            <label class="form-check-label">
            <input type="radio" class="form-check-input" value="Male" name="sex">Male
            </label>
            </div>
               <div class="form-check-inline">
            <label class="form-check-label">
            <input type="radio" class="form-check-input" value="Female" name="sex">Female
            </label>
            </div>
            <div class="form-check-inline ">
            <label class="form-check-label">
            <input type="radio" class="form-check-input" value="Other" name="sex">Other
            </label>
            </div>
               <div class="captcha">
                 <div class="g-recaptcha" data-sitekey="6LeGdJcUAAAAAPkXT2gwMtBFK6_JmiNtxa5UQKo5" data-callback="enableBtn"></div>
               </div>
            <div class="tos py-3">
               <input type="checkbox" name = "tos" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">By checking this box you agree to the <a class="tos-terms" data-toggle="modal" data-target="#tosModal">Terms and Conditions of our website.</a></label>
               </div>
             <div class="padding">
              <input type="submit" class="btn btn-lg btn-register btn-block text-uppercase" name="btnRegister" id="submitForm" value="Register"/>
               </div>
               

            </form>
               
          </div>
        </div>
      </div>
      <div class="modal fade" id="tosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MS Fit Care Gym Privacy Policy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body tos-style">
      
          <p>This privacy policy will explain how our organization uses the personal data we collect from you when you use our website.</p>


          <h4>What data do we collect?</h4>
          <p>MS Fit Care Gym collects the following data:</p>

<ul><li>Personal identification information (Name, email address, phone number, gender)</li></ul>

<h4>How do we collect your data?</h4>
<p>You directly provide MS Fit Care Gym with most of the data we collect. We collect data and process data when you:</p>

<ul>
    <li>Register online or place an order for any of our products or services.</li>
    <li>Use or view our website via your browser’s cookies.</li>
          </ul>



<h4>How will we use your data?</h4>
<p>MS Fit Care Gym collects your data so that we can:</p>

<ul><li>Process your order and manage your account.</li></ul>


<h4>How do we store your data?</h4>
<p>MS Fit Care Gym securely stores your data at xyz server which ensures security and confidentiality.</p>

<p>MS Fit Care Gym will keep the data you used to register until you end your subscription. Once this time period has expired, we will delete your data from our database.</p>


<h4>What are your data protection rights?</h4>
<p>MS Fit Care Gym would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>

<ul>
    <li>The right to access – You have the right to request MS Fit Care Gym for copies of your personal data. We may charge you a small fee for this service.</li>
    <li>The right to rectification – You have the right to request that MS Fit Care Gym correct any information you believe is inaccurate. You also have the right to request MS Fit Care Gym to complete the information you believe is incomplete.</li>
    <li>The right to erasure – You have the right to request that MS Fit Care Gym erase your personal data, under certain conditions.</li>
    <li>The right to restrict processing – You have the right to request that MS Fit Care Gym restrict the processing of your personal data, under certain conditions.</li>
    <li>The right to object to processing – You have the right to object to MS Fit Care Gym’s processing of your personal data, under certain conditions.</li>
    <li>The right to data portability – You have the right to request that MS Fit Care Gym transfer the data that we have collected to another organization, or directly to you, under certain conditions.</li>
</ul>


<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us at mspetsioti81@hotmail.com or by phone at: 24726444, 99481883</p>


<h4>Cookies</h4>
<p>Cookies are text files placed on your computer to collect standard Internet log information and visitor behavior information. When you visit our websites, we may collect information from you automatically through cookies or similar technology

For further information, visit allaboutcookies.org.</p>


<h4>How do we use cookies?</h4>
<p>MS Fit Care Gym uses cookies in a range of ways to improve your experience on our website, including:</p>

<ul>
    <li>Keeping you signed in</li>
    <li>Understanding how you use our website</li>
          </ul>


<h4>What types of cookies do we use?</h4>
<p>There are a number of different types of cookies, however, our website uses:</p>

<ul>
    <li>Functionality – MS Fit Care Gym uses these cookies so that we recognize you on our website and remember your previously selected preferences. These could include what language you prefer and location you are in. A mix of first-party and third-party cookies are used.</li>
          </ul>


<h4>How to manage cookies</h4>
<p>You can set your browser not to accept cookies, and the above website tells you how to remove cookies from your browser. However, in a few cases, some of our website features may not function as a result.</p>

<h4>Privacy policies of other websites</h4>
<p>The MS Fit Care Gym website contains links to other websites. Our privacy policy applies only to our website, so if you click on a link to another website, you should read their privacy policy.</p>


<h4>Changes to our privacy policy</h4>
<p>MS Fit Care Gym keeps its privacy policy under regular review and places any updates on this web page. This privacy policy was last updated on 18 March 2019.</p>

<h4>How to contact us</h4>
<p>If you have any questions about MS Fit Care Gym’s privacy policy, the data we hold on you, or you would like to exercise one of your data protection rights, please do not hesitate to contact us.</p>

<p>Email us at: mspetsioti81@hotmail.com</p>
<p>Call us: 24726444, 99481883 </p>
<p>Address: Nikos Theophanous,
Xylophagou 7520, Larnaca</p>
      </div>
     
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
 <script> 
    document.getElementById("submitForm").disabled = true;
     function enableBtn(){
    document.getElementById("submitForm").disabled = false;
   }
    </script>
</body>
</html>
