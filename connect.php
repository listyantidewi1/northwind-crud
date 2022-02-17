<?php
//parameter koneksi
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "northwind";

//koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

//periksa koneksi
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
} else {
    //echo "Connection ok";
}
