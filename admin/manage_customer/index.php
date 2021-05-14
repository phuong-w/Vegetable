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

        $sql2 = "select * from user where fullname like ('$textNew') or phone like ('$textNew') order by id desc";

    }else{
        $sql2 = "select * from user";
    }
    
    $totalRows = executeTotalRowsResult($sql2);

    // var_dump($totalRows);
    $totalPages = ceil($totalRows/$rowPerPage);
    
    $listPage = '';
    for ($i = 1; $i <= $totalPages; $i++){
        if ($totalPages == 1){
            $listPage = '';
        }elseif($page == $i){
            $listPage .= '<li class="page-item"><a style="border: 1px solid blanchedalmond;color: #fff; background: darkgray" style="color: rgb(114, 165, 11)" class="page-link" href="manage.php?tab=manage_user&page='.$i.'">'.$i.'</a></li>';
        }else{
            $listPage .= '<li class="page-item"><a style="color: #222" class="page-link" href="manage.php?tab=manage_customer&page='.$i.'">'.$i.'</a></li>';
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
                        <th>Tên đầy đủ</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Ngày khởi tạo</th>
                        <th>Ngày sửa đổi</th>
                        <th width="100px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['textSearch']) && $_POST['textSearch'] != null ){
                        //Lay danh muc theo input search theo phan trang
                        $sql = "select * from user where fullname like ('$textNew') or phone like ('$textNew') order by permission desc limit $perRow, $rowPerPage";
                    }else{
                        // Lay danh muc theo phan trang
                        $sql = "select * from user order by permission desc limit $perRow, $rowPerPage";
                    }

                    $userList = executeResult($sql);

                    if ($userList == null){ //check loi du lieu ra
                        echo 'Không tìm thấy dữ liệu.';
                    }else{
                        $index = 1;
                        foreach ($userList as $item){
                            echo '<tr>
                                <td style="line-height: 28px;">'.($index++).'</td>
                                <td style="line-height: 28px;">'.$item['fullname'].'</td>
                                <td style="line-height: 28px;">'.$item['phone'].'</td>
                                <td style="line-height: 28px;">'.$item['address'].'</td>
                                <td style="line-height: 28px;">'.$item['created_at'].'</td>
                                <td style="line-height: 28px;">'.$item['updated_at'].'</td>
                                <td style="line-height: 28px;">';
                                date_default_timezone_set("Asia/Ho_Chi_Minh");
                                $updated_at = date('Y-m-d H:i:s');
                                
                                if (isset($item['permission']) && $item['permission'] == 0) 
                                    echo '<button style="border: none;background: darkgray;" class ="btn btn-danger" onclick="blockUser('.$item['id'].', '.$item['permission'].', \''.$updated_at.'\');" >Mở khóa</button>';
                                elseif (isset($item['permission']) && $item['permission'] == 1) echo '<button class ="btn btn-danger" onclick="blockUser('.$item['id'].', '.$item['permission'].', \''.$updated_at.'\');">Khóa TK</button>';
                                else echo 'ADMIN';
                            
                            echo' </td>
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