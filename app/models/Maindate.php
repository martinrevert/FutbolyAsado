<?php

class Maindate extends Eloquent {
	
 protected $table = 'maindate';	
 
 
 public static function getMainDate()
	{
		$fecha = Maindate::find(1);
		return $fecha;
	}

    public static function getDateOnly()
    {
        $fecha = substr (Maindate::getMainDate()->fecha,0,10);
        return $fecha;
    }
	
	
}