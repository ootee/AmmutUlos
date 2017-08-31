<?php

class Osallistuminen extends BaseModel{
	public $kilpailija, $kilpailu, $pvm, $paikka, $kilpailijalkm;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function haeOsallistumiset($kilpailija_id){
		$query = DB::connection()->prepare('SELECT Kilpailu.kilpailu_id, Kilpailu.pvm, Kilpailu.paikka, count(kilpailija) AS kilpailijalkm FROM Kilpailu JOIN Osallistuminen ON Kilpailu.kilpailu_id = Osallistuminen.kilpailu WHERE Osallistuminen.kilpailija = :kilpailija_id GROUP BY Kilpailu.kilpailu_id ORDER BY Kilpailu.pvm DESC');
		$query->execute(array('kilpailija_id' => $kilpailija_id));
		$rows = $query->fetchAll();
		$osallistumiset = array();

		foreach ($rows as $row) {
			$osallistumiset[] = new Osallistuminen(array(
				'kilpailu' => $row['kilpailu_id'],
				'pvm' => $row['pvm'],
				'paikka' => $row['paikka'],
				'kilpailijalkm' => $row['kilpailijalkm']
				));
		}

		return $osallistumiset;
	}

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Osallistuminen 
			(kilpailija, kilpailu) 
			VALUES 
			(:kilpailija, :kilpailu)
			');
		
		$query->bindValue(':kilpailija', $this->kilpailija, PDO::PARAM_STR);
		$query->bindValue(':kilpailu', $this->kilpailu, PDO::PARAM_STR);

		$query->execute();
	}

}