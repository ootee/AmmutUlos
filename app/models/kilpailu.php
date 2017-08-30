<?php

class Kilpailu extends BaseModel{

	public $kilpailu_id, $pvm, $paikka, $rastilkm;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_pakollinen', 'validate_max_pituus', 'validate_pvm');

	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT Kilpailu.kilpailu_id, Kilpailu.pvm, Kilpailu.paikka, count(rasti_id) AS rastilkm FROM Kilpailu FULL OUTER JOIN Rasti ON Kilpailu.kilpailu_id = Rasti.kilpailu GROUP BY Kilpailu.kilpailu_id ORDER BY Kilpailu.pvm DESC');
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

	public function update($kilpailija_id){
		$query = DB::connection()->prepare('UPDATE Kilpailu SET 
			pvm = :pvm, 
			paikka = :paikka
			WHERE kilpailu_id = :kilpailu_id');

		$query->bindParam(':kilpailu_id', $this->kilpailu_id, PDO::PARAM_INT);
		$query->bindParam(':pvm', $this->pvm, PDO::PARAM_STR);
		$query->bindParam(':paikka', $this->paikka, PDO::PARAM_STR);
		
		$query->execute();
	}

	public function delete(){
		$query = DB::connection()->prepare('DELETE FROM Kilpailu WHERE kilpailu_id = :kilpailu_id');

		$query->execute(array('kilpailu_id' => $this->kilpailu_id));
	}
	
	public function validate_pakollinen(){
		$errors = array();

		$errors[] = parent::validate_required($this->paikka, 'Paikka');

		return $errors;
	}

	public function validate_max_pituus(){
		$errors = array();

		$errors[] = parent::validate_max_length($this->paikka, 'Paikka', 30);

		return $errors;
	}

	public function validate_pvm(){
		$errors = array();

		if (!parent::validate_date($this->pvm)) {
			$errors[] = 'Tarkasta päivämäärä!';
		}

		return $errors;
	}

}