<?php
require_once('../util/autoloader.php');
Session::getSession()->logout();
$output = "<script>
window.location.href = \"/\";
</script>";
echo $output;