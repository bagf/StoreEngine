<?php
/**
 * 
 * @author bagf
*/
namespace StoreEngine;

abstract class SessionFactory {
    /**
     *
     * @var \StoreEngine\StoreEngine
     */
    protected $storeEngine;

    public function __construct(StoreEngine $storeEngine) {
        $this->storeEngine = $storeEngine;
    }
    
    final public function getStoreEngine() {
        return $this->storeEngine;
    }
    
    /**
     * @return \StoreEngine\Session
     */
    abstract public function get();
}
