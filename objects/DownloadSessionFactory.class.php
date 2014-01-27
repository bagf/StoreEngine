<?php
/**
 * 
 * @author bagf
*/
namespace StoreEngine;

class DownloadSessionFactory extends SessionFactory {
    protected $file;


    public function __construct(StoreEngine $storeEngine, File $file) {
        parent::__construct($storeEngine);
        $this -> file = $file;
    }
    
    /**
     * 
     * @return \StoreEngine\DownloadSession
     */
    public function get() {
        $newSession = new DownloadSession($this->getStoreEngine());
        $newSession->setFile($this->file);
        return $newSession;
    }

}
