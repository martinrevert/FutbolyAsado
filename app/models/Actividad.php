<?php

class Actividad extends Eloquent
{

    protected $table = 'actividades';

    public static function Check($uid, $date)
    {
        $registro = DB::select("SELECT * FROM actividades WHERE actividad_uid = ".$uid." and fecha = '".$date."'");

        return $registro;
    }


    public static function CuantosJuegan()
    {
        $juegan = DB::table('actividades')
            ->whereIn('actividad', array('juega', 'comeyjuega'))
            ->get();
        $cuenta = 0;
        foreach ($juegan as $juega) {
            $cuenta++;
        }

        return $cuenta;
    }

    public static function CuantosComen()
    {
        $comen = DB::table('actividades')
            ->whereIn('actividad', array('come', 'comeyjuega'))
            ->get();
        $cuenta = 0;

        foreach ($comen as $come) {
            $cuenta++;
        }

        return $cuenta;
    }
    public static function Lista()
    {
        $actividades = DB::select('select users.photo,users.name,fecha, actividades.actividad, actividades.updated_at FROM actividades
LEFT JOIN profiles ON profiles.uid = actividades.actividad_uid
LEFT JOIN users ON profiles.user_id = users.id');
      //  $user = $actividad->uid
      //  $profile = Profile::whereUid($user)->first()
    return $actividades;
    }

}