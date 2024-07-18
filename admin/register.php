<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register Page</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    
    <!-- Material Design Iconic Font for the eye icon-->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .bg-register-image {
            background-image: url('https://t3.ftcdn.net/jpg/08/22/71/88/360_F_822718834_MFPzBmrS0n3LHvn6ZV9egDXcXUkV5d1s.jpg');
            background-size: cover;
            background-position: center;
            height: 142vh;
        }

        .field-icon {
            float: right;
            margin-right: 10px;
            margin-top: -35px;
            position: relative;
            z-index: 2;
            cursor: pointer;
        }

    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>


                            <form class="user" action="code.php" method="POST" enctype="multipart/form-data">

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name" name="firstname" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name" name="lastname" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name="email" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputAddress"
                                        placeholder="Home Address" name="address" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputPhone"
                                        placeholder="Phone Number" name="phone" required>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password" required>
                                            <span toggle="#exampleInputPassword"
                                            class="mdi mdi-eye field-icon toggle-password"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleConfirmPassword" placeholder="Confirm Password" name="cpassword" required>
                                            <!--<span toggle="#exampleConfirmPassword"
                                            class="mdi mdi-eye field-icon toggle-password"></span>-->
                                    </div>
                                </div> <br>

                                <div class="form-group">
                                    Profile Picture : &nbsp;&nbsp;&nbsp;   
                                    <input type="file" name="profileimage" required>
                                </div> <br>

                                <div class="form-group">
                                <label for="howhear"> How did you hear about us ? : &nbsp;&nbsp;&nbsp; </label>
                                <select name="howhear" id="ways" required>
                                    <option value="whatsapp"> WhatsApp </option>
                                    <option value="institue or university"> Institute or University </option>
                                    <option value="linkedin"> LinkedIn </option>
                                    <option value="Other"> Other </option>
                                </select>
                                </div> <br>

                                <div class="form-group">
                                    <label for="gender"> Gender : &nbsp;&nbsp;&nbsp; </label>
                                    <input type="radio" id="male" name="gender" value="male">
                                    <label for="male"> Male &nbsp;&nbsp;&nbsp; </label>
                                    <input type="radio" id="female" name="gender" value="female">
                                    <label for="female"> Female &nbsp;&nbsp;&nbsp; </label>
                                    <input type="radio" id="other" name="gender" value="other">
                                    <label for="other"> Other </label><br>
                                </div> <br>

                                <div class="form-group">
                                    <input type="checkbox" name="agreeterm" id="agree-term" class="agree-term" required/>
                                    <label for="agree-term" class="label-agree-term"> I agree all statements in  <a href="#" class="term-service"> Terms of service </a></label>
                                </div>



                                <?php
                                if(isset($_SESSION['status']) && $_SESSION['status'] !='')
                                {
                                    echo '<h6 class="container py-3" style="color: red; text-align: center;">' .$_SESSION['status']. '</h6>';
                                    unset($_SESSION['status']);
                                }
                                ?>


                                <button type="submit" class="btn btn-primary btn-user btn-block" name="registerbtn">
                                    Register Account
                                </button>
                                
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Password toggle script -->
    <script>
        $(document).on('click', '.toggle-password', function () {
            $(this).toggleClass('mdi-eye mdi-eye-off');
            var input = $($(this).attr('toggle'));
            if (input.attr('type') == 'password') {
                input.attr('type', 'text');
            } else {
                input.attr('type', 'password');
            }
        });
    </script>



</body>

</html>