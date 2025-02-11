<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advanced Search | gamerLk</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resourses/logo.png">

</head>

<body style="background-color: #252526;">

    <div class="container-fluid">
        <div class="row btnn">


            <?php include "header_se.php"; 
            include "a_banner.php";?>


            <div class="col-12 mb-2 d-lg-none" style="background-color: #2d2d30;">
                <div class="row">
                    <div class="offset-lg-4 col-12 col-lg-4">
                        <div class="row">


                            <div class="col-10 text-center">
                                <P class="fs-1 text-light fw-bold mt-3 pt-3">Advanced Search</P>
                                <hr style="color: #ff4d05;" class="mt-0" />

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-lg-2 col-12 col-lg-8 mb-3 rounded">
                <div class="row">

                    <div class="offset-lg-1 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12 col-lg-12 mt-5 mb-1">
                                <input type="text" class="form-control  border-0 text-light" style="background-color: #1e1e1e; " value="Type keyword to search..." id="t" />
                            </div>

                            <div class="col-12">
                                <hr class="border border-3 border-fuck">
                            </div>
                        </div>
                    </div>

                    <div class="offset-lg-1 col-12 col-lg-10">
                        <div class="row">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-6 mb-3">
                                        <select class="form-select  border-0 text-light" style="background-color: #1e1e1e;" id="c1">
                                            <option value="0">Select Category</option>
                                            <?php
                                            $category_rs = Database::search("SELECT * FROM `category`");
                                            $category_num = $category_rs->num_rows;

                                            for ($x = 0; $x < $category_num; $x++) {
                                                $category_data = $category_rs->fetch_assoc();
                                            ?>

                                                <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?></option>

                                            <?php
                                            }

                                            ?>
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <select class="form-select  border-0 text-light" style="background-color: #1e1e1e;" id="b1">
                                            <option value="0">Select Game type</option>
                                            <?php

                                            $brand_rs = Database::search("SELECT * FROM `game_type`");
                                            $brand_num = $brand_rs->num_rows;

                                            for ($x = 0; $x < $brand_num; $x++) {
                                                $brand_data = $brand_rs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["type_name"]; ?></option>

                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>


                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" style="background-color: #1e1e1e;" class="border-0 text-light form-control " value="Price From..." id="pf" />
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" style="background-color: #1e1e1e;" class="border-0 text-light form-control " value="Price To..." id="pt" />
                                    </div>

                                   

                                    <div class="col-12 col-lg-12 mb-3">
                                        <select class="form-select  border-0 text-light" style="background-color: #1e1e1e;" id="s">
                                            <option value="0">SORT BY</option>
                                            <option value="1">PRICE LOW TO HIGH</option>
                                            <option value="2">PRICE HIGH TO LOW</option>
                                            <option value="3">QUANTITY LOW TO HIGH</option>
                                            <option value="4">QUANTITY HIGH TO LOW</option>

                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border border-3 border-fuck">
                                    </div>

                                    <div class="col-12 col-lg-12 mt-2 mb-4 d-grid">
                                        <button class="btn btn-primary fw-bold" onclick="advancedSearch(0);">Search</button>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>



            <div class="offset-lg-2 col-12 col-lg-8 rounded mb-3">
                <div class="row">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row" id="view_area">
                            <div class="offset-5 col-2 mt-5">
                                <span class="fw-bold text-black-50"><i class="bi bi-search h1" style="font-size: 100px; color: #fff;"></i></span>
                            </div>
                            <div class="offset-3 col-6 mt-3 mb-5">
                                <span class="h1 text-light fw-bold">No Games Searched Yet...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>