<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
function tt($str){
    echo "<pre>";
        print_r($str);
    echo "</pre>";
}

function tte($str)
{
    echo "<pre>";
        print_r($str);
    echo "</pre>";
    exit();
}
 
// config.php


define('DB_HOST', 'localhost');
define('DB_USER', 'cs41410_encoder');
define('DB_PASS', '1234');
define('DB_NAME', 'cs41410_encoder');

define('ENABLE_PERMISSION_CHECK', true);