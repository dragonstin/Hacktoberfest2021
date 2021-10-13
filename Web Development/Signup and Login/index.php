<?php
session_start();
include("connection.php");
if (isset($_POST["username"], $_POST["password"],  $_POST["submit"])) {
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $password =  mysqli_real_escape_string($conn, $_POST["password"]);
  $sql = "SELECT * FROM `user` WHERE `email`='$username'";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);
  if ($count) {
    while ($row = mysqli_fetch_assoc($result)) {
      $fname = $row['fname'];
      $lname = $row['lastname'];
      $fetched_password = $row['password'];
      $status = $row['status'];
    }
    $password_check = password_verify($password, $fetched_password);
    if ($password_check) {
      if ($status) {
        $_SESSION["fname"] = $fname;
        $_SESSION["lname"] = $lname;
        if (isset($_POST['remember'])) {
          setcookie("Username", $username);
          setcookie("password", $password);
        }
        header("Location:dashboard.php");
      } else {
        $_SESSION['error'] = "status error";
      }
    } else {
      $_SESSION['error'] = "Invalid password";
    }
  } else {
    $_SESSION['error'] = "user not found";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="stylesheets/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Login</title>
</head>

<body>

  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
  </svg>

  <div class="container ">
    <div class="user-icon">
      <div class="fa-icon"><i class="far fa-user"></i></div>
    </div>

    <!-- Invalid credentials alert  -->
    <?php

    if (isset($_SESSION['error']) && $_SESSION['error'] == "Invalid password") {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
      </svg>
      <strong>Invalid credentials!</strong> Email or password is incorrect.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      unset($_SESSION['error']);
    }

    if (isset($_SESSION['error']) && $_SESSION['error'] == "user not found") {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
      </svg>
      <strong>User not found!</strong> Please Sign Up before login.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      unset($_SESSION['error']);
    }
    if (isset($_SESSION['error']) && $_SESSION['error'] == "status error") {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
      </svg>
      <strong>Email not verified!</strong> Please verify your email address using link sent to your email address and try again.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      unset($_SESSION['error']);
    }
    if (isset($_SESSION['error']) && $_SESSION['error'] == "reg_success") {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
      <use xlink:href="#check-circle-fill"/></svg>
      <strong>Signup Successful !</strong> Please verify your email using link sent to your email address.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      unset($_SESSION['error']);
    }
    if (isset($_SESSION['error']) && $_SESSION['error'] == "Verification_success") {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
      <use xlink:href="#check-circle-fill"/></svg>
      <strong>Email Verified!</strong> Now you can login.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      unset($_SESSION['error']);
    }

    if (isset($_SESSION['error']) && $_SESSION['error'] == "Verification_failed") {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
      </svg>
      <strong>Verification Failed!</strong> Try again later.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      unset($_SESSION['error']);
    }

    ?>
    <h2>Login to your account</h2>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
      <div class="form-floating mb-3">
        <input type="email" class="form-control" name="username" value="<?php if (isset($_COOKIE['Username'])) {
                                                                          echo $_COOKIE['Username'];
                                                                        } ?>" id="username" placeholder="name@example.com">
        <label for="username">Email</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="password" value="<?php if (isset($_COOKIE['password'])) {
                                                                              echo $_COOKIE['password'];
                                                                            } ?>" id=" password" placeholder="Password">
        <label for="password">Password</label>
      </div>
      <div class="form-check mt-3">
        <input class="form-check-input" type="checkbox" value="" name="remember" id="remember">
        <label class="form-check-label" for="flexCheckDefault">
          Remember Me
        </label>
        <a href="#">Forgot Password?</a>
      </div>
      <div class="form-floating">
        <button class="btn mt-3" type="submit" name="submit">Login</button>
      </div>
    </form>
    <div class="signup mt-2">
      Need an account? <a href="signup.php">Sign Up</a>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/2c0b7141fa.js" crossorigin="anonymous"></script>
</body>

</html>