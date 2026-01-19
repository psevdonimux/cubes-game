<?php
require_once __DIR__ . '/Config.php';
class MySqliUp{
	private MySqli $file;
	public function __construct(string $name){
		$db = $name ?: null;
		$this->file = new MySqli(Config::dbHost(), Config::dbUser(), Config::dbPass(), $db);
	}
	public function createDataBase(string $database): void{
		$this->file->query("CREATE DATABASE IF NOT EXISTS $database");
	}
	public function deleteDataBase(string $database): void{
		$this->file->query("DROP DATABASE IF EXISTS $database");
	}
	public function createTable(string $table, string $column): void{
		$this->file->query("CREATE TABLE IF NOT EXISTS $table ($column)");
	}
	public function deleteTable(string $table, string $type): void{
		$this->file->query("DROP TABLE IF EXISTS $table");
	}
	public function createColumn(string $table, string $column): void{
		$this->file->query("ALTER TABLE $table ADD COLUMN $column");
	}
	public function deleteColumn(string $table, string $column): void{
		$this->file->query("ALTER TABLE $table DROP COLUMN $column");
	}
	public function createString(string $table, string $column, string $text): void{
		$this->file->query("INSERT INTO $table ($column) VALUES ($text)");
	}
	public function deleteString(string $table, ?string $where = null): void{
		is_null($where) ? $this->file->query("DELETE FROM $table") : $this->file->query("DELETE FROM $table WHERE $where");
	}
	public function updateString(string $table, string $text, string $where): void{
		$this->file->query("UPDATE $table SET $text WHERE $where");
	}
	public function selectAllString(string $table, ?string $where = null): array|bool{
		$result = is_null($where) ? $this->file->query("SELECT * FROM $table")->fetch_array(MYSQLI_ASSOC) : $this->file->query("SELECT * FROM $table WHERE $where")->fetch_array(MYSQLI_ASSOC);
		return $result == null ? false : $result;
	}
	public function selectString(string $table, string $column, ?string $where = null): array|bool{
		$result = is_null($where) ? $this->file->query("SELECT $column FROM $table")->fetch_array(MYSQLI_ASSOC) : $this->file->query("SELECT $column FROM $table WHERE $where")->fetch_array(MYSQLI_ASSOC);
		return $result == null ? false : $result;
	}
	public function selectCountAllString(string $table, string $type, ?string $where = null): array|bool{
		$result = match($type){
			'notAs' => is_null($where) ? $this->file->query("SELECT COUNT (*) FROM $table")->fetch_array() : $this->file->query("SELECT COUNT (*) FROM $table WHERE $where")->fetch_array(),
			'as' => is_null($where) ? $this->file->query("SELECT COUNT (*) as count FROM $table")->fetch_array() : $this->file->query("SELECT COUNT (*) as count FROM $table WHERE $where")->fetch_array(),
		};
		return $result == null ? false : $result;
	}
	public function selectCountString(string $table, string $column, string $type, ?string $where = null): array|bool{
		$result = match($type){
			'notAs' => is_null($where) ? $this->file->query("SELECT COUNT (DISTINCT $column) FROM $table")->fetch_array() : $this->file->query("SELECT COUNT (DISTINCT $column) FROM $table WHERE $where")->fetch_array(),
			'as' => is_null($where) ? $this->file->query("SELECT COUNT (DISTINCT $column) as count FROM $table")->fetch_array() : $this->file->query("SELECT COUNT (DISTINCT $column) as count FROM $table WHERE $where")->fetch_array(),
		};
		return $result == null ? false : $result;
	}
	public function selectAllArray(string $table, string $column, ?string $where = null): array{
		$query = is_null($where) ? $this->file->query("SELECT $column FROM $table") : $this->file->query("SELECT $column FROM $table WHERE $where");
		$result = $query->fetch_array();
		$array = [];
		while($result !== null){
			$array[] = $result[$column];
			$result = $query->fetch_array();
		}
		return $array;
	}
	public function selectOrderString(string $table, string $column, string $order): array|false{
		$result = $this->file->query("SELECT $column FROM $table ORDER BY $order")->fetch_array();
		return $result == null ? false : $result;
	}
}
