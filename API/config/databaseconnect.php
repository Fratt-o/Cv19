<?php
class Database{
    

    private $host = "localhost";
    private $db_name = "my_cv19ing20";
    private $username = "cv19ing20";
    private $password = "";

    public $type ="mysql";
    public $conn;

    public function __construct(){
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

    }

    public function getConnection(){
 
        $this->conn = null;
        
        
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;

    }
    public function select($query){
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }
    public function insert($insert){
        $stmt = $this->conn->prepare($insert);
    
        $stmt->execute();
    
        return $stmt;
    }

    public function modify($modify){
        $stmt = $this->conn->prepare($modify);
    
        $stmt->execute();
    
        return $stmt;

    }
}
?> 
