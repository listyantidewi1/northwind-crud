<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once "connect.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <img src="img/home.png">
            <h1>ADMIN</h1>
        </div>
        <div class="sidebar-menu">
            <ul>
                <div class="user-wrapper">
                    <img src="img/user.png">
                    <div>
                        <h1>WELCOME</h1>
                        <h2><?php echo ucfirst($_SESSION["username"]); ?></h2>
                        <small>Online</small>
                    </div>
                </div>
                <div class="main-navigation">
                    <h1>MAIN NAVIGATION</h1>
                </div>
                <li>
                    <a href="index.php" ><span class="las la-tachometer-alt"></span>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="customers.php"><span class="las la-users"></span>
                        <span>Customers</span></a>
                </li>
                <li>
                    <a href="products.php"><span class="las la-shopping-bag"></span>
                        <span>Products</span></a>
                </li>
                <li>
                    <a href="orders.php" class="active"><span class="las la-clipboard-list"></span>
                        <span>Orders</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <h1>
                <label for="">
                    <i class="las la-bars"></i>
                </label>
            </h1>
            <div class="search-wrapper">
                <input type="search" placeholder="Search Here ....">
                <span class="las la-search"></span>
            </div>
            <a href="logout.php">
                <div class="log-out">
                    <h4>Log Out </h4><span class="las la-sign-out-alt"></span>
                </div>
            </a>
        </header>

        <main>
            
        </main>
    </div>
</body>

</html>