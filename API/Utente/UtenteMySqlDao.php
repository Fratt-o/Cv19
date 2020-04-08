<?php 
    include_once '../config/databaseconnect.php'; 
    include_once 'Utente.php';
    include_once 'UtenteDao.php';
    class UtenteMySqlDao implements UtenteDao{



        public function createUser($user){
            $db = new Database();
            $query = "INSERT INTO Utente
            SET
                nome = :nome,
                cognome = :cognome,
                email = :email,
                avatar = :avatar,
                password = :password,
                username = :username";
            $result = $db->insert($query,$user);

            if ($result == true){
                return true;
            }
            throw new Exception('Errore: Utente non registrato');
        }

        public function isAdmin($email,$psw){
            $db = new Database();
            $query="SELECT email, username, password, avatar, nome ,cognome FROM Utente WHERE isAdmin=1 AND email='".$email."'";
            $result = $db->select($query);
            $numRow = $result->rowCount();
            if($numRow >0){
                $row = $result->fetch(PDO::FETCH_ASSOC);
 
                $user = new Utente("",$row);
                if(password_verify($psw,$user->password)) return $user;
            }
            return null;

        }
        public function emailExist($email)
        {
            $db = new Database();
            $query = 
				"SELECT email, username, password, avatar, nome ,cognome
				FROM Utente
                WHERE email = '".$email."'";
            $result = $db->select($query);
            $numRow = $result->rowCount();
            if($numRow >0)return true;
            return false;
        }

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