<?php
/**
 * @author bagf
*/
namespace StoreEngine;
use \storm\PSQLConfiguration;

error_reporting(E_ALL | E_STRICT);
if (!is_file(__DIR__."/database.ini")) {
    if (!isset($db_host, $db_username, $db_password, $db_name, $db_port)) {
        throw new \Exception("Missing variables cannot init unit test");
    }
} else {
    $database = parse_ini_file(__DIR__."/database.ini", true);
    if (!isset($database['mysql'])) {
        throw new \Exception("Missing variables in config");
    }
    $db_host = $database['mysql']['host'];
    $db_port = (isset($database['mysql']['port'])?$database['mysql']['port']:3306);
    $db_username = $database['mysql']['username'];
    $db_password = $database['mysql']['password'];
    $db_name = $database['mysql']['database'];
}

if (!isset($lib_storm)) $lib_storm = "/../../Storm/autoloader.php";

// Relative paths
$lib_storm = __DIR__.$lib_storm;

if (!is_file($lib_storm)) {
    throw new \Exception("Cannot find Storm development library");
}

require_once $lib_storm;
require_once __DIR__ .'/../autoload.php';

PSQLConfiguration::setValue("PSQLConfiguration", "host", $db_host);
PSQLConfiguration::setValue("PSQLConfiguration", "port", $db_port);
PSQLConfiguration::setValue("PSQLConfiguration", "user", $db_username);
PSQLConfiguration::setValue("PSQLConfiguration", "pass", $db_password);
PSQLConfiguration::setValue("PSQLConfiguration", "db", $db_name);
PSQLConfiguration::setValue("PSQLConfiguration", "name", "StoreEngineDB");