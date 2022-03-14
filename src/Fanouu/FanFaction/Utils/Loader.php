<?php

# _____  _____             _    _               
#|  ___||  ___|__ _   ___ | |_ (_)  ___   _ __  
#| |_   | |_  / _` | / __|| __|| | / _ \ | '_ \ 
#|  _|  |  _|| (_| || (__ | |_ | || (_) || | | |
#|_|    |_|   \__,_| \___| \__||_| \___/ |_| |_|
#This plugin was made by Fan. All right reserved    

namespace Fanouu\FanFaction\Utils;

use CortexPE\Commando\exception\HookAlreadyRegistered;
use CortexPE\Commando\PacketHooker;
use Fanouu\FanFaction\Commands\FFactionCommand;
use Fanouu\FanFaction\Managers\FactionManager;
use Fanouu\FanFaction\Utils\Exception\ErrorException;
use Fanouu\FanFaction\Utils\Provider;
use Fanouu\FanFaction\Main;
use Ramsey\Uuid\Uuid;


class Loader{

    public static function loadCommands(){
        if (!PacketHooker::isRegistered()) {
            try {
                PacketHooker::register(Main::getInstance());
            } catch (HookAlreadyRegistered $error) {
                throw new ErrorException("An Error was occured `" . $error->getMessage() . "`");
                return false;
            }
        }

        Main::getInstance()->getServer()->getCommandMap()->register("fanfaction", new FFactionCommand(Main::getInstance(), "faction", "faction commands", ["f"]));
        var_dump(Provider::query("SELECT * FROM factions")->fetchArray());
        var_dump(Provider::query("SELECT * FROM player")->fetchArray());
    }

    public static function loadTables(){
        $array = [
            "CREATE TABLE IF NOT EXISTS factions (`leader` TEXT, `players` TEXT, `name` TEXT,`UUID` TEXT, `allies` TEXT, `claims` TEXT, `power` INT, `home` TEXT)",
            "CREATE TABLE IF NOT EXISTS player (`username` TEXT, `faction` TEXT)"
        ];

        foreach($array as $index => $value){
            Provider::query($value);
        }
    }


}