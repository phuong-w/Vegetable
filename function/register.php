<?php
    if (!empty($_POST['usernameR'])){
        if (isset($_POST['fullnameR'])){
            $fullname = $_POST['fullnameR'];
        }
        if (isset($_POST['addressR'])){
            $address = $_POST['addressR'];
        }
        if (isset($_POST['phoneR'])){
            $phone = $_POST['phoneR'];
        }
        if (isset($_POST['usernameR'])){
            $username = $_POST['usernameR'];
        }
        if (isset($_POST['passwordR'])){
            $password = $_POST['passwordR'];
        }
        if (isset($_POST['r_passwordR'])){
            $r_password = $_POST['r_passwordR'];
        }

        $sql1 = "select * from user where username = '$username' ";
        $username_slq = executeSingleResult($sql1);

        $check  = false;

        if ($username_slq != ''){
            $check = false;
            $error_username = "Tai khoan da ton tai!";
            // echo $error_username;
            // header('location:  index.php');
        }else if ($password != $r_password){
            $check = false;
            $error_password = "Nhap lai mat khau khong dung";
            // echo $error_password;
            // header('location:  index.php');
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
              <input type="text" class="form-control" name="fullnameR" placeholder="Họ tên" required/>
          </div>
          <div class="form-group">
              <input type="text" class="form-control" name="addressR" placeholder="Địa chỉ" required />
          </div>
          <div class="form-group">
              <input type="text" maxlength="10" name="phoneR" minlength="10" class="form-control" placeholder="Phone" required />
          </div>

      </div>
      <div class="col-md-6">
          <div class="form-group">
              <input type="text" class="form-control" name="usernameR" placeholder="Tên tài khoản" required>
          </div>
          <div class="form-group">
              <input type="password" class="form-control" id="passwordR" name="passwordR" placeholder="Mật khẩu" required/>
          </div>
          <div class="form-group">
              <input type="password" class="form-control" id="r_passwordR" name="r_passwordR" placeholder="Nhập lại mật khẩu" required/>
          </div>
          <input onclick="checkRegister()" type="submit" class="btnRegister" name="submit" value="Đăng ký"/>
      </div>
    </form>
  </div>  
</div>
<?php
}else{ //da dang nhap
    header('Location: index.php');
}
?>