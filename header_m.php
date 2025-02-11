<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resourses/logo.png">
    <title>Home | gamerLk</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>

<body>
    <div class="header col-12">
        <div class="row mt-1 mb-1 btnn">
            <div onclick="window.location='home.php'" class="col-4 col-lg-2 footer-logo3">GAMER<span style="color: #ff4d05;" class="footer-logo3">L</span>K</div>

            <?php
            if (isset($_SESSION["u"])) {
                $session_data = $_SESSION["u"];
            ?>
                <span class="text-lg-start" style="color: white;"><b>Welcome </b>
                    <?php echo $session_data["fname"] . " " . $session_data["lname"]; ?>
                    ||<a href="#" class="text-decoration-none text-danger fw-bold" onclick="signout();">
                        Sign Out
                    </a>
                </span>
            <?php
            } else {
            ?>
                <a href="index.php" class="text-decoration-none text-warning fw-bold">
                    SignIn or Register
                </a>
            <?php
            }
            ?>

        </div>




        <div class="row">

            <div>

            <ul class="navbar" id="navbar">
                    <li class="d-none d-lg-block">
                        <a  href="home.php"><i class="fa-solid fa-house fa-xl "></i></a>
                    </li>
                    <li class="d-lg-none">
                        <a  href="home.php"><i class="fa-solid fa-house fa-lg "></i> &nbsp; Home</a>
                    </li>


                    <li class="d-none d-lg-block">
                        <a href="userProfile.php"><i class="fa-solid fa-user fa-xl"></i></a>
                    </li>
                    <li class="d-lg-none">
                        <a href="userProfile.php"><i class="fa-solid fa-user fa-lg"></i> &nbsp; Profile</a>
                    </li>



                    <li class="d-none d-lg-block">
                        <a href="watchlist.php"><i class="fa-solid fa-heart fa-xl"></i></a>
                    </li>
                    <li class="d-lg-none">
                        <a href="watchlist.php"><i class="fa-solid fa-heart fa-lg"></i> &nbsp; Watchlist</a>
                    </li>



                    <li class="d-none d-lg-block">
                        <a class="active" href="messages.php"><i class="fa-solid fa-envelope fa-xl"></i></a>
                    </li>
                    <li class="d-lg-none">
                        <a class="active" href="messages.php"><i class="fa-solid fa-envelope fa-lg"></i> &nbsp; Messages</a>
                    </li>



                    <li id="cart" class="d-none d-lg-block">
                        <a href="cart.php"><i class="fa-solid fa-cart-shopping fa-xl"></i></a>
                    </li>
                    <li id="cart" class="d-lg-none">
                        <a href="cart.php"><i class="fa-solid fa-cart-shopping fa-lg"></i> &nbsp; Cart</a>
                    </li>


                    <li class="d-none d-lg-block">
                        <?php
                        if (isset($_SESSION['u'])) {
                        ?>
                            <a href="#" onclick="contactAdmin('<?php echo $_SESSION['u']['email']; ?>');"> <i class="fa-solid fa-headset fa-xl"></i></a>


                        <?php
                        } else {
                        ?>

                            <a href="#" onclick="contactAdminNotUser();"> <i class="fa-solid fa-headset fa-xl"></i></a>
                        <?php
                        }
                        ?>
                    </li>
                    <li class="d-lg-none">
                        <?php
                        if (isset($_SESSION['u'])) {
                        ?>
                            <a href="#" onclick="contactAdmin('<?php echo $_SESSION['u']['email']; ?>');"> <i class="fa-solid fa-headset fa-xl"></i> &nbsp; Cotatct admin</a>


                        <?php
                        } else {
                        ?>

                            <a href="#" onclick="contactAdminNotUser();"> <i class="fa-solid fa-headset fa-xl"></i> &nbsp; Cotatct admin</a>
                        <?php
                        }
                        ?>
                    </li>


                    <a href="#" id="close">
                        <i class="fa-solid fa-xmark"></i>
                    </a>





                </ul>
            </div>



            <div class="mobile">
                <a href="cart.php">
                    <i class="fa-solid fa-cart-shopping fa-xl"></i>
                </a>
                <i class="fa-solid fa-bars fa-xl" id="bar"></i>
            </div>





        </div>

    </div>
    <!-- msg modal -->
    <div class="modal" tabindex="-1" id="contactAdmin">
        <div class="modal-dialog">
            <div class="modal-content bg-dark1">
                <div class="modal-header border-dark">
                    <h5 class="modal-title fw-bold text-light">Contact Admin</h5>
                    <button type="button" class="btn-close-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- received -->
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="offset-4  col-8 rounded" style="background-color: #252526;">
                                <div class="row">
                                    <div class="col-12 pt-2">
                                        <span class="text-white  fs-5">Hello</span>
                                    </div>
                                    <div class="col-12 text-end pb-2">
                                        <span class="text-white" style="font-size: 10px;">08:44</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- received -->
                    <!-- sent -->
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-8 rounded " style="background-color: #252526;">
                                <div class="row">
                                    <div class="col-12 pt-2">
                                        <span class="text-white  fs-5">Hi, How Can I Help You</span>
                                    </div>
                                    <div class="col-12 text-end pb-2">
                                        <span class="text-white" style="font-size: 10px;">09:05</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- sent -->
                </div>
                <div class="modal-footer border-dark">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" style="background-color: #252526;" class=" border-0 form-control fw-bold text-light" id="msgtxt" />
                            </div>
                            <div class="col-3 d-grid">
                                <button type="button" class="btn btn-primary fw-bold" onclick="sendAdminMsg();">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <script src="bootstrap.js"></script>

    <script src="script.js"></script>
</body>

</html>