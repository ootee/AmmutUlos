<?php

class KilpailijaController extends BaseController{
	public static function index(){

		$kilpailijat = Kilpailija::all();

		View::make('kilpailija/index.html', array('kilpailijat' => $kilpailijat));
	}

	public static function store(){
		$params = $_POST;
		$kilpailija = new Kilpailija(array(
			'etunimi' => $params['etunimi'],
			'sukunimi' => $params['sukunimi'],
			'kayttajatunnus' => $params['kayttajatunnus'],
			'salasana' => $params['salasana'],
			'tuomari' => $params['tuomari'],
			'superuser' => $params['superuser']
		));

		$kilpailija->save();

		Redirect::to('/kilpailija/' . $kilpailija->kilpailija_id, array('message' => 'Kilpailija on lisätty listaukseen!'));
	}

	public static function add(){

		View::make('kilpailija/add.html');
	}

	public static function show($kilpailija_id){
		$kilpailija = Kilpailija::find($kilpailija_id);

		View::make('kilpailija/show.html', array('kilpailija' => $kilpailija));	
	}
}