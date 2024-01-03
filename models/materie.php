<?php
class Materia
	{
	private $conn;
	private $table_name = "corsi";
	// proprietà di un libro
	public $id;
	public $nome;
	// costruttore
	public function __construct($db)
		{
		$this->conn = $db;
		}
	// READ materie
	function read()
		{
		// select all
		$query = "SELECT
                        a.id, a.nome
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
   
            $query = "INSERT INTO " . $this->table_name . "SET id=:id, nome=:nome";
           
            $stmt = $this->conn->prepare($query);
           
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->nome = htmlspecialchars(strip_tags($this->nome));
           
            // binding
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":nome", $this->nome);
           
         
            if($stmt->execute()){
                return true;
            }
           
            return false;
             
           }
           
           function update(){
 
            $query = "UPDATE
                        " . $this->table_name . "
                    SET
                        nome = :nome
                    WHERE
                        id = :id";
         
            $stmt = $this->conn->prepare($query);
         
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->nome = htmlspecialchars(strip_tags($this->nome));
          
         
            // binding
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":nome", $this->nome);
            // execute the query
            if($stmt->execute()){
                return true;
            }
         
            return false;
        }
	}
?>