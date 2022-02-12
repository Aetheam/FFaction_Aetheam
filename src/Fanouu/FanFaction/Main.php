<?php


# _____  _____             _    _               
#|  ___||  ___|__ _   ___ | |_ (_)  ___   _ __  
#| |_   | |_  / _` | / __|| __|| | / _ \ | '_ \ 
#|  _|  |  _|| (_| || (__ | |_ | || (_) || | | |
#|_|    |_|   \__,_| \___| \__||_| \___/ |_| |_|
#This plugin was made by Fan. All right reserved     

namespace Fanouu\FanFaction;

use pocketmine\plugin\PluginBase;
use Fanouu\FanFaction\Utils\Provider;
use Fanouu\FanFaction\Utils\Loader;
use pocketmine\utils\Config;

class Main extends PluginBase{

    private static $instance;

    protected function onEnable(): void{
        $this->getLogger()->info("#This plugin was made by Fan. All right reserved");

        self::$instance = $this;
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->saveResource("messages.yml");
        Loader::loadTables();
        Loader::loadCommands();
    }

    public static function getInstance(){
        return self::$instance;
    }

    public static function getMessages(){
        return new Config(self::$instance->getDataFolder() . "messages.yml", Config::YAML);
    }
}