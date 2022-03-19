<?php

// allow all OPTIONS REQUEST
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    return true;
}

// list resources what need no authentication
$noAuthResources = [
    'GET' => ['etlap'],
    'POST' => ['felhasznalok=login'],
    'PATCH' => [],
    'DELETE' => []
];

  if (in_array($_SERVER['QUERY_STRING'], $noAuthResources[$_SERVER['REQUEST_METHOD']])) {
    return true;
}

// check the jog
$jog = isset(apache_request_headers()['jog']) ? apache_request_headers()['jog'] : null;

$stmt = $pdo->prepare('SELECT id FROM felhasznalok WHERE jog = ?');
$stmt->execute([$jog]);
if ($stmt->fetch(PDO::FETCH_ASSOC)) {
  return true;
}

http_response_code(401);
die('Authorization error');