<?php

$_SESSION['logged_in'] = false;
$_SESSION['grub_user'] = NULL;
$_SESSION['login_failed'] = false;
header('Location:../index.html');

?>