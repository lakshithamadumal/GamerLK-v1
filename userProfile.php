<?php
session_start();

// Check if the user is not signed in
if (!isset($_SESSION["u"])) {
    // Redirect to index.php
    header("Location: index.php");
    exit(); // Make sure to exit after redirecting
}
?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resourses/logo.png">
    <title>Profile | gamerlk</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>

<body style="background-color: #252526;">

    <div class="container-fluid">
        <div class="row btnn  overflow-x-hidden">


            <?php



            include "header_u.php";





            require "connection.php";


            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                $details_rs = Database::search("SELECT * FROM `users` INNER JOIN `gender` ON  
                                                users.gender_id=gender.id WHERE `email`='" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $email . "'");

                $address_rs = Database::search("SELECT * FROM `users` WHERE `contry_contry_id`='" . $email . "'");

                $details_data = $details_rs->fetch_assoc();
                $image_data = $image_rs->fetch_assoc();
                $address_data = $address_rs->fetch_assoc();

            ?><div class="col-12 offset-lg-3 a mt-3">
                    <div class="row">
                        <div class="col-12 col-lg-6 mt-2 my-lg-4 text-center">
                            <h1 class="text-white fw-bold" style="font-family:spartan;">User Profile</h1>
                        </div>
                        <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid b">
                            <button class="btn_p" onclick="window.location='purchasingHistory.php'"><i class="fa-solid fa-clock-rotate-left"></i>&nbsp; &nbsp;Purchase History </button>
                        </div>

                    </div>
                </div>


                <div class="col-12">
                    <div class="row">

                        <div class="col-12 bg-body mb-4">
                            <div class="row" style="background-color: #252526;">

                                <div class="col-12 border-end" style="background-color: #252526;">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                        <?php

                                        if (empty($image_data["path"])) {
                                        ?>
                                            <img src="resourses/user.svg" class="rounded mt-5" style="width:150px;" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $image_data["path"]; ?>" class="rounded mt-5" style="width:150px;" />
                                        <?php
                                        }

                                        ?>

                                        <br />

                                        <span class=" text-light"><?php echo $details_data["fname"] . " " . $details_data["lname"]; ?></span>
                                        <span class=" text-light"><?php echo $email; ?></span>

                                        <input type="file" class="d-none" id="profileImage" />
                                        <label for="profileImage" class="btn btn-primary mt-2 "><i class="fa-solid fa-image"></i> &nbsp;Update Profile</label>

                                    </div>
                                </div>

                                <div class="offset-2 col-8" style="background-color: #252526;">
                                    <div class="p-3 py-5">



                                        <div class="row">

                                            <div class="col-6 ">
                                                <label class="form-label text-light fw-bold">First Name</label>
                                                <input type="text" id="fname" style="background-color: #1e1e1e;" class="form-control text-light  border-0" value="<?php echo $details_data["fname"]; ?>" />
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label text-light fw-bold">Last Name</label>
                                                <input type="text" id="lname" style="background-color: #1e1e1e;" class="form-control text-light  border-0" value="<?php echo $details_data["lname"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label text-light fw-bold pt-2">Mobile Number</label>
                                                <input type="text" id="mobile" style="background-color: #1e1e1e;" class="form-control  text-light  border-0" value="<?php echo $details_data["mobile"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label text-light fw-bold pt-2">Password</label>
                                                <div class="input-group">
                                                    <input type="password" style="background-color: #1e1e1e;" id="pw" value="<?php echo $details_data["password"]; ?>" class="form-control  text-light fw-bold border-0" aria-describedby="pwb">
                                                    <span style="background-color: #1e1e1e;" class="input-group-text text-light  border-0" id="pwb" onclick="showPassword3();"><i class="bi bi-eye-fill"></i></span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label text-light fw-bold pt-2">Email</label>
                                                <input type="text" id="email" style="background-color: #1e1e1e;" class="form-control text-light  border-0" value="<?php echo $email; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label text-light fw-bold pt-2">Registered Date</label>
                                                <input type="text" style="background-color: #1e1e1e;" class="form-control text-light  border-0" readonly value="<?php echo $details_data["joined_date"]; ?>" />
                                            </div>

                                            <?php

                                            $contry_rs = Database::search("SELECT * FROM `contry`");

                                            $contry_num = $contry_rs->num_rows;

                                            ?>

                                            <div class="col-6">
                                                <label class="form-label text-light fw-bold pt-2">contry</label>
                                                <select style="background-color: #1e1e1e;" class="form-select text-light  border-0" id="contry">
                                                    <option value="0">Select contry</option>
                                                    <?php

                                                    for ($x = 0; $x < $contry_num; $x++) {
                                                        $contry_data = $contry_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $contry_data["contry_id"]; ?>" <?php
                                                                                                                    if (!empty($address_data["contry_contry_id"])) {
                                                                                                                        if ($contry_data["contry_id"] == $address_data["contry_contry_id"]) {
                                                                                                                    ?> selected <?php
                                                                                                                            }
                                                                                                                        }
                                                                                                                                ?>>
                                                            <?php echo $contry_data["contry_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>





                                            <div class="col-6">
                                                <label class="form-label text-light fw-bold pt-2">Gender</label>
                                                <input style="background-color: #1e1e1e;" type="text" class="form-control text-light  border-0" readonly value="<?php echo $details_data["gender_name"]; ?>" />
                                            </div>

                                            <div class="col-12 d-grid mt-2 pt-4">
                                                <button class="btn bb3" onclick="updateProfile();">Update My Profile</button>
                                            </div>



                                        </div>

                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>

            <?php

            } else {
                require "banner.php";
            }

            ?>




            <?php

            require "footer.php";

            ?>



        </div>
    </div>









    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>