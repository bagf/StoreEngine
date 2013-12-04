<?php
/**
 *
 * @author bagf
 */
namespace StoreEngine;

class FileModel {
    protected $providers;
    protected $rootProvider;
    
    protected $files;
    protected $parentID;


    public function __construct() {
        $this->providers = [];
        $this->rootProvider = null;
        
        $this->files = [];
        $this->parentID = 0;
    }

    public function addFileProvider(FileProviderInterface $provider) {
        if (!isset($this->providers[get_class($provider)])) {
            if (count($this->providers) < 1) {
                $this->rootProvider = get_class($provider);
            }
            $this->providers[get_class($provider)] = $provider;
        }
    }
    
    /**
     * 
     * @param string $className
     * @return \StoreEngine\FileProviderInterface
     */
    public function getFileProvider($className) {
        if (!isset($this->providers[$className])) {
            throw new \Exception("FileProvider not found");
        }
        return $this->providers[$className];
    }
    
    /**
     * 
     * @return \StoreEngine\FileProviderInterface
     */
    protected function getRootFileProvider() {
        if (!isset($this->providers[$this->rootProvider])) {
            throw new \Exception("Root FileProvider not found");
        }
        return $this->providers[$this->rootProvider];
    }
    
    public function get($from, $to) {
        $this->files = $this->getRootFileProvider()->get($from, $to);
        return $this->files;
    }
    
    public function count() {
        return $this->files = $this->getRootFileProvider()->count();
    }
    
    public function setParent($parent) {
        $this->parentID = $parent;
    }
    
    public function getParentID() {
        return $this->parentID;
    }
}
