<?php
/**
 *
 * @author bagf
 */
namespace StoreEngine;

class ImageFileProvider extends FileProvider implements FileProviderInterface {
    
    public function get() {
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
            return new ImageFile($resultset['fileID'], $resultset['name'], $resultset['size'], $resultset['mime']);
        }
    }

    public function __construct(FileModel $model) {
        parent::__construct($model);
    }

}
