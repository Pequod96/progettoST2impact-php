<?php
class Corso
	{
	private $conn;
	private $table_name = "corsi";
	// proprietà di un corso
	public $id;
	public $nome;
	public $materia;
    public $posti_disponibili;
	// costruttore
	public function __construct($db)
		{
		$this->conn = $db;
		}
	// READ corsi
	function read()
		{
		// select all
		$query = "SELECT
                        a.id, a.nome, a.materia, a.posti_disponibili
                    FROM
                   " . $this->table_name . " a ";
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
		}
        
        function delete(){
 
            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
         
         
            $stmt = $this->conn->prepare($query);
         
            $this->id = htmlspecialchars(strip_tags($this->id));
         
         
            $stmt->bindParam(1, $this->id);
         
            // execute query
            if($stmt->execute()){
                return true;
            }
         
            return false;
             
        }

        function create(){
   
            $query = "INSERT INTO " . $this->table_name . "SET id=:id, nome=:nome, materia=:materia, posti_disponibili=:posti_disponibili";
           
            $stmt = $this->conn->prepare($query);
           
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->nome = htmlspecialchars(strip_tags($this->nome));
            $this->materia = htmlspecialchars(strip_tags($this->materia));
            $this->posti_disponibili = htmlspecialchars(strip_tags($this->posti_disponibili));
           
            // binding
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":materia", $this->materia);
            $stmt->bindParam(":posti_disponibili", $this->posti_disponibili);
           
         
            if($stmt->execute()){
                return true;
            }
           
            return false;
             
           }
           
           function update(){
 
            $query = "UPDATE
                        " . $this->table_name . "
                    SET
                        nome = :nome,
                        materia = :materia
                    WHERE
                        id = :id";
         
            $stmt = $this->conn->prepare($query);
         
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->nome = htmlspecialchars(strip_tags($this->nome));
            $this->materia = htmlspecialchars(strip_tags($this->materia));
            $this->posti_disponibili = htmlspecialchars(strip_tags($this->posti_disponibili));
         
            // binding
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":materia", $this->materia);
            $stmt->bindParam(":posti_disponibili", $this->posti_disponibili);
            // execute the query
            if($stmt->execute()){
                return true;
            }
         
            return false;
        }
	}
?>
