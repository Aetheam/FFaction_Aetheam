<?php

namespace Fanouu\FanFaction\Events;

use pocketmine\event\Cancellable;
use pocketmine\event\player\PlayerEvent;
use pocketmine\player\Player;

class FactionCreateEvent extends PlayerEvent implements Cancellable{

    private $factionName;

    public function __construct(Player $player, string $factionName){
        $this->player = $player;
        $this->factionName = $factionName;
    }

    public function getFactioName(): string{
        return $this->factionName;
    }
}