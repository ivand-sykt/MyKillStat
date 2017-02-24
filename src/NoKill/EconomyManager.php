<?php

namespace NoKill;

use NoKill\NoKill;

class EconomyManager {
	
	public function __construct(NoKill $plugin) {
		$this->plugin = $plugin;
		$this->lang = $this->plugin->getLanguage();
	}
}