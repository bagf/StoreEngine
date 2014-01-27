<?php
/**
 * 
 * @author bagf
*/
namespace StoreEngine;

class UploadSessionFactory extends SessionFactory {
    protected $filePath;


    public function __construct(StoreEngine $storeEngine, string $filePath) {
        parent::__construct($storeEngine);
        $this -> filePath = $filePath;
    }
    
    public function get() {
        $newSession = new UploadSession($this->getStoreEngine());
        $newSession->setFile($this->file);
        return $newSession;
    }
    
    protected function analyseFile($filePath) {
        /**
         * @todo generate and return a file object with correct data and new ID
         */
    }

}
