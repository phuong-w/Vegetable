<?php
session_start();

if (isset($_POST['action'])){
  $action = $_POST['action'];

  switch($action){
    case 'logout':
      if (isset($_SESSION['username2'])){
        unset($_SESSION['username2']);
      }
      break;
  }
  
}

?>