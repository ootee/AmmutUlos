<?php

class Osallistuminen extends BaseModel{
	public $kilpailija, $kilpailu;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	
}