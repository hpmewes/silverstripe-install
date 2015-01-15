<?php
namespace MLabs;

use Composer\Script\Event;

class Installer {
    
    public static function postUpdate(Event $event) {
        self::tasks($event);
        
        $event->getIO()->write(":: mlabs installer post update done...");
    }
    
    public static function postInstall(Event $event) {
        self::tasks($event);
        
        $event->getIO()->write(":: mlabs installer post install done...");
    }
    
    protected static function tasks(Event $event) {
        exec("chown www-data:www-data ../ -R");
        $event->getIO()->write(":: make domain readable for www");
        
        $event->getIO()->write(":: run http://[domain]/install.php when done type [yes] here");
        
        exec("sake dev/build \"flush=1\"");
        $event->getIO()->write(":: build database and flush cache");
        
        $event->getIO()->write(":: mlabs installer tasks done...");
    }
    
}
?>
