<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$databaseHost = $_ENV['DB_HOST'];
$databasePort = $_ENV['DB_PORT'];
$databaseName = $_ENV['DB_DATABASE'];
$databaseUser = $_ENV['DB_USERNAME'];
$databasePassword = $_ENV['DB_PASSWORD'];

?>