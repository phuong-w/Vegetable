<?php
  session_start();

  if(isset($_POST['id']) && isset($_POST['quantity'])){
    if (isset($_POST['action'])){
      $action = $_POST['action'];
      $id = $_POST['id'];
      $quantity = $_POST['quantity'];
      switch ($action){
        case 'minus':
          // echo "Trừ";
          if ($quantity > 0){
            $quantity -= 1;
            $_SESSION['cart'][$id] = $quantity;
          }
          if ($quantity == 0){
            unset($_SESSION['cart'][$id]);
            // echo "Xóa sản phẩm thành công";
          }
          break;
        case 'plus':
          // echo "Cộng";
          if (isset($_POST['qtyProduct'])){
            $qtyProduct = $_POST['qtyProduct'];
          }
          if ($quantity < $qtyProduct){
            $quantity += 1;
            $_SESSION['cart'][$id] = $quantity;
          }
          if ($quantity == $qtyProduct){
            // echo "Số lượng sản phẩm đã đạt tối đa";
          }
          break;
      }
    }


  }
?>