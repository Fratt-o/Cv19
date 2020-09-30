<?php 

    class validation {

        private static $minString = 2;
        private static $minText=10;
        private static $maxText= 1000;
        private static $maxString = 40;
        private static $minRating = 1;
        private static $minPsw = 7;
        private static $maxRating = 5;
        

        /*
                static password: string = '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]+$';
                static username: string = '^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$';
        */
        public static function isEmail($email){

           
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $email;
            }
            
            throw new Exception('Invalid email');
        }
        public static function isValidPassword($psw){
            $result = validation::isEmpty($psw);
            if($result != false){
                if(preg_match('%^[a-zA-Z0-9]+$%',$psw)){
                   
                    if(strlen($psw)>validation::$minPsw) return $psw;
                }
            }
            throw new Exception('Invalid Password');
        }
        public static function isValidString($str,$type){
            $result = validation::isEmpty($str);
            if($result != false){
                if(preg_match( '%^[a-zA-Z0-9]+$%',$str)){
                    if(strlen($str)>validation::$minString  && strlen($str)< validation::$maxString) return $str;
                }
            }
            throw new Exception('Invalid String :'.$type);
        } 
        public static function isValidText($txt){
            $result = validation::isEmpty($txt);
            if($result != false){    
                if(strlen($txt)>validation::$minText  && strlen($txt)< validation::$maxText) return $txt;
            }
            throw new Exception('Invalid Text');
        }
        public static function isValidInteger($int){
            $result = validation::isEmpty($int);
            if($result!= false){
                if(filter_var($int,FILTER_VALIDATE_INT)){
                    return $int;
                }
            }
            throw new Exception('Invalid Integer');
        }
        public static function isValidRating($rating){
            $result = validation::isEmpty($rating);
            if($result != false){    
                if(filter_var($rating,FILTER_VALIDATE_FLOAT))
                    if((validation::$minRating <= $rating) && $rating < validation::$maxRating) return $rating;
            }
            throw new Exception('Invalid Rating');
        }
        public static function isEmpty($var){
            if(isset($var) && !empty($var) ) return $var;

            return false;
        }

    }



?>
