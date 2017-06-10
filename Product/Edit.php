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
    $suppliers = $db->query("SELECT * FROM suppliers;");
    $categories = $db->query("SELECT * FROM categories;");


    ?>
    <div class="container body-content">

        <h2>Edit</h2>

        <form enctype="multipart/form-data" action="/Product/Edit.php" method="post" novalidate="novalidate">
            <div class="form-horizontal">
                <h4>Bag</h4>
                <hr>
                <div class="text-danger"></div>
                <input type="hidden" data-val="true" data-val-required="The ID field is required." id="ID" name="ID"
                       value="<?php echo $row['id']; ?>">

                <div class="form-group">
                    <label class="col-md-2 control-label" for="BagName">BagName</label>

                    <div class="col-md-10">
                        <input class="form-control" type="text" data-val="true"
                               data-val-length="The BagName must be at least 1 and at max 100 characters long."
                               data-val-length-max="100" data-val-length-min="1"
                               data-val-required="The BagName field is required."
                               id="BagName" name="BagName" value="<?php echo htmlentities($row['bag_name']); ?>">
            <span class="text-danger field-validation-valid" data-valmsg-for="BagName"
                  data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Brand">Brand</label>

                    <div class="col-md-10">
                        <input class="form-control" type="text" id="Brand" name="Brand"
                               value="<?php echo htmlentities($row['brand']); ?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="Brand"
                              data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Price">Price</label>

                    <div class="col-md-10">
                        <input class="currency form-control" min="0" type="number" data-val="true"
                               data-val-required="The Price field is required." id="Price" name="Price"
                               value="<?php echo $row['price']; ?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="Price"
                              data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="CategoryID">CategoryID</label>

                    <div class="col-md-10">
                        <select class="form-control" data-val="true"
                                data-val-required="The CategoryID field is required."
                                id="CategoryID" name="CategoryID">
                            <?php
                            foreach ($categories as $category) {
                                if ($category['id'] == $row['category_id']) {
                                    echo sprintf('<option selected="selected" value="%s">%s</option>', $category['id'], $category['category_name']);
                                } else {
                                    echo sprintf('<option value="%s">%s</option>', $category['id'], $category['category_name']);
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="SupplierID">SupplierID</label>

                    <div class="col-md-10">
                        <select class="form-control" data-val="true"
                                data-val-required="The SupplierID field is required."
                                id="SupplierID" name="SupplierID">
                            <?php
                            foreach ($suppliers as $supplier) {
                                if ($supplier['id'] == $row['supplier_id']) {
                                    echo sprintf('<option selected="selected" value="%s">%s</option>', $supplier['id'], $supplier['supplier_name']);
                                } else {
                                    echo sprintf('<option value="%s">%s</option>', $supplier['id'], $supplier['supplier_name']);
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Description">Description</label>

                    <div class="col-md-10">
                        <textarea class="form-control" cols="40" rows="5" id="Description"
                                  name="Description"><?php echo htmlentities($row['description']); ?></textarea>
                        <span class="text-danger field-validation-valid" data-valmsg-for="Description"
                              data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="ImageURL">Image</label>

                    <div class="col-md-10">
                <span class="text-danger field-validation-valid" data-valmsg-for="ImageURL" data-valmsg-replace="true">
                <input type="file" name="_files" id="_files" onchange="imagePreview( this );" accept="image/*">
            </span></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Image Preview</label>

                    <div class="col-md-10">
                        <img id="BagImage" style="width: 300px; height: 300px;" src="<?php echo $row['image_url']; ?>"
                             alt="Bag Image">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="Save" class="btn btn-default">
                    </div>
                </div>
            </div>

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
    $id = @intval($_POST['ID']);

    try {
        $rows = $db->query("SELECT * FROM bags WHERE id = ?", 'i', $id);
        if (count($rows) == 0) {
            header("Location: /Products.php");
        }
    } catch (Exception $e) {
        header("Location: /Products.php");
    }
    $row = $rows[0];

    if (!empty($bagName) && !empty($price) && !empty($categoryId) && !empty($supplierId)) {
        $isImageUpdate = false;
        $imageUrl = $row['image_url'];
        $image = $_FILES['_files'];
        if ($image['error'] == 0 && $image['size'] != 0
            && strpos($image['type'], 'image') !== false && $image['size'] <= 1024 * 1024 * 5
        ) {
            $isImageUpdate = true;
            $fileName = getRandomFileName('jpg');
            $result = move_uploaded_file($image['tmp_name'], getImagesDir() . '/' . $fileName);
            if ($result === false) {
                $isImageUpdate = false;
            }
            $imageUrl = getImageUrl($fileName);
        }

        try {
            DB::getDB()->query("UPDATE
            bags SET bag_name = ?, brand = ?, category_id = ?, description = ?, image_url = ?, price = ?, supplier_id = ?
            WHERE id = ?", 'ssissiii',
                $bagName, $brand, $categoryId, $description, $imageUrl, $price, $supplierId, $id);
            if ($isImageUpdate) {
                removeBagImage($row['image_url']);
            }
        } catch (Exception $e) {
            if ($isImageUpdate) {
                removeBagImage($imageUrl);
            }
            echo $e->getMessage();
            require_once('../layout/footer.php');

        }


    }

    header("Location: /Products.php");

} ?>

<?php
require_once('../layout/footer.php');