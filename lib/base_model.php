<?php

class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
  protected $validators;

  public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
    foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
      if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
        $this->{$attribute} = $value;
      }
    }
  }

  public function validate_required($string, $name){
    $error = null;

    if (strlen($string) == 0 || $string == null){
      $error = $name . ' ei saa olla tyhjä!';
    }

    return $error;
  }

  public function validate_numeric($string, $name){
    $errors = null;

    if(!is_numeric($string)){
      $error = $name . ' täytyy olla luku!';
    }

    return $error;
  }

  // public function validate_date(){
  //   //todo
  // }

  public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
    $errors = array();

    foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
      $errors = array_merge($errors, $this->{$validator}());
    }

    return array_filter($errors);
  }

}

