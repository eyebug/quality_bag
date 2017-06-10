<?php
require_once('./util/autoloader.php');
$gst = @floatval($_GET['gst']);
$grandTotal = @floatval($_GET['grandTotal']);
$orderJsonStr = $_GET['orderJsonStr'];

if (checkOrder($orderJsonStr) && checkout($orderJsonStr, $gst, $grandTotal)) {
    echo "true";
} else {
    echo "false";
}
/**
 * @param $orderJsonStr
 * @return bool
 * @throws Exception
 */
function checkOrder($orderJsonStr)
{
    Session::getSession();
    if (!isset($_SESSION['id'])) {
        return false;
    }
    $db = DB::getDB();
    $rows = $db->query("SELECT id FROM bags");
    $bagIdArray = array();
    foreach ($rows as $row) {
        $bagIdArray[] = $row['id'];
    }
    $oderItemArray = json_decode($orderJsonStr, true);
    foreach ($oderItemArray as $orderItem) {
        if (!in_array($orderItem['BagId'], $bagIdArray)) {
            return false;
        }
    }
    return true;
}

/**
 * @param $orderJsonStr
 * @param $gst
 * @param $grandTotal
 * @return bool
 */
function checkout($orderJsonStr, $gst, $grandTotal)
{
    try {
        $db = DB::getDB();
        $userId = $_SESSION['id'];
        $orderId = $db->insert("INSERT INTO orders(gst, total, user_id) VALUE (?, ?, ?)", 'ddi', $gst, $grandTotal + $gst, $userId);
        $oderItemArray = json_decode($orderJsonStr, true);
        foreach ($oderItemArray as $orderItem) {
            $db->insert("INSERT INTO order_items(bag_id, order_id, quantity, sub_total, unit_price) VALUE(?, ?, ?, ?, ?)",
                'iiidd', $orderItem['BagId'], $orderId, $orderItem['Quantity'], $orderItem['SubTotal'], $orderItem['UnitPrice']
            );
        }
        return true;
    } catch (Exception $e) {
        return false;
    }

}