<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add OTP</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .bg-login-image {
            background-image: url('https://img.freepik.com/free-photo/top-view-bicolor-business-desk-arrangement_23-2148488617.jpg');
            background-size: cover;
            background-position: center;
            height: 80vh;
        }
    </style>

</head>
<body class="bg-gradient-primary">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">ADD OTP Here!</h1>
                                    <?php
                                    if(isset($_SESSION['error']) && $_SESSION['error'] !='')
									{
										echo '<h6 class="container py-3" style="color: red; text-align: center;">' .$_SESSION['error']. '</h6>';
										unset($_SESSION['error']);
									}
                                    ?>
                                </div>
                                <form class="user" action="add-otp-code.php" method="POST">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address..." required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="otp" class="form-control form-control-user" placeholder="Enter OTP..." required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.php">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="register.php">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
