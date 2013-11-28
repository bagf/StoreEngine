<?php
/**
 * 
 * @author bagf
*/
namespace StoreEngine;

class StoreEngine {
    
    protected static $paths = array();

    protected static function addClassPath($class, $path) {
        static::$paths[] = array("class" => $class, "path" => $path);
    }

    private static function findClass($class_name, $directory) {
        $di = new \DirectoryIterator($directory);
        foreach($di as $d) {
            if ($d->isDot()) continue;
            if ($d->isFile() && $d->getFilename() == "{$class_name}.php") {
                return $d->getPathname();
            } else if ($d->isDir()) {
                $recResult = self::findClass($class_name, $d->getPathname());
                if ($recResult !== false) {
                        return $recResult;
                }
            }
        }
        return false;
    }

    public static function autoload($class_name) {
        foreach($paths as $path) {
            $result = static::findClass($path['class'], $path['path']);
            if ($result !== false) {
                require_once($result);
                return true;
            }
        }
        
        return false;
    }

    public static function registerAutoloader() {
        $class_name = str_replace(__NAMESPACE__."\\", '', $class_name);
        static::addClassPath("{$class_name}.class", __DIR__."/");
        static::addClassPath("{$class_name}.class", __DIR__."/factories/");
        static::addClassPath("{$class_name}.interface", __DIR__."/interfaces/");
        static::addClassPath("{$class_name}.trait", __DIR__."/traits/");
        spl_autoload_register(__CLASS__ ."::autoload");
    }
}