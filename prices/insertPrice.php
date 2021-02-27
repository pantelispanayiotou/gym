<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../connect.php');


 if (!empty($_POST)) {
     $response = array();
  
             $title = $_POST["ptitle"];
     $description = $_POST["description"];
     $price = $_POST["price"];
    
     
		$query = "insert into prices(title,price,description) values(:title, :price, :description)";
	    $stmt = $DBcon->prepare( $query );
		
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
      
     

      
     $stmt->execute();
 
     
    echo $json_encode($response);
  
        
        }
     ?> 