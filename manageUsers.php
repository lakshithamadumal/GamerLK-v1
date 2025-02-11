<?php

session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Manage Users | Admins | gamerLk</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resourses/logo.png">

    </head>

    <body style="background-color: #252526;">

        <div class="container-fluid">
            <div class="row btnn overflow-x-hidden">
                <?php include "header_us.php"; ?>


                <div class="col-12 offset-lg-3 a">
                    <div class="row">
                        <div class="col-12 col-lg-6 mt-2 my-lg-4 text-center">
                            <h1 class="text-white fw-bold" style="font-family:spartan;">Manage All Users</h1>
                        </div>
                        <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid b">
                            <button onclick="printInvoice1();" class="btn_p"><i class="fa fa-print"></i> &nbsp;&nbsp;Print</button>
                        </div>

                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                            <div class="row">
                                <div class="col-9">
                                    <input type="text" class="form-control" />
                                </div>
                                <div class="col-3 d-grid">
                                    <button class="btn text-light fw-bold" style="background-color:  #ff4d05;">Search User</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-2 d-none d-lg-block col-lg-1 py-2 text-end bg-dark1">
                            <span class="fs-4 fw-bold text-white">ID</span>
                        </div>
                        <div class="col-2 d-none d-lg-block  py-2 bg-dark1 text-center">
                            <span class="fs-4 fw-bold text-light">Profile</span>
                        </div>
                        <div class="col-5 col-lg-2 py-2 bg-dark1">
                            <span class="fs-4 fw-bold text-white">User Name</span>
                        </div>
                        <div class="col-2 col-lg-3 d-lg-block  py-2 bg-dark1">
                            <span class="fs-4 fw-bold text-light">Email</span>
                        </div>

                        <div class="col-2 col-lg-1 d-none d-lg-block py-2 bg-dark1">
                            <span class="fs-4 fw-bold text-light"><i class="fa-solid fa-download fa-lg"></i></span>
                        </div>

                        <div class="col-3 d-none d-lg-block py-2 bg-dark1">
                            <span class="fs-4 fw-bold text-light">Registered Date</span>
                        </div>

                    </div>
                </div>

                <?php

                $query = "SELECT * FROM `users`";
                $pageno;

                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }

                $user_rs = Database::search($query);
                $user_num = $user_rs->num_rows;

                $results_per_page = 20;
                $number_of_pages = ceil($user_num / $results_per_page);

                $page_results = ($pageno - 1) * $results_per_page;
                $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");


                $selected_num = $selected_rs->num_rows;

                for ($x = 0; $x < $selected_num; $x++) {
                    $selected_data = $selected_rs->fetch_assoc();


                ?>
                    <div class="col-12 mt-0 mb-3">
                        <div class="row" id="page">
                            <div class="col-2 col-lg-1 py-2 text-end bg-dark1 d-none d-lg-block">
                                <span class="fs-5 text-light"><?php echo $x + 1; ?></span>
                            </div>
                            <div class="col-2 d-none d-lg-block py-2 bg-dark1" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">

                                <?php
                                $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" .  $selected_data["email"] . "'");
                                $image_data = $image_rs->fetch_assoc();



                                if (empty($image_data["path"])) {
                                ?>
                                    <img src="resourses/user.svg" style="height: 40px;margin-left: 80px;" />
                                <?php
                                } else {
                                ?>
                                    <img src="<?php echo $image_data["path"]; ?>" style="height: 40px;margin-left: 80px;" />
                                <?php
                                }

                                ?>
                            </div>
                            <div class="col-4 col-lg-2 py-2 bg-dark1">
                                <span class="fs-5 text-light"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></span>
                            </div>
                            <div class="col-2 col-lg-3 d-lg-block py-2 bg-dark1">
                                <span class="fs-6 text-light"><?php echo $selected_data["email"] ?></span>
                            </div>

                            <?php
                            $download_rs = Database::search("SELECT COUNT(*) AS download_count FROM `invoice` WHERE users_email='" . $selected_data["email"] . "'");
                            $download_data = $download_rs->fetch_assoc();
                            $download_count = $download_data['download_count'];

                            ?>

                            <div class="col-2 col-lg-1 d-none d-lg-block py-2 bg-dark1">
                                <span class="fs-6 text-light"><?php echo $download_count; ?></span>
                            </div>

                            <div class="col-2 d-none d-lg-block py-2 bg-dark1">
                                <span class="fs-6 text-light"><?php echo $selected_data["joined_date"] ?></span>
                            </div>
                            <div class="col-2 col-lg-1 py-2 d-grid bg-dark1 d-none d-lg-block">
                                <?php

                                if ($selected_data["status"] == 1) {
                                ?>
                                    <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-success" onclick="blockUser('<?php echo $selected_data['email']; ?>');"><i class="fa-solid fa-lock-open"></i></button>
                                <?php
                                } else {
                                ?>
                                    <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-danger" onclick="blockUser('<?php echo $selected_data['email']; ?>');"><i class="fa-solid fa-lock"></i></button>
                                <?php

                                }

                                ?>

                            </div>
                        </div>
                    </div>
                    <!-- msg modal -->
                    <div class="modal" tabindex="-1" id="userMsgModal<?php echo $selected_data["email"]; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark1">
                                <div class="modal-header border-dark">
                                    <h5 class="modal-title fw-bold text-light"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></h5>
                                    <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body overflow-hidden">
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
                                                <input type="text" style="background-color: #252526;" class="form-control text-light border-0" id="msgtxt" />
                                            </div>
                                            <div class="col-3 d-grid">
                                                <button type="button" class="btn btn-primary fw-bold" onclick="sendAdminMsg('<?php echo $selected_data['email']; ?>');">Send</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- msg modal -->
                <?php

                }

                ?>

                <!--  -->
                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-lg justify-content-center">
                            <li class="page-item">
                                <a class="page-link pages" <?php if ($pageno <= 1) {
                                                                echo ("#");
                                                            } else {
                                                            ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                } ?> aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            <?php

                            for ($y = 1; $y <= $number_of_pages; $y++) {
                                if ($y == $pageno) {
                            ?>
                                    <li class="page-item active">
                                        <a class="page-link pages" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item ">
                                        <a class="page-link pages" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                                    </li>
                            <?php
                                }
                            }

                            ?>

                            <li class="page-item ">
                                <a class="page-link pages" <?php if ($pageno >= $number_of_pages) {
                                                                echo ("#");
                                                            } else {
                                                            ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                } ?> aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!--  -->



            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php

} else {
    echo ("You are Not a valid user");
}

?>