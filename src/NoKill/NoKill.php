<?php

namespace NoKill;

/* NoKill
[ ] block creative kills
[ ] block flying kills
[ ] add permissions
[x] multilanguage
[ ] money for kills
*/

use NoKill\Language;
use NoKill\EconomyManager;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

class NoKill extends PluginBase {
	
	public $lang;
	
	public function onEnable() {
		@mkdir($this->getDataFolder());
		
		if(!is_file($this->getDataFolder() . 'config.yml')){
			$this->saveResource('config.yml');
		}
		
		$this->config = new Config($this->getDataFolder() . 'config.yml', Config::YAML);
		
		$this->lang = new Language($this);
		$this->lang->lang_init($this->config->get('language'));
		
		if($this->config->get('use_economy')){
			$this->economy = new EconomyManager($this);
			$this->economy->economy_init();
		}
		
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
	}
	
	public function onDisable() {
		
	}
	
	public function getLanguage() {
		return $this->lang;
	}
	
	public function getEconomy() {
		return $this->economy->api;
	}
}