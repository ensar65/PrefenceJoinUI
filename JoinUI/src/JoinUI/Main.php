<?php
namespace JoinUI;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\form\type\ModalForm;
use pocketmine\form\type\SimpleForm;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
class Main extends PluginBase implements Listener{
public function onEnable() {
    $this->json = new Config($this->getDataFolder() . "config.json", Config::JSON);
    $this->getServer()->getLogger("Plugin actived If you need close plugin type /JoinUI");
    $this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onCommand(CommandSender $sender, Command $command, string $label, array $args):bool {
switch($command->getName()) {
    case "joinui":
    $form = new ModalForm(function(Player $event, $data) {
        $player = $event->getPlayer();
        if($data === null) {
            null;
        }
        $status = $this->json->get("status");
if(!$status) $status = true;

if($data === true) {
    if($status === true) {
$player->sendMessage("§e[JoinUI] §f: §cPlugin already on :D");
        return;
    } else {
        $this->json->set("status", true);
        $this->json->save();

$player->sendMessage("§e[JoinUI] §f: §eSuccesfuly plugin activated. :D");
        
    } 

}

if($data === false) {
    if($status === "kapali") {
        $player->sendMessage("§e[JoinUI] §f: §cPlugin already off :D");
        return;
    } else {
        $this->json->set("status", "kapali");
$this->json->save();

$player->sendMessage("§e[JoinUI] §f: §cSuccesfuly plugin deactivated. :D");
        
    } 
}
});
    $form->setTitle("§cJoinUI settings");
$form->setContent("Sellect your prefence");
$form->setButton1("§eActivate");
$form->setButton2("§cDeactivate");
$form->sendToPlayer($sender);
    
    break;
}
return true;
}


public function onJoin(PlayerJoinEvent $event) {
    $player = $event->getPlayer();
    $isOn = $this->json->get("status");
    if(!$isOn) $isOn = true;
    if($isOn === "kapali") return;
    $form = new SimpleForm(function(Player $event, $data){
if($data === null) {
    null;
}

    });

    $form->setTitle("§cHortumcu§fCraft");
    $form->setContent("Hello whatsup bro \n If you need close form click Close");
    $form->addButton("§cClose");
    $form->sendToPlayer($player);
}

}


?>
