<?php
/**
 *
 * @author bagf
 */
namespace StoreEngine;

class FileModel {
    protected $providers;
    protected $rootProvider;
    
    protected $parentID;
    protected $limitFrom;
    protected $limitTo;
    protected $fileID;


    public function __construct() {
        $this->providers = [];
        $this->rootProvider = null;
        
        // Defaults
        $this->parentID = 0;
        $this->limitFrom = 0;
        $this->limitTo = 1;
        $this->fileID = null;
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
    
    public function get() {
        return $this->getRootFileProvider()->get();
    }
    
    public function count() {
        return $this->getRootFileProvider()->count();
    }
    
    public function setParent($parent) {
        $this->parentID = $parent;
    }
    
    public function setLimit($limitForm, $limitTo) {
        $this->limitFrom = $limitForm;
        $this->limitTo = $limitTo;
    }
    public function setFileID($fileID) {
        $this->fileID = $fileID;
    }
    
    public function getParentID() {
        return $this->parentID;
    }
    
    public function getFromLimit() {
        return $this->limitFrom;
    }
    
    public function getToLimit() {
        return $this->limitTo;
    }
    
    public function getFileID() {
        return $this->fileID;
    }
}
