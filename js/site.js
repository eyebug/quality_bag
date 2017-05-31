$(document).ready(function () {
    loadCartBags();

    if (sessionStorage.getItem('cartBags') === null) {
        $('#cart-amount').text('0');
    } else {
        $('#cart-amount').text(sessionStorage.getItem('cartAmout'));
    }
});


// Write your Javascript code.
function imagePreview(elem) {
    /* get file type */
    const fileType = elem.files[0].type;
    /* create file */
    image = document.getElementById('BagImage')
    if (null == document.getElementById('BagImage')) {
        image = document.createElement('img');
    }

    /* instance FileReader */
    reader = new FileReader();
    /* error handle */
    if (/^image\//.test(fileType) === false) return;
    /* show image */
    reader.onload = function (e) {
        /* add path  */
        image.src = e.target.result;
        if (null == document.getElementById('BagImage')) {
            /* insert to element */
            elem.parentNode.appendChild(image);
        }
    }
    /* read file */
    reader.readAsDataURL(elem.files[0]);
}

var urlPrefixAfterDeploy = '/chenc75/asp_assignment';
function AddToCart(bagID) {
    $.ajax({
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        type: 'get',
        url: urlPrefixAfterDeploy + '/Bags/AddToCart',
        data: { 'bagID': bagID },
        traditional: true,
        success: function (jsonStrData, textStatus, jqXHR) {
            var cartAmount = $('#cart-amount');
            var intAmount = parseInt(cartAmount.text());
            intAmount += 1;
            cartAmount.text(intAmount);
            sessionStorage.setItem('cartAmout', intAmount);

            AddBag2Cart(jsonStrData)
        },
        error: function (jsonStrData, textStatus, jqXHR) {
            var cartAmount = $('#cart-amount');
            var intAmount = parseInt(cartAmount.text());
            intAmount += 1;
            cartAmount.text(intAmount);
            sessionStorage.setItem('cartAmout', intAmount);

            AddBag2Cart(jsonStrData)
        }
    });
}

function AddBag2Cart(jsonStrData) {

    var jsonObj = $.parseJSON(jsonStrData);
    var bagId = jsonObj[0].ID;
    var bagName = jsonObj[0].BagName;
    var unitPrice = jsonObj[0].Price;
    var image = jsonObj[0].ImageURL;

    var cartBags = [];
    if (sessionStorage.getItem('cartBags') === null) {
        sessionStorage.setItem('cartBags', JSON.stringify(cartBags));
    } else {
        cartBags = JSON.parse(sessionStorage.getItem('cartBags'));
    }

    for (var i in cartBags) {
        var cartBag = cartBags[i];
        if (bagId == cartBag.BagId) {
            var intQuantity = parseInt(cartBag.Quantity);
            intQuantity += 1;
            cartBag.Quantity = intQuantity;

            var unitPrice = cartBag.UnitPrice;
            cartBag.SubTotal = unitPrice * intQuantity;

            sessionStorage.setItem('cartBags', JSON.stringify(cartBags));
            return;
        }
    }

    var item = {};
    item['BagId'] = bagId;
    item['BagName'] = bagName;
    item['UnitPrice'] = unitPrice;
    item['Quantity'] = 1;
    item['SubTotal'] = unitPrice;
    item['Image'] = urlPrefixAfterDeploy + image;
    cartBags.push(item);

    sessionStorage.setItem('cartBags', JSON.stringify(cartBags));
}

function loadCartBags() {

    var showCartData = $('#show-cart-data');
    showCartData.empty();
    var content = '';
    var grandTotal = 0;

    var cartBags = JSON.parse(sessionStorage.getItem('cartBags'));
    for (var i in cartBags) {
        var cartBag = cartBags[i];
        content += '<tr id=' + '"' + cartBag.BagId + '">';
        content += '<td class="col-sm-8 col-md-6"><div class="media">';
        content += '<a class="thumbnail pull-left"><img class="media-object" src=' + '"' + cartBag.Image + '"' + 'style="width: 70px; height: 70px;"/></a>';
        content += '<div class="media-body"><h5 class="media-heading"><a>' + cartBag.BagName + '</a></h5></div>';
        content += '</div></td>';
        content += '<td class="col-sm-1 col-md-1" style="text-align: center">';
        content += '<input id=' + '"' + 'quantity' + cartBag.BagId + '"' + 'type="number" class="form-control" value=' + '"' + cartBag.Quantity + '"/>';
        content += '</td>';
        content += '<td class="col-sm-1 col-md-1 text-center">' + '$' + cartBag.UnitPrice + '</td>';
        content += '<td id=' + '"' + 'subTotal' + cartBag.BagId + '"' + 'class="col-sm-1 col-md-1 text-center">$' + cartBag.SubTotal + '</td>';
        content += '<td class="col-sm-1 col-md-1"><button id=' + '"' + 'btnRemove' + cartBag.BagId + '"' + 'type="button" class="btn btn-success"><i class="fa fa-trash"></i> Remove</button></td>';
        content += '</tr>';
        grandTotal += cartBag.SubTotal;
    }
    var gst = parseFloat(grandTotal * 15 / 100).toFixed(2);
    content += '<tr><td></td><td></td><td></td><td nowrap="nowrap"><h3>GST(15%):</h3></td><td class="text-right"><h3 id="gst">$' + gst + '</h3></td></tr>';
    content += '<tr>';
    content += '<tr><td></td><td></td><td></td><td nowrap="nowrap"><h3>Grand Total:</h3></td><td class="text-right"><h3 id="grandTotal">$' + grandTotal + '</h3></td></tr>';
    content += '<tr>';
    content += '<td></td><td></td><td></td><td><button id="btnEmptyCart" type="button" class="btn btn-success"><i class="fa fa-trash-o"></i>Empty Cart</button></td>';
    content += '<td><button id="btnCheckOut" type="button" class="btn btn-success">Checkout</button></td>';
    content += '</tr>';

    showCartData.append(content);

    $('#btnEmptyCart').click(function () {
        $.sessionStorage.remove('cartBags');
        loadCartBags();
        $('#cart-amount').text(0);
        sessionStorage.remove('cartAmout');
    });
    $('#btnCheckOut').click(function () {
        var orderJson = JSON.parse(sessionStorage.getItem('cartBags'));
        var gst = $('#gst').text().replace('$', '');
        var grandTotal = $('#grandTotal').text().replace('$', '');
        var orderJsonStr = JSON.stringify(orderJson);

        $.ajax({
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            type: 'get',
            url: urlPrefixAfterDeploy + '/Orders/MakeOrder',
            data: { 'orderJsonStr': orderJsonStr, 'gst': gst, 'grandTotal': grandTotal },
            traditional: true,
            success: function (result, textStatus, jqXHR) {

                if (result == false) {
                    alert('You have to login first if you want to make order.')
                    location.href = urlPrefixAfterDeploy + '/Account/Login?returnUrl=' + urlPrefixAfterDeploy + '/Orders/ShoppingCart';
                } else {
                    alert('You have to checked out your order successfully, you can check your order in Order Page.')
                    sessionStorage.clear();
                    location.href = urlPrefixAfterDeploy + '/Orders/ShoppingCart'

                }
                var cartAmount = $('#cart-amount');
                var intAmount = parseInt(cartAmount.text());
                intAmount += 1;
                cartAmount.text(intAmount);
                sessionStorage.setItem('cartAmout', intAmount);

                AddBag2Cart(jsonStrData)
            },
            error: function (data, textStatus, jqXHR) {
            }
        });
    });

    // Remove item from cart
    $('[id^=btnRemove]').on('click', function (e) {
        var btnRemoveId = $(this).attr('id');
        var removeBagId = btnRemoveId.replace('btnRemove', '');

        var cartBags = JSON.parse(sessionStorage.getItem('cartBags'));

        for (var i in cartBags) {
            var cartBag = cartBags[i];
            if (cartBag.BagId == removeBagId) {

                cartBags.splice(i, 1);
                sessionStorage.setItem('cartBags', JSON.stringify(cartBags));
                break;
            }
        }

        var bagRow = $(this).parent().parent();
        bagRow.remove();

        var grandTotal = 0;
        var intAmount = 0;
        for (var i in cartBags) {
            var cartBag = cartBags[i];
            grandTotal += cartBag.SubTotal;
            intAmount += cartBag.Quantity;
        }

        var gst = parseFloat(grandTotal * 15 / 100).toFixed(2);

        $('#gst').text('$' + gst);
        $('#grandTotal').text('$' + grandTotal);
        $.sessionStorage.set('cartAmout', intAmount);
        $('#cart-amount').text(intAmount);
    });

    $('[id^=quantity]').change(function () {
        var quantity = $(this).val();
        var intQuantity = 1;
        if (quantity != '') {
            intQuantity = parseInt(quantity);
            if (intQuantity <= 0) {
                intQuantity = 1;
            }
        } else {
            intQuantity = 1;
        }
        $(this).val(intQuantity);

        var bagId = ($(this).attr('id')).replace('quantity', '');

        var cartBags = JSON.parse(sessionStorage.getItem('cartBags'));

        for (var i in cartBags) {
            var cartBag = cartBags[i];
            if (cartBag.BagId == bagId) {

                cartBag.Quantity = intQuantity;
                cartBag.SubTotal = parseFloat((intQuantity * cartBag.UnitPrice).toFixed(2));

                $('#subTotal' + bagId).text('$' + cartBag.SubTotal);
                sessionStorage.setItem('cartBags', JSON.stringify(cartBags));
                break;
            }
        }

        var grandTotal = 0;
        var intAmount = 0;
        for (var i in cartBags) {
            var cartBag = cartBags[i];
            grandTotal += cartBag.SubTotal;
            intAmount += parseInt(cartBag.Quantity);
        }

        var gst = parseFloat(grandTotal * 15 / 100).toFixed(2);

        $('#gst').text('$' + gst);
        $('#grandTotal').text('$' + grandTotal);
        sessionStorage.setItem('cartAmout', intAmount);
        $('#cart-amount').text(intAmount);
    });
}