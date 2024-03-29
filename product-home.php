<?php
  require_once ('./db/function.php');

  require_once ('./function/symbol.php');

  if (isset($_GET['id']) != null){
    $id_category = $_GET['id'];

    $sql = "select product.id, product.title, product.thumbnail, product.price, product.sale, product.updated_at 
    from product where product.id_category = '$id_category' and product.stop_buy = 0 and product.quantity > 0 order by rand() limit 8";
    $productList = executeResult($sql);
  }else{
    $sql = "select product.id, product.title, product.thumbnail, product.price, product.sale, product.updated_at 
            from product where product.stop_buy = 0 and product.quantity > 0 order by rand() limit 8";
    $productList = executeResult($sql);
  }

?>

<div class="main-product-home">
    <div class="products">
    <?php
        
        foreach($productList as $row){
    ?>  
    <a href='./master_page/index.php?tab=product_detail&id=<?=$row['id']?>'>
        <div class="col-product-home">
            
                <?php 
                    $divGroup ="";

                    if (isset($row['updated_at'])){
                        date_default_timezone_set("Asia/Ho_Chi_Minh");
                        $date_today = strtotime(date('Y-m-d H:i:s')); // doi ngay/thang/nam hien tai thanh seconds 
                        $updated_at = strtotime($row['updated_at']); // doi ngay/thang/nam updated thanh seconds 
                        
                        $numSeconds = $date_today - $updated_at;
                        $numDay = round($numSeconds / (60*60*24)); // tinh ra ngay hien tai. Ham lam tron so round(num, chi so sau dau phay)

                        if ($numDay <= 2){ //sp update chua den 2 ngay la sp moi
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
                

            <img src="<?php $thumbnail = $row['thumbnail'];
                            $thumbnail = str_replace('../', './', $thumbnail);
                            echo $thumbnail;?>" class="img-products-home" style="width: 165px;">

            <div class="group-heart-cart-eye">
                <a href=""><i class="far fa-heart"></i></a>
                <a onclick="addToCartHome('<?=$row['id']?>')"><i class="fas fa-shopping-cart"></i></a>
                <a href="./master_page/index.php?tab=product_detail&id=<?= $row['id']?>"><i class="far fa-eye"></i></a>
            </div>

            <div class="title-product-home">
                <h3 class="product-name"><?= $row['title']?></h3>
                <div class="group-price-old_price">
                    <?php if($row['sale'] > 0 && $row['sale'] != null){
                        $sale = $row['sale']; // %
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
        ?>
        
    </div>
    
</div>
<!--visit-store-->
<a href="./master_page/index.php"><h3 id="visit-store">Ghé thăm cửa hàng</h3></a>