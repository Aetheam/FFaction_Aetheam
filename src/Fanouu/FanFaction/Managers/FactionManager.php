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

    public function getPlayers(string $Uuid){

    }

    public function getFaction(string $playerName){
        $select = Provider::query("SELECT `faction` FROM player WHERE `username` = '".$playerName."'");
        if(Provider::database() instanceof \MySQLi) { $factionUUID = $select->fetch_all()[0][0]; }
        if(Provider::database() instanceof \SQLite3){ $factionUUID = $select->fetchArray()[0]; }

        $select = Provider::query("SELECT * FROM factions WHERE `UUID` = '".$factionUUID."'");
        if(Provider::database() instanceof \MySQLi) { $fetchAll = $select->fetch_all()[0]; }
        if(Provider::database() instanceof \SQLite3){ $fetchAll = $select->fetchArray(); }

        return ["name" => $fetchAll[2], "uuid" => $fetchAll[3], "allies" => json_decode($fetchAll[4]), "claims" => json_decode($fetchAll[5]), "players" => json_decode($fetchAll[1]), "leader" => $fetchAll[0], "power" => $fetchAll[6], "home" => $fetchAll[7]];
    }

    public function getFactionByUuid(string $uuid){
        $select = Provider::query("SELECT * FROM factions WHERE `UUID` = '".$uuid."'");
        if(Provider::database() instanceof \MySQLi) { $fetchAll = $select->fetch_all()[0]; }
        if(Provider::database() instanceof \SQLite3){ $fetchAll = $select->fetchArray(); }

        return ["name" => $fetchAll[2], "uuid" => $fetchAll[3], "allies" => json_decode($fetchAll[4]), "claims" => json_decode($fetchAll[5]), "players" => json_decode($fetchAll[1]), "leader" => $fetchAll[0], "power" => $fetchAll[6], "home" => $fetchAll[7]];
    }

    public function isLeader(string $pname, $factionUUID): bool{
        $select = Provider::query("SELECT `leader` FROM factions WHERE `UUID` = '".$factionUUID."'");
        $fetchAll = ["null"];
        if(Provider::database() instanceof \MySQLi) {
            $fetchAll = $select->fetch_all();
        }

        if(Provider::database() instanceof \SQLite3){
            $fetchAll = $select->fetchArray();
        }
        if($fetchAll[0] === $pname) return true;

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

    public function disbandFaction(string $uuid){
        $faction = $this->getFactionByUuid($uuid);
        $players = $faction["players"];
        $name = $faction["name"];

        foreach($players as $player) {
            $result = Provider::query("DELETE FROM player WHERE `username` = '" . $player . "'");
        }
        $result = Provider::query("DELETE FROM factions WHERE `name` = '".$name."'");
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

    public function existsFactionByUuid(string $Uuid){
        $result = Provider::query("SELECT * FROM factions WHERE `UUID` = '".$Uuid."'");

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