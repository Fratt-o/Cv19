<?php 
    include_once '../Struttura/Struttura.php';
    include_once '../Struttura/StrutturaMySqlDao.php';
    include_once '../config/databaseconnect.php';

    class StrutturaMySqlDao implements StrutturaDao {
        private $db;
        public function __construct()
         {
            $this->db = new Database();
         } 
        public function getStruttureStat(){
            $query =  "SELECT `idstruttura`,`nomestruttura`,`mediavoto` FROM `Struttura` ORDER BY `mediavoto` ASC ";
            $result = $this->db->select($query);
            $recensioni = array();
            
            if ($result != null){
                
                while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                    
                    $recensione= new Struttura(" ",$row);
                    array_push($recensioni,$recensione);
                }
            }
            return $recensioni; 
        }

    }

?>