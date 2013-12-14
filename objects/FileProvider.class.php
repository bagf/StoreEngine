<?php
/**
 *
 * @author bagf
 */
namespace StoreEngine;

class FileProvider implements FileProviderInterface {

    protected $model;

    public function get() {
        $results = array();
        $f = \storm\PSQL::query(""
                . "SELECT * "
                . "FROM `files` "
                . "WHERE `parentID` = :parentID "
                . "AND IF(:fileID IS NULL, TRUE, `fileID` = :fileID) "
                . "LIMIT :limitFrom, :limitTo", "StoreEngineDB", [
            ":parentID" => $this->model->getParentID(),
            ":fileID" => $this->model->getFileID(),
            ":limitFrom" => $this->model->getFromLimit(),
            ":limitTo" => $this->model->getToLimit()
        ]);
        while($r = $f->fetch()) {
            $results[] = $this->marshalResultset($r);
        }
        
        return $results;
    }
    
    public function count() {
        $f = \storm\PSQL::query("SELECT COUNT(`fileID`) AS count FROM `files` WHERE `parentID` = ?", "StoreEngineDB", array($this->model->getParentID()));
        $r = $f->fetch();
        return $f['count'];
    }
    
    public function marshalResultset($resultset) {
        // note providerOb serves as the providers unique id
        if ($resultset['providerOb'] == get_class($this)) {
            return new File($resultset['fileID'], $resultset['name'], $resultset['size'], $resultset['mime']);
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
            return $provider->marshalResultset($resultset);
        }
    }

    public function __construct(FileModel $model) {
        $this -> model = $model;
    }

}
