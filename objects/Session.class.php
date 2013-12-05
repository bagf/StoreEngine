<?php
/**
 * 
 * @author bagf
*/
namespace StoreEngine;

abstract class Session {
    
    protected $initiateTime;
    protected $completeTime;
    /**
     *
     * @var \StoreEngine\StoreEngine
     */
    protected $storeEngine;
    /**
     * @var \StoreEngine\File
     */
    protected $file;
    protected $middlewares;
    
    public function __construct(StoreEngine $storeEngine) {
        $this->initiateTime = null;
        $this->completeTime = null;
        $this->storeEngine = $storeEngine;
        $this->file = null;
        $this->middlewares = [];
    }
    
    final public function getInitiateTime() {
        if (is_null($this->initiateTime)) throw new \Exception("Session not initiated yet");
        return $this->initiateTime;
    }
    
    final public function getCompleteTime() {
        if (is_null($this->completeTime)) throw new \Exception("Session not complete yet");
        return $this->completeTime;
    }
    
    final public function getStoreEngine() {
        return $this->storeEngine;
    }

    final public function getFile() {
        if (is_null($this->file)) throw new \Exception("File not set yet");
        return $this->file;
    }
    
    final public function setFile(File $file) {
        $this->file = $file;
    }
    
    final public function addMiddleware(Middleware $middleware) {
        $middleware->setNextMiddleware($this->middlewares[0]);
        $middleware->setSession($this);
        array_unshift($this->middlewares, $middleware);
    }
    
    final protected function processMiddleware() {
        if (count($this->middlewares) > 0) {
            $this->middlewares[0]->call();
        }
    }
    
    final public function getFilePath() {
        return $this->getStoreEngine()->getFilePath($this->getFile());
    }
    
    final protected function begin() {
        $this->processMiddleware();
        $this->initiateTime = microtime(true);
    }
    
    final protected function end() {
        $this->completeTime = microtime(true);
    }

    abstract public function run();
}
