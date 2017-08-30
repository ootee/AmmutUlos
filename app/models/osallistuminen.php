<?php

class Osallistuminen extends BaseModel{
	public $kilpailija, $kilpailu;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function haeOsallistumiset($kilpailija_id){
		$query = DB::connection()->prepare('SELECT * FROM Osallistuminen WHERE kilpailija = :kilpailija_id');
		$query->execute(array('kilpailija_id' => $kilpailija_id));
		$rows = $query->fetchAll();
		$osallistumiset = array();

		foreach ($rows as $row) {
			$osallistumiset[] = new Osallistuminen(array(
				'kilpailija' => $row['kilpailija'],
				'kilpailu' => $row['kilpailu']
				));
		}

		return $osallistumiset;
	}
}