<?php
include('.././database/database.php');
include('./app/controller/controller.php');

$request_method = $_SERVER['REQUEST_METHOD'];
$request_uri = $_SERVER['REQUEST_URI'];

// Remove any GET parameters from the URI
$uri_parts = explode('?', $request_uri);
$endpoint = rtrim($uri_parts[0], '/');

$controller = new Controller($pdo);

switch ($endpoint) {
    case '/materie':
        if ($request_method === 'GET') {
            $controller->getMaterie();
        } elseif ($request_method === 'POST') {
            $controller->createMateria();
        } else {
            http_response_code(405);
        }
        break;
    case '/materie/update':
        if ($request_method === 'PUT') {
            $controller->updateMateria();
        } else {
            http_response_code(405);
        }
        break;
    case '/materie/delete':
        if ($request_method === 'DELETE') {
            $controller->deleteMateria();
        } else {
            http_response_code(405);
        }
        break;
    case '/corsi':
        if ($request_method === 'GET') {
            $controller->getCorsi();
        } elseif ($request_method === 'POST') {
            $controller->createCorso();
        } else {
            http_response_code(405);
        }
        break;
    case '/corsi/update':
        if ($request_method === 'PUT') {
            $controller->updateCorso();
        } else {
            http_response_code(405);
        }
        break;
    case '/corsi/delete':
        if ($request_method === 'DELETE') {
            $controller->deleteCorso();
        } else {
            http_response_code(405);
        }
        break;
    default:
        http_response_code(404);
        break;
}
