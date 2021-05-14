<?php
  require_once('../../db/function.php');
  if (isset($_POST['id'])){
    $id = $_POST['id'];
    if(isset($_POST['action']) == 'true'){
      $sql = "update bill set action = 1 where id = ".$id;
      execute($sql);
    }
    echo "Hoàn tất";
  }
?>