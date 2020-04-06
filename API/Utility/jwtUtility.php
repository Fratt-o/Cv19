<?php 

include_once '../config/core.php';
include_once '../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../libs/php-jwt-master/src/ExpiredException.php';
include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

    class jwtUtility{
        
        // variables used for jwt
        private $key = "example_key";
        private $iss = "http://example.org";
        private $aud = "http://example.com";
        private $iat = 1356999524;
        private $nbf = 1357000000;
        
        
        public function getToken($user){
            $token = array(
                "iss" => $this->iss,
                "exp" => time() + 7200,
                "aud" => $this->aud,
                "iat" => $this->iat,
                "nbf" => $this->nbf,
                "data" => array(
                    "username" => $user->username,
                    "email" => $user->email,
                    "avatar" =>$user->avatar,
                    "nome" => $user->nome,
                    "cognome" => $user->cognome
                )
             );
             return $token;
        }
        public function getEncodeToken($token){
            return JWT::encode($token, $this->key);
        }
    }

?>