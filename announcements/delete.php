
<?php 
session_start();

include("connect1.php");
include("auth.php");

 
			$id = $_GET['id'];
            mysqli_select_db($conn,"database");
            $sqldel=mysqli_query($conn,"delete from announcements where id='$id'");
            header('Location: announcement.php');
 ?>
 


