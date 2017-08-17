<?php

class EtusivuController extends BaseController{

  public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
    View::make('home.html');
  }

  public static function login(){
    View::make('user/login.html');
  }

  public static function handle_login(){
    $params = $_POST;

    $user = User::authenticate($params['kayttajatunnus'], $params['salasana']);

    if (!$user){
      View::make('user/login.html', array('error' => 'Väärä kättäjätunnus tai salasana', 'kayttajatunnus' => $params['kayttajatunnus']));
    }else{
      $_SESSION['user'] = $user->id;

      Redirect::to('/', array('message' => 'Tervetuloa ' . $user->nimi . '!'));
    }
  }

  public static function sandbox(){
      // Testaa koodiasi täällä
    $kipi = new Kilpailija(array(
      'sukunimi' => '',
      'kayttajatunnus' => 'kimkimmo',
      'salasana' => 'qwqweqwe',
      ));

    $errors = $kipi->errors();

    Kint::dump($errors);
  }
}    
