<?php
/**
 * 
 * @author bagf
*/
namespace StoreEngine;

class StoreEngine {
     
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
        $class_name = str_replace(__NAMESPACE__."\\", '', $class_name);
        $paths = array();
        $paths[] = array("class" => "{$class_name}.class", "path" => __DIR__."/");
        $paths[] = array("class" => "{$class_name}.class", "path" => __DIR__."/factories/");
        $paths[] = array("class" => "{$class_name}.interface", "path" => __DIR__."/interfaces/");
        $paths[] = array("class" => "{$class_name}.trait", "path" => __DIR__."/traits/");

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
        spl_autoload_register(__CLASS__ ."::autoload");
    }
}