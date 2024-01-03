<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// includiamo database.php e corsi.php per poterli usare
include_once '../config/database.php';
include_once '../models/corsi.php';
// creiamo un nuovo oggetto Database e ci colleghiamo al nostro database
$database = new Database();
$db = $database->getConnection();
// Creiamo un nuovo oggetto Corso
$corso = new Corso($db);
// query products
$stmt = $corso->read();
$num = $stmt->rowCount();
// se vengono trovati Corsi nel database
if($num>0){
    // array di corsi
    $corsi_arr = array();
    $corsi_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $corso_item = array(
            "id" => $id,
            "nome" => $nome,
            "materia" => $materia,
            "posti_disponibli" => $posti_disponibili
        );
        array_push($corsi_arr["records"], $corso_item);
    }
    echo json_encode($corsi_arr);
}else{
    echo json_encode(
        array("message" => "Nessun Corso Trovato.")
    );
}
?>