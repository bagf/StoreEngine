<?php
/**
 * 
 *
 * @author bagf
 */
namespace StoreEngine;

class ImageFile extends File {
    protected $location;
    
    use Dimensions;
    
    public function __construct($id, $name, $size, $mime) {
        parent::__construct($id, $name, $size, $mime);
        
        $this->location = null;
    }
    
    public function setLocation($location) {
        $this -> location = $location;
    }
    
    public function getLocation() {
        return $this->location;
    }
}
