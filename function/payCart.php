<?php

session_start();
require_once('../db/function.php');
foreach($_SESSION['cart'] as $id_product => $quantity){
  $arrayId[] = $id_product; //truyen tat ca id vao bien kieu mang
}
// print_r($arrayId);
// die();
$stringId = implode(',', $arrayId); /*chuyen du lieu sang kieu chuoi, 
                                  truyen vao ',' phan cach moi phan tu */
$sql = "select title, id, thumbnail, sale, quantity, price from product where id in ($stringId)";
$productList = executeResult($sql); 

if (isset($_POST['pay'])){
  $checkFreeShip = $_POST['freeShip'];
  if ($_POST['pay'] == 'true'){
      if (isset($_SESSION['username']) && isset($_SESSION['password'])){
          
          // echo "Xóa giỏ hàng";
          $username = $_SESSION['username'];
          $sqlUser = "select * from user where username ='$username'";
          $user = executeSingleResult($sqlUser);
          if($user > 0){
              $id_user = $user['id'];
          }
          
          date_default_timezone_set("Asia/Ho_Chi_Minh");
          $created_at = date('Y-m-d H:i:s');

          $sql1 = "insert into bill (id_user, created_at) values($id_user, '$created_at')";
          execute($sql1);
          $slqBill = "select * from bill where created_at = '$created_at'";
          $objectBill = executeSingleResult($slqBill);

          $id_bill = $objectBill['id'];
        //   die();
          $totals = 0;
          foreach($productList as $row){
              $quantity = $_SESSION['cart'][$row['id']];
              $total = 0;
              if (isset($row['sale']) && $row['sale'] > 0){
                  $sale = $row['sale']; //%
                  $price = $row['price'];
                  $priceNew = $price * (100 - $sale)/100;
                  $total = $priceNew * $quantity;
              }else{
                  $total = $row['price'] * $quantity;
              }
              $sql = "insert into detail_bill (id_bill, id_product, price, quantity, total)
              values($id_bill, $row[id], $row[price], $quantity, $total)";
              execute($sql);

              $totals += $total;

              //cap nhap hang hoa
              $updated_qty = $row['quantity'] - $quantity;
              $sql = "update product set quantity = $updated_qty where id =".$row['id'];
              execute($sql);
          }
          $totals += $checkFreeShip;

          $sql2 = "update bill set totals = $totals where id =".$id_bill;
          execute($sql2);

          echo "Thanh toán thành công";
        //   die();
          unset($_SESSION['cart']);
      }else{
          echo "Bạn phải đăng nhập";
      }
    }
}

?>