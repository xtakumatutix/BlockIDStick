<?php

namespace xtakumatutix\blockids;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\item\Item;

Class Main extends PluginBase
{
    public function onEnable()
    {
        $this->getLogger()->notice("読み込み完了 - ver." . $this->getDescription()->getVersion());
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if(!($sender instanceof Player)) {
            return true;
        }
        $item = Item::get(280, 0);
        $item->setCustomName('BlockIDStick');
        $item->setLore(['IDを調べたいブロックをこの棒でタップしてください']);
        $sender->getInventory()->addItem($item);
        $sender->sendMessage('§a >> §fBlockIDStickを追加しました');
        return true;
    }
}