<?php
namespace Core;

class DB
{	
	private static $instance;
	private $db;

	public static function Instance()
	{
		if (self::$instance == null) {
			self::$instance = new DB();
		}
		return self::$instance;
	}

	private function __construct()
	{
		setlocale(LC_ALL, 'ru_Ru.UTF8');
		$this->db = new \PDO('mysql:host=localhost;dbname=blog', 'root', '');
		$this->db->exec("SET NAMES UTF8");
		$this->db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
	}
	
	public function query($query)
	{
		$q = $this->db->prepare($query);
		$q->execute();
		
		if($q->errorCode() != \PDO::ERR_NONE){
			$info = $q->errorInfo();
			file_put_contents("error.log", implode('-|-', $info) . "\n", FILE_APPEND);
			die($info[2]);
		}
		
		return $q->fetchAll();
	}
							//$object = [title => 'aa', content => 'ddddd']
	public function insert($table, $object){
		$columns = array();
		$masks = array();

		foreach ($object as $key => $value){
			$columns[] = $key;
			$masks[] = ":$key";

			if ($value === null) {
				$object[$key] = 'NULL';
			}
		}

		$columns_s = implode(',', $columns);
		$masks_s = implode(',', $masks);
		$query = "INSERT INTO $table ($columns_s) VALUES ($masks_s)";

		$q = $this->db->prepare($query);
		$q->execute($object);

		if($q->errorCode() != \PDO::ERR_NONE){
			$info = $q->errorInfo();
			file_put_contents("error.log", implode('-|-', $info) . "\n", FILE_APPEND);
			die($info[2]);
		}

		return $this->db->lastInsertId();
	}

	public function update($table, $object, $where)
	{
		$sets = array();

		foreach ($object as $key => $value) {
			$sets[] = "$key=:$key";

			if ($value === null) {
				$object[$key] = 'NULL';
			}
		}

		$sets_s = implode(',', $sets);
		$query = "UPDATE $table SET $sets_s WHERE $where";

		$q = $this->db->prepare($query);
		$q->execute($object);

		if ($q->errorCode() != \PDO::ERR_NONE) {
			$info = $q->errorInfo();
			file_put_contents("error.log", implode('-|-', $info) . "\n", FILE_APPEND);
			die($info[2]);
		}

		return $q->rowCount();
	}

	public function delete($table, $where){
		$query = "DELETE FROM $table WHERE $where";

		$q = $this->db->prepare($query);
		$q->execute();

		if ($q->errorCode() != \PDO::ERR_NONE){
			$info = $q->errorInfo();
			die($info[2]);
		}

		return $q->rowCount();
	}
}