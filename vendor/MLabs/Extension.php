<?php
namespace MLabs;

class Extension implements IExtension {
    
    /**
     * copy customized extension.yml, classes and templates to silverstripe project which should be availible as skelet
     */
    public static function add() {
        File::copy(Installer::getRootDirVendor().static::getExtension(), Installer::getRootDirConfig());
        Installer::getComposerEvent()->getIO()->write(":: copied ".self::getConfigfile());
        
        foreach(static::getClasses() as $folder => $class) {
            File::copy(Installer::getRootDirVendor().$class, Installer::getRootDirCode().$folder."/");
            Installer::getComposerEvent()->getIO()->write(":: added class $class");
        }

        foreach(static::getTemplates() as $folder => $template) {
            File::copy(Installer::getRootDirVendor().$template, Installer::getRootDirTheme().$folder."/");
            
            Installer::getComposerEvent()->getIO()->write(":: added template $template");
        }
    }
    
    /**
     * get the config file without path from getExtension()
     */
    public static function getConfigfile() {
        return strrchr(static::getExtension(), '/');
    }

    /**
     * @return string
     */
    protected static function getExtension() {
        return "";
    }

    /**
     * @return array
     */
    protected static function getClasses() {
        return array();
    }

    /**
     * @return array
     */
    protected static function getTemplates() {
        return array();
    }
    
}
?>
