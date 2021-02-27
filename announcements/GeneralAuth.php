<?php
$check=0;
//$role_check=0;
//$_SESSION['role_check']=0; 


if(isset($_SESSION['customer_id'])){
$check=1;
    
}

if($check==0){
header("Location:  ../registration/login.php");    
}
?>