
<link rel="stylesheet" href="../css/profile.css">

<!--Nội dung trang-->
<?php
    if (isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $sql = "select * from user  where username = '$username'";
        $user = executeSingleResult($sql);

        $fullname = $phone = $address = $thumbnail = $password = $old_password = $r_password = $tmp_name = '';

        if (isset($_POST['fullname']) && isset($_POST['phone']) && isset($_POST['address'])){
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $address = trim($address);
            if (strlen($address) != 0){
                $arrAddress = explode(' ', $address);
                $address = implode('', $arrAddress);
            }

            
            

            if(isset($_FILES['thumbnail']['name']) != ''){
                $thumbnail = $_FILES['thumbnail']['name'];
                $tmp_name = $_FILES['thumbnail']['tmp_name'];
            }
            
            $str = trim($phone);
            $arrayStr = explode(' ', $str); //cat chuoi theo khoang trang
            $phoneN = implode('', $arrayStr); //loai bo khoang trang giua cac chuoi
            
            if (is_numeric($phoneN) && strlen($phoneN) >= 10 && strlen($address) > 0){

                date_default_timezone_set("Asia/Ho_Chi_Minh");
                $updated_at = date('Y-m-d H:i:s');
                
                $fullname = str_replace('\'', '\\\'', $fullname);
                $phoneN = str_replace('\'', '\\\'', $phoneN);
                $address = str_replace('\'', '\\\'', $address);
                $thumbnail = str_replace('\'', '\\\'', $thumbnail);

                $path = str_replace('\\', '/', dirname(getcwd(),1));
                
                move_uploaded_file($tmp_name, $path.'/images/' .  $thumbnail);
                if ($thumbnail != ''){
                    $sql = "update user set fullname = '$fullname', phone = '$phoneN', address = '$address', updated_at = '$updated_at', thumbnail = '$thumbnail' where username = '$username'";
                }else{
                    $sql = "update user set fullname = '$fullname', phone = '$phoneN', address = '$address', updated_at = '$updated_at' where username = '$username'";
                }
                execute($sql);
                echo "<script>
                    $(document).ready(
                        $.alert({
                            title: 'Thông báo:',
                            content: 'Thành công!!',
                            buttons: {
                                ok: function(){
                                    location.replace('index.php?tab=profile');
                                }
                            }
                        })
                    );
                </script>";
            }else{
                if (strlen($address) == 0){
                    echo "<script>
                        $(document).ready(
                            $.alert({
                                title: 'Thông báo:',
                                content: 'Địa chỉ không được để trống!!'
                            })
                        );
                    </script>";
                }
                if (is_numeric($phoneN) == false || strlen($phoneN) < 10){
                    echo "<script>
                        $(document).ready(
                            $.alert({
                                title: 'Thông báo:',
                                content: 'Sdt phải là ký tự số và có độ dài = 10'
                            })
                        );
                    </script>";
                }
            }
        }
        
        if (isset($_POST['old_password']) && isset($_POST['old_password']) && isset($_POST['old_password'])){
            $old_password = $_POST['old_password'];
            $password = $_POST['password'];
            $r_password = $_POST['r_password'];

            if ($old_password === $_SESSION['password']){
                
                if (strlen($password) >= 8){
                    if ($password === $r_password){
                        // echo "execute";
                        // die();
                        $sql = "update user set password = '$password' where username ='$username'";
                        execute($sql);
                        echo "<script>
                            $(document).ready(
                                $.alert({
                                    title: 'Thông báo:',
                                    content: 'Thành công!!'
                                })
                            );
                        </script>";
                    }else{
                        echo "<script>
                            $(document).ready(
                                $.alert({
                                    title: 'Thông báo:',
                                    content: 'Nhập lại mật khẩu không đúng!'
                                })
                            );
                        </script>";
                    }
                
                }else{
                    echo "<script>
                        $(document).ready(
                            $.alert({
                                title: 'Thông báo:',
                                content: 'Mật khẩu mới phải có độ dài tối thiểu 8 ký tự!'
                            })
                        );
                    </script>";
                }
            }else{
                echo "<script>
                        $(document).ready(
                            $.alert({
                                title: 'Thông báo:',
                                content: 'Mật khẩu không chính xác!'
                            })
                        );
                    </script>";
            }
        }
?>
<!-- Content -->
<div id="content">
    <div>
        <div class="group">
            <div class="main">
                <div class="img-profile">
                    <?php
                        if (isset($user['thumbnail']) && $user['thumbnail'] != ''){
                            echo "<img width='100%' src='../images/".$user['thumbnail']."'>";
                        }else{
                            echo '<img width="100%" src="../images/profile-1.jpg">';
                        }
                    ?>
                    
                </div>
                
                <h4><?=$user['fullname']?></h4>
                <i>Tài khoản: <?=$user['username']?></i>
            </div>

            <div class="show-updated">
                <div class="detail" id="detail">
                    <h4>Thông tin:</h4>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i><?=$user['address']?></li>
                        <li><i class="fas fa-phone"></i><?=$user['phone']?></li>
                        <li><i id="date">Ngày update tài khoản: </i><?=$user['updated_at']?></li>
                    </ul>
                    <img src="../images/icon_profile.png" alt="">
                    <div style="padding-top: 7px;">
                        <button onclick="updatePassword()" style="border: none;background: darkgray;margin-right: 30px" class="btn btn-danger">Đổi mật khẩu</button>
                        <button onclick="updateDetail()" class="btn btn-danger" style="background-color: #78d09f; border: none;">Sửa thông tin</button>            
                    </div>
                </div>

                <div id="up-detail" class="updated"style="display: none;" >
                    <h4>Chỉnh sửa thông tin:</h4>
                    <form method="POST" id="form-detail" enctype="multipart/form-data">
                        <ul>
                            <label for="fullname">Nhập họ tên</label>
                            <input required type="text" id="fullname" class="form-control" name="fullname" placeholder="Họ tên">
                            <label for="thumbnail" style="float: left; margin-right: 10px">Ảnh đại diện:</label>
                            <input id="thumbnail" name="thumbnail" type="file" style="float: left; width: 56%;">
                            <label for="phone">Nhập số điện thoại*</label>
                            <input required type="text" id="phone" class="form-control" name="phone" placeholder="Sô điện thoại">
                            <label for="address">Nhập địa chỉ*</label>
                            <input required type="text" id="address" class="form-control" name="address" placeholder="Địa chỉ">
                        </ul>
                    </form>
                    <img src="../images/icon_profile.png" alt="">
                    <div style="padding-top: 7px;">
                        <button onclick="packToDetail()" style="border: none;background: darkgray;margin-right: 30px; margin-left: 20px" class="btn btn-danger">Trở lại</button>
                        <button onclick="submitForm()" class="btn btn-danger" style="background-color: #78d09f; border: none;">Cập nhật</button>            
                    </div>
                </div>
                
                <div id="up-password" class="updated" style="display: none;">
                    <h4>Chỉnh sửa thông tin:</h4>
                    <form method="POST" id="form-password">
                        <ul>
                            <label for="old_password">Mật khẩu cũ*</label>
                            <input required type="password" id="old_password" class="form-control" name="old_password">
                            <label for="password">Mật khẩu mới*</label>
                            <input required type="password" id="password" class="form-control" name="password">
                            <label for="r_password">Nhập lại mật khẩu mới*</label>
                            <input required type="password" id="r_password" class="form-control" name="r_password">
                        </ul>
                    </form>
                    <img src="../images/icon_profile.png" alt="">
                    <div style="padding-top: 7px;">
                        <button onclick="packToDetail()" style="border: none;background: darkgray;margin-right: 30px; margin-left: 20px" class="btn btn-danger">Trở lại</button>
                        <button onclick="submitForm()" class="btn btn-danger" style="background-color: #78d09f; border: none;">Cập nhật</button>            
                    </div>
                </div>

            </div>
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
