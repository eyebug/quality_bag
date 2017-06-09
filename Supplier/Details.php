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

        <h2>Details</h2>

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
        </div>
        <div>
            <a href="/Supplier/Edit.php?id=<?php echo intval($row['id']); ?>">Edit</a> |
            <a href="/Suppliers.php">Back to List</a>
        </div>


    </div>

<?php }
require_once('../layout/footer.php');