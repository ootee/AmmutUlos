<?php

class UserController extends BaseController{
	
	public static function login(){
		View::make('kilpailija/index.html');
	}

	public static function handle_login(){
		$params = $_POST;

		$user = User::authenticate($params['kayttajatunnus'], $params['salasana']);

		if (!$user){
			View::make('home.html', array('error' => 'Väärä kättäjätunnus tai salasana', 'kayttajatunnus' => $params['kayttajatunnus']));
		}else{
			$_SESSION['user'] = $user->id;

			Redirect::to('/kilpailija', array('message' => 'Tervetuloa ' . $user->etunimi . ' ' . $user->sukunimi . '!'));
		}
	}
}			