function deleteCategory(id) {
    var option = confirm('Bạn có muốn xóa danh mục này không?')
    if (!option) {
        return;
    }
    $.post('./manage_category/delete.php', {
        'id': id,
        'action': 'delete'
    }, function(data) {
        // alert(data)
        location.reload()
    })
}

function deleteProduct(id) {
    var option = confirm('Bạn có muốn xóa sản phẩm này không?')
    if (!option) {
        return;
    }
    console.log(id)
    $.post('./manage_product/delete.php', {
        'id': id,
        'action': 'delete'
    }, function(data) {
        // alert(data)
        location.reload()
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