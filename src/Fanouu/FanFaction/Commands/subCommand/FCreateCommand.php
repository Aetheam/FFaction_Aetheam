<?php

namespace Fanouu\FanFaction\Commands\subCommand;

use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseSubCommand;
use Fanouu\FanFaction\Managers\FactionManager;
use pocketmine\command\CommandSender;

class FCreateCommand extends BaseSubCommand{
    use traitCommand;

    protected function prepare(): void {
        $this->registerArgument(0, new RawStringArgument("faction name"));
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        $factionAPI = new FactionManager();
        if($factionAPI->asFaction($sender->getName())){
            $sender->sendMessage($this->messages("error_isInFaction"));
        }else{
            var_dump($this->config()->getNested("Factions.min-faction-name"));
            if(strlen($args["faction name"]) <= (int)$this->config()->getNested("Factions.min-faction-name")){
                $sender->sendMessage($this->messages("error_min_faction_name_lenght"));
                return;
            }

            if(strlen($args["faction name"]) >= (int)$this->config()->getNested("Factions.max-faction-name")){
                $sender->sendMessage($this->messages("error_max_faction_name_lenght"));
                return;
            }

            if($factionAPI->existsFactionByName($args["faction name"])){
                $sender->sendMessage(str_replace("{faction}", $args["faction name"], $this->messages("error_faction_exists")));
                return;
            }

            $factionAPI->createFaction($sender->getName(), $args["faction name"]);
            $sender->sendMessage(str_replace("{faction}", $args["faction name"], $this->messages("succes_faction_created")));
        }
    }

}