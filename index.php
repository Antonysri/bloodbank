<?php
session_start();
if(isset($_SESSION['hid']) && !empty($_SESSION['hid'])){
    header("location:blood_request.php");
    exit;
}
?>
<html>
<head>
    <title>Blood Bank Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .navbar-right {
            margin-left: auto;
        }
        
        .nav-link.register {
            margin-right: 40px;
        }
        .nav-link {
            margin-right: 40px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a style="font-size:x-large;color:crimson" class="navbar-brand" href="#">BloodBank System</a>
        </div>
        <div class="navbar-nav navbar-right">
            <a class="nav-link register" href="register.php">Register</a>
            <a class="nav-link" href="login.php">Log in</a>
        </div>
    </nav>


</body>
</html>
