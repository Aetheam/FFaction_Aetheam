<?php

namespace Fanouu\FanFaction\Commands\subCommand;

use CortexPE\Commando\BaseSubCommand;
use Fanouu\FanFaction\Managers\FactionManager;
use pocketmine\command\CommandSender;

class FDisbandCommand extends BaseSubCommand{
    use traitCommand;

    public function prepare(): void
    {
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        $factionAPI = new FactionManager();
        if($factionAPI->asFaction($sender->getName())){
            if($factionAPI->isLeader($sender->getName(), $factionAPI->getFaction($sender->getName())["uuid"])){
                $sender->sendMessage(str_replace("{faction}", $factionAPI->getFaction($sender->getName())["name"], $this->messages("succes_faction_deleted")));
                $factionAPI->disbandFaction($factionAPI->getFaction($sender->getName())["uuid"]);
            }else{
                $sender->sendMessage($this->messages("error_not_leader"));
                return;
            }
        }else{
            $sender->sendMessage($this->messages("error_not_in_faction"));
            return;
        }
    }
}