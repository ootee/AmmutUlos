<?php

class Kilpailu extends BaseModel{
	public $kilpailu_id, $pvm, $paikka, $rastilkm;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT Kilpailu.kilpailu_id, Kilpailu.pvm, Kilpailu.paikka, count(*) AS rastilkm FROM Kilpailu LEFT JOIN Rasti ON Kilpailu.kilpailu_id = Rasti.kilpailu GROUP BY Kilpailu.kilpailu_id ORDER BY Kilpailu.kilpailu_id ASC');
		$query->execute();
		$rows = $query->fetchAll();
		$kilpailut = array();

		foreach ($rows as $row) {
			$kilpailut[] = new Kilpailu(array(
				'kilpailu_id' => $row['kilpailu_id'],
				'pvm' => $row['pvm'],
				'paikka' => $row['paikka'],
				'rastilkm' => $row['rastilkm']
			));
		}

		return $kilpailut;
	}

	public static function find($kilpailu_id){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailu WHERE kilpailu_id = :kilpailu_id LIMIT 1');
		$query->execute(array('kilpailu_id' => $kilpailu_id));
		$row = $query->fetch();

		if ($row){
			$kilpailu = new Kilpailu(array(
				'kilpailu_id' => $row['kilpailu_id'],
				'pvm' => $row['pvm'],
				'paikka' => $row['paikka']
			));

			return $kilpailu;
		}

		return null;
	}


	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Kilpailu (pvm, paikka) VALUES (:pvm, :paikka) RETURNING kilpailu_id');
		
		$query->execute(array('pvm' => $this->pvm, 'paikka' => $this->paikka));

		$row = $query->fetch();

		$this->kilpailu_id = $row['kilpailu_id'];
	}

}