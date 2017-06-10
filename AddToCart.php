<?php
require_once('./util/autoloader.php');
$bagId = @intval($_GET['bagID']);
$db = DB::getDB();
$rows = $db->query("SELECT * FROM bags WHERE id = ? LIMIT 1", 'i', $bagId);
if (count($rows) != 1) {
    exit;
}
$row = $rows[0];
$item = array(
    'ID' => $row['id'],
    'BagName' => $row['bag_name'],
    'Price' => $row['price'],
    'ImageURL' => $row['image_url']
);
$result[] = $item;
echo '"' . addslashes(json_encode($result)) . '"';
exit;

