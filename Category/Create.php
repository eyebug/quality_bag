<?php
require_once('../util/autoloader.php');
require_once('../layout/header.php');
Session::getSession()->adminOnly();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    ?>
    <div class="container body-content">

        <h2>Create</h2>

        <form action="/Category/Create.php" method="post">
            <div class="form-horizontal">
                <h4>Category</h4>
                <hr>
                <div class="text-danger"></div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="CategoryName">CategoryName</label>

                    <div class="col-md-10">
                        <input class="form-control" type="text" data-val="true"
                               data-val-required="The CategoryName field is required." id="CategoryName"
                               name="CategoryName" value="">
                        <span class="text-danger field-validation-valid" data-valmsg-for="CategoryName"
                              data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Description">Description</label>

                    <div class="col-md-10">
                        <input class="form-control" type="text" id="Description" name="Description" value="">
                        <span class="text-danger field-validation-valid" data-valmsg-for="Description"
                              data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="Create" class="btn btn-default">
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
    if (!empty($categoryName)) {
        try {
            DB::getDB()->query("INSERT INTO categories(category_name, description) VALUE (?, ?)", 'ss', $categoryName, $description);
        } catch (Exception $e) {

        }
    }
    header("Location: /Categories.php");

} ?>

<?php
require_once('../layout/footer.php');