<?php
require_once ('../db/function.php');

if (isset($_GET['id'])){
$id = $_GET['id'];
$sql = "select p.title, p.price, p.thumbnail, p.quantity, p.sale, p.content, p.updated_at from product p where id=".$id;

$row = executeSingleResult($sql);
if ($row != null){
?>

<link rel="stylesheet" href="../css/product_detail.css">

<!-- Content -->
<div id="content">
    <hr>
    <div class="section-2 section">
        <div class="container">
            <div class="card">
                <div class="container-fliud">
                    <div class="wrapper row">
                        <div class="preview col-md-6">
                        
                            <div class="preview-pic tab-content">
                                
                                <div class="tab-pane active" id="pic-1"><img src="<?= $row['thumbnail'] ?>"/></div>
                                <!-- <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
                                <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/400/252" /></div>
                                <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/400/252" /></div>
                                <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/400/252" /></div> -->
                            </div>

                        </div>
                        <div class="details col-md-6">
                            <h3 class="product-title"><?=$row['title']?></h3>
                            <div class="rating">
                                <div class="stars">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                                <span class="review-no">41 reviews</span>
                            </div>
                            <!-- <p class="product-description"></p> -->
                            <div class="form-group" style="margin-top: 35px; margin-bottom: 0px">
                                <input type="number" class="form-control" name="quantity" id="quantity" value="1" min="1" max = "<?=$row['quantity']?>" style="width: 45px;text-align: center;">
                            </div>

                            <h4 class="price-group">Giá tiền: 
                            <?php if($row['sale'] > 0 && $row['sale'] != null){
                                    $sale = $row['sale']; //%
                                    $price = $row['price'];
                                    $price_sale = $price * ((100 - $sale) / 100);
                                    
                                    echo "<span class='show-price' style='text-decoration: line-through; color: #BDBDBD;text-transform: initial;'>
                                    <span class='old-price' style='color: #BDBDBD;font-size: 20px'>".currency_format($price)."</span>
                                    <span class='kilogram' style='color: #BDBDBD;font-size: 18px'>kg</span>
                                    </span>

                                    <span class='show-price-sale' style='text-transform: initial;'>
                                    <span class='price' style='font-size: 20px'>".currency_format($price_sale)."</span>
                                    <span class='kilogram' style='font-size: 18px'>kg</span>
                                    </span>";
                                }else{
                                    $price = $row['price'];
                                    echo "<span class='show-price' style='text-transform: initial;'>
                                    <span class='old-price' style='font-size: 20px'>".currency_format($price)."</span>
                                    <span class='kilogram' style='font-size: 18px'>kg</span>
                                    </span>";
                                }?>
                            </h4>
                            <p style="text-align:left; font-size: 14px">Ngày cập nhật: <strong><?=$row['updated_at']?></strong></p>

                            <div class="action">
                                <button class="add-to-cart btn btn-default" type="button">Thêm vào giỏ hàng</button>
                                <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-detail">
            <ul class="menu-detail">
                <li>
                    <h4>Tin dùng</h4>
                    <hr class="luot-song">
                </li>
                <li>
                    <h4>Blogs</h4>
                    <hr class="luot-song">
                </li>
            </ul>

            <div class="content-detail">

            </div>
        </div>
    </div>
    <hr>

</div>



<?php
}else{
echo "Lỗi rồi. Ra đảo Tắm Biển điii!";
echo "<br>";
echo "LÀM GÌ CÓ ID NÀYYYYY";
}
}
?>