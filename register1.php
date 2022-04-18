<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/register.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <title>Sign Up</title>
</head>

<body>
  <div class="card">
    <div class="card-content">
      <div class="card-title">
        <h2>Sign Up</h2>
        <div class="underline-title"></div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form">
        <label for="username" style="padding-top:11%">
            &nbsp;Username
          </label>
          <input id="username" class="form-content" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" style="margin-top: 10px; text-align: center;" type="email" name="email" autocomplete="on" required />
          <span class="invalid-feedback"><?php echo $username_err; ?></span>
          <label for="username" style="padding-top:4%">
            &nbsp;Password
          </label>
          <input id="user-password" class="form-content" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?> style="margin-top:10px; text-align:center;"type="password" name="password" required />
          <span class="invalid-feedback"><?php echo $password_err; ?></span>
          <label for="username" style="padding-top:4%">
            &nbsp;Confirm Password
          </label>
          <input id="user-password" class="form-content" <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?> style="margin-top:10px; text-align:center;"type="password" name="password" required />
          <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        <input id="submit-btn" style="margin-top:10%;" type="submit" name="submit" value="Submit" />
        </form>

  </div>
</body>

</html>