<?php
ob_start();
session_start();
require_once ('../db/function.php');
require_once ('../function/symbol.php');

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/show_products.css">
    
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
                        <a href="../index.php">
                            <div id="logo">
                                <img src="../images/logo.png" alt="Logo">
                            </div>
                        </a>

                        <form action="index.php" method="POST" class="search-form">
                            <input type="text" name="textSearch" placeholder="Tìm kiếm: cà chua, dâu tây, bắp cải,..." required>
                            <button type="submit">
                                <img src="../images/search.png" alt="search">
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
                                        <li><a href="../function/logout.php">Đăng xuất</a></li>
                                    </ul>
                                    </span>';
                                }else{
                                    
                            
                            ?>
                                <ul>
                                    <li><span class='span_space' id='click_login'>Đăng nhập</span>
                                    <?php
                                        include_once '../function/login.php';
                                    ?>

                                    </li>
                                    <li id='cheo'>/</li>
                                    <li><span class='span_space' id='click_register' >Đăng ký</span>
                                    <?php 
                                        include_once '../function/register.php';
                                    ?>
                                    </li>

                                </ul>
                            <?php
                                } 
                                
                            ?>
                            </div>

                            <div id="cart">
                                <a href="index.php?tab=bill">
                                    <img src="../images/shopping-cart.png" alt="shopping-cart">
                                    
                                    <?php if (isset($_SESSION['cart'])){
                                        $quantityCart = 0;
                                        foreach($_SESSION['cart'] as $id=>$quantity){
                                            $quantityCart += $quantity;
                                        }
                                        echo '<span>'.$quantityCart.'</span>';
                                        }else{
                                            echo '';
                                        } ?>
                                    
                                </a>
                            </div>

                        </div>

                    </div>
                    <nav id="menu-top">
                        <ul>
                            <li><a href="../index.php">Trang chủ</a></li>
                            <li><a href="#">Nhà bán hàng</a></li>
                            <li class="product"><a href="index.php">Gian hàng</a></li>
                            <li><a href="#">Sự khác biệt</a></li>
                            <li><a href="#">Tin tức</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <!--Nội dung trang-->
        <?php
          if (!isset($_GET['tab'])){
            include_once './product/index.php';
          }else{
            switch ($_GET['tab']){
              case 'bill':
                include_once './bill/index.php';
                break;
              case 'product':
                include_once './product/index.php';
                break;
              case 'product_detail':
                include_once './product_detail/index.php';
                break;
              case 'shipping_bill':
                include_once './shipping_bill/index.php';
                break;
              default:
                include_once './product/index.php';
            }
        }
        ?>     

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
    <script src="../js/my_jquery_functions.js"></script>
</body>

</html>