<?php

# _____  _____             _    _               
#|  ___||  ___|__ _   ___ | |_ (_)  ___   _ __  
#| |_   | |_  / _` | / __|| __|| | / _ \ | '_ \ 
#|  _|  |  _|| (_| || (__ | |_ | || (_) || | | |
#|_|    |_|   \__,_| \___| \__||_| \___/ |_| |_|
#This plugin was made by Fan. All right reserved    

namespace Fanouu\FanFaction\Utils;

use Fanouu\FanFaction\Utils\Provider;

class Loader{

    public static function loadCommands(){

        $Cmd = [];

        foreach($Cmd as $cmd => $command){
            
        }
    }

    public static function loadTables(){
        $array = [
            "CREATE TABLE IF NOT EXISTS factions (`leader` TEXT, `players` TEXT, `allies` TEXT, `claims` TEXT, `power` INT, `home` TEXT)",
            "CREATE TABLE IF NOT EXISTS player (`username` TEXT, `faction`)"
        ];

        foreach($array as $index => $value){
            Provider::query($value);
        }
    }


}