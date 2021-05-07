<?php
    require_once('../db/function.php');

    if (isset($_GET['page'])){
        $page = $_GET['page'];
      }else{
            $page = 1;
        }
    
    $rowPerPage = 3; //so san pham hien thi
    $perRow = $page * $rowPerPage - $rowPerPage;
    /**
    * soSanPhamHienThi = 3
    * Vay chi so bat dau cua trang ke tiep?

    * 1*3-3 = 0 : 0,1,2
    * 2*3-3 = 3 : 3,4,5
    * 3*3-3 = 6 : 6,7,8
    * 4*3-3 = 9 : 9,10,11
    * 5*3-3 = 12 : 12,13,14
    * 6*3-3 = 15 : 15
     */

    if (isset($_POST['textSearch']) && $_POST['textSearch'] != ''){
        $textSearch = $_POST['textSearch'];
        
        $text = trim($textSearch); //xoa khoang trang dau va cuoi (result: 'nguyen thai phuong')
        $arrayText = explode(' ', $text); //cat chuoi theo khoang trang, tra ve mang (result: $arrayText = ['nguyen','thai','phuong'])
        $textNew = implode('%', $arrayText); //truyen ky tu '%' vao cac phan tu, tra ve chuoi (result: 'nguyen%thai%phuong')
        $textNew = '%'.$textNew.'%'; //truyen ky tu '%' vao dau va cuoi chuoi (result: '%nguyen%thai%phuong%')

        $sql2 = "select product.id from product where title like '$textNew'";
    }else{
        $sql2 = "select product.id from product";
    }
    
    $totalRows = executeTotalRowsResult($sql2);
    // var_dump($totalRows);
    $totalPages = ceil($totalRows/$rowPerPage); //tongSoTrang = tongSoSanPham / soSanPhamHienThi (lam tron lay phan nguyen)
    
    $listPage = '';
    for ($i = 1; $i <= $totalPages; $i++){
        if ($totalPages == 1){
            $listPage = '';
        }elseif($page == $i){
            $listPage .= '<li class="page-item"><a style="border: 1px solid blanchedalmond;
            color: #fff; background: #80bb01" style="color: rgb(114, 165, 11)" class="page-link"
            href="manage.php?page_layout=manage_product&page='.$i.'">'.$i.'</a></li>';
        }else{
            $listPage .= '<li class="page-item"><a style="color: rgb(114, 165, 11)"
            class="page-link" href="manage.php?page_layout=manage_product&page='.$i.'">'.$i.'</a></li>';
        }
    }
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
                <form method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="textSearch" placeholder="Tìm kiếm" required />
                        <input type="submit" hidden>
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
                    if (isset($_POST['textSearch']) && $_POST['textSearch'] != ''){
                        //Lay san pham theo du lieu input search (phan trang)
                        $sql = "select product.id, product.title, product.price, product.quantity ,
                         product.thumbnail, product.updated_at, category.name category_name from 
                         product left join category on product.id_category = category.id where product.title like ('$textNew') order by 
                         product.id desc limit $perRow, $rowPerPage" ;
                    }else{
                        // Lay danh tat ca san pham theo phan trang
                        $sql = "select product.id, product.title, product.price, product.quantity ,
                        product.thumbnail, product.updated_at, category.name category_name from product
                        left join category on product.id_category = category.id order by product.id desc 
                        limit $perRow, $rowPerPage" ;
                    }
                    
                    $productList = executeResult($sql);

                    if ($productList == null){
                        echo "Không tìm thấy dữ liệu";
                    }else{
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
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="navigation">
            <ul class="pagination" style="justify-content: flex-end;">
                
                <?php
                    echo $listPage;
                ?>
                
                
            </ul>
        </div>
    </div>
</div>