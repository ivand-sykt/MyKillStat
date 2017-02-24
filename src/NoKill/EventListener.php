<?php

namespace NoKill;

use NoKill\NoKill;

use pocketmine\event\Listener;

class EventListener implements Listener {
	
	public function __construct(NoKill $plugin) {
		$this->plugin = $plugin;
		$this->lang = $this->plugin->getLanguage();
	}
	
}