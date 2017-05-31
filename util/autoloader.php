<?php
spl_autoload_register(function ($class_name) {
    $appDir = dirname(__FILE__);
    include $appDir . '/' . $class_name . '.php';


});