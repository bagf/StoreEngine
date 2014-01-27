<?php
/**
 * @author bagf
*/
namespace StoreEngine;
require_once __DIR__.'/../settingsInit.php';
// PHPUnit
$lib_phpunit = "PHPUnit/Autoload.php";

if (!is_file($lib_phpunit)) {
    throw new \Exception("Cannot find PHPUnit library");
}

require_once $lib_phpunit;

