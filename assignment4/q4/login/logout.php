<?php session_start();
  unset($_SESSION['user']);
  header("Location: /assignment4/q4/index/index.php");
  exit();
?>