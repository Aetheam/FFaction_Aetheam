<?php

namespace Fanouu\FanFaction\Commands;

use CortexPE\Commando\args\BaseArgument;
use pocketmine\command\CommandSender;
use CortexPE\Commando\BaseCommand;

use Fanouu\FanFaction\Commands\subCommand\{FCreateCommand};

class FFactionCommand extends BaseCommand{

    public function prepare(): void
    {
        $this->registerSubCommand(new FCreateCommand("create", "Create a Faction", []));
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        // TODO: Implement onRun() method.
    }

}