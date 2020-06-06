<?php

namespace xtakumatutix\blockids;

use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\block\Block;

class EventListener implements Listener
{
    private $Main;

    public function __construct(Main $Main)
    {
        $this->Main = $Main;
    }

    public function onTap(PlayerInteractEvent $event)
    {
        $player = $event->getPlayer();
        $item = $event->getItem();
        $itemname = $item->getCustomName();
        if ($item->getID() == 280 and $item->getCustomName() == 'BlockIDStick') {
            $block = $event->getBlock();
            $id = $block->getId();
            if (!$id == 0){
                $damage = $block->getDamage();
                $x = $block->getFloorX();
                $y = $block->getFloorY();
                $z = $block->getFloorX();
                $player->sendMessage($id.":".$damage." [§c".$x." §a".$y." §b".$z. "§f]");
            }
        }
    }
}