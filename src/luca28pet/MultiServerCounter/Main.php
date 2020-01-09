<?php

namespace luca28pet\MultiServerCounter;

use libpmquery\PMQuery;
use pocketmine\event\Listener;
use pocketmine\event\server\QueryRegenerateEvent;
use pocketmine\plugin\PluginBase;
use function class_exists;
use function count;

class Main extends PluginBase implements Listener{

    /** @var int */
    private $cachedPlayers;

    /** @var int */
    private $cachedMaxPlayers;

    public function onEnable() : void{
        if(!class_exists(PMQuery::class)){
            $this->getLogger()->error('PMQuery virion not found. Please use the phar from poggit.pmmp.io or use DEVirion');
            $this->getServer()->getPluginManager()->disablePlugin($this);
            return;
        }

        $this->cachedPlayers = 0;
        $this->cachedMaxPlayers = 0;

        $this->saveDefaultConfig();

        $this->getScheduler()->scheduleRepeatingTask(new ScheduleUpdateTask($this), $this->getConfig()->get('update-players-interval') * 20);

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function getCachedPlayers() : int{
        return $this->cachedPlayers;
    }

    public function setCachedPlayers(int $cachedPlayers) : void{
        $this->cachedPlayers = $cachedPlayers;
    }

    public function getCachedMaxPlayers() : int{
        return $this->cachedMaxPlayers;
    }

    public function setCachedMaxPlayers(int $maxPlayers) : void{
        $this->cachedMaxPlayers = $maxPlayers;
    }

    public function queryRegenerate(QueryRegenerateEvent $event) : void{
        $event->setPlayerCount($this->cachedPlayers + count($this->getServer()->getOnlinePlayers()));
        $event->setMaxPlayerCount($this->cachedMaxPlayers + $this->getServer()->getMaxPlayers());
    }

}