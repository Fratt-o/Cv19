<?php
class Caratteristica
    {
		private $conn;
		private $table = "Caratteristiche";
		
		public $idcaratteristica;
		public $nomecaratteristica;
		
		//Costruttore
		public function __construct($db,$id=null,$nome=null){
			
			$this->conn = $db;
			if($id!=null){
				$this->idcaratteristica= $id;
				$this->nomecaratteristica = $nome;
			}
		}
	
		
			
		function read($queryModel){
			
			$query = "SELECT * FROM $this->table"; 
			// die($query);
			$stmt = $this->conn->prepare($query);
			
			$stmt->execute();
			return $stmt;
		}
	}
?>
