<?php
$check=0;


if(isset($_SESSION['customer_id'])){
$check=1;
    
if($_SESSION['role']!='Admin')
 header("Location: ../profile/profile.php");    

}

if($check==0){
header("Location: ../registration/login.php");   
}
?>