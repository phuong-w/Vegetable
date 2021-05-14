<?php
  session_start();
  require_once ('../db/function.php');
  $id = $_POST['id'];

  // echo $id;
  // die();
  if (isset($_POST['action'])){
    $action = $_POST['action'];
    $quantity = $_POST['quantity'];
    // print_r($quantity);
    // die();
    $sqlQuantity = "select * from product where id = ".$id;
    $num = executeSingleResult($sqlQuantity);

    if ($action == 'add'){
      if (isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id] = $_SESSION['cart'][$id] + $quantity;
      }else{
        $_SESSION['cart'][$id] = $quantity; 
      }
    }
  }

?>