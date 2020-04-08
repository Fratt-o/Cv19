<?php



    interface UtenteDao {


        public function createUser($user);
        public function isAdmin($email,$psw);
        public function emailExist($email);
        public function isRegistred($email,$psw);
    }


?>