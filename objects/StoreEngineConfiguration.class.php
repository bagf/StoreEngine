<?php
/**
 *
 * @author bagf
 */
namespace StoreEngine;

class StoreEngineConfiguration extends \storm\Configuration {
    public function __construct($name = null) {
        parent::__construct($name);
    }
    
    public function getFilesPath() {
        return $this->get("files_path");
    }
}
