<?php
require_once('./util/autoloader.php');
require_once('./layout/header.php');
Session::getSession()->adminOnly();
$db = DB::getDB();
$rows = $db->query("SELECT bags.*, c.category_name, s.supplier_name FROM bags
  LEFT JOIN suppliers as s ON s.id = bags.supplier_id
  LEFT JOIN categories as c ON c.id = bags.category_id");

?>
    <div class="container body-content">

        <h2>Index</h2>

        <p>
            <a href="/Product/Create.php">Create New</a>
        </p>
        <table class="table">
            <thead>
            <tr>
                <th>
                    BagName
                </th>
                <th>
                    Brand
                </th>
                <th>
                    Price
                </th>
                <th>
                    CategoryName
                </th>
                <th>
                    Supplier Name
                </th>
                <th>
                    Description
                </th>
                <th>
                    Image
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $format = '<tr>
                <td>
                    %1$s
                </td>
                <td>
                    %2$s
                </td>
                <td>
                    $%3$s
                </td>
                <td>
                    %4$s
                </td>
                <td>
                    %5$s
                </td>
                <td>
                    %6$s
                </td>
                <td width="70px">
                    <img style="width: 70px; height: 70px;" src="%7$s" alt="Product Image" onerror="this.onerror = null; this.src = \'/images/default_bag.png\'">
                </td>
                <td>
                    <a href="/Product/Edit.php?id=%8$s">Edit</a> |
                    <a href="/Product/Details.php?id=%8$s">Details</a> |
                    <a href="/Product/Delete.php?id=%8$s">Delete</a>
                </td>
            </tr>';
            foreach($rows as $row){
                $output = sprintf($format, htmlentities($row['bag_name']), htmlentities($row['brand']), $row['price'],
                    htmlentities($row['category_name']), htmlentities($row['supplier_name']), htmlentities($row['description']), $row['image_url'] ,$row['id']
                    );
                echo $output;

            }


?>
            </tbody>
        </table>


    </div>
<?php
require_once('./layout/footer.php');