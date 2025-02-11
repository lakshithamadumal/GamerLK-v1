<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp | gamerLk</title>
    <link rel="icon" href="resourses/logo.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="main-body">
    <div class="container-fluid vh-100 d-flex justify-content-center btnn">
        <div class="row align-content-center">
            <!--Header-->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                </div>
            </div>
            <!--Header-->
            <!--content-->
            <div class="col-12">
                <div class="row">
                    <div class="col-3"></div>
                    <!--signup box-->
                    <div class="col-12 col-lg-6" id="SignUpBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title02" style="font-weight: bold;">Create New Account</p>
                            </div>

                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger fw-bold" role="alert" id="msg">

                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label title03" style="font-weight: bold;">First Name</label>
                                <input class="form-control" type="text" style="font-weight: bold;" placeholder="ex: John" id="fname">
                            </div>
                            <div class="col-6">
                                <label class="form-label title03" style="font-weight: bold;">Last Name</label>
                                <input class="form-control" type="text" style="font-weight: bold;" placeholder="ex: Cena" id="lname">
                            </div>
                            <div class="col-12">
                                <label class="form-label title03" style="font-weight: bold;">Email</label>
                                <input class="form-control" type="email" style="font-weight: bold;" placeholder="ex: john@gmail.com" id="email">
                            </div>
                            <div class="col-12">
                                <label class="form-label title03" style="font-weight: bold;">Password</label>
                                <input class="form-control" type="password" style="font-weight: bold;" placeholder="ex: ********" id="password">
                            </div>
                            <div class="col-6">
                                <label class="form-label title03" style="font-weight: bold;">Mobile</label>
                                <input class="form-control" type="text" style="font-weight: bold;" placeholder="ex: xxx xxx xxxx" id="mobile">
                            </div>

                            <!-- Gender -->

                            <div class="col-6">
                                <label class="form-label text-light fw-bold">Gender</label>
                                <select class="form-control fw-bold" id="gender">
                                    <option value="0">Select your Gender</option>
                                    <?php
                                    require "connection.php";

                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $n = $rs->num_rows;

                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>

                                    <?php

                                    }

                                    ?>
                                </select>

                            </div>


                            <div></div>
                            <div></div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" style="font-weight: bold;" onclick="signUp();">Sign Up</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark" style="font-weight: bold;" onclick="ChangeView();">
                                    Already have an Account? Sign In
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- signin box -->

                    <div class="col-12 col-lg-6 d-none" id="SignInBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title02" style="font-weight: bold;">Sign In Your Account</p>
                            </div>

                            <?php
                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }
                            ?>

                            <div class="col-12">
                                <label class="form-label title03" style="font-weight: bold;">Email</label>
                                <input type="email" class="form-control" style="font-weight: bold;" placeholder="ex: john@gmail.com" id="email2" value="<?php echo $email; ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label title03" style="font-weight: bold;">Password</label>
                                <input type="password" class="form-control" style="font-weight: bold;" placeholder="ex: ********" id="password2" value="<?php echo $password; ?>">
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberme">
                                    <label class="form-check-label title03" for="rememberme" style="font-weight: bold;">
                                        Remember Me.
                                    </label>
                                </div>
                            </div>


                            <div class="col-6 text-end">
                                <a href="#" class="link-primary" style="font-weight: bold;" onclick="forgotPassword();">Forgotten Password?</a>
                            </div>


                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn
                    btn-primary" style="font-weight: bold;" onclick="signin();">Sign In</button>
                            </div>


                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger" style="font-weight: bold;" onclick="ChangeView();">
                                    Are you new? Register Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- signin box -->



                    <!-- social media -->
                    <footer class="footer" >
                        <div class="social-buttons">
                            <a href="https://www.facebook.com/lakshitha.mandumal.3?mibextid=ZbWKwL" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://youtube.com/@lakshitha_madumal" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="https://www.instagram.com/lakshitha__m_a_d_u_m_a_l/" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://twitter.com/Lakshitha_m_" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.pinterest.com/" target="_blank">
                                <i class="fab fa-pinterest-p"></i>
                            </a>
                        </div>
                    </footer>
                    <!-- social media -->
                </div>
            </div>
            <!-- content -->


            <!-- modal -->
            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark1">
                        <div class="modal-header border-dark">
                            <h5 class="modal-title text-light fw-bold">Forgot Password?</h5>
                            <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="form-label text-light fw-bold">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" style="background-color: #252526;" class="form-control fw-bold text-light border-0" id="np" />
                                        <button class="btn btn-outline-secondary border-0" onclick="showPassword();" type="button" id="npb">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label text-light fw-bold">Confirm New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" style="background-color: #252526;" class="form-control fw-bold text-light border-0" id="rnp" />
                                        <button class="btn btn-outline-secondary border-0" onclick="showPassword2();" type="button" id="rnpb">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label text-light fw-bold">Verifiction Code</label>
                                    <input type="text" style="background-color: #252526;" class="form-control fw-bold text-light border-0" id="vc" />
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer border-dark">
                            <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary fw-bold" onclick="resetPassword();">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->




            <!-- footer -->
            <!-- footer -->
        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>

</body>

</html>