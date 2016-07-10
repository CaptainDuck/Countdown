<?php

namespace Countdown;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Event;
use pocketmine\level\Level;

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
    
    public function onCommand(CommandSender $sender,Command $cmd,$label,array $args){
        switch($cmd->getName()){
            case "countdown":
            case "cd":
                if($sender instanceof Player){
                    if($sender->hasPermission("countdown.command")){
                        $sender->sendMessage(C::BLUE. C::ITALIC. C::BOLD. "Countdown Commands & Info");
                        $sender->sendMessage(C::WHITE. C::ITALIC. "/cdstart -> Starts a countdown!");
                        return true;
                        break;
                    }
                }
                case "cdstart":
                    if($sender instanceof Player){
                        $count = $this->getConfig()->get("countdown_time");
                            if($sender->hasPermission("countdown.start")){
                                $senderLevel = $sender->getLevel()->getPlayers();
                                $count--;
                                foreach($senderLevel as $player){
                                    if($this->getConfig()->get("broadcast_when_countdown_start") === true){
                                        $player->sendMessage(C::WHITE. $this->getConfig()->get("countdown_broadcast_msg"). $this->getConfig()->get("countdown_time"). " seconds!");
                                        
                                    if($count === 30){
                                        $player->sendMessage($this->getConfig()->get("countdown_message"). " 30 seconds!");
                                    }
                                    if($count === 0){
                                        $player->sendMessage($count. "Countdown ended!");
                                    }
                                    return true;
                                    break;
                                }
                            }
                        }
                    }
            }
        }
    }
}
