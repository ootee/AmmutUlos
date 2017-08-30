<?php

class KilpailijaController extends BaseController{
	public static function index(){

		$kilpailijat = Kilpailija::all();

		View::make('kilpailija/index.html', array('kilpailijat' => $kilpailijat));
	}

	public static function store(){
		self::check_logged_in();

		$params = $_POST;
		$attributes = array(
			'etunimi' => $params['etunimi'],
			'sukunimi' => $params['sukunimi'],
			'kayttajatunnus' => $params['kayttajatunnus'],
			'salasana' => $params['salasana'],
			'usergroup' => $params['usergroup']
			);

		$kilpailija = new Kilpailija($attributes);
		$errors = $kilpailija->errors();

		if (count($errors) == 0){
			$kilpailija->save();

			Redirect::to('/kilpailija', array('message' => 'Kilpailija on lisätty listaukseen!'));	
		}else{
			View::make('kilpailija/add.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}

	public static function add(){
		self::check_logged_in();

		View::make('kilpailija/add.html');
	}

	public static function show($kilpailija_id){
		$kilpailija = Kilpailija::find($kilpailija_id);
		$osallistumiset = Osallistuminen::haeOsallistumiset($kilpailija_id);

		View::make('kilpailija/show.html', array('kilpailija' => $kilpailija, 'osallistumiset' => $osallistumiset));	
	}

	public static function edit($id){
		self::check_logged_in();

		$kilpailija = Kilpailija::find($id);
		View::make('kilpailija/edit.html', array('attributes' => $kilpailija));
	}

	public static function update($id){
		self::check_logged_in();

		$params = $_POST;

		$attributes = array(
			'kilpailija_id' => $id,
			'etunimi' => $params['etunimi'],
			'sukunimi' => $params['sukunimi'],
			'kayttajatunnus' => $params['kayttajatunnus'],
			'salasana' => $params['salasana']
			);

		$kilpailija = new Kilpailija($attributes);
		$errors = $kilpailija->errors();

		if(count($errors) == 0){
			$kilpailija->update($id);

			Redirect::to('/kilpailija/' . $kilpailija->kilpailija_id, array('message' => 'Kilpailijan tiedot on päivitetty!'));
		}else{
			View::make('kilpailija/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		}

	}

	public static function delete($id){
		self::check_logged_in();

		$kilpailija = new Kilpailija(array('kilpailija_id' => $id));
		$kilpailija->delete();

		Redirect::to('/kilpailija', array('message' => 'Kilpailija on poistettu!'));
	}
}