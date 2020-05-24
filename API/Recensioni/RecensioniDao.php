<?php 
    namespace Dao;
    interface RecensioniDao {


        public function readAllReview($idStruttura);

        public function readReviewToModerate();
        public function GetReview();
        public function insertReview($review); 
        public function approvaReview($id);
        public function deleteReview($id);
    }


?>