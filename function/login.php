<?php
    require_once ('./db/function.php');
  if (!empty($_POST)){
      $username = $_POST['username'];
      $password = $_POST['password'];

      if (isset($username) && isset($password)){
          $sql = "select * from user where username = '$username' and password = '$password' and permission > 0";

          $row = executeSingleResult($sql);

          if ($row > 0){
              $_SESSION['username1'] = $username;
              $_SESSION['password1'] = $password;
              $_SESSION['fullname1'] = $row['fullname'];
              $_SESSION['phone1'] = $row['phone'];
              $_SESSION['address1'] = $row['address'];
              
          }else{
              $error_login = '<p style="color: red; font-size: 14px;line-height: 20px;">Sai thông tin tài khoản</p>';
          }
      }
  }
?>

<?php 

    if (!isset($_SESSION['username1'])){ //dang nhap
?>
<div class="login-form">
  <h3>Đăng nhập</h3>
  <span class="close"><i class="fas fa-times"></i></span>
    <form method="POST">
        <div class="form-group">
            <input type="text" class="form-control" id="username" name="username" placeholder="Tài khoản" value="" />
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" value="" />
        </div>
        
        <div class="form-group"> 
      <!-- Bao loi login -->
          <?php
            if (isset($error_login)){
                echo $error_login;
            }
          ?>
        </div>
        <div class="form-group">
            <input type="submit" class="btnSubmit" name="submit" value="Đăng nhập" />
        </div>
        <div class="form-group">
            <a href="#" class="ForgetPwd">Quên mật khẩu?</a>
        </div>
  </form>
</div>
<?php
}else{ //da dang nhap
    header('Location: index.php');
}
?>