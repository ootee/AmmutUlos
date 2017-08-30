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

  public function validate_integer($string, $name){
    $error = null;

    if(is_int($string)){
      $error = $name . 'n täytyy olla kokonaisluku!';
    }

    return $error;
  }

  public function validate_integer_input($string, $name){
    $error = null;

    if (!preg_match('/^([0-9]{1,2})$/', $string)) {
      $error = $name . ' saa olla korkeintaan 2 merkkiä pitkä!';
    }

    return $error;
  }

  public function validate_max_length($string, $name, $length){
    $error = null;

    if (strlen($string) > $length){
      $error = $name . ' saa olla korkeintaan ' . $length . ' merkkiä pitkä!';
    }

    return $error;
  }

  public function validate_min_length($string, $name, $length){
    $error = null;

    if (strlen($string) < $length && strlen($string) != 0){
      $error = $name . ' pitää olla vähintään ' . $length . ' merkkiä pitkä!';
    }

    return $error;
  }

  public function validate_date($string){
    $matches = array();
    $pattern = '/^([0-9]{4})\\-([0-9]{1,2})\\-([0-9]{1,2})$/';
    if (!preg_match($pattern, $string, $matches)) return false;
    if (!checkdate($matches[2], $matches[3], $matches[1])) return false;
      return true;
  }

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

