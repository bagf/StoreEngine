<?php
/**
 *
 * @author bagf
 */
namespace StoreEngine;

class ImageFileProvider extends FileProvider implements FileProviderInterface {
    
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

    public function __construct(FileModel $model) {
        parent::__construct($model);
    }

}
