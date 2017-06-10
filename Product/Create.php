<?php
require_once('../util/autoloader.php');
require_once('../layout/header.php');
Session::getSession()->adminOnly();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $db = DB::getDB();
    $suppliers = $db->query("SELECT * FROM suppliers;");
    $categories = $db->query("SELECT * FROM categories;");
    ?>
    <div class="container body-content">

        <h2>Create</h2>

        <form enctype="multipart/form-data" action="/Product/Create.php" method="post" novalidate="novalidate">
            <div class="form-horizontal">
                <h4>Bag</h4>
                <hr>
                <div class="text-danger"></div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="BagName">BagName</label>

                    <div class="col-md-10">
                        <input class="form-control" type="text" data-val="true"
                               data-val-length="The BagName must be at least 1 and at max 100 characters long."
                               data-val-length-max="100" data-val-length-min="1"
                               data-val-required="The BagName field is required." id="BagName" name="BagName" value="">
                        <span class="text-danger field-validation-valid" data-valmsg-for="BagName"
                              data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Brand">Brand</label>

                    <div class="col-md-10">
                        <input class="form-control" type="text" id="Brand" name="Brand" value="">
                        <span class="text-danger field-validation-valid" data-valmsg-for="Brand"
                              data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Price">Price</label>

                    <div class="col-md-10">
                        <input class="currency form-control" min="0" type="number" data-val="true"
                               data-val-required="The Price field is required." id="Price" name="Price" value="">
                        <span class="text-danger field-validation-valid" data-valmsg-for="Price"
                              data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="CategoryID">CategoryID</label>

                    <div class="col-md-10">
                        <select class="form-control" data-val="true"
                                data-val-required="The CategoryID field is required." id="CategoryID" name="CategoryID">
                            <?php
                            foreach ($categories as $category) {
                                $option = sprintf('<option value="%s">%s</option>', $category['id'], htmlentities($category['category_name']));
                                echo $option;
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="SupplierID">SupplierID</label>

                    <div class="col-md-10">
                        <select class="form-control" data-val="true"
                                data-val-required="The SupplierID field is required." id="SupplierID" name="SupplierID">
                            <?php
                            foreach ($suppliers as $supplier) {
                                $option = sprintf('<option value="%s">%s</option>', $supplier['id'], htmlentities($supplier['supplier_name']));
                                echo $option;
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Description">Description</label>

                    <div class="col-md-10">
                        <textarea class="form-control" cols="40" rows="5" id="Description"
                                  name="Description"></textarea>
                        <span class="text-danger field-validation-valid" data-valmsg-for="Description"
                              data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="ImageURL">Image</label>

                    <div class="col-md-2">
                <span class="text-danger field-validation-valid" data-valmsg-for="ImageURL" data-valmsg-replace="true">
                <input type="file" name="_files" id="_files" onchange="imagePreview( this );" accept="image/*">
            </span></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Image Preview</label>

                    <div class="col-md-2">
                        <img id="BagImage" style="width: 300px; height: 300px;" src="/image/default_bag.png"
                             alt="Bag Image">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-2">
                        <input type="submit" value="Create" class="btn btn-default">
                    </div>
                </div>
            </div>
        </form>

        <div>
            <a href="/Products.php">Back to List</a>
        </div>


    </div>
<?php } else {

    $bagName = @$_POST['BagName'];
    $brand = @$_POST['Brand'];
    $price = @intval($_POST['Price']);
    $categoryId = @intval($_POST['CategoryID']);
    $supplierId = @intval($_POST['SupplierID']);
    $description = @$_POST['Description'];

    if (!empty($bagName) && !empty($price) && !empty($categoryId) && !empty($supplierId)) {
        $image = $_FILES['_files'];
        if ($image['error'] != 0 || strpos($image['type'], 'image') === false || $image['size'] > 1024 * 1024 * 5) {
            echo "Image error, please image no more than 5MB";
            require_once('../layout/footer.php');
        } else {
            $fileName = getRandomFileName('jpg');
            $result = move_uploaded_file($image['tmp_name'], getImagesDir() . '/' . $fileName);
            if($result === false){
                throw new Exception("Upload image file failed!");
            }
            $imageUrl = getImageUrl($fileName);
            try {
                DB::getDB()->query("INSERT INTO
            bags(bag_name, brand, category_id, description, image_url, price, supplier_id)
            VALUE (?, ?, ?, ?, ?, ?, ?)", 'ssisssi',
                    $bagName, $brand, $categoryId, $description, $imageUrl, $price, $supplierId);
            } catch (Exception $e) {
                echo $e->getMessage();
                require_once('../layout/footer.php');

            }
        }

    }

    header("Location: /Products.php");

} ?>

<?php
require_once('../layout/footer.php');