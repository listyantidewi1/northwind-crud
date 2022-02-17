<?php
require "connect.php";

$CustomerID = $_GET['CustomerID'];

$sql = "select * from customers where CustomerID = '$CustomerID'"; //query utk menampilkan 1 data sesuai CustomerID
$result = $conn->query($sql); //menjalankan query $sql

//menampilkan satu data di dalam form
if ($result->num_rows > 0) {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Edit Customers</title>
    </head>

    <body>
        <h1>Update Data Customers</h1>
        <form method="post" action="action_update.php">
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <label for="CustomerID">Customer ID</label>
                <input type="text" id="CustomerID" name="CustomerID" placeholder="Enter Customer ID" value="<?php echo $row['CustomerID']; ?>" readonly><br />
                <label for="CompanyName">Company Name</label>
                <input type="text" id="CompanyName" name="CompanyName" placeholder="Enter Company Name" value="<?php echo $row['CompanyName']; ?>"><br />
                <label for="ContactName">Contact Name</label>
                <input type="text" id="ContactName" name="ContactName" placeholder="Enter Contact Name" value="<?php echo $row['ContactName']; ?>"><br />
                <label for="ContactTitle">Contact Title</label>
                <input type="text" id="ContactTitle" name="ContactTitle" placeholder="Enter Contact Title" value="<?php echo $row['ContactTitle']; ?>"><br />
                <label for="Address">Address</label>
                <textarea id="Address" name="Address" placeholder="Enter Address"><?php echo $row['Address']; ?></textarea><br />
                <label for="City">City</label>
                <input type="text" id="City" name="City" placeholder="Enter City" value="<?php echo $row['City']; ?>"><br />
                <label for="Region">Region</label>
                <input type="text" id="Region" name="Region" placeholder="Enter Region" value="<?php echo $row['Region']; ?>"><br />
                <label for="PostalCode">Postal Code</label>
                <input type="text" id="PostalCode" name="PostalCode" placeholder="Enter Postal Code" value="<?php echo $row['PostalCode']; ?>"><br />
                <label for="Country">Country</label>
                <input type="text" id="Country" name="Country" placeholder="Enter Country" value="<?php echo $row['Country']; ?>"><br />
                <label for="Phone">Phone</label>
                <input type="tel" id="Phone" name="Phone" placeholder="Enter Phone Number" value="<?php echo $row['Phone']; ?>"><br />
                <label for="Fax">Fax</label>
                <input type="tel" id="Fax" name="Fax" placeholder="Enter Fax Number" value="<?php echo $row['Fax']; ?>"><br /><br />
                <button type="submit" name="ubah" id="submit" value="submit">Submit</button>
        </form>
        </div>
    </body>
    </html>
<?php
            }
        } else {
            echo "Maaf, data tidak ada";
        }
        $conn->close();
?>