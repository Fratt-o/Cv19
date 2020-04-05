<?php 

    interface RecensioniDao {


        public function readAllReview();

        public function readReviewToModerate();
        
        public function insertReview(); 
    
    }


?>