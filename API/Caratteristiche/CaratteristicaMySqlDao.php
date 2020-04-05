<?php 
    include_once '../config/databaseconnect.php'; 
    include_once '../Caratteristiche/Caratteristica.php';
    include_once '../Caratteristiche/CaratteristicaDao.php';

    class CaratteristicaMySqlDao implements CaratteristicaDao {

        public function readAllCaratteristiche()
        {
            $db = new Database();
            $query = "SELECT * FROM Caratteristiche ";
            echo $query;
            $result = $db->select($query);
            $caratteristiche = array();
            $caratteristiche['data'] = array();
            if ($result != null){
                echo "che risultato";
                while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                    echo $row['nomecaratteristica'];
                    echo "\n";
                    $caratteristica= new Caratteristica("",$row['idcaratteristica'],$row['nomecaratteristica']);
                    array_push($caratteristiche['data'],$caratteristica);
                }
            }
            return $caratteristiche;
        }
    }


?>