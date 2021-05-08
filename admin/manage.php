<?php
    ob_start();
    session_start();

    require_once ('../db/function.php');

    $userAdmin ='';
    if (!empty($_SESSION)){
        if (isset($_SESSION['username2']) && isset($_SESSION['password2'])){
            $username = $_SESSION['username2'];
            $password = $_SESSION['password2'];
            $sql = "select * from user where username = '$username' and password = '$password' and permission = 2";

            $userAdmin = executeSingleResult($sql);

        }
    }

    if ($userAdmin != null){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Page admin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <link rel="stylesheet" href="../css/page_admin.css">
    
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="header-flex">
                        <span class="logo">
                      <h3 class="logo-text">DONGPHUONG<span>ADMIN</span></h3>
                        </span>

                        <span class="sayhi">
                            <i class="fas fa-user-check"></i>
                            <span>Xin chào, <span id="username"><?php if (isset($_SESSION['fullname2'])){ echo $_SESSION['fullname2'];} ?></span></span>
                            <i class="fas fa-caret-down"></i>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Thông tin</a></li>
                                <li><a href="#">Cài đặt</a></li>
                                <li><a href="logout.php">Đăng xuất</a></li>
                            </ul>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="col-left" style="border-right: 2px solid #222;">
                <div class="div-input_search">
                    <form class="form-input_search">
                        <input type="text" class="input_search" placeholder="Tìm kiếm">
                        <button type="submit" class="button_search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="clear"></div>
                <hr>
                <div class="menu_control">
                    <ul>
                        <a href="manage.php?tab=home_admin"><li class="active"><i class="fas fa-tachometer-alt"></i>Trang chủ quản trị</li></a>
                        <a href="manage.php?tab=manage_category"><li><i class="fas fa-check-circle"></i>Quản lý danh mục</li></a>
                        <a href="manage.php?tab=manage_product"><li><i class="fas fa-check-circle"></i>Quản lý sản phẩm</li></a>
                        <a href="manage.php?tab=manage_customer"><li><i class="fas fa-users"></i>Quản lý khách hàng</li></a>
                        <a href="manage.php?tab=manage_ads"><li><i class="fas fa-ad"></i>Quản lý quảng cáo</li></a>
                        <a href="manage.php?tab=manage_config"><li><i class="fas fa-cog"></i>Cấu hình</li></a>
                    </ul>
                </div>
                <hr>

                <div class="logout">
                    <ul>
                        <a href="logout.php"><li><i class="fas fa-sign-out-alt"></i>Đăng xuất</li></a>
                    </ul>
                </div>
            </div>

            <div class="col-right">
                    <span onclick="logoutAdmin()" class="back_home" style="cursor:pointer; text-align: center; display: block;width: 200px; float: right;padding: 30px 0;">
                        <span style="display: block;">Trang chủ</span>
                    <i style="font-size: 30px; line-height: 12px;">&rarr;</i>
                    </span>
                <?php
                    if (empty($_GET['tab'])){
                        header('Location: manage.php?tab=home_admin');
                    }

                    switch ($_GET['tab']) {
                        
                        case 'manage_category' :
                            include_once './manage_category/index.php';
                            break;
                        case 'manage_product' :
                            include_once './manage_product/index.php';
                            break;
                        case 'manage_customer' :
                            include_once './manage_customer/index.php';
                            break;
                        case 'manage_ads' :
                            include_once './manage_ads/index.php';
                            break;
                        case 'manage_config' :
                            include_once './manage_config/index.php';
                            break;
                        
                        // dieu huong product
                        case 'add_product' :
                            include_once './manage_product/add.php';
                            break;
                        case 'edit_product' :
                            include_once './manage_product/edit.php';
                            break;
                        case 'delete_product' :
                            include_once './manage_product/delete.php';
                            break;

                        // dieu huong category
                        case 'add_category' :
                            include_once './manage_category/add.php';
                            break;
                        case 'edit_category' :
                            include_once './manage_category/edit.php';
                            break;
                        case 'delete_category' :
                            include_once './manage_category/delete.php';
                            break;

                        default :
                            include_once './home_admin/index.php';
                    }
                ?>
            </div>
        </div>
    </div>

    

    <script src="../js/admin_jquery.js"></script>
    <script src="../js/ajax.js"></script>
</body>

</html>

<?php
    }else{
        header('Location: index.php');
    }
?>