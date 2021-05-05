<?php
    require_once('../db/function.php');
?>
<div class="main">
    <div class="title">
        <a href="">
            <h4>Quản lý sản phẩm</h4>
        </a>
    </div>

    <div class="main-table">
        <div class="header-table">
            <div class="add">
                <a href="manage.php?page_layout=add_product">
                    <h4>Thêm sản phẩm mới</h4>
                </a>
            </div>

            <div class="div-input_search">
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm" value="" />
                    </div>
                </form>
            </div>
        </div>

        <div class="table_form">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="50px">STT</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá bán</th>
                        <th>Danh mục</th>
                        <th width="50px">Số lượng</th>
                        <th>Ngày cập nhật</th>
                        <th width="50px"></th>
                        <th width="50px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Lay danh tat ca san pham
                    $sql = 'select product.id, product.title, product.price, product.quantity , product.thumbnail, product.updated_at, category.name category_name from product left join category on product.id_category = category.id order by product.id desc';
                    $productList = executeResult($sql);

                    $index = 1;
                    foreach ($productList as $item){
                        echo '<tr>
                            <td>'.($index++).'</td>
                            <td style="width:150px"><img width="100%" src="'.$item['thumbnail'].'"></td>
                            <td>'.$item['title'].'</td>
                            <td>'.$item['price'].'</td>
                            <td>'.$item['category_name'].'</td>
                            <td>'.$item['quantity'].'</td>
                            <td>'.$item['updated_at'].'</td>
                            <td>
                                <a href="manage.php?page_layout=edit_product&id='.$item['id'].'"><button class ="btn btn-warning"> Sửa </button></a>
                            </td>
                            <td>
                                <button class ="btn btn-danger" onclick="deleteProduct('.$item['id'].')"> Xóa </button>
                            </td>
                        </tr>';
                    }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>