<?php
include "connect.php";

if ($_POST['submit'] == "submit") {
    //Membaca inputan yang diketik di dalam form
    $CustomerID = $_POST['CustomerID'];
    $CompanyName = $_POST['CompanyName'];
    $ContactName = $_POST['ContactName'];
    $ContactTitle = $_POST['ContactTitle'];
    $Address = $_POST['Address'];
    $City = $_POST['City'];
    $Region = $_POST['Region'];
    $PostalCode = $_POST['PostalCode'];
    $Country = $_POST['Country'];
    $Phone = $_POST['Phone'];
    $Fax = $_POST['Fax'];


    //Membuat query sql
    $sql = "INSERT INTO customers VALUES ('$CustomerID', '$CompanyName', '$ContactName','$ContactTitle', '$Address','$City','$Region','$PostalCode','$Country','$Phone','$Fax' )";

    //Jalankan query
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan!<br/>";
        echo "<a href='view_customers.php'>Tampilkan Data</a>";
    } else {
        echo "Error: " . $sql . "<br/>" . $conn->error;
        echo "<a href='view_customers.php'>Tampilkan Data</a>";
    }

    $conn->close();
}
