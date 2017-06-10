<?php
require_once('../util/autoloader.php');
require_once('../layout/header.php');
Session::getSession()->adminOnly();
try {
    if (!isset($_GET['id'])) {
        header("Location: /Orders.php");
        return;
    }
    $id = intval($_GET['id']);
    $db = DB::getDB();
    $rows = $db->query("SELECT u.email,u.email, u.name, u.address,o.total, o.gst, o.order_status, o.id
                      FROM orders as o  LEFT JOIN users as u
                      ON o.user_id = u.id WHERE o.id = ?", 'i', $id);
    $orderItems = $db->query("
        SELECT b.image_url, b.bag_name, b.description, oi.quantity,oi.sub_total
         FROM orders as o LEFT JOIN order_items as oi ON o.id = oi.order_id
        LEFT JOIN bags as b ON oi.bag_id = b.id WHERE o.id = ?
    ", 'i', $id);
    if (count($rows) == 0) {
        header("Location: /Orders.php");
    }
} catch (Exception $e) {
    header("Location: /Orders.php");
}
$row = $rows[0]; ?>
    <div class="container body-content">

        <h2>Details</h2>

        <div>
            <h4>Order</h4>
            <hr>
            <dl class="dl-horizontal">
                <dt>
                    Email
                </dt>
                <dd>
                    <?php html_output($row['email']); ?>
                </dd>
                <dt>
                    Full Name
                </dt>
                <dd>
                    <?php html_output($row['name']); ?>
                </dd>
                <dt>
                    Address
                </dt>
                <dd>
                    <?php html_output($row['address']); ?>
                </dd>
                <dt>
                    Total
                </dt>
                <dd>
                    <?php echo $row['total']; ?>
                </dd>
                <dt>
                    GST
                </dt>
                <dd>
                    $<?php echo $row['gst']; ?>
                </dd>
                <dt>
                    Status
                </dt>
                <dd>
                    <?php html_output($row['order_status']); ?>
                </dd>
            </dl>
        </div>

        <h4>Order Items</h4>
        <table class="table">
            <thead>

            <tr>
                <th>
                    Image
                </th>
                <th>
                    BagName
                </th>
                <th>
                    Description
                </th>
                <th>
                    Quantity
                </th>
                <th>
                    SubTotal
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            $format = '<tr>
                <td width="70px">
                    <img style="width: 70px; height: 70px;"
                         src="%s" alt="Bag Image"
                         onerror="this.onerror = null; this.src = \'/images/default_bag.png\'">
                </td>
                <td>
                    %s
                </td>
                <td>
                    %s
                </td>
                <td>
                    %s
                </td>
                <td>
                    $%s
                </td>
            </tr>';
            foreach($orderItems as $orderItem){
                $output = sprintf($format, $orderItem['image_url'], htmlentities($orderItem['bag_name']),
                    htmlentities($orderItem['description']), $orderItem['quantity'], $orderItem['sub_total']);
                echo $output;
            }

            ?>
            </tbody>
        </table>


        <div>
            <a href="/Orders.php">Back to List</a>
        </div>


    </div>
<?php
require_once('../layout/footer.php');