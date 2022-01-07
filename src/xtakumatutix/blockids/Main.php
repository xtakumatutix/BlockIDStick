<?php

namespace xtakumatutix\blockids;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\block\Block;

Class Main extends PluginBase implements Listener
{
    public function onEnable() :void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if(!($sender instanceof Player)) {
            return true;
        }
        $item = VanillaItems::STICK();
        $item->setCustomName('BlockIDStick');
        $item->setLore(['IDを調べたいブロックをこの棒でタップしてください']);
        $sender->getInventory()->addItem($item);
        $sender->sendMessage('§a >> §fBlockIDStickを追加しました');
        return true;
    }

    public function onTap(PlayerInteractEvent $event)
    {
        $player = $event->getPlayer();
        $item = $event->getItem();
        if ($item->getID() == 280 and $item->getCustomName() == 'BlockIDStick') {
            $block = $event->getBlock();
            $id = $block->getId();
            if (!$id == 0){
                $damage = $block->getMeta();
                $blockname = $block->getName();
                $x = $block->getPosition()->getFloorX();
                $y = $block->getPosition()->getFloorY();
                $z = $block->getPosition()->getFloorZ();
                $player->sendMessage($id.":".$damage." §7(".$blockname.")§f [§c".$x." §a".$y." §b".$z. "§f]");
            }
        }
    }
}