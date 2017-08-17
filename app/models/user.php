<?php

class User extends BaseModel{
	public $id, $kayttajatunnus, $salasana, $etunimi, $sukunimi;

	function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function authenticate($kayttajatunnus, $salasana){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailija WHERE kayttajatunnus = :kayttajatunnus AND salasana = :salasana LIMIT 1');
		$query->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
		$row = $query->fetch();
		
		if($row){
			return new User(array(
				'id' => $row['kilpailija_id'],
				'kayttajatunnus' => $row['kayttajatunnus'],
				'salasana' => $row['salasana'],
				'etunimi' => $row['etunimi'],
				'sukunimi' => $row['sukunimi']
			));

		}else{
			return null;
		}
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailija WHERE kilpailija_id = :id');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if ($row){
			$user = new User(array(
				'id' => $row['kilpailija_id'],
				'etunimi' => $row['etunimi'],
				'sukunimi' => $row['sukunimi'],
				'kayttajatunnus' => $row['kayttajatunnus'],
				'salasana' => $row['salasana']
			));

			return $user;
		}

		return null;
	}
}