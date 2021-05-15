<?php
    require_once('../db/function.php');

    
?>
    <link rel="stylesheet" href="../css/page_admin.css">

<?php
if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];

    if (isset($_GET['page_bill'])){
        $page_bill = $_GET['page_bill'];
      }else{
            $page_bill = 1;
        }
    
    $rowPerPageBill = 4; //so bill hien thi
    $perRowBill = $page_bill * $rowPerPageBill - $rowPerPageBill;
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

    if (isset($_POST['txtBill']) && $_POST['txtBill'] != null){
        $txtBill = $_POST['txtBill'];
        $txtBill = str_replace('.', '', $txtBill);
        $txtBill = str_replace('đ', '', $txtBill);
        $text = trim($txtBill); //xoa khoang trang dau va cuoi (result: 'nguyen thai phuong')
        $text = str_replace('.', '', $text);
        $arrayText = explode(' ', $text); //cat chuoi theo khoang trang, tra ve mang (result: $arrayText = ['nguyen','thai','phuong'])
        $textNew = implode('%', $arrayText); //truyen ky tu '%' vao cac phan tu, tra ve chuoi (result: 'nguyen%thai%phuong')
        $textNew = '%'.$textNew.'%'; //truyen ky tu '%' vao dau va cuoi chuoi (result: '%nguyen%thai%phuong%')

        $sql2 = "select b.id
                from bill b join user u on b.id_user = u.id
                where u.fullname like '$textNew' or u.phone like '$textNew' or b.created_at like '$textNew' or b.totals like '$textNew' and u.username = '$username'";
    }else{
        $sql2 = "select b.id
                from bill b join user u on u.id = b.id_user
                where u.username = '$username'";
    }
    
    $totalRowsBill = executeTotalRowsResult($sql2);
    // var_dump($totalRows);
    $totalPagesBill = ceil($totalRowsBill/$rowPerPageBill); //tongSoTrang = tongSoSanPham / soSanPhamHienThi (lam tron lay phan nguyen)
    
    $listPageBill = '';
    for ($i = 1; $i <= $totalPagesBill; $i++){
        if ($totalPagesBill == 1){
            $listPageBill = '';
        }elseif($page_bill == $i){
            $listPageBill .= '<li class="page-item"><a style="border: 1px solid darkgray;
            color: #fff; background:darkgray; box-shadow: 0 5px 8px 0 rgb(0 0 0 / 20%), 0 9px 26px 0 rgb(0 0 0 / 19%);" style="color: #222" class="page-link"
            href="index.php?tab=shipping_bill&page_bill='.$i.'">'.$i.'</a></li>';
        }else{
            $listPageBill .= '<li class="page-item"><a style="color: #222; box-shadow: 0 5px 8px 0 rgb(0 0 0 / 20%), 0 9px 26px 0 rgb(0 0 0 / 19%);"
            class="page-link" href="index.php?tab=shipping_bill&page_bill='.$i.'">'.$i.'</a></li>';
        }
    }
