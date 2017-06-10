<?php
require_once('./util/autoloader.php');
require_once('./layout/header.php');
$db = DB::getDB();
$categories = $db->query("SELECT * FROM categories;");
$categoryId = @$_GET['category_id'];
if (!is_null($categoryId)) {
    $categoryId = intval($categoryId);
    $sql = "SELECT * FROM bags WHERE category_id = $categoryId;";
} else {
    $sql = "SELECT * FROM bags;";
}
$rows = $db->query($sql);

?>
    <div class="container body-content">

        <h2>Bags</h2>


        <div class="container">
            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="/Bags.php">All</a></li>
                    <?php
                    $format = '<li role="presentation" class="nardropcolor">
                    <a href="/Bags.php?category_id=%s">%s</a>
                    </li>';
                    foreach($categories as $category){
                        $output = sprintf($format, $category['id'], $category['category_name']);
                        echo $output;
                    }
                    ?>

                </ul>
            </div>

            <div class="col-md-10">
                <ul class="layout c6list">
                    <?php
                    $format = '<li>
                        <p>
                            <a href="/Product/Details.php?id=%1$s" title="%2$s">
                                <img src="%3$s"
                                     height="280" width="210" alt="%2$s">
                            </a>
                        </p>

                        <p>
                            <span>%2$s</span>
                            <br>
                            <span>%4$s</span>
                        </p>
                        <button class="btn btn-success" id="addToCart2" onclick="AddToCart(%1$s)">Add to cart</button>
                    </li>';
                    foreach($rows as $row){
                        $output = sprintf($format, $row['id'], htmlentities($row['bag_name']), $row['image_url'], $row['price']);
                        echo $output;
                    }
                    ?>
                </ul>
            </div>
        </div>


    </div>
<?php
require_once('./layout/footer.php');