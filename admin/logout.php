<?php
session_start();

if (isset($_SESSION['username2'])){
  unset($_SESSION['username2']);
  header('Location: index.php');
}else{
  header('Location: index.php');
}
?>