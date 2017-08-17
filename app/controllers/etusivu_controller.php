<?php

class EtusivuController extends BaseController{

  public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
    View::make('home.html');
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
