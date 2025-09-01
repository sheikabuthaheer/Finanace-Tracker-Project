<?php
session_start();
ob_start();
if(isset($_SESSION['adminuserid'])) {
    unset($_SESSION['adminuserid']);
}
header("Location:index.php");
?>