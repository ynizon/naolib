<?php

namespace App\Facade;

class Utils
{
    public static function getSensBus($bus){
        $infos = explode("@",$bus);
        return $infos[1];
    }

    public static function getNomBus($bus){
        $infos = explode("@",$bus);
        return $infos[0];
    }
}
