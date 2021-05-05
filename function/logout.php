<?php
session_start();

if (isset($_SESSION['username1'])){
  session_unset();
  header('Location: ../index.php');
}else{
  header('Location: ../index.php');
}
?>