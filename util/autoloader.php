<?php
$appDir = dirname(__FILE__);
require_once($appDir . '/functions.php');
spl_autoload_register(function ($class_name) {
    $appDir = dirname(__FILE__);
    include $appDir . '/' . $class_name . '.php';


});