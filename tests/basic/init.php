<?php
/**
 * @author bagf
*/
namespace StoreEngine;

error_reporting(E_ALL | E_STRICT);

if (!isset($lib_storm, $db_host, $db_username, $db_password, $db_name, $db_port)) {
    throw new \Exception("Missing variables cannot init unit test");
}

// Relative paths
$lib_storm = __DIR__.$lib_storm;

// PHPUnit
$lib_phpunit = "PHPUnit/autoload.php";

if (!is_file($lib_storm)) {
    throw new \Exception("Cannot find Storm development library");
}

if (!is_file($lib_phpunit)) {
    throw new \Exception("Cannot find PHPUnit library");
}

require_once $lib_storm;
require_once __DIR__ .'/../../autoload.php';
require_once $lib_phpunit;

