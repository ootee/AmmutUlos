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
			'salasana' => $params['salasana']
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

	public static function edit($id){
		$kilpailija = Kilpailija::find($id);
		View::make('kilpailija/edit.html', array('kilpailija' => $kilpailija));
	}

	public static function update($id){
		$params = $_POST;

		$attributes = array(
			'kilpailija_id' => $id,
			'etunimi' => $params['etunimi'],
			'sukunimi' => $params['sukunimi'],
			'kayttajatunnus' => $params['kayttajatunnus'],
			'salasana' => $params['salasana']
		);

		$kilpailija = new Kilpailija($attributes);


		//$errors = $kilpailija->errors();

		// if(count($errors) > 0){
		// 	View::make('kilpailija/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		// }else{
		$kilpailija->update($id);

		Redirect::to('/kilpailija/' . $kilpailija->kilpailija_id, array('message' => 'Kilpailijan tiedot on päivitetty!'));
		 //}
	}

	public static function delete($id){
		$kilpailija = new Kilpailija(array('kilpailija_id' => $id));
		$kilpailija->delete();

		Redirect::to('/kilpailija', array('message' => 'Kilpailija on poistettu!'));
	}
}