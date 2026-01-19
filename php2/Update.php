<?php
require '../php/Box.php';
$box = new Box($_GET['box']);
$color = $_GET['color'] ?? '#3498db';
$box->setXYColor($_GET['x'], $_GET['y'], $color);
