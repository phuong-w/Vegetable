<?php
  require_once('../../db/function.php');

  // ajax
  if (!empty($_POST)){
    if (isset($_POST['action'])){
      
      $action = $_POST['action'];
      
      switch($action){
        case 'delete':
          if (isset($_POST['id'])){
            $id = $_POST['id'];

            $sql = 'delete from product where id ='.$id;
            execute($sql);
          }
          break;
      }
    }
  }
?>