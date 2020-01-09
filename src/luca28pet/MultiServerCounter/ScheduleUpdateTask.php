<?php

namespace luca28pet\MultiServerCounter;

use pocketmine\scheduler\Task;

class ScheduleUpdateTask extends Task{

    /** @var Main */
    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function onRun(int $currentTick) : void{
        $this->plugin->getServer()->getAsyncPool()->submitTask(new UpdatePlayersTask($this->plugin->getConfig()->get('servers-to-query')));
    }

}