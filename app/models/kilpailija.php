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
}