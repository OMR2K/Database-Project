<?php

session_start();
$_SESSION["login_status"] = 0;
$_SESSION["admin_login_status"] = 0;
$_SESSION["email"] = "";
$_SESSION["admin_email"] = "";
session_destroy();
header("location: home.html");

?>