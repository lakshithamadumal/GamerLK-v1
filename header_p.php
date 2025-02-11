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
            <div onclick="window.location='adminPanel.php'" class="col-4 col-lg-2 footer-logo3">GAMER<span style="color: #ff4d05;" class="footer-logo3">L</span>K</div>

        </div>






        <div class="row">

            <div>

            <ul class="navbar" id="navbar">
                    <li class="d-none d-lg-block">
                        <a  href="adminPanel.php"><i class="fa-solid fa-house fa-xl"></i></a>
                    </li>
                    <li class="d-lg-none">
                        <a  href="adminPanel.php"><i class="fa-solid fa-house fa-lg"></i> &nbsp; Dashboard</a>
                    </li>


                    <li class="d-none d-lg-block">
                        <a class="active" href="myProducts.php"><i class="fa-solid fa-list fa-xl"></i></a>
                    </li>
                    <li class="d-lg-none">
                        <a class="active" href="myProducts.php"><i class="fa-solid fa-list fa-lg"></i> &nbsp; Products</a>
                    </li>


                    <li class="d-none d-lg-block">
                        <a href="manageUsers.php"><i class="fa-solid fa-users fa-xl"></i></a>
                    </li>
                    <li class="d-lg-none">
                        <a href="manageUsers.php"><i class="fa-solid fa-users fa-lg"></i> &nbsp; Users</a>
                    </li>


                    <li class="d-none d-lg-block">
                        <a href="#"><i class="fa-solid fa-inbox fa-xl"></i></a>
                    </li>
                    <li class="d-lg-none">
                        <a href="#"><i class="fa-solid fa-inbox fa-lg"></i> &nbsp; Inbox</a>
                    </li>


                    <li class="d-none d-lg-block">
                        <a href="#"><i class="fa-solid fa-gear fa-xl"></i></a>
                    </li>
                    <li class="d-lg-none">
                        <a href="#"><i class="fa-solid fa-gear fa-lg"></i> &nbsp; Settings</a>
                    </li>



                    <a href="#" id="close">
                        <i class="fa-solid fa-xmark"></i>
                    </a>

                </ul>
            </div>

            

            <div class="mobile">
                <a href="#">
                <i class="fa-solid fa-gear fa-xl"></i></i>
                </a>
                <i class="fa-solid fa-bars fa-xl" id="bar"></i>
            </div>
        </div>
    </div>































    <script src="script.js"></script>
</body>

</html>