function stop_buyProduct(id, stops, updated_at) {
    var option = confirm('Bạn có muốn thay đổi không?')
    if (!option) {
        return;
    }
    $.post('./manage_product/stop_buy.php', {
        'id': id,
        'stops': stops,
        'updated_at': updated_at,
        'action': 'stop_buy'
    }, function(data) {
        // alert(data)
        location.reload()
    })
}

function blockUser(id, permission, updated_at) {
    var option = confirm('Bạn có muốn thay đổi không?')
    if (!option) {
        return;
    }
    $.post('./manage_customer/blockUser.php', {
        'id': id,
        'permission': permission,
        'updated_at': updated_at,
        'action': 'block'
    }, function(data) {
        // alert(data)
        location.reload()
    })
}

function deleteProduct(id) {
    // console.log(id);
    var option = confirm('Bạn có muốn xóa sản phẩm này khỏi giỏ hàng không?')
    if (!option) {
        return;
    }
    $.post('../function/deleteProduct.php', {
        'id': id
    }, function(data) {
        alert(data)
        location.reload();
    })
}

function logoutAdmin() {
    var option = confirm('Bạn có muốn rời khỏi đây không?')
    if (!option) {
        return;
    }

    $.post('logoutAjax.php', {
        'action': 'logout'
    }, function() {
        location.replace('../index.php');
    })
}

function addToCartHome(id) {
    $.post('./function/addToCartHome.php', {
        'id': id,
        'action': 'add'
    }, function() {
        $.alert({
            title: 'Thông báo:',
            content: 'Thêm thành công',
            buttons: {
                ok: function() {
                    location.replace('./master_page/index.php?tab=product');
                }
            }
        });
    })
}

function addToCart(id) {
    $.post('../function/addToCartHome.php', {
        'id': id,
        'action': 'add'
    }, function() {
        $.alert({
            title: 'Thông báo:',
            content: 'Thêm thành công',
            buttons: {
                ok: function() {
                    location.reload();
                }
            }
        });
    })
}

function addToCartDetail(id, productQty) {
    var quantity = $("#quantityDetail").val();

    if (quantity >= 1 && quantity <= productQty) {
        $.post('../function/addToCartDetail.php', {
            'id': id,
            'action': 'add',
            'quantity': quantity
        }, function() {
            $.alert({
                title: 'Thông báo:',
                content: 'Thêm thành công',
                buttons: {
                    ok: function() {
                        location.reload();
                    }
                }
            });
        })
    } else {
        $.alert({
            title: 'Vui lòng nhập lại',
            content: 'Số lượng không tồn tại',
            buttons: {
                ok: function() {
                    location.reload();
                }
            }
        });
    }
}

function qtyMinus(id, quantity) {
    console.log(id, quantity);
    $.post('../function/qtyMinusAndPlus.php', {
        'quantity': quantity,
        'id': id,
        'action': 'minus'
    }, function(data) {
        // alert(data); 
        location.reload();
    })
}

function qtyPlus(id, quantity, qtyProduct) {
    console.log(id, quantity);
    $.post('../function/qtyMinusAndPlus.php', {
        'quantity': quantity,
        'id': id,
        'qtyProduct': qtyProduct,
        'action': 'plus'
    }, function(data) {
        // alert(data);
        location.reload();
    })
}

function payCart(freeShip) {
    $.post('../function/payCart.php', {
        'freeShip': freeShip,
        'pay': 'true'
    }, function(data) {
        alert(data);
        if ($('.login-form').length) { //neu ton tai className 'login-form' thi doi thuoc tinh
            /* $('name').length tra ve 0 neu rong
            
            or $('name')[0] tra ve undefine neu rong
            */
            $('.login-form').css('display', 'block');
        } else {
            location.reload();
        }
    })
}