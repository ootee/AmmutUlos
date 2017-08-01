<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('suunnitelmat/etusivu.html');
    }

    public static function kilpailulista(){
      View::make('suunnitelmat/kilpailulista.html');
    }

    public static function kilpailulista_edit(){
      View::make('suunnitelmat/kilpailulista_edit.html');
    }

    public static function kilpailu(){
      View::make('suunnitelmat/kilpailu.html');
    }

    public static function kilpailu_edit(){
      View::make('suunnitelmat/kilpailu_edit.html');
    }

    public static function rasti(){
      View::make('suunnitelmat/rasti.html');
    }

    public static function rasti_edit(){
      View::make('suunnitelmat/rasti_edit.html');
    }    

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }
  }
