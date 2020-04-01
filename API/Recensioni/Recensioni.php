<?php

header("Access-Control-Allow-Origin: *");

class Recensioni{
    private $conn;
  //  private $table_rec = "recensioni";
   // private $table_user = "utente";
    protected $idRecensione;
    public $voto;
    public $titolo;
    public $testo;
    public $fkutente;
    public $fkstruttura;
    protected $isEnable;
    
    public function __construct($db){
	$this->conn = $db;
	}
    
    function read($idStruttura){
        
		"SELECT * from RECENSIONI where fkstrutture = :idStruttura";
		 
		
		
        $query = "SELECT a.titolo, a.testo, a.voto, a.fkutente, b.username, a.fkstrutture "
                . "FROM Recensioni a "
                . "INNER JOIN Utente b "
                . "ON a.fkutente = b.email " 
				. "WHERE fkstrutture = :idStruttura and abilitazioneadmin = 1"
        
		
        $stmt = $this->conn->prepare($query);
		$stmt->bindParam(":idStruttura", $idStruttura);
		$stmt->execute();
		return $stmt;
    }
    
    //nun t scurdà se nun va buon e colpa della query
    function create($review){
        $query = "INSERT INTO Recensioni
            	(voto,titolo,testo,fkutente,fkstrutture	)
                VALUES (:voto,:titolo,:testo,:fkutente,:fkstrutture)";
                
       
        $stmt = $this->conn->prepare($query);
        
        $this->titolo=htmlspecialchars(strip_tags($review->titolo));
        $this->testo=htmlspecialchars(strip_tags($review->testo));
        $this->fkutente= htmlspecialchars(strip_tags($review->fkutente));
        $this->fkstruttura = $review->fkstruttura;
        $this->voto = $review->voto;

        //$stmt->bindParam('isssi',$this->voto,$this->titolo,$this->testo,$this->fkutente,$this->fkstruttura);
        // binding
        
        $stmt->bindParam(":titolo", $this->titolo);
        $stmt->bindParam(":testo", $this->testo); 
        $stmt->bindParam(":voto", $this->voto);  
        $stmt->bindParam(":fkutente", $this->fkutente);
        $stmt->bindParam(":fkstrutture",$this->fkstruttura);
        
        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
}

}