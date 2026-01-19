<?php
header('Content-Type: application/json');
require '../php/Box.php';
$box = new Box($_GET['box'] ?? '0');
$result = $box->getAllBoxes();
echo json_encode($result);
