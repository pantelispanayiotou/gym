
<?php 
require_once('../connect.php');
$response = array();

 if (!empty($_POST)) {
     $response = array();
  
             $title = $_POST["ptitle"];
     $description = $_POST["description"];
     $price = $_POST["price"];
     $picture = $_POST["picture"];
     
		$query = "insert into products(name,description,img_file,price) values(:title, :description, :picture, :price)";
	    $stmt = $DBcon->prepare( $query );
		
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':picture', $picture);
        $stmt->bindParam(':price', $price);
     

      
     $stmt->execute();
   
    if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'Product Deleted Successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to delete product ...';
		}
     
    echo $json_encode($response);
  
        
        }
     