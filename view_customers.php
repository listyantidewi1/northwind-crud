<?php
require_once "connect.php"; //menggunakan file connect.php

$sql = "select * from customers"; //query menampilkan all data dari tabel provinces
$result = $conn->query($sql); //menjalankan query $sql

//menampilkan data
if ($result->num_rows > 0) {
    //menampilkan data dalam format tabel
    echo "<table border=1>";
    echo "<tr>";
?>

    <!DOCTYPE HTML>
    <html>

    <head>
        <title>View Customers</title>
    </head>

    <body>
        <h1>Our Customers</h1>
        <table border=1>
            <tr>
                <th>Customer ID</th>
                <th>Company Name</th>
                <th>Contact Name</th>
                <th>Contact Title</th>
                <th>Address</th>
                <th>City</th>
                <th>Region</th>
                <th>Postal Code</th>
                <th>Country</th>
                <th>Phone</th>
                <th>Fax</th>
                <th>Action</th>
            </tr>
            <?php

            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row['CustomerID']; ?></td>
                    <td><?php echo $row['CompanyName']; ?></td>
                    <td><?php echo $row['ContactName']; ?></td>
                    <td><?php echo $row['ContactTitle']; ?></td>
                    <td><?php echo $row['Address']; ?></td>
                    <td><?php echo $row['City']; ?></td>
                    <td><?php echo $row['Region']; ?></td>
                    <td><?php echo $row['PostalCode']; ?></td>
                    <td><?php echo $row['Country']; ?></td>
                    <td><?php echo $row['Phone']; ?></td>
                    <td><?php echo $row['Fax']; ?></td>
                    <td>
                        <a href="edit_customers.php?CustomerID=<?php echo $row['CustomerID']; ?>">Edit</a>
                        <a href="delete_customer.php?CustomerID=<?php echo $row['CustomerID']; ?>">Delete</a>
                    </td>
                </tr>
                </div>
        <?php
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </body>

    </html>