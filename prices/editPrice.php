<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../connect.php');
$response = array();

 if (!empty($_POST)) {
     
     $id = $_POST["id"];
     $title = $_POST["ptitle"];
     $description = $_POST["description"];
     $price = $_POST["price"];
   
     
		$query = "update prices set title=:title, price=:price, description=:description where id=:id";
	    $stmt = $DBcon->prepare( $query );
		$stmt->bindParam(':id', $id,PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
       
       
     

      
     $stmt->execute();
   
   
    echo $json_encode($response);
  
        
        }
    ?>