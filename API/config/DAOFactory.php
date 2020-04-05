<?php 
    include_once '../Caratteristiche/CaratteristicaMySqlDao.php'; 
    class DAOFactory {
        
        private $db;
        private static $theDao;
        private function __construct() {
        
        }
        public static function getDao(){
            if($this->theDao == null){
                $this->theDao = new DAOFactory();
            }
            return $this->theDao;
        }
        public function getCaratteristicaDao()  {
            return new CaratteristicaMySqlDao();
        }        
    } 

?>