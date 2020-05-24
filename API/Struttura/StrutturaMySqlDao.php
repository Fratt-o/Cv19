<?
    namespace Dao;
    use PDO;
    use Model\Struttura;
    
    include_once '../Struttura/StrutturaMySqlDao.php';
   
    include_once '../Struttura/StrutturaDao.php';
    include_once 'StrutturaDao.php';
    include_once 'db.php';
    include_once 'Struttura.php';
    
    class StrutturaMySqlDao implements StrutturaDao {
          
        public function getStruttureStat(){
            $db = new Database2();
            $query =  "SELECT `idstruttura`,`nomestruttura`,`mediavoto` FROM `Struttura` ORDER BY `mediavoto` ASC ";
            $result = $db->select($query);
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