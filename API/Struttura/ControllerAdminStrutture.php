<?php 
    include_once "StrutturaMySqlDao.php";
   
use Dao\DAOFactory;
use Dao\StrutturaMySqlDao;
use Exception;
    session_start();
    class ControllerAdminStrutture{
        private $dao;
        
        public function __construct(){
           
        }
        private function isAdmin(){
           /* if($_SESSION['username']==null){
                return false;
            }*/
            return true;
        }
        public function getStats()
        {
            if($this->isAdmin()){
                
                       
                try {
    
                    $strutturaDao = new StrutturaMySqlDao();
                    $result = $strutturaDao->getStruttureStat();
                    return $result;
    
                }catch(Exception $E){
                
                    http_response_code(404); 
                    echo json_encode( array("message" => "Nessuna recensione trovata.") ); 
                
                }
            }
        }
    }
?>