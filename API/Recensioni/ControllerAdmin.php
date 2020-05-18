<?php 
session_start();
include_once "../Recensioni/RecensioniMySqlDao.php";
include_once "../Recensioni/RecensioniDao.php";
include "../config/DAOFactory.php";
require __DIR__."/RecensioniMySqlDao.php";

class ControllerAdmin {
    public $FactoryDao;
    public function __construct(){
    }
    private function isAdmin(){
        if($_SESSION['username']==null){
            return false;
        }
        return true;
    }

    public function approvaRecensione($id){
        $recensione= new RecensioniMySqlDao();
        $result = $recensione->approvaReview($id);
        return $result;
    }
    public function delateReview($id){
        $recensione= new RecensioniMySqlDao();
        $result = $recensione->deleteReview($id);
        return $result;
        
    }
    public function getReview(){ 
        if($this->isAdmin()){

        
            try{
                
                $recensione = new RecensioniMySqlDao();
                $result = $recensione->readReviewToModerate();
            
            
               return $result;
                
            }catch(Exception $E){
                http_response_code(404); 
                echo json_encode( array("message" => "Nessuna recensione trovata.") ); 
            }
        }
    }
}
?>