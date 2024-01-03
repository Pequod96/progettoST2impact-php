<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../models/corsi.php';
 
$database = new Database();
$db = $database->getConnection();
$corso = new Corso($db);
$data = json_decode(file_get_contents("php://input"));
if(
    !empty($data->id) &&
    !empty($data->nome) &&
    !empty($data->materia) &&
    !empty($data->posti_disponibili)
){
    $corso->id = $data->id;
    $corso->nome = $data->nome;
    $corso->materia = $data->materia;
    $corso->posti_disponibili = $data->posti_disponibili;
 
    if($corso->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Libro creato correttamente."));
    }
    else{
        //503 servizio non disponibile
        http_response_code(503);
        echo json_encode(array("message" => "Impossibile creare il corso."));
    }
}
else{
    //400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Impossibile creare il corso i dati sono incompleti."));
}
?>

