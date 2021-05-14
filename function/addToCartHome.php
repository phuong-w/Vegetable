<?php
  session_start();
  $id = $_POST['id'];

  // echo $id;
  // die();
  if (isset($_POST['action'])){
    $action = $_POST['action'];

    if ($action == 'add'){
      if (isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id] = $_SESSION['cart'][$id] + 1;
      }else{
        $_SESSION['cart'][$id] = 1; 
      }
    }
  }

?>