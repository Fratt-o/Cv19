<?php 

    interface RecensioniDao {


        public function readAllReview($idStruttura);

        public function readReviewToModerate();
        
        public function insertReview($review); 
    
    }


?>