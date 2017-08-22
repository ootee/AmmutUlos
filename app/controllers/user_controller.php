<?php

class UserController extends BaseController{
	
	public static function login(){
		View::make('kilpailija/index.html');
	}

	public static function handle_login(){
		$params = $_POST;

		$user = User::authenticate($params['kayttajatunnus'], $params['salasana']);

		if (!$user){
			View::make('home.html', array('error' => 'Väärä käyttäjätunnus tai salasana', 'kayttajatunnus' => $params['kayttajatunnus']));
		}else{
			$_SESSION['user'] = $user->id;

			Redirect::to('/kilpailija', array('message' => 'Tervetuloa ' . $user->etunimi . ' ' . $user->sukunimi . '!'));
		}
	}

	public static function logout(){
		$_SESSION['user'] = null;

		Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
	}
}			