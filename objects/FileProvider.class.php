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
    
    public function count() {
        $result = 0;
        /*
         * @todo Fetch from database table
         * $r = $f->fetch();
         * $result = $r['total'];
         */
        return $result;
    }
    
    public function marshalResultset($resultset) {
        // note providerOb serves as the providers unique id
        if ($resultset['providerOb'] == get_class($this)) {
            return new File($resultset['id'], $resultset['name'], $resultset['size'], $resultset['mime']);
        } else {
            // Try to get provider
            try {
                $provider = $this->model->getFileProvider($resultset['providerOb']);
            } catch (\Exception $ex) {
                // create and add new provider
                $newProvider = $resultset['providerOb'];
                /*
                 * @todo handel errors here
                 */
                $provider = new $newProvider($this->model);
                $this->model->addFileProvider($provider);
            }
        }
    }

    public function __construct(FileModel $model) {
        $this -> model = $model;
    }

}
