<?php



    interface UtenteDao {

        /*public function readAllUsers(){}
        public function createUser($user){}
        public function isAdmin($email,$psw){}
        public function isValidUsername($username){}*/
        public function isRegistred($email,$psw){}
    }


?>