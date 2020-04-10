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
    public $username;
    public $avatar;
	public $nomeMostrato;
    
    public function __construct($db,$review=null){
    $this->conn = $db;
        if($review != null){
            $this->voto = $review['voto'];
            $this->testo = $review['testo'];
            $this->titolo = $review['titolo'];
            $this->fkutente = $review['fkutente'];
            $this->nomeMostrato = $review['nomeMostrato'];
            $this->username =$review['username'];
            $this->fkstruttura = $review['fkstrutture'];
            $this->avatar = $review['avatar'];
        }
	}
    
    function read($idStruttura){
        
        $query = "SELECT a.titolo, a.testo, a.voto, a.fkutente, b.username, a.fkstrutture, b.avatar, a.nomeMostrato "
                . "FROM Recensioni a "
                . "INNER JOIN Utente b "
                . "ON a.fkutente = b.email " 
				. "WHERE fkstrutture = $idStruttura and abilitazioneadmin = 1";
        
        $stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
    }

    // Non toccare il codice sotto
    function readReviewToModerate(){
        $query = "SELECT a.titolo, a.testo, a.voto, a.fkutente, b.username, a.fkstrutture, b.avatar "
                . "FROM Recensioni a "
                . "INNER JOIN Utente b "
                . "ON a.fkutente = b.email " 
                . "WHERE abilitazioneadmin = 0";
                
        $stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
    }
    //ora puoi ottoccare il codice    
    //nun t scurdà se nun va buon e colpa della query
    function create($review){
        $query = "INSERT INTO Recensioni
            	(voto,titolo,testo,fkutente,fkstrutture,nomeMostrato)
                VALUES (:voto,:titolo,:testo,:fkutente,:fkstrutture,:nomeMostrato)";
                
       
        $stmt = $this->conn->prepare($query);
        
        $this->titolo=htmlspecialchars(strip_tags($review->titolo));
        $this->testo=htmlspecialchars(strip_tags($review->testo));
        $this->fkutente= htmlspecialchars(strip_tags($review->fkutente));
        $this->fkstruttura = $review->fkstruttura;
        $this->voto = $review->voto;
		$this->nomeMostrato = $review->nomeMostrato;

        //$stmt->bindParam('isssi',$this->voto,$this->titolo,$this->testo,$this->fkutente,$this->fkstruttura);
        // binding
        
        $stmt->bindParam(":titolo", $this->titolo);
        $stmt->bindParam(":testo", $this->testo); 
        $stmt->bindParam(":voto", $this->voto);  
        $stmt->bindParam(":fkutente", $this->fkutente);
        $stmt->bindParam(":fkstrutture",$this->fkstruttura);
		$stmt->bindParam(":nomeMostrato",$this->nomeMostrato);
        
        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
}

}