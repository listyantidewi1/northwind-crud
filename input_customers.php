<!DOCTYPE html>
<html>

<head>
    <title>Insert Customers</title>
</head>

<body>
    <h1>Tambah Data Customers</h1>
    <form method="post" action="action_input.php">
        <label for="CustomerID">Customer ID</label>
        <input type="text" id="CustomerID" name="CustomerID" placeholder="Enter Customer ID"><br />
        <label for="CompanyName">Company Name</label>
        <input type="text" id="CompanyName" name="CompanyName" placeholder="Enter Company Name"><br />
        <label for="ContactName">Contact Name</label>
        <input type="text" id="ContactName" name="ContactName" placeholder="Enter Contact Name"><br />
        <label for="ContactTitle">Contact Title</label>
        <input type="text" id="ContactTitle" name="ContactTitle" placeholder="Enter Contact Title"><br />
        <label for="Address">Address</label>
        <textarea id="Address" name="Address" placeholder="Enter Address"></textarea><br />
        <label for="City">City</label>
        <input type="text" id="City" name="City" placeholder="Enter City"><br />
        <label for="Region">Region</label>
        <input type="text" id="Region" name="Region" placeholder="Enter Region"><br />
        <label for="PostalCode">Postal Code</label>
        <input type="text" id="PostalCode" name="PostalCode" placeholder="Enter Postal Code"><br />
        <label for="Country">Country</label>
        <input type="text" id="Country" name="Country" placeholder="Enter Country"><br />
        <label for="Phone">Phone</label>
        <input type="tel" id="Phone" name="Phone" placeholder="Enter Phone Number"><br />
        <label for="Fax">Fax</label>
        <input type="tel" id="Fax" name="Fax" placeholder="Enter Fax Number"><br /><br />
        <button type="submit" name="submit" id="submit" value="submit">Submit</button>
    </form>
    </div>
</body>

</html>