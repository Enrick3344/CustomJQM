<?php

namespace CustomJQM;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

   public function onEnable(){
      $this->getServer()->getPluginManager()->registerEvents($this,$this);
      $this->loadConfig();
      $this->getLogger()->info(TextFormat::AQUA . "CustomJQM Enabled...");
   }
   
   public function onDisable(){
      $this->getLogger()->info(TextFormat::AQUA . "CustomJQM Disabled...");
   }
   
   public function loadConfig(){
      @mkdir($this->getDataFolder());
      $this->saveResource("config.yml");
      $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
   }
   
   public function translateColors($string){
		$msg = str_replace("&1",TextFormat::DARK_BLUE,$string);
		$msg = str_replace("&2",TextFormat::DARK_GREEN,$msg);
		$msg = str_replace("&3",TextFormat::DARK_AQUA,$msg);
		$msg = str_replace("&4",TextFormat::DARK_RED,$msg);
		$msg = str_replace("&5",TextFormat::DARK_PURPLE,$msg);
		$msg = str_replace("&6",TextFormat::GOLD,$msg);
		$msg = str_replace("&7",TextFormat::GRAY,$msg);
		$msg = str_replace("&8",TextFormat::DARK_GRAY,$msg);
		$msg = str_replace("&9",TextFormat::BLUE,$msg);
		$msg = str_replace("&0",TextFormat::BLACK,$msg);
		$msg = str_replace("&a",TextFormat::GREEN,$msg);
		$msg = str_replace("&b",TextFormat::AQUA,$msg);
		$msg = str_replace("&c",TextFormat::RED,$msg);
		$msg = str_replace("&d",TextFormat::LIGHT_PURPLE,$msg);
		$msg = str_replace("&e",TextFormat::YELLOW,$msg);
		$msg = str_replace("&f",TextFormat::WHITE,$msg);
		$msg = str_replace("&o",TextFormat::ITALIC,$msg);
		$msg = str_replace("&l",TextFormat::BOLD,$msg);
		$msg = str_replace("&r",TextFormat::RESET,$msg);
		$msg = str_replace("&k",TextFormat::OBFUSCATED,$msg);
		return $msg;
	}
  
  public function onJoin(PlayerJoinEvent $ev){
      $ev->setJoinMessage($this->translateColors(str_replace("{PLAYER}", $ev->getPlayer()->getName(), $this->config->get("Custom-Join-Message"))));
  }
  
  public function onQuit(PlayerQuitEvent $ev){
      $ev->setQuitMessage($this->transalteColors(str_replace("{PLAYER}", $ev->getPlayer()->getName(), $this->config->get("Custom-Quit-Message"))));
  }
}
