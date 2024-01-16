<?php
include('./database/database.php');
include('./app/models/materie.php');
include('./app/models/corsi.php');

class Controller
{
    private $conn;
    private $materiaModel;
    private $corsoModel;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->materiaModel = new Materia($db);
        $this->corsoModel = new Corso($db);
    }

    public function getMaterie()
    {
        $materia = new Materia($this->conn);
        // query products
        $stmt = $materia->read();
        $num = $stmt->rowCount();
        // if subjects are found in the database
        if ($num > 0) {
            // array of subjects
            $materie_arr = array();
            $materie_arr["records"] = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $materia_item = array(
                    "id" => $id,
                    "nome" => $nome
                );
                array_push($materie_arr["records"], $materia_item);
            }
            echo json_encode($materie_arr);
        } else {
            echo json_encode(
                array("message" => "Nessuna materia Trovato.")
            );
        }
    }

    public function createMateria()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (!empty($data->id) &&
            !empty($data->nome)
        ) {
            $this->materiaModel->id = $data->id;
            $this->materiaModel->nome = $data->nome;

            if ($this->materiaModel->create()) {
                http_response_code(201);
                echo json_encode(array("message" => "Materia creata correttamente."));
            } else {
                //503 Service Unavailable
                http_response_code(503);
                echo json_encode(array("message" => "Impossibile creare la materia."));
            }
        } else {
            //400 bad request
            http_response_code(400);
            echo json_encode(array("message" => "Impossibile creare la materia, i dati sono incompleti."));
        }
    }

    public function updateMateria()
    {
        $data = json_decode(file_get_contents("php://input"));

        $this->materiaModel->id = $data->id;
        $this->materiaModel->nome = $data->nome;

        if ($this->materiaModel->update()) {
            http_response_code(200);
            echo json_encode(array("risposta" => "Materia aggiornata"));
        } else {
            //503 service unavailable
            http_response_code(503);
            echo json_encode(array("risposta" => "Impossibile aggiornare la materia"));
        }
    }

    public function deleteMateria()
    {
        $data = json_decode(file_get_contents("php://input"));
        $this->materiaModel->id = $data->id;

        if ($this->materiaModel->delete()) {
            http_response_code(200);
            echo json_encode(array("risposta" => "La materia e' stata eliminato"));
        } else {
            //503 service unavailable
            http_response_code(503);
            echo json_encode(array("risposta" => "Impossibile eliminare la materia."));
        }
    }

    public function getCorsi()
    {
        $corso = new Corso($this->conn);
        // query products
        $stmt = $corso->read();
        $num = $stmt->rowCount();
        // if courses are found in the database
        if ($num > 0) {
            // array of courses
            $corsi_arr = array();
            $corsi_arr["records"] = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $corso_item = array(
                    "id" => $id,
                    "nome" => $nome,
                    "materia" => $materia,
                    "posti_disponibili" => $posti_disponibili
                );
                array_push($corsi_arr["records"], $corso_item);
            }
            echo json_encode($corsi_arr);
        } else {
            echo json_encode(
                array("message" => "Nessun Corso Trovato.")
            );
        }
    }

    public function createCorso()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id) &&
            !empty($data->nome) &&
            !empty($data->materia) &&
            !empty($data->posti_disponibili)
        ) {
            $this->corsoModel->id = $data->id;
            $this->corsoModel->nome = $data->nome;
            $this->corsoModel->materia = $data->materia;
            $this->corsoModel->posti_disponibili = $data->posti_disponibili;

            if ($this->corsoModel->create()) {
                http_response_code(201);
                echo json_encode(array("message" => "Corso creato correttamente."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Impossibile creare il corso."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Impossibile creare il corso, i dati sono incompleti."));
        }
    }

    public function updateCorso()
    {
        $data = json_decode(file_get_contents("php://input"));

        $this->corsoModel->id = $data->id;
        $this->corsoModel->nome = $data->nome;
        $this->corsoModel->materia = $data->materia;
        $this->corsoModel->posti_disponibili = $data->posti_disponibili;

        if ($this->corsoModel->update()) {
            http_response_code(200);
            echo json_encode(array("risposta" => "Corso aggiornato"));
        } else {
            //503 service unavailable
            http_response_code(503);
            echo json_encode(array("risposta" => "Impossibile aggiornare il Corso"));
        }
    }

    public function deleteCorso()
    {
        $data = json_decode(file_get_contents("php://input"));

        $this->corsoModel->id = $data->id;

        if ($this->corsoModel->delete()) {
            http_response_code(200);
            echo json_encode(array("risposta" => "Il corso e' stato eliminato"));
        } else {
            //503 service unavailable
            http_response_code(503);
            echo json_encode(array("risposta" => "Impossibile eliminare il corso."));
        }
    }
}
