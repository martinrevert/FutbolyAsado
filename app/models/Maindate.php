<?php

class Maindate extends Eloquent {
	
 protected $table = 'maindate';	
 
 
 public static function getMainDate()
	{
		$fecha = Maindate::find(1);
		return $fecha;
	}
	
	
}