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

        <h2>Edit</h2>

        <form action="/Category/Edit.php" method="post">
            <div class="form-horizontal">
                <h4>Category</h4>
                <hr>
                <div class="text-danger"></div>
                <input type="hidden" data-val="true" data-val-required="The ID field is required." id="ID" name="ID"
                       value="<?php echo $row['id']; ?>">

                <div class="form-group">
                    <label class="col-md-2 control-label" for="CategoryName">CategoryName</label>

                    <div class="col-md-10">
                        <input class="form-control" type="text" data-val="true"
                               data-val-required="The CategoryName field is required." id="CategoryName"
                               name="CategoryName" value="<?php echo htmlentities($row['category_name']); ?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="CategoryName"
                              data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Description">Description</label>

                    <div class="col-md-10">
                        <input class="form-control" type="text" id="Description" name="Description"
                               value="<?php echo htmlentities($row['description']); ?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="Description"
                              data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="Save" class="btn btn-default">
                    </div>
                </div>
            </div>

            <div>
                <a href="/Categories.php">Back to List</a>
            </div>


    </div>
<?php } else {
    $categoryName = @$_POST['CategoryName'];
    $description = @$_POST['Description'];
    $id = @$_POST['ID'];
    try {
        DB::getDB()->query("UPDATE categories
        SET category_name=?, description=? WHERE id = ?", 'ssi', $categoryName, $description, $id);
    } catch (Exception $e) {

    }
    header("Location: /Categories.php");

} ?>

<?php
require_once('../layout/footer.php');