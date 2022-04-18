<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

// Include config file
require_once "connect.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password, level FROM users WHERE username = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password, $level);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session

                            if ($level == "admin") {
                                session_start();
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                $_SESSION["level"] = $level;

                                // Redirect user to welcome page
                                header("location: index.php");
                            } else {
                                session_start();
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                $_SESSION["level"] = $level;

                                // Redirect user to welcome page
                                header("location: homepage.php");
                            }
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <title>LOGIN</title>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="card">
            <?php
            if (!empty($login_err)) {
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }
            ?>
            <div class="card-title">
                <h2>LOGIN</h2>
                <div class="underline-text"></div>
            </div>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form">
                <label for="username">
                    &nbsp;Username
                </label>
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                <input id="username" class="form-content <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" type="username" name="username" required />
                <label for="password" style="margin-top:4%;">
                    &nbsp;Password
                </label>
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                <input id="password" class="form-content <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" type="password" name="password" required />
                <a href="">
                    <legend class="forgot-pass">Forgot Password?</legend>
                </a>
                <input class="submit-btn" type="submit" name="submit" value="LOGIN">
                <a href="register.php" class="sign-up">Don't have account yet? <span style="color:red">Sign
                        Up</span></a>
            </form>
        </div>
    </section>
</body>

</html>