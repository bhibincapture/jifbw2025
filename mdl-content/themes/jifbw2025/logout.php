<?php
session_start();

unset($_SESSION['email']);

unset($_SESSION['login']);

session_destroy();

header ("location: ".DB_LOCAL.DB_LINK."/login/");
?>