<?php
session_start(); //inisialisasi session dalam PHP

//periksa apakah user sudah login. Jika sudah, maka langsung redirect / pindah otomatis ke halaman index.php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

//include koneksi data
require_once "connect.php";

//definisi variabel dan beri nilai kosong dulu
$username = $password = "";
$username_err = $password_err = $login_err = "";


//pemrosesan data ketika form login di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //validasi isian form
    //1. Periksa apakah username kosong
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username";
    } else {
        $username = trim($_POST["username"]);
    }

    //2. Periksa apakah password kosong
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password";
    } else {
        $password = trim($_POST["password"]);
    }

    //validasi login
    if (empty($username_err) && empty($password_err)) {
        //query select untuk menyeleksi satu data
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = $conn->prepare($sql)) {
            //pembuatan statement dari query sql
            $stmt->bind_param("s", $param_username);
            $param_username = $username;

            //eksekusi statement
            if ($stmt->execute()) {
                $stmt->store_result();

                //periksa apakah username yg diinputkan ada/terdaftar. Jika ya, maka verifikasi apakah passwordnya sesuai
                if ($stmt->num_rows == 1) {
                    //ikat hasilnya ke dalam statement
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) { //jika password yang diisikan pengguna cocok dengan password yang ada di database (hashed password)
                            session_start(); //maka buat session baru

                            //simpan informasi login ke dalam variabel session
                            $_SESSION["loggedin"] = true; //status login = true / sedang login
                            $_SESSION["id"] = $id; //informasi id user yg sedang login
                            $_SESSION["username"] = $username; //informasi username user yg sedang login

                            //auto pindah ke halaman index.php setelah login
                            header("location:index.php");
                        } else {
                            //password tidak valid, tampilkan pesan error
                            $login_err = "Invalid username or password";
                        }
                    }
                } else {
                    $login_err = "Username doesn't exist";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later";
            }

            //close statement
            $stmt->close();
        }
    }
    //close koneksi database
    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 400px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please enter your username and password</p>

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group mt-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group mt-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group mt-3 mb-3">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign Up Now!</a></p>

        </form>

    </div>
</body>

</html>