<?php
require_once '../connect.php'; 

class Checker
{
 
    
    public function Register($DBcon,$name, $surname, $telephone , $email, $username, $password , $sex)
    {
        try {
            //$db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $query = $DBcon->prepare("INSERT INTO customers(name, surname , telephone , email, username, password , sex) VALUES (:name, :surname,:telephone,:email,:username,:password ,:sex)");
            $query->bindParam("name", $name, PDO::PARAM_STR);
            $query->bindParam("surname", $surname, PDO::PARAM_STR);
             $query->bindParam("telephone", $telephone, PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $enc_password = hash('sha256', $password);
            $query->bindParam("password", $enc_password, PDO::PARAM_STR);
            $query->bindParam("sex", $sex, PDO::PARAM_STR);
            $query->execute();
      
             
            return $DBcon->lastInsertId();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
 
   
    public function isUsername($DBcon,$username)
    {
        try {
            //$db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $query = $DBcon->prepare("SELECT customer_id FROM customers WHERE username=:username");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
 
   
    public function isEmail($DBcon,$email)
    {
        try {
          //  $db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $query = $DBcon->prepare("SELECT customer_id FROM customers WHERE email=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
 
    
   
}