<?php
    require_once('../db/function.php');
?>
<div class="main">
    <div class="title">
        <a href="">
            <h4>Quản lý danh mục</h4>
        </a>
    </div>

    <div class="main-table">
        <div class="header-table">
            <div class="add">
                <a href="manage.php?page_layout=add_category">
                    <h4>Thêm danh mục mới</h4>
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
                        <th>Tên danh mục</th>
                        <th>Ngày khởi tạo</th>
                        <th width="50px"></th>
                        <th width="50px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Lay danh tat ca san pham
                    $sql = 'select * from category';
                    $productList = executeResult($sql);
                    

                    $index = 1;
                    foreach ($productList as $item){
                        echo '<tr style="line-height: 25px; min-height: 25px;height: 25px;">
                            <td>'.($index++).'</td>
                            <td>'.$item['name'].'</td>
                            <td>'.$item['created_at'].'</td>
                            <td>
                                <a href="manage.php?page_layout=edit_category&id='.$item['id'].'"><button class ="btn btn-warning"> Sửa </button></a>
                            </td>
                            <td>
                                <button class ="btn btn-danger" onclick="deleteCategory('.$item['id'].')"> Xóa </button>
                            </td>
                        </tr>';
                    }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>