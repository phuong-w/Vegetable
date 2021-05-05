<!DOCTYPE html>
<html lang="en">

<head>
    <title>Show products</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,300;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/show_products.css">
    <link rel="stylesheet" href="../css/cart.css">
</head>

<body>
    <div class="main-content" id="MainContent">
        <header id="header">
            <div id="header-top">
                <div class="container">
                    <div class="row">
                        <div class="sayhi">
                            <h3>Cửa hàng chuyên cung cấp thực phẩm sạch!</h3>
                        </div>
                        <div class="others">
                            <ul>
                                <li>
                                    <a href="">
                                        <img src="../images/shipped.png" alt="shipped">
                                        <span>Kiểm tra đơn hàng</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="../images/plant.png" alt="plantCoin">
                                        <span>Xu</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div id="header-mid">
                        <a href="" style="z-index: -1;">
                            <div id="logo">
                                <img src="../images/logo.png" alt="Logo">
                            </div>
                        </a>

                        <form action="" class="search-form">
                            <input type="text" placeholder="Tìm kiếm: cà chua, thịt heo, rau cải,...">
                            <button type="submit">
                                        <img src="../images/search.png" alt="search">
                                        <span>Tìm kiếm</span>
                                    </button>
                        </form>

                        <div id="groud-user-cart">
                            <div id="user">
                                <ul>
                                    <li><a href="">Đăng nhập</a></li>
                                    <li id="cheo">/</li>
                                    <li><a href="">Đăng ký</a></li>
                                </ul>
                            </div>

                            <div id="cart">
                                <a href="">
                                    <img src="../images/shopping-cart.png" alt="shopping-cart">
                                    <span>2</span>
                                </a>
                            </div>

                        </div>

                    </div>
                    <nav id="menu-top">
                        <ul>
                            <li><a href="">Trang chủ</a></li>
                            <li><a href="">Nhà bán hàng</a></li>
                            <li class="product"><a href="">Gian hàng</a></li>
                            <li><a href="">Sự khác biệt</a></li>
                            <li><a href="">Tin tức</a></li>
                            <li><a href="">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <!--Nội dung trang-->

        <!-- Content -->
        <div id="content">
            <hr>
            <div class="section-2 section">
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
                                            <tr>
                                                <td>
                                                    <div class="display-flex align-center">
                                                        <div class="img-product">
                                                            <img src="https://www.91-img.com/pictures/laptops/asus/asus-x552cl-sx019d-core-i3-3rd-gen-4-gb-500-gb-dos-1-gb-61721-large-1.jpg" alt="" class="mCS_img_loaded">
                                                        </div>
                                                        <div class="name-product">
                                                            Apple iPad Mini
                                                            <br>G2356
                                                        </div>
                                                        <div class="price">
                                                            $1,250.00
                                                        </div>
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
                                                        <img src="images/icons/delete.png" alt="" class="mCS_img_loaded">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="display-flex align-center">
                                                        <div class="img-product">
                                                            <img src="https://www.91-img.com/pictures/laptops/asus/asus-x552cl-sx019d-core-i3-3rd-gen-4-gb-500-gb-dos-1-gb-61721-large-1.jpg" alt="" class="mCS_img_loaded">
                                                        </div>
                                                        <div class="name-product">
                                                            Apple iPad Mini
                                                            <br>G2356
                                                        </div>
                                                        <div class="price">
                                                            $1,250.00
                                                        </div>
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
                                                        <img src="images/icons/delete.png" alt="" class="mCS_img_loaded">
                                                    </a>
                                                </td>
                                            </tr>
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
                                                    <td>Total</td>
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
            <hr>

        </div>

        <footer id="footer">
            <div class="footer-layout">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <a href="" class="system">
                                <i class="fas fa-map-marker-alt"></i>
                                <h3 class="location">Hệ thống cửa hàng</h3>
                            </a>
                            <p class="address">Địa chỉ: <span>237 An Dương Vương, Quận 5, TpHCM.</span></p>
                            <p class="hotline">Hotline: <span>0962711xxx</span></p>
                            <p class="email">Email: <span>hiencute@gmail.com</span></p>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <h4 class="collapsed">Hỗ trợ khách hàng</h4>
                            <ul class="list-menu">
                                <li class="li_menu"><a href="">Trang chủ</a></li>
                                <li class="li_menu"><a href="">Giới thiệu</a></li>
                                <li class="li_menu"><a href="">Gian hàng</a></li>
                            </ul>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <h4 class="collapsed">Chính sách</h4>
                            <ul class="list-menu">
                                <li class="li_menu"><a href="">Chính sách đổi hàng</a></li>
                                <li class="li_menu"><a href="">Chính sách bảo hành</a></li>
                                <li class="li_menu"><a href="">Chính sách hội viên</a></li>
                                <li class="li_menu"><a href="">Chính sách giao nhận</a></li>
                                <li class="li_menu"><a href="">Hướng dẫn mua hàng</a></li>
                                <li class="li_menu"><a href="">Hướng dẫn thanh toán</a></li>
                                <li class="li_menu"><a href="">Chính sách bảo mật thông tin</a></li>
                            </ul>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <h4 class="collapsed">Kết nối với chúng tôi</h4>
                            <ul class="follow_option">
                                <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                <li><a href=""><i class="fab fa-google"></i></a></li>
                                <li><a href=""><i class="fab fa-instagram"></i></a></li>
                                <li><a href=""><i class="fab fa-youtube"></i></a></li>
                            </ul>
                            <div class="payment_methods">
                                <h4 class="collapsed">Phương thức thanh toán</h4>
                                <a href=""><img src="../images/i_payment.png" style="width: 92%; margin-left: -18px;"></a>
                                <a href=""><img src="../images/bct.png" style="margin-left: -18px;"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer_copyright pt-20 pb-20 pb-sm-80">
                <div class="container">
                    <span class="full_copyright">
                        <span class="mobile">
                            © 2021 DONGPHUONG <span class="hidden-xs">|</span>
                    </span>
                    <span class="opacity1">Thiết kế bởi</span>
                    <a href="index.html" title="Chợ Đông Phương">NHÓM 123</a>
                    </span>
                </div>
            </div>
        </footer>
    </div>

    <div id="_desktop_back_top" style="display: block;">
        <div id="back-top">
            <span><i class="fas fa-chevron-up"></i></span>
        </div>
    </div>
    <script src="./js/my_jquery_functions.js"></script>
</body>

</html>