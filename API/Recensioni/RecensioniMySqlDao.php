<?php 
    include_once '../config/databaseconnect.php'; 
    include_once 'Recensioni.php';
    include_once 'RecensioniDao.php';
    require __DIR__."/databaseconnect.php";

    namespace Dao;
    use Model\Recensioni;
    use DatabaseCon\Database;
    use Dao\RecensioniDao;
    use PDO;
    use Exception;
    class RecensioniMySqlDao implements RecensioniDao{

        private $db;

        public function __construct()
         {
            $this->db = new Database();
         } 

         public function readAllReview($idStruttura){
            $query = "SELECT a.titolo, a.testo, a.voto, a.fkutente, b.username, a.fkstrutture, b.avatar, a.nomeMostrato "
            . "FROM Recensioni a "
            . "INNER JOIN Utente b "
            . "ON a.fkutente = b.email " 
            . "WHERE fkstrutture = $idStruttura and abilitazioneadmin = 1";

            $result = $this->db->select($query);
            $recensioni = array();
            $recensioni['data'] = array();
            if ($result != null){
                
                while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                    
                    $recensione= new Recensioni(" ",$row);
                    array_push($recensioni['data'],$recensione);
                }
            } 
            $recensioni['error'] = false;
            return $recensioni;
        }
        public function approvaReview($id){

            $query = "UPDATE Recensioni"
            ." SET abilitazioneadmin = 1" 
            ." WHERE idrecensione = ".$id;
           
            $result = $this->db->select($query);
            return $result; 
        }

        public function GetReview(){
            $query =  "SELECT `idstruttura`,`nomestruttura`,`mediavoto` FROM `Struttura` ORDER BY `mediavoto` ASC ";
            $result = $this->db->select($query);
            $recensioni = array();
            
            if ($result != null){
                
                while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                    
                    $recensione= new Recensioni(" ",$row);
                    array_push($recensioni,$recensione);
                }
            }
            return $recensioni; 
        }


        

        public function deleteReview($id){

            $query ="DELETE FROM Recensioni WHERE idrecensione =".$id;
            $result = $this->db->select($query);
            return $result;
        }

        public function readReviewToModerate(){
            $query = "SELECT a.titolo, a.testo, a.voto, a.fkutente, b.username, a.fkstrutture, b.avatar "
            . "FROM Recensioni a "
            . "INNER JOIN Utente b "
            . "ON a.fkutente = b.email " 
            . "WHERE abilitazioneadmin = 0";

            $query2="SELECT *  "
            . "FROM Recensioni a " 
            . "WHERE abilitazioneadmin = 0";
            $result = $this->db->select($query2);
            
            $recensioni = array();
            
            if ($result != null){
                
                while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                    
                    $recensione= new Recensioni(" ",$row);
                    array_push($recensioni,$recensione);
                }
            } 
            
            return $recensioni;
        }
        
        public function insertReview($review){
            $query = "INSERT INTO Recensioni
            (voto,titolo,testo,fkutente,fkstrutture,nomeMostrato)
            VALUES (:voto,:titolo,:testo,:fkutente,:fkstrutture,:nomeMostrato)";

            $result = $this->db->insert($query,$review);
            if ($result == true){
                return true;
            }
            throw new Exception('Errore: Recensione non inserita');

        } 

    }

?>