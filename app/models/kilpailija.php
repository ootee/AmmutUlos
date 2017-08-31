<?php

class Kilpailija extends BaseModel{

	public $kilpailija_id, $etunimi, $sukunimi, $kayttajatunnus, $salasana, $usergroup;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_pakollinen', 'validate_max_pituus', 'validate_min_pituus');
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
				'salasana' => $row['salasana'],
				'usergroup' => $row['usergroup']
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
				'salasana' => $row['salasana'],
				'usergroup' => $row['usergroup']
				));

			return $kilpailija;
		}

		return null;
	}

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Kilpailija 
			(etunimi, sukunimi, kayttajatunnus, salasana, usergroup) 
			VALUES 
			(:etunimi, :sukunimi, :kayttajatunnus, :salasana, :usergroup) 
			RETURNING kilpailija_id');
		
		$query->bindValue(':etunimi', $this->etunimi, PDO::PARAM_STR);
		$query->bindValue(':sukunimi', $this->sukunimi, PDO::PARAM_STR);
		$query->bindValue(':kayttajatunnus', $this->kayttajatunnus, PDO::PARAM_STR);
		$query->bindValue(':salasana', $this->salasana, PDO::PARAM_STR);
		$query->bindValue(':usergroup', $this->usergroup, PDO::PARAM_STR);

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

		$query->bindValue(':kilpailija_id', $this->kilpailija_id, PDO::PARAM_INT);
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

	public function validate_pakollinen(){
		$errors = array();

		$errors[] = parent::validate_required($this->etunimi, 'Etunimi');
		$errors[] = parent::validate_required($this->sukunimi, 'Sukunimi');
		$errors[] = parent::validate_required($this->kayttajatunnus, 'Käyttäjätunnus');
		$errors[] = parent::validate_required($this->salasana, 'Salasana');

		return $errors;
	}

	public function validate_max_pituus(){
		$errors = array();

		$errors[] = parent::validate_max_length($this->etunimi, 'Etunimi', 30);
		$errors[] = parent::validate_max_length($this->sukunimi, 'Sukunimi', 30);
		$errors[] = parent::validate_max_length($this->kayttajatunnus, 'Käyttäjätunnus', 16);
		$errors[] = parent::validate_max_length($this->salasana, 'Salasana', 16);

		return $errors;
	}

	public function validate_min_pituus(){
		$errors = array();

		$errors[] = parent::validate_min_length($this->kayttajatunnus, 'Käyttäjätunnus', 4);
		$errors[] = parent::validate_min_length($this->salasana, 'Salasana', 4);

		return $errors;
	}

	
}