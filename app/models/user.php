<?php

class User extends BaseModel{
	public $kayttajatunnus, $salasana, $etunimi, $sukunimi;

	function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function authenticate($kayttajatunnus, $salasana){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailija WHERE kayttajatunnus = :kayttajatunnus AND salasana = :salasana LIMIT 1');
		$query->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
		$row = $query->fetch();
		if($row){
			$user = new User(array(
				'kayttajatunnus' => $row['kayttajatunnus'],
				'salasana' => $row['salasana'],
				'etunimi' => $row['etunimi'],
				'sukunimi' => $row['sukunimi']
			));
		}else{
			return null;
		}
	}
}