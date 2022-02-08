<?php


# _____  _____             _    _               
#|  ___||  ___|__ _   ___ | |_ (_)  ___   _ __  
#| |_   | |_  / _` | / __|| __|| | / _ \ | '_ \ 
#|  _|  |  _|| (_| || (__ | |_ | || (_) || | | |
#|_|    |_|   \__,_| \___| \__||_| \___/ |_| |_|
#This plugin was made by Fan. All right reserved     

namespace Fanouu\FanFaction;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

    private static $instance;

    protected function onEnable(): void{
        $this->getLogger()->info("

        # _____  _____             _    _               
        #|  ___||  ___|__ _   ___ | |_ (_)  ___   _ __  
        #| |_   | |_  / _` | / __|| __|| | / _ \ | '_ \ 
        #|  _|  |  _|| (_| || (__ | |_ | || (_) || | | |
        #|_|    |_|   \__,_| \___| \__||_| \___/ |_| |_|
        #This plugin was made by Fan. All right reserved      
        
        ");

        self::$instance = $this;
    }

    public static function getInstance(){
        return self::$instance;
    }
}