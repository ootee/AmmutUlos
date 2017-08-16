<?php

class Kilpailija extends BaseModel{

	public $kilpailija_id, $etunimi, $sukunimi, $kayttajatunnus, $salasana;

	public function __construct($attributes){
		parent::__construct($attributes);
		//$this->validators = array('validate_required');
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailija ORDER BY kilpailija_id ASC');
		$query->execute();
		$rows = $query->fetchAll();
		$kilpailijat = array();

		foreach ($rows as $row) {
			$kilpailijat[] = new Kilpailija(array(
				'kilpailija_id' => $row['kilpailija_id'],
				'etunimi' => $row['etunimi'],
				'sukunimi' => $row['sukunimi'],
				'kayttajatunnus' => $row['kayttajatunnus'],
				'salasana' => $row['salasana']
			));

		}
		
		return $kilpailijat;
	}

	public static function find($kilpailija_id){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailija WHERE kilpailija_id = :kilpailija_id');
		$query->execute(array('kilpailija_id' => $kilpailija_id));
		$row = $query->fetch();

		if ($row){
			$kilpailija = new Kilpailija(array(
				'kilpailija_id' => $row['kilpailija_id'],
				'etunimi' => $row['etunimi'],
				'sukunimi' => $row['sukunimi'],
				'kayttajatunnus' => $row['kayttajatunnus'],
				'salasana' => $row['salasana']
			));

			return $kilpailija;
		}

		return null;
	}

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Kilpailija 
			(etunimi, sukunimi, kayttajatunnus, salasana) 
			VALUES 
			(:etunimi, :sukunimi, :kayttajatunnus, :salasana) 
			RETURNING kilpailija_id');
		
		$query->bindValue(':etunimi', $this->etunimi, PDO::PARAM_STR);
		$query->bindValue(':sukunimi', $this->sukunimi, PDO::PARAM_STR);
		$query->bindValue(':kayttajatunnus', $this->kayttajatunnus, PDO::PARAM_STR);
		$query->bindValue(':salasana', $this->salasana, PDO::PARAM_STR);

		$query->execute();

		$row = $query->fetch();

		$this->kilpailija_id = $row['kilpailija_id'];
	}

	public function update($kilpailija_id){
		$query = DB::connection()->prepare('UPDATE Kilpailija SET 
			etunimi = :etunimi, 
			sukunimi = :sukunimi,
			kayttajatunnus = :kayttajatunnus,
			salasana = :salasana
			WHERE kilpailija_id = :kilpailija_id');

		$query->bindValue(':kilpailija_id', $this->kilpailija_id, PDO::PARAM_STR);
		$query->bindValue(':etunimi', $this->etunimi, PDO::PARAM_STR);
		$query->bindValue(':sukunimi', $this->sukunimi, PDO::PARAM_STR);
		$query->bindValue(':kayttajatunnus', $this->kayttajatunnus, PDO::PARAM_STR);
		$query->bindValue(':salasana', $this->salasana, PDO::PARAM_STR);
		
		$query->execute();
	}

	public function delete(){
		$query = DB::connection()->prepare('DELETE FROM Kilpailija WHERE kilpailija_id = :kilpailija_id');

		$query->execute(array('kilpailija_id' => $this->kilpailija_id));
	}
}