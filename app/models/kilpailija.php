<?php

class Kilpailija extends BaseModel{

	public $kilpailija_id, $etunimi, $sukunimi, $kayttajatunnus, $salasana, $tuomari, $superuser;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailija');
		$query->execute();
		$rows = $query->fetchAll();
		$kilpailijat = array();

		foreach ($rows as $row) {
			$kilpailijat[] = new Kilpailija(array(
				'kilpailija_id' => $row['kilpailija_id'],
				'etunimi' => $row['etunimi'],
				'sukunimi' => $row['sukunimi'],
				'kayttajatunnus' => $row['kayttajatunnus'],
				'salasana' => $row['salasana'],
				'tuomari' => $row['tuomari'],
				'superuser' => $row['superuser']
			));

			return $kilpailijat;
		}

		return null;
	}

	public static function find($kilpailija_id){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailija WHERE kilpailija_id = :kilpailija_id LIMIT 1');
		$query->execute(array('kilpailija_id' => $kilpailija_id));
		$row = $query->fetch();

		if ($row){
			$kilpailija = new Kilpailija(array(
				'kilpailija_id' => $row['kilpailija_id'],
				'etunimi' => $row['etunimi'],
				'sukunimi' => $row['sukunimi'],
				'kayttajatunnus' => $row['kayttajatunnus'],
				'salasana' => $row['salasana'],
				'tuomari' => $row['tuomari'],
				'superuser' => $row['superuser']
				));

			return $kilpailija;
		}

		return null;
	}

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Kilpailija (etunimi, sukunimi, kayttajatunnus, salasana, tuomari, superuser) VALUES (:etunimi, :sukunimi, :kayttajatunnus, :salasana, :tuomari, :superuser) RETURNING kilpailija_id');
		
		$query->execute(array('etunimi' => $this->etunimi, 'sukunimi' => $this->sukunimi, 'kayttajatunnus' => $this->kayttajatunnus, 'salasana' => $this->salasana, 'tuomari' => $this->tuomari, 'superuser' => $this->superuser));

		$row = $query->fetch();

		$this->kilpailija_id = $row['kilpailija_id'];

	}
}