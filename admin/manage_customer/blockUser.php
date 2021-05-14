<?php
  require_once('../../db/function.php');

  // ajax
  if (!empty($_POST)){
    if (isset($_POST['action'])){
      
      $action = $_POST['action'];
      
      switch($action){
        case 'block':
          if (isset($_POST['id'])){
            $id = $_POST['id'];
            $permission = $_POST['permission'];
            $updated_at = $_POST['updated_at'];
            if ($permission == 1){
              $sql = "update user set permission = 0, updated_at = '$updated_at' where id =".$id;
            }else{
              $sql = "update user set permission = 1, updated_at = '$updated_at' where id =".$id;
            }
            execute($sql);
          }
          break;
      }
    }
  }

?>