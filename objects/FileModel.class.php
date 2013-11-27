<?php
/**
 *
 * @author bagf
 */
namespace StoreEngine;

class FileModel implements FileModelInterface {
    protected $providers;
    
    public function __construct() {
        $this->providers = array();
    }

    public function addFileProvider(FileProviderInterface $provider) {
        if (!isset($this->providers[get_class($provider)])) {
            $this->providers[get_class($provider)] = $provider;
        }
    }
    
}
