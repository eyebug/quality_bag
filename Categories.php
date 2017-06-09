<?php
require_once('./util/autoloader.php');
require_once('./layout/header.php');
Session::getSession()->adminOnly();
$db = DB::getDB();
$result = $db->query("SELECT * FROM categories");
?>

    <div class="container body-content">

        <h2>Index</h2>

        <p>
            <a href="/Category/Create.php">Create New</a>
        </p>
        <table class="table">
            <thead>
            <tr>
                <th>
                    CategoryName
                </th>
                <th>
                    Description
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach($result as $row){
                    $output = sprintf('
                    <tr>
                <td>
                    %1$s
                </td>
                <td>
                    %2$s
                </td>
                <td>
                    <a href="/Category/Edit.php?id=%3$s">Edit</a> |
                    <a href="/Category/Details.php?id=%3$s">Details</a> |
                    <a href="/Category/Delete.php?id=%3$s">Delete</a>
                </td>
            </tr>', htmlentities($row['category_name']), htmlentities($row['description']),$row['id']);
                    echo $output;
                }
            ?>
            </tbody>
        </table>

    </div>

<?php
require_once('./layout/footer.php');