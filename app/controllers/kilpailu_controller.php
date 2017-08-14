<?php

class KilpailuController extends BaseController{
	public static function index(){

		$kilpailut = Kilpailu::all();

		View::make('kilpailu/index.html', array('kilpailut' => $kilpailut));
	}	

	public static function store(){
		
		$params = $_POST;
		$kilpailu = new Kilpailu(array(
			'pvm' => $params['pvm'],
			'paikka' => $params['paikka']
		));

		$kilpailu->save();

		Redirect::to('/kilpailu/' . $kilpailu->kilpailu_id, array('message' => 'Kilpailu on lisätty!'));
	}

	public static function add(){

		View::make('kilpailu/add.html');
	}

	public static function show($kilpailu_id){

		$kilpailut = Rasti::all();

		View::make('kilpailu/show.html', array('kilpailut' => $kilpailut));
	}
}