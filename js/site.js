$(document).ready(function () {
    loadCartBags();

    if (sessionStorage.getItem('cartBags') === null) {
        $('#cart-amount').text('0');
    } else {
        $('#cart-amount').text(sessionStorage.getItem('cartAmout'));
    }
});

function AddToCart(productId) {
    $.ajax({
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        type: 'get',
        url: urlPrefix + '/AddToCart.php',
        data: { 'bagID': productId },
        traditional: true,
        success: function (resultData) {
            var cartAmount = $('#cart-amount');
            var amount = parseInt(cartAmount.text());
            amount += 1;
            cartAmount.text(amount);
            sessionStorage.setItem('cartAmout', amount);

            AddBag2Cart(resultData)
        },
        error: function (resultData) {
            var cartAmount = $('#cart-amount');
            var amount = parseInt(cartAmount.text());
            amount += 1;
            sessionStorage.setItem('cartAmout', amount);
            cartAmount.text(amount);

            AddBag2Cart(resultData)
        }
    });
}

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

//var urlPrefix = '/chenc75/asp_assignment';
var urlPrefix = "";


function AddBag2Cart(jsonStrData) {

    var cartObj = $.parseJSON(jsonStrData);
    var bagId = cartObj[0].ID;
    var bagName = cartObj[0].BagName;
    var unitPrice = cartObj[0].Price;
    var image = cartObj[0].ImageURL;

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
    item['Image'] = urlPrefix + image;
    cartBags.push(item);

    sessionStorage.setItem('cartBags', JSON.stringify(cartBags));
}

function loadCartBags() {

    var cartDetail = $('#show-cart-data');
    cartDetail.empty();
    var content = '';
    var grandTotal = 0;

    var cartArray = JSON.parse(sessionStorage.getItem('cartBags'));
    for (var i in cartArray) {
        var product = cartArray[i];
        content += '<tr id=' + '"' + product.BagId + '">';
        content += '<td class="col-sm-8 col-md-6">' +
                        '<div class="media">';
        content += '<a class="thumbnail pull-left">' +
                        '<img class="media-object" src=' + '"' + product.Image + '"' + 'style="width: 70px; height: 70px;"/></a>';
        content += '<div class="media-body">' +
                        '<h5 class="media-heading"><a>' + product.BagName + '</a></h5>' +
                    '</div>';
        content += '</div></td>';
        content += '<td class="col-sm-1 col-md-1" style="text-align: center">';
        content += '<input id=' + '"' + 'quantity' + product.BagId + '"' + 'type="number" class="form-control" value=' + '"' + product.Quantity + '"/>';
        content += '</td>';
        content += '<td class="col-sm-1 col-md-1 text-center">' + '$' + product.UnitPrice + '</td>';
        content += '<td id=' + '"' + 'subTotal' + product.BagId + '"' + 'class="col-sm-1 col-md-1 text-center">$' + product.SubTotal + '</td>';
        content += '<td class="col-sm-1 col-md-1"><button id=' + '"' + 'btnRemove' + product.BagId + '"' + 'type="button" class="btn btn-success">' +
                        '<i class="fa fa-trash"></i> Remove</button></td>';
        content += '</tr>';
        grandTotal += product.SubTotal;
    }
    var gst = parseFloat(grandTotal * 15 / 100).toFixed(2);
    content += '<tr><td></td><td></td><td></td>' +
                '<td nowrap="nowrap"><h4>GST(15%):</h4></td>' +
                '<td class="text-right"><h4 id="gst">$' + gst + '</h4></td></tr>';
    content += '<tr>';
    content += '<tr><td></td><td></td><td></td>' +
                '<td nowrap="nowrap"><h4>Grand Total:</h4></td>' +
                '<td class="text-right"><h4 id="grandTotal">$' + grandTotal + '</h4></td></tr>';
    content += '<tr>';
    content += '<td></td><td></td><td></td><td>' +
                    '<button id="btnEmptyCart" type="button" class="btn btn-success"><i class="fa fa-trash-o"></i>Empty Cart</button></td>';
    content += '<td><button id="btnCheckOut" type="button" class="btn btn-success">Checkout</button></td>';
    content += '</tr>';

    cartDetail.append(content);

    $('#btnEmptyCart').click(function () {
        $.sessionStorage.remove('cartBags');
        loadCartBags();
        $('#cart-amount').text(0);
        sessionStorage.remove('cartAmout');
    });
    $('#btnCheckOut').click(function () {
        var orderObj = JSON.parse(sessionStorage.getItem('cartBags'));
        var gst = $('#gst').text().replace('$', '');
        var grandTotal = $('#grandTotal').text().replace('$', '');
        var orderJsonStr = JSON.stringify(orderObj);

        $.ajax({
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            type: 'get',
            url: urlPrefix + '/PlaceOrder.php',
            data: { 'orderJsonStr': orderJsonStr, 'gst': gst, 'grandTotal': grandTotal },
            traditional: true,
            success: function (result) {
                if (result == false) {
                    alert('Please login before you place order.')
                    location.href = urlPrefix + '/Account/Login.php?returnUrl=' + urlPrefix + '/Orders/ShoppingCart';
                } else {
                    alert('Checkout successfully, you can view your order from Order Page.')
                    sessionStorage.clear();
                    location.href = urlPrefix + '/ShoppingCart.php'

                }
            },
            error: function (data, textStatus, jqXHR) {
            }
        });
    });

    // Remove item from cart
    $('[id^=btnRemove]').on('click', function (e) {
        var btnId = $(this).attr('id');
        var removeBagId = btnId.replace('btnRemove', '');

        var cartArray = JSON.parse(sessionStorage.getItem('cartBags'));

        for (var i in cartArray) {
            var cartBag = cartArray[i];
            if (cartBag.BagId == removeBagId) {

                cartArray.splice(i, 1);
                sessionStorage.setItem('cartBags', JSON.stringify(cartArray));
                break;
            }
        }

        var bagRow = $(this).parent().parent();
        bagRow.remove();

        var grandTotal = 0;
        var count = 0;
        for (var i in cartArray) {
            var cartBag = cartArray[i];
            grandTotal += cartBag.SubTotal;
            count += cartBag.Quantity;
        }

        var gst = parseFloat(grandTotal * 15 / 100).toFixed(2);

        $('#gst').text('$' + gst);
        $('#grandTotal').text('$' + grandTotal);
        $.sessionStorage.set('cartAmout', count);
        $('#cart-amount').text(count);
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