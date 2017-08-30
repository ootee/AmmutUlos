<?php

class KilpailuController extends BaseController{
	public static function index(){

		$kilpailut = Kilpailu::all();

		View::make('kilpailu/index.html', array('kilpailut' => $kilpailut));
	}	

	public static function store(){
		self::check_logged_in();
		
		$params = $_POST;
		$attributes = array(
			'pvm' => $params['pvm'],
			'paikka' => $params['paikka']
		);

		$kilpailu = new Kilpailu($attributes);
		$errors = $kilpailu->errors();

		if (count($errors) == 0){
			$kilpailu->save();
			
			Redirect::to('/kilpailu', array('message' => 'Kilpailu on lisätty!'));
		}else{
			View::make('kilpailu/add.html', array('errors' => $errors, 'attributes' => $attributes));
		}

	}

	public static function add(){

		View::make('kilpailu/add.html');
	}

	public static function show($kilpailu_id){

		$rastit = Rasti::haeKilpailunRastit($kilpailu_id);

		View::make('kilpailu/show.html', array('rastit' => $rastit, 'kilpailu_id' => $kilpailu_id));
	}

	public static function edit($id){
		self::check_logged_in();

		$kilpailu = Kilpailu::find($id);
		View::make('kilpailu/edit.html', array('attributes' => $kilpailu));
	}

		public static function update($id){
		self::check_logged_in();

		$params = $_POST;

		$attributes = array(
			'kilpailu_id' => $id,
			'pvm' => $params['pvm'],
			'paikka' => $params['paikka'],
			);

		$kilpailu = new Kilpailu($attributes);
		$errors = $kilpailu->errors();

		if(count($errors) == 0){
			$kilpailu->update($id);

			Redirect::to('/kilpailu', array('message' => 'Kilpailun tiedot on päivitetty!'));
		}else{
			View::make('kilpailu/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}

	public static function delete($id){
		self::check_logged_in();

		$kilpailu = new Kilpailu(array('kilpailu_id' => $id));
		$kilpailu->delete();

		Redirect::to('/kilpailu', array('message' => 'Kilpailu on poistettu!'));
	}
}