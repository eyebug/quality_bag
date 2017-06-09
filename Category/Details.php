<?php
require_once('../util/autoloader.php');
require_once('../layout/header.php');
Session::getSession()->adminOnly();

$db = DB::getDB();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header("Location: /Categories.php");
        return;
    }
    $id = intval($_GET['id']);
    try {
        $rows = $db->query("SELECT * FROM categories WHERE id = ? LIMIT 1", 'i', $id);
        if (count($rows) == 0) {
            header("Location: /Categories.php");
        }
    } catch (Exception $e) {
        header("Location: /Categories.php");
    }
    $row = $rows[0]; ?>
    <div class="container body-content">

        <h2>Details</h2>

        <div>
            <h4>Category</h4>
            <hr>
            <dl class="dl-horizontal">
                <dt>
                    CategoryName
                </dt>
                <dd>
                    <?php echo htmlentities($row['category_name']); ?>
                </dd>
                <dt>
                    Description
                </dt>
                <dd>
                    <?php echo htmlentities($row['description']);?>
                </dd>
            </dl>
        </div>
        <div>
            <a href="/Category/Edit.php?id=<?php echo $row['id'];?>">Edit</a> |
            <a href="/Categories.php">Back to List</a>
        </div>


    </div>
<?php
}
require_once('../layout/footer.php');