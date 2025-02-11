<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin LogIn | gamerLk</title>
    <link rel="icon" href="resourses/logo.png">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resourses/logo.png">
</head>

<body class="main-body-A-signin">

    <div class="container-fluid justify-content-center" style="margin-top: 100px;">
        <div class="row align-content-center btnn">

            <div class="col-12">
                <div class="row">

                    <div class="col-12 logo"></div>
                    

                </div>
            </div>

            <div class="col-12 p-3">
                <div class="row">
                    <div class="col-3 d-none d-lg-block background"></div>
                    

                    <div class="col-12 col-lg-6 d-block">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="title02">Admin Log In</p>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-light">Email</label>
                                <input type="email" class="form-control fw-bold" placeholder="ex : john@gmail.com" id="e" />
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary fw-bold" onclick="adminVerification();">Send Verification Code</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button onclick="window.location.href='Home.php';" class="btn btn-dark fw-bold">Back to Home Page</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->

            <div class="modal" tabindex="-1" id="verificationModal">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark1">
                        <div class="modal-header border-dark">
                            <h5 class="modal-title fw-bold text-light">Admin Verification</h5>
                            <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body border-dark">
                            <label class="form-label text-light">Enter Your Verification Code</label>
                            <input type="text" style="background-color: #252526;" class=" text-light form-control fw-bold border-0" id="vcode">
                        </div>
                        <div class="modal-footer  border-dark">
                            <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary fw-bold" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->

            <div class="col-12 fixed-bottom text-center text-light">
                <p>&copy; 2024 gamerLK.com | All Rights Reserved</p>
            </div>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>