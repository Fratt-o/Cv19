<?php 
    include_once '../Caratteristiche/CaratteristicaMySqlDao.php';
    include_once '../Recensioni/RecensioniMySqlDao.php'; 
    class DAOFactory {
        
        private $db;
        private static $theDao;
        private function __construct() {
        
        }
        public static function getDao(){
            if(DAOFactory::$theDao == null){
                DAOFactory::$theDao = new DAOFactory();
            }
            return DAOFactory::$theDao;
        }
        public function getCaratteristicaDao() {
            return new CaratteristicaMySqlDao();
        }
        public function getRecensioniDao(){
            return new RecensioniMySqlDao();
        }        
    } 

?>