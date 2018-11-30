<?php
session_start();
$_SESSION["IsLogged"] = false;
ob_start();
header('Location: index.php');
ob_end_flush();
die();
?>