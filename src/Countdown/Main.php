<?php

namespace Countdown;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;

class Main extends PluginBase implements Listener{
    
    public function onEnable(){
        $this->getLogger()->info("Countdown by CaptainDuck enabled!");
        $this->saveDefaultConfig();
        $this->saveResource("config.yml");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
    }
    
    public function onLoad(){
        $this->getLogger()->info("Countdown by CaptainDuck loading!");
    }
    
    public function onDisable(){
        $this->getLogger()->info("Countdown by CaptainDuck disabled! :o");
    }
    
    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        if($sender instanceof Player){
            switch($cmd->getName()){
                case "countdown":
                case "cd":
                    if($sender->hasPermission("countdown.command")){
                        $sender->sendMessage(C::BLUE."Countdown Commands & Info");
                        $sender->sendMessage(C::WHITE."/cd or /countdown start -> Starts a countdown!");
                        return true;
                        break;
                    }
            }
        }
        if($args[0] == "start"){
            $count = $this->getConfig()->get("countdown_time");
            if($sender->hasPermission("countdown.start")){
                $sender->sendMessage("Starting the countdown! The countdown starts in.." .$count. "seconds!");
            }
        }
    }
}
