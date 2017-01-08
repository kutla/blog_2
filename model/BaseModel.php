<?php

namespace model;

use Core\DB;

class BaseModel
{
	protected $pdo;
	protected $table;
	protected $pkey;

	public function __construct()
	{
		$this->pdo = DB::Instance();
	}

	public function all() {
		return $this->pdo->query("SELECT * FROM {$this->table}");
	}

	public function get($id) {
		return $this->pdo->query("SELECT * FROM {$this->table} WHERE {$this->pkey}='$id'")[0];
	}

	public function add($object) {
		return $this->pdo->insert($this->table, $object);
	}

	public function edit($object, $id) {
		return $this->pdo->update($this->table, $object, "$this->pkey = '$id'");
	}

	public function delete($id) {
		return $this->pdo->delete($this->table, "$this->pkey = '$id'");
	}
}