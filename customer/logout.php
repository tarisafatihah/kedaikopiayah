<?php
session_start();
session_destroy();
// session_unset($_SESSION['id_customer']);
header('location:../index.php');
?>