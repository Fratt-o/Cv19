<?php

class Utente {
    private $conn;
    private $table = "utente";
 
    // attributi
    public $email;
    public $username;
    public $password;
    public $nome;
    public $cognome;
    public $avatar;
    
 
    // constructor
    public function __construct($db,$user=null){
        $this->conn = $db;
        if($user['email']!= null){
            $this->email=$user['email'];
            $this->username=$user['username'];
            $this->avatar=$user['avatar'];
            $this->password=$user['password'];
            $this->nome=$user['nome'];
            $this->cognome=$user['cognome']; 
        }
    }
    function isAdmin($email){

        $query="SELECT username,password FROM Utente WHERE isAdmin=1 AND email='".$email."'";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        echo $query;
        $num = $stmt->rowCount();
        if($num>0){
	 
			// get record details / values
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
			// assign values to object properties
			$this->username = $row['username'];
			$this->password = $row['password'];
	 
            // return true because email exists in the database
            
			return true;
		}
        return false;
    }

    
    function read(){
        
        $query = "SELECT a.username, a.nome, a.cognome a.avatar FROM " .$this->table ." a " ; 
        $stmt = $this->conn->prepare($query);
	$stmt->execute();
	return $stmt;
    }
    
    function create(){
        $query = "INSERT INTO Utente
            SET
                nome = :nome,
                cognome = :cognome,
                email = :email,
                avatar = :avatar,
                password = :password,
                username = :username";
       
        $stmt = $this->conn->prepare($query);
        
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->cognome=htmlspecialchars(strip_tags($this->cognome));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->username= htmlspecialchars(($this->username));
        $this->password=htmlspecialchars(strip_tags($this->password));
        
        
        // binding
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":cognome", $this->cognome); 
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":avatar", $this->avatar);       
       
        //hash della password
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT); 
		$this->password = $password_hash;
        $stmt->bindParam(":password", $password_hash);
        
        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    
    function isValidUsername($username){
		if (strlen($username) < 3) return false;
		if (strlen($username) > 17) return false;
		if (!ctype_alnum($username)) return false;
		return true;
	}
    
    
    function emailExists($check_email){
    
	   $check_email=htmlspecialchars(strip_tags($check_email));
		// query to check if email exists
		$query = 
				"SELECT username, password, avatar, nome, cognome
				FROM Utente
				WHERE email = '".$check_email."'";
		$stmt = $this->conn->prepare( $query );

		$stmt->bindParam('s', $check_email);

		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if email exists, assign values to object properties for easy access and use for php sessions
		if($num>0){
	 
			// get record details / values
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
			// assign values to object properties
			$this->username = $row['username'];
			$this->password = $row['password'];
            $this->avatar = $row["avatar"];
            $this->nome = $row['nome'];
            $this->cognome = $row['cognome'];
	 
			// return true because email exists in the database
			return true;
		}
	 
		// return false if email does not exist in the database
		return false;
	}

}
?>

