<?php
/**
 *
 * @author bagf
 */
namespace StoreEngine;

interface FileProviderInterface {
    public function __construct(FileModelInterface $model);
    public function get($limitFrom, $limitTo);
}
