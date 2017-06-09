<?php
require_once('../util/autoloader.php');
require_once('../layout/header.php');
Session::getSession()->adminOnly();

$db = DB::getDB();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header("Location: /Suppliers.php");
        return;
    }
    $id = intval($_GET['id']);
    try {
        $rows = $db->query("SELECT * FROM suppliers WHERE id = ? LIMIT 1", 'i', $id);
        if (count($rows) == 0) {
            header("Location: /Suppliers.php");
        }
    } catch (Exception $e) {
        header("Location: /Suppliers.php");
    }
    $row = $rows[0];

    ?>
    <div class="container body-content">

        <h2>Edit</h2>

        <form action="/Supplier/Edit.php" method="post" novalidate="novalidate" _lpchecked="1">
            <div class="form-horizontal">
                <h4>Supplier</h4>
                <hr>
                <div class="text-danger"></div>
                <input type="hidden" data-val="true" data-val-required="The ID field is required." id="ID" name="ID" value="<?php echo $row['id']; ?>">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="SupplierName">Supplier Name</label>
                    <div class="col-md-10">
                        <input class="form-control valid" type="text" data-val="true" data-val-length="The Supplier Name must be at least 1 and at max 50 characters long." data-val-length-max="50" data-val-length-min="1" data-val-required="The Supplier Name field is required." id="SupplierName" name="SupplierName" value="<?php echo htmlentities($row['supplier_name']);?>" aria-required="true" aria-invalid="false" aria-describedby="SupplierName-error" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAfBJREFUWAntVk1OwkAUZkoDKza4Utm61iP0AqyIDXahN2BjwiHYGU+gizap4QDuegWN7lyCbMSlCQjU7yO0TOlAi6GwgJc0fT/fzPfmzet0crmD7HsFBAvQbrcrw+Gw5fu+AfOYvgylJ4TwCoVCs1ardYTruqfj8fgV5OUMSVVT93VdP9dAzpVvm5wJHZFbg2LQ2pEYOlZ/oiDvwNcsFoseY4PBwMCrhaeCJyKWZU37KOJcYdi27QdhcuuBIb073BvTNL8ln4NeeR6NRi/wxZKQcGurQs5oNhqLshzVTMBewW/LMU3TTNlO0ieTiStjYhUIyi6DAp0xbEdgTt+LE0aCKQw24U4llsCs4ZRJrYopB6RwqnpA1YQ5NGFZ1YQ41Z5S8IQQdP5laEBRJcD4Vj5DEsW2gE6s6g3d/YP/g+BDnT7GNi2qCjTwGd6riBzHaaCEd3Js01vwCPIbmWBRx1nwAN/1ov+/drgFWIlfKpVukyYihtgkXNp4mABK+1GtVr+SBhJDbBIubVw+Cd/TDgKO2DPiN3YUo6y/nDCNEIsqTKH1en2tcwA9FKEItyDi3aIh8Gl1sRrVnSDzNFDJT1bAy5xpOYGn5fP5JuL95ZjMIn1ya7j5dPGfv0A5eAnpZUY3n5jXcoec5J67D9q+VuAPM47D3XaSeL4AAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: pointer;">
                        <span class="text-danger field-validation-valid" data-valmsg-for="SupplierName" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Email">Email</label>
                    <div class="col-md-10">
                        <input class="form-control" type="email" data-val="true" data-val-email="The Email field is not a valid e-mail address." data-val-required="The Email field is required." id="Email" name="Email" value="<?php echo htmlentities($row['email']); ?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="MobileNo">MobileNo</label>
                    <div class="col-md-10">
                        <input class="form-control" type="tel" data-val="true" data-val-length="The MobileNo must be at least 7 and at max 20 characters long." data-val-length-max="20" data-val-length-min="7" data-val-phone="The MobileNo field is not a valid phone number." id="MobileNo" name="MobileNo" value="<?php echo htmlentities($row['mobile_no']); ?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="MobileNo" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="HomePhoneNo">Home PhoneNo</label>
                    <div class="col-md-10">
                        <input class="form-control" type="tel" data-val="true" data-val-length="The Home PhoneNo must be at least 7 and at max 20 characters long." data-val-length-max="20" data-val-length-min="7" data-val-phone="The Home PhoneNo field is not a valid phone number." id="HomePhoneNo" name="HomePhoneNo" value="<?php echo htmlentities($row['home_phone_no']); ?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="HomePhoneNo" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="WorkPhoneNo">Work PhoneNo</label>
                    <div class="col-md-10">
                        <input class="form-control" type="tel" data-val="true" data-val-length="The Work PhoneNo must be at least 7 and at max 20 characters long." data-val-length-max="20" data-val-length-min="7" data-val-phone="The Work PhoneNo field is not a valid phone number." id="WorkPhoneNo" name="WorkPhoneNo" value="<?php echo htmlentities($row['work_phone_no']); ?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="WorkPhoneNo" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Address">Address</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" data-val="true" data-val-required="The Address field is required." id="Address" name="Address" value="<?php echo htmlentities($row['address']); ?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="Address" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="Save" class="btn btn-default">
                    </div>
                </div>
            </div>

        <div>
            <a href="/Suppliers.php">Back to List</a>
        </div>



    </div>
<?php } else {
    $address = $_POST['Address'];
    $email = $_POST['Email'];
    $mobileNo = $_POST['MobileNo'];
    $homePhoneNo = $_POST['HomePhoneNo'];
    $workPhoneNo = $_POST['WorkPhoneNo'];
    $supplierName = $_POST['SupplierName'];

    $id = @intval($_POST['ID']);
    try {
        DB::getDB()->query("UPDATE suppliers
        SET address = ?, email = ?, home_phone_no = ?,
        work_phone_no = ?, mobile_no = ?, supplier_name = ? WHERE id = ?", 'ssssssi',
            $address, $email, $homePhoneNo, $workPhoneNo, $mobileNo, $supplierName, $id);
    } catch (Exception $e) {

    }
    header("Location: /Suppliers.php");

} ?>

<?php
require_once('../layout/footer.php');