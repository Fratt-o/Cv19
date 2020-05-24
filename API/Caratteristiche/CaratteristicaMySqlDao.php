<?php 
    include_once '../config/databaseconnect.php'; 
    include_once '../Caratteristiche/Caratteristica.php';
    include_once '../Caratteristiche/CaratteristicaDao.php';
    namespace Dao;
    use PDO;
    use DatabaseCon\Database;
    use Model\Caratteristica;
    class CaratteristicaMySqlDao implements CaratteristicaDao {

        public function readAllCaratteristiche()
        {
            $db = new Database();
            $query = "SELECT * FROM Caratteristiche ";
            
            $result = $db->select($query);
            $caratteristiche = array();
            $caratteristiche['data'] = array();
            if ($result != null){
                
                while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                    
                    $caratteristica= new Caratteristica("",$row['idcaratteristica'],$row['nomecaratteristica']);
                    array_push($caratteristiche['data'],$caratteristica);
                }
            } 
            $caratteristiche['error'] = false;
            return $caratteristiche;
        }
    }


?>