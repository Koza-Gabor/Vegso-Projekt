<?php
//use PDO;

require('./cors.php');
require('./secrets.php');

$pdo = new PDO('mysql:host=localhost;dbname=' . $secrets['mysqlDb'], $secrets['mysqlUser'], $secrets['mysqlPass']);

if ($development) {
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
}

$resource = strtok($_SERVER['QUERY_STRING'], '=');
require('auth.php');

if ($resource == 'etlap') {
  require('etlap.php');
}
if ($resource == 'felhasznalok') {
  require('felhasznalok.php');
}

echo json_encode($data);