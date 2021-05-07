<?php
  require_once ('../db/function.php');

  require_once ('../db/symbol.php');


  //xu ly phan trang
    if (isset($_GET['page'])){
    $page = $_GET['page'];
    }else{
        $page = 1;
    }

    if (isset($_GET['id']) && $_GET['id'] != ''){
        $id_category = $_GET['id'];
        $sql2 = "select product.id from product where id_category=".$id_category;

    }elseif (isset($_POST['textSearch']) && $_POST['textSearch'] != ''){
        $textSearch = $_POST['textSearch'];
        $text = trim($textSearch); //xoa khoang trang o dau va cuoi
        $arrayText = explode(' ', $text); //cat chuoi theo ky tu truyen vao, tra lai 1 mang
        $textNew = implode('%', $arrayText); //chen ky tu vao tung phan tu cua mang, tra lai chuoi string
        $textNew = '%'.$textNew.'%'; //bo xung ky tu vao dau va cuoi

        $sql2 = "select product.id from product where title like ('$textNew')";
    }else{
        $sql2 = "select product.id from product";
    }

    $rowPerPage = 8;
    $perRow = $page * $rowPerPage - $rowPerPage;
    $totalRows = executeTotalRowsResult($sql2);
    // var_dump($totalRows);
    $totalPages = ceil($totalRows/$rowPerPage);
    $listPage = '';
    for ($i = 1; $i <= $totalPages; $i++){
        if ($totalPages == 1){
            $listPage = '';
        }elseif($page == $i){
            $listPage .= '<li class="page-item"><a style="border: 1px solid blanchedalmond;color: #fff; background: #80bb01" class="page-link" href="index.php?page_layout=product&page='.$i.'">'.$i.'</a></li>';
        }else{
            $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$i.'">'.$i.'</a></li>';
        }
    }

  if (isset($_GET['id']) != null){
    $id_category = $_GET['id'];

    $sql = "select product.id, product.title, product.thumbnail, product.price, product.sale, product.updated_at 
    from product where product.id_category = '$id_category' order by product.id desc limit $perRow, $rowPerPage";
    $productList = executeResult($sql);
  }else{
      if (isset($_POST['textSearch']) && $_POST['textSearch'] != null){
        $sql = "select product.id, product.title, product.thumbnail, product.price, product.sale, product.updated_at 
        from product where product.title like ('$textNew') order by product.id desc limit $perRow, $rowPerPage";
      }else{
        $sql = "select product.id, product.title, product.thumbnail, product.price, product.sale, product.updated_at 
        from product order by product.id desc limit $perRow, $rowPerPage";
      }
        $productList = executeResult($sql);
  }

?>

<div class="main-product-home">
    <div class="products">
    <?php
        if ($productList == null){
            echo "Không tìm thấy dữ liệu";
        }else{
            foreach($productList as $row){
    ?>
    <a href='index.php?page_layout=product_detail&id=<?=$row['id']?>'>
        <div class="col-product-home">
                <?php  
                $divGroup = "";

                if (isset($row['updated_at'])){
                    date_default_timezone_set("Asia/Ho_Chi_Minh");
                    $date_today = strtotime(date('Y-m-d H:i:s')); // doi ngay/thang/nam hien tai thanh seconds 
                    $updated_at = strtotime($row['updated_at']); // doi ngay/thang/nam updated thanh seconds 
                    
                    $numSeconds = $date_today - $updated_at;
                    $numDay = round($numSeconds / (60*60*24)); // tinh ra ngay hien tai. Ham lam tron so round(num, chi so sau dau phay)
                    
                    if ($numDay <= 2){
                        $divGroup ="<div class='new-sale-group'>"."<span class='new'>&#8226; New</span>";
                    }else{
                        $divGroup ="<div class='new-sale-group' style='justify-content: flex-end'>";
                    }
                }

                if ($row['sale'] > 0 && $row['sale'] != null){
                    $divGroup .= "<span class='sale'>Sale &#8226;</span>";
                }

                $divGroup .= "</div>";
                echo $divGroup;
                ?>

            <img src="<?php echo $row['thumbnail'];?>" alt="ca-chua" class="img-products-home" style="width: 165px;">

            <div class="group-heart-cart-eye">
                <a href=""><i class="far fa-heart"></i></a>
                <a href="../function/addToCart.php?id=<?= $row['id']?>"><i class="fas fa-shopping-cart"></i></a>
                <a href="index.php?page_layout=product_detail&id=<?= $row['id']?>"><i class="far fa-eye"></i></a>
            </div>

            <div class="title-product-home">
                <h3 class="product-name"><?= $row['title']?></h3>
                <div class="group-price-old_price">
                    <?php if($row['sale'] > 0 && $row['sale'] != null){
                        $sale = $row['sale'];
                        $price = $row['price'];
                        $price_sale = $price * ((100 - $sale) / 100);
                        
                        echo "<span class='show-price' style='text-decoration: line-through; color: #BDBDBD'>
                        <span class='old-price' style='color: #BDBDBD; font-size:12px'>".currency_format($price)."</span>
                        <span class='kilogram' style='color: #BDBDBD'>kg</span>
                        </span>

                        <span class='show-price-sale'>
                        <span class='price'>".currency_format($price_sale)."</span>
                        <span class='kilogram'>kg</span>
                        </span>";
                    }else{
                        $price = $row['price'];
                        echo "<span class='show-price'>
                        <span class='old-price'>".currency_format($price)."</span>
                        <span class='kilogram'>kg</span>
                        </span>";
                    }?>

                    
                </div>
            </div>
        </div>
    </a>
        <?php }
        }
        ?>
    </div>
    
</div>
<!-- pagination -->

<div class="navigation">
    <ul class="pagination">
        
        <?php
            echo $listPage;
        ?>
        
        
    </ul>
</div>