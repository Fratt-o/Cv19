<?php

header("Access-Control-Allow-Origin: *");

class Struttura
    {
    private $conn;
    private $table = "Struttura";
    /*
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
    public $mediavoto;*/
    //Costruttore
    public function __construct($db){
	$this->conn = $db;
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
    function read($queryModel){
		$page = $queryModel->pagination->page;
		$pageSize = $queryModel->pagination->pageSize;
		$filter = $queryModel->filter;
		
		
		$join = '';
		$where = 'WHERE 1 = 1';
		$groupBy = ' group by idstruttura ';
		$having = '';
		if(isset($filter->categoria)) {
			$where .= " AND categoria = '$filter->categoria' ";
		}
		
		if(isset($filter->caratteristiche) && count($filter->caratteristiche) > 0) {
			$join .= " JOIN StrutturaCaratteristiche sc on s.idstruttura = sc.fkstruttura "; 
			$caratteristiche = implode(',', $filter->caratteristiche);
			$where .= " AND sc.fkcaratteristica in ($caratteristiche)";
			$having = ' having count(idstruttura) = '.count($filter->caratteristiche);
		}
		
		
		
		$limit = $page*$pageSize. ',' . (($page*$pageSize + $pageSize)); 
        $query = "SELECT * FROM Struttura s $join $where $groupBy $having LIMIT $limit"; 
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
		$filter = $queryModel->filter;
		
		$join = '';
		$where = 'WHERE 1 = 1';
		$groupBy = ' group by idstruttura ';
		$having = '';
		if(isset($filter->categoria)) {
			$where .= " AND categoria = '$filter->categoria' ";
		}
		
		if(isset($filter->caratteristiche) && count($filter->caratteristiche) > 0) {
			$join .= " JOIN StrutturaCaratteristiche sc on s.idstruttura = sc.fkstruttura "; 
			$caratteristiche = implode(',', $filter->caratteristiche);
			$where .= " AND sc.fkcaratteristica in ($caratteristiche)";
			$having = ' having count(idstruttura) = '.count($filter->caratteristiche);
		}
			
		
        $query = "SELECT * FROM Struttura s $join $where $groupBy $having"; 
        // die($query);
		$stmt = $this->conn->prepare($query);
		
		$stmt->execute();
		return $stmt;
	}
    
    
    }
?>
