<?php
/**
 *
 * @author bagf
 */
namespace StoreEngine;

class FileProvider implements FileProviderInterface {

    protected $model;

    public function get($limitFrom, $limitTo) {
        $results = array();
        /*
         * @todo Fetch from database table
         * while($r = $f->fetch()) {
         *     $results[] = $this->marshalResultset($r);
         * }
         */
        return $results;
    }
    
    public function marshalResultset($resultset) {
        // note providerOb serves as the providers unique id
        if ($resultset['providerOb'] == get_class($this)) {
            return new File($resultset['id'], $resultset['name'], $resultset['size'], $resultset['mime']);
        } else {
            // Try to create and add new provider
            $newProvider = $resultset['providerOb'];
            /*
             * @todo handel errors here
             */
            $this->model->addFileProvider(new $newProvider($this->model));
        }
    }

    public function __construct(FileModelInterface $model) {
        $this -> model = $model;
    }

}
