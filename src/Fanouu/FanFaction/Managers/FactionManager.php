<?php

# _____  _____             _    _               
#|  ___||  ___|__ _   ___ | |_ (_)  ___   _ __  
#| |_   | |_  / _` | / __|| __|| | / _ \ | '_ \ 
#|  _|  |  _|| (_| || (__ | |_ | || (_) || | | |
#|_|    |_|   \__,_| \___| \__||_| \___/ |_| |_|
#This plugin was made by Fan. All right reserved

namespace Fanouu\FanFaction\Managers;

use Fanouu\FanFaction\Utils\Provider;
use Ramsey\Uuid\Uuid;

class FactionManager{

    public function asFaction(string $playerName){
        $result = Provider::query("SELECT * FROM player WHERE `username` = '".$playerName."'");

        if(Provider::database() instanceof \MySQLi){
            if(!$result->num_rows >= 1) {
                return false;
            }else{
                return true;
            }
        }

        if(Provider::database() instanceof \SQLite3){
            if(!$result->fetchArray() >= 1) {
                return false;
            }else{
                return true;
            }
        }

        return false;
    }

    public function createFaction(string $leaderName, string $factionName){
        $players = [$leaderName];
        $allies = [];
        $claims = [];
        $uuid = $this->generateUuid();
        Provider::query("INSERT INTO factions (`leader`, `players`, `name`, `UUID`, `allies`, `claims`, `power`, `home`) VALUES ('".$leaderName."', '". json_encode($players) ."', '".$factionName."', '".$uuid."', '".json_encode($allies)."', '". json_encode($claims)."', '0', 'none')");
        Provider::query("INSERT INTO player (`username`, `faction`) VALUES ('".$leaderName."', '".$uuid."')");
    }

    public function existsFactionByName(string $name){
        $result = Provider::query("SELECT * FROM factions WHERE `name` = '".$name."'");

        if(Provider::database() instanceof \MySQLi){
            if(!$result->num_rows >= 1) {
                return false;
            }else{
                return true;
            }
        }

        if(Provider::database() instanceof \SQLite3){
            if(!$result->fetchArray() >= 1) {
                return false;
            }else{
                return true;
            }
        }

        return false;
    }

    public function generateUuid(): string{
       return Uuid::uuid4()->toString();
    }
}