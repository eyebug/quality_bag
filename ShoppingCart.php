<?php
require_once('./util/autoloader.php');
require_once('./layout/header.php');?>
<div class="container body-content">

    <h2>Shopping Cart</h2>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Bag</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Sub Total</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody id="show-cart-data"></tbody>

                </table>
            </div>
        </div>
    </div>



</div>

<?php
require_once('./layout/footer.php');
