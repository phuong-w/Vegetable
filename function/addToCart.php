<?php
  session_start();
  $id = $_GET['id'];

  // echo $id;
  // die();

  if (isset($_SESSION['cart']['id'])){
    $_SESSION['cart'][$id] = $_SESSION['cart'][$id] + 1;
  }else{
    $_SESSION['cart'][$id] = 1; 
  }

  header('location: ../master_page/index.php?page_layout=product'); 
?>