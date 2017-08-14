<?php

class RastiController extends BaseController{
	public static function index(){

		$rasti = Rasti::find($id);

		View::make('rasti/index.html', array('rasti' => $rasti));
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

		Redirect::to('/rasti/' . $rasti->rasti_id, array('message' => 'Rasti on lisätty!'));
	}

	public static function add(){

		View::make('rasti/add.html');
	}

	public static function show($rasti_id){

		$rasti = Rasti::find($rasti_id);

		View::make('rasti/show.html', array('rasti' => $rasti));
	}
}