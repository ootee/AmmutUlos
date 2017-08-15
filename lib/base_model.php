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

  // public function validate_required($string){
  //   $errors = array();
  //   if ($string == '' || $string == null){
  //     $errors[] = 'Syöte ei saa olla tyhjä!';
  //   }

  //   return $errors;
  // }

  // public function validate_numeric($string){
  //   $errors = array();
  //   if(!is_numeric($string)){
  //     $errors[] = 'Syötteen täytyy olla luku!';
  //   }

  //   return $errors;
  // }

  // public function validate_date(){
  //   //todo
  // }

  // public function errors(){
  //     // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
  //   $errors = array();

  //   foreach($this->validators as $validator){
  //       // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
  //     $this->{$validator}();
  //     $errors = array_merge($errors, $validator);
  //   }

  //   return $errors;
  // }

}
