<?php 
session_start();
namespace ControllerAdmin;

include_once "../Recensioni/RecensioniMySqlDao.php";
include_once "../Recensioni/RecensioniDao.php";
include "../config/DAOFactory.php";
require __DIR__."/RecensioniMySqlDao.php";

use Dao\RecensioniMySqlDao;
use Exception;
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
    public function getStats()
    {
        if($this->isAdmin()){
            
            try {

                $recensione = new RecensioniMySqlDao();
                $result = $recensione->GetReview();
                return $result;

            }catch(Exception $E){
            
                http_response_code(404); 
                echo json_encode( array("message" => "Nessuna recensione trovata.") ); 
            
            }
        }
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