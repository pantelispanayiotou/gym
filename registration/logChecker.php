<?php
require_once '../connect.php'; 
class LogChecker
{
public function Login($DBcon,$username, $password)
    {
        try {
          
            $query = $DBcon->prepare("SELECT customer_id FROM customers WHERE (username=:username OR email=:username) AND password=:password");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $enc_password = hash('sha256', $password);
            $query->bindParam("password", $enc_password, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_OBJ);
                return $result->customer_id;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
 
    
  /*public function UserDetails($DBcon , $customer_id)
    {
        try {
          
            $query = $DBcon->prepare("SELECT customer_id, name, username, email , role , password , surname , telephone FROM customers WHERE customer_id=:customer_id");
            $query->bindParam("customer_id", $customer_id, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }*/
    
}