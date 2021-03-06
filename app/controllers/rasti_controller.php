<?php

class RastiController extends BaseController{
	public static function index(){

		$rastit = Rasti::all();

		View::make('rasti/index.html', array('rastit' => $rastit));
	}	

	public static function store(){
		
		$params = $_POST;
		$rasti = new Rasti(array(
			'rastinro' => $params['rastinro'],
			'kuvaus' => $params['kuvaus'],
			'taululkm' => $params['taululkm'],
			'kilpailu' => $params['kilpailu']
		));

		$rasti->save();

		Redirect::to('/kilpailu/' . $rasti->kilpailu, array('message' => 'Rasti on lisätty!'));
	}

	public static function add($id){
		self::check_logged_in();

		View::make('rasti/add.html', array('kilpailu_id' => $id));
	}

	public static function show($rasti_id){

		$rasti = Rasti::find($rasti_id);

		View::make('rasti/show.html', array('rasti' => $rasti));
	}

	public static function edit($id){
		self::check_logged_in();

		$rasti = Rasti::find($id);
		View::make('rasti/edit.html', array('attributes' => $rasti));
	}

	public static function update($id){
		self::check_logged_in();

		$params = $_POST;

		$attributes = array(
			'rasti_id' => $id,
			'rastinro' => $params['rastinro'],
			'kuvaus' => $params['kuvaus'],
			'taululkm' => $params['taululkm'],
			);

		$rasti = new Rasti($attributes);
		$errors = $rasti->errors();

		if(count($errors) == 0){
			$rasti->update($id);

			Redirect::to('/rasti/' . $rasti->rasti_id, array('message' => 'Rastin tiedot on päivitetty!'));
		}else{
			View::make('rasti/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}

	public static function delete($id){
		self::check_logged_in();

		$rasti = new Rasti(array('rasti_id' => $id));
		$rasti->delete();

		Redirect::to('/rasti', array('message' => 'Rasti on poistettu!'));
	}
}