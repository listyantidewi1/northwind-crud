<?php

require "connect.php";

$CustomerID = $_GET['CustomerID'];

$sql = "DELETE from customers WHERE CustomerID = '$CustomerID'";

$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil dihapus!";
    echo "<a href='view_customers.php'>Tampilkan Data Customers</a>";
} else {
    echo "Error : " . $sql . "<br />" . $conn->error;
}

$conn->close();