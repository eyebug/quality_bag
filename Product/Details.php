<?php
require_once('../util/autoloader.php');
require_once('../layout/header.php');
Session::getSession()->adminOnly();
$db = DB::getDB();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header("Location: /Products.php");
        return;
    }
    $id = intval($_GET['id']);
    try {
        $rows = $db->query("SELECT bags.*, c.category_name, s.supplier_name FROM bags
  LEFT JOIN suppliers as s ON s.id = bags.supplier_id
  LEFT JOIN categories as c ON c.id = bags.category_id WHERE bags.id = ?", 'i', $id);

        if (count($rows) == 0) {
            header("Location: /Products.php");
        }
    } catch (Exception $e) {
        header("Location: /Products.php");
    }
    $row = $rows[0];

    ?>
    <div class="container body-content">

        <h2>Details</h2>

        <div>
            <h4>Bag</h4>
            <hr>
            <dl class="dl-horizontal">
                <dt>
                    BagName
                </dt>
                <dd>
                    <?php html_output($row['bag_name']);?>
                </dd>
                <dt>
                    Brand
                </dt>
                <dd>
                    <?php html_output($row['brand']);?>
                </dd>
                <dt>
                    Price
                </dt>
                <dd>
                    $<?php html_output($row['price']);?>
                </dd>
                <dt>
                    CategoryName
                </dt>
                <dd>
                    <?php html_output($row['category_name']);?>
                </dd>
                <dt>
                    Supplier Name
                </dt>
                <dd>
                    <?php html_output($row['supplier_name']);?>
                </dd>
                <dt>
                    Description
                </dt>
                <dd>
                    <?php html_output($row['description']); ?>
                </dd>
                <dt>
                    Image
                </dt>
                <dd>
                    <img style="width: 70px; height: 70px;" src="<?php echo $row['image_url']; ?>" alt="Product Image" onerror="this.onerror = null; this.src = '/image/default_bag.png'">
                </dd>
            </dl>
        </div>
        <div>
            <a href="/Product/Edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="/Products.php">Back to List</a>
        </div>


    </div>

<?php }
require_once('../layout/footer.php');