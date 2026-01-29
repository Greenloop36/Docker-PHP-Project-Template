<?php declare(strict_types=1);

/*

    Core Library
        include at the start of each file

*/

$path = "/var/www/html";

session_start();
session_regenerate_id(true);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

try {
    $database = new mysqli(
        'mysql',
        'root',
        'pw',
        'my_database'
    );
    echo "hi";
} catch (Exception $e) {
    echo $e;
}