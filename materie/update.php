<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../models/materie.php';
 
$database = new Database();
$db = $database->getConnection();
 
$materia = new Materia($db);
 
$data = json_decode(file_get_contents("php://input"));
 
    $corso->id = $data->id;
    $corso->nome = $data->nome;

if($materia->update()){
    http_response_code(200);
    echo json_encode(array("risposta" => "Materia aggiornata"));
}else{
    //503 service unavailable
    http_response_code(503);
    echo json_encode(array("risposta" => "Impossibile aggiornare la materia"));
}
?>