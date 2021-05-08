<?php
    require_once('../db/function.php');

    if (isset($_GET['page'])){
        $page = $_GET['page'];
      }else{
            $page = 1;
        }
    
    $rowPerPage = 4;
    $perRow = $page * $rowPerPage - $rowPerPage;

    if (isset($_POST['textSearch']) && $_POST['textSearch'] != null ){
        $textSearch = $_POST['textSearch'];

        $text = trim($textSearch); //loai bo khoang trang o dau va cuoi
        $array_text = explode(' ', $text); //cat chuoi thanh mang thong qua char chuyen vao la space
        $textNew = implode('%', $array_text); //tra ve chuoi cac thanh phan cua mang, va chen vao char (%)
        $textNew = '%'.$textNew.'%'; //bo sung them 2 char (%) o dau va cuoi

        $sql2 = "select * from category where name like ('$textNew') order by id desc";

    }else{
        $sql2 = "select * from category";
    }
    
    $totalRows = executeTotalRowsResult($sql2);

    // var_dump($totalRows);
    $totalPages = ceil($totalRows/$rowPerPage);
    
    $listPage = '';
    for ($i = 1; $i <= $totalPages; $i++){
        if ($totalPages == 1){
            $listPage = '';
        }elseif($page == $i){
            $listPage .= '<li class="page-item"><a style="border: 1px solid blanchedalmond;color: #fff; background: #80bb01" style="color: rgb(114, 165, 11)" class="page-link" href="manage.php?tab=manage_category&page='.$i.'">'.$i.'</a></li>';
        }else{
            $listPage .= '<li class="page-item"><a style="color: rgb(114, 165, 11)" class="page-link" href="manage.php?tab=manage_category&page='.$i.'">'.$i.'</a></li>';
        }
    }
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
                <a href="manage.php?tab=add_category">
                    <h4>Thêm danh mục mới</h4>
                </a>
            </div>

            <div class="div-input_search">
            <form method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Tìm kiếm" name="textSearch" required/>
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
                        <th>Tên danh mục</th>
                        <th>Ngày khởi tạo</th>
                        <th width="50px"></th>
                        <th width="50px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['textSearch']) && $_POST['textSearch'] != null ){
                        //Lay danh muc theo input search theo phan trang
                        $sql = "select * from category where name like ('$textNew') order by id desc limit $perRow, $rowPerPage";
                    }else{
                        // Lay danh muc theo phan trang
                        $sql = "select * from category order by id desc limit $perRow, $rowPerPage";
                    }

                    $categoryList = executeResult($sql);

                    if ($categoryList == null){ //check loi du lieu ra
                        echo 'Không tìm thấy dữ liệu.';
                    }else{
                        $index = 1;
                        foreach ($categoryList as $item){
                            echo '<tr style="line-height: 25px; min-height: 25px;height: 25px;">
                                <td>'.($index++).'</td>
                                <td>'.$item['name'].'</td>
                                <td>'.$item['created_at'].'</td>
                                <td>
                                    <a href="manage.php?tab=edit_category&id='.$item['id'].'"><button class ="btn btn-warning"> Sửa </button></a>
                                </td>
                                <td>
                                    <button class ="btn btn-danger" onclick="deleteCategory('.$item['id'].')"> Xóa </button>
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