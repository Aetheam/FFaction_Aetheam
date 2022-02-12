<?php

# _____  _____             _    _               
#|  ___||  ___|__ _   ___ | |_ (_)  ___   _ __  
#| |_   | |_  / _` | / __|| __|| | / _ \ | '_ \ 
#|  _|  |  _|| (_| || (__ | |_ | || (_) || | | |
#|_|    |_|   \__,_| \___| \__||_| \___/ |_| |_|
#This plugin was made by Fan. All right reserved            

namespace Fanouu\FanFaction\Utils;

use Fanouu\FanFaction\Main;
use Fanouu\FanFaction\Utils\Exception\ErrorException;

class Provider{
    
    public static function database(){
        $cfg = Main::getInstance()->getConfig();
        switch(strtolower($cfg->get("Provider"))){
            case "sqlite":
                return new \SQLite3(Main::getInstance()->getDataFolder() . "FFaction.db");
                Main::getInstance()->getLogger()->info("The database was defined in 'SQLite3'");
            break;

            case "mysql":
                return new \MySQLi($cfg->getNested("MySQL.adress"), $cfg->getNested("MySQL.username"), $cfg->getNested("MySQL.password"), $cfg->getNested("MySQL.database"));
                Main::getInstance()->getLogger()->info("The database was defined in 'MySQLi'");
            break;

            default:
                throw new ErrorException("No correct database was define.");
                
        }
    }

    public static function query(string $text){
        try{
            $query = self::database()->query($text);
        }catch(error $error){
            throw new ErrorException("An Error was occured `" . $error->getMessage() . "`");
            return false;
        }

        return $query;
    }
}