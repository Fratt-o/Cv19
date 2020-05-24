<?php
namespace Model;

header("Access-Control-Allow-Origin: *");

class Struttura
    {
    private $conn;
    private $table = "Struttura";
    
    public $idstruttura;
    public $nomestruttura;
    public $citta;
    public $indirizzo;
    public $provincia;
    public $cap;
    public $email;
    public $telefono;
    public $latitudine;
    public $longitudine;
    public $mediavoto;
    //Costruttore
    public function __construct($db,$row = null){
		$this->conn = $db;
		if($row != null){
				$this->idstruttura = $row['idstruttura'];
				$this->nomestruttura = $row['nomestruttura'];
				$this->mediavoto = $row['mediavoto'];
		}
	}
    
	//Ciao dado
	
	/*
	
	queryModel: {
		filter: {
			categoria: 'Ristorante',
			caratteristiche: [7, 20, 11] //7 Fumatori, 20 WiFi
		},
		pagination: {
			pageSize: 20,
			page: 3
		}
	}
	
	*/
	
	
	
	/*
		SELECT * FROM Struttura s 
		JOIN StrutturaCaratteristiche sc on s.idstruttura = sc.fkstruttura 
		WHERE    
		sc.fkcaratteristica in (arrayCaratteristiche)
		group by idstruttura 
		having count(idstruttura) >= count(arrayCaratteristiche)
	*/
	
	function detail($idStruttura){
        
        $query = "SELECT * "
                . "FROM Struttura s "
				. "WHERE idstruttura = $idStruttura";
        
        $stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	
	
    function read($queryModel){
		$page = $queryModel->pagination->page;
		$pageSize = $queryModel->pagination->pageSize;
		
		$query = $this->buildQuery($queryModel);
		
		$limit = $page*$pageSize. ',' . (($page*$pageSize + $pageSize)); 
        $query .= " LIMIT $limit"; 
		
        // die($query);
		$stmt = $this->conn->prepare($query);
		
		$stmt->execute();
		return $stmt;
    }
    
    function stampacaratteristiche(){
    
        $query = "SELECT a.idcaratteristica, a.nomecaratteristica FROM Caratteristiche a "
                . "INNER JOIN StrutturaCaratteristiche b ON b.fkcaratteristica = a.idcaratteristica "
                . "INNER JOIN Struttura c ON b.fkstruttura = c.idstruttura ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
        
    }
	
	function totalItemsPerFilters($queryModel) {
		$query = $this->buildQuery($queryModel);
        // die($query);
		$stmt = $this->conn->prepare($query);
		
		$stmt->execute();
		return $stmt;
	}
	
	function buildQuery($queryModel) {
		$filter = $queryModel->filter;
		$rating = $filter->rating;
		$name = $filter->nome;
		
		$join = '';
		$where = 'WHERE 1 = 1';
		$groupBy = ' group by idstruttura ';
		$having = '';
		if(isset($filter->categoria)) {
			$where .= " AND categoria = '$filter->categoria' ";
		}
		
		if(isset($name)) {
			$where .= " AND nomestruttura LIKE '$name%' ";
		}
		
		if(isset($filter->caratteristiche) && count($filter->caratteristiche) > 0) {
			$join .= " JOIN StrutturaCaratteristiche sc on s.idstruttura = sc.fkstruttura "; 
			$caratteristiche = implode(',', $filter->caratteristiche);
			$where .= " AND sc.fkcaratteristica in ($caratteristiche)";
			$having = ' having count(idstruttura) = '.count($filter->caratteristiche).' ';
		}
		
		if(isset($rating)){
			$where .= " AND s.mediavoto >= $rating ";
		}
		
        $query = "SELECT * FROM Struttura s $join $where $groupBy $having";
		return $query;
	}
    
    
}
?>
