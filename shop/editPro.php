<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../connect.php');
$response = array();

 if (!empty($_POST)) {
     
     $filename = $_FILES['file']['name'];

      if (!empty($filename)) {
    $location = '../uploads/'.$filename;


$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);


$image_ext = array("jpg","png","jpeg","gif");

$response['img_status'] = 0;
if(in_array($file_extension,$image_ext)){
  
  if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
   $response['img_status'] = $location;
  }
}
     $id = $_POST["id"];
     $title = $_POST["ptitle"];
     $description = $_POST["description"];
     $price = $_POST["price"];
    // $picture = $_POST["picture"];
     
		$query = "update products set name=:title, description=:description, img_file=:picture, price=:price where id=:id";
	    $stmt = $DBcon->prepare( $query );
		$stmt->bindParam(':id', $id,PDO::PARAM_INT);
        $stmt->bindParam(':title', $title,PDO::PARAM_STR);
        $stmt->bindParam(':description', $description,PDO::PARAM_STR);
        $stmt->bindParam(':picture', $filename, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price );
     

    
     $stmt->execute();
   
   
     
    echo $json_encode($response);
  
        
        }else {
           $id = $_POST["id"];
     $title = $_POST["ptitle"];
     $description = $_POST["description"];
     $price = $_POST["price"];
    // $picture = $_POST["picture"];
     
		$query = "update products set name=:title, description=:description, price=:price where id=:id";
	    $stmt = $DBcon->prepare( $query );
		$stmt->bindParam(':id', $id,PDO::PARAM_INT);
        $stmt->bindParam(':title', $title,PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price );
                
     $stmt->execute();
    echo $json_encode($response);
        
      }
 }
    ?>