?>
<div id="content">
<hr>
    <div class="section-2 section">
    <div class="main" style="width: 68%;margin: auto;">
        <div style="display: block;">
            <h4 style="width: 40%;float: left; font-size: 22px; line-height: 5px;">ĐƠN HÀNG ĐÃ MUA</h4>
            <div class="div-input_search" style="margin-top: 40px; width: 100%">
                <form method="POST">
                    <div class="form-group" style="height: 50px;">
                        <input style="width: 40%; float:right" type="text" class="form-control" name="txtBill" placeholder="Tìm kiếm đơn hàng" required />
                        <input type="submit" hidden>
                    </div>
                </form>
            </div>
        </div>
        
    
    <?php
        if (isset($_POST['txtBill'])){
            $sql = "select b.id, u.phone, u.address, u.fullname, u.username, b.created_at, b.totals, b.action
                    from bill b join user u on b.id_user = u.id
                    where u.fullname like '$textNew' or u.phone like '$textNew' or b.created_at like '$textNew' or b.totals like '$textNew' and u.username = '$username'
                    group by b.id
                    order by b.action 
                    limit $perRowBill, $rowPerPageBill";
        }else{
            $sql = "select b.id, u.phone, u.address, u.fullname, u.username, b.created_at, b.totals, b.action
                    from bill b join user u on b.id_user = u.id
                    where u.username = '$username'
                    group by b.id
                    order by b.action
                    limit $perRowBill, $rowPerPageBill";
        }
        
        $billList = executeResult($sql);

        if ($billList == null){
            echo "<script>
                $.alert({
                    title: 'Thông báo:',
                    content: 'Không có đơn hàng',
                    buttons: { 
                        ok: function (){
                            location.replace('index.php');
                        }
                    }
                });
            </script>";
        }
        foreach($billList as $bill){
            // echo $bill['phone'];
        /*onload="txtSearch(<?=$bill['id']?>,<?php if (isset($_POST['textSearch'][$bill['id']])){ echo $_POST['textSearch'][$bill['id']];}?>)"*/

        $sql = "select count(d.id_product) as total_quantity from detail_bill d join bill b on d.id_bill = b.id
            group by b.id";
        $rowQtyProduct = executeSingleResult($sql);

        $sql = "select count(b.id_user) as buy_quantity from bill b join user u on b.id_user = u.id
            group by u.id";
        $rowQtyBuy = executeSingleResult($sql);
    ?>
        <div style="border-radius: 5px 5px 0 0; margin: 15px 0;background-color: #126e0f; box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);">
        <div class="bill" style="border-radius: 5px 5px 0 0; border: 1px solid #222; padding: 10px">
            <ul>
            <li id="hover" onmouseover="proFileBlock(<?=$bill['id']?>)" onmouseout="proFileNone(<?=$bill['id']?>)" class="hover"><i>Bill: </i><?=$bill['phone']?></li>
            <li><i>Địa chỉ: </i><?=$bill['address']?></li>
            <li><i>Ngày mua: </i><?=$bill['created_at']?></li>
            <li><i>Số lượng: </i><?=$rowQtyProduct['total_quantity']?></li>
            <li><i>Thanh toán: </i><?=currency_format($bill['totals'])?></li>
            </ul>
            <div style="padding-top: 7px; height: 36px;">
            <button onclick="viewDetail(<?=$bill['id']?>)" style="float: left; border: none;background: darkgray;  margin-right: 14%;" class ="btn btn-danger">Xem chi tiết</button>
            <ul style=" float: left; padding: 5px 20px; background: #fff; margin-top: 1px; border-radius: 5px; margin-right: 50px;">

            <?php
                if ($bill['action'] == 0)
                echo '<li style="font-weight: bold; color: red"><i style="font-weight:lighter; padding-right: 10px; ">Trạng thái: </i>Chưa xác nhận</li>';
                else 
                echo '<li style="font-weight: bold;"><i style="font-weight:lighter; padding-right: 10px; ">Trạng thái: </i>Đã xác nhận</li>';
            ?>

            </ul>
            
            </div>
        </div>
        <div style="z-index: 9999999;" id="block-profile<?=$bill['id']?>" class="block-profile">
            <ul>
            <li><i>Tên tài khoản: </i><?=$bill['username']?></li>
            <li><i>Số lần mua: </i><?=$rowQtyBuy['buy_quantity']?></li>
            <li><i>Họ tên: </i><?=$bill['fullname']?></li>
            <li><i>Sđt: </i><?=$bill['phone']?></li>
            <li><i>Địa chỉ: </i><?=$bill['address']?></li>
            </ul>
        </div>
        </div>

        <!-- item detail bill -->
        <div class="main-table" style="margin-top:-15px;border-radius: 0px 0px 5px 5px">
        <div id="table_content<?=$bill['id']?>" class="table_form" style="display: none;">
          <div class="header-table">
            <div class="div-input_search">
                <form method="POST">
                    <div class="form-group">
                        <input style="width: 100%;" type="text" class="form-control" name="textSearch[<?=$bill['id']?>]" placeholder="Tìm kiếm" required />
                        <input type="submit" hidden>
                    </div>
                </form>
            </div>
          </div>
            <table class="table table-bordered table-hover" style="display: table;">
                <thead>
                    <tr>
                        <th width="50px">STT</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá bán</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['textSearch'][$bill['id']])){
                        $textSearch = $_POST['textSearch'][$bill['id']];
                        // echo $textSearch;
                        // die();
                        
                        $text = trim($textSearch); //xoa khoang trang dau va cuoi (result: 'nguyen thai phuong')
                        $arrayText = explode(' ', $text); //cat chuoi theo khoang trang, tra ve mang (result: $arrayText = ['nguyen','thai','phuong'])
                        $textNew = implode('%', $arrayText); //truyen ky tu '%' vao cac phan tu, tra ve chuoi (result: 'nguyen%thai%phuong')
                        $textNew = '%'.$textNew.'%'; //truyen ky tu '%' vao dau va cuoi chuoi (result: '%nguyen%thai%phuong%')
                        //Lay san pham theo du lieu input search
                        $sql = "select p.thumbnail, p.title, p.price, d.quantity, d.total, b.totals
                         from detail_bill d join bill b on d.id_bill = b.id 
                         join product p on p.id = d.id_product 
                         where p.title like '$textNew' and d.id_bill = $bill[id]" ;
                    }else{
                        // Lay danh tat ca san pham
                        $sql = "select p.thumbnail, p.title, p.price, d.quantity, d.total, b.totals
                        from detail_bill d join bill b on d.id_bill = b.id 
                        join product p on p.id = d.id_product
                        where d.id_bill = $bill[id]" ;
                    }
                    
                    $productList = executeResult($sql);

                    if ($productList == null){
                        echo "Không tìm thấy dữ liệu";
                    }else{
                        $index = 1;
                        foreach ($productList as $item){
                            echo '<tr>
                                <td>'.($index++).'</td>
                                <td style="width:150px"><img width="65%" src="'.$item['thumbnail'].'"></td>
                                <td>'.$item['title'].'</td>
                                <td>'.currency_format($item['price']).'</td>
                                <td>'.$item['quantity'].'</td>
                                <td>'.currency_format($item['total']).'</td>
                                
                            </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
    </div>
    <?php
        }
    ?>
    <hr style="margin-top: 40px; margin-bottom: -16px;">
        <div class="navigation" style="display: block; position: inherit;">
          <ul class="pagination" style="justify-content: center; padding: 5px 0px 50px 0px; ">
              
              <?php
                  echo $listPageBill;
              ?>
              
              
          </ul>
        </div>
    </div>
</div> 
<?php
    }else{
        echo "<script>
                $.alert({
                    title: 'Thông báo:',
                    content: 'Bạn phải đăng nhập',
                    buttons: { 
                        ok: function (){
                            location.replace('index.php');
                        }
                    }
                });
            </script>";
    }
?>