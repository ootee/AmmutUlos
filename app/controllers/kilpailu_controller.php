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

		View::make('kilpailu/show.html', array('rastit' => $rastit), array('kilpailu' => $kilpailu_id));
	}
}