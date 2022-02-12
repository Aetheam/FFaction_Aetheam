<?php

namespace Fanouu\FanFaction\Commands\subCommand;

use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseSubCommand;
use Fanouu\FanFaction\Managers\FactionManager;
use pocketmine\command\CommandSender;

class FCreateCommand extends BaseSubCommand{

    protected function prepare(): void {
        $this->registerArgument(0, new RawStringArgument("faction name"));
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        $factionAPI = new FactionManager();
        if($factionAPI->asFaction($sender->getName())){
            $sender->sendMessage("Tu a une fac");
        }else{
            $sender->sendMessage("Tu na pas de fac");
        }
    }

}