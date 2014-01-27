<?php
/**
 *
 * @author bagf
 */
namespace StoreEngine;

interface FileProviderInterface {
    public function __construct(FileModel $model);
    public function get();
    public function count();
}
