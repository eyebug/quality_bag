<?php
require_once('autoloader.php');

$db = DB::getDB();
$result = $db->query("select * from users WHERE id=?", 'i', 1);
var_dump($result);

