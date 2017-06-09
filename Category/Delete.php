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
    $row = $rows[0];

    ?>
    <div class="container body-content">

        <h2>Delete</h2>

        <h3>Are you sure you want to delete this?</h3>

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
                    <?php echo htmlentities($row['description']); ?>
                </dd>
            </dl>

            <form action="/Category/Delete.php" method="post">
                <input type="hidden" name="ID" value="<?php echo $row['id']; ?>">
                <div class="form-actions no-color">
                    <input type="submit" value="Delete" class="btn btn-default"> |
                    <a href="/Categories.php">Back to List</a>
                </div>
            </form>
        </div>


    </div>
<?php } else {
    if(!isset($_POST['ID'])){
        header("Location: /Categories.php");
        return;
    }
    $id = intval($_POST['ID']);
    try {
        $rows = $db->query("SELECT id FROM bags WHERE category_id = ? LIMIT 1", "i", $id);
        if(count($rows) == 0){
            $db->query("DELETE FROM categories WHERE id = ?", "i", $id);
            header("Location: /Categories.php");
        } else {
            echo "Please delete the bags under this category first!";
        }
    } catch (Exception $e) {
        echo "Something wrong in the system, please try again";
    }

} ?>

<?php
require_once('../layout/footer.php');