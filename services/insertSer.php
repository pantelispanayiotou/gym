<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../connect.php');
$response = array();

 if (!empty($_POST)) {
     $response = array();
     
     $filename = $_FILES['file']['name'];


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
  
   
    $title = $_POST["title"];
     $description = $_POST["description"];
     $capacity = $_POST["capacity"];
     //$image = $_POST["image"];
     
		$query = "insert into services(title,description,capacity,image) values(:title, :description, :capacity, :image)";
	    $stmt = $DBcon->prepare( $query );
		
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
      $stmt->bindParam(':capacity', $capacity);
        $stmt->bindParam(':image', $filename);
       
     

      
     $stmt->execute();
   
    if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'Service Deleted Successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to delete service ...';
		}
     
    echo $json_encode($response);
  
        
        }
     ?>