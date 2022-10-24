<?php
session_start();

include_once "vendor/autoload.php";
$username = "root";
$password = "73116868";
$hostname = "localhost";
$port     = 3306;
$dbname   = "spotify";

header('Content-Type: application/json; charset=utf-8');

// enable cors
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}