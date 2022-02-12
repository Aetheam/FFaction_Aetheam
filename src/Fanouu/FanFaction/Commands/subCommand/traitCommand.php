<?php

namespace Fanouu\FanFaction\Commands\subCommand;

use Fanouu\FanFaction\Main;
use pocketmine\utils\Config;

trait traitCommand{

    public function messages(string $text){
        return Main::getMessages()->get($text);
    }

    public function config(): Config
    {
        return new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);
    }
}