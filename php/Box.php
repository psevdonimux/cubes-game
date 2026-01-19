<?php
require_once __DIR__ . '/MySqliUp.php';
class Box{
	private string $box;
	private MySqliUp $sql;
	private $mysqli;
	public function __construct(string $box){
		$this->box = $box;
		$this->createTables();
	}
	public function createTables(): void{
		$dbName = Config::dbName();
		(new MySqliUp(''))->createDataBase($dbName);
		$this->sql = new MySqliUp($dbName);
		$this->sql->createTable('Box', 'Box TEXT NOT NULL, X TEXT NOT NULL, Z TEXT NOT NULL, Color TEXT');
		$this->mysqli = new MySqli(Config::dbHost(), Config::dbUser(), Config::dbPass(), $dbName);
	}
	public function existsBox(): bool{
		return $this->sql->selectString('Box', 'Box', "Box = '$this->box'") !== false;
	}
	public function setXY(int $x, int $y): void{
		$this->sql->updateString('Box', "X = '$x', Z = '$y'", "Box = '$this->box'");
	}
	public function setXYColor(int $x, int $y, string $color): void{
		$this->mysqli->query("UPDATE Box SET X = '$x', Z = '$y', Color = '$color' WHERE Box = '$this->box'");
	}
	public function getXY(): array{
		$result = $this->mysqli->query("SELECT X, Z, Color FROM Box WHERE Box = '$this->box'")->fetch_assoc();
		return $result ? ['x' => $result['X'], 'y' => $result['Z'], 'color' => $result['Color'] ?: '#3498db'] : ['x' => 100, 'y' => 100, 'color' => '#3498db'];
	}
	public function setRegister(string $box, int $x, int $y, string $color = '#3498db'): void{
		$this->mysqli->query("INSERT INTO Box (Box, X, Z, Color) VALUES ('$this->box', '$x', '$y', '$color')");
	}
	public function getAllBoxes(): array{
		$result = $this->mysqli->query("SELECT Box, X, Z, Color FROM Box");
		$boxes = [];
		if($result){
			while($row = $result->fetch_assoc()){
				$boxes[$row['Box']] = ['x' => $row['X'], 'y' => $row['Z'], 'color' => $row['Color'] ?: '#3498db'];
			}
		}
		return $boxes;
	}
}
