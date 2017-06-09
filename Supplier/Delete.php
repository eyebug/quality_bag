<?php
require_once('../util/autoloader.php');
require_once('../layout/header.php');
Session::getSession()->adminOnly();

$db = DB::getDB();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header("Location: /Suppliers.php");
        return;
    }
    $id = intval($_GET['id']);
    try {
        $rows = $db->query("SELECT * FROM suppliers WHERE id = ? LIMIT 1", 'i', $id);
        if (count($rows) == 0) {
            header("Location: /Suppliers.php");
        }
    } catch (Exception $e) {
        header("Location: /Suppliers.php");
    }
    $row = $rows[0];

    ?>
    <div class="container body-content">

        <h2>Delete</h2>

        <h3>Are you sure you want to delete this?</h3>
        <div>
            <h4>Supplier</h4>
            <hr>
            <dl class="dl-horizontal">
                <dt>
                    Supplier Name
                </dt>
                <dd>
                    <?php echo htmlentities($row['supplier_name']); ?>
                </dd>
                <dt>
                    Email
                </dt>
                <dd>
                    <a href="mailto:Johns@email.com"><?php echo htmlentities($row['email']); ?></a>
                </dd>
                <dt>
                    MobileNo
                </dt>
                <dd>
                    <?php html_output($row['mobile_no']);  ?>
                </dd>
                <dt>
                    Home PhoneNo
                </dt>
                <dd>
                    <?php html_output($row['home_phone_no']); ?>
                </dd>
                <dt>
                    Work PhoneNo
                </dt>
                <dd>
                    <?php html_output($row['work_phone_no']); ?>
                </dd>
                <dt>
                    Address
                </dt>
                <dd>
                    <?php html_output($row['address']); ?>
                </dd>
            </dl>

            <form action="/Supplier/Delete.php" method="post">
                <input type="hidden" data-val="true" data-val-required="The ID field is required." id="ID" name="ID" value="<?php echo $row['id']; ?>">
                <div class="form-actions no-color">
                    <input type="submit" value="Delete" class="btn btn-default"> |
                    <a href="/Suppliers.php">Back to List</a>
                </div>
        </div>


    </div>
<?php } else {
    if(!isset($_POST['ID'])){
        header("Location: /Suppliers.php");
        return;
    }
    $id = intval($_POST['ID']);
    try {
        $rows = $db->query("SELECT id FROM bags WHERE supplier_id = ? LIMIT 1", "i", $id);
        if(count($rows) == 0){
            $db->query("DELETE FROM suppliers WHERE id = ?", "i", $id);
            header("Location: /Suppliers.php");
        } else {
            echo "Please delete the bags under this supplier first!";
        }
    } catch (Exception $e) {
        echo "Something wrong in the system, please try again";
    }

} ?>

<?php
require_once('../layout/footer.php');