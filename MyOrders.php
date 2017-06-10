<?php
require_once('./util/autoloader.php');
require_once('./layout/header.php');
$session = Session::getSession();
if(isset($_SESSION['id'])){
    $userId = intval($_SESSION['id']);
}else {
    echo "Need to login first";
    require_once('./layout/footer.php');
}
$db = DB::getDB();
$rows = $db->query("SELECT u.email,u.email, u.name, u.address,o.total, o.gst, o.order_status, o.id
                      FROM orders as o  LEFT JOIN users as u
                      ON o.user_id = u.id WHERE u.id = $userId");

?>
    <div class="container body-content">

        <h2>Index</h2>
        <!--
            <h2></h2>
        -->
        <table class="table">
            <thead>
            <tr>
                <th>
                    Email
                </th>
                <th>
                    Full Name
                </th>
                <th>
                    Address
                </th>
                <th>
                    Total
                </th>
                <th>
                    GST
                </th>
                <th>
                    Status
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $format = '<tr>
                <td>
                    %1$s
                </td>
                <td>
                    %2$s
                </td>
                <td>
                    %3$s
                </td>
                <td>
                    $%4$d
                </td>
                <td>
                    $%5$d
                </td>
                <td>
                    %6$s
                </td>
                <td>
                    <a href="/Order/Details.php?id=%7$s">Details</a>
                </td>
            </tr>';
            foreach($rows as $row){
                $output = sprintf($format, htmlentities($row['email']), htmlentities($row['name']),
                    htmlentities($row['address']),$row['total'], $row['gst'], htmlentities($row['order_status']), $row['id']
                );
                echo $output;
            }

            ?>
            </tbody>
        </table>


    </div>
<?php
require_once('./layout/footer.php');