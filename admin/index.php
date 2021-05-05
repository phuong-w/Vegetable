<?php
  ob_start();
  session_start();
  require_once ('../db/function.php');


  if (!empty($_POST)){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($username) && isset($password)){
      $sql = "select * from user where username = '$username' and password = '$password' and permission = 2";

      $rows = executeSingleResult($sql);

      if ($rows > 0){
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['fullname'] = $rows['fullname'];

        header('Location: manage.php');

      }else{
        echo '<center class="alert alert-danger">Tài khoản không tồn tại</center>';
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,300;1,500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/style.css">
    
</head>

<body>
    <div class="wrapper">
      <?php
        if (!isset($_SESSION['username'])){ // khong ton tai
      ?>
      <div class="login-form" style="display: block;">
        <h3>Đăng nhập</h3>
        <form method="POST">
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Tài khoản" value="" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" value="" />
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
          header('Location: manage.php');
        }
      ?>
    </div>

    <script src="../js/admin_jquery.js"></script>
    <script src="../js/ajax.js"></script>
</body>

</html>