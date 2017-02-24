<?php

namespace NoKill;

use NoKill\NoKill;

use pocketmine\plugin\Plugin;

class EconomyManager {
	
	public $api;
	
	public function __construct(NoKill $plugin) {
		$this->plugin = $plugin;
		$this->lang = $this->plugin->getLanguage();
	}
	
	public function economy_init() {
		$this->server = $this->plugin->getServer();
		
		$plugin = $this->server->getPluginManager()->getPlugin('EconomyAPI');

		if($plugin instanceof Plugin) {
			$this->server->getLogger()->info($this->lang->getMessage('economy_found'));
			$this->api = $plugin::getInstance();
		} else {
			$this->server->getLogger()->error($this->lang->getMessage('economy_not_found'));
			$this->server->shutdown();
		}
	}
	
}