<?php
require_once('./util/autoloader.php');
require_once('./layout/header.php');
?>
<?php

?>
    <div class="container body-content">

        <h2>Create</h2>

        <form enctype="multipart/form-data" action="/Create" method="post"
              novalidate="novalidate">
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
                            <option value="1">Men</option>
                            <option value="2">Women</option>
                            <option value="3">Wallet</option>
                            <option value="4">Children</option>
                            <option value="5">sssssss</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="SupplierID">SupplierID</label>

                    <div class="col-md-10">
                        <select class="form-control" data-val="true"
                                data-val-required="The SupplierID field is required." id="SupplierID" name="SupplierID">
                            <option value="2">Johns</option>
                            <option value="3">Good Bag</option>
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
                        <img id="BagImage" style="width: 300px; height: 300px;"
                             src="/chenc75/asp_assignment/images/default_bag.png" alt="Bag Image">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-2">
                        <input type="submit" value="Create" class="btn btn-default">
                    </div>
                </div>
            </div>
            <input name="__RequestVerificationToken" type="hidden"
                   value="CfDJ8NN71KqJMItDtonj4jg0i1FMuOgsJH_QDN_zvw2ndVPuOYpFZ_mxG-oE6a3PDo-VC6W6-rXh6i93Keh_lVMZqcnbMtR52jpYwd1v4sOfaACytYLLgZE8lirne4dn9lFlAhgjRF3AKdTtkCqbOdsFjP-iWbiS29clC4wez5MiYShDYiikQ1xt7TtqqWXTMiWgRQ">
        </form>

        <div>
            <a href="/chenc75/asp_assignment/Products">Back to List</a>
        </div>


    </div>
<?php
require_once('./layout/footer.php');