<?php 
session_start();
include("../announcements/auth.php");
include("../announcements/connect1.php");


            $id = $_GET['customer_id'];

            mysqli_select_db($conn,"database");
            $sqldel=mysqli_query($conn,"delete from customers where customer_id='$id'");
            header("Location: seeUsers.php")
            ?>
           
               
