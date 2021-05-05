<?php
    // $fullname = $address = $phone = $username = $password = '';

    if (!empty($_POST)){
        if (isset($_POST['fullname'])){
            $fullname = $_POST['fullname'];
        }
        if (isset($_POST['address'])){
            $address = $_POST['address'];
        }
        if (isset($_POST['phone'])){
            $phone = $_POST['phone'];
        }
        if (isset($_POST['username'])){
            $username = $_POST['username'];
        }
        if (isset($_POST['password'])){
            $password = $_POST['password'];
        }
        if (isset($_POST['r_password'])){
            $r_password = $_POST['r_password'];
        }

        $sql1 = "select * from user where username = '$username' ";
        $username_slq = executeSingleResult($sql1);

        $check  = false;

        if ($username_slq != ''){
            $check = false;
            $error_username = "Tai khoan da ton tai!";
            echo $error_username;
            die();
        }else if ($password != $r_password){
            $check = false;
            $error_password = "Nhap lai mat khau khong dung";
            echo $error_password;
            die();
        }else{
            $check = true;
        }

        if ($check == true){
            if(!empty($username)){
                date_default_timezone_set("Asia/Ho_Chi_Minh");
                $created_at = $updated_at = date('Y-m-d H:i:s');
                //check loi dau
                $username = str_replace('\'', '\\\'', $username);
                $password = str_replace('\'', '\\\'', $password);
                $fullname = str_replace('\'', '\\\'', $fullname);
                $phone = str_replace('\'', '\\\'', $phone);
                $address = str_replace('\'', '\\\'', $address);

                $sql2 = "insert into user(username, password, fullname, address, phone, created_at, updated_at)
                        values('$username', '$password', '$fullname', '$address', '$phone', '$created_at', '$updated_at')";
                
                execute($sql2);
                header('location:  index.php');
                die();
            }
        }
    }
?>

<?php 

    if (!isset($_SESSION['username1'])){ //dang nhap
?>
<div class="register">
  <h3  class="register-heading">Đăng ký</h3>
  <span class="close"><i class="fas fa-times"></i></span>
  <div class="row register-form">
    <form method="POST">
      <div class="col-md-6">
          <div class="form-group">
              <input type="text" class="form-control" name="fullname" placeholder="Họ tên" value=""/>
          </div>
          <div class="form-group">
              <input type="text" class="form-control" name="address" placeholder="Địa chỉ" value="" />
          </div>
          <div class="form-group">
              <input type="text" maxlength="10" name="phone" minlength="10" class="form-control" placeholder="Phone" value="" />
          </div>

      </div>
      <div class="col-md-6">
          <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Tên tài khoản">
          </div>
          <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Mật khẩu" value="" />
          </div>
          <div class="form-group">
              <input type="password" class="form-control" name="r_password" placeholder="Nhập lại mật khẩu" value="" />
          </div>
          <input type="submit" class="btnRegister" name="submit" value="Đăng ký"/>
      </div>
    </form>
  </div>  
</div>
<?php
}else{ //da dang nhap
    header('Location: index.php');
}
?>