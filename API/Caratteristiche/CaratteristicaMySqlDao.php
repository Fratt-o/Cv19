<?php 
    include_once '../config/databaseconnect.php'; 
    include_once '../Caratteristiche/Caratteristica.php';
    include_once '../Caratteristiche/CaratteristicaDao.php';

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
            return $caratteristiche;
        }
    }


?>