<?php

class OsallistuminenController extends BaseController{
	
	public static function add($id){
		self::check_logged_in();

		$kilpailut = Kilpailu::all();

		View::make('kilpailija/add_osallistuminen.html', array('kilpailut' => $kilpailut, 'kilpailija' => $id));
	}

	public static function store(){
		self::check_logged_in();

		$params = $_POST;
		$attributes = array(
			'kilpailija' => $params['kilpailija'],
			'kilpailu' => $params['kilpailu'],
			);

		$osallistuminen = new Osallistuminen($attributes);

		$osallistuminen->save();

		Redirect::to('/kilpailija', array('message' => 'Kilpailija on lisätty listaukseen!'));	
	}

}