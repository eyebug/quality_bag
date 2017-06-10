<?php
require_once('../util/autoloader.php');
require_once('../layout/header.php');
Session::getSession()->adminOnly();
$db = DB::getDB();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header("Location: /Orders.php");
        return;
    }
    $id = intval($_GET['id']);
    try {
        $rows = $db->query("SELECT o.order_status, o.gst, o.total, u.email, u.address, u.name FROM orders as o LEFT JOIN users as u on o.user_id = u.id WHERE o.id = ? LIMIT 1", 'i', $id);
        if (count($rows) == 0) {
            header("Location: /Orders.php");
        }
    } catch (Exception $e) {
        header("Location: /Orders.php");
    }
    $row = $rows[0];
    $statusArray = array('Unpaid','Paid','Shipped','Finished','Cancelled');

    ?>
    <div class="container body-content">

        <h2>Edit</h2>

        <form action="/Order/Edit.php" method="post">
            <div class="form-horizontal">
                <h4>Order</h4>
                <hr>
                <div class="text-danger"></div>
                <input type="hidden" data-val="true" data-val-required="The ID field is required." id="Id" name="Id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="User_Email">Email</label>
                    <div class="col-md-10">
                        <input class="form-control" readonly="" type="text" id="User_Email" name="User.Email" value="<?php html_output($row['email']); ?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="User.Email" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="User_FullName">Full Name</label>
                    <div class="col-md-10">
                        <input class="form-control" readonly="" type="text" data-val="true" data-val-length="The Full Name must be at least 1 and at max 60 characters long." data-val-length-max="60" data-val-length-min="1" data-val-required="The Full Name field is required." id="User_FullName" name="User.FullName" value="<?php html_output($row['name']); ?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="User.FullName" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="User_Address">Address</label>
                    <div class="col-md-10">
                        <input class="form-control" readonly="" type="text" data-val="true" data-val-length="The Address must be at least 6 and at max 100 characters long." data-val-length-max="100" id="User_Address" name="User.Address" value="<?php html_output($row['address']); ?>">
                        <span class="text-danger " data-valmsg-for="User.Address" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Total">Total</label>
                    <div class="col-md-10">
                        <input class="form-control" readonly="" type="text" data-val="true" data-val-number="The field Total must be a number." data-val-required="The Total field is required." id="Total" name="Total" value="<?php echo $row['total']; ?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="Total" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="GST">GST</label>
                    <div class="col-md-10">
                        <input class="form-control" readonly="" type="text" data-val="true" data-val-number="The field GST must be a number." data-val-required="The GST field is required." id="GST" name="GST" value="<?php echo $row['gst']; ?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="GST" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Status">Status</label>
                    <div class="col-md-10">
                        <select class="form-control" data-val="true" data-val-required="The Status field is required." id="Status" name="Status">
                            <?php
                                foreach($statusArray as $status){
                                    if($status == $row['order_status']){
                                        $option = sprintf('<option selected="selected" value="%1$s">%1$s</option>', $status);
                                    } else {
                                        $option = sprintf('<option value="%1$s">%1$s</option>', $status);
                                    }
                                    echo $option;
                                }
                            ?>
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="Save" class="btn btn-default">
                    </div>
                </div>
            </div>

        <div>
            <a href="/Orders.php">Back to List</a>
        </div>



    </div>
<?php } else {
    $id = @$_POST['Id'];
    $status = @$_POST['Status'];
    try {
        DB::getDB()->query("UPDATE orders
        SET order_status=? WHERE id = ?", 'si', $status, $id);
    } catch (Exception $e) {

    }
    header("Location: /Orders.php");

} ?>

<?php
require_once('../layout/footer.php');