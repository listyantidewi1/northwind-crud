<?php

include "connect.php";

if ($_POST['ubah'] == "submit") { //jika tombol ubah dibaca dan nilai hasil bacaannya adalah "submit" maka:

    //membaca inputan
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

    //Membuat query sql untuk update data
    $sql = "UPDATE customers SET CompanyName = '$CompanyName', ContactName = '$ContactName', ContactTitle = '$ContactTitle', Address = '$Address', City = '$City', Region = '$Region', PostalCode = '$PostalCode', Country = '$Country', Phone = '$Phone', Fax = '$Fax' WHERE CustomerID = '$CustomerID'";

    //Jalankan query
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diubah! <br />";
        echo "<a href='view_customers.php'>Tampilkan Data Customers</a>";
    } else {
        echo "Error: " . $sql . "<br />" . $conn->error;
        echo "<a href='view_customers.php'>Tampilkan Data Customers</a>";
    }

    $conn->close();
}
