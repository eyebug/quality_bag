<?php
require_once('./util/autoloader.php');
require_once('./layout/header.php');
Session::getSession()->adminOnly();
$db = DB::getDB();
$result = $db->query("SELECT * FROM suppliers");
?>

    <div class="container body-content">

        <h2>Index</h2>

        <p>
            <a href="/Supplier/Create.php">Create New</a>
        </p>
        <table class="table">
            <thead>
            <tr>
                <th>
                    Supplier Name
                </th>
                <th>
                    Email
                </th>
                <th>
                    MobileNo
                </th>
                <th>
                    Home PhoneNo
                </th>
                <th>
                    Work PhoneNo
                </th>
                <th>
                    Address
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
                $format = '            <tr>
                <td>
                    %1$s
                </td>
                <td>
                    <a href="mailto:Johns@email.com">%2$s</a>
                </td>
                <td>
                    %3$s
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
                <td>
                    <a href="/Supplier/Edit.php?id=%7$s">Edit</a> |
                    <a href="/Supplier/Details.php?id=%7$s">Details</a> |
                    <a href="/Supplier/Delete.php?id=%7$s">Delete</a>
                </td>
            </tr>';
            foreach($result as $row){
                $output = sprintf($format, htmlentities($row['supplier_name']),
                    htmlentities($row['email']), htmlentities($row['mobile_no']), htmlentities($row['home_phone_no']),
                    htmlentities($row['work_phone_no']), htmlentities($row['address']), $row['id']
                    );
                echo $output;

            }
            ?>
            </tbody>
        </table>


    </div>

<?php
require_once('./layout/footer.php');