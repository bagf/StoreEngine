<?php
/**
 * 
 * @author bagf
*/
namespace StoreEngine;

abstract class Middleware {
    /**
     *
     * @var \StoreEngine\Session
     */
    protected $session;
    /**
     *
     * @var \StoreEngine\Middleware
     */
    protected $next;
    
    final public function setSession(Session $session) {
        $this->session = $session;
    }
    
    final public function setNextMiddleware(Middleware $middleware) {
        $this->next = $middleware;
    }
    
    /**
     * @return \StoreEngine\StoreEngine
     */
    final public function getSession() {
        return $this->session;
    }
    
    /**
     * 
     * @return \StoreEngine\Middleware
     */
    final public function getNextMiddleware() {
        return $this->next;
    }
    
    abstract public function call();
}
