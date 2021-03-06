<?php

class Rasti extends BaseModel{
	public $rasti_id, $rastinro, $kuvaus, $taululkm, $kilpailu;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_pakollinen', 'validate_max_pituus', 'validate_kokokaisluvun_pituus');
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Rasti ORDER BY kilpailu, rasti_id ASC');
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

	public static function haeKilpailunRastit($id){
		$query = DB::connection()->prepare('SELECT * FROM Rasti WHERE kilpailu = :id ORDER BY rastinro ASC');
		$query->execute(array('id' => $id));
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

	public function update($rasti_id){
		$query = DB::connection()->prepare('UPDATE Rasti SET 
			rastinro = :rastinro, 
			kuvaus = :kuvaus,
			taululkm = :taululkm
			WHERE rasti_id = :rasti_id');

		$query->bindValue(':rasti_id', $this->rasti_id, PDO::PARAM_INT);
		$query->bindValue(':rastinro', $this->rastinro, PDO::PARAM_INT);
		$query->bindValue(':kuvaus', $this->kuvaus, PDO::PARAM_STR);
		$query->bindValue(':taululkm', $this->taululkm, PDO::PARAM_INT);
		
		$query->execute();
	}

	public function delete(){
		$query = DB::connection()->prepare('DELETE FROM Rasti WHERE rasti_id = :rasti_id');

		$query->execute(array('rasti_id' => $this->rasti_id));
	}

	public function validate_pakollinen(){
		$errors = array();
		
		$errors[] = parent::validate_required($this->rastinro, 'Rastin numero');
		$errors[] = parent::validate_required($this->kuvaus, 'Kuvaus');
		$errors[] = parent::validate_required($this->taululkm, 'Tauluja');

		return $errors;
	}

	public function validate_max_pituus(){
		$errors = array();

		$errors[] = parent::validate_max_length($this->kuvaus, 'Kuvaus', 100);

		return $errors;
	}

	public function validate_kokokaisluvun_pituus(){
		$errors = array();

		$errors[] = parent::validate_integer_input($this->rastinro, 'Rastin numero');
		$errors[] = parent::validate_integer_input($this->taululkm, 'Tauluja');

		return $errors;
	}
}