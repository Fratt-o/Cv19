<?php 

    class velidation {

        private static $minString = 2;
        private static $minText=5;
        private static $maxText= 500;
        private static $maxString = 20;
        private static $minRating = 0;
        private static $minPsw = 6;
        private static $maxRating = 5;
        
        public static function isEmail($email){

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $email;
            }
            return false;
        }
        public static function isValidPassword($psw){
            if(strlen($psw)>$this->minPsw  ) return $psw;

        }
        public static function isValidString($str){
            if(strlen($str)>$this->minString  && strlen($str)< $this->maxString) return $str;
        } 
        public static function isValidText($txt){
            if(strlen($txt)>$this->minText  && strlen($txt)< $this->maxText) return $txt;
        }
        public static function isValidRating($rating){
            if(filter_var($rating,FILTER_VALIDATE_FLOAT))
                if($this->minRating < $rating < $this->maxRating) return $rating;
            
            return false;
        }

    }



?>