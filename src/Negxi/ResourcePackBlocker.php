<?php
/**
 * This file is part of the PackFilter plugin.
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

use pocketmine\network\mcpe\protocol\DataPacket;
use pocketmine\network\mcpe\protocol\ResourcePackStackPacket;
use pocketmine\network\mcpe\protocol\ResourcePacksInfoPacket;
use pocketmine\network\mcpe\protocol\types\resourcepacks\ResourcePackInfoEntry;

final class ResourcePackBlocker
{
    /** @var string[] lowercase UUIDs */
    private array $blockedPackIds;

    public function __construct(array $blockedPackIds)
    {
        $this->blockedPackIds = array_map('strtolower', $blockedPackIds);
    }

    public function filterPacket(DataPacket $packet): DataPacket
    {
        if ($packet instanceof ResourcePackStackPacket) {
            $packet->resourcePackStack = array_filter(
                $packet->resourcePackStack,
                fn($pack) => !in_array(strtolower($pack->getPackId()), $this->blockedPackIds, true)
            );
        }

        if ($packet instanceof ResourcePacksInfoPacket) {
            $packet->resourcePackEntries = array_filter(
                $packet->resourcePackEntries,
                fn(ResourcePackInfoEntry $entry) => !in_array(strtolower($entry->getPackId()), $this->blockedPackIds, true)
            );
        }

        return $packet;
    }
}
