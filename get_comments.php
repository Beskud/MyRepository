<?php

$dbh = new PDO('mysql:host=localhost;dbname=page', 'root', '');
$result = $dbh->query('SELECT * FROM Comment');
$row = $result->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($row);