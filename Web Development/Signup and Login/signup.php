<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include("connection.php");
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT `fname` FROM `user` WHERE `email`='$email'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count) {
        $_SESSION['error'] = "User already exists";
    } else {
        $token = bin2hex(random_bytes(20));
        $pass_encrypt = password_hash($password, PASSWORD_BCRYPT);
        $sql_insert = "INSERT INTO `user`(`fname`, `lastname`, `email`, `password`, `status`, `token`) VALUES ('$fname','$lname','$email','$pass_encrypt','0','$token') ";
        $result = mysqli_query($conn, $sql_insert);
        if ($result) {
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = '<Your Email>';                     //SMTP username
                $mail->Password   = '<Password>';                                //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('parivestra@gmail.com', 'Login_Signup');
                $mail->addAddress($email, $fname . ' ' . $lname);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Verify your email address';
                $mail->Body    = 'Your registration is sucessfull. Please click the link to verify your email http://localhost/Signup%20amd%20Login%20verification/activate.php?email=' . $email . '&token=' . $token;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();
            } catch (Exception $e) {
            }

            $_SESSION['error'] = "reg_success";
            header("Location:index.php");
        } else {
            echo '<script>alert("Failed to insert data");</script>';
        }
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
    <title>Sign Up</title>
</head>

<body>

    <div class="container" style="margin-top: 100px !important; background-color: rgba(255, 255, 255, 0.8);">
        <h2>Create an account</h2>
        <?php
        if (isset($_SESSION['error']) && $_SESSION['error'] == "User already exists") {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <strong>User already exists!</strong> Email is already registered.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
            unset($_SESSION['error']);
        }
        ?>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-6">
                <label for="validationCustom01" class="form-label">First name</label>
                <input type="text" class="form-control" id="validationCustom01" name="fname" placeholder="First name" required>
                <div class="invalid-feedback">
                    Please provide your first name.
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustom02" class="form-label">Last name</label>
                <input type="text" class="form-control" id="validationCustom02" name="lname" placeholder="Last name" required>
                <div class="invalid-feedback">
                    Please provide your Last name.
                </div>
            </div>
            <div class="col-md-12">
                <label for="validationCustomUsername" class="form-label">Email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="email" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="email" placeholder="Email address" required>
                    <div class="valid-feedback">
                        Verfication link will be sent to this email address.
                    </div>
                    <div class="invalid-feedback">
                        Please enter a valid email.
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <label for="validationCustom03" class="form-label">Password</label>
                <input type="password" class="form-control" id="validationCustom03" name="password" placeholder="Password" required>
                <div class="invalid-feedback">
                    Please create a password
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                        Agree to terms and conditions
                    </label>
                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" name="submit" type="submit">SIGN UP</button>
            </div>
        </form>
        <div class="signup mt-2">
            Already have an account? <a href="index.php">Login</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/2c0b7141fa.js" crossorigin="anonymous"></script>
    <script src="js/form-validation"></script>
</body>

</html>