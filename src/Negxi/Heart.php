<?php
/**
 * This file is part of the VoidPack plugin.
 *
 * @author      Negxi
 * @license     MIT License
 * @link        https://github.com/Negxi/PackFilter (optional)
 *
 * This plugin removes specific resource packs (UUIDs of those trash resource packs that ruin our custom textures.)
 * that interfere with custom textures on servers.
 *
 * You are free to use, modify, and distribute this file as long as you include this notice.
 */


namespace Negxi;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\DataPacket;

final class Heart extends PluginBase implements Listener
{
    private ResourcePackBlocker $packBlocker;

    protected function onEnable(): void
    {
        $this->saveDefaultConfig();

        $blockedUuids = $this->getConfig()->get('blacklist')['uuid'] ?? [];
        if (!is_array($blockedUuids)) {
            $this->getLogger()->warning("DUDE FOUND INVAILD SHIT UUID IN CONFIG.YML");
            $blockedUuids = [];
        }

        $this->packBlocker = new ResourcePackBlocker($blockedUuids);

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPacketSend(DataPacketSendEvent $event): void
    {
        $filtered = array_map([$this->packBlocker, 'filterPacket'], $event->getPackets());
        $event->setPackets($filtered);
    }
}
