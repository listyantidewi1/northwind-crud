<?php
session_start();

//periksa apakah sudah login, jika belum maka pindah ke login.php
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

//include koneksi database 
require_once "connect.php";

//definisi variabel
$new_password = $confirm_password = ""; //menyimpan password baru yg diketik di form ubah password
$new_password_err = $confirm_password_err = ""; //menyimpan pesan error

//pengecekan jika tombol sudah di klik submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//proses update password
    //ambil password baru yg diketikkan
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter your new password";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must be at least 6 characters";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    //validasi confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm your password";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match";
        }
    }

    //periksa error pada input
    if (empty($new_password_err) && empty($confirm_password_err)) {
        //buat query update data
        $sql = "UPDATE users SET password = ? WHERE id = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("si", $param_password, $param_id);

            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            if ($stmt->execute()) {
                //jika eksekusi berhasil, maka auto logout dan user harus login lagi dengan password barunya
                session_destroy();
                header("Location: login.php");
                exit();
            } else {
                //jika eksekusi gagal, maka tampilkan pesan error
                echo "Oops! Something went wrong. Please try again later";
            }

            $stmt->close();
        }
    }

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
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group mt-3">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group mt-3">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password; ?></span>
            </div>
            <div class="form-group mt-3">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="index.php">Cancel</a>
            </div>
        </form>
    </div>

</body>

</html>