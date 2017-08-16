<?php

class Rasti extends BaseModel{
	public $rasti_id, $rastinro, $kuvaus, $taululkm, $kilpailu;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Rasti ORDER BY rasti_id ASC');
		$query->execute();
		$rows = $query->fetchAll();
		$rastit = array();

		foreach ($rows as $row) {
			$rastit[] = new Rasti(array(
				'rasti_id' => $row['rasti_id'],
				'rastinro' => $row['rastinro'],
				'kuvaus' => $row['kuvaus'],
				'taululkm' => $row['taululkm'],
				'kilpailu' => $row['kilpailu']
				));
		}

		return $rastit;
	}

	// public static function haeKilpailunRastit($id){
	// 	$query = DB::connection()->prepare('SELECT * FROM Rasti WHERE kilpailu = :id');
	// 	$query->execute(array('id' => $id));
	// 	$rows = $query->fetchAll();
	// 	$rastit = array();

	// 	foreach ($rows as $row{
	// 		$rastit[] = new Rasti(array(
	// 			'rasti_id' => $row['rasti_id'],
	// 			'rastinro' => $row['rastinro'],
	// 			'kuvaus' => $row['kuvaus'],
	// 			'taululkm' => $row['taululkm'],
	// 			'kilpailu' => $row['kilpailu']
	// 			));
	// 	}
		
	// 	return $rastit;
	// }

	public static function find($rasti_id){
		$query = DB::connection()->prepare('SELECT * FROM Rasti WHERE rasti_id = :rasti_id LIMIT 1');
		$query->execute(array('rasti_id' => $rasti_id));
		$row = $query->fetch();

		if ($row){
			$rasti = new Rasti(array(
				'rasti_id' => $row['rasti_id'],
				'rastinro' => $row['rastinro'],
				'kuvaus' => $row['kuvaus'],
				'taululkm' => $row['taululkm'],
				'kilpailu' => $row['kilpailu']
				));

			return $rasti;
		}

		return null;
	}	

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Rasti (rastinro, kuvaus, taululkm, kilpailu) VALUES (:rastinro, :kuvaus, :taululkm, :kilpailu) RETURNING rasti_id');

		$query->execute(array('rastinro' => $this->rastinro, 'kuvaus' => $this->kuvaus, 'taululkm' => $this->taululkm, 'kilpailu' => $this->kilpailu));

		$row = $query->fetch();

		$this->rasti_id = $row['rasti_id'];
	}
}