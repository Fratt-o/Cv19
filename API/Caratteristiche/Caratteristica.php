<?php
class Caratteristica
    {
		private $conn;
		private $table = "Caratteristiche";
		/*
		public $idcaratteristica;
		public $nomecaratteristica;
		*/
		//Costruttore
		public function __construct($db){
		$this->conn = $db;
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
