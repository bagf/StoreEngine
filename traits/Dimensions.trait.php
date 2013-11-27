<?php
/**
 * @author bagf
*/
namespace StoreEngine;

trait Dimensions {
    protected $height = 0;
    protected $width = 0;
    protected $aspect = "1:1";
    
    public function getHeight() {
        return $this->height;
    }
    
    public function getWidth() {
        return $this->width;
    }
    
    public function getAspect() {
        return $this->aspect;
    }
    
    public function setHeight($height) {
        $this->height = $height;
    }
    
    public function setWidth($width) {
        $this->width = $width;
    }
    
    public function setAspect($aspect) {
        $this->aspect = $aspect;;
    }
}