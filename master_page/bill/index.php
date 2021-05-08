
<link rel="stylesheet" href="../css/cart.css">

<!--Nội dung trang-->

<!-- Content -->
<div id="content">
    <hr>
    <div class="section-2 section">
        <?php
        if (isset($_SESSION['cart'])){
            $arrayId = [];
            foreach($_SESSION['cart'] as $id_product => $quantity){
                $arrayId[] = $id_product; //truyen tat ca id vao bien kieu mang
            }
            // print_r($arrayId);
            // die();
            $stringId = implode(',', $arrayId); /*chuyen du lieu sang kieu chuoi, 
                                                truyen vao ',' phan cach moi phan tu */
            $sql = "select * from product where id in ($stringId)";
            $productList =  executeResult($sql);
            // print_r($productList);
            // die();
        ?>
        <div class="cart-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="main-heading">Giỏ hàng</div>
                        <div class="table-cart">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach($productList as $row){
                                ?>
                                    <tr>
                                        <td>
                                            <div class="display-flex align-center">
                                                <div class="img-product">
                                                    <img src="<?=$row['thumbnail']?>" class="mCS_img_loaded">
                                                </div>
                                                <div class="name-product">
                                                    <?= $row['title']?>
                                                </div>
                                                <?php
                                                    if (isset($row['sale']) && $row['sale'] > 0){
                                                        $sale = $row['sale']; //%
                                                        $price = $row['price'];
                                                        $priceNew = $price * (100 - $sale)/100;
                                                        echo "<div class='price'>".currency_format($priceNew)."<br><span style='text-decoration: line-through; color: #989898;'>".currency_format($price)."</span></div>";
                                                    }else{
                                                        echo "<div class='price'>".currency_format($row['price'])."</div>";
                                                    }
                                                ?>
                                            </div>
                                        </td>
                                        <td class="product-count">
                                            <form action="#" class="count-inlineflex">
                                                <div class="qtyminus">-</div>
                                                <input type="text" name="quantity" value="1" class="qty">
                                                <div class="qtyplus">+</div>
                                            </form>
                                        </td>
                                        <td>
                                            <div class="total">
                                                $6,250.00
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" title="">
                                                <i style="font-size: 22px; color: #989898" class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="coupon-box">
                                <form action="#" method="get" accept-charset="utf-8">
                                    <div class="coupon-input">
                                        <input type="text" name="coupon code" placeholder="Mã giảm giá">
                                        <button type="submit" class="round-black-btn">Áp dụng</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.table-cart -->
                    </div>
                    <!-- /.col-lg-8 -->
                    <div class="col-lg-4">
                        <div class="cart-totals">
                            <h3>Thanh Toán</h3>
                            <form action="#" method="get" accept-charset="utf-8">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Tạm tính</td>
                                            <td class="subtotal">$2,589.00</td>
                                        </tr>
                                        <tr>
                                            <td>Phí vận chuyển</td>
                                            <td class="free-shipping">Free Shipping</td>
                                        </tr>
                                        <tr class="total-row">
                                            <td>Tổng tiền</td>
                                            <td class="price-total">$1,591.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="btn-cart-totals">
                                    <a href="#" class="update round-black-btn" title="">Cập nhật</a>
                                    <a href="#" class="checkout round-black-btn" title="">Tiến Hành Thanh Toán</a>
                                </div>
                                <!-- /.btn-cart-totals -->
                            </form>
                            <!-- /form -->
                        </div>
                        <!-- /.cart-totals -->
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            </div>
        </div>
    </div>
    <?php
        }else{
            echo "<script>
                $.alert({
                    title: 'Thông báo:',
                    content: 'Không có sản phẩm để hiển thị'
                });
            </script>";
        }
    ?>
    <hr>

</div>
