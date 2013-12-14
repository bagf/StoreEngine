<?php
/**
 * 
 * @author bagf
*/
namespace StoreEngine;

class StoreEngine {
    
    protected static $paths = array();
    protected static $instance = null;
    
    public static function &get() {
        if (!is_null(static::$instance)) {
            return static::$instance;
        }
        
        if (session_status() != PHP_SESSION_ACTIVE) {
            if (!isset($_SESSION['StoreEngine'])) {
                $_SESSION['StoreEngine'] = new StoreEngine();
            }
            static::$instance = $_SESSION['StoreEngine'];
            return static::$instance;
        }
        
        static::$instance = new StoreEngine();
        return static::$instance;
    }

    protected static function addClassPath($class, $path) {
        static::$paths[] = array("class" => $class, "path" => $path);
    }

    private static function findClass($class_name, $class, $directory) {
        $di = new \DirectoryIterator($directory);
        foreach($di as $d) {
            if ($d->isDot()) continue;
            if ($d->isFile() && $d->getFilename() == sprintf($class, $class_name)) {
                return $d->getPathname();
            } else if ($d->isDir()) {
                $recResult = self::findClass($class_name, $class, $d->getPathname());
                if ($recResult !== false) {
                        return $recResult;
                }
            }
        }
        return false;
    }

    public static function autoload($class_name) {
        $class_name = str_replace(__NAMESPACE__."\\", '', $class_name);
        foreach(self::$paths as $path) {
            $result = static::findClass($class_name, $path['class'], $path['path']);
            if ($result !== false) {
                require_once($result);
                return true;
            }
        }
        
        return false;
    }

    public static function registerAutoloader() {
        static::addClassPath("%s.class.php", __DIR__."/");
        static::addClassPath("%s.class.php", __DIR__."/../factories/");
        static::addClassPath("%s.interface.php", __DIR__."/../interfaces/");
        static::addClassPath("%s.trait.php", __DIR__."/../traits/");
        spl_autoload_register(__CLASS__ ."::autoload");
    }
    
    public function __construct() {
        
    }
    
    public function getFilePath(File $file) {
        return \storm\Configuration::fetchFirstConfiguration("StoreEngineConfiguration")->getFilesPath()."/".$file->getID();
    }
}