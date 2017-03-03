<?php

namespace MyKillStat;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

class MyKillStat extends PluginBase {
	
	public $lang;
	
	public function onEnable() {
		@mkdir($this->getDataFolder());
		
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		
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
	
	}
	
	public function onDisable() {
		
	}
	
	public function getLanguage() {
		return $this->lang;
	}
	
	public function getEconomy() {
		return $this->economy->api;
	}
	
	public static function test(){
		var_dump(1);
	}
}