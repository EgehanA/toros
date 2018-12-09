<?php ob_start(); session_start();
session_destroy(); // Oturumu sonlandırdı, mevcut session değerlerini sildi
header('Location:index.php');
