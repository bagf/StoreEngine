<?php
/**
 *
 * @author bagf
 */
namespace StoreEngine;

class FileModelFactory {
    protected static $registeredFactories = array();
    
    protected static function registerFactory(FileModelFactory $factory) {
        if (!in_array($factory, self::$registeredFactories)) {
            self::$registeredFactories[] = $factory;
        }
    }
    
    public function __construct() {
        self::registerFactory($this);
    }
    
    /**
     * 
     * @return \StoreEngine\FileModel
     */
    public function createModel() {
        $model = new FileModel();
        $provider = new FileProvider($model);
        $model->addFileProvider($provider);
        
        return $model;
    }
}
