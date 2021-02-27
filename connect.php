
<?php
	
	$DBhost = "localhost";
	$DBuser = "gym";
	$DBpass = "VzuNPZeNYErTHXGT";
	$DBname = "gym";
	
	try{
		
		$DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
		$DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	}catch(PDOException $ex){
		
		die($ex->getMessage());
	}

?>