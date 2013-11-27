<?php
/**
 * Primitive File object
 *
 * @author bagf
 */
namespace StoreEngine;

class File {

    protected $id;
    protected $name;
    protected $size;
    protected $mime;


    /**
     * 
     * @param int $id File ID / files table index column
     * @param string $name
     * @param int $size File size in bytes (on disk)
     * @param type $mime Mime type info
     */
    public function __construct($id, $name, $size, $mime) {
        $this -> id = $id;
        $this -> name = $name;
        $this -> size = $size;
        $this -> mime = $mime;
    }
    
    /**
     * 
     * @return int
     */
    public function getID() {
        return $this->id;
    }
    
    /**
     * 
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    /**
     * 
     * @return int
     */
    public function getSize() {
        return $this->size;
    }
    /**
     * 
     * @return string
     */
    public function getMIME() {
        return $this->mime;
    }
}
