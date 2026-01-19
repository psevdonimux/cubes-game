<?php
require '../php/Box.php';
$box = new Box($_GET['box']);
$color = $_GET['color'] ?? '#3498db';
if(!$box->existsBox()){
	$box->setRegister($_GET['box'], rand(50, 400), rand(50, 400), $color);
}
echo json_encode($box->getXY());
