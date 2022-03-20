<?php
//inisialisasi session
session_start();

//unset session
$_SESSION = array();

//destroy session
session_destroy();

//redirect ke halaman login.php
header('Location: login.php');
exit;
