<?php
  if (!empty($_POST['username'])){
      $username = $_POST['username'];
      $password = $_POST['password'];

      if (isset($username) && isset($password)){
          $sql = "select * from user where username = '$username' and password = '$password' and permission > 0";

          $row = executeSingleResult($sql);

          if ($row > 0){
              $_SESSION['username'] = $username;
              $_SESSION['password'] = $password;
              $_SESSION['fullname'] = $row['fullname'];
              $_SESSION['phone'] = $row['phone'];
              $_SESSION['address'] = $row['address'];
              
          }else{
              $error_login = '<p style="color: red; font-size: 14px;line-height: 20px;">Sai thông tin tài khoản</p>';
          }
      }
  }
?>

<?php 

    if (!isset($_SESSION['username'])){ //dang nhap
?>
<div class="login-form">
  <h3>Đăng nhập</h3>
  <span class="close"><i class="fas fa-times"></i></span>
    <form method="POST">
        <div class="form-group">
            <input type="text" class="form-control" id="username" name="username" placeholder="Tài khoản" required />
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="passwordLogin" name="password" placeholder="Mật khẩu" required />
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