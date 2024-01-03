<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// includiamo database.php e corsi.php per poterli usare
include_once '../config/database.php';
include_once '../models/materie.php';
// creiamo un nuovo oggetto Database e ci colleghiamo al nostro database
$database = new Database();
$db = $database->getConnection();
// Creiamo un nuovo oggetto Libro
$materia = new Materia($db);
// query products
$stmt = $materia->read();
$num = $stmt->rowCount();
// se vengono trovate materie nel database
if($num>0){
    // array di materie
    $materie_arr = array();
    $materie_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $materia_item = array(
            "id" => $id,
            "nome" => $nome
        );
        array_push($materie_arr["records"], $materia_item);
    }
    echo json_encode($materie_arr);
}else{
    echo json_encode(
        array("message" => "Nessuna materia Trovato.")
    );
}
?>