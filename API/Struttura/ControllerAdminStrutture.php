<?php 
session_start();
include "http://cv19ing20.altervista.org/Cv19/API/config/DAOFactory.php";
    namespace ControllerAdmin;
    use Dao\DAOFactory;
    use Exception;
    class ControllerAdminStrutture{
        private $dao;
        
        public function __construct(){
            

            $this->dao = DAOFactory::getDao();
        }
        private function isAdmin(){
            if($_SESSION['username']==null){
                return false;
            }
            return true;
        }
        public function getStats()
        {
            if($this->isAdmin()){
                
                try {
    
                    $strutturaDao = $this->dao->getStrutturaDao();
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