<?php
  require_once('../../db/function.php');

  // ajax
  if (!empty($_POST)){
    if (isset($_POST['action'])){
      
      $action = $_POST['action'];
      
      switch($action){
        case 'stop_buy':
          if (isset($_POST['id'])){
            $id = $_POST['id'];
            $stops = $_POST['stops'];
            $updated_at = $_POST['updated_at'];
            if ($stops == 1){
              $sql = "update product set stop_buy = 0, updated_at = '$updated_at' where id =".$id;
            }else{
              $sql = "update product set stop_buy = 1, updated_at = '$updated_at' where id =".$id;
            }
            execute($sql);
          }
          break;
      }
    }
  }

?>