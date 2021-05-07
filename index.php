<?php
ob_start();
session_start();
require_once ('./db/function.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vegetable</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,300;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">
    
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
                                        <img src="./images/shipped.png" alt="shipped">
                                        <span>Kiểm tra đơn hàng</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="./images/plant.png" alt="plantCoin">
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
                        <a href="index.php">
                            <div id="logo">
                                <img src="./images/logo.png" alt="Logo">
                            </div>
                        </a>

                        <form action="./master_page/index.php" method="POST" class="search-form">
                            <input type="text" name="textSearch" placeholder="Tìm kiếm: cà chua, dâu tây, bắp cải,..." required>
                            <button type="submit">
                                        <img src="./images/search.png" alt="search">
                                        <span>Tìm kiếm</span>
                            </button>
                        </form>

                        <div id="groud-user-cart">
                            <div id="user">
                            <?php 
                                    if (isset($_SESSION['username']) && isset($_SESSION['password'])){
                                        echo '<span class="sayhi" style="position: relative;">
                                    <i class="fas fa-user" style="font-size: 18px; border: 1px solid darkseagreen; border-radius: 50%; padding: 5px; color: darkseagreen"></i>
                                    <span id="username" style="font-size: 18px; padding: 0 5px">'.$_SESSION['fullname'].'</span>
                                    <i class="fas fa-caret-down" style="font-size: 18px;"></i>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Thông tin</a></li>
                                        <li><a href="#">Đơn hàng</a></li>
                                        <li><a href="./function/logout.php">Đăng xuất</a></li>
                                    </ul>
                                    </span>';
                                }else{
                                    
                            
                            ?>
                                <ul>
                                    <li><span class='span_space' id='click_login'>Đăng nhập</span>
                                    <?php
                                        include_once './function/login.php';
                                    ?>

                                    </li>
                                    <li id='cheo'>/</li>
                                    <li><span class='span_space' id='click_register' >Đăng ký</span>
                                    <?php 
                                        include_once './function/register.php';
                                    ?>
                                    </li>

                                </ul>
                            <?php
                                } 
                                
                            ?>
                            </div>

                            <div id="cart">
                                <a href="./master_page/index.php?page_layout=bill">
                                    <img src="./images/shopping-cart.png" alt="shopping-cart">
                                    
                                    <?php if (isset($_SESSION['cart'])){
                                        echo '<span>'.count($_SESSION['cart']).'</span>';
                                        }else{
                                            echo '';
                                        } ?>
                                    
                                </a>
                            </div>

                        </div>

                    </div>
                    <nav id="menu-top">
                        <ul>
                            <li><a href="index.php">Trang chủ</a></li>
                            <li><a href="#">Nhà bán hàng</a></li>
                            <li class="product"><a href="./master_page/index.php?page_layout=product">Gian hàng</a></li>
                            <li><a href="#">Sự khác biệt</a></li>
                            <li><a href="#">Tin tức</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <!--Nội dung trang-->
        <div class="container-xl">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                </ul>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="./images/img-banner1.jpg" alt="banner-1">
                    </div>

                    <div class="item">
                        <img src="./images/img-banner2.jpg" alt="banner-2">
                    </div>

                    <div class="item">
                        <img src="./images/img-banner3.jpg" alt="banner-3">
                    </div>

                    <div class="item">
                        <img src="./images/img-banner4.jpg" alt="banner-4">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <i class="fas fa-chevron-left prev"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <i class="fas fa-chevron-right next"></i>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <!-- Content -->
        <div id="content">
            <div class="section-1 section">
                <img src="./images/—Pngtree—fresh lemon fruit_3602986.png" style="position: absolute;top: 7%;right: -15%;width: 400px; z-index: -1;">
                <img src="./images/fruit-salad.png" style="position: absolute;width: 300px;top: -2%;right: 83%;z-index: -1;">
                <div class="container">
                    <div class="row">
                        <h2>Top Favorite Fruits</h2>
                        <p>Là những sản phẩm đã được chọn lọc kỹ càng từ Nông Trại Tươi Sạch. Chúng tôi cam kết chất lượng!</p>
                        <div class="block col-md-12">
                            <div class="element col-md-2">
                                <a href="">
                                    <span class="b-img nv-mr-10">
                                        <img src="./images/b-img/icon-1_170x.png" alt="icon-1_170x.png">
                                    </span>
                                    <span class="name_link d-lock">Orange</span>
                                </a>
                            </div>
                            <div class="element col-md-2">
                                <a href="">
                                    <span class="b-img nv-mr-10">
                                        <img src="./images/b-img/icon-2_170x.png" alt="icon-2_170x.png">
                                    </span>
                                    <span class="name_link d-lock">Grape</span>
                                </a>
                            </div>
                            <div class="element col-md-2">
                                <a href="">
                                    <span class="b-img nv-mr-10">
                                        <img src="./images/b-img/icon-3_170x.png" alt="icon-3_170x.png">
                                    </span>
                                    <span class="name_link d-lock">Peach</span>
                                </a>
                            </div>
                            <div class="element col-md-2">
                                <a href="">
                                    <span class="b-img nv-mr-10">
                                        <img src="./images/b-img/icon-4_170x.png" alt="icon-4_170x.png">
                                    </span>
                                    <span class="name_link d-lock">Pineapple</span>
                                </a>
                            </div>

                            <div class="element col-md-2">
                                <a href="">
                                    <span class="b-img nv-mr-10">
                                        <img src="./images/b-img/icon-5_170x.png" alt="icon-5_170x.png">
                                    </span>
                                    <span class="name_link d-lock">Apple</span>
                                </a>
                            </div>

                            <div class="element col-md-2">
                                <a href="">
                                    <span class="b-img nv-mr-10">
                                        <img src="./images/b-img/icon-6_170x.png" alt="icon-6_170x.png">
                                    </span>
                                    <span class="name_link d-lock">Tomato</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="section-2 section" style="background-image: url(./images/img-8_1920x.webp);">
                <div class="container">
                    <div class="row">
                        <div id="product-home">
                            <h2 id="tile-product-2">Featured products</h2>
                            <p id="text-title-product"><span>&#8212;</span> Fresh from our farm <span>&#8212;</span></p>
                            <ul id="menu-product-home">
                                <a href="index.php?page_layout=home"><li class="click">All Goods</li></a>
                                <?php
                                    $sql = 'select * from category order by id asc';
                                    $categoryList = executeResult($sql);

                                    foreach ($categoryList as $category){
                                        echo '<a href="index.php?page_layout=home&id='.$category['id'].'"><li>'.$category['name'].'</li></a>';
                                    }
                                ?>
                            </ul>
                            <?php
                                include_once 'product-home.php'; //goi danh sach san pham
                            ?>
                            
                        </div>

                    </div>
                </div>
            </div>
            <div class="section-3 section">
                <div class="container">
                    <div class="row">
                        <div class="block col-md-12">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="gallery-image_item nov-sh-image-1">
                                    <a href="" class="w-100">
                                        <img src="./images/img-1_1920x.jpg" alt="img-1_1920x.jpg">
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="gallery-image_item nov-sh-image-1">
                                    <a href="" class="w-100">
                                        <img src="./images/img-2_1920x.jpg" alt="img-2_1920x.jpg">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <footer id="footer">
            <div class="footer_newsletter" style="background-image: url(./images/img-9_1920x.webp);">
                <div class="container">
                    <div class="row">
                        <div class="b_news">
                            <img src="./images/icon-7_120x.webp" alt="icon-7" class="icon-7">
                            <h3 class="title-block">Đăng ký nhận tin khuyến mại</h3>
                            <form>
                                <div class="input-group">
                                    <input type="email" placeholder="Nhập email của bạn" class="email_footer" required>
                                    <button class="button_footer">Đăng ký</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="footer_policy" style="background-image: url(./images/img-10_1920x.webp)">
                    <div class="container">
                        <div class="row">
                            <div class="bgroup_policy col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="bicon_policy" style="background-image: url(./images/icon-policy/bicon_policy_85x.webp)">
                                    <img src="./images/icon-policy/p-1_45x.webp" class="icon_policy">
                                </div>
                                <h4 class="title_policy">Thanh toán khi giao hàng</h4>
                            </div>
                            <div class="bgroup_policy col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="bicon_policy" style="background-image: url(./images/icon-policy/bicon_policy_85x.webp)">
                                    <img src="./images/icon-policy/p-2_45x.webp" class="icon_policy-mid icon_policy">
                                </div>
                                <h4 class="title_policy">Giao hàng miễn phí</h4>
                            </div>
                            <div class="bgroup_policy col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="bicon_policy" style="background-image: url(./images/icon-policy/bicon_policy_85x.webp)">
                                    <img src="./images/icon-policy/p-3_45x.webp" class="icon_policy">
                                </div>
                                <h4 class="title_policy">Chính sách hoàn tiền</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                                <a href=""><img src="./images/i_payment.png" style="width: 92%; margin-left: -18px;"></a>
                                <a href=""><img src="./images/bct.png" style="margin-left: -18px;"></a>
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