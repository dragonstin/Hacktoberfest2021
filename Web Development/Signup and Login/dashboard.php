<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/style.css">
    <title>Dashboard</title>
</head>

<body>
    <div class="welcome">
        <h1>Welcome <?= $_SESSION['fname'] . $_SESSION['lname'] ?> </h1>
    </div>

</body>

</html>