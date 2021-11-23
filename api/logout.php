<?php
session_start();
$_SESSION['user_id'] = "";
$_SESSION['user_name'] = "";
$_SESSION['fullname'] = "";
if (empty($_SESSION['user_id'])) header("location:../../caps1/sign.php");
