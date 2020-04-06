<?php 
    include_once '../config/databaseconnect.php'; 
    include_once 'Utente.php';
    include_once 'UtenteDao.php';
    class UtenteMySqlDao implements UtenteDao{

        public function readAllUsers(){}
        public function createUser($user){}
        public function isAdmin($email,$psw){}
        public function isValidUsername($username){}
        public function isRegistred($email,$psw){

            $db = new Database();
            $query = 
				"SELECT email, username, password, avatar, nome ,cognome
				FROM Utente
                WHERE email = '".$email."'";
   
            $result = $db->select($query);
            $numRow = $result->rowCount();
            if($numRow >0){
                $row = $result->fetch(PDO::FETCH_ASSOC);
 
                $user = new Utente("",$row);
                if(password_verify($psw,$user->password)) return $user;
            }
            return null;
        }
    }


?>