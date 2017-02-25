<?php

namespace NoKill;

use NoKill\NoKill;

use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;

use pocketmine\Player;

class EventListener implements Listener {
	
	public function __construct(NoKill $plugin) {
		$this->plugin = $plugin;
		$this->lang = $this->plugin->getLanguage();
	}
	
	public function onDamage(EntityDamageEvent $event) {
		
		if($event->getCause() == EntityDamageEvent::CAUSE_ENTITY_ATTACK){
			
			$victim = $event->getEntity();
			$damager = $event->getDamager();
		
			if(!$damager instanceof Player) return false;
			
			if($damager->isCreative() and ($this->plugin->config->get('kill_from_creative') == false)) {
				if($damager->hasPermission('nokill.except.creative')) return false;
			//	or $damager->hasPermission('nokill.except') 
			//	or $damager->hasPermission('nokill')) return false; 

				$event->setCancelled();
				$damager->sendMessage($this->lang->getMessage('kill_from_creative'));
				return true;
			}

			if($damager->isFlying() and ($this->plugin->config->get('kill_while_flying') == false)) {
				if($damager->hasPermission('nokill.except.flying')) return false;
			//	or $damager->hasPermission('nokill.except') 
			//	or $damager->hasPermission('nokill')) return false; 

				$event->setCancelled();
				$damager->sendMessage($this->lang->getMessage('kill_while_flying'));
				return true;
			}
			
			if(( $victim->getHealth() - $event->getFinalDamage()) <= 0){
				if(!$this->plugin->config->get('use_economy')) return false;
				
				$economy = $this->plugin->getEconomy();
				$money = $this->plugin->config->get('kill_money');
				$economy->addMoney($damager, $money);
			}
			
		}
		
		return;
		
	}
	
}